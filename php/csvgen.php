<?php
$table = 'lagshb_log';
$filename = tempnam(sys_get_temp_dir(), "csv");

$conn = mysql_connect("localhost", "root", "hab552");
mysql_select_db("wordpress",$conn);

$file = fopen($filename,"w");

// Write column names
$result = mysql_query("show columns from $table",$conn);
for ($i = 0; $i < mysql_num_rows($result); $i++) {
    $colArray[$i] = mysql_fetch_assoc($result);
    $fieldArray[$i] = $colArray[$i]['Field'];
}
fputcsv($file,$fieldArray);

// Write data rows
$result = mysql_query("select * from $table",$conn);
for ($i = 0; $i < mysql_num_rows($result); $i++) {
    $dataArray[$i] = mysql_fetch_assoc($result);
}
foreach ($dataArray as $line) {
    fputcsv($file,$line);
}

fclose($file);

header("Content-Type: application/csv");
header("Content-Disposition: attachment;Filename=cars-models.csv");

// send file to browser
readfile($filename);
unlink($filename);
?>