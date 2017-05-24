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
		<?php
			echo "
				<form method='post' action='services.php'>
					<div class='cal'>
				";
			$name = mysql_query("select distinct name_service from service");
			$count=0;
			while($result = mysql_fetch_array($name)){
				$count++;
				echo "
						<div style='display:block'>
							<input type='checkbox' class='cb' name='name_service[]'  value='$result[0]'/>
							<label for='cb$count'>$result[0]</label>
						</div>
				
					";
			}
			echo "<input type='submit' class='btn' name='mysub' value='Далее'>
				</div>
			</form>
			";
			?>
			<?
			if (isset($_POST['mysub'])){
				$name=$_POST['name_service'];
				$count = count($name);
				$i=0;
				echo "
						<div class='cal cal2'>";
				while($i<$count){
					$about = mysql_query("select about_service from service where name_service='$name[$i]'") or die(mysql_error());
					while($resabout = mysql_fetch_array($about)){
						echo "<div style='display:block'>
								<input type='checkbox' class='about_service' name='about_service[]'  value='$resabout[0]'/>
								<label for='cb$count'>$resabout[0]</label>
							 </div>
							";
					}
				$i++;
				}
				echo "<input type='submit' class='btn click' name='subsub' value='Далее'>";
				
			}
			echo "
				</div>
			<div class='cal cal3' id='mymenu'></div>
			";
			?>		
						
			</div>
		<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
		<script src="js/script.js"></script>
		<script>
			$('.cal2').ready ( function(){
				$('.click').click(function(){
					var checked = [];
					$(':checkbox:checked').each(function () {
    					checked.push($(this).val());
					});
					
					$.ajax({
					url: 'select2.php',
					type: 'post',
					data: { about_service: checked },
					success: function(data) {  
						$('.cal3').html(data);
						}
					});
				});
			});
		</script>
		
		</main>
	</body>
</html>
	