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
					<li><a href="admin.php">Сотрудники</a></li>
					<li><a class="active5" href="reviews-admin.php">Отзывы</a></li>
					<li><a href="services.php">Услуги</a></li>
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
			<a class="header-logo" href="index.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
		</div>
	</header>
	<main>
		<div class="container">
		<?php
			$reviews = mysql_query("select id_review from review");
			while($result = mysql_fetch_array($reviews)){
				$id_client = mysql_query("select id_client from review where id_review='$result[0]'");
				$resid = mysql_fetch_array($id_client);
				$name = mysql_query("select name from client where id_client='$resid[0]'");
				$resname = mysql_fetch_array($name);
				$review = mysql_query("select review from review where id_review='$result[0]'");
				$resreview = mysql_fetch_array($review);
				$date = mysql_query("select date_format(date, \"%d.%m.%y\") from review where id_review='$result[0]'");
				$resdate = mysql_fetch_array($date);
				echo "<div class='items'>
            			<div class='item-card'>
              				<div class='item-img-wrapper'>
                				<div class='item-header'>
                  					<span style='font-size:medium'>".$resname[0]."</span>
									<span style='font-size:medium;padding-left: 10px;'>".$resdate[0]."</span>
                				</div>
								<span style='font-size:15px;'>".$resreview[0]."</span>
								<form method='post' action='review-admin.php' class='forbutt' style='text-align:center;'>
									<input name='id' value=".$result[0]." hidden>
									<input type='submit' name='text-cancel' class='btn ch-cancel' value='Удалить отзыв'>
								</form>
              				</div>
            			</div>
					</div>
				";
				
			}
			if (isset($_POST['text-cancel'])){
				$id=$_POST['id'];
				mysql_query("DELETE FROM review WHERE id_review='$id'") or die(mysql_error());
				echo '<script>location.replace("review-admin.php");</script>'; exit;
			}
			?>
		</div>
		<div class="overlay_popup"></div>
	</main>
	<script src="js/script.js"></script>
	<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
</body>
</html>
	