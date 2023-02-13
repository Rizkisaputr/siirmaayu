<?
//This page contains an array of colors to be used as default set of colors for FusionCharts
//arr_FCColors is the array that would contain the hex code of colors 
//ALL COLORS HEX CODES TO BE USED WITHOUT #


//We also initiate a counter variable to help us cyclically rotate through
//the array of colors.
$FC_ColorCounter=0;

$arr_FCColors[0] = "1941A5";
$arr_FCColors[1] = "FF9933";
$arr_FCColors[2] = "8BBA00";
$arr_FCColors[3] = "A66EDD";
$arr_FCColors[4] = "F984A1" ;
$arr_FCColors[5] = "CCCC00" ;//Chrome Yellow+Green
$arr_FCColors[6] = "999999" ;//Grey
$arr_FCColors[7] = "0099CC" ;//Blue Shade
$arr_FCColors[8] = "FF0000" ;//Bright Red 
$arr_FCColors[9] = "006F00" ;//Dark Green
$arr_FCColors[10] = "0099FF"; //Blue (Light)
$arr_FCColors[11] = "FF66CC" ;//Dark Pink
$arr_FCColors[12] = "669966" ;//Dirty green
$arr_FCColors[13] = "7C7CB4" ;//Violet shade of blue
$arr_FCColors[14] = "FFFF33" ;//Orange
$arr_FCColors[15] = "9900FF" ;//Violet
$arr_FCColors[16] = "99FFCC" ;//Blue+Green Light
$arr_FCColors[17] = "CCCCFF" ;//Light violet
$arr_FCColors[18] = "669900" ;//Shade of green
$arr_FCColors[0] = "AFD8F8" ;//Dark Blue

//getFCColor method helps return a color from arr_FCColors array. It uses
//cyclic iteration to return a color from a given index. The index value is
//maintained in FC_ColorCounter

function getFCColor() 
{
	//accessing the global variables
	global $FC_ColorCounter;
	global $arr_FCColors;
	
	//Update index
	$FC_ColorCounter++;
	//Return color
	return($arr_FCColors[$FC_ColorCounter % count($arr_FCColors)]);
}
?>