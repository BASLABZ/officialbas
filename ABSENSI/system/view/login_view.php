<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
<title>Sistem Informasi Presensi</title>   
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">       
<link rel="Stylesheet" href="css/style_login.css" type="text/css" />
<link rel="Stylesheet" href="css/color.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">//<![CDATA[

	var JBase = '<?php echo $this->cnf->ROOTDIR; ?>';	
//]]></script>
</head>
<body>

<div id="semesta">
<div id="bgimg">
	<!--<img src="images/bgimg.jpg" alt=""/>-->
</div>
<!-- content starts here -->
<div id="login_banner">
<!--
<img src="images/banner.png" alt="" width="400" height="80" />
-->


</div>

<div id="login_container">
  <div id="login_user" class="biru">SISTEM INFORMASI PRESENSI</div> 
	<div id="login_box">
        <div id="right"> 
        <form method="post" id="formLogin">  
            <label>Username:</label><br/><br/>
            <input type="text" name="username" id="username" class="inputtextbox" /> 
            <br/><br/> 
          <label>Password:</label><br/><br/>
          <input type="password" name="password" id="password" class="input_password" />
        
        <br/><br/>
            <input name="" id="login" class="button-primary oranye" type="submit" value="Log in" />
            <input type="hidden" value="tes" name="hash" id="hash" />
        </form>
        
        </div>
		<div class="auth">
                	<p class="loading">
                		<img src="img/loading.gif" alt="loading"/>
                    	<span class="auth-text">Authenticating..</span>
                    </p><!--/loading/-->
                    <p class="error hide"></p><!--/error/-->
                    <p class="sukses hide">
                    
                    </p><!--/sukses/-->
        </div><!--[auth]--> 
	</div>
    <div id="bottom_title" class="abu-abu">
    	<div class="left"><img src="img/papua.png" height="30px"/></div>
    	<div class="right">PEMERINTAH PROVINSI PAPUA</div></div> 
</div>
<!-- content ends here -->
<div id="fix_footer">
        	<marquee scrollamount="3" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);">
  				<img src="img/papua-kecil.png"/> <p>Selamat Menggunakan Sistem Aplikasi Presensi</p>
  			</marquee>
</div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/login/md5.js"></script>
<script type="text/javascript" src="js/login/controller.js"></script>
<script type="text/javascript" src="js/login/object.js"></script>
<script type="text/javascript" src="js/login/config.js"></script>
</body>
</html>
