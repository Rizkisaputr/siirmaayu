<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
	public function __construct($config = 'rest')
	{
		parent::__construct($config);
	}

	public function index()
	{
		$this->load->model('api_model');
		$message = null;
		$status = 1;
		$error = array();
		$saved = 0;
		$unsaved = 0;

		$data = json_decode(file_get_contents('php://input'), true);

		if (!$this->ion_auth->login($data['email'], $data['password']))
		{
			$message = "Autentifikasi gagal";
			$status = 0;
		} else {

			if (isset($data['fungsi']) and $data['fungsi'] != null)
			{
				$this->load->model('User_model');
				$rs = $this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
				switch($data['fungsi'])
				{
					case 'bed':

					if (count($data['data']) > 0)
					{
						foreach($data['data'] as $n)
						{
						$kelas = $this->api_model->kelas($n['kelas']);
							if ($kelas->num_rows() > 0)
							{
								$saved += 1;

								$check_bed = $this->api_model->cek_bed(array(
								'id_rs' => $rs[0],
								'nama' => $n['bed'],
								'kelas' => $kelas->row()->id_kelas_bed));

								$simpan_bed = array(
									'id_rs' => $rs[0],
									'nama' => $n['bed'],
									'kapasitas_l' => $n['kapasitas_l'],
									'terpakai_l' => $n['terpakai_l'],
									'kapasitas_p' => $n['kapasitas_p'],
									'terpakai_p' => $n['terpakai_p'],
									'kelas' => $kelas->row()->id_kelas_bed
								);

								if ($check_bed->num_rows() > 0)
								{
									$this->api_model->update_bed($check_bed->row()->id_bed,$simpan_bed);
								} else {
									$this->api_model->insert_bed($simpan_bed);
								}
							} else {
								$unsaved += 1;
								$error[] = "Kelas ".$n[5]." tidak terindentifikasi sistem";
							}
						}

					}
					break;

					case 'stok_darah':

					if (count($data['data']) > 0)
					{
						foreach($data['data'] as $n)
						{
							$saved += 1;
							foreach(array("A","B","AB","O") as $s)
							{
							$check_stok_darah = $this->api_model->cek_stok_darah(array(
								'id_rs' => $rs[0],
								'gol_darah' => $s));

								$simpan_stok_darah = array(
									'id_rs' => $rs[0],
									'gol_darah' => $s,
									'stok' => $n[$s],
								);

								if ($check_stok_darah->num_rows() > 0)
								{
									$this->api_model->update_stok_darah($check_stok_darah->row()->id_stok_darah,$simpan_stok_darah);
								} else {
									$this->api_model->insert_stok_darah($simpan_stok_darah);
								}
							}
						}
					}

					break;

					case 'dokter':

						if (count($data['data']) > 0)
						{

							foreach($data['data'] as $n)
										{
							$check_dokter = $this->api_model->check_dokter(array('nama' => $n['nama'], 'no_idi' => $n['no_idi']));
							$saver = array(
								'id_rs' => $rs[0],
								'nama' => $n['nama'],
								'no_idi' => $n['no_idi'],
								'bidang' => $n['bidang'],
								'spesialis' => $n['spesialis']
							);

							if ($check_dokter->num_rows() > 0) $this->api_model->dokter($saver,$check_dokter->row()->id_dokter);
							else $this->api_model->dokter($saver);
							}

						}


					break;
				}

				$message = ($unsaved > 0) ? "Data berhasil disimpan dengan beberapa catatan" : "Data berhasil disimpan";
				$status = 1;

			} else {

				$rs = $this->api_model->rs($data['data']['rs']);
				if ($rs->num_rows() == 0)
				{
					$message = "Data RS tidak ditemukan";
					$status = 0;
				} else {
					if (count($data['data']['bed']) > 0)
					{
						$this->api_model->init($rs->row()->id_rs);
						foreach($data['data']['bed'] as $n)
						{
							$kelas = $this->api_model->kelas($n[5]);
							if ($kelas->num_rows() > 0)
							{
								$saved += 1;

								$check_bed = $this->api_model->cek_bed(array(
								'id_rs' => $rs->row()->id_rs,
								'nama' => $n[0],
								'kelas' => $kelas->row()->id_kelas_bed));

								$simpan_bed = array(
									'id_rs' => $rs->row()->id_rs,
									'nama' => $n[0],
									'kapasitas_l' => $n[1],
									'terpakai_l' => $n[2],
									'kapasitas_p' => $n[3],
									'terpakai_p' => $n[4],
									'kelas' => $kelas->row()->id_kelas_bed);

								if ($check_bed->num_rows() > 0)
								{
									$this->api_model->update_bed($check_bed->row()->id_bed,$simpan_bed);
								} else {
									$this->api_model->insert_bed($simpan_bed);
								}

							} else {
								$unsaved += 1;
								$error[] = "Kelas ".$n[5]." tidak terindentifikasi sistem";
							}
						}

					}
					$message = ($unsaved > 0) ? "Data berhasil disimpan dengan beberapa catatan" : "Data berhasil disimpan";
					$status = 1;
				}
			}
		}

		die(json_encode(array(
			'status' => $status,
			'message' => $message,
			'saved' => array(
				'ok' => $saved,
				'fail' => $unsaved,
				'error' => $error
				)
		)));
	}

	public function example()
	{
		$data['title'] = 'Example';
		render_back('pages.api.example',$data);
	}

	public function brute()
	{
		/*
		$kode = array("A15","A18","A30","A33","A35","A37.9","A53.9","A54.9","A90","A91","A92.0","B01.9","B15","B16","B20.0","D55","D56","I21.9","I50.9","I63.9","J01","J03.9","J18.0","J18.9","J20.9","J35.9","J40","J44.9","J45","J69.0","K29","L27.2","M32","N03","R.09.0","R57.9","T62.2","Z21");

		$this->db->from('tb_icdx');
		$this->db->where_in('tb_icdx.kode',$kode);
		$aa = $this->db->get();
		$kk = array();
		foreach ($aa->result() as $no => $j) {
			$kk[] = $j->id_icdx;
		}
		$this->db->where('id_icdx IS NOT NULL',null,false);
		$e = $this->db->get('tb_rujukan');
		foreach($e->result() as $a)
		{
			$this->db->where('id_rujukan',$a->id_rujukan);
			$this->db->update('tb_rujukan',array('id_icdx' => $kk[rand(1,36)]));
			//echo  $kk[rand(0,36)].'<br>';
		}
*/

		$awal = 1;
		$dw = rand($awal+10,$awal+500);
		$up = rand($awal+10,$awal+500);

		if ($dw > $up) {
			$bawah = $up; $atas = $dw;
		} else {
			$bawah = $dw; $atas = $up;
		}


$kode = array("O40","O41.0","O88.1","O99.0","O98.0","O98.1","O98.4","O71.2","O70","O71.7","O00","O01","O02.0","O21","O22.4","O25","O26.0","O24","O36.4","O36.5","O61","O62","O90.0","O98","O99.5");
		//$kode = array("O14.0","O12.1","O12.2","014","O14.9","O14.0","O14.1","O13","O14.4","O15.0","O15.1","O15.2","O63.1","O63.0","O66.2","O65","O69.1","O42.9","O68.1","O82.0","O46","O44.1","O44.0","O73.0","O72.0","O72.2","O72","O47","O60","O48","O64.1","O64","O06.4","O20","O20.0","O03.9","O30.0","O68","O86","O30.1","O80.9","O40","O41.0","O88.1","O99.0","O98.0","O98.1","O98.4","O71.2","O70","O71.7","O00","O01","O02.0","O21","O22.4","O25","O26.0","O24","O36.4","O36.5","O61","O62","O90.0","O98","O99.5");

		$this->db->from('tb_icdx');
		$this->db->where_in('tb_icdx.kode',$kode);
		$aa = $this->db->get();

		echo $aa->num_rows();

		foreach($aa->result() as $a)
		{
			$dw = rand($awal,$awal+(rand(200,500)));
			$up = rand($awal,$awal+(rand(200,500)));

			if ($dw > $up) {
				$bawah = $up; $atas = $dw;
			} else {
				$bawah = $dw; $atas = $up;
			}
			if ($awal < 11000)
			{
				$this->dds($a->kode.' '.$awal.' '.$bawah);
				$this->db->where("id_rujukan > ".$awal." AND id_rujukan < ".$bawah,null,false);
				$this->db->update('tb_rujukan',array('id_icdx' => $a->id_icdx));
				$awal = $atas;

			}
		}

	}

	public function dashboard($type) {
		$this->load->model('dashboard_model');

		$whereTgl = null; $whereFaskes = null;

		$tgl = $this->input->get('waktu');
		$faskes = $this->input->get('rujukan');
		$perujuk = $this->input->get('perujuk');
		if ($tgl != null)
		{
		if (substr($tgl,5,2) == '00') $whereTgl = "YEAR(dibuat) = '".substr($tgl,0,4)."'";
		else {
			$bln = substr($tgl,5,2);
			$thn = substr($tgl,0,4);
			$whereTgl = "MONTH(dibuat) = '".$bln."' AND YEAR(dibuat) = '".$thn."'";
		}
		}

		if ($faskes != null) $whereFaskes = ' AND id_rs_dirujuk = '.$faskes;
		if ($perujuk != null) $whereFaskes = ' AND id_rs_perujuk = '.$perujuk;

		switch($type) {
			case "faskes":
			 $rs = $this->dashboard_model->rs($this->input->get('search'));
			 die(json_encode($rs->result()));
			break;

			case "resume":
				$whereSet = $whereTgl.$whereFaskes;
				$total = $this->dashboard_model->allresume(
					array(),$whereSet,'count(id_rujukan) total')->row();
				$riil = $this->dashboard_model->riil(
					array('status_rujukan' => 'Diterima'),$whereSet,'count(id_rujukan) total')->row();
                //$estafet = $this->dashboard_model->allresume(
				//	array('id_rs_pengalih' => '1' or '2' or '3' or '4' or '5' or '6' or '8' or '9' or '10' or '11' or '12' or '13' or '14' or '15' or '16' or '17' or '18' or '19' or '20' or '57' or '68' or '72' or '106' or '107' or '108' or '109'),$whereSet,'count(id_rujukan) total')->row();
				
				$estafet = $this->dashboard_model->estafet(
					array('status_rujukan' => 'Diterima'),$whereSet,'count(id_rujukan) total')->row();
					
				$poli = $this->dashboard_model->poli($whereSet)->row();

				$batal = $this->dashboard_model->allresume(
					array('rujukbalik_status' => 'Batal'),$whereSet,'count(id_rujukan) total')->row();
				$meninggal = $this->dashboard_model->allresume(
					array('rujukbalik_status' => 'Meninggal Dunia'),$whereSet,'count(id_rujukan) total')->row();
				$pulang = $this->dashboard_model->allresume(
					array('rujukbalik_status' => 'Pulang'),$whereSet,'count(id_rujukan) total')->row();
				$dikembalikan = $this->dashboard_model->allresume(
					array('status_rujukan' => 'Ditolak'),$whereSet,'count(id_rujukan) total')->row();
			//	$konsul = $this->dashboard_model->konsul($whereTgl.($faskes != null?' AND rs_id = '.$faskes:null))->row();
                $konsul = $this->dashboard_model->allresume(
					array('type' => '6'),$whereSet,'count(id_rujukan) total')->row();
					
		 		die(json_encode(array(
					'total' => $total->total,
					'riil' => $riil->total,
					'poli' => $poli->total,
					'batal' => $batal->total,
					'meninggal' => $meninggal->total,
					'pulang' => $pulang->total,
					'estafet' => $estafet->total,
					'dikembalikan' => $dikembalikan->total,
					'konsultasi' => $konsul->total
				)));
			break;

			case "maternal":
				$whereSet = $whereTgl.$whereFaskes;
				$penyakit = array("O03","O06","O13","O14.0","O14.1","O14.9","O15.0","O15.1","O15.2","O20","O20.0","O30.0","O30.1","O42.9","O44.0","O44.1","O46","O47","O48","O60","O63.0","O63.1","O64","O64.1","O65","O66.2","O68","O68.1","O69.1","O72","O72.0","O72.2","O73.0","O80.9","O82.0","O86");
				$ek = $this->dashboard_model->penyakit($penyakit,$whereSet);
				$label = array(); $data = array();

				foreach($ek->result() as $e){ $label[] = $e->icdx; $data[] = $e->total; }
				die(json_encode(array(
					'label' => $label,
					'data' => $data)));
			break;

			case "maternal_lainnya":
				$whereSet = $whereTgl.$whereFaskes;
				$penyakit = array("O40","O41.0","O88.1","O99.0","O98.0","O98.1","O98.4","O71.2","O70","O71.7","O00","O01","O02.0","O21","O22.4","O25","O26.0","O24","O36.4","O36.5","O61","O62","O90.0","O98","O99.5");
				$ek = $this->dashboard_model->penyakit($penyakit,$whereSet);
				$label = array(); $data = array();

				foreach($ek->result() as $e){ $label[] = $e->icdx; $data[] = $e->total; }
				die(json_encode(array(
					'label' => $label,
					'data' => $data)));
			break;

			case "kasus_terbanyak":
				$whereSet = $whereTgl.$whereFaskes;
				$penyakit = array("A15","A18","A30","A33","A35","A37.9","A53.9","A54.9","A90","A91","A92.0","B01.9","B15","B16","B20.0","D55","D56","I21.9","I50.9","I63.9","J01","J03.9","J18.0","J18.9","J20.9","J35.9","J40","J44.9","J45","J69.0","K29","L27.2","M32","N03","R.09.0","R57.9","T62.2","Z21");
				$ek = $this->dashboard_model->penyakit($penyakit,$whereSet);
				$label = array(); $data = array();

				foreach($ek->result() as $e){ $label[] = $e->icdx; $data[] = $e->total; }
				die(json_encode(array(
					'label' => $label,
					'data' => $data)));
			break;

			case "maternal_rs":

				$whereSet = $whereTgl.$whereFaskes;
				$penyakit = array("O14.0","O14.1","O13","O14.4","O15.0","O15.1","O15.2","O46","O44.1","O44.0","O73.0","O72.0","O72.2","O72");
				$ek = $this->dashboard_model->penyakit_rs($penyakit,$whereSet);
				$label = array(); $data = array();

				foreach($ek->result() as $e){ $label[] = $e->rs; $data[] = $e->total; }
				die(json_encode(array(
					'label' => $label,
					'data' => $data)));
			break;

			case "neonatal":

				$whereSet = $whereTgl.$whereFaskes;
				$penyakit = array("P07.0","P07.2","P07.3","P21","P21.0","P21.1","P21.9","P22.0","P23","P24","P24.0","P57","P80","P81","P91.5");
				$ek = $this->dashboard_model->penyakit($penyakit,$whereSet);
				$label = array(); $data = array();

				foreach($ek->result() as $e){ $label[] = $e->icdx; $data[] = $e->total; }
				die(json_encode(array(
					'label' => $label,
					'data' => $data)));
			break;

			case "perujuk":

				$whereSet = $whereTgl.$whereFaskes;
				$ek = $this->dashboard_model->perujuk($whereSet);
				$label = array(); $data = array();

				foreach($ek->result() as $e){ $label[] = $e->rs; $data[] = $e->jumlah; }
				die(json_encode(array(
					'label' => $label,
					'data' => $data)));
			break;

			case "kasus4":

				$whereSet = $whereTgl.$whereFaskes;
				$penyakit = array("O13","O14.0","O14.1","O14.9","O15.0","O15.1","O15.2","O44.0","O44.1","O46","O72","O72.0","O72.2","O73.0");
				$ek = $this->dashboard_model->kasus4($penyakit,$whereSet);


				$data = array(); $label = array(); $sakit = array(); $temp = array();
				foreach($ek->result() as $e) {
					if (!in_array($e->sakit,$sakit)) $sakit[] = $e->sakit;
					if (!in_array($e->rs,$label)) $label[] = $e->rs;
					$temp[$e->sakit][$e->rs] = $e->jumlah;
				}

				foreach($label as $l)
				{
						foreach($sakit as $s)
						{
							$jml = 0;
							if (isset($temp[$s][$l])) $jml = $temp[$s][$l];
							$data[$s][] = $jml;
						}
				}

				die(json_encode(array(
					'label' => $label,
					'data' => $data),JSON_NUMERIC_CHECK));
			break;

			case "pemgso4":

				$whereSet = $whereTgl.$whereFaskes;
				$pee = $this->dashboard_model->pemgso4($whereSet,1);
				$mgso4 = $this->dashboard_model->pemgso4($whereSet,2);
				//echo $this->db->last_query();

				$data = array(); $label = array(); $sakit = array(); $temp = array();
				foreach($pee->result() as $e) {
					if (!in_array($e->sakit,$sakit)) $sakit[] = $e->sakit;
					if (!in_array($e->rs,$label) and $e->sakit != null) $label[] = $e->rs;
					$temp[$e->sakit][$e->rs] = $e->jumlah;
				}

				foreach($mgso4->result() as $e) {
					if (!in_array($e->sakit,$sakit)) $sakit[] = $e->sakit;
					if (!in_array($e->rs,$label) and $e->sakit != null) $label[] = $e->rs;
					$temp[$e->sakit][$e->rs] = $e->jumlah;
				}

				foreach($label as $l)
				{
						foreach($sakit as $s)
						{
							$jml = 0;
							if (isset($temp[$s][$l])) $jml = $temp[$s][$l];
							$data[$s][] = $jml;
						}
				}

				die(json_encode(array(
					'label' => $label,
					'data' => $data),JSON_NUMERIC_CHECK));
			break;

			case "media":
			$whereSet = $whereTgl.$whereFaskes;
			$med = array('Tanpa CC', 'Telpon CC', 'Dispatch NCC', 'SMS', 'Whatsapp', 'Whatsapp Gateway','Web', 'Android', 'Lainnya');
			$set = array(); $lainnya = 0;
			foreach($this->dashboard_model->media($whereSet)->result() as $d)
			{
				$set[$d->media] = $d->jumlah;
				if (!in_array($d->media,$med)) $lainnya+=$d->jumlah;
			}

			$label = array(); $data = array();
			foreach($med as $b)
			{
				$label[] = $b;
				if ($b == 'Lainnya') $data[] = $lainnya;
				else $data[] = (isset($set[$b])) ? $set[$b] : 0;
			}

			die(json_encode(array(
				'label' => $label,
				'data' => $data),JSON_NUMERIC_CHECK));
			break;

			case "gol_darah":
			$whereSet = $whereTgl.$whereFaskes;
			$goldarah = array('A' => 0,'AB' => 0,'B' => 0,'O' => 0);
			foreach($this->dashboard_model->gol_darah($whereSet)->result() as $d)
			{
					if (in_array($d->goldarah,$goldarah)) $goldarah[$d->goldarah] = $d->jumlah;
			}

			$label = array(); $data = array();
			foreach($goldarah as $a => $b)
			{
				$label[] = $a; $data[] = $b;
			}

			die(json_encode(array(
				'label' => $label,
				'data' => $data),JSON_NUMERIC_CHECK));
			break;

			case "transportasi":
			$whereSet = $whereTgl.$whereFaskes;
			$trans = array(
          'mobil_pribadi' => 'Mobil Pribadi',
          'ambulance' => 'Ambulance',
          'ambulan' => 'Ambulan',
          'ambulan_umum' => 'Ambulan Umum',
          'ambulan_desa' => 'Ambulan Desa',
          'ambulan_maternal' => 'Ambulan Maternal',
          'ambulan_neonatal' => 'Ambulan Neonatal',
          'becak_roda_3' => 'Becak / Roda 3',
          'angkot' => 'Angkot',
          'lainnya' => 'Lainnya'
      );
			$set = array();
			foreach($this->dashboard_model->transportasi($whereSet)->result() as $d)
			{
					$set[$d->transportasi] = $d->jumlah;
			}

			$label = array(); $data = array();
			foreach($trans as $a => $b)
			{
				$label[] = $b;
				$data[] = (isset($set[$b])) ? $set[$b] : 0;
			}

			die(json_encode(array(
				'label' => $label,
				'data' => $data),JSON_NUMERIC_CHECK));
			break;

			case "biaya":
			$whereSet = $whereTgl.$whereFaskes;
			$biaya = array(
            'Belum diketahui',
            'Jasa Raharja',
            'Asuransi Swasta',
            'BPJS Mandiri kelas 3',
            'BPJS Mandiri kelas 2',
            'Tunai / Mandiri / Umum',
            'Tidak ada jaminan / tidak mampu',
            'BPJS Mandiri kelas 1',
            'BPJS PPBU Perusahaan Kelas 1',
            'BPJS PPBU Perusahaan Kelas 2',
            'BPJS PPBU Perusahaan Kelas 3',
            'Rencana BPJS',
            'KIS / Jamkesmas',
            'Jamkesda',
            'BPJS PBI kelas 3',
            'DSP / Dana Covid'
			);

			$set = array(); $lainnya = 0;
			foreach($this->dashboard_model->biaya($whereSet)->result() as $b)
			{
				if (in_array($b->pembiayaan,$biaya)) $set[$b->pembiayaan] = $b->total;
				else $lainnya+=$b->total;
			}

			arsort($set);
			$set['Lainnya'] = $lainnya;

			$label = array(); $data = array();
			foreach($set as $a => $b)
			{
				$label[] = $a; $data[] = $b;
			}

			die(json_encode(array(
				'label' => $label,
				'data' => $data
			)));
			break;

			case "respon":
				$whereSet = $whereTgl.$whereFaskes;
				$labely = array(
					'Kurang dari 10 Menit' => 0,
					'10 - 30 Menit' => 0,
					'0.5 - 1 jam' => 0,
					'1 - 12 jam' => 0,
					'12 - 24 jam' => 0,
					'Lebih dari 1 hari' => 0,
					'Belum direspon' => 0);
				$label = array(); $data = array();
				foreach($this->dashboard_model->respon($whereSet)->result() as $b)
				{
					if (in_array($b->label,$labely)) $labely[$b->label] = $b->jumlah;
				}


				foreach($this->dashboard_model->no_respon($whereSet)->result() as $b)
				{
					$labely['Belum direspon'] = $b->jumlah;
				}

				foreach($labely as $a => $b)
				{
						$label[] = $a;
						$data[] = $b;
				}

				die(json_encode(array(
					'label' => $label,
					'data' => $data
				)));

			break;

			case "rujukanbalik":

				$whereSet = $whereTgl.$whereFaskes;
				$rujuk = $this->dashboard_model->rujukan($whereSet,1);
				$balik = $this->dashboard_model->rujukan($whereSet,2);
				$batal = $this->dashboard_model->rujukan($whereSet,3);

				$temp = array(); $label = array(); $data = array(); $type = array('Rujukan','Dikembalikan','Batal');
				foreach($rujuk->result() as $e) {
					if (!in_array($e->rs,$label)) $label[] = $e->rs;
					$temp['Rujukan'][$e->rs] = $e->jumlah;
				}
				foreach($balik->result() as $e) {
					if (!in_array($e->rs,$label)) $label[] = $e->rs;
					$temp['Dikembalikan'][$e->rs] = $e->jumlah;
				}
				foreach($batal->result() as $e) {
					if (!in_array($e->rs,$label)) $label[] = $e->rs;
					$temp['Batal'][$e->rs] = $e->jumlah;
				}

				foreach($label as $l)
				{
						foreach($type as $t)
						{
							$jml = 0;
							if (isset($temp[$t][$l])) $jml = $temp[$t][$l];
							$data[$t][] = $jml;
						}
				}

				die(json_encode(array(
					'label' => $label,
					'data' => $data),JSON_NUMERIC_CHECK));
			break;

			case "jenis_kasus":
			$whereSet = $whereTgl.$whereFaskes;

			$set = array(1 => 'Umum',2 => 'Maternal', 3 => 'Gynek', 4 => 'Neonatal', 5 => 'Balita', 6 => 'Konsultasi');
			$jenis = array('Umum' => 0, 'Maternal' => 0, 'Gynek' => 0, 'Neonatal' => 0, 'Balita' => 0, 'Konsultasi' => 0);
			foreach($this->dashboard_model->jenis_kasus($whereSet)->result() as $d)
			{
					$jenis[$set[$d->type]] = $d->jumlah;
			}

			$label = array(); $data = array();
			foreach($jenis as $a => $b)
			{
				$label[] = $a; $data[] = $b;
			}

			die(json_encode(array(
				'label' => $label,
				'data' => $data),JSON_NUMERIC_CHECK));
			break;


			case "matneo":

			$whereSet = $whereTgl.$whereFaskes;
			$label = array('Rujukan','Pengalihan','Advis');
			$data = array(
				$this->dashboard_model->matneo($whereSet,1)->row()->jumlah,
				$this->dashboard_model->matneo($whereSet,2)->row()->jumlah,
				$this->dashboard_model->matneo($whereSet,3)->row()->jumlah,
			);

			die(json_encode(array(
				'label' => $label,
				'data' => $data),JSON_NUMERIC_CHECK));
			break;

			case "bayi" or "umum":

			$toType = array('bayi' => 5, 'umum' => 1);
			$whereSet = $whereTgl.$whereFaskes;
			$label = array(); $data = array();
			foreach($this->dashboard_model->type_kasus($whereSet,$toType[$type])->result() as $d)
			{
					$label[] = $d->icdx; $data[] = $d->jumlah;
			}

			die(json_encode(array(
				'label' => $label,
				'data' => $data),JSON_NUMERIC_CHECK));
			break;

			default:

			echo "error";



		}
	}

	public function dds($set)
	{
		echo "<pre>";
		print_r($set);
		echo "</pre>";
	}

	function TimeToSec($time) {
    $sec = 0;
		if (strlen($time) > 1)
		{
    	foreach(array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, $k) * $v;
		}
    return $sec;
	}
}
