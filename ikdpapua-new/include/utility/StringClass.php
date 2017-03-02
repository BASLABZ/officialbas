<?php
class StringClass{
		function getSynopsis($con,$nmfrase='20')
			{
			$con = strip_tags($con);
			$bufPartCnt = array();
						$buddCnt = explode(" ",$con );
						 for($i=0;$i<=$nmfrase;$i++)
						 {
							$bufPartCnt[$i] = $buddCnt[$i];
						 }
						$partCnt = implode(" ", $bufPartCnt);
						
						return ($con <> '')?$partCnt." ... ":"";
			}	
}
?>