@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Food</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Edit</li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
        </div>
        <div class="card-body">
            <form action="/food/{{ $food->id }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="kode" placeholder="" name="kode" value="{{ old('kode',$food->kode) }}" onkeyup="this.value = this.value.toUpperCase()" required autofocus>
                            <label for="kode">Kode</label>
                            @error('kode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="nama" placeholder="" name="nama" value="{{ old('nama',$food->nama) }}" onkeyup="this.value = this.value.toUpperCase()" required>
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
                                <option {{ (old('foodCategory',$food->foodCategory)==$foodCategory->kode)?"selected":"" }} value="{{ $foodCategory->kode }}">{{ $foodCategory->kode }} - {{ $foodCategory->nama }}</option>
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
                            <input type="number" min=1 class="form-control mb-3" id="qty" placeholder="" name="qty" value="{{ old('qty',$food->qty) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="qty">Qty</label>
                            @error('qty')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" min=1 class="form-control mb-3" id="safetyStock" placeholder="" name="safetyStock" value="{{ old('safetyStock',$food->safetyStock) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="safetyStock">Safety Stock</label>
                            @error('safetyStock')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" min=1 class="form-control mb-3" id="hargaJual" placeholder="" name="hargaJual" value="{{ old('hargaJual',$food->hargaJual) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="hargaJual">Harga Jual</label>
                            @error('hargaJual')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" min=1 class="form-control mb-3" id="hargaBeli" placeholder="" name="hargaBeli" value="{{ old('hargaBeli',$food->hargaBeli) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="hargaBeli">Harga Beli</label>
                            @error('hargaBeli')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>  
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" min=1 class="form-control mb-3" id="biayaPemesanan" placeholder="" name="biayaPemesanan" value="{{ old('biayaPemesanan',$food->biayaPemesanan) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="biayaPemesanan">Biaya Pemesanan</label>
                            @error('biayaPemesanan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" min=1 class="form-control mb-3" id="lifeTime" placeholder="" name="lifeTime" value="{{ old('lifeTime',$food->lifeTime) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                            <label for="lifeTime">liteTime</label>
                            @error('lifeTime')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="keterangan" placeholder="" name="keterangan" value="{{ old('keterangan',$food->keterangan) }}" onkeyup="this.value = this.value.toUpperCase()" required>
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