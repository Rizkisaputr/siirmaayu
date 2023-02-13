<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property M_Base M_Base
 * @property CI_URI uri
 * @property Model_Home_Bed $Model_Home_Bed
 */

class Home extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/jakarta');
	}

	public function index(){

		$this->load->model('Model_Home_Bed');

		$data=$this->M_Base->get_config();
		$data['ambulance'] = $this->Model_Home_Bed->ambulance_pin();
		$data['title'] = 'Home';
		render_front('home',$data);
	}
	public function bed_data(){
		$this->load->model('Model_Home_Bed');
		$q=$this->Model_Home_Bed->list_bed_query();
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
						$this->rs_data_formater($row->bed_data,36); //*NAMBAH MENAMBAH BED DASHBORD*//
						//$this->rs_data_formater($row->faskes_data,1);
						$this->rs_data_formater($row->rujuk_data,1);
						$this->rs_data_formater($row->ambulance,1);
						$this->rs_data_formater($row->dokter_data,7);
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
		$inner_icu=$this
			->db
			->select_sum("(b_3.kapasitas_l+b_3.kapasitas_p)")
			->join('tb_kelas_bed kb3','b_3.kelas=kb3.id_kelas_bed')
			->where('b_3.id_rs=tb_rs.id_rs')
			->where('kb3.nama','ICU')
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
		$this->db->select("tb_rs.id_rs,tb_rs.nama,tb_rs.pos_lat,tb_rs.pos_lon,($inner_k3) as k3,($inner_ambulan) as ambulance,($inner_ventilator) as ventilator,($inner_icu) as icu");
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
		$this->load->model('Model_Home_Bed');
		$data=$this->Model_Home_Bed->detil_rs($id_rs);
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



// Mulai WA Model_Wa
	public function api_sms()
	{
		$this->config->load('smartrujukan');
		$url = $this->config->item('sms_api').'&start_date='.date('d/m/Y',strtotime('-1 day',strtotime(date('Y-m-d')))).'&end_date='.date('d/m/Y');
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		die(curl_exec($curlHandle));
		curl_close($curlHandle);
	}

	public function process_sms()
	{
		$this->load->model('Model_Sms');
		foreach($this->input->post('msg') as $m)
		{

			if ($this->Model_Sms->check_sms_id($m['messageId'])->num_rows() == 0)
			{
				$simpan = array(
					'messagewa_id' =>  $m['messageId'],
					'waktu' => $m['date'],
					'dari' => $m['dari'],
					'isi' => $m['isiPesan'],
					'status' => 0
				);
				$this->Model_Sms->set_sms($simpan);
			}

		}

		foreach($this->Model_Sms->get_sms()->result() as $sms)
		{

			/*
			R#kodeRS#nama ibu#usia#nama suami#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan

			RU#kodeRS#nama ibu#usia#nama suami#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan
			*/

            //WA SITEGAR
			$message = null;
			$userkey = '7cz2xl7gocma68giap6g';
			$passkey = 'vs9hmp67xx9g8qx5f7jq';
			$instanceID = '213074';
			$telepon = $sms->dari;
			$url = 'http://siirmaayu.zenziva.co.id/api/WAsendMsg/';
			$ext = explode('#',$sms->isi);
			
			if (count($ext) < 10)
			//if (count($ext1) < 10)
			{ $data = $this->db->query("SELECT * FROM tb_wa, tb_nakes where tb_wa.dari like tb_nakes.telp");
				{

				$kd = strtoupper($ext[0]);
				//$kd = strtoupper($ext1[0]);
				if (in_array($kd,array("R","RU","[CALL "))) {


					// Cek KODE RUMAH SAKIT

					//$kd_rs = $this->Model_Sms->get_kode_rs($ext[1]);
					$kd_rs = $this->Model_Sms->get_kode_rs($ext[1]);
					if ($kd_rs->num_rows() > 0)
					{	
						
						// Cek PASIEN
						$umur_filter = null;
						if (is_numeric($ext[1])) $umur_filter =  "AND umur = '".$ext[1]."'";
						$where = "LOWER(nama) LIKE '%".strtolower($ext[1])."%'".$umur;
						$pasien = $this->Model_Sms->check_pasien($where);
						if ($pasien->num_rows() > 0)
						{
							$id_pasien = $pasien->row()->id_rm;
						} else {
							$simpan_pasien = array(
												'nama' => '-',
												'umur' => '0',
												'pasangan' => '-',
												'goldarah' => '-',
												'jenis_kelamin'	=> '-',
												'nik' 			=> '-');
							$id_pasien = $this->Model_Sms->save_pasien($simpan_pasien);
							$this->Model_Sms->save_owner(array('id_rs' => $kd_rs->row()->id_rs, 'id_rm' => $id_pasien));
						}

						// CEK RS Owner
						$nakes_rs = $this->Model_Sms->check_perujuk(substr($sms->dari,2,12));
						$id_rs = ($nakes_rs->num_rows() > 0) ? $nakes_rs->row()->id_rs : $kd_rs->row()->id_rs;

						$simpan_rujukan = array(
							'type' => ($ext[0]=="R"?2:1),
							'id_rs_perujuk' => $id_rs,
							'id_rs_dirujuk' => $kd_rs->row()->id_rs,
							'no_rm' => $id_pasien,
							'id_nakes'	=> $id_nakes,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'pembiayaan' => "-",
							'transportasi' => "-",
							'diagnosis' => $ext[2],
							'tindakan' => "<font color='#16a085'><b>CC MOHON edit & lengkapi</b></font>",
							'nyeri' => "-",
							'ibuanak_nobidan' => $sms->dari,
							'ibuanak_namabidan' => "-",
							'ibuanak_kodebidan' => "-",
							'alasan_rujukan' 	=> "-",
							'sms_rujukan' 		=> $sms->dari,
							'media'				=> "Whatsapp Gateway");
						$this->Model_Sms->save_rujukan($simpan_rujukan);

						//$message = ($kd=="R"?'Rujukan Mat./Neo':'Rujukan Umum').' ke Faskes '.$ext[1].' sudah diterima APLIKASI RUJUKAN, sdg diproses CC Tlp.+6281212349911. ID: ';
						$message = ($kd=="R"?'Rujukan Mat./Neo':'Rujukan Umum').' ke Faskes '.$ext[1].' sudah diterima APLIKASI RUJUKAN, sdg diproses CC WA Call.+6282111502000. ID: '.$id_pasien;
					} else {
						$message = 'Kode RS ('.$ext[1].') tidak ditemukan. WA yang betul: R#kodeRS#nama pasien#usia#nama suami istri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan. KESULITAN? WA Call.+6282111502000';
					}

					} 
					}
					}
			        
					elseif (count($ext) == 10)
					{ $data = $this->db->query("SELECT * FROM tb_wa, tb_nakes where tb_wa.dari like tb_nakes.telp");
						{

						$kd = strtoupper($ext[0]);
						if (in_array($kd,array("R","RU","[CALL "))) {
					// ASLINYA $message = 'Format Salah1' .$ext[2].', yang betul: R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan. KESULITAN? segera TELP KE: 119 / Tlp.+6281212349911/ 119';
										//	  0    1     2     3    4                 5   6      7            8             9   		
					// Cek KODE RUMAH SAKIT

					$kd_rs = $this->Model_Sms->get_kode_rs($ext[1]);
					$kd_rs = $this->Model_Sms->get_kode_rs($ext[1]);
					if ($kd_rs->num_rows() > 0)
					{	
						
						// Cek PASIEN
						$umur_filter = null;
						if (is_numeric($ext[3])) $umur_filter =  "AND umur = '".$ext[3]."'";
						$where = "LOWER(nama) LIKE '%".strtolower($ext[2])."%'".$umur;
						$pasien = $this->Model_Sms->check_pasien($where);
						if ($pasien->num_rows() > 0)
						{
							$id_pasien = $pasien->row()->id_rm;
						} else {
							$simpan_pasien = array(
								'nama' => 'Px. '.$ext[2],
								'umur' => $ext[3],
								'pasangan' => $ext[4],
								'goldarah' => $ext[5],
								'jenis_kelamin'	=> 'Perempuan',
								'nik' 			=> '-');
							$id_pasien = $this->Model_Sms->save_pasien($simpan_pasien);
							$this->Model_Sms->save_owner(array('id_rs' => $kd_rs->row()->id_rs, 'id_rm' => $id_pasien));
						}

						// CEK RS Owner
						$nakes_rs = $this->Model_Sms->check_perujuk(substr($sms->dari,2,12));
						$id_rs = ($nakes_rs->num_rows() > 0) ? $nakes_rs->row()->id_rs : $kd_rs->row()->id_rs;

						$simpan_rujukan = array(
							'type' => ($ext[0]=="R"?2:1),
							'id_rs_perujuk' => $id_rs,
							'id_rs_dirujuk' => $kd_rs->row()->id_rs,
							'no_rm' => $id_pasien,
							'id_nakes'	=> $id_nakes,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'pembiayaan' => $ext[6],
							'transportasi' => $ext[7],
							'diagnosis' => $ext[8],
							'tindakan' => $ext[9],
							'nyeri' => "-",
							'ibuanak_nobidan' => $sms->dari,
							'ibuanak_namabidan' => "-",
							'ibuanak_kodebidan' => "-",
							'alasan_rujukan' 	=> "-",
							'sms_rujukan' 		=> $sms->dari,
							'media'				=> "Whatsapp Gateway");
						$this->Model_Sms->save_rujukan($simpan_rujukan);

						$message = ($kd=="R"?'Rujukan Mat./Neo':'Rujukan Umum').' a.n '.$ext[2].' sudah diterima APLIKASI RUJUKAN, sdg diproses Operator. WA Call.+6282111502000. ID: '.$id_pasien;
						//$message = ($kd=="R"?'Rujukan Mat./Neo':'Rujukan Umum').' a.n '.$ext[2].' sudah diterima APLIKASI RUJUKAN, sdg diproses Operator. Tlp.+6281212349911/ 119. ID: ';
					} else {
						$message = 'Perbaiki SMS anda. KodeRS ('.$ext[1].') tidak ditemukan. WA yang betul: R#kodeRS#nama pasien#usia#nama suami istri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan. KESULITAN? WA Call.+6282111502000';
					}
	 				}
				//} else {
				//	$message = 'Format Salah, yg betul: R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan. KESULITAN? TELP ke PSC: 119/Tlp: +6281212349911/ 119';
										//	  0    1     2     3    4                 5   6      7            8             9   		
					//R#001#Wika Septevani#27#idris#B#BPJS#Ambulance#g1poao hamil 37mg dg fetal distress dan febris,ku baik kes cm td:110/70 n:80x/m rr:20x/m s:38,5c#palp:tfu32cm puka preskep his- djj 165x/m,vt:portio tebal lunak pemb1cm ket+ preskep h1,therapy yg sudah dib
					}
				} else {
				
				$message = 'Perbaiki WA Anda, yg betul: R#kodeRS#NAMA PASIEN, usia, biaya, transportasi, DIAGNOSA, tindakan. KESULITAN? WA Call.+6282111502000';
	 
			}

			if ($message != null)
			{
				$curlHandle = curl_init();
				curl_setopt($curlHandle, CURLOPT_URL, $url);
				curl_setopt($curlHandle, CURLOPT_HEADER, 0);
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
				curl_setopt($curlHandle, CURLOPT_POST, 1);
				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
				    'userkey' => $userkey,
				    'passkey' => $passkey,
				    //'instance' => $instanceID,
				    'instance' => $instanceID,
				    'nohp' => $telepon,
				    'pesan' => $message
				));
				$results = json_decode(curl_exec($curlHandle), true);
				curl_close($curlHandle);
			}


			$this->Model_Sms->set_sms_ok($sms->id_wa);
		}
		
		
		
	}
	//akhir model WA
	
	//mulai model SMS GATEWAY
	public function api_sms1()
	{
		$this->config->load('smartrujukan');
		$url = $this->config->item('sms_api1').'&start_date='.date('d/m/Y',strtotime('-1 day',strtotime(date('Y-m-d')))).'&end_date='.date('d/m/Y');
 		$curlHandle = curl_init();
 		curl_setopt($curlHandle, CURLOPT_URL, $url);
 		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
 		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
 		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
 		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
 		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		
 		die(curl_exec($curlHandle));
 		curl_close($curlHandle);
 	}

	public function process_sms1()
	{
		$this->load->model('Model_Sms1');
		foreach($this->input->post('msg') as $m)
		{

			if ($this->Model_Sms1->check_sms_id($m['messageId'])->num_rows() == 0)
			{
				$simpan = array(
					'message_id' =>  $m['messageId'],
					'waktu' => $m['date'],
					'dari' => $m['dari'],
					'isi' => $m['isiPesan'],
					'status' => 0
				);
				$this->Model_Sms1->set_sms($simpan);
			}

		}

		foreach($this->Model_Sms1->get_sms()->result() as $sms)
		{

			/*
			R#kodeRS#nama ibu#usia#nama suami#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan

			RU#kodeRS#nama ibu#usia#nama suami#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan
			*/

            //gamaratu
			//$message = null;
			//$userkey = '0i2dte4pc9omlujw8so7';
			//$passkey = 'fbb241aceb2e1f7a89fa48a6';
			//$telepon = $sms->dari;
			//$url = 'http://gamaratu.zenziva.co.id/api/sendsms/';

            //rujukan
			//$message = null;
			//$userkey = 'tfbu1lf9enlyz11rx4g8';
			//$passkey = '9c88f3dc4d4d97171b877195';
			//$telepon = $sms->dari;
			//$url = 'http://rujukan.zenziva.co.id/api/sendsms/';
			
			
			$ext = explode('#',$sms->isi);
			if (count($ext) < 10)
			{ $data = $this->db->query("SELECT * FROM tb_sms, tb_nakes where tb_sms.dari like tb_nakes.telp");
				{

				$kd = strtoupper($ext[0]);
				if (in_array($kd,array("R","RU"))) {


					// Cek KODE RUMAH SAKIT

					$kd_rs = $this->Model_Sms1->get_kode_rs($ext[1]);
					$kd_rs = $this->Model_Sms1->get_kode_rs($ext[1]);
					if ($kd_rs->num_rows() > 0)
					{	
						
						// Cek PASIEN
						$umur_filter = null;
						if (is_numeric($ext[1])) $umur_filter =  "AND umur = '".$ext[1]."'";
						$where = "LOWER(nama) LIKE '%".strtolower($ext[1])."%'".$umur;
 						$pasien = $this->Model_Sms1->check_pasien($where);
 						if ($pasien->num_rows() > 0)
 						{
 							$id_pasien = $pasien->row()->id_rm;
 						} else {
 							$simpan_pasien = array(
 												'nama' => '-',
 												'umur' => '0',
 												'pasangan' => '-',
 												'goldarah' => '-',
 												'jenis_kelamin'	=> '-',
 												'nik' 			=> '-');
 							$id_pasien = $this->Model_Sms1->save_pasien($simpan_pasien);
 							$this->Model_Sms1->save_owner(array('id_rs' => $kd_rs->row()->id_rs, 'id_rm' => $id_pasien));
						}

						// CEK RS Owner
 						$nakes_rs = $this->Model_Sms1->check_perujuk(substr($sms->dari,2,12));
  						$id_rs = ($nakes_rs->num_rows() > 0) ? $nakes_rs->row()->id_rs : $kd_rs->row()->id_rs;

						$simpan_rujukan = array(
							'type' => ($ext[0]=="R"?2:1),
							'id_rs_perujuk' => $id_rs,
							'id_rs_dirujuk' => $kd_rs->row()->id_rs,
							'no_rm' => $id_pasien,
							'id_nakes'	=> $id_nakes,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'pembiayaan' => "-",
							'transportasi' => "-",
							'diagnosis' => $ext[2],
							'tindakan' => "<font color='#16a085'><b>Operator action: edit lengkapi</b></font>",
							'nyeri' => "-",
							'ibuanak_nobidan' => $sms->dari,
							'ibuanak_namabidan' => "-",
							'ibuanak_kodebidan' => "-",
							'alasan_rujukan' 	=> "-",
							'sms_rujukan' 		=> $sms->dari,
						    'media'				=> "SMS");
						$this->Model_Sms1->save_rujukan($simpan_rujukan);

						$message = ($kd=="R"?'Rujukan Mat./Neo':'Rujukan Umum').' ke Faskes '.$ext[1].' sudah diterima SISTEM, sdg diproses CallCenter PSC119. ID: ';
					} else {
						$message = 'Kode RS ('.$ext[1].') tidak ditemukan. KESULITAN? TELP CallCenter PSC119. ';
					}

					} 
					}
					}
					elseif (count($ext) == 10)
					{ $data = $this->db->query("SELECT * FROM tb_sms, tb_nakes where tb_sms.dari like tb_nakes.telp");
						{

						$kd = strtoupper($ext[0]);
						if (in_array($kd,array("R","RU"))) {
					// ASLINYA $message = 'Format Salah1' .$ext[2].', yang betul: R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan. KESULITAN? segera TELP KE: 119 / Tlp.+6282126433180/ (0262)2800119';
										//	  0    1     2     3    4                 5   6      7            8             9   		
					// Cek KODE RUMAH SAKIT

					$kd_rs = $this->Model_Sms1->get_kode_rs($ext[1]);
					$kd_rs = $this->Model_Sms1->get_kode_rs($ext[1]);
					if ($kd_rs->num_rows() > 0)
					{	
						
						// Cek PASIEN
						$umur_filter = null;
						if (is_numeric($ext[3])) $umur_filter =  "AND umur = '".$ext[3]."'";
						$where = "LOWER(nama) LIKE '%".strtolower($ext[2])."%'".$umur;
						$pasien = $this->Model_Sms1->check_pasien($where);
						if ($pasien->num_rows() > 0)
						{
							$id_pasien = $pasien->row()->id_rm;
						} else {
							$simpan_pasien = array(
								'nama' => 'Px. '.$ext[2],
								'umur' => $ext[3],
								'pasangan' => $ext[4],
								'goldarah' => $ext[5],
								'jenis_kelamin'	=> 'Perempuan',
								'nik' 			=> '-');
							$id_pasien = $this->Model_Sms1->save_pasien($simpan_pasien);
							$this->Model_Sms1->save_owner(array('id_rs' => $kd_rs->row()->id_rs, 'id_rm' => $id_pasien));
						}

						// CEK RS Owner
						$nakes_rs = $this->Model_Sms1->check_perujuk(substr($sms->dari,2,12));
						$id_rs = ($nakes_rs->num_rows() > 0) ? $nakes_rs->row()->id_rs : $kd_rs->row()->id_rs;

						$simpan_rujukan = array(
							'type' => ($ext[0]=="R"?2:1),
							'id_rs_perujuk' => $id_rs,
							'id_rs_dirujuk' => $kd_rs->row()->id_rs,
							'no_rm' => $id_pasien,
							'id_nakes'	=> $id_nakes,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'pembiayaan' => $ext[6],
							'transportasi' => $ext[7],
							'diagnosis' => $ext[8],
							'tindakan' => $ext[9],
							'nyeri' => "-",
							'ibuanak_nobidan' => $sms->dari,
							'ibuanak_namabidan' => "-",
							'ibuanak_kodebidan' => "-",
							'alasan_rujukan' 	=> "-",
							'sms_rujukan' 		=> $sms->dari,
							'media'				=> "SMS");
						$this->Model_Sms1->save_rujukan($simpan_rujukan);

						$message = ($kd=="R"?'Rujukan Mat./Neo':'Rujukan Umum').' a.n '.$ext[2].' sudah diterima sudah diterima SISTEM, sdg diproses CallCenter PSC119. ID: ';
					} else {
						$message = 'Perbaiki SMS anda. KodeRS ('.$ext[1].') tidak ditemukan. KESULITAN? TELP ke CallCenter PSC119. ';
					}
	 				}
				//} else {
				//	$message = 'Format Salah, yg betul: R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan. KESULITAN? TELP ke PSC: 119/Tlp: +6281212349911/ 119';
										//	  0    1     2     3    4                 5   6      7            8             9   		
					//R#001#Wika Septevani#27#idris#B#BPJS#Ambulance#g1poao hamil 37mg dg fetal distress dan febris,ku baik kes cm td:110/70 n:80x/m rr:20x/m s:38,5c#palp:tfu32cm puka preskep his- djj 165x/m,vt:portio tebal lunak pemb1cm ket+ preskep h1,therapy yg sudah dib
					}
				} else {
				
				$message = 'Perbaiki SMS Anda, yg betul: R#kodeRS#NAMA PASIEN, usia, biaya, transportasi, DIAGNOSA, tindakan. KESULITAN? TELP CallCenter PSC119. ';
	 
			}
 
 			if ($message != null)
 			{
 				$curlHandle = curl_init();
 				curl_setopt($curlHandle, CURLOPT_URL, $url);
 				curl_setopt($curlHandle, CURLOPT_HEADER, 0);
 				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
 				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
 				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
 				curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
 				curl_setopt($curlHandle, CURLOPT_POST, 1);
 				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
 				    'userkey' => $userkey,
 				    'passkey' => $passkey,
 				    'nohp' => $telepon,
 				    'pesan' => $message
 				));
				$results = json_decode(curl_exec($curlHandle), true);
				curl_close($curlHandle);
			}


			$this->Model_Sms1->set_sms_ok($sms->id_sms);
		}
	}
    //akhir model SMS
}