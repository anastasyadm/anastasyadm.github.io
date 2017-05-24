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
						<li><a href="index.php">О компании</a></li>
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
							<a class='active3' class='cabinet' href='me.php'>Личный кабинет</a>
				      	</li>
				     	<li style='float:right; margin-right: 10px;'>
							<a href='index.php?log_out='go' style='margin-right: 10px;'>Выйти</a>
						</li>";
						}
						?>
					</ul>
				</nav>
				<a class="header-logo" href="index.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
			</div>
		</header>
		<main>
			<div class="container">
				<div class="block about_me">
					<p class='friendship-title'>Обо мне</p>
					<?php
					$count==0;
					$id = $_SESSION['id_user'];
					$name = mysql_query("select name from client where id_client='$id'");
					while($resname = mysql_fetch_array($name)){
						$surname = mysql_query("select surname from client where id_client='".$_SESSION['id_user']."'");
						$ressurname = mysql_fetch_array($surname);
						$fullname = mysql_query("select fullname from client where id_client='".$_SESSION['id_user']."'");
						$resfullname = mysql_fetch_array($fullname);
						
						$email = mysql_query("select email from client where id_client='".$_SESSION['id_user']."'");
						$resemail = mysql_fetch_array($email);
						$adress = mysql_query("select address from client where id_client='".$_SESSION['id_user']."'");
						$resadress = mysql_fetch_array($adress);						
						$phone = mysql_query("select phone from client where id_client='".$_SESSION['id_user']."'");
						$resphone = mysql_fetch_array($phone);
						
						echo "<div class='me-items'>
            					<div class='item-card' style='width:100%;'>
									<form method='post' action='me.php' class='me-form'>
										<div>
											<div class='aboutme'>
												<label for='mysurname'>Ваша фамилия:*</label>
												<input class='mysurname' id='mysurname' name='mysurname' value='$ressurname[0]' required>
												<label for='myname'>Ваше имя:*</label>
												<input class='myname' id='myname' name='myname' value='$resname[0]' required>
												<label for='myfullname'>Ваше отчество:</label>
												<input class='myfullname' id='myfullname' name='myfullname' value='$resfullname[0]'>
											</div>
											<div class='aboutme'>
												<label for='myemail'>Ваш e-mail:*</label>
												<input class='myemail' id='myemail' name='myemail' value='$resemail[0]' required>
												<label for='myadress'>Ваш адрес:</label>
												<input class='myadress' id='myadress' name='myadress' value='$resadress[0]'>
												<label for='myphone'>Ваш номер телефона:*</label>
												<input class='myphone' id='myphonee' name='myphone' value='$resphone[0]' required>
											</div>
											<p class='' style='margin-top: 15px; font-weight: 500;'>Хотите изменить пароль?</p>
											<div class='aboutme' style='margin-top: 25px;'>
												<label for='oldpass'>Ваш старый пароль:</label>
												<input type='password' class='oldpass' id='oldpass' name='oldpass' required>
												<label for='pass'>Ваш новый пароль:</label>
												<input type='password' class='pass' id='pass' name='pass' required>
												<label for='newpass'>Повторите пароль:</label>
												<input type='password' class='newpass' id='newpass' name='newpass' required>
											</div>
										</div>
										
										<div class='form-buttons'>
											<p class='' style='margin: 15px 0;'>* - обязательное поле</p>
											<input type='submit' name='change-submit' class='btn change-submit' value='Изменить' style='margin-top: -8px;'>
										</div>
									</form>
									
              					</div>
            				</div>
						";
						
						
					}
					if (isset($_POST['change-submit'])){
							$id=$_SESSION['id_user'];
							//echo $id;
							$surname = $_POST['mysurname'];
							$name = $_POST['myname'];
							$fullname = $_POST['myfullname'];
							$email=$_POST['myemail'];
							$adress=$_POST['myadress'];
							$phone=$_POST['myphone'];
							
							$oldpass=$_POST['oldpass'];
							//echo $oldpass;
							$pass=$_POST['pass'];
							//echo $pass;
							$newpass=$_POST['newpass'];
							//echo $newpass;
							mysql_query("UPDATE client SET 
										surname='$surname', 
										name='$name', 
										fullname='$fullname', 
										email='$email', 
										address='$adress', 
										phone='$phone'
										WHERE id_client='$id'") or die(mysql_error());
							
							$p = mysql_query("select password from client where id_client='$id'") or die(mysql_error());
							//echo $p;
							if($oldpass==$password){
								if($pass==$newpass){
									mysql_query("UPDATE client SET 
										password='$pass' WHERE id_client='$id'") or die(mysql_error());
								}
							}
						echo '<script>location.replace("me.php");</script>'; exit;
						}
					?>
				</div>
				<div class="block reviewsss">
					<p class='friendship-title'>Оставленные отзывы</p>
					<?php
					$count==0;
					$id = mysql_query("select id_review from review where id_client='".$_SESSION['id_user']."'");
					while($result = mysql_fetch_array($id)){
						$reviews = mysql_query("select review from review where id_review='$result[0]'");
						$res = mysql_fetch_array($reviews);
						echo "<div class='review-items'>
							<div class='review-card'>
								<div class='review-wrapper'>
									<form method='post' action='me.php' class='text-form'>
										<textarea rows='5' id='text_review' name='text_review'>$res[0]</textarea>
										<input name='id' value='$result[0]' hidden>
										<div class='form-butt' style='text-align:center;'>
											<input type='submit' name='text-submit' class='btn text-submit' value='Дополнить' style='margin-left: 20px;'>
											<input type='submit' name='text-cancel' class='btn ch-cancel' value='Удалить отзыв' style='margin-top: 25px; margin-left: 20px;'>
										</div>
									</form>
								</div>
							</div>
						</div>
					";
					}
					if (isset($_POST['text-submit'])){
						$id = $_POST['id'];
						$review = $_POST['text_review'];
						mysql_query("UPDATE review SET 
										review='$review' WHERE id_review='$id'") or die(mysql_error());
						echo '<script>location.replace("me.php");</script>'; exit;
						}
					if (isset($_POST['text-cancel'])){
						$count++;
						$id=$_POST['id'];
						mysql_query("DELETE FROM review WHERE id_review='$id'") or die(mysql_error());
						echo '<script>location.replace("me.php");</script>'; exit;
					}
					?>
				</div>
				<div class="block writes">
					<p class='friendship-title'>Запись на замер</p>
					<?php
					$write = mysql_query("select id_write from write_to_order where id_client='".$_SESSION['id_user']."'");
					while($result = mysql_fetch_array($write)){
						$adress = mysql_query("select adress from write_to_order where id_write='$result[0]'");
						$resadress = mysql_fetch_array($adress);
						$date = mysql_query("select date_format(date_order, \"%d.%m.%y\") from write_to_order where id_write='$result[0]'");
						$resdate = mysql_fetch_array($date);
						$time = mysql_query("select date_format(time_order, \"%H:%i\") from write_to_order where id_write='$result[0]'");
						$restime = mysql_fetch_array($time);
						
						$color = mysql_query("select id_write from write_to_order where id_write='$result[0]' and varification='1'");
						$rescol = mysql_fetch_array($color);
						echo "<div class='items'>
							<div class='item-card'>";
						if($rescol!=0){
							echo "<div class='item-img-wrapper' style='background-color:palegreen;'>";
						}
						else{
							echo "<div class='item-img-wrapper'>";
						} 					
									echo "<form method='post' action='me.php' class='change-form'>
											<input type='text' class='date' id='write_date' name='write_date' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' value='$resadress[0]' disabled>
											<input type='text' class='date time' id='write_time' name='write_time' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' value='$restime[0]' disabled>
											<input type='text' class='date' style='font-size:medium;padding-left: 10px;' value='$resdate[0]'' disabled>
											<input name='idid' value='$result[0]' hidden>
									</form>
								</div>
							</div>
						</div>
					";

					}

					?>
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
	