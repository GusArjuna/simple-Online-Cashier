@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Fraktur Jual</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Laporan</li>
        <li class="breadcrumb-item active">Fraktur Jual</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('search')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/sellFractures">
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
        <a href="{{ url('/sellFracture/datain') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="bi bi-plus"></i> Tambah Fraktur Jual</a>
            <form action="/sellFracture/printdel" method="post">
                @csrf
                <button type="submit" value="true" name="generate" class="btn btn-primary">
                    <i class="bi bi-printer-fill"></i>  Generate Report
                </button>
                <input type="hidden" name="search" value="{{ request('search') }}">
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Fraktur Jual</h6>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            {{-- {{ $fsns->links() }} --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode - Nama Makanan</th>
                            <th>Kode - Nama Member</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode - Nama Makanan</th>
                            <th>Kode - Nama Member</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($sellFractures as $sellFracture)
                        <tr>
                            <td> <input type="checkbox" name="print{{ $sellFracture->id }}" id="print{{ $sellFracture->id }}" value="{{ $sellFracture->id }}"> </td>
                            <td> {{ $loop->iteration }} </td>
                            <td>  @foreach ($foods as $food)
                                @if ($food->kode == $sellFracture->kodeMakanan)
                                    {{ $food->kode - $food->nama}}
                                    @break
                                @endif
                                @endforeach
                            </td>
                            <td>  @foreach ($members as $member)
                                @if ($member->kode == $sellFracture->kodeSupplier)
                                    {{ $member->kode - $member->nama}}
                                    @break
                                @endif
                                @endforeach
                            </td>
                            <td> {{ $sellFracture->qty }} </td>
                            <td> {{ $sellFracture->harga}} </td>
                            <td> {{ $sellFracture->total }} </td>
                            <td> {{ $sellFracture->tanggal }} </td>
                            <td> <a href="/sellFracture/{{ $sellFracture->id }}/editdata" class="btn btn-warning btn-circle">
                                <i class="bi bi-pencil-fill"></i>
                                </a>
                                <button type="submit" value="{{ $sellFracture->id }}" name="delete" class="btn btn-danger btn-circle" onclick="return confirm('Yakin?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
@endsection