<?php include 'koneksi/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ZahidHildanMufata</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<!-- get main proses otomatis -->
	<?php
            if(empty( $_GET['pos']) ||  $_GET['pos'] =="")
            {
            $_GET['pos'] = "konten.php";
            }
            if(file_exists( $_GET['pos'].".php")){
            include  $_GET['pos'].".php";
            }else {
            include"konten.php";
            }   
        ?>
	<!-- proses akhir dari get main -->
	
	<?php include 'hubungi.php' ?>
	
	<script type="text/JavaScript">
    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>
</body>
</html>