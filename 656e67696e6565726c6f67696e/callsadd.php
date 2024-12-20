<?php
include('lcheck.php');
$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
$infolayoutcallquery=mysqli_query($connection,"select * from jrclayoutcall");
$infolayoutcall=mysqli_fetch_array($infolayoutcallquery);
if($_SESSION['eligiblecalls']=='1')
{
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT consigneeid From jrcxl where tdelete='0' and  id='".$id."' order by consigneename asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
$rowselect = mysqli_fetch_array($queryselect);
$consigneeid=$rowselect['consigneeid'];
$sqlselect1 = "SELECT ctype,latlong, consigneename,mobile From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
$rowCountselect1 = mysqli_num_rows($queryselect1);
if(!$queryselect1){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect1 > 0)
{
$count=1;
$rowselect1 = mysqli_fetch_array($queryselect1);
$latlong=$rowselect1['latlong'];
$mobile=$rowselect1['mobile'];
}
}
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Add New Complaint Call</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
<link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">

<style>
.ajax-upload-dragdrop, .ajax-file-upload-statusbar
{
width: 100% !important;
}
</style>
<style>
.main-body {
font-size: 90%;
}
.mytabl th, .mytabl td
{
padding:1px 5px;
}
a.button8
{
display:inline-block;
padding:0.05em 0.2em;
border-radius:5px;
margin:0.1em;
border:0.15em solid #CCCCCC;
box-sizing: border-box;
text-decoration:none;
font-family:'Segoe UI','Roboto',sans-serif;
font-weight:400;
color:#000000;
background-color:#CCCCCC;
text-align:center;
position:relative;
}
a.button8:hover{
border-color:#7a7a7a;
}
a.button8:active{
background-color:#999999;
}
@media all and (max-width:30em){
a.button8{
display:block;
margin:0.2em auto;
}
}
.nav-tabs .nav-link.active {
    color: #ffffff !important;
    background-color: #3d8eb9 !important;
    border-color: #3d8eb9 !important;
}
</style>
</head>
<body id="page-top" onLoad="checkcarry(); checkdiagnosis(); checkengineer(); checkreport()">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Add New Complaint Call</h1>
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
?>
<?php
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT consigneename, address1, address2, area, district, pincode, mobile, contact, phone, email, maincategory, subcategory, department, consigneeid,id From jrcxl where tdelete='0' and  id='".$id."' order by consigneename asc";
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
$consigneeid=$rowselect['consigneeid'];
$sqlselect1 = "SELECT consigneename, address1, address2, area, district, pincode, mobile, contact, phone, email, maincategory, subcategory, department,latlong,id,ctype   From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
$rowCountselect1 = mysqli_num_rows($queryselect1);
if(!$queryselect1){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect1 > 0)
{
$count=1;
$rowselect1 = mysqli_fetch_array($queryselect1);
$latlong=$rowselect1['latlong'];
}
?>
<div class="main-body">
<div class="card">
<div class="card-body" style="padding:0.5rem">
<div class="row gutters-sm">
<div class="col-md-12 col-12" >
<h6 class="text-center text-primary mb-1"><b><?=$conname=$rowselect1['consigneename']?></b></h6>
<p class="text-secondary text-center mb-1"><?php
if($rowselect1['ctype']!='')
{
if($rowselect1['ctype']=='BLOCK')
{
?>
<span class="badge badge-danger font-9"><?=$rowselect1['ctype']?></span>
<?php
}
else
{
?>
<span class="badge badge-success font-9"><?=$rowselect1['ctype']?></span>
<?php
}
}
?>
<span class="badge badge-success font-9" id="warrantycustomer" style="display:none;">Warranty Customer</span>
<span class="badge badge-success font-9" id="amccustomer" style="display:none">AMC Customer</span><br>
<?php
if(($infolayoutcustomers['address1']=='1')||($infolayoutcustomers['address2']=='1')||($infolayoutcustomers['area']=='1')||($infolayoutcustomers['district']=='1')||($infolayoutcustomers['pincode']=='1'))
{
?>
<span><i class="fa fa-address-book text-primary"></i> <?=$rowselect1['address1']?> <?=$rowselect1['address2']?> <?=$rowselect1['area']?> <?=$rowselect1['district']?> <?=$rowselect1['pincode']?></span><br>
<?php
}
if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['email']=='1'))
{
?>
<span><?=$rowselect1['contact']?> <i class="fa fa-phone-alt text-primary"></i>  <?=$rowselect1['phone']?> <?=$rowselect1['mobile']?> <i class="fa fa-envelope text-primary"></i> <?=$rowselect1['email']?></span> <!-- Button trigger modal -->
<br>
<?php
?>
<?php
if((($infolayoutcustomers['contact']=='1')&&($rowselect1['contact']=='')) || (($infolayoutcustomers['phone']=='1')&&($rowselect1['phone']=='')) || (($infolayoutcustomers['mobile']=='1')&&($rowselect1['phone']=='')) || (($infolayoutcustomers['email']=='1')&&($rowselect1['email']=='')))
{
?>
<?php
}
}
?>
<span>
<?php
if($infolayoutcustomers['maincategory']=='1')
{
?>
<?=$rowselect1['maincategory']?> -
<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<?=$rowselect1['subcategory']?> -
<?php
}
if($infolayoutcustomers['department']=='1')
{
?>
<?=$rowselect1['department']?>
<?php
}
?>
</span>
</p>
</div>
</div>
</div>
</div>
<br>
<?php
$consigneeid=$rowselect['consigneeid'];
$sqlselect1 = "SELECT id,ctype,latlong, consigneename From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
$rowCountselect1 = mysqli_num_rows($queryselect1);
if(!$queryselect1){
die("SQL query failed: " . mysqli_error($connection));
}
while($rowselect1 = mysqli_fetch_array($queryselect1))
{
?>
<div class="row gutters-sm">
<div class="col-md-12">
<div class="card mb-3" style="border:none">
<div class="card-body" style="padding:0">
<!-- List group-->
<ul class="list-group">
<?php
if(isset($_GET['type']))
{
$sqlselect = "SELECT rono, rentaldate, consigneeid, id  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and  id='".$rowselect['id']."' group by rono, rentaldate order by rentaldate desc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
$stockitem="";
$rono="";
$rentaldate="";
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<!-- list group item-->
<li class="list-group-item">
<!-- Custom content-->
<div class="media align-items-lg-center flex-column flex-lg-row p-1">
<div class="media-body order-2 order-lg-1">
<h5 class="mt-0 font-weight-bold" style="font-size:1.1rem"><?=$rowselect['rono']?> - <?=($rowselect['rentaldate']!='')?(date('d/m/Y',strtotime($rowselect['rentaldate']))):''?> <a href="rentaledit.php?id=<?=$rowselect['rono']?>"><i class="fa fa-edit"></i></a> </h5>
<?php
$stockitem="";
$rono="";
$rentaldate="";
$coset=1;
$sqlselect2 = mysqli_query($connection, "SELECT stockmaincategory, stocksubcategory, overallwarranty, tdelete, typeofproduct, componenttype, componentname, make, capacity, qty, serialnumber, departments, installedon, warranty, id, stockitem, rono, rentaldate,datefrom,dateto  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and id='".$rowselect['id']."' order by rono desc");
while($infoselect2=mysqli_fetch_array($sqlselect2))
{
$sqlrent=mysqli_query($connection,"SELECT id,datefrom,dateto from jrcrental where id='".$_GET['type']."'");
$rent=mysqli_fetch_array($sqlrent);
?>
<?php
if(($rono!=$infoselect2['rono'])||($rentaldate!=$infoselect2['rentaldate'])||($stockitem!=$infoselect2['stockitem']))
{
?>
<h6 class="text-primary font-weight-bold pt-2" style="border-bottom: 1px solid #cccccc"><?=$infoselect2['stockitem']?> </h6>
<?php
if(($infolayoutproducts['stockmaincategory']=='1')||($infolayoutproducts['stockmaincategory']=='1'))
{
if($infoselect2['stockmaincategory']!="")
{
?>
<b>Main Category: </b><?=$infoselect2['stockmaincategory']?> &nbsp; &nbsp;
<?php
}
if($infoselect2['stocksubcategory']!="")
{
?>
<b>Sub Category: </b> <?=$infoselect2['stocksubcategory']?> &nbsp; &nbsp;
<?php
}
?>
<?php
}
?>
<b>From Date: </b><?=date('d/m/Y h:i a',strtotime($rent['datefrom']))?> &nbsp; &nbsp;	<b>To Date: </b><?=date('d/m/Y h:i a',strtotime($rent['dateto']))?>
<?php
if($infoselect2['overallwarranty']!='')
{
$overdate=$rent['datefrom'];
$off=(float)$infoselect2['overallwarranty'];
$overdate = str_ireplace('/', '-', $overdate);
$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
$date = new DateTime($effectiveDate);
$now = new DateTime();
if($date < $now)
{
echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span><br>';
?>
<?php
}
else
{
echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span><br>';
?>
<?php
}
}
}
?>
<div class="row" style="background-color:#f1f1f1">
<div class="col-lg-10 p-2">
<table width="100%" class="mytabl">
<tr>
<th rowspan="4" style="width:40px; background-color:#8d8d8d!important; color:#ffffff; text-align:center"><?=$coset?>
<?php
if($deleteproduct=='1')
{
?>
<a href="invoicedelete.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>&tdelete=<?=$infoselect2['tdelete']?>" onclick="return confirm('Are you sure want to Delete this Product')" class="button8"><i class="fa fa-trash"></i></a>
<?php
}
?>
</th>
<?php
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{
?>
<th>Type of Product</th>
<?php
}
}
?>
<?php
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{
?>
<th>Component Type</th>
<?php
}
}
?>
<?php
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{
?>
<th>Component Name</th>
<?php
}
}
?>
<?php
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{
?>
<th>Make</th>
<?php
}
}
?>
<?php
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{
?>
<th>Capacity</th>
<?php
}
}
if($infolayoutinvoice['qty']=='1')
{
?>
<th>Qty</th>
<?php
}
if($infolayoutinvoice['warranty']=='1')
{
?>
<th>Warranty</th>
<?php
}
?>
</tr>
<tr>
<?php
$colsp=0;
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{
?>
<td><?=$infoselect2['typeofproduct']?></td>
<?php
$colsp++;
}
}
?>
<?php
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{
?>
<td><?=$infoselect2['componenttype']?></td>
<?php
$colsp++;
}
}
?>
<?php
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{
?>
<td><?=$infoselect2['componentname']?></td>
<?php
$colsp++;
}
}
?>
<?php
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{
?>
<td><?=$infoselect2['make']?></td>
<?php
$colsp++;
}
}
?>
<?php
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{
?>
<td><?=$infoselect2['capacity']?></td>
<?php
$colsp++;
}
}
if($infolayoutinvoice['qty']=='1')
{
?>
<td><?=$infoselect2['qty']?></td>
<?php
$colsp++;
}
if($infolayoutinvoice['warranty']=='1')
{
?>
<td><?=$infoselect2['warranty']?> Months</td>
<?php
$colsp++;
}
?>
</tr>
<?php
if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
?>
<tr>
<th colspan="<?=$colsp?>">Serial Number</th>
</tr>
<tr>
<td colspan="<?=$colsp?>">
<?php
$srls=explode("| ",$infoselect2['serialnumber']);
$dpts=explode("| ",$infoselect2['departments']);
for($sr=0;$sr<count($srls);$sr++)
{
if(isset($srls[$sr]))
{
echo ' '.$srls[$sr];
}
if(isset($dpts[$sr]))
{
echo '-'.$dpts[$sr].', &nbsp; ';
}
}
?>
</td>
</tr>
<?php
}
?>
</table>
</div>
<div class="col-lg-2 p-2" style="line-height:1.6">
<?php
$sqlamc = "SELECT dateto From jrcrental where rono='".$infoselect2['rono']."' and id='".$_GET['type']."'";
$queryamc = mysqli_query($connection, $sqlamc);
$rowCountamc = mysqli_num_rows($queryamc);
if(!$queryamc){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountamc!=0)
{
?>
<?php
$rowamc = mysqli_fetch_array($queryamc);
$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
echo '<span class="bg-danger text-white">Lasped Rental <strong>('.date('d/m/Y h:i a',strtotime($rowamc['dateto'])).')</strong></span><br>';
/* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
$t=3;
echo '<span class="bg-success text-white">Rental Active <strong>('.date('d/m/Y h:i a',strtotime($rowamc['dateto'])).')</strong></span><br>';
/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
?>
<script>
document.getElementById("amccustomer").style.display="inline-block";
</script>
<?php
}
}
?>
<?php
if($infoselect2['overallwarranty']!='')
{
$overdate=$infoselect2['datefrom'];
$off=(float)$infoselect2['overallwarranty'];
$overdate = str_ireplace('/', '-', $overdate);
$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
$date = new DateTime($effectiveDate);
$now = new DateTime();
if($date < $now)
{
$t=4;
echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span><br>';
?>
<?php
}
else
{ $t=4;
echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span><br>';
?>
<?php
}
}
?>
</div>
</div>
<?php
$stockitem=$infoselect2['stockitem'];
$rono=$infoselect2['rono'];
$rentaldate=$infoselect2['rentaldate'];
$coset++;
}
?>
</div>
</div>
<!-- End -->
</li>
<!-- End -->
<?php
$count++;
}
}
}
else
{
$sqlselect = "SELECT invoiceno, invoicedate, consigneeid, id  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and  id='".$rowselect['id']."' group by invoiceno, invoicedate order by invoicedate desc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
$stockitem="";
$invoiceno="";
$invoicedate="";
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<!-- list group item-->
<li class="list-group-item">
<!-- Custom content-->
<div class="media align-items-lg-center flex-column flex-lg-row p-1">
<div class="media-body order-2 order-lg-1">
<h5 class="mt-0 font-weight-bold" style="font-size:1.1rem"><?=$rowselect['invoiceno']?> - <?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?> </h5>
<?php
$stockitem="";
$invoiceno="";
$invoicedate="";
$coset=1;
$sqlselect2 = mysqli_query($connection, "SELECT stockmaincategory, stocksubcategory, overallwarranty, tdelete, typeofproduct, componenttype, componentname, make, capacity, qty, serialnumber, departments, installedon, warranty, id, stockitem, invoiceno, invoicedate  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and id='".$rowselect['id']."' order by invoicedate desc");
while($infoselect2=mysqli_fetch_array($sqlselect2))
{
?>
<?php
if(($invoiceno!=$infoselect2['invoiceno'])||($invoicedate!=$infoselect2['invoicedate'])||($stockitem!=$infoselect2['stockitem']))
{
?>
<h6 class="text-primary font-weight-bold pt-2" ><?=$infoselect2['stockitem']?> </h6>
<?php
}
?>
<div class="row" >
<div class="col-lg-2 p-2" style="line-height:1.6">
<?php
$sqlamc = "SELECT dateto From jrcamc where sourceid='".$infoselect2['id']."'";
$queryamc = mysqli_query($connection, $sqlamc);
$rowCountamc = mysqli_num_rows($queryamc);
if(!$queryamc){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountamc!=0)
{
?>
<?php
$rowamc = mysqli_fetch_array($queryamc);
$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
echo '<span class="bg-danger text-white">AMC Expired <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
/* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
$t=2;
echo '<span class="bg-success text-white">AMC Active <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
?>
<script>
document.getElementById("amccustomer").style.display="inline-block";
</script>
<?php
}
}
?>
<?php
if($infolayoutinvoice['warranty']=='1')
{
if($infoselect2['warranty']!='')
{
?>
<?php
if($infoselect2['installedon']!='')
{
$overdate=$infoselect2['installedon'];
}
else
{
$overdate=$infoselect2['invoicedate'];
}
$off=(float)$infoselect2['warranty'];
$overdate = str_ireplace('/', '-', $overdate);
$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
$date = new DateTime($effectiveDate);
$now = new DateTime();
if($date < $now)
{
if(!isset($t))
{
$t=1;
}
echo '<span class="bg-danger text-white">Warranty Expired <strong>('.$effectiveDate1.')</strong></span><br>';
?>
<?php
}
else
{
if(!isset($t))
{
$t=0;
}
echo '<span class="bg-success text-white">Warranty Active <strong>('.$effectiveDate1.')</strong></span><br>';
?>
<?php
?>
<script>
document.getElementById("warrantycustomer").style.display="inline-block";
</script>
<?php
}
}
}
?>
<?php
if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
$sqlcons = "SELECT id From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$querycons = mysqli_query($connection, $sqlcons);
$rowCountcons = mysqli_num_rows($querycons);
if(!$querycons){
die("SQL query failed: " . mysqli_error($connection));
}
$rowcon = mysqli_fetch_array($querycons);
?>
<?php
}
?>
</div>
</div>
<?php
$stockitem=$infoselect2['stockitem'];
$invoiceno=$infoselect2['invoiceno'];
$invoicedate=$infoselect2['invoicedate'];
$coset++;
}
?>
</div>
</div>
<!-- End -->
</li>
<!-- End -->
<?php
$count++;
}
}
}
?>
</ul>
<!-- End -->
</div>
</div>
</div>
</div>
<?php
}
?>
</div>
<br>
<div class="row">
<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
<div class="card card-profile shadow">
<div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
<div class="d-flex justify-content-between">
<h6><b>Call Details</b></h6>
</div>
</div>
<div class="card-body pt-0 pt-md-4">
<form method="post" action="callsadds.php" id="myForm">
<input type="hidden" id="consigneeid" name="consigneeid" value="<?=$consigneeid?>">
<input type="hidden" id="sourceid" name="sourceid" value="<?=$id?>">
<?php
if(isset($_GET['ts1']))
{
?>
<input type="hidden" id="ts1" name="ts1" value="<?=$_GET['ts1']?>">
<?php
}
?>
<div class="row">
<?php
$businesstypes1=explode(',',$businesstype);
if($infolayoutcall['businesstype']=='1')
{
if(count($businesstypes1)>1)
{
?>
<div class="col-lg-2 mb-3" style="display:none">
<label for="businesstype">Business Type:</label>
</div>
<div class="col-lg-10 mb-3" style="display:none">
<?php
if($businesstype!='')
{
$businesstypes=explode(',',$businesstype);
  $checked = true;
foreach($businesstypes as $btype)
{
?>	
<label class="mr-2"><input type="radio" name="businesstype" value="<?=$btype?>" <?=($infolayoutcall['businesstypereq']=='1')?'required':''?> <?=($checked)?'checked':''?>> <?=$btype?> </label>
<?php
  $checked = false;
}
}
?>
</div>
<?php
}
else
{
?>
<input type="hidden" name="businesstype" id="businesstype" value="<?=$businesstypes1[0]?>">
<?php
}
}
else
{
?>
<input type="hidden" name="businesstype" id="businesstype" value="<?=$businesstypes1[0]?>">
<?php
}
?>
<div class="col-lg-2 mb-3" style="display:none">
<label for="servicetype">Service Type:</label>
</div>
<div class="col-lg-10 mb-3" style="display:none">
<label class="mr-2"><input type="radio" name="servicetype" id="servicetypeonsite" <?=((isset($_GET['ts']))&&(($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> value="On-Site" <?=($infolayoutcall['servicetypereq']=='1')?'required':''?> onchange="checkcarry()" checked > On-Site </label>
<label class="mr-2" <?=(($liveplan=='GOLD')||($liveplan=='DIAMOND'))?'':'style="display:none"'?>><input type="radio" name="servicetype" id="servicetypecarry" value="Carry-In" <?=($infolayoutcall['servicetypereq']=='1')?'required':''?> onchange="checkcarry()" <?=((isset($_GET['at']))&&($_GET['at']=="in"))?'checked':''?>> Carry-In </label>
</div>
<?php
if($infolayoutcall['customernature']=='1')
{
?>
<div class="col-lg-2 mb-3" style="display:none">
<label for="customernature">Customer Nature:</label>
</div>
<div class="col-lg-10 mb-3" style="display:none">
<?php
if(($infolayoutcall['customernaturea']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" <?=((isset($primarywarranty))&&(($primarywarranty=='AMC')))?'checked':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> <?=((isset($t))&&(($t=='2')))?'checked':''?> value="AMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>  > AMC </label>
<?php
}
if(($infolayoutcall['customernaturew']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" <?=((isset($primarywarranty))&&(($primarywarranty=='Warranty')))?'checked':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')))?'checked':''?>  <?=((isset($t))&&(($t=='0')))?'checked':''?> value="Warranty" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Warranty </label>
<?php
}
if(($infolayoutcall['customernatureow']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="Out of Warranty" <?=((isset($primarywarranty))&&(($primarywarranty=='Out of Warranty')))?'checked':''?> <?=((isset($t))&&(($t=='1')))?'checked':''?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Out of Warranty </label>
<?php
}
if(($infolayoutcall['customernaturenone']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="None"  <?=((isset($t))&&(($t=='1') || ($t=='0') || ($t=='2')) )?'':'checked'?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> None </label>
<?php
					  }
if(($infolayoutcall['customernatureom']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="Other Make" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Other Make</label>
<?php
}
if(($infolayoutcall['customernaturefsma']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="FSMA" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> FSMA</label>
<?php
}
if(($infolayoutcall['customernaturecamc']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="CAMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> CAMC</label>
<?php
}
if(($infolayoutcall['customernaturerental']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="Rental" <?=(isset($_GET['type']))?'checked':''?> <?=((isset($t))&&(($t=='3')))?'checked':''?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>   Rental</label>
<?php
}
if(($infolayoutcall['customernaturecorporate']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="Corporate" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Corporate</label>
<?php
}
if(($infolayoutcall['customernaturewalkin']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="Walk-In" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Walk-In</label>
<?php
}
if(($infolayoutcall['customernaturechannel']=='1'))
{
?>
<label class="mr-2"><input type="radio" name="customernature" value="Channel" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Channel</label>
<?php
}
?>
</div>
<?php
}
else
{
?>
<input type="hidden" name="customernature" id="customernature" value="">
<?php
}
?>
<div class="col-lg-2 mb-3" <?=($infolayoutcall['calltype']=='1')?'style="display:none"':'style="display:none"'?> >
<label for="callnature">Call Type:</label>
</div>
<div class="col-lg-10 mb-3" <?=($infolayoutcall['calltype']=='1')?'style="display:none"':'style="display:none"'?> style="display:none">
<label class="mr-2"><input type="radio" name="calltype" id="calltypes" value="Service Call" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>> Service Call (Received from Customer) </label>
<label class="mr-2"><input  type="radio" name="calltype" id="calltypeo" <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')||($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> value="Other Call" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>> Other Call (Service Related Activities) </label>
</div>
<?php
if($infolayoutcall['callnature']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="callnature">Call Nature &nbsp;<span href="#" data-toggle="modal" data-target="#callnaturemodal">&nbsp;<i class="fa fa-plus text-primary"></i> </span></label>
<select class="form-control fav_clr" id="callnature" name="callnature" <?=($infolayoutcall['callnaturereq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT callnature From jrccallnature order by callnature asc";
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
?>
<option value="<?=$rowrep['callnature']?>"><?=$rowrep['callnature']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="callnature" id="callnature" value="">
<?php
}
if($infolayoutcall['callfrom']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="callfrom">Call Received From (Contact Number)</label>
<input type="text" class="form-control" id="callfrom" name="callfrom" maxlength="10" value="<?=$mobile?>" <?=($infolayoutcall['callfromreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="callfrom" id="callfrom" value="">
<?php
}
if($infolayoutcall['callon']=='1')
{
?>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="callon">Call Received On</label>
<input type="text" class="form-control" id="callon" name="callon" readonly  value="<?=date('Y-m-d H:i:s')?>" <?=($infolayoutcall['callonreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="callon" id="callon" value="<?=date('Y-m-d H:i:s')?>">
<?php
}
if($infolayoutcall['callhandling']=='1')
{
?>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="callhandlingname">Call Handled By</label>
<?php
$sqlrep2 = "SELECT id, adminusername From jrcadminuser where id='".$_SESSION['callhandlingid']."'  order by adminusername asc";
$queryrep2 = mysqli_query($connection, $sqlrep2);
$rowCountrep2 = mysqli_num_rows($queryrep2);
$rowrep2 = mysqli_fetch_array($queryrep2);
if($_SESSION['callhandlingid']!='')
{
?>
<input type="hidden" id="callhandlingname" name="callhandlingname" <?=($infolayoutcall['callhandlingreq']=='1')?'required':''?> value="<?=$rowrep2['adminusername']?>">
<?php
}
else
{
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0'  order by id asc";
$queryrep = mysqli_query($connection, $sqlrep);
$rowrep = mysqli_fetch_array($queryrep);
?>
<input type="hidden" id="callhandlingname" name="callhandlingname" <?=($infolayoutcall['callhandlingreq']=='1')?'required':''?> value="<?=$rowrep['adminusername']?>">
<?php
}
?>
<select class="form-control fav_clr" id="callhandlingid" name="callhandlingid" <?=($infolayoutcall['callhandlingreq']=='1')?'required':''?> onchange="valchange('callhandling')">
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0'  order by id asc";
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
?>
<option value="<?=$rowrep['id']?>" <?=(($rowrep['id']==$_SESSION['callhandlingid'])?"selected":" ")?>><?=$rowrep['adminusername']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="callhandlingid" id="callhandlingid" value="<?=$adminuserid?>">
<input type="hidden" name="callhandlingname" id="callhandlingname" value="<?=$adminusername?>">
<?php
}
if($infolayoutcall['reportedproblem']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="reportedproblem" >Reported Problem &nbsp;<span href="#" data-toggle="modal" data-target="#reportmodal">&nbsp;<i class="fa fa-plus text-primary" ></i> </span></label>
<select class="form-control fav_clr" id="reportedproblem" name="reportedproblem" <?=($infolayoutcall['reportedproblemreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT reportedproblem From jrcreportedproblem order by reportedproblem asc";
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
?>
<option value="<?=$rowrep['reportedproblem']?>" <?=((isset($_GET['t']))&&($_GET['t']=='wm')&&($rowrep['reportedproblem']=='WARRANTY MAINTENANCE'))?'selected':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire'))&&($rowrep['reportedproblem']=='WARRANTY MAINTENANCE'))?'selected':''?> <?=((isset($_GET['t']))&&($_GET['t']=='am')&&($rowrep['reportedproblem']=='AMC MAINTENANCE'))?'selected':''?>><?=$rowrep['reportedproblem']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="reportedproblem" id="reportedproblem" value="">
<?php
}
if($infolayoutcall['serial']=='1')
{
if(isset($_GET['type']))
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="serial">Serial Number </label>
<select class="fav_clr form-control" name="serial[]" id="serial" <?=($infolayoutcall['serialreq']=='1')?'required':''?> multiple="multiple">
<?php
$sqlserial = "SELECT serialnumber,id From jrcrental where id='".$_GET['type']."'  order by id asc";
$queryserial = mysqli_query($connection, $sqlserial);
$rowCountserial = mysqli_num_rows($queryserial);
if(!$queryserial){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountserial > 0)
{
$count=1;
while($rowserial = mysqli_fetch_array($queryserial))
{
$serialnumbers=explode(" | ",$rowserial['serialnumber']);
if(!empty($serialnumbers))
{
foreach($serialnumbers as $ser)
{
?>
<option value="<?=$ser?>" ><?=$ser?></option>
<?php
}
}
}
}
?>
<option value="Not Available">Not Available</option>
</select>
</div>
</div>
<?php
}
else
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="serial">Serial Number </label>
<select class="fav_clr form-control" name="serial[]" id="serial" <?=($infolayoutcall['serialreq']=='1')?'required':''?> multiple="multiple">
<?php
$sqlserial = "SELECT serialnumber From jrcserials where sourceid='".$_GET['id']."' and sstatus='0' order by serialqty asc";
$queryserial = mysqli_query($connection, $sqlserial);
$rowCountserial = mysqli_num_rows($queryserial);
if(!$queryserial){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountserial > 0)
{
$count=1;
while($rowserial = mysqli_fetch_array($queryserial))
{
?>
<option value="<?=$rowserial['serialnumber']?>"><?=$rowserial['serialnumber']?></option>
<?php
}
}
?>
<option value="Not Available">Not Available</option>
</select>
</div>
</div>
<?php
}
}
else
{
?>
<input type="hidden" name="serial" id="serial" value="Not Available">
<?php
}
if($infolayoutcall['coordinator']=='1')
{
?>
<div class="col-lg-3" style="display:none" >
<div class="form-group">
<label for="coordinatorname">Co-Ordinator Assigned</label>
<?php
$sqlrep1 = "SELECT id, adminusername From jrcadminuser where id='".$_SESSION['coordinatorid']."' order by adminusername asc";
$queryrep1 = mysqli_query($connection, $sqlrep1);
$rowCountrep1 = mysqli_num_rows($queryrep1);
$rowrep1 = mysqli_fetch_array($queryrep1);
if($_SESSION['coordinatorid']!='')
{
?>
<input type="hidden" id="coordinatorname" name="coordinatorname" <?=($infolayoutcall['coordinatorreq']=='1')?'required':''?> value="<?=$rowrep1['adminusername']?>" >
<?php
}
else{
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0'  order by id asc";
$queryrep = mysqli_query($connection, $sqlrep);
$rowCountrep = mysqli_num_rows($queryrep);
$rowrep = mysqli_fetch_array($queryrep);
?>
<input type="hidden" id="coordinatorname" name="coordinatorname" <?=($infolayoutcall['coordinatorreq']=='1')?'required':''?> value="<?=$rowrep['adminusername']?>" >
<?php
}
?>
<select class="form-control fav_clr" id="coordinatorid" name="coordinatorid" <?=($infolayoutcall['coordinatorreq']=='1')?'required':''?> onchange="valchange('coordinator')">
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0'  order by id asc";
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
?>
<option value="<?=$rowrep['id']?>" <?=(($rowrep['id']==$_SESSION['coordinatorid'])?"selected":"")?>><?=$rowrep['adminusername']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="coordinatorid" id="coordinatorid" value="<?=$adminuserid?>">
<input type="hidden" name="coordinatorname" id="coordinatorname" value="<?=$adminusername?>">
<?php
}
if($infolayoutcall['otherremarks']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="otherremarks">Other Remarks</label>
<textarea type="text" class="form-control" id="otherremarks" name="otherremarks"  <?=($infolayoutcall['otherremarksreq']=='1')?'required':''?>></textarea>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="otherremarks" id="otherremarks" value="">
<?php
}
?>
</div>

<div id="carrydiv" style="display:none">
<div class="row">
<div class="col-lg-3">
<label class="text-primary">Diagnosis Information</label>
</div>
</div>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosisby">Diagnosis By</label><br>
<label class="mr-2"><input type="radio" name="diagnosisby" id="diagnosisbyengineer" value="engineer" onchange="checkdiagnosis()"> Engineer </label>
<label class="mr-2"><input type="radio" name="diagnosisby" id="diagnosisbycoordinator" value="coordinator" onchange="checkdiagnosis()"> Co-ordinator </label>
</div>
</div>
<div class="col-lg-3">
<div id="diagnosiseng">
<div class="form-group">
<label for="diagnosisname">Diagnosis By (Engineer Name)</label>
<input type="hidden" id="diagnosisengineername" name="diagnosisengineername" >
<select class="form-control fav_clr" id="diagnosisengineerid" name="diagnosisengineerid" onchange="valchange('diagnosisengineer')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer  where enabled='0'  order by engineername asc";
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
?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div id="diagnosiscoor">
<div class="form-group">
<label for="diagnosisname">Diagnosis By (Co-Ordinator Name)</label>
<input type="hidden" id="diagnosiscoordinatorname" name="diagnosiscoordinatorname">
<select class="form-control fav_clr" id="diagnosiscoordinatorid" name="diagnosiscoordinatorid" onchange="valchange('diagnosiscoordinator')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser  where enabled='0'  order by adminusername asc";
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
?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['adminusername']?></option>
<?php
}
}
?>
</select>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="callon">Diagnosed On</label>
<input type="datetime-local" class="form-control" id="diagnosison" value="<?=date('Y-m-d H:i:s')?>" name="diagnosison" step="60">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="problemobserved">Problem Observed</label>
<select class="form-control fav_clr" id="problemobserved" name="problemobserved">
<option value="">Select</option>
<?php
$sqlrep = "SELECT problemobserved From jrcproblemobserved order by problemobserved asc";
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
?>
<option value="<?=$rowrep['problemobserved']?>"><?=$rowrep['problemobserved']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosisestdate">Estimated Date of Completion</label>
<input type="datetime-local" class="form-control" id="diagnosisestdate" name="diagnosisestdate" step="60">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosisestcharge">Estimated Charges</label>
<input type="number" class="form-control" id="diagnosisestcharge" name="diagnosisestcharge" min="0" step="0.01">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosisremarks">Diagnosis Remarks</label>
<textarea class="form-control" id="diagnosisremarks" name="diagnosisremarks"></textarea>
</div>
</div>
</div>
<hr>
<div class="row">
<div class="col-lg-3">
<label class="text-primary">Product Received Information</label>
</div>
</div>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosissignname">Received From (Name)</label>
<input type="text" class="form-control" name="diagnosissignname" id="diagnosissignname">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosissignmode">Received Mode</label>
<select class="form-control fav_clr" id="diagnosissignmode" name="diagnosissignmode">
<option value="">Select</option>
<option value="By Hand">By Hand</option>
<option value="By Courier">By Courier</option>
</select>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosissignmoderemark">Received Mode Remarks</label>
<textarea  class="form-control" id="diagnosissignmoderemark" name="diagnosissignmoderemark" rows="1">
</textarea>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosismaterial">Additional Materials</label>
<select class="form-control fav_clr" id="diagnosismaterial" name="diagnosismaterial[]" multiple>
<option value="">Select</option>
<?php
$sqlrep = "SELECT material From jrcmaterial order by material asc";
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
?>
<option value="<?=$rowrep['material']?>"><?=$rowrep['material']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<!--div class="col-lg-3">
<div class="form-group">
<label for="diagnosismaterial">Additional Materials Remarks</label>
<textarea class="form-control" id="diagnosismaterial" name="diagnosismaterial"></textarea>
</div>
</div-->
<div class="col-lg-3">
<div class="form-group">
<label for="godown">Move To(Warehouse)</label>
<select class="form-control fav_clr" id="godownname" name="godownname">
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, godownname From jrcgodown order by id asc";
$querygo = mysqli_query($connection, $sqlgo);
$rowCountgo = mysqli_num_rows($querygo);
if(!$querygo){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountgo > 0)
{
$count=1;
while($rowgo = mysqli_fetch_array($querygo))
{
?>
<option value="<?=$rowgo['id']?>"><?=$rowgo['godownname']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="godown">Supplier Name</label>
<select class="form-control fav_clr" id="suppliername" name="suppliername">
<option value="">Select</option>
<?php
$sqlsup = "SELECT id, suppliername From jrcsuppliers order by suppliername asc";
$querysup = mysqli_query($connection, $sqlsup);
$rowCountsup = mysqli_num_rows($querysup);
if(!$querysup){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountsup > 0)
{
$count=1;
while($rowsup = mysqli_fetch_array($querysup))
{
?>
<option value="<?=$rowsup['id']?>"><?=$rowsup['suppliername']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="diagnosissignname">Signature</label>
<input type="hidden" class="form-control" name="diagnosissignature" id="diagnosissignature" value="">
<img id="diagnosissignatureimg" src="">
<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#signModal">Get Signature</a>
<div id="signModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Get Signature</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body" class="text-center" align="center">
<p class="text-center"><div id="signpad" align="center" style="border:1px solid #000000; width:302px; height:202px;">
<canvas class="pad" id="pad" width="300" height="200" ></canvas>
</div></p>
</div>
<div class="modal-footer">
<input type="button" class="btn btn-warning" value="Clear" id="clear" />
<input type="button" id="btnSaveSign" class="btn btn-success" value="Submit"  data-dismiss="modal"/>
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3">
<label for="diagnosisimg">Product Images (On Received Time)</label>
<div id="mulitplefileuploader" style="width:100%">Upload Site Images</div>
<div id="status"></div>
<div id="showData" class="imgcontainer">
</div>
<input id="diagnosisimg" type="hidden" name="diagnosisimg" value="">
</div>
</div>
</div>
<div class="row" style="display:none">
<div class="col-lg-3">
<label class="text-primary">Engineer Information</label>
</div>
</div>
<div class="row" style="display:none">
<?php
if($infolayoutcall['engineer']=='1')
{
?>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="engineertype">Engineer Type</label><br>
<label class="mr-2"><input type="radio" name="engineertype" id="engineertypesingle" value="0" onchange="checkengineer()" checked> One Engineer </label>
<label class="mr-2"><input type="radio" name="engineertype" id="engineertypemultiple" value="1" onchange="checkengineer()"> Multiple Engineers </label>
</div>
</div>
<div class="col-lg-3" style="display:none">
<div id="engineereng">
<div class="form-group">
<label for="engineername">Engineer Assigned</label>
<input type="hidden" id="engineername" name="engineername" value="<?=$engineername?>">
<input type="hidden" id="engineername" name="engineerid" value="<?=$engineerid?>">
</div>
</div>
<div id="engineercoor" style="display:none">
<div class="form-group">
<label for="engineername">Engineers Assigned</label>
<input type="hidden" id="engineersname" name="engineersname" >
<input type="hidden" id="engineesrid" name="engineesrid" >
</div>
</div>
</div>
<div class="col-lg-3" style="display:none">
<div id="reportingengineertype">
<div class="form-group">
<label for="reportingengineername">Primary Engineer</label>
<input type="hidden" id="reportingengineername" name="reportingengineername" >
<select class="form-control fav_clr" id="reportingengineerid" name="reportingengineerid" onchange="valchange('reportingengineer')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0'  order by engineername asc";
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
?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
}
}
?>
</select>
</div>
</div>
</div>
<div class="col-lg-3" style="display:none">
<div id="reportingengineereng">
<div class="form-group">
<label for="reportingtype" class="text-primary">Reporting Type</label><br>
<label class="mr-2"><input type="radio" name="reportingtype" id="reportingtypeone" value="0" onchange="checkreport()" checked> All in One Report </label>
<label class="mr-2"><input type="radio" name="reportingtype" id="reportingtypeindividual" value="1" onchange="checkreport()"> Invidual Report </label>
</div>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="engineerid" id="engineerid" value="">
<input type="hidden" name="engineername" id="engineername" value="">
<input type="hidden" name="engineersid[]" id="engineersid" value="">
<input type="hidden" name="engineersname" id="engineersname" value="">
<input type="hidden" name="reportingtype" id="reportingtype" value="0">
<input type="hidden" name="reportingengineerid" id="reportingengineerid" value="">
<input type="hidden" name="reportingengineername" id="reportingengineername" value="">
<?php
}
?>
</div>
<div class="row" >
<?php
if($infolayoutcall['customersms']=='1')
{
?>
<div class="col-lg-12" >
<div class="form-group">
<label style="display:none"><input type="checkbox" name="customersms" id="customersms" > SEND TO CUSTOMER </label> 
<?php
}
if($infolayoutcall['coordinatorsms']=='1')
{
?>
<input type="hidden" name="callhandledsms" id="callhandledsms">
<label style="display:none"><input type="checkbox" name="coordinatorsms" id="coordinatorsms"> SEND TO CO-ORDINATOR </label> 
<?php
}
if($infolayoutcall['engineersms']=='1')
{
?>
<label style="display:none"><input type="checkbox" name="engineersms" id="engineersms" > SEND TO ENGINEER </label>
</div>
</div>
<?php
}
?>
<div class="col-lg-12" >
<div class="form-group" >
<?php
if($infolayoutcall['sms']=='1')
{
?>
<label style="display:none"><input type="checkbox" name="customerwa" id="customerwa" checked > SMS <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a SMS Package to Send SMS to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label> 
<?php
}
if($infolayoutcall['whatsapp']=='1')
{
?>
<input type="hidden" name="callhandledwa" id="callhandledwa">
<label style="display:none"><input type="checkbox" name="coordinatorwa" id="coordinatorwa" checked> WHATSAPP <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a WHATSAPP API Package to Send WHATSAPP to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label> 
<?php
}
if($infolayoutcall['mail']=='1')
{
?>
<label style="display:none"><input type="checkbox" name="engineerwa" id="engineerwa" checked> MAIL </label>
</div>
</div>
<?php
}
?>
<br>
<input class="btn btn-primary" type="submit" name="submit" value="Submit" onclick="validateFormAndSubmit()"
>
</div>
</form>
</div>
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
<!-----Call nature modal---->
<div class="modal fade" id="callnaturemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add New Call Nature</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="calltagForm">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label>Call Type</label><span class="text-danger">*</span>
<select name="ccalltype" id="ccalltype" class="form-control" required>
<option value="">Select</option>
<option value="Service Call">Service Call</option>
<option value="Other Call">Other Call</option>
</select>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="callnature">Call Nature</label><span class="text-danger">*</span>
<input type="text" class="form-control" id="ccallnature" name="ccallnature"  required>
</div>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="calltag-form-submit" name="ccall" value="Submit" >
</div>
</form>
</div>
</div>
</div>
</div>
<!-----Call nature modal---->
<!-----report modal---->
<div class="modal fade" id="reportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add New Problem Reported</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="reporttagForm">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label for="creportedproblem">Problem Reported</label><span class="text-danger">*</span>
<input type="text" class="form-control" id="creportedproblem" name="creportedproblem"  required>
</div>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="callprtag-form-submit" name="cprcall" value="Submit" >
</div>
</form>
</div>
</div>
</div>
</div>
<!-----report modal---->
<script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
<script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugins -->
<script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<!-- Page level plugins -->
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="../../1637028036/js/datatables.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
<script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
<script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
<script>
function checkvalidate()
{
var engineertypesingle=document.getElementById("engineertypesingle");
var engineerid=document.getElementById("engineerid");
var reportingengineerid=document.getElementById("reportingengineerid");
if(engineertypesingle.checked==true)
{
if(engineerid.value=='')
{
alert("Please Assign the Engineer");
engineerid.focus();
return false;
}
}
else
{
if(engineersid.value=='')
{
alert("Please Assign the Engineer");
engineersid.focus();
return false;
}
if(reportingengineerid.value=='')
{
alert("Please Assign the Primary Engineer");
reportingengineerid.focus();
return false;
}
}
}
</script>
<script>
function checkcarry()
{
var carrydiv=document.getElementById("carrydiv");
var servicetypecarry=document.getElementById("servicetypecarry");
if(servicetypecarry.checked==true)
{
carrydiv.style.display="block";
}
else
{
carrydiv.style.display="none";
}
}
function checkdiagnosis()
{
var diagnosisby=document.getElementById("diagnosisby");
var diagnosisbyengineer=document.getElementById("diagnosisbyengineer");
var diagnosisbycoordinator=document.getElementById("diagnosisbycoordinator");
var diagnosiscoor=document.getElementById("diagnosiscoor");
var diagnosiseng=document.getElementById("diagnosiseng");
if(diagnosisbyengineer.checked==true)
{
diagnosiseng.style.display="block";
diagnosiscoor.style.display="none";
}
else
{
diagnosiseng.style.display="none";
diagnosiscoor.style.display="block";
}
}
function checkengineer()
{
var engineertypesingle=document.getElementById("engineertypesingle");
var engineercoor=document.getElementById("engineercoor");
var engineereng=document.getElementById("engineereng");
var reportingengineertype=document.getElementById("reportingengineertype");
var reportingengineereng=document.getElementById("reportingengineereng");
if(engineertypesingle.checked==true)
{
engineereng.style.display="block";
engineercoor.style.display="none";
reportingengineertype.style.display="none";
reportingengineereng.style.display="none";
checkreport();
}
else
{
engineereng.style.display="none";
engineercoor.style.display="block";
reportingengineertype.style.display="block";
reportingengineereng.style.display="block";
checkreport();
}
}
function checkreport()
{
var reportingtypeone=document.getElementById("reportingtypeone");
var reportingengineereng=document.getElementById("reportingengineereng");
if(reportingtypeone.checked==true)
{
reportingengineereng.style.display="none";
$("#reportingengineername").val('');
$("#reportingengineerid").val('');
}
else
{
reportingengineereng.style.display="block";
}
}
</script>
<script>
function image(thisImg) {
// var img = document.createElement("IMG");
// img.src = thisImg;
// img.className="img-fluid";
// document.getElementById('showData').appendChild(img);
var count = $('.imgcontainer .imgcontent').length;
count = Number(count) + 1;
$('.imgcontainer').append("<div class='imgcontent' id='imgcontent_" + count + "' ><img src='" + thisImg +
"' width='100' height='100'><span class='imgdelete' id='imgdelete_" + count + "'>Delete</span></div>");
}
$(document).ready(function() {
var settings = {
url: "imageups.php",
method: "POST",
allowedTypes: "jpg,png",
fileName: "myfile",
multiple: true,
maxFileCount: 5,
onSuccess: function(files, data, xhr) {
var obj = JSON.parse(data);
console.log(obj.imglist);
image(obj.imglist);
var vals = $("#diagnosisimg").val();
if (vals != '') {
$("#diagnosisimg").val(vals + ',' + obj.imglist);
} else {
$("#diagnosisimg").val(obj.imglist);
}
$("#status").html("<font color='green'>Upload is success</font>");
},
onError: function(files, status, errMsg) {
$("#status").html("<font color='red'>Upload is Failed</font>" + errMsg);
}
}
$("#mulitplefileuploader").uploadFile(settings);
});
</script>
<script>
// Remove file
$('.imgcontainer').on('click', '.imgcontent .imgdelete', function() {
var id = this.id;
var split_id = id.split('_');
var num = split_id[1];
// Get image source
var imgElement_src = $('#imgcontent_' + num + ' img').attr("src");
var deleteFile = confirm("Do you really want to Delete?");
if (deleteFile == true) {
var vals = $("#diagnosisimg").val();
let newStr = vals.replace(imgElement_src + ',', '');
newStr = newStr.replace(',' + imgElement_src, '');
newStr = newStr.replace(imgElement_src, '');
$("#diagnosisimg").val(newStr);
$('#imgcontent_' + num).remove();
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
function valchange(els)
{
var data = $("#"+els+"id").select2('data');
if(data) {
if(data[0].text=='Select')
{
$("#"+els+"name").val('');
}
else
{
$("#"+els+"name").val(data[0].text);
}
}
else
{
$("#"+els+"name").val('');
}
}
function valchanges(els)
{
var data = $("#"+els+"id").select2('data');
var info='';
if(data) {
for(var i=0; i<data.length;i++)
{
if(data[i].text!='')
{
if(info!='')
{
info+=','+data[i].text;
}
else
{
info=data[i].text;
}
}
}
$("#"+els+"name").val(info);
}
else
{
$("#"+els+"name").val('');
}
}
</script>
<script type="text/javascript">
$(function() {
$( "#topsearch" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
/* $( "#callhandlingname" ).autocomplete({
source: 'callsearch.php', select: function (event, ui) { $("#callhandlingname").val(ui.item.value); $("#callhandlingid").val(ui.item.id);}
}); */
$( "#coordinatorname" ).autocomplete({
source: 'coorsearch.php', select: function (event, ui) { $("#coordinatorname").val(ui.item.value); $("#coordinatorid").val(ui.item.id);}
});
$( "#engineername" ).autocomplete({
source: 'engsearch.php', select: function (event, ui) { $("#engineername").val(ui.item.value); $("#engineerid").val(ui.item.id);}
});
});
$(document).ready(function() {
$('.fav_clr').select2({
width: '100%',
allowClear: true,
placeholder: ''
});
});
$('.fav_clr').on("select2:select", function (e) {
var data = e.params.data.text;
if(data=='all'){
$(".fav_clr > option").prop("selected","selected");
$(".fav_clr").trigger("change");
}
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
<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
</script>
<script>
$(document).ready(function(){
$("#callnature").change(function(){
var callnature=$("#callnature").val();
if(callnature=="")
{
$("#calltype").val('');
}
else
{
$.get("callsearch2.php", {callnature: callnature} , function(data){
if (data=="Other Call")
{
document.getElementById("calltypes").checked=false;
document.getElementById("calltypeo").checked=true;
}
else
{
document.getElementById("calltypes").checked=true;
document.getElementById("calltypeo").checked=false;
}
});
}
});
});
</script>
<!--call nature model-->
<script>
$(function() {
$('#calltag-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "callnaturecall.php",
data: $('#calltagForm').serialize(),
success: function(response) {
console.log(response);
$('#callnaturemodal').modal('toggle');
var len = response.length;
var calltype = $("#ccalltype").val();
var callnature = $("#ccallnature").val();
$("#calltype").val(calltype);
var newOption = new Option(callnature, callnature, true, true);
// Append it to the select
$('#callnature').append(newOption).trigger('change');
document.getElementById("calltagForm").reset();
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>
<!--call nature model-->
<script>
$(function() {
$('#callprtag-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "reportproblemcall.php",
data: $('#reporttagForm').serialize(),
success: function(response) {
console.log(response);
$('#reportmodal').modal('toggle');
var len = response.length;
var reportedproblem = $("#creportedproblem").val();
$("#reportedproblem").val(reportedproblem);
var newOption1 = new Option(reportedproblem, reportedproblem, true, true);
// Append it to the select
$('#reportedproblem').append(newOption1).trigger('change');
document.getElementById("reporttagForm").reset();
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>
<!--call nature model-->
<?php include('additionaljs.php');   ?>
</body>
</html>
<?php
}
?>