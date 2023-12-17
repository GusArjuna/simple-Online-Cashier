@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Tambah</li>
        <li class="breadcrumb-item active">Fraktur Beli</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Fracture Beli</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="/buyFracture/datain" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control @error('member') is-invalid @enderror" aria-label=".form-select-sm example" name="member" id="member">
                                    <option value="">- Pilih Salah Satu -</option>
                                    @foreach ($members as $member)
                                    <option {{ (old('member')==$member->kode)?"selected":"" }} value="{{ $member->kode }}">{{ $member->kode }} - {{ $member->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="member">Nama Member</label>
                                @error('keterangan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div id="inputdata">

                          </div>
                          {{-- <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control @error('food') is-invalid @enderror" aria-label=".form-select-sm example" name="food" id="food">
                                    <option value="">- Pilih Salah Satu -</option>
                                    @foreach ($foods as $food)
                                    <option {{ (old('food')==$food->kode)?"selected":"" }} value="{{ $food->kode }}">{{ $food->kode }} - {{ $food->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="food">Nama Makanan</label>
                                @error('keterangan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" class="form-control mb-3" id="qty" placeholder="" name="qty" value="{{ old('qty') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="qty">Qty</label>
                                @error('qty')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" class="form-control mb-3" id="harga" placeholder="" name="harga" value="{{ old('harga') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="harga">Harga</label>
                                @error('harga')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-floating">
                                <input disabled type="number" class="form-control mb-3" id="total" placeholder="" name="total" value="{{ old('total') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="total">Total</label>
                                @error('total')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div class="mt-2">
                                <button type="button" id="removeBtn" class="btn btn-warning" ><i class="bi bi-patch-minus-fill"></i></button>
                            </div>
                          </div> --}}
                          <div class="col-md-3">
                              <button type="button" id="addBtn" class="btn btn-primary rounded-pill">
                                <i class="bi bi-plus-circle-dotted"> Tambah Makanan</i>
                              </button>
                          </div>
                          <div class="col-md-9">
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control mb-3" id="tanggal" placeholder="" name="tanggal" value="{{ old('tanggal') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="tanggal">Tanggal</label>
                                @error('tanggal')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
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
@section('javas')
<script>
    let counter = 1;
    $('#addBtn').click(function (){
        counter++;
        let newInputan = `<div class="row g-3">
                            <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control @error('food') is-invalid @enderror" aria-label=".form-select-sm example" name="food[]" >
                                    <option value="">- Pilih Salah Satu -</option>
                                    @foreach ($foods as $food)
                                    <option {{ (old('food')==$food->kode)?"selected":"" }} value="{{ $food->kode }}">{{ $food->kode }} - {{ $food->nama }}</option>
                                    @endforeach
                                </select>
                                <label>Nama Makanan</label>
                                @error('keterangan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-floating">
                                <input type="number" class="form-control mb-3"  placeholder="" name="qty[]" value="{{ old('qty') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label>Qty</label>
                                @error('qty')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating">
                                <input disabled type="number" class="form-control mb-3"  placeholder="" name="harga[]" value="{{ old('harga') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label>Harga</label>
                                @error('harga')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating">
                                <input disabled type="number" class="form-control mb-3"  placeholder="" name="total[]" value="{{ old('total') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label>Total</label>
                                @error('total')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div class="mt-2">
                                <button type="button" class="btn btn-outline-danger removeBtn" ><i class="bi bi-dash-lg"></i></button>
                            </div>
                          </div>
                        </div>`
    $('#inputdata').append(newInputan);
    });

    $(document).on('click', '.removeBtn', function() {
    // $('.removeBtn').click(function (){
        // console.log($(this).parent().parent().parent());
        $(this).parent().parent().parent().remove();
      });
</script>
@endsection