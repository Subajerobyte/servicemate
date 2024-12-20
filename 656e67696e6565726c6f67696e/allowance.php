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
<title>Allowance Report - <?=$_SESSION['companyname']?></title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link href="../../1637028036/vendor/photoviewer/photoviewer.css" rel="stylesheet">
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
margin-left:100px;
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
left: -65%;
text-align: right;
font-size: 12px;
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
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Allowance</h1>
<!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>
<div class="row">
<div class="col-lg-12">
<div class="card shadow mb-4">
<div class="card-body">
<?php
if(isset($_GET['attdate']))
{
$attdate=$_GET['attdate'];
}
else if(isset($_POST['attdate']))
{
$attdate=$_POST['attdate'];
}
else
{
$attdate=date('Y-m-d');
}
if(isset($engineerid))
{
$sqlselect = "SELECT * From jrcengineer where enabled='0' and id='".$engineerid."' order by username asc";
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
<form action="" method="get" id="myForm">
<h3><?=$rowselect['engineername']?></h3>
<div class="row">
<div class="col-8">
<div class="form-group">
<input type="date" name="attdate" class="form-control" value="<?=((isset($_POST['attdate']))?$_POST['attdate']:((isset($_GET['attdate']))?$_GET['attdate']:date('Y-m-d')))?>" max="<?=date('Y-m-d')?>">
</div>
</div>
<div class="col-4">
<div class="form-group">
<input type="submit" name="submit" class="btn btn-primary" onclick="validateFormAndSubmit()"
>
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
<h4>Call History Map</h4>
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
if($infomap['endlocation']!='')
{
$endpoint=$infomap['endlocation'];
}
?>
<iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&origin=<?=$infomap['startlocation']?>&destination=<?=$endpoint?>&waypoints=<?=$waypoints?>&avoid=tolls|highways&center=<?=$infomap['startlocation']?>&zoom=9" allowfullscreen>
</iframe>
<?php
}
/* ?>
<h4>Call History Map</h4>
<?php
$salw=mysqli_query($connection, "select * from jrclive where user='".$rowselect['username']."' and ldate like '".date('Y-m-d',strtotime($attdate))."%'");
if(mysqli_num_rows($salw)>0)
{
$pwaypoints='';
$pstartpoint='';
$pendpoint='';
$uni=array();
while($insal=mysqli_fetch_array($salw))
{
if($pstartpoint=='')
{
$pstartpoint=$insal['lati'].','.$insal['longi'];
}
else
{
if(!in_array($insal['lati'].','.$insal['longi'], $uni)
{
$uni[]=$insal['lati'].','.$insal['longi'];
}
if($pwaypoints=='')
{
$pwaypoints.=''.$insal['lati'].','.$insal['longi'];
}
else
{
$pwaypoints.='|'.$insal['lati'].','.$insal['longi'];
}
}
$pendpoint=$insal['lati'].','.$insal['longi'];
}
?>
<iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&origin=<?=$pstartpoint?>&destination=<?=$pendpoint?>&waypoints=<?=$pwaypoints?>&avoid=tolls|highways&center=<?=$pstartpoint?>&zoom=9" allowfullscreen>
</iframe>
<?php
} */
?>
</div>
<div class="col-lg-6 historyid">
<div class="card">
<div class="history-tl-container">
<ul class="tl">
<?php
$prev='';
$totalkms=0;
$dakms=0;
if($infomap['startlocation']!='')
{
$data1 = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['startlocation']."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
$data = json_decode($data1);
?>
<li class="tl-item" ng-repeat="item in retailer_history">
<div class="timestamp">
<?php
echo (date('jS M Y',strtotime($infomap['starttime']))).'<br>'.(date('h:i a',strtotime($infomap['starttime'])));
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
$callpoints=0;
$reached=0;
for($j=1;$j<=7;$j++)
{
if($infomap['location'.$j]!='')
{
$data1 = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['location'.$j]."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
$data = json_decode($data1);
?>
<li class="tl-item" ng-repeat="item in retailer_history">
<div class="timestamp">
<?php
echo (date('jS M Y',strtotime($infomap['loctime'.$j]))).'<br>'.(date('h:i a',strtotime($infomap['loctime'.$j])));
?>
</div>
<div class="item-title">Reached to Customer <?=$j?> (<a href="callsedit.php?calltid=<?=$infomap['loccall'.$j]?>" target="_blank"><?=$infomap['loccall'.$j]?></a>) - <?=$infomap['lockm'.$j]?>Kms</div>
<div class="item-detail">
<?php
$sqlcalls1 = mysqli_query($connection, "SELECT t1.consigneename, t1.area, t1.district From jrcconsignee t1, jrccalls t2 where t2.calltid='".$infomap['loccall'.$j]."' and t1.id=t2.consigneeid");
if(mysqli_num_rows($sqlcalls1)>0)
{
$infocalls1=mysqli_fetch_array($sqlcalls1);
echo '<b>'.$infocalls1['consigneename'].', '.$infocalls1['area'].', '.$infocalls1['district'].'</b><br>';
}
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
$dakms+=(float)$infomap['lockm'.$j];
$callpoints+=(float)$infomap['points'.$j];
$reached++;
}
}
if($infomap['endlocation']!='')
{
$data1 = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['endlocation']."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
$data = json_decode($data1);
?>
<li class="tl-item" ng-repeat="item in retailer_history">
<div class="timestamp">
<?php
echo (date('jS M Y',strtotime($infomap['endtime']))).'<br>'.(date('h:i a',strtotime($infomap['endtime'])));
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
<?php
if($totalkms<75)
{
$dapoints=0;
}
else if(($totalkms>74)&&($totalkms<201))
{
$dapoints=5;
}
else if(($totalkms>200)&&($totalkms<301))
{
$dapoints=10;
}
else if(($totalkms>300)&&($totalkms<401))
{
$dapoints=15;
}
else
{
$dapoints=20;
}
$da=0;
if($dakms<75)
{
$da=0;
}
else if(($dakms>74)&&($dakms<121))
{
$da=50;
}
else
{
$da=120;
}
?>
<?php
if($liveplan=="DIAMOND")
{
if($infomap['ticketapprove']=='0')
{
?>
<div class="alert alert-danger">Approval Pending</div>
<?php
}
else
{
?>
<div class="alert alert-success">Ticket Approved by <?=$infomap['ticketapproveby']?> on <?=date('d/m/Y h:i:s a',strtotime($infomap['ticketapproveon']))?></div>
<?php
}
}
?>
<div class="col-lg-12 text-left">
<div class="table-responsive">
<table class="table">
<tr <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>
<th>Total Call Points:</th>
<td><?=$callpoints?></td>
</tr>
<tr <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>
<th>Total Kms Travelled:</th>
<td><?=$totalkms?></td>
</tr>
<tr <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>
<th>Total Travel Points:</th>
<td><?=$dapoints?></td>
</tr>
<tr <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>
<th>DA: Rs.</th>
<td><?=($infomap['ticketapprove']!='0')?$infomap['daamount']:$da?><br>
<?=$da?> (<?=$dakms?> Kms)</td>
</tr>
<tr <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>
<th>TA: Rs.</th>
<td><?=$infomap['totexpense']?></td>
</tr>
<tr <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>
<th colspan="2" class="text-center">
<div class="image-set">
<?php if($infomap['tickets']!==''){$as=explode(',',$infomap['tickets']);$c=1;foreach($as as $a){?>
<a data-gallery="photoviewer" data-title="Ticket on <?=date('d/m/Y',strtotime($attdate))?>" data-group="a" href="<?=$a?>"><img src="<?=$a?>" width="100" height="100" alt=""></a>
<?php
}}?>
</div>
</th>
</tr>
<?php
if($infomap['endlocation']!='')
{
?>
<?php
}
else
{
?>
<div class="alert bg-danger text-white text-center">Attendance not Closed by Engineer</div>
<?php
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
<?php
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
<div class="row">
<div class="col-lg-12 mb-2">
<div class="card-body">
<h5 class="text-danger">Report for that Week</h5>
<br>
<div class="table-responsive">
<table class="table table-bordered font-13" width="100%" cellspacing="0">
<thead>
<tr>
<th colspan="5"></th>
<th id="totalkms" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Total Kms</th>
<th id="totalpoints" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Travel Points</th>
<th id="totalcpoints" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Service Points</th>
<th id="totalda" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>DA</th>
<th id="totalexpenses" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>TA</th>
<th colspan="9"></th>
</tr>
<tr>
<th>S.No</th>
<th>Date</th>
<th>View</th>
<th>Attendance</th>
<th <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Ticket Verify</th>
<th <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Total Kms</th>
<th <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Travel Points</th>
<th <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Service Points</th>
<th <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>DA</th>
<th <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>TA</th>
<th>Start</th>
<th>Location 1</th>
<th>Location 2</th>
<th>Location 3</th>
<th>Location 4</th>
<th>Location 5</th>
<th>Location 6</th>
<th>Location 7</th>
<th>End</th>
</tr>
</thead>
<tbody>
<?php
$startdate=date('Y-m-01', strtotime($attdate));
$enddate=date('Y-m-t', strtotime($attdate));
$sqlselect = "SELECT * From jrcengineer where enabled='0' and id='".$engineerid."' order by username asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$totalkmtravelled=0;
$totalexpenses=0; $totalda=0;
$totalpoints=0;
$totalcpoints=0;
$totalda=0;
$count=1;
while($rowselect = mysqli_fetch_array($queryselect))
{
$day = date('w', strtotime($attdate));
$date = date('Y-m-d', strtotime($attdate.' -'.$day.' days'));
$end = date('Y-m-d', strtotime($attdate.' +'.(6-$day).' days'));
while(strtotime($date) <= strtotime($end))
{
$output='';
?>
<tr>
<td><?=$count?></td>
<td><?=date('d/m/Y',strtotime($date))?></td>
<td>
<a href="allowance.php?id=<?=$rowselect['id']?>&attdate=<?=$date?>">View</a>
</td>
<?php
$sqlmap = "SELECT * From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$date."%' order by attdate desc";
$querymap = mysqli_query($connection, $sqlmap);
$rowCountmap = mysqli_num_rows($querymap);
if(!$querymap){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountmap > 0)
{
$infomap=mysqli_fetch_array($querymap);
?>
<td class="text-success">Present</td>
<?php
if($liveplan=="DIAMOND")
{
if($infomap['ticketapprove']!='0')
{
?>
<td><a href="allowance.php?id=<?=$rowselect['id']?>&attdate=<?=$date?>" target="_blank"  class="text-success">Verified</a></td>
<?php
}
else
{
?>
<td><a href="allowance.php?id=<?=$rowselect['id']?>&attdate=<?=$date?>" target="_blank"  class="text-danger">Pending</a></td>
<?php
}
}
$output.='<td>'.(($infomap['starttime']!='')?date('d/m/Y h:i:s a',strtotime($infomap['starttime'])):'').'</td>';
$totalkms=0;
$dakms=0;
$cpoints=0;
for($i=1;$i<=7;$i++)
{
if($infomap['location'.$i]!='')
{
$details='';
if($infomap['detailsid'.$i]!='')
{
$sqlcon4 = "SELECT worktype, stockitem, callstatus From jrccalldetails WHERE id = '".$infomap['detailsid'.$i]."'";
$querycon4 = mysqli_query($connection, $sqlcon4);
$rowcon4=mysqli_num_rows($querycon4);
$infocon4=mysqli_fetch_array($querycon4);
$details='<b>Product:</b> <br>'.$infocon4['stockitem'].'<br><br><b>Work Type:</b> <br>'.$infocon4['worktype'].'<br><br><b>Call Status:</b> <br>'.$infocon4['callstatus'].'';
}
$output.='<td><a>'.$infomap['loccall'.$i].'</a><br>'.(date('d/m/Y h:i:sa',strtotime($infomap['loctime'.$i]))).' <br>'.$infomap['lockm'.$i].' Kms <br>'.(($infomap['callstatus'.$i]=="Completed")?'<span class="text-success">Completed</span>':(($infomap['callstatus'.$i]=="Pending")?'<span class="text-danger">Pending</span>':(($infomap['callstatus'.$i]=="Open")?'<span class="text-warning">Open</span>':$infomap['callstatus'.$i]))).'<br><div class="tooltip1"><b>'.$infomap['points'.$i].' Points</b><span class="tooltiptext1">'.$details.'</span></div><br>'.$infomap['worktime'.$i].' Duration</td>';
$totalkms=$totalkms+(float)$infomap['lockm'.$i];
$dakms=$dakms+(float)$infomap['lockm'.$i];
$cpoints+=$infomap['points'.$i];
}
else
{
$output.='<td></td>';
}
}
$output.='<td>'.(($infomap['endtime']!='')?date('d/m/Y h:i:s a',strtotime($infomap['endtime'])):'').'</td>';
$totalkms=$totalkms+(float)$infomap['endkm'];
if($liveplan=="DIAMOND")
{
?>
<td><?=$totalkms?></td>
<?php
}
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
$da=0;
if($dakms<75)
{
$da=0;
}
else if(($dakms>74)&&($dakms<121))
{
$da=50;
}
else
{
$da=120;
}
if(($infomap['daamount']!='')&&($infomap['daamount']!='0'))
{
$da=(float)$infomap['daamount'];
}
if($liveplan=="DIAMOND")
{
?>
<td><?=$points?></td>
<td><?=$cpoints?></td>
<td><?=$da?></td>
<td><?=$infomap['totexpense']?></td>
<?php
}
echo $output;
$totalkmtravelled+=$totalkms;
$totalda+=$da;
$totalexpenses+=(float)$infomap['totexpense'];
$totalpoints+=$points;
$totalcpoints+=$cpoints;
}
else
{
?>
<td class="text-danger">Absent</td>
<?php
if($liveplan=="DIAMOND")
{
$k=15;
}
else
{
$k=9;
}
for($i=1;$i<=$k;$i++)
{
?>
<td></td>
<?php
}
?>
<?php
}
?>
</tr>
<?php
$count++;
$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
}
}
?>
<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<script>
document.getElementById("totalkms").innerHTML=" <?=$totalkmtravelled?>";
document.getElementById("totalpoints").innerHTML=" <?=$totalpoints?>";
document.getElementById("totalcpoints").innerHTML=" <?=$totalcpoints?>";
document.getElementById("totalda").innerHTML=" <?=$totalda?>";
document.getElementById("totalexpenses").innerHTML=" <?=$totalexpenses?>";
</script>
<h4 class="m-2 text-primary">Call History</h4>
<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable1" width="100%" cellspacing="0">
<thead>
<tr>
<th>S.No</th>
<th>Call ID</th>
<th>Date</th>
<th>Status</th>
<th>Call Details</th>
<th>Customer Details</th>
<th>Product Details</th>
<th>Serial Number</th>
<th>Problem Reported</th>
<th>Problem Observed</th>
<th>Action Taken</th>
<th>Narration</th>
</tr>
</thead>
<tbody>
<?php
$sqlselect = "SELECT * From jrccalls where engineerid='".$engineerid."' and  callon BETWEEN '".$startdate."' AND '".$enddate."' order by id desc";
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
<tr <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowselect['callon'])))?'style="background-color:#ffe0f8 !important"':''?>>
<td><?=$count?></td>
<td><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a></td>
<td><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
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
<td>C/H: <a ><?=$rowselect['callhandlingname']?></a><br>
C/O: <a><?=$rowselect['coordinatorname']?></a><br>
<?php
if($rowselect['engineertype']=='1')
{
$engnsid=explode(',',$rowselect['engineersid']);
$engnsname=explode(',',$rowselect['engineersname']);
for($eise=0; $eise<count($engnsid);$eise++)
{
?>
E-<?=($eise+1)?>: <a ><?=$engnsname[$eise]?> <?=($rowselect['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
<?php
}
}
else
{
?>
E: <a ><?=$rowselect['engineername']?></a><br>
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
?>
</td>
<?php
if($rowxl['consigneename']!="")
{
?>
<td><a ><?=$rowxl['consigneename']?></a></td>
<?php
}
else
{
?>
<td><a >View</a></td>
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
?></td>
<td><?=$rowselect['serial']?></td>
<td><?=$rowselect['reportedproblem']?></td>
<td><?=$rowselect['problemobserved']?></td>
<td><?=$rowselect['actiontaken']?></td>
<td><?=$rowselect['narration']?></td>
</tr>
<?php
$count++;
}
}
?>
</tbody>
</table>
</div>
<?php
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
</div>
</div>
<?php include('footer.php'); ?>
<?php include('spin.php'); ?>
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
<!-- Page level plugins -->
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
<!-- Page level custom scripts -->
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
<script type="text/javascript">
$(document).ready(function() {
$(document).ready(function () {
var table = $('#dataTable').DataTable({
"paging": false,
"processing": true,
"bSort": false,
dom: 'Blfrtip',
buttons: [
{
extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
orientation: 'landscape',
footer: true,
exportOptions: {
columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
}
},
{
extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
footer: false,
exportOptions: {
columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
}
}
]
});
});
});
</script>
<script src="../../1637028036/vendor/photoviewer/photoviewer.js"></script>
<script>
// initialize manually with a list of links
$('[data-gallery=photoviewer]').click(function (e) {
e.preventDefault();
var items = [],
options = {
index: $(this).index(),
};
$('[data-gallery=photoviewer]').each(function () {
items.push({
src: $(this).attr('href'),
title: $(this).attr('data-title')
});
});
new PhotoViewer(items, options);
});
</script>
</body>
</html>