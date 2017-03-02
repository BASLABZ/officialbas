<?php
Class DashboardClass extends ModulClass{
	function FrontDisplay(){
		$this->content = "";
		$this->script = "";

		$sql = "SELECT tahun FROM setting_dis";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);

		$tahun = $data['tahun'];

		#visitor
		$sql = "SELECT count(1) AS jum, date_format(waktu,  '%Y') as tahun 
				FROM users_log 
				GROUP BY date_format(waktu,'%Y')
				ORDER BY tahun DESC";
		$res = $this->db->query($sql);
		$visitor = "";
		while($data = $this->db->fetchArray($res)){
			$visitor .= "<div><div class='widget-title'>".$data['tahun']."</div><div class='widget-subtitle'>Jumlah Visitor</div><div class='widget-int'>".$data['jum']."</div></div>";
		}

		#pendapatan daerah tertinggi
		$sql = "SELECT k.kabupaten,
		        (SELECT 
		            SUM(nilaianggaran/1000000000)
		         FROM ringkasan_apbd 
		         WHERE 
		            tahunanggaran = '".$tahun."' AND 
		            kodepemda = k.kodepemda AND 
		            kodeakunutama = '4' AND 
		            kodeakunkelompok <> '0' AND 
		            kodeakunjenis <> '0' AND 
		            kodeakunobjek = '0' AND 
		            kodeakunrincian = '0') AS pendapatan
		    FROM kabupaten k 
		    ORDER BY pendapatan DESC LIMIT 0,4";
		$res = $this->db->query($sql);
		$pendapatan = "";
		$x =1;
		while($data = $this->db->fetchArray($res)){
			$pendapatan .= "<div><div class='widget-title'>".number_format(abs($data['pendapatan']),2,',','.')." M</div><div class='widget-int'>".$x++.". ".$data['kabupaten']."</div><div class='widget-subtitle'>Pendapatan Daerah Tertinggi ".date('Y')."</div></div>";
		}

		#belanja daerah tertinggi
		$sql = "SELECT k.kabupaten,
		        (SELECT 
		            SUM(nilaianggaran/1000000000)
		         FROM ringkasan_apbd 
		         WHERE 
		            tahunanggaran = '".$tahun."' AND 
		            kodepemda = k.kodepemda AND 
		            kodeakunutama = '5' AND 
		            kodeakunkelompok <> '0' AND 
		            kodeakunjenis <> '0' AND 
		            kodeakunobjek = '0' AND 
		            kodeakunrincian = '0') AS belanja
		    FROM kabupaten k 
		    ORDER BY belanja DESC LIMIT 0,4";
		$res = $this->db->query($sql);
		$belanja = "";
		$x = 1;
		while($data = $this->db->fetchArray($res)){
			$belanja .= "<div><div class='widget-title'>".number_format(abs($data['belanja']),2,',','.')." M</div><div class='widget-int'>".$x++.". ".$data['kabupaten']."</div><div class='widget-subtitle'>Belanja Daerah Tertinggi ".date('Y')."</div></div>";
		}

		#data Peta dan donut
		$sql = "SELECT k.kabupaten, k.kodepemda,
                    (SELECT 
                        ROUND((SUM(nilaianggaran)/1000000000),2)
                     FROM ringkasan_apbd 
                     WHERE 
                        tahunanggaran = '".$tahun."' AND 
                        kodepemda = k.kodepemda AND 
                        kodeakunutama = '4' AND 
                        kodeakunkelompok <> '0' AND 
                        kodeakunjenis <> '0' AND 
                        kodeakunobjek = '0' AND 
                        kodeakunrincian = '0') AS pendapatan, 
                    (SELECT 
                        ROUND((SUM(nilaianggaran)/1000000000),2)
                     FROM ringkasan_apbd 
                     WHERE 
                            tahunanggaran = '".$tahun."' AND 
                            kodepemda = k.kodepemda AND 
                            kodeakunutama = '5' AND 
                            kodeakunkelompok <> '0' AND 
                            kodeakunjenis <> '0' AND 
                            kodeakunobjek = '0' AND 
                            kodeakunrincian = '0') AS belanja,
                    (SELECT ROUND((SUM(CASE 
                                    kodeakunkelompok WHEN 1 THEN 
                                    nilaianggaran WHEN 2 THEN 
                                    nilaianggaran * -1 END)/1000000000),2) 
                     FROM ringkasan_apbd 
                     WHERE tahunanggaran = '".$tahun."' AND 
                         kodepemda = k.kodepemda AND 
                         kodeakunutama = '6' AND 
                         kodeakunkelompok <> '0' AND 
                         kodeakunjenis <> '0' AND 
                         kodeakunobjek = '0' AND 
                         kodeakunrincian = '0') AS pembiayaan,
                    (SELECT SUM(jumlah)
                    FROM otsus_kabupaten 
                    WHERE
                         kodepemda = k.kodepemda AND
                         tahun = '".$tahun."') AS otsus
                FROM kabupaten k WHERE k.kodepemda LIKE '94%' AND k.kodepemda <> '9400'
                ORDER BY k.kodepemda";
        $dt_apbd = "";
        $res = $this->db->query($sql);
        while($data = $this->db->fetchArray($res)){
        	$dt_apbd .= "'".$data['kodepemda']."':{name: '".$data['kabupaten']." ',otsus: ".$data['otsus'].",pend: ".$data['pendapatan'].",bel: ".$data['belanja'].",pemb: ".$data['pembiayaan']."},\n";
        }
        
		$this->script = "
				$(function() {
		            $('#graf-otsus-prov').html('');
		            $.ajax({
		              	type: 'POST',
		              	url: 'data.htm',
		              	data: 'do=svc&cmd=chart_otsus',
		              	dataType: 'JSON',
		              	success: function(response){
		                	config.element = 'graf-otsus-prov';
		                	config.data = response.chart_data;
		                	config.xkey = response.chart_xkey;
		                	config.ykeys = response.chart_ykeys;
		                	config.labels = response.chart_labels;
		                	config.stacked = true;
		                	Morris.Area(config);
		              	}
		            });
		        });
				$(function() {
		            $('#graf-realisasi').html('');
		            $.ajax({
		              	type: 'POST',
		              	url: 'data.htm',
		              	data: 'do=svc&cmd=chart_realisasi',
		              	dataType: 'JSON',
		              	success: function(response){
		                	cfg.element = 'graf-realisasi';
		                	cfg.data = response.chart_data_2;
		                	cfg.xkey = response.chart_xkey_2;
		                	cfg.ykeys = response.chart_ykeys_2;
		                	cfg.labels = response.chart_labels_2;
		                	cfg.stacked = false;
		                	cfg.resize = true;
		                	cfg.xLabelAngle  = 45;
		                	Morris.Bar(cfg);
		              	}
		            });
		        });
				$(function() {
		            $('#chart_visitor').html('');
		            $.ajax({
		              	type: 'POST',
		              	url: 'data.htm',
		              	data: 'do=svc&cmd=chart_visitor&tahun=".$tahun."',
		              	dataType: 'JSON',
		              	success: function(response){
		                	conf.element = 'chart_visitor';
		                	conf.data = response.chart_data_3;
		                	conf.xkey = response.chart_xkey_3;
		                	conf.ykeys = response.chart_ykeys_3;
		                	conf.labels = response.chart_labels_3;
		                	conf.stacked = true;
		                	Morris.Area(conf);
		              	}
		            });
		        });
				$(function() {
		            $('#graf_otsuskab').html('');
		            $.ajax({
		              	type: 'POST',
		              	url: 'data.htm',
		              	data: 'do=svc&cmd=chart_otsuskab&tahun=".$tahun."',
		              	dataType: 'JSON',
		              	success: function(response){
		                	config.element = 'graf_otsuskab';
		                	config.data = response.chart_data_4;
		                	config.xkey = response.chart_xkey_4;
		                	config.ykeys = response.chart_ykeys_4;
		                	config.labels = response.chart_labels_4;
		                	config.stacked = true;
		                	Morris.Bar(config);
		              	}
		            });
		        });
				$(function() {
		            $('#graf-ringkasan').html('');
		            $.ajax({
		              	type: 'POST',
		              	url: 'data.htm',
		              	data: 'do=svc&cmd=chart_ringkasan&tahun=".$tahun."',
		              	dataType: 'JSON',
		              	success: function(response){
		                	config.element 		= 'graf-ringkasan';
		                	config.data         = response.chart_data_5;
	                        config.xkey         = response.chart_xkey_5;
	                        config.ykeys        = response.chart_ykeys_5;
	                        config.labels       = response.chart_labels_5;
	                        config.stacked      = false;
	                        config.resize       = true,
	                        config.xLabelAngle  = 45;
	                        Morris.Bar(config);
		              	}
		            });
				return false;
		        });

				$(function() {
		            $.ajax({
		              	type: 'POST',
		              	url: 'data.htm',
		              	data: 'do=svc&cmd=peta',
		              	dataType: 'JSON',
		              	success: function(response){
		                	apbd : response.data;
		              	}
		            });
				return false;
		        });

				var cfg = {
	                fillOpacity: 0.6,
	                hideHover: 'auto',
	                behaveLikeLine: true,
	                resize: true,
	                pointFillColors:['#ffffff'],
	                pointStrokeColors: ['black'],
	                lineColors:['gray','red'],
	                barColors:['#00f6ff', '#ff0000', '#3cff00'],
	                barRatio: 0.4,
	                postUnits: ' %',
	                gridTextSize: 10,
	                formatter: function (y) { return y + '%' },
	            }
				var conf = {
	                fillOpacity: 0.6,
	                hideHover: 'auto',
	                behaveLikeLine: true,
	                resize: true,
	                pointFillColors:['#ffffff'],
	                pointStrokeColors: ['black'],
	                lineColors:['red'],
	                barRatio: 0.1,
	                postUnits: ' Visitors',
	                gridTextSize: 10,
	                formatter: function (y) { return y + ' Visitors' },
	            }
	            var config = {
	                fillOpacity: 0.6,
	                hideHover: 'auto',
	                behaveLikeLine: true,
	                resize: true,
	                pointFillColors:['#ffffff'],
	                pointStrokeColors: ['black'],
	                lineColors:['gray','red'],
	                barColors:['#39F000', '#183EF0', '#ff0000'],
	                barRatio: 0.4,
	                postUnits: ' M',
	                gridTextSize: 10,
	                formatter: function (y) { return y + ' M' },
	            }
	            var apbd = {".$dt_apbd."};
				
				var otsus = {};	
				var otsustotal = 0;
				$.each(apbd,function(i,e){
					otsus[i] = e.otsus;
					otsustotal += e.otsus;
				});
				
				$('.otsus-pemda').html('Provinsi Papua');
				$('.otsus-jumlah').html(money_format(otsustotal));
				$('.otsus-detail').html('100%');
				$('.otsus-progress').attr('style','width: 100%;');

				var jvm_wm = $('#papua_map').vectorMap({
					map: 'papua_mill', 
					backgroundColor: '#C2E8FF',                                      
					regionsSelectable: true,
					regionsSelectableOne: true,
					series: {
					  regions: [{
						values: otsus,
						scale: ['#B4FF8E', '#169300'],
						normalizeFunction: 'polynomial'
					  }]
					},
					regionStyle: {selected: {fill: '#33414E'}, initial: {fill: '#FFFFFF'}},
					onRegionTipShow: function(e, el, code){
						$('.otsus-pemda').html(apbd[code].name);
						$('.otsus-jumlah').html(money_format(apbd[code].otsus));
						$('.otsus-detail').html(number_format(apbd[code].otsus/otsustotal*100,2,'.','')+'%');
						$('.otsus-progress').attr('style','width: '+number_format(apbd[code].otsus/otsustotal*100,2,'.','')+'%;');
						console.log($('.otsus-progress'));
						if (apbd[code].pend==0 && apbd[code].bel==0 && apbd[code].pemb==0) {
							Donut.setData(otsus);
						} else {
							Donut.setData([
								{label: 'Pendapatan', value: apbd[code].pend},
								{label: 'Belanja', value: apbd[code].bel},
								{label: 'Pembiayaan', value: apbd[code].pemb}
							]);
							Donut.select(0);
						}
						
					}
				});			

				var Donut = Morris.Donut({
					element: 'otsus_chart',
					data: otsus,
					colors: ['#33414E', '#3FBAE4', '#FEA223'],
					resize: true
				});";
			
			#WIDGET
			$define = array (
							 'THEME_URL'	=> THEME_URL,
							 'ROOT_URL'		=> ROOT_URL,
							 'VISITOR'		=> $visitor,
							 'PENDAPATAN'	=> $pendapatan,
							 'BELANJA'		=> $belanja,
	            );			
			
			$dashboard = new TemplateClass();
			$dashboard->init(THEME.'/widgets/widget.html');
			$dashboard->defineTag($define);
			$this->content .= $dashboard->parse();

			#PETA
			$define = array (
							 'THEME_URL'	=> THEME_URL,
							 'ROOT_URL'		=> ROOT_URL,
	            );			
			
			$dashboard = new TemplateClass();
			$dashboard->init(THEME.'/widgets/peta.html');
			$dashboard->defineTag($define);
			$this->content .= $dashboard->parse();

			#GRAFIK
			$define = array (
							 'THEME_URL'	=> THEME_URL,
							 'ROOT_URL'		=> ROOT_URL,
	            );			
			
			$dashboard = new TemplateClass();
			$dashboard->init(THEME.'/widgets/grafik.html');
			$dashboard->defineTag($define);
			$this->content .= $dashboard->parse();
	}
}
