<form action="{{ route('postNatalWrite')}}" onsubmit="return pnWrite()" id="pnFormPanel">
@csrf
@if (isset($def)) <input type="hidden" name="id" value="{{ $def->id }}"/>@endif
<input type="hidden" name="k1_id" value="{{ $periksa->id }}"/>
<div class="row">
      <div class="col-lg-6">
    @foreach(array(
      'Tgl' => 'tgl',
      'Hari Ke' => 'hari_ke',
      'TD (mmHg)' => 'td',
      'Suhu <sup>o</sup>C' => 'suhu',
      'Nadi' => 'nadi',
      'Respirasi' => 'respirasi',
      'TFU' => 'tfu',
      'BAK' => 'bak',
      'BAB' => 'bab',
      'Lochea' => 'lochea',
      'Masalah Payudara' =>  'masalah_payudara',
      'Catat di Buku KIA' => 'catat_buku_kia',
      'Fe (tab/botol)' => 'fe',
      'Vit. A' => 'vit_a',
      'CD4 (kopi/ml)' => 'cd4',
      'Anti Malaria' => 'anti_malaria',
      'Anti TB' => 'anti_tb',
      'ARV' => 'arv',
      'Komplikasi' => 'komplikasi',
      'klasifikasi' => 'klasifikasi',
      'Tata Laksana' => 'tata_laksana',
      'Dirujuk Ke' => 'dirujuk_ke',
      'Tiba (H/M)' => 'tiba',
      'Pulang (H/M)' => 'pulang') as $a => $b)

      @if (isset($judul[$b]))<h4>{{ strtoupper($judul[$b]) }}</h4>@endif

      @if ($b == "komplikasi")
        <div class="form-group row">
          <label class="col-sm-4 col-form-label text-right">Komplikasi</label>
          <div class="col-sm-8 form-radio">
            @foreach(array(
            1 => 'PPP',
            2 => 'Infeksi',
            3 => 'HDK',
            4 =>  'Lainnya') as $k => $ka)
            <div class="radio radio-inline">
              <label><input type="radio" name="komplikasi" value="{{ $k }}" @if (isset($def) and $def->komplikasi == $k) checked @endif><i class="helper"></i>{{ $ka }}</label>
            </div>
            @endforeach
          </div>
        </div>
    @endif

    @if ($b == "dirujuk_ke")
      <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{ $a }}</label>
        <div class="col-sm-8 form-radio">
          @foreach(array(
          1 => 'PKM',
          2 => 'Klinik',
          3 => 'RSIA/RSB',
          4 => 'RS',
          5 => 'Lainnya'
        ) as $k => $ka)
          <div class="radio radio-inline">
            <label><input type="radio" name="{{ $b }}" value="{{ $k }}" @if (isset($def) and $def->$b == $k) checked @endif><i class="helper"></i>{{ $ka }}</label>
          </div>
          @endforeach
        </div>
      </div>
    @endif

    @if (in_array($b,array('catat_buku_kia','vit_a')))
        <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{!! $a !!}</label>
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

    @if (!in_array($b,array('catat_buku_kia','vit_a','dirujuk_ke','komplikasi')))
          <div class="form-group row">
          <label class="col-sm-4 col-form-label text-right">{!! $a !!}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control @if ($a == "Tgl") tgl-pn @endif" name="{{ $b }}" value="@if (isset($def)){{ $def->$b }}@endif">
          </div>
          </div>
    @endif

    @if ($b == 'vit_a') </div><div class="col-lg-6">@endif
    @endforeach
  </div>
</div>
<hr>
<span class="btn btn-inverse float-left btn-close-pn" onclick="return pnFormClose(this)"><i class="feather icon-x"></i> Tutup</span>
<span class="btn btn-primary float-right btn-save-pn" onclick="return pnWrite()"><i class="feather icon-save"></i> Simpan</button>
<div class="clearfix"></div>
</form>

<script type="text/text/javascript">
  $(document).ready(function() {
    $('.tgl-pn').flatpickr({
        altInput: true,
        altFormat: 'j F Y',
        dateFormat: 'Y-m-d',
    })
  })
</script>
