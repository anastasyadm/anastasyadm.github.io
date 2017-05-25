<?php require "tools.php"; 
	$metr=$_POST['metr'];

	$cnt = count($metr);
	$width = $_POST['width'];
	$cnt3 = count($width);	
	
	$sh = $_POST['sh'];
	$cnt2 = count($sh);

	$temp = 0; 
	$i=0; 
	while($i<($cnt-1)){ 
		$temp+=($metr[$i]*$metr[$i+1]); 
		$i+=2; 
	} 
	$res = 0; 
	$i=0; 
	while($i<($cnt2-1)){ 
		$res+=($sh[$i]*$sh[$i+1]); 
		$i+=2; 
	} 
	$wid = 0; 
	$i=0; 
	while($i<($cnt3-1)){ 
		$wid+=($width[$i]*$width[$i+1]*$width[$i+2]); 
		$i+=3; 
	}
	$summ = $res+$temp+$wid;
	echo "<p class='table-title' style='margin-top: 15px;'>Стоимость:$summ руб.</p>";

?>
