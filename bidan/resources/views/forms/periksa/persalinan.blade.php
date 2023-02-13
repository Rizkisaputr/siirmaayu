
<div class="row">
  <div class="col-lg-12">
    <h5 class="m-b-10">MASA PERSALINAN</h5>
    @foreach(array(
      1 => 'Kala I Aktif',
      2 => 'Kala II',
      3 => 'Bayi Lahir',
      4 => 'Plasenta Lahir',
      5 => 'Perdarahan Kala IV 2 jam Postpartum') as $m => $n)

      <div class="form-group row">
        <label class="col-sm-4 col-form-label text-right">
          <input type="hidden" name="kode[]" value="{{ $m }}">{{ $n }}</label>
        <div class="col-sm-4">
          <div class="input-group">
          <input type="text" class="form-control datepicker" name="tgl[{{$m}}]" value="@if(isset($prsln[$m])){{ $prsln[$m]->tgl }}@endif" placeholder="Waktu" autocomplete="off">
          <label class="input-group-text"><i class="feather icon-calendar"></i></label>
          </div>
        </div>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="jam[{{$m}}]" value="@if(isset($prsln[$m])){{ $prsln[$m]->jam }}@endif" placeholder="Jam" autocomplete="off">
        </div>
      </div>
    @endforeach
    <hr>
    @foreach(array(
      'usia_kehamilan' => array('Minggu'),
      'usia_hpht' => array('Minggu'),
      'keadaan_ibu' => array('Hidup','Mati'),
      'keadaan_bayi' => array('Hidup','Mati'),
      'berat_bayi' => array('gram'),
      'jenis_kelamin' => array('Laki-laki','Perempuan'),
      'panjang_bayi' => array('cm')
    ) as $a => $pval)
    <div class="form-group row">
      <label class="col-sm-4 col-form-label text-right">{{ ucwords(str_replace('_',' ',$a)) }}</label>
        @if (count($pval) == 1)
        <div class="col-sm-8">
        <div class="input-group">
        <input type="text" class="form-control" name="{{ $a }}" value="@if(isset($prsln_data)){{ $prsln_data->$a }}@endif" placeholder="" autocomplete="off">
        <label class="input-group-text">{{ $pval[0] }}</label>
        </div>
        </div>
        @else
        <div class="col-sm-8 form-radio">
        @foreach($pval as $l => $pvalv)
        <div class="radio radio-inline">
          <label><input type="radio" name="{{ $a }}" value="{{ ($l+1) }}" @if (isset($prsln_data) and $prsln_data->$a == ($l+1)) checked @endif><i class="helper"></i>{{ $pvalv }}</label>
        </div>
        @endforeach
        </div>
        @endif
    </div>
    @endforeach
    <hr>
    @php
    $prsln_ii = 1;
    $prsln_array = array(
    'PRESENTASI' => array('puncak kepala','belakang kepala','lintang/oblique','menumbung','bokong','dahi','muka','kaki','campuran'),
    'TEMPAT' => array('rumah','polindes','pustu','puskesmas','RB','RSIA','RS'),
    'PENOLONG' => array('keluarga','dukun','bidan','dr. spesialis','dr','lainnya','tidak ada'),
    'CARA PERSALINAN' => array('Normal','Vacum','Forceps','Sectio Caesaria'),
    'MANAJEMEN AKTIF KALA III' => array('Injeksi Oksitosin','Peregangan tali pusat','Masase Fundus Uteri'),
    'PELAYANAN' => array('IMD < 1 jam / > 1jam','Menggunakan Partograf','Catat di Buku KIA'),
    'INTEGRASI PROGRAM' => array('ARV Profilaksis*** :','Obat Anti Malaria*** :','Obat Anti TB*** :'),
    'OBAT INTEGRASI PROGRAM' => null,
    'KOMPLIKASI' => array('Distosia','HDK','PPP','Infeksi','Lainnya'),
    'DIRUJUK KE' => array('Puskesmas','RB','RSIA','RS','Lainnya','Tidak Dirujuk'),
    'KEADAAN TIBA' => array('hidup','mati'),
    'KEADAAN PULANG' => array('hidup','mati'));
    @endphp

    @foreach($prsln_array as $pkode_col => $pkode_ch)
    <div class="form-group row">
      <label class="col-sm-4 col-form-label text-right">{{ $pkode_col }}</label>
      @if ($pkode_col == "OBAT INTEGRASI PROGRAM")
      <div class="col-sm-8">
        <input type="hidden" name="prsln_kode[]" value="{{ $prsln_ii }}"/>
        <input type="text" class="form-control" name="prsln_kode_val[{{$prsln_ii}}]" value="@if (isset($prsln_kode[$prsln_ii])){{ $prsln_kode[$prsln_ii] }}@endif" placeholder="" autocomplete="off">
      </div>
      @else
      <div class="col-sm-8 form-radio">
        <input type="hidden" name="prsln_kode[]" value="{{ $prsln_ii }}"/>
        @foreach($pkode_ch as $j => $jch)
        <div class="radio radio-inline">
          <label><input type="radio" name="prsln_kode_val[{{$prsln_ii}}]" value="{{ ($j+1) }}" @if (isset($prsln_kode[$prsln_ii]) and $prsln_kode[$prsln_ii] == ($j+1)) checked @endif><i class="helper"></i>{{ $jch }}</label>
        </div>
        @endforeach
      </div>
      @endif
    </div>
    @php $prsln_ii+=1 @endphp
    @endforeach
  </div>

</div>
<div class="form-group">
  <label class="p-b-10">Catatan Khusus</label>
  <textarea class="form-control" name="catatan_khusus" rows="4">@if (isset($def)){{ $def->catatan_khusus }}@endif</textarea>
</div>
