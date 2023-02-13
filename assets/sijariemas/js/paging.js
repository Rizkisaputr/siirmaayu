function rectime(sec) {
	if(!isNaN(sec)){
		var hr = Math.floor(sec / 3600);
		var min = Math.floor((sec - (hr * 3600))/60);
		sec -= ((hr * 3600) + (min * 60));
		sec += ''; min += '';
		while (min.length < 2) {min = '0' + min;}
		while (sec.length < 2) {sec = '0' + sec;}
		hr = (hr)?''+hr+':':'';
		
		return hr + min + ':' + sec;
		//return sec;
	}else{
		return '';
	}
}

function setTime(time)
{
	var d='-';
	if(time!=''&&time!='0'&&time!='0000-00-00 00:00:00')
	{	
	//StartCountDown("clock7","10/03/2012 7:32")

	//hari=getHari(substr($time,8,2),substr($time,5,2),substr($time,0,4));
		var tgl=time.substr(8,2);
		var bln=time.substr(5,2);
		var thn=time.substr(0,4);
		var hh=time.substr(11,2);
		var mm=time.substr(14,2);
		var ss=time.substr(17,2);
		temp=bln+'/'+tgl+'/'+thn+' '+hh+':'+mm+':'+ss;
		var d = new Date(temp); 
		d.setMinutes(d.getMinutes() + 10);
	}
	return d;

}

function StartCountDown(myDiv,myTargetDate,myTargetDate2)
  {
	var n='x'+myDiv;
	var st=document.getElementById(n).innerHTML;
	if(st=='0'||st=='2'||st=='4'||st=='6'||st=='8'||st=='10'||st=='12'){
						
		var dthen	= new Date(myTargetDate);
		var dnow	= new Date();
		ddiff		= new Date(dthen-dnow);
		gsecs		= Math.floor(ddiff.valueOf()/1000)
		CountBack(myDiv,gsecs,myTargetDate,myTargetDate2);
	}else{
		ResponTime(myDiv,myTargetDate,myTargetDate2);
		//document.getElementById(myDiv).innerHTML = "<font color='#FF0000'><blink><b>info time</b></blink></font>";
			
	}
}

function ResponTime(myDiv,myTargetDate,myTargetDate2)
{
    var dr1	= new Date(myTargetDate);
    var dr2	= new Date(myTargetDate2);
    ddiff		= new Date(dr2-dr1);
    gsecs		= Math.floor(ddiff.valueOf()/1000);
    CountTime(myDiv,gsecs);
}

  function Calcage(secs, num1, num2)
  {
    s = ((Math.floor(secs/num1))%num2).toString();
    if (s.length < 2) 
    {	
      s = "0" + s;
    }
    return (s);
  }

function CountTime(myDiv, secs)
  {
	 
    if(secs > 600)
    {	
      document.getElementById(myDiv).innerHTML = "<font color='#FF0000'><blink><b>"+rectime(secs)+"<br>(LEWAT SOP)</b></blink></font>";
    }
    else
    {
      document.getElementById(myDiv).innerHTML = "<font color='#OOOOFF'><b>"+rectime(secs)+"</b></font>";
    }
  }

  function CountBack(myDiv, secs,myTargetDate,myTargetDate2)
  {

	var DisplayStr;
    var DisplayFormat = "%%H%%:%%M%%:%%S%%";
    DisplayStr = DisplayFormat.replace(/%%D%%/g,	Calcage(secs,86400,100000));
    DisplayStr = DisplayStr.replace(/%%H%%/g,		Calcage(secs,3600,24));
    DisplayStr = DisplayStr.replace(/%%M%%/g,		Calcage(secs,60,60));
    DisplayStr = DisplayStr.replace(/%%S%%/g,		Calcage(secs,1,60));
	var n='x'+myDiv;
	var st=document.getElementById(n).innerHTML;
	if(st=='0'||st=='2'||st=='4'||st=='6'||st=='8'||st=='10'||st=='12'){
						
		if(secs > 0)
		{	
			document.getElementById(myDiv).innerHTML = DisplayStr;
			setTimeout("CountBack('" + myDiv + "'," + (secs-1) + ");", 990);	
	
		}
		else
		{
		document.getElementById(myDiv).innerHTML = "<font color='#FF0000'><blink><b>BLM DIJAWAB LEWAT SOP</b></blink></font>";
		}

	}else{
		//document.getElementById(myDiv).innerHTML = "<font color='#FF0000'><blink><b>info time x</b></blink></font>";
		ResponTime(myDiv,myTargetDate,myTargetDate2);
		//document.getElementById(myDiv).innerHTML = "<font color='#FF0000'><blink><b>info time</b></blink></font>";
	
	}

  }


function viewerPagingAll(page,no_of_paginations,total,per_page,today)
{
	//var page;
	var cur_page = parseInt(page);
	page -= 1;
	//var per_page = 5; // Per page
	var previous_btn = true;
	var next_btn = true;
	var first_btn = true;
	var last_btn = true;
	var start;
	//var no_of_paginations=nop;

	start = page * per_page;

	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if (cur_page >= 7) {
		start_loop = parseInt(cur_page) - 3;//4, nop 51, data 10001, per page 20
		if (no_of_paginations > cur_page + 3)
			end_loop = parseInt(cur_page) + 3;
		else if (cur_page <= no_of_paginations && cur_page > no_of_paginations - 6) {
			start_loop = no_of_paginations - 6;
			end_loop = no_of_paginations;
		} else {
			end_loop = no_of_paginations;
		}
	} else {
		start_loop = 1;
		if (no_of_paginations > 7)
			end_loop = 7;
		else
			end_loop = no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	var pawal;
	var count=total;
	var pakhir;

	pawal=((cur_page-1)*per_page)+1;
	pakhir=cur_page*per_page;
	if(pakhir>count){
		pakhir=count;
	}
	if(count==0){
		pawal=0;
	}

	var paginglist="";
	
	paginglist += "<div class='pagination'><ul>";
	paginglist += "<div class='pagination'><ul>";

	// TO ENABLE THE END BUTTON
	if (last_btn && cur_page < no_of_paginations) {
		paginglist += "<li p='"+no_of_paginations+"' class='active'>>></li>";
	} else if (last_btn) {
		paginglist += "<li p='"+no_of_paginations+"' class='inactive'>>></li>";
	}

	// TO ENABLE THE NEXT BUTTON
	if (next_btn && cur_page < no_of_paginations) {
		nex=parseInt(cur_page)+1;
		paginglist += "<li p='"+nex+"' class='active'>Berikutnya</li>";
	} else if (next_btn) {
		paginglist += "<li class='inactive'>Berikutnya</li>";
	}

	for (i = end_loop; i >= start_loop; i--) {
		if (cur_page == i)
			paginglist += "<li id='cpage' p='"+i+"' style='color:#fff;background-color:#000000;' class='active' value='"+i+"'>"+i+"</li>";
		else
			paginglist += "<li p='"+i+"' class='active'>"+i+"</li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if (previous_btn && cur_page > 1) {
		pre = parseInt(cur_page)-1;
		paginglist += "<li p='"+pre+"' class='active'>Sebelumnya</li>";
	} else if (previous_btn) {
		paginglist += "<li class='inactive'>Sebelumnya</li>";
	}

	// FOR ENABLING THE FIRST BUTTON
	if (first_btn && cur_page > 1) {
		paginglist += "<li p='1' class='active'><<</li>";
	} else if (first_btn) {
		paginglist += "<li p='1' class='inactive'><<</li>";
	}

	paginglist +="<li class='pagetotal'>"+pawal+"-"+pakhir+" dari "+count+"</li>";
	paginglist +="<li class='c' id='cdownload'>Download</li>";
	paginglist +="<li class='c' id='cfilter'>Filter</li>";
	paginglist +="<li class='c' id='csearch'>Search</li>";
	paginglist +="<li class='today' id='ctoday'>"+today+"</li>";

	viewdata = "<div align=\'center\'><table width='98%' class='\tpaging\' CELLSPACING=\'2\' CELLSPADDING=\'2\'><tr><td>"+paginglist+"</td></tr></table>";
	return viewdata;
}

function viewerPagingScreen(page,no_of_paginations,total,per_page)
{
	//var page;
	var cur_page = parseInt(page);
	page -= 1;
	//var per_page = 5; // Per page
	var previous_btn = true;
	var next_btn = true;
	var first_btn = true;
	var last_btn = true;
	var start;
	//var no_of_paginations=nop;

	start = page * per_page;

	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if (cur_page >= 7) {
		start_loop = parseInt(cur_page) - 3;//4, nop 51, data 10001, per page 20
		if (no_of_paginations > cur_page + 3)
			end_loop = parseInt(cur_page) + 3;
		else if (cur_page <= no_of_paginations && cur_page > no_of_paginations - 6) {
			start_loop = no_of_paginations - 6;
			end_loop = no_of_paginations;
		} else {
			end_loop = no_of_paginations;
		}
	} else {
		start_loop = 1;
		if (no_of_paginations > 7)
			end_loop = 7;
		else
			end_loop = no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	var pawal;
	var count=total;
	var pakhir;

	pawal=((cur_page-1)*per_page)+1;
	pakhir=cur_page*per_page;
	if(pakhir>count){
		pakhir=count;
	}
	if(count==0){
		pawal=0;
	}

	var paginglist="";
	
	paginglist += "<div class='pagination'><ul>";
	paginglist += "<div class='pagination'><ul>";

	// TO ENABLE THE END BUTTON
	if (last_btn && cur_page < no_of_paginations) {
		paginglist += "<li p='"+no_of_paginations+"' class='active'>Last</li>";
	} else if (last_btn) {
		paginglist += "<li p='"+no_of_paginations+"' class='inactive'>Last</li>";
	}

	// TO ENABLE THE NEXT BUTTON
	if (next_btn && cur_page < no_of_paginations) {
		nex=parseInt(cur_page)+1;
		paginglist += "<li p='"+nex+"' class='active'>Next</li>";
	} else if (next_btn) {
		paginglist += "<li class='inactive'>Next</li>";
	}

	for (i = end_loop; i >= start_loop; i--) {
		if (cur_page == i)
			paginglist += "<li id='cpage' p='"+i+"' style='color:#fff;background-color:#000000;' class='active' value='"+i+"'>"+i+"</li>";
		else
			paginglist += "<li p='"+i+"' class='active'>"+i+"</li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if (previous_btn && cur_page > 1) {
		pre = parseInt(cur_page)-1;
		paginglist += "<li p='"+pre+"' class='active'>Prev</li>";
	} else if (previous_btn) {
		paginglist += "<li class='inactive'>Prev</li>";
	}

	// FOR ENABLING THE FIRST BUTTON
	if (first_btn && cur_page > 1) {
		paginglist += "<li p='1' class='active'><<</li>";
	} else if (first_btn) {
		paginglist += "<li p='1' class='inactive'><<</li>";
	}

	paginglist +="<li class='pagetotal'>"+pawal+"-"+pakhir+" from "+count+"</li>";
	//paginglist +="<li id='smute' style='color:#fff;background-color:#000000;' class='active'>Mute</li>";
	//paginglist +="<li id='son' style='color:#fff;background-color:#000000;' class='active'>On</li>";

	viewdata = "<div align=\'center\'><table width='98%' class='\tpaging\' CELLSPACING=\'2\' CELLSPADDING=\'2\'><tr><td>"+paginglist+"</td></tr></table>";
	return viewdata;
}

function viewerPagingX(page,no_of_paginations,total,per_page)
{
	//var page;
	var cur_page = parseInt(page);
	page -= 1;
	//var per_page = 5; // Per page
	var previous_btn = true;
	var next_btn = true;
	var first_btn = true;
	var last_btn = true;
	var start;
	//var no_of_paginations=nop;

	start = page * per_page;

	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if (cur_page >= 7) {
		start_loop = parseInt(cur_page) - 3;//4, nop 51, data 10001, per page 20
		if (no_of_paginations > cur_page + 3)
			end_loop = parseInt(cur_page) + 3;
		else if (cur_page <= no_of_paginations && cur_page > no_of_paginations - 6) {
			start_loop = no_of_paginations - 6;
			end_loop = no_of_paginations;
		} else {
			end_loop = no_of_paginations;
		}
	} else {
		start_loop = 1;
		if (no_of_paginations > 7)
			end_loop = 7;
		else
			end_loop = no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	var pawal;
	var count=total;
	var pakhir;

	pawal=((cur_page-1)*per_page)+1;
	pakhir=cur_page*per_page;
	if(pakhir>count){
		pakhir=count;
	}
	if(count==0){
		pawal=0;
	}

	var paginglist="";
	
	paginglist += "<div class='pagination'><ul>";
	paginglist += "<div class='pagination'><ul>";

	// TO ENABLE THE END BUTTON
	if (last_btn && cur_page < no_of_paginations) {
		paginglist += "<li p='"+no_of_paginations+"' class='active'>>></li>";
	} else if (last_btn) {
		paginglist += "<li p='"+no_of_paginations+"' class='inactive'>>></li>";
	}

	// TO ENABLE THE NEXT BUTTON
	if (next_btn && cur_page < no_of_paginations) {
		nex=parseInt(cur_page)+1;
		paginglist += "<li p='"+nex+"' class='active'>Berikutnya</li>";
	} else if (next_btn) {
		paginglist += "<li class='inactive'>Berikutnya</li>";
	}

	for (i = end_loop; i >= start_loop; i--) {
		if (cur_page == i)
			paginglist += "<li id='cpage' p='"+i+"' style='color:#fff;background-color:#000000;' class='active' value='"+i+"'>"+i+"</li>";
		else
			paginglist += "<li p='"+i+"' class='active'>"+i+"</li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if (previous_btn && cur_page > 1) {
		pre = parseInt(cur_page)-1;
		paginglist += "<li p='"+pre+"' class='active'>Sebelumnya</li>";
	} else if (previous_btn) {
		paginglist += "<li class='inactive'>Sebelumnya</li>";
	}

	// FOR ENABLING THE FIRST BUTTON
	if (first_btn && cur_page > 1) {
		paginglist += "<li p='1' class='active'><<</li>";
	} else if (first_btn) {
		paginglist += "<li p='1' class='inactive'><<</li>";
	}

	paginglist +="<li class='pagetotal'>"+pawal+"-"+pakhir+" dari "+count+"</li>";
	paginglist +="<li id='cnew' class='active'>Buat Baru</li>";

	viewdata = "<div align=\'center\'><table width='98%' class='\tpaging\' CELLSPACING=\'2\' CELLSPADDING=\'2\'><tr><td>"+paginglist+"</td></tr></table>";
	return viewdata;
}

function viewerPaging(page,no_of_paginations,total,per_page)
{
	//var page;
	var cur_page = parseInt(page);
	page -= 1;
	//var per_page = 5; // Per page
	var previous_btn = true;
	var next_btn = true;
	var first_btn = true;
	var last_btn = true;
	var start;
	//var no_of_paginations=nop;

	start = page * per_page;

	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if (cur_page >= 7) {
		start_loop = parseInt(cur_page) - 3;//4, nop 51, data 10001, per page 20
		if (no_of_paginations > cur_page + 3)
			end_loop = parseInt(cur_page) + 3;
		else if (cur_page <= no_of_paginations && cur_page > no_of_paginations - 6) {
			start_loop = no_of_paginations - 6;
			end_loop = no_of_paginations;
		} else {
			end_loop = no_of_paginations;
		}
	} else {
		start_loop = 1;
		if (no_of_paginations > 7)
			end_loop = 7;
		else
			end_loop = no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	var pawal;
	var count=total;
	var pakhir;

	pawal=((cur_page-1)*per_page)+1;
	pakhir=cur_page*per_page;
	if(pakhir>count){
		pakhir=count;
	}
	if(count==0){
		pawal=0;
	}

	var paginglist="";
	
	paginglist += "<div class='pagination'><ul>";
	paginglist += "<div class='pagination'><ul>";

	// TO ENABLE THE END BUTTON
	if (last_btn && cur_page < no_of_paginations) {
		paginglist += "<li p='"+no_of_paginations+"' class='active'>>></li>";
	} else if (last_btn) {
		paginglist += "<li p='"+no_of_paginations+"' class='inactive'>>></li>";
	}

	// TO ENABLE THE NEXT BUTTON
	if (next_btn && cur_page < no_of_paginations) {
		nex=parseInt(cur_page)+1;
		paginglist += "<li p='"+nex+"' class='active'>Berikutnya</li>";
	} else if (next_btn) {
		paginglist += "<li class='inactive'>Berikutnya</li>";
	}

	for (i = end_loop; i >= start_loop; i--) {
		if (cur_page == i)
			paginglist += "<li id='cpage' p='"+i+"' style='color:#fff;background-color:#000000;' class='active' value='"+i+"'>"+i+"</li>";
		else
			paginglist += "<li p='"+i+"' class='active'>"+i+"</li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if (previous_btn && cur_page > 1) {
		pre = parseInt(cur_page)-1;
		paginglist += "<li p='"+pre+"' class='active'>Sebelumnya</li>";
	} else if (previous_btn) {
		paginglist += "<li class='inactive'>Sebelumnya</li>";
	}

	// FOR ENABLING THE FIRST BUTTON
	if (first_btn && cur_page > 1) {
		paginglist += "<li p='1' class='active'><<</li>";
	} else if (first_btn) {
		paginglist += "<li p='1' class='inactive'><<</li>";
	}

	paginglist +="<li class='pagetotal'>"+pawal+"-"+pakhir+" dari "+count+"</li>";
	viewdata = "<div align=\'center\'><table width='98%' class='\tpaging\' CELLSPACING=\'2\' CELLSPADDING=\'2\'><tr><td>"+paginglist+"</td></tr></table>";
	return viewdata;
}

function viewerTime(time)
{
	if(time!=''&&time!='0'&&time!='0000-00-00 00:00:00')
	{	
	//hari=getHari(substr($time,8,2),substr($time,5,2),substr($time,0,4));
	var tgl=time.substr(8,2);
	var bln=time.substr(5,2);
	var thn=time.substr(0,4);
	var hh=time.substr(11,2);
	var mm=time.substr(14,2);
	var ss=time.substr(17,2);
	var hari=getNamaHari(thn,bln,tgl);

	var temp='';
	//bulan-1
	var pbulan=bln-1;
	//newday=thn+'/'+bln+'/'+tgl;
	var currTime = new Date(thn,pbulan,tgl,parseInt(hh),parseInt(mm),parseInt(ss));
	//var day = new Date(newday).getDay();

	var today=new Date();
	//var laterdate = new Date(2000,0,1);     // 1st January 2000
	var difference = today.getTime() - currTime.getTime();
	//var daysDifference = Math.floor(difference/1000/60/60/24);
	var daysDifference = Math.floor(difference/1000/60/60/24);
	var hoursDifference = Math.floor(difference/1000/60/60);

	/*
		if(daysDifference=='0'){
		if(tgl!=today.getDate()){
			temp='Kemarin, '+hh+':'+mm;
		}else{
			temp='<b>Hari ini, '+hh+':'+mm+':'+ss+'</b>';
		}		
	}else if(daysDifference=='1'){
		if(hoursDifference<=24){
			temp='Kemarin, '+hh+':'+mm;
		}else{
		temp=hari+','+hh+':'+mm+':'+ss;
	
		}
	}else if((daysDifference>1)&&(daysDifference<=7)){
		temp=hari+','+hh+':'+mm+':'+ss;
		//temp=','+hh+':'+mm+':'+ss;

	}else{
		temp=tgl+' '+getNamaBulan(bln)+' '+thn;

	}*/
	temp='<b>'+tgl+' '+getNamaBulan(bln)+' '+thn+','+hh+':'+mm+':'+ss+'</b>';
	
	}else{
		temp='-';
	}
	
	//return daysDifference+'#'+currTime+'#'+thn+'#'+temp;
	//return hoursDifference+'#'+currTime+'#'+tgl+'#'+bln+'#'+thn+'#'+temp;
	return temp;
}

function viewerDate(time)
{
	if(time!=''&&time!='0'&&time!='0000-00-00')
	{	
	//hari=getHari(substr($time,8,2),substr($time,5,2),substr($time,0,4));
	var tgl=time.substr(8,2);
	var bln=time.substr(5,2);
	var thn=time.substr(0,4);
	
	var hari=getNamaHari(thn,bln,tgl);

	var temp='';
	temp=tgl+' '+getNamaBulan(bln)+' '+thn;

	}else{
		temp='-';
	}
	return temp;
}

function getNamaBulan(bln) 
{    
    switch (bln) {
    case "01":
        return "Jan";
        break;
    case "02":
        return "Feb";
        break;
    case "03":
        return "Mar";
        break;
    case "04":
        return "Apr";
        break;
    case "05":
        return "Mei";
        break;
    case "06":
        return "Jun";
        break;
    case "07":
        return "Jul";
        break;
    case "08":
        return "Agt";
        break;
    case "09":
        return "Sept";
        break;
    case "10":
        return "Okt";
        break;
    case "11":
        return "Nov";
        break;
    case "12":
        return "Des";
        break;
    }
}

//function getNamaHari(thn,bln,tgl){
function getNamaHari(thn,bln,tgl){
	newday=thn+'/'+bln+'/'+tgl;
	//var day = new Date(parseInt(thn),parseInt(bln),parseInt(tgl)).getDay();
	var day = new Date(newday).getDay();
	//return day;
	switch (day){
	case 0:
		return "Minggu";
		break;
	case 1:
		return "Senin";
		break;
	case 2:
		return "Selasa";
		break;
	case 3:
		return "Rabu";
		break;
	case 4:
		return "Kamis";
		break;
	case 5:
		return "Jumat";
		break;
	case 6:
		return "Sabtu";
		break;
	} 
}

function viewerTimeAll(time)
{
	if(time!=''&&time!='0'&&time!='0000-00-00 00:00:00')
	{	
	//hari=getHari(substr($time,8,2),substr($time,5,2),substr($time,0,4));
	var tgl=time.substr(8,2);
	var bln=time.substr(5,2);
	var thn=time.substr(0,4);
	var hh=time.substr(11,2);
	var mm=time.substr(14,2);
	var ss=time.substr(17,2);
	var hari=getNamaHari(thn,bln,tgl);

	var temp='';
	//bulan-1
	var pbulan=bln-1;
	//newday=thn+'/'+bln+'/'+tgl;
	var currTime = new Date(thn,pbulan,tgl,parseInt(hh),parseInt(mm),parseInt(ss));
	//var day = new Date(newday).getDay();

	var today=new Date();
	//var laterdate = new Date(2000,0,1);     // 1st January 2000
	var difference = today.getTime() - currTime.getTime();
	//var daysDifference = Math.floor(difference/1000/60/60/24);
	var daysDifference = Math.floor(difference/1000/60/60/24);
	var hoursDifference = Math.floor(difference/1000/60/60);

	if(daysDifference=='0'){
		if(tgl!=today.getDate()){
			temp='Kemarin, '+hh+':'+mm;
		}else{
			temp='<b>Hari ini, '+hh+':'+mm+':'+ss+'</b>';
		}		
	}else if(daysDifference=='1'){
		if(hoursDifference<=24){
			temp='Kemarin, '+hh+':'+mm+':'+ss;
		}else{
		temp=hari+','+hh+':'+mm+':'+ss;
	
		}
	}else if((daysDifference>1)&&(daysDifference<=7)){
		temp=hari+','+hh+':'+mm+':'+ss;
		//temp=','+hh+':'+mm+':'+ss;

	}else{
		temp=tgl+' '+getNamaBulan(bln)+' '+thn+' '+hh+':'+mm+':'+ss;;

	}
	}else{
		temp='-';
	}
	//return daysDifference+'#'+currTime+'#'+thn+'#'+temp;
	//return hoursDifference+'#'+currTime+'#'+tgl+'#'+bln+'#'+thn+'#'+temp;
	return temp;
}



function viewerPagingNakes(page,no_of_paginations,total,per_page,today)
{
	//var page;
	var cur_page = parseInt(page);
	page -= 1;
	//var per_page = 5; // Per page
	var previous_btn = true;
	var next_btn = true;
	var first_btn = true;
	var last_btn = true;
	var start;
	//var no_of_paginations=nop;

	start = page * per_page;

	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if (cur_page >= 7) {
		start_loop = parseInt(cur_page) - 3;//4, nop 51, data 10001, per page 20
		if (no_of_paginations > cur_page + 3)
			end_loop = parseInt(cur_page) + 3;
		else if (cur_page <= no_of_paginations && cur_page > no_of_paginations - 6) {
			start_loop = no_of_paginations - 6;
			end_loop = no_of_paginations;
		} else {
			end_loop = no_of_paginations;
		}
	} else {
		start_loop = 1;
		if (no_of_paginations > 7)
			end_loop = 7;
		else
			end_loop = no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	var pawal;
	var count=total;
	var pakhir;

	pawal=((cur_page-1)*per_page)+1;
	pakhir=cur_page*per_page;
	if(pakhir>count){
		pakhir=count;
	}
	if(count==0){
		pawal=0;
	}

	var paginglist="";
	
	paginglist += "<div class='pagination'><ul>";
	paginglist += "<div class='pagination'><ul>";

	// TO ENABLE THE END BUTTON
	if (last_btn && cur_page < no_of_paginations) {
		paginglist += "<li p='"+no_of_paginations+"' class='active'>>></li>";
	} else if (last_btn) {
		paginglist += "<li p='"+no_of_paginations+"' class='inactive'>>></li>";
	}

	// TO ENABLE THE NEXT BUTTON
	if (next_btn && cur_page < no_of_paginations) {
		nex=parseInt(cur_page)+1;
		paginglist += "<li p='"+nex+"' class='active'>Berikutnya</li>";
	} else if (next_btn) {
		paginglist += "<li class='inactive'>Berikutnya</li>";
	}

	for (i = end_loop; i >= start_loop; i--) {
		if (cur_page == i)
			paginglist += "<li id='cpage' p='"+i+"' style='color:#fff;background-color:#000000;' class='active' value='"+i+"'>"+i+"</li>";
		else
			paginglist += "<li p='"+i+"' class='active'>"+i+"</li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if (previous_btn && cur_page > 1) {
		pre = parseInt(cur_page)-1;
		paginglist += "<li p='"+pre+"' class='active'>Sebelumnya</li>";
	} else if (previous_btn) {
		paginglist += "<li class='inactive'>Sebelumnya</li>";
	}

	// FOR ENABLING THE FIRST BUTTON
	if (first_btn && cur_page > 1) {
		paginglist += "<li p='1' class='active'><<</li>";
	} else if (first_btn) {
		paginglist += "<li p='1' class='inactive'><<</li>";
	}

	paginglist +="<li class='pagetotal'>"+pawal+"-"+pakhir+" dari "+count+"</li>";
	paginglist +="<li class='c' id='cdownload'>Download</li>";
	paginglist +="<li class='c' id='cfilter'>Filter</li>";
	paginglist +="<li class='c' id='csearch'>Search</li>";
	paginglist +="<li class='c' id='ccsv'>Import Data XLS</li>";
	paginglist +="<li class='c' id='cnew'>Tambah Data Baru</li>";

	viewdata = "<div align=\'center\'><table width='98%' class='\tpaging\' CELLSPACING=\'2\' CELLSPADDING=\'2\'><tr><td>"+paginglist+"</td></tr></table>";
	return viewdata;
}

function viewerPagingReport(page,no_of_paginations,total,per_page,today)
{
	//var page;
	var cur_page = parseInt(page);
	page -= 1;
	//var per_page = 5; // Per page
	var previous_btn = true;
	var next_btn = true;
	var first_btn = true;
	var last_btn = true;
	var start;
	//var no_of_paginations=nop;

	start = page * per_page;

	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if (cur_page >= 7) {
		start_loop = parseInt(cur_page) - 3;//4, nop 51, data 10001, per page 20
		if (no_of_paginations > cur_page + 3)
			end_loop = parseInt(cur_page) + 3;
		else if (cur_page <= no_of_paginations && cur_page > no_of_paginations - 6) {
			start_loop = no_of_paginations - 6;
			end_loop = no_of_paginations;
		} else {
			end_loop = no_of_paginations;
		}
	} else {
		start_loop = 1;
		if (no_of_paginations > 7)
			end_loop = 7;
		else
			end_loop = no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	var pawal;
	var count=total;
	var pakhir;

	pawal=((cur_page-1)*per_page)+1;
	pakhir=cur_page*per_page;
	if(pakhir>count){
		pakhir=count;
	}
	if(count==0){
		pawal=0;
	}

	var paginglist="";
	
	paginglist += "<div class='pagination'><ul>";
	paginglist += "<div class='pagination'><ul>";

	// TO ENABLE THE END BUTTON
	if (last_btn && cur_page < no_of_paginations) {
		paginglist += "<li p='"+no_of_paginations+"' class='active'>>></li>";
	} else if (last_btn) {
		paginglist += "<li p='"+no_of_paginations+"' class='inactive'>>></li>";
	}

	// TO ENABLE THE NEXT BUTTON
	if (next_btn && cur_page < no_of_paginations) {
		nex=parseInt(cur_page)+1;
		paginglist += "<li p='"+nex+"' class='active'>Berikutnya</li>";
	} else if (next_btn) {
		paginglist += "<li class='inactive'>Berikutnya</li>";
	}

	for (i = end_loop; i >= start_loop; i--) {
		if (cur_page == i)
			paginglist += "<li id='cpage' p='"+i+"' style='color:#fff;background-color:#000000;' class='active' value='"+i+"'>"+i+"</li>";
		else
			paginglist += "<li p='"+i+"' class='active'>"+i+"</li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if (previous_btn && cur_page > 1) {
		pre = parseInt(cur_page)-1;
		paginglist += "<li p='"+pre+"' class='active'>Sebelumnya</li>";
	} else if (previous_btn) {
		paginglist += "<li class='inactive'>Sebelumnya</li>";
	}

	// FOR ENABLING THE FIRST BUTTON
	if (first_btn && cur_page > 1) {
		paginglist += "<li p='1' class='active'><<</li>";
	} else if (first_btn) {
		paginglist += "<li p='1' class='inactive'><<</li>";
	}

	paginglist +="<li class='pagetotal'>"+pawal+"-"+pakhir+" dari "+count+"</li>";
	paginglist +="<li class='c' id='cprint'>Print</li>";
	paginglist +="<li class='c' id='cdownload'>Download Excel</li>";

	viewdata = "<div align=\'center\'><table width='98%' class='\tpaging\' CELLSPACING=\'2\' CELLSPADDING=\'2\'><tr><td>"+paginglist+"</td></tr></table>";
	return viewdata;
}
