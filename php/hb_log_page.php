<?php 
global $wpdb;
$sql = "SELECT * FROM".$wpdb->prefix."hb_log ";
$result = $wpdb->query($sql);
?>

<div>
<h2> HB Log Setting and Retrieving page</h2>

<table id="">
<tr>
<td>IP</td> 
<td>Reffering Page</td> 
<td> Date</td> 
<td> Time</td>
<td> Request Method</td> 
<td> Browser Type</td>
</tr>
<?php 
echo $_SERVER['REQUEST_URI'];
print_r($result);
?>
</table>
</div>