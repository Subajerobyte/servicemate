<?php
if((isset($_GET['start']))&&(isset($_GET['end'])))
{
$start = strtotime($_GET['start']);
$end1 = strtotime($_GET['end']);
$interval   = 90*24*60*60; // 10 days equivalent seconds.
$chunks = array();
for($time=$start; $time<=$end1; $time+=$interval)
{
$chunks[] = date('Y-m-d', $time);
echo date('Y-m-d', $time).'<br>';
}
echo '<br>';
////
$date=$_GET['start'];
$end_date=$_GET['end'];
while (strtotime($date) < strtotime($end_date)) 
{
$date = date("Y-m-d", strtotime("+3 months", strtotime($date)));
echo "$date<br>";
}


}
?>