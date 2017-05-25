<?php require "tools.php" ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>Remokon - главная</title>
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
 					<li><a href="index.php">О компании</a></li>
 					<li><a href="review-admin.php">Отзывы</a></li>
 					<li><a class="active4" href="services.php">Услуги</a></li>
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
							<a href='index.php?log_out='go' style='margin-right: 10px;'>Выйти</a>
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
							
								<td class='td'><input type='text' class='date inname' id='write_date' name='write_date' value='$resname[0]'></td>
								<td class='td'><textarea class='textarea' rows='5' id='text_review' name='text_review'>$resabout[0]</textarea></td>
								<td class='td'><input type='text' class='date units' id='write_date' name='write_date' value='$resunits[0]'></td>
								<td class='td'><input type='text' class='date units' id='write_date' name='write_date' value='$resprice[0]'></td>
								<td class='td'><input type='submit' name='text-submit' class='btn text-submit' value='Изменить' style='border: none;'></td>
							
     					</tr>
 					
 					";
 			}
 			?>
 			</table>
 		</div>
 	</main>
 </body>
 </html>