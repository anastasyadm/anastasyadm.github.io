<?php require "tools.php"; 
	
	$sh_arr = $_POST['sh_price'];
	$width_arr = $_POST['width_height_price'];
	$metr_arr = $_POST['metr_price'];
	
	//$cnt = count($resprice);
	
	$metr=$_POST['metr'];
	
	$width = $_POST['width'];
	
	$height = $_POST['height'];
	
	$sh = $_POST['sh'];

	$sh_price = $sh_arr['sh']*$sh_arr['price'];
	$metr_price = $metr_arr['metr']*$metr_arr['price'];
	echo $sh_price;
	echo $metr_price;
	/*
	$i=0;
	while($i<=$cnt){
		$pwh =$resprice[$i]*$width[$i]*$height[$i];
		$psh =$resprice[$i]*$sh[$i];
		$m = $resprice[$i]*$metr[$i];
		
		echo "
		<div class='pwh'>$pwh</div>
		<div class='pr'>$psh</div>
		<div class='psh'>$m</div>
		<div class='pr'>$resprice[$i]</div>
		<div class='metr'>$metr[$i]</div>
		<div class='width'>$width[$i]</div>
		<div class='height'>$height[$i]</div>
		<div class='sh'>$sh[$i]</div>";
		$i++;
	}
	$summ = $pwh+$psh+$m;
	echo $summ;
*/
?>
