<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta property="fb:pages" content="1105131032933847" />

  <!-- WordPress Head-->
  <?php wp_head();?>
</head>

<body <?php body_class(); ?>>

  <div id="themenu" class="hide mobile-navigation">
    <?php

    $args = array(
      'container'         => 'ul',
      'theme_location' => 'primary_navigation',
      'depth'               => 3,
      );
    wp_nav_menu($args);
    ?>

  </div>
  <!-- Mobile Navigation -->

  <!-- Start the Page -->
  <div id="page" class="hfeed site">

    <!-- We wont be supporting IE 8. Those users will get a desent message to update their outdated browsers -->
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <a href="#content" class="skip-link screen-reader-text"><?php esc_attr_e('Skip to Content', 'cpmmagz');?></a>
        <!-- Skip Link for better Accessibility -->

        <!-- Start the Header -->
        <header id="masthead" class="site-header" role="banner">
          <div class="top-header">
            <div class="container">
              <?php
              if ( has_nav_menu( 'top_navigation' ) ) :
                $menu_args = array(
                  'theme_location'    => 'top_navigation',
                  'container'         => 'ul',
                  'container_class'   => '',
                  'container_id'      => '',
                  'menu_class'        => 'top-nav left',
                  'menu_id'           => 'top-navigation',
                  'echo'              => true,
                  'depth'             => 1,
                  );
              wp_nav_menu( $menu_args );
              else :  ?>
              <ul id="top-navigation" class="top-nav left assign-menu">
                <?php
                if ( is_user_logged_in() && current_user_can( 'administrator' ) ) {
                  echo  '<li class="menu-item"><a href="'.esc_url(admin_url("nav-menus.php")).'" target="_blank"><i class="fa fa-plus-circle"></i> '.esc_attr( __('Assign a menu', 'cpmmagz') ).'</a></li>';
                }
                ?>
              </ul>
            <?php endif; ?>
            <!-- End Top Navigation -->
            <?php if ( function_exists( 'cpmmagz_social_icons' ) ) { ?>
            <?php cpmmagz_social_icons(); ?>
            <?php } ?>
            <!-- End Social icons -->
          </div>
        </div>
        <!-- End Top Header -->

        <nav id="site-navigation" class="main-navigation" role="navigation">
          <div class="nav-wrapper container">
            <div class="row valign-wrapper">

              <div class="col l3 m12 s12">
                <a href="#themenu" class="mob-activator hide-on-large-only">
                  <!-- Ham Menu SVG File. We can also use any icons or image instead of this svg file-->
                  <svg width="32px" height="16px" viewBox="0 0 32 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" >
                    <g id="mobile" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                      <g id="aticle" sketch:type="MSArtboardGroup" transform="translate(-11.000000, -12.000000)" stroke-linecap="round" stroke="#6B6B6B" stroke-width="2">
                        <g id="top_bar" sketch:type="MSLayerGroup">
                          <g id="ham" transform="translate(12.000000, 12.000000)" sketch:type="MSShapeGroup">
                            <path d="M0,1 L30,1" id="Line-Copy" transform="translate(15.000000, 1.000000) scale(-1, 1) translate(-15.000000, -1.000000) "></path>
                            <path d="M22.5,8 L0,8" id="Line-Copy-2"></path>
                            <path d="M15,15 L0,15" id="Line-Copy-3"></path>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </a>
                <!-- Mobile Navigation Activator -->
                <!-- Start Brand Logo. Assign your logo from the customizer.-->
                <?php
                if ( function_exists( 'jetpack_the_site_logo' ) ) {
                  jetpack_the_site_logo();
                }
                ?>
                  <!-- If no logo is assigned fallback to the site title.
                  If logo is assigned we will remove the sitetitle from the css -->
                  <!-- Start Site Title -->
                  <h1 class="site-title site-logo-link">
                    <a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo('name'); ?>">
                      <?php echo bloginfo('name'); ?>
                    </a>
                  </h1>
                  <!-- End Site title -->
                </div>
                <!-- End the Column -->

                <div class="col l9">
                  <!-- Header Search -->

                  <?php  $search  = get_theme_mod('search_toggle');
                  if ( $search == 'yes' ) {
                    ?>
                    <ul class="right hide-on-med-and-down">
                      <li>
                        <?php cpmmagz_header_search();?>
                      </li>
                    </ul>
                    <?php } ?>
                    <!-- End Header Search -->

                    <!-- Our Primary Navigation -->
                    <?php

                    if ( has_nav_menu('primary_navigation') ) :

                      $args = array(
                        'theme_location' => 'primary_navigation',
                        'depth'    => 0,
                        'container'  => false,
                        'menu_class'   => 'right hide-on-med-and-down',
                        'menu_id'   => 'main-navs',
                        'fallback_cb'     => 'wp_page_menu',
                        'walker'   => new Cpmmagz_nav_menu_walker()
                        );
                    wp_nav_menu($args);
                    else :  ?>
                    <ul  class="right hide-on-med-and-down">
                      <?php
                      if ( is_user_logged_in() && current_user_can('administrator') ) {
                        echo  '<li class="menu-item"><a href="'.esc_url(admin_url("nav-menus.php")).'" target="_blank"><i class="fa fa-plus-circle"></i> '.esc_attr( __('Assign a menu', 'cpmmagz' ) ).'</a></li>';
                      }
                      ?>
                    </ul>
                  <?php endif; ?>

                </div>
                <!-- End the Column -->

              </div>
            </div>
            <!-- End nav-wrapper container -->
          </nav>
          <!-- End main-navigation -->
        </header>
        <!-- End Site header -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- RESP - Novo Peraweb -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8290638757858092"
     data-ad-slot="1319796796"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCMbw18QbJ0A6ChTsLhnaP52aUnnmu8BAU",
    authDomain: "peraweb-ee6f4.firebaseapp.com",
    databaseURL: "https://peraweb-ee6f4.firebaseio.com",
    storageBucket: "",
    messagingSenderId: "682610045957"
  };
  firebase.initializeApp(config);
</script>
        <!-- Start Main Wrapper -->
        <div id="main-wrapper">