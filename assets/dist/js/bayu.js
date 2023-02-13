$(function(){
	$('#main-table').on('click','.konfirmasi-hapus',function(e){
		if(!confirm('Apakah anda ingin menghapus data ini')){
			e.preventDefault();
			return false;
		}
	});
});
