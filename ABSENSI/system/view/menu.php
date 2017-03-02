<?php
	$menu = new menu;
	$res = $menu->getMenu();
	
	while($data = $this->db->fetchArray($res)){
		$active = ($data['link'] == $_GET['pg'])?'oranye':'';
		$ressub = $menu->getSubMenu($data['id_menu']);
		$nrw = $this->db->numRows($ressub);
		$href = ($nrw > 0)?'#':'?pg='.$data['link'].($this->user['kodeskpd']!=''?'&kodeskpd='.$this->user['kodeskpd']:'').'';
		echo '<div class="navmenu transbg '.$active.'">
				<a href="'.$href.'" '.@$return.'>
					<img src="img/'.$data['img'].'" width="15"/> '.$data['menu'].'
				</a>';				
				if($nrw > 0){
					echo '<div class="canvas-submenu">';
					while($datasub = $this->db->fetchArray($ressub)){
						echo '<a href="?pg='.$data['link'].'&mode='.$datasub['link'].($this->user['kodeskpd']!=''?'&kodeskpd='.$this->user['kodeskpd']:'').'"><div class="submenu">'.$datasub['menu'].'</div></a>';		
					}
					echo '</div>';
				}

		echo 	  	'</div>';	
	}
?>
