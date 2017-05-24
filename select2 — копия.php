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
					<input type='text' class='metr_price' name='idid' value='$resprice[0]' hidden>
				";
		} 
		if($resunits[0]=='кв. м.'){
			
				echo "<input type='text' class='date width un' id='width' name='width' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Ширина'>
				<input type='text' class='date height un' id='height' name='height' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Высота'>
				<input type='text' class='width_price' name='idid' value='$resprice[0]' hidden>
				";
		}
		if($resunits[0]=='шт.'){
			echo "
				
					<input type='text' class='date sh un' id='sh' name='sh' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' placeholder='Сколько штук?'>
					<input type='text' class='sh_price' id='price' name='price' value='$resprice[0]' hidden>
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

			var cnt1 = document.getElementById('mymenu').getElementsByClassName('sh').length;
			//var cnt2 = document.getElementById('mymenu').getElementsByClassName('mtr').length;
			//var cnt = document.getElementById('mymenu').getElementsByClassName('sh').length;
			alert(cnt1);
			//while(cnt > 0){
				for (var i=О; i < cnt1; i++){
					var sh_price = {};
					$(".sh").each(function(indx, element){
  					sh_price.[i]sh = ($(element).val());
					});
					$(".sh_price").each(function(indx, element){
  						sh_price.price{i} = ($(element).val());
					});
				}
				
				
				$(".metr").each(function(indx, element){
  					metr_price.metr = ($(element).val());
				});
				$(".metr_price").each(function(indx, element){
  					metr_price.price = ($(element).val());
				});
					
				
		
		
				$(".width").each(function(indx, element){
  					width_height_price.width = ($(element).val());
				});
				$(".height").each(function(indx, element){
  					width_height_price.height = ($(element).val());
				});
				$(".width_price").each(function(indx, element){
  					width_height_price.price = ($(element).val());
				});
				
		
		
				/*$(".sh").each(function(indx, element){
  					sh_price.sh = ($(element).val());
				});
				$(".sh_price").each(function(indx, element){
  					sh_price.price = ($(element).val());
				});
				cell['metr'] = $('.metr').val();
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

				if(metr_price.metr === undefined){
					metr_price.metr=0;
				}
				if(width_height_price.width === undefined){
					width_height_price.width=0;
				}
				if(width_height_price.height===undefined){
					width_height_price.height=0;
				}
				if(width_height_price.price===undefined){
					width_height_price.price=0;
				}
				if(sh_price.sh === undefined){
					sh_price.sh=0;
				}
			alert(arr);
			alert(metr_price.metr + ': ' + metr_price.price );
			alert(sh_price.sh + ': ' + sh_price.price );
			alert(width_height_price.width + ': ' + width_height_price.height + ': ' + width_height_price.price);
			/*alert(metr);
			alert(width);
			alert(height);
			alert(price);
			alert(sh)*/
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
							metr_price: metr_price,
							sh_price: sh_price,
							width_height_price: width_height_price
						},
						success: function(data) {  
						$('.result').html(data);
						}
					});
				});
			
		});
</script>