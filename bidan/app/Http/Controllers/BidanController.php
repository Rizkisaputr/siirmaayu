<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Bidan;

class BidanController extends Controller
{
  var $mod = 'bidan';
  var $title = 'Bidan';
  var $col = array(
    'Nama Bidan' => 'nama_bidan',
    'Nip' => 'nip',
    'Telepon' => 'telp'
  );

  var $cell = array(
    'nama_bidan',
    'nip',
    'alamat',
    'telp');

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
      return view('layouts.index', compact('mod','col','title'));
  }

  public function table(Request $request)
  {
    $data = Bidan::orderBy('nama_bidan');

    if ($request->provinsi != null) $data->where('provinsi_id',$request->provinsi);

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
    $def = Bidan::findBySlug($id);
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

    if ($request->id == null) Bidan::create($save);
    else Bidan::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
    )));
  }

  public function delete($id)
  {
    $data = Bidan::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function dropdown(Request $request)
  {
    $data = Bidan::selectRaw('id,nama_bidan text')->orderBy('nama_bidan');

    if ($request->term != null) $data->whereRaw("(nama_bidan LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
    $data = $data->get();

    die(json_encode($data));
  }

}
