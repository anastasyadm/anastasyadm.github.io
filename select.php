<?php require "tools.php"; 
$id=$_POST['idid'];
$date=$_POST['write_date'];
$time=$_POST['write_time'];
$query=mysql_query("UPDATE write_to_order SET varification='1',Date_order='$date',Time_order='$time' WHERE id_write='$id'") or die(mysql_error());
?>