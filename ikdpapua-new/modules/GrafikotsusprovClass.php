<?php
Class GrafikotsusprovClass extends ModulClass{
	function manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		$content ='';
		$script = '';
		
		#load template table
        $table = new TemplateClass();
		$table->init(THEME.'/grafik/otsus-prov.html');
		$define = array (
					'PAGETITLE'	=> 'Grafik Penerimaan Dana Otsus Provinsi',
		);
		$table->defineTag($define);
		$content = $table->parse();

		$script = "$(function() {
		            $('#graf-otsus-prov').html(\"\");
		            $.ajax({
		              	type: \"POST\",
		              	url: \"grafikotsusprov.htm\",
		              	data: \"do=svc\",
		              	dataType: 'JSON',
		              	success: function(response){
		                	conf.element = 'graf-otsus-prov';
		                	conf.data = response.chart_data;
		                	conf.xkey = response.chart_xkey;
		                	conf.ykeys = response.chart_ykeys;
		                	conf.labels = response.chart_labels;
		                	conf.stacked = true;
		                	Morris.Bar(conf);
		              	}
		            });
		            return false;
		        });
				var conf = {
	                fillOpacity: 0.6,
	                hideHover: 'auto',
	                behaveLikeLine: true,
	                resize: true,
	                pointFillColors:['#ffffff'],
	                pointStrokeColors: ['black'],
	                lineColors:['gray','red'],
	                barColors:['#43FF00', '#0000FF'],
	                barRatio: 0.4,
	                postUnits: ' M',
	                gridTextSize: 10,
	                formatter: function (y) { return y + ' M' },
	            }";

		$define = array (
						 'PAGETITLE'	=> 'Grafik Penerimaan Dana Otsus Provinsi',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl();
	}
	function Service(){
		$response = array();

		// Pendapatan Grafik
		$sql = "SELECT tahun, dana_otsus/1000000000, dana_infrastruktur/1000000000 FROM penerimaan_otsus";

		$data = $this->db->query($sql);
		$array = array();
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('y'=>$res[0], 'a'=>$res[1], 'b'=>$res[2]);
		}
		$response["chart_data"] = $array;
		$response["chart_xkey"] = array('y');
		$response["chart_ykeys"] = array(0=>'a','b');
		$response["chart_labels"] = array(0=>'Dana Otsus', 'Dana Infrastuktur');

		echo json_encode($response);
	}
}