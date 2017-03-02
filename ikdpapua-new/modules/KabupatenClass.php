<?php
Class KabupatenClass extends ModulClass{		

	function Insert(){
		# query insert
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$kodepemda = $this->scr->filter($_POST['cbStatus']).$this->scr->filter($_POST['edtKodeKab']);
			
			$sql = "INSERT INTO kabupaten SET
					tahun = '',
					kabupaten = '".$this->scr->filter($_POST['edtKabupaten'])."',
					kodepemda = '".$kodepemda."',
					kodesatker = '".$this->scr->filter($_POST['edtKodeDJPK'])."'
					";
			$res = $this->db->query($sql) or die('ERROR');			
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}
	}
	function Update(){
		# query update 
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$sql = "UPDATE kabupaten SET
					kabupaten = '".$this->scr->filter($_POST['edtKabupaten'])."',
					kodesatker = '".$this->scr->filter($_POST['edtKodeDJPK'])."'
					WHERE
					kodepemda = '".$this->scr->filter($_POST['id'])."'
					";
			$res = $this->db->query($sql)or die('ERROR');
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}		
	}
	function Delete(){
		# query delete 
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$sql = "DELETE FROM kabupaten WHERE 
					kodepemda IN (".$this->scr->filter($_POST['id']).") 
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
			$sql = "SELECT * FROM kabupaten WHERE kodepemda=".$id;
			$res = $this->db->query($sql);	
			if ($tmpdata = $this->db->fetchArray($res)) {	
				$data['id'] = $tmpdata['kodepemda'];
				$data['kabupaten'] = $tmpdata['kabupaten'];
				$data['status'] = substr($tmpdata['kodepemda'],0,2);
				$data['kodekab'] = substr($tmpdata['kodepemda'],2,2);
				$data['kodedjpk'] = $tmpdata['kodesatker'];
				
				echo json_encode($data);
			}
		} else if ($cmd=='list') {
			if (!$this->auth->isGranted('ADMIN')) die();
			$content = "<tr><td colspan=6 align='center'>Data Kosong</td></tr>";
			$sql = "SELECT * FROM kabupaten ORDER BY kodepemda ";
			$res = $this->db->query($sql);
			$i = 0;
			if ($this->db->numRows($res)>0) $content='';
			while($tmpdata = $this->db->fetchArray($res)){
				$data[$i] = $tmpdata;
				if($data[$i][0] <> ''){
					$content .= "<tr>
								<td ><input type='checkbox' name='lstKabupaten[]' value='".$data[$i]['kodepemda']."'> ".$data[$i]['kodepemda']."</td>
								<td >".$data[$i]['kodesatker']."</td>
								<td >".$data[$i]['kabupaten']."</td>
								<td style='text-align: center;'><a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return edit(".$data[$i]['kodepemda'].");' title='Edit'><i class='fa fa-pencil'></i> Edit</a>
								</td>					
								</tr>";
				}		
				$i++;			
			}
			
			echo $content;
		}
		
	}		
	
	function Manage(){
		if (!$this->auth->isGranted('ADMIN'))  header('location: '.ROOT_URL);
		
		$content = '';
		$table = new TemplateClass();
		$table->init(THEME.'/tables/kabupaten.html');
		$content = $table->parse();
							
		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/kabupaten.html');
		$content .= $form->parse();
		
		$script = "
							function edit(id) {
								$.post('#',{'do':'svc','cmd':'detail','id':id}, function(data) {
									$('#title').text('Edit Kabupaten');
									$('.frmKab input[name=id]').val(data.id);
									$('.frmKab input[name=do]').val('edt');
									$('#edtKabupaten').val(data.kabupaten);
									$('#cbStatus').selectpicker('val',data.status);
									$('#edtKodeKab').val(data.kodekab);
									$('#edtKodeDJPK').val(data.kodedjpk);
									
									$('#cbStatus').prop('disabled',true);
									$('#cbStatus').selectpicker('refresh');
									$('#edtKodeKab').prop('disabled',true);
									
									$('#edtKabupaten').focus();
									$('#kabupaten').modal('show');
								},'json');
								return false;
								
							};
							function add() {
								$('#title').text('Tambah Kabupaten');
								$('.frmKab input[name=id]').val('');
								$('.frmKab input[name=do]').val('add');
								$('#edtKabupaten').val('');
								$('#cbStatus').selectpicker('val','');
								$('#edtKabupaten').val('');
								$('#edtKodeKab').val('');
								$('#edtKodeDJPK').val('');
								
								$('#cbStatus').prop('disabled',false);
								$('#cbStatus').selectpicker('refresh');

								$('#edtKodeKab').prop('disabled',false);
								
								$('#edtKabupaten').focus();
								$('#kabupaten').modal('show');
								return false;
							};				

							function del() {
								var cek = Array();
								i=0;
								$('#tblKabupaten input:checkbox:checked').each(function(index,obj) {
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
							
							$(document).on('submit','.frmKab',function(e){
								e.preventDefault();
								var sukses = true;
								if ($('#cbStatus').selectpicker('val')=='') {
									bootbox.alert('Provinsi belum dipilih!');
									sukses = false;
								}
								if (sukses) {
									$.post('#',$('.frmKab').serialize(), function(data) { 
										if (data!='OK') bootbox.alert('Tidak berhasil!');
										else {
											bootbox.info('Berhasil menyimpan data!');
											$('#kabupaten').modal('hide');
											loadData(); 
										}
									});
								}
							});
							
		";
		
		$define = array (
						 'PAGETITLE'	=> 'Manage Data Kabupaten',
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
		
		$wpemda = $this->auth->getKodePemda();
		if ($wpemda!='') $wpemda = " WHERE kodepemda='".$wpemda."' ";
		
		$sql = "SELECT * FROM kabupaten ".$wpemda." ORDER BY kabupaten ";
		$res = $this->db->query($sql);
		$i = 0;
		$content = "<select class='form-control select'  data-live-search='true' name='cbKabupaten' id='cbKabupaten'>
				<option value=''>Pilih Kabupaten/Kota</option>
				";
		while($tmpdata = $this->db->fetchArray($res)){
			$data[$i] = $tmpdata;
			
			if($data[$i][0] <> ''){
				$content .= "<option value='".$data[$i]['kodepemda']."'>".$data[$i]['kabupaten']."</option>";
			}	
			$i++;			
		}	
		$content .= "</select>";
		return $content;
	
	}
	
	function SelectorScript() {
		$script = "";
		return $script;
	}	

}
