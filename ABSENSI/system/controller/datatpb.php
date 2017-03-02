<?php
class datatpb extends Controller
{
	var $util;
	
	function __construct(){
		parent::__construct();
		$this->library("CUtilities");
		$this->util = new CUtilities();
		
		$this->ceklogin();
		$this->init();
			
	}
	
	function init(){		
				
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'tpb04':
				$this->tpb04((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'edt_tpb04':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->template('tpb04_edit','tpb');
			break;
			case 'print_tpb04':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->report('cetak04');
			break;
			case 'tpb05':
				$this->tpb05((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'edt_tpb05':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->template('tpb05_edit','tpb');
			break;
			case 'print_tpb05':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->report('cetak05');
			break;
			case 'tpbkhusus':
				$this->tpbkhusus((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'tpbrekapumum':
				$this->tpbrekapumum((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'tpbrekapkhusus':
				$this->tpbrekapkhusus((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'edt_tpbkhusus':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->template('tpbkhusus_edit','tpb');
			break;
			case 'print_tpbkhusus':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->report('cetaktpbkhusus');
			break;
			case 'print_tpbrekapumum':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->report('cetakrekapumum');
			break;	
			case 'print_tpbrekapkhusus':
				$this->data['id'] = (trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']);
				$this->report('cetakrekapkhusus');
			break;		
			case 'tpbeksport':
				$this->tpbEksport();
			break;
			case 'tpbimport':
				$this->tpbImport();
			break;
			case 'do_eksport':
				$this->tpbEksport('export');
			break;	
			case 'do_import':
				$this->tpbImport('import');
			break;	
			default:
				$this->tpb04((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;	
		}
	}
	
	function optSKPD($val){
		if($val <> ''){
			$sql = "select * from skpd where id='".$this->esc($val)."'";
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
	
	function optSKPDKhusus($val){
		if($val <> ''){
			$sql = "select * from skpd where id='".$this->esc($val)."' and upper(skpd) like 'RUMAH SAKIT%' ";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['skpd'];
		}else{
			$sql = "select * from skpd where upper(skpd) like 'RUMAH SAKIT%' order by kode";
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
	
	function optBulan($val){
		$option = '<select id="bulan">';
		for($x=1;$x<=12;$x++) {
			$sel = ($x == $val)?'selected':'';
			$option .= '<option value="'.$x.'" '.$sel.'>'.$this->util->longMonth[$x].'</option>';
		}
		$option .= '</select>';
		return $option;	
	}
	
	function optTahun($val){
		$option = '<select id="tahun">';
		for($i=date("Y");$i>=2010;$i--) {
			$sel = ($i == $val)?'selected':'';
			$option .= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
		}
		$option .= '</select>';
		return $option;	
	}	
	
	function tpb04($id){
		$this->data['id'] = $id;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$this->res = $this->db->query("SELECT hari, jam, nama_kepala, nip_kepala, nama_bendahara, nip_bendahara, nama_petugas, nip_petugas  FROM setting WHERE skpd = '".$this->esc($id)."' AND bulan = '".$this->esc($_POST['bulan'])."' AND tahun = '".$this->esc($_POST['tahun'])."'");			
			if ($this->db->fetchArray($this->res)) {
			
				$sql = "select p.nama,p.nip,p.golongan,p.jabatan,k.total_tpb,(k.total_tpb*k.persen_disiplin/100)-k.potongan+k.tambahan as tpb,".
				    "k.bulan from (pegawai p join eselon e on (p.eselon=e.urai) join golongan g on (p.golongan=g.golong)) ".
					"left join form04 k on (k.nip=p.nip and k.bulan='".$this->esc($_POST["bulan"])."' and k.tahun='".$this->esc($_POST["tahun"])."') ".
					"where upper(p.eselon)<>'ESELON IV' and upper(p.eselon)<>'-' and p.skpd = '".$this->esc($id)."' order by e.urut,g.urut, p.nama";
				//die($sql);
				$this->res = $this->db->query($sql);
				$this->template('tpb04','tpb');
			} else {
				echo "<script>alert('Silahkan dientry dahulu jumlah hari dan jam kerja');</script>";
				echo "<form id='back' method='post' action='?pg=tpbsetting&mode=tpbsetting&kodeskpd=".$this->data['id']."'>";
				echo "<input type='hidden' name='bulan' value='".$_POST['bulan']."'>";
				echo "<input type='hidden' name='tahun' value='".$_POST['tahun']."'>";
				echo "</form><script>document.getElementById('back').submit();</script>";
			}
		} else {
			$this->template('tpb04','tpb');	
		}
	}	
	
	function tpb05($id){
		$this->data['id'] = $id;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$this->res = $this->db->query("SELECT hari, jam, nama_kepala, nip_kepala, nama_bendahara, nip_bendahara, nama_petugas, nip_petugas  FROM setting WHERE skpd = '".$this->esc($id)."' AND bulan = '".$this->esc($_POST['bulan'])."' AND tahun = '".$this->esc($_POST['tahun'])."'");			
			if ($this->db->fetchArray($this->res)) {
			
				$sql = "select p.nama,p.nip,p.golongan,p.jabatan,k.total_tpb,(k.total_tpb*k.persen_disiplin/100)-k.potongan+k.tambahan as tpb,".
				    "k.bulan from (pegawai p join eselon e on (p.eselon=e.urai) join golongan g on (p.golongan=g.golong)) ".
					"left join form05 k on (k.nip=p.nip and k.bulan='".$this->esc($_POST["bulan"])."' and k.tahun='".$this->esc($_POST["tahun"])."') ".
					"where upper(p.eselon)<>'ESELON I' and upper(p.eselon)<>'ESELON II' and upper(p.eselon)<>'ESELON III' and p.skpd = '".$this->esc($id)."' order by e.urut,g.urut, p.nama";
				$this->res = $this->db->query($sql);
				$this->template('tpb05','tpb');
			} else {
				echo "<script>alert('Silahkan dientry dahulu jumlah hari dan jam kerja');</script>";
				echo "<form id='back' method='post' action='?pg=tpbsetting&mode=tpbsetting&kodeskpd=".$this->data['id']."'>";
				echo "<input type='hidden' name='bulan' value='".$_POST['bulan']."'>";
				echo "<input type='hidden' name='tahun' value='".$_POST['tahun']."'>";
				echo "</form><script>document.getElementById('back').submit();</script>";
			}
		} else {
			$this->template('tpb05','tpb');	
		}
	}		
	
	function tpbkhusus($id){
		$this->data['id'] = $id;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$this->res = $this->db->query("SELECT nama_direktur,nip_direktur,nama_kepala_sdm,nip_kepala_sdm,nama_petugas,nip_petugas FROM setting_tpb_khusus WHERE skpd = '".$this->esc($id)."' AND bulan = '".$this->esc($_POST['bulan'])."' AND tahun = '".$this->esc($_POST['tahun'])."'");			
			if ($this->db->fetchArray($this->res)) { 
				$sql = "select p.nama,p.nip,p.golongan,p.jabatan,k.total_tpb,k.total_tpb_kotor,k.bulan from (pegawai p join eselon e on (p.eselon=e.urai) join golongan g on (p.golongan=g.golong)) ".
					   "left join tpb_khusus k on (k.nip=p.nip and k.bulan='".$this->esc($_POST["bulan"])."' and k.tahun='".$this->esc($_POST["tahun"])."') ".
					   "where p.skpd = '".$this->esc($id)."' order by e.urut, g.urut,p.nama";
				$this->res = $this->db->query($sql);
			} else {
				echo "<script>alert('Silahkan dientry dahulu setting tpb khusus!');</script>";
				echo "<form id='back' method='post' action='?pg=tpbsetting&mode=tpbkhusussetting&kodeskpd=".$this->data['id']."'>";
				echo "<input type='hidden' name='bulan' value='".$_POST['bulan']."'>";
				echo "<input type='hidden' name='tahun' value='".$_POST['tahun']."'>";
				echo "</form><script>document.getElementById('back').submit();</script>";
			}
		}
		if($this->user['kodeskpd'] <> ''){
			$sql = "select * from skpd where id='".$this->esc($this->user['kodeskpd'])."' and upper(skpd) like 'RUMAH SAKIT%' ";
			$res = $this->db->query($sql);
			if ($this->db->fetchArray($res)) $this->template('tpbkhusus','tpb');	 
			else $this->template('home','admin');	
		} else {
			$this->template('tpbkhusus','tpb');	
		}
	}
	
	
	function tpbrekapumum($id){
		$sql = "SELECT 
					p.nama, p.tpb,p.eselon,urut,v.nip,v.golongan, v.pangkat, v.gol1, v.gol2, 
					v.jabatan, v.`status`, v.subunit, sum(total_tpb) as totaltpb, 
					sum(potongan) as potongan, sum(tambahan) as tambahan, pajak 						
				FROM (
					(
						SELECT 
							urut,nip,golongan, form04.pangkat, 
							gol1, gol2, jabatan, subunit, `status`, 
							(total_tpb*persen_disiplin/100)-potongan+tambahan as total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, 
							tambahan, pajak 
						FROM 
							form04,golongan 
						WHERE 
							golong=golongan AND 
							bulan = '".$this->db->esc($_POST['bulan'])."' AND 
							tahun = '".$this->db->esc($_POST['tahun'])."' AND 	
							skpd = '".$this->db->esc($id)."'
					)	UNION
					(
						SELECT 
							urut,nip, golongan,form05.pangkat, 
							gol1, gol2, jabatan, subunit,`status`, 	
							(total_tpb*persen_disiplin/100)-potongan+tambahan as total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, 
							tambahan, pajak 
						FROM 
							form05,golongan 
						WHERE 
							golong=golongan AND 
							bulan = '".$this->db->esc($_POST["bulan"])."' AND 
							tahun = '".$this->db->esc($_POST["tahun"])."' AND 
							skpd = '".$this->db->esc($id)."'
					)
				  ) as v 
				join 
			  		pegawai p  
			  		on 
			  		p.nip = v.nip
					GROUP BY 
						nip 
					order by 
						if(eselon='-',1,0) ,
						eselon, 
						urut,
						p.nip,
						`status`
					";
		//die($sql);
		$this->res = $this->db->query($sql);			
		$this->data['id'] = $id;
		$this->template('tpbrekapumum','tpb');

	}
	

	function tpbrekapkhusus($id){
		$sql = "SELECT 
						p.nama, p.eselon, g.urut, t.nip, t.golongan, t.jabatan, 
						t.status, t.subunit, SUM(t.total_tpb) as totaltpb, 
						SUM(t.potongan) as totalpotongan, SUM(t.total_tpb_kotor) as totaltpbkotor
				FROM 
					tpb_khusus t JOIN golongan g 
						ON 
							t.golongan = g.golong
					JOIN pegawai p
						ON
							p.nip = t.nip  
				WHERE 
					t.bulan = '".$this->db->esc($_POST["bulan"])."' AND 
					t.tahun = '".$this->db->esc($_POST["tahun"])."' AND 
					t.skpd = '".$this->db->esc($id)."' 
				GROUP BY 
					t.nip
				ORDER BY 
					if(eselon='-',1,0) ,
					eselon,
					urut ,
					t.nip,
					`status` desc
				";
		$this->res = $this->db->query($sql);						
		$this->data['id'] = $id;
		$this->template('tpbrekapkhusus','tpb');	
	}


	function tpbEksport($act=''){
		//die('eksport');
		if($act == 'export'){
			//print_r($_POST);
			//die('do export');
			$idskpd=$_POST['skpd'];
			//$sskpd=$_SESSION['sesi_skpd'];
			//$_POST['bulan'] = $_POST['bulan'];
			//$_POST['tahun'] = $_POST['tahun'];
			//$_POST['nip'] = $_SESSION['sesi_nip'];
			//$_POST['skpd'] = $idskpd;	

			$res = $this->db->query("SELECT skpd,singkat,kode FROM skpd WHERE id = '".$this->db->esc($idskpd)."'");
			list($skpd,$singkat,$kode) = $this->db->fetchRow($res);
			header("CONTENT-TYPE:application/tpb");
			header("Content-Disposition: attachment; filename=\" ".$singkat."-".$this->db->esc($_POST['tahun']).$this->db->esc($_POST['bulan']).".zip\"");

			$array_isi[] = "REPLACE INTO skpd VALUE (
								'".$this->db->esc($_POST['skpd'])."',
								'".$this->db->esc($skpd)."',
								'".$this->db->esc($singkat)."',
								'".$this->db->esc($kode)."');";

			$res = $this->db->query("SELECT * FROM pegawai WHERE skpd= '".$this->db->esc($_POST['skpd'])."'");

			while($array = $this->db->fetchRow($res)) {
				foreach($array as $v)
					$array_value[] = "'".$v."'";
				
				$values = implode(",",$array_value);
				
				$array_isi[] = "REPLACE INTO pegawai VALUE (".$values.");";
				unset($array_value);
			}

			$res = $this->db->query("SELECT * FROM setting WHERE skpd= '".$this->db->esc($_POST['skpd'])."'");

			while($array = $this->db->fetchRow($res)) {
				foreach($array as $v)
					$array_value[] = "'".$v."'";
				
				$values = implode(",",$array_value);
				
				$array_isi[] = "REPLACE INTO setting VALUE (".$values.");";
				unset($array_value);
			}

			$res = $this->db->query("SELECT * FROM rekap WHERE skpd= '".$this->db->esc($_POST['skpd'])."'");

			while($array = $this->db->fetchRow($res)) {
				foreach($array as $v)
					$array_value[] = "'".$v."'";
				
				$values = implode(",",$array_value);
				
				$array_isi[] = "REPLACE INTO rekap VALUE (".$values.");";
				unset($array_value);
			}

			$res = $this->db->query("SELECT * FROM form04 WHERE 
								skpd = '".$this->db->esc($_POST['skpd'])."' AND 
								bulan = '".$this->db->esc($_POST['bulan'])."' AND 
								tahun = '".$this->db->esc($_POST['tahun'])."'");

			while($array = $this->db->fetchRow($res)) {
				foreach($array as $v)
					$array_value[] = "'".$v."'";
				
				$values = implode(",",$array_value);
				
				$array_isi[] = "REPLACE INTO form04 VALUE (".$values.");";
				unset($array_value);
			}

			$res = $this->db->query("SELECT * FROM form05 WHERE 
								skpd = '".$this->db->esc($_POST['skpd'])."' AND 
								bulan = '".$this->db->esc($_POST['bulan'])."' AND 
								tahun = '".$this->db->esc($_POST['tahun'])."'");

			while($array = $this->db->fetchRow($res)) {
				foreach($array as $v)
					$array_value[] = "'".$v."'";
				
				$values = implode(",",$array_value);
				
				$array_isi[] = "REPLACE INTO form05 VALUE (".$values.");";
				unset($array_value);
			}

			$res = $this->db->query("SELECT * FROM setting_tpb_khusus WHERE 
								skpd = '".$this->db->esc($_POST['skpd'])."' AND 
								bulan = '".$this->db->esc($_POST['bulan'])."' AND 
								tahun = '".$this->db->esc($_POST['tahun'])."'");

			while($array = $this->db->fetchRow($res)) {
				foreach($array as $v)
					$array_value[] = "'".$v."'";
				
				$values = implode(",",$array_value);
				
				$array_isi[] = "REPLACE INTO setting_tpb_khusus VALUE (".$values.");";
				unset($array_value);
			}

			$res = $this->db->query("SELECT * FROM tpb_khusus WHERE 
								skpd = '".$this->db->esc($_POST['skpd'])."' AND 
								bulan = '".$this->db->esc($_POST['bulan'])."' AND 
								tahun = '".$this->db->esc($_POST['tahun'])."'");

			while($array = $this->db->fetchRow($res)) {
				foreach($array as $v)
					$array_value[] = "'".$v."'";
				
				$values = implode(",",$array_value);
				
				$array_isi[] = "REPLACE INTO tpb_khusus VALUE (".$values.");";
				unset($array_value);
			}
			//echo "<pre>";
			//print_r($array_isi);
			echo convert_uuencode(implode("aangcuakep",$array_isi));
		}else{
			// form eksport
			$this->template('tpbeksport','tpb');
		}		
	}

	function tpbImport($act=''){
		if($act == 'import'){			
			$this->ermsg = "<br><br>Import data telah berhasil dilakukan!<br><br>";
			$this->color = "0000FF";

			if(!empty($_FILES['file']['name'])) {
 				
				$file = $_FILES['file']['tmp_name'];
				$arfile = explode('.', $_FILES['file']['name']);
				$ext = $arfile[count($arfile)-1];

				if($ext == 'zip' ){	
					$handle = fopen($file,"r");
					$contents = fread($handle, filesize($file));
					fclose($handle);

					$contents = convert_uudecode($contents);
					//die($contents);
					$array_contents = explode("aangcuakep",$contents);
					
					$ok = true;
					$i = 0;
					foreach($array_contents as $contents){
						if ($i <> 0) {
							if($ok) {
								$terakhir = $contents;							
								$ok = $this->db->query($contents);
								
								// if($this->db->query($contents)){
								// 	$this->ermsg .=  $contents."<br>";
								// }else{
								// 	$this->ermsg .=  "<strike>".$contents."</strike><br>";
								// }
								
							}else{
								$this->ermsg =  "Proses Import data gagal.";
								$this->color = "FF0000";
							}
						}
						$i++;
					}	
				}else{
					$this->ermsg =  "File tidak valid.";	
					$this->color = "FF0000";
				}
			} else {
				$this->ermsg =  "Import data gagal dilakukan.";
				$this->color = "FF0000";
			}
			//die($this->ermsg);
			$this->template('tpbimport','tpb');
		}else{
			// form eksport
			$this->ermsg = "";
			$this->template('tpbimport','tpb');
		}	
	}


	function workDay($date) {
		$sql = "select * from presensi_harilibur where tanggal like '".date("Y-m-",$date)."'";
		$res = $this->db->query($sql);
		$liburs = array();
		while ($row = $this->db->fetchArray($res)) {
			$liburs[$row['tanggal']] = $row['keterangan'];
		}
		
		$day = 0;
		for ($i=1;$i<=date("t",$date);$i++) {
			$tgl = mktime(0,0,0,date("m",$date),$i,date("Y",$date));
			if (!array_key_exists(date("Y-m-d",$tgl), $liburs) && (date("w",$tgl)!=0) && (date("w",$tgl)!=6)) $day++;
		}
		return $day;
	}
	
	
	function pengaliDisiplin04($x) {
			if($x=="STB")
				return 100;
			else
			if($x=="KB")
				return 75;
			else
			if($x=="C")
				return 50;
			else
			if($x=="B")
				return 25;
			else 
				return 0;
	}
		
	function pengaliKinerja04($x) {
			if($x=="SB")
				return 100;
			else
			if($x=="B")
				return 75;
			else
			if($x=="C")
				return 50;
			else
			if($x=="KB")
				return 25;
			else 
				return 0;
	}	
	
	
	
}
?>