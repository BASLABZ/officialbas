<?php
class pegawai extends Controller
{
	function __construct(){
		parent::__construct();
		$this->ceklogin();
		$this->library("CUtilities");
		$this->util = new CUtilities();
		$this->init();	
	}
	function init(){
				
		@$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'add':
				$this->add($_GET['kodeskpd']);
			break;
			case 'edit':
				$this->edit();
			break;
			case 'pindah':
				$this->pindah_SKPD($_GET['nip']);
			break;
			case 'pindah_peg':
				$this->pindah_eksekusi();
			break;
			case 'insert':
				$this->insert();
			break;
			case 'update':
				$this->update();
			break;
			case 'delete':
				$this->delete();
			break;
			case 'optAtasan':
				$this->optAtasan();
			break;
			default:
				$this->datalist(($this->user['kodeskpd']!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;	
		}
	}
	function optAtasan(){
		$sql = "select * from pegawai where skpd='".$this->db->esc($_GET['kodeskpd'])."' and nip <> '".$this->db->esc($_GET['nip'])."'";
		$this->res = $this->db->query($sql);
		$this->view('optAtasan');
	}
	function optSKPD($val){
		if($val <> ''){
			$sql = "select * from skpd where id='".$this->db->esc($val)."'";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['singkat'];
		}else{
			$sql = "select * from skpd order by kode";
			$res = $this->db->query($sql);
			$option = '<select id="optskpd">';
			$option .= '<option value="">- Pilih SKPD -</option>';
			$i=1;
			while($data = $this->db->fetchArray($res)){
				$sel = ($data['id'] == @$_GET['kodeskpd'])?'selected':'';
				$option .= '<option value="'.$data['id'].'" '.$sel.'>'.($i++).' - '.$data['singkat'].'</option>';
			}
			$option .= '</select>';
		}
		return $option;	
	}
	function optSKPD_PINDAH($val){
		
			$sql = "select * from skpd order by kode";
			$res = $this->db->query($sql);
			$option = '<select id="optskpd" name="kodeskpd">';
			$option .= '<option value="">- Pilih SKPD -</option>';
			$i=1;
			while($data = $this->db->fetchArray($res)){
				$sel = ($data['id'] == $val)?'selected':'';
				$option .= '<option value="'.$data['id'].'" '.$sel.'>'.($i++).' - '.$data['skpd'].'</option>';
			}
			$option .= '</select>';
		
		return $option;	
	}
	function optPendidikan($val){
		$sql = "select * from pendidikan order by id";
		$res = $this->db->query($sql);
		$option = '<option value="">- Pilih Pendidikan -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['urai'] == $val)?'selected':'';
			$option .= '<option value="'.$data['urai'].'" '.$sel.'>'.$data['urai'].'</option>';
		}
		return $option;	
	}
	function optBidang($id){
		$sql = "select * from bidang where id_skpd= '".$this->data['id']."'";
		$res =$this->db->query($sql);
		$option = '<option value="">- Pilih Bidang -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['nama_bidang'] == $val)?'selected':'';
			$option .= '<option value="'.$data['nama_bidang'].'" '.$sel.'>'.$data['nama_bidang'].'</option>';
		}
		return $option;
	}
	function optBidangList($skpd,$val){
		$sql = "select * from bidang where id_skpd='".$skpd."'";
		$res =$this->db->query($sql);
		$option = '<option value="">- Pilih Bidang -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['nama_bidang'] == $val)?'selected':'';
			$option .= '<option value="'.$data['nama_bidang'].'" '.$sel.'>'.$data['nama_bidang'].'</option>';
		}
		return $option;
	}
	function optBidangEdit($val){
		$sql = "select * from bidang where id_skpd= '".$this->db->esc($_POST['kodeskpd'])."'";
		$res =$this->db->query($sql);
		$option = '<option value="">- Pilih Bidang -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['nama_bidang'] == $val)?'selected':'';
			$option .= '<option value="'.$data['nama_bidang'].'" '.$sel.'>'.$data['nama_bidang'].'</option>';
		}
		return $option;
	}
	function optBidangPindah($skpd,$val){
		$sql = "select * from bidang where id_skpd='".$skpd."'";
		$res =$this->db->query($sql);
		$option = '<option value="">- Pilih Bidang -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['nama_bidang'] == $val)?'selected':'';
			$option .= '<option value="'.$data['nama_bidang'].'" '.$sel.'>'.$data['nama_bidang'].'</option>';
		}
		return $option;
	}
	
	function optGolongan($val){
		$sql = "select * from golongan order by urut desc";
		$res = $this->db->query($sql);
		$option = '<option value="">- Pilih Golongan -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['golong'] == $val)?'selected':'';
			$option .= '<option value="'.$data['golong'].'" '.$sel.'>'.$data['golong'].'</option>';
		}
		return $option;	
	}
	function pindah_SKPD($nip){
		$sql = "select * from pegawai where nip='".$this->db->esc($nip)."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		$this->data['listpeg'] = '<tr>'.
            					  '<td><table class="tabket">'.
								  '<tr><td>NIP</td><td><input type="text" name="nip"  maxlength="30" size="22" value="'.$data['nip'].'" class="nip"/><input type="hidden" name="oldnip" value="'.$data['nip'].'"/></td></tr>'.
								  '<tr><td>Nama</td><td><input type="text" name="nama"  maxlength="100" size="22" value="'.$data['nama'].'"/></td></tr>'.
								  '</table></td>'.
            					  '<td><table class="tabket">'.
            					  '<tr><td>Pendidikan</td><td><select name="pendidikan">'.$this->optPendidikan($data['pendidikan']).'</select></td><td>Status Pegawai</td><td><input type="radio" name="status" value="pns" '.($data['status']=='pns'?'checked':'').'>PNS <input type="radio" name="status['.$no.']" value="honor" '.($data['status']=='pns'?'':'checked').'>Honorer</tr>'.
            					  '<tr><td>Golongan</td><td><select name="golongan">'.$this->optGolongan($data['golongan']).'</select></td><td>Max TPB</td><td>Rp. <input type="text" name="tpb" class="numberonly" value="'.$data['tpb'].'"/></td></tr>'.
            					  '<tr><td>Jabatan</td><td><input type="text" name="jabatan" maxlength="100" value="'.$data['jabatan'].'"/></td><td>Nama Atasan</td><td><input type="text" name="namaa"  maxlength="100" value="'.$data['namaa'].'" class="nama_a" alt="1"/><img src="img/search.png" width="15px" class="search" alt="1"/></td></tr>'.
            					  '<tr><td>Eselon</td><td><select name="eselon">'.$this->optEselon($data['eselon']).'</select></td><td>NIP Atasan</td><td><input type="text" name="nipa"  maxlength="30" value="'.$data['nipa'].'" class="nip_a" alt="1"/></td></tr>'.
            					  '<tr><td>Bidang</td><td><select name="unit" id="bidang">'.$this->optBidangPindah($data['skpd'],$data['unit']).'</select></td><td>Golongan Atasan</td><td><select name="golongana" class="golongan_a" alt="1">'.$this->optGolongan($data['golongana']).'></select></td></tr>'.
            					  '<tr><td>Sub Bidang</td><td><input type="text" name="subunit" maxlength="150" value="'.$data['subunit'].'"/></td><td>Jabatan Atasan</td><td><input type="text" name="jabatana" maxlength="100" value="'.$data['jabatana'].'" class="jabatan_a" alt="1"/></td></tr>'.
            					  '</table></td>'.
            					  '</tr>';
		$this->data['optskpd'] = $this->optSKPD_PINDAH($data['skpd']);
		$this->data['oldkodeskpd'] = $data['skpd'];
		$this->template('pegawai_pindah','admin');
	}
	function pindah_eksekusi(){
		$sql = "update pegawai set dwMachineNumber = '',
										dwEnrollNumber = '',
										skpd = '".$this->db->esc($_POST['kodeskpd'])."',
										nip = '".$this->db->esc($_POST['nip'])."',
										nama = '".$this->db->esc($_POST['nama'])."',
										pendidikan = '".$this->db->esc($_POST['pendidikan'])."',
										golongan = '".$this->db->esc($_POST['golongan'])."',
										jabatan = '".$this->db->esc($_POST['jabatan'])."',
										eselon = '".$this->db->esc($_POST['eselon'])."',
										skpd = '".$this->db->esc($_POST['kodeskpd'])."',
										unit = '".$this->db->esc($_POST['unit'])."',
										subunit = '".$this->db->esc($_POST['subunit'])."',
										status = '".$this->db->esc($_POST['status'])."',
										namaa = '".$this->db->esc($_POST['namaa'])."',
										nipa = '".$this->db->esc($_POST['nipa'])."',
										golongana = '".$this->db->esc($_POST['golongana'])."',
										jabatana = '".$this->db->esc($_POST['jabatana'])."',
										tpb = '".$this->db->esc($_POST['tpb'])."'
										WHERE nip='".$this->db->esc($_POST['oldnip'])."'";
		$this->db->query($sql);
		$sql = "insert into pindah_skpd set nip = '".$this->db->esc($_POST['nip'])."',
											skpd_asal = '".$this->db->esc($_POST['oldkodeskpd'])."',
											skpd_tujuan = '".$this->db->esc($_POST['kodeskpd'])."',
											`date` = '".$this->db->esc($_POST['tanggal'])."'";
		$this->db->query($sql);									
		$kodeskpd = ($this->user[kodeskpd] <> '')?$this->user[kodeskpd]:$_POST['kodeskpd'];
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pegawai&kodeskpd=".$kodeskpd."'>";
	}
	
	function optEselon($val){
		$sql = "select * from eselon where urai<>'-' order by urut";
		$res = $this->db->query($sql);
		$option = '<option value="-">- Pilih Eselon -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['urai'] == $val)?'selected':'';
			$option .= '<option value="'.$data['urai'].'" '.$sel.'>'.$data['urai'].'</option>';
		}
		return $option;	
	}
	function optAlat($val){
		$kodeskpd = ($this->user['kodeskpd'] <> '')?$this->user['kodeskpd']:$_GET['kodeskpd'];
		$sql = "select * from machine where kodeskpd = '".$this->db->esc($kodeskpd)."' and kodeskpd <> ''";
		$res = $this->db->query($sql);
		$option = '<option value="-">-</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['dwMachineNumber'] == $val)?'selected':'';
			$option .= '<option value="'.$data['dwMachineNumber'].'" '.$sel.'>'.$data['dwMachineNumber'].'</option>';
		}
		return $option;
	}
	function datalist($id){
		$this->data['id'] = $id;
		if(isset($_GET['bidang'])) $bidang=$_GET['bidang'];
		$where = ($bidang != '') ? " and b.id='".$bidang."' " : "";
		$sql = "select * from pegawai p join golongan g on (g.golong=p.golongan) left join eselon e on (e.urai=p.eselon) 
		left join bidang b on (b.id_skpd=p.skpd)  
		where p.skpd = '".$this->db->esc($id)."' ".$where."
				order by if(p.eselon = '-',1,0),p.eselon,e.urut,g.urut,p.nip,if(p.status = 'pns',0,1) desc";
		// die($sql);
		$this->res = $this->db->query($sql);
		
		$this->template('pegawai_list','admin');	
	}
	function add($id){
		$sql = "select * from skpd where id='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		$this->data['id'] = $data['id'];
		$this->data['skpd'] = $data['skpd'];
		$this->template('pegawai_add','admin');
	}
	
	function edit(){
		$sql = "select * from skpd where id='".$this->db->esc($_POST['kodeskpd'])."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		$this->data['skpd'] = $data['skpd'];
		$this->data['listpeg'] = "";
		$no = 1;
		foreach($_POST['nip'] as $val){
			$sql = "select * from pegawai where nip='".$this->db->esc($val)."'";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			
			$this->data['listpeg'] .= '<tr>'.
            					  '<td class="td1" valign="top">'.$no.'</td>'.
            					  '<td><table class="tabket">'.
								  '<tr><td>NIP</td><td><input type="text" name="nip['.$no.']"  maxlength="30" size="22" value="'.$data['nip'].'"/><input type="hidden" name="oldnip['.$no.']" value="'.$data['nip'].'" class="nip" alt="'.$no.'"/></td></tr>'.
								  '<tr><td>Nama</td><td><input type="text" name="nama['.$no.']"  maxlength="100" size="22" value="'.$data['nama'].'"/></td></tr>'.
								  '</table></td>'.
            					  '<td><table class="tabket">'.
            					  '<tr><td>Pendidikan</td><td><select name="pendidikan['.$no.']">'.$this->optPendidikan($data['pendidikan']).'</select></td><td>Status Pegawai</td><td><input type="radio" name="status['.$no.']" value="pns" '.($data['status']=='pns'?'checked':'').'>PNS <input type="radio" name="status['.$no.']" value="honor" '.($data['status']=='pns'?'':'checked').'>Honorer</tr>'.
            					  '<tr><td>Golongan</td><td><select name="golongan['.$no.']">'.$this->optGolongan($data['golongan']).'</select></td><td>Max TPB</td><td>Rp. <input type="text" name="tpb['.$no.']" class="numberonly" value="'.$data['tpb'].'"/></td></tr>'.
            					  '<tr><td>Jabatan</td><td><input type="text" name="jabatan['.$no.']" maxlength="100" value="'.$data['jabatan'].'"/></td><td>Nama Atasan</td><td><input type="text" name="namaa['.$no.']"  maxlength="100" value="'.$data['namaa'].'" class="nama_a" alt="'.$no.'"/><img src="img/search.png" width="15px" class="search" alt="'.$no.'"/></td></tr>'.
            					  '<tr><td>Eselon</td><td><select name="eselon['.$no.']">'.$this->optEselon($data['eselon']).'</select></td><td>NIP Atasan</td><td><input type="text" name="nipa['.$no.']"  maxlength="30" value="'.$data['nipa'].'" class="nip_a" alt="'.$no.'"/></td></tr>'.
            					  '<tr><td>Bidang</td><td><select name="unit['.$no.']">'.$this->optBidangEdit($data['unit']).'</select></td><td>Golongan Atasan</td><td><select name="golongana['.$no.']" class="golongan_a" alt="'.$no.'">'.$this->optGolongan($data['golongana']).'></select></td></tr>'.
            					  '<tr><td>Sub Bidang</td><td><input type="text" name="subunit['.$no.']" maxlength="150" value="'.$data['subunit'].'"/></td><td>Jabatan Atasan</td><td><input type="text" name="jabatana['.$no.']" maxlength="100" value="'.$data['jabatana'].'" class="jabatan_a" alt="'.$no.'"/></td></tr>'.
            					  '</table></td>'.
            					  '<td><table class="tabket">'.
            					  '<tr><td>No. Alat</td><td><select name="no_alat['.$no.']" style="width:50px;">'.$this->optAlat($data['dwMachineNumber']).'</select></td></tr>'.
            					  '<tr><td>No. Enroll</td><td><input type="text" name="no_enroll['.$no.']" class="numberonly" size="3" value="'.$data['dwEnrollNumber'].'"/></td></tr>'.
            					  '</table></td>'.
            					  '</tr>';
			$no++;					
		}
		$this->template('pegawai_edit','admin');
	}
	
	function insert(){
		$sum = count($_POST['nip']);
		for($i=1;$i<=$sum;$i++){
			$sql = "insert into pegawai set dwMachineNumber = '".$this->db->esc($_POST['no_alat'][$i])."',
										dwEnrollNumber = '".$this->db->esc($_POST['no_enroll'][$i])."',
										nip = '".$this->db->esc($_POST['nip'][$i])."',
										nama = '".$this->db->esc($_POST['nama'][$i])."',
										pendidikan = '".$this->db->esc($_POST['pendidikan'][$i])."',
										golongan = '".$this->db->esc($_POST['golongan'][$i])."',
										jabatan = '".$this->db->esc($_POST['jabatan'][$i])."',
										eselon = '".$this->db->esc($_POST['eselon'][$i])."',
										skpd = '".$this->db->esc($_POST['kodeskpd'])."',
										unit = '".$this->db->esc($_POST['unit'][$i])."',
										subunit = '".$this->db->esc($_POST['subunit'][$i])."',
										status = '".$this->db->esc($_POST['status'][$i])."',
										namaa = '".$this->db->esc($_POST['namaa'][$i])."',
										nipa = '".$this->db->esc($_POST['nipa'][$i])."',
										golongana = '".$this->db->esc($_POST['golongana'][$i])."',
										jabatana = '".$this->db->esc($_POST['jabatana'][$i])."',
										tpb = '".$this->db->esc($_POST['tpb'][$i])."'";
		
		$this->db->query($sql);
		}
		
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pegawai&kodeskpd=".$_POST['kodeskpd']."'>";	
	}
	
	function update(){
		$sum = count($_POST['nip']);
		for($i=0;$i<=$sum;$i++){
			if($_POST['oldnip'][$i] <> ''){
				$sql = "update pegawai set dwMachineNumber = '".$this->db->esc($_POST['no_alat'][$i])."',
										dwEnrollNumber = '".$this->db->esc($_POST['no_enroll'][$i])."',
										nip = '".$this->db->esc($_POST['nip'][$i])."',
										nama = '".$this->db->esc($_POST['nama'][$i])."',
										pendidikan = '".$this->db->esc($_POST['pendidikan'][$i])."',
										golongan = '".$this->db->esc($_POST['golongan'][$i])."',
										jabatan = '".$this->db->esc($_POST['jabatan'][$i])."',
										eselon = '".$this->db->esc($_POST['eselon'][$i])."',
										skpd = '".$this->db->esc($_POST['kodeskpd'])."',
										unit = '".$this->db->esc($_POST['unit'][$i])."',
										subunit = '".$this->db->esc($_POST['subunit'][$i])."',
										status = '".$this->db->esc($_POST['status'][$i])."',
										namaa = '".$this->db->esc($_POST['namaa'][$i])."',
										nipa = '".$this->db->esc($_POST['nipa'][$i])."',
										golongana = '".$this->db->esc($_POST['golongana'][$i])."',
										jabatana = '".$this->db->esc($_POST['jabatana'][$i])."',
										tpb = '".$this->db->esc($_POST['tpb'][$i])."'
										WHERE nip='".$this->db->esc($_POST['oldnip'][$i])."'";
		
				$this->db->query($sql);
			}
		}
		
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pegawai&kodeskpd=".$_POST['kodeskpd']."'>";	
	}
	function delete(){
		$sum = count($_POST['nip']);
		for($i=0;$i<=$sum;$i++){
			if($_POST['nip'][$i] <> ''){
				$sql = "delete from pegawai where nip = '".$this->db->esc($_POST['nip'][$i])."'";
				
				$this->db->query($sql);
			}
		}
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=pegawai&kodeskpd=".$_POST['kodeskpd']."'>";
	}
}
?>