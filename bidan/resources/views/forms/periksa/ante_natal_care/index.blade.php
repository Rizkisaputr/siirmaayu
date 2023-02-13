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
<span class="btn btn-success btn-sm pull-left" id="ancRefreshBtn" onclick="initANCTable()"><i class="feather icon-refresh-cw"></i> Perbarui Tabel</span>
<a href="@if(isset($def)){{ route('anteNatalCareCreate',$def) }}@endif" class="btn btn-primary btn-sm pull-right" id="ancBtn" onclick="return ancForm(this)"><i class="feather icon-plus"></i> Data</a>
<div class="anc-form clearfix"></div>
<br>
<table class="table table-condensed table-bordered table-responsive" id="anteNatalCareTable">
  <thead>
  <tr>
    <th rowspan="3" class="text-center">No.</th>
    <th rowspan="3" class="text-center"></th>
    <th colspan="4" class="text-center" rowspan="2">REGISTER</th>
    <th colspan="16" class="text-center">PEMERIKSAAN</th>
    <th colspan="7" class="text-center" rowspan="2">PELAYANAN</th>
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
    <th colspan="11" class="text-center">IBU</th>
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
    'MAP',
    'Nadi',
    'Respirasi',
    'Suhu',
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
    'Kalsium',
    'Asetosal',
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
    <td colspan="61" class="text-center">Tidak ada data Periksa ...</td>
  </tr>
  @endif
  @php for($i = 1; $i <= 61; $i++) { @endphp
  <td class="text-center">{{ $i }}</td>
  @php } @endphp
  </thead>
  <tbody></tbody>
</table>
@push('formScript')
<script type="text/javascript">
@if ($def != null)

initANCTable = function()
{
$.ajax({
    url: '{{ route('anteNatalCareTable',$def) }}',
    cache: false,
    beforeSend: function() {
      loaderSet('Memuat ...');
    },
    success: function(result) {
      loaderUnset();
      $('#anteNatalCareTable tbody').html(result);
    },error:function(xhr, ajaxOptions, thrownError){
      console.log(JSON.stringify(xhr));
    }
});
}

initANCTable();

ancBtnAktif = function(i)
{
  if (i) $('#ancBtn, #ancRefreshBtn, .btn-save, .btn-close').show()
  else $('#ancBtn, #ancRefreshBtn, .btn-save, .btn-close').hide()
}

ancFormClose = function() {
  $('.anc-form').html(null)
  ancBtnAktif(1)
}

ancWrite = function()
{
  $.ajax({
      url: '{{ route('anteNatalCareWrite') }}',
      method: "post",
      data: $('#ancFormPanel').serialize(),
      cache: false,
      beforeSend: function() {
        $('.btn-close-anc').hide()
        $('.btn-save-anc').attr('disabled','disabled').html('Menyimpan ...')
      },
      dataType: "json",
      success: function(result) {
        if (result.status == true) {
          $('.anc-form').html(null)
          initANCTable()
          ancBtnAktif(1)
        } else {
          $('.btn-close-anc').show()
          $('.btn-save-anc').html('Simpan').removeAttr('disabled')
        }

      },error:function(xhr, ajaxOptions, thrownError){
          failSet('Terjadi Kesalahan Penyimpanan')
          $('.btn-close-anc').show()
          $('.btn-save-anc').html('Simpan').removeAttr('disabled')
          console.log(JSON.stringify(xhr));

      }
  });
  return false;
}

ancDelete = function (i) {
    swal({
        title: "Perhatian.",
        text: "Anda yakin ingin menghapus ANC tersebut?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f86c6b",
        cancelButtonColor: "#ddd",
        confirmButtonText: "Hapus!",
        cancelButtonText: "Batal",
        allowOutsideClick: false,
    },
    function(){
            loaderSet('Menghapus Data ...')
            $.ajax({
                url: $(i).attr('href'),
                cache: false,
                dataType: "json",
                success: function(result) {
                    loaderUnset()
                    successSet(result.message)
                    initANCTable();
                },error:function(xhr, ajaxOptions, thrownError){
                    console.log(JSON.stringify(xhr));
                }
            });
    })
    return false;
}
@endif

ancForm = function(i) {
  url = $(i).attr('href')
  if (url != '') {
    formRedirect(url,'anc-form')
    $("html, body").animate({ scrollTop: 0 }, 0);
    ancBtnAktif(0)
  } else {
    failSet('Pemeriksaan mohon diisi terlebih dahulu')
  }
  return false
}

</script>
@endpush
