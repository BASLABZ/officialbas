<script type="text/javascript">
	var grafdata = [<?php echo $this->getGrafikData();?>];
	
	$(document).ready(function() { 
		tampil();
	});
	function ubahTahun(){
		var tahun = $("#tahun").val();
        
        $.ajax({
            type:"POST",
            url: "?pg=home&mode=ambildata",
            dataType: 'json',
            data: "tahun="+tahun,
            cache: false,
            success: function(msg){
            	grafdata = msg;
                tampil();
            }
        });
	}
	function tampil(){
	    $('#grafik').highcharts({
		    chart: {

	        },
	        title: {
                text: ''
            },
	    	yAxis: {
	    		title: {
                    text: 'Presentase (%)'
                },
	    		min: 0
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
            
	        xAxis: {
	            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
	        },
	    
	        series: [{
	            data: grafdata,
	            color: '#a6c96a'
	        }]
	    
	    })

	}
</script>
<script src="js/highcharts/highcharts.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>

	<table width="100%" height="100%">
		<tr>
			<td style="vertical-align:top;padding-right:10px;">
				<div class='homeinfo'>
					Selamat datang di <b>Sistem Informasi Presensi</b>
				</div>
				<div class="kotak">

					<div class="title abu-abu">Grafik Presensi Seluruh SKPD</div>
					<div class="nav">Tahun : <?php echo "".$this->optTahun(@$_POST["tahun"]).""; ?></div> 
					<div id="grafik" style="width: 100%; height: 350px; margin: 0 auto">
				</div>
				
			</td>
			<td width="300px;" style="vertical-align:top;">
				<div class="item bor-top-kuning defaultshadowbox boxhover">
						<div class="title">
							Catatan Aktifitas
						</div>
						<div class="d">
							<?php
								$this->getLogdata();
							?>
						</div>
					</div>
			</td>
		</tr>
	</table>
	 
</div>