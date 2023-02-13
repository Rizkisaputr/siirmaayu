<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property Ion_auth ion_auth
 * @property Ion_auth_model ion_auth_model
 * @property M_Base M_Base
 */

class Laporan extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/jakarta');
	}
	public function _remap($function){
		my_map($function,array(
			NULL => array($this,'show404'),
			'index' => array($this,'show404'),
			'bed' => array($this,'bed'),
			'rujukan' => array($this,'rujuk'),
			'rujukan_balik' => array($this,'rujuk_balik'),
			'rujuk_konfirmasi' => array($this,'rujuk_konfirmasi'),
		));
	}
	public function show404(){
		show_404();
	}
	public function bed(){
		echo Modules::run('panel/Rumah_sakit/bed_export');
	}
	public function rujuk(){
		echo Modules::run('panel/Rujukan/rujuk_export');
	}
	public function rujuk_balik(){
		echo Modules::run('panel/Rujukan/balik_export');
	}
	public function rujuk_konfirmasi(){
		echo Modules::run('panel/Rujukan/konfirmasi_export');
	}
}
