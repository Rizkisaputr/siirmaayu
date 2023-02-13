<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Puskesmas;
use App\Models\Periksa;
use App\Models\Ibu;

class HomeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $puskesmas = Puskesmas::count();
    $desa = Desa::count();
    $ibu = Ibu::count();
    $periksa = Periksa::count();
    return view('dashboard',compact('puskesmas','desa','ibu','periksa'));
  }
}
