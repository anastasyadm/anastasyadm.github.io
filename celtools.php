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
					<li><a href="admin.php">Сотрудники</a></li>
					<li><a href="review-admin.php">Отзывы</a></li>
					<li><a href="#">Услуги</a></li>
					<li><a class="active4" href="celendar.php">Календарь</a></li>
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
						<a class='icon-basket show_popup'  href='#popup1'>Войти</a>
						<a class='regist show_popup' href='#popup2' style='padding-right:10px;'>Регистрация</a>
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
		<?php
		$day=$_GET['day'];
		$month=$_GET['month'];
		$idwrite = mysql_query("select id_write from write_to_order where day(date_order)='$day' and month(date_order)='$month'");
		$count=0;
		while($residwrite = mysql_fetch_array($idwrite)){
				$id_client = mysql_query("select id_client from write_to_order where id_write='$residwrite[0]'");
				$resid = mysql_fetch_array($id_client);
				$name = mysql_query("select name from client where id_client='$resid[0]'");
				$resname = mysql_fetch_array($name);
				$surname = mysql_query("select surname from client where id_client='$resid[0]'");
				$ressurname = mysql_fetch_array($surname);
				$fullname = mysql_query("select fullname from client where id_client='$resid[0]'");
				$resfullname = mysql_fetch_array($fullname);
				$phone = mysql_query("select phone from client where id_client='$resid[0]'");
				$resphone = mysql_fetch_array($phone);
				
				$time = mysql_query("select date_format(time_order, \"%H:%i\") from write_to_order where id_write='$residwrite[0]'");
				$restime = mysql_fetch_array($time);
				$date = mysql_query("select date_format(date_order, \"%d.%m.%Y\") from write_to_order where id_write='$residwrite[0]'");
				$resdate = mysql_fetch_array($date);
				$adress = mysql_query("select adress from write_to_order where id_write='$residwrite[0]'");
				$resad = mysql_fetch_array($adress);
				$count++;
			
				$color = mysql_query("select id_write from write_to_order where id_write='$residwrite[0]' and varification='1'");
				$rescol = mysql_fetch_array($color);
				
				//$id_empl = mysql_query("select id_employee from write_to_order where id_employee>0 and varification='1'");
				//$resid_empl = mysql_fetch_array($id_empl);
						echo "<div class='items'>
							<div class='item-card'>";
						if($rescol!=0){
							echo "<div class='item-img-wrapper' style='background-color:palegreen;'>
									<div class='item-header'>
                  					<span name='surname' style='font-size:medium; font-weight: 500; letter-spacing: 0.035em;'>".$ressurname[0]."</span>
									<span name='name' style='font-size:medium;padding-left: 5px; font-weight: 500; letter-spacing: 0.035em;'>".$resname[0]."</span>
									<span style='font-size:medium;padding-left: 5px; font-weight: 500; letter-spacing: 0.035em;'>".$resfullname[0]."</span>
									<span style='font-size:medium;padding-left: 5px; font-weight: 500; letter-spacing: 0.035em;display: block; margin-top: 10px;'>".$resphone[0]."</span>
                				</div>
								<form method='post' action='celtools.php?day=$day&month=$month' class='change-form'>
									<input class='date' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' value=".$resdate[0]." disabled>
									<input class='date time' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' value=".$restime[0]." disabled>
									<textarea class='date' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' disabled>$resad[0]</textarea>
							";
							$id_empl = mysql_query("select id_employee from write_to_order where id_employee>0 and id_write='$residwrite[0]'");
							while($resid_empl = mysql_fetch_array($id_empl)){
								$e_surname = mysql_query("select e_surname from employee where id_employee='$resid_empl[0]'");
								$resesurname = mysql_fetch_array($e_surname);
								$e_name = mysql_query("select left(e_name,1) from employee where id_employee='$resid_empl[0]'");
								$resename = mysql_fetch_array($e_name);
								$e_fullname = mysql_query("select left(e_fullname,1) from employee where id_employee='$resid_empl[0]'");
								$resefullname = mysql_fetch_array($e_fullname);
								echo "<input class='date' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' value='$resesurname[0] $resename[0].$resefullname[0].' disabled>";
							}
						}
						else{
							echo "<div class='item-img-wrapper'>
									<div class='item-header'>
										<span name='surname' style='font-size:medium; font-weight: 500; letter-spacing: 0.035em;'>".$ressurname[0]."</span>
										<span name='name' style='font-size:medium;padding-left: 5px; font-weight: 500; letter-spacing: 0.035em;'>".$resname[0]."</span>
										<span style='font-size:medium;padding-left: 5px; font-weight: 500; letter-spacing: 0.035em;'>".$resfullname[0]."</span>
										<span style='font-size:medium;padding-left: 5px; font-weight: 500; letter-spacing: 0.035em;display: block; margin-top: 10px;'>".$resphone[0]."</span>
                					</div>
									<form method='post' action='celtools.php?day=$day&month=$month' class='change-form'>
										<input class='date' id='write_date' name='write_date' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' value=".$resdate[0].">
										<input class='date time' id='write_time' name='write_time' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' value=".$restime[0].">
										<textarea class='date' style='font-size:medium;padding-left: 10px; margin-bottom: 10px;' disabled>$resad[0]</textarea>
										<select class='select' name='e_id'>
									";
						
									$empl = mysql_query("select id_employee from employee");
									while($resempl = mysql_fetch_array($empl)){
										$e_surname = mysql_query("select e_surname from employee where id_employee='$resempl[0]'");
										$resesurname = mysql_fetch_array($e_surname);
										$e_name = mysql_query("select left(e_name,1) from employee where id_employee='$resempl[0]'");
										$resename = mysql_fetch_array($e_name);
										$e_fullname = mysql_query("select left(e_fullname,1) from employee where id_employee='$resempl[0]'");
										$resefullname = mysql_fetch_array($e_fullname);
										
										
										echo "<option value='$resempl[0]'>$resesurname[0] $resename[0].$resefullname[0].</option>";
										
									
									}
						
									
								echo "</select>
								<input class='date' name='idid' id='write_id' style='font-size:medium;padding-left: 10px;' value=".$residwrite[0]." hidden>
								<div class='form-login-butt'>
										<input type='submit' name='change-submit' class='btn change-submit' value='Подтвердить' style='margin-top: -8px;'>
										<input type='submit' name='change-cancel' class='btn change-cancel' value='Отклонить' style='margin-top: -8px;'>
									 </div>
								";
						}
								echo "
								</form>
              				</div>
            			</div>
					</div>
				";
			
				
			}
			if (isset($_POST['change-submit'])){
				$id=$_POST['idid'];
				$d=$_POST['write_date'];
				$date = date('Y-m-d', strtotime($d));
				
				$time=$_POST['write_time'];
				$e_id=$_POST['e_id'];
				$query=mysql_query("UPDATE write_to_order SET varification='1',id_employee='$e_id', Date_order='$date',Time_order='$time' WHERE id_write='$id'") or die(mysql_error());
				echo '<script>location.replace("celtools.php");</script>'; exit;
				//echo "Вы подтвердили заявку ";
				
				
			}
			if (isset($_POST['change-cancel'])){
				$id=$_POST['idid'];
				mysql_query("DELETE FROM `write_to_order` WHERE 'id_write'='$id'") or die(mysql_error());
			}
			
		?>
		</div>
		
		

		<!--<script>
			function call() {
				var date = $("#write_date").val();
				var time = $("#write_time").val();
				var id = $("#write_id").val();
 	  			var msg   = $('#formx').serialize();
        		$.ajax({
				  type: 'POST',
				  url: 'select.php',
				  data: {date:date,
				   time:time,
				   id:id
				  },
				  success: function() {
					$('.item-img-wrapper').css("background-color","palegreen");
				  },
				  error:  function(xhr, str){
					alert('Возникла ошибка: ' + xhr.responseCode);
				  }
				});
 
    }
	<script>
		$(document).ready ( function(){
			$(".time").keyup(function() {
			 $('#contenInput').text($(".mytext").val());
			});

		});
	</script>
		</script>-->
		
	</main>
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
	<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>
	