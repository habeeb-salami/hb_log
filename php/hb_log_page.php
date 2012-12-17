<?php 
global $wpdb;
$sql = "SELECT * FROM ".$wpdb->prefix."hb_log ";
$result = $wpdb->get_results($sql);
?>

<div>
<h2> HB Log Setting and Retrieving page</h2>

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
//echo $_SERVER['REQUEST_URI'];
//print_r($result);
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
?>
</table>
</div>