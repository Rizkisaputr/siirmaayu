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

.width-200 { width: 200px; }
.width-100 { width: 100px; }
.m-r-10 { margin-right: 10px }
</style>

<!-- [ navigation menu ] end -->
<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">

          <div class="float-left"><h4 class="p-t-5">{{ $title }}</h4></div>

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
                </div>
                <div class="card-block table-responsive">
                  @yield('indexFilter')
                  <form action="{{ route('targetWrite')}}" method="post" onsubmit="return formSave(this)">
                  @csrf
                  <table class="table table-bordered table-condensed" id="dataTable">
                      <thead>
                          <tr>
                              <th width="20">NO</th>
                              <th colspan="2">WILAYAH</th>
                              @foreach(array(
                                'K1',
                                'K4',
                                'PERSALINAN',
                                'KF',
                                'DKN',
                                'PK',
                                'CPR'
                              ) as $a)
                              <th>{{ $a }}</th>
                              @endforeach
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
                  <div class="pull-right">
                    <button class="btn btn-success btn-save"><i class="feather icon-save"></i> Simpan</button>
                  </div>
                  <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- [ page content ] end -->
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
    url: '{{ route('targetTable') }}',
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

formSave = function(i)
{
  $.ajax({
      url: $(i).attr('action'),
      type: "POST",
      data: $(i).serialize()+'&ajax=true',
      cache: false,
      dataType: "json",
      beforeSend: function() {
          $('.btn-save').attr('disabled','disabled').html('Menyimpan')
      },
      success: function(result) {
          if (result.status == true)
          {
              successSet(result.message);
          } else {
              failSet(result.message)
          }
          $('.btn-save').removeAttr('disabled').html('Simpan');
      },error:function(xhr, ajaxOptions, thrownError){
          console.log(JSON.stringify(xhr));
          $('.btn-save').removeAttr('disabled').html('Simpan');
      }
  });
  return false;
}

</script>

@yield('indexScript')

@stop
