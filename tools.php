<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
$connect = mysql_connect('localhost', 'root', '') or die(mysql_error());
mysql_select_db('remokon') or die(mysql_error());
function log_in(){
    $login=($_POST['logemail']);
    $ath = mysql_query("select password from client where email='".$login."'") or die(mysql_error());
      if($ath){
		$author = mysql_fetch_array($ath);
        $pass=$author['password'];
		if($pass=='admin'){
		  $_SESSION['user_email'] = $_POST['logemail'];
          $mass = mysql_query("select id_client from client where email='".$_SESSION['user_email']."'");
          $id = mysql_fetch_array($mass);
          $id_user=$id[0];
          $_SESSION['id_user']=$id_user;
		  $_SESSION['admin']=True;
          echo '<script>location.replace("admin.php");</script>'; exit;
		}
        /*if($pass == ($_POST['logpassword'])){
          $_SESSION['user_email'] = $_POST['logemail'];
          $mass = mysql_query("select id_client from client where email='".$_SESSION['user_email']."'");
          $id = mysql_fetch_array($mass);
          $id_user=$id[0];
          $_SESSION['id_user']=$id_user;
          $_SESSION['author']=True;
          //echo '<script>location.replace("reindex.php");</script>'; exit;
        }*/
		else{
          echo "<p class='error' style='color:red;'>Вы ввели неправильный логин/пароль</p>
		  ";
        }
	  }
}
/*function registration(){
	$username=$_POST['name'];
    $usersurname=$_POST['surname'];
    $useremail=$_POST['email'];
    $userpassword=$_POST['password'];
    $query=mysql_query("INSERT INTO client
            			VALUES(default, '$usersurname','$username',default,
             				'$useremail','$userpassword', default, default)") or die(mysql_error());
	$_SESSION['user_email'] = $useremail;
	$mass = mysql_query("select id_client from client where email='".$_SESSION['user_email']."'");
    $id = mysql_fetch_array($mass);
    $id_user=$id[0];
    $_SESSION['id_user']=$id_user;
	$_SESSION['author']=True;
}
$go=$_GET['log_out'];
if(isset($go)){
  session_start();
  session_unset();
  session_destroy();
  echo '<script>location.replace("index.php");</script>'; exit;
}*/

?>

