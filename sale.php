<?php require "tools.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="yandex-verification" content="6ea04b52d7a65255" />
  <title>Remokon - главная</title>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,300&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/minilogo.png" width="15" height="25" type="image/x-icon">
  <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
</head>
<body>

<!-- Header -->
 	<header>
 		<div class="container">
			
			<nav>
				<ul class="menu">
					<li><a class="active" href="index.php">О компании</a></li>
					<li><a href="reviews.php">Отзывы</a></li>
					<li><a href="services.php">Калькулятор</a></li>
					<li><a href="#contacts">Контакты</a></li>
					
					<li class='user-block'>
						<a class='cabinet' href='service2.php'>Услуги</a>
				    </li>
				    <li>
						<a href='sale.php'>Акции</a>
					</li>
					
				</ul>
			</nav>
			<a class="header-logo" href="index.php"><img src="img/logo.png" alt="logo" width="330" height="100"></a>
		</div>
	</header>

<!-- Content -->
  <!-- Slider -->
	<main>
		<div>cffvv</div>
	</main>
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
<!-- Registration form -->
	<form action="index.php" method="post" class="regist-form popup" id="popup2">
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
	<form action="enter.php" method="POST" class="login-form popup" id="popup1">
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
<!-- write-to-order form-->
	
	<form action="index.php" method="POST" class="write-form popup" id="popup3">
		<p class="input-name">
      <label for="input-name">Ваше имя:</label>
		<?php 
		$name = mysql_query("select name from client where id_client='".$_SESSION['id_user']."'") or die(mysql_error());
    	while($resname = mysql_fetch_array($name)){
			echo "<input type='text' id='write-name' name='write-name' value=".$resname[0]." disabled>";
		}
	?>
    	</p>
		<p class="adress">
		  <label for="adress">Адрес:</label><input type="text" id="adress" name="adress" placeholder="г.Коммунар, Ижорская ул. д.24">
		</p>
		<p class="formdate">
		  <label for="formdate">Желательная дата:</label><input type="date" id="formdate" name="formdate">
		</p>
		<p class="time">
		  <label for="time">Желательное время:</label><input type="text" id="time" name="time" placeholder="15:00" pattern="[0-9]{2}:[0-9]{2}">
		</p>
		<p>
			<label for="message">Что будем ремонтировать?:</label>
			<textarea id="message" name="message" placeholder="Изготовление и установка глухого окна ПВХ" style="width: 460px;height: 60px;padding: 5px;"></textarea>
		</p>
		<div class="form-btns" style="margin-top:25px">
		  <input type="submit" id="write-submit" name="write-submit" class="btn write-submit" value="Записать">
		  <a href="#" class="btn write-cancel modal_close">Отмена</a>
		</div>
	</form>
	<div class="overlay_popup"></div>
	

<!-- Javascript -->
			<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="js/etimer.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
				$('.eTimer').eTimer({
				etType: 2, etDate: "20.06.2017.0.0", etTitleText: "До окончания акции осталось:", etTitleSize: 15, etShowSign: 1, etSep: ":", etFontFamily: "Arial", etTextColor: "white", etPaddingTB: 15, etPaddingLR: 15, etBackground: "#eeeeee", etBorderSize: 0, etBorderRadius: 2, etBorderColor: "white", etShadow: " 0px 0px 10px 0px #eeeeee", etLastUnit: 3, etNumberFontFamily: "Arial", etNumberSize: 35, etNumberColor: "white", etNumberPaddingTB: 0, etNumberPaddingLR: 8, etNumberBackground: "#fb565a", etNumberBorderSize: 0, etNumberBorderRadius: 5, etNumberBorderColor: "white", etNumberShadow: "inset 0px 0px 0px 0px rgba(0, 0, 0, 0.5)"
				});
			});
	</script>
	<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
	<script src="owlcarousel/owl.carousel.min.js"></script>
	<script src="js/script.js"></script>
	<script>
		 // Slider - owl carousel plugin
 		control = $(".owl-dot"),
 		control_active = $(".owl-dot.active");
	$('.owl-carousel').owlCarousel({
		items:1,
		loop:true,
		margin:10,
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:true
	  });
	</script>
	</body>
</html>
