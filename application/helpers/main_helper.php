<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 07/04/2018
 * Time: 11:52
 */

if(!function_exists('render_back')){
	function render_back($view,$data=array(),$return=FALSE){
		return _render('back',$view,$data,$return);
	}
}

if(!function_exists('render_front')){
	function render_front($view,$data=array(),$return=FALSE){
		return _render('front',$view,$data,$return);
	}
}

if(!function_exists('_render')){
	function _render($type,$view,$data,$return=FALSE){
		$view_path=VIEWPATH;
		switch ($type){
			case 'back':
				$view_path.='back/';
				break;
			case 'front':
				$view_path.='front/';
				break;
			default:

		}
		$blade=new \Jenssegers\Blade\Blade($view_path,APPPATH.'cache');
		if($return){
			return $blade->render($view,$data);
		}else{
			echo $blade->render($view,$data);
		}
	}
}

if(!function_exists('nav_active')){
	function nav_active(array $item_hirarchy){
		try{
			$CI=&get_instance();
			$uri=$CI->uri->segment_array();
			if(count($item_hirarchy)>count($uri))
				throw new Exception();
			foreach ($item_hirarchy as $index=>$item){
				if($uri[$index+1]!=$item)
					throw new Exception();
			}
			return 'active';
		}catch (Exception $e){
			return '';
		}
	}
}

if(!function_exists('my_tes')){
	function my_tes($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		exit();
	}
}

if(!function_exists('send_json')){
	function send_json($data){
		header('Content-Type: application/json');
		echo json_encode($data);
		exit();
	}
}

if(!function_exists('my_map')){
	function my_map($path,array $map){
		$found=false;
		foreach ($map as $uri=>$foo){
			if($uri==$path){
				$found=true;
				call_user_func(array_slice($foo,0,2),isset($foo[2])?$foo[2]:NULL);
				break;
			}
		}
		if(!$found)
			show_404();
	}
}

if(!function_exists('time_ago')){
	function time_ago($time_ago)
	{
		$time_ago = strtotime($time_ago);
		$cur_time   = time();
		$time_elapsed   = $cur_time - $time_ago;
		$seconds    = $time_elapsed ;
		$minutes    = round($time_elapsed / 60 );
		$hours      = round($time_elapsed / 3600);
		$days       = round($time_elapsed / 86400 );
		$weeks      = round($time_elapsed / 604800);
		$months     = round($time_elapsed / 2600640 );
		$years      = round($time_elapsed / 31207680 );
		// Seconds
		if($seconds <= 60){
			return 'Baru Saja';
		}
		//Minutes
		else if($minutes <=60){
			return "$minutes Menit";
		}
		//Hours
		else if($hours <=24){
			return "$hours Jam";
		}
		//Days
		else if($days <= 7){
			return "$days Hari";
		}
		//Weeks
		else if($weeks <= 4.3){
			return "$weeks Minggu";
		}
		//Months
		else if($months <=12){
			return "$months Bulan";
		}
		//Years
		else{
			return "$years Tahun";
		}
	}
}

if(!function_exists('transform_to_selection')){
	function transform_to_selection($keyname,$fieldname,array $object){
		$selection=array();
		foreach ($object as $o){
			$o=(array)$o;
			$selection[$o[$keyname]]=$o[$fieldname];
		}
		return $selection;
	}
}
