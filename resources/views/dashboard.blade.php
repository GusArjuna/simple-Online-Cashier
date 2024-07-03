@extends('template.navbar')
@section('pagetitle')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->   
@endsection
@section('bagan')
    <!-- Sales Card -->
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Foods</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-cart"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $foodCount }}</h6>
              </div>
            </div>
          </div>

        </div>
      </div><!-- End Sales Card -->

      <!-- Revenue Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">
          <div class="card-body">
            <h5 class="card-title">Suppliers</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-person-lines-fill"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $supplierCount }}</h6>
              </div>
            </div>
          </div>

        </div>
      </div><!-- End Revenue Card -->

      <!-- Customers Card -->
      <div class="col-xxl-4 col-xl-12">

        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Members</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $memberCount }}</h6>
              </div>
            </div>

          </div>
        </div>

      </div><!-- End Customers Card -->

      <!-- Reports -->
      <div class="col-12">
        <div class="card">

          <div class="card-body">
            <h5 class="card-title">Reports</h5>

            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">
  
                  {{ $foods->links() }}
                  <div class="card-body pb-0">
                    <h5 class="card-title">Top Selling</h5>
                    
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Product</th>
                          <th scope="col">Price</th>
                          <th scope="col">Sold</th>
                          <th scope="col">Revenue</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($foods as $foods)
                        <tr>
                            <td> {{ $foods->kode.' - '. $foods->nama}} </td>
                            <td> {{ $foods->hargaJual }} </td>
                            <td> {{ $foods->penjualan}} </td>
                            @php
                                $revenue = $foods->penjualan*$foods->hargaJual;
                            @endphp
                            <td> {{ $revenue}}</td>
                        </tr>
                        @endforeach
                        <tr>
                        </tr>
                      </tbody>
                    </table>
                    
  
                  </div>
  
                </div>
              </div><!-- End Top Selling -->

          </div>

        </div>
      </div><!-- End Reports -->
@endsection