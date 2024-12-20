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
<title>Attendance - Jerobyte</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
<style>
.imgcontainer{
height:auto;
text-align:center;
}
.imgcontent{
width: 110px;
float: left;
margin-right: 5px;
border: 1px solid gray;
border-radius: 3px;
padding: 5px;
}
/* Delete */
.imgcontent span{
border: 2px solid red;
display: inline-block;
width: 100%;
text-align: center;
color: red;
}
.imgcontent span:hover{
cursor: pointer;
}
.ajax-upload-dragdrop, .ajax-file-upload-statusbar, .ajax-file-upload-filename
{
width: 100% !important;
}
</style>
<style>
.historyid{
line-height:1.3em;
}
.history-tl-container{
font-family: "Roboto",sans-serif;
width:100%;
margin:auto;
display:block;
position:relative;
}
.history-tl-container ul.tl{
margin:20px 0;
padding:0;
display:inline-block;
}
.history-tl-container ul.tl li{
list-style: none;
margin:auto;
margin-left:150px;
min-height:50px;
/*background: rgba(255,255,0,0.1);*/
border-left:1px dashed #86D6FF;
padding:0 0 30px 30px;
position:relative;
}
.history-tl-container ul.tl li:last-child{ border-left:0;}
.history-tl-container ul.tl li::before{
position: absolute;
left: -18px;
top: -5px;
content: " ";
border: 8px solid rgba(255, 255, 255, 0.74);
border-radius: 500%;
background: #258CC7;
height: 35px;
width: 35px;
transition: all 500ms ease-in-out;
}
.history-tl-container ul.tl li:hover::before{
border-color:  #258CC7;
transition: all 1000ms ease-in-out;
}
ul.tl li .item-title{
}
ul.tl li .item-detail{
color:rgba(0,0,0,0.5);
font-size:12px;
}
ul.tl li .timestamp{
color: #8D8D8D;
position: absolute;
width:100px;
left: -30%;
text-align: right;
font-size: 12px;
}
@media only screen and (max-width: 600px) {
.history-tl-container ul.tl li{
list-style: none;
margin:auto;
margin-left:110px;
min-height:50px;
/*background: rgba(255,255,0,0.1);*/
border-left:1px dashed #86D6FF;
padding:0 0 20px 25px;
position:relative;
}
ul.tl li .timestamp{
color: #8D8D8D;
position: absolute;
width:100px;
left: -60%;
text-align: right;
font-size: 12px;
}
}
</style>
</head>
<body id="page-top" onsubmit="return !!(kilometercal() || travelcost1() || totaltravelexpense1() || otherexpense() || totalexpense());">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
<h1 class="h4 mb-0 text-gray-800">Attendance</h1>
<!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>
<div class="row">
<div class="col-lg-12">
<?php
if(isset($_GET['attdate']))
{
$attdate=$_GET['attdate'];
}
else
{
$attdate=date('Y-m-d');
}
if(isset($id))
{
$sqlselect = "SELECT * From jrcengineer where enabled='0' and id='".$id."' order by username asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
?>
<?php
$count=1;
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<form action="" method="get">
<div class="row">
<div class="col-8">
<div class="form-group">
<input type="date" name="attdate" class="form-control" value="<?=((isset($_GET['attdate']))?$_GET['attdate']:date('Y-m-d'))?>" max="<?=date('Y-m-d')?>">
</div>
</div>
<div class="col-4">
<div class="form-group">
<input type="submit" name="submit" class="btn btn-primary">
</div>
</div>
</div>
</form>
<?php
$sqlmap = "SELECT * From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$attdate."%' order by attdate desc";
$querymap = mysqli_query($connection, $sqlmap);
$rowCountmap = mysqli_num_rows($querymap);
if(!$querymap){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountmap > 0)
{
$infomap=mysqli_fetch_array($querymap);
?>
<div class="row">
<div class="col-lg-6">
<?php
if($infomap['startlocation']!='')
{
$waypoints='';
$endpoint=$infomap['startlocation'];
for($j=1;$j<=7;$j++)
{
if($infomap['location'.$j]!='')
{
if($waypoints=='')
{
$waypoints.=''.$infomap['location'.$j];
}
else
{
$waypoints.='|'.$infomap['location'.$j];
}
$endpoint=$infomap['location'.$j];
}
}
if($waypoints=='')
{
$waypoints=$infomap['startlocation'];
}
if($infomap['endlocation']!='')
{
$endpoint=$infomap['endlocation'];
}
?>
<iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&origin=<?=$infomap['startlocation']?>&destination=<?=$endpoint?>&waypoints=<?=$waypoints?>&avoid=tolls|highways&center=<?=$infomap['startlocation']?>&zoom=9" allowfullscreen>
</iframe>
<?php
}
?></div>
<div class="col-lg-6 historyid">
<div class="card p-3">
<div class="history-tl-container">
<ul class="tl">
<?php
$prev='';
$totalkms=0;
if($infomap['startlocation']!='')
{
$data1 = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['startlocation']."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
$data = json_decode($data1);
?>
<li class="tl-item" ng-repeat="item in retailer_history">
<div class="timestamp">
<?php
echo (date('jS F Y',strtotime($infomap['starttime']))).'<br>'.(date('h:i a',strtotime($infomap['starttime'])));
?>
</div>
<div class="item-title">Start from Home</div>
<div class="item-detail"><?php
for($i=0;$i<=7;$i++)
{
if(isset($data->results[0]->address_components[$i]))
{
echo $data->results[0]->address_components[$i]->long_name.', ';
}
}
?></div>
</li>
<?php
}
?>
<?php
for($j=1;$j<=7;$j++)
{
if($infomap['location'.$j]!='')
{
$data1 = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['location'.$j]."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
$data = json_decode($data1);
?>
<li class="tl-item" ng-repeat="item in retailer_history">
<div class="timestamp">
<?php
echo (date('jS F Y',strtotime($infomap['loctime'.$j]))).'<br>'.(date('h:i a',strtotime($infomap['loctime'.$j])));
?>
</div>
<div class="item-title">Reached to Customer <?=$j?> (<a href="callsedit.php?calltid=<?=$infomap['loccall'.$i]?>" target="_blank"><?=$infomap['loccall'.$j]?></a>) - <?=$infomap['lockm'.$j]?>Kms</div>
<div class="item-detail"><?php
for($i=0;$i<=7;$i++)
{
if(isset($data->results[0]->address_components[$i]))
{
echo $data->results[0]->address_components[$i]->long_name.', ';
}
}
?></div>
</li>
<?php
$totalkms+=(float)$infomap['lockm'.$j];
}
}
if($infomap['endlocation']!='')
{
$data1 = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['endlocation']."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
$data = json_decode($data1);
?>
<li class="tl-item" ng-repeat="item in retailer_history">
<div class="timestamp">
<?php
echo (date('jS F Y',strtotime($infomap['endtime']))).'<br>'.(date('h:i a',strtotime($infomap['endtime'])));
?>
</div>
<div class="item-title">Back to Home - <?=$infomap['endkm']?>Kms</div>
<div class="item-detail"><?php
for($i=0;$i<=7;$i++)
{
if(isset($data->results[0]->address_components[$i]))
{
echo $data->results[0]->address_components[$i]->long_name.', ';
}
}
?></div>
</li>
<?php
$totalkms+=(float)$infomap['endkm'];
}
?>
</ul>
<div class="text-center">
<h4>Total Kms Travelled: <?=$totalkms?></h4>
<?php
$points=0;
if($totalkms<75)
{
$points=0;
}
else if(($totalkms>74)&&($totalkms<201))
{
$points=5;
}
else if(($totalkms>200)&&($totalkms<301))
{
$points=10;
}
else if(($totalkms>300)&&($totalkms<401))
{
$points=15;
}
else
{
$points=20;
}
?>
<h5 class="text-danger">Total Travel Points: <?=$points?></h5>
<?php
if($infomap['endlocation']=='')
{
?><br>
<h4><strong>Two Wheeler Allowance</strong></h4>
<br>
<div class="row mb-1">
<div class="col-6">
<label for="startingkm" class="col-form-label"><strong>Starting KM</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="startingkm" id="startingkm" value="<?=$infomap['startingkm']?>" step="0.01"  onchange="kilometercal()"></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="endingkm" class="col-form-label"><strong>Ending KM</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="endingkm" id="endingkm" value="<?=$infomap['endingkm']?>" step="0.01"  onchange="kilometercal()"></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="totalkm" class="col-form-label"><strong>Total KMs</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="totalkm" id="totalkm" value="<?=$infomap['totalkm']?>" step="0.01" readonly onkeydown="kilometercal()" onchange="travelcost1()"></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="rateperkm" class="col-form-label"><strong>Rate Per KM</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="rateperkm" id="rateperkm" value="<?=$_SESSION['companyperkm']?>" step="0.01" onchange="travelcost1()"  readonly></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="travelcost" class="col-form-label"><strong>Two Wheeler Travel Cost</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="travelcost" id="travelcost" value="<?=$infomap['travelcost']?>" step="0.01"  onkeydown="travelcost1()" onchange="totaltravelexpense1()" readonly></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="othercost" class="col-form-label"><strong>Other Travel Expense</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="othercost" id="othercost" value="<?=$infomap['othercost']?>" step="0.01" onchange="totaltravelexpense1()" ></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="travelexpense" class="col-form-label"><strong>Total Travel Expense (Rs.)</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="travelexpense" id="travelexpense" value="<?=$infomap['travelexpense']?>" step="0.01" onchange="totaltravelexpense1();totalexpense()" readonly></div>
</div><hr>
<div class="row mb-1">
<div class="col-6">
<label for="couriercharges" class="col-form-label"><strong>Courier Charges</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="couriercharges" id="couriercharges" value="<?=$infomap['couriercharges']?>" step="0.01" onchange="otherexpense()" ></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="materialcharges" class="col-form-label"><strong>Material Charges</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="materialcharges" id="materialcharges" value="<?=$infomap['materialcharges']?>" step="0.01" onchange="otherexpense()" ></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="othermaterial" class="col-form-label"><strong>Other Expenses</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="othermaterial" id="othermaterial" value="<?=$infomap['othermaterial']?>" step="0.01" onchange="otherexpense()" ></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="tototherexpense" class="col-form-label"><strong>Total Other Expenses (Rs.)</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="tototherexpense" id="tototherexpense" value="<?=$infomap['tototherexpense']?>" step="0.01" onchange="otherexpense();totalexpense()" readonly></div>
</div><hr>
<div class="row mb-1">
<div class="col-6">
<label for="totexpense" class="col-form-label"><strong>Total Expenses (Rs.)</strong></label>
</div>
<div class="col-6"><input type="number" min="0" class="form-control" name="totexpense" id="totexpense" value="<?=$infomap['totexpense']?>" step="0.01" onchange="totalexpense()" readonly></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="customerfeedback" class="col-form-label"><strong>Ticket Images or Two wheeler meter images <br>(Capture all Tickets in One Photo)</strong></label>
</div>
<div class="col-6">
<div id="mulitplefileuploader">Upload</div>
<div id="status"></div>
<div id="showData" class="imgcontainer"><?php if($infomap['tickets']!=''){ $as=explode(',',$infomap['tickets']);$c=1;foreach($as as $a){ echo "<div class='imgcontent' id='imgcontent_".$c."' ><img src='".$a."' width='100' height='100'><span class='imgdelete' id='delete_".$c."'>Delete</span></div>";$c++;}}?></div>
<input id="tickets" type="hidden" name="tickets" value="<?=$infomap['tickets']?>"><br>
</div>
</div>
<a class="btn btn-danger text-white" style="cursor:white" onclick="confirmattendance('<?=$endpoint?>','<?=$attdate?>');"><i class="fas fa-times-circle"></i><br>CLOSE ATTENDANCE</a>
<?php
}
else
{
?>
<div class="row mb-1">
<div class="col-6">
<label for="startingkm" class="col-form-label"><strong>Starting KM</strong></label>
</div>
<div class="col-6"><?=$infomap['startingkm']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="endingkm" class="col-form-label"><strong>Ending KM</strong></label>
</div>
<div class="col-6"><?=$infomap['endingkm']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="totalkm" class="col-form-label"><strong>Total KMs</strong></label>
</div>
<div class="col-6"><?=$infomap['totalkm']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="rateperkm" class="col-form-label"><strong>Rate Per KM</strong></label>
</div>
<div class="col-6"><?=$_SESSION['companyperkm']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="travelcost" class="col-form-label"><strong>Two Wheeler Travel Cost</strong></label>
</div>
<div class="col-6"><?=$infomap['travelcost']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="othercost" class="col-form-label"><strong>Other Travel Expense</strong></label>
</div>
<div class="col-6"><?=$infomap['othercost']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="travelexpense" class="col-form-label"><strong>Total Travel Expense (Rs.)</strong></label>
</div>
<div class="col-6"><?=$infomap['travelexpense']?></div>
</div><hr>
<div class="row mb-1">
<div class="col-6">
<label for="couriercharges" class="col-form-label"><strong>Courier Charges</strong></label>
</div>
<div class="col-6"><?=$infomap['couriercharges']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="materialcharges" class="col-form-label"><strong>Material Charges</strong></label>
</div>
<div class="col-6"><?=$infomap['materialcharges']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="othermaterial" class="col-form-label"><strong>Other Expenses</strong></label>
</div>
<div class="col-6"><?=$infomap['othermaterial']?></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="tototherexpense" class="col-form-label"><strong>Total Other Expenses (Rs.)</strong></label>
</div>
<div class="col-6"><?=$infomap['tototherexpense']?></div>
</div><hr>
<div class="row mb-1">
<div class="col-6">
<label for="totexpense" class="col-form-label"><strong>Total Expenses (Rs.)</strong></label>
</div>
<div class="col-6"><?=$infomap['totexpense']?></div>
</div>
<div id="showData" class="imgcontainer"><?php if($infomap['tickets']!==''){$as=explode(',',$infomap['tickets']);$c=1;foreach($as as $a){echo "<div class='imgcontent' id='imgcontent_".$c."' style='width:100%' ><img src='".$a."' width='100%' height='150'></div>";$c++;}}?></div>
<?php
}
?>
</div>
</div>
</div>
</div>
</div>
<?php
}
else
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-danger text-white shadow">
<div class="card-body">
Attendance not Taken. Kindly Proceed with any <a href="calls.php" style="color:#ffffff;font-weight:bold">Complaint call</a> from your Location.
</div>
</div>
</div>
<?php
}
}
}
else
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-danger text-white shadow">
<div class="card-body">
No Results Found
</div>
</div>
</div>
<?php
}
}
?>
</div>
</div>
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
<script>
function confirmattendance(startip,attdate)
{
var tickets=document.getElementById("tickets");
if(travelexpense.value=="")
{
alert('Enter Total Travel Expense Amount');
travelexpense.focus();
return false;
}
else if(travelexpense.value!="0")
{
if(tickets.value=="")
{
alert('Capture All Tickets in One Image and Upload');
return false;
}
else
{
var r = confirm("Are you sure want to Close this Attendance");
if (r == true) {
endlocation(startip,attdate,tickets.value,travelexpense.value,startingkm.value,endingkm.value,totalkm.value,rateperkm.value,travelcost.value,othercost.value,othermaterial.value,couriercharges.value,materialcharges.value,tototherexpense.value,totexpense.value);
} else {
}
}
}
else
{
var r = confirm("Are you sure want to Close this Attendance");
if (r == true) {
endlocation(startip,attdate,tickets.value,travelexpense.value,startingkm.value,endingkm.value,totalkm.value,rateperkm.value,travelcost.value,othercost.value,othermaterial.value,couriercharges.value,materialcharges.value,tototherexpense.value,totexpense.value);
} else {
}
}
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
function endlocation(ip,att,tic,exp,str,end,tot,rat,tra,oth,mat,cc,mc,toe,te) {
startip=ip;
attdate=att;
tickets=tic;
travelexpense=exp;
startingkm=str;
endingkm=end;
totalkm=tot;
rateperkm=rat;
travelcost=tra;
othercost=oth;
othermaterial=mat;
couriercharges=cc;
materialcharges=mc;
tototherexpense=toe;
totexpense=te;
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
url: "closeattendance.php",
type: "post",
data: { lati: position.coords.latitude, longi: position.coords.longitude, startip:startip, attdate:attdate, tickets:tickets, travelexpense:travelexpense,startingkm:startingkm,endingkm:endingkm,totalkm:totalkm,rateperkm:rateperkm,travelcost:travelcost,othercost:othercost,othermaterial:othermaterial,couriercharges:couriercharges,materialcharges:materialcharges,tototherexpense:tototherexpense,totexpense:totexpense},
success: function (data) {
console.log(data);
window.location.reload();
}
});
}
</script>
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
<script>
function image(thisImg) {
// var img = document.createElement("IMG");
// img.src = thisImg;
// img.className="img-fluid";
// document.getElementById('showData').appendChild(img);
var count = $('.imgcontainer .imgcontent').length;
count = Number(count) + 1;
$('.imgcontainer').append("<div class='imgcontent' id='imgcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgdelete' id='imgdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
url: "ticketups.php",
method: "POST",
allowedTypes:"jpg,png,jpeg",
fileName: "myfile",
multiple: true,
maxFileCount:5,
acceptFiles:"image/*;capture=camera",
onSuccess:function(files,data,xhr)
{
var obj = JSON.parse(data);
console.log(obj.imglist);
image(obj.imglist);
var vals=$("#tickets").val();
if(vals!='')
{
$("#tickets").val(vals+','+obj.imglist);
}
else
{
$("#tickets").val(obj.imglist);
}
$("#status").html("<font color='green'>Upload is success</font>");
},
onError: function(files,status,errMsg)
{
$("#status").html("<font color='red'>Upload is Failed</font>"+errMsg);
}
}
$("#mulitplefileuploader").uploadFile(settings);
});
</script>
<script>
// Remove file
$('.imgcontainer').on('click','.imgcontent .imgdelete',function(){
var id = this.id;
var split_id = id.split('_');
var num = split_id[1];
// Get image source
var imgElement_src = $( '#imgcontent_'+num+' img' ).attr("src");
var deleteFile = confirm("Do you really want to Delete?");
if (deleteFile == true) {
var vals=$("#tickets").val();
let newStr = vals.replace(imgElement_src+',', '');
newStr = newStr.replace(','+imgElement_src, '');
newStr = newStr.replace(imgElement_src, '');
$("#tickets").val(newStr);
$('#imgcontent_'+num).remove();
// AJAX request
/* $.ajax({
url: 'complaintrems.php',
type: 'post',
data: {path: imgElement_src,request: 2},
success: function(response){
if(response == 1){
$('#imgcontent_'+num).remove();
}
}
}); */
}
});
</script>
<script>
function kilometercal()
{
var startingkm = document.getElementById("startingkm").value;
var endingkm = document.getElementById("endingkm").value;
if(startingkm!="" && endingkm!="")
{
document.getElementById("totalkm").value =(parseFloat(endingkm)-parseFloat(startingkm));
}
else
{
document.getElementById("totalkm").value ="";
}
travelcost1();
}
</script>
<script>
function travelcost1()
{
var totalkm = document.getElementById("totalkm").value;
var rateperkm = document.getElementById("rateperkm").value;
document.getElementById("travelcost").value =(parseFloat(totalkm) * parseFloat(rateperkm));
totaltravelexpense1();
}
</script>
<script>
function totaltravelexpense1()
{
var travelcost = document.getElementById("travelcost").value;
if(travelcost=="")
{
travelcost=0;
}
var othercost = document.getElementById("othercost").value;
if(othercost=="")
{
othercost=0;
}
document.getElementById("travelexpense").value =(parseFloat(travelcost)+parseFloat(othercost));
otherexpense();
}
function otherexpense()
{
var couriercharges = document.getElementById("couriercharges").value;
if(couriercharges=="")
{
couriercharges=0;
}
var materialcharges = document.getElementById("materialcharges").value;
if(materialcharges=="")
{
materialcharges=0;
}
var othermaterial = document.getElementById("othermaterial").value;
if(othermaterial=="")
{
othermaterial=0;
}
document.getElementById("tototherexpense").value =(parseFloat(couriercharges)+parseFloat(materialcharges)+parseFloat(othermaterial));
totalexpense();
}
function totalexpense()
{
var travelexpense = document.getElementById("travelexpense").value;
if(travelexpense=="")
{
travelexpense=0;
}
var tototherexpense = document.getElementById("tototherexpense").value;
if(tototherexpense=="")
{
tototherexpense=0;
}
document.getElementById("totexpense").value =(parseFloat(travelexpense)+parseFloat(tototherexpense));
}
</script>
</body>
</html>