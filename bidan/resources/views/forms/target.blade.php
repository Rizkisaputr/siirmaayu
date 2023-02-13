@if($puskesmas != null)
<tr>
  <td></td>
  <td colspan="2">{{ $puskesmas->kecamatan->nama_kecamatan }}
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
    @foreach(array(
    'K1',
    'K4',
    'PERSALINAN',
    'KF',
    'DKN',
    'PK',
    'CPR'
    ) as $a)
    <td>
      @php $var = strtolower($a) @endphp
      <input type="text" name="{{ $var.'['.$dd->id.']' }}" value="@if (isset($d[$dd->id])){{ $d[$dd->id]->$var }}@endif" class="form-control width-100" placeholder="" autocomplete="off">
    </td>
    @endforeach
  </tr>
  @endforeach
  @endif
@else
<tr>
  <td colspan="10" class="text-center">Pilih Puskesmas ... </td>
</tr>
@endif
