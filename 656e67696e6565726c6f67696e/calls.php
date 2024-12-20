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
<title><?=$_SESSION['companyname']?> - Jerobyte - Complaints</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
<h1 class="h4 mb-0 text-gray-800">Complaints</h1>
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
?>
<?php
if(!isset($_GET['status']))
{
?>
<div class="row">
<?php
$totalcalls=0;
$totalopen=0;
$totalpending=0;
$totalcomplete=0;
$totalcancel=0;
$todaycalls=0;
$todayopen=0;
$todaypending=0;
$todaycomplete=0;
$todaycancel=0;
$sqlcall = "SELECT * From jrccalls where (engineerid='".$id."' or find_in_set('".$id."', engineersid)) order by id desc";
$querycall = mysqli_query($connection, $sqlcall);
$rowCountcall = mysqli_num_rows($querycall);
if(!$querycall){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcall > 0)
{
$count=1;
while($rowcall = mysqli_fetch_array($querycall))
{
$totalcalls++;
if($rowcall['compstatus']=='0')
{
$totalopen++;
}
if($rowcall['compstatus']=='1')
{
$totalpending++;
}
if($rowcall['compstatus']=='2')
{
$totalcomplete++;
}
if($rowcall['compstatus']=='3')
{
$totalcancel++;
}
if(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))
{
$todaycalls++;
if($rowcall['compstatus']=='0')
{
$todayopen++;
}
if($rowcall['compstatus']=='1')
{
$todaypending++;
}
if($rowcall['compstatus']=='2')
{
$todaycomplete++;
}
if($rowcall['compstatus']=='3')
{
$todaycancel++;
}
}
}
}
$result = mysqli_query($connection,"select year(callon) as year, month(callon) as month, count(id) as total_calls
from jrccalls
group by year(callon), month(callon) order by id asc");
$i=0;
$months='';
$totals='';
while($row = mysqli_fetch_array($result))
{
$month_name = date("F", mktime(0, 0, 0, $row["month"], 10));
if($months=='')
{
$months='"'.$row["year"].'-'.$month_name.'"';
}
else
{
$months.=', "'.$row["year"].'-'.$month_name.'"';
}
if($totals=='')
{
$totals=''.$row["total_calls"].'';
}
else
{
$totals.=', '.$row["total_calls"].'';
}
}
?>
<div class="col-xl-6 col-md-6 mb-4">
<div class="card bg-primary text-white shadow h-100 py-1" role="button" onclick="window.location.href= 'calls.php?status=ALL'">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="font-weight-bold text-uppercase mb-1">Total Calls (90 Days)</div>
<div class="h4 mb-1 font-weight-bold"><?=$totalcalls?></div>
<div class="h6 mb-1">(Today: <?=$todaycalls?>) Click here to View Calls</div>
</div>
<div class="col-auto">
<i class="fas fa-phone fa-2x"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-6 col-md-6 mb-4">
<div class="card bg-info text-white shadow h-100 py-1" role="button" onclick="window.location.href= 'calls.php?status=0'">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="font-weight-bold text-uppercase mb-1">Open Calls</div>
<div class="h4 mb-1 font-weight-bold"><?=$totalopen?></div>
<div class="h6 mb-1">(Today: <?=$todayopen?>) Click here to View Calls</div>
</div>
<div class="col-auto">
<i class="fas fa-hourglass-half fa-2x"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-6 col-md-6 mb-4">
<div class="card bg-warning text-gray-800 shadow h-100 py-1" role="button" onclick="window.location.href= 'calls.php?status=1'">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="font-weight-bold text-uppercase mb-1">Pending Calls</div>
<div class="h4 mb-1 font-weight-bold"><?=$totalpending?></div>
<div class="h6 mb-1">(Today: <?=$todaypending?>) Click here to View Calls</div>
</div>
<div class="col-auto">
<i class="fas fa-exclamation-triangle fa-2x"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-6 col-md-6 mb-4">
<div class="card bg-danger text-white shadow h-100 py-1" role="button" onclick="window.location.href= 'calls.php?status=3'">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="font-weight-bold text-uppercase mb-1">Cancelled Calls</div>
<div class="h4 mb-1 font-weight-bold"><?=$totalcancel?></div>
<div class="h6 mb-1">(Today: <?=$todaycancel?>) Click here to View Calls</div>
</div>
<div class="col-auto">
<i class="fas fa-solid fa-phone-slash fa-2x"></i>

</div>
</div>
</div>
</div>
</div>
<div class="col-xl-6 col-md-6 mb-4">
<div class="card bg-success text-white shadow h-100 py-1" role="button" onclick="window.location.href= 'calls.php?status=2'">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="font-weight-bold text-uppercase mb-1">Closed Calls (90 Days)</div>
<div class="h4 mb-1 font-weight-bold"><?=$totalcomplete?></div>
<div class="h6 mb-1">(Today: <?=$todaycomplete?>) Click here to View Calls</div>
</div>
<div class="col-auto">
<i class="fas fa-check fa-2x"></i>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
$opencallstatus=0;
if(isset($_GET['status']))
{
$Q='';
if($_GET['status']!='ALL')
{
$Q='and compstatus="'.mysqli_real_escape_string($connection,$_GET['status']).'"';
}
$staqu='';
if($_GET['status']=='2')
{
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
				
			   $dashfromdate=mysqli_real_escape_string($connection,$fromdate);
			  $dashtodate=mysqli_real_escape_string($connection,$todate);
			 $dashcallonsearch=' and (callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
			  $dashschargesearch=' and (schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
			  
			  if($staqu!="")
				{
					$staqu.=' and (callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
				}
				else
				{
					$staqu.=' and (callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
				}
		  }
		  else
		  {
			  
			  $currentDate = date('Y-m-d');  // Current date
			 $dashfromdate = date('Y-m-d', strtotime('-90 days', strtotime($currentDate)));  // 30 days ago from the current date
			 $dashtodate = $currentDate;  
			  $dashcallonsearch=' and (callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
			  $dashschargesearch=' and (schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
			  
			  if($staqu!="")
				{
					$staqu.=' and (callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
				}
				else
				{
					$staqu.=' and (callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
				}
			  
			  
		  }
	
	
	?><form method="POST"><div class="row">
	<div class="col-sm-6 mb-3"></div>
		<div class="col-sm-6 mb-3">
                                <div class="form-group row" style="margin-bottom: 0rem;">
                                   <div class="col-sm-8 mb-1 col-8">
                                    <input type="text"  id="reportrange"  name="reportrange" class="form-control"/>
									</div>	
									<div class="col-sm-4 mb-1 col-4">
                                <button type="submit" name="submit" class="btn btn-success btn-block">GET INFO</button>
								</div>
                                </div>
								
							
								
								</div>
								</div>
								</form>
								<?php
}
?>

<div class="row">

<div class="col-sm-12 mb-3">
<input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Search..">
<span class="text-black-50 small">Hints: Open, Pending, Date, Mobile, Name, Address</span>
</div>							
</div>
<div class="row" id="myItems">

<?php
$qs="";
$sqlroute = "SELECT id From jrcengroute WHERE engineerid = '{$engineerid}' and (endlocation='' or endlocation is null) and attdate!='".date('Y-m-d')."' and attdate> now() -  interval 15 day";
$queryroute = mysqli_query($connection, $sqlroute);
$preclose = mysqli_num_rows($queryroute);
$sqlselect = "SELECT * From jrccalls where (engineerid='".$id."' or find_in_set('".$id."', engineersid)) ".$Q." ".$staqu ."  order by id desc";
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
else if($rowselect['compstatus']=='3')
{
$bg="bg-info";
$bgtext="Cancelled";
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
<h5>Product Details:</h5>
<p><?php
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
?><br><?=$rowselect['serial']?></p>
<hr>
<h5>Problem Details:</h5>
<p>Reported: <?=$rowselect['reportedproblem']?> <?=($rowselect['otherremarks']!='')?'('.$rowselect['otherremarks'].')':''?><br>
Observed: <?=$rowselect['problemobserved']?><br>
Action Taken: <?=$rowselect['actiontaken']?></p>
<?php
if(($bgtext!='Completed'))
{
if(($bgtext=='Pending')||($bgtext=='Open'))
{
$sqliselect=mysqli_query($connection, "select * from jrccallstravel where calltid='".$rowselect['calltid']."' and engineerid='".$id."'");
$rowselect2=mysqli_fetch_array($sqliselect);
if($rowselect2['acknowlodge']=='1')
{
if($rowselect2['startip']!='')
{
$opencallstatus++;
?>
<a class="btn btn-sm btn-success text-white mb-1"><i class="fas fa-check"></i> Started from my Location (<?=$rowselect2['startip']?>)</a><br>
<?php
if($rowselect2['endip']!='')
{
$opencallstatus--;
?>
<a class="btn btn-sm btn-success text-white mb-1"><i class="fas fa-check"></i> Reached to Customer Location (<?=$rowselect2['endip']?>) (Total: <?=$rowselect2['kms']?>kms)</a><br>
<?php
if((($rowselect['engineertype']=='1')&&($rowselect['reportingengineerid']==$engineerid))||($rowselect['engineertype']=='0'))
{
if($rowselect['detailsid']!='')
{
if(($infolayoutservice['imgbefuploads']=='1'))
{
?>
<a class="btn btn-sm btn-success text-white mb-1"><i class="fas fa-check"></i> Site Photos Taken (Before Action Taken)</a><br>
<?php
}
if($rowselect['callnature']=='Installation')
{
?>
<a href="serialupdate.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-info text-white mb-1"> Update Serials</a><br>
<?php
}
if($rowselect['detailsapprove']=='0')
{
$sqlcon4 = "SELECT callstatus From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
$querycon4 = mysqli_query($connection, $sqlcon4);
$rowcon4=mysqli_fetch_array($querycon4);
if($rowcon4['callstatus']!='')
{
?>
<a href="complaint.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-warning text-white mb-1"> <i class="fas fa-edit"></i></a> <a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1"> <i class="fas fa-print"></i></a> <?php if($rowcons['email']!=''){?> <a href="sendEmails.php?calltid=<?=$rowselect['calltid']?>&email=<?=$rowcons['email']?>" onclick="return confirm('Are you sure want to send this Service Call Report to the customer via Email?')" class="btn btn-sm btn-success text-white mb-1"> <i class="fas fa-at"></i></a> <?php } ?>
<a href="consolidate.php?times=<?=$rowselect['times']?>&id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-danger text-white mb-1">Consolidate Report</a><br>
<br>
<?php
}
else
{
?>
<a href="complaint.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-danger text-white mb-1"> Give Complaint Details</a><br>
<?php
}
}
else
{
?>
<a class="btn btn-sm btn-success text-white mb-1"><i class="fas fa-check"></i> Approved</a><br>
<?php
}
}
else
{
if(($infolayoutservice['imgbefuploads']=='1'))
{
?>
<a href="complaintbef.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1">Take Site Images (Before Taking Action)</a><br>
<?php
}
else
{
$addedon=date('Y-m-d H:i:s');
$editedon=date('Y-m-d H:i:s');
$calltid=mysqli_real_escape_string($connection, $rowselect['calltid']);
$sqlcon = "SELECT id From jrccalldetails WHERE calltid = '{$calltid}' and reassign='0'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon == 0)
{
$sqlup = "INSERT INTO jrccalldetails set addedon='$addedon', calltid='$calltid'";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$tid=mysqli_insert_id($connection);
mysqli_query($connection, "update jrccalls set detailsid='$tid' where calltid='$calltid'");
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Call Report', '{$tid}')");
}
}
else
{
$info=mysqli_fetch_array($querycon);
$tid=$info['id'];
$sqlup = "update jrccalldetails set editedon='$editedon' where calltid='$calltid' and reassign='0'";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
mysqli_query($connection, "update jrccalls set detailsid='$tid' where calltid='$calltid'");
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A Call Report', '{$tid}')");
}
}
if($rowselect['callnature']=='Installation')
{
?>
<a href="serialupdate.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-info text-white mb-1"> Update Serials</a><br>
<?php
}
if($rowselect['detailsapprove']=='0')
{
$sqlcon4 = "SELECT problemobserved From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
$querycon4 = mysqli_query($connection, $sqlcon4);
$rowcon4=mysqli_fetch_array($querycon4);
if($rowcon4['problemobserved']!='')
{
?>
<a href="complaint.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-warning text-white mb-1"> <i class="fas fa-edit"></i></a> <a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1"> <i class="fas fa-print"></i></a> <?php if($rowcons['email']!=''){?> <a href="sendEmails.php?calltid=<?=$rowselect['calltid']?>&email=<?=$rowcons['email']?>" onclick="return confirm('Are you sure want to send this Service Call Report to the customer via Email?')" class="btn btn-sm btn-success text-white mb-1"> <i class="fas fa-at"></i></a> <?php } ?>
<br>
<?php
}
else
{
?>
<a href="complaint.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-danger text-white mb-1"> Give Complaint Details</a><br>
<?php
}
}
else
{
?>
<a class="btn btn-sm btn-success text-white mb-1"><i class="fas fa-check"></i> Approved</a><br>
<?php
}
}
}
}
/////
}
else
{
?>
<a onclick="endlocation('<?=$rowselect2['startip']?>', '<?=$rowselect['calltid']?>')" class="btn btn-sm btn-primary text-white mb-1">Reached to Customer Location</a><br>
<?php
}
}
else
{
if($preclose==0)
{
?>
<a onclick="startmylocation('<?=$rowselect['calltid']?>')" class="btn btn-sm btn-primary text-white mb-1">Start from my Location</a><br>
<?php
}
else
{
?>
<a onclick="window.alert('Previous Attendance Not Closed, Click here to Close'); window.location.href='attendance.php';" href="attendance.php" class="btn btn-sm btn-danger text-white mb-1">Previous Attendance Not Closed, Click here to Close</a><br>
<?php
}
}
}
else
{
?>
<a href="callackn.php?id=<?=$rowselect['id']?>&status=<?=$_GET['status']?>" class="btn btn-sm btn-danger text-white mb-1">Click Here to Acknowledge</a><br>
<?php
}
////
}
else if($bgtext=='Cancelled')
{
if($rowselect['detailsid']!='')
{
if($rowselect['detailsapprove']=='1')
{
$sqlcon4 = "SELECT callstatus From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
$querycon4 = mysqli_query($connection, $sqlcon4);
$rowcon4=mysqli_fetch_array($querycon4);
if($rowcon4['callstatus']!='')
{
?>
<a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1"> <i class="fas fa-print"></i></a> <?php if($rowcons['email']!=''){ ?> <a href="sendEmails.php?calltid=<?=$rowselect['calltid']?>&email=<?=$rowcons['email']?>" onclick="return confirm('Are you sure want to send this Service Call Report to the customer via Email?')" class="btn btn-sm btn-success text-white mb-1"> <i class="fas fa-at"></i></a> <?php } ?>
<!--<a href="complaintpdf.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-danger text-white mb-1"> <i class="fas fa-file-pdf"></i></a>-->
<br>
<?php
}
}
}
}

}
else
{
if($rowselect['detailsid']!='')
{
if($rowselect['detailsapprove']=='1')
{
$sqlcon4 = "SELECT callstatus From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
$querycon4 = mysqli_query($connection, $sqlcon4);
$rowcon4=mysqli_fetch_array($querycon4);
if($rowcon4['callstatus']!='')
{
?>
<a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1"> <i class="fas fa-print"></i></a> <?php if($rowcons['email']!=''){ ?> <a href="sendEmails.php?calltid=<?=$rowselect['calltid']?>&email=<?=$rowcons['email']?>" onclick="return confirm('Are you sure want to send this Service Call Report to the customer via Email?')" class="btn btn-sm btn-success text-white mb-1"> <i class="fas fa-at"></i></a> <?php } ?>
<!--<a href="complaintpdf.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-danger text-white mb-1"> <i class="fas fa-file-pdf"></i></a>-->
<br>
<?php
}
}
}
}
if($rowselect['quotationgen']=='')
{
?>
<a href="quotationgen.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1" style="background-color:#e11584 !important; border-color:#e11584 !important"> Generate Quotation</a><br>
<?php
}
else
{
?>
<a href="quotations.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-success text-white mb-1"> Quotation Generated</a><br>
<?php
}
if($rowselect['amcquotationgen']=='')
{
?>
<a href="amcquotationgen.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1" style="background-color:#e11584 !important; border-color:#e11584 !important"> Generate AMC Quotation</a><br>
<?php
}
else
{
?>
<a href="amcquotations.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-success text-white mb-1">AMC Quotation Generated</a><br>
<?php
}
?>
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
</div>
</div>
</div>
</div>
<?php include('footer.php') ?>
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
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/moment.min.js"></script>
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/daterangepicker.min.js"></script>
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
</body>
</html>