@extends('layouts.form')
@section('formBody')
    @foreach(array(
      'Kecamatan' => 'kecamatan',
      'Desa' => 'desa'
    ) as $a => $b)
    <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{$a}}</label>
        <div class="col-sm-8">
          <select name="{{$b}}_id" class="form-control" id="f{{$b}}">
            @if ($b == "kecamatan" and isset($def) and $def->desa->kecamatan != null)
              <option value="{{ $def->desa->kecamatan->id }}" selected>{{ $def->desa->kecamatan->kode.' '.$def->desa->kecamatan->nama_kecamatan }}</option>
            @endif
            @if ($b == "kabupaten" and isset($def) and $def->kabupaten != null)
              <option value="{{ $def->desa->id }}" selected>{{ $def->desa->kode.' '.$def->desa->nama_desa }}</option>
            @endif
          </select>
        </div>
    </div>
    @endforeach
    @foreach(array(
      'Kode' => 'kode',
      'Nama Posyandu' => 'nama_posyandu') as $n => $m)
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
      'Kecamatan' => 'kecamatan',
      'Desa' => 'desa'
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
              @if ($b == "kecamatan" and $kabupaten != null) kabupaten: {{ $kabupaten->id }},@endif
              @if ($b == "desa") kecamatan: $('#fkecamatan').val() @endif
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
