<?php
Class KontakClass extends ModulClass{	

	function Manage() {
		$this->FrontDisplay();
	}
	
	function FrontDisplay(){
		$content = "";
		$script = "";
		$define = array (
					 'THEME_URL'	=> THEME_URL,
					 'ROOT_URL'		=> ROOT_URL,
		);	
		$kontak = new TemplateClass();
		$kontak->init(THEME.'/contact.html');
		$kontak->defineTag($define);
		$sql = "SELECT * FROM conf";
		$res = $this->db->query($sql);		
		while($data = $this->db->fetchArray($res)){
			//autodefine utk template
			$kontak->defineTag(strtoupper($data['conf']),$data['val']);
		}		
		$content .= $kontak->parse();
			
		$define = array (
						 'PAGETITLE' 			=> 'Kontak',
						 'PAGECONTENT'			=> $content,
						 'PAGESCRIPT'			=> $script,
                );
						
		$this->template->init(THEME.'/index.html');			
		$this->template->defineTag($define);
		$this->template->printTpl(); 		
	}	
	
	function GetDetail($id){
		# detail artikel
		header('location: '.ROOT_URL.'kontak.htm');
	}	


}