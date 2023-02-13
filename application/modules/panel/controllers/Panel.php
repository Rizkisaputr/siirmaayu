<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 09/04/2018
 * Time: 21:23
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property M_Base $M_Base
 * @property DG_rujuk $DG_rujuk
 * @property Model_Dashboard $Model_Dashboard
 * @property User_model $User_model
 * @property Model_Rumah_Sakit $Model_Rumah_Sakit
 * @property DG_Pasien $DG_Pasien
 * @property DG_Bed $DG_Bed
 */

class Panel extends MX_Controller
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

	protected $user_data;
	function __construct()
	{
		parent::__construct();
		$this->user_data=$this->M_Base->cek_auth();
		date_default_timezone_set('Asia/jakarta');
	}

	public function index(){
		/**redirect('panel/dashboard'); DEFAULT HALAMAN PAGE SETELAH LOGIN*/
		redirect('panel/data_rujukan');
	}


	public function indexdinkes(){
		redirect('panel/dashboard');
	}

	public function dashboard() {

		$tahun = ($this->input->post('tahun') != null?$this->input->post('tahun'):date('Y'));
		$bulan = ($this->input->post('bulan') != null?$this->input->post('bulan'):null);

		$this->load->model('Model_Dashboard');
		$this->load->model('User_model');

		$all_rs=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		
		$this->session->set_userdata('is_puskesmas',$this->User_model->is_puskesmas($this->ion_auth->get_user_id()));
		$data['is_puskesmas'] = $this->session->userdata('is_puskesmas');
		$data['all_rs'] = $all_rs;

		$data=$this->M_Base->get_config();

		$rs = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
		$id_rs = (isset($rs[0])?$rs[0]:null);
		$list_rs = $this->Model_Dashboard->list_rs($id_rs);

		$umum = array();
		foreach($this->Model_Dashboard->rujukan_type($id_rs,1,['tahun' => $tahun,'bulan' => $bulan])->result() as $rj)
		{
			$umum[$rj->id_rs_dirujuk] = $rj->total;
		}
		$ibuanak = array();
		foreach($this->Model_Dashboard->rujukan_type($id_rs,2,['tahun' => $tahun,'bulan' => $bulan])->result() as $rj)
		{
			$ibuanak[$rj->id_rs_dirujuk] = $rj->total;
		}

		$diterima = array();
		foreach($this->Model_Dashboard->rujukan_status($id_rs,'Diterima',['tahun' => $tahun,'bulan' => $bulan])->result() as $rj)
		{
			$diterima[$rj->id_rs_dirujuk] = $rj->total;
		}

		$ditolak = array();
		foreach($this->Model_Dashboard->rujukan_status($id_rs,'Ditolak',['tahun' => $tahun,'bulan' => $bulan])->result() as $rj)
		{
			$ditolak[$rj->id_rs_dirujuk] = $rj->total;
		}

		$dialihkan = array();
		foreach($this->Model_Dashboard->rujukan_status($id_rs,'Dialihkan',['tahun' => $tahun,'bulan' => $bulan])->result() as $rj)
		{
			$dialihkan[$rj->id_rs_dirujuk] = $rj->total;
		}

		$mon = array();
		foreach($this->Model_Dashboard->rujukan_monthly($id_rs,['tahun' => $tahun,'bulan' => $bulan])->result() as $mm)
		{
			$mon[$mm->bulan] = $mm->total;
		}

		$monthly = array();
		for($i = 1; $i <= 12; $i++)
		{
			$monthly[] = (isset($mon[$i])?$mon[$i]:0);
		}

		$day = array();
		foreach($this->Model_Dashboard->rujukan_daily($id_rs,['tahun' => $tahun,'bulan' => $bulan])->result() as $dd)
		{
			$day[$dd->hari] = $dd->total;
		}
		
		$daily = array();
		for($i = 1; $i <= 31; $i++)
		{
			$daily[] = (isset($day[$i])?$day[$i]:0);
		}

		$data['list_rj_diterima'] = $diterima; 
		$data['list_rj_dialihkan'] = $dialihkan;
		$data['list_rj_ditolak'] = $ditolak;

		$data['list_rs'] = $list_rs;
		$data['list_rj_umum'] = $umum;
		$data['list_rj_ibuanak'] = $ibuanak;
		$data['rujukan_total'] = $this->Model_Dashboard->rujukan_total($id_rs,['tahun' => $tahun,'bulan' => $bulan])->row()->total;
		$data['rujukan_l'] = $this->Model_Dashboard->rujukan_jkel($id_rs,'Laki-laki',['tahun' => $tahun,'bulan' => $bulan])->row()->total;
		$data['rujukan_p'] = $this->Model_Dashboard->rujukan_jkel($id_rs,'Perempuan',['tahun' => $tahun,'bulan' => $bulan])->row()->total;
		$data['ibuanak'] = $this->Model_Dashboard->rujukan_type_total($id_rs,2,['tahun' => $tahun,'bulan' => $bulan])->row()->total;
		$data['umum'] = $this->Model_Dashboard->rujukan_type_total($id_rs,1,['tahun' => $tahun,'bulan' => $bulan])->row()->total;
		$data['monthly'] = implode(',',$monthly);
		$data['daily'] = implode(',',$daily);

		$data['cb_tahun'] = $this->Model_Dashboard->rujukan_tahun();
		$data['cb_tahun_selected'] = $tahun;
		$data['cb_bulan'] = $this->bulan;
		$data['cb_bulan_selected'] = $bulan;

		$data['title'] 		= 'dashboard';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Dashboard Rujukan';
		$data['page_desc']	= 'Dashboard Rujukan';

		render_back('pages.dashboard.dashboard_rujukan',$data);
	}

	public function dashboard_psc(){

		$tahun = ($this->input->post('tahun') != null?$this->input->post('tahun'):date('Y'));
		$bulan = ($this->input->post('bulan') != null?$this->input->post('bulan'):null);
		
		$this->load->model('Model_Dashboard');

		$data=$this->M_Base->get_config();
		$data['title']  = 'dashboard';
		$data['user'] = $this->user_data;

		$kp = array();
		foreach($this->Model_Dashboard->psc_kategori_sel()->result() as $a)
		{
			$kp[] = $a->value;
		}

		$kpres = array();
		foreach($this->Model_Dashboard->psc_kategori(['tahun' => $tahun,'bulan' => $bulan])->result() as $a)
		{
			$kpres[$a->kategori_psc] = $a->jml;
		}

		$kp_data = array();
		foreach($this->Model_Dashboard->psc_kategori_sel()->result() as $a)
		{
			$val = 0;
			if (isset($kpres[$a->value])) $val = $kpres[$a->value];
			$kp_data[] = $val;
		}

		$tahun_pie = array($tahun-1,$tahun);

		$data['tahun_pie'] = '"'.implode('", "',$tahun_pie).'"';

		$tahun_proc = array(); foreach($this->Model_Dashboard->psc_tahun(['tahun' => $tahun,'bulan' => $bulan])->result() as $a)
		{
			$tahun_proc[$a->tahun] = $a->jml;
		}

		$tahun_data = array(); foreach($tahun_pie as $t)
		{
			$val = 0;
			if (isset($tahun_proc[$t])) $val = $tahun_proc[$t];
			$tahun_data[] = $val;
		}

		$data['cb_tahun'] = $this->Model_Dashboard->psc_tahun();
		$data['cb_tahun_selected'] = $tahun;
		$data['cb_bulan'] = $this->bulan;
		$data['cb_bulan_selected'] = $bulan;

		$data['tahun_data'] = implode(',',$tahun_data);
 
		$data['psc_sel'] = '"'.implode('","',$kp).'"';
		$data['psc_data'] = implode(',',$kp_data);
		$data['total'] = $this->Model_Dashboard->psc_total(['tahun' => $tahun,'bulan' => $bulan])->num_rows();
		$data['page_head']	= 'Dashboard PSC';
		$data['page_desc']	= 'Dashboard PSC';

		render_back('pages.dashboard.dashboard_psc',$data);
	}

	public function dashboard_pwskia(){

		$this->load->model('Model_Dashboard');
		$data=$this->M_Base->get_config();

		$tahun = ($this->input->post('tahun')?$this->input->post('tahun'):date('Y'));
		$puskesmas = ($this->input->post('puskesmas')?$this->input->post('puskesmas'):$this->Model_Dashboard->get_puskesmas()->row()->id_rs);

		$data['title'] 		= 'dashboard';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Dashboard PWSKIA';
		$data['page_desc']	= 'Dashboard PWSKIA';

		$det = $this->Model_Dashboard->get_detail($tahun,$puskesmas);
		$detail = array();
		foreach($det->result() as $d)
		{
			$detail[] = $d->akses;
			$detail[] = $d->murni;
			$detail[] = $d->k4;
			$detail[] = $d->linakes;
			$detail[] = $d->kf3;
			$detail[] = $d->kn1;
			$detail[] = $d->kn_lgkp;
			$detail[] = $d->masy;
			$detail[] = $d->nakes;
			$detail[] = $d->bumil;
			$detail[] = $d->neo;
			$detail[] = $d->bayi11;
			$detail[] = $d->balita;
			$detail[] = $d->ditangani;
			$detail[] = $d->total_balita;
			$detail[] = $d->kb_baru;
		}

		$data['puskesmas'] = $this->Model_Dashboard->get_puskesmas($puskesmas)->row();
		$data['detail'] = implode(',',$detail);

		// Target Bulanan //
		$target_data = array(); foreach($this->Model_Dashboard->target_bulan($tahun, $puskesmas)->result() as $t)
		{
			$target_data[$t->bulan] = $t->total;
		}

		$pwskia_data = array(); foreach($this->Model_Dashboard->data_bulan($tahun, $puskesmas)->result() as $t)
		{
			$pwskia_data[$t->bulan] = $t->total;
		}

		$bln_ini = date('m');
		$pwskia_data_bln_ini_target = array(); foreach($this->Model_Dashboard->data_bulan_ini_target($bln_ini,$tahun, $puskesmas)->result() as $t)
		{
			$total = $t->akses+$t->murni+$t->k4+$t->linakes+$t->kf3;
			+$t->kn1+$t->kn_lgkp+$t->masy+$t->nakes+$t->bumil+$t->neo+$t->bayi11+$t->balita+$t->ditangani+$t->total_balita+$t->kb_baru;
			$pwskia_data_bln_ini_target[$t->id_desa] = $total;
		}
		$pwskia_data_bln_ini = array(); foreach($this->Model_Dashboard->data_bulan_ini($bln_ini,$tahun, $puskesmas)->result() as $t)
		{
			$target_hitung = (isset($pwskia_data_bln_ini_target[$t->id_desa]))?$pwskia_data_bln_ini_target[$t->id_desa]:0;
			$total = $t->akses+$t->murni+$t->k4+$t->linakes+$t->kf3;
			+$t->kn1+$t->kn_lgkp+$t->masy+$t->nakes+$t->bumil+$t->neo+$t->bayi11+$t->balita+$t->ditangani+$t->total_balita+$t->kb_baru;
			$pwskia_data_bln_ini[$t->id_desa] = ($target_hitung > 0 and $total > 0)?number_format($target_hitung/$total,0):0;
		}


		$bln_past = (date('m') == 1?12:date('m')-1);

		$pwskia_data_bln_past_target = array(); foreach($this->Model_Dashboard->data_bulan_ini_target($bln_past,$tahun, $puskesmas)->result() as $t)
		{
			$total = $t->akses+$t->murni+$t->k4+$t->linakes+$t->kf3;
			+$t->kn1+$t->kn_lgkp+$t->masy+$t->nakes+$t->bumil+$t->neo+$t->bayi11+$t->balita+$t->ditangani+$t->total_balita+$t->kb_baru;
			$pwskia_data_bln_past_target[$t->id_desa] = $total;
		}
		$pwskia_data_bln_past = array(); foreach($this->Model_Dashboard->data_bulan_ini($bln_past,$tahun, $puskesmas)->result() as $t)
		{
			$target_hitung = (isset($pwskia_data_bln_ini_target[$t->id_desa]))?$pwskia_data_bln_ini_target[$t->id_desa]:0;
			$total = $t->akses+$t->murni+$t->k4+$t->linakes+$t->kf3;
			+$t->kn1+$t->kn_lgkp+$t->masy+$t->nakes+$t->bumil+$t->neo+$t->bayi11+$t->balita+$t->ditangani+$t->total_balita+$t->kb_baru;
			$pwskia_data_bln_past[$t->id_desa] = ($target_hitung > 0 and $total > 0)?number_format($target_hitung/$total,0):0;
		}
		
		$pwskia_kumulatif_target = array(); foreach($this->Model_Dashboard->data_kumulatif_target($puskesmas)->result() as $t)
		{
			$total = $t->akses+$t->murni+$t->k4+$t->linakes+$t->kf3;
			+$t->kn1+$t->kn_lgkp+$t->masy+$t->nakes+$t->bumil+$t->neo+$t->bayi11+$t->balita+$t->ditangani+$t->total_balita+$t->kb_baru;
			$pwskia_kumulatif_target[$t->id_desa] = $total;
		}

		$pwskia_data_kumulatif = array(); foreach($this->Model_Dashboard->data_kumulatif($puskesmas)->result() as $t)
		{
			$target_hitung = (isset($pwskia_kumulatif_target[$t->id_desa]))?$pwskia_kumulatif_target[$t->id_desa]:0;
			$total = $t->akses+$t->murni+$t->k4+$t->linakes+$t->kf3;
			+$t->kn1+$t->kn_lgkp+$t->masy+$t->nakes+$t->bumil+$t->neo+$t->bayi11+$t->balita+$t->ditangani+$t->total_balita+$t->kb_baru;
			$pwskia_data_kumulatif[$t->id_desa] = ($target_hitung > 0 and $total > 0)?number_format($target_hitung/$total,0):0;
		}
		

		$persen_bln = array();
		for($i = 1; $i <= 12; $i++)
		{
			$persen = '-';
			if (isset($target_data[$i]) and isset($pwskia_data[$i]))
			{
				$persen = number_format($pwskia_data[$i]/$target_data[$i]*100,0).'%';
			}
			$persen_bln[$i] = $persen;
		}

		$data['pbln'] = $persen_bln; 
		$data['cb_puskesmas'] = $this->Model_Dashboard->get_puskesmas();

		$cb_tahun = array(); for($i = date('Y')-2; $i < date('Y')+3; $i++)
		{
			$cb_tahun[] = $i;
		}

		$data['cb_tahun'] = $cb_tahun;
		$data['thn_selected'] = $tahun;
		$data['bulan_ini'] = $pwskia_data_bln_ini;
		$data['bulan_past'] = $pwskia_data_bln_past;
		$data['kumulatif'] = $pwskia_data_kumulatif;
		$data['puskesmas_selected'] = $puskesmas;
		$data['desa'] = $this->Model_Dashboard->get_desa($puskesmas);

		render_back('pages.dashboard.dashboard_pwskia',$data);
	}
	
	public function data_rujukan(){

		$data=$this->M_Base->get_config();
		$data['title'] 		= 'dashboard';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Dashboard';
		$data['page_desc']	= 'Dashboard Sistem';
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		
		$s_date = $this->input->post('start_date');
		$e_date = $this->input->post('end_date');
		$faskes = $this->input->post('faskes');

		$data['filter'] = array($s_date,$e_date,$faskes);

//		if($this->ion_auth->is_admin()){
//			render_back('pages.dashboard.dashboard_mimin',$data);
//		}else{
//			$this->load->model('Model_Dashboard');
//			$this->load->model('User_model');
//			$this->load->model('DG_Pasien');
//			$this->load->model('DG_Bed');
//			$all_rs=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
//			$data['my_rujukan_count']	= $this->Model_Dashboard->rujukan_counter(array(),FALSE,array('key'=>'id_rs_perujuk','in'=>$all_rs));
//			$this->DG_Bed->setIn('tb_bed.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
//			$data['my_bed_count']		= $this->DG_Bed->total();
//			$data['my_response_spd']	= $this->Model_Dashboard->rujukan_response_speed(false,array('key'=>'id_rs_dirujuk','in'=>$all_rs));
//			$data['pasien_count']		= $this->DG_Pasien->total();
//			render_back('pages.dashboard.dashboard',$data);
//		}
		$is_admin=$this->ion_auth->is_admin();
		if ($this->ion_auth->in_group('psc')) $is_admin = true;
		$this->load->model('Model_Dashboard');
		$this->load->model('User_model');
		$this->load->model('DG_Pasien');
		$this->load->model('DG_Bed');
		$all_rs=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());


		$this->session->set_userdata('is_puskesmas',$this->User_model->is_puskesmas($this->ion_auth->get_user_id()));
		$data['is_puskesmas'] = $this->session->userdata('is_puskesmas');
		$data['all_rs'] = $all_rs;

		$where = array();
		if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;
		if ($s_date != NULL and $e_date != NULL) {
			$where['tb_rujukan.dibuat >='] = $s_date;
			$where['tb_rujukan.dibuat <='] = $e_date;
		}

		$data['my_rujukan_count']	= $this->Model_Dashboard->rujukan_counter($where,$is_admin,array('key'=>'id_rs_perujuk','in'=>$all_rs));
		if(!$is_admin) {
			$this->DG_Bed->setIn('tb_bed.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
			$this->DG_Pasien->setIn('tb_rs.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}
		if ($faskes != NULL) {
			$this->DG_Bed->setWhere('tb_rs.jenis',$faskes);
			$this->DG_Pasien->setWhere('tb_rs.jenis',$faskes);
		}
		
		$data['my_bed_count']		= $this->DG_Bed->total();
		$data['my_response_spd']	= $this->Model_Dashboard->rujukan_response_speed($is_admin,array('key'=>'id_rs_dirujuk','in'=>$all_rs));
		$data['pasien_count']		= $this->DG_Pasien->total();

		$data['pasien_l'] = $this->Model_Dashboard->rujukan_gender(array('tb_pasien.jenis_kelamin' => 'Laki-laki'),array('key'=>'tb_pasien_owner.id_rs','in'=>(is_array($all_rs)?$all_rs:null)));

		$data['pasien_p'] = $this->Model_Dashboard->rujukan_gender(array('tb_pasien.jenis_kelamin' => 'Perempuan'),array('key'=>'tb_pasien_owner.id_rs','in'=>(is_array($all_rs)?$all_rs:null)));

		$data['is_admin']			= $is_admin;
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_faskes'] 	= $this->Model_Rumah_Sakit->get_type_faskes();

		$param = array();
		if ($s_date != NULL and $e_date != NULL) {
			$param[] = 'start='.$s_date; 
			$param[] = 'end='.$e_date; 
		}
		if ($faskes != NULL) $param[] = 'faskes='.$faskes;
		$data['param_pie'] = (count($param) > 0)?'?'.implode('&',$param):null;
		$data['param_bed'] = ($faskes != NULL?$faskes:'all');
		$data['param_rujuk'] = implode('_',array('faskes' => ($faskes != NULL?$faskes:'all'),'date' => ($s_date != NULL and $e_date != NULL) ? $s_date.'_'.$e_date:'all'));

		render_back('pages.dashboard.data_rujukan',$data);
	}

	public function dashboard_data_rujukan(){

		$sdate = $this->input->get('start');
		$edate = $this->input->get('end');
		$faskes = $this->input->get('faskes');

		$data=array();
		$this->load->model('Model_Dashboard');
		$this->load->model('User_model');
		$all_rs=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());

		if(!isset($_GET['ping'])){
			$where = array('status_rujukan'=>'Diterima');
			if ($sdate != NULL) {
				$where['tb_rujukan.dibuat >='] = $sdate;
				$where['tb_rujukan.dibuat <='] = $edate;
			}
			if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;

			$data['terima']		= $this->Model_Dashboard->rujukan_counter($where,FALSE,array('key'=>'id_rs_dirujuk','in'=>(is_array($all_rs)?$all_rs:null)));
			$where = array('status_rujukan'=>'Ditolak');
			if ($sdate != NULL) {
				$where['tb_rujukan.dibuat >='] = $sdate;
				$where['tb_rujukan.dibuat <='] = $edate;
			}
			if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;
			$data['tolak']	= $this->Model_Dashboard->rujukan_counter($where,FALSE,array('key'=>'id_rs_dirujuk','in'=>(is_array($all_rs)?$all_rs:null)));

		}
		$where = array('status_rujukan'=>'Belum direspon');
			if ($sdate != NULL) {
				$where['tb_rujukan.dibuat >='] = $sdate;
				$where['tb_rujukan.dibuat <='] = $edate;
			}
			if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;
		$data['no_respon']	= $this->Model_Dashboard->rujukan_counter($where,$this->ion_auth->is_admin(),array('key'=>'id_rs_dirujuk','in'=>$all_rs));
		send_json($data);
	}

	public function data_rujukan_all(){

		$data=$this->M_Base->get_config();
		$data['title'] 		= 'dashboard';
		$data['user'] 		= $this->user_data;
		$data['page_head']	= 'Dashboard';
		$data['page_desc']	= 'Dashboard Sistem';
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		
		$s_date = $this->input->post('start_date');
		$e_date = $this->input->post('end_date');
		$faskes = $this->input->post('faskes');

		$data['filter'] = array($s_date,$e_date,$faskes);

//		if($this->ion_auth->is_admin()){
//			render_back('pages.dashboard.dashboard_mimin',$data);
//		}else{
//			$this->load->model('Model_Dashboard');
//			$this->load->model('User_model');
//			$this->load->model('DG_Pasien');
//			$this->load->model('DG_Bed');
//			$all_rs=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
//			$data['my_rujukan_count']	= $this->Model_Dashboard->rujukan_counter(array(),FALSE,array('key'=>'id_rs_perujuk','in'=>$all_rs));
//			$this->DG_Bed->setIn('tb_bed.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
//			$data['my_bed_count']		= $this->DG_Bed->total();
//			$data['my_response_spd']	= $this->Model_Dashboard->rujukan_response_speed(false,array('key'=>'id_rs_dirujuk','in'=>$all_rs));
//			$data['pasien_count']		= $this->DG_Pasien->total();
//			render_back('pages.dashboard.dashboard',$data);
//		}
		$is_admin=$this->ion_auth->is_admin();
		if ($this->ion_auth->in_group('psc')) $is_admin = true;
		$this->load->model('Model_Dashboard');
		$this->load->model('User_model');
		$this->load->model('DG_Pasien');
		$this->load->model('DG_Bed');
		$all_rs=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());


		$this->session->set_userdata('is_puskesmas',$this->User_model->is_puskesmas($this->ion_auth->get_user_id()));
		$data['is_puskesmas'] = $this->session->userdata('is_puskesmas');
		$data['all_rs'] = $all_rs;

		$where = array();
		if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;
		if ($s_date != NULL and $e_date != NULL) {
			$where['tb_rujukan.dibuat >='] = $s_date;
			$where['tb_rujukan.dibuat <='] = $e_date;
		}

		$data['my_rujukan_count']	= $this->Model_Dashboard->rujukan_counter($where,$is_admin,array('key'=>'id_rs_perujuk','in'=>$all_rs));
		if(!$is_admin) {
			$this->DG_Bed->setIn('tb_bed.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
			$this->DG_Pasien->setIn('tb_rs.id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}
		if ($faskes != NULL) {
			$this->DG_Bed->setWhere('tb_rs.jenis',$faskes);
			$this->DG_Pasien->setWhere('tb_rs.jenis',$faskes);
		}
		
		$data['my_bed_count']		= $this->DG_Bed->total();
		$data['my_response_spd']	= $this->Model_Dashboard->rujukan_response_speed($is_admin,array('key'=>'id_rs_dirujuk','in'=>$all_rs));
		$data['pasien_count']		= $this->DG_Pasien->total();

		$data['pasien_l'] = $this->Model_Dashboard->rujukan_gender(array('tb_pasien.jenis_kelamin' => 'Laki-laki'),array('key'=>'tb_pasien_owner.id_rs','in'=>(is_array($all_rs)?$all_rs:null)));

		$data['pasien_p'] = $this->Model_Dashboard->rujukan_gender(array('tb_pasien.jenis_kelamin' => 'Perempuan'),array('key'=>'tb_pasien_owner.id_rs','in'=>(is_array($all_rs)?$all_rs:null)));

		$data['is_admin']			= $is_admin;
		$this->load->model('Model_Rumah_Sakit');
		$data['selection_faskes'] 	= $this->Model_Rumah_Sakit->get_type_faskes();

		$param = array();
		if ($s_date != NULL and $e_date != NULL) {
			$param[] = 'start='.$s_date; 
			$param[] = 'end='.$e_date; 
		}
		if ($faskes != NULL) $param[] = 'faskes='.$faskes;
		$data['param_pie'] = (count($param) > 0)?'?'.implode('&',$param):null;
		$data['param_bed'] = ($faskes != NULL?$faskes:'all');
		$data['param_rujuk'] = implode('_',array('faskes' => ($faskes != NULL?$faskes:'all'),'date' => ($s_date != NULL and $e_date != NULL) ? $s_date.'_'.$e_date:'all'));

		render_back('pages.dashboard.data_rujukan_all',$data);
	}

	public function dashboard_data_rujukan_all(){

		$sdate = $this->input->get('start');
		$edate = $this->input->get('end');
		$faskes = $this->input->get('faskes');

		$data=array();
		$this->load->model('Model_Dashboard');
		$this->load->model('User_model');
		$all_rs=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());

		if(!isset($_GET['ping'])){
			$where = array('status_rujukan'=>'Diterima');
			if ($sdate != NULL) {
				$where['tb_rujukan.dibuat >='] = $sdate;
				$where['tb_rujukan.dibuat <='] = $edate;
			}
			if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;

			$data['terima']		= $this->Model_Dashboard->rujukan_counter($where,FALSE,array('key'=>'id_rs_dirujuk','in'=>(is_array($all_rs)?$all_rs:null)));
			$where = array('status_rujukan'=>'Ditolak');
			if ($sdate != NULL) {
				$where['tb_rujukan.dibuat >='] = $sdate;
				$where['tb_rujukan.dibuat <='] = $edate;
			}
			if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;
			$data['tolak']	= $this->Model_Dashboard->rujukan_counter($where,FALSE,array('key'=>'id_rs_dirujuk','in'=>(is_array($all_rs)?$all_rs:null)));

		}
		$where = array('status_rujukan'=>'Belum direspon');
			if ($sdate != NULL) {
				$where['tb_rujukan.dibuat >='] = $sdate;
				$where['tb_rujukan.dibuat <='] = $edate;
			}
			if ($faskes != NULL) $where['tb_rs.jenis'] = $faskes;
		$data['no_respon']	= $this->Model_Dashboard->rujukan_counter($where,$this->ion_auth->is_admin(),array('key'=>'id_rs_dirujuk','in'=>$all_rs));
		send_json($data);
	}

	public function dashboard_data_bed($param){
		modules::run('panel/rumah_sakit/bed_data',TRUE,($param != 'all'?str_replace('%20',' ',$param):'Rumah Sakit'));
	}

	public function backup_db(){
		if(!$this->ion_auth->is_admin()){
			show_404();
		}
		$this->load->dbutil();
		$prefs = array(
			'format'      => 'txt',
			'filename'    => 'my_db_backup.sql'
		);
		ini_set('memory_limit', '2048M');
		$backup = $this->dbutil->backup($prefs);
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.sql';
		$backup_name = $db_name ? $db_name : 'backup'.".sql";
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary");
		header("Content-disposition: attachment; filename=\"".$backup_name."\"");
		echo $backup; exit;
	}
}
