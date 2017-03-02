<?php
error_reporting(E_PARSE |  E_ERROR | E_STRICT | E_WARNING) ;
				$dbi = new mysqli('localhost','root','sapi','presensi_edt')or die('gagal db');	
				$query = "select * from generallogdata";
				$statment = $dbi->prepare($query);
				$statment->execute();
?>						