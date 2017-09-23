<?php
/*
Plugin Name: Twitte para Json
Plugin URI: http://peraweb.com.br
Description: plugin coração
Version: 1.0
Author: Rafael Roberto
Author URI: http://peraweb.com.br
License: GPLv2
*/
//require_once plugin_dir_path( __FILE__ ).'vendor/tmhOAuth.php';
//require plugin_dir_path( __FILE__ ).'vendor/twitter_auth.php';
//require plugin_dir_path( __FILE__ ).'vendor/simple_html_dom.php';
//include '/home/perawebc/public_html/wp/wp-blog-header.php';


function atualizaBlog(){
	 //echo '<iframe src="http://empregos.seitudo.com.br/criaListaGeral.php" width="0" height="0" style="display:none"></iframe>';
	echo '<iframe src="http://peraweb.com.br/wp/criaListaGeral.php" width="0" height="0" style="display:none"></iframe>';
//	 echo '<iframe src="http://news.peraweb.com.br/criaListaGeral.php" width="0" height="0" style="display:none"></iframe>';
//	 echo '<iframe src="http://seitudo.com.br/criaListaGeral.php" width="0" height="0" style="display:none"></iframe>';
//require_once '../../../criaListaGeral.php"';
}

	add_action( 'get_footer', 'atualizaBlog' );
