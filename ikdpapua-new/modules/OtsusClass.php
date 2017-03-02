<?php
Class OtsusClass extends ModulClass{		

	function Insert(){
		# query insert
		$this->Update();
	}
	function Update(){
		# query update 
		if (!$this->auth->isGranted(array('ADMIN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$jumlah = str_replace(',','.',str_replace('.','', $_POST['edtJumlah']))*1;
			$jumlahI = str_replace(',','.',str_replace('.','', $_POST['edtJumlahI']))*1;
			$total = $jumlah + $jumlahI;
			
			$sql = "REPLACE INTO penerimaan_otsus SET
					tahun = '".$this->scr->filter($_POST['id'])."',
					dana_otsus = ".$jumlah.",
					dana_infrastruktur = ".$jumlahI.",
					total_otsus = ".$total."
					";
			$res = $this->db->query($sql) or die('ERROR');			
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}	
	}
	function Delete(){
		# query delete 
		if (!$this->auth->isGranted(array('ADMIN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$sql = "DELETE FROM penerimaan_otsus WHERE 
					tahun IN (".$this->scr->filter($_POST['id']).") 
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
		if ($cmd=='detail' && $id!='') {
			$sql = "SELECT * FROM penerimaan_otsus WHERE tahun=".$id;
			$res = $this->db->query($sql);	
			if ($tmpdata = $this->db->fetchArray($res)) {	
				$data['id'] = $tmpdata['tahun'];
				$data['tahun'] = $tmpdata['tahun'];
				$data['jumlah'] = $tmpdata['dana_otsus'];
				$data['jumlahi'] = $tmpdata['dana_infrastruktur'];
			
				echo json_encode($data);
			}
		} else if ($cmd=='list') {
			if (!$this->auth->isGranted(array('ADMIN', 'OPERATOR'))) die();
			$content = "<tr><td colspan=6 align='center'>Data Kosong</td></tr>";
			$sql = "SELECT * FROM penerimaan_otsus ORDER BY tahun ";
			$res = $this->db->query($sql);
			$i = 0;
			if ($this->db->numRows($res)>0) $content='';
			while($tmpdata = $this->db->fetchArray($res)){
				$data[$i] = $tmpdata;
				if($data[$i][0] <> ''){
					$content .= "<tr>
								<td ><input type='checkbox' name='lstOtsus[]' value='".$data[$i]['tahun']."'> ".$data[$i]['tahun']."</td>
								<td class='text-right'>".number_format($data[$i]['dana_otsus'],2,',','.')."</td>
								<td class='text-right'>".number_format($data[$i]['dana_infrastruktur'],2,',','.')."</td>
								<td class='text-right'>".number_format($data[$i]['total_otsus'],2,',','.')."</td>
								<td class='text-center'><a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return edit(".$data[$i]['tahun'].");' title='Edit'><i class='fa fa-pencil'></i> Edit</a>
								</td>					
								</tr>";
				}		
				$i++;			
			}
			
			echo $content;
		}
		
	}		
	
	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'OPERATOR')))  header('location: '.ROOT_URL);
		
		$content = '';
		$table = new TemplateClass();
		$table->init(THEME.'/tables/otsus.html');
		$content = $table->parse();
							
		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/otsus.html');
		$content .= $form->parse();
		
		$script = "
							function edit(id) {
								$.post('#',{'do':'svc','cmd':'detail','id':id}, function(data) {
									$('#title').text('Edit Dana Otonomi Khusus');
									$('.frmOtsus input[name=id]').val(data.id);
									$('.frmOtsus input[name=do]').val('edt');

									$('#edtTahun').val(data.tahun);
									$('#edtJumlah').autoNumeric('set',data.jumlah);
									$('#edtJumlahI').autoNumeric('set',data.jumlahi);									
									
									$('#edtTahun').spinner('option','disabled',true);
									
									$('#otsus').modal('show');
								},'json');
								return false;
								
							};
							function add() {
								$('#title').text('Tambah Dana Otonomi Khusus');
								$('.frmOtsus input[name=id]').val('');
								$('.frmOtsus input[name=do]').val('add');
								
								$('#edtTahun').val('".date('Y')."');
								$('#edtJumlah').autoNumeric('set',0);
								$('#edtJumlahI').autoNumeric('set',0);
								
								$('#edtTahun').spinner('option','disabled',false);
																
								$('#otsus').modal('show');
								return false;
							};				

							function del() {
								var cek = Array();
								i=0;
								$('#tblOtsus input:checkbox:checked').each(function(index,obj) {
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
								$('#loader').modal('show');
								$.post('#',{'do':'svc','cmd':'list'}, function(data) { 
									$('#loader').modal('hide'); 
									$('#tbodyData').html(data);	
								});
							};
							
							loadData();
							$('.spinner_default').spinner();
							$('.edtUang').autoNumeric('init',{
								aSep: '.',
								aDec: ',', 
								aSign: ''
							});
							
							$(document).on('submit','.frmOtsus',function(e){
								e.preventDefault();
								var sukses = true;
								$('.frmOtsus input[name=id]').val($('#edtTahun').val());
								
								if (sukses) {
									$.post('#',$('.frmOtsus').serialize(), function(data) { 
										if (data!='OK') bootbox.alert('Tidak berhasil!');
										else {
											bootbox.info('Berhasil menyimpan data!');
											$('#otsus').modal('hide');
											loadData(); 
										}
									});
								}
							});
							
		";
		
		$define = array (
						 'PAGETITLE'	=> 'Dana Otonomi Khusus Provinsi',
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
		$sql = "SELECT * FROM jenis_otsus ORDER BY id_otsus ";
		$res = $this->db->query($sql);
		$i = 0;
		$content = "<select class='form-control select'  data-live-search='true' name='cbJenisotsus' id='cbJenisotsus'>
				<option value=''>Pilih Jenis Penyaluran Dana Otsus</option>
				";
		while($tmpdata = $this->db->fetchArray($res)){
			$data[$i] = $tmpdata;
			
			if($data[$i][0] <> ''){
				$content .= "<option value='".$data[$i]['id_otsus']."'>".$data[$i]['urai']."</option>";
			}	
			$i++;			
		}	
		$content .= "</select>";
		return $content;
	}
	
	function SelectorScript() {
		return "";
	}		

}