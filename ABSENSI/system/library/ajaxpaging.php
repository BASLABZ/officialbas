<?php
class ajaxpaging
{
	var $itemperpage;
	var $totalpage;
	var $itemstotal;
	var $start;
	var $limit;
	function __construct(){
    	$this->itemperpage = 10;
	}
	function paginate(){
		$this->page = (isset($_GET['page']))?$_GET['page']:1;
		$this->start = ($this->page-1)*$this->itemperpage;
		$this->limit = "limit ".$this->start.",".$this->itemperpage."";	
	}
	function displayPage(){
		$this->totalpage = ceil($this->itemstotal/$this->itemperpage);
		$linkpage = "";
		for($i=1;$i<=$this->totalpage; $i++)
		{
			$class = ($this->page == $i)?'current':'paginate';
			$linkpage .="<a href='#' class='$class' id='$i'>$i</a>";
		}
		return $linkpage;	
	}	
}
?>