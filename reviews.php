<?php require "tools.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Remokon - отзывы</title>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,500,700,300&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/minilogo.png" width="15" height="25" type="image/x-icon">
</head>
<body>

<!-- Header -->
  <header>
 		<div class="container">
			<nav>
				<ul class="menu">
					<li><a href="index.php">О компании</a></li>
					<li><a class="active2" href="reviews.php">Отзывы</a></li>
					<li><a href="services.php">Услуги</a></li>
					<li><a href="#contacts">Контакты</a></li>
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
						<a class='icon-basket show_popup' href='#popup1'>Войти</a>
						<a class='regist show_popup' href='#popup2' style='padding-right:10px;'>Регистрация</a>
						";
					}
					?>
				</ul>
			</nav>
			<a class="header-logo" href="index.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
		</div>
	</header>


<!-- Content -->
  <main>
    <section class="welcome-block">
      <div class="container">
        <h1 class="shop-title">Добро пожаловать</h1>
      </div>
    </section>
	  <?php 
	  $count=0;
	if (isset($_POST['review-submit'])){
		$review=$_POST['reviews'];
		$id_client=$_SESSION['id_user'];
		$today = date('y.m.d');
		if(count==0){
			$query=mysql_query("INSERT INTO review VALUES (default,'$id_client','$today','$review')") or die(mysql_error());
			$count++;
			echo "<p style='text-align:center;margin-top:15px;'>Ваш отзыв отправлен</p>";
		}
	}
	?>
    <div class="container">
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
			<script src="http://e-timer.ru/js/etimer.js"></script>
			<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(".eTimer").eTimer({
				etType: 2, etDate: "27.05.2017.0.0", etTitleText: "До окончания акции осталось:", etTitleSize: 15, etShowSign: 1, etSep: ":", etFontFamily: "Arial", etTextColor: "white", etPaddingTB: 15, etPaddingLR: 15, etBackground: "#eeeeee", etBorderSize: 0, etBorderRadius: 2, etBorderColor: "white", etShadow: " 0px 0px 10px 0px #eeeeee", etLastUnit: 3, etNumberFontFamily: "Arial", etNumberSize: 35, etNumberColor: "white", etNumberPaddingTB: 0, etNumberPaddingLR: 8, etNumberBackground: "#fb565a", etNumberBorderSize: 0, etNumberBorderRadius: 5, etNumberBorderColor: "white", etNumberShadow: "inset 0px 0px 0px 0px rgba(0, 0, 0, 0.5)"
				});
			});
			</script>
			<div class="eTimer"></div>
      <div class="row catalog">
        <div class="col">
          <div class="sorting">    
				<?php
				if($_SESSION['author']==True){
			  		echo"<a class='btn abtn show_popup' href='#popup3'>Оставить отзыв</a>";
				}
				?>
            <div class="sorting-controls">
              <a href="#" class="icon-down-dir active"></a>
              <a href="#" class="icon-up-dir"></a>
            </div>
          </div>

          <!-- Item cards -->
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
              				</div>
            			</div>
					</div>
				";
				
			}
			
			?>
          

          

      		</div>
		</div>
	</div>
  </main>

<!-- Map & contacts -->
<div class="map-wrapper">
		<a name="contacts"></a>
		<div class="map" id="map" style="height:450px">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2017.338200598877!2d30.400062715788707!3d59.62737778176411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46961fe924ffde2b%3A0x686b1f62604d6f88!2z0JjQttC-0YDRgdC60LDRjyDRg9C7LiwgMjQsINCa0L7QvNC80YPQvdCw0YAsINCb0LXQvdC40L3Qs9GA0LDQtNGB0LrQsNGPINC-0LHQuy4sIDE4ODMyMg!5e0!3m2!1sru!2sru!4v1492516938242" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="col col1">
			<div class="contacts">
				<p class="contacts-title"><span>РемОкон</span><br> Тепло и уют в Ваш дом!</p>
				<p class="contacts-address">188322, г.Коммунар, Ижорская ул. д.24</p>
				<p class="contacts-phone">тел. +7 (911) 925-25-79</p>
				<p class="contacts-phone">тел. +7 (911) 924-24-69</p>
				<a class="btn contacts-btn show_popup" href="#popup4">Напишите нам</a>
			</div>
		</div>
	</div>
	<form action="reviews.php" method="post" class="regist-form popup" id="popup2">
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
		<div class="form-butt">
			<input type="submit" id="submit" name="submit" class="btn feedback-submit" value="Зарегистрировать">
			<a href="#" class="btn regist-cancel modal_close">Отмена</a>
		</div>
	</form>
	
<!-- login form-->
	<form action="reviews.php" method="POST" class="login-form popup" id="popup1">
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
<!-- Feedback form -->
  <form action="#" method="get" class="feedback-form popup" id="popup4">
		<p class="name">
			<label for="input-name">Ваше имя:</label><input type="text" id="input-name" name="feedback-name" placeholder="Представьтесь, пожалуйста">
		</p>
		<p class="e-mail">
			<label for="input-e-mail">Ваш e-mail:</label><input type="email" id="input-e-mail" name="feedback-e-mail" placeholder="Для отправки ответа">
		</p>
		<p class="message-text">
			<label for="input-message">Текст письма:</label><textarea id="input-message" name="feedback-message" placeholder="В свободной форме"></textarea>
		</p>
		<div class="form-btns">
			<input type="submit" id="input-submit" name="feedbacksubmit" class="btn feedback-submit" value="Отправить">
			<a href="#" class="btn feedback-cancel modal_close">Отмена</a>
		</div>
	</form>
<!--reviews-->
	
<form action="reviews.php" method="POST" class="review-form popup" id="popup3">
    <p class="rename">
      <label for="input-name">Ваше имя:</label>
		<?php 
		$name = mysql_query("select name from client where id_client='".$_SESSION['id_user']."'") or die(mysql_error());
    	while($resname = mysql_fetch_array($name)){
			echo "<input type='text' id='input-name' name='feedback-name' value=".$resname[0]." disabled>";
		}
	?>
    </p>
    <p class="reviews">
      <label for="reviews">Ваш отзыв:</label><textarea id="reviews" name="reviews" placeholder="В свободной форме"></textarea>
    </p>
    <div class="form-btns">
      <input type="submit" id="input-submit" name="review-submit" class="btn review-submit" value="Отправить">
      <a href="#" class="btn review-cancel modal_close">Отмена</a>
    </div>
  </form>
	<div class="overlay_popup"></div>
<!-- Javascript -->
	<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>
