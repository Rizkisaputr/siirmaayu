@extends('layouts.panel_layout')

@section('content')

<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Target PWS KIA</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header f-s-14 f-w-500">Data Target PWS KIA <span class="label label-danger"> ({{ $rs->nama}})</span></h1>
    <div class="wrapper bg-silver-lighter">
        <!-- begin btn-toolbar -->
        <div class="btn-toolbar">
            <div class="form-group m-r-5">
                <form method="post" id="form_bulan">
                <select class="default-select2 form-control form-control-sm pull-left" name="tahun" onchange="$(this).parent().submit()"  style="width: 120px;">
                    <option>Pilih Tahun</option>
                    @foreach($cb_tahun as $t)
                    <option value="{{ $t }}" @if ($t == $thn_selected) selected @endif>{{ $t }}</option>
                    @endforeach
                </select>
                <select class="default-select2 form-control form-control-sm pull-left" name="bulan" onchange="$(this).parent().submit()"  style="width: 150px;">
                    <option>Pilih Bulan</option>
                    @foreach($cb_bulan as $no => $bln)
                    <option value="{{ $no }}" @if ($no == $bln_selected) selected @endif>{{ $bln }}</option>
                    @endforeach
                </select>
                <div class="pull-right">
                <a href="{{ site_url('panel/rujukan/pwskia') }}" class="btn btn-inverse"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <!-- end btn-toolbar -->
    </div>

    <form method="post" id="form_isian">
    <input type="hidden" name="bulan" value="{{ $bln_selected }}">
    <input type="hidden" name="tahun" value="{{ $thn_selected }}">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="table-basic-5">
                <div class="panel-body">
                <!-- masukkan inputannya disini -->
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2">Desa</th>
                                <th colspan="2" class="text-center">K1</th>
                                <th rowspan="2">K4</th>
                                <th rowspan="2">Linakes <br> Total</th>
                                <th rowspan="2">Kunjungan Nifas (KF 3)</th>
                                <th colspan="2" class="text-center">Kunjungan Neonatus</th>
                                <th colspan="2" class="text-center">Bumil Resti</th>
                                <th colspan="2" class="text-center">Kompilasi Ditangani</th>
                                <th colspan="2" class="text-center">Kunjungan Sesuai Standar</th>
                                <th colspan="2" class="text-center">MTBS</th>
                                <th rowspan="2" class="text-center">JML KB Baru</th>
                            </tr>
                            <tr>
                                <th>Akses</th>
                                <th>Murni</th>
                                <th>KN1</th>
                                <th>KN lgkp</th>
                                <th>Masy</th>
                                <th>Nakes</th>
                                <th>Bumil</th>
                                <th>Neo</th>
                                <th>Bayi 11 Bln</th>
                                <th>Balita 1-5 Thn</th>
                                <th>Ditangani Sesuai Standar</th>
                                <th>Seluruh Pasien Balita</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($desa->result() as $d)
                            <tr>
                                <td>{{ $d->desa }}</td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][akses]" class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['akses'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][murni]" class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['murni'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][k4]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['k4'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][linakes]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['linakes'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][kf3]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['kf3'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][kn1]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['kn1'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][kn_lgkp]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['kn_lgkp'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][masy]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['masy'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][nakes]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['nakes'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][bumil]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['bumil'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][neo]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['neo'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][bayi11]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['bayi11'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][balita]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['balita'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][ditangani]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['ditangani'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][total_balita]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['total_balita'] or null }}"></td>
                                <td><input type="text" name="isian[{{$d->id_desa}}][kb_baru]"class="text-custom form-control form-control-sm m-0" autocomplete="off" value="{{ $parse[$d->id_desa]['kb_baru'] or null }}"></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><b>{{ strtoupper($rs->nama) }}<br>#TOTALDATA</b></td>
                                @foreach($total as $a => $b)
                                <td>{{ $b }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    </div>            
                </div>    
            </div>
        </div>
    </div>
    </form>
</div>
<footer class="footer-content bg-silver">
    <div class="pull-left">
        <div class="dropdown">
            <a href="{{ site_url('panel/rujukan/pwskia') }}" class="btn btn-sm btn-warning">
              <i class="fas fa-arrow-alt-circle-left"></i>
              Back
            </a>
        </div>
    </div>
    <div class="pull-right">
        <div class="dropdown">
            <button type="submit" class="btn btn-sm btn-success" onclick="$('#form_isian').submit()">
              Simpan Perubahan
              <i class="fas fa-arrow-alt-circle-right"></i>
            </button>
        </div>
    </div>
    <div class="clearfix"></div>
</footer>
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

    <style type="text/css">
        .text-custom {
            width: 40px;
            font-size: 10px;
        }
    </style>
@endsection

@section('head')
    <link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection


