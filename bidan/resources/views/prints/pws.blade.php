<html>
<head><title>Cetak PWS</title>

  <style type="text/css">

  table {
    font: 11px 'Arial',arial,tahoma !important;
    vertical-align: middle !important;
  }

  body { padding: 15px; }
  .tabel_print {
      margin:0px 0; border-collapse:collapse; width: 100%; }
  .tabel_print th, .add_th {
    border-collapse:collapse;
    border:1px #222 solid;
    background: #f9f9f9;
    color:#000; padding: 5px 3px;
    font-weight: bold; margin: 0;
     }
  .tabel_print td {
    border-collapse:collapse !important;
    color:#000;
    border:1px #222 solid !important;
    padding: 5px; margin: 0;
    text-align: left;
    font: 12px 'Arial',arial;
    vertical-align: top; }
  .tabel_print th {
    font: 12px 'Arial',arial,tahoma !important; font-weight: bold; text-align: center }
    .rotate {
      transform: rotate(-90deg);
      -webkit-transform: rotate(-90deg);
      -moz-transform: rotate(-90deg);
      -ms-transform: rotate(-90deg);
      -o-transform: rotate(-90deg);
      filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }

  .text-center { text-align: center !important; }
  .text-right { text-align: right !important; }
  @media print {



  }
  </style>
</head>
<body onload="window.print()">
  <table width="100%" style="padding-bottom: 30px">
    <tr>
      <td rowspan="5" width="90" style="vertical-align: top">
        <img src="{{ asset(env('APP_BASE').'img/baktihusada.png') }}" style="width: 60px">

      </td>
      <td colspan="3"><span style="font-size: 1.4em; font-weight: bold">PUSKESMAS {{ strtoupper($puskesmas->nama_puskesmas) }}</span></td>
    </tr>
    <tr>
      <td width="80"><strong>KAB.</strong></td>
      <td><strong>INDRAMAYU</strong></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>PROP.</strong></td>
      <td><strong>JAWA TENGAH</strong></td>
      <td class="text-right"><strong>LAPORAN PWS</strong></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td class="text-right">Laporan : Aktual</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td class="text-right">Periode : {{ $tgl }}</td>
    </tr>
  </table>


<table class="tabel_print">
    <thead>
        <tr>
            <th width="20" rowspan="3">NO</th>
            <th rowspan="3" colspan="2">WILAYAH</th>
            @foreach(array(
              'SASARAN',
              'K1',
              'K4',
              'PERSALINAN OLEH NAKES',
              'KF LENGKAP',
              'DETEKSI KOMPLIKASI OLEH NAKES (DKN)',
              'PENANGANAN KOMPLIKASI OBSTETRIK (PK)',
              'PELAYANAN KB (CPR)'
            ) as $a)
            <th colspan="4">{{ $a }}</th>
            @endforeach
        </tr>
        <tr>
          @foreach(array('BUMIL','BULIN','BAYI','BALITA') as $a)
            <td rowspan="2" height="150" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">{{ $a }}</div></td>
          @endforeach
          @foreach(array(1,2,3,4,5,6,7) as $a)
          <td rowspan="2" height="130" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">BLN LALU</div></td>
          <td rowspan="2" height="130" width="20"><div class="rotate" style="width: 25px; margin-top: 100px">BLN INI</div></td>
          <td colspan="2">KOMULATIF</td>
          @endforeach
        </tr>
        <tr>
        @foreach(array(1,2,3,4,5,6,7) as $a)
          <td>ABS</td>
          <td>%</td>
        @endforeach
        </tr>
    </thead>
    <tbody>

@if($puskesmas != null)
<tr>
  <td></td>
  <td colspan="26">{{ $puskesmas->kecamatan->nama_kecamatan }}
      <input type="hidden" name="bulan" value="{{ $bln }}"/>
      <input type="hidden" name="tahun" value="{{ $thn }}">
      <input type="hidden" name="puskesmas_id" value="{{ $psk }}"/>
  </td>
  <td colspan="8"></td>
</tr>
  @if ($desa != null)
  @foreach($desa->get() as $no => $dd)
  <tr>
    <td>
      <input type="hidden" name="desa_id[]" value="{{ $dd->id }}"/>
      {{ $no+1 }}
    </td>
    <td width="50"></td>
    <td>{{ $dd->nama_desa }}</td>
    @foreach($col as $c)
    <td>@if (isset($d[$dd->id])){{ $d[$dd->id]->$c }}@else - @endif</td>
    @endforeach
  </tr>
  @endforeach
  @endif
@else
<tr>
  <td colspan="35" class="text-center">Pilih Puskesmas ... </td>
</tr>
@endif

</tbody>
</table>

</body>
</html>
