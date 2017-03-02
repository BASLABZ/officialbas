<?php 
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "imkom_profile";
	$konekkeserver = mysql_connect($server,$username,$password) or die("maaf server anda sedang down");
	$caridatabase = mysql_select_db($database) or die("maaf database tidak ditemukan");
 ?>