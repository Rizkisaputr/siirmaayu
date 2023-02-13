@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Halaman : </a></li>
        <li class="breadcrumb-item active"><b>Menjawab Rujukan</b></li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500"><b>Resume Medis Pasien yang Dirujuk</b></h1>

	  <div class="row">
	  	<div class="col-md-12">
	  		@if ($detil_rujukan['type'] == 2)
	      <div class="panelruj1 panel-inverse">
	      	<div class="row">
	      		<div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Nama ibu</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['pasien'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">NIK ibu</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['nik'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Umur</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['umur'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Nama Suami</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['pasangan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Golongan Darah</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['goldarah'] or '-'}}</dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Nomor Bidan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['ibuanak_nobidan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Nama Bidan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['ibuanak_namabidan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Kode Praktik</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['ibukanak_kodebidan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Puskesmas Asal</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['perujuk'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Puskesmas Tujuan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['dirujuk'] or '-'}}</dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Diagnosa</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['diagnosis'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Kode ICDX</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['ibuanak_icdx'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Pemeriksaan Penunjang</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['alasan_rujukan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Tindakan Pra Rujukan</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['tindakan'] or '-'}}</dd>
	                <dt class="col-sm-4 text-truncate">Asuransi</dt>
	                <dd class="col-sm-8">{{ $detil_rujukan['pembiayaan'] or '-'}}</dd>
	              </dl>
		        </div>	
		    </div>
	        
	        <!-- /.box-body -->
	      </div>
	      <!-- /.box -->

	      @else 

	      <div class="panelruj2 panel-inverse">
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
	      @endif
	    </div>
	    <!-- ./col -->
	  </div>
      <!-- /.row -->
      <h1 class="page-header f-s-14 f-w-500"><b>Form Respon Jawaban Rujukan</b></h1>
      <div class="row">
      	  <div class="col-lg-12">
	        <div class="panel panel-inverse">
	          <div class="panel-body form-horizontal">
	            <form action="" method="post" accept-charset="utf-8">
	              <div class="form-group">
	                {!! form_label('Status Rujukan','status rujukan') !!}
                    <select name="status_rujukan" class="form-control form-control-sm" id="status_rujukan" placeholder="Status Rujukan" required style="width: 30%">
                      <option value="Diterima">Diterima</option>
                      <option value="Ditolak">Ditolak</option>
                      <option value="Dialihkan">Dialihkan ke RS lain</option>
                    </select>
	              </div>
	              <div class="form-group pengalih">
					 <label for="id_rs" class=""><b>Dialihkan ke : </b> </label>
                  	<input type="hidden" name="id_rs_pengalih" value="{{ $detil_rujukan['id_dirujuk'] }}">
					{!! form_dropdown('id_rs_dirujuk',$selection_rs,'','class="form-control form-control-sm" id="id_rs" required style="width: 30%"') !!}
				</div>
	              <div class="form-group">
	                <label for="info_rujuk_balik" class="">Advis / Alasan</label>
	                  <textarea name="info_rujuk_balik" cols="40" rows="3" class="form-control" id="info_rujuk_balik" placeholder="Advis/Alasan" required style="width: 30%"></textarea>
	              </div>
	              <div class="footer-content bg-silver">
	              	{!! anchor(base_url('panel/data_rujukan'),'<i class="fas fa-arrow-alt-circle-left"></i> Back','class="btn btn-sm btn-danger"') !!}
	                <input type="submit" name="save" value="Simpan" class="btn btn-primary btn-sm">
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#id_rs').select2();
			$('#status_rujukan').change(function() {
				if ($(this).val() == "Dialihkan")
				{
					$('.pengalih').show();
				} else {
					$('.pengalih').hide();
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

	.pengalih { display: none; }
</style>
