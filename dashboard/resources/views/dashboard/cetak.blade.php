<html>
<head>
<title>Dashboard Siirmaayu</title>
<style type="text/css">
  body { font-family: 'Helvetica' !important ; font-size: 0.7em}
</style>

<style>

.clearfix { clear: both }
h5 { font-size: 1.1em }
.logo img { margin-right: 20px; width: 60px}
.logo span { font-size: 1.8em; font-weight: bold; line-height: .8em;}
.logo span span { font-size: .7em; font-weight: bold; }
.table { width: 100%; margin: 0 }
.table td { width: 50%; padding: 0; }
.table td img { margin-bottom: 30px; width: 90%; }
.full { width: 100%; text-align: center; }
.full img { width: 100%; }
.text-right { text-align: right; }
</style>
</head>
<body>
  @if ($phase == 1)
<div style="width: 100%">
  <div style="width: 75%; float: left" class="logo">
    <div style="float: left; margin-right: 20px; width: 20%">
      <img src="{{ 'img/indramayu.png' }}"></div>
    <div style="float: left; padding-left: 80px">
      <span><br>LAPORAN INFOGRAFIS SI-IRMA-AYU<br><br>
        <span><b></b>Dinas Kesehatan Kabupaten Indramayu</b></span><br><br>
        <span>Jl. MT. Haryono No. 09, Sindang, Penganjang, Kabupaten Indramayu, Jawa Barat 45221</span>
      </span>
    </div>
    <div class="clearfix"></div>
  </div>
  <div style="width: 25%; float: left">

    <p class="m-t-5">Faskes Perujuk<br>
      <strong>@if ($perujuk != null){{ $perujuk }}@else{{ 'Semua Faskes Perujuk' }}@endif</strong></p>
    <p class="m-t-5">Faskes Rujukan<br>
      <strong>@if ($rujukan != null){{ $rujukan }}@else{{ 'Semua Faskes Rujukan' }}@endif</strong></p>
    <p class="m-t-5">Periode<br>
      <strong>{{ $waktu }}</strong></p>
  </div>
  <div class="clearfix">
        <hr align="center" width="100%" size="4" color="blue" noshade>
  </div>

</div>
<br><br>
<table class="table">
  {{-- Baris 1 --}}
  <tr>
    <td><img src="{{ $canvas['statistik'] }}"></td>
    <td><img src="{{ $canvas['respon'] }}"></td>
  </tr>
  {{-- Baris 2 --}}
  <tr>
    <td><img src="{{ $canvas['jenis_kasus'] }}"></td>
    <td><img src="{{ $canvas['matneo'] }}"></td>
  </tr>
  {{-- Baris 3 --}}
  <tr><td colspan="2" class="full"><img src="{{ $canvas['maternal'] }}" style="width: 100%; height: 400px"></td></tr>
  {{-- Baris 4 --}}
  <tr>
    <td><img src="{{ $canvas['maternal_lainnya'] }}"></td>
    <td><img src="{{ $canvas['neonatal'] }}"></td>
  </tr>
  {{-- Baris 5 --}}
  <tr>
    <td><img src="{{ $canvas['bayi'] }}"></td>
    <td><img src="{{ $canvas['kasus_terbanyak'] }}"></td>
  </tr>
  {{-- Baris 6 --}}
  <tr><td colspan="2" class="full"><img src="{{ $canvas['umum'] }}"></td></tr>

@else

<table class="table">
  {{-- Baris 10 --}}
  <tr><td colspan="2" class="full"><img src="{{ $canvas['maternal_rs'] }}" style="height: 400px; width: 700px"></td></tr>

  {{-- Baris 11 --}}
  <tr><td colspan="2" class="full"><img src="{{ $canvas['rujukanBalik'] }}" style="height: 350px; width: 700px"></td></tr>

  {{-- Baris 12 --}}
  <tr><td colspan="2" class="full"><img src="{{ $canvas['perujuk'] }}" style="height: 420px"></td></tr>

  {{-- Baris 13 --}}
  <tr><td colspan="2" class="full" style="height: 300px"><img src="{{ $canvas['kasus4'] }}"></td></tr>

  {{-- Baris 14 --}}
  <tr><td colspan="2" class="full" style="height: 300px"><img src="{{ $canvas['pemgso4'] }}"></td></tr>

  {{-- Baris 15 --}}
  <tr>
    <td><img src="{{ $canvas['biaya'] }}"></td>
    <td><img src="{{ $canvas['transportasi'] }}"></td>
  </tr>
  {{-- Baris 16 --}}
  <tr>
    <td><img src="{{ $canvas['gol_darah'] }}"></td>
    <td><img src="{{ $canvas['media'] }}"></td>
  </tr>
  @endif

</table>

<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width()-120;
        $y = $pdf->get_height()-60;
        $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
        $font = null;
        $size = 10;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
</body>
</html>
