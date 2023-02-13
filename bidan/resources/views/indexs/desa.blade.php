@section('dataTableScript')
  provinsi: $('#provinsi').val()
@endsection

@section('indexFilter')
<div class="row">
  <div class="col-lg-6">
    @foreach(array(
      'Provinsi' => 'provinsi',
      'Kabupaten' => 'kabupaten',
      'Kecamatan' => 'kecamatan'
    ) as $a => $b)
    <div class="m-b-10">
      <label>{{$a}}</label>
      <select name="{{$b}}" class="form-control" id="{{$b}}"></select>
    </div>
    @endforeach
  </div>
</div>
@endsection

@section('indexScript')
<script type="text/javascript">
  $(document).ready(function() {
    @foreach(array(
      'Provinsi' => 'provinsi',
      'Kabupaten' => 'kabupaten',
      'Kecamatan' => 'kecamatan'
    ) as $a => $b)
    $('#{{ $b }}').select2({
      width: '100%',
      placeholder: 'Semua {{$a}}',
      ajax: {
          url: '{{ route($b.'Dropdown') }}',
          dataType: 'json',
          type: "GET",
          data: function (q) {
            var param = {
              term: q.term,
              @if ($b == "kabupaten") provinsi: $('#provinsi').val(), @endif
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

@endsection
