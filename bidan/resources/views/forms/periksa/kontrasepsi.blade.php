
<div class="row">
  <div class="col-lg-12">
    <h5 class="m-b-10">KONTRASEPSI</h5>
    @php $k_id = 1 @endphp
    @foreach(array(
      'Mal',
      'Kondom',
      'Pil',
      'Suntik',
      'AKDR',
      'Implant',
      'MOW',
      'MOP') as $kt)
      <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right">
          <input type="hidden" name="kt_kode[]" value="{{ $k_id }}">{{ $kt }}</label>
        <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control datepicker" name="kt_tgl[{{$k_id}}]" value="@if(isset($kntsps_def[$k_id])){{ $kntsps_def[$k_id]->tgl }}@endif" placeholder="Waktu" autocomplete="off">
          <label class="input-group-text"><i class="feather icon-calendar"></i></label>
          </div>
        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="kt_rencana[{{$k_id}}]" value="@if(isset($kntsps_def[$k_id])){{ $kntsps_def[$k_id]->rencana }}@endif" placeholder="Rencana" autocomplete="off">
        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="kt_pelaksanaan[{{$k_id}}]" value="@if(isset($kntsps_def[$k_id])){{ $kntsps_def[$k_id]->pelaksanaan }}@endif" placeholder="Pelaksanaan" autocomplete="off">
        </div>
      </div>
      @php $k_id+=1 @endphp
    @endforeach
  </div>
</div>
