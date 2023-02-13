@extends('layouts.app')

@if (isset($extend)) @include('indexs.'.$mod) @endif
@section('body')

<!-- [ navigation menu ] end -->
<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        @if (isset($import))
          <div class="float-left m-r-10">
            <span class="btn btn-inverse" onclick="$('#importForm').show()"><i class="feather icon-arrow-up"></i> Impor</span>
          </div>
        @endif
          <div class="float-left m-r-10"><a href="{{ route($mod.'Create') }}" onclick="return formOpen(this)" class="btn btn-primary btn-create text-center">
            <i class="feather icon-plus"></i></a>
          </div>
          <div class="float-left"><h4 class="p-t-5">{{ $title }}</h4></div>
            <ul class="breadcrumb breadcrumb-title pull-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard')}}"><i class="feather icon-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route($mod) }}">{{ $title }}</a></li>
            </ul>
          <div class="clearfix p-t-10"></div>
        <div class="page-body">
          <!-- [ page content ] start -->
          <div class="panel-form"></div>
          <div class="panel-alert"></div>

          @if (isset($import))
          <div class="row" id="importForm" style="display: none">
            <div class="col-lg-6 col-md-6 col-sm-12">

              <form action="{{ route($mod.'Import') }}" enctype="multipart/form-data" method="post">
              @csrf
              <div class="card">
                <div class="card-block">
                  <h4 class="m-b-20">Impor Data</h4>
                   <div class="form-group">
                      <label for="import">File Excel</label>
                      <input type="file" name="import_file" id="import" required/>
                  </div>

                  <div class="m-t-10">
                    <a href="{{ asset('template/'.$mod.'.xlsx') }}" target="_blank" class="text text-info"><i class="feather icon-file"></i> Template {{ $title }}</a>
                  </div>
                </div>
              <div class="card-block" style="border-top: 1px dashed #ccc">
                  <button class="btn btn-inverse pull-left" onclick="$('#importForm').hide()"><i class="fas fa-remove"></i> Tutup</button>
                  <button type="submit" class="btn btn-warning pull-right"><i class="feather icon-arrow-up"></i> Impor</button>
                  <div class="clearfix"></div>
              </div>
              </form>
              </div>
            </div>
          </div>
          @endif

          <div class="row panel-table">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-block">
                  @yield('indexFilter')
                  <table class="table table-bordered table-condensed" id="dataTable">
                      <thead>
                          <tr>
                              <th width="20">NO</th>
                              @foreach($col as $a => $b)
                              <th>{{$a}}</th>
                              @endforeach
                              <th width="80"></th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>

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
@include('scripts.datatable')
<script type="text/javascript">
    initTable = function()
    {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route($mod.'Table') }}',
                type: "GET",
                data: {
                  @yield('dataTableScript')
                }
            },
            language: {
                url: "{{ asset('dt/indonesia.json')}}"
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                @foreach($col as $a => $b)
                { data: '{{ $b }}', name: '{{ $b }}' },
                @endforeach
                { data: 'aksi', name: 'aksi', searchable: false, orderable: false, class: 'no-wrapping'}
            ],
            order: [[ 1, "asc" ]]
        })
    }

    drawTable = function()
    {
        $('#dataTable').DataTable().destroy()
        initTable()
    }

    initTable();


    @if (session()->has('success'))
      successSet('{!! session('success') !!}')
    @endif

</script>

@yield('indexScript')

@stop
