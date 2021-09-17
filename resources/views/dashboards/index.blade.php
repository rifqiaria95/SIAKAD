@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col-md-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-info">
                    <h5 class="card-title">Total Siswa<span class="material-icons-outlined"></span></h5>
                    <p class="stats-text">{{ totalSiswa() }}</p>
                    </div>
                    <div class="stats-icon change-success">
                    <i class="material-icons">face</i>
                    </div>
                </div>
                </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-info">
                    <h5 class="card-title">Total Guru<span class="material-icons-outlined"></span></h5>
                    <p class="stats-text">{{ totalGuru() }}</p>
                    </div>
                    <div class="stats-icon change-danger">
                    <i class="material-icons">supervised_user_circle</i>
                    </div>
                </div>
                </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-info">
                    <h5 class="card-title">Total Mapel<span class="material-icons-outlined"></span></h5>
                    <p class="stats-text">{{ totalMapel() }}</p>
                    </div>
                    <div class="stats-icon change-success">
                    <i class="material-icons">library_books</i>
                    </div>
                </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card main-chart-card">
                <div class="card-body">
                    <div id="chartDashboard">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Ranking 5 Besar</h5>
                    <table id="zero-conf" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ranking = 1;
                            @endphp
                            @foreach(ranking5Besar() as $s)
                            <tr>
                                <td>{{ $ranking }}</td>
                                <td>{{ $s->nama_lengkap() }}</td>
                                <td>{{ $s->rataRataNilai}}</td>
                            </tr>
                            @php
                                $ranking++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-bg">
            <div class="card-body">
                <h5 class="card-title">Transactions</h5>
                <div class="transactions-list">
                <div class="tr-item">
                    <div class="tr-company-name">
                    <div class="tr-icon tr-card-icon tr-card-bg-primary text-white">
                        <i data-feather="thumbs-up"></i>
                    </div>
                    <div class="tr-text">
                        <h4 class="text-white">Facebook</h4>
                        <p>02 March</p>
                    </div>
                    </div>
                    <div class="tr-rate">
                    <p><span class="text-success">+$24</span></p>
                    </div>
                </div>
                </div>
                <div class="transactions-list">
                <div class="tr-item">
                    <div class="tr-company-name">
                    <div class="tr-icon tr-card-icon tr-card-bg-success text-white">
                        <i data-feather="credit-card"></i>
                    </div>
                    <div class="tr-text">
                        <h4 class="text-white">Visa</h4>
                        <p>02 March</p>
                    </div>
                    </div>
                    <div class="tr-rate">
                    <p><span class="text-success">+$300</span></p>
                    </div>
                </div>
                </div>
                <div class="transactions-list">
                <div class="tr-item">
                    <div class="tr-company-name">
                    <div class="tr-icon tr-card-icon tr-card-bg-danger text-white">
                        <i data-feather="tv"></i>
                    </div>
                    <div class="tr-text">
                        <h4 class="text-white">Netflix</h4>
                        <p>02 March</p>
                    </div>
                    </div>
                    <div class="tr-rate">
                    <p><span class="text-danger">-$17</span></p>
                    </div>
                </div>
                </div>
                <div class="transactions-list">
                <div class="tr-item">
                    <div class="tr-company-name">
                    <div class="tr-icon tr-card-icon tr-card-bg-warning text-white">
                        <i data-feather="shopping-cart"></i>
                    </div>
                    <div class="tr-text">
                        <h4 class="text-white">Themeforest</h4>
                        <p>02 March</p>
                    </div>
                    </div>
                    <div class="tr-rate">
                    <p><span class="text-danger">-$220</span></p>
                    </div>
                </div>
                </div>
                <div class="transactions-list">
                <div class="tr-item">
                    <div class="tr-company-name">
                    <div class="tr-icon tr-card-icon tr-card-bg-info text-white">
                        <i data-feather="dollar-sign"></i>
                    </div>
                    <div class="tr-text">
                        <h4 class="text-white">PayPal</h4>
                        <p>02 March</p>
                    </div>
                    </div>
                    <div class="tr-rate">
                    <p><span class="text-success">+20%</span></p>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
        <div class="card widget widget-info card-bg">
            <div class="card-body">
            <div class="widget-info-container">
                <div class="widget-info-image" style="background: url('../../template/images/premium.svg')"></div>
                <h5 class="widget-info-title text-white">Advanced Security</h5>
                <p class="widget-info-text">Lorem ipsum dolor sit amet. Nunc cursus tempor sapien, et mattis libero dapibus ut. Ut a ante sit amet arcu imperdiet</p>
                <a href="#" class="btn btn-primary widget-info-action">Try Premium for free</a>
            </div>
        </div>
        </div>
        </div>
    <div class="col-lg-4">
        <div class="card stat-widget card-bg">
        <div class="card-body">
            <h5 class="card-title">Top Authors</h5>
            <div class="transactions-list">
            <div class="tr-item">
                <div class="tr-company-name">
                <div class="tr-img tr-card-img">
                    <img src="{{ asset('template/images/avatars/profile-image.jpg') }}" alt="...">
                </div>
                <div class="tr-text">
                    <h4 class="text-white">John Doe</h4>
                    <p>23 items sold</p>
                </div>
                </div>
                <div class="tr-rate">
                <p><span>$300</span></p>
                </div>
            </div>
            </div>
            <div class="transactions-list">
            <div class="tr-item">
                <div class="tr-company-name">
                <div class="tr-img tr-card-img">
                    <img src="{{ asset('template/images/avatars/profile-image.jpg') }}" alt="...">
                </div>
                <div class="tr-text">
                    <h4 class="text-white">Ann Doe</h4>
                    <p>19 items sold</p>
                </div>
                </div>
                <div class="tr-rate">
                <p><span>$270</span></p>
                </div>
            </div>
            </div>
            <div class="transactions-list">
            <div class="tr-item">
                <div class="tr-company-name">
                <div class="tr-img tr-card-img">
                    <img src="{{ asset('template/images/avatars/profile-image.jpg') }}" alt="...">
                </div>
                <div class="tr-text">
                    <h4 class="text-white">Lisa Doe</h4>
                    <p>14 items sold</p>
                </div>
                </div>
                <div class="tr-rate">
                <p><span>$404</span></p>
                </div>
            </div>
            </div>
            <div class="transactions-list">
            <div class="tr-item">
                <div class="tr-company-name">
                <div class="tr-img tr-card-img">
                    <img src="{{ asset('template/images/avatars/profile-image.jpg') }}" alt="...">
                </div>
                <div class="tr-text">
                    <h4 class="text-white">John Doe</h4>
                    <p>10 items sold</p>
                </div>
                </div>
                <div class="tr-rate">
                <p><span>$500</span></p>
                </div>
            </div>
            </div>
            <div class="transactions-list">
            <div class="tr-item">
                <div class="tr-company-name">
                <div class="tr-img tr-card-img">
                    <img src="{{ asset('template/images/avatars/profile-image.jpg') }}" alt="...">
                </div>
                <div class="tr-text">
                    <h4 class="text-white">Ann Doe</h4>
                    <p>8 items sold</p>
                </div>
                </div>
                <div class="tr-rate">
                <p><span>$299</span></p>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
        
    </div>
    <div class="row">
    <div class="col-lg-4">
        <div class="card card-bg">
        <div class="card-body">
            <h5 class="card-title">Sales</h5>
            <div id="sparkline1"></div>

        </div>
    </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-bg">
        <div class="card-body">
            <h5 class="card-title">Visitors</h5>
            <div id="sparkline2"></div>
        </div>
    </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-bg">
        <div class="card-body">
            <h5 class="card-title">Projects</h5>
            <div id="sparkline3"></div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chartDashboard"), options);
        chart.render();

        var options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
            },
            dataLabels: {
            enabled: false
            },
            stroke: {
            curve: 'straight'
            },
            title: {
            text: 'Product Trends by Month',
            align: 'left'
            },
            grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
            },
            xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#sparkline1"), options);
        chart.render();

        var options = {
            series: [{
            name: 'Servings',
            data: [44, 55, 41, 67, 22, 43, 21, 33, 45, 31, 87, 65, 35]
            }],
            annotations: {
            points: [{
                x: 'Bananas',
                seriesIndex: 0,
                label: {
                borderColor: '#775DD0',
                offsetY: 0,
                style: {
                    color: '#fff',
                    background: '#775DD0',
                },
                text: 'Bananas are good',
                }
            }]
            },
            chart: {
            height: 350,
            type: 'bar',
            },
            plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '50%',
            }
            },
            dataLabels: {
            enabled: false
            },
            stroke: {
            width: 2
            },
            
            grid: {
            row: {
                colors: ['#fff', '#f2f2f2']
            }
            },
            xaxis: {
            labels: {
                rotate: -45
            },
            categories: ['Apples', 'Oranges', 'Strawberries', 'Pineapples', 'Mangoes', 'Bananas',
                'Blackberries', 'Pears', 'Watermelons', 'Cherries', 'Pomegranates', 'Tangerines', 'Papayas'
            ],
            tickPlacement: 'on'
            },
            yaxis: {
            title: {
                text: 'Servings',
            },
            },
            fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
            }
        };

        var chart = new ApexCharts(document.querySelector("#sparkline2"), options);
        chart.render();

        var options = {
            series: [44, 55, 13, 43, 22],
            chart: {
            width: 380,
            type: 'pie',
            },
            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
            responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 200
                },
                legend: {
                position: 'bottom'
                }
            }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#sparkline3"), options);
        chart.render();
    </script>
@endsection