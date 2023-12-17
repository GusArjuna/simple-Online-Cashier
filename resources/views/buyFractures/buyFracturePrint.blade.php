@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Dashboard</h1>
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
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="card">
    <div class="card-header p-4">
    <a class="pt-2 d-inline-block" href="index.html" data-abc="true">BBBootstrap.com</a>
    <div class="float-right"> <h3 class="mb-0">Invoice #BBB10234</h3>
    Date: 12 Jun,2019</div>
    </div>
    <div class="card-body">
    <div class="row mb-4">
    <div class="col-sm-6">
    <h5 class="mb-3">From:</h5>
    <h3 class="text-dark mb-1">Tejinder Singh</h3>
    <div>29, Singla Street</div>
    <div>Sikeston,New Delhi 110034</div>
    <div>Email: contact@bbbootstrap.com</div>
    <div>Phone: +91 9897 989 989</div>
    </div>
    <div class="col-sm-6 ">
    <h5 class="mb-3">To:</h5>
    <h3 class="text-dark mb-1">Akshay Singh</h3>
    <div>478, Nai Sadak</div>
    <div>Chandni chowk, New delhi, 110006</div>
    <div>Email: info@tikon.com</div>
    <div>Phone: +91 9895 398 009</div>
    </div>
    </div>
    <div class="table-responsive-sm">
    <table class="table table-striped">
    <thead>
    <tr>
    <th class="center">#</th>
    <th>Item</th>
    <th>Description</th>
    <th class="right">Price</th>
    <th class="center">Qty</th>
    <th class="right">Total</th>
    </tr>
    </thead>
    <tbody>
        @for ($i = 1; $i < 10; $i++)
            @if ($i%2==1)
            <tr class="table table-primary">
                <td class="center">4</td>
                <td class="left">Google Pixel</td>
                <td class="left">Google prime with Amazon prime membership</td>
                <td class="right">$500</td>
                <td class="center">10</td>
                <td class="right">$5000</td> 
            </tr>
            @else
            <tr>
                <td class="center">4</td>
                <td class="left">Google Pixel</td>
                <td class="left">Google prime with Amazon prime membership</td>
                <td class="right">$500</td>
                <td class="center">10</td>
                <td class="right">$5000</td> 
            </tr>
            @endif
        @endfor
    </tbody>
    </table>
    </div>
    <div class="row">
    <div class="col-lg-4 col-sm-5">
    </div>
    <div class="col-lg-4 col-sm-5 ml-auto">
    <table class="table table-clear">
    <tbody>
    <tr>
    <td class="left">
    <strong class="text-dark">Subtotal</strong>
    </td>
    <td class="right">$28,809,00</td>
    </tr>
    <tr>
    <td class="left">
    <strong class="text-dark">Discount (20%)</strong>
    </td>
    <td class="right">$5,761,00</td>
    </tr>
    <tr>
    <td class="left">
    <strong class="text-dark">VAT (10%)</strong>
    </td>
    <td class="right">$2,304,00</td>
    </tr>
    <tr>
    <td class="left">
    <strong class="text-dark">Total</strong>
     </td>
    <td class="right">
    <strong class="text-dark">$20,744,00</strong>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <div class="card-footer bg-white">
    <p class="mb-0">BBBootstrap.com, Sounth Block, New delhi, 110034</p>
    </div>
    </div>
    </div>
@endsection