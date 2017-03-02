<?php
Class GrafikRealisasiClass extends ModulClass{
	function Service(){
		$response = array();
		$sql = "SELECT k.kabupaten,
                    (SELECT 
                        SUM((realisasi*100)/nilaianggaran) 
                     FROM realisasi_apbd 
                     WHERE 
                        tahunanggaran = '".$_POST['tahun']."' AND 
                        kodepemda = k.kodepemda AND 
                        kodeakunutama = '4' AND 
                        kodeakunkelompok <> '0' AND 
                        kodeakunjenis <> '0' AND 
                        kodeakunobjek = '0' AND 
                        kodeakunrincian = '0') AS pendapatan, 
                    (SELECT 
                        SUM((realisasi*100)/nilaianggaran) 
                     FROM realisasi_apbd 
                     WHERE 
                            tahunanggaran = '".$_POST['tahun']."' AND 
                            kodepemda = k.kodepemda AND 
                            kodeakunutama = '5' AND 
                            kodeakunkelompok <> '0' AND 
                            kodeakunjenis <> '0' AND 
                            kodeakunobjek = '0' AND 
                            kodeakunrincian = '0') AS belanja,
                    (SELECT 
                        SUM(CASE 
                            kodeakunkelompok WHEN 1 THEN 
                            (realisasi) WHEN 2 THEN 
                            (realisasi) * -1 END) * 100 / 
                        SUM(CASE 
                            kodeakunkelompok WHEN 1 THEN 
                            (nilaianggaran) WHEN 2 THEN 
                            (nilaianggaran) * -1 END)
                     FROM realisasi_apbd 
                     WHERE tahunanggaran = '".$_POST['tahun']."' AND 
                         kodepemda = k.kodepemda AND 
                         kodeakunutama = '6' AND 
                         kodeakunkelompok <> '0' AND 
                         kodeakunjenis <> '0' AND 
                         kodeakunobjek = '0' AND 
                         kodeakunrincian = '0') AS pembiayaan
                FROM kabupaten k WHERE k.kodepemda LIKE '94%' AND k.kodepemda <> '9400'
                ORDER BY k.kodepemda";
                // die($sql);

		$data = $this->db->query($sql);
		$array = array();
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('y'=>$res[0], 'a'=>number_format($res[1]),'b'=>number_format($res[2]), 'c'=>number_format($res[3]));
		}
		$response["chart_data"] = $array;
		$response["chart_xkey"] = array('y');
		$response["chart_ykeys"] = array(0=>'a', 'b', 'c');
		$response["chart_labels"] = array(0=>'PENDAPATAN', 'BELANJA', 'PEMBIAYAAN');

		echo json_encode($response);
	}
	function manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		$content ='';
		$script = '';
		$option = '';

		// option tahun
        $sql = "SELECT DISTINCT tahunanggaran FROM ringkasan_apbd ORDER BY tahunanggaran DESC";
        $res = $this->db->query($sql);
        while ($data = $this->db->fetchArray($res)) {
            $option .= "<option value='".$data['tahunanggaran']."'>".$data['tahunanggaran']."</option>";
        }

        #load template table
        $table = new TemplateClass();
		$table->init(THEME.'/grafik/realisasi.html');
		$define = array (
					'PAGETITLE'	=> 'Grafik Realisasi APBD Kabupaten/Kota',
					'OPTTAHUN' => $option,
		);
		$table->defineTag($define);
		$content = $table->parse();

		$script = "
			getGraf = function(tahun) {
                $('#graf-realisasi-apbd').html('');
                $.ajax({
                    type: 'POST',
                    url: 'grafikrealisasi.htm',
                    data: 'do=svc&tahun='+tahun,
                    dataType: 'JSON',
                    success: function(response){
                        config.element      = 'graf-realisasi-apbd';
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
            getGraf($('#pilihan-tahun').selectpicker('val'));
            var config = {
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
            }";
		
		$define = array (
						 'PAGETITLE'	=> 'Grafik Realisasi APBD Kabupaten/Kota',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl();
	}
}