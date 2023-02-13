<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Pasien</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Data Pasien <small>List Data Pasien</small></h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
            <div class="btn-toolbar">
                <div class="dropdown m-r-2">
                    <a href="<?php echo e(base_url('panel/rujukan/pasien/add')); ?>" class="btn btn-sm btn-success">
                      <b>Tambah Data</b>
                    </a>
                </div>
            </div>
        </div>
            <!-- end btn-toolbar -->
        <div class="panel-body">
        	<div class="table-responsive">
        		<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th>Action</th>
						<th>Nama</th>
						<th>Diagnosa</th>
						<th>Faktor Risiko</th>
						<th>Jenis Kelamin</th>
						<th>NIK</th>
						<th>Telepon</th>
						<th>Alamat</th>
						<th>Fasilitas Kesehatan</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
        	</div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
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
				processing:true,
				serverSide:true,
				autoWidth :false,
				ajax:{
					url:'<?php echo e(base_url('panel/rujukan/pasien/data')); ?>'
				},
				columns:[
					{
						data:'id_rm',
						render:function(data, type, row, meta){
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm btn-white\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-white btn-sm dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"<?php echo e(base_url('panel/rujukan/pasien/edit/')); ?>"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"<?php echo e(base_url('panel/rujukan/pasien/delete/')); ?>"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					},
					{data:'nama'},
					{data:'diagnosa'},
					{data:'risiko'},
					{data:'jenis_kelamin'},
					{data:'nik'},
					{data:'kontak'},
					{
						data:'alamat',
						render: function(data, type, row, meta){
							if(data.length<50)
								return data;
							return data.substr(0,50)+'...';
						}
					},
					{data:'rs_names'}
				]
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>