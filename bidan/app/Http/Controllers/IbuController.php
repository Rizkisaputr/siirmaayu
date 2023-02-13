<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Ibu;
use App\Models\Puskesmas;
use App\Models\Posyandu;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;

class IbuController extends Controller
{
  var $mod = 'ibu';
  var $title = 'Data Ibu';
  var $col = array(
    'Periksa' => 'periksa',
    'Register' => 'no_registrasi',
    'Nama' => 'nama_ibu',
    'Tanggal Lahir' => 'tgl_lahir',
    'NIK' => 'nik',
    'Puskesmas' => 'puskesmas',
    'Bidan' => 'bidan'
  );

  var $cell = array(
    'tgl_register',
    'no_registrasi',
    'bidan_id',
    'kader_id',
    'posyandu_id',
    'puskesmas_id',
    'nama_ibu',
    'nama_suami',
    'tgl_lahir',
    'nik',
    'nkk',
    'umur',
    'telp',
    'alamat',
    'rt',
    'rw',
    'desa_id',
    'kecamatan_id',
    'kabupaten_id',
    'provinsi_id',
    'pendidikan_id',
    'pekerjaan_id',
    'agama',
    'pembiayaan',
    'disabilitas',
    'catatan_khusus'
  );
  var $ddown = array(
    'agama' => array(
      1 => 'Islam',
      2 => 'Katholik',
      3 => 'Kristen',
      4 => 'Hindu',
      5 => 'Budha',
      0 => 'Lain-Lain'
    ),
    'pembiayaan' => array(
      1 => 'JKN',
      2 => 'Jampersal',
      3 => 'Asuransi Kesehatan lain',
      4 => 'Mandiri'
    ));

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      $title = $this->title;
      $mod = $this->mod;
      $col = $this->col;
      return view('layouts.index', compact('mod','col','title'));
  }

  public function table()
  {
    $data = Ibu::all();

    return DataTables::of($data)
    ->addColumn('aksi', function($data) {
          return '
          <div class="nowrap">
            <a class="m-r-10 btn btn-sm btn-info" href="'.route($this->mod.'Edit',$data).'" onclick="return formOpen(this)"><i class="feather icon-edit-2"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="'.route($this->mod.'Delete',$data).'" onclick="return hapusData(this)"><i class="feather icon-trash-2" style="margin-right: 0 !important"></i></a>
          </div>';
      })
    ->addColumn('bidan', function($data) {
          return ($data->bidan != null) ? $data->bidan->nama_bidan : null; })
    ->addColumn('puskesmas', function($data) {
          return ($data->puskesmas != null) ? $data->puskesmas->nama_puskesmas : null; })
    ->addColumn('periksa', function($data) {
          $cnt = $data->periksa()->count();
          return '<a href="'.route('periksa',$data).'" class="btn btn-sm '.($cnt > 0 ? 'btn-info' : 'btn-primary').'" onclick="return formOpen(this)"><i class="feather icon-'.($cnt > 0 ? 'layers' : 'plus').'"></i> Pemeriksaan</a>';
    })
    ->addIndexColumn()
    ->rawColumns(['aksi', 'periksa'])
    ->make(true);
  }

  public function create()
  {
    $mod = $this->mod;
    $title = $this->title;
    $cell = $this->cell;
    $url = route($this->mod.'Write');
    $ddown = $this->ddown;
    return view('forms.'.$this->mod, compact('mod','title','cell','url','ddown'));
  }

  public function edit($id)
  {
    $def = Ibu::findBySlug($id);
    $mod = $this->mod;
    $title = $this->title;
    $cell = $this->cell;
    $ddown = $this->ddown;
    $url = route($this->mod.'Write');
    return view('forms.'.$this->mod,compact('def','mod','title','cell','url','ddown'));
  }

  public function write(Request $request)
  {
    $save = array(); foreach($this->cell as $c)
    {
      $save[$c] = $request->$c;
    }

    if ($request->id == null) {
      $ibu = Ibu::create($save);
    } else {
      $ibu = Ibu::find($request->id);
      $ibu->update($save);
    }

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...',
      'redirect' => ($request->id == null) ? route('periksa',$ibu) : null
    )));
  }

  public function delete($id)
  {
    $data = Ibu::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }


  public function dropdown($type, Request $request)
  {
    switch ($type) {
      case 'pekerjaan':
        $data = Posyandu::selectRaw('id,CONCAT(kode," - ",nama_posyandu) text')
          ->orderBy('kode');
      if ($request->term != null) $data->whereRaw("(nama_posyandu LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
      $data = $data->get();
      break;
      case 'pendidikan':
        $data = Posyandu::selectRaw('id,CONCAT(kode," - ",nama_posyandu) text')
          ->orderBy('kode');
      if ($request->term != null) $data->whereRaw("(nama_posyandu LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
      $data = $data->get();
      break;
    }
    die(json_encode($data));
  }

}
