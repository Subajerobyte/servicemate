<?php
include('lcheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title><?=$_SESSION['companyname']?> - Jerobyte - Engineer Nearby Customers Location</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<!--
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load("current", {
"packages":["map"],
"mapsApiKey": "AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg"
});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = google.visualization.arrayToDataTable([
['Lat', 'Long', 'Name'],
<?php
$sqlselect = "SELECT latlong, consigneename From jrcconsignee where latlong!='' order by consigneename asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
[<?=$rowselect['latlong']?>, " <?=trim(preg_replace('/\s+/', ' ', $rowselect['consigneename']));?> "],
<?php
}
}
?>
]);
var map = new google.visualization.Map(document.getElementById('map_div'));
map.draw(data, {
mapType: 'styledMap',
zoomLevel: 7,
showTooltip: true,
showInfoWindow: true,
useMapTypeControl: true,
maps: {
// Your custom mapTypeId holding custom map styles.
styledMap: {
name: 'Styled Map', // This name will be displayed in the map type control.
styles: [
{featureType: 'poi.attraction',
stylers: [{color: '#fce8b2'}]
},
{featureType: 'road.highway',
stylers: [{hue: '#0277bd'}, {saturation: -50}]
},
{featureType: 'road.highway',
elementType: 'labels.icon',
stylers: [{hue: '#000'}, {saturation: 100}, {lightness: 50}]
},
{featureType: 'landscape',
stylers: [{hue: '#259b24'}, {saturation: 10}, {lightness: -22}]
}
]}}
});
}
</script>
-->
<?php
function distance($lat1, $lon1, $lat2, $lon2, $unit)
{
if (($lat1 == $lat2) && ($lon1 == $lon2)) {
return 0;
}
else {
$theta = $lon1 - $lon2;
$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
$miles = $dist * 60 * 1.1515;
$unit = strtoupper($unit);
if ($unit == "M") {
return ($miles * 1609.344);
} else if ($unit == "K") {
return ($miles * 1.609344);
} else if ($unit == "N") {
return ($miles * 0.8684);
} else {
return $miles;
}
}
}
?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script>
/**
* @license
* Copyright 2021 Google LLC.
* SPDX-License-Identifier: Apache-2.0
*/
// The following example creates five accessible and
// focusable markers.
function initMap() {
const map = new google.maps.Map(document.getElementById("map"), {
zoom: 17,
<?php
$latlong1=explode(',',$_POST['engineername']);
$selectakm=mysqli_real_escape_string($connection,$_POST['selectakm']);
$selectunit=mysqli_real_escape_string($connection,$_POST['selectunit']);
?>
center: { lat: <?=$latlong1[0]?>, lng: <?=$latlong1[1]?>},
});
// Set LatLng and title text for the markers. The first marker (Boynton Pass)
// receives the initial focus when tab is pressed. Use arrow keys to
// move between markers; press tab again to cycle through the map controls.
const tourStops = [
<?php
$sqlselect = "SELECT latlong, consigneename,id From jrcconsignee where latlong!='' order by district asc, area asc, maincategory asc, subcategory asc, consigneename asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
while($rowselect = mysqli_fetch_array($queryselect))
{
$latlong=explode(',',$rowselect['latlong']);
if(distance($latlong1[0], $latlong1[1], $latlong[0], $latlong[1], $selectunit) < $selectakm)
{
?>
[{ lat: <?=$latlong[0]?>, lng: <?=$latlong[1]?> }, " <a href='consigneeview.php?id=<?=$rowselect['id'] ?>'><?=trim(preg_replace('/\s+/', ' ', $rowselect['consigneename']));?></a> "],
<?php
}
}
}
?>
];
// Create an info window to share between markers.
const infoWindow = new google.maps.InfoWindow();
// Create the markers.
tourStops.forEach(([position, title], i) => {
const marker = new google.maps.Marker({
position,
map,
title: `${i + 1}. ${title}`,
label: `${i + 1}`,
optimized: false,
});
// Add a click listener for each marker, and set up the info window.
marker.addListener("click", () => {
infoWindow.close();
infoWindow.setContent(marker.getTitle());
infoWindow.open(marker.getMap(), marker);
});
});
}
window.initMap = initMap;
</script>
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php //include('engineernavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->


 <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Engineer Nearby Customers Location</b></h1>
  </div>
</div>

<div class="card shadow mb-4">
          
            <div class="card-body">
<form action="" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-4">
<div class="form-group">
<label for="actiontaken">Engineer Name</label><span class="text-danger">*</span>
<select class="form-control fav_clr" id="engineername" name="engineername" required>
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername,username From jrcengineer  where enabled='0'  order by engineername asc";
$queryrep = mysqli_query($connection, $sqlrep);
$rowCountrep = mysqli_num_rows($queryrep);
if(!$queryrep){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountrep > 0)
{
$count=1;
while($rowrep = mysqli_fetch_array($queryrep))
{
$sqlrep1 = "SELECT id, lati,longi,ldate,user From jrclive  where user='".$rowrep['username']."'  ";
$queryrep1 = mysqli_query($connection, $sqlrep1);
$rowCountrep1 = mysqli_num_rows($queryrep1);
$rowrep1 = mysqli_fetch_array($queryrep1);
$currentlocation=$rowrep1['lati'].','.$rowrep1['longi'];
?>
<option value="<?=$rowrep1['lati']?>,<?=$rowrep1['longi']?>" <?=($currentlocation==$_POST['engineername'])?'selected':''?>><?=$rowrep['engineername']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-2">
<label for="selectakm">Enter a Distance</label><span class="text-danger">*</span>
<div class="input-group">
<input type="number" name="selectakm" id="selectakm" step="0.01" class="form-control" value="<?=isset($_POST['selectakm'])?$_POST['selectakm']:'5'?>">
<div class="input-group-append">
<select id="selectunit" name="selectunit" class="form-control" data-live-search="true" >
<option value="K" <?=(isset($_POST['selectunit']) && $_POST['selectunit']=='K')?'selected':''?> >KM</option>
<option value="M" <?=(isset($_POST['selectunit']) && $_POST['selectunit']=='M')?'selected':''?>>M</option>
</select>
</div>
</div>
<div class="form-group">
</div>
</div>
<div class="col-lg-1">
<div class="form-group">
<br>
<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</div>
</div>
</div>
</form>
</div>
</div>
<?php
if(isset($_POST['submit']))
{
?>
<div class="row">
<div class="col-lg-12">
<div id="map" style="width: 100%; height: 400px"></div>
</div>
</div>
<?php
}
?>
</div>
</div>
<?php include('footer.php'); ?>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<a class="btn btn-primary" href="../logout.php">Logout</a>
</div>
</div>
</div>
</div>
<script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
<script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script><script src="notification.js"></script>
<!-- Page level plugins -->
<script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<!-- Page level custom scripts -->
<script src="../../1637028036/js/demo/chart-area-demo.js"></script>
<script src="../../1637028036/js/demo/chart-pie-demo.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
$( "#topsearch" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
});
</script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=initMap"></script>
</body>
</html>