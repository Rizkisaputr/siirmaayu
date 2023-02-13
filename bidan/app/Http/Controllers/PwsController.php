<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\K1;
use App\Models\Puskesmas;
use App\Models\Desa;
use App\Models\Pws;
use App\Models\PwsTarget;

class PwsController extends Controller
{
  var $mod = 'pws';
  var $title = 'Laporan PWS';
  var $bln = array(
    '01'=>'Januari',
    '02'=>'Februari',
    '03'=>'Maret',
    '04'=>'April',
    '05'=>'Mei',
    '06'=>'Juni',
    '07'=>'Juli',
    '08'=>'Agustus',
    '09'=>'September',
    '10'=>'Oktober',
    '11'=>'November',
    '12'=>'Desember');

  var $extend = true;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      $title = $this->title;
      $mod = $this->mod;
      $cbBln = $this->bln;
        $cbBln = $this->bln;
        $cbThn = array();
        for($i = date('Y'); $i <= date('Y')+5; $i++)
        {
          $cbThn[] = $i;
        }
        $bln = date('m');
        $thn = date('Y');


      return view('indexs.pws', compact('mod','title','cbBln','cbThn','bln','thn'));
  }

  public function table(Request $request)
  {
    $d = null;
    $puskesmas = null;
    $desa = null;
    $bln = $request->bulan;
    $thn = $request->tahun;
    $tgl = (isset($bln)) ? $this->bln[$bln].' '.$thn : $thn;
    $psk = $request->puskesmas;
    if ($request->puskesmas != null)
    {
      $puskesmas = Puskesmas::find($request->puskesmas);
      $desa = Desa::where('kecamatan_id',$puskesmas->kecamatan_id);
      $d = array();

      foreach(Pws::where([
        'bulan' => $bln,
        'tahun' => $thn,
        'puskesmas_id' => $psk
      ])->get() as $e) {
        $d[$e->desa_id] = $e;
      };
    }
    $col = array(
      'bumil',
      'bulin',
      'bayi',
      'balita',
      'k1_bln_lalu',
      'k1_bln',
      'k1_abs',
      'k1_persen',
      'k4_bln_lalu',
      'k4_bln',
      'k4_abs',
      'k4_persen',
      'persalinan_bln_lalu',
      'persalinan_bln',
      'persalinan_abs',
      'persalinan_persen',
      'kf_bln_lalu',
      'kf_bln',
      'kf_abs',
      'kf_persen',
      'dkn_bln_lalu',
      'dkn_bln',
      'dkn_abs',
      'dkn_persen',
      'pk_bln_lalu',
      'pk_bln',
      'pk_abs',
      'pk_persen',
      'cpr_bln_lalu',
      'cpr_bln',
      'cpr_abs',
      'cpr_persen');
    if ($request->has('print')) return view('prints.pws',compact('d','puskesmas','desa','psk','bln','thn','col','tgl'));
    else return view('forms.pws',compact('d','puskesmas','desa','psk','bln','thn','col'));

  }

  public function create()
  {
    $mod = $this->mod;
    $title = $this->title;
    $cell = $this->cell;
    $url = route($this->mod.'Write');
    $kabupaten = Kabupaten::first();
    return view('forms.'.$this->mod, compact('mod','title','cell','url','kabupaten'));
  }

  public function edit($id)
  {
    $def = PWS::findBySlug($id);
    $mod = $this->mod;
    $title = $this->title;
    $cell = $this->cell;
    $url = route($this->mod.'Write');
    $kabupaten = Kabupaten::first();
    return view('forms.'.$this->mod,compact('def','mod','title','cell','url','kabupaten'));
  }

  public function write(Request $request)
  {
    $save = array(); foreach($this->cell as $c)
    {
      $save[$c] = $request->$c;
    }

    if ($request->id == null) PWS::create($save);
    else PWS::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
    )));
  }

  public function delete($id)
  {
    $data = PWS::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function dropdown(Request $request)
  {
    $data = PWS::selectRaw('id,nama_pws text')->orderBy('nama_pws');

    if ($request->term != null) $data->whereRaw("(nama_pws LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
    $data = $data->get();

    die(json_encode($data));
  }

  public function target(Request $request)
  {
    $mod = 'target';
    $title = 'Target Puskesmas';
    $cbBln = $this->bln;
    $cbThn = array();
    for($i = date('Y'); $i <= date('Y')+5; $i++)
    {
      $cbThn[] = $i;
    }
    $bln = date('m');
    $thn = date('Y');

    return view('indexs.target',compact('mod','title','cbBln','cbThn','bln','thn'));
  }

  public function targetTable(Request $request)
  {

    $d = null;
    $puskesmas = null;
    $desa = null;
    $bln = $request->bulan;
    $thn = $request->tahun;
    $psk = $request->puskesmas;
    if ($request->puskesmas != null)
    {
      $puskesmas = Puskesmas::find($request->puskesmas);
      $desa = Desa::where('kecamatan_id',$puskesmas->kecamatan_id);
      $d = array();

      foreach(PwsTarget::where([
        'bulan' => $bln,
        'tahun' => $thn,
        'puskesmas_id' => $psk
      ])->get() as $e) {
        $d[$e->desa_id] = $e;
      };
    }
    return view('forms.target',compact('d','puskesmas','desa','psk','bln','thn'));

  }

  public function targetWrite(Request $request)
  {
    foreach($request->desa_id as $d)
    {
        $save = array('desa_id' => $d);
        foreach(array(
          'k1',
          'k4',
          'persalinan',
          'kf',
          'dkn',
          'pk',
          'cpr') as $a) {
          $save[$a] = $request->$a[$d];
        }

        foreach(array(
          'puskesmas_id',
          'bulan',
          'tahun',
          ) as $a) {
          $save[$a] = $request->$a;
        }

        $cekTarget = PwsTarget::where(['desa_id' => $d, 'bulan' => $request->bulan, 'tahun' => $request->tahun])->first();
        if ($cekTarget == null) PwsTarget::create($save);
        else PwsTarget::find($cekTarget->id)->update($save);
    }
    die(json_encode(array(
      'status' => true,
      'url' => route('target'),
      'message' => 'Target PWS berhasil disimpan ...'
    )));
  }

}
