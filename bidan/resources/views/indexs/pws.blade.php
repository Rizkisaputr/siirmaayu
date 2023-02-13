@extends('layouts.app')

@if (isset($extend)) @include('indexs.'.$mod) @endif
@section('body')

<style>
.rotate {
  transform: rotate(-90deg);
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>

<!-- [ navigation menu ] end -->
<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <form action="{{ route($mod.'Table') }}" method="get" target="_blank">
        @csrf
        <input type="hidden" name="print" value="true"/>
          <div class="float-left"><h4 class="p-t-5">{{ $title }}</h4></div>
          <div class="float-left m-l-10">
            <button type="submit" class="btn btn-primary btn-create text-center">
          <i class="feather icon-file"></i> Cetak</button></div>
            <ul class="breadcrumb breadcrumb-title pull-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard')}}"><i class="feather icon-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route($mod) }}">{{ $title }}</a></li>
            </ul>
          <div class="clearfix p-t-10"></div>
        <div class="page-body">
          @if (session()->has('success'))
          <div class="alert alert-success">{!! session('success') !!}</div>
          @endif
        </div>
          <!-- [ page content ] start -->
          <div class="panel-form"></div>
          <div class="panel-alert"></div>
          <div class="row panel-table">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-block">
                  <div class="form-inline pull-right ">
                    <div class="width-200 m-r-10">
                      <select name="puskesmas" id="puskesmas" class="form-control"></select>
                    </div>
                    <div class="width-200 m-r-10">
                      <select name="bulan" id="bulan" class="form-control default-select2">
                        @foreach($cbBln as $c => $d)
                          <option value="{{ $c }}">{{ $d }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="width-100">
                      <select name="tahun" id="tahun" class="form-control default-select2">
                        @foreach($cbThn as $t)
                          <option value="{{ $t }}" @if ($t == $thn) selected @endif>{{ $t }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="table-responsive p-10" style="width: 100%">
                  <table class="table table-bordered table-condensed" id="dataTable">
                      <thead>
                          <tr>
                              <th width="20" rowspan="3">NO</th>
                              <th rowspan="3" colspan="2">WILAYAH</th>
                              @foreach(array(
                                'SASARAN',
                                'K1',
                                'K4',
                                'PERSALINAN OLEH NAKES',
                                'KF LENGKAP',
                                'DETEKSI KOMPLIKASI OLEH NAKES (DKN)',
                                'PENANGANAN KOMPLIKASI OBSTETRIK (PK)',
                                'PELAYANAN KB (CPR)'
                              ) as $a)
                              <th colspan="4">{{ $a }}</th>
                              @endforeach
                          </tr>
                          <tr>
                            @foreach(array('BUMIL','BULIN','BAYI','BALITA') as $a)
                              <td rowspan="2" height="150" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">{{ $a }}</div></td>
                            @endforeach
                            @foreach(array(1,2,3,4,5,6,7) as $a)
                            <td rowspan="2" height="130" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">BLN LALU</div></td>
                            <td rowspan="2" height="130" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">BLN INI</div></td>
                            <td colspan="2">KOMULATIF</td>
                            @endforeach
                          </tr>
                          <tr>
                          @foreach(array(1,2,3,4,5,6,7) as $a)
                            <td>ABS</td>
                            <td>%</td>
                          @endforeach
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
          <!-- [ page content ] end -->
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('script')
<script type="text/javascript">

$(document).ready(function() {
  $('.default-select2').select2({ width: '100%' }).on('select2:select', function (e) {
    initTable()
  });
})
initTable = function()
{
$.ajax({
    url: '{{ route('pwsTable') }}',
    cache: false,
    data: {
      bulan: $('#bulan').val(),
      tahun: $('#tahun').val(),
      puskesmas: $('#puskesmas').val()
    },
    beforeSend: function() {
      loaderSet('Memuat ...');
    },
    success: function(result) {
      loaderUnset();
      $('#dataTable tbody').html(result);
    },error:function(xhr, ajaxOptions, thrownError){
      console.log(JSON.stringify(xhr));
    }
});
}

@foreach(array(
  'Puskesmas' => 'puskesmas'
) as $a => $b)
$('#{{ $b }}').select2({
  width: '100%',
  placeholder: 'Pilih {{ $a }} ...',
  ajax: {
      url: '{{ route($b.'Dropdown') }}',
      dataType: 'json',
      type: "GET",
      data: function (q) {
        var param = {
          term: q.term
        }
        return param
      },
      processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
          return { text: item.text, id: item.id }
        })
      }
    },
    }
}).on('select2:select', function (e) {
  initTable()
})

@endforeach

initTable();
</script>

@stop
