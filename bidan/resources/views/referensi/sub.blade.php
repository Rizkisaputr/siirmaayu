<div class="row">
    <div class="col-lg-6">
        <div class="wrapper bg-silver-lighter panel-table">
            <h3>@if (isset($def)) Ubah @else Tambah @endif Bidang</h3>
        </div>
        <div class="panel panel-inverse" data-sortable-id="table-basic-5">
            <form action="{{ route('bidangWrite') }}" method="post" onsubmit="return formSubmit(this)">
            @csrf
            <input type="hidden" name="induk_id" value="{{ $bidang->id }}"/>
            <input type="hidden" name="desa_id" value="{{ $bidang->desa_id }}"/>
            <div class="panel-body">
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-4 text-right">Desa</label>
                    <div class="col-md-8 p-t-10"><input type="text" class="form-control read" value="{{ $bidang->desa->nama_desa }}" readonly="readonly"/></div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-4 text-right" for="nama_bidang">Nama Bidang</label>
                    <div class="col-md-8"><input type="text" class="form-control read" value="{{ $bidang->nama_bidang }}" readonly="readonly"></div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-4 text-right" for="nama_bidang">Nama Sub Bidang</label>
                    <div class="col-md-8">
                        <input type="text" name="nama_bidang" id="nama_bidang" class="form-control form-control-sm m-b-5" required>
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

<style>
  .read { background: #fff; }
</style>
