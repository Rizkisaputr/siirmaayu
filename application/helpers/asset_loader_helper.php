<?php
if(!function_exists('load_asset')){
	function load_asset($path){
		return base_url('assets/'.$path);
	}
}
