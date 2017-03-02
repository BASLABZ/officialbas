<?php 
		/**
		* 
		*/
		class fungsi
		{
			public $id;
			public $kode;
			public $sql;
			private function kode()
			{
				 $kode1 = 1234576876;
				
				 return $kode1;
			}
			public function kodepu()
			{
				$kode = $this->kode();
				return $kode;
			}
			public function view($table,$where)
			{

				//echo sizeof($where);
				//die();
				$y = "";
				if(sizeof($where) != 0){
					$x = "";
					foreach ($where as $key => $value) {
						$x .= " ".$key." = '".$value."' AND";
					}
					$y = "where ".substr($x, 0, strlen($x)-3);
				}
				$sql = "SELECT * from ".$table." ".$y."  ";
				 //die($sql);
				$data = ibase_query($sql);

				return $data;

			}
		}
		$fungsi_si = new fungsi();

 ?>