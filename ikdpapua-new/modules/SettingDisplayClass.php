<?php
Class SettingDisplayClass extends ModulClass{
	function manage(){
		if (!$this->auth->isGranted(array('ADMIN')))  header('location: '.ROOT_URL);
		$content = "";
		$script = "";

		# Ringkasan APBD
		$table = new TemplateClass();
		$table->init(THEME.'/tables/disp-apbd.html');
		$content .= $table->parse();


		# modal form ringkasan apbd
		$form = new TemplateClass();
		$form->init(THEME.'/forms/disp-apbd.html');
		$form->defineTag('TAHUN',date('Y'));
		$content .= $form->parse();

		$script = "
			function edit(id,t) {
				$.post('#',{'do':'svc','cmd':'detail','id':id}, function(data) {
					$('#title').text('Pilih Tahun dan Kodepemda');
					$('.frmSetting input[name=id]').val(data.id);
					$('.frmSetting input[name=do]').val('edt');
					$('#edtTahun').val(data.tahun);
					
					$('#edtTahun').spinner('option','disabled',false);
					$('#settingDisp').modal('show');
				},'json');
				return false;
			};
																	
			function loadData() {
				$('#loader').modal('show');
				$.post('#',{'do':'svc','cmd':'list', 'act':'apbd'}, function(data) { 
					$('#loader').modal('hide'); 
					$('#tbodyData').html(data);	
				});
			};
			
			loadData();
			$('.spinner_default').spinner();
			
			$(document).on('submit','.frmSetting',function(e){
				e.preventDefault();
				var sukses = true;
				if ($('#cbKabupaten').selectpicker('val')=='') {
					bootbox.alert('Kabupaten Belum Dipilih!');
					sukses = false;
				}
				if (sukses) {
					$.post('#',$('.frmSetting').serialize(), function(data) { 
						if (data!='OK') bootbox.alert('Tidak berhasil!');
						else {
							bootbox.info('Berhasil menyimpan data!');
							$('#settingDisp').modal('hide');
							loadData(); 
						}
					});
				}
			});
		";

		$define = array (
						 'PAGETITLE'	=> 'Pengaturan Display',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
				
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl(); 
	}

	function Service(){
		# service handle
		$cmd = '';
		$id = '';
		$act = '';
		if (isset($_POST['cmd'])) $cmd = $this->scr->filter($_POST['cmd']);
		if (isset($_POST['id'])) $id = $this->scr->filter($_POST['id']);
		if (isset($_POST['act'])) $act = $this->scr->filter($_POST['act']);
		if ($cmd=='detail' && $id!='') {
			$sql = "SELECT * FROM setting_dis
					WHERE id = '".$id."'";
			// die($sql);
			$res = $this->db->query($sql);	
			if ($tmpdata = $this->db->fetchArray($res)) {
				$data['id']	= $tmpdata['id'];
				$data['tahun'] = $tmpdata['tahun'];
				echo json_encode($data);
			}
		} else if ($cmd=='list' && $act=='apbd') {
			if (!$this->auth->isGranted(array('ADMIN'))) die();
			$content = "";

			$sql = "SELECT * FROM setting_dis";
			$data = $this->db->query($sql);
			$i = 0;
			while ($row = $this->db->fetchArray($data)) {
				$content .= "<tr>
							<td class='text-center'>".++$i."</td>
							<td class='text-center'>".$row['tahun']."</td>
							<td class='text-center'><a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return edit(".$row['id'].");' title='Edit'><i class='fa fa-pencil'></i> Ubah</a></td></tr>";
			}
			echo $content;
		}
	}

	function Update(){
		# query update 
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$sql = "UPDATE setting_dis SET
					tahun = '".$this->scr->filter($_POST['edtTahun'])."'
					WHERE
					id = '".$this->scr->filter($_POST['id'])."'";
			$res = $this->db->query($sql)or die('ERROR');
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}
	}
}