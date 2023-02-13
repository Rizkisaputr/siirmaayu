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
<span class="btn btn-success btn-sm pull-left" id="pnRefreshBtn" onclick="initPnTable()"><i class="feather icon-refresh-cw"></i> Perbarui Tabel</span>
<a href="@if(isset($def)){{ route('postNatalCreate',$def) }}@endif" class="btn btn-primary btn-sm pull-right" id="pnBtn" onclick="return pnForm(this)"><i class="feather icon-plus"></i> Data</a>
<div class="pn-form clearfix"></div>
<table class="table table-condensed table-bordered table-responsive m-t-10" id="postNatalTable">
  <thead>
  <tr>
    <th rowspan="2">NO</th>
    <th rowspan="2"></th>
    <th rowspan="2" class="text-center">TGL</th>
    <th rowspan="2" class="text-center">HARI KE/KF</th>
    <th colspan="4" class="text-center">TANDA VITAL</th>
    <th colspan="5" class="text-center">PEMERIKSAAN</th>
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
      'Suhu <sup>o</sup>C',
      'Nadi',
      'Respirasi',
      'TFU',
      'BAK',
      'BAB',
      'Lochea',
      'Masalah Payudara',
      'Catat di Buku KIA',
      'Fe (tab/botol)',
      'Vit. A',
      'CD4 (kopi/ml)',
      'Anti Malaria',
      'Anti TB',
      'ARV',
      'PPP',
      'Infeksi',
      'HDK',
      'Lainnya',
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
  @php for($i = 1; $i <= 26; $i++) { @endphp
  <td class="text-center">{{ $i }}</td>
  @php } @endphp
  </tr>
  </thead>
  <tbody>
  @if ($def == null)
  <tr>
    <td colspan="26" class="text-center">Tidak ada data Periksa ...</td>
  </tr>
  @endif
  </tbody>
</table>

@push('formScript')
<script type="text/javascript">
@if ($def != null)

initPnTable = function()
{
$.ajax({
    url: '{{ route('postNatalTable',$def) }}',
    cache: false,
    beforeSend: function() {
      loaderSet('Memuat ...');
    },
    success: function(result) {
      loaderUnset();
      $('#postNatalTable tbody').html(result);
    },error:function(xhr, ajaxOptions, thrownError){
        console.log(JSON.stringify(xhr));
    }
});
}

initPnTable();

pnBtnAktif = function(i)
{
  if (i) $('#pnBtn, #pnRefreshBtn, .btn-save, .btn-close').show()
  else $('#pnBtn, #pnRefreshBtn, .btn-save, .btn-close').hide()
}


pnFormClose = function() {
  $('.pn-form').html(null)
  pnBtnAktif(1)
}

pnWrite = function()
{
  $.ajax({
      url: '{{ route('postNatalWrite') }}',
      method: "post",
      data: $('#pnFormPanel').serialize(),
      cache: false,
      beforeSend: function() {
        $('.btn-close-pn').hide()
        $('.btn-save-pn').attr('disabled','disabled').html('Menyimpan ...')
      },
      dataType: "json",
      success: function(result) {
        if (result.status == true) {
          $('.pn-form').html(null)
          initPnTable()
          pnBtnAktif(1)
        } else {
          $('.btn-close-pn').show()
          $('.btn-save-pn').html('Simpan').removeAttr('disabled')
        }

      },error:function(xhr, ajaxOptions, thrownError){
          failSet('Terjadi Kesalahan Penyimpanan')
          $('.btn-close-pn').show()
          $('.btn-save-pn').html('Simpan').removeAttr('disabled')
          console.log(JSON.stringify(xhr));
      }
  });
  return false;
}

pnDelete = function (i) {
    swal({
        title: "Perhatian.",
        text: "Anda yakin ingin menghapus Post Natal tersebut?",
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
                initPnTable();
            },error:function(xhr, ajaxOptions, thrownError){
                console.log(JSON.stringify(xhr));
            }
        });
    })
    return false;
}
@endif



pnForm = function(i) {
  url = $(i).attr('href')
  if (url != '') {
    formRedirect(url,'pn-form')
    $("html, body").animate({ scrollTop: 0 }, 0);
    pnBtnAktif(0)
  } else {
    failSet('Pemeriksaan mohon diisi terlebih dahulu')
  }
  return false
}
</script>
@endpush
