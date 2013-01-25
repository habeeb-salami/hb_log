<?php
$table = 'lagshb_log';
$outstr = NULL;

header("Content-Type: application/csv");
header("Content-Disposition: attachment;Filename=logs.csv");
global $wpdb;

// Query database to get column names 
$result = $wpdb->query("show columns from ".$wpdb->prefix."hb_log");
// Write column names
while($row = mysql_fetch_array($result)){
    $outstr.= $row['Field'].',';
} 
$outstr = substr($outstr, 0, -1)."\n";

// Query database to get data
$result = mysql_query("select * from $table",$conn);
// Write data rows
while ($row = mysql_fetch_assoc($result)) {
    $outstr.= join(',', $row)."\n";
}

echo $outstr;
mysql_close($conn);
?>