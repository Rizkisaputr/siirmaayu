@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content content-custom">
    <div class="header-content d-flex justify-content-between align-items-center">
      <h1 class="page-header f-s-16">Dashboard PSC</h1>
      <form method="post" id="form_filter">
      <ul class="breadcrumb-custom">
        <li><a href="#"><b>Filter Berdasarkan</b></a></li>
        <li class="text-white">
            <select class="select2" name="tahun" style="width: 100%" onchange="$('#form_filter').submit()">
                <option value="">Seluruh Tahun</option>
                @foreach($cb_tahun->result() as $t)
                <option value="{{$t->tahun}}" @if ($t->tahun == $cb_tahun_selected) selected @endif>{{$t->tahun}}</option>
                @endforeach
            </select>
        </li>
        <li class="text-white">
            <select class="select2" name="bulan" style="width: 100%" onchange="$('#form_filter').submit()">
                <option value="">Seluruh Bulan</option>
                @foreach($cb_bulan as $a => $b)
                <option value="{{$a}}" @if ($a == $cb_bulan_selected) selected @endif>{{$b}}</option>
                @endforeach
            </select>
        </li>
      </ul>
    </form>
    </div>
    <div class="row">
        <div class="col-md-4 p-r-0">    
            <h5 class="p-10 f-s-14 bg-aqua text-center">Trend Rujukan</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="icon-circle-wrap d-flex align-items-center">
                        <div class="icon-circle bg-aqua mr-2">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-wrap d-flex align-items-center">
                        <h2 class="display-4 mr-2 mb-0">2</h2>
                        <div class="text-group">
                            <h6>TAHUN <br>TERAKHIR</h6>
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="trend-rujukan" class="mt-4"></canvas>
            <!-- next Dashboard -->
        </div>
        <div class="col-md-8 p-l-0">
            <h5 class="p-10 f-s-14 bg-green text-center">Rujukan PSC</h5>
            <div class="row">
                <div class="col-md-5">
                    <div class="icon-circle-wrap d-flex align-items-center">
                        <div class="icon-circle bg-green mr-2">
                        <i class="fas fa-building"></i>
                        </div>
                        <div class="text-group">
                            <h6 class="mb-0"><b>JUMLAH</b></h6>
                            <h4 class="mb-0">RUJUKAN</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-wrap d-flex align-items-center">
                        <h2 class="display-4 mr-2 mb-0">{{ $total }}</h2>
                        <div class="text-group">
                            <h6 class="mb-0"><b>TOTAL</b></h6>
                            <h4 class="mb-0">RUJUKAN PSC</h4>
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="kategori-rujukan" class="mt-4"></canvas>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{load_asset('new-assets/js/vendor/chart.bundle.min.js')}}"></script>
<script>
var ctx = document.getElementById("trend-rujukan");
ctx.height = 220;
var myLineChart = new Chart(ctx, {
    type: "pie",
    data: {
        labels: [{!!$tahun_pie!!}],
        datasets: [{
            data: [{!!$tahun_data!!}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: true,
        },
    }
});
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
// For Bar Chart
var ctx = document.getElementById("kategori-rujukan");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [{!!$psc_sel!!}],
        datasets: [{
            data: [{!!$psc_data!!}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        legend: {
            display: false
        }
    }
});
</script>
@endsection

@section('head')
    <link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
    <style>
        .select2-container { 
            margin: -10px 0 0 0 !important; 
            padding: 0 !important;
            line-height: 12px;
            background: '#eee' !important; }
    </style>
@endsection