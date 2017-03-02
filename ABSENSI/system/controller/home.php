<?php
class home extends Controller
{
	function __construct(){
		parent::__construct();
		$this->ceklogin();
		$this->init();
	}
	function init(){
		$mode = $_GET['mode'];
		switch($mode){
			case 'ambildata':
				$this->ambildata();
			break;
			default:
				$this->template('home','admin');
			break;
		}
		
	}
	function optTahun($val){
		$option = '<select id="tahun" name="tahun" onChange="ubahTahun()">';
		for($i=date("Y");$i>=2010;$i--) {
			$sel = ($i == $val)?'selected':'';
			$option .= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
		}
		$option .= '</select>';
		return $option;	
	}
	function getGrafikData(){
		$tahun = date('Y');
		$sql = "SELECT bulan, tahun, (
				sum( jml_masuk ) / (
				SELECT count( nip )
				FROM pegawai )
				) / jml_harikerja *100 AS presentase
				FROM presensi_rekap p
				WHERE tahun = '".$tahun."'
				GROUP BY bulan";
		$res = $this->db->query($sql);
		$arrdata = array();
		while ($data = $this->db->fetchArray($res)) {
			$arrdata[$data['bulan']] = round($data['presentase'],2);
		}
		for ($i=1; $i <= 12; $i++) { 
			$dt = 'null';
			if(array_key_exists($i, $arrdata)){
				$dt = ''.$arrdata[$i].'';
			}
			$datagrafik .= $dt.',';
		}
		return substr($datagrafik, 0,strlen($datagrafik)-1);
	}
	function getLogdata(){
		$this->library('date');
		$dt = new DateClass;
		$res = $this->db->query("select * from log where log_user = '".$this->user['id_user']."' order by log_id desc limit 5");
		echo '<table>';
		while ($data = $this->db->fetchArray($res)) {
			echo "<tr><td>".$dt->indonesian_date($data['log_waktu'])."</td><td> - <b>".$data['jenis']."</b> </td></tr>";
		}
		echo '</table>';

	}
	function ambildata(){
		$tahun = $_POST['tahun'];
		$sql = "SELECT bulan, tahun, (
				sum( jml_masuk ) / (
				SELECT count( nip )
				FROM pegawai )
				) / jml_harikerja *100 AS presentase
				FROM presensi_rekap p
				WHERE tahun = '".$tahun."'
				GROUP BY bulan";
		$res = $this->db->query($sql);
		$arrdata = array();
		$datagrafik = array();
		while ($data = $this->db->fetchArray($res)) {
			$arrdata[$data['bulan']] = round($data['presentase'],2);
		}
		for ($i=1; $i <= 12; $i++) { 
			$dt = null;
			if(array_key_exists($i, $arrdata)){
				$dt = $arrdata[$i];
			}
			array_push($datagrafik, $dt);
		}
		echo json_encode($datagrafik);
	}
}
?>