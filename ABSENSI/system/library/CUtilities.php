<?php
class CUtilities {
  	var $longMonth = array("---------", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
  	var $shortMonth = array("---", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nop", "Des");
	var $dtNow = NULL;
	
  	function roundup($value, $konter) {
		$bagi=intval($value/$konter);
		$sisa=$value%$konter;
		if($sisa>0){
			$tambah=1;	
		} else {  
			$tambah=0;	
		}
		$awal=$bagi+$tambah;
		return ($awal);
	}
	
	function cetak($arr) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
		
	function triwulan($bulan){
		switch($bulan){
			case 1:
			case 2:
			case 3:			
				$triwul="I";
				break;
			case 4:
			case 5:
			case 6:			
				$triwul="II";
				break;
			case 7:
			case 8:
			case 9:			
				$triwul="III";			
				break;
			case 10:
			case 11:
			case 12:			
				$triwul="IV";
				break;			
		}
		return $triwul;
	}
		
		
	function duit($x) {
		return number_format($x,0,",",".");
	}
		
	function duit_rp($x) {
		return "Rp. ".number_format($x,0,",",".");
	}
	
	function terbilang($angka) {
		if($angka == 0)	{
			return "nol";
			exit();
		}
		
		$bilang[1] = "satu ";
		$bilang[2] = "dua ";
		$bilang[3] = "tiga ";
		$bilang[4] = "empat ";
		$bilang[5] = "lima ";
		$bilang[6] = "enam ";
		$bilang[7] = "tujuh ";
		$bilang[8] = "delapan ";
		$bilang[9] = "sembilan ";
		
		$kecil[1] = "";
		$kecil[2] = "puluh ";
		$kecil[3] = "ratus ";
		
		$besar[1] = "";
		$besar[2] = "ribu ";
		$besar[3] = "juta ";
		$besar[4] = "milyar ";
		$besar[5] = "triliyun ";
		
		$angka = number_format($angka,2,',','.');
		$angka2 = explode(",",$angka);
		$angka3 = explode(".",$angka2[0]);
			
		$n = count($angka3);
		if($n <= 5) {
			foreach($angka3 as $key => $angka) {
				if(strlen($angka)%3 == 2)
					$angka = "0".$angka;
				if(strlen($angka)%3 == 1)
					$angka = "00".$angka;
				
				$bilangan = str_split($angka,1);
	
				foreach($bilangan as $key2 => $bil) {	
					if(($bil == 1) && ($key2 != 2)) {
						if(($key2 == 1) && ($bilangan[2] != 1 && $bilangan[2] != 0))
							$belas = $bilang[$bilangan[2]];
						else
							$hasil .= "se";
					} else {
						if((!isset($belas)) && ($key2 != 2 || $bilangan[2] != 1 || $bilangan[1] != 1)) {
							if($key2 == 2 && ($n-$key) == 2 && $bilangan[0] == 0 && $bilangan[1] == 0 && $bilangan[2] == 1)
								$hasil .= "se";
							else
								@$hasil .= $bilang[$bil];
						}
					}
						
					if($key2 == 1 && $bilangan[1] == 1 && $bilangan[2] != 0) {
						$hasil .= $belas."belas ";
					} else {
						if($bil != 0)
							$hasil .= $kecil[3-$key2];
						if($bil != 0)
							$ada = true;
					}
				}
				
				if($ada)
					$hasil .= $besar[($n-$key)];
				
				$ada = false;
				
				unset($belas);
			}
		}
		return $hasil." rupiah";
	}
		
	function select_huruf($name) {
		$array = array("STB","KB","C","B","SB");
		?>
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
		<?php
		foreach($array as $v) {
		?>
			<option value="<?php echo $v; ?>" <?php if($v == $_POST[$name]) echo "selected"; ?>><?php echo $v; ?></option>
		<?php
		}
		?>
		</select>
		<?php
	}
		
	function select_poin($name) {
		$array = array("1","2","3","4","5");
		?>
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" onChange="proses_<?php echo $name; ?>()">
			<option value="0">-</option>
		<?php
		foreach($array as $v) {
		?>
			<option value="<?php echo $v; ?>" <?php if($v == $_POST[$name]) echo "selected"; ?>><?php echo $v; ?></option>
		<?php
		}
		?>
		</select>
		<?php
	}
		
	function pajak($status, $golongan) {
		if($status == "pns")
			if(eregi("IV",$golongan) || eregi("III",$golongan))
				return "0.15";
			else
				return "0";
		else
			return "0.05";
	}
  
  	function showErrorMsg($msg)
  	{
		$msg_id = strlen($msg);
		echo '<div id="msg_'.$msg_id.'" class="msg">'.
			'<div class="error-top">'.
			'<table border="0" cellpadding="0" cellspacing="0" width="100%">'.
			'<tr valign="top">'.
			'<td width="70" align="center"><a href="javascript:void(0);" onClick="document.getElementById(\'msg_'.$msg_id.'\').innerHTML = \'\';"><img src="images/error-icon.png" width="32" height="32"></a></td>'.
			'<td>'.$msg.'</td>'.
			'</tr>'.
			'</table>'.
			'</div>'.
			'<div class="error-bottom"></div>'.
			'</div>';
  	}
  
  	function showInfoMsg($msg)
  	{
		echo '<div class="msg">'.
			'<div class="info-top">'.
			'<table border="0" cellpadding="0" cellspacing="0" width="100%">'.
			'<tr valign="top">'.
			'<td width="70" align="center"><img src="images/info-icon.png" width="32" height="32"></td>'.
			'<td>'.$msg.'</td>'.
			'</tr>'.
			'</table>'.
			'</div>'.
			'<div class="info-bottom"></div>'.
			'</div>';
  	}
  
  	function dtDbToLongDt($dtDb)
  	{
    	if ($dtDb == '')
      		$retVal = '';
		else
		{
	  		list($dateDb, $timeDb) = explode(" ", $dtDb);
	  		list($year, $month, $day) = explode("-", $dateDb);
	  		$retVal = sprintf("%02d %s %04d, %s", (int)$day, $this->longMonth[(int)$month], (int)$year, $timeDb);
		}
		return $retVal;
  	}
  
  	function dtDbToShortDt($dtDb)
  	{
    	if ($dtDb == '')
      		$retVal = '';
		else
		{
	  		list($dateDb, $timeDb) = explode(" ", $dtDb);
	  		list($year, $month, $day) = explode("-", $dateDb);
	  		$retVal = sprintf("%02d-%s-%04d, %s", (int)$day, $this->shortMonth[(int)$month], (int)$year, $timeDb);
		}
		return $retVal;
  	}
  
 	function getDbDateTime()
  	{
		return sprintf('%04d-%02d-%02d %02d:%02d:%02d', $this->dtNow['year'], $this->dtNow['mon'], $this->dtNow['mday'], 
				   	$this->dtNow['hours'], $this->dtNow['minutes'], $this->dtNow['seconds']);
  	}
	
	function getDbDate()
  	{
		return sprintf('%04d-%02d-%02d', $this->dtNow['year'], $this->dtNow['mon'], $this->dtNow['mday']);
  	}
  
  	function getDateTime()
  	{
		return $this->dtNow;
  	}
	
	function FormatDateDB($Tahun, $Bulan, $Tanggal)
	{
		return sprintf('%04d-%02d-%02d',(int)$Tahun,(int)$Bulan,(int)$Tanggal);
	}
  
  	function dayOfMonth($year, $month)
  	{
		$retVal = 0;
		switch ($month)
		{
	  		case 1  : $retVal = 31; break;
	  		case 2  : 
	  		{
				$remainder = $year % 4;
				if ($remainder == 0)
		  			$retVal = 29;
				else
		  			$retVal = 28;
				break;
	  		}
	  		case 3  : $retVal = 31; break;
	  		case 4  : $retVal = 30; break;
	  		case 5  : $retVal = 31; break;
		  	case 6  : $retVal = 30; break;
		  	case 7  : $retVal = 31; break;
		  	case 8  : $retVal = 31; break;
			case 9  : $retVal = 30; break;
			case 10 : $retVal = 31; break;
			case 11 : $retVal = 30; break;
		  	case 12 : $retVal = 31; break;
		  	default : $retVal = 0;
		}
		return $retVal;
  	}
  
  	function dateToInt($year, $month, $day)
  	{
		$remainder = $year % 4;
		$result = (int)floor($year / 4);
	
		$retVal = ($result * 3 * 365) + ($result * 366) + ($remainder * 365);
	
		if ($month > 1)
			for ($i = 1; $i < $month; $i++)
	  			$retVal += $this->dayOfMonth($year, $month);
	
		$retVal += $day;
	
		return $retVal;
  	}
  
  	function isLocalhost()
  	{
		if ($_SERVER['SERVER_NAME'] == 'localhost')
	  		return true;
		else
	  		return false;
  	}
  
  	function getDayOptions($day)
  	{
		$html = '';
		$html .= '<option value="0">--</option>';
    	for ($i = 1; $i <= 31; $i++)
			if ($i == $day)
     			 $html .= '<option value="'.$i.'" selected>'.sprintf("%02d", $i).'</option>';
			else
      			$html .= '<option value="'.$i.'">'.sprintf("%02d", $i).'</option>';
	 
		return $html;
  	}

  	function getMonthOptions($month)
  	{
		$html = '';
		for ($i = 0; $i <= 12; $i++)
			if ($i == $month)
	  			$html .= '<option value="'.$i.'" selected>'.$this->longMonth[$i].'</option>';
			else
	  			$html .= '<option value="'.$i.'">'.$this->longMonth[$i].'</option>';
		return $html;
  	}
  
  	function getYearOptions($year, $minYear = 1900)
  	{
		$html = '';
		$html .= '<option value="0">-----</option>';
		$maxYear = $this->dtNow['year'];
		if ($maxYear < 2009)
	  		$maxYear = 2009;
		for ($i = $maxYear; $i >= $minYear; $i--)
			if ($i == $year)
	  			$html .= '<option value="'.$i.'" selected>'.sprintf('%04d', $i).'</option>';
			else
	 			$html .= '<option value="'.$i.'">'.sprintf('%04d', $i).'</option>';
		return $html;
  	}
	
	function checkDate($day,$month,$year)
	{
		$check = checkdate($month,$day,$year);
		return $check; 
	}		
	
	function formatNIP($nip) {
		$nip = trim($nip);
		if (strlen($nip)==18) {
		   return substr($nip,0,8)." ".substr($nip,8,6)." ".substr($nip,14,1)." ".substr($nip,15,3); 
		} else if (strlen($nip)==9) {
		   return substr($nip,0,3)." ".substr($nip,3,3)." ".substr($nip,5,3);
		} else return $nip;
	}
	
	
	function statusAbsen($masuk,$keluar,$tanggal,$arrJamkerja) {
		$currDay = $currDay = strtotime("2013-06-10");
		$masuk = strtotime($masuk,$currDay);
		$keluar = strtotime($keluar,$currDay);
		
		$jamKerja = $arrJamkerja[date("N",$currDay)];;
		$kerja_masuk = strtotime($jamKerja['workStart'],$currDay) + (strtotime($jamKerja['tolerance'],$currDay)-$currDay);
		$kerja_keluar =  strtotime($jamKerja['workEnd'],$currDay) - (strtotime($jamKerja['tolerance'],$currDay)-$currDay);
		
		$stat="M";	
		if ($masuk==$keluar) {
			if (date("H:i:s",$masuk)=="00:00:00") $stat="TK";
			else $stat="AS";
		} else {
			if (($kerja_masuk-$masuk)<0) {
				$stat="TL";
			}		
			if (($keluar-$kerja_keluar)<0) {
				if ($stat=="TL") $stat="TP";
				else $stat="PL";
			}
		}
		return $stat;
	}
	
}
?>