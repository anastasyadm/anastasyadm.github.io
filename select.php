<?php require "tools.php"; 

	$resprice = $_POST['price'];
	echo $resprice;
	$metr=$_POST['metr'];
	echo $metr;
	$width = $_POST['width'];
	echo $width;
	$height = $_POST['height'];
	echo $height;
	$sh = $_POST['sh'];
	echo $sh;
	$summ = $resprice*$width*$height+$resprice*$sh+$resprice*$metr;
	echo $summ;
	

?>
