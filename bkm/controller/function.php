<?php 
	
	class index
	{

		public $table;
		public $where;
		public function Getdata()
		{
			$sql = "SELECT * from MASTERASET";
			$data = ibase_query($sql);
			return $data;
		}
		//pengambilan data field tabel
 		// $result = "SELECT * FROM BIDANG";
 		// $query = ibase_query($result);
 		// $coln = ibase_num_fields($query);
 		// for ($i=0; $i < $coln ; $i++) { 
 		// 	$col_info = ibase_field_info($query,$i);
 		// 	$fileld = $col_info['name'];
 		// 	echo " ".$fileld." ";
 		// }
		public function AUTOCODE($tabelk,$inisialk){
				$strukturk = ibase_query("SELECT * from $tabelk");
				$fieldk = ibase_field_info($strukturk,1);
				$qryk	= ibase_query("SELECT MAX(".$fieldk.") FROM ".$tabelk);
 				$rowk	= ibase_fetch_assoc($qryk); 
				if ($rowk[0]=="") {
					$angkak = 0;
				}else{
					$angkak = substr($rowk[0],strlen($inisialk));
				}
				$angkak++;
				$angkak = strval($angkak);
				$tmpk = "";
				for ($ik=1; $ik <= ($panjangk-strlen($inisialk)-strlen($angkak)) ; $ik++) { 
					$tmpk = $tmpk."0";
				}return $inisialk.$tmpk.$angkak;
		}
		public function GETDATAOTOMATIS($table,$where)
		
		{
				$y = "";
				if(sizeof($where) != 0){
					$x = "";
					foreach ($where as $key => $value) {
						$x .= " ".$key." = '".$value."' AND";
					}
					$y = "where ".substr($x, 0, strlen($x)-3);
				}
				$sql = "SELECT * from ".$table." ".$y."  ";
				$data = ibase_query($sql);
				return $data;

		}
		// insert data bidang
		public function INSERTDATABIDANG($field1,$field2)
		{
			$QUERYbidang = "INSERT INTO BIDANG 
							(KODEBIDANG,URAI) 
							VALUES ('".$field1."','".$field2."') ";
			
			$insertbidang = ibase_query($QUERYbidang);
			return $insertbidang;
		}
		public function DELETEDATA($tables,$wheres)
		{
			$z ="";
			if ($wheres != 0) {
				$v="";
				foreach ($wheres as $keys => $values) {
					$v .= "  ".$keys." = '".$values."'  ";
				}
				$z ="WHERE " .$v; 
			}
			$QUERYdelete = "DELETE FROM ".$tables." ".$z."  ";
			//die();
			$hapusdata = ibase_query($QUERYdelete);
		}
}
	$mainindex = new index();

 ?>