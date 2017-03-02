<?php 
$host = 'localhost:E:/Masters/master/ASETFIX.GDB';
$username = 'ASET';
$password = 't3mp3-t3l3s';
$dbh = ibase_connect($host,$username,$password);

$stmt = 'SELECT * FROM pemilik';
$sth = ibase_query($dbh, $stmt);

ibase_free_result($sth);
ibase_close($dbh);
 ?>