<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
//
// Your code goes below
//
function bbloomer_use_geolocated_user_country(){
 
// Geolocation must be enabled @ Woo Settings
 
$location = WC_Geolocation::geolocate_ip();
$country = $location['country'];
global $country;
// Lets use the country to e.g. echo greetings
 

}
 
add_action( '_______', 'bbloomer_use_geolocated_user_country' );