<?php
Class UrlClass
{
		function friendlyURL($string){
			$string = preg_replace("`\[.*\]`U","",$string);
			$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
			$string = htmlentities($string, ENT_COMPAT, 'utf-8');
			$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
			$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
			return strtolower(trim($string, '-'));
		}

		function shareThis(){
			$share ="<!-- AddToAny BEGIN -->
					<br /> <br />
					<div class=\"a2a_kit a2a_kit_size_32 a2a_default_style\">
					<a class=\"a2a_dd\" href=\"http://www.addtoany.com/share_save\"></a>
					<a class=\"a2a_button_facebook\"></a>
					<a class=\"a2a_button_twitter\"></a>
					<a class=\"a2a_button_google_plus\"></a>
					<a class=\"a2a_button_email\"></a>
					</div>
					<script type=\"text/javascript\" src=\"//static.addtoany.com/menu/page.js\"></script>
					<!-- AddToAny END -->";
			return $share;
		}

}
?>