<?php if(isset($message)): ?>
	<div style="display: none" id="toastr-error">
		<?php echo $message['message']; ?>

	</div>
	<script type="text/javascript">
		$(function(){
			toastr["<?php echo e($message['status']?'success':'error'); ?>"]($("#toastr-error").html());
		});
	</script>
<?php endif; ?>
