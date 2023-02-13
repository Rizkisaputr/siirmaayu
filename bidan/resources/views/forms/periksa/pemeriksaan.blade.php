
<style>
.input-group-append, .input-group-text { height: 35px }
.input-group-append .input-group-text, .input-group-prepend .input-group-text { background-color: #fff !important; color: #555}
</style>
@php $ne = 0; @endphp
@foreach(array(
  1 => 'Pemeriksaan Dokter TM1',
  2 => 'Pemeriksaan Dokter TM3'
) as $n => $t)
<input type="hidden" name="tm[]" value="{{$n}}"/>
<h3>{{ $t }}</h3>
<div class="row">
  <div class="col-lg-8">
    <h5 class="m-b-10">PEMERIKSAAN FISIK</h5>
  </div>
  <div class="col-lg-4">@if ($n == 1)USG @endif</div>
  <div class="col-lg-4">
    @foreach(array(
      'Konjungtiva',
      'Sklera',
      'Kulit',
      'Leher',
      'Gigi/mulut',
      'THT',
      'Jantung',
      'Paru',
      'Perut',
      'Tungkai') as $m)
      @php $var = strtolower(str_replace('/','_',$m)) @endphp
        <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">{{ $m }}</label>
        <div class="col-sm-8 form-radio">
          <div class="radio radio-inline">
            <label><input type="radio" name="{{ $var }}[]" value="1" @if (isset($tm[$ne]) and $tm[$ne][$var] == 1) checked @endif><i class="helper"></i>Normal</label>
          </div>
          <div class="radio radio-inline">
            <label><input type="radio" name="{{ $var }}[]" value="2" @if (isset($tm[$ne]) and $tm[$ne][$var] == 2) checked @endif><i class="helper"></i>Tidak</label>
          </div>
        </div>
        </div>@if ($m == 'Gigi/mulut') </div><div class="col-lg-4">@endif

      @endforeach
    </div>
    @if ($n == 1)
    <div class='col-lg-4'>
      @foreach(array(
      array('gs','GS (Gestational Sac)','Cm'),
      array('crl','CRL (Crown-rump-Length)','Cm'),
      array('djj','DJJ (denyut Jantung janin)','dpm'),
      array('sesuai_usia_kehamilan','Sesuai usia kehamilan','mgg')
      ) as $a)

      <div class="form-group row">
        <label class="col-sm-6 col-form-label">{{ $a[1] }}</label>
          <div class="col-sm-6">
            <div class="input-group">
            <input type="text" class="form-control" name="{{$a[0]}}[]" value="@if (isset($tm[0])){{ $tm[0][$a[0]] }}@endif">
            <label class="input-group-text">{{ $a[2]}}</label>
            </div>
          </div>
      </div>
      @endforeach
      <div class="form-group">
        <label class="m-b-10">Taksiran Persalinan</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker" name="tksrn_persalinan[]" value="@if (isset($tm[1])){{ $tm[1]['taksiran_persalinan'] }}@endif">
            <label class="input-group-text"><i class="feather icon-calendar"></i></label>
            </div>
      </div>
    </div>
    @endif
    <div class="col-lg-12">
      @if ($n == 1)

      <h3>Skrining Preeklamsi</h3>

      @foreach($pe as $pe_jenis => $pe_data)
      <h4>{{ $pe_jenis }}</h4>
      @foreach($pe_data as $pe_kode => $pe_val)
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">{{ $pe_val }}</label>
        <div class="col-sm-8 form-radio">
          @foreach(array(
            1 => 'Ya',
            2 => 'Tidak'
          ) as $pe_id => $val)
          <div class="radio radio-inline">
            <label><input type="radio" name="pe_value[{{ $pe_kode }}]" value="{{ $pe_id }}" @if (isset($pe_def[$pe_kode]) and $pe_def[$pe_kode] == $pe_id) checked @endif><i class="helper"></i>{{ $val }}</label>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
      @endforeach

      @foreach(array(
        'Skrining Preeklamsi' => 'skrining_preeklamsi',
        'Kesimpulan' => 'kesimpulan') as $n => $m)
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ $n }}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="{{ $m }}" value="@if (isset($tm[0])){{ $tm[0]->$m }}@endif">
            </div>
          </div>
      @endforeach
      <hr>
      <div class="form-group row">
      <label class="col-sm-4 col-form-label text-right">Rekomendasi</label>
      <div class="col-sm-8 form-radio">
        <div class="radio radio-inline">
          <label><input type="radio" name="rekomendasi" value="1" @if (isset($tm[1]) and $tm[0]['rekomendasi'] == 1) checked @endif><i class="helper"></i>ANC dapat dilanjutkan di FKTP</label>
        </div>
        <div class="radio radio-inline">
          <label><input type="radio" name="rekomendasi" value="2" @if (isset($tm[1]) and $tm[0]['rekomendasi'] == 2) checked @endif><i class="helper"></i>Rujuk FKRTL</label>
        </div>
      </div>
      </div>

      @else

      <h5>USG TM 3</h5>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">HPHT</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control datepicker" name="usg_tm3_hpht" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->hpht }}@endif">
                <label class="input-group-text"><i class="feather icon-calendar"></i></label>
                </div>
              </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Janin</label>
            <div class="col-sm-8 form-radio">
              @foreach(array(
                1 => 'Hidup',
                2 => 'Tidak Hidup'
              ) as $usg_tm3_janin => $usg_tm3_janin_val)
              <div class="radio radio-inline">
                <label><input type="radio" name="usg_tm3_janin" value="{{ $usg_tm3_janin }}" @if (isset($usg_tm3_def) and $usg_tm3_def->janin == $usg_tm3_janin) checked @endif><i class="helper"></i>{{ $usg_tm3_janin_val }}</label>
              </div>
              @endforeach
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-sm-8 form-radio">
              @foreach(array(
                1 => 'Tunggal',
                2 => 'Ganda'
              ) as $usg_tm3_jumlah => $usg_tm3_jumlah_val)
              <div class="radio radio-inline">
                <label><input type="radio" name="usg_tm3_jumlah" value="{{ $usg_tm3_jumlah }}" @if (isset($usg_tm3_def) and $usg_tm3_def->jumlah == $usg_tm3_jumlah) checked @endif><i class="helper"></i>{{ $usg_tm3_jumlah_val }}</label>
              </div>
              @endforeach
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Letak</label>
            <div class="col-sm-8 form-radio">
              @foreach(array(
                1 => 'Intrauterine',
                2 => 'Ekstrauterine',
                3 => 'Presentasi Kepala',
                4 => 'Presentasi Sungsang',
                5 => 'Presentasi Melintang',
              ) as $usg_tm3_letak => $usg_tm3_letak_val)
              <div class="radio radio-inline">
                <label><input type="radio" name="usg_tm3_letak" value="{{ $usg_tm3_letak }}" @if (isset($usg_tm3_def) and $usg_tm3_def->letak == $usg_tm3_letak) checked @endif><i class="helper"></i>{{ $usg_tm3_letak_val }}</label>
              </div>
              @endforeach
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Berat Janin</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="usg_tm3_berat" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->berat }}@endif">
                <label class="input-group-text">Gram</label>
                </div>
              </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Plasenta</label>
            <div class="col-sm-8 form-radio">
              @foreach(array(
                1 => 'Normal',
                2 => 'Tidak'
              ) as $usg_tm3_plasenta => $usg_tm3_plasenta_val)
              <div class="radio radio-inline">
                <label><input type="radio" name="usg_tm3_plasenta" value="{{ $usg_tm3_plasenta }}" @if (isset($usg_tm3_def) and $usg_tm3_def->plasenta == $usg_tm3_plasenta) checked @endif><i class="helper"></i>{{ $usg_tm3_plasenta_val }}</label>
              </div>
              @endforeach
            </div>
          </div>

        </div>
        <div class="col-lg-6">

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Kehamilan</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="usg_tm3_minggu_kehamilan" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->minggu_kehamilan }}@endif">
                <label class="input-group-text">Minggu</label>
                </div>
              </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">BPD</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="usg_tm3_bpd" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->bpd }}@endif">
                <label class="input-group-text">Cm</label>
                </div>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">HC</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="usg_tm3_hc" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->hc }}@endif">
                <label class="input-group-text">Cm</label>
                </div>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">AC</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="usg_tm3_ac" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->ac }}@endif">
                <label class="input-group-text">Cm</label>
                </div>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">FL</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="usg_tm3_fl" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->fl }}@endif">
                <label class="input-group-text">Cm</label>
                </div>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Cairan Ketuban</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="usg_tm3_ketuban" value="@if (isset($usg_tm3_def)){{ $usg_tm3_def->ketuban }}@endif">
                <label class="input-group-text">Cm</label>
                </div>
              </div>
          </div>
      </div>
    </div>

      <h5>Pemeriksaan Lab</h5>

      @foreach(array(
        'Hb' => array('hb','gr/dl'),
        'Gula Darah Puasa' => array('gd_puasa','mg/dl'),
        'Gula Darah 2jam PP' => array('gd_2jam_pp','mg/dl')) as $n => $m)
          <div class="form-group row">
          <label class="col-sm-4 col-form-label text-right">{{ $n }}</label>
          <div class="col-sm-8">
              <div class="input-group">
                @php $labText = $m[0] @endphp
                  <input type="text" class="form-control" name="{{ $labText }}" value="@if(isset($tm[1])){{ $tm[1]->$labText }}@endif">
                  <label class="input-group-text">{{ $m[1]}}</label>
              </div>
          </div>
          </div>
      @endforeach
      @endif
    </div>
</div>
@php $ne+=1 @endphp
@endforeach
