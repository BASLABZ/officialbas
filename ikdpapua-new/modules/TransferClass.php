<?php
Class TransferClass extends ModulClass{		

	function Insert(){
		# query insert
		if (!$this->auth->isGranted(array('ADMIN','KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {		
			$jumlah = str_replace(',','.',str_replace('.','', $_POST['edtJumlah']));
			$sql = "INSERT INTO otsus_transfer SET
					tahunanggaran = '".$this->scr->filter($_POST['edtTahun'])."',
					nosp2d = '".$this->scr->filter($_POST['edtSp2d'])."',
					kodejenis = '".$this->scr->filter($_POST['cbJenisotsus'])."',
					kodepemda = '".$this->scr->filter($_POST['cbKabupaten'])."',
					tanggal = '".$this->scr->filter($_POST['edtTanggal'])."',
					jumlah = ".$jumlah."
					";
			$res = $this->db->query($sql) or die('ERROR');			
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}
	}
	function Update(){
		# query update 
		if (!$this->auth->isGranted(array('ADMIN','KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$jumlah = str_replace(',','.',str_replace('.','', $_POST['edtJumlah']));
			$sql = "UPDATE otsus_transfer SET
					tahunanggaran = '".$this->scr->filter($_POST['edtTahun'])."',
					nosp2d = '".$this->scr->filter($_POST['edtSp2d'])."',
					kodejenis = '".$this->scr->filter($_POST['cbJenisotsus'])."',
					kodepemda = '".$this->scr->filter($_POST['cbKabupaten'])."',
					tanggal = '".$this->scr->filter($_POST['edtTanggal'])."',
					jumlah = ".$jumlah."
					WHERE
					idtransfer = '".$this->scr->filter($_POST['id'])."'
					";
			$res = $this->db->query($sql)or die('ERROR');
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}		
	}
	function Delete(){
		# query delete 
		if (!$this->auth->isGranted(array('ADMIN','KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$sql = "DELETE FROM otsus_transfer WHERE 
					idtransfer IN (".$this->scr->filter($_POST['id']).") 
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
		if ($cmd=='detail' && $id!='') {
			$sql = "SELECT * FROM otsus_transfer WHERE idtransfer=".$id;
			$res = $this->db->query($sql);	
			if ($tmpdata = $this->db->fetchArray($res)) {	
				$data['id'] = $tmpdata['idtransfer'];
				$data['kodepemda'] = $tmpdata['kodepemda'];
				$data['nosp2d'] = $tmpdata['nosp2d'];
				$data['kodejenis'] = $tmpdata['kodejenis'];
				$data['tanggal'] = $tmpdata['tanggal'];
				$data['tahun'] = $tmpdata['tahunanggaran'];
				$data['jumlah'] = $tmpdata['jumlah'];
				
				echo json_encode($data);
			}
		} else if ($cmd=='list') {
			if (!$this->auth->isGranted(array('ADMIN','KABUPATEN', 'OPERATOR'))) die();
			$aaData = Array();
			$sLimit = "";
			$i=0;
			if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".intval( $_POST['iDisplayStart'] ).", ".intval( $_POST['iDisplayLength'] );
				$i = intval( $_POST['iDisplayStart'] ); 
			}			
			$wpemda = $this->auth->getKodePemda();
			if ($wpemda!='') $wpemda = " WHERE t.kodepemda='".$wpemda."' ";
			$sql = "SELECT t.*,k.kabupaten, o.urai
					FROM 
						otsus_transfer t 
					LEFT JOIN 
						kabupaten k ON (k.kodepemda=t.kodepemda) 
					LEFT JOIN jenis_otsus o ON (o.id_otsus = t.kodejenis) 
					".$wpemda."  
					ORDER BY tanggal, k.kodepemda DESC ";
			$all = $this->db->query($sql);
			$res = $this->db->query($sql.$sLimit);
			
			$i = 0;
			if ($this->db->numRows($res)>0) $content='';
			while($tmpdata = $this->db->fetchArray($res)){
				$data[$i] = $tmpdata;
				if($data[$i][0] <> ''){
					$tmpdata = Array();
					$tmpdata[]  = "<input type='checkbox' name='lstTransfer[]' value='".$data[$i]['idtransfer']."'> ".$data[$i]['tahunanggaran'];
					$tmpdata[]  = $data[$i]['tanggal'];
					$tmpdata[] 	= $data[$i]['nosp2d'];
					$tmpdata[]	= $data[$i]['urai'];
					$tmpdata[]  = $data[$i]['kabupaten'];
					$tmpdata[]  = number_format($data[$i]['jumlah'],2,',','.');
					$tmpdata[]  = "<a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return edit(".$data[$i]['idtransfer'].");' title='Edit'><i class='fa fa-pencil'></i> Edit</a>";
 					
					$aaData[] = $tmpdata;
				}				
				$i++;			
			}
			
			$echo = 0;
			if (isset($_POST['sEcho'])) $echo = intval($_POST['sEcho']);
			
			$output = Array(
				"sEcho" => $echo,
				"iTotalRecords" => $this->db->numRows($res),
				"iTotalDisplayRecords" => $this->db->numRows($all),
				"aaData" => $aaData
			);
			echo json_encode($output);			

		}
		
	}		
	
	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN','KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		
		$content = '';
		$table = new TemplateClass();
		$table->init(THEME.'/tables/transfer.html');
		$content = $table->parse();
							
		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/transfer.html');
		$form->defineTag('TAHUN',date('Y'));
		$form->defineTag('SELECT_KABUPATEN',$this->owner->kabupaten->SelectorBody());
		$form->defineTag('SELECT_OTSUS',$this->owner->otsus->SelectorBody());
		$content .= $form->parse();
		
		$script = "
							function edit(id) {
								$.post('#',{'do':'svc','cmd':'detail','id':id}, function(data) {
									$('#title').text('Edit Data Transfer');
									$('.frmTransfer input[name=id]').val(data.id);
									$('.frmTransfer input[name=do]').val('edt');
									$('#cbKabupaten').selectpicker('val',data.kodepemda);
									$('#cbJenisotsus').selectpicker('val',data.kodejenis);
									$('#edtTahun').val(data.tahun);
									$('#edtTanggal').val(data.tanggal);
									$('#edtSp2d').val(data.nosp2d);
									$('#edtJumlah').autoNumeric('set',data.jumlah);
									
									$('#edtTahun').focus();
									$('#transfer').modal('show');
								},'json');
								return false;
								
							};
							function add() {
								$('#title').text('Tambah Data Transfer');
								$('.frmTransfer input[name=id]').val('');
								$('.frmTransfer input[name=do]').val('add');
								$('#cbKabupaten').selectpicker('val','');
								$('#cbJenisotsus').selectpicker('val','');
								$('#edtTahun').val('".date('Y')."');
								$('#edtTanggal').val('".date('Y-m-d')."');
								$('#edtSp2d').val('');
								$('#edtJumlah').autoNumeric('set',0);
								
								$('#edtTahun').focus();
								$('#transfer').modal('show');
								return false;
							};				

							function del() {
								var cek = Array();
								i=0;
								$('#tblTransfer input:checkbox:checked').each(function(index,obj) {
									cek[i++] = obj.value;
								});
								if (!cek.length>0) bootbox.alert('Belum ada data yang dipilih!'); 
								else {
									bootbox.confirm('Yakin akan menghapus data?',function(result) {
										if (result) {
											$.post('#',{'do':'del','id':cek.join(',')}, function(data) { 
												if (data!='OK') bootbox.alert('Tidak berhasil menghapus! Ada data lain yang membutuhkan data ini');
												else loadData(); 
											});
										}
									}); 
								}
								return false;
							};	
							
							function loadData() {
								$('#tblTransfer').dataTable({
									bDestroy: true,
									sAjaxSource: '#',
									fnServerData: function( sUrl, aoData, fnCallback, oSettings ) {
												aoData.push({name:'do',value:'svc'});
												aoData.push({name:'cmd',value:'list'});
												oSettings.jqXHR = $.post(sUrl,aoData,function (data) { $('#loader').modal('hide'); fnCallback(data);},'json');
									}											
								});
								

							};
							
							loadData();
							$('.spinner_default').spinner();
							$('.edtUang').autoNumeric('init',{
								aSep: '.',
								aDec: ',', 
								aSign: ''
							});
							
							$(document).on('submit','.frmTransfer',function(e){
								e.preventDefault();
								var sukses = true;
								
								if ($('#cbJenisotsus').selectpicker('val')=='') {
									bootbox.alert('Jenis Penyaluran Dana Belum Dipilih!');
									sukses = false;
								}														
								if ($('#cbKabupaten').selectpicker('val')=='') {
									bootbox.alert('Kabupaten/Kota belum dipilih!');
									sukses = false;
								}
								if (sukses) {
									$.post('#',$('.frmTransfer').serialize(), function(data) { 
										if (data!='OK') bootbox.alert('Tidak berhasil!');
										else {
											bootbox.info('Berhasil menyimpan data!');
											$('#transfer').modal('hide');
											loadData(); 
										}
									});
								}
							});
							
		";
		
		$define = array (
						 'PAGETITLE'	=> 'Transfer Otsus Kabupaten/Kota',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
				
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl(); 		
	
	}
	
	function GetDetail($id){
		# detail artikel
		header('location: '.ROOT_URL);
	}

	function SelectorBody() {
		return "";
	}
	
	function SelectorScript() {
		return "";
	}		

}
