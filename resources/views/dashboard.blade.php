@extends('layout.adminlte')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- INFO BOX --}}
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $jumlahSiswa }}</h3>
                                <p>Jumlah Siswa</p>
                            </div>
                            <div class="icon">
                              <i class="material-symbols-outlined">wc</i>
                            </div>
                            <a href="{{ route('data') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $jumlahSiswaLaki }}</h3>
                                <p>Jumlah Siswa Laki-laki</p>
                            </div>
                            <div class="icon">
                              <i class="material-symbols-outlined">man</i>
                            </div>
                            <a href="{{ route('data') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $jumlahSiswaPerempuan }}</h3>
                                <p>Jumlah Siswa Perempuan</p>
                            </div>
                            <div class="icon">
                              <i class="material-symbols-outlined">woman</i>
                            </div>
                            <a href="{{ route('data') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $jumlahKota }}</h3>
                                <p>Jumlah Kota</p>
                            </div>
                            <div class="icon">
                              <i class="material-symbols-outlined">apartment</i>
                            </div>
                            <a href="{{ route('kota') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                  <div class="col-4">
                      {{-- PIE CHART KOTA --}}
                      <div class="card card-danger w-auto">
                          <div class="card-header">
                              <h3 class="card-title">Siswa Berdasarkan Kota</h3>
                          </div>
                          <div class="card-body">
                              <canvas id="pieChart"
                                  style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                          </div>
                      </div>
                      {{-- PIE CHART JENIS KELAMIN --}}
                      <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Jenis Kelamin</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                    </div>
                    {{-- BAR CHART TAHUN LAHIR --}}
                    <div class="card card-danger col-8 p-0">
                      <div class="card-header">
                          <h3 class="card-title">Jenis Kelamin</h3>
                      </div>
                      <div class="card-body">
                        <canvas id="barChart"></canvas>
                      </div>
                    </div>
                    
              </div>
            </div>
    </div><!-- /.container-fluid -->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let ctx = document.getElementById('pieChart').getContext('2d');
        let ctx2 = document.getElementById('pieChart2').getContext('2d');

        // mengambil variabel $dataChart dari PHP lalu mengubah ke format JSON dan menghasilkan array dari objek, dimana setiap objek memiliki properti kota dan total
        let dataChart = {!! json_encode($dataChart) !!};
        // membuat array baru dari dataChart. fungsi panah mengambil objek tersebut (e) dan mengembalikan sting yang menggabungkan e.kota dan e.total dalam format "kota (total)" ex: "Jakarta (10)"
        let labels = dataChart.map(e => `${e.kota} (${e.total})`);
        let cityChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: {!! json_encode(array_column($dataChart, 'total')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
        });

        let genderChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $jumlahSiswaLaki }}, {{ $jumlahSiswaPerempuan }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
        });

        var ctx3 = document.getElementById('barChart').getContext('2d');
        var yearChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: {{ json_encode($labelsYear) }},
                datasets: [{
                    label: 'Jumlah Anak',
                    data: {{ json_encode($dataTotalYear) }},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!-- /.content -->
    </div>
@endsection
