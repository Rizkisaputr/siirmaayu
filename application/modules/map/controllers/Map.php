<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property M_Base M_Base
 * @property CI_URI uri
 * @property Model_Map_Bed $Model_Map_Bed
 */

class Map extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/jakarta');
	}

	public function index(){

		$this->load->model('Model_Map_Bed');

		$data=$this->M_Base->get_config();
		$data['ambulance'] = $this->Model_Map_Bed->ambulance_pin();
		$data['title'] = 'Map';
		render_front('Map',$data);
	}
	public function bed_data(){
		$this->load->model('Model_Map_Bed');
		$q=$this->Model_Map_Bed->list_bed_query();
		// $i=1;

		while ($row=$q->unbuffered_row()){

			$updater = null;
			if ($row->diupdate != NULL) 
			{
				$upd = explode(':',$row->diupdate);

				if ($upd[0] > 24) {
					$days = floor($upd[0]/24);
					$hour = $upd[0]%24;
				} else {
					$days = null;
					$hour = $upd[0];
				}	

				if ($days != null) $updater = $days.' Hari '.$hour.' Jam';
				else $updater = $hour.' Jam';
				
				if ($upd[1] != null) $updater.= ' '.$upd[1].' Menit';
			}

			echo '<tr>
					<td>
						<a data-idrs="'.$row->id_rs.'" data-toggle="modal" data-target="#exampleModal">' .$row->nama.'&nbsp;&nbsp;<span class="ion-icon ion-ios-information"> Detail</span></a>
						</td>';
						$this->rs_data_formater($row->bed_data,21);
						$this->rs_data_formater($row->rujuk_data,1);
						$this->rs_data_formater($row->faskes_data,1);
						$this->rs_data_formater($row->ambulance,1);
						$this->rs_data_formater($row->dokter_data,2);
						echo '<td>'.$updater.'</td></tr>'.PHP_EOL;
					}
				}
	public function rs_map(){
		$inner_k3=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','Kelas III')
			->get_compiled_select('tb_bed b_3');
		$inner_vk=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','VK')
			->get_compiled_select('tb_bed b_3');			
		$inner_icu=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','ICU')
			->get_compiled_select('tb_bed b_3');
		$inner_nicu=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','NICU')
			->get_compiled_select('tb_bed b_3');
		$inner_isolasi_icu=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','ISOLASI ICU')
			->get_compiled_select('tb_bed b_3');
		$inner_isolasi_igd=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','ISOLASI IGD')
			->get_compiled_select('tb_bed b_3');
		$inner_isolasi_perina=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','ISOLASI PERINA')
			->get_compiled_select('tb_bed b_3');
		$inner_covid_hijau=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','COVID HIJAU')
			->get_compiled_select('tb_bed b_3');
		$inner_covid_kuning=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','COVID KUNING')
			->get_compiled_select('tb_bed b_3');
		$inner_covid_merah=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','COVID MERAH')
			->get_compiled_select('tb_bed b_3');															
		$inner_ventilator=$this
			->db
			->select_sum('fv.jumlah')
			->where('fv.nama_faskes=','Ventilator')
			->where('fv.id_rs=tb_rs.id_rs')
			->get_compiled_select('tb_faskes fv');
		$inner_ambulan=$this
			->db
			->select_sum('fa.jumlah')
			->where('fa.nama_faskes','Ambulan')
			->where('fa.id_rs=tb_rs.id_rs')
			->get_compiled_select('tb_faskes fa');
//		$inner_k3
//		$this->db->select(<<<EOD
//tb_rs.id_rs,
//tb_rs.nama,
//tb_rs.pos_lat,
//tb_rs.pos_lon,
//COALESCE(SUM((tb_bed.kapasitas_l+tb_bed.kapasitas_p)-(tb_bed.terpakai_l+tb_bed.terpakai_p)),0) as kosong,
//COALESCE(SUM(icu.jumlah),0) as icu,
//COALESCE(SUM(ambulance.jumlah),0) as ambulance,
//COALESCE(SUM(ventilator.jumlah),0) as ventilator,
//EOD
//,FALSE);
		$this->db->select("tb_rs.id_rs,tb_rs.nama,tb_rs.pos_lat,tb_rs.pos_lon,($inner_k3) as k3,($inner_ambulan) as ambulance,($inner_ventilator) as ventilator,($inner_icu) as icu,($inner_nicu) as nicu,($inner_isolasi_igd) as isolasi_igd,($inner_isolasi_icu) as isolasi_icu,($inner_isolasi_perina) as isolasi_perina,($inner_covid_hijau) as covid_hijau,($inner_covid_kuning) as covid_kuning,($inner_covid_merah) as covid_merah,($inner_vk) as vk");
		$q=$this->db->get('tb_rs');
		header('Content-Type: application/json');
		echo '[';
		$first=0;
		while ($row=$q->unbuffered_row()){
			echo ($first++?',':'').json_encode($row);
		}
		echo ']';
	}

	public function rs_detil($id_rs){
		$this->load->model('Model_Map_Bed');
		$data=$this->Model_Map_Bed->detil_rs($id_rs);
		if($data===FALSE)
			show_404();
		render_front('partials.modal_detil_rs',$data);
	}

	//formater
	public function rs_data_formater($data,$assumed_len){
		$row=explode(';',$data,$assumed_len);
		foreach ($row as $r){
			if ($r == 0 or $r == NULL) echo "<td class='red'>0</td>";
			else echo "<td class='text-center'>$r</td>";
		}
		$remaining=$assumed_len-count($row);
		for ($i=0;$i<$remaining;$i++)
			echo '<td>0</td>';
	}


}