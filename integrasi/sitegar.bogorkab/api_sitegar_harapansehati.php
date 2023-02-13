<?php

// Konfigurasi Database lokal data bed untuk RS 

$config['db_server'] 	= "localhost";
$config['db_name'] 	= "sijm5638_simrs";
$config['db_user']	= "sijm5638_smartruj";
$config['db_password']	= "Mul41@09*2012";

// Init API sesuai dengan kode pada SITEGAR

$config['email'] 	= "rsharapansehati@rujukan.web.id";
$config['password'] 	= "rujukan2016";
$config['redaksi']	= "RS Harapan Sehati";
$config['api_url'] 	= "https://sitegar.bogorkab.go.id/api";  
// $config['api_url'] 	= "https://sitegar.id/sitegar/api"; 
 
// SQL Getter untuk data BED, 5 kolom wajib data BED SMARTRUJUKAN SITEGAR
// SCRIPT INI SUDAH BISA DENGAN CONTOH STRUKTUR TABEL DIBAWAH : tb_bed, tb_rs, tb_kelas_bed
// SQL Getter untuk data BED, 5 kolom wajib data BED SITEGAR. BISA INI

$config['column_bed']		= "bed";
$config['column_kapasitas_l']	= "kapasitas_l";
$config['column_terpakai_l']	= "terpakai_l";
$config['column_kapasitas_p']	= "kapasitas_p";
$config['column_terpakai_p']	= "terpakai_p";
$config['column_kelas'] 		= "kelas";

$config['sql'] = "select 
	b.nama as bed,b.kapasitas_l,b.terpakai_l,b.kapasitas_p,b.terpakai_p,k.nama as kelas
	FROM tb_bed b
	JOIN tb_kelas_bed k ON (k.id_kelas_bed = b.kelas)";

$conn = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query($config['sql']);

$bed = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	if (!$result)
    		die($conn->error);
	    $bed[] = array(
			$row[$config['column_bed']],
			$row[$config['column_kapasitas_l']],
			$row[$config['column_terpakai_l']],
			$row[$config['column_kapasitas_p']],
			$row[$config['column_terpakai_p']],
			$row[$config['column_kelas']]
		);
    }	
}

$ch = curl_init($config['api_url']); 
$jsonDataEncoded = json_encode(
	array(
		'email' => $config['email'] ,
		'password' => $config['password'] ,
		'data' => array(
			'rs' => $config['redaksi'],
			'bed' => $bed
		)
	)); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
curl_exec($ch);


$conn->close();
