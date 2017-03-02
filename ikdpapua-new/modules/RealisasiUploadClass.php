<?php
Class RealisasiUploadClass extends ModulClass{		

	function Insert(){
		# query insert
		$target_dir_upload = ROOT_PATH.'files/';
		if (!file_exists($target_dir_upload)) mkdir($target_dir_upload,'0777',true);
		
		if ($_FILES['berkas']['name']!='') {
			$path_parts = pathinfo(basename($_FILES['berkas']['name']));
			if (strtoupper($path_parts['extension'])=='XML' || strtoupper($path_parts['extension'])=='ZIP') {
				$sql = "INSERT INTO upload SET
					jenis = 'REALISASI',
					kodepemda = '".$this->scr->filter($_POST['cbKabupaten'])."',
					file = '".strtoupper($this->scr->filter($path_parts['basename']))."'
					";
				$res = $this->db->query($sql);
				$id = $this->db->insertId();
				$uploadfile = $target_dir_upload.md5($id).".".strtoupper($path_parts['extension']);
				move_uploaded_file($_FILES['berkas']['tmp_name'], $uploadfile);
				die(json_encode(Array('status'=>'OK','msg'=>'Berhasil Upload Data!')));
			} die(json_encode(Array('status'=>'ERROR','msg'=>'Gagal Upload Data! Hanya File XML dan ZIP yang diterima')));
		} die(json_encode(Array('status'=>'ERROR','msg'=>'Gagal Upload Data!')));
	}
	function Update(){
		# query update 
		
	}
	function Delete(){
		# query delete 
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
		if (isset($_POST)) {
			$sql = "DELETE FROM upload WHERE 
					idupload IN (".$this->scr->filter($_POST['id']).") 
					";
			$res = $this->db->query($sql) or die('ERROR');		
			if ($this->db->affectedRow()==0) die('ERROR');
			$file = explode(",",$this->scr->filter($_POST['id']));
			$target_dir_upload = ROOT_PATH.'files/';
			foreach($file as $val) {
				if (file_exists($target_dir_upload.md5($val).".ZIP")) unlink($target_dir_upload.md5($val).".ZIP");
				if (file_exists($target_dir_upload.md5($val).".XML")) unlink($target_dir_upload.md5($val).".XML");
			}
			
			die('OK');
		}
	}
	function Service(){
		# service handle
		$cmd = '';
		$id = '';
		if (isset($_POST['cmd'])) $cmd = $this->scr->filter($_POST['cmd']);
		if (isset($_POST['id'])) $id = $this->scr->filter($_POST['id']);
		if ($cmd=='proses' && $id!='') {
			$data['id'] = $id;
			echo json_encode($data);
		} else if ($cmd=='list') {
			if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
			$aaData = Array();
			$sLimit = "";
			$i=0;
			if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".intval( $_POST['iDisplayStart'] ).", ".intval( $_POST['iDisplayLength'] );
				$i = intval( $_POST['iDisplayStart'] ); 
			}			
			
			$wpemda = $this->auth->getKodePemda();
			if ($wpemda!='') $wpemda = " AND k.kodepemda='".$wpemda."' ";

			$sql = "SELECT t.*,k.kabupaten FROM upload t LEFT JOIN kabupaten k ON (k.kodepemda=t.kodepemda) WHERE t.jenis='REALISASI' ".$wpemda." ORDER BY tanggal DESC ";
			$all = $this->db->query($sql);
			$res = $this->db->query($sql.$sLimit);
			
			$i = 0;
			if ($this->db->numRows($res)>0) $content='';
			while($tmpdata = $this->db->fetchArray($res)){
				$data[$i] = $tmpdata;
				if($data[$i][0] <> ''){
					$tmpdata = Array();
					$tmpdata[]  = "<input type='checkbox' name='lstUpload[]' value='".$data[$i]['idupload']."'> ".$data[$i]['tanggal'];
					$tmpdata[]  = $data[$i]['kabupaten'];
					$tmpdata[]  = $data[$i]['file'];
					$path_parts = pathinfo($data[$i]['file']);
					$tmpdata[]  = number_format(filesize(ROOT_PATH.'files/'.md5($data[$i]['idupload']).".".$path_parts['extension'])/1024,0,',','.')."KB";
					$tmpdata[]  = "<a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return proses(".$data[$i]['idupload'].");' title='Proses'><i class='fa fa-cogs'></i> Proses</a>";
 					
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
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		
		$content = '';
		$table = new TemplateClass();
		$table->init(THEME.'/tables/upload.html');
		$table->defineTag('JENIS','Realisasi');
		$content = $table->parse();
							
		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/upload.html');
		$form->defineTag('TAHUN',date('Y'));
		$form->defineTag('SELECT_KABUPATEN',$this->owner->kabupaten->SelectorBody());
		$form->defineTag('MAX',ini_get('post_max_size'));
		$content .= $form->parse();
		
		$script = "
							function proses(id) {
								$.post('#',{'do':'svc','cmd':'proses','id':id}, function(data) {
									bootbox.info('Proses id = '+data.id);
								},'json');
								return false;
							};
							function add() {
								$('#title').text('Tambah Data Upload');
								$('.frmUpload input[name=id]').val('');
								$('.frmUpload input[name=do]').val('add');
								$('#cbKabupaten').selectpicker('val','');
								var berkas = $('#berkas');
								berkas.replaceWith(berkas = berkas.clone(true));
								$('.file-input-name').text('');
								
								$('#upload').modal('show');
								return false;
							};				

							function del() {
								var cek = Array();
								i=0;
								$('#tblUpload input:checkbox:checked').each(function(index,obj) {
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
								$('#tblUpload').dataTable({
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
							$('#iUpload').load(function() {
								var res = $.parseJSON($(this).contents().text());
								if (res.status=='OK') {
									$('#upload').modal('hide');
									bootbox.info(res.msg);
									loadData();	
								}
								else bootbox.alert(res.msg);
							});
							
							$(document).on('submit','.frmLaporan',function(e){
								e.preventDefault();
								var sukses = true;
																							
								if ($('#cbKabupaten').selectpicker('val')=='') {
									bootbox.alert('Kabupaten/Kota belum dipilih!');
									sukses = false;
								}
								if (sukses) {
									$.post('#',$('.frmLaporan').serialize(), function(data) { 
										if (data!='OK') bootbox.alert('Tidak berhasil!');
										else {
											bootbox.info('Berhasil menyimpan data!');
											$('#laporan').modal('hide');
											loadData(); 
										}
									});
								}
							});
							
		";
		
		$define = array (
						 'PAGETITLE'	=> 'Manage Upload Data Realisasi',
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