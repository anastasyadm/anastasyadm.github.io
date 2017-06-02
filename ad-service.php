<?php require "tools.php" ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>Remokon - Услуги</title>
   <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,300&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="img/minilogo.png" width="15" height="25" type="image/x-icon">
 </head>
 <body>
 
 <!-- Header -->
  	<header class="admin">
  		<div class="container">
 			
 			<nav>
 				<ul class="menu">
 					<li><a href="admin.php">Сотрудники</a></li>
					<li><a href="review-admin.php">Отзывы</a></li>
					<li><a class="active4" href="ad-service.php">Услуги</a></li>
					<li><a href="celendar.php">Календарь</a></li>
 					<?php
 					if (isset($_POST['logsubmit'])){
 						log_in();}
 					if (isset($_POST['submit'])){
           				registration();}
 					
 					if($_SESSION['admin']==True){
						echo "<li class='user-block'>
							<a class='cabinet' href='adme.php'>Личный кабинет</a>
				      	</li>
				     	<li style='float:right; margin-right: 10px;'>
							<a href='index.php?log_out='go'>Выйти</a>
						</li>";
					}
					else{
						echo "
						<a class='icon-basket' href='#'>Войти</a>
						<a class='icon-regist' href='#' style='padding-right:10px;' href='#'>Регистрация</a>
						";
					}
 					?>
 				</ul>
 			</nav>
 			<a class="header-logo" href="admin.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
 		</div>
 	</header>
 	<main>
 		<div class="container">
 			<table>
				<tr>
         			<td style='padding: 20px 0;'><p class='table-title'>Тип услуги</p></td>
         			<td style='padding: 20px 0;'><p class='table-title'>Наименование<br>услуги</p></td>
					<td style='padding: 20px 0;'><p class='table-title'>Единицы<br>измерения</p></td>
 					<td style='padding: 20px 0;'><p class='table-title'>Цена</p></td>
					<td></td>
     				<td colspan='2' class='buttonnn'>
						<a class='btn set-submit show_popup' href='#popup3' style='border: none; margin: 0 30px; background-color: #568fda;'>Добавить услугу</a>
					</td>
     			</tr>
 					
 			<?php 
 				$all = mysql_query("select id_service from service");
 	          	while($resall = mysql_fetch_array($all)){
 					$name = mysql_query("SELECT distinct name_service FROM service WHERE id_service='$resall[0]'");
 					$resname = mysql_fetch_array($name);
 					$about = mysql_query("SELECT about_service FROM service WHERE id_service='$resall[0]'");
 					$resabout = mysql_fetch_array($about);
					$units = mysql_query("SELECT units FROM service WHERE id_service='$resall[0]'");
 					$resunits = mysql_fetch_array($units);
 					$price = mysql_query("SELECT price FROM service WHERE id_service='$resall[0]'");
 					$resprice = mysql_fetch_array($price);
 					echo "
					
     					<tr>
							<form method='post' action='ad-service.php'>
								<td class='td'><input type='text' class='date inname' id='name' name='name' value='$resname[0]'></td>
								<td class='td'><textarea class='textarea' rows='5' id='about' name='about'>$resabout[0]</textarea></td>
								<td class='td'><input type='text' class='date units' id='units' name='units' value='$resunits[0]'></td>
								<td class='td'><input type='text' class='date units' id='price' name='price' value='$resprice[0]'></td>
								<td class='td'><input type='text' name='idid' value='$resall[0]' hidden></td>
								<td class='td'><input type='submit' name='change-submit' class='btn text-submit' value='Изменить' style='border: none;'></td>
								<td class='td'><input type='submit' name='cancel-submit' class='btn text-submit' value='Удалить' style='border: none; background-color: #B0B7C6;'></td>
							</form>
     					</tr>
 					";
 			}
				
			if (isset($_POST['change-submit'])){
				$id = $_POST['idid'];
				$name = $_POST['name'];
				$about = $_POST['about'];
				$units = $_POST['units'];
				$price = $_POST['price'];
				mysql_query("UPDATE service SET 
										name_service='$name', 
										about_service='$about', 
										units='$units', 
										price='$price' 
										WHERE id_service='$id'") or die(mysql_error());
				echo '<script>location.replace("ad-service.php");</script>'; exit;
			}
			if (isset($_POST['cancel-submit'])){
				$id = $_POST['idid'];
				mysql_query("DELETE FROM service WHERE id_service='$id'") or die(mysql_error());
				echo '<script>location.replace("ad-service.php");</script>'; exit;
			}
			$count=0;
			if (isset($_POST['sub-submit'])){	
				$type_service = $_POST['type_service'];
				$about_service = $_POST['about_service'];
				$units_service = $_POST['units_service'];
				$price_service = $_POST['price_service'];
				if($count==0){
				$query=mysql_query("INSERT INTO service
									VALUES(default, '$type_service',
									'$about_service','$units_service', '$price_service', default)") or die(mysql_error());
				$count++;
				echo '<script>location.replace("ad-service.php");</script>'; exit;
				}

			}
 			?>
 			</table>
 		</div>
		<form action="ad-service.php" method="POST" class="regist-form popup" id="popup3">
			<p class="input-name" style="position: relative; top: -26px;">
		  		<label for="type_service">Тип услуги:</label> 
				<input type='text' id='type_service' name='type_service' placeholder="Окна ПВХ">
			</p>
			<p class="about_service">
			  	<label for="adress">Наименование услуги:</label>
				<textarea class="textarea" type="text" id="about_service" name="about_service" placeholder="Изготовление и установка глухого окна ПВХ"></textarea>
			</p>
			<p class="formdate">
			  	<label for="units_service">Единицы измерения:</label>
				<input type="text" id="units_service" name="units_service" placeholder="кв. м.">
			</p>
			<p class="time">
			  	<label for="price_service">Цена:</label>
				<input type="text" id="price_service" name="price_service" placeholder="1500">
			</p>
			<div class="form-btns">
			  <input type="submit" id="sub-submit" name="sub-submit" class="btn write-submit" value="Добавить">
			  <a href="#" class="btn write-cancel modal_close">Отмена</a>
			</div>
		</form>
		<div class="overlay_popup"></div>
 	</main>
	<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
	<script src="js/script.js"></script>
 </body>
 </html>