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

        <div class="card-body">
          <h5 class="card-title">Reports <span>/Today</span></h5>

          <!-- Line Chart -->
          <div id="reportsChart"></div>

          <script>
              var groupedData = @json($groupedData);
              var monthlyDates = @json($monthlyDates);
              var colors = @json($colors);

            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#reportsChart"), {
                series: groupedData.map(item => ({
                    name: item.name,
                    data: item.data
                })),
                chart: {
                  height: 350,
                  type: 'area',
                  toolbar: {
                    show: false
                  },
                },
                markers: {
                  size: 4
                },
                colors: colors,
                fill: {
                  type: "gradient",
                  gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                  }
                },
                dataLabels: {
                  enabled: false
                },
                stroke: {
                  curve: 'smooth',
                  width: 2
                },
                xaxis: {
                  type: 'date',
                  categories: monthlyDates
                },
                tooltip: {
                  x: {
                    format: 'dd/MM/yy'
                  },
                }
              }).render();
            });
          </script>
          <!-- End Line Chart -->

        </div>

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
                          <th scope="col">Purchase Price</th>
                          <th scope="col">Selling Price</th>
                          <th scope="col">Purchase Amount</th>
                          <th scope="col">Quantity Sold</th>
                          <th scope="col">Total Purchases</th>
                          <th scope="col">Income</th>
                          <th scope="col">Profit</th>
                          <th scope="col">Stats</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($foods as $foods)
                        <tr>
                            <td> {{ $foods->kode.' - '. $foods->nama}} </td>
                            <td> {{ $foods->hargaBeli }} </td>
                            <td> {{ $foods->hargaJual }} </td>
                            <td> {{ $foods->pembelian}} </td>
                            <td> {{ $foods->penjualan}} </td>
                            @php
                                $totalJual = $foods->penjualan*$foods->hargaJual;
                                $totalBeli = $foods->pembelian*$foods->hargaBeli;
                                $stats = $totalJual-$totalBeli;
                            @endphp
                            <td> {{ $totalBeli}}</td>
                            <td> {{ $totalJual}}</td>
                            <td> {{ $stats}}</td>
                            <td>{!! $stats <= 0 ? '<span class="badge bg-danger">Non Profit</span>' : '<span class="badge bg-success">Profit</span>' !!}</td>
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