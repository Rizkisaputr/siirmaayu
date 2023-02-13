function tS(){ x=new Date(); x.setTime(x.getTime()); return x; } 
function lZ(x){ return (x>9)?x:'0'+x; } 
function tH(x){ if(x==0){ x=00; } return x; } 
//function tH(x){ if(x==0){ x=12; } return (x>12)?x-=12:x; } 
function y2(x){ x=(x<500)?x+1900:x; return String(x).substring(0,4) } 

function dT(){ window.status=''+eval(oT)+''; document.getElementById('tP').innerHTML=eval(oT); setTimeout('dT()',1000); } 

function aP(x){ return (x>11)?'PM':'AM'; } 

var dN=new Array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'),mN=new Array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'),oT="dN[tS().getDay()]+', '+tS().getDate()+' '+mN[tS().getMonth()]+' '+y2(tS().getYear())+' '+' '+' '+lZ(tH(tS().getHours()))+':'+lZ(tS().getMinutes())+':'+lZ(tS().getSeconds())";
//+' '+aP(tS().getHours())";

if(!document.all){ window.onload=dT; }else{ dT(); }
