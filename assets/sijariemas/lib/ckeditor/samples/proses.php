<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sample &mdash; CKEditor</title>
	<link rel="stylesheet" href="sample.css">
</head>
<body>
<?php

$editor1 = (isset($_REQUEST["editor1"])) ? $_REQUEST["editor1"] : "-";  
if(get_magic_quotes_gpc()){
	$postedValue = htmlspecialchars(stripslashes($editor1));
}else{
	$postedValue = htmlspecialchars($editor1);
}
echo $postedValue;
?>
</body>
</html>
