@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form {{$page_desc}}</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Form {{$page_desc}}</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-inverse">
				{!! form_open('','role="form"') !!}
				<div class="panel-body">
					<div class="form-group">
						{!! form_label('Nama Fasilitas Kesehatan','id_rs') !!}
						{!! form_dropdown('id_rs',$selection_rs,$edit_data['id_rs'],'class="form-control form-control-sm" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama Bed','nama') !!}
						{!! form_input('nama',$edit_data['nama'],'class="form-control form-control-sm" id="nama" placeholder="Nama Bed Rumah Sakit" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Kelas Bed','kelas') !!}
						{{--{!! form_input('kelas',$edit_data['kelas'],'class="form-control form-control-sm" id="kelas" placeholder="Kelas Bed" required') !!}--}}
						<select name="kelas" class="form-control" id="kelas" placeholder="Kelas Bed" required>
							@foreach($list_kelas as $kelas)
								<option value="{{$kelas->id_kelas_bed}}" {{$edit_data['kelas']===$kelas->id_kelas_bed?'selected':''}} data-unigender="{{$kelas->unigender}}">{{$kelas->nama}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						{!! form_label('Kapasitas','kapasitas') !!}
						<div class="row">
							<div class="col-md-4">
								{!! form_input('kapasitas_l',$edit_data['kapasitas_l'],'class="form-control form-control-sm laki-laki" id="kapasitas_l" placeholder="Kapasitas Bed Laki-laki" required') !!}
							</div>
							<div class="col-md-4">
								{!! form_input('kapasitas_p',$edit_data['kapasitas_p'],'class="form-control perempuan" id="kapasitas_p" placeholder="Kapasitas Bed Perempuan" required') !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Terpakai','terpakai') !!}
						<div class="row">
							<div class="col-md-4">
								{!! form_input('terpakai_l',$edit_data['terpakai_l'],'class="form-control form-control-sm laki-laki" id="terpakai_l" placeholder="Bed Terpakai Laki-laki" required') !!}
							</div>
							<div class="col-md-4">
								{!! form_input('terpakai_p',$edit_data['terpakai_p'],'class="form-control form-control-sm perempuan" id="terpakai_p" placeholder="Bed Terpakai Perempuan" required') !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! form_submit('save','Simpan','class="btn btn-primary btn-sm"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning btn-sm"') !!}
						{!! anchor(base_url('panel/rumah_sakit/bed'),'Back','class="btn btn-danger sm"') !!}
					</div>
				</div>
				{!! form_close() !!}
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	@include('partials.toastr_msg')
	<script type="text/javascript">
		var laki=$('.laki-laki');
		var perempuan=$('.perempuan');
		var k_l=$('#kapasitas_l');
		var k_p=$('#kapasitas_p');
		var p_l=$('#terpakai_l');
		var p_p=$('#terpakai_p');
		function reset_input(){
			k_l.val('0');
			k_p.val('0');
			p_l.val('0');
			p_p.val('0');
		}
		var changed=0;
		$('#kelas').change(function(event){
			console.log($(this).find(':selected').attr('data-unigender'));
			if($(this).find(':selected').attr('data-unigender')==1){
				perempuan.hide();
				k_l.attr('placeholder','Kapasitas');
				p_l.attr('placeholder','Terpakai');
				if(changed>0)
					reset_input();
			}else{
				perempuan.show();
				k_l.attr('placeholder','Kapasitas Bed Laki-laki');
				p_l.attr('placeholder','Terpakai Bed Laki-laki');
				if(changed>0)
					reset_input();
			}
			changed++;
		});
		$('#kelas').trigger('change');
	</script>
@endsection
