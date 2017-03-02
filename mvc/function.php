<?php 
	/**
	* fungsi tampil data
	*/
	class home 
	{
		public function GetData()
		{
			$y="";// untuk mendapat nilai dari view
			if (sizeof($where !=0)) {
				$x="";
				foreach ($where as $key => $value) {
				$x = " ".$key." = '".$value."'AND";
				}
						$y = "WHERE ".substr($x, 0, strlen($x)-3);
			
			}
			$sql1 = "SELECT * from ".$table." ".$y."  ";
			//die($sql1);
			$data1 = ibase_query($sql1);
		
			
			return $data1;
		}
		
	}
	$index = new home();
 ?>