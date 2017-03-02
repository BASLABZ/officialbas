<?php
class DateClass{
		#edit by sulis
		public static $arMon = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		public static $hari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
			
		function IndonesianMonth($intMon){
			$intMon = (int) $intMon; 
			return self::$arMon[$intMon];
		}
		
		function IndonesianDay($intMon){
			return self::$hari[$intMon];
		}
		
				
		function IndonesianDate($sqldate){	
			$intBln=substr($sqldate,5,2);	
			$bln = $this->IndonesianMonth($intBln);	
			
			return substr($sqldate,8,2).' '.$bln.' '.substr($sqldate,0,4);
		}
		
		function IndonesianDatetime($sqldate){	
			$intBln=substr($sqldate,5,2);	
			$bln = $this->IndonesianMonth($intBln);	
			
			return substr($sqldate,8,2).' '.$bln.' '.substr($sqldate,0,4).' '.substr($sqldate,11);
		}
		
		function hariini(){		
			return $this->IndonesianDay(@date("w")-1).', '.$this->IndonesianDate(@date("Y-m-d"));
		}
		
		
		function cekIndonesianMonth($matches)
		{
			$bln = array_search($matches[2],self::$arMon);
			if ($bln>0) return $matches[3].'-'.str_pad($bln,2,'0',STR_PAD_LEFT).'-'.($matches[1]);
		}
		
		function SqlDate($indonesianDate) {
			return preg_replace_callback("|(\d{2}) ([[:alpha:]]+) (\d{4})|",array($this,"cekIndonesianMonth"),$indonesianDate);		
		}
		
}
?>