@extends('layouts.panel_layout')
@section('content')
@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Tambah User</li>
    </ol>
    <h1 class="page-header f-s-14 f-w-500">Form {{$page_desc}}</h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse">
				{!! form_open('','role="form"') !!}
				<div class="panel-body">
					<div class="form-group">
						{!! form_label('Username','username') !!}
						{!! form_input('username','','class="form-control" id="username" placeholder="Username" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Email','email') !!}
						<input type="email" class="form-control" id="email" placeholder="Email" required name="email">
					</div>
					<div class="form-group">
						{!! form_label('Password','password','required') !!}
						{!! form_password('password','','class="form-control" id="password" placeholder="Password" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama Lengkap','full_name') !!}
						{!! form_input('full_name','','class="form-control" id="full_name" placeholder="Nama Lengkap"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Kontak','phone') !!}
						{!! form_input('phone','','class="form-control" id="phone" placeholder="No HP/telpon"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Jenis User','user_type') !!}
						{!! form_dropdown('user_type',$selection_user_type,'','class="form-control" id="user_type" required') !!}
					</div>
				</div>
				<footer class="footer-content bg-silver">
				    <div class="pull-left">
				        <div class="dropdown">
				        	{!! anchor(base_url('panel/admin/users'),'<i class="fas fa-arrow-alt-circle-left"></i> Back','class="btn btn-sm btn-warning"') !!}
				        </div>
				    </div>
				    <div class="pull-right">
				        <div class="dropdown">
				            {!! form_submit('save','Simpan','class="btn btn-success btn-sm"') !!}
				        </div>
				    </div>
				    <div class="clearfix"></div>
				</footer>
				{!! form_close() !!}
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	@if(isset($message))
	<div style="display: none" id="toastr-error">
		{!! $message['message'] !!}
	</div>
	<script type="text/javascript">
	$(function(){
			toastr["{{$message['status']?'success':'error'}}"]($("#toastr-error").html());
	});
	</script>
	@endif
@endsection
