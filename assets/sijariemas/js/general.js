function checkInput(obj) 
{
	var pola = "^";
	pola += "[0-9]*";
	pola += "$";
	rx = new RegExp(pola);

	if (!obj.value.match(rx))
	{
		if (obj.lastMatched)
		{
			obj.value = obj.lastMatched;
		}
		else
		{
			obj.value = "";
		}
	}
	else
	{
		obj.lastMatched = obj.value;
	}
}
function checkAbjadBesar(obj) 
{
	var pola = "^";
	pola += "[aA-zZ' ]*";
	pola += "$";
	rx = new RegExp(pola);
	obj.value=obj.value.toUpperCase();
	if (!obj.value.match(rx))
	{
		if (obj.lastMatched)
		{
			obj.value = obj.lastMatched;
		}
		else
		{
			obj.value = "";
		}
	}
	else
	{
		obj.lastMatched = obj.value;
	}
}

function checkAbjad(obj) 
{
	var pola = "^";
	pola += "[aA-zZ' ]*";
	pola += "$";
	rx = new RegExp(pola);

	if (!obj.value.match(rx))
	{
		if (obj.lastMatched)
		{
			obj.value = obj.lastMatched;
		}
		else
		{
			obj.value = "";
		}
	}
	else
	{
		obj.lastMatched = obj.value;
	}
}

function getColorHome(i){
	if(i==0){
		return "#FFFFFF";
	}
	else{
		if(i%5==0){
			return "#FFFFFF";
		}else if(i%5==1){
			return "#EFEFEF";
		}else if(i%5==2){
			return "#FFCCFF";
		}else if(i%5==3){
			return "#EFEFEF";
		}else if(i%5==4){
			return "#FFEFFF";
		}else{
			return "#FFF";	
		}
	}
}


function getColor(i){
	if(i==0){
		return "#FFFFFF";
	}
	else{
		if(i%5==0){
			return "#e7ebf2";
		}else if(i%5==1){
			return "#EFEFEF";
		}else if(i%5==2){
			return "#e7ebf2";
		}else if(i%5==3){
			return "#EEFFEE";
		}else if(i%5==4){
			return "#DDFFDD";
		}else{
			return "#D5FFD5";	
		}
	}
}

function getMediaInfo(type){
	switch (type){
	case "wsms":
		return "SMS";
		break;
	case "SMS":
		return "SMS";
		break;
	case "wtelp":
		return "TELP";
		break;
	} 
}

function getStatusAMP(type){
	switch (type){
	case "0":
		return "BELUM";
		break;
	case "1":
		return "SUDAH";
		break;
	} 
}

function getFungsiAmbulans(type){
	switch (type){
	case "0":
		return "Jemput Ibu dan Anak";
		break;
	case "1":
		return "Jemput Ibu Melahirkan";
		break;
	case "2":
		return "Jemput Bayi";
		break;
	} 
}

function getNotType(type){
	switch (type){
	case "0":
		return "Input Sys Admin!";
		break;
	case "1":
		return "Input Member!";
		break;
	case "2":
		return "SMS Refferal!";
		break;
	case "3":
		return "SMS AMP!";
		break;
	case "4":
		return "SMS Aspirasi!";
		break;
	case "5":
		return "Tanggapan Aspirasi";
		break;
	case "6":
		return "Setting Aplikasi";
		break;
	case "7":
		return "Setting SMS Server";
		break;
	case "8":
		return "Jawab Permintaan Rujukan";
		break;
	case "9":
		return "Feedback Pasien";
		break;
	} 
}

function getSMSSentType(type)
{
	//temp="Kirim SMS Standard";
	switch (type){
	case "1":
		return "SMS Masyarakat";
		break;
	case "2":
		return "SMS Broadcast";
		break;
	case "3":
		return "Penjadwalan SMS Masyarakat";
		break;
	case "4":
		return "Penjadwalan SMS Broadcast";
		break;
	case "5":
		return "Broadcast SMS Kuis";
		break;
	case "6":
		return "Forward SMS AMP";
		break;
	case "7":
		return "Investigasi SMS AMP";
		break;
	case "8":
		return "Forward Rujukan";
		break;
	case "9":
		return "Siaga Rujukan";
		break;
	case "10":
		return "Konfirmasi Ibu Hamil";
		break;
	case "11":
		return "Forward Pasien Resiko Tinggi";
		break;
	case "12":
		return "Advis Ibu Hamil";
		break;
	case "13":
		return "SMS Info";
		break;
	case "14":
		return "Forward Tanggapan";
		break;
	case "15":
		return "Forward Tindak Lanjut";
		break;
	case "16":
		return "Jawaban Rujukan";
		break;
	case "17":
		return "Format Salah";
		break;
	case "18":
		return "Konten SMS Sama";
		break;
	}
}

function getSelected(string1, string2){
	if(string1==string2){
		temp="selected";
	}else{
		temp="";
	}
	return temp;
}

function getChecked(string1, string2){
	if(string1==string2){
		temp="checked";
	}else{
		temp="";
	}
	return $temp;
}

function getStatusPegawai(type){
	switch (type){
	case "0":
		return "Swasta";
		break;
	case "1":
		return "PNS";
		break;
	} 
}

function printCheckList(type){
	switch (type){
	case "0":
		return "-";
		break;
	case "1":
		return "V";
		break;
	} 
}
function jumlahKata(form) { 
		with (form) { 
			sisa.value = 500-pesan.value.length;
			if (parseInt(sisa.value)<0) { 
				sisa.value = '0'; 
			}
		pesan.value = pesan.value.substr(0,500);
		}
		return;
}

function printStatusStock(type){
	switch (type){
	case "0":
		return "Tidak Tersedia";
		break;
	case "1":
		return "ADA";
		break;
	} 
}

function displayBlood(type){
	if(type!='a' && type!='A' && type!='b' && type!='B' && type!='o' && type!='O' && type!='ab' && type!='AB'){
		return "<font color='#FF0000'><blink><b>"+type+"</b></blink></font>";
	}
	return type;
}

//untuk memberDashboard.php dan rfPasien.php

function getStatusRujukan(type){
	switch (type){
	case "0":
		return "<font color='#993333'><blink><b>RUJUKAN BARU KE RS PRIORITAS I : </b></blink></font>";
		break;
	case "1":
		return "DITERIMA RS PRIORITAS I";
		break;
	case "2":
		return "DIALIHKAN KE RS PRIORITAS II :";
		break;
	case "3":
		return "DITERIMA RS PRIORITAS II";
		break;
	case "4":
		return "DIALIHKAN KE RS PRIORITAS III :";
		break;
	case "5":
		return "DITERIMA RS PRIORITAS III";
		break;
	case "6":
		return "DIALIHKAN KE RS PRIORITAS IV :";
		break;
	case "7":
		return "DITERIMA RS PRIORITAS IV";
		break;
	case "8":
		return "DIALIHKAN KE RS PRIORITAS V :";
		break;
	case "9":
		return "DITERIMA RS PRIORITAS V";
		break;
	case "10":
		return "DIALIHKAN KE RS PRIORITAS VI :";
		break;
	case "11":
		return "DITERIMA RS PRIORITAS TERAKHIR";
		break;
	case "12":
		return "DIALIHKAN KE RS PRIORITAS WAJIB :";
		break;
	case "13":
		return "<font color='#991100'><blink><b>SIAGA IGD/PASIEN DLM PERJALANAN</b></blink></font>";
		break;
	case "14":
		return "<font color='#0099FF'><blink><b>PASIEN DALAM PENANGANAN DI IGD / PONEK / VK</b></blink></font>";
		break;
	case "15": 
		return "<font color='#3300CC'><b>PENANGANAN PASIEN DI IGD/PONEK/VK SELESAI</b></font>";
		break;
	case "16":
		return "<font color='#33CC00'><b>PERAWATAN PASIEN DI NIFAS</b></font>";
		break;
	case "17":
		return "<font color='#3300CC'><b>PERAWATAN PASIEN SELESAI</b></font>";
		break;
	case "18":
		return "<font color='#99CC00'><b>PULANG</b></font>";
		break;
	case "19":
		return "<font color='#99CC00'><b>BATAL</b></font>";
		break;
	case "20":
		return "<font color='#000000'><b>MENINGGAL DUNIA</b></font>";
		break;
	case "21":
		return "<font color='#000000'><b>DIKEMBALIKAN</b></font>";
		break;
	} 
}

function getCGStatus(type)
{
	switch (type){
	case "1":
		return "BARU";
		break;
	case "2":
		return "KLASIFIKASI";
		break;
	case "3":
		return "DISTRIBUSI KE DINAS/FASKES";
		break;
	case "4":
		return "DISTRIBUSI UNIT/BGN/BDG/PKM";
		break;
	case "5":
		return "TANGGAPAN BARU";
		break;
	case "6":
		return "TANGGAPAN DIKIRIM";
		break;
	case "7":
		return "TINDAKAN BARU";
		break;
	case "8":
		return "TINDAKAN DIKIRIM";
		break;
	case "9":
		return "SELESAI";
		break;
	}
}

function getTransportasi(type)
{
	switch (type){
	case "0":
		return "Ambulan";
		break;
	case "1":
		return "Kendaraan Pribadi";
		break;
	case "2":
		return "Motor";
		break;
	case "3":
		return "PickUp";
		break;
	case "4":
		return "Angkot";
		break;
	case "5":
		return "Lainnya";
		break;
	}
}


function getPiketColor(shift){
		if(shift=="P"){
			return "#B5D333";
		}else if(shift=="S"){
			return "#01AEF0";
		}else if(shift=="M"){
			return "#F78222";
		}else if(shift=="L"){
			return "#ED135D";
		}else{
			return "#F8F8F8";	
		}
}
