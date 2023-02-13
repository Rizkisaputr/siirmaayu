<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Models\AnteNatalCare;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Periksa;
use App\Models\Trimester;
use App\Models\Ibu;
use App\Models\Persalinan;
use App\Models\PersalinanData;
use App\Models\PersalinanMasa;
use App\Models\Kontrasepsi;
use App\Models\Ppia;
use App\Models\PpiaScreening;
use App\Models\Pe;
use App\Models\Pws;
use App\Models\PwsTarget;
use App\Models\UsgTm3;
use App\Models\PostNatal;

class PeriksaController extends Controller
{
  var $mod = 'periksa';
  var $title = 'Pemeriksaan Ibu';
  var $pe = array(
    'Anamnesis' => array(
      1 => 'Multipara dengan Kehamilan oleh Pasangan Baru',
      2 => 'Kehamilan dengan teknologi reproduksi berbantu: bayi tabung, obat induksi ovulasi',
      3 => 'Umur>=35 Tahun',
      4 => 'Nulipara',
      5 => 'Multipara yang jarak kehamilan sebelumnya > 10 tahun',
      6 => 'Riwayat preeklampsia ibu atau saudara perempuan',
      7 => 'Obesitas sebelum hamil (IMT>30kg/m2)',
      8 => 'Multipara dengan riwayat preeklampsia sebelumnya',
      9 => 'Kehamilan Multiple',
      10 => 'Diabetes dalam kehamilan',
      11 => 'Hipertensi Kronik',
      12 => 'Penyakit Ginjal',
      13 => 'Penyakit Autoimun',
      14 => 'Keguguran Berulang (APS), riwayat IUFD',
    ),
    'Pemeriksaan Fisik' => array(
      1 => 'Mean Arterial Pressure (MAP) >= 90mmHg',
      2 => 'Proteinuria (urin celup > +1 pada 2 kali pemeriksaan berjarak 6 jam atau segera kuantitatif 300mg/24jam)'
    ));

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index($ibu, Request $request)
  {
      $ibu = Ibu::findBySlug($ibu);
      $title = $this->title;
      $mod = $this->mod;
      $url = route('periksaWrite');
      $tm = $prsln = $prsln_kode = $kntsps_def = $ppia_def_sc = $pe_def = array();
      $ppia_def = $usg_tm3_def = $prsln_data = null;
      $def = ($request->periksa != null) ? Periksa::find($request->periksa) : Periksa::where('ibu_id',$ibu->id)->orderBy('tgl_periksa','desc')->limit(0)->first();
      if ($def != null)
      {
        $prsln_data = Persalinan::where('k1_id',$def->id)->first();
        foreach($def->tm()->get() as $a) { $tm[$a->ke] = $a; }
        if ($prsln_data != null and $prsln_data->masa() != null) { foreach($prsln_data->masa()->get() as $s) { $prsln[$s->kode] = $s; } }
        if ($prsln_data != null and $prsln_data->data() != null) { foreach($prsln_data->data()->get() as $s) { $prsln_kode[$s->kode] = $s->value; } }
        foreach($def->kontrasepsi()->get() as $k) { $kntsps_def[$k->kode] = $k; }
        $ppia_def = Ppia::where('k1_id',$def->id)->first();
        $usg_tm3_def = UsgTm3::where('k1_id',$def->id)->first();

        if ($ppia_def != null) {
          foreach(PpiaScreening::where('ppia_id',$ppia_def->id)->get() as $psc) {
            $ppia_def_sc[$psc->kode] = $psc;
          }
        }

        foreach($def->pe()->get() as $p)
        {
          $pe_def[$p->kode] = $p->val;
        }
      }
      $custom = 'formPeriksaSave(this)';
      $pe = $this->pe;

      return view('forms.periksa', compact('mod','title','ibu','url','def','tm','usg_tm3_def','custom','prsln','prsln_kode','prsln_data','kntsps_def','ppia_def','ppia_def_sc','pe','pe_def'));
  }

  public function table(Request $request)
  {
    $data = Kecamatan::orderBy('kabupaten_id')->orderBy('kode');

    if ($request->provinsi != null) $data->whereHas('kabupaten',function($query) use ($request) {
        $query->where('provinsi_id',$request->provinsi);
    });
    if ($request->kabupaten != null) $data->where('kabupaten_id',$request->kabupaten);

    return DataTables::of($data)
    ->addColumn('aksi', function($data) {
          return '
          <div class="nowrap">
            <a class="m-r-10 btn btn-info" href="'.route($this->mod.'Edit',$data).'" onclick="return formOpen(this)"><i class="feather icon-edit-2"></i> Edit</a>
            <a class="btn btn-danger" href="'.route($this->mod.'Delete',$data).'" onclick="return hapusData(this)"><i class="feather icon-trash-2" style="margin-right: 0 !important"></i></a>
          </div>';
    })
    ->addColumn('kabupaten', function($data) {
          return ($data->kabupaten != null) ? $data->kabupaten->kode.' '.$data->kabupaten->nama_kabupaten : null;
    })
    ->addIndexColumn()
    ->rawColumns(['aksi'])
    ->make(true);
  }

  public function write(Request $request)
  {

    $tgl_hitung = array();

    $cell = array(
      'ibu_id',
      'gravida',
      'partus',
      'abortus',
      'hidup',
      'komplikasi_kebidanan',
      'riwayat_persalinan',
      'riwayat_penyakit_kronis_alergi',
      'riwayat_penyakit_menular',
      'riwayat_kb',
      'tgl_periksa',
      'tgl_hpht',
      'taksiran_persalinan',
      'persalinan_sebelum',
      'bb_sebelum_hamil',
      'imt',
      'rekomen_bb',
      'bb_sekarang',
      'tinggi',
      'lila',
      'gizi',
      'buku_kia',
      'gol_darah',
      'rhesus',
      'tgl_rencana',
      'penolong',
      'tempat',
      'pendamping',
      'transportasi',
      'pendonor_darah',
      'pendonor_gol_darah');

    $save = array(); foreach($cell as $c)
    {
      $save[$c] = $request->$c;
    }

    $tgl_hitung[] = $request->tgl_periksa;
    $tgl_hitung[] = $request->tgl_hpht;

    if ($request->id == null) $k1 = Periksa::create($save);
    else {
      $k1 = Periksa::find($request->id);
      $k1->update($save);
    }

    //-- Trimester
    if ($request->tm != null)
    {
      foreach($request->tm as $t => $ke)
      {
        $saveTm = array(
          'k1_id' => $k1->id,
          'ke' => $t,
          'gs' => (isset($request->gs[$t]))?$request->gs[$t]:null,
          'crl' => (isset($request->crl[$t]))?$request->crl[$t]:null,
          'djj' => (isset($request->djj[$t]))?$request->djj[$t]:null,
          'sesuai_usia_kehamilan' => (isset($request->sesuai_usia_kehamilan[$t]))?$request->sesuai_usia_kehamilan[$t]:null,
          'skrining_preeklamsi' => $request->skrining_preeklamsi,
          'kesimpulan' => $request->kesimpulan,
          'rekomendasi' => $request->rekomendasi,
          'hb' => $request->hb,
          'gd_puasa' => $request->gd_puasa,
          'gd_2jam_pp' => $request->gd_2jam_pp,
          'taksiran_persalinan' => (isset($request->tksrn_persalinan[$t]))?$request->tksrn_persalinan[$t]:null);

        foreach(array('konjungtiva','sklera','kulit','leher','gigi_mulut','tht','jantung','paru','perut','tungkai') as $h)
        {
          if(isset($request->$h[$t])) $saveTm[$h] = $request->$h[$t];
        }

        $cekTm = Trimester::where(['k1_id' => $k1->id,'ke' => $t])->first();
        if ($cekTm == null) Trimester::create($saveTm);
        else Trimester::find($cekTm->id)->update($saveTm);
      }
    }

    //-- Skrining Preeklamsia
    if ($request->pe_value != null)
    {
      foreach($request->pe_value as $kd => $p)
      {
        if ($p != null) {
          $savePe = array(
            'k1_id' =>  $k1->id,
            'kode' => $kd,
            'val' => $p
          );
          $cekPe = Pe::where(['k1_id' => $k1->id,'kode' => $kd])->first();
          if ($cekPe == null) Pe::create($savePe);
          else Pe::find($cekPe->id)->update($savePe);
        }
      }
    }

    //-- USG TM 3
    $saveUsgTm3 = array(
      'k1_id' => $k1->id,
      'hpht' => $request->usg_tm3_hpht,
      'minggu_kehamilan' => $request->usg_tm3_minggu_kehamilan,
      'janin' => $request->usg_tm3_janin,
      'jumlah' => $request->usg_tm3_jumlah,
      'letak' => $request->usg_tm3_letak,
      'berat' => $request->usg_tm3_berat,
      'plasenta' => $request->usg_tm3_plasenta,
      'usia_kehamilan' => $request->usg_tm3_usia_kehamilan,
      'bpd' => $request->usg_tm3_bpd,
      'hc' => $request->usg_tm3_hc,
      'ac' => $request->usg_tm3_ac,
      'fl' => $request->usg_tm3_fl,
      'ketuban' => $request->usg_tm3_ketuban);

    $cekUsgTm3 = UsgTm3::where('k1_id',$k1->id)->first();
    if($cekUsgTm3 == null) $prs = UsgTm3::create($saveUsgTm3);
    else {
      $UsgTm3 = UsgTm3::find($cekUsgTm3->id);
      $UsgTm3->update($saveUsgTm3);
    }

    //-- Persalinan
    $savePrs = array(
      'k1_id' => $k1->id,
      'usia_kehamilan' => $request->usia_kehamilan,
      'usia_hpht' => $request->usia_hpht,
      'keadaan_ibu' => $request->keadaan_ibu,
      'keadaan_bayi' => $request->keadaan_bayi,
      'berat_bayi' => $request->berat_bayi,
      'jenis_kelamin' => $request->jenis_kelamin,
      'panjang_bayi' => $request->panjang_bayi
    );
    $cekPersalinan = Persalinan::where('k1_id',$k1->id)->first();
    if($cekPersalinan == null) $prs = Persalinan::create($savePrs);
    else {
      $prs = Persalinan::find($cekPersalinan->id);
      $prs->update($savePrs);
    }

    if ($request->kode != null)
    {
      foreach($request->kode as $k)
      {
          $saveMs = array(
            'persalinan_id' => $prs->id,
            'kode' => $k,
            'tgl' => $request->tgl[$k],
            'jam' => $request->jam[$k]
          );
          $cekMs = PersalinanMasa::where(['persalinan_id' => $prs->id,'kode' => $k])->first();
          if ($cekMs == null) PersalinanMasa::create($saveMs);
          else PersalinanMasa::find($cekMs->id)->update($saveMs);
      }
    }

    if ($request->prsln_kode != null)
    {
      foreach($request->prsln_kode as $prk)
      {
        $saveDt = array(
          'persalinan_id' => $prs->id,
          'kode' => $prk,
          'value' => (isset($request->prsln_kode_val[$prk])) ? $request->prsln_kode_val[$prk] : null
        );
        $cekDt = PersalinanData::where(['persalinan_id' => $prs->id,'kode' => $prk])->first();
        if ($cekDt == null) PersalinanData::create($saveDt);
        else PersalinanData::find($cekDt->id)->update($saveDt);
      }
    }

    //-- Kontrasepsi
    if ($request->kt_kode != null)
    {
      foreach($request->kt_kode as $kt)
      {
        $saveKt = array(
          'k1_id' => $k1->id,
          'kode' => $kt,
          'tgl' => $request->kt_tgl[$kt],
          'rencana' => $request->kt_rencana[$kt],
          'pelaksanaan' => $request->kt_pelaksanaan[$kt],
        );
        $cekKt = Kontrasepsi::where(['k1_id' => $k1->id,'kode' => $kt])->first();
        if ($cekKt == null) Kontrasepsi::create($saveKt);
        else Kontrasepsi::find($cekKt->id)->update($saveKt);
      }
    }

    //-- Ppia

    $savePpia = array(
      'k1_id' => $k1->id,
      'hiv_tgl_pdp' => $request->sc_hiv_tgl_pdp,
      'hiv_tgl_arv' => $request->sc_hiv_tgl_arv,
      'sifilis' => $request->sc_sifilis,
      'sifilis_diobati' => $request->sc_sifilis_diobati,
      'pasangan_tahu' => $request->sc_pasangan_tahu,
      'pasangan_diperiksa_sifilis' => $request->sc_pasangan_diperiksa_sifilis,
      'faskes_rujukan' => $request->sc_faskes_rujukan
    );
    $cekPpia = Ppia::where(['k1_id' => $k1->id])->first();
    if ($cekPpia == null) $ppia = Ppia::create($savePpia);
    else {
      $ppia = Ppia::find($cekPpia->id);
      $ppia->update($savePpia);
    }

    if ($request->ppia_screening_kode != null)
    {
      foreach($request->ppia_screening_kode as $i => $p_sc) {
        $savePpiaSc = array(
          'ppia_id' => $ppia->id,
          'kode' => $p_sc,
          'tgl' => isset($request->ppia_screening_tgl[$i]) ? $request->ppia_screening_tgl[$i] : null,
          'value' => isset($request->ppia_value[$i]) ? $request->ppia_value[$i] : null,
          'value_ext' => isset($request->ppia_value_ext[$i]) ? $request->ppia_value_ext[$i] : null );
        $cekPpiaSc = PpiaScreening::where(['ppia_id' => $ppia->id,'kode' => $p_sc])->first();
        if ($cekPpiaSc == null) PpiaScreening::create($savePpiaSc);
        else PpiaScreening::find($cekPpiaSc->id)->update($savePpiaSc);
      }
    }

    $ibu = Ibu::find($request->ibu_id);

    foreach($tgl_hitung as $t)
    {
      if ($t != null) {
        $bln = substr($t,5,2);
        $thn = substr($t,0,4);
        Self::hitung($bln,$thn);
      }
    }

    die(json_encode(array(
      'status' => true,
      'url' => route('periksa',$ibu),
      'message' => $this->title.' berhasil disimpan ...',
      'anc' => route('anteNatalCareCreate',$k1),
      'pn' => route('postNatalCreate',$k1)
    )));
  }

  public function delete($id)
  {
    $data = Kecamatan::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function dropdown(Request $request)
  {
    $data = Kecamatan::selectRaw('id,CONCAT(kode," - ",nama_kecamatan) text')
    ->where('kabupaten_id',($request->kabupaten != null)?$request->kabupaten:null)
    ->orderBy('kode');

    if ($request->term != null) $data->whereRaw("(nama_kecamatan LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
    $data = $data->get();

    die(json_encode($data));
  }

  public function hitung($bulan,$tahun, Request $request = null)
  {
    $save = array();
    $bl = Carbon::parse($tahun.'-'.$bulan.'-01')->subMonth();
    $bulan_lalu = substr($bl,5,2);
    $tahun_lalu = substr($bl,0,4);

    $bumil = Periksa::selectRaw('count(k1.id) as bumil, ibu.desa_id')
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id')
    ->whereRaw("MONTH(tgl_periksa) ='".$bulan."' AND YEAR(tgl_periksa) = '".$tahun."'");

    foreach($bumil->get() as $b)
    {
      if ($b->desa_id != null)
      {
        $save[$b->desa_id]['bumil'] = $b->bumil;
      }
    }

    $bulin = PostNatal::selectRaw('count(post_natal.id) bulin, ibu.desa_id')
    ->join('k1','k1.id','=','post_natal.k1_id')
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id')
    ->whereRaw("MONTH(tgl_periksa) ='".$bulan."' AND YEAR(tgl_periksa) = '".$tahun."'");

    //Bulin
    foreach($bulin->get() as $b)
    {
      if ($b->desa_id != null)
      {
        $save[$b->desa_id]['bulin'] = $b->bulin;
      }
    }

    //K1

    $anc = AnteNatalCare::groupBy('k1_id')->selectRaw('count(id),k1_id')->whereRaw("MONTH(ante_natal_care.tgl) ='".$bulan."' AND YEAR(ante_natal_care.tgl) = '".$tahun."'");

    $k1 = Periksa::selectRaw('count(k1.id) k1, ibu.desa_id')
    ->joinSub($anc,'anc',function($q) {
      $q->on('anc.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');


    foreach($k1->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['k1_bln'] = $b->k1;
    }

    $anc = AnteNatalCare::groupBy('k1_id')->selectRaw('count(id),k1_id')->whereRaw("MONTH(ante_natal_care.tgl) ='".$bulan_lalu."' AND YEAR(ante_natal_care.tgl) = '".$tahun_lalu."'");

    //K1 Lalu
    $k1_lalu = Periksa::selectRaw('count(k1.id) k1_lalu, ibu.desa_id')
    ->joinSub($anc,'anc',function($q) {
      $q->on('anc.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    $anc = AnteNatalCare::groupBy('k1_id')->selectRaw('count(id),k1_id')->whereRaw("MONTH(ante_natal_care.tgl) ='".$bulan."' AND YEAR(ante_natal_care.tgl) = '".$tahun."'");

    foreach($k1_lalu->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['k1_bln_lalu'] = $b->k1_lalu;
    }

    $k4 = Periksa::selectRaw('count(k1.id) k4, ibu.desa_id')
    ->joinSub($anc,'anc',function($q) {
      $q->on('anc.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($k4->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['k4_bln'] = $b->k4;
    }

    $anc = AnteNatalCare::groupBy('k1_id')->selectRaw('count(id),k1_id')->whereRaw("MONTH(ante_natal_care.tgl) ='".$bulan_lalu."' AND YEAR(ante_natal_care.tgl) = '".$tahun_lalu."'");

    //k4 Lalu
    $k4_lalu = Periksa::selectRaw('count(k1.id) k4_lalu, ibu.desa_id')
    ->joinSub($anc,'anc',function($q) {
      $q->on('anc.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($k4_lalu->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['k4_bln_lalu'] = $b->k4_lalu;
    }

    //Persalinan NAKES
    $pr = PersalinanMasa::whereRaw("kode = 3 and MONTH(tgl) ='".$bulan."' AND YEAR(tgl) = '".$tahun."'")
    ->join('persalinan','persalinan.id','=','persalinan_masa.persalinan_id')
    ->groupBy('persalinan.k1_id')
    ->selectRaw('count(persalinan_masa.id) id, k1_id');

    $salin_nakes = Periksa::selectRaw('count(k1.id) salin_nakes, ibu.desa_id')
    ->joinSub($pr,'pr',function($q) {
      $q->on('pr.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($salin_nakes->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['persalinan_bln'] = $b->salin_nakes;
    }

    //Persalinan NAKES Bulan Lalu
    $pr = PersalinanMasa::whereRaw("kode = 3 and MONTH(tgl) ='".$bulan_lalu."' AND YEAR(tgl) = '".$tahun_lalu."'")
    ->join('persalinan','persalinan.id','=','persalinan_masa.persalinan_id')
    ->groupBy('persalinan.k1_id')
    ->selectRaw('count(persalinan_masa.id) id, k1_id');

    $salin_nakes = Periksa::selectRaw('count(k1.id) salin_nakes, ibu.desa_id')
    ->joinSub($pr,'pr',function($q) {
      $q->on('pr.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($salin_nakes->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['persalinan_bln_lalu'] = $b->salin_nakes;
    }

    //KF

    $pr = PersalinanMasa::whereRaw("kode = 3")
    ->join('persalinan','persalinan.id','=','persalinan_masa.persalinan_id')
    ->select('persalinan.k1_id','persalinan_masa.tgl')->where('persalinan_masa.tgl','!=',null);

    $pst = PostNatal::selectRaw('MIN(tgl) tgl,k1_id')->groupBy('k1_id')
    ->havingRaw("MONTH(MIN(tgl)) ='".$bulan."' AND YEAR(MIN(tgl)) = '".$tahun."'");

    $pn = PostNatal::joinSub($pr, 'pr',function($q) {
        $q->on('pr.k1_id','=','post_natal.k1_id');
    })->joinSub($pst, 'pst',function($q) {
        $q->on('pst.k1_id','=','post_natal.k1_id');
    })
    ->whereRaw('DATEDIFF(pst.tgl, pr.tgl) <= 6')
    ->selectRaw('post_natal.tgl, post_natal.k1_id');

    $kf = Periksa::selectRaw('count(k1.id) kf, ibu.desa_id')
    ->joinSub($pn,'kf',function($q) {
      $q->on('kf.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($kf->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['kf_bln'] = $b->kf;
    }

    //KF Lalu

    $pr = PersalinanMasa::whereRaw("kode = 3")
    ->join('persalinan','persalinan.id','=','persalinan_masa.persalinan_id')
    ->select('persalinan.k1_id','persalinan_masa.tgl')
    ->where('persalinan_masa.tgl','!=',null);

    $pst = PostNatal::selectRaw('MIN(tgl) tgl,k1_id')
    ->groupBy('k1_id')
    ->havingRaw("MONTH(MIN(tgl)) ='".$bulan_lalu."' AND YEAR(MIN(tgl)) = '".$tahun_lalu."'");

    $pn = PostNatal::joinSub($pr, 'pr',function($q) {
        $q->on('pr.k1_id','=','post_natal.k1_id');
    })->joinSub($pst, 'pst',function($q) {
        $q->on('pst.k1_id','=','post_natal.k1_id');
    })
    ->whereRaw('DATEDIFF(pst.tgl, pr.tgl) <= 6')
    ->selectRaw('post_natal.tgl, post_natal.k1_id');

    $kf = Periksa::selectRaw('count(k1.id) kf, ibu.desa_id')
    ->joinSub($pn,'kf',function($q) {
      $q->on('kf.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($kf->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['kf_bln_lalu'] = $b->kf;
    }


    //Komplikasi
    $km = PostNatal::selectRaw('count(id),k1_id')
    ->whereRaw("komplikasi IS NOT NULL and MONTH(tgl) ='".$bulan."' AND YEAR(tgl) = '".$tahun."'")
    ->groupBy('k1_id');

    $komplks = Periksa::selectRaw('count(k1.id) kf, ibu.desa_id')
    ->joinSub($km,'km',function($q) {
      $q->on('km.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($komplks->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['dkn_bln'] = $b->kf;
    }

    //Komplikasi Lalu
    $km = PostNatal::selectRaw('count(id),k1_id')
    ->whereRaw("komplikasi IS NOT NULL and MONTH(tgl) ='".$bulan_lalu."' AND YEAR(tgl) = '".$tahun_lalu."'")
    ->groupBy('k1_id');

    $komplks = Periksa::selectRaw('count(k1.id) kf, ibu.desa_id')
    ->joinSub($km,'km',function($q) {
      $q->on('km.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($komplks->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['dkn_bln_lalu'] = $b->kf;
    }

    //PENANGANAN
    $pnn = PostNatal::selectRaw('count(id),k1_id')
    ->whereRaw("tata_laksana IS NOT NULL and MONTH(tgl) ='".$bulan."' AND YEAR(tgl) = '".$tahun."'")
    ->groupBy('k1_id');

    $pk = Periksa::selectRaw('count(k1.id) kf, ibu.desa_id')
    ->joinSub($pnn,'pnn',function($q) {
      $q->on('pnn.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($pk->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['pk_bln'] = $b->kf;
    }

    //PENANGANAN Lalu
    $pnn = PostNatal::selectRaw('count(id),k1_id')
    ->whereRaw("tata_laksana IS NOT NULL and MONTH(tgl) ='".$bulan_lalu."' AND YEAR(tgl) = '".$tahun_lalu."'")
    ->groupBy('k1_id');

    $pk = Periksa::selectRaw('count(k1.id) pk, ibu.desa_id')
    ->joinSub($pnn,'pnn',function($q) {
      $q->on('pnn.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($pk->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['pk_bln_lalu'] = $b->pk;
    }

    //KB
    $ktr = Kontrasepsi::selectRaw('count(id),k1_id')
    ->whereRaw("MONTH(tgl) ='".$bulan."' AND YEAR(tgl) = '".$tahun."'")
    ->groupBy('k1_id');

    $kb = Periksa::selectRaw('count(k1.id) kb, ibu.desa_id')
    ->joinSub($ktr,'ktr',function($q) {
      $q->on('ktr.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($kb->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['kb_bln'] = $b->kb;
    }

    //KB Lalu
    $ktr = Kontrasepsi::selectRaw('count(id),k1_id')
    ->whereRaw("MONTH(tgl) ='".$bulan_lalu."' AND YEAR(tgl) = '".$tahun_lalu."'")
    ->groupBy('k1_id');

    $kb = Periksa::selectRaw('count(k1.id) kb, ibu.desa_id')
    ->joinSub($ktr,'ktr',function($q) {
      $q->on('ktr.k1_id','=','k1.id');
    })
    ->join('ibu','ibu.id','=','k1.ibu_id')
    ->groupBy('ibu.desa_id');

    foreach($kb->get() as $b) {
      if ($b->desa_id != null) $save[$b->desa_id]['kb_bln_lalu'] = $b->kb;
    }

    foreach($save as $a => $b)
    {
      $target = PwsTarget::where([
        'desa_id' => $a,
        'bulan' => $bulan,
        'tahun' => $tahun])->first();

      if ($target != null)
      {
        $b = array_merge($b, array(
          'k1_abs' => $target->k1,
          'k4_abs' => $target->k4,
          'persalinan_abs' => $target->persalinan,
          'kf_abs' => $target->kf,
          'dkn_abs' => $target->dkn,
          'pk_abs' => $target->pk,
          'cpr_abs' => $target->cpr,
        ));
        foreach(array(
          'k1',
          'k4',
          'persalinan',
          'kf',
          'dkn',
          'pk',
          'cpr'
        ) as $c)
        {
          if (isset($b[$c.'_bln']) and $target->$c != null) $b[$c.'_persen'] = number_format($b[$c.'_bln']/$target->$c*100,2);
        }
      }

      $desa = Desa::find($a);
      $kecamatan = ($desa != null and $desa->kecamatan != null) ? Kecamatan::find($desa->kecamatan->id) : null;
      $puskesmas = ($kecamatan != null and $kecamatan->puskesmas != null) ? $kecamatan->puskesmas()->first()->id : null;

      $saveCek = array(
        'bulan' => $bulan,
        'tahun' => $tahun,
        'desa_id' => $a,
        'puskesmas_id' => ($puskesmas != null) ? $puskesmas : null,
        'desa_id' => ($desa != null) ? $desa->id : null,
        'kecamatan_id' => ($kecamatan != null) ? $kecamatan->id : null
      );
      $cek = Pws::where($saveCek)->first();

      $saveAll = array_merge($saveCek,$b);

      if ($cek == null) Pws::create($saveAll);
      else Pws::find($cek->id)->update($saveAll);
    }


  }



}
