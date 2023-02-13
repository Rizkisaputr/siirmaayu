<audio id="sirine" loop="loop">
	<source src="{{load_asset('etc/sirine.mp3')}}" type="audio/mp3"/>
</audio>
<script type="text/javascript">
	function togglesound(play) {
		if(play){
			sirine.paused?sirine.play():'';
		}else{
			sirine.paused?'':sirine.pause();
		}
	}
	$(function(){
		function sirine_refresh(){
			$.get("{{base_url('panel/dashboard_data_rujukan?ping')}}",function(res){
				togglesound(res.no_respon>0);
				setTimeout(sirine_refresh,120000);
			});
		}
		sirine_refresh();
	});
</script>
