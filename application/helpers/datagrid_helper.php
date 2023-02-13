<?php
/**
 * Data grid helper
 */

if(!function_exists('get_collumn')){
	function get_collumn($columns,$num){
		return $columns[$num];
	}
}

if(!function_exists('get_collumn_properties')){
	function get_collumn_properties($columns,$num,$name){
		return $columns[$num][$name];
	}
}

if(!function_exists('get_order_by')){
	function get_order_by($columns,$order){
		return array($columns[$order[0]['column']]['data'],$order[0]['dir']);
	}
}
