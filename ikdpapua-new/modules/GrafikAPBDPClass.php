<?php
Class GrafikAPBDPClass extends ModulClass{
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

        $script = "
			getGraf = function(tahun) {
                $('#graf-ringkasan-apbd-p').html('');
                $.ajax({
                    type: 'POST',
                    url: 'grafikapbd-p.htm',
                    data: 'do=svc&tahun='+tahun,
                    dataType: 'JSON',
                    success: function(response){
                        config.element      = 'graf-ringkasan-apbd-p';
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
                barColors:['#39F000', '#183EF0', '#ff0000'],
                barRatio: 0.4,
                postUnits: ' M',
                gridTextSize: 10,
                formatter: function (y) { return y + 'M' },
            }";

        #load template table
        $table = new TemplateClass();
		$table->init(THEME.'/grafik/apbd-p.html');
		$define = array (
					'PAGETITLE'	=> 'Grafik Ringkasan APBD-P Kabupaten/Kota',
					'OPTTAHUN' => $option,
		);
		$table->defineTag($define);
		$content = $table->parse();

		$define = array (
						 'PAGETITLE'	=> 'Grafik Ringkasan APBD-P Kabupaten/Kota',
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
		$sql = "SELECT k.kabupaten,
                    (SELECT 
                        SUM(nilaianggaran_p/1000000000) 
                     FROM ringkasan_apbd 
                     WHERE 
                        tahunanggaran = '".$_POST['tahun']."' AND 
                        kodepemda = k.kodepemda AND 
                        kodeakunutama = '4' AND 
                        kodeakunkelompok <> '0' AND 
                        kodeakunjenis <> '0' AND 
                        kodeakunobjek = '0' AND 
                        kodeakunrincian = '0') AS pendapatan, 
                    (SELECT 
                        SUM(nilaianggaran_p/1000000000) 
                     FROM ringkasan_apbd 
                     WHERE 
                            tahunanggaran = '".$_POST['tahun']."' AND 
                            kodepemda = k.kodepemda AND 
                            kodeakunutama = '5' AND 
                            kodeakunkelompok <> '0' AND 
                            kodeakunjenis <> '0' AND 
                            kodeakunobjek = '0' AND 
                            kodeakunrincian = '0') AS belanja,
                    (SELECT SUM(CASE 
                                    kodeakunkelompok WHEN 1 THEN 
                                    nilaianggaran_p/1000000000 WHEN 2 THEN 
                                    nilaianggaran_p/1000000000 * -1 END) 
                     FROM ringkasan_apbd 
                     WHERE tahunanggaran = '".$_POST['tahun']."' AND 
                         kodepemda = k.kodepemda AND 
                         kodeakunutama = '6' AND 
                         kodeakunkelompok <> '0' AND 
                         kodeakunjenis <> '0' AND 
                         kodeakunobjek = '0' AND 
                         kodeakunrincian = '0') AS pembiayaan
                FROM kabupaten k WHERE k.kodepemda LIKE '94%' AND k.kodepemda <> '9400'
                ORDER BY k.kodepemda";

		$data = $this->db->query($sql);
		$array = array();
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('y'=>$res[0], 'a'=>$res[1],'b'=>$res[2], 'c'=>$res[3]);
		}
		$response["chart_data"] = $array;
		$response["chart_xkey"] = array('y');
		$response["chart_ykeys"] = array(0=>'a', 'b', 'c');
		$response["chart_labels"] = array(0=>'PENDAPATAN', 'BELANJA', 'PEMBIAYAAN');

		echo json_encode($response);
	}
}