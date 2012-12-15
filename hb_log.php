<?php 
/*
Plugin Name: hb_log
Plugin Dir: http://localhost/hb-log/
Description: This Plugin helps in Recording webpage visit and specifically BOTs
Version:1.0
Author: Salami Habeeb Alabi(+2348064620491)
*/

include_once 'php/hb_log_class.php';
$obj_hb_log = new HB_LOG();

function my_log_admin(){
	include 'php/hb_log_page.php';
}

function plugin_menu(){ //the page container
	add_options_page("My Log Plugin Menu Page", "Log Menu",9,"hb_log","my_log_admin");
}

add_action("activate_hb_log/hb_log.php",array($obj_hb_log,"init_hb_log"));
add_action('admin_menu','plugin_menu'); //hooking into the admin page
add_action("wp_footer",array($obj_hb_log,"hb_log")); //calling the hb_log method in the footer
?>