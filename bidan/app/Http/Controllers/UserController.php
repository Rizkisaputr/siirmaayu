<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;

class UserController extends Controller
{
  var $mod = 'user';
  var $title = 'User';
  var $col = array(
    'Nama' => 'name',
    'Username' => 'username'
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
    $data = User::all();

    return DataTables::of($data)
    ->addColumn('aksi', function($data) {
          return '
          <div class="nowrap">
            <a class="m-r-10 text-warning" href="'.route($this->mod.'Edit',$data).'" onclick="return formOpen(this)"><i class="feather icon-edit"></i></a>
            <a class="text-danger" href="'.route($this->mod.'Delete',$data).'" onclick="return hapusData(this)"><i class="feather icon-trash-2"></i></a>
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
    return view('forms.user', compact('mod','title','cell'));
  }

  public function edit($id)
  {
    $def = User::findBySlug($id);
    $mod = $this->mod;
    $title = $this->title;
    $cell = $this->cell;
    return view('forms.user',compact('def','mod','title','cell'));
  }

  public function write(Request $request)
  {
    $save = array(); foreach($this->cell as $c => $d)
    {
      $save[$c] = $request->$c;
    }

    if ($request->id == null) User::create($save);
    else User::find($request->id)->update($save);

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil disimpan ...'
    )));
  }

  public function delete($id)
  {
    $data = User::findBySlug($id)->delete();

    die(json_encode(array(
      'status' => true,
      'message' => $this->title.' berhasil dihapus ...'
    )));
  }

  public function import(Request $request)
  {
    if ($request->process != null)
    {
        $collection = Excel::toArray(new DataImport, './'.Storage::url('anggaran/'.$request->process));

    } else {

      if ($files = $request->file('impor_excel'))
      {
        $berkasname = $files->getClientOriginalName();
        if (!Storage::exists('anggaran')) Storage::makeDirectory('anggaran');
        $files->move(storage_path('app/public/anggaran'),$berkasname);

        $collection = Excel::toArray(new DataImport, './'.Storage::url('anggaran/'.$berkasname));
        $row_all = array();

        //return view('bidang.preview',compact('row_all','berkasname'));
      }

    }
    AnggaranDetail::truncate();
    $pos = array();
    foreach($collection[0] as $no => $pe)
    {
        $tahun = date('Y');
        if ($no == 0) {
          $tahun = trim($pe[9]);
          $nama = $pe[0];
        } else {
          if ($pe[0] != null)
          {
            $saveAngJenis = array(
              'kode' => $pe[0],
              'nama_anggaran_jenis' => $pe[1]
            );
            $cekAngJenis = AnggaranJenis::where($saveAngJenis)->first();
            if ($cekAngJenis == null) $anggaran_jenis_id = AnggaranJenis::create($saveAngJenis);
            else $anggaran_jenis_id = $cekAngJenis;

            $saveAng = array(
              'nama_anggaran' => $nama,
              'tahun' => $tahun,
              'anggaran_jenis_id' => $anggaran_jenis_id->id
            );
            $cekAng = User::where($saveAng)->first();
            if ($cekAng == null) $anggaran = User::create($saveAng);
            else $anggaran = $cekAng;
          }

          if ($pe[0] == null and $pe[1] != null)
          {
            $saveAngDet = array(
              'anggaran_id' => $anggaran->id,
              'parent_id' => 0,
              'kode' => $pe[1],
              'uraian' => $pe[2],
              'nilai' => (is_numeric($pe[6])) ? $this->nilai($pe[6]) : null,
              'nilai_sesudah' => (is_numeric($pe[7])) ? $this->nilai($pe[7]) : null,
              'sisa' => (is_numeric($pe[8])) ? $this->nilai($pe[8]) : null
            );
            $cekAngDet = AnggaranDetail::where($saveAngDet)->first();
            if ($cekAngDet == null) $setPos = AnggaranDetail::create($saveAngDet);
            else {
              $setPos = AnggaranDetail::find($cekAngDet->id);
              $setPos->update($saveAngDet);
            }
            $pos[0] = $setPos->id;

          }

          for ($i = 2; $i <= 4; $i++)
          {
            if ($pe[$i-1] == null and $pe[$i] != null)
            {
              $parent = AnggaranDetail::find($pos[$i-2]);
              $saveAngDet = array(
                'anggaran_id' => $parent->anggaran_id,
                'parent_id' => $parent->id,
                'kode' => $pe[$i],
                'uraian' => $pe[$i+1],
                'nilai' => (is_numeric($pe[6])) ? $this->nilai($pe[6]) : null,
                'nilai_sesudah' => (is_numeric($pe[7])) ? $this->nilai($pe[7]) : null,
                'sisa' => (is_numeric($pe[8])) ? $this->nilai($pe[8]) : null,
                'sumber_anggaran' => $pe[9]
              );
              $cekAngDet = AnggaranDetail::where($saveAngDet)->first();
              if ($cekAngDet == null) $setPos = AnggaranDetail::create($saveAngDet);
              else {
                $setPos = AnggaranDetail::find($cekAngDet->id);
                $setPos->update($saveAngDet);
              }
              $pos[$i-1] = $setPos->id;
            }
          }
        }
    }
    return redirect()->to(route('anggaran'))->with('success','Anggaran berhasil disimpan ...');
  }

  function nilai($e)
  {
    return str_replace(array(',','.'),array('.',''),$e);
  }

}
