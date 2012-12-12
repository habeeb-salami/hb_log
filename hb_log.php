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

add_action("activate_hb_log/hb_log.php",array($obj_hb_log,"init_hb_log"));
///register_activation_hook($file, $function)
//run this action when the page loads
add_action('admin_menu', array($obj_hb_log,'plugin_menu')); //hooking into the admin page
add_action("wp_footer",array($obj_hb_log,"hb_log")); //calling the hb_log method in the footer
?>