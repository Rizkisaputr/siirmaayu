@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content content-custom">
    <div class="header-content d-flex justify-content-between align-items-center">
      <h1 class="page-header f-s-16">Dashboard Rujukan</h1>
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
        <div class="col-md-6 p-r-0">    
            <h5 class="p-10 f-s-14 bg-blue">Presentasi Jumlah Rujukan Per Rumah Sakit</h5>
            <div class="panel panel-inverse" data-sortable-id="table-basic-4">
	            <div class="panel-body">
		            <div class="table-responsive">
						<!-- begin widget-table -->
						<table class="table table-bordered table-condensed" data-id="">
							<thead>
								<tr>
									<th rowspan="2">Nama Rumah Sakit</th>
									<th colspan="2" class="text-center">Total Rujukan</th>
									<th colspan="3" class="text-center">Status</th>
								</tr>
								<tr>
									<th>Ibu & Anak</th>
									<th>Umum</th>
									<th>Diterima</th>
									<th>Dialihkan</th>
									<th>Dikembalikan</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_rs->result() as $rs)
								<tr>
									<td>{{ $rs->nama }}</td>
									<td>{{ $list_rj_ibuanak[$rs->id_rs] or 0 }}</td>
									<td>{{ $list_rj_umum[$rs->id_rs] or 0 }}</td>
									<td><span class="badge bg-success">{{ $list_rj_diterima[$rs->id_rs] or 0 }}</span></td>
									<td><span class="badge bg-warning">{{ $list_rj_dialihkan[$rs->id_rs] or 0 }}</span></td>
									<td><span class="badge bg-danger">{{ $list_rj_Dikembalikan[$rs->id_rs] or 0 }}</span></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<!-- end widget-table -->
					</div>
				</div>
			</div>
        </div>
        <div class="col-md-3 p-0">
            <h5 class="p-10 f-s-14 bg-green">Rujukan Berdasarkan Kategori</h5>
            <canvas id="doughnut"></canvas>
		</div>
		<div class="col-md-3 p-0">
			<h5 class="p-10 f-s-13 bg-yellow">Rujukan Masuk</h5>
            <div class="circle-wrap">
                <div class="circle-custom bg-gradient-yellow circle-big d-flex align-items-center justify-content-center flex-column mx-auto">
                    <h2><b>{{ $rujukan_total }}</b></h2>
                    <p><b>TOTAL RUJUKAN</b></p>
                </div>
                <div class="circle-custom bg-gradient-green circle-small d-flex align-items-center justify-content-center flex-column">
                    <h5 class="text-white f-s-14 f-w-600">{{ $rujukan_l }}</h5>
                    <h6>Laki-laki</h6>
                    <h5 class="text-white f-s-14 f-w-600">{{ $rujukan_p }}</h5>
                    <h6>Perempuan</h6>
                </div>
                <div class="square-custom bg-gradient-white mx-auto">
                    <h5 class="f-s-10 f-w-400"><b>Tanggal Update :<b></h5>
                    <h6 class="f-s-12 f-w-800 f-s-12"><b><?php echo date("d-M-Y H:i:s A");?> </b></h6>
                </div>
            </div>
            <!-- <h5 class="p-10 f-s-14 bg-green">Rujukan Berdasarkan Kategori</h5>
            <canvas id="doughnut"></canvas> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 p-r-0">    
			<h5 class="p-10 f-s-14 bg-green">Presentasi Rujukan Harian</h5>
            <canvas id="bar-chart" width="100" height="100"></canvas>
        </div>
        <div class="col-md-6 p-l-0">
            <h5 class="p-10 f-s-14 bg-yellow">Presentasi Rujukan Bulanan</h5>
            <canvas id="bar-bulan"></canvas>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{load_asset('new-assets/js/vendor/chart.bundle.min.js')}}"></script>
<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script>
	$(document).ready(function() {
	    $('.select2').select2();
	});
  var ctx = document.getElementById("bar-chart");
	ctx.height = 58;
	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10","11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
	        datasets: [{
	            data: [{{$daily}}],
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	            ],
	            borderColor: [
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 99, 132, 0.5)',
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
<script>
    var ctx = document.getElementById("doughnut");
	ctx.height = 250;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Ibu dan Anak", "Umum"],
            datasets: [{
                data: [{{ $ibuanak }}, {{ $umum }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
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
                display: true
            },
        }
    });
</script>
<script>
  var ctx = document.getElementById("bar-bulan");
	ctx.height = 169;
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt","Nop", "Des"],
	        datasets: [{
	            data: [{{$monthly}}],
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	                'rgba(255, 206, 86, 0.5)',
	                'rgba(75, 192, 192, 0.5)',
	                'rgba(153, 102, 255, 0.5)',
	                'rgba(255, 99, 132, 0.5)',
	                'rgba(54, 162, 235, 0.5)',
	            ],
	            borderColor: [
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
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