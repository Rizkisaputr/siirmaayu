<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Periksa;
use App\Models\AnteNatalCare;

class AnteNatalCareController extends Controller
{
  var $mod = 'anteNatalCare';
  var $title = 'Ante Natal Care';
  var $judul = array(
    'tgl' => 'Register',
    'keluhan' => 'Pemeriksaan',
    'injeksi_td' => 'Pelayanan',
    'konseling' => 'Konseling',
    'hemoglobin' => 'Laboratorium',
    'sifilis' => 'Integrasi Program',
    'komplikasi' => 'Komplikasi',
    'tata_laksana_awal' => 'Tata Laksana',
    'dirujuk_ke' => 'Dirujuk Ke');
  var $pilihan = array(
    'komplikasi' => array(
      1 => 'HDK',
      2 => 'Abortus',
      3 => 'Perdarahan',
      4 => 'Infeksi',
      5 => 'KPD',
      6 => 'Lain-lain'
    ),
    'dirujuk_ke' => array(
      1 => 'Puskesmas',
      2 => 'Klinik',
      3 => 'RSIA/RSB',
      4 => 'RS',
      5 => 'Lain-lain'),
    'tiba' => array('H' => 'Hidup','M' => 'Mati'),
    'pulang' => array('H' => 'Hidup','M' => 'Mati'),
    'refleks_patella' => array('-' => 'Negatif (-)', '+' => 'Positif (+)'),
    'glucosa_urine' => array('-' => 'Negatif (-)', '+' => 'Positif (+)'),
    'pmtct_sifilis' => array('-' => 'Negatif (-)', '+' => 'Positif (+)'),
    'pmtct_hiv' => array('-' => 'Negatif (-)', '+' => 'Positif (+)'),
    'malaria' => array('-' => 'Negatif (-)', '+' => 'Positif (+)'),
    'tbc' => array('-' => 'Negatif (-)', '+' => 'Positif (+)'),
    'status_gizi' => array(
      'K' => 'Gizi Kurang',
      'N' => 'Normal',
      'G' => 'Cendrung gemuk',
      'O' => 'Obesitas'),
    'kepala_pap' => array(
      'M' => 'Masuk (M)',
      'BM' => 'Belum Masuk (BM)'),
    'presentasi' => array(
      'KP' => 'Kepala (KP)',
      'BS' => 'Bokong/Sungsang (BS)',
      'LLO' =>  'Letak Lintang/Obligue (LLO)'),
    'jumlah_janin' => array(
      'T' => 'Tunggal',
      'G' =>  'Ganda')
    );
  var $ya_tidak = array(
    'jkn',
    'injeksi_td',
    'catat_buku_kia',
    'pmtct_hbsag',
    'malaria_kelambu_berinsektisida',
    'tbc_skrining_anamnesis',
    'tbc_dahak');

  var $ditulis = array(
    'pmtct_arv_profilaksis',
    'malaria_obat',
    'tbc_obat');

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function table($periksa, Request $request)
  {
    $periksa = Periksa::findBySlug($periksa);
    $data = AnteNatalCare::where('k1_id',$periksa->id)->orderBy('tgl');
    $pilihan = $this->pilihan;
    $pil = array(); foreach($pilihan as $pp => $emp) { $pil[] = $pp; }
    $ya_tidak = $this->ya_tidak;
    return view('forms.periksa.ante_natal_care.table',compact('data','ya_tidak','pilihan','pil','ya_tidak'));
  }

  public function create($periksa)
  {
    $periksa = Periksa::findBySlug($periksa);
    $judul = $this->judul;
    $pilihan = $this->pilihan;
    $ya_tidak = $this->ya_tidak;
    $ditulis = $this->ditulis;
    return view('forms.periksa.ante_natal_care.form',compact('periksa','judul','pilihan','ya_tidak','ditulis'));
  }

  public function edit($id)
  {
    $def = AnteNatalCare::findBySlug($id);
    $periksa = Periksa::find($def->k1_id);
    $judul = $this->judul;
    $pilihan = $this->pilihan;
    $ya_tidak = $this->ya_tidak;
    $ditulis = $this->ditulis;
    return view('forms.periksa.ante_natal_care.form',compact('periksa','def','judul','pilihan','ya_tidak','ditulis'));
  }
  public function write(Request $request)
  {
    $saveData = array();
    foreach(array(
      'k1_id',
      'tgl',
      'jkn',
      'usia_kehamilan',
      'trimester',
      'keluhan',
      'bb',
      'td',
      'map',
      'nadi',
      'respirasi',
      'suhu',
      'lila',
      'status_gizi',
      'tfu',
      'refleks_patella',
      'ddj',
      'kepala_pap',
      'tbj',
      'presentasi',
      'jumlah_janin',
      'injeksi_td',
      'catat_buku_kia',
      'fe',
      'pmt_bumil_kek',
      'ikut_tkelas_ibu',
      'kalsium',
      'asetosal',
      'konseling',
      'hemoglobin',
      'glucosa_urine',
      'pmtct_sifilis',
      'pmtct_hbsag',
      'pmtct_hiv',
      'pmtct_arv_profilaksis',
      'malaria',
      'malaria_obat',
      'malaria_kelambu_berinsektisida',
      'tbc_skrining_anamnesis',
      'tbc_dahak',
      'tbc',
      'tbc_obat',
      'covid19_sehat',
      'covid19_kontak_erat',
      'covid19_suspek',
      'covid19_terkonfirmasi',
      'komplikasi',
      'tata_laksana_awal',
      'dirujuk_ke',
      'tiba',
      'pulang',
      'keterangan') as $a)
      {
        $saveData[$a] = $request->$a;
      }

      if ($request->id == null) AnteNatalCare::create($saveData);
      else AnteNatalCare::find($request->id)->update($saveData);

      die(json_encode(array(
        'status' => true,
        'message' => $this->title.' berhasil disimpan ...'
      )));
    }

    public function delete($id)
    {
      $data = AnteNatalCare::findBySlug($id)->delete();

      die(json_encode(array(
        'status' => true,
        'message' => $this->title.' berhasil dihapus ...'
      )));
    }


}
