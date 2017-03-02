<?php 
 $rooturl = 'http://'.$_SERVER['HTTP_HOST']."/GlobalInt/bkm/";

 ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html">SKPD</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo $rooturl; ?>index.html">Home</a></li>
      <li><a href="<?php echo $rooturl; ?>KIB_A.html">KIB A</a></li>
      <li><a href="<?php echo $rooturl; ?>KIB_B.html">KIB B</a></li>
      <li><a href="<?php echo $rooturl; ?>KIB_C.html">KIB C</a></li>
       <li><a href="<?php echo $rooturl; ?>masteraset.html">MASTER ASET</a></li> 
              <li><a href="<?php echo $rooturl; ?>masterbidang.html">MASTER BIDANG</a></li> 
       <li><a href="<?php echo $rooturl; ?>masterorganisasi.html">MASTER ORGANISASI</a></li>
    </ul>
  </div>
</nav>