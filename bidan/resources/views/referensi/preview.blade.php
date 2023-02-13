@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item">Pengaturan</li>
        <li class="breadcrumb-item active">Bidang</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header f-s-14 f-w-500">Bidang</h1>

    <div class="panel-form"></div>

    <div class="panel-import" style="display: none">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <form action="{{ route('bidangPreview') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        </div>
                        <h4 class="panel-title">
                            Import Bidang
                        </h4>
                    </div>
                    <div class="card-body">
                         <div class="form-group">
                            <label for="import">File Excel</label>
                            <input type="file" name="import_file" id="import" required/>
                        </div>
                    </div>
                    <div class="card-body" style="border-top: 1px dashed #ccc">
                        <button class="btn btn-default pull-left btn-close" onclick="return importClose()"><i class="fas fa-remove"></i> Tutup</button>
                        <button type="submit" class="btn btn-info pull-right btn-save">Impor Bidang</button>
                        <div class="clearfix"></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-inverse panel-table">



<div class="wrapper bg-silver-lighter panel-header panel-table">
    <div class="btn-toolbar m-l-50 pull-right">
      <button class="btn btn-info btn-sm m-r-5" onclick="importOpen(this)">
          <i class="fas fa-download"></i> Impor
      </button>

        <a href="{{ route('bidangCreate') }}" onclick="return formOpen(this)" class="btn btn-sm btn-success btn-create">
          <i class="fas fa-plus"></i>
          Bidang
        </a>
    </div>
    <div class="clearfix"></div>
</div>
<div class="panel-alert"></div>
<div class="panel-body">
    <table class="table table-bordered table-condensed" id="dataTable">
        <thead>
            <tr>
                <th width="5">#</th>
                <th>Nama Bidang</th>
                <th>Desa</th>
            </tr>
        </thead>
        <tbody>
          @foreach($row_all as $no => $r)
            <tr>
            @foreach($r as $e)
              <td>{{ $e }}</td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
    </table>
      <form action="{{ route('bidangImport') }}" method="post">
        @csrf
        <input type="hidden" name="berkas" value="{{ $berkasname }}">
        <button type="submit" class="btn btn-info pull-right btn-save" onclick="$(this).attr('disabled','disabled').html('Proses Import ...')">Impor Data</button>
      </form>
</div>

</div>
</div>

@stop
