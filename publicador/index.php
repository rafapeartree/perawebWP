<?php
// echo dirname(__FILE__);
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

ini_set('max_execution_time', '300');


	$owner_screen_name = 'PeraNewsBR';//peranewsint  //peranewsbr

require_once  ( dirname(__FILE__) . '/twitte-json/vendor/tmhOAuth.php');
require ( dirname(__FILE__) . '/twitte-json/vendor/twitter_auth.php');
require ( dirname(__FILE__) .'/twitte-json/vendor/simple_html_dom.php');
include ('../wp-blog-header.php');

global $wpdb;
// $recent_post_date = $wpdb->get_row("SELECT * FROM $wpdb->posts ORDER BY post_date desc LIMIT 1"  , 'ARRAY_A');
// echo "<pre>";
// print_r($recent_post_date);
// echo "</pre>";
// echo "<br><br>";
// echo "Hora strtotime:".strtotime($recent_post_date['post_date']);
// echo "<br><br>";
// echo "Hora strtotime 15 min:".strtotime("-15 minutes");
// echo "<br><br>";
// echo "Hora Resultado:".(strtotime($recent_post_date['post_date']) > strtotime("-15 minutes"));
// echo "<br><br>";
date_default_timezone_set('America/Sao_Paulo');
$cache_life = 60*2;
$filemtime = @filemtime('controlePublicacao.txt');
if (!$filemtime or (time() - $filemtime >= $cache_life)){


	$textPublicacao = "\r\nPublicação iniciada às:".date('d-m-Y H:i:s');
		//echo $textPublicacao."<br>";
file_put_contents('controlePublicacao.txt',$textPublicacao,FILE_APPEND);
// if (strtotime($recent_post_date['post_date']) < strtotime("-28 minutes")) {
		//echo "mais de 15 minutos<br><br>";
echo "Iniciando....<br>";
// if (strtotime($recent_post_date['post_date']) < strtotime("-22 minutes")) {
// 		//echo "mais de 15 minutos<br><br>";
// echo "Iniciando....<br>";

	// echo "<pre>";
	//print_r($recent_post_date);
	// echo "</pre>";
	// echo "<br><br>";

	$tmhOAuth = new tmhOAuth($twitter_auth);
	$statuses_url = '1.1/lists/list.json';
	$code = $tmhOAuth->request('GET', $tmhOAuth->url($statuses_url), array(
		'owner_screen_name'=>$owner_screen_name,
		'count'=>1000,
	));
	$return = json_decode($tmhOAuth->response['response']);

	foreach ($return as $lineCanal){
			$tmhOAuthSecao = new tmhOAuth($twitter_auth);
			$statuses_url = '1.1/lists/statuses.json';
	    $canal = $lineCanal->slug;
	    $canalName = $lineCanal->name;
			$code = $tmhOAuthSecao->request('GET', $tmhOAuthSecao->url($statuses_url), array(
				'slug'=>$canal,
				'owner_screen_name'=>$owner_screen_name,
				'count'=>5,
				'include_rts'=> false
			));
			//$secao = $lineCanal->user->screen_name;
			$returnSecao = json_decode($tmhOAuthSecao->response['response']);
	//}
			foreach ($returnSecao as $line){
	$jsonMontado = array();
	      echo "<br><br>                 Post:<br>";
	      print_r ($line);
				$iddaPagina = $line->id;
				$urlPagina = $line->entities->urls[0]->url;
				$urlTwittePic = $line->entities->media[0]->url;
				$imagemPagina = $line->entities->media[0]->media_url;
				$hashTag = $line->entities->hashtags[0]->text;
				$imagemProfile = $line->user->profile_banner_url;
				$nameProfile = $line->user->name;
				$userProfile = $line->user->screen_name;
				$texto = $line->text;
	      $texto = str_pad($texto, 3, ' ', STR_PAD_LEFT);   //pad feed
	      //$startat = stripos($texto, '@');
	      //$numat = substr_count($texto, '@');
	      $numhash = substr_count($texto, '#');
	      $numhttp = substr_count($texto, 'http');
	      $texto = preg_replace("/(http:\/\/)(.*?)\/([\w\.\/\&\=\?\-\,\:\;\#\_\~\%\+]*)/", "", $texto);
	      //$texto = preg_replace("(@([a-zA-Z0-9\_]+))", "", $texto);
	      //$texto = preg_replace('/(^|\s)#(\w+)/', '', $texto);
	      $coisasATirar = array($urlTwittePic,$urlPagina,"#","@");
	      $texto = str_replace($coisasATirar, "", $texto);
				$fonte = $owner_screen_name = 'peranewsint'?'SOURCE':'FONTE';
	     // if($urlPagina != ''&& $imagemPagina != ''){
	       if($urlPagina != ''){
	        $arquivoPost = "";
	        $html = file_get_html($urlPagina);
					if(($html->find('body',0))){
	          if($userProfile == 'autoesporte'){
	                  $xPathWrap_P = $html->find('div[id=materia-parsed-corpo]',0);

	          }else if($userProfile == 'g1carros' || $userProfile == 'siteEgo'){
	              if($html->find('div[id=materia-letra]',0) != ''){
	                  $xPathWrap_P = $html->find('div[id=materia-letra]',0);
	              }else{
	                  $xPathWrap_P = $html->find('article',0);
	              }

	          }else if(strrpos($userProfile,'EXAME') === true ){
	                  $xPathWrap_P = $html->find('article',0);

		      }else if(strrpos($userProfile,'GizmodoBR') === true ){
	                  $xPathWrap_P = $html->find('div[id=content]',0);

	          }else if(strrpos($userProfile,'quatrorodas') === true ){
	              //header('Content-Type: text/html; charset=iso-8859-1');
	                  //echo '';

	          }else{
                if($html->find('article',0) != ''){
                    $xPathWrap_P = $html->find('article',0);
                }else{
	                 $xPathWrap_P = $html->find('body',0);
                }

	               //echo "Caiu no else<br>";
	          }
	          $arquivoPost .= '<img src="'.$imagemPagina.'" style="display:none">';
	          foreach($xPathWrap_P->find('p') as $i=>$paragrafo) {
              // if($i = floor($i/2)){
              //   $arquivoPost .= '<p><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- responsivo 2 --><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8290638757858092" data-ad-slot="7232457190" data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></p><p>'.$paragrafo.'</p>';
              // }else{
	               $arquivoPost .= '<p>'.$paragrafo.'</p>';
              // }
	          }//foreach Paragrafo
            //$arquivoPost .= '<p><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- responsivo 2 --><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8290638757858092" data-ad-slot="7232457190" data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></p>';
						$arquivoPost .= '<p><a href="'.$urlPagina.'" target="_blanc">'.$fonte.'</a></p>';
	          $jsonMontado = array(
	            'post_author'  => 1,
	            //'post_content' => iconv('ISO-8859-1','UTF-8', $arquivoPost),
	            'post_content' => mb_detect_encoding($str, 'UTF-8', true)!="UTF-8"? iconv('ISO-8859-1','UTF-8', $arquivoPost):$arquivoPost,
	            'post_title' => wp_strip_all_tags($texto),
	            'post_status'  => 'publish',
	            'post_type'  => 'post',
	            'import_id'  => $iddaPagina,
	            'tax_input'  => array(
	              'non_hierarchical_tax' => $userProfile,$hashTag,
	            )
	          );

	            $post_exists = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '" . $iddaPagina . "'", 'ARRAY_A');
	            if(!$post_exists){
	                  $post_id = wp_insert_post( $jsonMontado, true );
	                  // echo 'Inserido Post: ';
	                  // print_r($post_id);
	                  // echo ', Title: '.wp_strip_all_tags($texto).'<br>';
										$nPosts++;
										if($imagemPagina != ''){

											$imagemPaginaOriginal = $imagemPagina;
											$upload_dir = wp_upload_dir();
											$image_data = file_get_contents($imagemPagina);
											$filename = basename($imagemPagina);
											if(wp_mkdir_p($upload_dir['path']))
											    $file = $upload_dir['path'] . '/' . $filename;
											else
											    $file = $upload_dir['basedir'] . '/' . $filename;
											file_put_contents($file, $image_data);

											$wp_filetype = wp_check_filetype($filename, null );
											$attachment = array(
											    'post_mime_type' => $wp_filetype['type'],
											    'post_title' => sanitize_title($texto),
											    'post_content' => '$texto',
											    'post_status' => 'inherit'
											);
											$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
											require_once(ABSPATH . 'wp-admin/includes/image.php');
											$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
											wp_update_attachment_metadata( $attach_id, $attach_data );

											set_post_thumbnail( $post_id, $attach_id );
	            }else{
	                  // echo 'Post nao inserido: '.$iddaPagina.', Title: '.wp_strip_all_tags($texto).'<br>';

	            }
							wp_set_object_terms( 1, null, 'category' );
	            wp_set_object_terms($post_id, str_replace("1", "", $canalName), 'category', False);





	              // $getImageFile = $imagemPagina;
	              // $wp_filetype = wp_check_filetype( $getImageFile, null );
	              // $attachment_data = array(
	              //   'post_mime_type' => $wp_filetype['type'],
	              //   'post_title' => sanitize_title($texto),
	              //   'post_content' => '',
	              //   'post_status' => 'inherit'
	              // );
								//
	              //   $attach_id = wp_insert_attachment( $attachment_data, $getImageFile, $post_id );
	              }
	            //echo '<br><br> Canal:'.$canal.'  Secao:'.$userProfile.',  Postid:'.$iddaPagina.',  Titulo:'.$texto.',  UTF:'.mb_detect_encoding($str, 'UTF-8', true).',<br> URL: <a href="'.$urlPagina.'">'.$urlPagina.'</a><br> Imagem: <img src="'.$imagemPagina.'" /><br><br><br><br>';
	            //echo "erro".$arquivoPost.'<br><br>';
	      }//if tem link
				}
	    }//foreach Post
		// }//foreach Secao
	}//foreach Canal
	$textPublicacao2 = ", com: ".$nPosts." salvos\r\n";
		//echo $textPublicacao2."<br>";
file_put_contents('controlePublicacao.txt',$textPublicacao2,FILE_APPEND);
 }else{
	 return $cache_life;
	//echo date('d-m-Y H:i:s')." menos de ".$cache_life." segundos<br><br>";
}
?>
