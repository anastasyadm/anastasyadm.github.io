<?php require "tools.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Remokon - Личный кабинет</title>
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
					<li><a href="admin.php">Сотрудники</a></li>
					<li><a href="review-admin.php">Отзывы</a></li>
					<li><a href="ad-service.php">Услуги</a></li>
					<li><a href="celendar.php">Календарь</a></li>
					<?php
					if (isset($_POST['logsubmit'])){
						log_in();}
					if (isset($_POST['submit'])){
          				registration();}
					
					if($_SESSION['admin']==True){
						echo "<li class='user-block'>
							<a class='cabinet active3' href='adme.php'>Личный кабинет</a>
				      	</li>
				     	<li style='float:right; margin-right: 60px;'>
							<a href='index.php?log_out='go'>Выйти</a>
						</li>";
					}
					else{
						echo "
						<a class='icon-basket' href='#'>Войти</a>
						<a class='icon-regist' href='#' style='padding-right:60px;' href='#'>Регистрация</a>
						";
					}
					?>
				</ul>
				</nav>
				<a class="header-logo" href="index.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
			</div>
		</header>
		<main>
			<?php 
				if (isset($_POST['change-submit'])){
					$oldpass=$_POST['oldpass'];
					//echo $oldpass;
					$pass=$_POST['pass'];
					//echo $pass;
					$newpass=$_POST['newpass'];
					$p = mysql_query("select password from client where id_client='4'") or die(mysql_error());
					$password = mysql_fetch_array($p);
					if($oldpass==$password[0]){
						if($pass==$newpass){
							mysql_query("UPDATE client SET 
										password='$pass' WHERE id_client='4'") or die(mysql_error());
							echo "<p style='text-align:center;margin-top:15px;'>Пароль успешно изменен</p>";
						}
						else{
							echo "<p style='text-align:center;margin-top:15px;'>Пароли не совпадают</p>";
						}
					
					}
					else{
						echo "<p style='text-align:center;margin-top:15px;'>Старый пароль не верен</p>";
					}
				}
				if (isset($_POST['mail-submit'])){
					$email=$_POST['newemail'];
					mysql_query("UPDATE client SET 
										email='$email' WHERE id_client='4'") or die(mysql_error());
					echo '<script>location.replace("adme.php");</script>'; exit;
				}
			?>
			<div class="container">
				<div class='me-items'>
            		<div class='item-card' style='width:100%;'>
						<form method='post' action='adme.php' class='me-form' style="min-height: 270px;width: 50%; float: left;">		
							<p class='' style='margin-top: 15px; font-weight: 500;'>Хотите изменить пароль?</p>
							<div class='aboutme' style='margin-top: 25px;'>
								<label for='oldpass'>Ваш старый пароль:</label>
								<input type='password' class='oldpass' id='oldpass' name='oldpass' required>
								<label for='pass'>Ваш новый пароль:</label>
								<input type='password' class='pass' id='pass' name='pass' required>
								<label for='newpass'>Повторите пароль:</label>
								<input type='password' class='newpass' id='newpass' name='newpass' required>
							</div>
							<div style="clear: both;">
								<input type='submit' name='change-submit' class='btn change-submit' value='Изменить'>
							</div>
						</form>	
						<?php
							$email = mysql_query("select email from client where id_client='4'");
							$resemail = mysql_fetch_array($email);
							echo "
							<form method='post' action='adme.php' class='me-form' style='min-height: 270px;width: 50%;float: left;'>	
								<div class='aboutme' style='margin-top: 50px;'>
									<label for='myemail'>Ваш e-mail:</label>
									<input class='myemail' id='myemail' name='myemail' value='$resemail[0]' disabled style='background-color:white;'>
									<label for='newemail'>Изменить e-mail:</label>
									<input class='myadress' id='newemail' name='newemail'>

									<div style='clear: both;'>
										<input type='submit' name='mail-submit' class='btn change-submit' value='Изменить'>
									</div>
								</div>
							</form>
							";
							
						?>
										
              		</div>
            	</div>
			</div>
		<div class="overlay_popup"></div>
		</main>
			
			
		<script>
			
		</script>
		<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>
	