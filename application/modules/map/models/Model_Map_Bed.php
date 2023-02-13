<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property Model_Rumah_Sakit $Model_Rumah_Sakit
 */

class Model_Map_Bed extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function list_bed_query(){
		$this->db->reset_query();

		$kelas_1_total="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas I' THEN tb_bed.kapasitas_l+tb_bed.kapasitas_p ELSE 0 END),0)";
		$kelas_1_kosong_l="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas I' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$kelas_1_kosong_p="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas I' THEN tb_bed.kapasitas_p-tb_bed.terpakai_p ELSE 0 END),0)";

		$kelas_2_total="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas II' THEN tb_bed.kapasitas_l+tb_bed.kapasitas_p ELSE 0 END),0)";
		$kelas_2_kosong_l="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas II' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$kelas_2_kosong_p="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas II' THEN tb_bed.kapasitas_p-tb_bed.terpakai_p ELSE 0 END),0)";

		$kelas_3_total="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas III' THEN tb_bed.kapasitas_l+tb_bed.kapasitas_p ELSE 0 END),0)";
		$kelas_3_kosong_l="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas III' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$kelas_3_kosong_p="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='Kelas III' THEN tb_bed.kapasitas_p-tb_bed.terpakai_p ELSE 0 END),0)";

		$kelas_vip_total="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='VIP' THEN tb_bed.kapasitas_l+tb_bed.kapasitas_p ELSE 0 END),0)";
		$kelas_vip_kosong_l="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='VIP' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$kelas_vip_kosong_p="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='VIP' THEN tb_bed.kapasitas_p-tb_bed.terpakai_p ELSE 0 END),0)";

		$kelas_vvip_total="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='VVIP' THEN tb_bed.kapasitas_l+tb_bed.kapasitas_p ELSE 0 END),0)";
		$kelas_vvip_kosong_l="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='VVIP' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$kelas_vvip_kosong_p="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='VVIP' THEN tb_bed.kapasitas_p-tb_bed.terpakai_p ELSE 0 END),0)";

		$vk="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='VK' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$igd="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='IGD' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$isolasi="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='ISOLASI STANDARD' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$isolasicovid="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='ISOLASI COVID' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$isolasi_icu="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='ISOLASI ICU' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$isolasi_igd="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='ISOLASI IGD' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$isolasi_perina="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='ISOLASI PERINA' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$covid_hijau="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='COVID HIJAU' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$covid_kuning="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='COVID KUNING' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$covid_merah="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='COVID MERAH' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";		
		$icu="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='ICU' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$hcu="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='HCU' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$picu="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='PICU' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$nicu="COALESCE(SUM(CASE WHEN tb_kelas_bed.nama='NICU' THEN tb_bed.kapasitas_l-tb_bed.terpakai_l ELSE 0 END),0)";
		$f_v="COALESCE(SUM(CASE WHEN tb_faskes.nama_faskes='Ventilator' THEN tb_faskes.jumlah ELSE 0 END),0)";
		$f_a="COALESCE(SUM(CASE WHEN tb_faskes.nama_faskes='Ambulan' THEN 1 ELSE 0 END),0)";
		$d_j="COALESCE(COUNT(tb_dokter.id_dokter),0)";
		$d_s="COALESCE(SUM(tb_dokter.spesialis),0)";


		//some concantenate inner query
		//format: k3_kapasitas;k3_kosong_l;k3_kosong_p;vk;igd;icu;hcu;picu;nicu
		$i_q_bed=$this
			->db
			->select("CONCAT($kelas_1_total,';',$kelas_1_kosong_l,';',$kelas_1_kosong_p,';',$kelas_2_total,';',$kelas_2_kosong_l,';',$kelas_2_kosong_p,';',$kelas_3_total,';',$kelas_3_kosong_l,';',$kelas_3_kosong_p,';',$kelas_vip_total,';',$kelas_vip_kosong_l,';',$kelas_vip_kosong_p,';',$kelas_vvip_total,';',$kelas_vvip_kosong_l,';',$kelas_vvip_kosong_p,';',$vk,';',$igd,';',$icu,';',$isolasi_perina,';',$isolasi_icu,';',$isolasi_igd,';',$covid_hijau,';',$covid_kuning,';',$covid_merah,';',$hcu,';',$picu,';',$nicu)")
			->where('tb_bed.id_rs=tb_rs.id_rs')
			->join('tb_kelas_bed','tb_bed.kelas=tb_kelas_bed.id_kelas_bed')
			->get_compiled_select('tb_bed',TRUE);
		//format: rujukan_no_response
		$i_q_rujuk=$this
			->db
			->select("COUNT(tb_rujukan.id_rujukan)")
			->where('tb_rujukan.id_rs_dirujuk=tb_rs.id_rs')
			->where('tb_rujukan.status_rujukan','Belum direspon')
			->get_compiled_select('tb_rujukan',TRUE);
		//format: ventilator;ambulan
		$i_q_faskes=$this
			->db
			->select("$f_v")
			->where('tb_faskes.id_rs=tb_rs.id_rs')
			->get_compiled_select('tb_faskes',TRUE);
		//format: dokter_jaga;dokter_spesialis
		$i_q_dokter=$this
			->db
			->select("CONCAT($d_j,';',$d_s)")
			->where('tb_dokter.id_rs=tb_rs.id_rs')
			->where('TIME(NOW()) BETWEEN tb_jadwal_dokter.jam_mulai AND tb_jadwal_dokter.jam_selesai')
			->where('WEEKDAY(NOW())=tb_jadwal_dokter.hari')
			->join('tb_jadwal_dokter','tb_dokter.id_dokter=tb_jadwal_dokter.id_dokter')
			->get_compiled_select('tb_dokter',TRUE);

		$this->db->select("tb_rs.id_rs,tb_rs.nama,tb_rs.telepon,($i_q_bed) as bed_data,($i_q_rujuk) as rujuk_data,($i_q_faskes) as faskes_data,($i_q_dokter) as dokter_data,TIMEDIFF(NOW(),tb_update.updater) diupdate,jml_ambulance ambulance",FALSE);
		$this->db->from('tb_rs');
		$this->db->join('(select count(id_ambulance) jml_ambulance,id_rs from tb_ambulance group by id_rs) tb_ambulance','tb_ambulance.id_rs = tb_rs.id_rs','left');
		$this->db->join('(select MAX(tgl_update) updater,id_rs from tb_bed group by id_rs) tb_update','tb_update.id_rs = tb_rs.id_rs','left');
		$this->db->where('tb_rs.jenis','Rumah Sakit');
		$this->db->order_by('tb_rs.id_rs','ASC');
		return $this->db->get();
	}
	public function detil_rs($id_rs){
		$this->load->model('Model_Rumah_Sakit');
		$data=array();
		$data['data_rs']	= $this->Model_Rumah_Sakit->get_rs_data($id_rs);
		if(!$data['data_rs'])
			return FALSE;
		$data['dokter']		= $this->data_dokter($id_rs);
		$data['faskes']		= $this->data_faskes($id_rs);
		$data['bed']		= $this->data_bed($id_rs);
		$data['bed2']		= $this->data_bed($id_rs,TRUE);
		$data['layanan']	= $this->data_layanan($id_rs);
		return $data;
	}
	public function data_faskes($id_rs){
		$this->db->reset_query();
		$this->db->select('nama_faskes,jumlah');
		$this->db->where('id_rs',$id_rs);
		return $this->db->get('tb_faskes')->result();
	}
	public function data_dokter($id_rs){
		$this->db->reset_query();
		$this->db->select('tb_dokter.nama,tb_dokter.bidang');
		$this->db->where('tb_dokter.id_rs',$id_rs);
		$this->db->where('TIME(NOW()) BETWEEN tb_jadwal_dokter.jam_mulai AND tb_jadwal_dokter.jam_selesai');
		$this->db->where('WEEKDAY(NOW())=tb_jadwal_dokter.hari');
		$this->db->join('tb_jadwal_dokter','tb_dokter.id_dokter=tb_jadwal_dokter.id_dokter');
		return $this->db->get('tb_dokter')->result();
	}
	public function data_bed($id_rs,$unigender=FALSE){
		$this->db->reset_query();
		$this->db->select('tb_bed.nama,tb_bed.kapasitas_l,tb_bed.kapasitas_p,tb_bed.terpakai_l,tb_bed.terpakai_p,tb_kelas_bed.nama kelas');
		$this->db->join('tb_kelas_bed','tb_kelas_bed.id_kelas_bed=tb_bed.kelas');
		$this->db->where('id_rs',$id_rs);
		$this->db->where('tb_kelas_bed.unigender',$unigender);
		return $this->db->get('tb_bed')->result();
	}
	public function data_layanan($id_rs){
		$this->db->reset_query();
		$this->db->select('tb_layanan_type.nama');
		$this->db->where('tb_layanan.id_rs',$id_rs);
		$this->db->join('tb_layanan_type','tb_layanan.id_jenis_layanan=tb_layanan_type.id_jenis_layanan');
		return $this->db->get('tb_layanan')->result();
	}

	public function ambulance_pin()
	{
		$this->db->from('tb_ambulance');
		$this->db->join('tb_rs','tb_rs.id_rs = tb_ambulance.id_rs');
		$this->db->select('tb_ambulance.*,tb_rs.nama nama_rs');
		return $this->db->get();
	}


}
