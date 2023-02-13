<?php

class Dashboard_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function rs($n = null)
	{
		$this->db->select('id_rs,nama,jenis');
		$this->db->order_by('jenis,nama');
		if ($n != null) $this->db->like('nama',$n);

		return $this->db->get('tb_rs');
	}

	public function allresume($where,$waktu,$select)
	{
		$this->db->where($where);
		$this->db->where($waktu,null,false);
		$this->db->select($select);
		return $this->db->get('tb_rujukan');
	}


	public function rujukanaktif($where,$waktu,$select)
	{
		$this->db->from('tb_rujukan');
		$this->db->where('status_rujukan', 'Diterima');
		//$this->db->where('rujukbalik_status','Batal', false);
		$this->db->where('rujukbalik_status IS NULL',null, true);
		$this->db->where($waktu,null,true);
		$this->db->select('count(id_rujukan) total');
		return $this->db->get();
	}

	public function riil($where,$waktu,$select)
	{
		$this->db->from('tb_rujukan');
		$this->db->where('status_rujukan', 'Diterima');
		//$this->db->where('rujukbalik_status IS NULL', null, true);
		//$this->db->where_not_in('rujukbalik_status',array('Pulang'));
		$this->db->where_in('rujukbalik_status',array('','Masih dirawat','Pulang','Meninggal Dunia'));
		$this->db->where($waktu,null,false);
		$this->db->select('count(id_rujukan) total');
		return $this->db->get();
	}
	
	public function estafet($where,$waktu,$select)
	{
		$this->db->from('tb_rujukan');
		//$this->db->where('status_rujukan', 'Diterima');
		//$this->db->where('rujukbalik_status','Batal', false);
		$this->db->where('id_rs_pengalih IS NOT NULL',null, true);
		$this->db->where($waktu,null,true);
		$this->db->select('count(id_rujukan) total');
		return $this->db->get();
	}	
	
	public function poli($waktu)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_layanan_type','tb_rujukan.id_jenis_layanan = tb_layanan_type.id_jenis_layanan');
		$this->db->like('tb_layanan_type.nama','poli');
		$this->db->where($waktu,null,false);
		$this->db->select('count(id_rujukan) total');
		return $this->db->get();
	}

	//public function konsul($waktu)
	//{
	//	$this->db->from('tb_konsultasi');
	//	$this->db->where($waktu,null,false);
	//	$this->db->select('count(kon_id) total');
	//	return $this->db->get();
	//}

	public function penyakit($kode,$waktu)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_icdx','tb_icdx.kode = tb_rujukan.ibuanak_icdx');
		$this->db->where_in('tb_icdx.kode',$kode);
		$this->db->where($waktu,null,false);
		$this->db->group_by('tb_icdx.kode');
		$this->db->select('count(id_rujukan) total,tb_icdx.keterangan icdx');
		$this->db->order_by('total','desc');
		return $this->db->get();
	}

	public function penyakit_rs($kode,$waktu)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_icdx','tb_icdx.kode = tb_rujukan.ibuanak_icdx');
		$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk');
		$this->db->where_in('tb_icdx.kode',$kode);
		$this->db->where($waktu,null,false);
		$this->db->group_by('tb_rs.nama');
		$this->db->select('count(id_rujukan) total,tb_rs.nama rs');
		$this->db->order_by('total','desc');
		return $this->db->get();
	}

	public function kasus4($kode,$waktu)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_icdx','tb_icdx.kode = tb_rujukan.ibuanak_icdx');
		$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk');
		$this->db->where_in('tb_icdx.kode',$kode);
		$this->db->where($waktu,null,false);
		$this->db->where("(LOWER(tb_rs.nama) LIKE 'rs%' or LOWER(tb_rs.nama) LIKE 'rumah sakit%')");
		$this->db->select("
		case
		when tb_icdx.kode = 'O13' or tb_icdx.kode = 'O14.0' or tb_icdx.kode = 'O14.1' or tb_icdx.kode = 'O14.9' then 'Pre Eklamsia'
		when tb_icdx.kode = 'O15.0' or tb_icdx.kode = 'O15.1' or tb_icdx.kode = 'O15.2' then 'Eklampsia'
		when tb_icdx.kode = 'O44.0' or tb_icdx.kode = 'O44.1' or tb_icdx.kode = 'O46' then 'HAP'
		when tb_icdx.kode = 'O72' or tb_icdx.kode = 'O72.0' or tb_icdx.kode = 'O72.2' or tb_icdx.kode = 'O73.0' then 'HPP'
		end as sakit, count(id_rujukan) jumlah, tb_rs.nama rs");
		$this->db->group_by('sakit, rs');
		//$this->db->order_by('sakit','desc');
		$this->db->order_by('jumlah desc');
		return $this->db->get();
	}

	public function pemgso4($waktu,$type)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_icdx','tb_icdx.kode = tb_rujukan.ibuanak_icdx','left');
		$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk');
		$this->db->where($waktu,null,false);
		$this->db->where("(LOWER(tb_rs.nama) LIKE 'rs%' or LOWER(tb_rs.nama) LIKE '%rumah sakit%')");
		if ($type == 1)
		{
		$this->db->select("
		case
		when tb_icdx.kode = 'O13' or tb_icdx.kode = 'O14.0' or tb_icdx.kode = 'O14.1' or tb_icdx.kode = 'O14.9' or LOWER(tb_rujukan.diagnosis) LIKE '%peb%' then 'Pre Eklamsia'
		when tb_icdx.kode = 'O15.0' or tb_icdx.kode = 'O15.1' or tb_icdx.kode = 'O15.2' or LOWER(tb_rujukan.diagnosis) LIKE '%eklam%'  then 'Eklampsia'
		end as sakit, count(id_rujukan) jumlah, tb_rs.nama rs");
		} else {
			$this->db->select("
				case when LOWER(tb_rujukan.tindakan) LIKE '%mgso4%' then 'MGSO4'
				end as sakit, count(id_rujukan) jumlah, tb_rs.nama rs");
		}
		$this->db->group_by('sakit, rs');
		//$this->db->order_by('sakit','desc');
		$this->db->order_by('jumlah desc');
		return $this->db->get();
	}

	public function media($waktu)
	{
		$this->db->where($waktu,null,false);
		$this->db->select('media,count(id_rujukan) jumlah');
		$this->db->group_by('media');
		return $this->db->get('tb_rujukan');
	}

	public function transportasi($waktu)
	{
		$this->db->where($waktu,null,false);
		$this->db->select('transportasi,count(id_rujukan) jumlah');
		$this->db->group_by('transportasi');
		return $this->db->get('tb_rujukan');
	}

	public function biaya($where)
	{
		$this->db->where($where,null,false);
		$this->db->select('count(id_rujukan) total, pembiayaan');
		$this->db->group_by('pembiayaan');
		return $this->db->get('tb_rujukan');
	}

	public function respon($where)
	{
		$this->db->from('tb_rujukan');
		$this->db->where($where,null,false);
		$this->db->where('direspon IS NOT NULL',null, false);
		$this->db->select("
		case
		when TIME_TO_SEC(timediff(direspon,dibuat)) <= 86400 then 'Kurang dari 10 Menit'
		when TIME_TO_SEC(timediff(direspon,dibuat)) <= 1800 and TIME_TO_SEC(timediff(direspon,dibuat)) > 600 then '10 - 30 Menit'
		when TIME_TO_SEC(timediff(direspon,dibuat)) <= 3600 and TIME_TO_SEC(timediff(direspon,dibuat)) > 1800 then '0.5 - 1 jam'
		when TIME_TO_SEC(timediff(direspon,dibuat)) <= 43200 and TIME_TO_SEC(timediff(direspon,dibuat)) > 3600 then '1 - 12 jam'
		when TIME_TO_SEC(timediff(direspon,dibuat)) <= 86400 and TIME_TO_SEC(timediff(direspon,dibuat)) > 43200 then '12 - 24 jam'
		when TIME_TO_SEC(timediff(direspon,dibuat)) > 86400 then 'Lebih dari 1 hari'
		end as label,count(id_rujukan) jumlah,TIME_TO_SEC(timediff(direspon,dibuat))");
		//$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk');
		$this->db->group_by('label');
		//$this->db->order_by('respon asc');

		return $this->db->get();
	}

	public function gol_darah($where)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_pasien','tb_pasien.id_rm = tb_rujukan.no_rm');
		$this->db->where($where,null,false);
		//$this->db->where('direspon IS NOT NULL',null, false);
		$this->db->select("tb_pasien.goldarah,count(id_rujukan) jumlah");
		$this->db->where_in('goldarah',array('A','AB','B','O','-'));
		$this->db->group_by('goldarah');
		return $this->db->get();
	}

	public function no_respon($where)
	{
		$this->db->from('tb_rujukan');
		$this->db->where($where,null,false);
		$this->db->where('direspon IS NULL',null, false);
		$this->db->select("count(id_rujukan) jumlah");

		return $this->db->get();
	}

	public function rujukan($waktu,$type)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk');
		$this->db->where($waktu,null,false);
		switch ($type) {
			case 1: $this->db->where("(LOWER(tb_rs.nama) LIKE 'rs%' or LOWER(tb_rs.nama) LIKE 'rumah sakit%')"); break;
			case 2: $this->db->where("(LOWER(tb_rs.nama) LIKE 'rs%' or LOWER(tb_rs.nama) LIKE 'rumah sakit%') and (lower(rujukbalik_status) like '%pulang%' or lower(rujukbalik_status) like '%meninggal%')"); break;
			case 3: $this->db->where("(LOWER(tb_rs.nama) LIKE 'rs%' or LOWER(tb_rs.nama) LIKE 'rumah sakit%') and (lower(rujukbalik_status) like '%batal%')"); break;
		}

		$this->db->select("tb_rs.nama rs,count(id_rujukan) jumlah");
		$this->db->group_by('tb_rujukan.id_rs_dirujuk');
		$this->db->order_by('jumlah desc');
		return $this->db->get();
	}

	public function perujuk($waktu)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_perujuk');
		$this->db->where($waktu,null,false);
		$this->db->select("tb_rs.nama rs,count(id_rujukan) jumlah");
		$this->db->group_by('tb_rujukan.id_rs_perujuk');
		$this->db->order_by('jumlah desc');
		$this->db->limit(60)->offset(0);
		return $this->db->get();
	}

	public function jenis_kasus($waktu)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk');
		$this->db->where($waktu,null,false);
		$this->db->select("type, count(id_rujukan) jumlah");
		$this->db->group_by('type');
		$this->db->order_by('jumlah desc');
		return $this->db->get();
	}

	public function type_kasus($waktu,$type)
	{
		$this->db->from('tb_rujukan');
		$this->db->join('tb_icdx','tb_icdx.kode = tb_rujukan.ibuanak_icdx');
		$this->db->where($waktu,null,false);
		$this->db->where('tb_rujukan.type',$type);
		$this->db->select('count(id_rujukan) jumlah,tb_icdx.keterangan icdx');
		$this->db->group_by('icdx');
		$this->db->order_by('jumlah desc');
		return $this->db->get();
	}

	public function matneo($waktu,$type)
	{
		$kode = array("O03","O06","O13","O14.0","O14.1","O14.9","O15.0","O15.1","O15.2","O20","O20.0","O30.0","O30.1","O42.9","O44.0","O44.1","O46","O47","O48","O60","O63.0","O63.1","O64","O64.1","O65","O66.2","O68","O68.1","O69.1","O72","O72.0","O72.2","O73.0","O80.9","O82.0","O86",
	"O40","O41.0","O88.1","O99.0","O98.0","O98.1","O98.4","O71.2","O70","O71.7","O00","O01","O02.0","O21","O22.4","O25","O26.0","O24","O36.4","O36.5","O61","O62","O90.0","O98","O99.5",
"P07.0","P07.2","P07.3","P21","P21.0","P21.1","P21.9","P22.0","P23","P24","P24.0","P57","P80","P81","P91.5");
		$this->db->from('tb_rujukan');
		$this->db->join('tb_icdx','tb_icdx.kode = tb_rujukan.ibuanak_icdx');
		$this->db->where($waktu,null,false);
		$this->db->where_in('tb_icdx.kode',$kode);
		if ($type == 1) $this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk'); // Rujukan
		if ($type == 2) $this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_pengalih'); // Pengalihan Rujukan
		if ($type == 3) {
			$this->db->join('tb_rs','tb_rs.id_rs = tb_rujukan.id_rs_dirujuk');
			$this->db->where('tb_rujukan.rujukbalik_diagnosa'); // Rujuk Balik Diagnosa / Advis Medis
		}

		$this->db->where("(LOWER(tb_rs.nama) LIKE 'rs%' or LOWER(tb_rs.nama) LIKE 'rumah sakit%')");
		$this->db->select('count(id_rujukan) jumlah');
		$this->db->order_by('jumlah desc');
		return $this->db->get();
	}

}
