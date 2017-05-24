<?php require "tools.php"; 
	$metr=$_POST['metr'];
	//$metr = array_chunk($allmetr,2);
	$cnt = count($metr);
	//echo $cnt;
	$width = $_POST['width'];
	$cnt3 = count($width);	
	
	$sh = $_POST['sh'];
	$cnt2 = count($sh);


	//echo $metr[0][0];
	//echo $cnt;
 //1*2+3*4+5*6
	
	$temp = 0; 
	$i=0; 
	while($i<($cnt-1)){ 
		$temp+=($metr[$i]*$metr[$i+1]); 
		$i+=2; 
	} 
	//echo $temp;
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
	echo $wid;
	$summ = $res+$temp+$wid;
	echo $summ;
		/*for($i=0; $i<($cnt2);$i++){
			$s+=$sh[$i]*$sh[$i+1];	
		}
		//echo $s;
		
		for($i=0; $i<($cnt);$i++){
			for($j=0; $j<($cnt);$j++)
			$m[$j][$i]+=$metr[$j][$i]*$metr[0][$i+1];
			//$k=$m-$metr[$e]*$metr[$e+1];
				
		}
		//$k=$m[1]+$m[3];
		echo $m[$j][$i];
		$summ = $s+$k;
		//echo $summ;

	
*/
?>
