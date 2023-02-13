@section('dataTableScript')
  provinsi: $('#provinsi').val()
@endsection

@section('indexFilter')
<div class="row m-b-10">
  <div class="col-lg-6">
    <label>Filter Provinsi</label>
    <select name="provinsi" class="form-control" id="provinsi"></select>
  </div>
</div>
@endsection

@section('indexScript')
<script type="text/javascript">
  $(document).ready(function() {
    @foreach(array(
      'Provinsi' => 'provinsi'
    ) as $a => $b)
    $('#{{ $b }}').select2({
      width: '100%',
      placeholder: 'Semua Propinsi',
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

@endsection
