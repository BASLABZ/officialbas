<?php
Class MenuClass {
	
	function __construct($owner) {
		$this->cnf = $owner->cnf;
		$this->db = $owner->db;
		$this->auth = $owner->auth;
	}

	function MainMenu(){
		# tampilan depan
		$auth = $this->auth->isAuth();
		$content = "\t\t\t\t<li class=''>
					  <a href='".ROOT_URL."index.htm'><span class='fa fa-tachometer'></span><span class='xn-text'>Dashboard</span></a>
				  </li> \n";
		if (!$auth) return $content;
		
		$hak = $this->auth->getHakVar();
		if ($hak!='ADMIN') {
			$sql = "SELECT * FROM menu WHERE (idmenu IN (
						SELECT m.parent FROM menu_group mg
						JOIN menu m ON (m.idmenu=mg.idmenu)
						WHERE mg.hak='".$hak."'
					) OR idmenu IN (SELECT idmenu FROM menu_group WHERE hak='".$hak."')) AND published='Y' and parent='0' order by ordering
					";
		} else  {
			$sql = "SELECT * FROM menu WHERE published='Y' and parent='0' order by ordering ";
		}
		$active = "";
		$res = $this->db->query($sql) or die($sql);		
		while($data = $this->db->fetchAssoc($res)){
			$url = (substr($data['url'],0,4)=='http')?$data['url']:ROOT_URL.$data['url'];
			$url = ( in_array(strtolower($data['menu']), array("home","beranda")))?ROOT_URL:$url;
			if ($hak!='ADMIN') {
				$sqlsub = "SELECT * FROM menu WHERE (idmenu IN (
						SELECT m.parent FROM menu_group mg
						JOIN menu m ON (m.idmenu=mg.idmenu)
						WHERE mg.hak='".$hak."'
					) OR idmenu IN (SELECT idmenu FROM menu_group WHERE hak='".$hak."')) AND published='Y' and parent='".$data['idmenu']."' order by ordering
					";
			} else {
				$sqlsub = "SELECT * FROM menu WHERE published='Y' and parent='".$data['idmenu']."' order by ordering ";
			}
			$ressub = $this->db->query($sqlsub) or die($sqlsub);
			$ulsub ="";
			$dropdownclass = "";
			if($this->db->numRows($ressub)){				
				$ulsub ="<ul>\n";
				while($datasub = $this->db->fetchAssoc($ressub)){
			
					if (isset($_GET['mode']) && $_GET['mode']==str_replace(".htm","",$datasub['url'])) { 
						$active = " active ";
						$dropdownclass = " active ";
					} else $active = "";
					
					$suburl = (substr($datasub['url'],0,4)=='http')?$datasub['url']:ROOT_URL.$datasub['url'];

					$ulsub .= "<li class='".$active."'>
							<a href='".$suburl."'><span class='".($datasub['iconclass']!=''?$datasub['iconclass']:'icon-caret-right')."'></span> ".$datasub['menu']."</a>
							</li>";
				}
				$ulsub .="</ul>\n";
				$dropdownclass .= " xn-openable";
				$active = "";
			}
					

			$li = "\t\t\t\t<li class='".$dropdownclass."'>
					  <a href='".$url."'><span class='".$data['iconclass']."'></span> <span class='xn-text'>".$data['menu']."</span></a>
				      $ulsub  
				  </li> \n";
			$content .= $li;
			
		}	
		$content .= "\t\t\t\t<li class=''>
					  <a href='".ROOT_URL."kontak.htm'><span class='glyphicon glyphicon-phone'></span><span class='xn-text'>Kontak</span></a>
				  </li> \n";

		return 	$content;
				
	}	
	
	function SideBarMenu() {
		return "";
	}
	
	function UserMenu() {
		if ($this->auth->isAuth()) {
			$menu = "
					<li class='xn-icon-button pull-right last'>
                        <a href='#'><span class='fa fa-power-off'></span></a>
						<ul class='xn-drop-left animated zoomIn'>
							<li><a href='".ROOT_URL."detail/pengguna/".$this->auth->getUserIDVar()."/profile.htm'><span class='fa fa-user'></span> Profil</a></li>
							<li><a href='#' class='mb-control' data-box='#mb-signout'><span class='fa fa-sign-out'></span> Sign Out</a></li>
						</ul> 
					</li>
					";
		} else {
		    $menu = "
					<li class='xn-icon-button pull-right last'>
                        <a href='".ROOT_URL."login.htm' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Login'><span class='fa fa-user'></span></a>
					</li>
			";
		}
		return $menu;
	}
	
}