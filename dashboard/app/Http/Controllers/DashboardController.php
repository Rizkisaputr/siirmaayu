<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Carbon\Carbon;

use App\Exports\ChartExports;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{

  var $chart = array(
    'biaya',
    'maternal',
    'maternal_lainnya',
    'kasus_terbanyak',
    'maternal_rs',
    'neonatal',
    'perujuk',
    'umum',
    'bayi',
    'matneo',
    'media',
    'transportasi',
    'gol_darah',
    'jenis_kasus',
    'respon',
    'pemgso4',
    'kasus4',
    'rujukanBalik');
  public function __construct()
  {
      //$this->middleware('auth');
  }

  public function waktu()
  {
    $waktu = array();

    for($i = date('n'); $i > 0; $i--)
    {
      $i = ($i > 9)?$i:'0'.$i;
      $waktu[date('Y').'-'.($i)] = ($i).'/'.date('Y').($i == date('m')?' (bulan ini)':null);
    }

    for($i = date('Y'); $i > date('Y')-5; $i--)
    {
      $waktu[$i.'-00'] = 'Tahun '.$i;
    }
    return $waktu;
  }

  public function index()
  {
    $waktu = $this->waktu();
    return view('page',compact('waktu'));
  }

  public function listen($type, Request $request)
  {
    $ch = curl_init();
    $param = array();
    switch ($type) {
      case 'faskes':
        $param[] = 'search='.(($request->term != null) ? $request->term : null);
        $url =  "https://siirmaayu.id/api/dashboard/faskes";
      break;
      default:
        $param[] = 'perujuk='.(($request->perujuk != null) ? $request->perujuk : null);
        $param[] = 'rujukan='.(($request->rujukan != null) ? $request->rujukan : null);
        $param[] = 'waktu='.(($request->waktu != null) ? $request->waktu : null);
        $url = "https://siirmaayu.id/api/dashboard/".$type;
    }

    curl_setopt($ch, CURLOPT_URL,$url.'?'.implode('&',$param));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    die($output);
    curl_close($ch);

  }

  public function getExcel($get_on)
  {
    $ch = curl_init();
    $param = array();

    $param[] = 'perujuk='.(($get_on['perujuk'] != null) ? $get_on['perujuk'] : null);
    $param[] = 'rujukan='.(($get_on['rujukan'] != null) ? $get_on['rujukan'] : null);
    $param[] = 'waktu='.(($get_on['waktu'] != null) ? $get_on['waktu'] : null);
    $url = "https://siirmaayu.id/api/dashboard/".$get_on['type'];

    curl_setopt($ch, CURLOPT_URL,$url.'?'.implode('&',$param));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);

    curl_close($ch);
    return $output;
  }

  public function excel(Request $request)
  {
    $jenis = array(
      'resume' => 'Statistik Umum',
      'respon' => 'Respon Time Rujukan',
      'jenis_kasus' => 'Perbandingan Jenis Kasus (Maternal, Ginek, Neonatal, Bayi/Balita, Umum)',
      'matneo' => 'Jumlah Penerima Rujukan Maternal Neonatal Semua RS, Pengalihan dan Advis Medis',
      'maternal' => 'Jumlah Kasus Maternal',
      'maternal_lainnya' => 'Ginek / Kasus Maternal Lainnya',
      'neonatal' => 'Jumlah Kasus Neonatal',
      'bayi' => 'Kasus Bayi / Balita',
      'kasus_terbanyak' => 'Kasus Terbanyak sesuai ICD X',
      'umum' => 'Kasus Umum',
      'maternal_rs' => 'Jumlah Penerimaan Rujukan Semua Kasus Maternal Semua RS',
      'rujukanbalik' => 'Penerimaan Rujukan versus Rujukan Balik dari RS',
      'perujuk' => 'Semua Faskes Pengirim Rujukan',
      'kasus4' => 'Penerimaan RS untuk Kasus PreEklamsi, Eklamsia, HAP, HPP',
      'pemgso4' => 'Rujukan PE/E dengan Tata Laksana MgSO4',
      'biaya' => 'Berdasarkan Pembiayaan',
      'transportasi' => 'Berdasarkan Transportasi',
      'gol_darah' => 'Golongan Darah',
      'media' => 'Berdasarkan Media Komunikasi'
    );
    $data = array(
      'jenis' => $jenis,
      'kecuali' => array('resume','rujukanbalik','kasus4','pemgso4')
    );
    foreach($jenis as $a => $b)
      {
    $param  = array(
      'type' => $a,
      'perujuk' => $request->perujuk,
      'rujukan' => $request->rujukan,
      'waktu' => $request->waktu
    );

    $data[$a] = json_decode(Self::getExcel($param));
  }
  $excel = (new ChartExports);
  $excel->filename('excel');
  $excel->parsing($data);

  return $excel->download('dashboard_export_'.str_replace(array('-','-00'),array('_',''),$request->waktu).'.xlsx');
  //return view('dashboard.excel',compact('data'));


  }

  public function pdf(Request $request)
  {
    $waktu = $request->waktu;
    $rujukan = $request->rujukan;
    $perujuk = $request->perujuk;
    $uid = $request->uid;
    $phase = $request->phase;

    $canvas = array();
    foreach($this->chart as $c)
    {
      $fm = 'canvas_'.$c;
      $canvas[$c] = $request->$fm;
    }
    $canvas['statistik'] = $request->canvas_statistik;
    //echo $request->phase;
    //dd($_POST);

    $pdf = PDF::loadView('dashboard.cetak', compact('waktu','rujukan','perujuk','uid','canvas','phase'));
    $pdf->getDomPDF()->set_option("enable_php", true);
    return $pdf->stream();
    //return view('dashboard.cetak', compact('waktu','rujukan','perujuk','canvas','phase'));
  }


  public function chart(Request $request)
  {
    $waktu = $request->waktu;
    $rujukan = $request->rujukan;
    $perujuk = $request->perujuk;

    if ($request->export != null)
    {
      $uid = $request->uid;

      $pdf = PDF::loadView('dashboard.cetak', compact('waktu','rujukan','perujuk','uid'));
      return $pdf->stream();

      //return view('dashboard.cetak', compact('waktu','rujukan','perujuk','uid'));
    } else {
    $barChart = array(
      'biaya' => 'Berdasarkan Pembiayaan',
      'maternal' => 'Jumlah Kasus Maternal',
      'maternal_lainnya' => 'Ginek / Kasus Maternal Lainnya',
      'kasus_terbanyak' => 'Kasus Terbanyak sesuai ICD X',
      'maternal_rs' => 'Jumlah Penerimaan Rujukan Semua Kasus Maternal Semua RS',
      'neonatal' => 'Jumlah Kasus Neonatal',
      'perujuk' => 'Semua Faskes Pengirim Rujukan',
      'umum' => 'Kasus Umum',
      'bayi' => 'Kasus Bayi / Balita',
      'matneo' => 'Jumlah Penerima Rujukan Maternal Neonatal Semua RS, Pengalihan dan Advis Medis'
    );
    $pieChart = array(
      'media' => 'Berdasarkan Media Komunikasi',
      'transportasi' => 'Berdasarkan Transportasi',
      'gol_darah' => 'Golongan Darah',
      'jenis_kasus' => 'Perbandingan Jenis Kasus (Maternal, Ginek, Neonatal, Bayi/Balita, Umum)');

    $colorRand = array(
        '210,105,30',
        '139,69,19',
        '245,222,179',
        '255,192,203',
        '188,143,143',
    	  '255,165,0',
        '250,128,114',
        '255,127,80',
        '220,20,60',
        '139,0,0',
        '255,165,0',
        '240,230,140',
        '107,142,35',
        '32,178,170',
        '255,140,0',
        '255,165,0',
        '255,215,0',
        '238,232,170',
        '189,183,107',
        '240,230,140',
        '0,128,0',
        '50,205,50',
        '154,205,50',
        '100,149,237',
        '70,130,180',
        '221,160,221',
        '199,21,133',
        '255,105,180');

    foreach(array('biaya','maternal','maternal_lainnya','neonatal','kasus_terbanyak','kasus4','maternal_rs','respon','gol_darah','transportasi','media','rujukanbalik','perujuk','umum','bayi','jenis_kasus','matneo') as $c) {
      for($i = 0; $i < 14; $i++) {
          $clr = $colorRand[rand(0,27)];
          $color[$c.'Color'][] = 'rgba('.$clr.', 0.6)';
          $color[$c.'ColorB'][] = 'rgba('.$clr.', 1)';
      }
    }

      $uid = strtotime(Carbon::now());
      return view('dashboard.chart',compact('waktu','rujukan','perujuk','color','barChart','pieChart','uid'));
    }
  }

  public function generate(Request $request)
  {
    $this->chart[] = 'statistik';
    foreach($this->chart as $img) {
      $fileName = 'img_'.$img;
      $base64_image = $request->$fileName;
      if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
          $data = substr($base64_image, strpos($base64_image, ',') + 1);

          $data = base64_decode($data);
          Storage::disk('public')->put($request->uid."_".$img.".png", $data);
      }
    }
  }

}
