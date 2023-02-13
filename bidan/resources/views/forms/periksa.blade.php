@extends('layouts.form')
@section('formBody')

<style>
.input-group-append, .input-group-text { height: 35px }
.input-group-append .input-group-text, .input-group-prepend .input-group-text { background-color: #fff !important; color: #555}
</style>

<input type="hidden" name="ibu_id" value="{{ $ibu->id }}"/>
@if (isset($def))<input type="hidden" name="id" value="{{ $def->id }}"/>@endif

<table class="table-condensed">
  @foreach(array(
    array('Nama Ibu',':',$ibu->nama_ibu),
    array('NIK',':',$ibu->nik),
    array('Tanggal Lahir',':',Carbon\Carbon::parse($ibu->tgl_lahir)->formatLocalized('%d %B %Y'))
  ) as $d)
  <tr>
    <td width="150">{{ $d[0] }}</td>
    <td width="20">{{ $d[1] }}</td>
    <td>{{ $d[2] }}</td>
  </tr>
  @endforeach
</table>

<ul class="nav nav-tabs tabs m-20" role="tablist">

@foreach(array(
  'Riwayat' => 'riwayat',
  'Pemeriksaan Dokter' => 'tm',
  'Ante Natal Care' => 'ante_natal_care',
  'Persalinan' => 'persalinan',
  'Post Natal' => 'nifas',
  'Kontrasepsi' => 'kontrasepsi',
  'PPIA' => 'ppia') as $a => $b)
<li class="nav-item">
<a class="nav-link @if ($b == "riwayat") show active @endif" data-toggle="tab" href="#{{ $b }}" role="tab" aria-selected="true">{{ $a }}</a>
</li>
@endforeach
</ul>

<div class="tab-content tabs card-block">
<div class="tab-pane active show" id="riwayat" role="tabpanel">
  @include('forms.periksa.riwayat')
</div>
<div class="tab-pane" id="tm" role="tabpanel">
  @include('forms.periksa.pemeriksaan')
</div>
<div class="tab-pane" id="ante_natal_care" role="tabpanel">
  @include('forms.periksa.ante_natal_care.index')
</div>
<div class="tab-pane" id="persalinan" role="tabpanel">
  @include('forms.periksa.persalinan')
</div>
<div class="tab-pane" id="nifas" role="tabpanel">
  @include('forms.periksa.post_natal.index')
</div>
<div class="tab-pane" id="kontrasepsi" role="tabpanel">
  @include('forms.periksa.kontrasepsi')
</div>
<div class="tab-pane" id="ppia" role="tabpanel">
  @include('forms.periksa.ppia')
</div>
</div>
@endsection

@push('formScript')
@include('scripts.flatpickr')
<script type="text/javascript">
    $(document).ready(function() {
      $('.default-select2').select2()
      $('.datepicker').flatpickr({
          altInput: true,
          altFormat: 'j F Y',
          dateFormat: 'Y-m-d',
      })

      formPeriksaSave = function(i)
      {
        $.ajax({
            url: $(i).attr('action'),
            type: "POST",
            data: $(i).serialize()+'&ajax=true',
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('.btn-close').hide()
                $('.btn-save').attr('disabled','disabled').html('Menyimpan')
            },
            success: function(result) {
                if (result.status == true) {
                  successSet(result.message);
                  $('#ancBtn').attr('href',result.anc)
                  $('#pnBtn').attr('href',result.pn)
                } else {
                  failSet(result.message)
                }
                $('.btn-close').show()
                $('.btn-save').removeAttr('disabled').html('Simpan');
                drawTable();
            },error:function(xhr, ajaxOptions, thrownError){
                failSet('Terjadi Kesalahan')
                console.log(JSON.stringify(xhr));
                $('.btn-close').show()
                $('.btn-save').removeAttr('disabled').html('Simpan');
            }
        });
        return false;
      }
    })
</script>

@endpush
