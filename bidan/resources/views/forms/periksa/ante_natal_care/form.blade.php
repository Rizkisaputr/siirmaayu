<form action="{{ route('anteNatalCareWrite')}}" onsubmit="return ancWrite()" id="ancFormPanel">
@csrf

@if (isset($def)) <input type="hidden" name="id" value="{{ $def->id }}"/>@endif
<input type="hidden" name="k1_id" value="{{ $periksa->id }}"/>
<div class="row">
      <div class="col-lg-6">
    @foreach(array(
      'Tgl' => 'tgl',
      'JKN' => 'jkn',
      'Usia Kehamilan' => 'usia_kehamilan',
      'Trimester ke' => 'trimester',
      'Keluhan' => 'keluhan',
      'BB (kg)' => 'bb',
      'TD (mmHg)' => 'td',
      'MAP' => 'map',
      'Nadi' => 'nadi',
      'Respirasi' => 'respirasi',
      'Suhu' => 'suhu',
      'LILA (cm)' => 'lila',
      'Status Gizi2' => 'status_gizi',
      'TFU (cm)' => 'tfu',
      'Refleks Patella' => 'refleks_patella',
      'DJJ (x/menit)' => 'ddj',
      'Kepala thd PAP ' => 'kepala_pap',
      'TBJ (gram)' => 'tbj',
      'Presentasi' => 'presentasi',
      'Jumlah Janin' => 'jumlah_janin',
      'Injeksi Td' => 'injeksi_td',
      'Catat di Buku KIA' => 'catat_buku_kia',
      'Fe (tab/botol)' => 'fe',
      'PMT Bumil KEK' => 'pmt_bumil_kek',
      'Ikut tkelas ibu' => 'ikut_tkelas_ibu',
      'Kalsium' => 'kalsium',
      'Asetosal' => 'asetosal',
      'Konseling' => 'konseling',
      'Hemoglobin (gr/dl)' => 'hemoglobin',
      'Glucosa Urine' => 'glucosa_urine',
      'Sifilis' => 'pmtct_sifilis',
      'HBsAg' => 'pmtct_hbsag',
      'HIV' => 'pmtct_hiv',
      'ARV Profilaksis' => 'pmtct_arv_profilaksis',
      'Malaria' => 'malaria',
      'Obat' => 'malaria_obat',
      'Kelambu berinsektisida' => 'malaria_kelambu_berinsektisida',
      'Skrining anamnesis' => 'tbc_skrining_anamnesis',
      'Periksa Dahak' => 'tbc_dahak',
      'TBC' => 'tbc',
      'Obat' => 'tbc_obat',
      'Sehat' => 'covid19_sehat',
      'Kontak Erat' => 'covid19_kontak_erat',
      'Suspek' => 'covid19_suspek',
      'Terkonfirmasi' => 'covid19_terkonfirmasi',
      'Komplikasi' => 'komplikasi',
      'Tata Laksana' => 'tata_laksana_awal',
      'Dirujuk ke' => 'dirujuk_ke',
      'Tiba (H/M)' => 'tiba',
      'Pulang (H/M)' => 'pulang') as $a => $b)

      @if (isset($judul[$b]))<h4>{{ strtoupper($judul[$b]) }}</h4>@endif

      @php $pil = array(); foreach($pilihan as $pp => $emp) { $pil[] = $pp; } @endphp
      @if (in_array($b,$pil))
        <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{ $a }}</label>
        <div class="col-sm-8 form-radio">
          @foreach($pilihan[$b] as $k => $ka)
          <div class="radio radio-inline">
            <label><input type="radio" name="{{ $b }}" value="{{ $k }}" @if (isset($def) and $def->$b == $k) checked @endif><i class="helper"></i>{{ $ka }}</label>
          </div>
          @endforeach
        </div>
        </div>
      @endif

      @if (in_array($b,$ya_tidak))
        <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{ $a }}</label>
        <div class="col-sm-8 form-radio">
          @foreach(array(
          1 => 'Ya',
          2 => 'Tidak',
        ) as $k => $ka)
          <div class="radio radio-inline">
            <label><input type="radio" name="{{ $b }}" value="{{ $k }}" @if (isset($def) and $def->$b == $k) checked @endif><i class="helper"></i>{{ $ka }}</label>
          </div>
          @endforeach
        </div>
        </div>
      @endif

      @if (!in_array($b,$pil) and !in_array($b,$ya_tidak))

          @php  $input_type = (in_array($b,array('usia_kehamilan','trimester','tbj'))) ? 'onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))"' : '' @endphp
          <div class="form-group row">
          <label class="col-sm-4 col-form-label text-right">{{ $a }}</label>
          <div class="col-sm-8">
            <input type="text" {!! $input_type !!} class="form-control @if ($a == "Tgl") tgl-anc @endif" name="{{ $b }}" value="@if (isset($def)){{ $def->$b }}@endif" @if (in_array($b,$ditulis)) placeholder="Tuliskan Nama Obat ..."@endif>
          </div>
          </div>
      @endif

      @if ($b == 'hemoglobin') </div><div class="col-lg-6">@endif

    @endforeach
    <div class="form-group row">
    <label class="col-sm-4 col-form-label text-right">Keterangan</label>
    <div class="col-sm-8">
      <textarea type="text" class="form-control" name="keterangan"></textarea>
    </div>
    </div>
  </div>
</div>
<hr>
<span class="btn btn-inverse float-left btn-close-anc" onclick="return ancFormClose(this)"><i class="feather icon-x"></i> Tutup</span>
<span class="btn btn-primary float-right btn-save-anc" onclick="return ancWrite()"><i class="feather icon-save"></i> Simpan</button>
<div class="clearfix"></div>
</form>

<script type="text/text/javascript">
  $(document).ready(function() {
    $('.tgl-anc').flatpickr({
        altInput: true,
        altFormat: 'j F Y',
        dateFormat: 'Y-m-d',
    })
  })
</script>
