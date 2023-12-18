@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Add</li>
        <li class="breadcrumb-item active">Supplier</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Supplier</h6>
        </div>
        <div class="card-body">
            <form action="/supplier/datain" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="kode" placeholder="" name="kode" value="{{ old('kode') }}" onkeyup="this.value = this.value.toUpperCase()" required autofocus>
                            <label for="kode">Kode</label>
                            @error('kode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="nama" placeholder="" name="nama" value="{{ old('nama') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="nama">Nama</label>
                            @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" min=1 class="form-control mb-3" id="noTelp" placeholder="" name="noTelp" value="{{ old('noTelp') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="noTelp">No. Telp</label>
                            @error('noTelp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="alamat" placeholder="" name="alamat" value="{{ old('alamat') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="keterangan" placeholder="" name="keterangan" value="{{ old('keterangan') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="keterangan">Keterangan</label>
                            @error('keterangan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mb-3">Submit</button>
                        <button type="reset" class="btn btn-secondary mb-3">Reset</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection