<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">PWS KIA</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-600">PWS KIA</h1>
	<div class="panel panel-inverse">
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th>Puskesmas</th>
						<th>Desa</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
					<tr>
						<th>Puskesmas</th>
						<th>Desa</th>
						<th>Action</th>
					</tr>
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
				processing:true,
				serverSide:true,
				ajax:{
					url:'<?php echo e(base_url('panel/rujukan/pwskia/data')); ?>'
				},
				columns:[
					{data:'nama_rs',},
					{data:'desa'},
					{
						data:'id_rs',
						render:function(data, type, row, meta){
							return "<a class=\"btn btn-primary btn-xs\" href=\"<?php echo e(base_url('panel/rujukan/pwskia/edit/')); ?>"+data+"\"><i class=\"fas fa fa-edit\"></i> &nbsp;Data</a> "+
							"<a class=\"btn btn-warning btn-xs\" href=\"<?php echo e(base_url('panel/rujukan/pwskia/target/')); ?>"+data+"\"><i class=\"fas fa fa-edit\"></i> &nbsp;Target</a>";
						}
					},
				]
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>