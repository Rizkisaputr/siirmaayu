@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	  <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;"><b>Dashboard : </b></a></li>
        <li class="breadcrumb-item active">Rujukan Balik</li>
      </ol>
	  <h1 class="page-header f-s-14 f-w-500"><b>Resume Medis Pasien Masuk</b></h1>
	  <div class="row">
	    <!-- ./col -->
	    <div class="col-md-12">
	      <div class="panel panel-inverse">
	      	<div class="row">
	      		<div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Pasien</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['pasien'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Alasan Rujukan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['Alasan Rujukan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Kesadaran</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['kesadaran'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Tensi</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['tensi'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Nadi</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['nadi'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Suhu</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['suhu'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Pernafasan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['pernafasan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Diagnosis</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['diagnosis'] or '-'}}</dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">GCS</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['nyeri'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Keterangan Lain</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['Keterangan Lain'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Hasil Lab</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['Hasil Lab'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Hasil Radiologi</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['Hasil Radiologi'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Tindakan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['tindakan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Status Rujukan</dt>
	                <dd class="col-sm-8" style="color: red;">{{ $detil_rujukan['Status Rujukan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Dibuat</dt>
	                <dd class="col-sm-8" style="color: red;">{{ date('d M Y H:i:s',strtotime($detil_rujukan['dibuat'])) }}</dd>
	                <dt class="col-sm-4 text-truncate">Perujuk</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['perujuk'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Tujuan Rujukan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['dirujuk'] or '-'}} 
	                	@if ($detil_rujukan['pengalih'] != NULL)
	                		<i>(Dialihkan dari {{ $detil_rujukan['pengalih'] }})</i>
	                	@endif
	                </dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Kelas Bed</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['Kelas Bed'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Layanan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['Layanan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Transportasi</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['transportasi'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Pembiayaan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['pembiayaan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Lampiran 1</dt>
	                <dd class="col-sm-8">
	                	@if ($detil_rujukan['attachment_1'] != NULL)
	                		<a href="{{ load_asset('public/'.$detil_rujukan['attachment_1']) }}" type="" class="btn btn-primary btn-xs" target="_blank">Download</a>
	                	@else
	                		Tidak Ada
	                	@endif
					</dd>
	                <dt class="col-sm-4 text-truncate">Lampiran 2</dt>
	                <dd class="col-sm-8">@if ($detil_rujukan['attachment_2'] != NULL)
	                		<a href="{{ load_asset('public/'.$detil_rujukan['attachment_2']) }}" type="" class="btn btn-primary btn-xs" target="_blank">Download</a>
	                	@else
	                		Tidak Ada
	                	@endif
	                </dd>
	                <dt class="col-sm-4 text-truncate">Lampiran 3</dt>
	                <dd class="col-sm-8">@if ($detil_rujukan['attachment_3'] != NULL)
	                		<a href="{{ load_asset('public/'.$detil_rujukan['attachment_3']) }}" type="" class="btn btn-primary btn-xs" target="_blank">Download</a>
	                	@else
	                		Tidak Ada
	                	@endif</dd>
	                <dt class="col-sm-4 text-truncate">Hasil Lab</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['Hasil Lab'] or '-'}}</dd>
	              </dl>
		        </div>	
		    </div>
	        
	        <!-- /.box-body -->
	      </div>
	      <!-- /.box -->
	    </div>
	    <!-- ./col -->
	  </div>
	  <!-- /.row -->
	  <h1 class="page-header f-s-14 f-w-500"><b>Form Rujukan Balik</b></h1>
	  <div class="row">
	  	  <div class="col-lg-12">
	        <div class="panelruj3 panel-inverse">
	          <div class="panel-body form-horizontal">
	            <form action="" method="post" accept-charset="utf-8">
	              <div class="form-group">
	                {!! form_label('Status Rujukan  Balik   :  ','status rujukan balik') !!}
                    <select name="rujukbalik_status" class="form-control combo-box" id="status_rujukan" placeholder="Status Pasien" style="width: 32%">
                      <option value="Pulang">Pulang</option>
                      <option value="Meninggal Dunia">Meninggal Dunia</option>
                      <option value="Batal">Batal</option>
                    </select>
	              </div>
	              <div class="form-group">
	                <label for="tanggal" class="txt-tgl-tindakan">Tanggal Tindakan</label>
                	<div class="input-group" style="width: 80px">
                  	<input type="date" class="datepicker" name="rujukbalik_tanggal" id="date">
                  	<!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="tindakan" class="">Tindakan</label>
	                <textarea name="rujukbalik_tindakan" cols="40" rows="1" class="form-control" id="tindakan" style="width: 40%"></textarea>
	              <div class="form-group">
	                <label for="diagnosa" class="">Diagnosa / Alasan</label>
	                <textarea name="rujukbalik_diagnosa" cols="40" rows="1" class="form-control" id="diagnosa" required style="width: 40%"></textarea>
	              </div>
	              <div class="box-fu">
	              <div class="form-group">
		                <label for="tgl_fu" class="">Tanggal Follow UP</label>
	                	<div class="datepicker" style="width: 80px">
	                  	<input type="date" class="datepicker" name="rujukbalik_fu_tanggal" id="date">
	                  	<!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
              		    </div>
	              </div>
	              	<div class="form-group">
		                <label for="tempat_fu" class="">Tempat Follow UP</label>
		                {!! form_dropdown('rujukbalik_fu_id',$selection_namars,'','class="form-control default-select2" id="tempat_fu" style="width: 40%"') !!}
		            </div>
	              </div>

	              <div class="box-footer">
	                <input type="submit" name="save" value="Simpan" class="btn btn-primary">
	                <input type="reset" name="reset" value="Reset" class="btn btn-warning">
	                <!--<a href="" class="btn btn-danger">Back</a>-->
	                {!! anchor(base_url('panel/data_rujukan'),'<i class="fas fa-arrow-alt-circle-left"></i> Back','class="btn btn-danger"') !!}
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
	  </div>
</div>
@endsection

@section('script')
	@include('partials.toastr_msg')

	<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script src="{{load_asset('bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.combo-box').select2();
			$('#tgl_fu, #tanggal').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });
			$('#status_rujukan').change(function() {
				if ($(this).val() == "Meninggal Dunia" || $(this).val() == "Batal" )
				{
					$('.txt-tgl-tindakan').html('Tanggal Meninggal / Batal');
					$('.box-fu').hide();
				} else {
					$('.txt-tgl-tindakan').html('Tanggal Tindakan');
					$('.box-fu').show();
				}
			});
		});
	</script>
@endsection

@section('head')
<link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection

<style type="text/css">
	.dl-horizontal dt {
		text-align: left !important;
	}
	.dl-horizontal dd {
	    margin-left: 160px!important;
	}
</style>
