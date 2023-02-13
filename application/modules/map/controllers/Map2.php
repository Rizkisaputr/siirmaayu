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
					'message_id' =>  $m['messageId'],
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

			$message = null;
			$userkey = '0i2dte4pc9omlujw8so7';
			$passkey = '0067qo65ij1o4fdc3q44';
			$telepon = $sms->dari;
			$url = 'http://gamaratu.zenziva.co.id/api/sendsms/';

			$ext = explode('#',$sms->isi);
			if (count($ext) == 10)
			{

				$kd = strtoupper($ext[0]);
				if (in_array($kd,array("R","RU"))) {

					// Cek KODE RUMAH SAKIT

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
							'media'				=> "SMS");
						$this->Model_Sms->save_rujukan($simpan_rujukan);

						$message = ($kd=="R"?'Rujukan Maternal/Neo':'Rujukan Umum').' a.n '.$ext[2].' sudah diterima dan sedang diproses, SIJARIEMAS 4.0, ID: '.$id_pasien;
					} else {
						$message = 'Kode RS ('.$ext[1].') tidak ditemukan';
					}
				} else {
					$message = 'Format Salah, yang betul: R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan';
										//	  0    1     2     3    4                 5   6      7            8             9   		
					//R#001#Wika Septevani#27#idris#B#BPJS#Ambulance#g1poao hamil 37mg dg fetal distress dan febris,ku baik kes cm td:110/70 n:80x/m rr:20x/m s:38,5c#palp:tfu32cm puka preskep his- djj 165x/m,vt:portio tebal lunak pemb1cm ket+ preskep h1,therapy yg sudah dib
				}
				

			} else {
				
				$message = 'Format Salah. R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan';
				
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


			$this->Model_Sms->set_sms_ok($sms->id_sms);
		}
	}

//WHATSAPP
	public function api_wa()
	{
		$this->config->load('smartrujukan');
		$url = $this->config->item('wa_api').'&start_date='.date('d/m/Y',strtotime('-1 day',strtotime(date('Y-m-d')))).'&end_date='.date('d/m/Y');
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://panel.apiwha.com/send_message.php?apikey=B1QG102VSGZHV2MK8CQT&number=6281296757676",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}

	public function process_wa()
	{
		$this->load->model('Model_Wa');
		foreach($this->input->post('msg') as $m)
		{

			if ($this->Model_Wa->check_wa_id($m['messageId'])->num_rows() == 0)
			{
				$simpan = array(
					'message_id' =>  $m['id'],
					'waktu_dibuat' => $m['creation_date'],
					'dari' => $m['from'],
					'isi' => $m['text'],
					'status' => 0
				);
				$this->Model_Wa->set_wa($simpan);
			}

		}

		foreach($this->Model_Wa->get_wa()->result() as $wa)
		{

			/*
			R#kodeRS#nama ibu#usia#nama suami#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan

			RU#kodeRS#nama ibu#usia#nama suami#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan
			*/

			
			//json php ambil dari APWHA-- HAPUS JIKA TIDAK BERGNA
			$connect = mysqli_connect("localhost","root", "ASDK2019%","smartruj_karawang");
			date_default_timezone_set('Asia/jakarta');

			$message = null;
			$userkey = '6281296757676';
			$passkey = 'B1QG102VSGZHV2MK8CQT';
			$telepon = $wa->dari;
			$url = 'http://panel.apiwha.com/send_message.php/';

			/*JAJAL API WA*/
			// Pull messages (for push messages please go to settings of the number) 
			$wa_userkey = "6281296757676"; 
			$wa_passkey = "B1QG102VSGZHV2MK8CQT"; //the apy key
			$type = "IN"; 
			$markaspulled = "1"; 
			$getnotpulledonly = "1"; 
			$wa_api  = "http://panel.apiwha.com/get_messages.php";
			$wa_api .= "?wa_passkey=". urlencode ($wa_passkey); 
			$wa_api .=	"&wa_userkey=". urlencode ($wa_userkey); 
			$wa_api .= "&type=". urlencode ($type);

			$wa_api .= "&markaspulled=". urlencode ($markaspulled); 
			$wa_api .= "&getnotpulledonly=". urlencode ($getnotpulledonly); 
			$my_json_result = file_get_contents($wa_api, false); 
			$array1 = json_decode($my_json_result, true); 

			foreach($array1 as $row) 
			{
			 $sql1 = "INSERT INTO tb_wa (message_id,dari,tujuan,isi,waktu_dibuat,waktu_diproses,waktu_gagal,type,custom_data) VALUES ('".$row["id"]."','".$row["from"]."','".$row["to"]."','".$row["text"]."','".$row["creation_date"]."','".$row["process_date"]."','".$row["failed_date"]."','".$row["type"]."','".$row["custom_data"]."')";
			mysqli_query($connect, $sql1);
			}
			/*BATAS COBA... BATAS HAPUS JIKA TIDAK BERGUNA habis jajal*/

			$ext = explode('#',$wa->isi);
			if (count($ext) == 10)
			{

				$kd = strtoupper($ext[0]);
				if (in_array($kd,array("R","RU"))) {

					// Cek KODE RUMAH SAKIT

					$kd_rs = $this->Model_Wa->get_kode_rs($ext[1]);
					if ($kd_rs->num_rows() > 0)
					{	
						
						// Cek PASIEN
						$umur_filter = null;
						if (is_numeric($ext[3])) $umur_filter =  "AND umur = '".$ext[3]."'";
						$where = "LOWER(nama) LIKE '%".strtolower($ext[2])."%'".$umur;
						$pasien = $this->Model_Wa->check_pasien($where);
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
							$id_pasien = $this->Model_Wa->save_pasien($simpan_pasien);
							$this->Model_Wa->save_owner(array('id_rs' => $kd_rs->row()->id_rs, 'id_rm' => $id_pasien));
						}

						// CEK RS Owner
						$nakes_rs = $this->Model_Wa->check_perujuk(substr($wa->dari,2,12));
						$id_rs = ($nakes_rs->num_rows() > 0) ? $nakes_rs->row()->id_rs : $kd_rs->row()->id_rs;

						$simpan_rujukan = array(
							'type' => ($ext[0]=="R"?2:1),
							'id_rs_perujuk' => $id_rs,
							'id_rs_dirujuk' => $kd_rs->row()->id_rs,
							//'id_rujukan' => $id_pasien,
							'no_rm' => $id_pasien,
							'id_rujukan' => $id_pasien,
							'id_nakes'	=> $id_nakes,
							'ibuanak_icdx' 		=> $this->input->post('ibuanak_icdx'),
							'pembiayaan' => $ext[6],
							'transportasi' => $ext[7],
							'diagnosis' => $ext[8],
							'tindakan' => $ext[9],
							'nyeri' => "-",
							'ibuanak_nobidan' => $wa->dari,
							'ibuanak_namabidan' => "-",
							'ibuanak_kodebidan' => "-",
							'alasan_rujukan' 	=> "-",
							'sms_rujukan' 		=> $wa->dari,
							'media'				=> "Whatsapp");
						$this->Model_Wa->save_rujukan($simpan_rujukan);

						$message = ($kd=="R"?'Rujukan Ibu/Anak':'Rujukan Umum').' berhasil disimpan a.n '.$ext[2];
					} else {
						$message = 'Kode RS ('.$ext[1].') tidak ditemukan';
					}
				} else {
					$message = 'Format Salah. R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan';
										//	  0    1     2     3    4                 5   6      7            8             9   		
					//R#001#Wika Septevani#27#idris#B#BPJS#Ambulance#g1poao hamil 37mg dg fetal distress dan febris,ku baik kes cm td:110/70 n:80x/m rr:20x/m s:38,5c#palp:tfu32cm puka preskep his- djj 165x/m,vt:portio tebal lunak pemb1cm ket+ preskep h1,therapy yg sudah dib
				}
				

			} else {
				
				$message = 'Format Salah. R#kodeRS#pasien#usia#namasuamiistri#golDar#biaya#transportasi#diagnosa#tindakanPraRUjukan';
				
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


			$this->Model_Wa->set_wa_ok($wa->id_wa);
		}
	}

}
