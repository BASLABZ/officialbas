<?php
class login extends Controller
{
	function __construct(){
		parent::__construct();
		$this->library('CUtilities');
		$this->util = new CUtilities;
		$this->init();
	}	
	function init(){
		$mode = isset($_GET['mode']);
		switch($mode){
			case 'login':
				$this->ceklogin();
			break;
			case 'out':
				$this->logout();
			break;
			default:
				$this->index();
			break;
		}
			
	}
	function index(){

		if($this->auth->isAuth() == '1'){
			header('Location: '.$this->cnf->ROOTDIR.'?pg=home');
		}
		$this->view('login');	
	}
	function ceklogin(){
		if($this->auth->login($_POST['username'],$_POST['hash'])){
			echo '100';
			$datausr = $this->auth->getDetail();
			$this->writeLogs($datausr['id_user'],'Login');
		}else{				
			echo "Username dan Password tidak sesuai";
		}
	}
	function logout(){
		$this->writeLogs($this->user['id_user'],'Logout');
		$this->auth->logout();
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."'></meta>";	
	}
	function getPresensiData(){
		$prevmonth = date("m",strtotime("-1 month"));
		$year  = date("Y");

		$sql = "select *,if(persen <> '',persen,'0') as jpersen,s.skpd as namaskpd 
				from skpd s left join 
					(select skpd,bulan,tahun,(sum(jml_masuk) / (jml_harikerja * count(nip)) * 100) as persen 
						from presensi_rekap group by tahun,skpd) as j 
				on (s.id=j.skpd and j.tahun='".$year."')
				
				order by persen desc";
		
		$res = $this->db->query($sql);
		$no = 1;
		while ($data = $this->db->fetchArray($res)) {
			echo  '<tr class="hov transbg">
							<td class="td1">'.$no.'</td>
							<td class="td2">'.$data['namaskpd'].'</td>
							<td class="td1">'.round($data['jpersen'],2).' %</td>
				   </tr>';
			$no++;
		}

	}
	function getGrafikData($val){
		$year  = date("Y");

		$sql = "select *,if(persen <> '',persen,'0') as jpersen,s.skpd as namaskpd 
				from skpd s left join 
					(select skpd,bulan,tahun,(sum(jml_masuk) / (jml_harikerja * count(nip)) * 100) as persen 
						from presensi_rekap group by tahun,skpd) as j 
				on (s.id=j.skpd and j.tahun='".$year."')
				
				order by persen desc limit 0,10";
				
		$res = $this->db->query($sql);
		$no = 0;
		while ($data = $this->db->fetchArray($res)){
		
			$result['label'] .= "'".$data['singkat']."',";
			$result['data'] .= '{y: '.round($data['persen']).', color: colors['.$no.']},';
			$no++;
		}
		echo $result[$val];
	}
	function writeLogs($id,$type){
		//keterangan
		$ip = substr($_SERVER['REMOTE_ADDR'],0,255);
		$user_agent = substr($_SERVER['HTTP_USER_AGENT'],0,255);
		$now = date("Y-m-d H:i:s");
		
		$sql = "insert into log (log_ip,log_user,log_waktu,log_user_agent,jenis) 
				values('".$ip."','".$id."','".$now."','".$user_agent."','".$type."')";
		$this->db->query($sql);
		
	}
}
?>