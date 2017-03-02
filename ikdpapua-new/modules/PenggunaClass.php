<?php
Class PenggunaClass extends ModulClass{		

	function Insert(){
		# query insert 
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$sql = "INSERT INTO users SET
					username = '".$this->scr->filter($_POST['edtUsername'])."',
					pass = md5(concat('".$this->scr->filter($_POST['edtUsername'])."','".$this->scr->filter($_POST['edtPwd1'])."')),
					hak = md5(concat('".$this->scr->filter($_POST['edtUsername'])."','".$this->scr->filter($_POST['cbHakAkses'])."'))
					";
			$res = $this->db->query($sql) or die('ERROR');		
			if ($this->db->affectedRow()==0) die('ERROR');	
			$id = $this->db->insertId();
			if ($this->auth->hak[$_POST['cbHakAkses']]=='KABUPATEN') {
				$sql = "INSERT INTO users_kab SET
						tahun = '".$this->db->tahun."',
						iduser = '".$this->scr->filter($id)."', 
						kodepemda = '".$this->scr->filter($_POST['cbKabupaten'])."'
						";
				$res = $this->db->query($sql)or die('ERROR');	
			} else if ($this->auth->hak[$_POST['cbHakAkses']]=='OPERATOR') {
				$sql = "INSERT INTO users_operator SET
						tahun = '".$this->db->tahun."',
						iduser = '".$this->scr->filter($id)."', 
						id_operator = '".$this->scr->filter($_POST['id_operator'])."'
						";
				$res = $this->db->query($sql)or die('ERROR');	
			}			
			die('OK');
		}
	}
	function Update(){
		# query update 
		if (isset($_POST['cbHakAkses'])) {
			if (!$this->auth->isGranted('ADMIN')) die();
			$sql = "UPDATE users SET
					hak = md5(concat(username,'".$this->scr->filter($_POST['cbHakAkses'])."')) 
					WHERE iduser = '".$this->scr->filter($_POST['id'])."' 
					";
			$res = $this->db->query($sql)or die('ERROR');	
			$sql = "DELETE FROM users_kab WHERE tahun='".$this->db->tahun."' AND iduser = '".$this->scr->filter($_POST['id'])."' ";
			$res = $this->db->query($sql)or die('ERROR');
			$sql = "DELETE FROM users_operator WHERE tahun='".$this->db->tahun."' AND iduser = '".$this->scr->filter($_POST['id'])."' ";
			$res = $this->db->query($sql)or die('ERROR');
			if ($this->auth->hak[$_POST['cbHakAkses']]=='KABUPATEN') {
				$sql = "INSERT INTO users_kab SET
						tahun = '".$this->db->tahun."',
						iduser = '".$this->scr->filter($_POST['id'])."', 
						kodepemda = '".$this->scr->filter($_POST['cbKabupaten'])."'
						";
				$res = $this->db->query($sql)or die('ERROR');	
			} else if ($this->auth->hak[$_POST['cbHakAkses']]=='OPERATOR') {
				$sql = "INSERT INTO users_operator SET
						tahun = '".$this->db->tahun."',
						iduser = '".$this->scr->filter($_POST['id'])."', 
						id_operator = '".$this->scr->filter($_POST['id_operator'])."'
						";
				$res = $this->db->query($sql)or die('ERROR');	
			}
			
			die('OK');
		} else if (isset($_POST['edtNewPwd1'])) {
			if (!$this->auth->isGranted('ADMIN') && ($_POST['id']!=$this->auth->getUserIDVar())) die();
			$sql = "UPDATE users SET
					pass = md5(concat(username,'".$this->scr->filter($_POST['edtNewPwd1'])."')) 
					WHERE iduser = '".$this->scr->filter($_POST['id'])."'
					";
			$res = $this->db->query($sql)or die('ERROR');	
			if ($this->db->affectedRow()==0) die('ERROR');
			$this->auth->validLogin(md5($this->auth->getUserVar()),$this->scr->filter($_POST['edtNewPwd1']));
			die('OK');
		}
	}
	function Delete(){
		# query delete 
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$sql = "DELETE FROM users WHERE 
					iduser IN (".$this->scr->filter($_POST['id']).") 
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
			if (!$this->auth->isGranted('ADMIN') && ($id!=$this->auth->getUserIDVar())) die();
			
			$data = Array();
			$sql = "SELECT * FROM users WHERE iduser=".$id;
			$res = $this->db->query($sql);	
			if ($tmpdata = $this->db->fetchArray($res)) {	
				$data['id'] = $tmpdata['iduser'];
				$data['username'] = $tmpdata['username'];
				$data['hak'] = $this->auth->getMD5Hak($tmpdata['username'],$tmpdata['hak']);
				$data['shak'] =  $this->auth->getSHak($tmpdata['username'],$tmpdata['hak']);
				$sql = "SELECT * FROM users_log WHERE username='".$tmpdata['username']."' ORDER BY waktu DESC";
				$res = $this->db->query($sql);
				if ($tmpdata = $this->db->fetchArray($res)) {
					$data['lastlogin'] = $this->date->IndonesianDatetime($tmpdata['waktu'])." dari ".$tmpdata['ip'];
				}
			}
			
			$sql = "
				SELECT p.kodepemda,p.kabupaten FROM users_kab uk
				JOIN kabupaten p ON (p.tahun=uk.tahun AND p.kodepemda=uk.kodepemda)
				WHERE uk.tahun = '".$this->db->tahun."' AND uk.iduser=".$id;
			$res = $this->db->query($sql);	
			if ($tmpdata = $this->db->fetchArray($res)) {	
				$data['kodepemda'] = $tmpdata['kodepemda'];
				$data['nmkab'] = $tmpdata['kabupaten'];
			}
		
			echo json_encode($data);
			
		} if ($cmd=='pwd' && $id!='') {
			if (!$this->auth->isGranted('ADMIN') && ($id!=$this->auth->getUserIDVar())) die();
			
			$sql = "SELECT * FROM users WHERE iduser=".$id." and pass=md5(concat(username,'".$this->scr->filter($_POST['pwd'])."'))";
			$res = $this->db->query($sql);	
			if ($this->db->numRows($res)>0) die("OK");
			else die("ERROR");

		} else if ($cmd=='list') {
			if (!$this->auth->isGranted('ADMIN')) die();
			
			$content = "<tr><td colspan=6 align='center'>Data Kosong</td></tr>";
			$sql = "SELECT s.*,A.kabupaten
					FROM users s LEFT JOIN (SELECT up.iduser,p.kabupaten FROM users_kab up
					JOIN kabupaten p ON (p.tahun=up.tahun AND p.kodepemda=up.kodepemda AND up.tahun = '2015' )
					) A
					ON (A.iduser=s.iduser)
					ORDER BY s.username ";
			$res = $this->db->query($sql);
			$i = 0;
			if ($this->db->numRows($res)>0) $content='';
			while($tmpdata = $this->db->fetchArray($res)){
				$data[$i] = $tmpdata;
				
				if($data[$i][0] <> ''){
					if ($data[$i]['username']!=$this->auth->getUserVar()) $cek = "<input type='checkbox' name='lstPengguna[]' value='".$data[$i]['iduser']."' > ";
					else $cek = '';
					$content .= "<tr>
								<td >".$cek.($i+1)."</td>
								<td >".$data[$i]['username']."</td>
								<td >".$this->auth->getHak($data[$i]['username'],$data[$i]['hak'])."</td>
								<td >".$data[$i]['kabupaten']."</td>
								<td align='center'>
									<a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return edit(".$data[$i]['iduser'].");' title='Edit'><i class='fa fa-pencil'></i> Edit</a>
									<a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return pass(".$data[$i]['iduser'].");' title='Ubah Password'><i class='fa fa-key'></i> Ganti Password</a>
								</td>					
								</tr>";
				}		
				$i++;			
			}
			
			echo $content;
		}
		
	}		
	
	function Manage(){
		$content = '';
		$table = new TemplateClass();
		$table->init(THEME.'/tables/pengguna.html');
		$content = $table->parse();
		
		$strhak = "";
		foreach ($this->auth->sHak as $key => $val) {
			$strhak .= "<option value='".$key."'>".$val."</option>";
		}		
							
		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/pengguna.html');
		$form->defineTag('HAK_AKSES',$strhak);
		$form->defineTag('SELECT_KABUPATEN',$this->owner->kabupaten->SelectorBody());
		$content .= $form->parse();
		
		//modal form password
		$form = new TemplateClass();
		$form->init(THEME.'/forms/pengguna-password.html');
		$content .= $form->parse();		
		
		$script = "
							function pass(id) {
								$('.frmPassword input[name=id]').val(id);
								$('.frmPassword input[name=do]').val('edt');
								$('#edtOldPwd').val('');
								$('#edtNewPwd1').val('');
								$('#edtNewPwd2').val('');
								
								$('#edtOldPwd').focus();
								$('#password').modal('show');
								return false;
							};		
							
							function edit(id) {
								$.post('#',{'do':'svc','cmd':'detail','id':id}, function(data) {
									$('#title').text('Edit Pengguna');
									$('.frmPengguna input[name=id]').val(data.id);
									$('.frmPengguna input[name=do]').val('edt');
									$('#edtUsername').val(data.username);
									$('#edtUsername').attr('disabled','disabled');
									
									$('#cbHakAkses').selectpicker('val',data.hak);
									$('#cbKabupaten').selectpicker('val',data.kodepemda);
									
									$('#Pass1').hide();
									$('#Pass2').hide();
									$('#edtPwd1').val('');
									$('#edtPwd2').val('');									
									
									$('#inputKab').hide();
									
									if (data.hak==MD5('KABUPATEN'))  $('#inputKab').show();

								
									$('#edtUsername').focus();
									$('#pengguna').modal('show');
								},'json');
								return false;
								
							};
							function add() {
								$('#title').text('Tambah Pengguna');
								$('.frmPengguna input[name=id]').val('');
								$('.frmPengguna input[name=do]').val('add');
								$('#cbHakAkses').selectpicker('val','');
								$('#cbKabupaten').selectpicker('val','');								
								$('#edtUsername').removeAttr('disabled');
								$('#edtUsername').val('');
								$('#edtPwd1').val('');
								$('#edtPwd2').val('');

								$('#Pass1').show();
								$('#Pass2').show();
								$('#inputKab').hide();
								
								$('#edtUsername').focus();
								$('#pengguna').modal('show');
								return false;
							};				

							function del() {
								var cek = Array();
								i=0;
								$('#tblPengguna input:checkbox:checked').each(function(index,obj) {
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
							
							$(document).on('change','#cbHakAkses',function(e){
								e.preventDefault();
								$('#inputKab').hide();
								if ($('#cbHakAkses').selectpicker('val')==MD5('KABUPATEN')) $('#inputKab').show();
							});
							
							$(document).on('submit','.frmPengguna',function(e){
								e.preventDefault();
								var sukses = true;
								if ($('.frmPengguna input[name=do]').val()=='add') {
									 if ($('#edtPwd1').val() != $('#edtPwd2').val()) {
										bootbox.alert('Password tidak sama!');
										sukses = false;
									 }
								}
								
								if ($('#cbHakAkses').selectpicker('val')==null) {
									bootbox.alert('Hak Akses belum dipilih!');
									sukses = false;
								}
								
								if ($('#inputKab').is(':visible') && ($('#cbKabupaten').selectpicker('val')=='')) {
									bootbox.alert('Kabupaten/Kota belum dipilih!');
									sukses = false;
								}
								
								if (sukses) {
									if ($('.frmPengguna input[name=do]').val()=='add') {
										$('#edtPwd1').val(MD5($('#edtPwd1').val()));
										$('#edtPwd2').val(MD5($('#edtPwd2').val()));
									}
									$.post('#',$('.frmPengguna').serialize(), function(data) { 
										if (data!='OK') {
											$('#edtPwd1').val('');
											$('#edtPwd1').val('');									
											bootbox.alert('Tidak berhasil!');
										} else {
											$('#pengguna').modal('hide');
											bootbox.info('Berhasil menyimpan data!');
											loadData(); 
										}
									});
								}
							});
							
							$(document).on('submit','.frmPassword',function(e){
								e.preventDefault();
								$.post('#',{'do':'svc','cmd':'pwd','id':$('.frmPassword input[name=id]').val(),'pwd':MD5($('#edtOldPwd').val())}, function(data) {
									if (data!='OK') bootbox.alert('Password lama tidak sama!');
									else {
										if ($('#edtNewPwd1').val() == '') {
											bootbox.alert('Password belum diisi!');
										} else if ($('#edtNewPwd1').val() != $('#edtNewPwd2').val()) {
											bootbox.alert('Password tidak sama!');
										} else {
											$('#edtOldPwd').val(MD5($('#edtOldPwd').val()));
											$('#edtNewPwd1').val(MD5($('#edtNewPwd1').val()));
											$('#edtNewPwd2').val(MD5($('#edtNewPwd2').val()));
											$.post('#',$('.frmPassword').serialize(), function(data) { 
												if (data!='OK') {
													$('#edtOldPwd').val('');
													$('#edtNewPwd1').val('');
													$('#edtNewPwd2').val('');												
													bootbox.alert('Tidak berhasil mengubah password!');
												} else {
													bootbox.info('Berhasil mengubah password!');
													$('#password').modal('hide');
												}
											});
										}
									}
								});
							});	
														
		";
				
		$define = array (
						 'PAGETITLE'	=> 'Manage Data Pengguna',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
				
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl(); 		
	
	}
	
	function GetDetail($id){
		# detail artikel
		$title = 'Profil Pengguna';
		$content = '';

		$form = new TemplateClass();
		$form->init(THEME.'/forms/pengguna-detail.html');
		$content .= $form->parse();	

		//modal form password
		$form = new TemplateClass();
		$form->init(THEME.'/forms/pengguna-password.html');
		$content .= $form->parse();				

		$script = "
				$.post('".ROOT_URL."/pengguna.htm',{'do':'svc','cmd':'detail','id':'".$id."'}, function(data) {
					$('#nmUsername').text(data.username);
					$('#nmHak').text(data.shak);
					$('#nmLastLogin').text(data.lastlogin);
					$('#nmKab').text(data.nmkab);					
					$('#kabupaten').hide();
					if (data.hak==MD5('KABUPATEN')) $('#kabupaten').show();

				},'json');
				
				function pass() {
					$('.frmPassword input[name=id]').val('".$id."');
					$('.frmPassword input[name=do]').val('edt');
					$('#edtOldPwd').val('');
					$('#edtNewPwd1').val('');
					$('#edtNewPwd2').val('');
					
					$('#edtOldPwd').focus();
					$('#password').modal('show');
					return false;
				};				
		
				$(document).on('submit','.frmPassword',function(e){
					e.preventDefault();
					$.post('".ROOT_URL."/pengguna.htm',{'do':'svc','cmd':'pwd','id':$('.frmPassword input[name=id]').val(),'pwd':MD5($('#edtOldPwd').val())}, function(data) {
						if (data!='OK') bootbox.alert('Password lama tidak sama!');
						else {
							$('#edtOldPwd').val(MD5($('#edtOldPwd').val()));
							$('#edtNewPwd1').val(MD5($('#edtNewPwd1').val()));
							$('#edtNewPwd2').val(MD5($('#edtNewPwd2').val()));
							$.post('".ROOT_URL."/pengguna.htm',$('.frmPassword').serialize(), function(data) { 
								if (data!='OK') {
									$('#edtOldPwd').val('');
									$('#edtNewPwd1').val('');
									$('#edtNewPwd2').val('');												
									bootbox.alert('Tidak berhasil mengubah password!');
								} else {
									bootbox.info('Berhasil mengubah password!');
									$('#password').modal('hide');
								}
							});
						}
					});
				});		
		";
		
		$this->pgTitle = $title;
		$this->pgContent = $content; 
		$this->pgScript = $script;
	}



}