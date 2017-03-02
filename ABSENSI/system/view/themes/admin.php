<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Informasi Presensi dan TPB - Provinsi Papua </title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/global.css" type="text/css" />
<link rel="stylesheet" href="css/color.css" type="text/css" />
<link rel="stylesheet" href="css/tooltipster.css" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/presensi.js"></script>
<script type="text/javascript" src="js/jquery.tooltipster.js"></script>
<script type="application/javascript">
$(document).ready(function() { 
	$('.toolbutton').click(function(e) {
		 e.preventDefault();
		 var elem = '#'+$(this).attr("alt"),
			 offset = {x: 30, y: 70};
		 $('.expand').hide();	 
		 $(elem).css({right: '5px', top: offset.y}); 
		 $(elem).show();
	});
	$('.expand').mouseleave(function() {
		$(this).hide();
	});
	$(".tooltip").tooltipster({
		position: 'top',
        arrow_color : '#CCC'
	});
});	
</script>
</head>
<body>
<div id="semesta">
        <div id="header" >
        	<div class="atas">
                <div class="left">
                    <img src="img/presensi_1.png" alt=""/>
                </div>
                <div class="right">
                	<div class="ll">
                    	<p class="ket">Masuk Sebagai <b><?php echo $this->user['nama']; ?></b></p>
                    </div><!--[ll]-->
                    <a href="#" alt="user" class="toolbutton">
                    <div class="rr">
                    	<img src="img/propic.png" />
                    </div><!--[rr]-->
                    </a>
                </div><!--[r]-->
            </div>
            <div class="bawah">
                
            </div>
        </div>
        <div class='expand' id="user">
				<div class='arrow'></div>
				<div class='expandcontent'>
					<a href="?pg=profil"><div class='expandsub'>Edit Profile</div></a>
					<a href="?pg=login&mode=out"><div class='expandsub'>Logout</div></a>
                    
				</div>		
			</div>
        <div id="fix_footer">
        	<marquee scrollamount="3" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);">
  				<?php $this->view('footer');?>
  			</marquee>
        </div>
        <div id="main">
            <table border="1" width="100%" height="100%" id="container" cellspacing="0" cellpadding="0">
            <tr>
                <td id="left" class="noborder">
               		<div id="canvas-menu">
                        <?php $this->view('menu'); ?>
                    </div>
                </td>
                <td id="right" class="noborder">
           			<?php $this->view($this->data['view']); ?>
                </td>
            </tr>
            </table>
        </div>
        
</div>
</body>
</html>
