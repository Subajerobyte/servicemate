<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
$calltid=mysqli_real_escape_string($connection, $_GET['calltid']);
$sql = "update jrccalls set callrequest='1',requestengineerid='".$_SESSION['engineerid']."' where calltid='$calltid' ";
$query = mysqli_query($connection, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title><?=$_SESSION['companyname']?> - Jerobyte - Call Transfer </title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
</head>
<body id="page-top"  onload="getGeolocation()">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
<h1 class="h4 mb-0 text-gray-800">Call Transfer</h1>
<!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>
<div class="row">
<div class="col-lg-12">
<?php
if(isset($_GET['remarks']))
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-success text-white shadow">
<div class="card-body">
<?=$_GET['remarks']?>
</div>
</div>
</div>
<?php
}
if(isset($_GET['error']))
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<?=$_GET['error']?>
</div>
</div>
</div>
<?php
}
?><form method="post" id="myForm">
<?php
$opencallstatus=0;
if(isset($_GET['status'])&isset($_GET['calltid']))
{
$Q='';
if($_GET['calltid']!='')
{
$Q=' calltid="'.mysqli_real_escape_string($connection,$_GET['calltid']).'"';
}
?>
<div class="row" id="myItems">
<?php
$qs="";
$sqlroute = "SELECT id From jrcengroute WHERE attdate!='".date('Y-m-d')."' and attdate> now() -  interval 2 day";
$queryroute = mysqli_query($connection, $sqlroute);
$preclose = mysqli_num_rows($queryroute);
$sqlselect = "SELECT * From jrccalls where ".$Q." order by id desc";
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
$callrequest=$rowselect['callrequest'];
$sqlxl = "SELECT * From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
$queryxl = mysqli_query($connection, $sqlxl);
$rowCountxl = mysqli_num_rows($queryxl);
if(!$queryxl){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountxl > 0)
{
$rowxl = mysqli_fetch_array($queryxl);
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
if($rowxl['address1']!='')
{
$rowxl['address1']=jbsdecrypt($encpass, $rowxl['address1']);
}
if($rowxl['phone']!='')
{
$rowxl['phone']=jbsdecrypt($encpass, $rowxl['phone']);
}
if($rowxl['mobile']!='')
{
$rowxl['mobile']=jbsdecrypt($encpass, $rowxl['mobile']);
}
if($rowxl['email']!='')
{
$rowxl['email']=jbsdecrypt($encpass, $rowxl['email']);
}
}
}
$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$querycons = mysqli_query($connection, $sqlcons);
$rowCountcons = mysqli_num_rows($querycons);
if(!$querycons){
die("SQL query failed: " . mysqli_error($connection));
}
$rowcons = mysqli_fetch_array($querycons);
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
if($rowcons['address1']!='')
{
$rowcons['address1']=jbsdecrypt($encpass, $rowcons['address1']);
}
if($rowcons['phone']!='')
{
$rowcons['phone']=jbsdecrypt($encpass, $rowcons['phone']);
}
if($rowcons['mobile']!='')
{
$rowcons['mobile']=jbsdecrypt($encpass, $rowcons['mobile']);
}
if($rowcons['email']!='')
{
$rowcons['email']=jbsdecrypt($encpass, $rowcons['email']);
}
}
}
?>
<?php
if($rowselect['compstatus']=='2')
{
$bg="bg-success";
$bgtext="Completed";
}
else if($rowselect['compstatus']=='1')
{
$bg="bg-warning";
$bgtext="Pending";
}
else
{
$bg="bg-danger";
$bgtext="Open";
}
?>
<div class="col-lg-6 mb-4 items">
<div class="card shadow">
<div class="card-header <?=$bg?> text-white ">
<?=$rowselect['calltid']?> - <?=$bgtext?>
</div>
<div class="card-body">
<h5>Call Details:</h5>
<p><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?><br>
C/H: <?=$rowselect['callhandlingname']?><br>
C/O: <?=$rowselect['coordinatorname']?><br>
Call From: <a href="tel:<?=$rowselect['callfrom']?>"><?=$rowselect['callfrom']?></a><br>
Customer Nature: <?php
if($rowselect['customernature']!='')
{
?>
<span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
<?php
}
?>
Business Type: <?php
if($rowselect['businesstype']!='')
{
?>
<span class="btn btn-sm btn-success"><?=$rowselect['businesstype']?></span><br>
<?php
}
?>
Service Type: <?php
if($rowselect['servicetype']!='')
{
?>
<span class="btn btn-sm btn-danger"><?=$rowselect['servicetype']?></span><br>
<?php
}
?>
Call Nature: <?php
if($rowselect['callnature']!='')
{
?>
<span class="btn btn-sm btn-primary"><?=$rowselect['callnature']?></span><br>
<?php
}
?></p>
<hr>
<h5>Customer Details:</h5>
<p><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
if($rowcons['latlong']!='')
{
?>
<br>
<a class="text-primary" style="cursor:pointer" onclick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a>
<?php
}
?>
</p>
<hr>
<?php
if(($rowselect['requestengineerid']==$_SESSION['engineerid'])){	?>
<input class="btn btn-success"  value="Call Request Sent">
<?php } else { ?>
<input class="btn btn-primary" type="submit" name="submit" value="Call Request" onclick="validateFormAndSubmit()"
>
<?php } ?>
</div>
</div>
</div>
<?php
$count++;
}
}
}
?>
</div>
<?php
}
?>
</form>
</div>
</div>
</div>
</div>
<?php include('footer.php') ?>
<?php include('spin.php') ?>
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
<script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
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
<script>
function mapsSelector(lat,lon) {
if ((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) || (navigator.platform.indexOf("iPod") != -1))
{
window.open("maps://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
else
{
window.open("https://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
}
function myFunction() {
var input, filter, cards, cardContainer, h5, title, i;
input = document.getElementById("myFilter");
filter = input.value.toUpperCase();
cardContainer = document.getElementById("myItems");
cards = cardContainer.getElementsByClassName("items");
for (i = 0; i < cards.length; i++) {
title = cards[i].querySelector(".card");
if (title.innerText.toUpperCase().indexOf(filter) > -1) {
cards[i].style.display = "";
} else {
cards[i].style.display = "none";
}
}
}
</script>
<script>
function displayLocation(latitude,longitude)
{
var request = new XMLHttpRequest();
var method = 'GET';
var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg';
var async = true;
request.open(method, url, async);
request.onreadystatechange = function(){
if(request.readyState == 4 && request.status == 200){
var data = JSON.parse(request.responseText);
console.log(data);
var address = data.results[0];
console.log(address.formatted_address);
document.getElementById('daddress').innerHTML='<b>Your Current Location: </b>'+address.formatted_address;
}
};
request.send();
}
const demo = document.getElementById('demo');
function error(err) {
demo.innerHTML = `Failed to locate. Error: ${err.message}`;
}
function success(pos) {
demo.innerHTML = '<b>Located:</b> '+`${pos.coords.latitude}, ${pos.coords.longitude}`;
showPosition(pos);
displayLocation(`${pos.coords.latitude}`, `${pos.coords.longitude}`);
//alert(`${pos.coords.latitude}, ${pos.coords.longitude}`);
}
function getGeolocation() {
if (navigator.geolocation) {
demo.innerHTML = 'Locating…';
navigator.geolocation.getCurrentPosition(success, error);
setInterval(function(){
navigator.geolocation.getCurrentPosition(success, error);
}, 30000);
} else {
demo.innerHTML = 'Geolocation is not supported by this browser.';
}
}
function showPosition(position)
{
var useremail="<?=$_SESSION['email']?>";
$.ajax({
url: "livelocation.php",
type: "post",
data: { lati: position.coords.latitude, longi: position.coords.longitude, user:useremail},
success: function (data) {
console.log(data);
}
});
}
</script>
<script>
var callid = "";
function error1(err) {
alert(`Failed to locate. Error: ${err.message}`);
}
function success1(pos) {
alert('Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`);
startposition(pos);
}
function startmylocation(id) {
callid=id;
var opencallstatus=<?=$opencallstatus?>;
if(opencallstatus==0)
{
if (navigator.geolocation) {
demo.innerHTML = 'Locating…';
navigator.geolocation.getCurrentPosition(success1, error1);
} else {
alert('Geolocation is not supported by this browser.');
}
}
else
{
alert('Already A call has been Started, Please Complete that call before start new one');
}
}
function startposition(position)
{
var useremail="<?=$_SESSION['email']?>";
$.ajax({
url: "callstartlocation.php",
type: "post",
data: { lati: position.coords.latitude, longi: position.coords.longitude, callid:callid},
success: function (data) {
console.log(data);
window.location.reload();
}
});
}
</script>
<script>
var callid = "";
var startip = "";
function error2(err) {
alert(`Failed to locate. Error: ${err.message}`);
}
function success2(pos) {
alert('Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`);
endposition(pos);
}
function endlocation(ip,id) {
callid=id;
startip=ip;
if (navigator.geolocation) {
demo.innerHTML = 'Locating…';
navigator.geolocation.getCurrentPosition(success2, error2);
} else {
alert('Geolocation is not supported by this browser.');
}
}
function endposition(position)
{
var useremail="<?=$_SESSION['email']?>";
$.ajax({
url: "callendlocation.php",
type: "post",
data: { lati: position.coords.latitude, longi: position.coords.longitude, callid:callid, startip:startip},
success: function (data) {
console.log(data);
window.location.reload();
}
});
}
</script>
</body>
</html>