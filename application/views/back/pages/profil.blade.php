@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Profil</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Edit Profil</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-inverse">
				{!! form_open('',array('role'=>'form')) !!}
					<div class="panel-body">
						@if(isset($message))
							@if($message['status'])
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Sukses</h4>
								{!! $message['message'] !!}
							</div>
							@else
								<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Gagal</h4>
									{!! $message['message'] !!}
								</div>
							@endif
						@endif
						<div class="form-group">
							{!! form_label('Username','username','required') !!}
							{!! form_input('username',$user->username,'class="form-control" id="username" placeholder="Username" required') !!}
						</div>
						<div class="form-group">
							{!! form_label('Email','email','required') !!}
							{!! form_input('email',$user->email,'class="form-control" id="email" placeholder="Email" required') !!}
						</div>
						<div class="form-group">
							{!! form_label('Nama lengkap','full_name','required') !!}
							{!! form_input('full_name',$user->full_name,'class="form-control" id="full_name" placeholder="Nama Lengkap" required') !!}
						</div>
						<div class="form-group">
							{!! form_label('Kontak','kontak') !!}
							{!! form_input('phone',$user->phone,'class="form-control" id="kontak" placeholder="No telepon"') !!}
						</div>
						<div class="form-group">
							{!! form_label('Ganti Password','change_passwd') !!}
							<div class="input-group" id="change_passwd">
								<span class="input-group-addon">
								  <input type="checkbox" name="is_change_password" id="change_pass" value="yes">
								</span>
								{!! form_password('new_password','','class="form-control" id="new_pass" placeholder="Password Baru"') !!}
							</div>
						</div>
						<div class="form-group">
						<button type="submit" class="btn btn-primary btn-sm">Ubah Data Profil  <i class="ion-ios-arrow-right text-white f-w-700"></i></button>
					</div>
					</div>
					<!-- /.box-body -->
				{!! form_close() !!}
			</div>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
	$(function(){
		change_pass();
	});
	var change_pass=function(){
		var ic=$('#change_pass'),
			np=$('#new_pass'),
			update_passwordbox=function(){
				np.prop('disabled',!ic.is(":checked"));
			};
			update_passwordbox();
			ic.click(update_passwordbox);
	}
</script>
@endsection
