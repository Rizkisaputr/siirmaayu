@extends('layouts.form')
@section('formBody')
    @foreach(array(
      'Provinsi' => 'provinsi',
      'Kabupaten' => 'kabupaten',
      'Kecamatan' => 'kecamatan'
    ) as $a => $b)
    <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{$a}}</label>
        <div class="col-sm-8">
          <select name="{{$b}}_id" class="form-control" id="f{{$b}}">
            @if ($b == "provinsi" and isset($def) and $def->kecamatan->kabupaten != null)
              <option value="{{ $def->kecamatan->kabupaten->provinsi->id }}" selected>{{ $def->kecamatan->kabupaten->provinsi->kode.' '.$def->kecamatan->kabupaten->provinsi->nama_provinsi }}</option>
            @endif
            @if ($b == "kabupaten" and isset($def) and $def->kecamatan->kabupaten != null)
              <option value="{{ $def->kecamatan->kabupaten->id }}" selected>{{ $def->kecamatan->kabupaten->kode.' '.$def->kecamatan->kabupaten->nama_kabupaten }}</option>
            @endif
            @if ($b == "kecamatan" and isset($def) and $def->kecamatan != null)
              <option value="{{ $def->kecamatan->id }}" selected>{{ $def->kecamatan->kode.' '.$def->kecamatan->nama_kecamatan }}</option>
            @endif
          </select>
        </div>
    </div>
    @endforeach
    @foreach(array(
      'Kode' => 'kode',
      'Nama Puskesmas' => 'nama_puskesmas',
      'Alamat' => 'alamat',
      'Telp' => 'telp'
      ) as $n => $m)
        <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{ $n }}</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif" placeholder="" autocomplete="off">
        </div>
        </div>
    @endforeach


@endsection

@push('formScript')
@include('scripts.flatpickr')
<script type="text/javascript">
    $(document).ready(function() {

    @foreach(array(
      'Provinsi' => 'provinsi',
      'Kabupaten' => 'kabupaten',
      'Kecamatan' => 'kecamatan'
    ) as $a => $b)
    $('#f{{ $b }}').select2({
      width: '100%',
      placeholder: 'Pilih {{ $a }} ...',
      ajax: {
          url: '{{ route($b.'Dropdown') }}',
          dataType: 'json',
          type: "GET",
          data: function (q) {
            var param = {
              term: q.term,
              @if ($b == "kabupaten") provinsi: $('#fprovinsi').val() @endif
              @if ($b == "kecamatan") kabupaten: $('#fkabupaten').val() @endif
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
      drawTable()
    });

    @endforeach
  })
</script>

@endpush
