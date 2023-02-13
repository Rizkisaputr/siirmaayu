@if(isset($message))
	<div style="display: none" id="toastr-error">
		{!! $message['message'] !!}
	</div>
	<script type="text/javascript">
		$(function(){
			toastr["{{$message['status']?'success':'error'}}"]($("#toastr-error").html());
		});
	</script>
@endif
