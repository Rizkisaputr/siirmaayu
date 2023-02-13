@extends('master')
@section('master_css')
@stack('css')
@yield('css')
@stop
@section('body')
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container no-navbar-wrapper">

    @include('partials.navbar')

    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content" id="appBox">
              <div class="main-body">
                <div class="row p-10 form-filter" style="background: #fff">
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <strong>Faskes Perujuk</strong>
                    <select id="perujukDropdown" class="form-control form-control-sm" style="width: 100%"></select>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <strong>Faskes Rujukan</strong>
                    <select id="rujukanDropdown" class="form-control form-control-sm" style="width: 100%"></select>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <strong>Periode</strong>
                    <select id="waktuDropdown" class="form-control" style="width: 100%">
                      @foreach($waktu as $a => $b)
                          <option value="{{ $a }}">{{ $b }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="page-wrapper">
                  <div class="page-body">
                    <div id="layer"></div>
                  </div>
                </div>
              </div>
            </div>

            <div id="styleSelector">
            </div>

        </div>
    </div>
</div>
@stop
@section('master_js')

<script type="text/javascript">
var init = function(i)
{
  $.ajax({
      url: '{{ route('chart') }}',
      type: "GET",
      data: {
        waktu: $('#waktuDropdown').val(),
        rujukan: $('#rujukanDropdown').val(),
        perujuk: $('#perujukDropdown').val()
      },
      cache: false,
      beforeSend: function() {
          $('#layer').html('<p class="text-center p-20" style="font-size: 20px"><i class="fa fa-spin fa-spinner"></i> Memuat ...</p>');
      },
      success: function(result) {
          $('#layer').html(result)
      },error:function(xhr, ajaxOptions, thrownError){
          console.log(JSON.stringify(xhr));
      }
  })
}

init();

</script>

@stack('js')
@yield('js')
@stop
