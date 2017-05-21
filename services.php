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
					<li><a class="active" href="index.php">О компании</a></li>
					<li><a href="review-admin.php">Отзывы</a></li>
					<li><a href="services.php">Услуги</a></li>
					<li><a href="index.php#contacts">Контакты</a></li>
					<?php
					if (isset($_POST['logsubmit'])){
						log_in();}
					if (isset($_POST['submit'])){
          				registration();}
					
					if($_SESSION['author']==True){
						echo "<li class='user-block'>
							<a class='cabinet' href='#'>Личный кабинет</a>
							<ul class='mycabinet'>
				      	
								<li class='cabinettools'>
				      		<a href='index.php?log_out='go''>Выйти</a>
				      	</li>
				      </ul>
						</li>";
					}
					else{
						echo "
						<a class='icon-basket' href='#'>Войти</a>
						<a class='regist' href='#' style='padding-right:10px;' href='#'>Регистрация</a>
						";
					}
					?>
				</ul>
			</nav>
			<a class="header-logo" href="index.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
		</div>
	</header>
	<main>
		<div class="container">
			<table>
			<?php 
				$all = mysql_query("select id_service from service");
	          	while($resall = mysql_fetch_array($all)){
					$name = mysql_query("SELECT distinct name_service FROM service WHERE id_service='$resall[0]'");
					$resname = mysql_fetch_array($name);
					$about = mysql_query("SELECT about_service FROM service WHERE id_service='$resall[0]'");
					$resabout = mysql_fetch_array($about);
					$price = mysql_query("SELECT price FROM service WHERE id_service='$resall[0]'");
					$resprice = mysql_fetch_array($price);
					echo "
    					<tr>
        					<td>".$resname[0]."</td>
							
        						<td>".$resabout[0]."</td>
								<td>".$resprice[0]."</td>
    						
    					</tr>
					
					";
				}
			?>
			</table>
		</div>
	</main>
</body>
</html>
	