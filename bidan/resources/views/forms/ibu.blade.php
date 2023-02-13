@extends('layouts.form')
@section('formBody')

<div class="row">
  <div class="col-lg-6">
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">Puskesmas</label>
      <div class="col-sm-8">
        <select name="puskesmas_id" class="form-control" id="puskesmas">
          @if (isset($def) and $def->puskesmas != null)
            <option value="{{ $def->puskesmas->id }}" selected>{{ $def->puskesmas->nama_puskesmas }}</option>
          @endif
        </select>
      </div>
    </div>
    @foreach(array(
      'No Registrasi' => 'no_registrasi') as $n => $m)
        <div class="form-group row">
        <label class="col-sm-4 col-form-label">{{ $n }}</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif">
        </div>
        </div>
    @endforeach
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Tanggal Registrasi</label>
        <div class="col-sm-8">
          <div class="input-group">
          <input type="text" class="form-control datepicker" name="tgl_register" value="@if (isset($def)){{ $def->tgl_register }}@endif">
          <label class="input-group-text"><i class="feather icon-calendar"></i></label>
          </div>
        </div>
    </div>

  </div>
  <div class="col-lg-6">
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">Bidan</label>
      <div class="col-sm-8">
        <select name="bidan_id" class="form-control" id="bidan">
          @if (isset($def) and $def->bidan != null)
            <option value="{{ $def->bidan->id }}" selected>{{ $def->bidan->nama_bidan }}</option>
          @endif
        </select>
      </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">Posyandu</label>
      <div class="col-sm-8">
        <select name="posyandu_id" class="form-control" id="posyandu">
          @if (isset($def) and $def->posyandu != null)
            <option value="{{ $def->posyandu->id }}" selected>{{ $def->posyandu->nama_posyandu }}</option>
          @endif
        </select>
      </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">Kader</label>
      <div class="col-sm-8">
        <select name="kader_id" class="form-control" id="kader">
          @if (isset($def) and $def->kader != null)
            <option value="{{ $def->kader->id }}" selected>{{ $def->kader->nama_kader }}</option>
          @endif
        </select>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-lg-6">
    @foreach(array(
      'Nama Ibu' => 'nama_ibu',
      'Nama Suami' => 'nama_suami') as $n => $m)
        <div class="form-group row">
        <label class="col-sm-4 col-form-label">{{ $n }}</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif">
        </div>
        </div>
    @endforeach
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-8">
          <div class="input-group">
          <input type="text" class="form-control datepicker" name="tgl_lahir" value="@if (isset($def)){{ $def->tgl_lahir }}@endif">
          <label class="input-group-text"><i class="feather icon-calendar"></i></label>
          </div>
        </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Alamat Domisili</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="alamat" rows="3">@if (isset($def)){{ $def->alamat }}@endif</textarea>
        </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">RT/RW</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="rt" value="@if (isset($def)){{ $def->rt }}@endif" placeholder="RT">
    </div>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="rw" value="@if (isset($def)){{ $def->rw }}@endif" placeholder="RW">
    </div>
    </div>

  </div>
  <div class="col-lg-6">

    @foreach(array(
      'No Telp/HP' => 'telp',
      'NIK Ibu' => 'nik',
      'Nomor KK' => 'nkk'
      ) as $n => $m)
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">{{ $n }}</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif">
    </div>
    </div>
    @endforeach
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">Agama</label>
      <div class="col-sm-8">
        <select name="agama" class="form-control default-select2">
          <option value="">Pilih Agama</option>
          @foreach($ddown['agama'] as $a => $b)
            <option value="{{ $a }}" @if (isset($def) and $def->agama == $a) selected @endif>{{ $b }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-4 col-form-label">Pembiayaan</label>
      <div class="col-sm-8">
        <select name="pembiayaan" class="form-control default-select2">
          <option value="">Pilih Pembiayaan</option>
          @foreach($ddown['pembiayaan'] as $a => $b)
            <option value="{{ $a }}" @if (isset($def) and $def->pembiayaan == $a) selected @endif>{{ $b }}</option>
          @endforeach
        </select>
      </div>
    </div>
    @foreach(array(
      'Disabilitas' => 'disabilitas') as $n => $m)
        <div class="form-group row">
        <label class="col-sm-4 col-form-label">{{ $n }}</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif">
        </div>
        </div>
    @endforeach
  </div>


</div>
@endsection

@push('formScript')
@include('scripts.flatpickr')
<script type="text/javascript">
    $(document).ready(function() {
      $('.default-select2').select2()
      $('.datepicker').flatpickr({
          altInput: true,
          altFormat: 'j F Y',
          dateFormat: 'Y-m-d',
      })
    })

    @foreach(array(
      'Puskesmas' => 'puskesmas',
      'Posyandu' => 'posyandu',
      'Kader' => 'kader',
      'Bidan' => 'bidan'
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
    })

    @endforeach
</script>

@endpush
