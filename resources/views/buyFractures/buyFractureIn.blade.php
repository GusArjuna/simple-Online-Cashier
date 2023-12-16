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
                <form action="buyFracture/datain" method="post">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control mb-3" id="floatingName" placeholder="Kode Kelompok Makanan" name="kode" value="{{ old('kode') }}" onkeyup="this.value = this.value.toUpperCase()" required autofocus>
                                <label for="floatingName">Kode</label>
                                @error('kode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control mb-3" id="floatingEmail" placeholder="Nama Kelompok Makanan" name="nama" value="{{ old('nama') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="floatingEmail">Nama</label>
                                @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control mb-3" id="floatingPassword" placeholder="Keterangan" name="keterangan" value="{{ old('keterangan') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                                <label for="floatingPassword">Keterangan</label>
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
    <button id="addItemBtn">Tambah</button>
    document.getElementById('addItemBtn').addEventListener('click', function () {
        var foodCategories = @json($foodCategories);
        const container = document.getElementById('itemsContainer');
        const newItem = document.createElement('div');
        newItem.classList.add('item');

        const selectLabel = document.createElement('label');
        selectLabel.setAttribute('for', 'item');
        selectLabel.textContent = 'Pilih Makanan:';
        newItem.appendChild(selectLabel);

        const select = document.createElement('select');
        select.classList.add('item-select');
        select.setAttribute('name', 'items[]');
        select.setAttribute('multiple', 'multiple');
        const option = document.createElement('option');
        option.value = 'nilai-baru';
        option.textContent = 'Nilai Baru';
        select.appendChild(option);

        newItem.appendChild(select);

        const quantityLabel = document.createElement('label');
        quantityLabel.setAttribute('for', 'quantity');
        quantityLabel.textContent = 'Jumlah:';
        newItem.appendChild(quantityLabel);

        const quantityInput = document.createElement('input');
        quantityInput.setAttribute('type', 'number');
        quantityInput.classList.add('item-quantity');
        quantityInput.setAttribute('name', 'quantity[]');
        quantityInput.setAttribute('min', '1');
        quantityInput.setAttribute('value', '1');
        newItem.appendChild(quantityInput);

        container.appendChild(newItem);
    });
</script>
@endsection