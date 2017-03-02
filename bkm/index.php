<?php include 'include.php'; ?> 
<!DOCTYPE html>
<html>
<head>
	<title>HOME </title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'menu.php'; ?>
	<div class="container">
		 <?php
			if(empty( $_GET['hal']) ||  $_GET['hal'] ==""){
			$_GET['hal'] = "main.php";
			}
			if(file_exists( $_GET['hal'].".php")){
			include  $_GET['hal'].".php";
			}else {
			include"main.php";
			}   
			?> 
	</div>
<footer>
	<CENTER>	@copy right - Gondes </CENTER>
</footer>



</body>
</html>