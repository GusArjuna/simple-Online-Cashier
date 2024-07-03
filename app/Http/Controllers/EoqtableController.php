<?php

namespace App\Http\Controllers;

use App\Models\eoqtable;
use App\Http\Requests\StoreeoqtableRequest;
use App\Http\Requests\UpdateeoqtableRequest;
use App\Models\food;
use App\Models\frakturJual;
use App\Models\member;
use App\Models\nomorRegisFrakturBeli;
use App\Models\supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EoqtableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(){
        $foodCount = food::count();
        $memberCount = member::count();
        $supplierCount = supplier::count();
        $foods = food::orderBy('penjualan','desc')->paginate(15);

        $monthlyDates = $this->generateMonthlyDates('forward'); // foward or backward
        $foodAndEoqByWeeks = $this->getEoqData($monthlyDates);
        $groupedData = $this->groupEoqData($foodAndEoqByWeeks);
        $products = $this->getProductNames($groupedData);
        $colors = $this->generateColors($products);

        // dd($startOfWeek, $groupedData, $products, $colors);

        return view("dashboard",[
            "title" => "Dashboard",
            "foodCount" => $foodCount,
            "memberCount" => $memberCount,
            "supplierCount" => $supplierCount,
            "foods" => $foods,
            "groupedData" => $groupedData,
            "monthlyDates" => $monthlyDates,
            "colors" => $colors,
        ]);
    }

    function generateMonthlyDates(string $direction = 'forward') {
        $dates = [];
        $currentDate = now();
    
        for ($i = 0; count($dates) < 7; $i++) {
            $firstDayOfMonth = $currentDate->copy()->startOfMonth();
            $dates[] = $firstDayOfMonth->format("Y-m-d");
    
            $sixteenthDayOfMonth = $currentDate->copy()->startOfMonth()->addDays(15);
            $dates[] = $sixteenthDayOfMonth->format("Y-m-d");
    
            if ($direction === 'forward') {
                $currentDate->addMonths(1);
            } elseif ($direction === 'backward') {
                $currentDate->subMonths(1);
            } else {
                return 'Invalid direction. Please specify "forward" or "backward".';
            }
        }
    
        return $dates;
    }

    function getEoqData($startOfWeek) {
        $foodAndEoqByWeeks = [];
    
        foreach ($startOfWeek as $week) {
            $eoqData = eoqtable::join('food', 'food.kode', 'eoqtables.kodeMakanan')
                ->where("periode", $week)
                ->orderBy('EOQ', 'desc')
                ->limit(10)
                ->get();
    
            foreach ($eoqData as $eoq) {
                $foodName = $eoq->nama;
                $eoqValue = $eoq->EOQ;
    
                $found = false;
                foreach ($foodAndEoqByWeeks as &$item) {
                    if ($item['name'] === $foodName) {
                        $item['data'][] = $eoqValue;
                        $found = true;
                        break;
                    }
                }
    
                if (!$found) {
                    $foodAndEoqByWeeks[] = ['name' => $foodName, 'data' => [$eoqValue]];
                }
            }
        }
    
        return $foodAndEoqByWeeks;
    }
    

    function groupEoqData($foodAndEoqByWeeks) {
        $groupedData = collect($foodAndEoqByWeeks)->groupBy('name')->map(function ($item) {
            return ['name' => $item[0]['name'], 'data' => $item->pluck('data')->flatten()->toArray()];
        })->values()->all();
    
        return $groupedData;
    }
    
    function getProductNames($groupedData) {
        $products = array_map(function ($item) {
            return $item['name'];
        }, $groupedData);
    
        return $products;
    }
    
    function generateColors($products) {
        $colors = [];
        foreach ($products as $product) {
            $colors[] = '#' . substr(md5($product), 0, 6);
        }
    
        return $colors;
    }

    public function index()
    {
        $foods = food::all();
        $eoqTables = eoqtable::query();
        $selectedDate = Session::get('selected_date');
    
        if ($selectedDate) {
            $selectedDate = Carbon::parse($selectedDate);
            $day = $selectedDate->day;
            $periode = $selectedDate->format('Y-m') . '-' . ($day <= 15 ? '01' : '16');
            $eoqTables->where('periode', $periode);
        }
        if(request('search')){                                     
            $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get()
                                        ->orWhere('qty','like','%'.request('search').'%')->get()
                                        ->orWhere('safetyStoc','like','%'.request('search').'%')->get()
                                        ->orWhere('lifeTime','like','%'.request('search').'%')->get();
                                        
            $eoqTables->where('kodeMakanan','like','%'.request('search').'%')
                                        ->orWhere('EOQ','like','%'.request('search').'%')
                                        ->orWhere('ROP','like','%'.request('search').'%')
                                        ->orWhere('biayaPenyimpanan','like','%'.request('search').'%');
            
            foreach($querytambahan2 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $eoqTables->orWhere('kodeMakanan','like','%'.$querybantuan.'%');
            }
        }
        return view('EOQMethod/EOQMethod',[
            "title"=>"EOQMethod",
            "eoqTables" => $eoqTables->paginate(15),
            "foods" => $foods,
            "selectedDate" => Session::get('selected_date'),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    /*
    Riwayat Codingan
    // $totalDays = 14;
        // $selectedDate = Carbon::parse($request->tanggal); // ganti dengan tanggal yang dipilih
        // $startDate = $selectedDate->copy()->subDays(14);
        // $endDate = $selectedDate;
        // for ($month = 1; $month <= 12; $month++) {
        //     $totalDays += cal_days_in_month(CAL_GREGORIAN, $month, $year-1);
        // }

        // $demand = frakturJual::where('kodeMakanan','like','%'.$food->kode.'%')
            //                 ->whereYear('tanggal',$year-1)
            //                 ->sum('qty');

                dd("holding Cost",$hodingCost,
                "Kode Makanan",$food->kode,
                "Demand",$demand,
                "EOQ",$eoq,
                "SafetyStoc",$food->safetyStock, 
                "Life Time",$food->lifeTime,
                "ROP",$rop,
                "Tanggal",$request->tanggal,
                "startDate",$startDate->format("d-M-Y"),
                "EndDate",$endDate->format("d-M-Y"),
                "totalDays",$totalDays,
                "day",$day,
                "existingRecord",$existingRecord,
                "periode",$periode->format("d-M-Y"),
                "periode Asli",$periode->format('Y-m') . '-' . ($day <= 15 ? '1' : '16'),
                );

        //     $hodingCost = ceil(($food->hargaJual*$food->qty)/((100/100)+(20/100)));
        //     $demand = frakturJual::where('kodeMakanan', 'like', '%' . $food->kode . '%')
        //         ->whereBetween('tanggal', [$startDate, $endDate])
        //         ->sum('qty');
        //     if ($hodingCost>0) {
        //         $eoq = round(sqrt(2*$food->biayaPemesanan*$demand/$hodingCost),1);
        //         $rop = round($food->safetyStock*($demand/$totalDays)*$food->lifeTime,1);
        //     }else{
        //         $eoq = 0;
        //         $rop = round($food->safetyStock*($demand/$totalDays)*$food->lifeTime,1);
        //     }

        //     eoqtable::create([
        //         'kodeMakanan' => $food->kode,
        //         'BiayaPenyimpanan' => $hodingCost,
        //         'EOQ' => $eoq,
        //         'ROP' => $rop,
        //     ]);
        // }
        // return redirect('/eoq')->with('success','Data Di Update');
    */
    public function updateEoq(Request $request)
    {      
        $foods = food::all();
        $selectedDate = Carbon::parse($request->tanggal);
        $day = $selectedDate->day;

        if ($day <= 15) {
            $startDate = $selectedDate->copy()->subMonth()->startOfMonth()->addDays(15);
            $endDate = $selectedDate->copy()->subMonth()->endOfMonth();
            $check = $startDate->copy()->addMonth();
        } else {
            $startDate = $selectedDate->copy()->startOfMonth();
            $endDate = $selectedDate->copy()->startOfMonth()->addDays(14);
            $check = $startDate->copy();
        }
        $totalDays = $startDate->diffInDays($endDate) + 1;
        foreach ($foods as $food) {
            $existingRecord = eoqtable::where('kodeMakanan', $food->kode)
            ->where('periode', $check->format('Y-m') . '-' . ($day <= 15 ? '01' : '16'))
            ->first();

            if (!$existingRecord) {
                $hodingCost = ceil(($food->hargaJual * $food->qty) / ((100 / 100) + (20 / 100)));
                $demand = frakturJual::where('kodeMakanan', 'like', '%' . $food->kode . '%')
                    ->whereBetween('tanggal', [$startDate, $endDate])
                    ->sum('qty');

                if ($hodingCost > 0) {
                    $eoq = round(sqrt(2 * $food->biayaPemesanan * $demand / $hodingCost), 1);
                    $rop = round($food->safetyStock * ($demand / $totalDays) * $food->lifeTime, 1);
                } else {
                    $eoq = 0;
                    $rop = round($food->safetyStock * ($demand / $totalDays) * $food->lifeTime, 1);
                }
                eoqtable::create([
                    'kodeMakanan' => $food->kode,
                    'BiayaPenyimpanan' => $hodingCost,
                    'EOQ' => $eoq,
                    'ROP' => $rop,
                    'periode' => ($day <= 15 ? $startDate->copy()->addMonth()->format('Y-m') . '-' . ($day <= 15 ? '01' : '16') : $startDate->copy()->format('Y-m') . '-' . ($day <= 15 ? '01' : '16')), 
                ]);
            }
            
        }
        Session::put('selected_date', $request->tanggal);
        return redirect('/eoq')->with('success','Data Di Update');
    }
    
    public function printQR($request)
    {
        // // $directory = '../public/qrcodes/';
        // // if (!is_dir($directory)) {
        // //     mkdir($directory, 0777, true);
        // // }
        // // QrCode::format('png');
        // // $qrs=QrCode::generate($request, '../public/qrcodes/',$request,'.png');
        // // dd($qrs);
        // $pdf = Pdf::loadView('printQR', [
        //     "data" => $request,
        //     "qrs" => $qrs,
        // ])->setPaper('f4', 'landscape');
        // return $pdf->download('Print_QR.pdf');
    }

    public function print(Request $request)
    {
        $foods = food::all();
            $cek=false;
            $lastId = eoqtable::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
            $data = [];
            for ($i = 1; $i <= $lastId; $i++) {
                $inputName = 'print' . $i;
                if($request->$inputName){
                    $cek=true;
                    break;
                }elseif(!$request->$inputName){
                    $cek=false;
                }
            }
            if($cek){
                for ($i = 1; $i <= $lastId; $i++) {
                    $inputName = 'print' . $i; // Membuat nama input berdasarkan iterasi
    
                    if ($request->has($inputName)) {
                        // Melakukan pencarian berdasarkan nilai input dari request pada model barangKeluar
                        $foundMaterial = eoqtable::find($request->$inputName);
    
                        if ($foundMaterial) {
                            $data[] = $foundMaterial; // Menambahkan model yang cocok ke dalam array $data
                        }
                    }
                }
                $pdf = Pdf::loadView('stuffoutf.pdf', [
                    "foods" => $foods,
                    "eoqtables" => $data
                ])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Barang_Keluar.pdf');
            }else{
                $eoqtables = eoqtable::query();
                if($request->search){
                    $querytambahans=food::where('peruntukan','like','%'.request('search').'%')
                                        ->orWhere('namaMaterial','like','%'.request('search').'%')
                                        ->orWhere('satuan','like','%'.request('search').'%')->get();
                                        
                    $eoqtables->where('kodeMaterial','like','%'.request('search').'%')
                                                ->orWhere('jumlah','like','%'.request('search').'%')
                                                ->orWhere('kondisi','like','%'.request('search').'%')
                                                ->orWhere('keterangan','like','%'.request('search').'%')
                                                ->orWhere('keperluan','like','%'.request('search').'%')
                                                ->orWhere('keterangan','like','%'.request('search').'%')
                                                ->orWhere('peminjam','like','%'.request('search').'%')
                                                ->orWhere('divisi','like','%'.request('search').'%')
                                                ->orWhere('tanggalKeluar','like','%'.request('search').'%');
                    
                    foreach($querytambahans as $querytambahan){
                        $querybantuan= (string)$querytambahan->kodeMaterial;
                        $eoqtables->orWhere('kodeMaterial','like','%'.$querybantuan.'%');
                    }
                }
                $foods = $foods->toArray();
                $eoqtables = $eoqtables->get()->toArray();
                $pdf = Pdf::loadView('EOQMethod.EOQMethodPrint', [
                    "foods" => $foods,
                    "eoqtables" => $eoqtables
                ])->setPaper('f4', 'landscape');
                return $pdf->download('EOQMethod.pdf');
            } 
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeoqtableRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(eoqtable $eoqtable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(eoqtable $eoqtable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeoqtableRequest $request, eoqtable $eoqtable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(eoqtable $eoqtable)
    {
        //
    }
}
