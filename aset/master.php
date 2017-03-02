<!DOCTYPE html>
<html>
<head>
	<title>MASTER</title>
</head>
<body>
	<?php 
		$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
		$query = 'SELECT * FROM TAI';
		$data = ibase_query($config,$query);
	 ?>
</body>
</html>