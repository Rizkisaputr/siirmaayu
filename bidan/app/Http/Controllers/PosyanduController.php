<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Posyandu;
use App\Models\Kabupaten;

class PosyanduController extends Controller
{
  var $mod = 'posyandu';
  var $title = 'Posyandu';
  var $col = array(
    'Kecamatan' => 'kecamatan',
    'Desa' => 'desa',
    'Kode' => 'kode',
    'Nama Posyandu' => 'nama_posyandu'
  );

  var $cell = array(
    'desa_id',
    'kode',
    'nama_posyandu',
  );

  var $extend = true;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      $title = $this->title;
      $mod = $this->mod;
      $col = $this->col;
      $extend = $this->extend;
      $kabupaten = Kabupaten::first();
      return view('layouts.index', compact('mod','col','title','extend','kabupaten'));
  }

  public function table(Request $request)
  {
    $data = Posyandu::orderBy('desa_id')->orderBy('kode');
    if ($request->desa != null) $data->where('desa_id',$request->desa);

    return DataTables::of($data)
    ->addColumn('aksi', function($data) {
          return '
          <div class="nowrap">
            <a class="m-r-10 btn btn-info" href="'.route($this->mod.'Edit',$data).'" onclick="return formOpen(this)"><i class="feather icon-edit-2"></i> Edit</a>
            <a class="btn btn-danger" href="'.route($this->mod.'Delete',$data).'" onclick="return hapusData(this)"><i class="feather icon-trash-2" style="margin-right: 0 !important"></i></a>
          </div>';
    })
    ->addColumn('kecamatan', function($data) {
          return ($data->desa != null and $data->desa->kecamatan != null) ? $data->desa->kecamatan->kode.' '.$data->desa->kecamatan->nama_kecamatan : null;
    })
    ->addColumn('desa', function($data) {
          return ($data->desa != null) ? $data->desa->kode.' '.$data->desa->nama_desa : null;
    })
    ->addIndexColumn()
    ->rawColumns(['aksi'])
    ->make(true);
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
    $def = Posyandu::findBySlug($id);
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

    if ($request->id == null) Posyandu::create($save);
    else Posyandu::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
    )));
  }

  public function delete($id)
  {
    $data = Posyandu::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function dropdown(Request $request)
  {
    $data = Posyandu::selectRaw('id,nama_posyandu text')->orderBy('nama_posyandu');

    if ($request->term != null) $data->whereRaw("(nama_posyandu LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
    $data = $data->get();

    die(json_encode($data));
  }

}
