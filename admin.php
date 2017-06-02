<?php require "tools.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Remokon - Сотрудники</title>
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
					<li><a href="ad-service.php">Услуги</a></li>
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
			<a class='btn set-submit show_popup' href='#popup3' style='border: none; margin: 0 30px; background-color: #568fda; margin-bottom: 10px; margin-left:1px; width: 200px;'>Добавить сотрудника</a>
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
								<input type='submit' name='change-submit' class='btn change-submit' value='Изменить' style='margin-top: -8px; margin-bottom: 20px;'>
								<input type='submit' name='delete-submit' class='btn change-submit' value='Удалить' style='margin-top: -8px; background-color: #eee;'>
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
			if (isset($_POST['delete-submit'])){
				$id = $_POST['idid'];
				mysql_query("UPDATE write_to_order SET  
							id_employee='0'
							WHERE id_employee='$id'") or die(mysql_error());
				mysql_query("DELETE FROM employee WHERE id_employee='$id'") or die(mysql_error());
				echo '<script>location.replace("admin.php");</script>'; exit;
			}
			$count=0;
			if (isset($_POST['sub-submit'])){	
				$name = $_POST['name'];
				$surname = $_POST['surname'];
				$fullname = $_POST['fullname'];
				$phone = $_POST['phone'];
				if($count==0){
				$query=mysql_query("INSERT INTO employee
									VALUES(default, '$surname',
									'$name','$fullname', '$phone')") or die(mysql_error());
				$count++;
				echo '<script>location.replace("admin.php");</script>'; exit;
				}

			}
		?>
		</div>
		<form action="admin.php" method="POST" class="regist-form popup" id="popup3" style="height: 340px;">
			<p class="surname">
				<label for="surname">Фамилия:</label><input type="text" id="surname" name="surname" placeholder="Фамилия">
			</p>
			<p class="name">
				<label for="name">Имя:</label><input type="text" id="name" name="name" placeholder="Имя">
			</p>
			<p class="e-mail">
				<label for="fullname">Отчество:</label><input type="text" id="fullname" name="fullname" placeholder="Отчество">
			</p>
			<p class="phone">
				<label for="phone">Номер телефона:</label><input type="text" id="phone" name="phone" pattern="[0-9]{11}" placeholder="89102345678">
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
	