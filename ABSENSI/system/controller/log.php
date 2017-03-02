<?php

class log extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->ceklogin();
		$this->library('date');
		$this->dt = new DateClass;
		$this->library('paginator');
		$this->page = new Paginator();
		$this->init();
	}
	function init(){
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'user':
				$this->log_user();
			break;
			default:
				$this->log_absensi();
			break;
		}
	}
	function log_user(){
		
		$sql = "select * from log l join pengguna p on (l.log_user=p.id_user) 
				order by log_id desc";
		
		$this->page->items_total = $this->db->numRows($this->db->query($sql));
		$this->page->mid_range = 3;
		$this->page->paginate();
		
		$this->sql = "".$sql." ".$this->page->limit."";
		
		$this->page->row_per_page = $this->db->numRows($this->db->query($this->sql));
		$this->res = $this->db->query($this->sql);
		$this->page->row_per_page = $this->db->numRows($this->res);

		
		$this->template('log_user_list','admin');
	}
	function log_absensi(){
		
		$tahun = ($_GET['tahun'] <> '')?$_GET['tahun']:date('Y');
		// $sql = "select s.skpd,l.dwMachineNumber,
		// 		SUM(IF(l.dwMonth=01,1,0)) as  jan, 
		// 		SUM(IF(l.dwMonth=02,1,0)) as  feb,
		// 		SUM(IF(l.dwMonth=03,1,0)) as  mar,
		// 		SUM(IF(l.dwMonth=04,1,0)) as  apr,
		// 		SUM(IF(l.dwMonth=05,1,0)) as  mei,
		// 		SUM(IF(l.dwMonth=06,1,0)) as  jun,
		// 		SUM(IF(l.dwMonth=07,1,0)) as  jul,
		// 		SUM(IF(l.dwMonth=08,1,0)) as  ags,
		// 		SUM(IF(l.dwMonth=09,1,0)) as  sep,
		// 		SUM(IF(l.dwMonth=10,1,0)) as  okt,
		// 		SUM(IF(l.dwMonth=11,1,0)) as  nov,
		// 		SUM(IF(l.dwMonth=12,1,0)) as  des
		// 		from skpd s
		// 		left join (generallogdata l
		// 		join machine m on (l.dwMachineNumber=m.dwMachineNumber and l.dwYear='".$tahun."'))
		// 		on (s.id=m.kodeskpd)
		// 		group by s.id,l.dwMachineNumber order by s.kode";
		$sql = "select s.skpd,l.dwMachineNumber,
				SUM(IF(l.dwMonth=01,1,0)) as  jan, 
				SUM(IF(l.dwMonth=02,1,0)) as  feb,
				SUM(IF(l.dwMonth=03,1,0)) as  mar,
				SUM(IF(l.dwMonth=04,1,0)) as  apr,
				SUM(IF(l.dwMonth=05,1,0)) as  mei,
				SUM(IF(l.dwMonth=06,1,0)) as  jun,
				SUM(IF(l.dwMonth=07,1,0)) as  jul,
				SUM(IF(l.dwMonth=08,1,0)) as  ags,
				SUM(IF(l.dwMonth=09,1,0)) as  sep,
				SUM(IF(l.dwMonth=10,1,0)) as  okt,
				SUM(IF(l.dwMonth=11,1,0)) as  nov,
				SUM(IF(l.dwMonth=12,1,0)) as  des
				from generallogdata l
				join (skpd s
				join machine m on (s.id=m.kodeskpd))
				on (l.dwMachineNumber=m.dwMachineNumber)
				where dwYear='".$tahun."'
				group by l.dwMachineNumber order by s.kode";
		$this->res = $this->db->query($sql);

		$this->template('log_presen_list','admin');
	}
	function optTahun($val){
		$option = '<select id="tahun" name="tahun">';
		for($i=date("Y");$i>=2010;$i--) {
			$sel = ($i == $val)?'selected':'';
			$option .= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
		}
		$option .= '</select>';
		return $option;	
	}
}
?>