@extends('layouts.form')
@section('formBody')
    @foreach(array(
      'Nama Bidan' => 'nama_bidan',
      'NIP' => 'nip',
      'Telepon' => 'telp') as $n => $m)
        <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{ $n }}</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif" placeholder="" autocomplete="off">
        </div>
        </div>
    @endforeach
    <div class="form-group row">
      <label class="col-sm-4 col-form-label text-right">Alamat</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="alamat" rows="3">@if (isset($def)){{ $def->alamat }}@endif</textarea>
        </div>
    </div>

@endsection
