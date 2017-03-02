<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
<title>Sistem Informasi Presensi dan TPB</title>   
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">       
<link rel="Stylesheet" href="css/login.css" type="text/css" />
<link rel="Stylesheet" href="css/color.css" type="text/css" />
<link rel="Stylesheet" href="css/global.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.js" type="text/javascript"></script>

<script type="text/javascript">
	var JBase = '<?php echo $this->cnf->ROOTDIR; ?>';	
</script>
<script type="text/javascript">
$(function () {
		var colors = Highcharts.getOptions().colors;
        $('#container').highcharts({
            chart: {
                type: 'column',
                margin: [ 50, 50, 100, 50]
            },
            title: {
                text: ''
            },
            credit: {
            	enabled: false
            },
            xAxis: {
                categories: [<?php $this->getGrafikData('label')?>
                ],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Presentase (%)'
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        'Presentase: '+ Highcharts.numberFormat(this.y, 1) +'%';
                }
            },
            
            series: [{
                name: 'Population',
                data: [<?php $this->getGrafikData('data')?>],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#cccccc',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
    

</script>
<script src="js/highcharts/highcharts.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>
</head>
<body>
<div id="semesta">
<table id="content">
	<tr><td class="header">
			<div class="left"><img src="img/presensi_1.png"/> </div>
			<div class="right"><img src="img/presensi_2.png"/> </div>
		</td></tr>
	<tr><td class="main">
		<table class="tabhome">
			<tr>
				<td width="30%">
					<div class="item bor-top-biru defaultshadowbox boxhover">
						<div class="title">
							Grafik 10 Presensi Per SKPD Tahun <?php echo date("Y");?>
						</div>
						<div id="container" style="min-width: 350px; height: 350px; margin: 0 auto">
                		
                		</div><!--[d]-->
					</div>
					
				</td>
				<td>
					<div class="item bor-top-biru defaultshadowbox boxhover">
						<div class="title">
							Data Presensi Per SKPD Tahun <?php echo date("Y");?> 					
						</div>
						<div class="d">
							<div class="overflow">
								<table class="tabdata" width="100%">
								<tr>
									<th class="biru" width="30px">No.</th>
									<th class="biru">SKPD</th>
									<th class="biru" width="50px">Presentase</th>
								</tr>
								<?php
									$this->getPresensiData();
								?>
								</table>
							</div>
						</div>
					</div>
				</td>
				<td width="300px" >
					<div id="login_container" class="defaultshadowbox boxhover">
					  <div id="login_user" class="abu-abu">FORM LOGIN</div> 
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
					     
					</div>
				</td>
			</tr>
		</table>
	</td></tr>
	<tr><td class="footer">
		<marquee scrollamount="3" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);">
  				<?php $this->view('footer');?>
  		</marquee></td></tr>
</table>
</div>
<script type="text/javascript" src="js/login/md5.js"></script>
<script type="text/javascript" src="js/login/controller.js"></script>
<script type="text/javascript" src="js/login/object.js"></script>
<script type="text/javascript" src="js/login/config.js"></script>
</body>
</html>