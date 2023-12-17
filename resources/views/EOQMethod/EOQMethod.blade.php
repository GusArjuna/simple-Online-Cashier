@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>EOQ Method</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">EOQ</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('search')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/eoq">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2" name="search" value="{{ request('search') }}">
        <div class="input-group-append">
            <button class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</form>    
@endsection
@section('bagan')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <form action="/eoq/updates" method="post">
                <div class="input-group mb-3">
                    <label class="input-group-text rounded-left" style="border-radius: 0" for="inputGroupSelect01">Tahun</label>
                    <select class="form-select" name="tahun">
                        <option value="">Choose Year</option>
                        @php
                            $start_year = date("Y") - 100; // Tahun mulai
                            $end_year = date("Y") + 100; // Tahun akhir
                            $tahun = $eoqTables->first()->tahun??'';
                        @endphp
                        @for ($i = $end_year; $i >= $start_year; $i--)
                            @if ($i==$tahun)
                                <option value={{ $i }} selected>{{ $i }}</option>
                            @else
                                <option value={{ $i }}>{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                  </div>
                  <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-undo fa-sm text-white-50"></i>Hitung EOQ</a>
                </button>
            </form>
            <form action="/eoq/print" method="post">
            @csrf
            <button type="submit" value="true" name="generate" class="btn btn-primary">
                <i class="bi bi-printer-fill"></i>  Generate Report
            </button>
            <input type="hidden" name="search" value="{{ request('search') }}">
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail EOQ Makanan</h6>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            {{ $eoqTables->links() }}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode - Nama Makanan</th>
                            <th>qty</th>
                            <th>Safety Stock</th>
                            <th>Life Time</th>
                            <th>Biaya Penyimpanan</th>
                            <th>Repeat Order</th>
                            <th>Economic Order Quantity</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode - Nama Makanan</th>
                            <th>qty</th>
                            <th>Safety Stock</th>
                            <th>Life Time</th>
                            <th>Biaya Penyimpanan</th>
                            <th>Repeat Order</th>
                            <th>Economic Order Quantity</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($eoqTables as $eoqTable)
                        <tr>
                            <td> <input type="checkbox" name="print{{ $eoqTable->id }}" id="print{{ $eoqTable->id }}" value="{{ $eoqTable->id }}"> </td>
                            <td> {{ $loop->iteration }} </td>
                            @foreach ($foods as $food)
                                @if ($food->kode == $eoqTable->kodeMakanan)
                                    <td>{{ $food->kode.' - '.$food->nama }}</td>
                                    <td>{{ $food->qty}}</td>
                                    <td>{{ $food->safetyStock}}</td>
                                    <td>{{ $food->lifeTime}}</td>
                                @endif
                                @break
                            @endforeach 
                            <td> {{ $eoqTable->biayaPenyimpanan }} </td>
                            <td> {{ $eoqTable->rop}}</td>
                            <td> {{ $eoqTable->eoq}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
@endsection