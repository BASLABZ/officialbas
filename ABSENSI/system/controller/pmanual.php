<?php
class pmanual extends Controller
{
	function __construct(){
		parent::__construct();
		$this->ceklogin();
		$this->library('date');
		$this->dt = new DateClass;
		$this->library('paginator');
		$this->page = new Paginator();
		$this->init();	
	}
	function init(){
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'add':
				$this->formAdd();
			break;
			case 'edit':
				$this->formEdit($_GET['id']);
			break;
			case 'insert':
				$this->view('loading');
				$this->insert();
			break;
			case 'update':
				$this->view('loading');
				$this->update();
			break;
			case 'delete':
				$this->view('loading');
				$this->delete();
			break;
			case 'formupload':
				$this->form_upload();
			break;
			case 'upload':
				$this->upload();
			break;
			case 'harian':
				$this->datalist(($this->user['kodeskpd']!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			default:
				$this->datalist(($this->user['kodeskpd']!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;	
		}
	}
	function optSKPD($val=''){
		if($val <> ''){
			$sql = "select * from skpd where id='".$val."'";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['skpd'];
		}else{
			$sql = "select * from skpd order by kode";
			$res = $this->db->query($sql);
			$option = '<select id="optskpd">';
			$option .= '<option value="">- Pilih SKPD -</option>';
			$i=1;
			while($data = $this->db->fetchArray($res)){
				$sel = ($data['id'] == $_GET['kodeskpd'])?'selected':'';
				$option .= '<option value="'.$data['id'].'" '.$sel.'>'.($i++).' - '.$data['skpd'].'</option>';
			}
			$option .= '</select>';
		}
		return $option;	
	}
	function optMesin(){
		$sql = "select * from machine where kodeskpd <> ''";
		$res = $this->db->query($sql);
		$option = '';
		while($data = $this->db->fetchArray($res)){
			$option .= '<option value="'.$data['dwMachineNumber'].'" class="'.$data['kodeskpd'].'">'.$data['dwMachineNumber'].'</option>';
		}
		return $option;	
	}
	function form_upload(){
		
		$this->template('pmanual_formupload','admin');
	}
	function upload(){
		if($_FILES['file']['tmp_name']){
			$kode = date('dmyhis');
			$namafile = "".$kode.".dat";
			$target = "./tmp/".$namafile."";
			move_uploaded_file($_FILES['file']['tmp_name'],$target);
			if(file_exists($target)){
				$lines = file($target);
				foreach ($lines as $line_num => $line) {
					list($dwEnrollNumber,$dwTimeStamp,$dwMachineNumber,$dwInOutMode,$dwVerifyMode,$dwWorkCode)= explode("\t",$line);	
					$dwEnrollNumber = trim($dwEnrollNumber);
					list($dwDate,$dwTime) = explode(" ",$dwTimeStamp);
					list($dwYear,$dwMonth,$dwDay) = explode("-",$dwDate);
					list($dwHour,$dwMinute,$dwSecond) = explode(":",$dwTime);
					
					$sql = "replace into generallogdata(dwMachineNumber,dwEnrollNumber,dwVerifyMode,dwInOutMode,dwYear,dwMonth,dwDay,dwHour,dwMinute,dwDate,dwTime) values ".
						   "($dwMachineNumber, $dwEnrollNumber, $dwVerifyMode, $dwInOutMode,$dwYear,$dwMonth,$dwDay,$dwHour,$dwMinute,'$dwDate','$dwTime'); \n";
					$this->db->query($sql);
					
				}
				unlink($target);
				echo '<script>alert("Upload Data Berhasil");</script>';
			}
		}
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pmanual&mode=formupload'>";
	}
	function optPegawai($kodeskpd,$nip = ''){
		$sql = "select nip,nama from pegawai p 
										join golongan g on (p.golongan = g.golong)
										where skpd = '".$this->db->esc($kodeskpd)."' order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";
		$res = $this->db->query($sql);
		$option = '<option value="">- Pilih Pegawai -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['nip'] == $nip)?'selected':'';
			$option .= '<option value="'.$data['nip'].'" '.$sel.'>'.$data['nip'].' - '.$data['nama'].'</option>';
		}
		return $option;
	}
	function optTypeAbsen($type = ''){
		$arr = array('Masuk' => '0','Pulang' => '1');
		$option = '<option value="">- Pilih -</option>';
		foreach($arr as $key => $val){
			$sel = ($val == $type)?'selected':'';
			$option .= '<option value="'.$val.'" '.$sel.'>'.$key.'</option>';
		}
		return $option;	
	}
	function getSKPD($id){
		$sql = "select * from skpd where id='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		
		return $data['skpd'];
	}
	function formAdd(){
		
		$this->template('pmanual_add','admin');
	}
	function formEdit($id){
		$sql = "select * from presensi_manual where id_presensim = '".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->template('pmanual_edit','admin');
	}
	function insert(){
		$sql = "insert into presensi_manual set nip 		= '".$this->db->esc($_POST['nip'])."',
												inoutmode  = '".$this->db->esc($_POST['type'])."',
												date 	   = '".$this->db->esc($_POST['tanggal'])."',
												time 	   = '".$this->db->esc($_POST['jam'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pmanual&kodeskpd=".$_POST['kodeskpd']."'>";	
	}
	function update(){
		$sql = "update presensi_manual set nip 		= '".$this->db->esc($_POST['nip'])."',
											inoutmode  = '".$this->db->esc($_POST['type'])."',
											date 	   = '".$this->db->esc($_POST['tanggal'])."',
											time 	   = '".$this->db->esc($_POST['jam'])."'
										where id_presensim = '".$this->db->esc($_POST['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pmanual&kodeskpd=".$_POST['kodeskpd']."'>";
	}
	function delete(){
		$sql = "delete from presensi_manual where id_presensim = '".$this->db->esc($_GET['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pmanual&kodeskpd=".$_GET['kodeskpd']."'>";
	}
	function datalist($id){

		$sql = "select m.*,p.skpd,p.nama from presensi_manual m join pegawai p on m.nip=p.nip 
				where p.skpd='".$this->db->esc($id)."' order by `date` desc";

		$this->page->items_total = $this->db->numRows($this->db->query($sql));
		$this->page->mid_range = 3;
		$this->page->paginate();
		
		$this->sql = "".$sql." ".$this->page->limit."";

		$this->page->row_per_page = $this->db->numRows($this->db->query($this->sql));
		$this->res = $this->db->query($this->sql);
		$this->page->row_per_page = $this->db->numRows($this->res);
		
		$this->data['id'] = $id;
		$this->template('pmanual_list','admin');
	}	
}
?>