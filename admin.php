<?php require "tools.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Remokon - главная</title>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,300&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/minilogo.png" width="15" height="25" type="image/x-icon">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>

<!-- Header -->
 	<header class="admin">
 		<div class="container">
			
			<nav>
				<ul class="menu">
					<li><a class="active" href="admin.php">Сотрудники</a></li>
					<li><a href="review-admin.php">Отзывы</a></li>
					<li><a href="#">Услуги</a></li>
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
					
					?>
				</ul>
			</nav>
			<a class="header-logo" href="admin.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
		</div>
	</header>
	<main>
		<div class="container">
		<?php 
		$id = mysql_query("select id_employee from employee");
		while($result = mysql_fetch_array($id)){
			$surname = mysql_query("select e_surname from employee where id_employee='$result[0]'");
			$ressurname = mysql_fetch_array($surname);
			$name = mysql_query("select e_name from employee where id_employee='$result[0]'");
			$resname = mysql_fetch_array($name);
			$fullname = mysql_query("select e_fullname from employee where id_employee='$result[0]'");
			$resfullname = mysql_fetch_array($fullname);
			$phone = mysql_query("select e_phone from employee where id_employee='$result[0]'");
			$resphone = mysql_fetch_array($phone);
			echo "<div class='items'>
					<div class='item-card'>
						<div class='form-wrapper'>
							<form class='me-form' method='post' action='admin.php'>
								<input name='surname' style='font-size:medium; font-weight: 500; letter-spacing: 0.035em; margin-bottom: 10px;' value='$ressurname[0]'>
								<input name='name' style='font-size:medium; font-weight: 500; letter-spacing: 0.035em; margin-bottom: 10px;' value='$resname[0]'>
								<input name='fullname' style='font-size:medium;font-weight: 500; letter-spacing: 0.035em; margin-bottom: 10px;' value='$resfullname[0]'>
								<input name='phone' style='font-size:medium;font-weight: 500; margin-top: 15px; display: block; letter-spacing: 0.035em; margin-bottom: 30px;' value='$resphone[0]' pattern='[0-9]{11}'>
								<input name='idid' value='$result[0]' hidden>
								<input type='submit' name='change-submit' class='btn change-submit' value='Изменить' style='margin-top: -8px;'>
								
							</form>
						</div>
					</div>
				  </div>
				";
			
			}
			if (isset($_POST['change-submit'])){
				$id=$_POST['idid'];
				$surname = $_POST['surname'];
				$name = $_POST['name'];
				$fullname = $_POST['fullname'];
				$phone=$_POST['phone'];
				mysql_query("UPDATE employee SET 
							e_surname='$surname', 
							e_name='$name', 
							e_fullname='$fullname',  
							e_phone='$phone'
							WHERE id_employee='$id'") or die(mysql_error());
							
				
				echo '<script>location.replace("admin.php");</script>'; exit;
			}
		?>
		</div>
		
			<form action="index.php" method="post" class="regist-form" id="popup2">
				<p class="name">
					<label for="name">Ваше имя:</label><input type="text" id="name" name="name" placeholder="Имя">
				</p>
				<p class="surname">
					<label for="surname">Ваша фамилия:</label><input type="text" id="surname" name="surname" placeholder="Фамилия">
				</p>
				<p class="e-mail">
					<label for="email">Ваш e-mail:</label><input type="email" id="email" name="email">
				</p>
				<p class="password">
					<label for="password">Пароль:</label><input type="password" id="password" name="password" >
				</p>
				<p class="phone">
					<label for="phone">Телефон:</label><input type="text" id="phone" name="phone" pattern="[0-9]{11}" placeholder="891122222222">
				</p>
				<div class="form-butt">
					<input type="submit" id="submit" name="submit" class="btn feedback-submit" value="Зарегистрировать">
					<a href="#" class="btn regist-cancel modal_close">Отмена</a>
				</div>
			</form>
			<!-- login form-->
			<form action="index.php" method="POST" class="login-form popup" id="popup1">
				<p class="e-mail">
					<label for="logemail">Ваш e-mail:</label><input type="email" id="logemail" name="logemail">
				</p>
				<p class="password">
					<label for="logpassword">Пароль:</label><input type="password" id="logpassword" name="logpassword" >
				</p>
				<div class="form-login-butt">
					<input type="submit" name="logsubmit" class="btn feedback-submit" value="Войти">
					<a href="#" class="btn login-cancel modal_close">Отмена</a>
				</div>
			</form>
		<div class="overlay_popup"></div>
	</main>
	<script src="js/script.js"></script>
	<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
</body>
</html>
	