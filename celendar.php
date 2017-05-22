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
					<li><a href="services.php">Услуги</a></li>
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
			my_calendar(array(date("Y-m-d"))); 
			
			function my_calendar($fill=array()) { 
				$month_names=array("январь","февраль","март","апрель","май","июнь",
  									"июль","август","сентябрь","октябрь","ноябрь","декабрь"); 
				if (!isset($y) OR $y < 1970 OR $y > 2037) $y=date("Y");
  				if (!isset($m) OR $m < 1 OR $m > 12) $m=date("m");
				if (isset($_GET['y'])) $y=$_GET['y'];
  				if (isset($_GET['m'])) $m=$_GET['m']; 
  				if (isset($_GET['date']) AND strstr($_GET['date'],"-")) list($y,$m)=explode("-",$_GET['date']);
  				

  				$month_stamp=mktime(0,0,0,$m,1,$y);
  				$day_count=date("t",$month_stamp);
  				$weekday=date("w",$month_stamp);
  				if ($weekday==0) $weekday=7;
  					$start=-($weekday-2);
  					$last=($day_count+$weekday-1) % 7;
  				if ($last==0) $end=$day_count; else $end=$day_count+7-$last;
  					$today=date("Y-m-d");
  					$prev=date('?\m=m&\y=Y',mktime (0,0,0,$m-1,1,$y));  
  					$next=date('?\m=m&\y=Y',mktime (0,0,0,$m+1,1,$y));
  				$i=0;
				
				
			?> 
			<table border=1 cellspacing=0 cellpadding=2 style="width:900px"> 
 				<tr>
  					<td colspan=7> 
   					<table width="100%" border=0 cellspacing=0 cellpadding=0 style="margin-bottom: 25px;"> 
    					<tr> 
     						<td align="left" class="tablename"><a href="<? echo $prev ?>">&lt;&lt;&lt;</a></td> 
     						<td align="center" class="tablename"><? echo $month_names[$m-1]," ",$y ?></td> 
     						<td align="right" class="tablename"><a href="<? echo $next ?>">&gt;&gt;&gt;</a></td> 
    					</tr> 
   					</table> 
  					</td> 
 				</tr> 
 				<tr><td class="tablename">Пн</td>
					<td class="tablename">Вт</td>
					<td class="tablename">Ср</td>
					<td class="tablename">Чт</td>
					<td class="tablename">Пт</td>
					<td class="tablename">Сб</td>
					<td class="tablename">Вс</td>
				<tr>
				<? 
  			for($d=$start;$d<=$end;$d++) { 
				if (!($i++ % 7)) echo " <tr>\n";
    				echo '  <td class="tabletd" align="center">';
    				if ($d < 1 OR $d > $day_count) {
      					echo "&nbsp";
					} 
				else {
      					$now="$y-$m-".sprintf("%02d",$d);
      					if (is_array($fill) AND in_array($now,$fill)) {
        					echo '<a class="atable" href="#">'.$d.'</a>'; 
      						} 
						else {
        					echo $d;
      					}
						
						//$m=$_GET['m'];
						$count=0;
						$write = mysql_query("select id_write from write_to_order") or die(mysql_error());
						while($reswrite = mysql_fetch_array($write)){
							$month = mysql_query("select month(date_order) from write_to_order where id_write='$reswrite[0]'") or die(mysql_error());
							$resmonth = mysql_fetch_array($month);
							
							$count++;
							if($resmonth[0]==$m){
								//echo $m;
								//echo $resmonth[0];
								$date = mysql_query("select day(date_order) from write_to_order where id_write='$reswrite[0]'") or die(mysql_error());
								$resdate = mysql_fetch_array($date);
								if ($d==$resdate[0]){
									echo "<a class='star' href='celtools.php?day=$d&month=$m'>&#10052;</a>";
								}
							}
						}
    				} 
    			echo "</td>\n";
    			if (!($i % 7))  echo " </tr>\n";
				
  			} 
			?>
			</table> 
		<? 
		} 
			?>
		</div>
		<div class="overlay_popup"></div>
		
		
		<form action="index.php" method="POST" class="write-form popup" id="popup">
			<p class="date">
			  <label for="date">Желательная дата:</label><input type="text" name="date" id="user_date">
			</p>
			<p class="time">
			  <label for="time">Желательное время:</label><input type="text" id="time" name="time" placeholder="15:00" pattern="[0-9]{2}:[0-9]{2}">
			</p>
			<div class="form-btns">
			  <input type="submit" id="write-submit" name="write-submit" class="btn write-submit" value="Записать">
			  <a href="#" class="btn write-cancel modal_close">Отмена</a>
			</div>
		</form>
		
		
	<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
		<script src="js/script.js"></script>	
	</main>
	
</body>
</html>
	