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

<table class="table table-condensed table-bordered table-responsive" id="anteNatalCareTable">
  <tr>
    <th rowspan="3" class="text-center">No.</th>
    <th colspan="4" class="text-center" rowspan="2">REGISTER</th>
    <th colspan="12" class="text-center">PEMERIKSAAN</th>
    <th colspan="5" class="text-center" rowspan="2">PELAYANAN</th>
    <th class="text-center" rowspan="3">KONSELING</th>
    <th class="text-center" rowspan="2" colspan="2">LABORATORIUM</th>
    <th class="text-center" colspan="15">INTEGRASI PROGRAM</th>
    <th class="text-center" colspan="6" rowspan="2">KOMPLIKASI</th>
    <th class="text-center" rowspan="3">TATA LAKSANA AWAL</th>
    <th class="text-center" colspan="5" rowspan="2">DIRUJUK KE</th>
    <th class="text-center" colspan="2" rowspan="2">KEADAAN</th>
    <th class="text-center" rowspan="3">KETERANGAN</th>
  </tr>
  <tr>
    <th colspan="7" class="text-center">IBU</th>
    <th colspan="5" class="text-center">BAYI</th>
    <th colspan="4" class="text-center">PMTCT</th>
    <th colspan="3" class="text-center">ALARIA</th>
    <th colspan="4" class="text-center">TB</th>
    <th colspan="4" class="text-center">SKRINING COVID-19</th>
  </tr>
  <tr>
    @foreach(array(
      'Tgl',
      'JKN',
      'Usia Kehamilan',
      'Trimester ke',
      ) as $a)
    <th height="150" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">{{ $a }}</div></th>
    @endforeach
    <th>Keluhan</th>
    @foreach(array(
    'BB (kg)',
    'TD (mmHg)',
    'LILA (cm)',
    'Status Gizi2',
    'TFU (cm)',
    'Refleks Patella (+/-)',
    'DJJ (x/menit)',
    'Kepala thd PAP ',
    'TBJ (gram) ',
    'Presentasi ',
    'Jumlah Janin',
    'Injeksi Td',
    'Catat di Buku KIA',
    'Fe (tab/botol)',
    'PMT Bumil KEK',
    'Ikut tkelas ibu',
    'Hemoglobin (gr/dl)',
    'Glucosa urine (+/-)',
    'Sifilis (+/-)',
    'HBsAg*',
    'HIV (+/-)',
    'ARV Profilaksis***',
    'Malaria (+/-)',
    'Obat***',
    'Kelambu berinsektisida*',
    'Skrinng anamnesis*',
    'Periksa Dahak*',
    'TBC (+/-)',
    'Obat***',
    'Sehat',
    'Kontak Erat',
    'Suspek',
    'Terkonfirmasi',
    'HDK',
    'Abortus',
    'Perdarahan',
    'Infeksi',
    'KPD',
    'Lain-lain',
    'Puskesmas',
    'Klinik',
    'RSIA/RSB',
    'RS',
    'Lain-lain',
    'Tiba (H/M)',
    'Pulang (H/M)'
      ) as $a)
    <th height="150" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">{{ $a }}</div></th>
    @endforeach
  </tr>
  @if ($def == null)
  <tr>
    <td colspan="60" class="text-center">Tidak ada data Periksa ...</td>
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
})--}}
@endif
</script>
@endpush
