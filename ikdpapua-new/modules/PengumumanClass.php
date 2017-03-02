<?php
Class PengumumanClass extends ModulClass{
	function Service(){
		# service handle
		$cmd = '';
		$id = '';
		if (isset($_POST['cmd'])) $cmd = $this->scr->filter($_POST['cmd']);
		if (isset($_POST['id'])) $id = $this->scr->filter($_POST['id']);
		if ($cmd=='detail' && $id!='') {
			$sql = "SELECT * FROM pengumuman WHERE idpengumuman = '".$id."'";
			$res = $this->db->query($sql);	
			if ($tmpdata = $this->db->fetchArray($res)) {
				$data['id']	= $tmpdata['idpengumuman'];
				$data['title'] = $tmpdata['title'];
				$data['content'] = $tmpdata['content'];
				$data['author'] = $tmpdata['author'];
				$data['tampil'] = $tmpdata['tampil'];
				echo json_encode($data);
			}
		} else if ($cmd=='list') {
			if (!$this->auth->isGranted(array('ADMIN'))) die();
			$content = "";

			$sql = "SELECT * FROM pengumuman ORDER BY postdate";
			$data = $this->db->query($sql);
			$i=0;
			if ($this->db->numRows($data)>0) $content='';
			while ($tmpdata = $this->db->fetchArray($data)) {
				$row[$i] = $tmpdata;
				if($row[$i][0] <> ''){
					$tampil = ($row[$i]['tampil'] == 'Y') ? "<span class='label label-info label-form'><i class='fa fa-check-circle'></i></span>" : "<span class='label label-warning label-form'><i class='fa fa-times-circle'></i></span>";
					$content .= "<tr>
								<td ><input type='checkbox' name='lstPengumuman[]' value='".$row[$i]['idpengumuman']."'> ".($i+1)."</td>
								<td>".$row[$i]['title']."</td>
								<td>".$row[$i]['content']."</td>
								<td>".$row[$i]['postdate']."</td>
								<td>".$row[$i]['author']."</td>
								<td>".$tampil."</td>
								<td style='text-align: center;'><a class='btn btn-success btn-xs has-tooltip' href='#' onClick='return edit(".$row[$i]['idpengumuman'].");' title='Edit'><i class='fa fa-pencil'></i> Edit</a></td></tr>";
				}
				$i++;
			}
			echo $content;
		}
	}

	function Update(){
		# query update 
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$sql = "UPDATE pengumuman SET
					title = '".$this->scr->filter($_POST['edtTitle'])."',
					content = '".$this->scr->filter($_POST['edtContent'])."',
					author = '".$this->scr->filter($_POST['edtAuthor'])."',
					tampil = '".$this->scr->filter($_POST['edtStatus'])."',
					postdate = '".date('Y-m-d h:i:s')."'
						WHERE
					idpengumuman = '".$this->scr->filter($_POST['id'])."'
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
			$sql = "DELETE FROM pengumuman WHERE 
					
					idpengumuman IN (".$this->scr->filter($_POST['id']).") 
					";
			$res = $this->db->query($sql) or die('ERROR');		
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}
	}

	function Insert(){
		# query insert 
		if (!$this->auth->isGranted('ADMIN')) die();
		if (isset($_POST)) {
			$sql = "INSERT INTO pengumuman SET
					title = '".$this->scr->filter($_POST['edtTitle'])."',
					content = '".$this->scr->filter($_POST['edtContent'])."',
					author = '".$this->scr->filter($_POST['edtAuthor'])."',
					tampil = '".$this->scr->filter($_POST['edtStatus'])."'
					";
			$res = $this->db->query($sql)or die('ERROR');
			if ($this->db->affectedRow()==0) die('ERROR');
			die('OK');
		}
	}

	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN')))  header('location: '.ROOT_URL);
		$content = "";
		$script = "";

		$table = new TemplateClass();
		$table->init(THEME.'/tables/pengumuman.html');
		$content = $table->parse();

		//modal form tambah
		$form = new TemplateClass();
		$form->init(THEME.'/forms/pengumuman.html');
		$content .= $form->parse();

		$script = "
			function add(t,p,apbd) {
				$('#title').text('Tambah Pengumuman');
				$('.frmPengumuman input[name=id]').val('');
				$('.frmPengumuman input[name=do]').val('add');
				
				$('#edtTitle').val('');
				$('#edtContent').val('');
				$('#edtAuthor').val('');
				$('#edtStatus').val('');

				$('#edtTitle').focus();

				$('#pengumuman').modal('show');
				return false;
			};

			function edit(id) {
				$.post('#',{'do':'svc','cmd':'detail','id':id}, function(data) {
					$('#title').text('Edit Pengumuman');
					$('.frmPengumuman input[name=id]').val(data.id);
					$('.frmPengumuman input[name=do]').val('edt');
					
					$('#edtTitle').val(data.title);
					$('#edtContent').val(data.content);
					$('#edtAuthor').val(data.author);
					$('#edtStatus').val(data.tampil);

					$('#edtTitle').focus();

					$('#pengumuman').modal('show');
				},'json');
				return false;
				
			};

			function del() {
				var cek = Array();
				i=0;
				$('#tblPengumuman input:checkbox:checked').each(function(index,obj) {
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
			
			$(document).on('submit','.frmPengumuman',function(e){
				e.preventDefault();
				var sukses = true;
				if ($('#cbKabupaten').selectpicker('val')=='') {
					bootbox.alert('Kabupaten Belum Dipilih!');
					sukses = false;
				}
				if (sukses) {
					$.post('#',$('.frmPengumuman').serialize(), function(data) { 
						if (data!='OK') bootbox.alert('Tidak berhasil!');
						else {
							bootbox.info('Berhasil menyimpan data!');
							$('#pengumuman').modal('hide');
							loadData(); 
						}
					});
				}
			});
		";

		$define = array (
						 'PAGETITLE'	=> 'Pengumuman',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl();
	}
}