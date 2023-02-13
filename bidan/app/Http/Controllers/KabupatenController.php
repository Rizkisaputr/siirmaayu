<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Kabupaten;

class KabupatenController extends Controller
{
  var $mod = 'kabupaten';
  var $title = 'Kabupaten';
  var $col = array(
    'Provinsi' => 'provinsi',
    'Kode' => 'kode',
    'Nama Kabupaten' => 'nama_kabupaten'
  );

  var $cell = array(
    'provinsi_id',
    'kode',
    'nama_kabupaten'
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
      return view('layouts.index', compact('mod','col','title','extend'));
  }

  public function table(Request $request)
  {
    $data = Kabupaten::orderBy('provinsi_id')->orderBy('kode');

    if ($request->provinsi != null) $data->where('provinsi_id',$request->provinsi);

    return DataTables::of($data)
    ->addColumn('aksi', function($data) {
          return '
          <div class="nowrap">
            <a class="m-r-10 btn btn-info" href="'.route($this->mod.'Edit',$data).'" onclick="return formOpen(this)"><i class="feather icon-edit-2"></i> Edit</a>
            <a class="btn btn-danger" href="'.route($this->mod.'Delete',$data).'" onclick="return hapusData(this)"><i class="feather icon-trash-2" style="margin-right: 0 !important"></i></a>
          </div>';
    })
    ->addColumn('provinsi', function($data) {
          return ($data->provinsi != null) ? $data->provinsi->kode.' '.$data->provinsi->nama_provinsi : null;
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
    $def = Kabupaten::findBySlug($id);
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

    if ($request->id == null) Kabupaten::create($save);
    else Kabupaten::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
    )));
  }

  public function delete($id)
  {
    $data = Kabupaten::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function dropdown(Request $request)
  {
    $data = Kabupaten::selectRaw('id,CONCAT(kode," - ",nama_kabupaten) text')
    ->where('provinsi_id',($request->provinsi != null)?$request->provinsi:null)
    ->orderBy('kode');

    if ($request->term != null) $data->whereRaw("(nama_kabupaten LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
    $data = $data->get();

    die(json_encode($data));
  }

}
