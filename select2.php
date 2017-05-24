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
				
					<input type='text' class='date metr un' id='metr' name='metr' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Сколько метров?'>
					<input type='text' class='price un metr' name='idid' value='$resprice[0]' hidden>
				";
		} 
		if($resunits[0]=='кв. м.'){
			
				echo "<input type='text' class='date width un' id='width' name='width' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Ширина'>
				<input type='text' class='date height un width' id='height' name='height' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Высота'>
				<input type='text' class='price un width' name='idid' value='$resprice[0]' hidden>
				";
		}
		if($resunits[0]=='шт.'){
			echo "
				
					<input type='text' class='date sh un' id='sh' name='sh' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Сколько штук?'>
					<input type='text' class='price un sh' id='price' name='price' value='$resprice[0]' hidden>
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

			var cnt = document.getElementById('mymenu').getElementsByClassName('metr').length;
			//while(cnt > 0){
				var metr = [];
				var width = [];
				var sh = [];
				
				var i = 0;
				$(".metr").each(function(indx, element){
  					metr[i]=($(element).val());
					i++;
				});
				var k = 0;				
				$(".width").each(function(indx, element){
  					width[k]=($(element).val());
					k++;
				});
				var r = 0;
				$(".sh").each(function(indx, element){
  					sh[r]=($(element).val());
					r++;
				});
				/*cell['metr'] = $('.metr').val();
				cell['width'] = $('.width').val();
				cell['height'] = $('.height').val();
				cell['price'] = $('.price').val();
				cell['sh'] = $('.sh').val();*/
				/*cell['metr'] = input.value;
				cell['width'] = input.value;
				cell['height'] = input.value;
				cell['price'] = input.value;
				cell['sh'] = input.value;*/

				/*var cell['metr'] = $(this).val();
				var cell['width'] = $(this).val();
				var cell['height'] = $(this).val();
				var cell['price'] = $(this).val();
				alert(cell['price']);
				var cell['sh'] = $(this).val();*/

				if(metr === undefined){
					metr=0;
				}
				if(width === undefined){
					width=0;
				}
				/*if(height===undefined){
					height=0;
				}*/
				if(sh === undefined){
					sh=0;
				}
			/*alert(metr);
			alert(width);
			
			alert(sh);
				//cnt--;
			//}
			/*alert(cell['metr']);
			alert(cell['width']);
			alert(cell['height']);
			alert(cell['price']);
			alert(cell['sh']);*/
					$.ajax({
						url: 'select.php',
						type: 'post',
						data: { 
							metr: metr,
							width: width,
							sh: sh
						},
						success: function(data) {  
						$('.result').html(data);
						}
					});
				});
			
		});
</script>