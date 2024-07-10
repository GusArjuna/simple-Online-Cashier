@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('search')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/">
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
        <form action="/updatefsn" method="post">
            @csrf
        </form>
            <form action="/printdashboard" method="post">
                @csrf
                <button type="submit" value="true" name="generate" class="btn btn-primary">
                   <i class="bi bi-printer-fill"></i> Generate Report
                </button>
                <input type="hidden" name="search" value="{{ request('search') }}">
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Perusahaan</h6>
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
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kelompok</th>
                            <th>Qty</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kelompok</th>
                            <th>Qty</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        {{-- @foreach ($fsns as $fsn)
                        <tr>
                            <td> <input type="checkbox" name="print{{ $fsn->id }}" id="print{{ $fsn->id }}" value="{{ $fsn->id }}"> </td>
                            <td> {{ $loop->iteration }} </td>
                            <td> 
                                @foreach ($kodematerials as $kodematerial)
                                    @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                        {{ $kodematerial->kodeMaterial }}
                                        @break
                                    @endif
                                @endforeach
                             </td>
                            <td> @foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                    {{ $kodematerial->namaMaterial }}
                                    @break
                                @endif
                            @endforeach </td>
                            <td> {{ $fsn->lokasi}} </td>
                            <td> @foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                    {{ $kodematerial->satuan }}
                                    @break
                                @endif
                            @endforeach </td>
                            <td> @foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                    {{ $kodematerial->peruntukan }}
                                    @break
                                @endif
                            @endforeach </td>
                            <td> {{ $fsn->tor}} </td>
                            <td> {{ $fsn->kategori}} </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
@endsection