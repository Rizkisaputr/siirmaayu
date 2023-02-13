<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property Ion_auth ion_auth
 * @property Ion_auth_model ion_auth_model
 * @property M_Base M_Base
 * @property CI_URI uri
 * @property User_model $User_model
 * @property Model_Rumah_Sakit $Model_Rumah_Sakit
 * @property DG_rujuk $DG_rujuk
 * @property DG_Rujuk_Balik $DG_Rujuk_Balik
 * @property DG_Pasien $DG_Pasien
 * @property CI_Upload upload
 */

class Rujukan extends MX_Controller
{

	var $bulan =  array(
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember');

	var $var_darurat = array(
		'placenta previa',
		'retentio plasenta',
		'hpp',
		'hap',
		'peb',
		'per',
		'solucio placenta',
		'ketuban hijau kental',
		'robekan grade 3 dan 4',
		'prolaps uteri',
		'atonia uteri',
		'ruptur uteri'
	);

	public function __construct()
	{
		parent::__construct();
		$this->M_Base->cek_auth();
		$this->load->helper('datagrid');
		//initialize file upload form
		$config =array();
		$config['upload_path']          = FCPATH.'assets/public/';
		$config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlsx|pdf';
		$config['max_size']             = 2048;
		$config['encrypt_name']			= TRUE;

		$this->load->library('upload', $config);
		date_default_timezone_set('Asia/jakarta');
	}
	public function _remap($function){
		switch ($function){
			case NULL:
			case 'index':
				redirect(base_url('panel/rujukan/rujuk'),'refresh');
				break;
			case 'rujuk':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'rujuk'),
					'data'		=> array($this,'rujuk_data'),
					'add'		=> array($this,'rujuk_add'),
					'edit'		=> array($this,'rujuk_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'rujuk_delete',$this->uri->segment(5)),
					'recommend'	=> array($this,'recomend_rs',array('perujuk'=>$this->uri->segment(5))),
//					'export'	=> array($this,'rujuk_export')
				));
				break;
			case 'balik':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'balik'),
					'index'		=> array($this,'balik'),
					'data'		=> array($this,'balik_data'),
					'data_param' => array($this,'balik_data',$this->uri->segment(5)),
					'action'	=> array($this,'balik_konfirmasi',$this->uri->segment(5)),
					'jawab'	=> array($this,'balik_jawab',$this->uri->segment(5)),
//					'export'	=> array($this,'balik_export')
				));
				break;
			case 'pasien_list':
				$this->pasien_list();
				break;
			case 'icdx_list':
				$this->icdx_list();
				break;
			case 'find_nakes':
				$this->find_nakes();
				break;
			case 'pasien':
				my_map($this->uri->segment(4),array(
					NULL 		=> array($this,'pasien'),
					'data' 		=> array($this,'pasien_data'),
					'add' 		=> array($this,'pasien_add'),
					'edit' 		=> array($this,'pasien_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'pasien_delete',$this->uri->segment(5)),
				));
				break;
			case 'konfirmasi':
				my_map($this->uri->segment(4),array(
					NULL 		=> array($this,'konfirmasi'),
					'data' 		=> array($this,'konfirmasi_data'),
					'add' 		=> array($this,'konfirmasi_add'),
					'edit' 		=> array($this,'konfirmasi_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'konfirmasi_delete',$this->uri->segment(5)),
				));
				break;
			case 'psc':
				my_map($this->uri->segment(4),array(
					NULL 		=> array($this,'psc'),
					'data' 		=> array($this,'psc_data'),
					'add' 		=> array($this,'psc_add'),
					'edit' 		=> array($this,'psc_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'psc_delete',$this->uri->segment(5)),
				));
			break;

			case 'covid':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'covid'),
					'data'		=> array($this,'covid_data'),
					'add'		=> array($this,'covid_add'),
					'edit'		=> array($this,'covid_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'covid_delete',$this->uri->segment(5)),
					//'recommend'	=> array($this,'recomend_rs',array('perujuk'=>$this->uri->segment(5))),
					'export'	=> array($this,'covid_export')
				));
				break;

			case 'pwskia':
				my_map($this->uri->segment(4),array(
					NULL 		=> array($this,'pwskia'),
					'data' 		=> array($this,'pwskia_data'),
					'add' 		=> array($this,'pwskia_add'),
					'edit' 		=> array($this,'pwskia_edit',$this->uri->segment(5)),
					'target' 	=> array($this,'pwskia_target',$this->uri->segment(5)),
					'delete'	=> array($this,'pwskia_delete',$this->uri->segment(5)),
				));
			break;
			default:
				show_404();
		}
	}

	/**
	 * =================================================================================
	 * MASUK
	 * =================================================================================
	 */
	public function rujuk(){
		$this->load->model('User_model');
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujukan';
		$data['rs'] = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan';
		$data['page_desc']	= 'List Riwayat Rujukan';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujukan.list',$data);
	}
	public function rujuk_data(){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_rujuk');

		if(!$this->ion_auth->is_admin() and !$this->ion_auth->in_group('psc')) {
			$this->load->model('User_model');
			$this->DG_rujuk->setIn('tb_rujukan.id_rs_perujuk',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_rujuk->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_rujuk->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_rujuk->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}

	private function upload_procedure($insert_data=array()){
		//upload attachment
		$attachment_fields=array('attachment_1','attachment_2','attachment_3');
		foreach ($attachment_fields as $attch){
			if(!empty($_FILES[$attch]['name'])){
				if(!$this->upload->do_upload($attch)){
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>/*'Upload gagal dan data gagal diinput'*/$this->upload->display_errors('','')));
					redirect(base_url('panel/rujukan/rujuk'),'refresh');
				}
				$insert_data[$attch]=$this->upload->data('file_name');
			}
		}
		return $insert_data;
	}

	public function rujuk_add(){
		$this->load->model('DG_rujuk');
		$this->load->model('DG_Pasien');
		if($_POST){
			switch ($_POST['pasien_type']){
				case 'old':
					$this->form_validation->set_rules('no_rm','Pasien','required|is_natural_no_zero');
					break;
				case 'new':
					if ($_POST['type'] == 1)
					{
						$this->form_validation->set_rules('nama','Nama Pasien','required|trim|max_length[255]');
						//$this->form_validation->set_rules('nama','Nama Pasien','required|trim|alpha_numeric_spaces');
						//$this->form_validation->set_rules('kontak','Kontak Pasien','trim');
						//$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','trim');
						//$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','trim|alpha_numeric_spaces');
						//$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','trim|in_list[Laki-laki,Perempuan]');
						//$this->form_validation->set_rules('nik','NIK','trim|numeric');
						//$this->form_validation->set_rules('alamat','Alamat','trim');
					} else {
						$this->form_validation->set_rules('nama','Nama Pasien','required|trim|max_length[255]');
						//$this->form_validation->set_rules('ibuanak_namasuami','Kontak Pasien','trim');
						//$this->form_validation->set_rules('ibuanak_umur','Tanggal Lahir','trim');
						//$this->form_validation->set_rules('ibuanak_goldarah','Tempat Lahir','trim|alpha_numeric_spaces');
						//$this->form_validation->set_rules('nik','NIK','trim|numeric');
					}
					break;
				default:
					$message=array('status'=>FALSE,'message'=>'Input Error');
			}
			$this->form_validation->set_rules('id_rs_perujuk','Asal Rujukan','trim|required|integer');
			$this->form_validation->set_rules('id_rs_dirujuk','Tujuan Rujukan','trim|required|integer');
			$this->form_validation->set_rules('ibuanak_nobidan','Nomor perujuk','trim|required|integer');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');

			if ($_POST['pasien_type'] == 1)
			{
				$this->form_validation->set_rules('alasan_rujukan','Alasan Rujukan','trim|required');
			}
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());

				// Rujukan Pasien Umum

				if ($this->input->post('type') == 1)
				{
					if($this->input->post('pasien_type')==='old'){
						$insert_data=$_POST;
						unset($insert_data['save']);
						unset($insert_data['pasien_type']);
					}elseif ($this->input->post('pasien_type')==='new'){
						$pasien_data=array(
							'nama'			=> $this->input->post('nama'),
							'kontak'		=> $this->input->post('kontak'),
							'tgl_lahir'		=> $this->input->post('tgl_lahir'),
							'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
							'nik'			=> $this->input->post('nik'),
							'tempat_lahir'	=> $this->input->post('tempat_lahir'),
							'alamat'		=> $this->input->post('alamat'),
							'umur'				=> '-',
							'pasangan'			=> "-",
							'goldarah'			=> "-"

						);
						$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
						if(!$id_pasien)
							throw new Exception('Gagal menginput pasien');
						$insert_data=array(
							'type' => $this->input->post('type'),
							'id_icdx' => $this->input->post('icdx'),
							//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
							'id_rs_perujuk'			=> $this->input->post('id_rs_perujuk'),
							'ibuanak_nobidan' 	=> $this->input->post('ibuanak_nobidan'),
							'ibuanak_namabidan' => $this->input->post('ibuanak_namabidan'),
							'ibuanak_kodebidan' 	=> '-',
							'id_rs_dirujuk'			=> $this->input->post('id_rs_dirujuk'),
							'id_nakes'				=> $this->input->post('id_nakes'), //baru tambahan
							'id_kelas_bed' 			=> $this->input->post('id_kelas_bed'),
							'id_jenis_layanan' 		=> $this->input->post('id_jenis_layanan'),
							'id_ambulance'			=> $this->input->post('id_ambulance'),
							'transportasi'			=> $this->input->post('transportasi'),
							'alasan_rujukan' 		=> $this->input->post('alasan_rujukan'),
							'pembiayaan' 			=> $this->input->post('pembiayaan'),
							'media'					=> $this->input->post('media'),
							'diagnosis' 			=> $this->input->post('diagnosis'),
							'tindakan' 				=> $this->input->post('tindakan'),
							'no_rm' 				=> $id_pasien,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'kesadaran'				=> $this->input->post('kesadaran'),
							'tensi'					=> $this->input->post('tensi'),
							'nadi'					=> $this->input->post('nadi'),
							'suhu'					=> $this->input->post('suhu'),
							'pernapasan'			=> $this->input->post('pernapasan'),
							'nyeri'					=> $this->input->post('nyeri'),
							'keterangan_lain'		=> $this->input->post('keterangan_lain'),
							'hasil_lab'				=> $this->input->post('hasil_lab'),
							'hasil_radiologi_ekg'	=> $this->input->post('hasil_radiologi_ekg'),
							'sms_rujukan'			=> $this->input->post('ibuanak_nobidan'),
							'wa_rujukan'			=> $this->input->post('ibuanak_nobidan')


						);

					}else{
						throw new Exception('Input Error');
					}
				}

				// Rujukan Pasien Maternal Neonatal

				if ($this->input->post('type') == 2)
				{
					if($this->input->post('pasien_type')==='old'){
						$insert_data=$_POST;
						unset($insert_data['save']);
						unset($insert_data['pasien_type']);
						unset($insert_data['jenis_kelamin']);
					}elseif ($this->input->post('pasien_type')==='new'){
						$pasien_data=array(
							'nama' 			=> $this->input->post('nama'),
							'umur' 			=> $this->input->post('ibuanak_umur'),
							'pasangan' 		=> $this->input->post('ibuanak_namasuami'),
							'goldarah' 		=> $this->input->post('ibuanak_goldarah'),
							'jenis_kelamin'	=> "Perempuan",
							'nik' 			=> $this->input->post('nik')
						);
						$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
						if(!$id_pasien)
							throw new Exception('Gagal menginput pasien');
						$insert_data=array(
							'type' => $this->input->post('type'),
							//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
							'id_icdx' 			=> $this->input->post('icdx'),
							'id_rs_perujuk'		=> $this->input->post('id_rs_perujuk'),
							'id_rs_dirujuk'		=> $this->input->post('id_rs_dirujuk'),
							'id_nakes'			=> $this->input->post('id_nakes'),
							'id_kelas_bed' 		=> $this->input->post('id_kelas_bed'),
							'id_jenis_layanan' 	=> $this->input->post('id_jenis_layanan'),
							//'ibuanak_nobidan' 	=> $this->DG_rujuk->get_hp((['ibuanak_nobidan'])),
							'ibuanak_nobidan' 	=> $this->input->post('ibuanak_nobidan'),
							'ibuanak_namabidan' => $this->input->post('ibuanak_namabidan'),
							'ibuanak_kodebidan' => $this->input->post('ibuanak_kodebidan'),
							'transportasi' 		=> $this->input->post('transportasi'),
							'diagnosis' 		=> $this->input->post('diagnosis'),
							'tindakan' 			=> $this->input->post('tindakan'),
							'no_rm' 			=> $id_pasien,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'alasan_rujukan' 	=> $this->input->post('alasan_rujukan'),
							'tindakan'			=> $this->input->post('tindakan'),
							'pembiayaan'		=> $this->input->post('pembiayaan'),
							'sms_rujukan'		=> $this->input->post('ibuanak_nobidan'),
							'wa_rujukan'		=> $this->input->post('wa_rujukan'),
							'media'				=> $this->input->post('media')
						);
					}else{
						throw new Exception('Input Error');
					}
				}
				
				                // Rujukan Pasien Gynekology

				if ($this->input->post('type') == 3)
				{
					if($this->input->post('pasien_type')==='old'){
						$insert_data=$_POST;
						unset($insert_data['save']);
						unset($insert_data['pasien_type']);
						unset($insert_data['jenis_kelamin']);
					}elseif ($this->input->post('pasien_type')==='new'){
						$pasien_data=array(
							'nama' 			=> $this->input->post('nama'),
							'umur' 			=> $this->input->post('ibuanak_umur'),
							'pasangan' 		=> $this->input->post('ibuanak_namasuami'),
							'goldarah' 		=> $this->input->post('ibuanak_goldarah'),
							'jenis_kelamin'	=> "Perempuan",
							'nik' 			=> $this->input->post('nik')
						);
						$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
						if(!$id_pasien)
							throw new Exception('Gagal menginput pasien');
						$insert_data=array(
							'type' => $this->input->post('type'),
							//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
							'id_icdx' 			=> $this->input->post('icdx'),
							'id_rs_perujuk'		=> $this->input->post('id_rs_perujuk'),
							'id_rs_dirujuk'		=> $this->input->post('id_rs_dirujuk'),
							'id_nakes'			=> $this->input->post('id_nakes'),
							'id_kelas_bed' 		=> $this->input->post('id_kelas_bed'),
							'id_jenis_layanan' 	=> $this->input->post('id_jenis_layanan'),
							//'ibuanak_nobidan' 	=> $this->DG_rujuk->get_hp((['ibuanak_nobidan'])),
							'ibuanak_nobidan' 	=> $this->input->post('ibuanak_nobidan'),
							'ibuanak_namabidan' => $this->input->post('ibuanak_namabidan'),
							'ibuanak_kodebidan' => $this->input->post('ibuanak_kodebidan'),
							'transportasi' 		=> $this->input->post('transportasi'),
							'diagnosis' 		=> $this->input->post('diagnosis'),
							'tindakan' 			=> $this->input->post('tindakan'),
							'no_rm' 			=> $id_pasien,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'alasan_rujukan' 	=> $this->input->post('alasan_rujukan'),
							'tindakan'			=> $this->input->post('tindakan'),
							'pembiayaan'		=> $this->input->post('pembiayaan'),
							'sms_rujukan'		=> $this->input->post('ibuanak_nobidan'),
							'wa_rujukan'		=> $this->input->post('wa_rujukan'),
							'media'				=> $this->input->post('media')
						);
					}else{
						throw new Exception('Input Error');
					}
				}
				
                // Rujukan Pasien Neonatal

				if ($this->input->post('type') == 4)
				{
					if($this->input->post('pasien_type')==='old'){
						$insert_data=$_POST;
						unset($insert_data['save']);
						unset($insert_data['pasien_type']);
						unset($insert_data['jenis_kelamin']);
					}elseif ($this->input->post('pasien_type')==='new'){
						$pasien_data=array(
							'nama' 			=> $this->input->post('nama'),
							'umur' 			=> $this->input->post('ibuanak_umur'),
							'pasangan' 		=> $this->input->post('ibuanak_namasuami'),
							'goldarah' 		=> $this->input->post('ibuanak_goldarah'),
							'jenis_kelamin'	=> "Perempuan",
							'nik' 			=> $this->input->post('nik')
						);
						$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
						if(!$id_pasien)
							throw new Exception('Gagal menginput pasien');
						$insert_data=array(
							'type' => $this->input->post('type'),
							//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
							'id_icdx' 			=> $this->input->post('icdx'),
							'id_rs_perujuk'		=> $this->input->post('id_rs_perujuk'),
							'id_rs_dirujuk'		=> $this->input->post('id_rs_dirujuk'),
							'id_nakes'			=> $this->input->post('id_nakes'),
							'id_kelas_bed' 		=> $this->input->post('id_kelas_bed'),
							'id_jenis_layanan' 	=> $this->input->post('id_jenis_layanan'),
							//'ibuanak_nobidan' 	=> $this->DG_rujuk->get_hp((['ibuanak_nobidan'])),
							'ibuanak_nobidan' 	=> $this->input->post('ibuanak_nobidan'),
							'ibuanak_namabidan' => $this->input->post('ibuanak_namabidan'),
							'ibuanak_kodebidan' => $this->input->post('ibuanak_kodebidan'),
							'transportasi' 		=> $this->input->post('transportasi'),
							'diagnosis' 		=> $this->input->post('diagnosis'),
							'tindakan' 			=> $this->input->post('tindakan'),
							'no_rm' 			=> $id_pasien,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'alasan_rujukan' 	=> $this->input->post('alasan_rujukan'),
							'tindakan'			=> $this->input->post('tindakan'),
							'pembiayaan'		=> $this->input->post('pembiayaan'),
							'sms_rujukan'		=> $this->input->post('ibuanak_nobidan'),
							'wa_rujukan'		=> $this->input->post('wa_rujukan'),
							'media'				=> $this->input->post('media')
						);
					}else{
						throw new Exception('Input Error');
					}
				}

                // Rujukan Pasien Bayi/Balita

				if ($this->input->post('type') == 5)
				{
					if($this->input->post('pasien_type')==='old'){
						$insert_data=$_POST;
						unset($insert_data['save']);
						unset($insert_data['pasien_type']);
						unset($insert_data['jenis_kelamin']);
					}elseif ($this->input->post('pasien_type')==='new'){
						$pasien_data=array(
							'nama' 			=> $this->input->post('nama'),
							'umur' 			=> $this->input->post('ibuanak_umur'),
							'pasangan' 		=> $this->input->post('ibuanak_namasuami'),
							'goldarah' 		=> $this->input->post('ibuanak_goldarah'),
							'jenis_kelamin'	=> "Perempuan",
							'nik' 			=> $this->input->post('nik')
						);
						$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
						if(!$id_pasien)
							throw new Exception('Gagal menginput pasien');
						$insert_data=array(
							'type' => $this->input->post('type'),
							//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
							'id_icdx' 			=> $this->input->post('icdx'),
							'id_rs_perujuk'		=> $this->input->post('id_rs_perujuk'),
							'id_rs_dirujuk'		=> $this->input->post('id_rs_dirujuk'),
							'id_nakes'			=> $this->input->post('id_nakes'),
							'id_kelas_bed' 		=> $this->input->post('id_kelas_bed'),
							'id_jenis_layanan' 	=> $this->input->post('id_jenis_layanan'),
							//'ibuanak_nobidan' 	=> $this->DG_rujuk->get_hp((['ibuanak_nobidan'])),
							'ibuanak_nobidan' 	=> $this->input->post('ibuanak_nobidan'),
							'ibuanak_namabidan' => $this->input->post('ibuanak_namabidan'),
							'ibuanak_kodebidan' => $this->input->post('ibuanak_kodebidan'),
							'transportasi' 		=> $this->input->post('transportasi'),
							'diagnosis' 		=> $this->input->post('diagnosis'),
							'tindakan' 			=> $this->input->post('tindakan'),
							'no_rm' 			=> $id_pasien,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'alasan_rujukan' 	=> $this->input->post('alasan_rujukan'),
							'tindakan'			=> $this->input->post('tindakan'),
							'pembiayaan'		=> $this->input->post('pembiayaan'),
							'sms_rujukan'		=> $this->input->post('ibuanak_nobidan'),
							'wa_rujukan'		=> $this->input->post('wa_rujukan'),
							'media'				=> $this->input->post('media')
						);
					}else{
						throw new Exception('Input Error');
					}
				}

				$insert_data=$this->upload_procedure($insert_data);
				if ($this->input->post('type') == 1) {
				if(!$this->DG_Pasien->add_rs_owner($insert_data['no_rm'],$insert_data['id_rs_dirujuk'])){
					throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang dirujuk');
				}
				}

				if(!$this->DG_rujuk->insert_data($insert_data)){
					throw new Exception('Input Error');
				}
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
				redirect(base_url('panel/data_rujukan'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$this->load->model('User_model');
		$ids = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['title'] 				= 'Rujukan';
		$data['user'] 				= $this->ion_auth->user()->row();
		$data['page_head']			= 'Rujukan';
		$data['page_desc']			= 'Buat Rujukan Ke RS Lain';
		$data['pembiayaan_select']	= array();
		foreach ($this->M_Base->get_enum('pembiayaan') as $row){
			$data['pembiayaan_select'][$row]=$row;
		}
		$data['transportasi_select']	= array();
		foreach ($this->M_Base->get_enum('fungsi_mobil') as $row){
			$data['transportasi_select'][$row]=$row;
		}

		if ($this->ion_auth->in_group('psc')) $ids = TRUE;

		if($ids===TRUE) {
			$data['dirujuk']=$data['perujuk']= $this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['dirujuk']=$this->DG_rujuk->get_rs_selection(TRUE,$ids,FALSE);
			$data['perujuk']=$this->DG_rujuk->get_rs_selection(FALSE,$ids,FALSE);
		}
		if(isset($message)){
			$data['message']=$message;
		}
		$data['kelas_bed_select']=$this->DG_rujuk->get_kelas_bed_selection();
		$data['layanan_select']=$this->DG_rujuk->get_layanan_selection();
		$data['ambulance']=$this->DG_rujuk->get_ambulance();
		$data['bidan'] = $this->DG_rujuk->get_bidan();
		$data['dokter'] = $this->DG_rujuk->get_dokter();
		$data['namabidan'] = $this->DG_rujuk->get_namabidan();
		$data['namadokter'] = $this->DG_rujuk->get_namadokter();
		$data['namabidandokter'] = $this->DG_rujuk->get_namabidandokter();
		$data['bidandokter'] = $this->DG_rujuk->get_bidandokter();
		//$data['ibuanak_nobidan'] = $this->DG_rujuk->get_hp($ibuanak_nobidan);
		//$data['ibuanak_nobidan'] = $this->DG_rujuk->maskingNumber();
		//$msisdn = maskingNumber(filter($_GET['ibuanak_nobidan']));

		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujukan.create',$data);
	}

	public function rujuk_edit($idRujukan){

		$this->load->model('DG_rujuk');
		$this->load->model('DG_Pasien');
		$edit_data=$this->DG_rujuk->get_single_data(array('id_rujukan'=>$idRujukan));
		if(!$edit_data)
			show_404();
		$edit_data_user=$this->DG_rujuk->get_single_pasien_selected(array('id_rm'=>$edit_data['no_rm']));
		if(!$edit_data_user)
			show_404();
		$this->load->model('User_model');
		if($this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$edit_data['id_rs_perujuk'])===FALSE){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Tidak memiliki izin untuk mengedit rujukan ini'));
			redirect(base_url('panel/rujukan/rujuk'),'refresh');
		}
		if($_POST){

			$this->form_validation->set_rules('id_rs_perujuk','Asal Rujukan','trim|required|integer');
			$this->form_validation->set_rules('id_rs_dirujuk','Tujuan Rujukan','trim|required|integer');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');
			//$this->form_validation->set_rules('alasan_rujukan','Alasan Rujukan','trim|required');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				if($this->input->post('pasien_type')==='old'){
					$new_data=$_POST;
					unset($new_data['save']);
					unset($new_data['pasien_type']);
				}elseif ($this->input->post('pasien_type')==='new'){
					$pasien_data=array(
						'nama'			=> $this->input->post('nama'),
						'kontak'		=> $this->input->post('kontak'),
						'tgl_lahir'		=> $this->input->post('tgl_lahir'),
						'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
						'nik'			=> $this->input->post('nik'),
						'tempat_lahir'	=> $this->input->post('tempat_lahir'),
						'alamat'		=> $this->input->post('alamat'),
					);
					$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
					if(!$id_pasien)
						throw new Exception('Gagal menginput pasien');
					$new_data=array(
						'id_icdx' => $this->input->post('icdx'),
						//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
						'id_rs_perujuk'			=> $this->input->post('id_rs_perujuk'),
						'ibuanak_namabidan' 	=> $this->input->post('ibuanak_namabidan'),
						'ibuanak_nobidan' 		=> $this->input->post('ibuanak_nobidan'),
						'ibuanak_kodebidan' 	=> $this->input->post('ibuanak_kodebidan'),
						'id_rs_dirujuk'			=> $this->input->post('id_rs_dirujuk'),
						'id_nakes'				=> $this->input->post('id_nakes'),
						'id_kelas_bed' 			=> $this->input->post('id_kelas_bed'),
						'id_jenis_layanan' 		=> $this->input->post('id_jenis_layanan'),
						'id_ambulance'			=> $this->input->post('id_ambulance'),
						'transportasi'			=> $this->input->post('transportasi'),
						'alasan_rujukan' 		=> $this->input->post('alasan_rujukan'),
						'pembiayaan' 			=> $this->input->post('pembiayaan'),
						'diagnosis' 			=> $this->input->post('diagnosis'),
						'no_rm' 				=> $id_pasien,
						'kesadaran'				=> $this->input->post('kesadaran'),
						'tensi'					=> $this->input->post('tensi'),
						'nadi'					=> $this->input->post('nadi'),
						'suhu'					=> $this->input->post('suhu'),
						'pernapasan'			=> $this->input->post('pernapasan'),
						'GCS'					=> $this->input->post('nyeri'),
						'keterangan_lain'		=> $this->input->post('keterangan_lain'),
						'hasil_lab'				=> $this->input->post('hasil_lab'),
						'hasil_radiologi_ekg'	=> $this->input->post('hasil_radiologi_ekg'),
						'tindakan'				=> $this->input->post('tindakan'),
						'sms_rujukan'			=> $this->input->post('wa_rujukan'),
						'wa_rujukan'			=> $this->input->post('wa_rujukan'),
						'media'					=> $this->input->post('media'),
					);
					if(!$this->DG_Pasien->add_rs_owner($id_pasien,$new_data['id_rs_perujuk'])){
						throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang merujuk');
					}
				}else{
					throw new Exception('Update Error');
				}
				$new_data=$this->upload_procedure($new_data);
				if(!$this->DG_Pasien->add_rs_owner($new_data['no_rm'],$new_data['id_rs_dirujuk'])){
					throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang dirujuk');
				}
				if(!$this->DG_rujuk->update_data(array('id_rujukan'=>$idRujukan),$new_data)){
					throw new Exception('Update Error');
				}
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
				redirect(base_url('panel/data_rujukan'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujukan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan';
		$data['page_desc']	= 'Edit Rujukan Ke RS Lain';

		if ($this->ion_auth->in_group('psc')) $ids = TRUE;

		if($ids===TRUE){
			$data['dirujuk']=$data['perujuk']= $this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['dirujuk']=$this->DG_rujuk->get_rs_selection(TRUE,$ids,FALSE);
			$data['perujuk']=$this->DG_rujuk->get_rs_selection(FALSE,$ids,FALSE);
		}
		if(isset($message)){
			$data['message']=$message;
		}
		$data['edit_data']=$edit_data;
		$data['pasien'] = $this->DG_rujuk->get_pasien($edit_data['no_rm']);
		$data['selected_user_select']=$edit_data_user;
		$data['pembiayaan_select']	= array();
		foreach ($this->M_Base->get_enum('pembiayaan') as $row){
			$data['pembiayaan_select'][$row]=$row;
		}
		$data['transportasi_select']	= array();
		foreach ($this->M_Base->get_enum('fungsi_mobil') as $row){
			$data['transportasi_select'][$row]=$row;
		}
		$data['kelas_bed_select']=$this->DG_rujuk->get_kelas_bed_selection();
		$data['layanan_select']=$this->DG_rujuk->get_layanan_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujukan.edit',$data);
	}
	
		public function rujuk_batal($idRujukan){

		$this->load->model('DG_rujuk');
		$this->load->model('DG_Pasien');
		$edit_data=$this->DG_rujuk->get_single_data(array('id_rujukan'=>$idRujukan));
		if(!$edit_data)
			show_404();
		$edit_data_user=$this->DG_rujuk->get_single_pasien_selected(array('id_rm'=>$edit_data['no_rm']));
		if(!$edit_data_user)
			show_404();
		$this->load->model('User_model');
		if($this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$edit_data['id_rs_perujuk'])===FALSE){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Tidak memiliki izin untuk mengedit rujukan ini'));
			redirect(base_url('panel/rujukan/rujuk'),'refresh');
		}
		if($_POST){

			$this->form_validation->set_rules('id_rs_perujuk','Asal Rujukan','trim|required|integer');
			$this->form_validation->set_rules('id_rs_dirujuk','Tujuan Rujukan','trim|required|integer');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');
			//$this->form_validation->set_rules('alasan_rujukan','Alasan Rujukan','trim|required');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				if($this->input->post('pasien_type')==='old'){
					$new_data=$_POST;
					unset($new_data['save']);
					unset($new_data['pasien_type']);
				}elseif ($this->input->post('pasien_type')==='new'){
					$pasien_data=array(
						'nama'			=> $this->input->post('nama'),
						'kontak'		=> $this->input->post('kontak'),
						'tgl_lahir'		=> $this->input->post('tgl_lahir'),
						'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
						'nik'			=> $this->input->post('nik'),
						'tempat_lahir'	=> $this->input->post('tempat_lahir'),
						'alamat'		=> $this->input->post('alamat'),
					);
					$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
					if(!$id_pasien)
						throw new Exception('Gagal menginput pasien');
					$new_data=array(
						'id_icdx' => $this->input->post('icdx'),
						//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
						'id_rs_perujuk'			=> $this->input->post('id_rs_perujuk'),
						'ibuanak_namabidan' 	=> $this->input->post('ibuanak_namabidan'),
						'ibuanak_nobidan' 		=> $this->input->post('ibuanak_nobidan'),
						'ibuanak_kodebidan' 	=> $this->input->post('ibuanak_kodebidan'),
						'id_rs_dirujuk'			=> $this->input->post('id_rs_dirujuk'),
						'id_nakes'				=> $this->input->post('id_nakes'),
						'id_kelas_bed' 			=> $this->input->post('id_kelas_bed'),
						'id_jenis_layanan' 		=> $this->input->post('id_jenis_layanan'),
						'id_ambulance'			=> $this->input->post('id_ambulance'),
						'transportasi'			=> $this->input->post('transportasi'),
						'alasan_rujukan' 		=> $this->input->post('alasan_rujukan'),
						'pembiayaan' 			=> $this->input->post('pembiayaan'),
						'diagnosis' 			=> $this->input->post('diagnosis'),
						'no_rm' 				=> $id_pasien,
						'kesadaran'				=> $this->input->post('kesadaran'),
						'tensi'					=> $this->input->post('tensi'),
						'nadi'					=> $this->input->post('nadi'),
						'suhu'					=> $this->input->post('suhu'),
						'pernapasan'			=> $this->input->post('pernapasan'),
						'GCS'					=> $this->input->post('nyeri'),
						'keterangan_lain'		=> $this->input->post('keterangan_lain'),
						'hasil_lab'				=> $this->input->post('hasil_lab'),
						'hasil_radiologi_ekg'	=> $this->input->post('hasil_radiologi_ekg'),
						'tindakan'				=> $this->input->post('tindakan'),
						'sms_rujukan'			=> $this->input->post('wa_rujukan'),
						'wa_rujukan'			=> $this->input->post('wa_rujukan'),
						'media'					=> $this->input->post('media'),
					);
					if(!$this->DG_Pasien->add_rs_owner($id_pasien,$new_data['id_rs_perujuk'])){
						throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang merujuk');
					}
				}else{
					throw new Exception('Update Error');
				}
				$new_data=$this->upload_procedure($new_data);
				if(!$this->DG_Pasien->add_rs_owner($new_data['no_rm'],$new_data['id_rs_dirujuk'])){
					throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang dirujuk');
				}
				if(!$this->DG_rujuk->update_data(array('id_rujukan'=>$idRujukan),$new_data)){
					throw new Exception('Update Error');
				}
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
				redirect(base_url('panel/data_rujukan'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujukan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan';
		$data['page_desc']	= 'Edit Rujukan Ke RS Lain';

		if ($this->ion_auth->in_group('psc')) $ids = TRUE;

		if($ids===TRUE){
			$data['dirujuk']=$data['perujuk']= $this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['dirujuk']=$this->DG_rujuk->get_rs_selection(TRUE,$ids,FALSE);
			$data['perujuk']=$this->DG_rujuk->get_rs_selection(FALSE,$ids,FALSE);
		}
		if(isset($message)){
			$data['message']=$message;
		}
		$data['edit_data']=$edit_data;
		$data['pasien'] = $this->DG_rujuk->get_pasien($edit_data['no_rm']);
		$data['selected_user_select']=$edit_data_user;
		$data['pembiayaan_select']	= array();
		foreach ($this->M_Base->get_enum('pembiayaan') as $row){
			$data['pembiayaan_select'][$row]=$row;
		}
		$data['transportasi_select']	= array();
		foreach ($this->M_Base->get_enum('fungsi_mobil') as $row){
			$data['transportasi_select'][$row]=$row;
		}
		$data['kelas_bed_select']=$this->DG_rujuk->get_kelas_bed_selection();
		$data['layanan_select']=$this->DG_rujuk->get_layanan_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujukan.edit',$data);
	}
	
	public function rujuk_delete($idRujukan){
		$this->load->model('User_model');
		$this->load->model('DG_rujuk');
		try{
			$rujuk_data=$this->DG_rujuk->get_single_data(array('id_rujukan'=>$idRujukan));
			if(!$rujuk_data)
				throw new Exception('Rujukan tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$rujuk_data['id_rs_perujuk']))
				throw new Exception('Tidak memiliki ijin untuk menghapus rujukan ini');
			if(!$this->DG_rujuk->delete_data(array('id_rujukan'=>$rujuk_data['id_rujukan'])))
				throw new Exception('Gagal menghapus rujukan');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Rujukan Telah dapat dihapus'));
			redirect(base_url('panel/data_rujukan'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/data_rujukan'),'refresh');
		}
	}
	public function rujuk_export(){
		$this->load->model('DG_rujuk');
		if($_POST){
			$this->DG_rujuk->export_excel(array(
				'id_rs'	=> $this->input->post('id_rs')===0?NULL:$this->input->post('id_rs'),
				'start'	=> $this->input->post('start'),
				'end'	=> $this->input->post('end'),
			));
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Rujukan Fasilitas Kesehatan';
		$data['user']		= $this->ion_auth->user()->row();;
		$data['page_head']	= 'Rujukan Fasilitas Kesehatan';
		$data['page_desc']	= 'Export Data Rujukan Keluar Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		if($ids===TRUE){
			$data['selection_rs']=$this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['selection_rs']=$this->DG_rujuk->get_rs_selection(FALSE,$ids,FALSE);
		}
		$data['selection_rs'] 	= array('0'=>'Semua')+$data['selection_rs'];
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujukan.export',$data);
	}
	/**
	 * =================================================================================
	 * Balik
	 * =================================================================================
	 */
	public function balik(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujuk Diterima';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan Diterima';
		$data['page_desc']	= 'List Rujukan Diterima';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();

		$data=array_merge($data,$data_back);
		render_back('pages.rujukan_balik.list',$data);
	}
	public function balik_data($param = null){

		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_rujuk');

		if(!$this->ion_auth->is_admin() and !$this->ion_auth->in_group('psc')) {
			$this->load->model('User_model');
			$this->DG_rujuk->setIn('tb_rujukan.id_rs_dirujuk',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}
		if ($param != NULL)
		{
			$par = explode('_',$param);

			if ($par[1] != 'all') {
				$this->DG_rujuk->setWhere('tb_rujukan.dibuat >=',$par[1]);
				$this->DG_rujuk->setWhere('tb_rujukan.dibuat <=',$par[2]);
			}
			if ($par[0] != 'all') $this->DG_rujuk->setWhere('tb_rs.jenis', str_replace('%20',' ',$par[0]));

		}

		$data=$this->DG_rujuk->get($limit,$offset,$q['value'],get_order_by($columns,$order));

		$data_filtered = array();
		foreach($data as $d) {
			$awal  = date_create($d->dibuat);
			$akhir = date_create();
			$diff  = date_diff( $awal, $akhir );

			$d->darurat = false;
			if ((($diff->h*60)+$diff->i) <=5 ) $d->darurat = true;
			foreach($this->var_darurat as $vd) {
				if (strpos(strtolower($d->diagnosis), $vd) !== false) $d->darurat = true;
			}
			$data_filtered[] = $d;
		}

		$all_data=$this->DG_rujuk->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data_filtered,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_rujuk->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function balik_konfirmasi($idRujukan){
		$this->load->model('DG_Rujuk_Balik');
		$detil_rujukan=$this->DG_Rujuk_Balik->get_rujukan_info($idRujukan);

		if(!$detil_rujukan)
			show_404();
		$id_dirujuk=$detil_rujukan['id_dirujuk'];
		//unset($detil_rujukan['id_dirujuk']);
		if($_POST){
			$this->form_validation->set_rules('status_rujukan','Status Rujukan','trim|required|in_list[Diterima,Ditolak,Dialihkan]');
			$this->form_validation->set_rules('info_rujuk_balik','Status Rujukan','trim');
			try{
				try{
					if($this->form_validation->run()==FALSE)
						throw new Exception(validation_errors());
					$this->load->model('User_model');
					if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$id_dirujuk))
					{
						$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak bisa mengkonfirmasi rujukan ini'));
						redirect(base_url('panel/rujukan/balik'),'refresh');
					}
					unset($_POST['save']);
					$this->db->set('direspon','NOW()',FALSE);
					$this->db->set('id_penerima',$this->ion_auth->get_user_id());
					if ($_POST['status_rujukan'] != "Dialihkan") {
						unset($_POST['id_rs_pengalih']);
						unset($_POST['id_rs_dirujuk']);
					}
					if(!$this->DG_Rujuk_Balik->update_data(array('id_rujukan'=>$idRujukan),$_POST))
						throw new Exception('Gagal mengkonfirmasi rujukan');

					// -- SMS Jawaban Rujukan & Advis RS-- //
					$alasan = null;
					if ($_POST['info_rujuk_balik'] != null) $alasan = ', advis dr '.$_POST['info_rujuk_balik'];

					$result = $this->sms_konfirmasi([
						'no' => $detil_rujukan['sms_rujukan'],
						'message' => 'Rujukan '.($detil_rujukan['type']==1?'Umum':'Mat/Neo').' a.n '.$detil_rujukan['pasien'].': '.$_POST['status_rujukan'] .$alasan .'. PSC SIIRMAAYU WA Call.+6287709046020 Tlp.119, ID: '.$idRujukan]);
						//'message' => 'Rujukan '.($detil_rujukan['type']==1?'Umum':'Mat/Neo').' a.n '.$detil_rujukan['pasien'].': '.$_POST['status_rujukan'] .$alasan .'. PSC SIIRMAAYU, ID: ']);

					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Rujukan telah berhasil dikonfirmasi'));
					//redirect(base_url('panel/rujukan/balik'),'refresh'); data_rujukan
					redirect(base_url('panel/data_rujukan'),'refresh'); 
				}catch (Exception $e){
					$message=array('status'=>FALSE,'message'=>$e->getMessage());
				}
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['detil_rujukan']	= $detil_rujukan;
		$data['title'] 		= 'Rujuk Diterima';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan Diterima';
		$data['page_desc']	= 'Respon Rujukan';

		$this->load->model('DG_rujuk');
		$data['selection_rs']=$this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		$data['selection_namars']=$this->DG_rujuk->get_namars_selection(FALSE,array(),TRUE);

		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujukan_balik.respon',$data);
	}

	public function sms_konfirmasi($data)
	{
		$this->config->load('smartrujukan');
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $this->config->item('sms_url'));
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
		    'userkey' => $this->config->item('sms_userkey'),
		    'passkey' => $this->config->item('sms_passkey'),
		    'instance' => $this->config->item('instanceID'),
		    'nohp' => $data['no'],
		    'pesan' => $data['message']
		));
		$results = json_decode(curl_exec($curlHandle), true);
		curl_close($curlHandle);
	}

	public function wa_konfirmasi($data)
	{
		$this->config->load('smartrujukan');
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $this->config->item('wa_url1'));
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
		    'number' => $this->config->item('wa_number'),
		    'apikey' => $this->config->item('wa_apikey'),
		    'nohp' => $data['no'],
		    'pesan' => $data['message']
		));
		$results = json_decode(curl_exec($curlHandle), true);
		curl_close($curlHandle);
	}

	public function balik_jawab($idRujukan){
		$this->load->model('DG_rujuk_konfirmasi');
		$this->load->model('DG_Rujuk_Balik');
		$detil_rujukan=$this->DG_Rujuk_Balik->get_rujukan_info($idRujukan);
		if(!$detil_rujukan)
			show_404();
		$id_dirujuk=$detil_rujukan['id_dirujuk'];
		if($_POST){
			$this->form_validation->set_rules('rujukbalik_status','Status Rujuk Balik','required');
			//$this->form_validation->set_rules('rujukbalik_tanggal','Tanggal Rujuk Balik','trim|required');
			try{
				try{
					if($this->form_validation->run()==FALSE)
						throw new Exception(validation_errors());
					
					unset($_POST['save']);
					if ($_POST['rujukbalik_status'] == "Meninggal Dunia" || ['rujukbalik_status'] == 'Batal' ) {
						unset($_POST['rujukbalik_fu_tanggal']);
						unset($_POST['rujukbalik_fu_id']);
					}
					if(!$this->DG_rujuk_konfirmasi->update_data(array('id_rujukan'=>$idRujukan),$_POST))
						throw new Exception('Gagal mengkonfirmasi rujuk balik');
					
					// -- SMS Rujukan Balik-- //
					
					$rujukbalik_tindakan = null;
					if ($_POST['rujukbalik_diagnosa'] != null) $rujukbalik_tindakan = ' dg. dx: '.$_POST['rujukbalik_diagnosa'];
					$result = $this->sms_konfirmasi([
						'no' => $detil_rujukan['sms_rujukan'],
						//'message' => 'Rujukan Balik u/ Px. '.($detil_rujukan['type']==1?'Umum':'Mat/Neo').' a.n '.$detil_rujukan['pasien'].' status: '.$_POST['rujukbalik_status'].'. Tx : '.$_POST['rujukbalik_tindakan'].' Tgl: '.$_POST['rujukbalik_tanggal'].' dgn dx/FU: '.$_POST['rujukbalik_diagnosa'].' Kontrol ke: '.$_POST['rujukbalik_fu_id'] .', Tgl Kntrl: '.$_POST['rujukbalik_fu_tanggal']. '. PSC SIIRMAAYU, ID: '.$idRujukan]);
                        'message' => 'Rujukan Balik u/ Px. '.($detil_rujukan['type']==1?'Umum':'Mat/Neo').' a.n '.$detil_rujukan['pasien'].' status: '.$_POST['rujukbalik_status'].'. Tx : '.$_POST['rujukbalik_tindakan'].' Tgl: '.$_POST['rujukbalik_tanggal'].' dgn dx/FU: '.$_POST['rujukbalik_diagnosa'].' Kontrol ke: '.$_POST['rujukbalik_fu_id'] .', Tgl Kntrl: '.$_POST['rujukbalik_fu_tanggal']. '. PSC SIIRMAAYU WA Call.+6287709046020 Tlp.119, ID: '.$idRujukan]);
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Rujuk Balik telah berhasil dikonfirmasi'));
					redirect(base_url('panel/data_rujukan'),'refresh');
				}catch (Exception $e){
					$message=array('status'=>FALSE,'message'=>$e->getMessage());
				}
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['detil_rujukan']	= $detil_rujukan;
		$data['title'] 		= 'Rujuk Balik';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujuk Balik';
		$data['page_desc']	= 'Respon Rujuk Balik';
		$data['id_rujukan'] = $idRujukan;
 
		$this->load->model('DG_rujuk');
		$data['selection_rs']=$this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		$data['selection_namars']=$this->DG_rujuk->get_namars_selection(FALSE,array(),TRUE);

		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujuk_balik.jawab',$data);
	}

	public function balik_export(){
		$this->load->model('DG_Rujuk_Balik');
		if($_POST){
			$this->DG_Rujuk_Balik->export_excel(array(
				'id_rs'	=> $this->input->post('id_rs')===0?NULL:$this->input->post('id_rs'),
				'start'	=> $this->input->post('start'),
				'end'	=> $this->input->post('end'),
			));
		}
		$this->load->model('DG_rujuk');
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Rujukan Fasilitas Kesehatan';
		$data['user']		= $this->ion_auth->user()->row();;
		$data['page_head']	= 'Rujukan Fasilitas Kesehatan';
		$data['page_desc']	= 'Export Data Rujukan Masuk Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		if($ids===TRUE){
			$data['selection_rs']=$this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['selection_rs']=$this->DG_rujuk->get_rs_selection(TRUE,$ids,FALSE);
		}
		$data['selection_rs'] 	= array('0'=>'Semua')+$data['selection_rs'];
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujukan_balik.export',$data);
	}

	/**
	 * =================================================================================
	 * Pasien
	 * =================================================================================
	 */

		public function pasien(){
			$data=$this->M_Base->get_config();
			$data['title'] 		= 'Data Pasien';
			$data['user'] 		= $this->ion_auth->user()->row();
			$data['page_head']	= 'Data Pasien';
			$data['page_desc']	= 'List Data Pasien';
			if($message=$this->session->flashdata('message')){
				$data['message']=$message;
			}
			$data_back=$this->M_Base->get_data_back();
			$data=array_merge($data,$data_back);
			render_back('pages.pasien.list',$data);
		}
		public function pasien_data(){
			//get all the param
			$offset=$this->input->get('start');
			$limit=$this->input->get('length');
			$q=$this->input->get('search');
			$columns=$this->input->get('columns');
			$order=$this->input->get('order');

			$this->load->model('DG_Pasien');
			if(!$this->ion_auth->is_admin()){
				$this->load->model('User_model');
				$this->DG_Pasien->setIn('tb_pasien_owner.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
			}
			$data=$this->DG_Pasien->get($limit,$offset,$q['value'],get_order_by($columns,$order));
			$all_data=$this->DG_Pasien->total();
			$response=array(
				'draw'=>$this->input->get('draw'),
				'data'=>$data,
				'recordsTotal'=>$all_data,
				'recordsFiltered'=>$q?$this->DG_Pasien->total_filtered($q['value']):$all_data
			);
			send_json($response);
		}
		public function pasien_add(){
			if($_POST){
				$this->form_validation->set_rules('nama','Nama Pasien','required|trim|alpha_numeric_spaces');
				$this->form_validation->set_rules('kontak','Kontak Pasien','trim');
				$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','trim');
				$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','trim|alpha_numeric_spaces');
				$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','trim|in_list[Laki-laki,Perempuan]');
				$this->form_validation->set_rules('nik','NIK','trim|numeric');
				$this->form_validation->set_rules('alamat','Alamat','trim');
				$this->form_validation->set_rules('rs_owner[]','Fasilitas Kesehatan','required');
				if($this->form_validation->run()==FALSE){
					$message=array('status'=>FALSE,'message'=>validation_errors());
				}else{
					$this->load->model('DG_Pasien');
					unset($_POST['save']);
					if($this->DG_Pasien->insert_data($_POST)){
						$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
						redirect(base_url('panel/rujukan/pasien'),'refresh');
					}else{
						$message=array('status'=>FALSE,'message'=>'Gagal Menambahkan Data');
					}
				}
			}
			$data=$this->M_Base->get_config();
			if(isset($message))
				$data['message']=$message;
			$data['title'] 		= 'Data Pasien';
			$data['user'] 		= $this->ion_auth->user()->row();
			$data['page_head']	= 'Data Pasien';
			$data['page_desc']	= 'Tambah Data Pasien';
			$data_back=$this->M_Base->get_data_back();
			$this->load->model('Model_Rumah_Sakit');
			$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
			$data=array_merge($data,$data_back);
			render_back('pages.pasien.create',$data);
		}
		public function pasien_edit($id_pasien){
			$this->load->model('DG_Pasien');
			$edit_data=$this->DG_Pasien->get_single_data(array('id_rm'=>$id_pasien));
			if($edit_data===NULL)
				show_404();
			//TODO: if not admin, harus punya hak akses di tb_owner

			//end of hak akses
			if($_POST){
				$this->form_validation->set_rules('nama','Nama Pasien','required|trim|alpha_numeric_spaces');
				$this->form_validation->set_rules('kontak','Kontak Pasien','trim');
				$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','trim');
				$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','trim|alpha_numeric_spaces');
				$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','trim|in_list[Laki-laki,Perempuan]');
				$this->form_validation->set_rules('nik','NIK','trim|numeric');
				$this->form_validation->set_rules('alamat','Alamat','trim');
				if($this->ion_auth->is_admin()){
					$this->form_validation->set_rules('rs_owner[]','Fasilitas Kesehatan','required');
				}else{
					if(isset($_POST['rs_owner']))
						unset($_POST['rs_owner']);
				}
				if($this->form_validation->run()==FALSE){
					$message=array('status'=>FALSE,'message'=>validation_errors());
				}else{
					unset($_POST['save']);
					if($this->DG_Pasien->update_data(array('id_rm'=>$id_pasien),$_POST)){
						$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Diedit'));
						redirect(base_url('panel/rujukan/pasien'),'refresh');
					}else{
						$message=array('status'=>FALSE,'message'=>'Gagal mengedit Data');
					}
				}
			}
			$data=$this->M_Base->get_config();
			if(isset($message))
				$data['message']=$message;
			$data['title'] 		= 'Data Pasien';
			$data['user'] 		= $this->ion_auth->user()->row();
			$data['page_head']	= 'Data Pasien';
			$data['page_desc']	= 'Tambah Data Pasien';
			$data['edit_data']	= $edit_data;
			$data['owners_list']=array();
			foreach ($edit_data['owners'] as $owner){
				array_push($data['owners_list'],$owner['id_rs']);
			}
			$data_back=$this->M_Base->get_data_back();
			$this->load->model('Model_Rumah_Sakit');
			$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
			$data=array_merge($data,$data_back);
			render_back('pages.pasien.edit',$data);
		}
		public function pasien_delete($id_pasien){
			if($this->ion_auth->is_admin()){
				$this->load->model('DG_Pasien');
				if($this->DG_Pasien->delete_data(array('id_rm'=>$id_pasien))){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Terhapus'));
					redirect(base_url('panel/rujukan/pasien'),'refresh');
				}else{
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Gagal menghapus data'));
					redirect(base_url('panel/rujukan/pasien'),'refresh');
				}
			}else{
				$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Maaf Anda Tidak Bisa Menghapus Pasien'));
				redirect(base_url('panel/rujukan/pasien'),'refresh');
			}
		}
	/**
	 * =================================================================================
	 * Utility
	 * =================================================================================
	 */
	public function pasien_list(){
		$query=$this->input->get('q');
		$this->load->model('User_model');
		if(($ids=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()))!==TRUE){
			$this->db->join('tb_pasien_owner','tb_pasien.id_rm=tb_pasien_owner.id_rm');
			$this->db->group_by('tb_pasien.id_rm');
			$this->db->where_in('tb_pasien_owner.id_rs',$ids);
		}
		if($query){
			$this->db->group_start();
			$this->db->like('nama',$query);
			$this->db->or_like('kontak',$query);
			$this->db->or_like('nik',$query);
			$this->db->group_end();
		}
		$data=$this->db->get('tb_pasien',5,0)->result();
		send_json($data);
	}

	public function icdx_list(){
		$query=$this->input->get('q');
		$this->db->like('kode',$query);
		$this->db->or_like('keterangan',$query);

		$data=$this->db->get('tb_icdx',5,0)->result();
		send_json($data);
	}

	public function find_nakes(){
		$query = $this->input->get('q');
		$type = $this->input->get('type');
		$this->db->like($type,$query);
		if ($this->input->get('bidan')) $this->db->where('profesi_name','Bidan');
		$this->db->order_by($type);
		$this->db->select('telp,nama,id_rs');

		$data=$this->db->get('tb_nakes',20,0)->result();
		send_json($data);
	}


	public function recomend_rs($info){
		$this->load->model('DG_rujuk');
		$data=$this->DG_rujuk->rs_recomendation($this->input->post('id_kelas_bed'),$this->input->post('id_jenis_layanan'),$info['perujuk']);
		send_json($data);
	}

	// Rujukan Balik -Rujukan Pulang
	public function konfirmasi(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujuk Balik';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan Balik';
		$data['page_desc']	= 'List Rujukan Balik';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujuk_balik.list',$data);
	}
	public function konfirmasi_data($param = null){

		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_rujuk_konfirmasi');

		if(!$this->ion_auth->is_admin()){
			$this->load->model('User_model');
			$this->DG_rujuk_konfirmasi->setIn('tb_rujukan.id_rs_perujuk',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}
		if ($param != NULL)
		{
			$par = explode('_',$param);

			if ($par[1] != 'all') {
				$this->DG_rujuk_konfirmasi->setWhere('tb_rujukan.dibuat >=',$par[1]);
				$this->DG_rujuk_konfirmasi->setWhere('tb_rujukan.dibuat <=',$par[2]);
			}
			if ($par[0] != 'all') $this->DG_rujuk_konfirmasi->setWhere('tb_rs.jenis', str_replace('%20',' ',$par[0]));

		}


		$data=$this->DG_rujuk_konfirmasi->get($limit,$offset,$q['value'],get_order_by($columns,$order));

		$all_data=$this->DG_rujuk_konfirmasi->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_rujuk_konfirmasi->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}


	public function konfirmasi_export(){
		$this->load->model('DG_rujuk_konfirmasi');
		if($_POST){
			$this->DG_rujuk_konfirmasi->export_excel(array(
				'id_rs'	=> $this->input->post('id_rs')===0?NULL:$this->input->post('id_rs'),
				'start'	=> $this->input->post('start'),
				'end'	=> $this->input->post('end'),
			));
		}
		$this->load->model('DG_rujuk');
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Rujukan Fasilitas Kesehatan';
		$data['user']		= $this->ion_auth->user()->row();;
		$data['page_head']	= 'Rujukan Balik Fasilitas Kesehatan';
		$data['page_desc']	= 'Export Data Rujukan Balik Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		if($ids===TRUE){
			$data['selection_rs']=$this->DG_rujuk->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['selection_rs']=$this->DG_rujuk->get_rs_selection(TRUE,$ids,FALSE);
		}
		$data['selection_rs'] 	= array('0'=>'Semua')+$data['selection_rs'];
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rujuk_konfirmasi.export',$data);
	}

	public function psc(){
		$this->load->model('User_model');
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujukan PSC';
		$data['rs'] = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan PSC';
		$data['page_desc']	= 'Daftar Rujukan PSC';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.psc.list',$data);
	}

	public function psc_data(){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_psc');

		if(!$this->ion_auth->is_admin() and !$this->ion_auth->in_group('psc')) {
			$this->load->model('User_model');
			$this->DG_psc->setIn('tb_psc.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_psc->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_psc->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_psc->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}

	public function psc_add(){

		$this->load->model('DG_psc');

		if($_POST){

			try{
				// if($this->form_validation->run()==FALSE)
				// 	throw new Exception(validation_errors());

				$insert_data=$_POST;

				if(!$this->DG_psc->insert_data($insert_data)){
					throw new Exception('Input Error');
				}
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
				redirect(base_url('panel/rujukan/psc'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['title'] 				= 'PSC';
		$data['user'] 				= $this->ion_auth->user()->row();
		$data['page_head']			= 'PSC';
		$data['page_desc']			= 'PSC Laporan';
		$data['pembiayaan_select']	= array();
		foreach ($this->M_Base->get_enum('pembiayaan') as $row){
			$data['pembiayaan_select'][$row]=$row;
		}
		$data['transportasi_select']	= array();
		foreach ($this->M_Base->get_enum('fungsi_mobil') as $row){
			$data['transportasi_select'][$row]=$row;
		}
		if($ids===TRUE){
			$data['dirujuk']= $this->DG_psc->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['dirujuk']=$this->DG_psc->get_rs_selection(FALSE,$ids,FALSE);
		}
		if(isset($message)){
			$data['message']=$message;
		}
		$data['kategori_pelapor'] = array(
			'' => 'Pilih Kategori Pelapor',
			'Orang Awam Umum' => 'Orang Awam Umum',
			'Aparat/Keamanan' => 'Aparat/Keamanan',
			'Bidan' => 'Bidan',
			'Perawat' => 'Perawat',
			'Dokter' => 'Dokter'
		);

		$data['goldarah_select'] = array(
			'' => 'Belum Diketahui',
			'A' => 'A',
			'AB' => 'AB',
			'B' => 'B',
			'O' => 'O'
		);

		$data['kategori_psc_select']	= array('' => 'Pilih Kategori PSC');
		foreach ($this->M_Base->get_enum('kategori_psc') as $row){
			$data['kategori_psc_select'][$row]=$row;
		}

		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.psc.create',$data);
	}

	public function psc_edit($id){

		$this->load->model('DG_psc');
		$this->load->model('DG_Pasien');
		$edit_data=$this->DG_psc->get_single_data(array('id_psc'=>$id));
		if(!$edit_data)
			show_404();

		if($_POST){

			$message=array('status'=>FALSE,'message'=>'Input Error');
			try{
				// if($this->form_validation->run()==FALSE)
				// 	throw new Exception(validation_errors());

				$new_data=$_POST;

				if(!$this->DG_psc->update_data(array('id_psc'=>$id),$new_data)){
					throw new Exception('Update Error');
				}
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Rujukan PSC tersimpan'));
				redirect(base_url('panel/rujukan/psc'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$this->load->model('User_model');
		$ids = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujukan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan';
		$data['page_desc']	= 'Edit Rujukan Ke RS Lain';
		if($ids===TRUE){
			$data['dirujuk']= $this->DG_psc->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['dirujuk']=$this->DG_psc->get_rs_selection(FALSE,$ids,FALSE);
		}
		if(isset($message)){
			$data['message']=$message;
		}

		$data['edit_data']=$edit_data;
		$data['pembiayaan_select']	= array();
		foreach ($this->M_Base->get_enum('pembiayaan') as $row){
			$data['pembiayaan_select'][$row]=$row;
		}
		$data['transportasi_select']	= array();
		foreach ($this->M_Base->get_enum('fungsi_mobil') as $row){
			$data['transportasi_select'][$row]=$row;
		}
		$data['kategori_pelapor'] = array(
			'' => 'Pilih Kategori Pelapor',
			'Orang Awam Umum' => 'Orang Awam Umum',
			'Aparat/Kemanan' => 'Aparat/Kemanan',
			'Bidan' => 'Bidan',
			'Perawat' => 'Perawat',
			'Dokter' => 'Dokter'
		);

		$data['goldarah_select'] = array(
			'' => 'Belum Diketahui',
			'A' => 'A',
			'AB' => 'AB',
			'B' => 'B',
			'O' => 'O'
		);

		$data['kategori_psc_select']	= array('' => 'Pilih Kategori PSC');
		foreach ($this->M_Base->get_enum('kategori_psc') as $row){
			$data['kategori_psc_select'][$row]=$row;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.psc.create',$data);
	}
	public function psc_delete($id){
		$this->load->model('User_model');
		$this->load->model('DG_psc');
		try{
			$psc_data=$this->DG_psc->get_single_data(array('id_psc'=>$id));
			if(!$psc_data)
				throw new Exception('Rujukan PSC tidak ditemukan');
			if(!$this->DG_psc->delete_data(array('id_psc'=>$psc_data['id_psc'])))
				throw new Exception('Gagal menghapus rujukan');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Rujukan PSC telah dihapus'));
			redirect(base_url('panel/rujukan/psc'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rujukan/psc'),'refresh');
		}
	}
 // -- PSC END -- /

 //-- START COVID--//

    public function covid(){
		$this->load->model('User_model');
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Covid';
		$data['rs'] = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Covid';
		$data['page_desc']	= 'List Riwayat Covid';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.covid.list',$data);
	}
	public function covid_data(){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_covid');

		if(!$this->ion_auth->is_admin() and !$this->ion_auth->in_group('psc')) {
			$this->load->model('User_model');
			$this->DG_covid->setIn('tb_covid.id_rs_perujuk',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_covid->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_covid->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_covid->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}


	public function covid_add(){
		$this->load->model('DG_covid');
		$this->load->model('DG_Pasien');
		if($_POST){
			switch ($_POST['pasien_type']){
				case 'old':
					$this->form_validation->set_rules('no_rm','Pasien','required|is_natural_no_zero');
					break;
				case 'new':
					if ($_POST['type'] == 1)
					{
						$this->form_validation->set_rules('nama','Nama Pasien','required|trim|max_length[255]');
						//$this->form_validation->set_rules('nama','Nama Pasien','required|trim|alpha_numeric_spaces');
						//$this->form_validation->set_rules('kontak','Kontak Pasien','trim');
						//$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','trim');
						//$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','trim|alpha_numeric_spaces');
						//$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','trim|in_list[Laki-laki,Perempuan]');
						//$this->form_validation->set_rules('nik','NIK','trim|numeric');
						//$this->form_validation->set_rules('alamat','Alamat','trim');
					} else {
						$this->form_validation->set_rules('nama','Nama Pasien','required|trim|max_length[255]');
						//$this->form_validation->set_rules('ibuanak_namasuami','Kontak Pasien','trim');
						//$this->form_validation->set_rules('ibuanak_umur','Tanggal Lahir','trim');
						//$this->form_validation->set_rules('ibuanak_goldarah','Tempat Lahir','trim|alpha_numeric_spaces');
						//$this->form_validation->set_rules('nik','NIK','trim|numeric');
					}
					break;
				default:
					$message=array('status'=>FALSE,'message'=>'Input Error');
			}
			$this->form_validation->set_rules('id_rs_perujuk','Asal Rujukan','trim|required|integer');
			$this->form_validation->set_rules('id_rs_dirujuk','Tujuan Rujukan','trim|required|integer');
			$this->form_validation->set_rules('ibuanak_nobidan','Nomor perujuk','trim|required|integer');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');

			if ($_POST['pasien_type'] == 1)
			{
				$this->form_validation->set_rules('alasan_rujukan','Alasan Rujukan','trim|required');
			}
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());

				// Rujukan PASIEN COVID UMUM

				if ($this->input->post('type') == 1)
				{
					if($this->input->post('pasien_type')==='old'){
						$insert_data=$_POST;
						unset($insert_data['save']);
						unset($insert_data['pasien_type']);
					}elseif ($this->input->post('pasien_type')==='new'){
						$pasien_data=array(
							'nama'			=> $this->input->post('nama'),
							'kontak'		=> $this->input->post('kontak'),
							'tgl_lahir'		=> $this->input->post('tgl_lahir'),
							'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
							'nik'			=> $this->input->post('nik'),
							'tempat_lahir'	=> $this->input->post('tempat_lahir'),
							'alamat'		=> $this->input->post('alamat'),
							'umur'				=> '-',
							'pasangan'			=> "-",
							'goldarah'			=> "-"

						);
						$id_pasien=$this->DG_covid->insert_pasien($pasien_data);
						if(!$id_pasien)
							throw new Exception('Gagal menginput pasien');
						$insert_data=array(
							'type' => $this->input->post('type'),
							'id_icdx' => $this->input->post('icdx'),
							//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
							'id_rs_perujuk'			=> $this->input->post('id_rs_perujuk'),
							'ibuanak_nobidan' 	=> $this->input->post('ibuanak_nobidan'),
							'ibuanak_namabidan' => $this->input->post('ibuanak_namabidan'),
							'ibuanak_kodebidan' 	=> '-',
							'id_rs_dirujuk'			=> $this->input->post('id_rs_dirujuk'),
							'id_nakes'				=> $this->input->post('id_nakes'), //baru tambahan
							'id_kelas_bed' 			=> $this->input->post('id_kelas_bed'),
							'id_jenis_layanan' 		=> $this->input->post('id_jenis_layanan'),
							'id_ambulance'			=> $this->input->post('id_ambulance'),
							'transportasi'			=> $this->input->post('transportasi'),
							'alasan_rujukan' 		=> $this->input->post('alasan_rujukan'),
							'pembiayaan' 			=> $this->input->post('pembiayaan'),
							'media'					=> $this->input->post('media'),
							'diagnosis' 			=> $this->input->post('diagnosis'),
							'tindakan' 				=> $this->input->post('tindakan'),
							'no_rm' 				=> $id_pasien,
							'kesadaran'				=> $this->input->post('kesadaran'),
							'tensi'					=> $this->input->post('tensi'),
							'nadi'					=> $this->input->post('nadi'),
							'suhu'					=> $this->input->post('suhu'),
							'pernapasan'			=> $this->input->post('pernapasan'),
							'nyeri'					=> $this->input->post('nyeri'),
							'keterangan_lain'		=> $this->input->post('keterangan_lain'),
							'hasil_lab'				=> $this->input->post('hasil_lab'),
							'hasil_radiologi_ekg'	=> $this->input->post('hasil_radiologi_ekg'),
							'sms_rujukan'			=> $this->input->post('ibuanak_nobidan'),
							'wa_rujukan'			=> $this->input->post('ibuanak_nobidan'),
							//'stat_cov_matneo'		=> $this->input->post('stat_cov_matneo'),
							'trav_zona_merah'		=> $this->input->post('trav_zona_merah'),
							'demam_38'				=> $this->input->post('demam_38'),
							'batuk'					=> $this->input->post('batuk'),
							'sputum'				=> $this->input->post('ibuanak_nobidan'),
							'pilek'					=> $this->input->post('pilek'),
							'sakit_tenggorokan'		=> $this->input->post('sakit_tenggorokan'),
							'sesak_nafas'			=> $this->input->post('sesak_nafas'),
							'diabetes_melitus'		=> $this->input->post('diabetes_melitus'),
							'hipertensi'			=> $this->input->post('hipertensi'), 
							'jantung_koroner'		=> $this->input->post('jantung_koroner'),
							'paru'					=> $this->input->post('paru'),
							'hati_liver'			=> $this->input->post('hati_liver'),
							'ginjal'				=> $this->input->post('ginjal'),
							'hiv_aids'				=> $this->input->post('hiv_aids'),
							'stroke'				=> $this->input->post('stroke'),
							'comorbid_lainnya'		=> $this->input->post('comorbid_lainnya')

						);

					}else{
						throw new Exception('Input Error');
					}
				}

				// Rujukan PASIEN COVID MATERNAL-NEONATAL

				if ($this->input->post('type') == 2)
				{
					if($this->input->post('pasien_type')==='old'){
						$insert_data=$_POST;
						unset($insert_data['save']);
						unset($insert_data['pasien_type']);
						unset($insert_data['jenis_kelamin']);
					}elseif ($this->input->post('pasien_type')==='new'){
						$pasien_data=array(
							'nama' 			=> $this->input->post('nama'),
							'umur' 			=> $this->input->post('ibuanak_umur'),
							'pasangan' 		=> $this->input->post('ibuanak_namasuami'),
							'goldarah' 		=> $this->input->post('ibuanak_goldarah'),
							'jenis_kelamin'	=> "Perempuan",
							'nik' 			=> $this->input->post('nik')
						);
						$id_pasien=$this->DG_covid->insert_pasien($pasien_data);
						if(!$id_pasien)
							throw new Exception('Gagal menginput pasien');
						$insert_data=array(
							'type' => $this->input->post('type'),
							//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
							'id_icdx' 			=> $this->input->post('icdx'),
							'id_rs_perujuk'		=> $this->input->post('id_rs_perujuk'),
							'id_rs_dirujuk'		=> $this->input->post('id_rs_dirujuk'),
							'id_nakes'			=> $this->input->post('id_nakes'),
							'id_kelas_bed' 		=> $this->input->post('id_kelas_bed'),
							'id_jenis_layanan' 	=> $this->input->post('id_jenis_layanan'),
							//'ibuanak_nobidan' 	=> $this->DG_rujuk->get_hp((['ibuanak_nobidan'])),
							'ibuanak_nobidan' 	=> $this->input->post('ibuanak_nobidan'),
							'ibuanak_namabidan' => $this->input->post('ibuanak_namabidan'),
							'ibuanak_kodebidan' => $this->input->post('ibuanak_kodebidan'),
							'transportasi' 		=> $this->input->post('transportasi'),
							'diagnosis' 		=> $this->input->post('diagnosis'),
							'tindakan' 			=> $this->input->post('tindakan'),
							'no_rm' 			=> $id_pasien,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'alasan_rujukan' 	=> $this->input->post('alasan_rujukan'),
							'tindakan'			=> $this->input->post('tindakan'),
							'pembiayaan'		=> $this->input->post('pembiayaan'),
							'sms_rujukan'		=> $this->input->post('ibuanak_nobidan'),
							'wa_rujukan'		=> $this->input->post('wa_rujukan'),
							'media'				=> $this->input->post('media'),
							'stat_cov_matneo'		=> $this->input->post('stat_cov_matneo'),
							'trav_zona_merah'		=> $this->input->post('trav_zona_merah'),
							'demam_38'				=> $this->input->post('demam_38'),
							'batuk'					=> $this->input->post('batuk'),
							'sputum'				=> $this->input->post('ibuanak_nobidan'),
							'pilek'					=> $this->input->post('pilek'),
							'sakit_tenggorokan'		=> $this->input->post('sakit_tenggorokan'),
							'sesak_nafas'			=> $this->input->post('sesak_nafas')
						);
					}else{
						throw new Exception('Input Error');
					}
				}

				$insert_data=$this->upload_procedure($insert_data);
				if ($this->input->post('type') == 1) {
				if(!$this->DG_Pasien->add_rs_owner($insert_data['no_rm'],$insert_data['id_rs_dirujuk'])){
					throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang dirujuk');
				}
				}

				if(!$this->DG_covid->insert_data($insert_data)){
					throw new Exception('Input Error');
				}
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
				redirect(base_url('panel/data_rujukan'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$this->load->model('User_model');
		$ids = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['title'] 				= 'COVID';
		$data['user'] 				= $this->ion_auth->user()->row();
		$data['page_head']			= 'Rujukan Covid';
		$data['page_desc']			= 'Buat Rujukan Covid Ke RS';
		$data['pembiayaan_select']	= array();
		foreach ($this->M_Base->get_enum('pembiayaan') as $row){
			$data['pembiayaan_select'][$row]=$row;
		}
		$data['transportasi_select']	= array();
		foreach ($this->M_Base->get_enum('fungsi_mobil') as $row){
			$data['transportasi_select'][$row]=$row;
		}

		if ($this->ion_auth->in_group('covid')) $ids = TRUE;

		if($ids===TRUE) {
			$data['dirujuk']=$data['perujuk']= $this->DG_covid->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['dirujuk']=$this->DG_covid->get_rs_selection(TRUE,$ids,FALSE);
			$data['perujuk']=$this->DG_covid->get_rs_selection(FALSE,$ids,FALSE);
		}
		if(isset($message)){
			$data['message']=$message;
		}
		$data['kelas_bed_select']=$this->DG_covid->get_kelas_bed_selection();
		$data['layanan_select']=$this->DG_covid->get_layanan_selection();
		$data['ambulance']=$this->DG_covid->get_ambulance();
		$data['bidan'] = $this->DG_covid->get_bidan();
		$data['dokter'] = $this->DG_covid->get_dokter();
		$data['namabidan'] = $this->DG_covid->get_namabidan();
		$data['namadokter'] = $this->DG_covid->get_namadokter();
		$data['namabidandokter'] = $this->DG_covid->get_namabidandokter();
		$data['bidandokter'] = $this->DG_covid->get_bidandokter();
		//$data['ibuanak_nobidan'] = $this->DG_rujuk->get_hp($ibuanak_nobidan);
		//$data['ibuanak_nobidan'] = $this->DG_rujuk->maskingNumber();
		//$msisdn = maskingNumber(filter($_GET['ibuanak_nobidan']));

		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.covid.create',$data);
	}

	public function covid_edit($idCovid){

		$this->load->model('DG_covid');
		$this->load->model('DG_Pasien');
		$edit_data=$this->DG_covid->get_single_data(array('id_covid'=>$idCovid));
		if(!$edit_data)
			show_404();
		$edit_data_user=$this->DG_covid->get_single_pasien_selected(array('id_rm'=>$edit_data['no_rm']));
		if(!$edit_data_user)
			show_404();
		$this->load->model('User_model');
		if($this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$edit_data['id_rs_perujuk'])===FALSE){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Tidak memiliki izin untuk mengedit rujukan ini'));
			redirect(base_url('panel/rujukan/covid'),'refresh');
		}
		if($_POST){

			$this->form_validation->set_rules('id_rs_perujuk','Asal Rujukan','trim|required|integer');
			$this->form_validation->set_rules('id_rs_dirujuk','Tujuan Rujukan','trim|required|integer');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');
			//$this->form_validation->set_rules('alasan_rujukan','Alasan Rujukan','trim|required');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				if($this->input->post('pasien_type')==='old'){
					$new_data=$_POST;
					unset($new_data['save']);
					unset($new_data['pasien_type']);
				}elseif ($this->input->post('pasien_type')==='new'){
					$pasien_data=array(
						'nama'			=> $this->input->post('nama'),
						'kontak'		=> $this->input->post('kontak'),
						'tgl_lahir'		=> $this->input->post('tgl_lahir'),
						'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
						'nik'			=> $this->input->post('nik'),
						'tempat_lahir'	=> $this->input->post('tempat_lahir'),
						'alamat'		=> $this->input->post('alamat'),
					);
					$id_pasien=$this->DG_covid->insert_pasien($pasien_data);
					if(!$id_pasien)
						throw new Exception('Gagal menginput pasien');
					$new_data=array(
						'id_icdx' => $this->input->post('icdx'),
						//'ibuanak_icdx' => $this->input->post('ibuanak_icdx'),
						'id_rs_perujuk'			=> $this->input->post('id_rs_perujuk'),
						'ibuanak_namabidan' 	=> $this->input->post('ibuanak_namabidan'),
						'ibuanak_nobidan' 		=> $this->input->post('ibuanak_nobidan'),
						'ibuanak_kodebidan' 	=> $this->input->post('ibuanak_kodebidan'),
						'id_rs_dirujuk'			=> $this->input->post('id_rs_dirujuk'),
						'id_nakes'				=> $this->input->post('id_nakes'),
						'id_kelas_bed' 			=> $this->input->post('id_kelas_bed'),
						'id_jenis_layanan' 		=> $this->input->post('id_jenis_layanan'),
						'id_ambulance'			=> $this->input->post('id_ambulance'),
						'transportasi'			=> $this->input->post('transportasi'),
						'alasan_rujukan' 		=> $this->input->post('alasan_rujukan'),
						'pembiayaan' 			=> $this->input->post('pembiayaan'),
						'diagnosis' 			=> $this->input->post('diagnosis'),
						'no_rm' 				=> $id_pasien,
						'kesadaran'				=> $this->input->post('kesadaran'),
						'tensi'					=> $this->input->post('tensi'),
						'nadi'					=> $this->input->post('nadi'),
						'suhu'					=> $this->input->post('suhu'),
						'pernapasan'			=> $this->input->post('pernapasan'),
						'GCS'					=> $this->input->post('nyeri'),
						'keterangan_lain'		=> $this->input->post('keterangan_lain'),
						'hasil_lab'				=> $this->input->post('hasil_lab'),
						'hasil_radiologi_ekg'	=> $this->input->post('hasil_radiologi_ekg'),
						'tindakan'				=> $this->input->post('tindakan'),
						'sms_rujukan'			=> $this->input->post('wa_rujukan'),
						'wa_rujukan'			=> $this->input->post('wa_rujukan'),
						'media'					=> $this->input->post('media'),
							'stat_cov_matneo'		=> $this->input->post('stat_cov_matneo'),
							'trav_zona_merah'		=> $this->input->post('trav_zona_merah'),
							'demam_38'				=> $this->input->post('demam_38'),
							'batuk'					=> $this->input->post('batuk'),
							'sputum'				=> $this->input->post('ibuanak_nobidan'),
							'pilek'					=> $this->input->post('pilek'),
							'sakit_tenggorokan'		=> $this->input->post('sakit_tenggorokan'),
							'sesak_nafas'			=> $this->input->post('sesak_nafas'),
							'diabetes_melitus'		=> $this->input->post('diabetes_melitus'),
							'hipertensi'			=> $this->input->post('hipertensi'), 
							'jantung_koroner'		=> $this->input->post('jantung_koroner'),
							'paru'					=> $this->input->post('paru'),
							'hati_liver'			=> $this->input->post('hati_liver'),
							'ginjal'				=> $this->input->post('ginjal'),
							'hiv_aids'				=> $this->input->post('hiv_aids'),
							'stroke'				=> $this->input->post('stroke'),
							'comorbid_lainnya'		=> $this->input->post('comorbid_lainnya')	
					);
					if(!$this->DG_Pasien->add_rs_owner($id_pasien,$new_data['id_rs_perujuk'])){
						throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang merujuk');
					}
				}else{
					throw new Exception('Update Error');
				}
				$new_data=$this->upload_procedure($new_data);
				if(!$this->DG_Pasien->add_rs_owner($new_data['no_rm'],$new_data['id_rs_dirujuk'])){
					throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang dirujuk');
				}
				if(!$this->DG_covid->update_data(array('id_covid'=>$idCovid),$new_data)){
					throw new Exception('Update Error');
				}
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
				redirect(base_url('panel/data_covid'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Covid';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Covid';
		$data['page_desc']	= 'Edit Covid Ke RS Lain';

		if ($this->ion_auth->in_group('covid')) $ids = TRUE;

		if($ids===TRUE){
			$data['dirujuk']=$data['perujuk']= $this->DG_covid->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['dirujuk']=$this->DG_covid->get_rs_selection(TRUE,$ids,FALSE);
			$data['perujuk']=$this->DG_covid->get_rs_selection(FALSE,$ids,FALSE);
		}
		if(isset($message)){
			$data['message']=$message;
		}
		$data['edit_data']=$edit_data;
		$data['pasien'] = $this->DG_covid->get_pasien($edit_data['no_rm']);
		$data['selected_user_select']=$edit_data_user;
		$data['pembiayaan_select']	= array();
		foreach ($this->M_Base->get_enum('pembiayaan') as $row){
			$data['pembiayaan_select'][$row]=$row;
		}
		$data['transportasi_select']	= array();
		foreach ($this->M_Base->get_enum('fungsi_mobil') as $row){
			$data['transportasi_select'][$row]=$row;
		}
		$data['kelas_bed_select']=$this->DG_covid->get_kelas_bed_selection();
		$data['layanan_select']=$this->DG_covid->get_layanan_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.covid.edit',$data);
	}
	public function covid_delete($idCovid){
		$this->load->model('User_model');
		$this->load->model('DG_covid');
		try{
			$covid_data=$this->DG_covid->get_single_data(array('id_covid'=>$idCovid));
			if(!$covid_data)
				throw new Exception('Px COVID tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$covid_data['id_rs_perujuk']))
				throw new Exception('Tidak memiliki ijin untuk menghapus rujukan ini');
			if(!$this->DG_covid->delete_data(array('id_covid'=>$covid_data['id_covid'])))
				throw new Exception('Gagal menghapus rujukan');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Rujukan Telah dapat dihapus'));
			redirect(base_url('panel/data_covid'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/data_covid'),'refresh');
		}
	}
	public function covid_export(){
		$this->load->model('DG_covid');
		if($_POST){
			$this->DG_covid->export_excel(array(
				'id_rs'	=> $this->input->post('id_rs')===0?NULL:$this->input->post('id_rs'),
				'start'	=> $this->input->post('start'),
				'end'	=> $this->input->post('end'),
			));
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Rujukan Fasilitas Kesehatan';
		$data['user']		= $this->ion_auth->user()->row();;
		$data['page_head']	= 'Rujukan Fasilitas Kesehatan';
		$data['page_desc']	= 'Export Data Rujukan Keluar Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$this->load->model('User_model');
		$ids				= $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		if($ids===TRUE){
			$data['selection_rs']=$this->DG_covid->get_rs_selection(FALSE,array(),TRUE);
		}else{
			$data['selection_rs']=$this->DG_covid->get_rs_selection(FALSE,$ids,FALSE);
		}
		$data['selection_rs'] 	= array('0'=>'Semua')+$data['selection_rs'];
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.covid.export',$data);
	}

//--END COVID--//

	// -- PWS KIA -- //
	public function pwskia(){
		$this->load->model('User_model');
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Rujukan pwskia';
		$data['rs'] = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Rujukan PWS KIA';
		$data['page_desc']	= 'Daftar Rujukan PWS KIA';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.pwskia.list',$data);
	}

	public function pwskia_data(){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_pwskia');

		if(!$this->ion_auth->is_admin()){
			$this->load->model('User_model');
			$this->DG_pwskia->setIn('tb_desa.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_pwskia->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_pwskia->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_pwskia->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}

	public function pwskia_edit($id){

		$this->load->model('DG_pwskia');

		if($this->input->post('isian') != null){

			$isian = $this->input->post('isian');
			$bln = $this->input->post('bulan');
			$thn = $this->input->post('tahun');
			foreach($isian as $desa => $set)
			{
				$data_save = array('id_desa' => $desa,'bulan' => $bln,'tahun' => $thn);
				$data_save = array_merge_recursive($data_save,$set);
				$check = $this->DG_pwskia->checkPwskia($desa,$bln);
				if ($check->num_rows() > 0)
				{
					$this->DG_pwskia->updatePwskia($check->row()->id_pwskia,$data_save);
				} else {
					$this->DG_pwskia->savePwskia($data_save);
				}
			}

			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data PWS KIA berhasil disimpan'));
			redirect(base_url('panel/rujukan/pwskia/edit/'.$id),'refresh');

		}
		$this->load->model('User_model');
		$ids = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['bln_selected'] = ($this->input->post('bulan')?$this->input->post('bulan'):1);
		$data['thn_selected'] = ($this->input->post('tahun')?$this->input->post('tahun'):date('Y'));

		$data['title'] 		= 'Data PWS KIA';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data PWS KIA';
		$data['page_desc']	= 'Data PWS KIA';

		if(isset($message)){
			$data['message']=$message;
		}

		$getPwskia = $this->DG_pwskia->getPwskia(array('bulan' => $data['bln_selected'],'id_rs' => $id));
		$getPwskiaTarget = $this->DG_pwskia->getPwskiaTarget(array('bulan' => $data['bln_selected'],'id_rs' => $id));
		$total = array(
				'akses' => 0,
				'murni' => 0,
				'k4' => 0,
				'linakes' => 0,
				'kf3' => 0,
				'kn1' => 0,
				'kn_lgkp' => 0,
				'masy' => 0,
				'nakes' => 0,
				'bumil' => 0,
				'neo' => 0,
				'bayi11' => 0,
				'balita' => 0,
				'ditangani' => 0,
				'total_balita' => 0,
				'kb_baru' => 0);
		$total_target = array(
				'akses' => 0,
				'murni' => 0,
				'k4' => 0,
				'linakes' => 0,
				'kf3' => 0,
				'kn1' => 0,
				'kn_lgkp' => 0,
				'masy' => 0,
				'nakes' => 0,
				'bumil' => 0,
				'neo' => 0,
				'bayi11' => 0,
				'balita' => 0,
				'ditangani' => 0,
				'total_balita' => 0,
				'kb_baru' => 0);

		$parse = array(); foreach($getPwskia->result() as $g)
		{
			$parse[$g->id_desa] = array(
				'akses' => $g->akses,
				'murni' => $g->murni,
				'k4' => $g->k4,
				'linakes' => $g->linakes,
				'kf3' => $g->kf3,
				'kn1' => $g->kn1,
				'kn_lgkp' => $g->kn_lgkp,
				'masy' => $g->masy,
				'nakes' => $g->nakes,
				'bumil' => $g->bumil,
				'neo' => $g->neo,
				'bayi11' => $g->bayi11,
				'balita' => $g->balita,
				'ditangani' => $g->ditangani,
				'total_balita' => $g->total_balita,
				'kb_baru' => $g->kb_baru);

			$total['akses']+=$g->akses;
			$total['murni']+=$g->murni;
			$total['k4']+=$g->k4;
			$total['linakes']+=$g->linakes;
			$total['kf3']+=$g->kf3;
			$total['kn1']+=$g->kn1;
			$total['kn_lgkp']+=$g->kn_lgkp;
			$total['masy']+=$g->masy;
			$total['nakes']+=$g->nakes;
			$total['bumil']+=$g->bumil;
			$total['neo']+=$g->neo;
			$total['bayi11']+=$g->bayi11;
			$total['balita']+=$g->balita;
			$total['ditangani']+=$g->ditangani;
			$total['total_balita']+=$g->total_balita;
			$total['kb_baru']+=$g->kb_baru;
		}

		$parse_target = array(); foreach($getPwskiaTarget->result() as $g)
		{
			$parse_target[$g->id_desa] = array(
				'akses' => $g->akses,
				'murni' => $g->murni,
				'k4' => $g->k4,
				'linakes' => $g->linakes,
				'kf3' => $g->kf3,
				'kn1' => $g->kn1,
				'kn_lgkp' => $g->kn_lgkp,
				'masy' => $g->masy,
				'nakes' => $g->nakes,
				'bumil' => $g->bumil,
				'neo' => $g->neo,
				'bayi11' => $g->bayi11,
				'balita' => $g->balita,
				'ditangani' => $g->ditangani,
				'total_balita' => $g->total_balita,
				'kb_baru' => $g->kb_baru);

			$total_target['akses']+=$g->akses;
			$total_target['murni']+=$g->murni;
			$total_target['k4']+=$g->k4;
			$total_target['linakes']+=$g->linakes;
			$total_target['kf3']+=$g->kf3;
			$total_target['kn1']+=$g->kn1;
			$total_target['kn_lgkp']+=$g->kn_lgkp;
			$total_target['masy']+=$g->masy;
			$total_target['nakes']+=$g->nakes;
			$total_target['bumil']+=$g->bumil;
			$total_target['neo']+=$g->neo;
			$total_target['bayi11']+=$g->bayi11;
			$total_target['balita']+=$g->balita;
			$total_target['ditangani']+=$g->ditangani;
			$total_target['total_balita']+=$g->total_balita;
			$total_target['kb_baru']+=$g->kb_baru;
		}

		$data['parse'] = $parse;
		$data['parse_target'] = $parse_target;

		$data['cb_bulan'] = $this->bulan;
		$tahun = array(); for($i = date('Y')-2; $i < date('Y')+3; $i++)
		{
			$tahun[] = $i;
		}

		$data['cb_tahun'] = $tahun;
		$data['total'] = $total;
		$data['desa'] = $this->DG_pwskia->getDesa($id);
		$data['rs'] = $this->DG_pwskia->getRs($id)->row();

		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.pwskia.create',$data);


	}

	public function pwskia_target($id){

		$this->load->model('DG_pwskia');

		if($this->input->post('isian') != null){

			$isian = $this->input->post('isian');
			$bln = $this->input->post('bulan');
			$thn = $this->input->post('tahun');
			foreach($isian as $desa => $set)
			{
				$data_save = array('id_desa' => $desa,'bulan' => $bln,'tahun' => $thn);
				$data_save = array_merge_recursive($data_save,$set);
				$check = $this->DG_pwskia->checkPwskiaTarget($desa,$bln);
				if ($check->num_rows() > 0)
				{
					$this->DG_pwskia->updatePwskiaTarget($check->row()->id_pwskia_target,$data_save);
				} else {
					$this->DG_pwskia->savePwskiaTarget($data_save);
				}
			}

			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Target PWS KIA berhasil disimpan'));
			redirect(base_url('panel/rujukan/pwskia/target/'.$id),'refresh');

		}
		$this->load->model('User_model');
		$ids = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$data=$this->M_Base->get_config();
		$data['bln_selected'] = ($this->input->post('bulan')?$this->input->post('bulan'):1);
		$data['thn_selected'] = ($this->input->post('tahun')?$this->input->post('tahun'):date('Y'));

		$data['title'] 		= 'Data Target PWS KIA';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data Target PWS KIA';
		$data['page_desc']	= 'Data Target PWS KIA';

		if(isset($message)){
			$data['message']=$message;
		}

		$getPwskia = $this->DG_pwskia->getPwskiaTarget(array('bulan' => $data['bln_selected'],'id_rs' => $id));
		$total = array(
				'akses' => 0,
				'murni' => 0,
				'k4' => 0,
				'linakes' => 0,
				'kf3' => 0,
				'kn1' => 0,
				'kn_lgkp' => 0,
				'masy' => 0,
				'nakes' => 0,
				'bumil' => 0,
				'neo' => 0,
				'bayi11' => 0,
				'balita' => 0,
				'ditangani' => 0,
				'total_balita' => 0,
				'kb_baru' => 0);

		$parse = array(); foreach($getPwskia->result() as $g)
		{
			$parse[$g->id_desa] = array(
				'akses' => $g->akses,
				'murni' => $g->murni,
				'k4' => $g->k4,
				'linakes' => $g->linakes,
				'kf3' => $g->kf3,
				'kn1' => $g->kn1,
				'kn_lgkp' => $g->kn_lgkp,
				'masy' => $g->masy,
				'nakes' => $g->nakes,
				'bumil' => $g->bumil,
				'neo' => $g->neo,
				'bayi11' => $g->bayi11,
				'balita' => $g->balita,
				'ditangani' => $g->ditangani,
				'total_balita' => $g->total_balita,
				'kb_baru' => $g->kb_baru);

			$total['akses']+=$g->akses;
			$total['murni']+=$g->murni;
			$total['k4']+=$g->k4;
			$total['linakes']+=$g->linakes;
			$total['kf3']+=$g->kf3;
			$total['kn1']+=$g->kn1;
			$total['kn_lgkp']+=$g->kn_lgkp;
			$total['masy']+=$g->masy;
			$total['nakes']+=$g->nakes;
			$total['bumil']+=$g->bumil;
			$total['neo']+=$g->neo;
			$total['bayi11']+=$g->bayi11;
			$total['balita']+=$g->balita;
			$total['ditangani']+=$g->ditangani;
			$total['total_balita']+=$g->total_balita;
			$total['kb_baru']+=$g->kb_baru;
		}

		$data['parse'] = $parse;
		$data['cb_bulan'] = $this->bulan;
		$tahun = array(); for($i = date('Y')-2; $i < date('Y')+3; $i++)
		{
			$tahun[] = $i;
		}

		$data['cb_tahun'] = $tahun;
		$data['total'] = $total;
		$data['desa'] = $this->DG_pwskia->getDesa($id);
		$data['rs'] = $this->DG_pwskia->getRs($id)->row();

		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.pwskia.target',$data);
	}
	public function pwskia_delete($id){
		$this->load->model('User_model');
		$this->load->model('DG_pwskia');
		try{
			$pwskia_data=$this->DG_pwskia->get_single_data(array('id_pwskia'=>$id));
			if(!$pwskia_data)
				throw new Exception('Rujukan pwskia tidak ditemukan');
			if(!$this->DG_pwskia->delete_data(array('id_pwskia'=>$pwskia_data['id_pwskia'])))
				throw new Exception('Gagal menghapus rujukan');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Rujukan pwskia telah dihapus'));
			redirect(base_url('panel/rujukan/pwskia'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rujukan/pwskia'),'refresh');
		}
	}



	public function validNumber($ibuanak_nobidan)
	{
		if (ereg ('^\+[0-9]+$',$ibuanak_nobidan)) {
			return true;
		} else {
			return false;
		}
	}

	/**
		 * mask MSISDN kedalam format +628XXXXXXXXX
		 * @param ibuanak_nobidan user mobile phone number
		 * @return mobile number phone number with international number
		 */

	public function maskingNumber($ibuanak_nobidan)
	{
		$temp=$ibuanak_nobidan;
		if($temp!=''){
			if((substr($ibuanak_nobidan,0,1)=="0")&&(substr($ibuanak_nobidan,0,5)!="00162")){
				$temp="62".substr($temp,1);
			}
			if(substr($ibuanak_nobidan,0,2)=="62"){
				$temp="".$temp;
			}
			if(substr($ibuanak_nobidan,0,1)=="8"){
				$temp="62".$temp;
			}
			if(substr($ibuanak_nobidan,0,1)=="+"){
				$temp="62".substr($temp,1);
			}
			if(substr($ibuanak_nobidan,0,5)=="00162"){
				$temp="62".substr($temp,5);
			}
		}else{
			$temp="";
		}
		return $temp;
	}

 	public  function hp($ibuanak_nobidan)  {

        $ibuanak_nobidan = $this->db->get('tb_rujukan');
        //  bila  penulisan  no  hp  0812  339  545

        $ibuanak_nobidan  =  str_replace("  ","",$ibuanak_nobidan);

        //  bila  penulisan  no  hp  (0274)  778787

        $ibuanak_nobidan  =  str_replace("(","",$ibuanak_nobidan);

        //  bila  penulisan  no  hp  (0274)  778787

        $ibuanak_nobidan  =  str_replace(")","",$ibuanak_nobidan);

        //  bila  penulisan  no  hp  0811.239.345

        $ibuanak_nobidan  =  str_replace(".","",$ibuanak_nobidan);


        //  bila  no  hp  terdapat  karakter  +  dan  0-9

        if(!preg_match('/[^+0-9]/',trim($ibuanak_nobidan))){

                //  cek  karakter  1-3  apakah  +62

                if(substr(trim($ibuanak_nobidan),  0,  3)=='62'){

                        $hp  =  trim($ibuanak_nobidan);

                }

                //  cek  karakter  1  apakah  0

                elseif(substr(trim($ibuanak_nobidan),  0,  1)=='0'){

                        $hp  =  '62'.substr(trim($ibuanak_nobidan),  1);

                }

        }

        print  $hp;

		}

}
