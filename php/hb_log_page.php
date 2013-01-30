<?php 
//function logger(){	
global $wpdb, $wp_hbLog_root;
DEFINE('SHOWMAX',20); //Defining the maximum number of records per page
$getTotal = "SELECT COUNT(*) FROM ".$wpdb->prefix."hb_log"; //total records query
$totalRow = $wpdb->get_var($wpdb->prepare($getTotal)); //qurying the databse for the total records
$curPage = isset($_GET['curPage']) ? $_GET['curPage']:0; //checking currentPage is set else set it to zero
$startRow = $curPage * SHOWMAX;
$sql = "SELECT * FROM ".$wpdb->prefix."hb_log LIMIT ".$startRow.",".SHOWMAX;
$result = $wpdb->get_results($sql);
//} //end of the logger function
?>

<div>
<h2> HB Log Setting and Retrieving page</h2>

<?php 
//function log_selector(){
 //logger();
 echo  "<p>
<strong>Displaying:";
 
echo $startRow+1; //output Starting row+1
if($startRow+1 < $totalRow){ //checking if starting row+1 is lesser than the total row
echo " to "	; //confirming that their are more rows to be displayed
	if($startRow+SHOWMAX< $totalRow){
		echo $startRow+SHOWMAX;
	}else {
		echo $totalRow;
	}
}
 echo " of $totalRow </strong>";

 //$wp_hbLog_root
?>
<p><a class="button-primary" href="<?php echo $wp_hbLog_root; ?>php/log_to_csv.php">
      Download CSV
    </a></p>
<table class="wp-list-table widefat plugins" cellspacing="0">
<thead>
<tr>
<th>IP</th> 
<th>Landing Page</th> 
<th> Request Method</th> 
<th> Date</th> 
<th> Time</th>
<th>Reffering Page</th> 
<th> Browser Type </th>
</tr>
</thead>
<tfoot> <tr>
<th>IP</th> 
<th>Landing Page</th> 
<th> Request Method</th> 
<th> Date</th> 
<th> Time</th>
<th>Reffering Page</th> 
<th> Browser Type </th>
</tr></tfoot>
<?php
//function displayLogResult(){
 //log_selector();
if (isset($result)){
foreach ($result as $results){
echo "<tr>
		<td>".$results->req_ip."</td> 
		<td>".$results->req_landing."</td>
		<td>".$results->req_method."</td>
		<td>".$results->req_date."</td>
		<td>".$results->req_time."</td>
		<td>".$results->req_refferer."</td>
		<td>".$results->req_browser."</td>
</tr>";
	}
	}
		//} //end of the displayLogResult() function
?>
</table>
<!-- Creating page navigatoion system -->
<?php 
//creating a backlink if the current page is greater than zero
if ($curPage>0){
	echo '<a href="?page='.$_GET['page'].'&curPage='.($curPage-1).'">&lt;&lt;Prev</a> ';
}else{
	echo '&nbsp;';
}
//creating link to the sub-page
if( $totalRow > SHOWMAX ){

$numberOfPage = $totalRow/SHOWMAX;

	if($totalRow % SHOWMAX){
		$numberOfPage=$numberOfPage + 1;
	}
	
	for($i=1; $i<$numberOfPage;$i++){

		echo '<a href="?page='.$_GET['page'].'&curPage='.($numberOfPage).'"> '.$i.' </a> ';
	}
}
	

//create a forward link if more records exists
if ($startRow+SHOWMAX < $totalRow){
	echo '<a href="?page='.$_GET['page'].'&curPage='.($curPage+1).'"> Next &gt;&gt;</a>';
}else {
	echo '&nbsp;';
}
echo "</p>";
//}//end of the log_selector() function

?>


</div>