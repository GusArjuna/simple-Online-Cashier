@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Fraktur Beli</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Laporan</li>
        <li class="breadcrumb-item active">Fraktur Beli</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('search')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/buyFractures">
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
        <a href="{{ url('/buyFracture/datain') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="bi bi-plus"></i> Tambah Fraktur Beli</a>
            <form action="/buyFracture/printdel" method="post">
                @csrf
                {{-- <button type="submit" value="true" name="generate" class="btn btn-primary">
                    <i class="bi bi-printer-fill"></i>  Generate Report
                </button> --}}
                <input type="hidden" name="search" value="{{ request('search') }}">
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Fraktur Beli</h6>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            <div class="mt-3">
    
                {{ $buyFracturenumbers->links() }}
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{-- <th></th> --}}
                            <th>No</th>
                            <th>Nomor Fracture</th>
                            <th>Kode - Nama Supplier</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            {{-- <th></th> --}}
                            <th>No</th>
                            <th>Nomor Fracture</th>
                            <th>Kode - Nama Supplier</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($buyFracturenumbers as $buyFracturenumber)
                        <tr>
                            {{-- <td> <input type="checkbox" name="print{{ $buyFracturenumber->id }}" id="print{{ $buyFracturenumber->id }}" value="{{ $buyFracturenumber->id }}"> </td> --}}
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $buyFracturenumber->kode }} </td>
                            <td>  @foreach ($suppliers as $supplier)
                                @if ($supplier->kode == $buyFracturenumber->kodeSupplier)
                                    {{ $supplier->kode.' - '.$supplier->nama}}
                                    @break
                                @endif
                                @endforeach
                            </td>
                            <td> {{ $buyFracturenumber->total }} </td>
                            <td> {{ $buyFracturenumber->tanggal}} </td>
                            <td> <a href="/buyFracture/{{ $buyFracturenumber->id }}/show" class="btn btn-info btn-sm">
                                <i class="bi bi-info-lg"></i>
                                </a> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
@endsection