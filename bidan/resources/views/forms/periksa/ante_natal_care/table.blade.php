@if($data->count() > 0)
@foreach($data->get() as $no => $d)
<tr>
  <td>{{ $no+1 }}</td>
  <td>
    <div class="nowrap">
      <a class="m-r-10 btn btn-info" href="{{ route('anteNatalCareEdit',$d) }}" onclick="return ancForm(this)"><i class="feather icon-edit-2 icon-only"></i></a>
      <a class="btn btn-danger" href="{{ route('anteNatalCareDelete',$d) }}" onclick="return ancDelete(this)"><i class="feather icon-trash-2 icon-only"></i></a>
    </div>
  </td>
  <td>{{ Carbon\Carbon::parse($d->tgl)->format('d-m-Y')}}</td>
@foreach(array(
    'jkn',
    'usia_kehamilan',
    'trimester',
    'keluhan',
    'bb',
    'td',
    'map',
    'nadi',
    'respirasi',
    'suhu',
    'lila',
    'status_gizi',
    'tfu',
    'refleks_patella',
    'ddj',
    'kepala_pap',
    'tbj',
    'presentasi',
    'jumlah_janin',
    'injeksi_td',
    'catat_buku_kia',
    'fe',
    'pmt_bumil_kek',
    'ikut_tkelas_ibu',
    'kalsium',
    'asetosal',
    'konseling',
    'hemoglobin',
    'glucosa_urine',
    'pmtct_sifilis',
    'pmtct_hbsag',
    'pmtct_hiv',
    'pmtct_arv_profilaksis',
    'malaria',
    'malaria_obat',
    'malaria_kelambu_berinsektisida',
    'tbc_skrinng_anamnesis',
    'tbc_dahak',
    'tbc',
    'tbc_obat',
    'covid19_sehat',
    'covid19_kontak_erat',
    'covid19_suspek',
    'covid19_terkonfirmasi',
    ) as $a)
<td class="text-center">
  @if (in_array($a,$ya_tidak))
    @if ($d->$a != null){{ ($d->$a == 1)?'V':'X' }}@endif
  @else
    {{ $d->$a }}
  @endif
</td>
@endforeach
<td class="text-center">@if ($d->komplikasi == 1) V @endif</td>
<td class="text-center">@if ($d->komplikasi == 2) V @endif</td>
<td class="text-center">@if ($d->komplikasi == 3) V @endif</td>
<td class="text-center">@if ($d->komplikasi == 4) V @endif</td>
<td class="text-center">@if ($d->komplikasi == 5) V @endif</td>
<td class="text-center">@if ($d->komplikasi == 6) V @endif</td>
<td>{{ $d->tata_laksana_awal }}</td>
<td class="text-center">@if ($d->dirujuk_ke == 1) V @endif</td>
<td class="text-center">@if ($d->dirujuk_ke == 2) V @endif</td>
<td class="text-center">@if ($d->dirujuk_ke == 3) V @endif</td>
<td class="text-center">@if ($d->dirujuk_ke == 4) V @endif</td>
<td class="text-center">@if ($d->dirujuk_ke == 5) V @endif</td>
@foreach(array(
'tiba',
'pulang',
'keterangan') as $a)
<td>{{ $d->$a }}</td>
@endforeach
</tr>
@endforeach
@else
<tr>
  <td colspan="40" class="text-center">Tidak ditemukan data ... </td>
</tr>
@endif
