<?php 
class TemplateClass
{
    var $TAGS = array();
    var $THEME;
    var $CONTENT;
    
    
    function init($themename)
    {
        $this->THEME = 'themes/'.$themename;
        $this->openTag ();
        $this->closeTag ();
    }
	
	function clearTag() {
		$this->TAGS = array();
	}
    
    function openTag ($tagBegin = '{'){
	    $this->tagBeginwal = $tagBegin;
    }
	
	 function getTheme (){
	    return $this->THEME; 
    }
    
    function closeTag ($tagEnd = '}') {
	    $this->closeTag = $tagEnd;  
    }
        
    function defineTag($tagname, $varname=false)
    {
	    if (is_array ($tagname)){
		    foreach ($tagname as $key => $value) 
            { 
            $this->TAGS[$key] = $value; 
            } 
	    }else {
        $this->TAGS[$tagname] = $varname;
    		}
    }   
    
    function parse()
    {
		if (file_exists($this->THEME)) $this->CONTENT = file($this->THEME); 
        else die(ErrorClass::showError('Tidak dapat meload template'));
		
        $this->CONTENT = implode("", $this->CONTENT);
       
        foreach ($this->TAGS as $kunci=>$nilai){
	        $start = $this->tagBeginwal . $kunci . $this->closeTag;
	        $this->CONTENT = str_replace($start, $nilai, $this->CONTENT);	        
        }
        
       return $this->CONTENT;
    }
	
	function printTpl()
	{
		echo $this->parse();
	}
}
