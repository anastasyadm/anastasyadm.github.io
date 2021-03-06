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
		<div class="big-slider">
			<div class="container">
				<div class="slider">
					<!--<input type="radio" id="btn-1" name="toggle" checked>
					<input type="radio" id="btn-2" name="toggle">
					<input type="radio" id="btn-3" name="toggle">
					<input type="radio" id="btn-4" name="toggle">
					<input type="radio" id="btn-5" name="toggle">
					<div class="slider-controls">
						<label for="btn-1"></label>
						<label for="btn-2"></label>
						<label for="btn-3"></label>
						<label for="btn-4"></label>
						<label for="btn-5"></label>
					</div>-->
					<div class="owl-carousel">
						<div class="slide first">
							<div class="slide-text">
								<div class="slide-title">Регулировка и ремонт фурнитуры</div>
								<p>Профессиональная инструментальная регулировка оконной фурнитуры.<br>Сложная регулировка створки стеклопакетом(переклинка).<br>Устранение провисаний и притираний.<br>Очистка и смазка, замена фурнитуры.</p>
									
									<a class='btn write-order show_popup' href='#popup3'>Запись на замер</a>
							</div>
						</div>
						<div class="slide second">
							<div class="slide-text">
								<div class="slide-title">Замена и ремонт стеклопакетов</div>
								<p>Производим замену и установку стеклопакетов любых форм и размеров. Поменяем испорченные и разбитые стеклопакеты или просто установим стекло.</p>
								
									<a class='btn write-order show_popup' href='#popup3'>Запись на замер</a>
								
							</div>
						</div>
						<div class="slide third">
							<div class="slide-text">
								<div class="slide-title">Замена уплотнителя</div>
								<p>Смазка, чистка и замена резиновых уплотнителей. Устраним сквозняки, повысим шумоизоляцию.Установим 3 й контур уплотнения от уличной пыли на подоконнике и откосах.</p>
								
									<a class='btn write-order show_popup' href='#popup3'>Запись на замер</a>
							</div>
						</div>
						<div class="slide fourth">
							<div class="slide-text">
								<div class="slide-title">Москитные сетки</div>
								<p>Изготовим и установим москитные сетки на окна и двери. Защитите себя от комаров, мух и прочей летающей и ползающей живности!</p>
								
									<a class='btn write-order show_popup' href='#popup3'>Запись на замер</a>
									
							</div>
						</div>
						<div class="slide fifth">
							<div class="slide-text">
								<div class="slide-title">Откосы и подоконники</div>
								<p>Установим новые и поменяем старые откосы и подоконники. Смонтируем откосы из сэндвич – панелей, прекрасный внешний вид!Герметизация и утепление - забудьте о промерзаниях!</p>
								
									<a class='btn write-order show_popup' href='#popup3'>Запись на замер</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php 
		$count=0;
		if (isset($_POST['write-submit'])){	
    		$name_user=$_POST['name_user'];
			$phone = $_POST['phone'];
    		$adress=$_POST['adress'];
			$date=$_POST['formdate'];
			
    		$time=$_POST['time'];
			$message=$_POST['message'];
			if($count==0){
    		$query=mysql_query("INSERT INTO write_to_order
            			VALUES(default, default, default, '$name_user', '$phone',
             			'$adress','$date', '$time','$message')") or die(mysql_error());
			$count++;
			echo "<p style='text-align:center;margin-top:15px;'>Вы успешно записаны</p>";
			}
			require_once 'sms.ru.php';

			/*$smsru = new SMSRU('B82C0C23-A495-17F8-18B8-B57A04A48FC0'); // Ваш уникальный программный ключ, который можно получить на главной странице

			$data = new stdClass();
			$data->to = '79111740999';
			$data->text = "Имя клиента:$name_user \nТелефон:$phone \nАдрес:$adress \nДата:$date \nВремя:$time \nСообщение:$message"; // Текст сообщения
			// $data->from = ''; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
			// $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
			// $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
			// $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
			// $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
			$sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

			/*if ($sms->status == "OK") { // Запрос выполнен успешно
				echo "Сообщение отправлено успешно. ";
				echo "ID сообщения: $sms->sms_id.";
			} else {
				echo "Сообщение не отправлено. ";
				echo "Код ошибки: $sms->status_code. ";
				echo "Текст ошибки: $sms->status_text.";
			}*/
			
		}
		?>
		

    <!-- Services block -->
		<div class="container">
			<div class="eTimer"></div>
			<div class="row services">
				<div class="col col1">
					<div class="service">
						<div class="img-wrapper"><img src="img/medal.png" alt="Сайты" width="150" height="150"></div>
						<h3 class="service-title">Гарантия</h3>
						<p class="service-text">После нашего ремонта окна на 100% будут выполнять свою функцию, а в квартире станет тепло и уютно.</p>
					</div>
				</div>

				<div class="col col1">
					<div class="service">
						<div class="img-wrapper"><img src="img/truck-2.png" alt="Приложения"></div>
						<h3 class="service-title">Оперативность</h3>
						<p class="service-text">Выезд мастера в день обращения</p>
					</div>
				</div>

				<div class="col col1">
					<div class="service">
						<div class="img-wrapper"><img src="img/settings.png" alt="Презентации"></div>
						<h3 class="service-title">Качество</h3>
						<p class="service-text">У нас работают только высококвалифицированные специалисты с большим опытом установки оконных конструкций, что гарантирует неизменно высокое качество производимых работ.</p>
					</div>
				</div>
			</div>

      <!-- Info block -->
			<div class="row info">
				<div class="col col2">
					<p class="info-title">Профессионально занимаемся ремонтом окон и балконных блоков.</p>
					<p class="info-text"> Мы даем людям надежность и гарантию. Поэтому работаем только в одной области, которую мы знаем, как свои пять пальцев! </p>
					<p class="list-title">Выполняем заказы на разработку:</p>
					<ul class="list">
						<li>Устранение поломок любой сложности</li>
						<li>Ремонт пластиковых окон любых производителей</li>
						<li>Работаем по Санкт-Петербургу и Лен. области</li>
					</ul>
				</div>

				<div class="col col1">
					<div class="index-logo"><img src="img/logo.png" alt="logo" width="230" height="70"></div>
					<p class="since-text">Since 2004</p>
					<p class="list-title">Как мы работаем:</p>
					<ul class="list">
						<li>С самоотдачей 146%</li>
						<li>Соблюдая сроки на 100%</li>
						<!--<li>По предоплате 50%</li>-->
					</ul>
				</div>
			</div>
			<div class='references'>
						<div class='row'>
							<p class='friendship-title'>Наши клиенты о нас!</p>
							<div class='col5'>
								<div class='social-icons'>

      <!-- References block -->
			<?php
			$reviews = mysql_query("SELECT * FROM review ORDER BY DATE DESC LIMIT 3");
			while($result = mysql_fetch_array($reviews)){
				$id_client = mysql_query("select distinct id_client from review where id_review='$result[0]'");
				$resid = mysql_fetch_array($id_client);
				$name = mysql_query("select name from client where id_client='$resid[0]'");
				$resname = mysql_fetch_array($name);
				$date = mysql_query("select date_format(date, \"%d.%m.%y\") from review where id_review='$result[0]'");
				$resdate = mysql_fetch_array($date);
				echo "
					<a class='icon-vk' href='reviews.php?rew=$resid[0]'>".$resname[0]."</a>
								
				";
				
			}
				?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<div class="map-wrapper">
		<a name="contacts"></a>
		<div class="map" id="map" style="height:450px">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2017.338200598877!2d30.400062715788707!3d59.62737778176411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46961fe924ffde2b%3A0x686b1f62604d6f88!2z0JjQttC-0YDRgdC60LDRjyDRg9C7LiwgMjQsINCa0L7QvNC80YPQvdCw0YAsINCb0LXQvdC40L3Qs9GA0LDQtNGB0LrQsNGPINC-0LHQuy4sIDE4ODMyMg!5e0!3m2!1sru!2sru!4v1492516938242" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="col col1">
			<div class="contacts" id="contacts">
				<p class="contacts-title"><span>РемОкон</span><br> Тепло и уют в Ваш дом!</p>
				<p class="contacts-address">188322, г.Коммунар, Ижорская ул. д.24</p>
				<p class="contacts-phone">тел. +7 (911) 925-25-79</p>
				<p class="contacts-phone">тел. +7 (911) 924-24-69</p>
				<!--<a href="#popup4" class="btn contacts-btn show_popup">Напишите нам</a>-->
			</div>
		</div>
	</div>

<!-- Footer -->
	<!--<footer>
		<div class="container">
			<div class="row">
				<div class="col col1">
					<div class="social-icons">
						<a class="icon-vk" href="https://vk.com/" target="_blank">Vk</a>
						<a class="icon-facebook" href="https://www.facebook.com/" target="_blank">Fb</a>
						<a class="icon-instagram" href="https://instagram.com/" target="_blank">Insta</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

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
	<form action="index.php" method="POST" class="login-form popup" id="popup1">
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
      		<label for="name_user">Ваше имя:</label>
			<input type='text' id='name_user' name='name_user' required>
    	</p>
    	<p class="phone">
		  <label for="phone">Телефон:</label><input type="text" id="phone" name="phone" pattern="[0-9]{11}" placeholder="89107654321" required>
		</p>
		<p class="adress">
		  <label for="adress">Адрес:</label><input type="text" id="adress" name="adress" required>
		</p>
		<p class="formdate">
		  <label for="formdate">Желательная дата:</label><input type="date" id="formdate" name="formdate" required>
		</p>
		<p class="time">
		  <label for="time">Желательное время:</label><input type="text" id="time" name="time" placeholder="15:00" pattern="[0-9]{2}:[0-9]{2}" required>
		</p>
		<p>
			<label for="message">Что будем ремонтировать?:</label>
			<textarea id="message" name="message" placeholder="Изготовление и установка глухого окна ПВХ" style="width: 460px;height: 60px;padding: 5px;"></textarea>
		</p>
		<p>
				<input type='checkbox' id='cb$count' class='cb' name='name_service' required/>
				<label for='cb$count'>Я СОГЛАСЕН на обработку и хранение моих персональных данных, указанных мною в
форме обратной связи на сайте в соответствии с условиями настоящего
согласия на обработку персональных данных.</label>
		</p>
		<div class="form-btns" style="margin-top:0px">
		  <input type="submit" id="write-submit" name="write-submit" class="btn write-submit" value="Записать">
		  <a href="#" class="btn write-cancel modal_close">Отмена</a>
		</div>
	</form>
	<div class="overlay_popup"></div>
	

<!-- Javascript -->
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="js/etimer.js"></script>
	<!--<script type="text/javascript">
		jQuery(document).ready(function() {
				$('.eTimer').eTimer({
				etType: 2, etDate: "20.06.2017.0.0", etTitleText: "До окончания акции осталось:", etTitleSize: 15, etShowSign: 1, etSep: ":", etFontFamily: "Arial", etTextColor: "white", etPaddingTB: 15, etPaddingLR: 15, etBackground: "#eeeeee", etBorderSize: 0, etBorderRadius: 2, etBorderColor: "white", etShadow: " 0px 0px 10px 0px #eeeeee", etLastUnit: 3, etNumberFontFamily: "Arial", etNumberSize: 35, etNumberColor: "white", etNumberPaddingTB: 0, etNumberPaddingLR: 8, etNumberBackground: "#fb565a", etNumberBorderSize: 0, etNumberBorderRadius: 5, etNumberBorderColor: "white", etNumberShadow: "inset 0px 0px 0px 0px rgba(0, 0, 0, 0.5)"
				});
			});
	</script>-->
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
