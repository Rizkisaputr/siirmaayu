<?php
/**
 * Authorization helper for jwt
 * Created by PhpStorm.
 * User: Bayu Setiawan
 * Date: 28/02/2018
 * Time: 17:20
 */
use Firebase\JWT\JWT;

class JWT_AUTHORIZATION
{
    public static function generateToken($data){
        $CI =& get_instance();
		$CI->load->config('jwt');
        return JWT::encode($data,$CI->config->item('jwt_key'));
    }

    public static function validateToken($token){
        try{
            $CI =& get_instance();
			$CI->load->config('jwt');
            return JWT::decode($token,$CI->config->item('jwt_key'),array('HS256'));
        }catch (Exception $e){
            return $e;
        }
    }
}
