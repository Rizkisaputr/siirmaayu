<style>
.rotate {

  transform: rotate(-90deg);
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>

<table class="table table-condensed table-bordered table-responsive" id="nifasTable">
  <tr>
    <th rowspan="2" class="text-center">TGL</th>
    <th rowspan="2" class="text-center">HARI KE/KF</th>
    <th colspan="2" class="text-center">TANDA VITAL</th>
    <th colspan="3" class="text-center">PELAYANAN</th>
    <th colspan="4" class="text-center">INTEGRASI</th>
    <th colspan="4" class="text-center">KOMPLIKASI</th>
    <th rowspan="2" class="text-center">KLASIFIKASI</th>
    <th rowspan="2" class="text-center">TATA<br>LAKSANA</th>
    <th colspan="5" class="text-center">DIRUJUK KE*</th>
    <th colspan="2" class="text-center">KEADAAN</th>
  </tr>
  <tr>
    @foreach(array(
      'TD (mmHg)',
      'Suhu <sub>o</sub>C',
      'Catat di Buku KIA*',
      'Fe (tab/botol)',
      'Vit. A*',
      'CD4 (kopi/ml)',
      'Anti Malaria',
      'Anti TB',
      'ARV',
      'PPP',
      'Infeksi',
      'HDK Lainnya',
      'PKM',
      'Klinik',
      'SIA/RSB',
      'RS',
      'Lainnya',
      'Tiba',
      '(H/M)'
      ) as $a)
    <th height="150" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">{!! $a !!}</div></th>
    @endforeach
  </tr>

  <tr>
  @php for($i = 1; $i <= 24; $i++) { @endphp
  <td class="text-center">{{ $i }}</td>
  @php } @endphp
  </tr>

  @if ($def == null)
  <tr>
    <td colspan="24" class="text-center">Tidak ada data Periksa ...</td>
  </tr>
  @endif

</table>

@push('formScript')
<script type="text/javascript">
@if ($def != null)
{{--
$('#anteNatalCareTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('anteNatalCareTable',$def) }}',
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
        { data: 'aksi', name: 'aksi', searchable: false, orderable: false, class: 'no-wrapping'}
    ],
    order: [[ 1, "asc" ]]
})

--}}
@endif
</script>
@endpush
