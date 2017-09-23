<?php
    function clrString($s){
		$separator = array('_','-',' ');
		return str_replace($separator,"", $s);
	}


	//$nvgLanguage = 'en';
	$nvgTexts= array();
    try{
    	if($_COOKIE["idioma_nvg"])
    		$idioma_nvg = $_COOKIE["idioma_nvg"];
    	else if(!$idioma_nvg ){
    		
    		if(strnatcasecmp(clrString(get_bloginfo('language')),'ptBR') == 0 || strnatcasecmp(clrString(get_bloginfo('language')),'br') == 0 ){
    			$idioma_nvg = 'br';
    		}
    		else if(strnatcasecmp(clrString(get_bloginfo('language')),'esES') == 0){
    			$idioma_nvg = 'es';
    		}
    		else{
    			$idioma_nvg = 'en';
    		}
    	}
    }catch(Exception $e){
        $idioma_nvg = 'en';
    }
	
	//if(isset($idioma_nvg)){
	if(($idioma_nvg) == 'br'){
		require_once('textsPT_BR.php');
	}
	else if(($idioma_nvg) == 'es'){
		require_once('textsES.php');
	}
	else{
		require_once('textsEN.php');
	}
	
	//else{		require_once('textsEN.php');	}
	
		function getTextNvg($term){
			//Para pegar identificar array não local da função
			global $nvgTexts;
	
			if(array_key_exists($term, $nvgTexts))
			    return $nvgTexts[$term];
			else
			    return '!'.$term;		
		}
	
	
	
/*
	 
  switch ($nvgLanguage){
	
		    case 'br':
			require_once('textsPT_BR.php');
		    break; 
			
			case 'es':
			require_once('textsES.php');
		    break; 
	 		
		    default:	
			require_once('textsEN.php');
		    break;
	 }//endSwitch
*/
?>