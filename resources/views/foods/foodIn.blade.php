@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Food</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Add</li>
        <li class="breadcrumb-item active">Food</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Makanan</h6>
        </div>
        <div class="card-body">
            <form action="/food/datain" method="post">
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
                            <select class="form-control @error('foodCategory') is-invalid @enderror" aria-label=".form-select-sm example" name="foodCategory" id="foodCategory">
                                <option value="">- Pilih Salah Satu -</option>
                                @foreach ($foodCategories as $foodCategory)
                                <option {{ (old('foodCategory')==$foodCategory->kode)?"selected":"" }} value="{{ $foodCategory->kode }}">{{ $foodCategory->kode }} - {{ $foodCategory->nama }}</option>
                                @endforeach
                            </select>
                            <label for="foodCategory">Kategori Makanan</label>
                            @error('keterangan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control mb-3" id="qty" placeholder="" name="qty" value="{{ old('qty') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="qty">Qty</label>
                            @error('qty')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control mb-3" id="safetyStock" placeholder="" name="safetyStock" value="{{ old('safetyStock') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="safetyStock">Safety Stock</label>
                            @error('safetyStock')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control mb-3" id="hargaJual" placeholder="" name="hargaJual" value="{{ old('hargaJual') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="hargaJual">Harga Jual</label>
                            @error('hargaJual')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control mb-3" id="hargaBeli" placeholder="" name="hargaBeli" value="{{ old('hargaBeli') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="hargaBeli">Harga Beli</label>
                            @error('hargaBeli')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control mb-3" id="kebutuhan" placeholder="" name="kebutuhan" value="{{ old('kebutuhan') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="kebutuhan">Kebutuhan</label>
                            @error('kebutuhan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control mb-3" id="biayaPemesanan" placeholder="" name="biayaPemesanan" value="{{ old('biayaPemesanan') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="biayaPemesanan">Biaya Pemesanan</label>
                            @error('biayaPemesanan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control mb-3" id="waktu" placeholder="" name="waktu" value="{{ old('waktu') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="waktu">Waktu</label>
                            @error('waktu')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
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
@endsection