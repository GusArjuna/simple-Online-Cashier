@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Faktur Beli</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Pembelian</li>
        <li class="breadcrumb-item active">Fraktur Beli</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h6 class="m-0 font-weight-bold text-primary">Pembuatan Faktur Beli</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="/buyFracture/datain" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input readonly type="text" class="form-control mb-3"  placeholder="" name="nomorRegis" value="{{ $nomorRegis }}">
                                <label for="">Facture Number</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control @error('supplier') is-invalid @enderror" aria-label=".form-select-sm example" name="supplier" id="supplier">
                                    <option value="">- Pilih Salah Satu -</option>
                                    @foreach ($suppliers as $supplier)
                                    <option {{ (old('supplier')==$supplier->kode)?"selected":"" }} value="{{ $supplier->kode }}">{{ $supplier->kode }} - {{ $supplier->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="supplier">Nama Supplier</label>
                                @error('keterangan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                          <div id="inputdata">

                          </div>
                          <div class="col-md-3">
                              <button type="button" id="addBtn" class="btn btn-primary rounded-pill">
                                <i class="bi bi-plus-circle-dotted"> Tambah Makanan</i>
                              </button>
                          </div>
                          <div class="col-md-9">
                          </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input readonly type="text" class="form-control mb-3 totalKeseluruhan" name="totalKeseluruhan">
                                <label for="tanggal">Total Keseluruhan</label>
                            </div>
                        </div>
                          <div class="col-md-2">
                            <div class="form-floating">
                                <input type="date" class="form-control mb-3" id="tanggal" placeholder="" name="tanggal" value="{{ old('tanggal') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="tanggal">Tanggal</label>
                                @error('tanggal')
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
    $('#addBtn').click(function (){
        let newInputan = `<div class="row g-3">
                            <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control @error('food') is-invalid @enderror makanan" aria-label=".form-select-sm example" name="food[]" >
                                    <option value="">- Pilih Salah Satu -</option>
                                    @foreach ($foods as $food)
                                    <option {{ (old('food')==$food->kode)?"selected":"" }} harga="{{ $food->hargaBeli }}" value="{{ $food->kode }}">{{ $food->kode }} - {{ $food->nama }}</option>
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
                                <input type="number" min=1 class="form-control mb-3 qty"  placeholder="" name="qty[]" value="{{ old('qty') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label>Qty</label>
                                @error('qty')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating">
                                <input readonly type="number" class="form-control mb-3 harga"  placeholder="" name="harga[]" value="{{ old('harga') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label>Harga</label>
                                @error('harga')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating">
                                <input readonly type="number" class="form-control mb-3 total"  placeholder="" name="total[]" value="{{ old('total') }}" onkeyup="this.value = this.value.toUpperCase()" required>
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
        $(this).parent().parent().parent().remove();
      });

    
    $(document).ready(function() {
        $(document).on('keyup', '.qty', function() {
          var qtyValue = $(this).val();
          var hargaValue = $(this).closest('.row').find('.makanan option:selected').attr('harga');
          var totalHarga = qtyValue * hargaValue;
          $(this).closest('.row').find('.harga').val(hargaValue);
          $(this).closest('.row').find('.total').val(totalHarga);
          hitungTotalKeseluruhan();
        });
    });
    function hitungTotalKeseluruhan() {
    var totalKeseluruhan = 0;

    $('.harga').each(function() {
        var harga = $(this).closest('.row').find('.total').val();
        if (!isNaN(harga)) {
            totalKeseluruhan += parseInt(harga, 10);
        }
    });
    $('.totalKeseluruhan').val(totalKeseluruhan);
  }
</script>
@endsection