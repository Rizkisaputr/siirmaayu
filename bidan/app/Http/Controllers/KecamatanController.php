<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use DataTables;
use App\Models\Kecamatan;
use App\Models\Kabupaten;

class KecamatanController extends Controller
{
  var $mod = 'kecamatan';
  var $title = 'Kecamatan';
  var $col = array(
    'Kabupaten' => 'kabupaten',
    'Kode' => 'kode',
    'Nama Kecamatan' => 'nama_kecamatan'
  );

  var $cell = array(
    'kabupaten_id',
    'kode',
    'nama_kecamatan'
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
    $def = Kecamatan::findBySlug($id);
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

    if ($request->id == null) Kecamatan::create($save);
    else Kecamatan::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
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
        if ($pe[0] != null or $pe[1] != null)
        {
          $n = ucfirst(strtolower($pe[1]));
          $kec = Kecamatan::where('nama_kecamatan',$n)->first();

          $save = array('nama_kecamatan' => $n, 'kode' => $pe[0], 'kabupaten_id' => Kabupaten::first()->id);

          if ($kec == null) Kecamatan::create($save);
          else Kecamatan::find($kec->id)->update($save);
          $total+=1;
        }
      }
      return redirect()->to(route('kecamatan'))->with('success','<strong>'.$total.' data</strong> berhasil diimport ...');
    }
  }

}
