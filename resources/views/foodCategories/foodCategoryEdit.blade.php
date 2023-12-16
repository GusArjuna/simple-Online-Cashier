@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Food Category</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Edit</li>
        <li class="breadcrumb-item active">Food Category</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Kategori Makanan</h6>
        </div>
        <div class="card-body">
                <form action="/foodCategory/{{ $foodCategory->id }}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control mb-3" id="kode" placeholder="Kode Kelompok Makanan" name="kode" value="{{ old('kode',$foodCategory->kode) }}" onkeyup="this.value = this.value.toUpperCase()" required autofocus>
                                <label for="kode">Kode</label>
                                @error('kode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control mb-3" id="nama" placeholder="Nama Kelompok Makanan" name="nama" value="{{ old('nama',$foodCategory->nama) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="nama">Nama</label>
                                @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control mb-3" id="keterangan" placeholder="Keterangan" name="keterangan" value="{{ old('keterangan',$foodCategory->keterangan) }}" onkeyup="this.value = this.value.toUpperCase()"  required>
                                <label for="keterangan">Keterangan</label>
                                @error('keterangan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-success mb-3">Update</button>
                            <button type="reset" class="btn btn-secondary mb-3">Reset</button>
                          </div>
                    </div>
                </form>
        </div>
    </div>
@endsection