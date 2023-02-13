@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<h1 class="page-header f-s-14 f-w-500"><?php if ($is_puskesmas) { ?> Data Rujukan <?php } else { ?> Rujukan Masuk <?php } ?></h1>
	<!-- top card -->
	<div class="row">
        <!-- <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-white text-inverse">
                <div class="stats-content">
                    <div class="stats-title">TOTAL RUJUKAN</div>
                    <div class="stats-number">{{$my_rujukan_count}}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-desc">Total Seluruh Rujukan</div>
                </div>
            </div>
        </div> -->
        <div class="col-lg-3 col-md-6">
			<div class="widget widget-stats bg-gradient-blue">
				<div class="stats-icon"><i class="fa fa-ambulance"></i></div>
				<div class="stats-info">
					<h4>TOTAL RUJUKAN</h4>
					<p>{{$my_rujukan_count}}</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">Total Seluruh Rujukan <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
        <!-- <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-white text-inverse">
                <div class="stats-content">
                    <div class="stats-title">RUJUKAN DITERIMA</div>
                    <h5 class="stats-number" id="balik_terima">0</h5>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-desc">Rujukan yang Telah Diterima</div>
                </div>
            </div>
        </div> -->
        <div class="col-lg-3 col-md-6">
			<div class="widget widget-stats bg-gradient-green">
				<div class="stats-icon"><i class="fa fa-user"></i></div>
				<div class="stats-info">
					<h4>RUJUKAN DITERIMA</h4>
					<p id="balik_terima">0</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">Rujukan yang Telah Diterima <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
        <!-- <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-white text-inverse">
                <div class="stats-content">
                    <div class="stats-title">RUJUKAN DITOLAK</div>
                    <h5 class="stats-number" id="balik_tolak">0</h5>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-desc">Rujukan yang Ditolak</div>
                </div>
            </div>
        </div> -->
        <div class="col-lg-3 col-md-6">
			<div class="widget widget-stats bg-gradient-red">
				<div class="stats-icon"><i class="fa fa-ban"></i></div>
				<div class="stats-info">
					<h4>RUJUKAN DIKEMBALIKAN</h4>
					<p id="balik_tolak">0</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">Rujukan yang Dikembalikan <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
        <!-- <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-white text-inverse">
                <div class="stats-content">
                    <div class="stats-title">RUJUKAN BELUM DIRESPON</div>
                    <h5 class="stats-number" id="balik_no_respon">0</h5>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 1009%;"></div>
                    </div>
                    <div class="stats-desc">Rujukan yang Belum Direspon</div>
                </div>
            </div>
        </div> -->
        <div class="col-lg-3 col-md-6">
			<div class="widget widget-stats bg-gradient-orange">
				<div class="stats-icon"><i class="fa fa-bell"></i></div>
				<div class="stats-info">
					<h4>RUJUKAN BELUM DIRESPON</h4>
					<p id="balik_no_respon">0</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">Rujukan yang Belum Direspon <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
    </div>
    <!-- end top card -->
	<div class="panel panel-inverse" data-sortable-id="table-basic-4">
        <div class="wrapper bg-silver-lighter">
            <div class="btn-toolbar">
                <!-- begin btn-group -->
                <div class="dropdown m-r-1">
                    <a href="{{base_url('panel/rujukan/rujuk/add')}}" class="btn btn-sm btn-success">
                      Buat Rujukan Baru
                      <i class="fas fa-angle-double-right"></i>
                    </a>
                </div>
                <div class="btn-group ml-auto">
                    <form class="form-inline" action="/" method="POST">
                        <!-- <div class="form-group m-r-1">
                            <button type="submit" class="btn btn-sm btn-primary">Rujukan Balik</button>  
                        </div>
                        <div class="form-group m-r-1">
                            <select class="form-control form-control-sm">
                                <option>Status Rujukan</option>
                                <option>Belum Direspon</option>
                                <option>Ditolak</option>
                                <option>Diterima</option>
                                <option>Sudah Dirujuk</option>
                            </select>
                        </div>
                        <div class="form-group m-r-1">
                            <select class="form-control form-control-sm">
                                <option>Kategori Rujukan</option>
                                <option>Rujukan Umum</option>
                                <option>Ibu dan Anak</option>
                            </select>
                        </div>
                        <div class="form-group m-r-1">
                            <select class="form-control form-control-sm width-100">
                                <option>Pilih Tahun</option>
                                <option>2017</option>
                                <option>2018</option>
                            </select>
                        </div>
                        <div class="form-group m-r-1">
                            <select class="form-control form-control-sm width-100">
                                <option>Pilih Bulan</option>
                                <option>Januari</option>
                                <option>Maret</option>
                                <option>April</option>
                                <option>Mei</option>
                                <option>Juni</option>
                                <option>Juli</option>
                                <option>Agustus</option>
                                <option>September</option>
                                <option>Oktober</option>
                                <option>November</option>
                                <option>Desember</option>
                            </select>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-body">
			<div class="table-responsive table-hover">
				<table class="table table-bordered table-hover" id="rujukan-table">
					<thead>
					<tr>
						<th>Kategori & Waktu</th>
						<th>Identitas Pasien</th>						
						<th>Biaya & Media</th>
						@if($all_rs!==TRUE)
						<th>Asal & Tujuan </th>
						<th>Diagnosa</th>
						<th>Tanda-Tanda Vital</th>
						@else  
						<th>Tujuan Rujukan</th>
						<th>Diagnosa</th>
						<th>Tanda-Tanda Vital</th>
						@endif
						<th>Pra-Rujukan</th>
						<th>Advis RS</th>													
						<!--<th>Alasan</th>
						<th>Darurat</th>-->
						<th>Status</th>
						<th>Identitas Perujuk</th>
						<th>Action</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('head')
	<link rel="stylesheet" href="{{load_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
	<style rel="stylesheet">
		@-webkit-keyframes blinker {
			from {opacity: 1.0;}
			to {opacity: 0.0;}
		}
		.blink-infinite{
			text-decoration: blink;
			-webkit-animation-name: blinker;
			-webkit-animation-duration: 0.6s;
			-webkit-animation-iteration-count:infinite;
			-webkit-animation-timing-function:ease-in-out;
			-webkit-animation-direction: alternate;
		}

		.img-logo-dash {
			height: 48px;
			float: left;
			margin-right: 15px;
		}
		/*.description-block>.description-header {
			font-size: 20px !important;
		}*/
	</style>
@endSection

@section('script')
	<script src="{{load_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{load_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
	@include('partials.toastr_msg')
	<script src="{{load_asset('bower_components/Flot/jquery.flot.js')}}"></script>
	<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
	<script src="{{load_asset('bower_components/Flot/jquery.flot.resize.js')}}"></script>
	<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
	<script src="{{load_asset('bower_components/Flot/jquery.flot.pie.js')}}"></script>
	<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
	<script src="{{load_asset('bower_components/Flot/jquery.flot.categories.js')}}"></script>
	<audio id="sirine" loop="loop">
		<source src="{{load_asset('etc/sirine.mp3')}}" type="audio/mp3"/>
	</audio>
	<script type="text/javascript">
		$(function(){
		refresh_sms();
		refresh_wa();
			});

		function labelFormatter(label, series) {
		    return '<div style="font-size:12px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
		      + label
		      + '<br>'
		      + Math.round(series.percent) + '%</div>'
		 }

		function togglesound(play) {
			if(play){
				sirine.paused?sirine.play():'';
			}else{
				sirine.paused?'':sirine.pause();
			}
		}
		function secondsToString(seconds){
			var numyears = Math.floor(seconds / 31536000);
			var numdays = Math.floor((seconds % 31536000) / 86400);
			var numhours = Math.floor(((seconds % 31536000) % 86400) / 3600);
			var numminutes = Math.floor((((seconds % 31536000) % 86400) % 3600) / 60);
			var numseconds = (((seconds % 31536000) % 86400) % 3600) % 60;
			if(numyears>0){
				return numyears+" Tahun";
			}else if(numdays>0){
				return numdays+" Hari";
			}else if(numhours>0){
				return numhours+" Jam";
			}else if(numminutes>0){
				return numminutes+" Menit";
			}else if(numseconds>0){
				return numseconds+" Detik";
			}else if(!seconds){
				return 'Tidak tersedia';
			}
			return seconds;

		}
		function is_loading_rujukbalik(loading) {
			if(loading){
				$('.my-loading').show();
			}else{
				$('.my-loading').hide();
			}
		}
		$(function(){
			var ele=$('#response-second');
			ele.text(secondsToString(ele.attr('data-second')));
			is_loading_rujukbalik(false);

			function refresh_rujuk_balik() {
				is_loading_rujukbalik(true);
				$.get("{!! base_url('panel/dashboard_data_rujukan'.$param_pie) !!}",function(res){
					$("#balik_tolak").text(res.tolak);
					$("#balik_terima").text(res.terima);
					$("#balik_no_respon").text(res.no_respon);
					is_loading_rujukbalik(false);
					if(res.no_respon>0)
						togglesound(true);
					else
						togglesound(false);
					

					var data = [], totalPoints = 100

				    var donutData = [
				      { label: 'Rujukan Belum Direspon', data: res.no_respon, color: '#E64B3E' },
				      { label: 'Rujukan Dikembalikan', data: res.tolak, color: '#FA9C2F' },
				      { label: 'Rujukan Diterima', data: res.terima, color: '#00A65E' }
				    ]
				    $.plot('#donut-chart', donutData, {
				      series: {
					        pie: {
					            show: true,
					            radius: 1,
					            label: {
					                show: true,
					                radius: 1,
					                formatter: labelFormatter,
					                background: {
					                    opacity: 0.8
					                }
					            }
					        }
					    },
					   
				      legend: {
				        show: false
				      }
				    })

				});
				setTimeout(refresh_rujuk_balik,30000);
			}

			refresh_rujuk_balik();
			$('#bed-table').DataTable({
				processing:true,
				serverSide:true,
				autoWidth :false,
				ajax:{
					url:'{!!base_url('panel/dashboard_data_bed/'.$param_bed)!!}'
				},
				order:[[7,'desc']],
				columns:[
					{data:'nama_rs'},
					{data:'nama'},
					{data:'kelas'},
					{data:'kapasitas_l'},
					{data:'kapasitas_p'},
					{
						data:'terpakai_l',
						render: function(data, type, row, meta){
							return data+'/'+(Number(row.kapasitas_l)-Number(data));
						}
					},
					{
						data:'terpakai_p',
						render: function (data,type,row,meta) {
							return data+'/'+(Number(row.kapasitas_p)-Number(data));
						}
					},
					{data:'tgl_update'}
				]
			});
			var table=$('#rujukan-table').DataTable({
				columnDefs:[
					{'orderable':false,'targets':1}
				],
				autoWidth :false,
				// processing:true,
				serverSide:true,
				order:[[11,'DESC']],
				ajax:{
					url:'{!!base_url('panel/rujukan/'.($is_puskesmas?'rujuk/data':'balik/data_param').'/'.$param_rujuk)!!}'
				},
				columns:[
					{
						data:'type',
						render:function(data, type, row, meta){
							var r='';
							switch (data){
								case '1':
									r='Umum';
									break;
								case '2':
									r='Maternal';
									break;
								case '3':
									r='Ginekologi';
									break;
								case '4':
									r='Neonatal';
									break;
								case '5':
									r='Bayi / Balita';
									break;
								default:
							}
							return '<a class="text text-primary">' + r + ',<br><i><a class="text text-capitalize">Tanggal : </i><b>' + row.dibuat;
						}
					},
					{
						data:'pasien',
						render: function ( data, type, row ) {
                		//return row.pasien + ',<br><i>' + row.umur + '</i>,'+ ' (' + row.pasangan + ')';
                		return row.pasien + ',<br><a class="text text-danger blink-infinite"><i> Umur: ' + row.umur + '</i>, Goldar: '+ ' ' + row.goldarah + '</i></a>,'+ ' (' + row.pasangan + ')' + '</i>, ID: '+ ' ' + row.id_rujukan;
            			}   
					},   
					{data:'pembiayaan',
						render: function ( data, type, row ) {
                		return row.pembiayaan + ',<br><a class="text text-warning">Media: ' + row.media+ ',<br></a><a class="text text-info"> Transport: ' + row.transportasi;
            			}   
					}, 
					@if($all_rs!==TRUE)
					{data:'perujuk',
						render: function ( data, type, row ) {
                		return row.perujuk + ',<br><a class="text text-danger blink-infinite"><i> Tujuan: ' + row.rs;
            			}   
					},  					
					{data:'diagnosis'},
					{
					    data:'kesadaran',
						render: function ( data, type, row, meta ) {
                		return '<a class="text text-danger"> Kesadaran : ' +row.kesadaran + ',<br><i> tensi: ' + row.tensi + '</i>, nadi: '+ ' ' + row.nadi + '</i></a>,'+ '<br><a class="text text-warning"> Suhu : ' + row.suhu + 'c' + '</i>, RR : '+ ' ' + row.pernapasan + ', GCS : '+ ' ' + row.nyeri;
            			}  
					},
					@else
					{data:'rs'},
					{data:'diagnosis'},
					{
					    data:'kesadaran',
						render: function ( data, type, row, meta ) {
                		return '<a class="text text-danger"> Kesadaran : ' +row.kesadaran + ',<br><i> tensi: ' + row.tensi + '</i>, nadi: '+ ' ' + row.nadi + '</i></a>,'+ '<br><a class="text text-warning"> Suhu : ' + row.suhu + 'c' + '</i>, RR : '+ ' ' + row.pernapasan + ', GCS : '+ ' ' + row.nyeri;
            			}  
					},					
					@endif

					{data:'tindakan'},
					//{data:'alasan_rujukan'},
					{data:'info_rujuk_balik'},
					//{
					//	data:'darurat',
					//	render:function(data, type, row, meta){
					//		var r='';
					//		if (data == true) r='<span class="label label-danger blink-infinite">Darurat</span>';
					//		return r;
					//	}
					//},
					{
					data:'status_rujukan',
						render:function(data, type, row, meta){
							var r='';
							switch (data){
								case 'Diterima':
									r='<span class="label label-success">Diterima</span>';
									r+=' oleh '+row.full_name;
									break;
								case 'Ditolak':
									r='<span class="label label-warning">Dikembalikan</span>';
									r+=' oleh '+row.full_name;
									break;
								case 'Batal':
									r='<span class="label label-info">Batal</span>';
									r+=' oleh '+row.full_name;
									break;
								case 'Belum direspon':
									r='<span class="label label-danger blink-infinite">Belum Direspon</span>';
									break;
								case 'Dialihkan':
									r='<span class="label label-primary">Dialihkan</span> dari '+row.pengalih;
									break;
								default:
									r=data;
							}
							return r;
						}
					},

					{
						data:'ibuanak_nobidan',
						render: function ( data, type, row ) {
                		return row.ibuanak_nobidan + ',<br>' + row.ibuanak_namabidan + ','+ '<br><b>' + row.perujuk + '</b>';
            			}   
					},

					{
					data:'id_rujukan',
					render:function(data, type, row, meta){
							if (row.status_rujukan == 'Diterima') {
								if (row.rujukbalik_status == 'Pulang') {
									return "<a class='btn btn-green'>Sudah <br>Pulang</a>";
								} else if (row.rujukbalik_status == 'Batal' ) {
									return "<a class='btn btn-info'>Sudah <br>Dibatalkan</a>";
								} else if (row.rujukbalik_status == 'Meninggal Dunia' ) {
									return "<a class='btn btn-yellow'>Meninggal <br>Dunia</a>";
								} else {
									return "<a class='btn btn-purple btn-sm' href=\"{{base_url('panel/rujukan/balik/jawab/')}}"+data+"\">Rujuk Balik <br> / Batal</a>";
								} 
							} else if (row.status_rujukan == 'Ditolak' ) {
									return "<a class='btn btn-warning btn-sm'>Dikembalikan</a>";
							} else if (row.status_rujukan == 'Batal' ) {
									return 'Batal' ;
							} else {
								return "<a class='btn btn-danger btn-sm' href=\"{{base_url('panel/rujukan/balik/action/')}}"+data+"\"><b>Jawab</b></a>";
							}
							/*return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"{{base_url('panel/rujukan/balik/action/')}}"+data+"\">Respon</a></li>\n" +
									"</ul>\n" +
									"</div>";*/
						}
					},
					{
						data:'id_rujukan',
						render:function(data, type, row, meta){


							
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"{{base_url('panel/rujukan/rujuk/edit/')}}"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"{{base_url('panel/rujukan/rujuk/delete/')}}"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					}
				]
			});
			function refresh_table(){
				Pace.restart();
				table.ajax.reload(function(json){
					setTimeout(refresh_table,600000);
				});
			}
			refresh_table();
		});

		function refresh_sms() 
		{
			setInterval(function() {
				$.ajax({
					type: "GET",
					url:'{{site_url('home/api_sms')}}',
					dataType: "json",
					success: function(res) {
						$.ajax({
		                    url: '{{ base_url('home/process_sms') }}',
		                    type: "POST",
		                    data: res,
		                    cache: false,
		                    dataType: "json",
		                    success: function(ans) {
		                       
		                    },error:function(xhr, ajaxOptions, thrownError){
		                        console.log(JSON.stringify(xhr));
		                    }
		                });
					}
				});
		    }, 5000); 
		}

		function refresh_wa() 
		{
			setInterval(function() {
				$.ajax({
					type: "GET",
					url:'{{site_url('home/api_wa')}}',
					dataType: "json",
					success: function(res) {
						$.ajax({
		                    url: '{{ base_url('home/process_wa') }}',
		                    type: "POST",
		                    data: res,
		                    cache: false,
		                    dataType: "json",
		                    success: function(ans) {
		                       
		                    },error:function(xhr, ajaxOptions, thrownError){
		                        console.log(JSON.stringify(xhr));
		                    }
		                });
					}
				});
		    }, 5000); 
		}

		
		//connection detect
		var connection_info=$('#status-internet');
		var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
		var type = connection.type;
		function update_connection_info(event){
			if(connection){
				connection_info.text('Online');
				connection_info.removeClass('blink-infinite')
			}else{
				connection_info.text('Offline');
				connection_info.addClass('blink-infinite')
			}
		}
		connection.addEventListener('change', update_connection_info);
		update_connection_info();


	</script>
@endsection
