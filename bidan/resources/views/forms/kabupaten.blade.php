@extends('layouts.form')
@section('formBody')
    <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">Propinsi</label>
        <div class="col-sm-8">
          <select name="provinsi_id" class="form-control" id="provinsi"></select>
        </div>
    </div>
    @foreach(array(
      'Kode' => 'kode',
      'Nama Provinsi' => 'nama_kabupaten') as $n => $m)
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
      'Provinsi' => 'provinsi'
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
      drawTable()
    });

    @endforeach
  })
</script>

@endpush
