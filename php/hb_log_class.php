<?php 
/*
 * 
 * this is the class that house the hb log footprint 
 * 
 * */

class HB_LOG{
	
 public function __constructor(){
		
		//
	}
	

 public	function init_hb_log(){
		// this method create the table for keeping the log
		global $wpdb;
		$table = $wpdb->prefix."hb_log";
		$structure = "CREATE TABLE IF NOT EXISTS $table(id INT(9) NOT NULL AUTO_INCREMENT,	req_ip VARCHAR(50) NOT NULL, req_method VARCHAR(50) NOT NULL,req_date VARCHAR(50) NOT NULL, req_time VARCHAR(50) NOT NULL, req_refferer VARCHAR(250) NOT NULL, req_browser VARCHAR(250) NOT NULL, PRIMARY KEY (id));";
		$wpdb->query($structure); //create the table for the log
	} //end of initiate function
	
	
	function dirmaker($thedir){
		// this method create a folder based on the provided meat for the method
		$logdir = $dir;
		$plugin_url = trailingslashit( WP_PLUGIN_URL.'/'.dirname( plugin_basename(__FILE__))); //gets the plugin directory folder
		//this directory makes the directory for recording the log file
		$dir = $plugin_url.$logdir;
		if(!file_exists($dir)){
			mkdir($dir, 0777); //Making of the directory
			return $dir; //return the name of the directory folder
		}else{
			return false;
		}
	
	}// end of the directory maker method
	
public	function hb_log(){
	
		/*
		 * Keeping record of the site is done here
		* */
		global $wpdb;
		$req_method = $_SERVER['REQUEST_METHOD'] ; //getting page request method
		$req_ip = gethostbyaddr($_SERVER['REMOTE_ADDR']); //requestor's IP address
		$req_date = date("d/m/y"); //Rquest date
		$req_time = date("H:i:s"); // request time
	
		if(isset($_SERVER['HTTP_REFERER'])){ //checking if user is reffered from another page or website
			$req_refferer = $_SERVER['HTTP_REFERER']; //if yes get the reffereing page or website address
		}else{
			$req_refferer = "direct"; //else record direct
		}
	
		$req_browser = $_SERVER['HTTP_USER_AGENT']; //getting browser type
	
		$sql_log = "INSERT INTO ". $wpdb->prefix."hb_log(req_ip,req_refferer, req_date,req_time, req_method, req_browser) VALUES('".$req_ip."','".$req_refferer."','".$req_date."','".$req_time."','".$req_method."','".$req_browser."')" ;  //logging query
		$result = $wpdb->query($sql_log); // inserting the record into the  log table
	} // end of the hb_log method
	
	
public	function my_log_admin(){ //defines the admin page output
		include_once'hb_log_page.php';	
	}
	//initiating plugin with this action
}

?>