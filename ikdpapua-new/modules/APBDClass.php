<?php
Class APBDClass extends ModulClass{		

	function Insert(){
		# query insert
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
	}
	function Update(){
		# query update 
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$rowdata_M = $_POST['rekening_M'];
			$rowdata_P = $_POST['rekening_P'];
			$akun = $_POST['akun'];
			foreach($rowdata_M as $key => $val) {
				$jumlah = str_replace(',','.',str_replace('.','', $val));
				$jumlah_p = str_replace(',','.',str_replace('.','', $rowdata_P[$key]));
				$rek = explode(".",str_replace('"','', $key));
				$sql = "REPLACE INTO ringkasan_apbd SET
						namaakun = '".$this->scr->filter($akun[$key])."',
						nilaianggaran = ".$jumlah.",
						nilaianggaran_p = ".$jumlah_p.",
						tahunanggaran = '".$this->scr->filter($_POST['tahun'])."',
						kodepemda = '".$this->scr->filter($_POST['kodepemda'])."',
						kodeakunutama = '".$rek[0]."', 
						kodeakunkelompok = '".$rek[1]."',
						kodeakunjenis = '".$rek[2]."',
						kodeakunobjek = '0',
						kodeakunrincian = '0',
						kodeakunsub = '0'			
						";
				$res = $this->db->query($sql)or die('ERROR');
			}
			die('OK');
		}		
	}
	function Delete(){
		# query delete 
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$sql = "DELETE FROM ringkasan_apbd WHERE
					tahunanggaran = '".$this->scr->filter($_POST['tahun'])."' AND
					kodepemda = '".$this->scr->filter($_POST['kodepemda'])."'
					";
			$res = $this->db->query($sql) or die('ERROR');		
			if ($this->db->affectedRow()==0) die('ERROR');
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
			$sql = "SELECT DISTINCT(tahunanggaran) FROM ringkasan_apbd ORDER by tahunanggaran DESC";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				 $listtahun[] = $data['tahunanggaran'];
			}

			$wpemda = $this->auth->getKodePemda();
			if ($wpemda!='') $wpemda = " AND kodepemda='".$wpemda."' ";

			$sql = "SELECT * FROM kabupaten WHERE kodepemda like '94%' ".$wpemda." ORDER by kodepemda";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				$content .= "<tr>
							<td>".$data['kodepemda']."</td>
							<td>".$data['kabupaten']."</td>
				";
				
				foreach($listtahun as $tahun) {
				
					$sqldata = "SELECT SUM(nilaianggaran),SUM(nilaianggaran_p) FROM ringkasan_apbd WHERE tahunanggaran='".$tahun."' AND kodepemda='".$data['kodepemda']."'";	
					// die($sqldata);
					$resdata =	$this->db->query($sqldata);				
					if ($apbd = $this->db->fetchArray($resdata)) {
						if ($apbd[0]>0) {
							$content .= "<td class='text-center success'>
										<a class='btn btn-success btn-xs btn-condensed' href='".ROOT_URL."detail/apbd/".$tahun."-".$data['kodepemda']."/rincian.htm' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Detail'><span class='fa fa-file-text'></span></a>
										</td>";
						} else {
							$content .= "<td class='text-center warning' style='padding: 5px;'>
								<a class='' href='#' onClick='return add(\"".$tahun."\",\"".$data['kodepemda']."\",\"M\");' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Input APBD'><span class='fa fa-plus'></span></a>
							</td>";
						}
						if ($apbd[1]>0) {
							$content .= "<td class='text-center success'>
										<a class='btn btn-success btn-xs btn-condensed' href='".ROOT_URL."detail/apbd/".$tahun."-".$data['kodepemda']."/rincian.htm' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Detail'><span class='fa fa-file-text'></span></a>
										</td>";
						} else {
							$content .= "<td class='text-center warning' style='padding: 5px;'>
								<a class='' href='#' onClick='return add(\"".$tahun."\",\"".$data['kodepemda']."\",\"P\");' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Input APBD'><span class='fa fa-plus'></span></a>
							</td>";
						}
						
					} else  $content .= "<td></td><td></td>";
				}
				
				$content .= "</tr>";
			}
			
            echo $content;
        }
        
    }       
	
	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		$content ='';
		$script = '';

		$listtahun = "";
		$listtahunanggaran = "";
		$sql = "SELECT DISTINCT(tahunanggaran) FROM ringkasan_apbd ORDER by tahunanggaran DESC";	
		$res =	$this->db->query($sql);
		while ($data =$this->db->fetchArray($res)) {
			 $listtahun .= "<th colspan='2' class='text-center'>".$data['tahunanggaran']."</th>";
			 $listtahunanggaran .= "<th class='text-center'>APBD</th><th class='text-center'>APBD P</th>"; 
		}
  
  
		$table = new TemplateClass();
		$table->init(THEME.'/tables/apbd.html');
		$define = array (
						'LIST_TAHUN'			=> $listtahun,	
						'LIST_TAHUN_ANGGARAN'	=> $listtahunanggaran,	
                );
		$table->defineTag($define);
		$content = $table->parse();
				
		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/apbd.html');
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
			
			function add(t,p,apbd) {
				$('#title').text('Tambah APBD');
				$('.frmAPBD input[name=do]').val('add');
				$('.frmAPBD input[name=apbd]').val(apbd);
				$('#cbKabupaten').selectpicker('val',p);	
				if (t=='') t='".date('Y')."';
				$('#edtTahun').val(t);
				
				$('#apbd').modal('show');
				return false;
			};
																	
			loadData();
			$('.spinner_default').spinner();
			
			$(document).on('submit','.frmAPBD',function(e){
				
				var sukses = true;
								
				if ($('#cbKabupaten').selectpicker('val')=='') {
					bootbox.alert('Kabupaten/Kota belum dipilih!');
					sukses = false;
				}
				
				if (sukses) {
					$('.frmAPBD').attr('action','".ROOT_URL."detail/apbd/'+$('#edtTahun').val()+'-'+$('#cbKabupaten').selectpicker('val')+'/rincian.htm');
				} else e.preventDefault();
			});			
		";
		
		$define = array (
						 'PAGETITLE'	=> 'Ringkasan APBD Kabupaten/Kota',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
				
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl(); 		
	
	}
	
	function GetDetail($id){
		$apbd = 'M';
		$do = '';
		if (isset($_POST['apbd'])) $apbd = $_POST['apbd']; 
		if (isset($_POST['do'])) $do = $_POST['do'];
		
		list($tahun,$kodepemda) = explode('-',$this->scr->filter($id));
		$kabupaten = '';
		$sql = "SELECT * FROM kabupaten WHERE kodepemda='".$kodepemda."'";	
		$res =	$this->db->query($sql);
		if ($data = $this->db->fetchArray($res)) {
			$kabupaten = $data['kabupaten'];
		}
		
		$title = 'Rincian APBD '.$kabupaten.' Tahun '.$tahun;
		$content = '';
		$script = '';
		
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
                    AND ra.tahunanggaran = '".$tahun."'
                )
                WHERE mr.kodeakunutama IN (4,5,6) AND mr.kodeakunobjek = 0
                GROUP BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis
                ORDER BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis";
        // die("<pre>".$sql);
		
		$abpddata = array();
        $data = $this->db->query($sql);		
		$rowdata = "";
		$apbdp = 0;
		while ($res = $this->db->fetchArray($data)) {		
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
		
		$table = new TemplateClass();
		$table->init(THEME.'/forms/apbd-detail.html');
		$define = array (
					'ROOT_URL' => ROOT_URL,
					'KABUPATEN' => $kabupaten,
					'TAHUN' => $tahun,
					'KODEPEMDA' => $kodepemda,
					'ROWDATA' => $rowdata,
					'DO' => 'edt',
                );
		$table->defineTag($define);
		$content = $table->parse();

		$script = "
	
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
			
			$('.btnEdit').on('click',function(e){
				$('.caninput').each(function(i,e){
					var val = $(e).attr('data-val');
					var k = $(e).attr('data-koderek');
					var apbd = 'M';
					if ($(e).hasClass('perubahan')) apbd = 'P';
					$(e).html('<input type=\'text\' name=\'rekening_'+apbd+'[\"'+k+'\"]\' class=\'text-right form-control edtUang\' value=\''+val+'\'>');	
				});		
				
				$('.edtUang').autoNumeric('init',{
					aSep: '.',
					aDec: ',', 
					aSign: ''
				});

				$('.edtUang').on('keyup',function() {
					$(this).parent().attr('data-val',$(this).autoNumeric('get'));
					updateJumlah(true);
					return true;
				});						
				$('.btnSimpan').show();
				$('.btnBatal').show();
				$('.btnEdit').hide();
						
			});
			
			$('.btnPerubahan').on('click',function(e){
				$('.perubahan').toggle();
			});
			
			$('.btnSimpan').on('click',function(e){
				$.post('".ROOT_URL."apbd.htm',$('.frmAPBD').serialize(), function(data) { 
						if (data!='OK') bootbox.alert('Tidak berhasil menyimpan data!');
						else { 
							bootbox.info('Berhasil menyimpan data!');
							$('.btnSimpan').hide();
							$('.btnBatal').hide();
							$('.btnEdit').show();							
							updateJumlah(false); 
						}
				});
			});
			
			$('.btnBatal').on('click',function(e){
				$('.btnSimpan').hide();
				$('.btnBatal').hide();
				$('.btnEdit').show();
				updateJumlah(false);
			});
			
			$('.btnHapus').on('click',function(e){
				bootbox.confirm('Yakin akan menghapus data?',function(result) {
					if (result) {
						$.post('".ROOT_URL."apbd.htm',{'do':'del','tahun':'".$tahun."','kodepemda':'".$kodepemda."'}, function(data) { 
								if (data!='OK') bootbox.alert('Tidak berhasil menghapus data!');
								else { 
									bootbox.info('Berhasil menghapus data!');
									window.location = '".ROOT_URL."apbd.htm';
								}
						});
					}
				});
			});
			
			
			$('.frmAPBD').on('submit',function(e){ e.preventDefault; return false; });
			
			updateJumlah(false);
			".((($apbdp>0) || ($apbd=='P'))?"":"$('.perubahan').toggle();")."
			".(($do=='add')?"$('.btnEdit').click();":"")."
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

