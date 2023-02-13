@extends('layouts.panel_layout')

@section('content')
{!! form_open_multipart() !!}

<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">@if (isset($edit_data)) Edit @else Tambah @endif Rujukan PSC</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header f-s-14 f-w-500">@if (isset($edit_data)) Edit @else Tambah @endif Rujukan PSC</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="panelruj panel-inverse" data-sortable-id="table-basic-5">
                <div class="panel-body">
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">FIRST Responder</label>
                            <div class="col-md-10">
                                {!! form_dropdown('id_rs',$dirujuk,(isset($edit_data)?$edit_data['id_rs']:null),'class="form-control default-select2" id="id_rs" required style="width: 100%"') !!}
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <label class="col-md-2 col-form-label">Media Laporan</label>
                            <div class="col-md-10">
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="media_laporan" id="inlineCssRadio1" value="Dispatch NCC" @if (isset($edit_data) and $edit_data['media_laporan'] == "Dispatch NCC") checked @endif />
                                    <label for="inlineCssRadio1">Dispatch NCC</label>
                                </div>
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="media_laporan" id="inlineCssRadio2" value="Telp CC PSC" @if (isset($edit_data) and $edit_data['media_laporan'] == "Telp CC PSC") checked @endif/>
                                    <label for="inlineCssRadio2">Telp CC PSC</label>
                                </div>
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="media_laporan" id="inlineCssRadio2" value="SMS" @if (isset($edit_data) and $edit_data['media_laporan'] == "SMS") checked @endif/>
                                    <label for="inlineCssRadio2">SMS</label>
                                </div>
                                <div class="radio radio-css radio-inline">
                                    <input type="radio" name="media_laporan" id="inlineCssRadio2" value="Whatsapp" @if (isset($edit_data) and $edit_data['media_laporan'] == "Whatsapp") checked @endif/>
                                    <label for="inlineCssRadio2">Whatsapp</label>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Nomor Kontak Pelapor</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" name="kontak_pelapor" placeholder="Nomor Telepon" value="{{(isset($edit_data)?$edit_data['kontak_pelapor']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Nama Pelapor</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="Nama Pelapor" name="nama_pelapor" value="{{(isset($edit_data)?$edit_data['nama_pelapor']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Instansi</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="Instansi" name="instansi" value="{{(isset($edit_data)?$edit_data['instansi']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Kategori Pelapor</label>
                            <div class="col-md-10">
                                {!! form_dropdown('kategori_pelapor',$kategori_pelapor,(isset($edit_data)?$edit_data['kategori_pelapor']:null),'class="form-control default-select2" id="kategori_pelapor" required style="width: 100%"') !!}
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Lokasi Kejadian</label>
                            <div class="col-md-10">
                                <textarea class="form-control form-control-sm" rows="3" name="lokasi">{{(isset($edit_data)?$edit_data['lokasi']:null)}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Kategori Pasien</label>
                            <div class="col-md-10">
                               {!! form_dropdown('kategori_psc',$kategori_psc_select,(isset($edit_data)?$edit_data['kategori_psc']:null),'class="form-control default-select2" id="kategori_psc" required style="width: 100%"') !!}
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Nama Penderita</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="Nama Penderita" name="nama_penderita" value="{{(isset($edit_data)?$edit_data['nama_penderita']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Perkiraan Umur</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="Perkiraan Umur" name="perkiraan_umur" value="{{(isset($edit_data)?$edit_data['perkiraan_umur']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Nama dan Kontak Keluarga</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="" name="kontak_keluarga" value="{{(isset($edit_data)?$edit_data['kontak_keluarga']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Golongan Darah</label>
                            <div class="col-md-10">
                                {!! form_dropdown('goldarah',$goldarah_select,(isset($edit_data)?$edit_data['goldarah']:null),'class="form-control default-select2" id="goldarah" style="width: 100%"') !!}
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Transportasi Diperlukan</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="Transportasi" name="transportasi" value="{{(isset($edit_data)?$edit_data['transportasi']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Kondisi Fisik, Dx</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="Kondisi Fisik" name="kondisi_fisik" value="{{(isset($edit_data)?$edit_data['kondisi_fisik']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Tindakan Pertolongan Pertama</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-sm m-b-5" placeholder="Tindakan" name="tindakan" value="{{(isset($edit_data)?$edit_data['tindakan']:null)}}">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-2">Asuransi/Biaya</label>
                            <div class="col-md-10">
                               {!! form_dropdown('pembiayaan',$pembiayaan_select,'','class="form-control default-select2"') !!}
                            </div>
                        </div>
                </div>            
            </div>    
        </div>
    </div>
</div>
<footer class="footer-content bg-silver">
    <div class="pull-left">
        <div class="dropdown">
            <a href="{{ site_url('panel/rujukan/psc') }}" class="btn btn-sm btn-warning">
              <i class="fas fa-arrow-alt-circle-left"></i>
              Back
            </a>
        </div>
    </div>
    <div class="pull-right">
        <div class="dropdown">
            <button type="submit" class="btn btn-sm btn-success">
              @if (isset($edit_data)) Edit @else Tambah @endif Data
              <i class="fas fa-arrow-alt-circle-right"></i>
            </button>
        </div>
    </div>
    <div class="clearfix"></div>
</footer>
 {!! form_close() !!}
@endsection

@section('script')
    @include('partials.toastr_msg')
    <!-- InputMask -->
    <script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('.default-select2').select2();
        });
    </script>
@endsection

@section('head')
    <link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection


