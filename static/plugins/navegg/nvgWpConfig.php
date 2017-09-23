<?php

require_once('lang/texts.php');

/**
 * Classe responsável por controlar o plugin
 */
class NvgWp{

	//private static $wpdb;
	private static $info;
	
	private static $nvgApiUrl = 'http://cluster.navegg.com/ws/';
	private static $nvgApiKey = '3b1eb550948434f6d049a04830188de4';
	
	
	/**
	 * Função de inicialização
	 */
	function inicializar(){
	  //Mapear objeto para manipular o banco 
	  // global $wpdb;
	  // NvgWp::$wpdb = $wpdb;
	  /** Com $wpdb você manipula o banco de dados agora ele esta referenciado em uma variavel estática da classe.
	   * Para utiliza-la agora não precisa declarar global $wpdb em todas funções, basta usar a estica da classe. 
	   * Ex.: NvgWp::$wpdb->
	   * Esta variavel não está sendo usado no momento, pois na v1.0 o id é amazenado na tablea options padrão do Wp. Para futuras versões basta descomentar a linhas que possuem $wpdb
	   */
	
	  //Mapear infos relevantes para plugin
	  NvgWp::$info['plugin_fpath']= dirname(__FILE__);
	
	
	  //Chama a função para imprimir a tag no head
	  add_action( 'wp_head', array('nvgWp','echoNavegg'));
	
	  //Chama a função para criar página de administração
	  add_action( 'admin_menu', array('nvgWp','createAdmNvg'));

	  //Colocar Mensagem de erro se não estiver cadastrado ID_NAVEGG
	  if(NvgWp::getIdNvg() == ''&& $_GET['page'] != 'nvg-admin' )//Verifica se não é post! E imprimie
	     add_action( 'admin_notices', array('nvgWp','echoMsgNotId' ));
	}
	
	/**
	 * Função de instalação
	 */
	function instalar(){
	    //Verifica se esta inicializado se não estiver, inicializa;
	    if ( is_null(NvgWp::$info) ) NvgWp::inicializar();
	    
	    //Criar dados do banco
	    NvgWp::createIdNvg();
	}
	
	/**
	 * Função de desinstalação
	 */
	function desinstalar(){
	  //Deleta dados do banco
	   NvgWp::deleteIdNvg();  
	}
	
	
	
	//Páginas
	
	
	/**
	 * Cria página de adm
	 */
	function createAdmNvg(){
	
	 add_menu_page('Navegg Analytics','Navegg Analytics',10,'nvg-admin',array('NvgWp','admInit'),plugins_url( '/contents/favicon.ico', __FILE__ ));
	
	 /* Exmplo com submenu para outra funcionalidade...
	  add_submenu_page('nvg-admin','Navegg - Optimeze. Results. - Painel ','Painel','manage_options','nvg-adm-rel',array('NvgWp','admInit'));*/
	
	}
	
	/**
	 * Faz o include da pagina inicial do administrador, que é chamado quando
	 * o usuário clica no menu NAVEGG
	 */
	function admInit(){ 
	
	  //caso esteja trocando o ID
	  if( isset( $_POST['idNvg']) ){
	
		//verifica se é um numerico
		if(NvgWp::idIsNum($_POST['idNvg'])){            
	
			//verifica se id é diferente do que ja estava cadastrado ou default
			if(!NvgWp::idIsDiference($_POST['idNvg'])){
			     $msgPost['class'] = 'updtFail';    
			     $msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_4');
			}
			else //atualiza o id navegg
			     try{
				     	$uptStatus =NvgWp::setIdNvg(str_replace(" ","",$_POST['idNvg']));           			     
			        	if($uptStatus){           
						//perdeu o retorno do WS (caso tinha cadastrado antes)
						NvgWp::deleteAutoInNvg();
			        		$msgPost['class'] = 'updtSucess';
				     	  	$msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_1');
			       		}else
			     			throw new Exception($uptStatus);		
	
			     }catch (Exception $e) {
			     	$msgPost['class'] = 'updtFail';    
			       	$msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_3');
			     }
	        }else{
	           $msgPost['class'] = 'updtFail';    
		   $msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_2');
		}       
	
	  }else //caso esteja querendo buscar ID através do e-mail cadastrado
		if($_POST['emNvg']){
			try{
				$rep = NvgWp::apiGetId($_POST['emNvg']);				
				if($rep->{"accid"}){
					if(!NvgWp::idIsDiference(str_replace(" ","",$rep->{"accid"}))){
        	            $msgPost['class'] = 'updtFail';
	                    $msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_4');
                	}else{
                        $rep->{"accid"} = array_unique($rep->{"accid"});
                        if(count($rep->{"accid"}) > 1){
        	                $msgPost['class'] = 'updtFail';
	                        $msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_5');
                            foreach($rep->{"accid"} as $id){
	                            $msgPost['msg'] .= '<br>Account ID - <strong>'.$id.'</strong>';
                            }
                        }else{
                            if(NvgWp::setIdNvg($rep->{"accid"}[0])){
					            //perdeu o retorno do WS (caso tinha cadastrado antes)
					            NvgWp::deleteAutoInNvg();
                	            $msgPost['class'] = 'updtSucess';
                	            $msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_1');
                	        }else{
                	            throw new Exception($uptStatus); 
                            }
                        }
                    }
				}else{
                    if(empty($rep))
                        	throw new Exception(getTextNvg('nvgMsgAdmInitError_6'));
                        else
					    	throw new Exception("err");
                }

			}catch (Exception $e) {
		 	   $msgPost['class'] = 'updtFail';
	                   $msgPost['msg'] = getTextNvg('nvgMsgAdmInitError_2');			
			}			
		//endIfGetIdByEmail
		}else
			if($_POST['newNvg']){
				try{
					$name     = addslashes($_POST['nmNvg']);
					$email    = addslashes($_POST['nemNvg']);
					$siteName = addslashes($_POST['stNvg']);
					$siteUrl  = addslashes($_POST['urNvg']);
					if(empty($name) || empty($email)) throw new Exception("empty");
					
					$rep = NvgWp::apiNewAcc($name,$email,$siteName,$siteUrl);

					if(!@$rep->{"error"}){

                        if(!NvgWp::idIsDiference(str_replace(" ","",$rep->{"acc_id"}))){

                        	throw new Exception('dupli');

                        }else if(NvgWp::setIdNvg(str_replace(" ","",$rep->{"acc_id"}),str_replace(" ","",$rep->{"usr_acess_key"}) )){

                               $msgPost['class'] = 'updtSucess';
                               $msgPost['msg'] = getTextNvg('nvgMsgAdmIdAlt_1');

                        }else{

                           throw new Exception('err');
                        }

					}else{
                        if(empty($rep))
                            throw new Exception("wsnull");
						else
    	                    throw new Exception("err");
					}

				}catch (Exception $e) {
                    $msgs['err']     = getTextNvg('nvgMsgAdmInitError_7');
                    $msgs['empty']   = getTextNvg('nvgMsgAdmInitError_8');
                    $msgs['dupli']	 = getTextNvg('nvgMsgAdmIdAlt_4');
                    $msgs['wsnull']  = getTextNvg('nvgMsgAdmInitError_6');

                    $msgPost['class'] = 'updtFail';
                    $msgPost['msg'] = $msgs[$e->getMessage()];
                }

			}//endIfNewNvg
			
		
		


	
	  require_once('contents/cssInit.php');
	  require_once('nvgWpInit.php');
	
	}
	
	
	/**
	 * Verifica se o ID digitado é um número e retirando os espaços em branco
	 **/
	function idIsNum($id){
	   if(is_numeric(str_replace(" ","",$id)))
	   	return true;
	   else
	   	return false;
	}
	
	
	/**
	 * Verifica se o ID que esta tentando salvar é diferente do que esta salvo
	 **/
	function idIsDiference($id){
	   if($id == NvgWp::getIdNvg())
	      return false;
	   else
	      return true;
	}
	
	
	/**
	 * Exemplo de como ficaria com submenu para outra funcionalidade
	 *
	 */
	/*
	function admPainel(){
	 echo 'Implementar um painel navegg para Wp';
	}
	*/
	
	
	
	
	
	//Manipular dados
	
	
	/**
	 * Cria ID Navegg
	 */
	function createIdNvg(){
	 //Cria na table Options do wordpress o campo ID_NAVEGG com valor vazio caso nao tenha ainda
	  if(NvgWp::getIdNvg() == '')
	     add_option('ID_NAVEGG');
	}
	
	/**
	 * Deleta ID Navegg
	 */
	function deleteIdNvg(){
	     delete_option('ID_NAVEGG');
	     NvgWp::deleteAutoInNvg();
	}
	
	/** 
	 * Pega ID Navegg
	 */
	function getIdNvg(){
	   return get_option('ID_NAVEGG'); 
	}
	
	/**
	 * Atualiza ID Naveg
	*/
	function setIdNvg($id, $autoIn = NULL){
	   if(!empty($autoIn)) NvgWp::setAutoInNvg($autoIn);

	   if(update_option('ID_NAVEGG',$id))
	      return true;
	   else
	      return false;
	}
	

	/**
	  * Manipular autologin
          */
	function createAutoInNvg(){
		if(NvgWp::getAutoInNvg() == '')
			add_option('AUTOIN_NAVEGG');
	}
	function deleteAutoInNvg(){
		if(NvgWp::getAutoInNvg() != '')
			delete_option('AUTOIN_NAVEGG');
	}
	function getAutoInNvg(){
		return get_option('AUTOIN_NAVEGG');
	} 
        function setAutoInNvg($key){
		NvgWp::createAutoInNvg();
           	update_option('AUTOIN_NAVEGG',$key);
        }

	
	//Impressões
	
	
	
	/**
	 * Imprime Tag Js Navegg
	 */
	function echoNavegg() { 
	    
	   if(NvgWp::getIdNvg() != '')
	        echo '<script id="navegg" type="text/javascript" src="//tag.navdmp.com/tm'.NvgWp::getIdNvg().'.js"></script>'."\n";
	
	}
	
	/**
	 * Aviso que o site ainda não está sendo analisado, pois falta cadastrar o ID
	 */
	function echoMsgNotId(){	
	    echo '<div id="nvgMsgAdmNotId" class="updated fade">
	           <p>'.getTextNvg('nvgMsgAdmNotId_1').' <a href="admin.php?page=nvg-admin">'.getTextNvg('nvgMsgAdmNotId_2').'</a> '.getTextNvg('nvgMsgAdmNotId_3').'</p>
	          </div>';
	
	}
	
	

	// Webservice
	
	
	/**
	 * GET ID Navegg by e-mail
	 */
    function apiGetId($email){
        $url = NvgWp::$nvgApiUrl;
        $url .= '?action=partneruseremail';
        $url .= '&part_key='.NvgWp::$nvgApiKey;
        $url .= '&email='.urlencode($email);
        $content = file_get_contents( $url );
        return json_decode($content);

    }


    /**
     * New Account
     */
    function apiNewAcc($name,$email,$siteName,$siteUrl){

        $postdata = http_build_query(
        array(
            'action' => 'partneraccount',
            'usr_name' => $name,
            'usr_email' => $email,
            'usr_site_name' => $siteName,
            'usr_domain' => $siteUrl,
            'part_key' => NvgWp::$nvgApiKey
        )
        );

        $opts = array('http' =>array('method'  => 'POST','content' => $postdata));
        $context = stream_context_create($opts);
        $content = file_get_contents(NvgWp::$nvgApiUrl, 0, $context);

        return json_decode($content);
    }

//EndClass
}

?>
