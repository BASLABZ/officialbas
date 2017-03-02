<?php
$mem_usage = memory_get_usage(true);
$time_usage = microtime(true);
include('inc.php');

class cms{

	function __construct() {
		$this->cms();
	}
	
	function cms(){	
		//classdefault
		$this->cnf = new ConfigClass();
		$this->db = new MysqliClass();	
		$this->str = new StringClass();
		$this->scr = new SecurityClass($this->db);
		$this->date = new DateClass();
		$this->url = new URLClass();
		$this->grid = new DbGridClass();
		$this->template = new TemplateClass();
		$this->auth = new AuthenticationClass($this);
		$this->dl = new DownloadClass();
		$this->menu = new MenuClass($this);		
		
		$this->loadedclass = array(		
			'kontak'				=> 'KontakClass',
			'pengguna'				=> 'PenggunaClass',
			'kabupaten'				=> 'KabupatenClass',
			'apbd'					=> 'APBDClass',
			'transfer'				=> 'TransferClass',
			'penerima'				=> 'PenerimaClass',
			'otsus'					=> 'OtsusClass',
			'grafikapbd'			=> 'GrafikapbdClass',
			'grafikapbd-p'			=> 'GrafikAPBDPClass',
			'grafikrealisasi'		=> 'GrafikRealisasiClass',
			'data'					=> 'ServiceDataClass',
			'grafikotsuskab'		=> 'GrafikotsusClass',
			'grafikotsusprov'		=> 'GrafikotsusprovClass',
			'grafiktransfer'		=> 'GrafikTransferOtsusClass',
			'dashboard'				=> 'DashboardClass',
			'uploadapbd'			=> 'APBDUploadClass',
			'realisasiupload'		=> 'RealisasiUploadClass',
			'realisasi'				=> 'RealisasiClass',
			'apbd-penjabaran'		=> 'APBDPenjabaran',
			'perbandingan-anggaran' => 'PerbandinganAnggaranClass',
			'lra'					=> 'LRAClass',
			'display'				=> 'DisplayClass',
			'setting-display'		=> 'SettingDisplayClass',
			'pengumuman'			=> 'PengumumanClass',
		);
	}

				
	function init(){	
		
		if (isset($_POST['tokenA'])) {
			if ($this->auth->login($_POST['tokenA'],$_POST['tokenB'])) {
				die('OK');
			} else die ('ERROR');
		}	
		
		if (isset($_SESSION['tahun'])) $this->db->tahun = $_SESSION['tahun'];
		else $this->db->tahun = date('Y');

		$this->__class();
		$this->__config();	
		if (!isset($_GET['mode'])) $_GET['mode'] = '';		
	
		switch($_GET['mode']){ 
			case 'detail':
				$this->getDetail();
			break;
			case 'display':
				$this->getDisplay();
			break;
			case 'logout':
				$this->auth->logout();
				header('location: login.htm');
			break;
			case 'login':
				$this->getLogin();
			break;
			default:
				if(array_key_exists($_GET['mode'], $this->loadedclass)){
					if (isset($_GET['cntmode']) && ($_GET['cntmode'] == 'download')){
						// untuk men-download file di masing2 modul  >>> $this->berita->FrontList();
						$this->$_GET['mode']->Download($this->scr->filter($_GET['id']));
					} else if ($_GET['mode']=='data') {
						// untuk request data
						$this->$_GET['mode']->Service();
					} else if ($this->auth->isAuth()) {
						//managemen data harus auth
						if (isset($_POST['do'])) {
							if ($_POST['do'] == 'add') $this->$_GET['mode']->Insert();
							else if ($_POST['do'] == 'edt') $this->$_GET['mode']->Update();
							else if ($_POST['do'] == 'del') $this->$_GET['mode']->Delete();
							else if ($_POST['do'] == 'svc') $this->$_GET['mode']->Service();								
						} else {		
							$this->auth->saveState();
							$this->$_GET['mode']->Manage();
						}
					} else {
						// untuk menampilkan daftar artikel  >>> $this->berita->FrontDisplay();					
						$this->$_GET['mode']->FrontDisplay();
					}	
				}else{					
					$this->getIndex();
				}				
			break;
		}

	}	


	function getIndex(){
		$content = "";
		$script = "";

		#load Dashboard
		$this->dashboard->FrontDisplay();
		
		$content = $this->dashboard->content;
		$script = $this->dashboard->script;
							
		$define = array (
			'PAGETITLE' 	=> 'Dashboard',
			'PAGECONTENT'	=> $content,
			'PAGESCRIPT'	=> $script,
                );
		$this->template->init(THEME.'/index.html');			
		$this->template->defineTag($define);
		$this->template->printTpl(); 
	}

	function getDisplay(){
		$content = "";
		$script = "";
		$piechart = "";
		$barchartdata = "";
		$barchartcat = "";

		#load Display
		$this->display->FrontDisplay();

			$content = $this->display->content;
			$script = $this->display->script;
			$piechart = $this->display->piechart;
			$barchartdata = $this->display->barchartdata;
			$barchartcat = $this->display->barchartcat;
			$otsusbardata = $this->display->barotsuskab;
			$otsusbarcat = $this->display->barotsuskabcat;
			$pieotsus = $this->display->pieotsus;
							
		$define = array (
			'PAGETITLE' 	=> 'Informasi Keuangan Daerah Provinsi Papua',
			'PAGECONTENT'	=> $content,
			'PAGESCRIPT'	=> $script,
			'PIECHART'		=> $piechart,
			'BARCHARTDATA'	=> $barchartdata,
			'BARCHARTCAT'	=> $barchartcat,
			'OTSUSBARDATA'	=> $otsusbardata,
			'OTSUSBARCAT'	=> $otsusbarcat,
			'PIEOTSUS'		=> $pieotsus,
			'TIMELIMIT'		=> '900',
			'PAGEREFRESH'	=> ROOT_URL."display.htm",
                );
		$this->template->init(THEME.'/display.html');			
		$this->template->defineTag($define);
		$this->template->printTpl(); 
	}
	
	function getLogin(){
		$content = "";
		$script = "";
		
		if (!$this->auth->isAuth()) {

			$define = array (
						 'THEME_URL'	=> THEME_URL,
						 'ROOT_URL'		=> ROOT_URL,
            );			
			
			$login = new TemplateClass();
			$login->init(THEME.'/forms/login.html');
			$login->defineTag($define);
			$content .= $login->parse();
			$script = "
				$(document).on('submit','#frmLogin',function(e){
					e.preventDefault();
					$('#frmLogin [name=tokenA]').val(MD5($('#frmLogin [name=username]').val()));
					$('#frmLogin [name=tokenB]').val(MD5($('#frmLogin [name=password]').val()));
					$('#frmLogin [name=username]').val('default');
					$('#frmLogin [name=password]').val('**********');
					$.post('#',$('#frmLogin').serialize(), function(data) {
						if (data=='OK')	{
							bootbox.info('Login berhasil!');
							
							window.location = 'index.htm';
						} else {
							$('#frmLogin [name=username]').val('');
							$('#frmLogin [name=password]').val('');
							bootbox.alert('Username atau password salah!');
							
						}
					});
				});
				
			";
		}
					
		$define = array (
						 'PAGETITLE' 			=> 'Login',
						 'PAGECONTENT'			=> $content,
						 'PAGESCRIPT'			=> $script,
                );
		$this->template->init(THEME.'/index.html');			
		$this->template->defineTag($define);
		$this->template->printTpl(); 
	}	

	function getDetail(){
		
		if(array_key_exists($_GET['content'], $this->loadedclass)){
			$detail = $this->$_GET['content'];
			$detail->getDetail($this->scr->filter($_GET['id']));
		}else{
			new ErrorClass('Error 404 : Halaman tidak ditemukan');
		}
 
		$define = array (
						 'PAGETITLE'	=> $detail->pgTitle,
						 'PAGECONTENT'	=> $detail->pgContent,		
						 'PAGESCRIPT'	=> $detail->pgScript,						 
                );

		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl(); 
	}


	function __class(){
		foreach($this->loadedclass as $key=>$value){
			if(class_exists($value)){
				// this->berita = new BeritaClass($owner)
				$this->$key = new $value($this);
			}
			else{
				die($value.' not exists object.');
			}
		}
	}

	function __config(){		
		$sql = "SELECT * FROM conf";
		$res = $this->db->query($sql)or die(ErrorClass::showError('Saat ini kami sedang melakukan perbaikan Database'));
		
		while($data = $this->db->fetchArray($res)){
			define(strtoupper($data['conf']), $data['val']);
			//autodefine utk template
			$this->template->defineTag(strtoupper($data['conf']),$data['val']);
		}		
		$this->template->defineTag('THEME_URL',THEME_URL);
		$this->template->defineTag('ROOT_URL',ROOT_URL);
		$this->template->defineTag('MENU',$this->menu->MainMenu());
		$this->template->defineTag('USERMENU',$this->menu->UserMenu());
		$this->template->defineTag('SIDEBARMENU',$this->menu->SideBarMenu());	
		$this->template->defineTag('NAVMODE','');
	} 


}


$gi	= new cms();
print($gi->init());
if (stripos($_SERVER['HTTP_ACCEPT'],'json')===false) {
	echo "<!--\n";
	echo "Time Elapsed : ".round(microtime(true) - $time_usage,2)."s\n";
	echo "Memory Usage : ".round((memory_get_usage(true)-$mem_usage)/1024,2)."KB\n";
	echo "-->\n";
}
?>
