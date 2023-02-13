$(document).ready(function(){
	$(".tools").click(function(){
		if($(this).parent().is(".open")){
			$(this).parent().removeClass("open");
		return false}

	$(".tools").parent().removeClass("open");
	$(this).parent().addClass("open");return false});
	$("html,.modal-close").click(function(){$(".tools").parent().removeClass("open")});
});