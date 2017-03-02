<?php
Class ServiceDataClass extends ModulClass{
	//return e json
	
	function Insert(){
		# query insert 
	}
	function Update(){
		# query update 
	}
	function Delete(){
		# query delete 
	}
	
	function FrontDisplay(){

	}	
	
	function Manage(){

	}	
	
	function Service(){
		$content='';
		if (isset($_POST['tahun'])) $tahun = $this->scr->filter($_POST['tahun']);
		if (isset($_POST['cmd'])) {
			switch($_POST['cmd']){  
				case 'chart_visitor':
					$content = $this->chart_visitor($tahun);
				break;
				case 'chart_otsus':
					$content = $this->chart_otsus();
				break;
				case 'chart_otsuskab';
					$content = $this->chart_otsuskab($tahun);
				break;
				case 'chart_realisasi':
					$content = $this->chart_realisasi();
				break;
				case 'chart_ringkasan':
					$content = $this->chart_ringkasan($tahun);
				break;
				case 'trfotsustot' :
					$content = $this->trfotsustot();
				break;
				case 'disp_otsuskab' :
					$content = $this->disp_otsuskab();
				break;
				case 'penerima_graf' :
					$content = $this->penerima_graf();
				break;
				default: 
					$content = '';
				break;	
			}
		}
		echo $content;
	}
	
	function GetDetail($id){
		# detail artikel
	}	
	
	function chart_visitor($tahun){
		$response = array();
		$sql = "SELECT 
					count(username) as jum, 
					date_format(waktu,'%Y-%m') as tahunbulan,
					date_format(waktu,'%M') as bulan
				FROM users_log
				WHERE YEAR(waktu)='".$tahun."'
				GROUP BY date_format(waktu,'%m%Y')
				ORDER BY date_format(waktu,'%m')";
		$data = $this->db->query($sql);	
		$array = array();
		
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array(
				'a' => $res[0], // jumlah
				'y' => $res[1], // tahun
				'b'	=> $res[2]
			);
		}
		
		$response["chart_data_3"] = $array;
		$response["chart_xkey_3"] = array(0 =>'y');
		$response["chart_ykeys_3"] = array(0 => 'a');
		$response["chart_labels_3"] = array(0 => 'Visitor');

		echo json_encode($response);
	}
	function chart_otsus(){
		$response = array();
		$sql = "SELECT 
					tahun, 
					dana_otsus/1000000000, 
					dana_infrastruktur/1000000000 
				FROM penerimaan_otsus";

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
	function chart_otsuskab($tahun){
		$response = array();
		$sql = "SELECT 
					k.kabupaten, 
					(SELECT sum(jumlah/1000000000) AS jum
					 FROM otsus_kabupaten 
					 WHERE k.kodepemda = kodepemda 
					 	AND tahun = '".$tahun."') AS otsus 
				FROM kabupaten k
				WHERE k.kodepemda <> '9400' AND k.kodepemda LIKE '94%'
				ORDER BY k.kodepemda";
				// die($sql);

		$data = $this->db->query($sql);
		$array = array();
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('y'=>$res[0], 'a'=>$res[1]);
		}
		$response["chart_data_4"] = $array;
		$response["chart_xkey_4"] = array('y');
		$response["chart_ykeys_4"] = array(0=>'a');
		$response["chart_labels_4"] = array(0=>'Dana Otonomi Khusus');

		echo json_encode($response);
	}

	function disp_otsuskab(){
		$response = array();
		$sql = "SELECT 
					k.kabupaten, 
					(SELECT sum(jumlah/1000000000) AS jum
					 FROM otsus_kabupaten 
					 WHERE k.kodepemda = kodepemda 
					 	AND tahun = ".$_POST['tahun'].") AS otsus 
				FROM kabupaten k
				WHERE k.kodepemda <> '9400' AND k.kodepemda LIKE '94%'
				ORDER BY k.kodepemda";
				// die($sql);

		$data = $this->db->query($sql);
		$array = array();
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('y'=>$res[0], 'a'=>$res[1]);
		}
		$response["chart_data_4"] = $array;
		$response["chart_xkey_4"] = array('y');
		$response["chart_ykeys_4"] = array(0=>'a');
		$response["chart_labels_4"] = array(0=>'Dana Otonomi Khusus');

		echo json_encode($response);
	}

	function chart_realisasi(){
		$response = array();
		$sql = "SELECT k.kabupaten,
                    (SELECT 
                        SUM((realisasi*100)/nilaianggaran) 
                     FROM realisasi_apbd 
                     WHERE 
                        tahunanggaran = YEAR(CURDATE()) AND 
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
                            tahunanggaran = YEAR(CURDATE()) AND 
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
                     WHERE tahunanggaran = YEAR(CURDATE()) AND 
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
			$array[] = array('y'=>$res[0], 'a'=>number_format($res[1]),'b'=>number_format($res[2]), 'c'=>number_format($res[3]));
		}
		$response["chart_data_2"] = $array;
		$response["chart_xkey_2"] = array('y');
		$response["chart_ykeys_2"] = array(0=>'a', 'b', 'c');
		$response["chart_labels_2"] = array(0=>'PENDAPATAN', 'BELANJA', 'PEMBIAYAAN');

		echo json_encode($response);
	}

	function chart_ringkasan($tahun){
		$response = array();
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
                        kodeakunrincian = '0') AS pendapatan, 
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
                            kodeakunrincian = '0') AS belanja,
                    (SELECT SUM(CASE 
                                    kodeakunkelompok WHEN 1 THEN 
                                    nilaianggaran/1000000000 WHEN 2 THEN 
                                    nilaianggaran/1000000000 * -1 END) 
                     FROM ringkasan_apbd 
                     WHERE tahunanggaran = '".$tahun."' AND 
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
		$response["chart_data_5"] = $array;
		$response["chart_xkey_5"] = array('y');
		$response["chart_ykeys_5"] = array(0=>'a', 'b', 'c');
		$response["chart_labels_5"] = array(0=>'PENDAPATAN', 'BELANJA', 'PEMBIAYAAN');

		echo json_encode($response);
	}
	function trfotsustot(){
		$response = array();
		$sql = "SELECT jo.urai, ROUND((SUM(jumlah)/1000000000),2) AS otsus FROM otsus_transfer ot 
				LEFT JOIN jenis_otsus jo ON (ot.kodejenis = jo.id_otsus)
				WHERE ot.tahunanggaran = '".date('Y')."'
				GROUP BY ot.kodejenis";
		$data = $this->db->query($sql);
		$array = array();
		while ($res = $this->db->fetchArray($data)) {
			$array[] = array('label' => $res[0], 'value' => $res[1]);
		}
		$response["donut_data"] = $array;
		echo json_encode($response);
	}
	function penerima_graf(){
		$response = array();
		$sql = "
			SELECT 
				ROUND((SUM(jumlah)/1000000000),2), jo.urai
			FROM 
				otsus_transfer ot  
			LEFT JOIN
				jenis_otsus jo ON (ot.kodejenis = jo.id_otsus)
			WHERE ot.tahunanggaran = '".$_POST['tahun']."' AND ot.kodepemda = '".$_POST['kodepemda']."'
			GROUP BY ot.kodepemda, ot.kodejenis
		";
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
