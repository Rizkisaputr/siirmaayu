<html>
<head><title>Dashboard Sijariemas</title></head>
<body>

@foreach($data['jenis'] as $a => $b)
<strong>{{ $b }}</strong><br>
<table border="1">
  @if ($a == "resume")
    @foreach($data[$a] as $c => $d)
    <tr>
      <td>{{ $c }}</td>
      <td>{{ $d }}</td>
    </tr>
    @endforeach
  @endif
  @if ($a == "rujukanbalik")
  <tr>
    <td>Faskes</td>
    <td>Rujukan</td>
    <td>Dikembalikan</td>
    <td>Batal</td>
  </tr>
  @foreach($data[$a]->label as $c => $d)
  <tr>
    <td>{{ trim($d) }}</td>
    <td align="center">{{ $data[$a]->data->Rujukan[$c] }}</td>
    <td align="center">{{ $data[$a]->data->Dikembalikan[$c] }}</td>
    <td align="center">{{ $data[$a]->data->Batal[$c] }}</td>
  </tr>
  @endforeach
  @endif

  @if ($a == "kasus4")
  <tr>
    <td>Faskes</td>
    @foreach(array(
      'Pre Eklamsia',
      'Eklampsia',
      'HAP',
      'HPP'
    ) as $r)
    <td>{{ $r }}</td>
    @endforeach
  </tr>
  @foreach($data[$a]->label as $c => $d)
  <tr>
    <td>{{ trim($d) }}</td>
    @foreach(array(
      'Pre Eklamsia',
      'Eklampsia',
      'HAP',
      'HPP'
    ) as $r)
    <td align="center">@if (isset($data[$a]->data->$r[$c])){{ $data[$a]->data->$r[$c] }}@endif</td>
    @endforeach
  </tr>
  @endforeach
  @endif

  @if ($a == "pemgso4")
  <tr>
    <td>Faskes</td>
    @foreach(array(
      'Pre Eklamsia',
      'Eklampsia',
      'MGSO4'
    ) as $r)
    <td>{{ $r }}</td>
    @endforeach
  </tr>
  @foreach($data[$a]->label as $c => $d)
  <tr>
    <td>{{ trim($d) }}</td>
    @foreach(array(
      'Pre Eklamsia',
      'Eklampsia',
      'MGSO4'
    ) as $r)
    <td align="center">@if (isset($data[$a]->data->$r[$c])){{ $data[$a]->data->$r[$c] }}@endif</td>
    @endforeach
  </tr>
  @endforeach
  @endif

  @if(!in_array($a,$data['kecuali']))
    @foreach($data[$a]->label as $c => $d)
    @if ($d != null)
    <tr>
      <td>{{ trim($d) }}</td>
      <td>{{ $data[$a]->data[$c] }}</td>
    </tr>
    @endif
    @endforeach
  @endif
</table>
<br>
@endforeach
</body>
</html>
