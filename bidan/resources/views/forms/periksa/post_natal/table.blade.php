@if($data->count() > 0)
@foreach($data->get() as $no => $d)
<tr>
  <td>{{ $no+1 }}</td>
  <td><div class="nowrap">
    <a class="m-r-10 btn btn-info" href="{{ route('postNatalEdit',$d) }}" onclick="return pnForm(this)"><i class="feather icon-edit-2 icon-only"></i></a>
      <a class="btn btn-danger" href="{{ route('postNatalDelete',$d) }}" onclick="return pnDelete(this)"><i class="feather icon-trash-2 icon-only"></i></a>
    </div>
  </td>
  <td>{{ Carbon\Carbon::parse($d->tgl)->format('d-m-Y')}}</td>
  <td>{{ $d->hari_ke}}</td>
  <td>{{ $d->td }}</td>
  <td>{{ $d->suhu }}</td>
  <td>{{ $d->nadi }}</td>
  <td>{{ $d->respirasi }}</td>
  <td>{{ $d->tfu }}</td>
  <td>{{ $d->bak }}</td>
  <td>{{ $d->bab }}</td>
  <td>{{ $d->lochea }}</td>
  <td>{{ $d->masalah_payudara }}</td>
  <td>
    @if ($d->catat_buku_kia == 1) V @endif
    @if ($d->catat_buku_kia == 2) X @endif
  </td>
  <td>{{ $d->fe }}</td>
  <td>
    @if ($d->vit_a == 1) V @endif
    @if ($d->vit_a == 2) X @endif
  </td>
  <td>{{ $d->cd4 }}</td>
  <td>{{ $d->anti_malaria }}</td>
  <td>{{ $d->anti_tb }}</td>
  <td>{{ $d->arv }}</td>
  <td>@if ($d->komplikasi == 1) V @endif</td>
  <td>@if ($d->komplikasi == 2) V @endif</td>
  <td>@if ($d->komplikasi == 3) V @endif</td>
  <td>@if ($d->komplikasi == 4) V @endif</td>
  <td>{{ $d->klasifikasi }}</td>
  <td>{{ $d->tata_laksana }}</td>
  <td>@if ($d->dirujuk_ke == 1) V @endif</td>
  <td>@if ($d->dirujuk_ke == 2) V @endif</td>
  <td>@if ($d->dirujuk_ke == 3) V @endif</td>
  <td>@if ($d->dirujuk_ke == 4) V @endif</td>
  <td>@if ($d->dirujuk_ke == 5) V @endif</td>
  <td>{{ $d->tiba }}</td>
  <td>{{ $d->pulang }}</td>
</tr>
@endforeach
@else
<tr>
  <td colspan="40" class="text-center">Tidak ditemukan data ... </td>
</tr>
@endif
