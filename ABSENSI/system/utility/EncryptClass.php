<?php
class EncryptClass
{
		function encrypt($string){
			return base64_encode($string);
		}
		
		function decrypt($string){
			return base64_decode($string);
		}
		
		function arrEncrypt($array){			 
			foreach( $array as $key => $val){
				$array[$key] = $this->encrypt($val);
			}			
			return $array;
		}

		function arrDecrypt($array){			 
			foreach( $array as $key => $val){
				$array[$key] = $this->decrypt($val);
			}			
			return $array;
		}


}
?>