<div class="row">
    <div class="col-lg-6">
        <div class="wrapper bg-silver-lighter panel-table">
            <h3>@if (isset($def)) Ubah @else Tambah @endif Bidang</h3>
        </div>
        <div class="panel panel-inverse" data-sortable-id="table-basic-5">
            <form action="{{ route('bidangWrite') }}" method="post" onsubmit="return formSubmit(this)">
            @csrf
            @if (isset($def))<input type="hidden" name="id" value="{{ $def->id }}"/>@endif
            <div class="panel-body">
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-4 text-right" for="kode_bidang">Kode Bidang</label>
                    <div class="col-md-3">
                        <input type="text" name="kode_bidang" id="kode_bidang" class="form-control form-control-sm m-b-5" placeholder="" autocomplete="off" value="@if (isset($def)){{ $def->kode_bidang }}@endif">
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-4 text-right" for="nama_bidang">Nama Bidang</label>
                    <div class="col-md-8">
                        <textarea name="nama_bidang" id="nama_bidang" class="form-control form-control-sm m-b-5" placeholder="" autocomplete="off" required>@if (isset($def)){{ $def->nama_bidang }}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                    <button class="btn btn-default pull-left btn-close" onclick="return formClose(this)"><i class="fas fa-remove"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary pull-right btn-save"><i class="fas fa-save"></i> Simpan</button>
                    <div class="clearfix"></div>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $('.default-select2').select2({ width: '100%' })
    })
</script>
