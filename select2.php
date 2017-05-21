<?php require "tools.php"; 
$day=$_GET['day'];
$id_client = mysql_query("select id_client from write_to_order where day(date_order)='$day'") or die(mysql_error());
while($resid = mysql_fetch_array($id_client)){
	$name = mysql_query("select name from client where id_client='$resid[0]'");
	$resname = mysql_fetch_array($name);
	$name_client = $resname[0];
	echo $name_client;
}

?>