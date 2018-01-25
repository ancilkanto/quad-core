<?php
/*
Plugin Name: Q Core
Plugin URI: http://www.quadnotion.com
Description: Extension plugin developed to use with WPBakery Visual Composer Page Builder.
Author: Quadnotion
Author URI: http://www.quadnotion.com
Version: 1.0
*/




require_once 'vc-extend/shortcodes.php';





if (!is_admin()) { 

    add_action( 'wp_enqueue_scripts', 'q_core_scripts' );
    add_action( 'wp_enqueue_scripts', 'q_core_styles' );

}

function q_core_scripts(){
	
	
	wp_enqueue_script("crypto-market-scroller-main-script", plugins_url('assets/js/main.js' , __FILE__ ),array(),false,true);
}


function q_core_styles(){
	
	wp_enqueue_style("q-core-style", plugins_url('assets/css/main.css' , __FILE__ ));
}




function q_core_fonts_url() {
    
    $font_url = add_query_arg( 'family', urlencode( 'Open+Sans:300,400,600,700,800' ), "//fonts.googleapis.com/css" );
    
    return $font_url;
}
/*
Enqueue scripts and styles.
*/
function q_core_font_scripts() {
    wp_enqueue_style( 'crypto-market', q_core_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'q_core_font_scripts' );



