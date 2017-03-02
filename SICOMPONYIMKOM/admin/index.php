<?php 
	include '../koneksi/koneksi.php';
	session_start();

if (isset($_GET['logout'])) {
	session_destroy();
	header('location: index.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistem Componi Profile Imkom Academy</title>
	 <meta charset="utf-8"> 
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <!-- konfigurasi Boostrap -->
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <script type="text/javascript" src = "js/bootstrap.min.js"></script>
	 <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>

	<!-- ini unutk get main otomatis -->

	<?php 
	if (isset($_SESSION['idadmin']) && isset($_SESSION['username'])) 
	{
		include 'menuatas.php';

		if (isset($_GET['pos'])) 
		{
			include($_GET['pos'].'.php');
		}
		else
		{
			include('konten.php');
		}
	}
	else
	{
		include('login.php');
	}
?>



</body>
</html>