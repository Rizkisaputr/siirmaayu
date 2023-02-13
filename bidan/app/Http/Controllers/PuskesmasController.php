<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use DataTables;
use App\Models\Puskesmas;
use App\Models\Kecamatan;

class PuskesmasController extends Controller
{
  var $mod = 'puskesmas';
  var $title = 'Puskesmas';
  var $col = array(
    'Kecamatan' => 'kecamatan',
    'Kode' => 'kode',
    'Nama Puskesmas' => 'nama_puskesmas'
  );

  var $cell = array(
    'kecamatan_id',
    'kode',
    'nama_puskesmas',
    'alamat',
    'telp'
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
      $import = true;
      return view('layouts.index', compact('mod','col','title','extend','import'));
  }

  public function table(Request $request)
  {
    $data = Puskesmas::orderBy('kecamatan_id')->orderBy('kode');
    if ($request->kecamatan != null) $data->where('kecamatan_id',$request->kabupaten);

    return DataTables::of($data)
    ->addColumn('aksi', function($data) {
          return '
          <div class="nowrap">
            <a class="m-r-10 btn btn-info" href="'.route($this->mod.'Edit',$data).'" onclick="return formOpen(this)"><i class="feather icon-edit-2"></i> Edit</a>
            <a class="btn btn-danger" href="'.route($this->mod.'Delete',$data).'" onclick="return hapusData(this)"><i class="feather icon-trash-2" style="margin-right: 0 !important"></i></a>
          </div>';
    })
    ->addColumn('kecamatan', function($data) {
          return ($data->kecamatan != null) ? $data->kecamatan->kode.' '.$data->kecamatan->nama_kecamatan : null;
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
    $def = Puskesmas::findBySlug($id);
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

    if ($request->id == null) Puskesmas::create($save);
    else Puskesmas::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
    )));
  }

  public function delete($id)
  {
    $data = Puskesmas::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function dropdown(Request $request)
  {
    $data = Puskesmas::selectRaw('id,CONCAT(kode," - ",nama_puskesmas) text')
    //->where('provinsi_id',($request->provinsi != null)?$request->provinsi:null)
    ->orderBy('kode');

    if ($request->term != null) $data->whereRaw("(nama_puskesmas LIKE '%".$request->term."%' OR kode LIKE '%".$request->term."%')");
    $data = $data->get();

    die(json_encode($data));
  }

  public function import(Request $request)
  {
    if ($files = $request->file('import_file'))
    {
      $berkasname = $files->getClientOriginalName();
      Storage::disk('local')->putFileAs('public/import', $request->file('import_file'), $berkasname);

      $collection = Excel::toArray(new DataImport, 'storage/'.(env('STORAGE_BASE') != null ? env('STORAGE_BASE'):null).'import/'.$berkasname);

      $total = 0;
      foreach($collection[0] as $pe)
      {
        if ($pe[0] != null)
        {
          $n = ucwords(strtolower($pe[0]));
          $kec = Kecamatan::where('nama_kecamatan',$n)->first();
        }

        if ($kec != null and $pe[0] == null and $pe[2] != null)
        {
          $n = ucfirst(strtolower($pe[2]));
          $cekDesa = Puskesmas::where(['kecamatan_id' => $kec->id, 'nama_puskesmas' => $n])->first();

          if ($cekDesa == null)
          {
            Puskesmas::create([
              'kecamatan_id' => $kec->id,
              'kode' => $pe[1],
              'nama_puskesmas' => $n,
              'alamat' => $pe[2]]);
            $total+=1;
          }
        }
      }
      return redirect()->to(route($this->mod))->with('success','<strong>'.$total.' data</strong> berhasil diimport ...');
    }
  }

}
