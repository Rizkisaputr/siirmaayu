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
 * @property DG_RumahSakit $DG_RumahSakit
 * @property DG_Bed $DG_Bed
 * @property DG_Dokter $DG_Dokter
 * @property DG_Faskes $DG_Faskes
 * @property User_model $User_model
 * @property Model_Rumah_Sakit $Model_Rumah_Sakit
 * @property DG_Layanan $DG_Layanan
 * @property DG_Jadwal_Dokter $DG_Jadwal_Dokter
 */

class Rumah_sakit extends MX_Controller
{
	protected $user_data;
	public function __construct()
	{
		parent::__construct();
		$this->user_data=$this->M_Base->cek_auth();
		$this->load->helper('datagrid');
		date_default_timezone_set('Asia/jakarta');
	}
	function _remap($function){
		$is_admin=$this->ion_auth->is_admin();
		switch ($function){
			case 'index':
				redirect(base_url('panel/rumah_sakit/rs'),'refresh');
				break;
			case 'rs':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'rs'),
					'data'		=> array($this,'rs_data',$is_admin),
					'add'		=> array($this,'rs_add'),
					'edit'		=> array($this,'rs_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'rs_delete',$this->uri->segment(5)),
					'import'	=> array($this,'rs_import'),
					'template'	=> array($this,'rs_template')
				));
				break;
			case 'bed':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'bed'),
					'data'		=> array($this,'bed_data',$is_admin),
					'add'		=> array($this,'bed_add'),
					'edit'		=> array($this,'bed_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'bed_delete',$this->uri->segment(5)),
					'import'	=> array($this,'bed_import'),
					'template'	=> array($this,'bed_template'),
//					'export'	=> array($this,'bed_export')
				));
				break;
			case 'faskes':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'faskes'),
					'data'		=> array($this,'faskes_data',$is_admin),
					'add'		=> array($this,'faskes_add'),
					'edit'		=> array($this,'faskes_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'faskes_delete',$this->uri->segment(5)),
					'import'	=> array($this,'faskes_import'),
					'template'	=> array($this,'faskes_template')
				));
				break;
			case 'dokter':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'dokter'),
					'data'		=> array($this,'dokter_data',$is_admin),
					'add'		=> array($this,'dokter_add'),
					'edit'		=> array($this,'dokter_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'dokter_delete',$this->uri->segment(5)),
					'import'	=> array($this,'dokter_import'),
					'template'	=> array($this,'dokter_template')
				));
				break;
			case 'jadwal_dokter':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'jadwal_dokter'),
					'data'		=> array($this,'jadwal_dokter_data',$is_admin),
					'add'		=> array($this,'jadwal_dokter_add'),
					'edit'		=> array($this,'jadwal_dokter_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'jadwal_dokter_delete',$this->uri->segment(5))
				));
				break;
			case 'ambulance':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'ambulance'),
					'data'		=> array($this,'ambulance_data',$is_admin),
					'add'		=> array($this,'ambulance_add'),
					'edit'		=> array($this,'ambulance_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'ambulance_delete',$this->uri->segment(5))
				));
				break;
			case 'nakes':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'nakes'),
					'data'		=> array($this,'nakes_data',$is_admin),
					'add'		=> array($this,'nakes_add'),
					'edit'		=> array($this,'nakes_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'nakes_delete',$this->uri->segment(5))
				));
				break;
			case 'stok_darah':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'stok_darah'),
					'data'		=> array($this,'stok_darah_data',$is_admin),
					'add'		=> array($this,'stok_darah_add'),
					'edit'		=> array($this,'stok_darah_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'stok_darah_delete',$this->uri->segment(5))
				));
				break;
			default:
				show_404();
		}
	}
	public function index(){
		echo 'forbidden';
		exit();
	}
	/*============================================================
	 * /RS
	 *============================================================
	 */
	public function rs(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Fasilitas Kesehatan';
		$data['page_desc']	= 'List Data Fasilitas Kesehatan';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rs.list',$data);
	}
	public function rs_data($is_admin=true){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_RumahSakit');

		if(!$is_admin  and !$this->ion_auth->in_group('psc')) {
			$this->load->model('User_model');
			$this->DG_RumahSakit->setIn('id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_RumahSakit->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_RumahSakit->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_RumahSakit->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function rs_add(){
		$this->load->model('DG_RumahSakit');
		if($_POST){
			$this->form_validation->set_rules('nama','Nama Fasilitas Kesehatan','trim|required');
			$this->form_validation->set_rules('kode_rs','Kode Fasilitas Kesehatan','trim');
			$this->form_validation->set_rules('telepon','Telepon','trim|required|numeric');
			$this->form_validation->set_rules('alamat','Alamat','required');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}else{
				$layanan=NULL;
				if(isset($_POST['layanan'])){
					$layanan=$_POST['layanan'];
					unset($_POST['layanan']);
				}
				unset($_POST['save']);
				if($this->DG_RumahSakit->insert_data($_POST,$layanan)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Sudah Terinput'));
					redirect(base_url('panel/rumah_sakit/rs'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Menambahkan Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Fasilitas Kesehatan';
		$data['page_desc']	= 'Tambah Data Fasilitas Kesehatan';
		$data['selection_fasilitas'] = $this->DG_RumahSakit->get_selection_fasilitas();
		$data['jenis_rs']	= transform_to_selection('value','value',$this->M_Base->get_enum('jenis_rs',TRUE));
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rs.create',$data);
	}
	public function rs_edit($id_rs){
		if($_POST){
			$this->form_validation->set_rules('nama','Nama Fasilitas Kesehatan','trim|required');
			$this->form_validation->set_rules('kode_rs','Kode Fasilitas Kesehatan','trim');
			$this->form_validation->set_rules('telepon','Telepon','trim|required|numeric');
			$this->form_validation->set_rules('alamat','Alamat','required');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}else{
				$this->load->model('DG_RumahSakit');
				$layanan=NULL;
				if(isset($_POST['layanan'])){
					$layanan=$_POST['layanan'];
					unset($_POST['layanan']);
				}
				unset($_POST['save']);
				$this->db->set('tgl_update','NOW()',FALSE);
				if($this->DG_RumahSakit->update_data(array('id_rs'=>$id_rs),$_POST,$layanan)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Berhasil Diedit'));
					redirect(base_url('panel/rumah_sakit/rs'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Mengedit Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Fasilitas Kesehatan';
		$data['page_desc']	= 'Edit Data Fasilitas Kesehatan';
		$this->load->model('DG_RumahSakit');
		$data['edit_data']	= $this->DG_RumahSakit->get_single_data(array('id_rs'=>$id_rs));
		$data['selection_fasilitas'] = $this->DG_RumahSakit->get_selection_fasilitas();
		$data['jenis_rs']	= transform_to_selection('value','value',$this->M_Base->get_enum('jenis_rs',TRUE));
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rs.edit',$data);
	}
	public function rs_delete($id_rs){
		if($this->ion_auth->is_admin()){
			$this->load->model('DG_RumahSakit');
			if($this->DG_RumahSakit->delete_data(array('id_rs'=>$id_rs))){
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Terhapus'));
				redirect(base_url('panel/rumah_sakit/rs'),'refresh');
			}else{
				$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Gagal menghapus data'));
				redirect(base_url('panel/rumah_sakit/rs'),'refresh');
			}
		}else{
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak dapat menghapus rumah sakit'));
			redirect(base_url('panel/rumah_sakit/rs'),'refresh');
		}
	}
	public function rs_import(){
		if(!$this->ion_auth->is_admin())
			show_404();
		if($_POST){
			$this->load->model('DG_RumahSakit');
			$message=$this->DG_RumahSakit->import_excel('file');
			if($message['status']){
				$this->session->set_flashdata('message',$message);
				redirect(base_url('panel/rumah_sakit/rs'),'refresh');
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Fasilitas Kesehatan';
		$data['page_desc']	= 'Import Data Fasilitas Kesehatan';
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.rs.import',$data);
	}
	public function rs_template(){
		if(!$this->ion_auth->is_admin())
			show_404();
		$this->load->model('DG_RumahSakit');
		$this->DG_RumahSakit->make_template();
	}
	/*============================================================
	 * /BED
	 *============================================================
	 */
	public function bed(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Bed';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Bed';
		$data['page_desc']	= 'List Data Bed Fasilitas Kesehatan';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.bed.list',$data);
	}
	public function bed_data($is_admin,$jenis=FALSE){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Bed');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Bed->setIn('tb_bed.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}
		if($jenis!=FALSE){
			$this->DG_Bed->setWhere('tb_rs.jenis',$jenis);
		}

		$data=$this->DG_Bed->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Bed->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Bed->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function bed_add(){
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('nama','Nama Bed','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('kapasitas_l','Kapasitas Laki-laki','required|trim|is_natural');
			$this->form_validation->set_rules('kapasitas_p','Kapasitas Perempuan','required|trim|is_natural');
			$this->form_validation->set_rules('terpakai_l','Terpakai Laki-laki','required|trim|is_natural|less_than_equal_to['.$this->input->post('kapasitas_l').']',array('less_than_equal_to'=>'Terpakai harus lebih kecil dari kapasitas'));
			$this->form_validation->set_rules('terpakai_p','Terpakai Perempuan','required|trim|is_natural|less_than_equal_to['.$this->input->post('kapasitas_p').']',array('less_than_equal_to'=>'Terpakai harus lebih kecil dari kapasitas'));
			$this->form_validation->set_rules('kelas','Kelas Bed','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan bed di rumah sakit ini');
				$this->load->model('DG_Bed');
				unset($_POST['save']);
				if(!$this->DG_Bed->insert_data($_POST))
					throw new Exception('Gagal menambahkan data bed');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Bed telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/bed'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 			= 'Data Bed';
		$data['user']	 		= $this->user_data;
		$data['page_head']		= 'Data Bed';
		$data['page_desc']		= 'Tambah Data Bed Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] 	= $this->Model_Rumah_Sakit->get_rs_selection();
		$data['list_kelas']		= $this->Model_Rumah_Sakit->get_kelas_bed();
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.bed.create',$data);
	}
	public function bed_edit($id_bed){
		$this->load->model('DG_Bed');
		$data_bed=$this->DG_Bed->get_single_data(array('id_bed'=>$id_bed));
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('nama','Nama Bed','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('kapasitas_l','Kapasitas Laki-laki','required|trim|is_natural');
			$this->form_validation->set_rules('kapasitas_p','Kapasitas Perempuan','required|trim|is_natural');
			$this->form_validation->set_rules('terpakai_l','Terpakai Laki-laki','required|trim|is_natural|less_than_equal_to['.$this->input->post('kapasitas_l').']',array('less_than_equal_to'=>'Terpakai harus lebih kecil dari kapasitas'));
			$this->form_validation->set_rules('terpakai_p','Terpakai Perempuan','required|trim|is_natural|less_than_equal_to['.$this->input->post('kapasitas_p').']',array('less_than_equal_to'=>'Terpakai harus lebih kecil dari kapasitas'));
			$this->form_validation->set_rules('kelas','Kelas Bed','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$data_bed['id_rs']))
				{
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak bisa mengedit bed ini'));
					redirect(base_url('panel/rumah_sakit/bed'),'refresh');
				}
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan bed di rumah sakit ini');
				unset($_POST['save']);
				$this->db->set('tgl_update','NOW()',FALSE);
				if(!$this->DG_Bed->update_data(array('id_bed'=>$id_bed),$_POST))
					throw new Exception('Gagal mengedit data bed');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Bed telah berhasil diedit'));
				redirect(base_url('panel/rumah_sakit/bed'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Bed';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Bed';
		$data['page_desc']	= 'Edit Data Bed Fasilitas Kesehatan';
		$data['edit_data']	= $data_bed;
		if(isset($message))
			$data['message']=$message;
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data['list_kelas']		= $this->Model_Rumah_Sakit->get_kelas_bed();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.bed.edit',$data);
	}
	public function bed_delete($id_bed){
		$this->load->model('User_model');
		$this->load->model('DG_Bed');
		try{
			$bed_data=$this->DG_Bed->get_single_data(array('id_bed'=>$id_bed));
			if(!$bed_data)
				throw new Exception('Bed tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$bed_data['id_rs']))
				throw new Exception('Tidak memiliki ijin untuk menghapus bed ini');
			if(!$this->DG_Bed->delete_data(array('id_bed'=>$id_bed)))
				throw new Exception('Gagal menghapus bed');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Bed Telah dihapus'));
			redirect(base_url('panel/rumah_sakit/bed'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/bed'),'refresh');
		}
	}
	public function bed_import(){
		if($_POST){
			$this->load->model('DG_Bed');
			$this->DG_Bed->id_rs=$_POST['id_rs'];
			$this->DG_Bed->delete_data(array('id_rs'=>$_POST['id_rs']));
			$message=$this->DG_Bed->import_excel('file');
			if($message['status']){
				$this->session->set_flashdata('message',$message);
				redirect(base_url('panel/rumah_sakit/bed'),'refresh');
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Bed Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Bed Fasilitas Kesehatan';
		$data['page_desc']	= 'Import Data Bed Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] 	= $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.bed.import',$data);
	}
	public function bed_template(){
		$this->load->model('DG_Bed');
		$this->DG_Bed->make_template();
	}
	public function bed_export(){
		$this->load->model('DG_Bed');
		if($_POST){
			if($_POST['id_rs']==='0'){
				unset($_POST['id_rs']);
			}
			if($_POST['kelas']==='0'){
				unset($_POST['kelas']);
			}
			$export_arg=array(
				'id_rs'=>$this->input->post('id_rs'),
				'kelas'=>$this->input->post('kelas')
			);
			$this->DG_Bed->export_excel($export_arg);
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Bed Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Bed Fasilitas Kesehatan';
		$data['page_desc']	= 'Export Data Bed Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] 	= array('0'=>'Semua')+$this->Model_Rumah_Sakit->get_rs_selection();
		$data['list_kelas']		= array('0'=>'Semua')+$this->Model_Rumah_Sakit->get_kelas_bed_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.bed.export',$data);
	}

	/*============================================================
	 * /faskes
	 *============================================================
	 */
	public function faskes(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Alat Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Alat Kesehatan';
		$data['page_desc']	= 'List Data Alat Kesehatan Fasilitas Kesehatan';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.faskes.list',$data);
	}
	public function faskes_data($is_admin){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Faskes');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Faskes->setIn('tb_faskes.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}
		
		$data=$this->DG_Faskes->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Faskes->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Faskes->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function faskes_add(){
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('nama_faskes','Nama Fasilitas','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('jumlah','Jumlah Fasilitas','required|trim|is_natural');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan fasilitas di rumah sakit ini');
				$this->load->model('DG_Faskes');
				unset($_POST['save']);
				if(!$this->DG_Faskes->insert_data($_POST))
					throw new Exception('Gagal menambahkan Fasilitas');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Fasilitas telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/faskes'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Alat Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Alat Kesehatan';
		$data['page_desc']	= 'Tambah Data Alat Kesehatan Fasilitas Kesehatan';
		if(isset($message))
			$data['message']=$message;
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.faskes.create',$data);
	}
	public function faskes_edit($id_fk){
		$this->load->model('DG_Faskes');
		$data_faskes = $this->DG_Faskes->get_single_data(array('id_faskes'=>$id_fk));
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('nama_faskes','Nama Fasilitas','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('jumlah','Jumlah Fasilitas','required|trim|is_natural');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$data_faskes['id_rs'])){
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak dapat mengedit fasilitas Fasilitas Kesehatan ini'));
					redirect(base_url('panel/rumah_sakit/faskes'),'refresh');
				}
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan fasilitas di rumah sakit ini');
				unset($_POST['save']);
				$this->db->set('tgl_update','NOW()',FALSE);
				if(!$this->DG_Faskes->update_data(array('id_faskes'=>$id_fk),$_POST))
					throw new Exception('Gagal mengedit fasilitas');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Fasilitas telah diedit'));
				redirect(base_url('panel/rumah_sakit/faskes'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Alat Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Alat Kesehatan';
		$data['page_desc']	= 'Edit Data Alat Kesehatan Fasilitas Kesehatan';
		$data['edit_data']	= $data_faskes;
		if(isset($message))
			$data['message']=$message;
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.faskes.edit',$data);
	}
	public function faskes_delete($id_fk){
		$this->load->model('User_model');
		$this->load->model('DG_Faskes');
		try{
			$fk_data=$this->DG_Faskes->get_single_data(array('id_faskes'=>$id_fk));
			if(!$fk_data)
				throw new Exception('Faskes tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$fk_data['id_rs']))
				throw new Exception('Tidak memiliki ijin untuk menghapus faskes ini');
			if(!$this->DG_Faskes->delete_data(array('id_faskes'=>$id_fk)))
				throw new Exception('Gagal menghapus Faskes');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Faskes sudah dihapus'));
			redirect(base_url('panel/rumah_sakit/faskes'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/faskes'),'refresh');
		}
	}
	public function faskes_import(){
		if($_POST){
			$this->load->model('DG_Faskes');
			$this->DG_Faskes->id_rs=$_POST['id_rs'];
			$message=$this->DG_Faskes->import_excel('file');
			if($message['status']){
				$this->session->set_flashdata('message',$message);
				redirect(base_url('panel/rumah_sakit/faskes'),'refresh');
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Alat Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Alat Kesehatan';
		$data['page_desc']	= 'Import Data Alat Kesehatan Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] 	= $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.faskes.import',$data);
	}
	public function faskes_template(){
		$this->load->model('DG_Faskes');
		$this->DG_Faskes->make_template();
	}
	/*============================================================
	 * /dokter
	 *============================================================
	 */
	public function dokter(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Dokter';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Dokter';
		$data['page_desc']	= 'List Data Dokter Fasilitas Kesehatan';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.dokter.list',$data);
	}
	public function dokter_data($is_admin){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Dokter');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Dokter->setIn('tb_dokter.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_Dokter->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Dokter->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Dokter->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function dokter_add(){
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			//$this->form_validation->set_rules('nama','Nama Dokter','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('nama','Nama Dokter','required|trim|max_length[255]');
			$this->form_validation->set_rules('no_idi','No Idi','trim');
			$this->form_validation->set_rules('bidang','Bidang','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan dokter di rumah sakit ini');
				$this->load->model('DG_Dokter');
				unset($_POST['save']);
				if(!$this->DG_Dokter->insert_data($_POST))
					throw new Exception('Gagal menambahkan Dokter');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Dokter telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Dokter';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Dokter';
		$data['page_desc']	= 'Tambah Data Dokter Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.dokter.create',$data);
	}
	public function dokter_edit($id_dokter){
		$this->load->model('DG_Dokter');
		$data_dokter = $this->DG_Dokter->get_single_data(array('id_dokter'=>$id_dokter));
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			//$this->form_validation->set_rules('nama','Nama Dokter','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('nama','Nama Dokter','required|trim|max_length[255]');
			$this->form_validation->set_rules('no_idi','No Idi','trim');
			$this->form_validation->set_rules('bidang','Bidang','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$data_dokter['id_rs'])){
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak dapat mengedit dokter Fasilitas Kesehatan ini'));
					redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
				}
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan dokter di rumah sakit ini');
				unset($_POST['save']);
				$this->db->set('tgl_update','NOW()',FALSE);
				if(!$this->DG_Dokter->update_data(array('id_dokter'=>$id_dokter),$_POST))
					throw new Exception('Gagal mengedit dokter');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Dokter telah diedit'));
				redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Dokter';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Dokter';
		$data['page_desc']	= 'Edit Data Dokter Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data['edit_data']	= $data_dokter;
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.dokter.edit',$data);
}
	public function dokter_delete($id_dokter){
		$this->load->model('User_model');
		$this->load->model('DG_Dokter');
		try{
			$dokter_data=$this->DG_Dokter->get_single_data(array('id_dokter'=>$id_dokter));
			if(!$dokter_data)
				throw new Exception('Dokter tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$dokter_data['id_rs']))
				throw new Exception('Tidak memiliki ijin untuk menghapus dokter ini');
			if(!$this->DG_Dokter->delete_data(array('id_dokter'=>$id_dokter)))
				throw new Exception('Gagal menghapus dokter');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Dokter sudah dihapus'));
			redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
		}
	}
	public function dokter_import(){
		if($_POST){
			$this->load->model('DG_Dokter');
			$this->DG_Dokter->id_rs=$_POST['id_rs'];
			$message=$this->DG_Dokter->import_excel('file');
			if($message['status']){
				$this->session->set_flashdata('message',$message);
				redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Dokter Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Dokter Fasilitas Kesehatan';
		$data['page_desc']	= 'Import Data Dokter Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] 	= $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.faskes.import',$data);
	}
	public function dokter_template(){
		$this->load->model('DG_Dokter');
		$this->DG_Dokter->make_template();
	}
	/*===========================================================
	 * Jadwal dokter
	 *===========================================================
	 */
	public function jadwal_dokter(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Jadwal Dokter';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Jadwal Dokter';
		$data['page_desc']	= 'List Data Jadwal Dokter Fasilitas Kesehatan';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jadwal_dokter.list',$data);
	}
	public function jadwal_dokter_data($is_admin){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Jadwal_Dokter');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Jadwal_Dokter->setIn('tb_dokter.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_Jadwal_Dokter->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Jadwal_Dokter->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Jadwal_Dokter->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function jadwal_dokter_add(){
		$this->load->model('DG_Jadwal_Dokter');
		if($_POST){
			$this->form_validation->set_rules('id_dokter','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('hari','Hari','required|trim');
			$this->form_validation->set_rules('jam_mulai','Jam Mulai','required|trim');
			$this->form_validation->set_rules('jam_selesai','Jam Selesai','required|trim');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$this->DG_Jadwal_Dokter->get_dokter_rs($_POST['id_dokter'])))
					throw new Exception('Anda tidak dapat menambahkan jadwal dokter rumah sakit ini');
				unset($_POST['save']);
				if(!$this->DG_Jadwal_Dokter->insert_data($_POST))
					throw new Exception('Gagal menambahkan jadwal Dokter');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Jadwal Dokter telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/jadwal_dokter'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 			= 'Data Jadwal Dokter';
		$data['user'] 			= $this->user_data;
		$data['page_head']		= 'Data Jadwal Dokter';
		$data['page_desc']		= 'Tambah Data Jadwal Dokter Fasilitas Kesehatan';
		$data['selection_hari']	= array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
		$this->load->model('Model_Rumah_Sakit');
		$this->load->model('User_model');
		$data['selection_dokter'] = $this->DG_Jadwal_Dokter->get_dokter_selection($this->ion_auth->is_admin(),$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jadwal_dokter.create',$data);
	}
	public function jadwal_dokter_edit($id_jadwal){
		$this->load->model('DG_Jadwal_Dokter');
		$edit_data=$this->DG_Jadwal_Dokter->get_single_data(array('id_jadwal_dokter'=>$id_jadwal));
		if(!$edit_data)
			show_404();
		if($edit_data){

		}
		if($_POST){
			$this->form_validation->set_rules('id_dokter','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('hari','Hari','required|trim');
			$this->form_validation->set_rules('jam_mulai','Jam Mulai','required|trim');
			$this->form_validation->set_rules('jam_selesai','Jam Selesai','required|trim');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$this->DG_Jadwal_Dokter->get_dokter_rs($_POST['id_dokter'])))
					throw new Exception('Anda tidak dapat menambahkan jadwal dokter rumah sakit ini');
				unset($_POST['save']);
				$_POST['tgl_update']=date('Y-m-d H:i:s');
				if(!$this->DG_Jadwal_Dokter->update_data(array('id_jadwal_dokter'=>$id_jadwal),$_POST))
					throw new Exception('Gagal mengedit jadwal Dokter');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Jadwal Dokter telah diedit'));
				redirect(base_url('panel/rumah_sakit/jadwal_dokter'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Jadwal Dokter';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Jadwal Dokter';
		$data['page_desc']	= 'Edit Data Jadwal Dokter Fasilitas Kesehatan';
		$data['edit_data']	= $edit_data;
		$this->load->model('Model_Rumah_Sakit');
		$this->load->model('User_model');
		$data['selection_hari']	= array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
		$data['selection_dokter'] = $this->DG_Jadwal_Dokter->get_dokter_selection($this->ion_auth->is_admin(),$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jadwal_dokter.edit',$data);
	}
	public function jadwal_dokter_delete($id_dokter){
		$this->load->model('User_model');
		$this->load->model('DG_Jadwal_Dokter');
		try{
			$dokter_data=$this->DG_Jadwal_Dokter->get_single_data(array('id_jadwal_dokter'=>$id_dokter));
			if(!$dokter_data)
				throw new Exception('Jadwal tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$this->DG_Jadwal_Dokter->get_dokter_rs($dokter_data['id_dokter'])))
				throw new Exception('Tidak memiliki ijin untuk menghapus Jadwal dokter ini');
			if(!$this->DG_Jadwal_Dokter->delete_data(array('id_jadwal_dokter'=>$id_dokter)))
				throw new Exception('Gagal menghapus dokter');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Jadwal Dokter sudah dihapus'));
			redirect(base_url('panel/rumah_sakit/jadwal_dokter'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/jadwal_dokter'),'refresh');
		}
	}
	public function jadwal_dokter_import(){
		if($_POST){
			$this->load->model('DG_Jadwal_Dokter');
			$this->DG_Jadwal_Dokter->id_rs=$_POST['id_rs'];
			$message=$this->DG_Jadwal_Dokter->import_excel('file');
			if($message['status']){
				$this->session->set_flashdata('message',$message);
				redirect(base_url('panel/rumah_sakit/jadwal_dokter'),'refresh');
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Dokter Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Dokter Fasilitas Kesehatan';
		$data['page_desc']	= 'Import Data Dokter Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] 	= $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.faskes.import',$data);
	}
	public function jadwal_dokter_template(){
		$this->load->model('DG_Jadwal_Dokter');
		$this->DG_Jadwal_Dokter->make_template();
	}
	/*
	 * ===========================================================
	 * Layanan NOPE
	 * ===========================================================
	 */
	public function layanan(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Layanan Fasilitas Kesehatan';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Layanan Fasilitas Kesehatan';
		$data['page_desc']	= 'List Data Data Layanan Fasilitas Kesehatan';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.layanan_rs.list',$data);
	}
	public function layanan_data($is_admin){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Dokter');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Dokter->setIn('tb_dokter.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_Dokter->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Dokter->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Dokter->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function layanan_add(){
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('nama','Nama Dokter','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('no_idi','No Idi','trim');
			$this->form_validation->set_rules('bidang','Bidang','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan dokter di rumah sakit ini');
				$this->load->model('DG_Dokter');
				unset($_POST['save']);
				if(!$this->DG_Dokter->insert_data($_POST))
					throw new Exception('Gagal menambahkan Dokter');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Dokter telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Dokter';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Dokter';
		$data['page_desc']	= 'Tambah Data Dokter Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.dokter.create',$data);
	}

	public function layanan_edit($id_dokter){
		$this->load->model('DG_Dokter');
		$data_dokter = $this->DG_Dokter->get_single_data(array('id_dokter'=>$id_dokter));
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('nama','Nama Dokter','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('no_idi','No Idi','trim');
			$this->form_validation->set_rules('bidang','Bidang','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$data_dokter['id_rs'])){
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak dapat mengedit dokter Fasilitas Kesehatan ini'));
					redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
				}
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan dokter di rumah sakit ini');
				unset($_POST['save']);
				$this->db->set('tgl_update','NOW()',FALSE);
				if(!$this->DG_Dokter->update_data(array('id_dokter'=>$id_dokter),$_POST))
					throw new Exception('Gagal mengedit dokter');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Dokter telah diedit'));
				redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Dokter';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Dokter';
		$data['page_desc']	= 'Edit Data Dokter Fasilitas Kesehatan';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data['edit_data']	= $data_dokter;
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.dokter.edit',$data);
	}
	public function layanan_delete($id_dokter){
		$this->load->model('User_model');
		$this->load->model('DG_Dokter');
		try{
			$dokter_data=$this->DG_Dokter->get_single_data(array('id_dokter'=>$id_dokter));
			if(!$dokter_data)
				throw new Exception('Dokter tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$dokter_data['id_rs']))
				throw new Exception('Tidak memiliki ijin untuk menghapus dokter ini');
			if(!$this->DG_Dokter->delete_data(array('id_dokter'=>$id_dokter)))
				throw new Exception('Gagal menghapus dokter');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Dokter sudah dihapus'));
			redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/dokter'),'refresh');
		}
	}

	/*
	 * ===========================================================
	 * Ambulance
	 * ===========================================================
	 */
	public function ambulance(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Ambulance';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Ambulance';
		$data['page_desc']	= 'List Data Ambulance';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.ambulance.list',$data);
	}
	public function ambulance_data($is_admin){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Ambulance');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Ambulance->setIn('tb_rs.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_Ambulance->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Ambulance->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Ambulance->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function ambulance_add(){
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('merk','Merk','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('tahun_produksi','Tahun Produksi','required|trim|integer');
			$this->form_validation->set_rules('nopol','Nomor Polisi','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('fungsi','Fungsi','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan ambulance di rumah sakit ini');
				$this->load->model('DG_Ambulance');
				unset($_POST['save']);
				if(!$this->DG_Ambulance->insert_data($_POST))
					throw new Exception('Gagal menambahkan Ambulance');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Ambulance telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/ambulance'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Ambulance';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Ambulance';
		$data['page_desc']	= 'Tambah Data Ambulance Fasilitas Kesehatan';
		$this->load->model('Model_Ambulance');
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_merk'] = $this->Model_Ambulance->get_value('merk_mobil');
		$data['selection_fungsi'] = $this->Model_Ambulance->get_value('fungsi_mobil');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.ambulance.create',$data);
	}
	public function ambulance_edit($id_ambulance){
		$this->load->model('DG_Ambulance');
		$data_ambulance = $this->DG_Ambulance->get_single_data(array('id_ambulance'=>$id_ambulance));
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('merk','Merk','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('tahun_produksi','Tahun Produksi','required|trim|integer');
			$this->form_validation->set_rules('nopol','Nomor Polisi','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('fungsi','Fungsi','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$data_ambulance['id_rs'])){
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak dapat mengedit Ambulance Fasilitas Kesehatan ini'));
					redirect(base_url('panel/rumah_sakit/ambulance'),'refresh');
				}
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan ambulance di rumah sakit ini');
				unset($_POST['save']);
				$this->db->set('tgl_update','NOW()',FALSE);
				if(!$this->DG_Ambulance->update_data(array('id_ambulance'=>$id_ambulance),$_POST))
					throw new Exception('Gagal mengedit ambulance');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Ambulance telah diedit'));
				redirect(base_url('panel/rumah_sakit/ambulance'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Ambulance';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Ambulance';
		$data['page_desc']	= 'Edit Data Ambulance Fasilitas Kesehatan';
		$this->load->model('Model_Ambulance');
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_merk'] = $this->Model_Ambulance->get_value('merk_mobil');
		$data['selection_fungsi'] = $this->Model_Ambulance->get_value('fungsi_mobil');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data['edit_data']	= $data_ambulance;
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.ambulance.edit',$data);
	}
	public function ambulance_delete($id_ambulance){
		$this->load->model('User_model');
		$this->load->model('DG_Ambulance');
		try{
			$dokter_data=$this->DG_Ambulance->get_single_data(array('id_ambulance'=>$id_ambulance));
			if(!$dokter_data)
				throw new Exception('Ambulance tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$dokter_data['id_rs']))
				throw new Exception('Tidak memiliki ijin untuk menghapus ambulance ini');
			if(!$this->DG_Ambulance->delete_data(array('id_ambulance'=>$id_ambulance)))
				throw new Exception('Gagal menghapus ambulance');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Ambulance sudah dihapus'));
			redirect(base_url('panel/rumah_sakit/ambulance'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/ambulance'),'refresh');
		}
	}


	/*
	 * ===========================================================
	 * Nakes
	 * ===========================================================
	 */
	public function nakes(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Nakes';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Nakes';
		$data['page_desc']	= 'List Data Nakes';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.nakes.list',$data);
	}
	public function nakes_data($is_admin){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Nakes');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Nakes->setIn('tb_rs.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_Nakes->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Nakes->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Nakes->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function nakes_add(){
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			//$this->form_validation->set_rules('nama','Nama','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('telp','Nomor Telepon','required|trim|numeric');
			$this->form_validation->set_rules('nama','Nama','required|trim|max_length[255]');		
			$this->form_validation->set_rules('profesi_name','Nama Profesi','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan nakes di rumah sakit ini');
				$this->load->model('DG_Nakes');
				unset($_POST['save']);
				if(!$this->DG_Nakes->insert_data($_POST))
					throw new Exception('Gagal menambahkan Nakes');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Nakes telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/nakes'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Nakes';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Nakes';
		$data['page_desc']	= 'Tambah Data Nakes';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.nakes.create',$data);
	}
	public function nakes_edit($id_nakes){
		$this->load->model('DG_Nakes');
		$data_nakes = $this->DG_Nakes->get_single_data(array('id_nakes'=>$id_nakes));
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			//$this->form_validation->set_rules('nama','Nama','required|trim|alpha_numeric_spaces');
	        $this->form_validation->set_rules('telp','Nomor Telepon','required|trim|numeric');
			$this->form_validation->set_rules('nama','Nama','required|trim|max_length[255]');
			$this->form_validation->set_rules('profesi_name','Nama Profesi','required|trim|alpha_numeric_spaces');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$data_nakes['id_rs'])){
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak dapat mengedit Nakes Fasilitas Kesehatan ini'));
					redirect(base_url('panel/rumah_sakit/nakes'),'refresh');
				}
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan nakes di rumah sakit ini');
				unset($_POST['save']);
				if(!$this->DG_Nakes->update_data(array('id_nakes'=>$id_nakes),$_POST))
					throw new Exception('Gagal mengedit nakes');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Nakes telah diedit'));
				redirect(base_url('panel/rumah_sakit/nakes'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Nakes';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Nakes';
		$data['page_desc']	= 'Edit Data Nakes';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data['edit_data']	= $data_nakes;
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.nakes.edit',$data);
	}
	public function nakes_delete($id_nakes){
		$this->load->model('User_model');
		$this->load->model('DG_Nakes');
		try{
			$dokter_data=$this->DG_Nakes->get_single_data(array('id_nakes'=>$id_nakes));
			if(!$dokter_data)
				throw new Exception('Nakes tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$dokter_data['id_rs']))
				throw new Exception('Tidak memiliki ijin untuk menghapus Nakes ini');
			if(!$this->DG_Nakes->delete_data(array('id_nakes'=>$id_nakes)))
				throw new Exception('Gagal menghapus nakes');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Nakes sudah dihapus'));
			redirect(base_url('panel/rumah_sakit/nakes'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/nakes'),'refresh');
		}
	}

	/*
	 * ===========================================================
	 * Stok Darah
	 * ===========================================================
	 */
	public function stok_darah(){
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Stok Darah';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Stok Darah';
		$data['page_desc']	= 'List Data Stok Darah';
		if($message=$this->session->flashdata('message')){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.stok_darah.list',$data);
	}
	public function stok_darah_data($is_admin){
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Stok_Darah');

		if(!$is_admin){
			$this->load->model('User_model');
			$this->DG_Stok_Darah->setIn('tb_rs.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}

		$data=$this->DG_Stok_Darah->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Stok_Darah->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Stok_Darah->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function stok_darah_add(){
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('gol_darah','Golongan Darah','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('stok','Stok','required|trim|numeric');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan stok_darah di rumah sakit ini');
				$this->load->model('DG_Stok_Darah');
				unset($_POST['save']);
				if(!$this->DG_Stok_Darah->insert_data($_POST))
					throw new Exception('Gagal menambahkan Stok Darah');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Stok Darah telah ditambahkan'));
				redirect(base_url('panel/rumah_sakit/stok_darah'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Stok Darah';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Stok Darah';
		$data['page_desc']	= 'Tambah Data Stok Darah';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data['selection_gol_darah'] = array(
			'A' => 'A',
			'B' => 'B',
			'AB' => 'AB',
			'O' => 'O',
		);
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.stok_darah.create',$data);
	}
	public function stok_darah_edit($id_stok_darah){
		$this->load->model('DG_Stok_Darah');
		$data_stok_darah = $this->DG_Stok_Darah->get_single_data(array('id_stok_darah'=>$id_stok_darah));
		if($_POST){
			$this->form_validation->set_rules('id_rs','Nama Fasilitas Kesehatan','required|trim|integer');
			$this->form_validation->set_rules('gol_darah','Golongan Darah','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('stok','Stok','required|trim|numeric');
			try{
				if($this->form_validation->run()==FALSE)
					throw new Exception(validation_errors());
				$this->load->model('User_model');
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$data_stok_darah['id_rs'])){
					$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>'Anda tidak dapat mengedit Stok Darah Fasilitas Kesehatan ini'));
					redirect(base_url('panel/rumah_sakit/stok_darah'),'refresh');
				}
				if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$_POST['id_rs']))
					throw new Exception('Anda tidak dapat menambahkan stok darah di rumah sakit ini');
				unset($_POST['save']);
				if(!$this->DG_Stok_Darah->update_data(array('id_stok_darah'=>$id_stok_darah),$_POST))
					throw new Exception('Gagal mengedit stok_darah');
				$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Stok Darah telah diedit'));
				redirect(base_url('panel/rumah_sakit/stok_darah'),'refresh');
			}catch (Exception $e){
				$message=array('status'=>FALSE,'message'=>$e->getMessage());
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Stok Darah';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Data Stok Darah';
		$data['page_desc']	= 'Edit Data Stok Darah';
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data['edit_data']	= $data_stok_darah;
		$data['selection_gol_darah'] = array(
			'A' => 'A',
			'B' => 'B',
			'AB' => 'AB',
			'O' => 'O',
		);
		if(isset($message))
			$data['message']=$message;
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.stok_darah.edit',$data);
	}
	public function stok_darah_delete($id_stok_darah){
		$this->load->model('User_model');
		$this->load->model('DG_Stok_Darah');
		try{
			$dokter_data=$this->DG_Stok_Darah->get_single_data(array('id_stok_darah'=>$id_stok_darah));
			if(!$dokter_data)
				throw new Exception('Stok Darah tidak ditemukan');
			if(!$this->User_model->have_rs_permission($this->ion_auth->get_user_id(),$dokter_data['id_rs']))
				throw new Exception('Tidak memiliki ijin untuk menghapus Stok Darah ini');
			if(!$this->DG_Stok_Darah->delete_data(array('id_stok_darah'=>$id_stok_darah)))
				throw new Exception('Gagal menghapus stok_darah');
			$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Stok Darah sudah dihapus'));
			redirect(base_url('panel/rumah_sakit/stok_darah'),'refresh');
		}catch (Exception $e){
			$this->session->set_flashdata('message',array('status'=>FALSE,'message'=>$e->getMessage()));
			redirect(base_url('panel/rumah_sakit/stok_darah'),'refresh');
		}
	}
}
