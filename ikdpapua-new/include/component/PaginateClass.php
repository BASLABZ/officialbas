<?php
Class PaginateClass{
	function PaginateClass($nrw, $numperpage = 15, $numsetpg = 5, $linkformat = "?pg={pg}&pgs={pgs}"){		
			/* page counting */
			$pg 		=(empty($_GET[pg]))?"1":$_GET[pg];
			$pgstart	= ($pg-1) * $numperpage;
			$pgend		= ($pg) * $numperpage;
			/* data */			
			$numpg = ceil($nrw/$numperpage);				
			$lssetpg = ceil($numpg/$numsetpg); 	
					
			$pg = (empty($_GET[pg]))?1:$_GET[pg];
			$pgs = (empty($_GET[pgs]))?1:$_GET[pgs];
			$prev = $_GET[pgs]-1;


			$pages = "<div class=\"pagination-area\">
							<ul class=\"pagination\">"; 
			if($pgs>'1'){
				$pages = $pages."<li><a href=\"".$this->getLink($linkformat,$x,$prev)."\">&laquo; Previous </a> </li>";
				} 
			$awal  = ($pgs-1)*$numsetpg+1;
			$akhir = $pgs*$numsetpg;
			for($x=$awal;$x<=$akhir;$x++){
				if($x<=$numpg){
					$pages = $pages."<li><a href=\"".$this->getLink($linkformat,$x,$pgs)."\">$x</a></li>";
				}
			}
			$next = $pgs+1;
			if($pgs<$lssetpg){
				$pages = $pages."<li><a href=\"".$this->getLink($linkformat,$x,$next)."\"> Next &raquo;</a></li>";
			}
			$pages = $pages."</ul></div>";
			
			
			if($numpg > 1 ){
				$pagedisplay = $pages;
			}else{
				$pagedisplay = '';
			}
			
			$this->indexstart =$pgstart;
			$this->indexend =$pgend;
			$this->pagedisplay=$pagedisplay;
			
			/* loop example */
			/*
			$i = 0;
			while($tmpdata = mysql_fetch_array($dataSource)){
					$data[$i] = $tmpdata;
					$i++;
			}
					
					
			for($i = $pgstart; $i< $pgend; $i++){
					$no = $i +1;
					$color = ($no % 2 == 0 )?'#F7F7F7':'';
					if($data[$i][0] <> ''){
					}
			}
			*/
			
			
	}
	
	function getLink($linkformat,$pg,$pgs){
		$pg = ($pg=='')?'1':$pg;
		$linkformat =  str_replace('{pg}',"$pg",$linkformat);
		$linkformat =  str_replace('{pgs}',"$pgs",$linkformat);
		return $linkformat;
	}
}
?>