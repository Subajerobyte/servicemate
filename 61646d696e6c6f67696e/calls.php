<?php 
include('lcheck.php');
if($callview=='0')
{
header("location: dashboard.php");
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Call History</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<style>
.blink {
animation: blinker 1s step-start infinite;
}
@keyframes blinker {
50% {
opacity: 0;
}
}
</style>
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php include('callnavbar.php'); ?>
<div class="container-fluid">
<?php
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
else if($_GET['status']=='3')
{
$statitle=" - Cancelled";
$staqu=" where compstatus='3'";
}
else if($_GET['status']=='Received')
{
$statitle=" - Received";
$staqu=" where compstatus='0'";
}
else if($_GET['status']=='Assigned')
{
$statitle=" - Assigned";
$staqu=" where (engineerid!='' or engineersid!='') and  compstatus='0'";
}
else
{
$statitle=" - Open";
$staqu=" where compstatus='0'";
}
}
?>
<!-- Page Heading -->
<div class="row">
<div class="col">
<h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Call History<?=$statitle?></b></h1>
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
<a href="calls.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
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
<div class="alert alert-success shadow">
<?=$_GET['remarks']?>
</div>
<?php
}
if(isset($_GET['error']))
{
?>
<div class="alert alert-danger shadow">
<?=$_GET['error']?>
</div>
<?php
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
$reportrange=mysqli_real_escape_string($connection, $_POST['reportrange']);
$reportrange = explode(' - ', $reportrange);
$from = $reportrange[0];
$to   = $reportrange[1];
$from = explode('/', $from);
$month   =$from[0];
$date   =$from[1];
$year = $from[2];
$fromdate =$from[2]."-".$from[0]."-".$from[1];
$to = explode('/', $to);
$month1   = $to[0];
$date1   = $to[1];
$year1 = $to[2];
$todate =$to[2]."-".$to[0]."-".$to[1];
$dashfromdate=date('Y-m-d',strtotime($fromdate));
$dashtodate=date('Y-m-d',strtotime($todate));
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
if(isset($_GET['status']))
{
if($_GET['status']=='1')
{
$dashfromdate="2021-01-01";
$dashtodate=date('Y-m-t');
}
else if($_GET['status']=='2')
{
if(isset($_GET['lform']))
{
$dashfromdate=date('Y-m-d');
$dashtodate=date('Y-m-d');
}
else{
$dashfromdate=date('Y-m-01');
$dashtodate=date('Y-m-t');
}
}
else if($_GET['status']=='Received')
{
$dashfromdate=date('Y-m-d');
$dashtodate=date('Y-m-d');
}
else if($_GET['status']=='Assigned')
{
$dashfromdate=date('Y-m-d');
$dashtodate=date('Y-m-d');
}
else{
$dashfromdate="2021-01-01";
$dashtodate=date('Y-m-t');
}
}
else {
$dashfromdate=date('Y-m-01');
$dashtodate=date('Y-m-t');
}
$dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
$dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
if(isset($_GET['status']))
{
if(($_GET['status']=='1') ||($_GET['status']=='2') )
{
if($staqu!="")
{
$staqu.=' and changeon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
else
{
$staqu.=' where changeon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
}
else
{
if($staqu!="")
{
$staqu.=' and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
else
{
$staqu.=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
}
}
else{
if($staqu!="")
{
$staqu.=' and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
else
{
$staqu.=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
}
}
}
?>
<div class="row">
<?php
$t1=1;
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
<div class="col-xl-6 col-md-6 ">
<div class="card bg-white text-primary shadow" role="button" >
<div class="card-statistic-3 p-3"><div class="row">
<div class="col-xl-12 col-md-6 ">
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
${'tname'.$t1}=strtoupper($rowselect['calltype']).'S';
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
if(!$queryselect1)
{
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect1 > 0)
{
?>
<div class="row">
<?php
$count=1;
${'tpy'.$t1}=array();
${'tpv'.$t1}=array();
while($rowselect1 = mysqli_fetch_array($queryselect1))
{
?>
<tr>
<td onClick="window.location.href= 'calls.php?<?=(isset($_GET['status']))?'status='.(mysqli_real_escape_string($connection, $_GET['status'])):''?><?=(isset($_GET['status']))?'&ctype='.$rowselect['calltype']:'ctype='.$rowselect['calltype']?><?=(isset($_GET['status']))?'&nature='.$rowselect1['callnature']:'&nature='.$rowselect1['callnature']?>'"><?=${'tpy'.$t1}[]=strtoupper($rowselect1['callnature']);?></td>
<td class="text-center" ><?=${'tpv'.$t1}[]=$rowselect1['count'];?></td>
</tr>
<?php
}
$t1++;
}
?>	<?php
?>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="row align-items-center  d-flex" style="font-size:14px;">
<div class="col-12 text-center">
</div>
</div>
</div>
</div>
<?php
$t1++;
}
}
?>
</div>
<br>
<?php
if(isset($_GET['status']))
{
if($_GET['status']=='1')
{
?><div class="row"><div class="col-xl-12 col-md-12">
<div class="card bg-white text-primary shadow" role="button" >
<div class="card-statistic-3 p-3"><div class="row">
<div class="col-xl-12 col-md-6 ">
<div class="card shadow">
<div class="card-header py-2">
<h6 class="m-0 font-weight-bold text-black text-center">Pending Reasons</h6>
</div>
<div class="card-body" style="height:280px; overflow-y:auto">
<table class="table">
<tr>
<th>Call Reasons</th>
<th>Total Calls</th>
</tr>
<?php
$sqlselect = "SELECT count(id) as count, actiontaken From jrccalls ".$staqu." group by actiontaken order by count desc";
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
<tr>
<td><?=$rowselect['actiontaken'];?></td>
<td class="text-center"><?=$rowselect['count']?></td>
</tr>
<?php
}
}
?>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<br>
<div class="card shadow mb-4">
<!--<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Call History <?=$statitle?></h6>
</div>-->
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>S.No</th>
<th>Call ID and Date</th>
<th>Call Details</th>
<th>Type Details</th>
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
$sqlselect = "SELECT sourceid, callfrom, callon, calltid, acknowlodge, compstatus, changeon, id, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid,engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, callnature, customernature, businesstype, servicetype, calltype, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid,otherremarks From jrccalls ".$staqu." order by id desc";
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
if(isset($rowxl['consigneeid']))
{
$consigneeid=mysqli_real_escape_string($connection,($rowxl['consigneeid']));
$sqlcons = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email,consigneename,id From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$querycons = mysqli_query($connection, $sqlcons);
$rowCountcons = mysqli_num_rows($querycons);
if(!$querycons){
die("SQL query failed: " . mysqli_error($connection));
}
$rowcons = mysqli_fetch_array($querycons);
}
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
if($rowselect['engineersname']!='')
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
else if($rowselect['compstatus']!='2')
{
?>
<a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-danger blink">Assign Engineer</a>
<?php
}
}
else
{
if($rowselect['engineername']!='')
{
?>
E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
<?php
}
else if($rowselect['compstatus']!='2')
{
?>
<a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-danger blink">Assign Engineer</a>
<?php
}
}
?>
<br>
<?php
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
<td>
<?php
if($rowselect['businesstype']!='')
{
?>
<span class="text-success text-bold"><?=$rowselect['businesstype']?></span><br>
<?php
}
if($rowselect['servicetype']!='')
{
?>
<span class="text-danger text-bold"><?=$rowselect['servicetype']?></span><br>
<?php
}
if($rowselect['customernature']!='')
{
?>
<span class="text-info text-bold"><?=$rowselect['customernature']?></span><br>
<?php
}
if($rowselect['callnature']!='')
{
?>
<span class="text-primary text-bold"><?=$rowselect['callnature']?></span><br>
<?php
}
?>
</td>
<?php
if((isset($rowxl['consigneeid'])!=''))
{
?>
<td><a href="consigneeview.php?id=<?=$rowcons['id']?>"><?=$rowcons['consigneename']?></a><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></td>
<?php
}
else
{
?>
<td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>">View</a></td>
<?php
}
?>
<td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span><br><b>Serial:</b> <?=$rowselect['serial']?></td>
<td><b>Reported:</b> <span class="text-primary"><?=$rowselect['reportedproblem']?></span><br>
<b>Observed:</b> <span class="text-primary"><?=$rowselect['problemobserved']?></span><br>
<b>Action:</b> <span class="text-primary"><?=$rowselect['actiontaken']?></span><br>
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
$totalmeterreading=(($rowselect['otherremarks']!='')?$rowselect['otherremarks']:'');
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
else if($rowselect['compstatus']=='3')
{
?>
<span class="text-info">Cancelled </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
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
if($rowselect['compstatus']=='0')
{
?>
<td><a href="callsedit.php?id=<?=$rowselect['id']?>&rd=open">Edit</a></td>
<?php
}
else
{
?>
<td><a href="callsedit.php?id=<?=$rowselect['id']?>&rd=pending">Edit</a></td>
<?php
}
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
<?php
/* if($_SESSION['companyid']=='1')
{
?>
<div class="row">
<div class="col-lg-4">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6635039710002828"
crossorigin="anonymous"></script>
<!-- Square -->
<ins class="adsbygoogle"
style="display:block"
data-ad-client="ca-pub-6635039710002828"
data-ad-slot="7662356617"
data-ad-format="auto"
data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div class="col-lg-4">
<!-- Square -->
<ins class="adsbygoogle"
style="display:block"
data-ad-client="ca-pub-6635039710002828"
data-ad-slot="7662356617"
data-ad-format="auto"
data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div class="col-lg-4">
<!-- Square -->
<ins class="adsbygoogle"
style="display:block"
data-ad-client="ca-pub-6635039710002828"
data-ad-slot="7662356617"
data-ad-format="auto"
data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
<?php
} */
?>
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
<h5 class="modal-title">Call History</h5>
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
<?php
for($at=1;$at<$t1;$at++)
{
?>
<script>
var xValues = [<?php foreach (${'tpy'.$at} as $sd){ echo "'".$sd."',";}?>];
var yValues = [<?php foreach (${'tpv'.$at} as $sa){ echo $sa.',';}?>];
var barColors = [
"#FF6C95",
"#6F9FF5",
"#04DCCB",
"#FF9C7F",
"#77808F",
"#8A61EA",
"#FF5D68",
"#C976DB",
"#FEC368",
"#02DB9E",
"#b91d47",
"#00aba9",
"#2b5797",
"#e8c3b9",
"#1e7145"
];
new Chart("myChart<?=$at?>", {
type: "pie",
data: {
labels: xValues,
datasets: [{
backgroundColor: barColors,
data: yValues
}]
},
options: {
title: {
display: true,
text: "<?=${'tname'.$at}?>"
},
plugins: {
labels: {
render: 'value'
}
}
}
});
</script>
<?php
}
?>
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