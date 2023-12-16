<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Http\Requests\StorememberRequest;
use App\Http\Requests\UpdatememberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = member::query();
        if(request('search')){                                     
            $members->where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')
                                        ->orWhere('noTelp','like','%'.request('search').'%')
                                        ->orWhere('alamat','like','%'.request('search').'%')
                                        ->orWhere('status','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%');
        }
        return view('members/member',[
            "title"=>"Daftar Member",
            "members" => $members->paginate(15),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members/memberIn',["title"=>"Tambah Data Member"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorememberRequest $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);
        if ($request->status) {
            $validatedData['status']="ACTIVE";
        } else {
            $validatedData['status']="PASSIVE";
        }
        
        
        member::create($validatedData);
        return redirect('/members')->with('success','Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(member $member)
    {
        return view('members/memberEdit',[
            "title"=>"Daftar Member",
            "member" => $member,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatememberRequest $request, member $member)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);
        if ($request->status) {
            $validatedData['status']="ACTIVE";
        } else {
            $validatedData['status']="PASSIVE";
        }
        
        
        member::where('id',$member->id)
                ->update($validatedData);
        return redirect('/members')->with('success','Data Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(member $member)
    {
        //
    }

    public function printdelete(Request $request)
    {
        if($request->delete){
            member::destroy($request->delete);
            return redirect('/members')->with('success','Data Dihapus');
        }
    }
}
