<?php
class CounterClass{
	function CounterClass(){
		$this->db = new DatabaseClass;
		$this->cnf = new ConfigClass;		
		if(!$_SESSION['stat']){
			$this->sql = "select * from stat where postdate = DATE_FORMAT(now(),'%Y-%m-%d')";
			$res = $this->db->query($this->sql);
			if($this->db->numRows($res) == 0){
				//die('kosong');
				$this->sql = "insert into stat(postdate,hit) values(now(),'1')";
				$this->db->query($this->sql);
			}else{
				//die('satu');
				$this->sql = "update stat set hit=hit+1 where postdate = DATE_FORMAT(now(),'%Y-%m-%d')";
				$this->db->query($this->sql);
			}			
		$_SESSION['stat'] = 'OK';
		}
		$this->lvisitor = ($_SESSION[lang]=='en')?'visitor':'pengunjung';	
			
	}	
	
	function countToday(){
		$this->sql = "select sum(hit) as jumlah from stat where postdate =  DATE_FORMAT(now(),'%Y-%m-%d')";
		$res = $this->db->query($this->sql);
		$data = $this->db->fetchArray($res);
		return $data['jumlah'].' &nbsp; &nbsp; '.$this->lvisitor; 
	}
	
	function countMonth(){
		$this->sql = "select sum(hit) as jumlah from stat where DATE_FORMAT(postdate,'%Y-%m')=  DATE_FORMAT(now(),'%Y-%m')";
		$res = $this->db->query($this->sql);
		$data = $this->db->fetchArray($res);
		return $data['jumlah'].' &nbsp; &nbsp; '.$this->lvisitor;  
	}
	
	function countYear(){
		$this->sql = "select sum(hit) as jumlah from stat where DATE_FORMAT(postdate,'%Y')=  DATE_FORMAT(now(),'%Y')";
		$res = $this->db->query($this->sql);
		$data = $this->db->fetchArray($res);
		return $data['jumlah'].' &nbsp; &nbsp; '.$this->lvisitor;  
	}
	
	function total(){
		$this->sql = "select sum(hit) as jumlah from stat ";
		$res = $this->db->query($this->sql);
		$data = $this->db->fetchArray($res);
		return $data['jumlah'].' &nbsp; &nbsp; '.$this->lvisitor;  
	}
	
	function display(){
		if($_SESSION[lang]=='en'){
			$display = "<table width='90%' align=center>
						<tr><td width=100px>Today </td><td>:</td><td>".$this->countToday()."</td></tr>
						<tr><td width=100px>Mounth </td><td>:</td><td>".$this->countMonth()."</td></tr>
						<tr><td width=100px>Years </td><td>:</td><td>".$this->countYear()."</td></tr>
						<tr><td width=100px>Total </td><td>:</td><td>".$this->total()."</td></tr>
					   </table>";
		}else{
			$display = "<table width='90%' align=center>
						<tr><td height:40px width=100px>Hari ini</td><td width=15Spx>:</td><td>".$this->countToday()."</td></tr>
						<tr><td>Bulan ini </td><td>:</td><td>".$this->countMonth()."</td></tr>
						<tr><td>Tahun ini </td><td>:</td><td>".$this->countYear()."</td></tr>
						<tr><td>Total </td><td>:</td><td>".$this->total()."</td></tr>
					   </table>";
		}
		return $display;
	}
	
	
	
	
}
?>