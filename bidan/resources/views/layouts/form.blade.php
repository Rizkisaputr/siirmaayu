<div class="card">
  <div class="card-header">
    <h5>@if (isset($def)) Ubah @else Tambah Data @endif {{ $title }}</h5>
      </div>
      <div class="card-block">
      <form action="{{ $url }}" method="post" onsubmit="return @if (isset($custom)){{ $custom }}@else formSubmit(this) @endif">
      @csrf
      @if (isset($def) and $def->id)<input type="hidden" name="id" value="{{ $def->id }}">@endif
      @yield('formBody')
      <hr>
      <button class="btn btn-inverse float-left btn-close" onclick="return formClose(this)"><i class="feather icon-x"></i> Tutup</button>
      <button type="submit" class="btn btn-primary float-right btn-save"><i class="feather icon-save"></i> Simpan</button>
      <div class="clearfix"></div>
      </form>
</div>
</div>

@stack('formScript')
