<?php
$startip='10.815697,78.657823';
$endip='10.8272213,78.6682285';
$from = $startip;
$to = $endip;

$from = urlencode($from);
$to = urlencode($to);
$data1 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&mode=driving&language=en-EN&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
$data = json_decode($data1);
print_r($data);
$time = 0;
$distance = 0;

foreach($data->rows[0]->elements as $road) {
    $time += $road->duration->value;
    $distance += $road->distance->value;
}
$km=$distance/1000;
echo $km;
?>
