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
<title><?=$_SESSION['companyname']?> - Jerobyte - Waiting for Approval Calls</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
.go-corner {
display: flex;
align-items: center;
justify-content: center;
position: absolute;
width: 32px;
height: 32px;
overflow: hidden;
top: 0;
right: 0;
background-color: #3d8eb9;
border-radius: 0 4px 0 32px;
}
.go-arrow {
margin-top: -4px;
margin-right: -4px;
color: white;
font-family: courier, sans;
}
.card1 {
display: block;
position: relative;
background-color: #3d8eb9;
text-decoration: none;
z-index: 0;
overflow: hidden;
}
.card1:before {
content: "";
position: absolute;
z-index: -1;
top: -16px;
right: -16px;
background: #ffffff;
height: 32px;
width: 32px;
border-radius: 32px;
transform: scale(1);
transform-origin: 50% 50%;
transition: transform 0.25s ease-out;
}
.card1:hover:before {
transform: scale(21);
}
.card1:hover {
color: #3d8eb9 !important;
}
</style>
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col">
<h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Waiting for Approval</b></h1>
</div>
<div class="col-auto" style="padding-top:10px; text-align: right;">
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
<div class="input-group">
<input type="text" id="reportrange" name="reportrange" class="form-control"/>
<div class="input-group-append">
<button class="btn btn-navb" type="submit" name="submit">
<i class="fa-solid fa-calendar-days fa-sm" style="color: #3d8eb9;"></i>
</button>
<button class="btn btn-navb" type="submit">
<a href="wcalls.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
</button>
</div>
</div>
</form>
</div>
</div>
<?php
if(isset($_GET['remarks']))
{
?>
<div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
<?php
}
if(isset($_GET['error']))
{
?>
<div class="alert alert-danger shadow"><?=$_GET['error']?></div>
<?php
}
$statitle="";
$staqu="";
if(isset($_GET['status']))
{
if($_GET['status']=='2')
{
$statitle=" - Completed";
$staqu=" where compstatus='2'";
}
else if($_GET['status']=='1')
{
$statitle=" - Pending";
$staqu=" where compstatus='1'";
}
else
{
$statitle=" - Open";
$staqu=" where compstatus='0'";
}
}
if($staqu!="")
{
$staqu.=" and (actiontaken='WAITING FOR APPROVAL' and wastatus='0')  ";
}
else
{
$staqu.=" where (actiontaken='WAITING FOR APPROVAL' and wastatus='0')";
}
if(isset($_GET['prob']))
{
$prob=mysqli_real_escape_string($connection, $_GET['prob']);
if($staqu!="")
{
$staqu.=" and reportedproblem='".$prob."'";
}
else
{
$staqu.=" where reportedproblem='".$prob."'";
}
}
if(isset($_GET['action']))
{
$prob=mysqli_real_escape_string($connection, $_GET['action']);
if($staqu!="")
{
$staqu.=" and actiontaken='".$prob."'";
}
else
{
$staqu.=" where actiontaken='".$prob."'";
}
}
if(isset($_GET['ctype']))
{
$prob=mysqli_real_escape_string($connection, $_GET['ctype']);
if($staqu!="")
{
$staqu.=" and calltype='".$prob."'";
}
else
{
$staqu.=" where calltype='".$prob."'";
}
}
if(isset($_GET['nature']))
{
$prob=mysqli_real_escape_string($connection, $_GET['nature']);
if($staqu!="")
{
$staqu.=" and callnature='".$prob."'";
}
else
{
$staqu.=" where callnature='".$prob."'";
}
}
?>
<?php
if(isset($_POST['submit']))
{
$dashfromdate=date('Y-m-d',strtotime($_POST['dashfromdate']));
$dashtodate=date('Y-m-d',strtotime($_POST['dashtodate']));
$dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
$dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
if($staqu!="")
{
$staqu.=' and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
else
{
$staqu.=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
}
else
{
$dashfromdate='';
$dashtodate='';
$dashcallonsearch='';
$dashschargesearch='';
}
?>
<div class="row">
<div class="col-xl-12 col-md-6 ">
<div class="card bg-white text-primary shadow" role="button" >
<div class="card-statistic-3 p-3">
<div class="row">
<?php
$sqlselect = "SELECT count(id) as count, calltype From jrccalls ".$staqu." group by calltype order by calltype desc";
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
<!-- new start-->	<div class="col-xl-6 col-md-6 ">
<div class="card shadow">
<!-- Card Header - Dropdown -->
<div class="card-header py-2">
<h6 class="m-0 font-weight-bold text-black text-center" ><?=strtoupper($rowselect['calltype']).'S'?> (<span ><?=$rowselect['count']?></span>)</h6>
</div>
<!-- Card Body -->
<div class="card-body" style="height:280px; overflow-y:auto">
<table class="table">
<tr>
<th>Call Type</th>
<th>Total Calls</th>
</tr>
<?php
$staqu1=$staqu;
if($staqu1!="")
{
$staqu1.=" and calltype='".$rowselect['calltype']."'";
}
else
{
$staqu1.=" where calltype='".$rowselect['calltype']."'";
}
$sqlselect1 = "SELECT count(id) as count, callnature From jrccalls ".$staqu1." group by callnature order by count desc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
$rowCountselect1 = mysqli_num_rows($queryselect1);
if(!$queryselect1){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect1 > 0)
{
?>
<div class="row">
<?php
$count=1;
while($rowselect1 = mysqli_fetch_array($queryselect1))
{
?>
<tr>
<td onClick="window.location.href= 'ocalls.php?<?=(isset($_GET['status']))?'status='.(mysqli_real_escape_string($connection, $_GET['status'])):''?><?=(isset($_GET['status']))?'&ctype='.$rowselect['calltype']:'ctype='.$rowselect['calltype']?><?=(isset($_GET['status']))?'&nature='.$rowselect1['callnature']:'&nature='.$rowselect1['callnature']?>'"><?=strtoupper($rowselect1['callnature'])?></td>
<td class="text-center" ><?=$rowselect1['count']?></td>
</tr>
<?php
}
}
?>
</table>
</div>
</div>
<div class="row align-items-center  d-flex" style="font-size:14px;">
<div class="col-12 text-center">
</div>
</div>
</div>
<!-- new end-->
<?php
}
}
?>
</div>
</div>
</div>
</div>
</div>
<?php
if(isset($_GET['status']))
{
if($_GET['status']=='1')
{
?>
<h6>Pending Reasons</h6>
<div class="row">
<?php $sqlselect = "SELECT count(id) as count, actiontaken From jrccalls ".$staqu." group by actiontaken order by count desc";
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
<div class="col-xl-2 col-md-2 mb-4">
<div class="card bg-primary text-white shadow1 card1" role="button">
<div class="card-statistic-3 p-3">
<div class="row align-items-center  d-flex" style="font-size:14px;">
<div class="col-12 text-center" onClick="window.location.href= 'wcalls.php?<?=(isset($_GET['status']))?'status='.(mysqli_real_escape_string($connection, $_GET['status'])):''?><?=(isset($_GET['status']))?'&action='.$rowselect['actiontaken']:'action='.$rowselect['actiontaken']?>'">
<h5 class="card-title mb-0" style="font-size:0.7rem; line-height:1.5; font-weight:bold"><?=$rowselect['actiontaken']?> <br><span style="font-size:1.5rem;"><?=$rowselect['count']?></span></h5>
</div>
</div>
</div>
<div class="go-corner" href="#"><div class="go-arrow">→</div></div>
</div>
</div>
<?php
}
}
?>
</div>
<?php
}
}
?>
<div class="card shadow mb-4">
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>S.No</th>
<th>Call ID and Date</th>
<th>Call Details</th>
<th>Customer Details</th>
<th>Product Details</th>
<th>Problem Details</th>
<th>Status</th>
<?php
if($calledit=='1')
{
?>
<th>Action</th>
<?php
}
?>
</tr>
</thead>
<tbody>
<?php
$sqlselect = "SELECT sourceid, callfrom, callon, calltid, acknowlodge, compstatus, changeon, id, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid,engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, callnature, customernature, businesstype, servicetype, calltype, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid From jrccalls ".$staqu." order by id desc";
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
$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
$queryxl = mysqli_query($connection, $sqlxl);
$rowCountxl = mysqli_num_rows($queryxl);
if(!$queryxl){
die("SQL query failed: " . mysqli_error($connection));
}
$rowxl = mysqli_fetch_array($queryxl);
$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
$sqlcons = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
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
$rowcons['address1']=jbsdecrypt($_SESSION['encpass'], $rowcons['address1']);
}
if($rowcons['phone']!='')
{
$rowcons['phone']=jbsdecrypt($_SESSION['encpass'], $rowcons['phone']);
}
if($rowcons['mobile']!='')
{
$rowcons['mobile']=jbsdecrypt($_SESSION['encpass'], $rowcons['mobile']);
}
if($rowcons['email']!='')
{
$rowcons['email']=jbsdecrypt($_SESSION['encpass'], $rowcons['email']);
}
}
}
?>
<tr>
<td> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowselect['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
<td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
<br>
<?=$rowselect['callfrom']?><br>
<?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?>
<br><?php
if($rowselect['acknowlodge']=='1')
{
?>
<span class="badge badge-primary">Approved</span>
<?php
}
else
{
?>
<span class="badge badge-default shadow">Wait for Appr.</span>
<?php
}
?>
</td>
<td>
C/H: <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
C/O: <a href="coordinatorview.php?id=<?=$rowselect['coordinatorid']?>"><?=$rowselect['coordinatorname']?></a><br>
<?php
if($rowselect['engineertype']=='1')
{
$engnsid=explode(',',$rowselect['engineersid']);
$engnsname=explode(',',$rowselect['engineersname']);
for($eise=0; $eise<count($engnsid);$eise++)
{
?>
E-<?=($eise+1)?>: <a href="mapengineerview.php?id=<?=$engnsid[$eise]?>&attdate=<?=date('Y-m-d')?>"><?=$engnsname[$eise]?> <?=($rowselect['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
<?php
}
}
else
{
?>
E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
<?php
}
?>
<?php
if($rowselect['businesstype']!='')
{
?>
<span class="btn btn-sm btn-success"><?=$rowselect['businesstype']?></span><br>
<?php
}
if($rowselect['servicetype']!='')
{
?>
<span class="btn btn-sm btn-danger"><?=$rowselect['servicetype']?></span><br>
<?php
}
if($rowselect['customernature']!='')
{
?>
<span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
<?php
}
if($rowselect['callnature']!='')
{
?>
<span class="btn btn-sm btn-primary"><?=$rowselect['callnature']?></span><br>
<?php
}
if($rowselect['compstatus']!='2')
{
if($callchange=='1')
{
?>
<a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-warning">Change Details</a>
<?php
}
}
?>
</td>
<?php
if($rowxl['consigneename']!="")
{
?>
<td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>"><?=$rowxl['consigneename']?></a><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></td>
<?php
}
else
{
?>
<td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>">View</a></td>
<?php
}
?>
<td><?php
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<?=$rowxl['stockmaincategory']?> -
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<?=$rowxl['stocksubcategory']?> -
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<?=$rowxl['componentname']?> -
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<?=$rowxl['stockitem']?>
<?php
}
?><br><b>Serial:</b> <?=$rowselect['serial']?></td>
<td><b>Reported:</b> <span class="text-primary"><?=$rowselect['reportedproblem']?></span><br>
<b>Observed:</b> <span class="text-primary"><?=$rowselect['problemobserved']?></span><br>
<b>Action:</b> <b class="text-danger"><?=$rowselect['actiontaken']?></b><br>
<b>Narration:</b> <span class="text-primary"><?=$rowselect['narration']?></span>
<?php
if($rowselect['businesstype']=='COPIER')
{
$totalmeterreading="";
if($rowselect['detailsid']!='')
{
$sqlise=mysqli_query($connection, "select totalmeterreading from jrccalldetails where id='".$rowselect['detailsid']."'");
$infose=mysqli_fetch_array($sqlise);
$totalmeterreading=$infose['totalmeterreading'];
}
else
{
$totalmeterreading=$rowselect['otherremarks'];
}
?>
<br>
<b>Last Meter Reading:</b> <span class="text-primary"><?=$totalmeterreading?></span>
<?php
}
?>
</td>
<td>
<?php
if($rowselect['compstatus']=='2')
{
?>
<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
<?php
}
else if($rowselect['compstatus']=='1')
{
?>
<span class="text-danger">Pending </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
<?php
}
else
{
?>
<span class="text-warning">Open</span>
<?php
}
?>
</td>
<?php
if($calledit=='1')
{
if($rowselect['compstatus']!='2')
{
?>
<td><a href="callsedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
<?php
}
if($rowselect['compstatus']=='2' && $rowselect['actiontaken']=='WAITING FOR APPROVAL')
{
?>
<td><a href="callsedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
<?php
}
else
{
?>
<td></td>
<?php
}
}
?>
</tr>
<?php
$count++;
}
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php'); ?>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<!--Modal starts Here-->
<div class="modal fade" id="dynamicModal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Waiting for Approval Calls</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="callhistorybody">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
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
<!-- Page level plugins -->
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="../../1637028036/js/datatables.js"></script>
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
function searchhistory(id)
{
var id=id;
$.ajax({
url:"searchcallhistory.php",
method:"post",
data:{id:id},
success:function(response){
$("#callhistorybody").html(response);
$("#dynamicModal").modal('show');
}
})
}
</script>
<!------------daterangepicker--->
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/moment.min.js"></script>
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {
var start = moment().subtract(6, 'days');
var end = moment();
function cb(start, end) {
$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}
$('#reportrange').daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'Last 365 Days': [moment().subtract(364, 'days'), moment()],
'This Week': [moment().startOf('week'), moment().endOf('week')],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'This Year': [moment().startOf('year'), moment().endOf('year')],
'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')], 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
}
}, cb);
cb(start, end);
<?php
if((isset($dashfromdate))&&($dashfromdate!=''))
{
?>
$('#reportrange').data('daterangepicker').setStartDate('<?=date('m/d/Y',strtotime($dashfromdate))?>');
$('#reportrange').data('daterangepicker').setEndDate('<?=date('m/d/Y',strtotime($dashtodate))?>');
<?php
}
?>
});
</script>
<!------------daterangepicker--->
<?php include('additionaljs.php');   ?>
</body>
</html>