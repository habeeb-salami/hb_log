<?php
/** Load WordPress Administration Bootstrap */
$wp_root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if(file_exists($wp_root . '/wp-load.php')) {
	require_once($wp_root . "/wp-load.php");
} else if(file_exists($wp_root . '/wp-config.php')) {
	require_once($wp_root . "/wp-config.php");
} else {
	exit;
}

global $wp_db_version;
if ($wp_db_version < 8201) {
	// Pre 2.6 compatibility (BY Stephen Rider)
	if ( ! defined( 'WP_CONTENT_URL' ) ) {
		if ( defined( 'WP_SITEURL' ) ) define( 'WP_CONTENT_URL', WP_SITEURL . '/wp-content' );
		else define( 'WP_CONTENT_URL', get_option( 'url' ) . '/wp-content' );
	}
	if ( ! defined( 'WP_CONTENT_DIR' ) ) define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
	if ( ! defined( 'WP_PLUGIN_URL' ) ) define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
	if ( ! defined( 'WP_PLUGIN_DIR' ) ) define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
}

require_once(ABSPATH.'wp-admin/admin.php');

load_plugin_textdomain('wp-download_monitor', false, 'download-monitor/languages/');


/*
 * My Legacy code Habeelety
 * */
global $wpdb;
$hb_log_download_date = date("d/m/y"); //Rquest date
$hb_log_download_time = date("H:i:s"); // request time
$downloadFileName =$hb_log_download_time."_".$hb_log_download_date."_hb_log.csv"; //concantenating date with time
$tblhbLog =  $wpdb->prefix."hb_log";
$logQuery = "SELECT * FROM $tblhbLog"; //hb_log query string
$logResult = $wpdb->get_results($logQuery);

$log = "IP, Landing Page, Request Method, Date, Time, Referring Page, Browser Type\n";

if (!empty($logResult)){
	foreach ($logResult as $logs){
	$log .= "$logs->req_ip,$logs->req_landing,$logs->req_method,$logs->req_date,$logs->req_time,$logs->req_refferer,$logs->req_browser \n";
	}
}
header("Content-type: text/csv");
//header("Content-Disposition: attachment; filename=download_log.csv");
header("Content-Disposition: attachment; filename=$downloadFileName");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Length: " . strlen($log));

echo $log;
exit;
?>