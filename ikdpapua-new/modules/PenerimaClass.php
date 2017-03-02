<?php
Class PenerimaClass extends ModulClass{		

	function Insert(){
		# query insert
		$this->Update();
	}
	function Update(){
		# query update 
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$jumlah = str_replace(',','.',str_replace('.','', $_POST['edtJumlah']));
			$sql = "REPLACE INTO otsus_kabupaten SET
					tahun = '".$this->scr->filter($_POST['edtTahun'])."',
					kodepemda = '".$this->scr->filter($_POST['cbKabupaten'])."',
					jumlah = ".$jumlah."
					";
			$res = $this->db->query($sql)or die('ERROR');
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}		
	}
	function Delete(){
		# query delete 
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$sql = "DELETE FROM otsus_kabupaten WHERE 
					tahun = '".$this->scr->filter($_POST['edtTahun'])."' AND
					kodepemda = '".$this->scr->filter($_POST['cbKabupaten'])."'
					";
			$res = $this->db->query($sql) or die('ERROR');		
			die('OK');
		}
	}
	function Service(){
		# service handle
		$cmd = '';
		$id = '';

		if (isset($_POST['cmd'])) $cmd = $this->scr->filter($_POST['cmd']);
		if (isset($_POST['id'])) $id = $this->scr->filter($_POST['id']);
		
		if ($cmd=='list') {
			if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
			$content = "";
			$listtahun = array();
			$sql = "SELECT DISTINCT(tahun) FROM otsus_kabupaten ORDER by tahun DESC";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				 $listtahun[] = $data['tahun'];
			}

			$wpemda = $this->auth->getKodePemda();
			if ($wpemda!='') $wpemda = " AND kodepemda='".$wpemda."' ";

			$sql = "SELECT * FROM kabupaten WHERE kodepemda<>'9400' ".$wpemda." ORDER by kodepemda";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				$content .= "<tr>
							<td>".$data['kodepemda']."</td>
							<td>".$data['kabupaten']."</td>
				";
				
				foreach($listtahun as $tahun) {
					$sqldata = "SELECT jumlah FROM otsus_kabupaten WHERE tahun='".$tahun."' AND kodepemda='".$data['kodepemda']."'";	
					$resdata =	$this->db->query($sqldata);				
					if ($apbd = $this->db->fetchArray($resdata)) {
						$content .= "<td class='text-right success'>
										<a href='".ROOT_URL."detail/penerima/".$tahun."-".$data['kodepemda']."/rincian.htm' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='".number_format($apbd[0],2,',','.')."'>".number_format($apbd[0]/1000000000,2,',','.')."M</a>
									</td>";
					} else  {
						$content .= "<td class='text-center warning' style='padding: 5px;'>
										<a class='' href='#' onClick='return add(\"".$tahun."\",\"".$data['kodepemda']."\");' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Tambah Data'><span class='fa fa-plus'></span></a>
									</td>";					
					}
				}
				
				$content .= "</tr>";
			}
			$content .= "<tr style='font-weight: bold;'>
						<td></td>
						<td>Jumlah</td>
			";
			
			foreach($listtahun as $tahun) {
				$wpemda = $this->auth->getKodePemda();
				if ($wpemda!='') $wpemda = " AND kodepemda='".$wpemda."' ";
				
				$sqldata = "SELECT sum(jumlah) FROM otsus_kabupaten WHERE tahun='".$tahun."' ".$wpemda."";	
				$resdata =	$this->db->query($sqldata);				
				if ($otsus = $this->db->fetchArray($resdata)) {
					$content .= "<td class='text-right'>
									<a class='' href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='".number_format($otsus[0],2,',','.')."'>".number_format($otsus[0]/1000000000,2,',','.')."M</a>
								</td>";
				}
			}
			
			$content .= "</tr>";			
			
            echo $content;
        }
        
    }       
	
	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		$content ='';
		$script = '';

		$listtahun = "";
		$sql = "SELECT DISTINCT(tahun) FROM otsus_kabupaten ORDER by tahun DESC";	
		$res =	$this->db->query($sql);
		while ($data =$this->db->fetchArray($res)) {
			 $listtahun .= "<th class='text-center'>".$data['tahun']."</th>";
		}
  
  
		$table = new TemplateClass();
		$table->init(THEME.'/tables/penerima.html');
		$define = array (
						'LIST_TAHUN'	=> $listtahun,	
                );
		$table->defineTag($define);
		$content = $table->parse();
				
		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/penerima.html');
		$form->defineTag('TAHUN',date('Y'));
		$form->defineTag('SELECT_KABUPATEN',$this->owner->kabupaten->SelectorBody());
		$content .= $form->parse();				
				
		$script = "
			function loadData() {
				$('#loader').modal('show');
				
				$.post('#',{'do':'svc','cmd':'list'}, function(data) { 
					$('#loader').modal('hide'); 
					$('#tbodyData').html(data);	
				});
			};
			
			function edit(t,p) {
				$.post('#',{'do':'svc','cmd':'detail','id':t+'-'+p}, function(data) {
					$('#title').text('Edit Data Penerima');
					$('.frmPenerima input[name=do]').val('edt');
					$('.frmPenerima input[name=id]').val(data.id);
					$('#cbKabupaten').selectpicker('val',data.kodepemda);
					$('#edtTahun').val(data.tahun);
					$('#edtJumlah').autoNumeric('set',data.jumlah);
					$('#edtTahun').spinner('option','disabled',true);
					
					$('#cbKabupaten').prop('disabled',true);
					$('#cbKabupaten').selectpicker('refresh');
					
					$('#btnHapus').show();
					$('#edtJumlah').focus()
					$('#penerima').modal('show');
				},'json');
				return false;
				
			};			
			
			function add(t,p) {
				$('#title').text('Tambah Penerima');
				$('.frmPenerima input[name=do]').val('add');
				$('.frmPenerima input[name=id]').val('');
				$('#cbKabupaten').selectpicker('val',p);	
				if (t=='') t='".date('Y')."';
				$('#edtTahun').val(t);
				$('#edtJumlah').autoNumeric('set',0);
				
				$('#edtTahun').spinner('option','disabled',false);
				$('#cbKabupaten').prop('disabled',false);
				$('#cbKabupaten').selectpicker('refresh');				
				
				$('#btnHapus').hide();
				$('#penerima').modal('show');
				return false;
			};
			
			function del() {
				bootbox.confirm('Yakin akan menghapus data?',function(result) {
					if (result) {
						$('.frmPenerima input[name=do]').val('del');
						$.post('#',$('.frmPenerima').serialize(), function(data) { 
							if (data!='OK') bootbox.alert('Tidak berhasil menghapus! Ada data lain yang membutuhkan data ini');
							else {
								$('#penerima').modal('hide');
								loadData(); 
							}
						});
					}
				}); 
				return false;
			};			
																	
			loadData();
			$('.spinner_default').spinner();
			$('.edtUang').autoNumeric('init',{
				aSep: '.',
				aDec: ',', 
				aSign: ''
			});
			
			$(document).on('submit','.frmPenerima',function(e){
				e.preventDefault();
				var sukses = true;
								
				if ($('#cbKabupaten').selectpicker('val')=='') {
					bootbox.alert('Kabupaten/Kota belum dipilih!');
					sukses = false;
				}
				
				if (sukses) {
					$.post('#',$('.frmPenerima').serialize(), function(data) { 
						if (data!='OK') bootbox.alert('Tidak berhasil!');
						else {
							bootbox.info('Berhasil menyimpan data!');
							$('#penerima').modal('hide');
							loadData(); 
						}
					});				} 
			});			
		";
		
		$define = array (
						 'PAGETITLE'	=> 'Kabupaten/Kota Penerima Dana Otonomi Khusus',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
				
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl(); 		
	
	}
	
	function GetDetail($id){

		list($tahun,$kodepemda) = explode('-',$this->scr->filter($id));
		$kab = '';
		
		$sql = "SELECT * FROM kabupaten WHERE kodepemda='".$kodepemda."'";	
		$res =	$this->db->query($sql);
		if ($data = $this->db->fetchArray($res)) {
			$kab = $data['kabupaten'];
		}

		$detail = "";

		$sql = "SELECT kodejenis,COUNT(kodejenis) AS numtahap FROM otsus_transfer
				WHERE
					kodepemda='".$kodepemda."' AND
					tahunanggaran='".$tahun."' 
				GROUP BY 
					kodejenis";
		$rmaxtahap = $this->db->query($sql);
		$maxtahap = '0';
		while($dmaxtahap = $this->db->fetchArray($rmaxtahap)){
			if($dmaxtahap['numtahap'] > $maxtahap) $maxtahap = $dmaxtahap['numtahap'];
		}	

		$nummerge = 3 * $maxtahap;
		$colspan = ($maxtahap != '0') ? "3" : "0";		
		$tahaplbl = "";
		$tahapheading = "";
		for($x=1;$x<=$maxtahap;$x++){
			$tahaplbl .= "<th class='text-center' colspan='".$colspan."'> REALISASI TAHAP ".$x." </th>";
			$tahapheading .= "<th class='text-center'>   Tanggal   </th>";
			$tahapheading .= "<th class='text-center'>   No SP2D  </th>";
			$tahapheading .= "<th class='text-center'>   Nilai  </th>";
		}

		$detail .= "<table id='tblPenerima' class='table table-hover table-actions table-bordered table-striped' style='margin-bottom:0;'>";
		$detail .= "<thead>
						<tr>
							<th style='vertical-align: middle;' rowspan='2' class='text-center'>URAI</th>
							".$tahaplbl."
							<th style='vertical-align: middle;' rowspan='2' class='text-center' width='150px'>PENERIMAAN</th>
							<th style='vertical-align: middle;' rowspan='2' class='text-center'>  % </th>
					   </tr>";

		$sql = "SELECT 
					* 
				FROM 
					otsus_kabupaten
				WHERE 
					tahun = '".$tahun."' AND 
					kodepemda='".$kodepemda."'";

		$rkab =	$this->db->query($sql);
		$dkab = $this->db->fetchArray($rkab);

			$detail .= "<tr>
							".$tahapheading."
					   </tr>
				   </thead>
				   <tbody>
				   <tr>
						<th>".strtoupper($kab)."</th>";
			$detail .= ($nummerge != 0) ? "<th colspan = '".$nummerge."'></th>" : "";
			$detail .="<th class='text-right'>".number_format($dkab['jumlah'],2,',','.')."</th>
						<th  class='text-center'>  </th>
				   </tr>";
	
		$sql = "SELECT 
					*, IF(SUM(jumlah) IS NULL,0,SUM(jumlah)) AS total_realisasi
				FROM 
					jenis_otsus j left join otsus_transfer t
					on
						j.id_otsus = t.kodejenis and
						kodepemda='".$kodepemda."' and 
						tahunanggaran='".$tahun."'
				GROUP BY
					j.id_otsus		
					 ";		

					
		$rjenis =	$this->db->query($sql);
		while($djenis = $this->db->fetchArray($rjenis)){
			
			$sql = "SELECT * FROM otsus_transfer
					WHERE
						kodepemda = '".$kodepemda."' AND 
						tahunanggaran = '".$tahun."' AND
						kodejenis = '".$djenis['id_otsus']."'
					ORDER BY
					       tanggal
					";

			$rtahap = $this->db->query($sql);	
			$arrtahap = array();
			$tahap = '';
			while($dtahap = $this->db->fetchArray($rtahap)){
				array_push($arrtahap,$dtahap);
			}	


			for($x=0;$x<$maxtahap;$x++){

				if( $x < count($arrtahap)){
					// echo $x.' = '.(count($x)).'<br>';
					$tanggal = $arrtahap[$x]['tanggal'];
					$nosp2d = $arrtahap[$x]['nosp2d'];
					$nilai = number_format($arrtahap[$x]['jumlah'],2,',','.');
				}else{
					$tanggal = '<center>-</center>';
					$nosp2d = '<center>-</center>';
					$nilai = '<center>-</center>';
				}	

				$tahap .= "<td>".$tanggal."</td>";
				$tahap .= "<td>".$nosp2d."</td>";
				$tahap .= "<td  class='text-right'>$nilai</td>";

			}

			$prosenrealisasi = $djenis['total_realisasi']/$dkab['jumlah']*100;
			$detail .= "<tr>
							<td style='padding-left:20px'>".$djenis['id_otsus'].". ".$djenis['urai']."</td>
							".$tahap."
							<td class='text-right'>".number_format($djenis['total_realisasi'],2,',','.')."</td>
							<td class='text-right'>".number_format($prosenrealisasi,2,',','.')." </td>
				   		</tr>";	
		}
				   		   
		$detail .= "</tbody></table>";

		$define = array (
						 'DETAIL'	=> $detail,
						 'KABUPATEN' => $kab,
						 'TAHUN'	=> $tahun,
						 'ROOT_URL' => ROOT_URL,				 
                );
				

		$table = new TemplateClass();
		$table->init(THEME.'/tables/penerimaan-detail.html');
		$table->defineTag($define);
		$content = $table->parse();

		#Pie Graf
		$sql = "SELECT 
					ROUND((SUM(jumlah)/1000000000),2) AS otsus, jo.urai
				FROM 
					otsus_transfer ot  
				LEFT JOIN
					jenis_otsus jo ON (ot.kodejenis = jo.id_otsus)
				WHERE ot.tahunanggaran = '".$tahun."' AND ot.kodepemda = '".$kodepemda."'
				GROUP BY ot.kodepemda, ot.kodejenis";
				// die($sql);
		$res = $this->db->query($sql);
		$num = $this->db->numRows($res);
		$piegraf = "";
		if ($num > 0){
			while ($data = $this->db->fetchArray($res)) {
				$piegraf .= "['".$data['urai']."',".$data['otsus']."],";
			}
		} else {
			$piegraf = "['Data Transfer Dana Tidak Ditemukan', 1]";
		}
		
		#bar graf
		$sql = "SELECT tahun, ROUND(jumlah/1000000000,2) AS otsus 
				FROM otsus_kabupaten 
				WHERE kodepemda = '".$kodepemda."'";
		$res = $this->db->query($sql);
		$bardata = "";
		$baryear = "";
		while ($data = $this->db->fetchArray($res)) {
			$bardata .= $data['otsus'].",";
			$baryear .= "'".$data['tahun']."',";
		}
		$title = 'Rincian Penerimaan Otsus Kabupaten '.$kab.' Tahun '.$tahun;
		$script = "
			$(function () {
		    $('#otsus-trf').highcharts({
		        chart: {
		            type: 'pie',
		            options3d: {
		                enabled: true,
		                alpha: 45,
		                beta: 0
		            }
		        },
		        title: {
		            text: ''
		        },
		        tooltip: {
		            pointFormat: 'Persentase : <b>{point.percentage:.1f} %</b><br> Jumlah Dana : <b>{point.y} M</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                depth: 35,
		                dataLabels: {
		                    enabled: true,
		                    format: '{point.name} <b>{point.y} M</b>'
		                }
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: 'Persentase',
		            data: [".$piegraf."]
		        }]
		    });
		});
		$(function () {
		    $('#container').highcharts({
		        chart: {
		            type: 'column',
		            margin: 75,
		            options3d: {
		                enabled: true,
		                alpha: 10,
		                beta: 25,
		                depth: 70
		            }
		        },
		        title: {
		            text: ''
		        },
		        tooltip: {
		            pointFormat: '<br> Jumlah Dana : <b>{point.y} M</b>'
		        },
		        plotOptions: {
		            column: {
		                depth: 25,
		                dataLabels: {
		                    enabled: true,
		                    format: '{point.name} <b>{point.y} M</b>'
		                }
		            }
		        },
		        xAxis: {
		            categories: [".$baryear."]
		        },
		        yAxis: {
		            title: {
		                text: '<b>Jumlah Dana (M)</b>'
		            }
		        },
		        series: [{
		            name: 'Tahun',
		            data: [".$bardata."]
		        }]
		    });
		});
		";

		$this->pgTitle = $title;
		$this->pgContent = $content; 
		$this->pgScript = $script;
	}

	function SelectorBody() {
		
	}
	
	function SelectorScript() {
		
	}	

}

