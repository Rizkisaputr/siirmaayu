<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Periksa;
use App\Models\PostNatal;

class PostNatalController extends Controller
{
  var $mod = 'post_natal';
  var $title = 'Post Natal';
  var $judul = array(
    'td' => 'Tanda Vital',
    'tfu' => 'Pemeriksaan',
    'catat_buku_kia' => 'Pelayanan',
    'cd4' => 'Integrasi Program',
    'komplikasi' => 'Komplikasi',
    'klasifikasi' => 'Klasifikasi',
    'tata_laksana' => 'Tata Laksana',
    'dirujuk_ke' => 'Dirujuk Ke',
    'tiba' => 'Keadaan');

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function table($periksa, Request $request)
  {
    $periksa = Periksa::findBySlug($periksa);
    $data = PostNatal::where('k1_id',$periksa->id)->orderBy('tgl');
    $judul = $this->judul;

    return view('forms.periksa.'.$this->mod.'.table',compact('data','judul'));
  }

  public function create($periksa)
  {
    $periksa = Periksa::findBySlug($periksa);
    $judul = $this->judul;
    return view('forms.periksa.'.$this->mod.'.form',compact('periksa','judul'));
  }
  public function edit($id)
  {
    $def = PostNatal::findBySlug($id);
    $periksa = Periksa::find($def->k1_id);
    $judul = $this->judul;
    return view('forms.periksa.'.$this->mod.'.form',compact('periksa','def','judul'));
  }
  public function write(Request $request)
  {
    $saveData = array();
    foreach(array(
      'k1_id',
      'tgl',
      'hari_ke',
      'td',
      'suhu',
      'nadi',
      'respirasi',
      'catat_buku_kia',
      'fe',
      'vit_a',
      'cd4',
      'anti_malaria',
      'anti_tb',
      'arv',
      'komplikasi',
      'klasifikasi',
      'tata_laksana',
      'dirujuk_ke',
      'tiba',
      'pulang',
      'tfu',
      'bak',
      'bab',
      'lochea',
      'masalah_payudara') as $a)
      {
        $saveData[$a] = $request->$a;
      }

      if ($request->id == null) PostNatal::create($saveData);
      else PostNatal::find($request->id)->update($saveData);

      die(json_encode(array(
        'status' => true,
        'message' => $this->title.' berhasil disimpan ...'
      )));
    }

    public function delete($id)
    {
      $data = PostNatal::findBySlug($id)->delete();

      die(json_encode(array(
        'status' => true,
        'message' => $this->title.' berhasil dihapus ...'
      )));
    }


}
