<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
<title>Sistem Informasi Naskah Dinas</title>          
<link rel="Stylesheet" href="css/style_login.css" type="text/css" />
<link rel="Stylesheet" href="css/color.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('#formlogin').submit(function(){
			$('#user_name').removeClass('red');
			$('#password').removeClass('red');
			if($('#user_name').val() == ""){
				$('#user_name').addClass('red');
				$('#user_name').focus();
				return false;
			}else if($('#password').val() == ""){
				$('#password').addClass('red');
				$('#password').focus();
				return false;
			}
		});
	});
</script>
</head>
<body>

 
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
<form method="post" action="?mod=login&amp;sub=eq_login" id="formlogin">  
    <label>Username:</label><br/><br/>
    <input type="text" name="user_name" id="user_name" class="inputtextbox" /> 
    <br/><br/> 
  <label>Password:</label><br/><br/>
  <input type="password" name="password" id="password" class="input_password" />
<input name="act" type="hidden" id="act" value="eq_login" />
<input name="dst" type="hidden" id="dst" value="http://<?php echo $_GET['dst']; ?>" />
<br/>
    <p class="submit"><input name="" id="login" class="button-primary oranye" type="submit" value="Log in" /></p>
</form>

</div>

</div>
</div>
<!-- content ends here -->

<div id="footer"></div>

<div id="fix_footer">
 <div id="fix_footer_kiri">
  <marquee scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);">
  percobaan
  </marquee>
 </div>
  
</div>

</body>
</html>
