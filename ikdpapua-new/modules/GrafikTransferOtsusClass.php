<?php
Class GrafikTransferOtsusClass extends ModulClass{
	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		$content ='';
		$script = '';
		$optionKabupaten = '';

        // option tahun
        $sql = "SELECT kodepemda, kabupaten FROM kabupaten WHERE kodepemda LIKE '%94%' AND kodepemda <> '9400' ORDER BY kodepemda ASC";
        $res = $this->db->query($sql);
        while ($data = $this->db->fetchArray($res)) {
            $optionKabupaten .= "<option value='".$data['kodepemda']."'>".$data['kabupaten']."</option>";
        }
		
		#load template table
        $table = new TemplateClass();
		$table->init(THEME.'/grafik/transfer-otsus.html');
		$define = array (
					'PAGETITLE'	=> 'Grafik Dana Otsus Kabupaten/Kota',
					'TAHUN' => date('Y'),
					'SELECT_KABUPATEN' => $optionKabupaten, 
		);
		$table->defineTag($define);
		$content = $table->parse();

		$script = "
			getGraf = function(kodepemda) {
                $('#otsus-trf').html('');
                $.ajax({
                    type: 'POST',
                    url: 'grafiktransfer.htm',
                    data: 'do=svc&kodepemda='+kodepemda,
                    dataType: 'JSON',
                    success: function(response){
                        config.element      = 'otsus-trf';
                        config.data         = response.chart_data;
                        Morris.Donut(config);
                    }
                });
                return false;
            };
            getGraf($('#kodepemda').selectpicker('val'));
            var config = {
                fillOpacity: 0.6,
                hideHover: 'auto',
                resize: true,
                colors:['#ff3333','#33414E', '#3FBAE4', '#FEA223', '#00b300', '#663300', '#cc00cc'],
                gridTextSize: 10,
                formatter: function (y) { return y + ' M' },
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
		#grafik data
		
		$sql = "SELECT 
					ROUND((SUM(jumlah)/1000000000),2), jo.urai
				FROM 
					otsus_transfer ot  
				LEFT JOIN
					jenis_otsus jo ON (ot.kodejenis = jo.id_otsus)
				WHERE ot.tahunanggaran = '".date('Y')."' AND ot.kodepemda = '".$this->scr->filter($_POST['kodepemda'])."'
				GROUP BY ot.kodepemda, ot.kodejenis";
		// die($sql);
		$data = $this->db->query($sql);
		$array = array();
		$x = 1;
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('label' => $res[1], 'value' => $res[0]);
		}
		$response["chart_data"] = $array;

		echo json_encode($response);
	}
}