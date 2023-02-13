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
 */

class Model_Dashboard extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function rujukan_gender($filter,$in=array()){
		$this->db->reset_query();
		$this->db->select('count(tb_pasien.id_rm) jml');
		$this->db->from('tb_pasien');

		foreach ($filter as $key=>$val){
			$this->db->where($key,$val);
		}
		if($in['in'] != NULL){
			$this->db->where_in($in['key'],$in['in']);
			$this->db->join('tb_pasien_owner','tb_pasien_owner.id_rm=tb_pasien.id_rm');
		}
		
		return $this->db->get()->row()->jml;

	}

	public function rujukan_counter($filter,$admin=TRUE,$in=array()){
		$this->db->reset_query();
		foreach ($filter as $key=>$val){
			$this->db->where($key,$val);
		}
		if(!$admin){
			$this->db->where_in($in['key'],$in['in']);
		}
		$this->db->from('tb_rujukan');
		$this->db->join('tb_rs','tb_rs.id_rs=tb_rujukan.id_rs_dirujuk');
		return $this->db->count_all_results();
	}

	public function rujukan_response_speed($admin=TRUE,$in=array()){
		$this->db->reset_query();
		if(!$admin){
			$this->db->where_in($in['key'],$in['in']);
		}
		$this->db->where('status_rujukan!=','Belum direspon');
		$res=$this->db->select('AVG(TIMESTAMPDIFF(SECOND,dibuat,direspon)) as speed',FALSE)->get('tb_rujukan')->row();
		return $res ? $res->speed:0;
	}

	public function list_rs($id_rs)
	{
		$this->db->from('tb_rs')
		->where('jenis','Rumah Sakit')
		->select('id_rs,nama');
		if ($id_rs != null) $this->db->where('id_rs',$id_rs);
		return $this->db->get();
	}

	public function rujukan_tahun()
	{
		return $this->db->select('YEAR(dibuat) tahun')
		->group_by('YEAR(dibuat)')
		->get('tb_rujukan');
	}

	public function rujukan_type($id_rs = null,$type)
	{
		$this->db->from('tb_rujukan t')
		->join('tb_rs rs','rs.id_rs=t.id_rs_dirujuk')
		->where('t.type',$type)
		->select('count(t.id_rujukan) total,t.id_rs_dirujuk')
		->where('rs.jenis','Rumah Sakit')
		->group_by('t.id_rs_dirujuk');
		if ($id_rs != null) $this->db->where('id_rs_dirujuk',$id_rs);
		return $this->db->get();
	}

	public function rujukan_type_total($id_rs = null,$type)
	{
		$this->db->from('tb_rujukan t')
		->join('tb_rs rs','rs.id_rs=t.id_rs_dirujuk')
		->where('t.type',$type)
		->where('rs.jenis','Rumah Sakit')
		->select('count(t.id_rujukan) total');
		if ($id_rs != null) $this->db->where('id_rs_dirujuk',$id_rs);
		return $this->db->get();
	}

	public function rujukan_status($id_rs = null,$type,$filter)
	{
		$this->db->from('tb_rujukan t')
		->join('tb_rs rs','rs.id_rs=t.id_rs_dirujuk')
		->where('t.status_rujukan',$type)
		->select('count(t.id_rujukan) total,t.id_rs_dirujuk')
		->group_by('t.id_rs_dirujuk')
		->where('rs.jenis','Rumah Sakit');
		if ($id_rs != null) $this->db->where('id_rs_dirujuk',$id_rs);
		if ($filter['tahun'] != null) $this->db->where('YEAR(dibuat)',$filter['tahun']);
		if ($filter['bulan'] != null) $this->db->where('MONTH(dibuat)',$filter['bulan']);
		return $this->db->get();
	}

	public function rujukan_monthly($id_rs = null,$filter)
	{
		$this->db->from('tb_rujukan t')
		->join('tb_rs rs','rs.id_rs=t.id_rs_dirujuk')
		->select('count(t.id_rujukan) total,MONTH(t.dibuat) bulan')
		->group_by('MONTH(t.dibuat)')
		->where('rs.jenis','Rumah Sakit');
		if ($filter['tahun'] != null) $this->db->where('YEAR(dibuat)',$filter['tahun']);
		if ($id_rs != null) $this->db->where('id_rs_dirujuk',$id_rs);
		return $this->db->get();
	}

	public function rujukan_daily($id_rs = null,$filter)
	{
		$this->db->from('tb_rujukan t')
		->join('tb_rs rs','rs.id_rs=t.id_rs_dirujuk')
		->select('count(t.id_rujukan) total,DAY(t.dibuat) hari')
		->group_by('DAY(t.dibuat)');
		if ($filter['tahun'] != null) $this->db->where('YEAR(dibuat)',$filter['tahun']);
		if ($filter['bulan'] != null) $this->db->where('MONTH(dibuat)',$filter['bulan']);
		$this->db->where('rs.jenis','Rumah Sakit');
		if ($id_rs != null) $this->db->where('id_rs_dirujuk',$id_rs);
		return $this->db->get();
	}

	public function rujukan_total($id_rs = null,$filter)
	{
		$this->db->from('tb_rujukan t')
		->join('tb_rs rs','rs.id_rs=t.id_rs_dirujuk')
		->select('count(t.id_rujukan) total')
		->where('rs.jenis','Rumah Sakit');
		if ($filter['tahun'] != null) $this->db->where('YEAR(dibuat)',$filter['tahun']);
		if ($filter['bulan'] != null) $this->db->where('MONTH(dibuat)',$filter['bulan']);
		if ($id_rs != null) $this->db->where('t.id_rs_dirujuk',$id_rs);
		return $this->db->get();
	}

	public function rujukan_jkel($id_rs = null,$gend,$filter)
	{
		$this->db->from('tb_rujukan t')
		->join('tb_rs rs','rs.id_rs=t.id_rs_dirujuk')
		->join('tb_pasien p','p.id_rm = t.no_rm')
		->select('count(t.id_rujukan) total')
		->where('p.jenis_kelamin',$gend)
		->where('rs.jenis','Rumah Sakit');
		if ($filter['tahun'] != null) $this->db->where('YEAR(dibuat)',$filter['tahun']);
		if ($filter['bulan'] != null) $this->db->where('MONTH(dibuat)',$filter['bulan']);
		if ($id_rs != null) $this->db->where('t.id_rs_dirujuk',$id_rs);

		return $this->db->get();
	}

	public function psc_total($filter)
	{
		if ($filter['tahun'] != null) $this->db->where('YEAR(tanggal_update)',$filter['tahun']);
		if ($filter['bulan'] != null) $this->db->where('MONTH(tanggal_update)',$filter['bulan']);
		return $this->db->get('tb_psc');
	}

	public function psc_kategori($filter)
	{
		$this->db->from('tb_psc');
		$this->db->join('tb_enum','tb_enum.value = tb_psc.kategori_psc');
		$this->db->select('count(tb_psc.id_psc) jml,tb_psc.kategori_psc');
		$this->db->group_by('tb_psc.kategori_psc,tb_enum.type_enum');
		$this->db->order_by('tb_enum.type_enum');
		if ($filter['tahun'] != null) $this->db->where('YEAR(tanggal_update)',$filter['tahun']);
		if ($filter['bulan'] != null) $this->db->where('MONTH(tanggal_update)',$filter['bulan']);
		return $this->db->get();
	}

	public function psc_kategori_sel()
	{
		$this->db->where('type_enum','kategori_psc');
		$this->db->order_by('type_enum');
		return $this->db->get('tb_enum');
	}
	
	public function psc_tahun($filter = null)
	{
		$this->db->from('tb_psc');
		$this->db->select('count(id_psc) jml,YEAR(tanggal_update) tahun');
		$this->db->group_by('YEAR(tanggal_update)');
		if ($filter['tahun'] != null) $this->db->where('YEAR(tanggal_update)',$filter['tahun']);
		if ($filter['bulan'] != null) $this->db->where('MONTH(tanggal_update)',$filter['bulan']);
		return $this->db->get();
	}

	public function get_puskesmas($id=null){
		$this->db->from('tb_rs')
		->join('tb_desa','tb_desa.id_rs = tb_rs.id_rs','left')
		->where('jenis','Puskesmas')
		->select('count(tb_desa.id_desa) jml, tb_rs.*')
		->group_by('tb_rs.id_rs')
		->order_by('tb_rs.nama,tb_rs.id_rs');
		if ($id != null) $this->db->where('tb_rs.id_rs',$id);
		return $this->db->get();
	}

	public function get_detail($tahun,$puskesmas)
	{
		return $this->db->from('tb_pwskia')
		->join('tb_desa','tb_desa.id_desa = tb_pwskia.id_desa')
		->where(['tb_pwskia.tahun' => $tahun,'tb_desa.id_rs' => $puskesmas])
		->select('
			sum(akses) akses,
			sum(murni) murni,
			sum(k4) k4,
			sum(linakes) linakes,
			sum(kf3) kf3,
			sum(kn1) kn1,
			sum(kn_lgkp) kn_lgkp,
			sum(masy) masy,
			sum(nakes) nakes,
			sum(bumil) bumil,
			sum(neo) neo,
			sum(bayi11) bayi11,
			sum(balita) balita,
			sum(ditangani) ditangani,
			sum(total_balita) total_balita,
			sum(kb_baru) kb_baru' 
		)->get();
	}

	public function target_bulan($tahun,$puskesmas)
	{
		return $this->db->from('tb_pwskia_target')
			->join('tb_desa','tb_desa.id_desa = tb_pwskia_target.id_desa')
			->select('(akses+murni+k4+linakes+kf3+kn1+kn_lgkp+masy+nakes+bumil+neo+bayi11+balita+ditangani+total_balita+kb_baru) total,bulan')
			->where(['tb_pwskia_target.tahun' => $tahun,'tb_desa.id_rs' => $puskesmas])->get();

	}

	public function data_bulan($tahun,$puskesmas)
	{
		return $this->db->from('tb_pwskia')
			->join('tb_desa','tb_desa.id_desa = tb_pwskia.id_desa')
			->select('(akses+murni+k4+linakes+kf3+kn1+kn_lgkp+masy+nakes+bumil+neo+bayi11+balita+ditangani+total_balita+kb_baru) total,bulan')
			->where(['tb_pwskia.tahun' => $tahun,'tb_desa.id_rs' => $puskesmas])->get();
	}

	public function data_bulan_ini($bulan,$tahun,$puskesmas)
	{
		return $this->db->from('tb_pwskia')
			->join('tb_desa','tb_desa.id_desa = tb_pwskia.id_desa')
			->select('tb_pwskia.*,tb_desa.id_desa')
			->where(['tb_pwskia.tahun' => $tahun,'tb_desa.id_rs' => $puskesmas,'tb_pwskia.bulan' => $bulan])->get();
	}
	
	public function data_bulan_ini_target($bulan,$tahun,$puskesmas)
	{
		return $this->db->from('tb_pwskia')
			->join('tb_desa','tb_desa.id_desa = tb_pwskia.id_desa')
			->select('tb_pwskia.*,tb_desa.id_desa')
			->where(['tb_pwskia.tahun' => $tahun,'tb_desa.id_rs' => $puskesmas,'tb_pwskia.bulan' => $bulan])->get();
	}

	public function data_kumulatif($puskesmas)
	{
		return $this->db->from('tb_pwskia')
			->join('tb_desa','tb_desa.id_desa = tb_pwskia.id_desa')
			->select('
				tb_desa.id_desa,
				sum(tb_pwskia.akses) akses,
				sum(tb_pwskia.murni) murni,
				sum(tb_pwskia.k4) k4,
				sum(tb_pwskia.linakes) linakes,
				sum(tb_pwskia.kf3) kf3,
				sum(tb_pwskia.kn1) kn1,
				sum(tb_pwskia.kn_lgkp) kn_lgkp,
				sum(tb_pwskia.masy) masy,
				sum(tb_pwskia.nakes) nakes,
				sum(tb_pwskia.bumil) bumil,
				sum(tb_pwskia.neo) neo,
				sum(tb_pwskia.bayi11) bayi11,
				sum(tb_pwskia.balita) balita,
				sum(tb_pwskia.ditangani) ditangani,
				sum(tb_pwskia.total_balita) total_balita,
				sum(tb_pwskia.kb_baru) kb_baru,
				tb_desa.id_desa')
			->group_by('tb_desa.id_desa')
			->where(['tb_desa.id_rs' => $puskesmas])->get();
	}

	public function data_kumulatif_target($puskesmas)
	{
		return $this->db->from('tb_pwskia_target')
			->join('tb_desa','tb_desa.id_desa = tb_pwskia_target.id_desa')
			->select('
				tb_desa.id_desa,
				sum(tb_pwskia_target.akses) akses,
				sum(tb_pwskia_target.murni) murni,
				sum(tb_pwskia_target.k4) k4,
				sum(tb_pwskia_target.linakes) linakes,
				sum(tb_pwskia_target.kf3) kf3,
				sum(tb_pwskia_target.kn1) kn1,
				sum(tb_pwskia_target.kn_lgkp) kn_lgkp,
				sum(tb_pwskia_target.masy) masy,
				sum(tb_pwskia_target.nakes) nakes,
				sum(tb_pwskia_target.bumil) bumil,
				sum(tb_pwskia_target.neo) neo,
				sum(tb_pwskia_target.bayi11) bayi11,
				sum(tb_pwskia_target.balita) balita,
				sum(tb_pwskia_target.ditangani) ditangani,
				sum(tb_pwskia_target.total_balita) total_balita,
				sum(tb_pwskia_target.kb_baru) kb_baru,
				tb_desa.id_desa')
			->group_by('tb_desa.id_desa')
			->where(['tb_desa.id_rs' => $puskesmas])->get();
	}


	public function get_desa($id)
	{
		return $this->db->where('id_rs',$id)->get('tb_desa');
	}

}
