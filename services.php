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
 	<header class="admin">
 		<div class="container">
			
			<nav>
				<ul class="menu">
					<li><a href="index.php">О компании</a></li>
					<li><a href="reviews.php">Отзывы</a></li>
					<li><a class="active4" href="services.php">Услуги</a></li>
					<li><a href="index.php#contacts">Контакты</a></li>
					<?php
					if (isset($_POST['logsubmit'])){
						log_in();}
					if (isset($_POST['submit'])){
          				registration();}
					
					if($_SESSION['author']==True){
						echo "<li class='user-block'>
							<a class='cabinet' href='me.php'>Личный кабинет</a>
							</li>
				     	<li style='float:right; margin-right: 10px;'>
							<a href='index.php?log_out='go' style='margin-right: 10px;'>Выйти</a>
						</li>";
					}
					else{
						echo "
						<a class='icon-basket show_popup' href='#popup2'>Войти</a>
						<a class='regist show_popup' style='padding-right:10px;' href='#popup1'>Регистрация</a>
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
			<div style='width: 100%;'>
		<?php
			echo "
				<form method='post' action='services.php'>
					<div class='cal cal1'>
				";
			$name = mysql_query("select distinct name_service from service");
			$count=0;
			while($result = mysql_fetch_array($name)){
				$count++;
				echo "
						<div style='display:block'>
							<input type='checkbox' id='cb$count' class='cb' name='name_service[]'  value='$result[0]'/>
							<label for='cb$count'>$result[0]</label>
						</div>
				
					";
			}
			echo "<input type='submit' class='abtn' name='mysub' value='Далее'>
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
						<div class='cal cal2' >";
				while($i<$count){
					$about = mysql_query("select about_service from service where name_service='$name[$i]'") or die(mysql_error());
					while($resabout = mysql_fetch_array($about)){
						$count++;
						echo "<div style='display:block'>
								<input type='checkbox' id='cr$count' class='about_service' name='about_service[]'  value='$resabout[0]'/>
								<label for='cr$count'>$resabout[0]</label>
							 </div>
							";
					}
				$i++;
				}
				echo "<input type='submit' class='abtn click' name='subsub' value='Далее'>";
				
			}
			echo "
				</div>
			<div class='cal cal3' id='mymenu'></div>
			";
			?>		
				</div>		
			</div>
		<div class="overlay_popup"></div>
	<form action="services.php" method="post" class="regist-form popup" id="popup1">
		<p class="name">
			<label for="name">Ваше имя:</label><input type="text" id="name" name="name" placeholder="Имя" required>
		</p>
		<p class="surname">
			<label for="surname">Ваша фамилия:</label><input type="text" id="surname" name="surname" placeholder="Фамилия" required>
		</p>
		<p class="e-mail">
			<label for="email">Ваш e-mail:</label><input type="email" id="email" name="email" required>
		</p>
		<p class="password">
			<label for="password">Пароль:</label><input type="password" id="password" name="password" required>
		</p>
		<p class="phone">
			<label for="phone">Телефон:</label><input type="text" id="phone" name="phone" title="Пример 89107654321" pattern="[0-9]{11}" placeholder="89107654321" required>
		</p>
		<div class="form-butt">
			<input type="submit" id="submit" name="submit" class="btn feedback-submit" value="Зарегистрировать">
			<a href="#" class="btn regist-cancel modal_close">Отмена</a>
		</div>
	</form>
	
<!-- login form-->
	<form action="services.php" method="POST" class="login-form popup" id="popup2">
		<p class="e-mail">
			<label for="logemail">Ваш e-mail:</label><input type="email" id="logemail" name="logemail" required>
		</p>
		<p class="password">
			<label for="logpassword">Пароль:</label><input type="password" id="logpassword" name="logpassword" required>
		</p>
		<div class="form-login-butt">
			<input type="submit" name="logsubmit" class="btn feedback-submit" value="Войти">
			<a href="#" class="btn login-cancel modal_close">Отмена</a>
		</div>
	</form>
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
	