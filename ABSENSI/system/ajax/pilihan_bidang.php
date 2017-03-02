<?php
	include("../common/ConfigClass.php");
	include("../data/MysqlClass.php");
	$db  = new MysqlClass;
	$db->connect();

	function optBidang($skpd,$val){
		global $db;

		$sql = "select * from bidang where id_skpd='".$skpd."'";
		$res =$db->query($sql);
		$option = '<option value="">- Pilih Bidang -</option>';
		while($data = $db->fetchArray($res)){
			$sel = ($data['nama_bidang'] == $val)?'selected':'';
			$option .= '<option value="'.$data['id'].'" '.$sel.'>'.$data['nama_bidang'].'</option>';
		}
		return $option;
	}

	echo optBidang($_GET['kodeskpd'], null);
?>