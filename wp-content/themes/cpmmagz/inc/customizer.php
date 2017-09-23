<?php
/**
 * CPMMagz Theme Customizer
 *
 * @package CPMMagz
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cpmmagz_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'cpmmagz_customize_register' );

function cpmmagz_enqueue_customizer_scripts(){
	wp_enqueue_style( 'cpmmagz-customizer-css', get_template_directory_uri() . '/inc/assets/customizer.min.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'cpmmagz_enqueue_customizer_scripts' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cpmmagz_customize_preview_js() {
    wp_enqueue_script( 'cpmmagz_customizer', get_template_directory_uri() . '/inc/assets/customizer.min.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'cpmmagz_customize_preview_js' );


get_template_part('inc/customizer','basic');
get_template_part('inc/customizer','additional');

if( ! class_exists('WP_Customize_Control') ){
    return NULL;
}
class Cpmmagz_Support_Custom_Text_Control extends WP_Customize_Control {
        public $type = 'customtext';
        public $extra = ''; // we add this for the extra description
        public function render_content() {
        ?>
         <div class="support-buttons">
            <?php  printf( '<a href="https://codethemes.co/demos?theme=Magazine" class="button btn-customize" target="_blank">' ); ?>
               <span class="dashicons dashicons-welcome-view-site"></span>
                <?php echo esc_attr_e('View Demo', 'cpmmagz');?>
            </a>
            <?php  printf( '<a href="https://codethemes.co/cpmmagz-lite-documentationn/" class="button btn-customize" target="_blank">' ); ?>
                <span class="dashicons dashicons-clipboard"></span>
                <?php echo esc_attr_e('Documentation', 'cpmmagz');?>
            </a>
            <?php  printf( '<a href="https://codethemes.co/my-tickets/" class="button btn-customize" target="_blank">' ); ?>
                <span class="dashicons dashicons-edit"></span>
                <?php echo esc_attr_e('Create a ticket', 'cpmmagz');?>
            </a>
            <?php  printf( '<a href="https://codethemes.co/product/cpm-magz-pro/" class="button btn-customize" target="_blank">' ); ?>
                <span class="dashicons dashicons-star-filled"></span>
                <?php echo esc_attr_e('Buy Premium', 'cpmmagz');?>
            </a>
            <?php  printf( '<a href="https://codethemes.co/support/#customization_support" class="button btn-customize btn-request" target="_blank">' ); ?>
                <span class="dashicons dashicons-admin-tools"></span>
                <?php echo esc_attr_e('Request Customization', 'cpmmagz');?>
            </a>
        </div>
        <?php

        }
    }
