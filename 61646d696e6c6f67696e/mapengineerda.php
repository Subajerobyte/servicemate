<?php
include('lcheck.php');
if(($engineerperformance=='0'))
{
header("location: dashboard.php");
}
if(isset($_GET['reportrange']))
{
$reportrange=mysqli_real_escape_string($connection, $_GET['reportrange']);
$reportrange = explode(' - ', $reportrange);
$from = $reportrange[0];
$to   = $reportrange[1];
$from = explode('/', $from);
$month   =$from[0];
$date   =$from[1];
$year = $from[2];
$dashfromdate =$from[2]."-".$from[0]."-".$from[1];
$to = explode('/', $to);
$month1   = $to[0];
$date1   = $to[1];
$year1 = $to[2];
$dashtodate =$to[2]."-".$to[0]."-".$to[1];
$date=mysqli_real_escape_string($connection,$dashfromdate);
$end=mysqli_real_escape_string($connection,$dashtodate);
$date1=mysqli_real_escape_string($connection,$dashfromdate);
$end1=mysqli_real_escape_string($connection,$dashtodate);
}
else
{
$date = date("Y-m-d", strtotime("Monday this week"));
for ($i=0; $i<7;$i++){
$end=date("Y-m-d", strtotime($date . " + $i day"));
}
$date1=$date;
$end1=$end;
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
<title>Engineer - Jerobyte - Service Engineer Details - <?=date('d/m/Y',strtotime($date))?> to <?=date('d/m/Y',strtotime($end))?></title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
.dtfc-fixed-left
{
background-color:#ffffff !important;
z-index:99999;
}
</style>
<style>
.table-responsive {
max-height: 600px;
overflow: auto;
}
@media (max-width: 768px) {
.floating-container {
right: 10px; /* Adjust as needed for smaller screens */
transform: translateX(0);
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
<?php //include('engineernavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col">
<h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Report for <?=date('d/m/Y',strtotime($date))?> to <?=date('d/m/Y',strtotime($end))?></b></h1>
</div>
<div class="col-auto" style="padding-top:10px; text-align: right;">
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get">
<div class="input-group">
<input type="text" id="reportrange" name="reportrange" class="form-control"/>
<div class="input-group-append">
<button class="btn btn-navb" type="submit" name="submit">
<i class="fa-solid fa-calendar-days fa-sm" style="color: #3d8eb9;"></i>
</button>
<button class="btn btn-navb" type="submit">
<a href="mapengineerda.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
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
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-body">
<p><b>SC :</b>Service Calls&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>OC :</b>Other Calls&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TOT :</b>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TA-TE :</b>Travel Expenses&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TA-CC :</b>Courier Charges&nbsp;&nbsp;&nbsp;&nbsp;<b>TA-MC :</b> Material Charges&nbsp;&nbsp;&nbsp;&nbsp;<b>TA-GE :</b> General Expenses&nbsp;&nbsp;&nbsp;&nbsp;<b>TA :</b> Travel Allowance&nbsp;&nbsp;&nbsp;&nbsp;<b>DA :</b> Dearness Allowance&nbsp;&nbsp;&nbsp;&nbsp;</p>
<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>S.No</th>
<th>Engineer Name</th>
<th>Tot Days</th>
<th>Pres</th>
<th>Abs</th>
<th>Tot - SC</th>
<th>Tot - OC</th>
<th>Tot - TOT</th>
<th>Pend - SC</th>
<th>Pend - OC</th>
<th>Pend - TOT</th>
<th>Comp - SC</th>
<th>Comp - OC</th>
<th>Comp - TOT</th>
<th>Comp %</th>
<th>Avg Calls</th>
<?php
if($liveplan=="DIAMOND")
{
?>
<th>Call Points</th>
<th>Tot Kms</th>
<th>Avg Kms</th>
<th>Trav Pt</th>
<th>TA-TE</th>
<th>TA-CC</th>
<th>TA-MC</th>
<th>TA-GE</th>
<th>TA</th>
<th>DA</th>
<th>Tot</th>
<th>Print</th>
<?php
}
?>
</tr>
</thead>
<tbody>
<?php
$engineerarray=array();
$engineerpoints=array();
$engineercpoints=array();
$sqlselect = "SELECT id, engineername  From jrcengineer where enabled='0' and designation='SERVICE ENGINEER' order by username asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
$totaltotalamount=0;
$totaltotalcalls=0;
$totaltotalscalls=0;
$totaltotalocalls=0;
$totaltotaldays=0;
$totaltotalpresent=0;
$totaltotalabsent=0;
$totaltotalkmtravelled=0;
$totaltotalavgkmtravelled=0;
$totaltotalpoints=0;
$totaltotalcpoints=0;
$totaltotalexpenses=0;
$totaltotaltotexpense=0;
$totaltotalcc=0;
$totaltotalmc=0;
$totaltotalom=0;
$totaltotaltoe=0;
$totaltotalda=0;
$totaltotalstatuscomplete=0;
$totaltotalstatusscomplete=0;
$totaltotalstatusocomplete=0;
$totaltotalstatuspending=0;
$totaltotalstatusspending=0;
$totaltotalstatusopending=0;
$totaltotalstatusper=0;
while($rowselect = mysqli_fetch_array($queryselect))
{
$totalcalls=0;
$totalscalls=0;
$totalocalls=0;
$totaldays=0;
$totalpresent=0;
$totalabsent=0;
$totalkmtravelled=0;
$totalpoints=0;
$totalcpoints=0;
$totalexpenses=0;
$totaltotexpense=0;
$totalstatuscomplete=0;
$totalstatusscomplete=0;
$totalstatusocomplete=0;
$totalstatuspending=0;
$totalstatusspending=0;
$totalstatusopending=0;
$totalstatusper=0;
$totalcc=0;
$totalmc=0;
$totalom=0;
$totaltoe=0;
$totalda=0;
$date=$date1;
$end=$end1;
?>
<tr>
<td style="background-color:#ffffff"><?=$count?></td>
<td style="background-color:#ffffff"><a href="mapengineerda1.php?date=<?=$date?>&end=<?=$end?>&submit=Submit&id=<?=$rowselect['id']?>"><?=$rowselect['engineername']?></a></td>
<?php
while(strtotime($date) <= strtotime($end))
{
$totaldays++;
$sqlmap = "SELECT location1, location2, location3, location4, location5, location6, location7, calltype1, calltype2, calltype3, calltype4, calltype5, calltype6, calltype7, lockm1, lockm2, lockm3, lockm4, lockm5, lockm6, lockm7, points1, points2, points3, points4, points5, points6, points7, callstatus1, callstatus2, callstatus3, callstatus4, callstatus5, callstatus6, callstatus7, endkm, daamount, travelexpense, couriercharges, materialcharges,othermaterial, tototherexpense, totexpense From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$date."%' order by attdate desc";
$querymap = mysqli_query($connection, $sqlmap);
$rowCountmap = mysqli_num_rows($querymap);
if(!$querymap){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountmap > 0)
{
$infomap=mysqli_fetch_array($querymap);
$totalpresent++;
$totalkms=0;
$dakms=0;
$cpoints=0;
$statuscomplete=0;
$statuspending=0;
$statusscomplete=0;
$statusspending=0;
$statusocomplete=0;
$statusopending=0;
for($i=1;$i<=7;$i++)
{
if($infomap['location'.$i]!='')
{
$totalcalls++;
if($infomap['calltype'.$i]=="Service Call")
{
$totalscalls++;
}
else
{
$totalocalls++;
}
$totalkms=$totalkms+(float)$infomap['lockm'.$i];
$dakms=$dakms+(float)$infomap['lockm'.$i];
$cpoints+=(float)$infomap['points'.$i];
if($infomap['callstatus'.$i]=="Completed")
{
$statuscomplete++;
if($infomap['calltype'.$i]=="Service Call")
{
$statusscomplete++;
}
else
{
$statusocomplete++;
}
}
if($infomap['callstatus'.$i]=="Pending")
{
$statuspending++;
if($infomap['calltype'.$i]=="Service Call")
{
$statusspending++;
}
else
{
$statusopending++;
}
}
}
else
{
}
}
$totalkms=$totalkms+(float)$infomap['endkm'];
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
$cc=0;
$mc=0;
$om=0;
$toe=0;
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
if(($infomap['couriercharges']!='')&&($infomap['couriercharges']!='0'))
{
$cc=(float)$infomap['couriercharges'];
}
if(($infomap['materialcharges']!='')&&($infomap['materialcharges']!='0'))
{
$mc=(float)$infomap['materialcharges'];
}
if(($infomap['othermaterial']!='')&&($infomap['othermaterial']!='0'))
{
$om=(float)$infomap['othermaterial'];
}
if(($infomap['tototherexpense']!='')&&($infomap['tototherexpense']!='0'))
{
$toe=(float)$infomap['tototherexpense'];
}
if(($infomap['daamount']!='')&&($infomap['daamount']!='0'))
{
$da=(float)$infomap['daamount'];
}
$totalkmtravelled+=$totalkms;
$totalcc+=$cc;
$totalmc+=$mc;
$totalom+=$om;
$totaltoe+=$toe;
$totalda+=$da;
$totalcpoints+=$cpoints;
$totalstatuscomplete+=$statuscomplete;
$totalstatusscomplete+=$statusscomplete;
$totalstatusocomplete+=$statusocomplete;
$totalstatuspending+=$statuspending;
$totalstatusspending+=$statusspending;
$totalstatusopending+=$statusopending;
$totalexpenses+=(float)$infomap['travelexpense'];
$totaltotexpense+=(float)$infomap['totexpense'];
$totalpoints+=$points;
}
else
{
$totalabsent++;
}
$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
}
?>
<td><?=$totaldays?></td>
<td><?=$totalpresent?></td>
<td><?=$totalabsent?></td>
<td><?=$totalscalls?></td>
<td><?=$totalocalls?></td>
<td><?=$totalcalls?></td>
<td><?=$totalstatusspending?></td>
<td><?=$totalstatusopending?></td>
<td><?=$totalstatuspending?></td>
<td><?=$totalstatusscomplete?></td>
<td><?=$totalstatusocomplete?></td>
<td><?=$totalstatuscomplete?></td>
<td><?=($totalcalls!=0)?round(($totalstatuscomplete/$totalcalls)*100,2):0?></td>
<td><?=($totalcalls!=0)?round($totalcalls/$totalpresent):0?></td>
<?php
if($liveplan=="DIAMOND")
{
?>
<td><?=$totalcpoints?></td>
<td><?=$totalkmtravelled?></td>
<td><?=($totalpresent!=0)?(round(($totalkmtravelled/$totalpresent),2)):'0'?></td>
<td><?=$totalpoints?></td>
<td><?=(float)$totalexpenses?></td>
<td><?=$totalcc?></td>
<td><?=$totalmc?></td>
<td><?=$totalom?></td>
<td><?=(float)$totaltotexpense?></td>
<td><?=$totalda?></td>
<td><?=(float)$totalda+(float)$totaltotexpense?></td>
<td><a href="ticketprint.php?date=<?=$date1?>&end=<?=$end1?>&id=<?=$rowselect['id']?>" target="_blank">Print</a></td>
<?php
}
${'eng'.$rowselect['id'].'totaldays'}=$totaldays;
${'eng'.$rowselect['id'].'totalpresent'}=$totalpresent;
${'eng'.$rowselect['id'].'totalabsent'}=$totalabsent;
${'eng'.$rowselect['id'].'totalcalls'}=$totalcalls;
${'eng'.$rowselect['id'].'totalscalls'}=$totalscalls;
${'eng'.$rowselect['id'].'totalocalls'}=$totalocalls;
${'eng'.$rowselect['id'].'totalcpoints'}=$totalcpoints;
${'eng'.$rowselect['id'].'totalstatuscomplete'}=$totalstatuscomplete;
${'eng'.$rowselect['id'].'totalstatusscomplete'}=$totalstatusscomplete;
${'eng'.$rowselect['id'].'totalstatusocomplete'}=$totalstatusocomplete;
${'eng'.$rowselect['id'].'totalstatuspending'}=$totalstatuspending;
${'eng'.$rowselect['id'].'totalstatusspending'}=$totalstatusspending;
${'eng'.$rowselect['id'].'totalstatusopending'}=$totalstatusopending;
${'eng'.$rowselect['id'].'totalstatusper'}=($totalcalls!=0)?round(($totalstatuscomplete/$totalcalls)*100,2):0;
${'eng'.$rowselect['id'].'totalkmtravelled'}=$totalkmtravelled;
${'eng'.$rowselect['id'].'totalavg'}=(($totalpresent!=0)?(round(($totalkmtravelled/$totalpresent),2)):'0');
${'eng'.$rowselect['id'].'totalpoints'}=$totalpoints;
${'eng'.$rowselect['id'].'totalcc'}=$totalcc;
${'eng'.$rowselect['id'].'totalmc'}=$totalmc;
${'eng'.$rowselect['id'].'totalom'}=$totalom;
${'eng'.$rowselect['id'].'totaltoe'}=$totaltoe;
${'eng'.$rowselect['id'].'totalda'}=$totalda;
${'eng'.$rowselect['id'].'totalexpenses'}=$totalexpenses;
${'eng'.$rowselect['id'].'totaltotexpense'}=$totaltotexpense;
${'eng'.$rowselect['id'].'totaldaexpenses'}=(float)$totalda+(float)$totaltotexpense;
?>
</tr>
<?php
$count++;
$engineerarray[]=$rowselect['engineername'];
$engineerpoints[]=$totalpoints;
$engineercpoints[]=$totalcpoints;
$totaltotaldays+=$totaldays;
$totaltotalpresent+=$totalpresent;
$totaltotalabsent+=$totalabsent;
$totaltotalcalls+=$totalcalls;
$totaltotalscalls+=$totalscalls;
$totaltotalocalls+=$totalocalls;
$totaltotalstatuscomplete+=$totalstatuscomplete;
$totaltotalstatusscomplete+=$totalstatusscomplete;
$totaltotalstatusocomplete+=$totalstatusocomplete;
$totaltotalstatuspending+=$totalstatuspending;
$totaltotalstatusspending+=$totalstatusspending;
$totaltotalstatusopending+=$totalstatusopending;
$totaltotalcpoints+=$totalcpoints;
$totaltotalkmtravelled+=$totalkmtravelled;
$totaltotalavgkmtravelled+=(($totalpresent!=0)?(round(($totalkmtravelled/$totalpresent),2)):0);
$totaltotalpoints+=$totalpoints;
$totaltotalcc+=$totalcc;
$totaltotalmc+=$totalmc;
$totaltotalom+=$totalom;
$totaltotaltoe+=$totaltoe;
$totaltotalda+=$totalda;
$totaltotalexpenses+=$totalexpenses;
$totaltotaltotexpense+=$totaltotexpense;
$totaltotalamount+=((float)$totalda+(float)$totaltotexpense);
}
}
?>
</tbody>
<tfoot>
<tr>
<th></th>
<th>Total</th>
<th></th>
<th></th>
<th></th>
<th><?=$totaltotalscalls?></th>
<th><?=$totaltotalocalls?></th>
<th><?=$totaltotalcalls?></th>
<th><?=$totaltotalstatusspending?></th>
<th><?=$totaltotalstatusopending?></th>
<th><?=$totaltotalstatuspending?></th>
<th><?=$totaltotalstatusscomplete?></th>
<th><?=$totaltotalstatusocomplete?></th>
<th><?=$totaltotalstatuscomplete?></th>
<th><?=($totaltotalcalls!=0)?round(($totaltotalstatuscomplete/$totaltotalcalls)*100,2):0?></th>
<th></th>
<?php
if($liveplan=="DIAMOND")
{
?>
<th><?=$totaltotalcpoints?></th>
<th><?=$totaltotalkmtravelled?></th>
<th><?=$totaltotalavgkmtravelled?></th>
<th><?=$totaltotalpoints?></th>
<th><?=$totaltotalexpenses?></th>
<th><?=$totaltotalcc?></th>
<th><?=$totaltotalmc?></th>
<th><?=$totaltotalom?></th>
<th><?=$totaltotaltotexpense?></th>
<th><?=$totaltotalda?></th>
<th><?=$totaltotalamount?></th>
<th></th>
<?php
}
?>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
<br>
<div class="card shadow mb-4">
<div class="card-body">
<div class="row">
<div class="col-md-6" style="display:none">
<canvas id="myChart1" style="width:100%; height:250px;"></canvas>
</div>
<div class="col-md-6" style="display:none">
<canvas id="myChart2" style="width:100%; height:250px;"></canvas>
</div>
<div class="col-md-12">
<canvas id="myChart4" style="height:300px;"></canvas>
</div>
</div>
</div></div>
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
<!-- Page level plugins -->
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
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
$(document).ready(function () {
var table = $('#dataTable').DataTable({
"paging": false,
"processing": true,
dom: 'Blfrtip',
scrollY:        "500px",
scrollX:        true,
scrollCollapse: true,
fixedColumns:   {
left: 2
},
<?php
if($engineerta=='1')
{
?>
buttons: [
{
extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
title: "Engineer's TA Report from <?=date('d/m/Y',strtotime($date1))?> to <?=date('d/m/Y',strtotime($end1))?>",
orientation: 'landscape',
footer: true,
exportOptions: {
<?php
if($liveplan=="DIAMOND")
{
?>
columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26]
<?php
}
else
{
?>
columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
<?php
}
?>
}
},
{
extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
title: "Engineer's TA Report from <?=date('d/m/Y',strtotime($date1))?> to <?=date('d/m/Y',strtotime($end1))?>",
footer: true,
exportOptions: {
<?php
if($liveplan=="DIAMOND")
{
?>
columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26]
<?php
}
else
{
?>
columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
<?php
}
?>
}
}
]
<?php
}
?>
});
var table = $('#dataTable1').DataTable({
"paging": false,
"processing": true,
dom: 'Blfrtip',
<?php
if($engineerta=='1')
{
?>
buttons: [
{
extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
orientation: 'landscape',
footer: true,
exportOptions: {
columns: [0,1,2,3,4,5,6,7]
}
},
{
extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
footer: true,
exportOptions: {
columns: [0,1,2,3,4,5,6,7]
}
}
]
<?php
}
?>
});
});
</script>
<script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<script>
var xValues = [<?php foreach ($engineerarray as $sd){ echo "'".$sd."',";}?>];
var yValues = [<?php foreach ($engineercpoints as $sa){ echo $sa.',';}?>];
var barColors = [<?php foreach ($engineercpoints as $sa){ echo "'#FEC368',";}?>];
var myData = {
labels: xValues,
datasets: [{
fill: false,
backgroundColor: barColors,
data: yValues,
}]
};
var myoption = {
legend: {display: false},
title: {
display: true,
text: "Call Points"
},
tooltips: {
enabled: true
},
hover: {
animationDuration: 1
},
animation: {
duration: 1,
onComplete: function () {
var chartInstance = this.chart,
ctx = chartInstance.ctx;
ctx.textAlign = 'center';
ctx.fillStyle = "rgba(0, 0, 0, 1)";
ctx.textBaseline = 'bottom';
this.data.datasets.forEach(function (dataset, i) {
var meta = chartInstance.controller.getDatasetMeta(i);
meta.data.forEach(function (bar, index) {
var data = dataset.data[index];
ctx.fillText(data, bar._model.x, bar._model.y - 5);
});
});
}
}
};
var ctx = document.getElementById('myChart1').getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: myData,
options: myoption
});
</script>
<script>
var xValues = [<?php foreach ($engineerarray as $sd){ echo "'".$sd."',";}?>];
var yValues = [<?php foreach ($engineerpoints as $sa){ echo $sa.',';}?>];
var barColors = [<?php foreach ($engineerpoints as $sa){ echo "'#04DCCB',";}?>];
var myData = {
labels: xValues,
datasets: [{
fill: false,
backgroundColor: barColors,
data: yValues,
}]
};
var myoption = {
legend: {display: false},
title: {
display: true,
text: "Travel Points"
},
tooltips: {
enabled: true
},
hover: {
animationDuration: 1
},
animation: {
duration: 1,
onComplete: function () {
var chartInstance = this.chart,
ctx = chartInstance.ctx;
ctx.textAlign = 'center';
ctx.fillStyle = "rgba(0, 0, 0, 1)";
ctx.textBaseline = 'bottom';
this.data.datasets.forEach(function (dataset, i) {
var meta = chartInstance.controller.getDatasetMeta(i);
meta.data.forEach(function (bar, index) {
var data = dataset.data[index];
ctx.fillText(data, bar._model.x, bar._model.y - 5);
});
});
}
}
};
var ctx = document.getElementById('myChart2').getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: myData,
options: myoption
});
</script>
<script>
var ctx = document.getElementById("myChart4").getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: [<?php foreach ($engineerarray as $sd){ echo "'".$sd."',";}?>],
datasets: [{
label: 'Call Points',
backgroundColor: "#4287f5",
data: [<?php foreach ($engineercpoints as $sa){ echo $sa.',';}?>],
}, {
label: 'Travel Points',
backgroundColor: "#45c490",
data: [<?php foreach ($engineerpoints as $sa){ echo $sa.',';}?>],
}],
},
options: {
responsive: true,
maintainAspectRatio: false,
plugins: {
labels: {
render: 'value',
}
},
scales: {
xAxes: [{
stacked: true,
}],
yAxes: [{
stacked: true
}]
}
}
});
</script>
<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip();
})
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
if((isset($date))&&($date!=''))
{
?>
$('#reportrange').data('daterangepicker').setStartDate('<?=date('m/d/Y',strtotime($date1))?>');
$('#reportrange').data('daterangepicker').setEndDate('<?=date('m/d/Y',strtotime($end1))?>');
<?php
}
?>
});
</script>
<!------------daterangepicker--->
<?php include('additionaljs.php');   ?>
</body>
</html>