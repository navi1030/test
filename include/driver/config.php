<?php
 
session_start();
$conn_error='Could not Connect.';
$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='';
$mysql_db='efine_final';

$con=mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
// Check connection
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
