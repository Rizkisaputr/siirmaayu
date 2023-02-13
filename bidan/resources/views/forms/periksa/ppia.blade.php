
    <h5 class="m-b-10">PEMANTAUAN PPIA (UNTUK IBU HAMIL YANG POSITIF)</h5>
    <hr>
    <h5>HASIL DETEKSI DINI</5>
    @php $ppia_id = 0 @endphp
    @foreach(array('HBsAg','HIV','Sifilis') as $ppia_screening)

    <input type="hidden" name="ppia_screening_kode[{{ $ppia_id }}]" value="{{ $ppia_screening }}"/>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">{{ $ppia_screening }}</label>
      <div class="col-sm-3">
        <div class="input-group">
        <input type="text" class="form-control datepicker" name="ppia_screening_tgl[{{ $ppia_id }}]" value="@if(isset($ppia_def_sc[$ppia_screening])){{ $ppia_def_sc[$ppia_screening]->tgl }}@endif" placeholder="Tanggal" autocomplete="off">
        <label class="input-group-text"><i class="feather icon-calendar"></i></label>
        </div>
      </div>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="ppia_value[{{ $ppia_id }}]" value="@if(isset($ppia_def_sc[$ppia_screening])){{ $ppia_def_sc[$ppia_screening]->value }}@endif" placeholder="Kode Specimen" autocomplete="off">
      </div>
      <div class="col-sm-3 form-radio">
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value_ext[{{ $ppia_id }}]" value="1" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value_ext == 1) checked @endif><i class="helper"></i>Reaktif</label>
        </div>
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value_ext[{{ $ppia_id }}]" value="2" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value_ext == 2) checked @endif><i class="helper"></i>Non Reaktif</label>
        </div>
      </div>
    </div>
    @php $ppia_id+=1 @endphp
    @endforeach
    <hr>
    <h5>Ibu Hamil dirujuk untuk tata laksana</h5>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right p-t-30">HIV</label>
      <div class="col-sm-3">
        Tgl masuk PDP
        <div class="input-group m-t-5">
        <input type="text" class="form-control datepicker" name="sc_hiv_tgl_pdp" value="@if(isset($ppia_def)){{ $ppia_def->hiv_tgl_pdp }}@endif" placeholder="" autocomplete="off">
        <label class="input-group-text"><i class="feather icon-calendar"></i></label>
        </div>
      </div>
      <div class="col-sm-3">
        Tgl Mulai ARV
        <div class="input-group m-t-5">
        <input type="text" class="form-control datepicker" name="sc_hiv_tgl_arv" value="@if(isset($ppia_def)){{ $ppia_def->hiv_tgl_arv }}@endif" placeholder="" autocomplete="off">
        <label class="input-group-text"><i class="feather icon-calendar"></i></label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right p-t-30">Sifilis</label>
      <div class="col-sm-3">
        Ditangani
        <div class="form-radio m-t-5">
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_sifilis" value="1" @if (isset($ppia_def) and $ppia_def->sifilis == 1) checked @endif><i class="helper"></i>Ya</label>
          </div>
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_sifilis" value="2" @if (isset($ppia_def) and $ppia_def->sifilis == 2) checked @endif><i class="helper"></i>TidaK</label>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        Diobati Adequat
        <div class="form-radio m-t-5">
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_sifilis_diobati" value="1" @if (isset($ppia_def) and $ppia_def->sifilis_diobati == 1) checked @endif><i class="helper"></i>Ya</label>
          </div>
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_sifilis_diobati" value="2" @if (isset($ppia_def) and $ppia_def->sifilis_diobati == 2) checked @endif><i class="helper"></i>TidaK</label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">Pasangan mengetahui status HIV</label>
      <div class="col-sm-3">
        <div class="form-radio m-t-5">
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_pasangan_tahu" value="1" @if (isset($ppia_def) and $ppia_def->pasangan_tahu == 1) checked @endif><i class="helper"></i>Ya</label>
          </div>
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_pasangan_tahu" value="2" @if (isset($ppia_def) and $ppia_def->pasangan_tahu == 2) checked @endif><i class="helper"></i>TidaK</label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">Pasangan diperiksa Sifilis</label>
      <div class="col-sm-3">
        <div class="form-radio m-t-5">
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_pasangan_diperiksa_sifilis" value="1" @if (isset($ppia_def) and $ppia_def->pasangan_diperiksa_sifilis == 1) checked @endif><i class="helper"></i>Ya</label>
          </div>
          <div class="radio radio-inline">
            <label><input type="radio" name="sc_pasangan_diperiksa_sifilis" value="2" @if (isset($ppia_def) and $ppia_def->pasangan_diperiksa_sifilis == 2) checked @endif><i class="helper"></i>TidaK</label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">Faskes Rujukan</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="sc_faskes_rujukan" value="@if (isset($ppia_def)){{ $ppia_def->faskes_rujukan }} @endif">
      </div>
    </div>

    <hr>
    <h5>PEMANTAUAN BAYI DARI IBU HEPATITIS B</5>
      <p>Tanggal / Jam Pemberian :</p>
    @foreach(array(
      'hep_b_hbo' => 'HBO',
      'hep_b_hbig' => 'HBIG',
      'hep_b_dpt_hb1' => 'DPT/HB1',
      'hep_b_dpt_hb2' => 'DPT/HB2',
      'hep_b_dpt_hb3' => 'DPT/HB3') as $ppia_screening => $judul)
    <input type="hidden" name="ppia_screening_kode[{{ $ppia_id }}]" value="{{ $ppia_screening }}"/>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">{{ $judul }}</label>
      <div class="col-sm-3">
        <div class="input-group">
        <input type="text" class="form-control datepicker" name="ppia_screening_tgl[{{ $ppia_id }}]" value="@if(isset($ppia_def_sc[$ppia_screening])){{ $ppia_def_sc[$ppia_screening]->tgl }}@endif" placeholder="Tanggal" autocomplete="off">
        <label class="input-group-text"><i class="feather icon-calendar"></i></label>
        </div>
      </div>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="ppia_value[{{ $ppia_id }}]" value="@if(isset($ppia_def_sc[$ppia_screening])){{ $ppia_def_sc[$ppia_screening]->value }}@endif" placeholder="Jam" autocomplete="off">
      </div>
    </div>
    @php $ppia_id+=1 @endphp
    @endforeach

    <p>Pemeriksaan bayi (9-12 bulan):</p>
    @foreach(array(
      'hep_b_hbsag' => 'HBsAg',
      'hep_b_anti_hbs' => 'Anti HBs') as $ppia_screening => $judul)
    <input type="hidden" name="ppia_screening_kode[{{ $ppia_id }}]" value="{{ $ppia_screening }}"/>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">{{ $judul }}</label>
      <div class="col-sm-3">
        <div class="input-group">
        <input type="text" class="form-control datepicker" name="ppia_screening_tgl[{{ $ppia_id }}]" value="@if(isset($ppia_def_sc[$ppia_screening])){{ $ppia_def_sc[$ppia_screening]->tgl }}@endif" placeholder="Tanggal" autocomplete="off">
        <label class="input-group-text"><i class="feather icon-calendar"></i></label>
        </div>
      </div>
      <div class="col-sm-3 form-radio">
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value[{{ $ppia_id }}]" value="1" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value == 1) checked @endif><i class="helper"></i>Reaktif</label>
        </div>
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value[{{ $ppia_id }}]" value="2" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value == 2) checked @endif><i class="helper"></i>Non Reaktif</label>
        </div>
      </div>
    </div>
    @php $ppia_id+=1 @endphp
    @endforeach
    <hr>

    <h5>PEMANTAUAN BAYI DARI IBU HIV</p>
    @foreach(array(
      'hiv_bayi_arv' => 'Pemberian ARV',
      'hiv_dbs_eid' => 'DBS EID pada usia 6-8 Minggu',
      'hiv_eid' => 'Konfirmasi EID dalam 12 bulan',
      'hiv_serologis' => 'Pemeriksaan balita terdeteksi HIV (serologis) (Bayi usia >=9 bulan atau anak balita)',
      'hiv_pdp' => 'Balita HIV masuk perawatan PDP',
      'hiv_obat_arv' => 'Balita HIV mendapat pengobatan ARV') as $ppia_screening => $judul)
    <input type="hidden" name="ppia_screening_kode[{{ $ppia_id }}]" value="{{ $ppia_screening }}"/>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">{{ $judul }}</label>
      <div class="col-sm-3">
        <div class="input-group">
        <input type="text" class="form-control datepicker" name="ppia_screening_tgl[{{ $ppia_id }}]" value="@if(isset($ppia_def_sc[$ppia_screening])){{ $ppia_def_sc[$ppia_screening]->tgl }}@endif" placeholder="Tanggal" autocomplete="off">
        <label class="input-group-text"><i class="feather icon-calendar"></i></label>
        </div>
      </div>
      @if (in_array($ppia_id,array(11,12,13)))
      <div class="col-sm-3 form-radio">
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value[{{ $ppia_id }}]" value="1" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value == 1) checked @endif><i class="helper"></i>Reaktif</label>
        </div>
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value[{{ $ppia_id }}]" value="2" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value == 2) checked @endif><i class="helper"></i>Non Reaktif</label>
        </div>
      </div>
      @else
      <div class="col-sm-3">
        <input type="text" class="form-control" name="ppia_value[{{ $ppia_id }}]" value="@if(isset($ppia_def_sc[$ppia_screening])){{ $ppia_def_sc[$ppia_screening]->value }}@endif" placeholder="Hasil" autocomplete="off">
      </div>
      @endif
    </div>
    @php $ppia_id+=1 @endphp
    @endforeach
    <hr>
    <h5>PEMANTAUAN BAYI DARI IBU SIFILIS</h5>
    @foreach(array(
      'sifilis_bayi_dirujuk' => 'Bayi dari ibu Sifilis dirujuk',
      'sifilis_diperiksa' => 'Bayi < 2 tahun diperiksa Sifilis') as $ppia_screening => $judul)
    <input type="hidden" name="ppia_screening_kode[{{ $ppia_id }}]" value="{{ $ppia_screening }}"/>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label text-right">{{ $judul }}</label>
      <div class="col-sm-4 form-radio">
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value[{{ $ppia_id }}]" value="1" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value == 1) checked @endif><i class="helper"></i>Ya</label>
        </div>
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value[{{ $ppia_id }}]" value="2" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value == 2) checked @endif><i class="helper"></i>Tidak</label>
        </div>
      </div>
      @if ($ppia_id == 17)
      <div class="col-sm-4 form-radio">
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value_ext[{{ $ppia_id }}]" value="1" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value_ext == 1) checked @endif><i class="helper"></i>Reaktif</label>
        </div>
        <div class="radio radio-inline">
          <label><input type="radio" name="ppia_value_ext[{{ $ppia_id }}]" value="2" @if (isset($ppia_def_sc[$ppia_screening]) and $ppia_def_sc[$ppia_screening]->value_ext == 2) checked @endif><i class="helper"></i>Non Reaktif</label>
        </div>
      </div>
      @endif
    </div>
    @php $ppia_id+=1 @endphp
    @endforeach
