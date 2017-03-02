<?php
Class GrafikotsusClass extends ModulClass{
	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		$content ='';
		$script = '';
		$option = '';

		// option tahun
        $sql = "SELECT DISTINCT tahun FROM otsus_kabupaten ORDER BY tahun DESC";
        $res = $this->db->query($sql);
        while ($data = $this->db->fetchArray($res)) {
            $option .= "<option value='".$data['tahun']."'>".$data['tahun']."</option>";
        }
		
		#load template table
        $table = new TemplateClass();
		$table->init(THEME.'/grafik/otsus-kab.html');
		$define = array (
					'PAGETITLE'	=> 'Grafik Dana Otsus Kabupaten/Kota',
					'OPTTAHUN' => $option,
		);
		$table->defineTag($define);
		$content = $table->parse();

		$script = "getOtsusgraf = function(tahun) {
                $('#otsus-graf').html('');
                $.ajax({
                    type: 'POST',
                    url: 'grafikotsuskab.htm',
                    data: 'do=svc&tahun='+tahun,
                    dataType: 'JSON',
                    success: function(response){
                        config.element      = 'otsus-graf';
                        config.data         = response.chart_data;
                        config.xkey         = response.chart_xkey;
                        config.ykeys        = response.chart_ykeys;
                        config.labels       = response.chart_labels;
                        config.stacked      = false;
                        config.resize       = true,
                        config.xLabelAngle  = 45;
                        Morris.Bar(config);
                    }
                });
                return false;
            };
            getOtsusgraf($('#pilihan-tahun').selectpicker('val'));
            var config = {
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors:['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors:['gray','red'],
                barColors:['#FF004E'],
                barRatio: 0.4,
                postUnits: ' M',
                gridTextSize: 10,
                formatter: function (y) { return y + 'M' },
            }";

		$define = array (
						 'PAGETITLE'	=> 'Grafik Penerimaan Dana Otsus Kabupaten/Kota',
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
		$sql = "SELECT 
					k.kabupaten, 
					(SELECT sum(jumlah/1000000000) AS jum
					 FROM otsus_kabupaten 
					 WHERE k.kodepemda = kodepemda 
					 	AND tahun ='".$_POST['tahun']."') AS otsus 
				FROM kabupaten k
				WHERE k.kodepemda <> '9400'
				ORDER BY k.kodepemda";

		$data = $this->db->query($sql);
		$array = array();
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('y'=>$res[0], 'a'=>$res[1]);
		}
		$response["chart_data"] = $array;
		$response["chart_xkey"] = array('y');
		$response["chart_ykeys"] = array(0=>'a');
		$response["chart_labels"] = array(0=>'Dana Otonomi Khusus');

		echo json_encode($response);
	}
}