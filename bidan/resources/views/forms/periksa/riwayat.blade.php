
<style>
.input-group-append, .input-group-text { height: 35px }
.input-group-append .input-group-text, .input-group-prepend .input-group-text { background-color: #fff !important; color: #555}
</style>

<div class="row">
  <div class="col-lg-6">
    <h5 class="m-b-10">RIWAYAT OBSTETRIK</h5>
    @foreach(array(
      'gravida',
      'partus',
      'abortus',
      'hidup') as $m)
        <div class="form-group row">
        <label class="col-sm-4 col-form-label">{{ ucfirst($m) }}</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($def)){{ $def->$m }}@endif">
        </div>
        </div>
    @endforeach
    <hr>
    <h5 class="m-b-10">RIWAYAT Penyakit</h5>
    @php
      $radioSebelum = array(
        'riwayat_persalinan' => array(
          1 => 'Prematur',
          2 => 'BBLR',
          3 => 'Kelainan Kongenital'),
        'riwayat_penyakit_menular' => array(
          1 => 'TB',
          2 => 'HIV',
          3 => 'Hepatitis',
          4 => 'Sifilis',
          5 => 'Malaria',
          6 => 'Lainnya'))
    @endphp
    @foreach(array(
      'Riwayat Komplikasi Kebidanan' => 'komplikasi_kebidanan',
      'Riwayat persalinan sebelumnya' => 'riwayat_persalinan',
      'Riwayat Penyakit Kronis dan Alergi' => 'riwayat_penyakit_kronis_alergi',
      'Riwayat penyakit menular' => 'riwayat_penyakit_menular',
      'Riwayat KB' => 'riwayat_kb') as $a => $b)

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">{{ $a }}</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="{{ $b }}" value="@if (isset($def)){{ $def->$b }}@endif">
      </div>
    </div>
    @endforeach
    <hr>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Buku KIA</label>
      <div class="col-sm-8 form-radio">
        <div class="radio radio-inline">
          <label><input type="radio" name="buku_kia" value="1" @if (isset($def) and $def->buku_kia == 1) checked @endif><i class="helper"></i>Memiliki</label>
        </div>
        <div class="radio radio-inline">
          <label><input type="radio" name="buku_kia" value="2" @if (isset($def) and $def->buku_kia == 2) checked @endif><i class="helper"></i>Tidak</label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Golongan Darah</label>
      <div class="col-sm-8 form-radio">
        @foreach(array(1 => 'A',2 => 'B', 3 => 'AB', 4 => 'O') as $a => $b)
        <div class="radio radio-inline">
          <label><input type="radio" name="gol_darah" value="{{ $a }}" @if (isset($def) and $def->gol_darah == $a) checked @endif><i class="helper"></i>{{ $b }}</label>
        </div>
        @endforeach
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Rhesus</label>
      <div class="col-sm-8 form-radio">
        @foreach(array(1 => 'Positif', 2 => 'Negatif') as $a => $b)
        <div class="radio radio-inline">
          <label><input type="radio" name="rhesus" value="{{ $a }}" @if (isset($def) and $def->rhesus == $a) checked @endif><i class="helper"></i>{{ $b }}</label>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <h5>PEMERIKSAAN BIDAN/DOKTER SAAT K1</h5>
          @foreach(array(
            'Tanggal Periksa' =>  'tgl_periksa',
            'Tanggal HPHT' => 'tgl_hpht',
            'Taksiran Persalinan' => 'taksiran_persalinan',
            'Tgl Persalinan Sebelum' => 'persalinan_sebelum'
          ) as $m => $n)
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ $m }}</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control datepicker" name="{{ $n }}" value="@if (isset($def)){{ $def->$n }}@endif">
                <label class="input-group-text"><i class="feather icon-calendar"></i></label>
                </div>
              </div>
          </div>
          @endforeach

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">BB Sebelum Hamil</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="bb_sebelum_hamil" value="@if (isset($def)){{ $def->bb_sebelum_hamil }}@endif" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">BB Saat Ini</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="bb_sekarang" value="@if (isset($def)){{ $def->bb_sekarang }}@endif">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">IMT</label>
            <div class="col-sm-8 form-radio">
              @foreach(array(
                1 => '< 18,5',
                2 => '10,5 - 24,9',
                3 => '25,0 - 29,9',
                4 => '>= 30'
              ) as $id => $val)
              <div class="radio radio-inline">
                <label><input type="radio" name="imt" value="1" @if (isset($def) and $def->imt == $id) checked @endif><i class="helper"></i>{{ $val }}</label>
              </div>
              @endforeach
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Rekomendasi Peningkatan Berat Badan</label>
            <div class="col-sm-8 form-radio">
              @foreach(array(
                1 => '12,5 - 18 kg',
                2 => '11,5 - 16 kg',
                3 => '7 - 11,5 kg',
                4 => '5 - 9 kg'
              ) as $id => $val)
              <div class="radio radio-inline">
                <label><input type="radio" name="rekomendasi_bb" value="1" @if (isset($def) and $def->rekomendasi_bb == $id) checked @endif><i class="helper"></i>{{ $val }}</label>
              </div>
              @endforeach
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Tinggi Badan</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" class="form-control" name="tinggi" value="@if (isset($def)){{ $def->tinggi }}@endif">
                <span class="input-group-append">
                <label class="input-group-text">cm</label>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">LILA</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" class="form-control" name="lila" value="@if (isset($def)){{ $def->lila }}@endif">
                <span class="input-group-append">
                <label class="input-group-text">cm</label>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Status Gizi</label>
            <div class="col-sm-8 form-radio">
              @foreach(array(
                1 => 'Gizi Kurang',
                2 => 'Normal',
                3 => 'Cendrung Gemuk',
                4 => 'Obesitas'
              ) as $id => $val)
              <div class="radio radio-inline">
                <label><input type="radio" name="gizi" value="1" @if (isset($def) and $def->gizi == $id) checked @endif><i class="helper"></i>{{ $val }}</label>
              </div>
              @endforeach
            </div>
          </div>

  </div>
</div>
<hr>
<h5>Rencana Persalinan</h5>
<div class="row">
  <div class="col-lg-4">
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Tanggal</label>
        <div class="col-sm-8">
          <div class="input-group">
          <input type="text" class="form-control datepicker" name="tgl_rencana" value="@if (isset($def)){{ $def->tgl_rencana }}@endif">
          <label class="input-group-text"><i class="feather icon-calendar"></i></label>
          </div>
        </div>
    </div>
  </div>
  <div class="col-lg-8"></div>
  @php
  $radioRP = array(
  'Penolong' => array(
    1 => 'Bidan',
    2 => 'Dr. Umum',
    3 => 'Dr. Spesialis'),
  'Tempat' => array(
    1 => 'Pustu',
    2 => 'Puskesmas',
    3 => 'PMB',
    4 => 'RSIA',
    5 => 'RS',
    6 => 'Klinik'),
  'Pendamping' => array(
    1 => 'Suami',
    2 => 'Keluarga',
    3 => 'Teman',
    4 => 'Tetangga',
    5 => 'Lain-lain',
    6 => 'Tidak ada'),
  'Transportasi' => array(
    1 => 'Suami',
    2 => 'Keluarga',
    3 => 'Teman',
    4 => 'Lain-lain',
    5 => 'Tidak ada'),
  'Pendonor darah' => array(
    1 => 'Suami',
    2 => 'Keluarga',
    3 => 'Teman',
    4 => 'Lain-lain',
    5 => 'Tidak ada'),
  'Pendonor Gol Darah' => array(
    1 => 'A',
    2 => 'B',
    3 => 'AB',
    4 => 'O'))
  @endphp

  @foreach($radioRP as $a => $b)
  <div class="col-lg-3 p-b-20">
        <h6>{{ $a }}</h6>
        @foreach($b as $c => $d)
        <div class="form-radio">
        <div class="radio">
          <label>
            @php $set_name = strtolower(Str::snake($a)) @endphp
            <input type="radio" name="{{ $set_name }}" value="{{ $c }}" @if (isset($def) and $def->$set_name == $c) checked @endif><i class="helper"></i>{{ $d }}</label>
        </div></div>
        @endforeach
  </div>
  @endforeach

</div>
<div class="form-group">
  <label class="p-b-10">Catatan Khusus</label>
  <textarea class="form-control" name="catatan_khusus" rows="4">@if (isset($def)){{ $def->catatan_khusus }}@endif</textarea>
</div>
