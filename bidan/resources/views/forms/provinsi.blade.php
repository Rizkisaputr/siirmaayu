@extends('layouts.form')
@section('formBody')

    @foreach(array(
      'Kode' => 'kode',
      'Nama Provinsi' => 'nama_provinsi') as $n => $m)
        <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{ $n }}</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif" placeholder="" autocomplete="off">
        </div>
        </div>
    @endforeach


@endsection
