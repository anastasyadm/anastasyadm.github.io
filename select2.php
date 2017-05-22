<?php require "tools.php"; 

$aboutt=$_POST['about_service'];
$c = count($aboutt);
$i=0;
while($i<$c){
	$price = mysql_query("select price from service where about_service='$aboutt[$i]'") or die(mysql_error());
	while($resprice = mysql_fetch_array($price)){
		$units = mysql_query("select units from service where about_service='$aboutt[$i]'") or die(mysql_error());
		$resunits = mysql_fetch_array($units);
		
		if($resunits[0]=='п. м.'){
				echo "
				
					<input type='text' class='date' id='metr' name='metr' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Сколько метров?'>
					<input name='idid' value='$resprice[0]' hidden>
				";
		} 
		if($resunits[0]=='кв. м.'){
			
				echo "<input type='text' class='date' id='width' name='width' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Ширина'>
				<input type='text' class='date' id='height' name='height' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Высота'>
				<input name='idid' value='$resprice[0]' hidden>
				";
		}
		if($resunits[0]=='шт.'){
			echo "
				
					<input type='text' class='date' id='sh' name='sh' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Сколько штук?'>
					<input id='price' name='price' value='$resprice[0]' hidden>
				";
			
		}
		
		
	}
	$i++;
	
}
echo "<input type='submit' class='btn click2' name='submit' value='Далее'>

<div class='result'></div>";

?>
<script>
$('.cal3').ready ( function(){
	$('.click2').click(function(){
		
			var cell = [];
			/*cell['metr'] = input.value;
			cell['width'] = input.value;
			cell['height'] = input.value;
			cell['price'] = input.value;
			cell['sh'] = input.value;*/
			
			var cell['metr'] = $('#metr').val();
			var cell['width'] = $('#width').val();
			var cell['height'] = $('#height').val();
			var cell['price'] = $('#price').val();
			alert(cell['price']);
			var cell['sh'] = $('#sh').val();
		
			if(cell['metr'] === undefined){
				metr=0;
			}
			if(cell['width'] === undefined){
				width=0;
			}
			if( cell['height']===undefined){
				height=0;
			}
			if(cell['sh'] === undefined){
				sh=0;
			}
					$.ajax({
						url: 'select.php',
						type: 'post',
						data: { 
							metr: cell['metr'],
							width: cell['width'],
							height: cell['height'],
							price: cell['price'],
							sh: cell['sh']
						},
						success: function(data) {  
						$('.result').html(data);
						}
					});
				});
			
		});
</script>