<?php
class upload extends Controller
{

	function __construct(){
		parent::__construct();
		$this->init();	
	}
	
	function init(){		
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'data':
				$uploaddir = 'data/';
				$uploadfile = $uploaddir . basename($_FILES['absensi']['name']);
				if (move_uploaded_file($_FILES['absensi']['tmp_name'], $uploadfile)) {
					$lines = file($uploadfile);
					foreach ($lines as $line_num => $line) {
						list($dwEnrollNumber,$dwTimeStamp,$dwMachineNumber,$dwInOutMode,$dwVerifyMode,$dwWorkCode)= explode("\t",$line);	
						$dwEnrollNumber = trim($dwEnrollNumber);
						list($dwDate,$dwTime) = explode(" ",$dwTimeStamp);
						list($dwYear,$dwMonth,$dwDay) = explode("-",$dwDate);
						list($dwHour,$dwMinute,$dwSecond) = explode(":",$dwTime);
						$dwEnrollNumber = $this->db->esc($dwEnrollNumber);
						$dwVerifyMode = $this->db->esc($dwVerifyMode);
						$dwInOutMode = $this->db->esc($dwInOutMode);
						$dwYear = $this->db->esc($dwYear);
						$dwMonth = $this->db->esc($dwMonth);
						$dwDay = $this->db->esc($dwDay);
						$dwHour = $this->db->esc($dwHour);
						$dwMinute = $this->db->esc($dwMinute);
						$dwDate = $this->db->esc($dwDate);
						$dwTime = $this->db->esc($dwTime);
						
						$sql = "replace into generallogdata(dwMachineNumber,dwEnrollNumber,dwVerifyMode,dwInOutMode,dwYear,dwMonth,dwDay,dwHour,dwMinute,dwDate,dwTime) values ".
							   "($dwMachineNumber, $dwEnrollNumber, $dwVerifyMode, $dwInOutMode,$dwYear,$dwMonth,$dwDay,$dwHour,$dwMinute,'$dwDate','$dwTime'); \n";
						$this->db->query($sql);
					}
					echo 'sukses';
				} 
			break;
			case 'datausb':
				$this->ceklogin();
				$uploaddir = 'data/';
				$ext = pathinfo($_FILES['datausb']['name'], PATHINFO_EXTENSION);
				if($ext <> 'dat'){
					echo '<script>alert("File yang anda upload salah");history.back(-1)</script>';
					die();
				}
				$namafile = ''.$this->user['id_user'].'-'.date('dmyhis').'-'.basename($_FILES['datausb']['name']).'';
				$uploadfile = $uploaddir . $namafile;

				if (move_uploaded_file($_FILES['datausb']['tmp_name'], $uploadfile)) {
					$lines = file($uploadfile);
					foreach ($lines as $line_num => $line) {
						list($dwEnrollNumber,$dwTimeStamp,$dwMachineNumber,$dwInOutMode,$dwVerifyMode,$dwWorkCode)= explode("\t",$line);	
						$dwEnrollNumber = trim($dwEnrollNumber);
						list($dwDate,$dwTime) = explode(" ",$dwTimeStamp);
						list($dwYear,$dwMonth,$dwDay) = explode("-",$dwDate);
						list($dwHour,$dwMinute,$dwSecond) = explode(":",$dwTime);
						$dwEnrollNumber = $this->db->esc($dwEnrollNumber);
						$dwVerifyMode = $this->db->esc($dwVerifyMode);
						$dwInOutMode = $this->db->esc($dwInOutMode);
						$dwYear = $this->db->esc($dwYear);
						$dwMonth = $this->db->esc($dwMonth);
						$dwDay = $this->db->esc($dwDay);
						$dwHour = $this->db->esc($dwHour);
						$dwMinute = $this->db->esc($dwMinute);
						$dwDate = $this->db->esc($dwDate);
						$dwTime = $this->db->esc($dwTime);
						if($dwMachineNumber <> $_POST['idMesin']){
							if(file_exists($uploadfile)){
							 	unlink($uploadfile);
							}
							echo '<script>alert("File yang anda upload salah");history.back(-1)</script>';
							die();
						}
						$sql = "replace into generallogdata(dwMachineNumber,dwEnrollNumber,dwVerifyMode,dwInOutMode,dwYear,dwMonth,dwDay,dwHour,dwMinute,dwDate,dwTime) values ".
							   "(".$this->db->esc($_POST['idMesin']).", $dwEnrollNumber, $dwVerifyMode, $dwInOutMode,$dwYear,$dwMonth,$dwDay,$dwHour,$dwMinute,'$dwDate','$dwTime'); \n";
						
						$this->db->query($sql);
					}
					echo '<script>alert("Upload Data Berhasil");</script>';
				}
				echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=upload'>"; 
			break;
			case 'config' :
				header("Content-Disposition: attachment; filename=FPMachine.ini");    
				header("Content-Type: application/force-download");
				header("Content-Type: application/octet-stream");
				header("Content-Type: application/download");
				header("Content-Description: File Transfer");
				flush(); // this doesn't really matter.			
				$res = $this->db->query('select dwMachineNumber,dwIPAddress,dwPort,dwPassword,dwTitle from machine where dwEnable=-1');
				while($data = $this->db->fetchArray($res)){
					echo "[DEVICE_".$data['dwMachineNumber']."]\r\n";
					echo "TITLE=".$data['dwTitle']."\r\n";
					echo "IP=".$data['dwIPAddress']."\r\n";
					echo "PORT=".$data['dwPort']."\r\n";
					echo "PASS=".$data['dwPassword']."\r\n";
					echo "\r\n\r\n";
				
				}
			break;
			case 'upload_file':
				$this->ceklogin();
				
				$ext = pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
				if($ext <> 'dat'){
					echo "error";
					die();
				}
				$uploaddir = 'tmp/';
				$namafile = ''.$this->user['id_user'].'-'.basename($_FILES['uploadfile']['name']).'';
				$uploadfile = $uploaddir . $namafile;
				
				if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) { 
					echo "success"; 	
				} else {   
					echo "error"; 
				} 
			break;
			case 'prosesdata':
				$sukses = true;
				$uploadfile = 'tmp/'.$_POST['file'].'';
				$handle = fopen($uploadfile, "r") or die("gagal handle file");
				try
  				{
					if ($handle) {
							
							$shardSize = 500;
							$k = 0;
						    while (!feof($handle)) {	
						        $buffer = fgets($handle, 4096);
						        list($dwEnrollNumber,$dwTimeStamp,$dwMachineNumber,$dwInOutMode,$dwVerifyMode,$dwWorkCode)= explode("\t",$buffer);	
								$dwEnrollNumber = trim($dwEnrollNumber);
								list($dwDate,$dwTime) = explode(" ",$dwTimeStamp);
								list($dwYear,$dwMonth,$dwDay) = explode("-",$dwDate);
								list($dwHour,$dwMinute,$dwSecond) = explode(":",$dwTime);
								
								$dwEnrollNumber = $this->db->esc($dwEnrollNumber);
								$dwVerifyMode = $this->db->esc($dwVerifyMode);
								$dwInOutMode = $this->db->esc($dwInOutMode);
								$dwYear = $this->db->esc($dwYear);
								$dwMonth = $this->db->esc($dwMonth);
								$dwDay = $this->db->esc($dwDay);
								$dwHour = $this->db->esc($dwHour);
								$dwMinute = $this->db->esc($dwMinute);
								$dwDate = $this->db->esc($dwDate);
								$dwTime = $this->db->esc($dwTime);

								if($dwMachineNumber <> ''){
									if($dwMachineNumber <> $_POST['idMesin']){
										if(file_exists($uploadfile)){
										 	unlink($uploadfile)or die('gagal unlink');
										}
										echo 'fail';
										die();
									}
									
									if ($k % $shardSize == 0) {
        								if ($k != 0) { // mulai loop kedua (501) execute
        									//echo("exec part $k <br> $sql");
											if(!$this->db->query($sql)){
												$sukses = false;
												//echo "$k [gagal] >>> $sql <br>";
											}else{
												//echo "$k [success] >>> $sql <br>";
											}
										} 

										$sql  = "replace into generallogdata(dwMachineNumber,dwEnrollNumber,dwVerifyMode,dwInOutMode,dwYear,dwMonth,dwDay,dwHour,dwMinute,dwDate,dwTime) values ";
									}

									$sql .=	   (($k % $shardSize == 0) ? '' : ', ') ."(".$this->db->esc($_POST['idMesin']).", $dwEnrollNumber, $dwVerifyMode, $dwInOutMode,$dwYear,$dwMonth,$dwDay,$dwHour,$dwMinute,'$dwDate','$dwTime')";

									$k++;

								} // machine number	

						}// en loop

					} // end if open

				  } // end try

				//catch exception
				catch(Exception $e)
				  {	
				  echo 'Message: ' .$e->getMessage()." memory : ".memory_get_usage();
				  }
		

				if($sukses){
					echo 'success';
					$exp = explode('-', $_POST['file']);
					
					$filesave = 'data/'.date('dmyhis').'-'.$_POST['file'].'';
					if(file_exists($uploadfile)){
					 	copy($uploadfile, $filesave); 
					}
				}else{
					echo 'error';
				}

				if(file_exists($uploadfile)){
				 	unlink($uploadfile);
				}
				
			break;
			default:
				$this->template('pmanual_formupload','admin');
			break;	
		}
	}
	function optSKPD($val=''){
		if($val <> ''){
			$sql = "select * from skpd where id='".$val."'";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['skpd'];
			$option .= '<select id="optskpd" style="display:none;"><option value="'.$data['id'].'"/></select>';
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
	
	
	
	
}
?>