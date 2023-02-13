

<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Rujukan</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-600">Data Rujukan</h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
			<div class="btn-toolbar">
                <div class="dropdown m-r-2">
                    <a href="<?php echo e(base_url('panel/rujukan/rujuk/add')); ?>" class="btn btn-sm btn-success">
                      <b>Buat Rujukan</b>
                    </a>
                </div>
                <div class="btn-group ml-auto">
                	<div class="form-group m-r-1">
                        <a href="<?php echo e(base_url('panel/laporan/rujukan')); ?>" type="button" class="btn btn-sm btn-primary">Export Rujukan&nbsp;<i class="fa fa-download"></i></a> 
                    </div>
               	</div>
            </div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th>Kategori</th>
						<th>Tanggal</th>
						<th>Identitas Pasien</th>						
						<th>Biaya & Media</th>
						<?php if($rs!==TRUE): ?>
						<th>Asal & Tujuan </th>
						<th>Diagnosa cc</th>
						<?php else: ?>  
						<th>Tujuan Rujukan</th>
						<th>Diagnosa</th>
						<?php endif; ?>
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
					<tfoot>
					<tr>
						<th>Kategori</th>
						<th>Tanggal</th>
						<th>Identitas Pasien</th>						
						<th>Biaya & Media</th>
						<?php if($rs!==TRUE): ?>
						<th>Asal & Tujuan </th>
						<th>Diagnosa</th>
						<?php else: ?>  
						<th>Tujuan Rujukan</th>
						<th>Diagnosa</th>
						<?php endif; ?>
						<th>Pra-Rujukan</th>
						<th>Advis RS</th>													
						<!--<th>Alasan</th>
						<th>Darurat</th>-->
						<th>Status</th>
						<th>Identitas Perujuk</th>
						<th>Action</th>
						<th></th>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
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
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(load_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(load_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('partials.sirine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		$(function(){
			$('#main-table').DataTable({
				columnDefs:[
					{'orderable':false,'targets':0}
				],
				autoWidth :false,
				order:[[3,'desc']],
				processing:true,
				serverSide:true,
				ajax:{
					url:'<?php echo e(base_url('panel/rujukan/rujuk/data')); ?>'
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
							return r;
						}
					},
					{data:'dibuat'},
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
					<?php if($all_rs!==TRUE): ?>
					{data:'perujuk',
						render: function ( data, type, row ) {
                		return row.perujuk + ',<br><a class="text text-danger blink-infinite"><i> Tujuan: ' + row.rs;
            			}   
					},  					
					{data:'diagnosis'},  
					<?php else: ?>
					{data:'rs'},
					{data:'diagnosis'},
					<?php endif; ?>

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
								case 'Belum direspon':
									r='<span class="label label-danger blink-infinite">Belum Direspon</span>';
									break;
								case 'Dialihkan':
									r='<span class="label label-warning">Dialihkan</span> dari '+row.pengalih;
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
								if (row.rujukbalik_status == 'Pulang' || row.rujukbalik_status == 'Meninggal Dunia' ) {
									return 'Sudah Dirujuk Balik';
								} else {
									return "<a class='btn btn-info btn-sm' href=\"<?php echo e(base_url('panel/rujukan/balik/jawab/')); ?>"+data+"\">Rujuk Balik</a>";
								} 
							} else {
								return "<a class='btn btn-danger btn-sm' href=\"<?php echo e(base_url('panel/rujukan/balik/action/')); ?>"+data+"\">Jawab</a>";
							}
							/*return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"<?php echo e(base_url('panel/rujukan/balik/action/')); ?>"+data+"\">Respon</a></li>\n" +
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
									"<li><a href=\"<?php echo e(base_url('panel/rujukan/rujuk/edit/')); ?>"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"<?php echo e(base_url('panel/rujukan/rujuk/delete/')); ?>"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					}
				]
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>