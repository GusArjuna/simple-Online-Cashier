@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Show Detail</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Show</li>
        <li class="breadcrumb-item active">Fraktur Jual</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
<form action="/buyFracture/printdel" method="post">
    @csrf
    <button type="submit" value="true" name="generate" class="btn btn-primary">
        <i class="bi bi-printer-fill"></i>  Generate Report
    </button>
</form>
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="card">
        <div class="card-header p-4">
            <div class="float-right"> 
                <h3 class="mb-0">Invoice {{ $nomorRegis->kode }}</h3>
                Date: {{ $nomorRegis->tanggal }}
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h5 class="mb-3">From:</h5>
                    <h3 class="text-dark mb-1">Toko Hikmah</h3>
                    <div>Jalan Jaya</div>
                    <div>Email: ajiWibowo@gmail.com</div>
                    <div>Phone: +87878787</div>
                </div>
                <div class="col-sm-6 ">
                    <h5 class="mb-3">To:</h5>
                    <h3 class="text-dark mb-1">{{ $member->nama }}</h3>
                    <div>{{ $member->alamat }}</div>
                    <div>{{ $member->noTelp }}</div>
                </div>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Item</th>
                            <th class="right">Price</th>
                            <th class="center">Qty</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellFractures as $sellFracture)    
                            @if ($loop->iteration%2==1)
                            <tr class="table table-primary">
                                <td class="center">{{ $loop->iteration }}</td>
                                <td class="left">
                                    @foreach ($foods as $food)
                                    @if ($food->kode == $sellFracture->kodeMakanan)
                                        {{ $food->kode.' - '.$food->nama}}
                                        @break
                                    @endif
                                    @endforeach    
                                </td>
                                <td class="right">{{ $sellFracture->harga }}</td>
                                <td class="center">{{ $sellFracture->qty }}</td>
                                <td class="right">{{ $sellFracture->total }}</td> 
                            </tr>
                            @else
                            <tr>
                                <td class="center">{{ $loop->iteration }}</td>
                                <td class="left">
                                    @foreach ($foods as $food)
                                    @if ($food->kode == $sellFracture->kodeMakanan)
                                        {{ $food->kode.' - '.$food->nama}}
                                        @break
                                    @endif
                                    @endforeach
                                </td>
                                <td class="right">{{ $sellFracture->harga }}</td>
                                <td class="center">{{ $sellFracture->qty }}</td>
                                <td class="right">{{ $sellFracture->total }}</td>  
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                                <td class="left">
                                    <strong class="text-dark">Total</strong>
                                </td>
                                <td class="right">
                                    <strong class="text-dark">{{ $nomorRegis->total }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <p class="mb-0">&copy; Copyright <strong><span>Aji Wibowo</span></strong>. All Rights Reserved 2023</p>
        </div>
    </div>
</div>
@endsection