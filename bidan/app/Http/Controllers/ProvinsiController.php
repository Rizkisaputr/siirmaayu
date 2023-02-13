<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
  var $mod = 'provinsi';
  var $title = 'Provinsi';
  var $col = array(
    'Kode' => 'kode',
    'Nama Provinsi' => 'nama_provinsi'
  );

  var $cell = array(
    'kode',
    'nama_provinsi'
  );

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
    $data = Provinsi::all();

    return DataTables::of($data)
    ->addColumn('aksi', function($data) {
          return '
          <div class="nowrap">
            <a class="m-r-10 btn btn-info" href="'.route($this->mod.'Edit',$data).'" onclick="return formOpen(this)"><i class="feather icon-edit-2"></i> Edit</a>
            <a class="btn btn-danger" href="'.route($this->mod.'Delete',$data).'" onclick="return hapusData(this)"><i class="feather icon-trash-2" style="margin-right: 0 !important"></i></a>
          </div>';
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
    return view('forms.'.$this->mod, compact('mod','title','cell','url'));
  }

  public function edit($id)
  {
    $def = Provinsi::findBySlug($id);
    $mod = $this->mod;
    $title = $this->title;
    $cell = $this->cell;
    $url = route($this->mod.'Write');
    return view('forms.'.$this->mod,compact('def','mod','title','cell','url'));
  }

  public function write(Request $request)
  {
    $save = array(); foreach($this->cell as $c)
    {
      $save[$c] = $request->$c;
    }

    if ($request->id == null) Provinsi::create($save);
    else Provinsi::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
    )));
  }

  public function delete($id)
  {
    $data = Provinsi::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function dropdown(Request $request)
  {
    $data = Provinsi::selectRaw('id,CONCAT(kode," - ",nama_provinsi) text')->orderBy('kode');
    if ($request->term != null) $data->whereRaw("(nama_provinsi LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
    $data = $data->get();

    die(json_encode($data));
  }


}
