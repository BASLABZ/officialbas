<?php
Class DisplayClass extends ModulClass{
	function FrontDisplay(){
		$this->content = "";
		$this->script = "";
		$tahun = "";
		$kodepemda = "";
		$kabupaten = "";
		$apbd = 'M';

		#result tahun dan kabupaten
		$sql = "SELECT tahun FROM setting_dis";
		$data = $this->db->query($sql);
		$res = $this->db->fetchArray($data);

		$tahun = $res['tahun'];

		$sql = "SELECT kodepemda, tahunanggaran FROM ringkasan_apbd WHERE tahunanggaran = (SELECT MAX(tahunanggaran) FROM ringkasan_apbd) GROUP BY kodepemda ORDER BY kodepemda";
		$res = $this->db->query($sql);
		while ($row = $this->db->fetchArray($res)) {
			$arrKodepemda[] = $row['kodepemda'];
			$arrTahun[] = $row['tahunanggaran'];
		}

		if(!isset($_SESSION['urutan'])) $_SESSION['urutan'] = 1;

		$key = $_SESSION['urutan']++;
		if($key == count($arrKodepemda)){
			$kodepemda = $arrKodepemda['0'];
			$tahunanggaran = $arrTahun['0'];
			unset($_SESSION['urutan']);
		} else {
			$kodepemda = $arrKodepemda[$key];
			$tahunanggaran = $arrTahun[$key];
		}

		$sql = "SELECT kabupaten FROM kabupaten WHERE kodepemda = '".$kodepemda."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		$kabupaten = $data['kabupaten'];
		

		#hightChart
			#PIECHART
			$this->piechart = "";
			$sql = "SELECT jo.urai, ROUND((SUM(jumlah)/1000000000),2) AS otsus FROM otsus_transfer ot 
					LEFT JOIN jenis_otsus jo ON (ot.kodejenis = jo.id_otsus)
					WHERE ot.tahunanggaran = '".$tahun."'
					GROUP BY ot.kodejenis";
			$res = $this->db->query($sql);
			while ($data = $this->db->fetchArray($res)) {
				$this->piechart .= "
									{
										name: '".$data[0]."',
										y: ".$data[1]."
									},";
			}

			#BARCHART 3D
			$this->barchartdata = "";
			$this->barchartcat = "";
			$sql = "SELECT 
						k.kabupaten, 
						(SELECT sum(jumlah/1000000000) AS jum
						 FROM otsus_kabupaten 
						 WHERE k.kodepemda = kodepemda 
						 	AND tahun = ".$tahun.") AS otsus 
					FROM kabupaten k
					WHERE k.kodepemda <> '9400' AND k.kodepemda LIKE '94%'
					ORDER BY k.kodepemda";
			$res = $this->db->query($sql);
			while ($data = $this->db->fetchArray($res)) {
				$jum = ($data['otsus'] <> '') ? $data['otsus'] : 'null';
				$this->barchartcat .= "'".$data['kabupaten']."',";
				$this->barchartdata .= $jum.",";
			}

			#BAR OTSUS KABUPATEN
			$sql = "SELECT tahun, ROUND(jumlah/1000000000, 2) AS otsus FROM otsus_kabupaten
					WHERE kodepemda = '".$kodepemda."'";
			$res = $this->db->query($sql);
			$this->barotsuskab = "";
			$this->barotsuskabcat = "";
			while ($data = $this->db->fetchArray($res)){
				$this->barotsuskab .= $data['otsus'].",";
				$this->barotsuskabcat .= "'".$data['tahun']."',";
			}

			#OTSUS KABUPATEN PIE
			$sql = "SELECT 
					ROUND((SUM(jumlah)/1000000000),2) AS otsus, jo.urai
				FROM 
					otsus_transfer ot  
				LEFT JOIN
					jenis_otsus jo ON (ot.kodejenis = jo.id_otsus)
				WHERE ot.tahunanggaran = '".$tahun."' AND ot.kodepemda = '".$kodepemda."'
				GROUP BY ot.kodepemda, ot.kodejenis";
			$res = $this->db->query($sql);
			$this->pieotsus = "";
			while ($data = $this->db->fetchArray($res)){
				$this->pieotsus .= "['".$data['urai']."',".$data['otsus']."],";
			}

		$sql = "SELECT 
                    CONCAT(mr.kodeakunutama, IF(mr.kodeakunkelompok,'.',''),IF(mr.kodeakunkelompok,mr.kodeakunkelompok,''), IF(mr.kodeakunjenis,'.',''), IF(mr.kodeakunjenis,mr.kodeakunjenis,'')) AS kodeakun,
                    mr.namaakun, 
                    ra.nilaianggaran, 
                    ra.nilaianggaran_p, 
                    0 as selisih, 
                    0 as persen,
                    mr.kodeakunutama,
                    mr.kodeakunkelompok,
                    mr.kodeakunjenis                        
                FROM master_rekening AS mr
                LEFT JOIN ringkasan_apbd AS ra ON (
                    ra.kodeakunutama = mr.kodeakunutama 
                    AND ra.kodeakunkelompok = mr.kodeakunkelompok 
                    AND ra.kodeakunjenis = mr.kodeakunjenis
                    AND ra.kodepemda = '".$kodepemda."' 
                    AND ra.tahunanggaran = '".$tahunanggaran."'
                )
                WHERE mr.kodeakunutama IN (4,5,6) AND mr.kodeakunobjek = 0
                GROUP BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis
                ORDER BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis";

	   	$abpddata = array();
        $data = $this->db->query($sql);		
		$rowdata = "";
		$apbdp = 0;
		while ($res = $this->db->fetchArray($data)) {
		// var_dump($res);	
			$rek = explode('.',$res[0]);
			$input = "";
			if ($res['2']=='') $res['2'] = 0;
			if ($res['3']=='') $res['3'] = 0;
			$apbdp += $res['3'];
			
			$bold = $res['8'] == 0 ? "style='font-weight:bold;'" : "";
			if (sizeof($rek)==3 && !($res[0]=='6.3.1' || $res[0]=='6.4.1')) $input = "caninput";
			
			if ($res[0]=='5') {
				$rowdata .= "
				   <tr style='font-weight:bold;'>
				   <td></td>
				   <td align='right'>Jumlah Pendapatan</td>
				   <td align='right' data-koderek='4' data-val='0' class='apbd'></td>
				   <td align='right' data-koderek='4' data-val='0' class='apbdp perubahan'></td>
				   <td align='right' data-koderek='4' data-val='0' class='selisih perubahan'></td>
				   <td align='center' data-koderek='4' data-val='0' class='persen perubahan'></td>
				   </tr>
				";
			} else if ($res[0]=='6') {
				$rowdata .= "
				   <tr style='font-weight:bold;'>
				   <td></td>
				   <td align='right'>Jumlah Belanja</td>
				   <td align='right' data-koderek='5' data-val='0' class='apbd'></td>
				   <td align='right' data-koderek='5' data-val='0' class='apbdp perubahan'></td>
				   <td align='right' data-koderek='5' data-val='0' class='selisih perubahan'></td>
				   <td align='center' data-koderek='5' data-val='0' class='persen perubahan'></td>
				   </tr>
				";
				$rowdata .= "
				   <tr style='font-weight:bold;'>
				   <td></td>
				   <td align='right'>Surplus/(Defisit)</td>
				   <td align='right' data-koderek='SD' data-val='0' class='apbd'></td>
				   <td align='right' data-koderek='SD' data-val='0' class='apbdp perubahan'></td>
				   <td align='right' data-koderek='SD' data-val='0' class='selisih perubahan'></td>
				   <td align='center' data-koderek='SD' data-val='0' class='persen perubahan'></td>
				   </tr>
				";				
			} else if ($res[0]=='6.2') {
				$rowdata .= "
				   <tr style='font-weight:bold;'>
				   <td></td>
				   <td align='right'>Jumlah Penerimaan Pembiayaan</td>
				   <td align='right' data-koderek='6.1' data-val='0' class='apbd'></td>
				   <td align='right' data-koderek='6.1' data-val='0' class='apbdp perubahan'></td>
				   <td align='right' data-koderek='6.1' data-val='0' class='selisih perubahan'></td>
				   <td align='center' data-koderek='6.1' data-val='0' class='persen perubahan'></td>
				   </tr>
				";		
			}
			
				
			$rowdata .= "
			   <tr ".$bold.">
			   <td>".$res['0']."</td>
			   <td>".$res['1']."<input type='hidden' name='akun[\"".$res['0']."\"]' value='".$res['1']."'/></td>
			   <td align='right' data-koderek='".$res['0']."' data-val='".$res['2']."' class='apbd ".$input."'></td>
			   <td align='right' data-koderek='".$res['0']."' data-val='".$res['3']."' class='apbdp perubahan ".$input."'></td>
			   <td align='right' data-koderek='".$res['0']."' data-val='0' class='selisih perubahan'></td>
			   <td align='center' data-koderek='".$res['0']."' data-val='0' class='persen perubahan'></td>
			   </tr>
			";		
		}
		
		if ($rowdata!='') {
				$rowdata .= "
				   <tr style='font-weight:bold;'>
				   <td></td>
				   <td align='right'>Jumlah Pengeluaran Pembiayaan</td>
				   <td align='right' data-koderek='6.2' data-val='0' class='apbd'></td>
				   <td align='right' data-koderek='6.2' data-val='0' class='apbdp perubahan'></td>
				   <td align='right' data-koderek='6.2' data-val='0' class='selisih perubahan'></td>
				   <td align='center' data-koderek='6.2' data-val='0' class='persen perubahan'></td>
				   </tr>
				";		
				
				$rowdata .= "
				   <tr style='font-weight:bold;'>
				   <td></td>
				   <td align='right'>Pembiayaan neto</td>
				   <td align='right' data-koderek='6' data-val='0' class='apbd'></td>
				   <td align='right' data-koderek='6' data-val='0' class='apbdp perubahan'></td>
				   <td align='right' data-koderek='6' data-val='0' class='selisih perubahan'></td>
				   <td align='center' data-koderek='6' data-val='0' class='persen perubahan'></td>
				   </tr>
				";			

				$rowdata .= "
				   <tr style='font-weight:bold;'>
				   <td></td>
				   <td align='left'>Sisal lebih pembiayaan anggaran tahun berkenaan (SILPA)</td>
				   <td align='right' data-koderek='SI' data-val='0' class='apbd'></td>
				   <td align='right' data-koderek='SI' data-val='0' class='apbdp perubahan'></td>
				   <td align='right' data-koderek='SI' data-val='0' class='selisih perubahan'></td>
				   <td align='center' data-koderek='SI' data-val='0' class='persen perubahan'></td>
				   </tr>
				";							
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
				var config = {
	                fillOpacity: 0.6,
	                hideHover: 'auto',
	                behaveLikeLine: true,
	                resize: true,
	                lineColors:['#007fff','#80ff00'],
	                postUnits: ' M',
	                gridTextSize: 10,
	                formatter: function (y) { return y + 'M' },
	            };
	        	proses = function(c,k,isEdit){
					var jumlah = 0;
					$('.caninput.'+c+'[data-koderek^=\''+k+'\']').each(function(i,e){ 
						jumlah += ($(e).attr('data-val')*1); 
					});
									
					if (!$('.'+c+'[data-koderek=\''+k+'\']').hasClass('caninput')) {
						$('.'+c+'[data-koderek=\''+k+'\']').attr('data-val',jumlah);
						$('.'+c+'[data-koderek=\''+k+'\']').html(money_format(jumlah));
					} else {
						if (!isEdit) $('.'+c+'[data-koderek=\''+k+'\']').html(money_format(jumlah));
					}
				};

				hitung = function(c,isEdit) {
					proses(c,'4');
					$('.'+c+'[data-koderek^=\'4.\']').each(function(i,e){ 
							proses(c,$(e).attr('data-koderek'),isEdit);
					});
					proses(c,'5');
					$('.'+c+'[data-koderek^=\'5.\']').each(function(i,e){ 
							proses(c,$(e).attr('data-koderek'),isEdit);
					});
					$('.'+c+'[data-koderek^=\'6.\']').each(function(i,e){ 
							proses(c,$(e).attr('data-koderek'),isEdit);
					});
					
					var surplus = $('.'+c+'[data-koderek=\'4\']').attr('data-val') - $('.'+c+'[data-koderek=\'5\']').attr('data-val');
					var pemb = $('.'+c+'[data-koderek=\'6.1\']').attr('data-val') - $('.'+c+'[data-koderek=\'6.2\']').attr('data-val');
					var silpa = surplus + pemb;
					
					$('.'+c+'[data-koderek=\'SD\']').attr('data-val',surplus);
					$('.'+c+'[data-koderek=\'SD\']').html(money_format(surplus));
					
					$('.'+c+'[data-koderek=\'6\']').attr('data-val',pemb);
					$('.'+c+'[data-koderek=\'6\']').html(money_format(pemb));
					
					$('.'+c+'[data-koderek=\'SI\']').attr('data-val',silpa);
					$('.'+c+'[data-koderek=\'SI\']').html(money_format(silpa));
					
				};
				updateJumlah = function(isEdit) {
					hitung('apbd',isEdit);	
					hitung('apbdp',isEdit);
					var selisih,k,persen;
					$('.apbd').each(function(i,e){ 
						k = $(e).data('koderek');
						selisih = $('.apbdp[data-koderek=\''+k+'\']').data('val')-$(e).data('val');
						$('.selisih[data-koderek=\''+k+'\']').html(money_format(selisih));
						persen = 0;
						if ($(e).data('val')!=0) persen = selisih / $(e).data('val')*100;
						$('.persen[data-koderek=\''+k+'\']').html(money_format(persen));	
					});				
				};
				
				updateJumlah(false);
				".((($apbdp>0) || ($apbd=='P'))?"":"$('.perubahan').toggle();")."
				";

		$pengumuman = "";
		$sql = "SELECT * FROM pengumuman WHERE tampil = 'Y'";
		$res = $this->db->query($sql);
		while ($data = $this->db->fetchArray($res)) {
			$pengumuman .= "<div class='widget-pengumuman-title'>".$data['title']."</div>
							<div class='widget-pengumuman-content'>".$data['content']."</div>
							<div class='widget-pengumuman-postdate'>".$data['postdate']." - ".$data['author']."</div>
							";
		}

		#GRAFIK
		$define = array (
						 'THEME_URL'	=> THEME_URL,
						 'ROOT_URL'		=> ROOT_URL,
						 'TAHUN'		=> $tahun,
						 'PENGUMUMAN'	=> $pengumuman,
            );
		$display = new TemplateClass();
		$display->init(THEME.'/display/widget.html');
		$display->defineTag($define);
		$this->content .= $display->parse();

		

		#TABEL
		$define = array (
						 'THEME_URL'	=> THEME_URL,
						 'ROOT_URL'		=> ROOT_URL,
						 'TAHUN'		=> $tahun,
						 'KABUPATEN'	=> $kabupaten,
						 'APBD-TAHUN'	=> date('Y'),
						 'ROWDATA'		=> $rowdata,
            );
		$display = new TemplateClass();
		$display->init(THEME.'/display/apbd-prov.html');
		$display->defineTag($define);
		$this->content .= $display->parse();
		
	}
}
?>
