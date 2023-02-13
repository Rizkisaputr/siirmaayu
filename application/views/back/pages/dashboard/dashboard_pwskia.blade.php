@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content content-custom">
    <div class="header-content d-flex justify-content-between align-items-center">
      <h1 class="page-header f-s-16">Dashboard PWS KIA</h1>
      <form method="post" id="form_filter">
      <ul class="breadcrumb-custom">
        <li><a href="#"><b>Filter Berdasarkan</b></a></li>
        <li class="text-white">
            <select class="select2" name="tahun" onchange="$('#form_filter').submit()">
                <option value="">Tahun</option>
                 @foreach($cb_tahun as $t)
                    <option value="{{ $t }}" @if ($t == $thn_selected) selected @endif>{{ $t }}</option>
                 @endforeach
            </select>
        </li>
        <li class="text-white">
            <select class="select2" name="puskesmas" onchange="$('#form_filter').submit()">
                @foreach($cb_puskesmas->result() as $p)
                <option value="{{$p->id_rs}}" @if ($p->id_rs == $puskesmas_selected) selected @endif>{{$p->nama}}</option>
                @endforeach
            </select>
        </li>
      </ul>
  	  </form>
    </div>
    <div class="row">
        <div class="col-md-10">
            <h5 class="p-10 f-s-14 bg-green text-center">Rujukan PWS KIA</h5>
            <div class="row">
                <div class="col-md-5">
                    <div class="icon-circle-wrap d-flex align-items-center">
                        <div class="icon-circle bg-green mr-2">
                        <i class="fas fa-building"></i>
                        </div>
                        <div class="text-group">
                            <h6 class="mb-0"><b>PUSKESMAS</b></h6>
                            <h4 class="mb-0">{{ $puskesmas->nama }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-wrap d-flex align-items-center">
                        <h2 class="display-4 mr-2 mb-0">{{ $puskesmas->jml }}</h2>
                        <div class="text-group">
                            <h6 class="mb-0"><b>TOTAL</b></h6>
                            <h4 class="mb-0">Desa</h4>
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="dashboard-pwskia" class="mt-2"></canvas>
 			<br>
 			<div class="panel-body">
	        <div class="panel panel-inverse" data-sortable-id="table-basic-4">
	            <div class="table-responsive">
	                <!-- begin widget-table -->
	                <table class="table table-bordered table-condensed" data-id="widget">
	                    <tbody>
	                    	<tr>
	                            <td><strong>Kumulatif (seluruh bulan dari tahun ini yang berjalan)</strong></td>
	                            @foreach($desa->result() as $d)
                                    <td>{{ $kumulatif[$d->id_desa].'%'}}</td>
                                @endforeach
	                        </tr>
                            <tr>
                                <td><strong>% Bulan Lalu</strong></td>
                                 @foreach($desa->result() as $d)<td>{{ $bulan_past[$d->id_desa].'%'}}</td>@endforeach

                            </tr>
	                        <tr>
	                            <td><strong>% Bulan Ini</strong></td>
	                             @foreach($desa->result() as $d)<td>{{ $bulan_ini[$d->id_desa].'%'}}</td>@endforeach
	                        </tr>
	                        <tr>
	                            <td><strong>Trend</strong></td>
	                            @foreach($desa->result() as $d)
                               
	                            <td>
                                    @if (isset($bulan_past[$d->id_desa]) and !isset($bulan_ini[$d->id_desa]))
                                    <i class="fa fa-arrow-down text-danger"></i>
                                    @elseif (!isset($bulan_past[$d->id_desa]) and isset($bulan_ini[$d->id_desa]))
                                    <i class="fa fa-arrow-up text-success"></i>
                                    @elseif (isset($bulan_past[$d->id_desa]) and isset($bulan_ini[$d->id_desa]) and $bulan_ini[$d->id_desa] < $bulan_past[$d->id_desa])
                                    <i class="fa fa-arrow-down text-danger"></i>
                                    @elseif (isset($bulan_past[$d->id_desa]) and isset($bulan_ini[$d->id_desa]) and $bulan_ini[$d->id_desa] > $bulan_past[$d->id_desa])
                                    <i class="fa fa-arrow-up text-success"></i>
                                    @else 
                                    -
                                    @endif
                                </td>

	                            @endforeach
	                        </tr>
	                    </tbody>
	                    <body>
	                        <tr>
	                        	<th>Desa</th>
	                            @foreach($desa->result() as $d)<th>{{$d->desa}}</th>@endforeach
	                        </tr>
	                    </body>
	                </table>
	                <!-- end widget-table -->
	            </div>
	        </div>
	    </div>
        </div>
        <div class="col-md-2">
        	<h5 class="p-10 f-s-14 bg-blue text-center">Target</h5>
        	<div class="panel panel-inverse" data-sortable-id="table-basic-4">
	            <div class="table-responsive">
		        	<table class="table table-bordered table-condensed" data-id="widget">
		        		<tbody>
		        			<tr>
		        				<td>Des</td>
		        				<td>{{ $pbln[12] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Nop</td>
		        				<td>{{ $pbln[11] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Okt</td>
		        				<td>{{ $pbln[10] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Sep</td>
		        				<td>{{ $pbln[9] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Agu</td>
		        				<td>{{ $pbln[8] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Jul</td>
		        				<td>{{ $pbln[7] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Jun</td>
		        				<td>{{ $pbln[6] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Mei</td>
		        				<td>{{ $pbln[5] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Apr</td>
		        				<td>{{ $pbln[4] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Mar</td>
		        				<td>{{ $pbln[3] }}</td>
		        			</tr>
		        			<tr>
		        				<td>Feb</td>
		        				<td>{{ $pbln[2] }}</td>
		        			</tr><tr>
		        				<td>Jan</td>
		        				<td>{{ $pbln[1] }}</td>
		        			</tr>
		        		</tbody>
		        	</table>
	       		</div>
        	</div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{load_asset('new-assets/js/vendor/chart.bundle.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
// For Bar Chart
var ctx = document.getElementById("dashboard-pwskia");
ctx.height = 80;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["K1 Akses", "K1 Murni", "K4", "Linakes Total", "Kunjungan Nifas (KF 3)", "KN1", "KN lgkp","Masy Nakes","Bumil","Neo","Bayi 11 Bulan","Balita 1-5 Thn","Ditangani Sesuai Standar","Seluruh Pasien Balita","JML KB Baru"],
        datasets: [{
            data: [{!!$detail!!}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
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