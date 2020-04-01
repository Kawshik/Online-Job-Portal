<?php 

$serverName = "localhost";
$dBName = "online_job_portal";
$dBUsername = "root";
$dBPassword = "";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn){
	die("Conection Failed: ".mysql_connect_error());
}