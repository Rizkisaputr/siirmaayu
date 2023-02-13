<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Manajemen Pengguna</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Manajemen Pengguna</h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
            <div class="btn-toolbar">
                <div class="dropdown m-r-2">
                    <a href="<?php echo e(base_url('panel/admin/users/add')); ?>" class="btn btn-sm btn-success">
                      <b>Tambah User</b>
                    </a>
                </div>
                
            </div>
        </div>
		<div class="panel-body">
        	<div class="table-responsive">
        		<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th>Action</th>
						<th>Username</th>
						<th>Email</th>
						<th>Nama Lengkap</th>
						<th>Kontak</th>
						<th>Jenis</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
					<tr>
						<th>Action</th>
						<th>Username</th>
						<th>Email</th>
						<th>Nama Lengkap</th>
						<th>Kontak</th>
						<th>Jenis</th>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(load_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(load_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
	<?php echo $__env->make('partials.sirine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(isset($message)): ?>
		<div style="display: none" id="toastr-error">
			<?php echo $message['message']; ?>

		</div>
		<script type="text/javascript">
			$(function(){
				toastr["<?php echo e($message['status']?'success':'error'); ?>"]($("#toastr-error").html());
			});
		</script>
	<?php endif; ?>
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
					url:'<?php echo e(base_url('panel/admin/users/list')); ?>'
				},
				columns:[
					{
						data:'id',
						render:function(data, type, row, meta){
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm btn-white\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-white btn-sm dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"<?php echo e(base_url('panel/admin/users/edit/')); ?>"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"<?php echo e(base_url('panel/admin/users/delete/')); ?>"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					},
					{data:'username'},
					{data:'email'},
					{data:'full_name'},
					{data:'phone'},
					{data:'groups'}
				]
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>