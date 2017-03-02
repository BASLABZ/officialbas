<?php
class DateClass{
		function IndonesianMonth($intMon){
			$intMon = (int) $intMon; 
			$arMon = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
				return $arMon[$intMon];
		}
		
		function IndonesianDay($intMon){
			$hari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
			return $hari[$intMon];
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
			return "".$this->IndonesianDay(@date("w"))." ".$this->IndonesianDate(@date("Y-m-d"))."";
		}
		function indonesian_date($timestamp = '', $date_format = 'l, j F Y  H:i', $suffix = '') {
			if (trim ($timestamp) == '')
			{
					$timestamp = time ();
			}
			elseif (!ctype_digit ($timestamp))
			{
				$timestamp = strtotime ($timestamp);
			}
			# remove S (st,nd,rd,th) there are no such things in indonesia :p
			$date_format = preg_replace ("/S/", "", $date_format);
			$pattern = array (
				'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
				'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
				'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
				'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
				'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
				'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
				'/April/','/June/','/July/','/August/','/September/','/October/',
				'/November/','/December/',
			);
			$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
				'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
				'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
				'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
				'Oktober','November','Desember',
			); 
			$date = date ($date_format, $timestamp);
			$date = preg_replace ($pattern, $replace, $date);
			$date = "{$date} {$suffix}";
			return $date;
		} 
		
		function jumlah_hari($thn,$bln){ 
			$bulan[1]='31'; 
			$bulan[2]='28'; 
			$bulan[3]='31'; 
			$bulan[4]='30'; 
			$bulan[5]='31'; 
			$bulan[6]='30'; 
			$bulan[7]='31'; 
			$bulan[8]='31'; 
			$bulan[9]='30'; 
			$bulan[10]='31'; 
			$bulan[11]='30'; 
			$bulan[12]='31'; 
			if ($thn%4==0){ 
				$bulan[02]=29; 
			} 
			return $bulan[$bln]; 
		} 
		function date_to_day($date){
			$timestamp = strtotime($date);
			$day = date('N', $timestamp);
			$hari = array('','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
			return $hari[$day];
		}
}
?>