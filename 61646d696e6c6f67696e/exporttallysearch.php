<?php
include('lcheck.php');
if($salesorder=='0')
{
header("Location: dashboard.php");
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Sales Order</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
.table td, .table th {
    padding: 1.0rem;
    vertical-align: center;
    border-top: 1px solid #e3e6f0;
}
.table th {
	    color: #fff;
}
.table thead th {
    vertical-align: middle;
    border-bottom: 2px solid #e3e6f0;
}
</style>
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
 <?php include('salesnavbar.php');?>
<?php /* include('salesnavbar.php'); */?>
<div class="container-fluid">
<!-- Page Heading -->
<!--div class="d-sm-flex align-items-center justify-content-between mb-1">

<?php
$sqlselect = "SELECT invoiceno, grandtotal FROM jrctally  ORDER BY id DESC";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$completedtotal=0;
$pendingtotal=0;
while($rowselect = mysqli_fetch_array($queryselect))
{
	if($rowselect['invoiceno']!='')
	{
		$completedtotal += $rowselect['grandtotal'];
	}
	else
	{
		$pendingtotal += $rowselect['grandtotal'];
	}
}
}
?>
<h1 class="h4 mb-2 mt-2 text-gray-800" style="display:none">Completed Amount - <?=$completedtotal?></h1>
<!--a href="importsales.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary  shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Import Data</a-->
<h1 class="h4 mb-2 mt-2 text-gray-800 text-center">Pending Sales Order Search</h1>
<h1 class="h4 mb-2 mt-2 text-gray-800" style="display:none">Pending Amount - <?=$pendingtotal?></h1>
<!--a href="exporttallyadd.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Data</a-->
</div-->
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
<?php
$sqlselect = "SELECT id, qno, sotype, DATE_ADD(podate, INTERVAL duedays DAY) AS next_due_date FROM jrctally ORDER BY next_due_date ASC";

$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$qno=0;
$regular=0;
$service=0;
while($rowselect = mysqli_fetch_array($queryselect))
{
	if($rowselect['qno']!='')
	{
		$qno++;
	}
	if($rowselect['sotype']=='Service')
	{
		$service++;
	}
	if($rowselect['sotype']=='Regular')
	{
		
		$regular++;
	}
}
}
?>
<div class="row">
<div class="col-xl-4 col-sm-6 mb-3" style="display:none">
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                               onClick="window.location.href= 'exporttally.php?sotype=qno'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">
                                                Total Quotation to Sales Order</h5>
												<h4><?=$qno?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>
						<div class="col-xl-4 col-sm-6 mb-3" style="display:none">
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                               onClick="window.location.href= 'exporttally.php?sotype=Regular'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">
                                                Total Regular Sales Order</h5>
												<h4><?=$regular?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>
						<div class="col-xl-4 col-sm-6 mb-3" style="display:none">
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                               onClick="window.location.href= 'exporttally.php?sotype=Service'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">
                                                Total Service Sales Order</h5>
												<h4><?=$service?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>

      </div>
	   <div class="card shadow mb-4">
	   <div class="card-body">
<form action="" method="post">
<div class="row">
	  <div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="datefrom">Sales Order From</label>
    <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="Invoice Date From" value="<?=(isset($_POST['datefrom']))?$_POST['datefrom']:((isset($_GET['datefrom']))?$_GET['datefrom']:'')?>" >
  </div>
</div>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="dateto">Sales Order To</label>
    <input type="date" class="form-control" id="dateto" name="dateto" placeholder="Invoice Date To" value="<?=(isset($_POST['dateto']))?$_POST['dateto']:((isset($_GET['dateto']))?$_GET['dateto']:'')?>" >
  </div>
</div>
</div>
 <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>
</div>
<?php
$staqu="";
if(isset($_POST['submit']))
			{
				if(($_POST['datefrom'])&&($_POST['dateto']))
				{
					if($staqu!="")
					{
						$staqu.=" where createdon BETWEEN '".date('Y-m-d 00:00:00', strtotime($_POST['datefrom']))."' AND '".date('Y-m-d 23:59:59',strtotime($_POST['dateto']))."'";
					}
					else
					{
						$staqu.=" where createdon BETWEEN '".date('Y-m-d 00:00:00',strtotime($_POST['datefrom']))."' AND '".date('Y-m-d 23:59:59',strtotime($_POST['dateto']))."'";
					}
				}
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Sales Order</h6>
</div>-->
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead style="background-color: #00B3BC">
<tr style="text-align: center; text-white">
<th>S.No</th>
<th>Customer Name</th>
<th>Department</th>
<th>Purchase Order No</th>
<th>Due Days</th>
<!--th>Purchase Order Date</th-->
<th>Sales Order No</th>
<!--th>Sales Order Created On</th-->
<!--th>Invoice From</th-->
<!--th>Invoice To</th-->
<th>Sales Order</th>
<th>Delivery Challan</th>
<th>Installation Certificate</th>
<th>Invoice</th>
<th>IRN</th>
<th>E-way Bill</th>
<th>E-Invoice</th>
</tr>
</thead>
<tbody>
<?php
                                      $st="";
									  if(isset($_GET['sotype']) && $_GET['sotype'] == 'qno')
									  {
										   $st="where qno!=''";
									  }
									  if(isset($_GET['sotype']) && $_GET['sotype']=='Service')
									  {
										   $st="where sotype='Service'";
									  }
									  if(isset($_GET['sotype']) && $_GET['sotype']=='Regular')
									  {
										   $st="where sotype='Regular'";
									  }
$sqlselect = "SELECT consgst, conigst, concgst, grandtotal, contotal, consigneename, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, duedays, dcno, sono, pono, podate, dname, createdon, invoicenofrom, invoicenoto, exp, invoiceno, installedon, expinvoice, expdc, irn, ewbno, canceldocumentstatus, ewbstatus, ewaypdf, invoicetype, condepartment, DATE_ADD(podate, INTERVAL duedays DAY) AS next_due_date FROM jrctally ".$staqu." group by sono ORDER BY next_due_date ASC";
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
<td><?=$count?></td>
<td><?=$rowselect['consigneename']?> <?=$rowselect['conaddress1']?> <?=$rowselect['conaddress2']?> <?=$rowselect['conaddress3']?> <?=$rowselect['contaluk']?> <?=$rowselect['condistrict']?> <?=$rowselect['conpincode']?></td>
<td><?=$rowselect['condepartment']?></td>
<td><?=$rowselect['pono']?></td>
<!--td><?=date('d/m/Y',strtotime($rowselect['podate']))?></td-->
<?php
$currentDate = date('Y-m-d');
$nextDueDate = $rowselect['next_due_date'];
$remainingDueDays = (strtotime($nextDueDate) - strtotime($currentDate)) / (60 * 60 * 24);
?>
<td>(<?=date('d/m/Y',strtotime($rowselect['podate']))?>-<b><?= date('d/m/Y', strtotime($rowselect['next_due_date'])) ?></b>)<br><?php $remainingDueDaysCeiled = ceil($remainingDueDays);

if ($remainingDueDaysCeiled < 0) {
    echo '<span style="color: red;">Remaining due days: ' . $remainingDueDaysCeiled . '</span><br>';
	$ldamound=0;
$ldamound=$rowselect['contotal']/100*.25;
echo 'Invoice Amount - <b>'.  $rowselect['contotal'].'</b><br>';
echo 'Per day LD  - <b>'. $ldamound.'</b><br>';
echo 'Total LD Amount - <b>'. $ldamound * $remainingDueDaysCeiled.'</b>';
} else {
     echo 'Remaining due days: <b>' . $remainingDueDaysCeiled . '/'. $rowselect['duedays'].'</b>';
}
?></td>
<td><?=$rowselect['sono']?></td>
<!--td><?=date('d/m/Y h:i:s a',strtotime($rowselect['createdon']))?></td-->
<!--td><?=$rowselect['invoicenofrom']?></td-->
<!--td><?=$rowselect['invoicenoto']?></td-->
<td style="text-align: center;">
<?php
if($rowselect['exp']!='1')
{
?>
<a href="exporttallyxl.php?id=<?=$rowselect['dname']?>" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Export</a><br>
<?php
}
else
{?>
<a href="../padhivetram/TallyImport-<?=$rowselect['dname']?>.xlsx" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">Download</a>
<?php
}
?>
</td>
<td style="text-align: center;">
<?php
if($rowselect['dcno']=='')
{
?><a href="javascript:void(0);" data-toggle="modal" data-target="#serialmodal" style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white" onclick="openModal('<?=$rowselect['sono']?>')">Update Serial No</a><a href="salesorderdcadds.php?id=<?=$rowselect['sono']?>&dc=generate" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white" >Generate</a>
<br>
<td></td>
<?php
}
else
{
?>
<a style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white">Update Serial No</a><a style="background-color: #D7B0FF;" class="btn btn-sm shadow-sm text-white" >Generate</a>
<br>

<a href="salesorderdc.php?id=<?=$rowselect['sono']?>" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">View</a><br><a href="#" style="background-color: #AFAFAF;"  class="btn btn-sm shadow-sm text-white printLink" data-sono="<?php  $sono = $rowselect['sono']; echo $sono;  ?>">Print</a><br>
<?php
if($rowselect['expdc']!='1')
{
?>
<a href="exporttallydcxl.php?id=<?=$rowselect['dname']?>" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Export</a>
<br>
<?php
}
else
{?>
<a href="../padhivetram/DC-<?=$rowselect['dname']?>.xlsx" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">Download</a>
<?php
}?>
</td>
<td style="text-align: center;"> <?php if($rowselect['installedon']=='') { ?> <a href="javascript:void(0);" data-toggle="modal" data-target="#icmodal" style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white" onclick="icmodal('<?=$rowselect['sono']?>')">Update IC Date</a> <?php } else { echo  '<span class="text-success"><b>'.date('d/m/Y',strtotime($rowselect['installedon'])).'</b></span><br>'; } ?><a href="salesordericprint.php?id=<?=$rowselect['sono']?>&dc=generate" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">View</a><br>
<a href="#"  style="background-color: #AFAFAF;"  class="btn btn-sm shadow-sm text-white printLinkic" data-sono="<?php  $sono = $rowselect['sono']; echo $sono; ?>">Print</a>
</td>
<?php
}?>
<td style="text-align: center;">
<?php
if($rowselect['invoiceno']=='')
{
?>
<a href="salesorderiadds.php?id=<?=$rowselect['sono']?>&invoice=generate" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
<?php
}
else
{
	?>
	<a style="background-color: #D7B0FF;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
	<a href="salesorderinvoice.php?id=<?=$rowselect['sono']?>" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">View</a><br><a href="#" style="background-color: #AFAFAF;"  class="btn btn-sm shadow-sm text-white printLinkin" data-sono="<?php   $sono = $rowselect['sono']; echo $sono; ?>">Print</a><br>
	<?php
if($rowselect['expinvoice']!='1')
{
?>
	<a href="exporttallyixl.php?id=<?=$rowselect['dname']?>" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Export</a><br>
	<?php
}
else
{
	?>
<a href="../padhivetram/Invoice-<?=$rowselect['dname']?>.xlsx" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">Download</a>
<?php
}
?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#coveringModal"  onclick="openModal2('<?=$rowselect['sono']?>')" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">Covering Letter</a><br>
<?php
}
?>
</td>
<?php
if($rowselect['invoicetype']=='B2B')
{
	?>
<td>
<?php
if($rowselect['invoiceno']!='')
{
if($rowselect['irn']=='')
{
?><a href="generateirn.php?id=<?=$rowselect['sono']?>" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
<?php
}
else
{
?>
<a style="background-color: #D7B0FF;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
<?php

if($rowselect['canceldocumentstatus']=='')
	{
?>
<a href="#" style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white open-cancelIrnModal"  data-toggle="modal" data-target="#cancelIrnModal" data-sono="<?=$rowselect['sono']?>">Cancel</a>
<?php
	}
	else{
		?>
		<a style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white" >Cancel</a>
		<?php
}
}?></td>
	<td style="text-align: center;">
	<?php
	if($rowselect['ewbno']=='')
{
	?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#ewayModal"  onclick="openModal1('<?=$rowselect['sono']?>')" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
<?php
}
else
{
	?>
	<a style="background-color: #D7B0FF;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
	<?php

if($rowselect['ewbstatus']!='CANCELLED')
	{
?><a href="#" style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white open-canceleModal" data-toggle="modal" data-target="#canceleModal" data-sono="<?=$rowselect['sono']?>">Cancel</a><br><?php
	if($rowselect['ewaypdf']!='1')
	{
?>
<a href="ewaybillpdf.php?id=<?=$rowselect['sono']?>" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">view</a><br>
<?php
	}
	else
	{
	?>
	<a href="../padhivetram/irnpdf/<?=$rowselect['ewbno']?>.pdf" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">View </a>
<?php	
	}}
	else
	{
		?>
		<a  style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white">Cancel</a>
		<?php
}}?></td>
<td style="text-align: center;">
<?php
if($rowselect['canceldocumentstatus']!='IRN_CANCELLED')
	{
		if($rowselect['irn']!='')
{ 
?><a href="einvoiceprint.php?id=<?=$rowselect['sono']?>" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">View</a><br>
<a href="#" style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white printLinkein" data-sono="<?php $sono = $rowselect['sono']; echo $sono;  ?>">Print</a>
<?php
	}}
?></td>
<?php
}
else
{
	?>
	<td></td>
	<td></td>
	<?php
}
}
else
{
	if($rowselect['invoiceno']!='')
	{
	if($rowselect['conigst']!='' && $rowselect['grandtotal']>50000)
{
	?>
	<td></td>
	<td style="text-align: center;">
	<?php
	
	if($rowselect['ewbno']=='')
{
	
	?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#ewayModal"  onclick="openModal1('<?=$rowselect['sono']?>')" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
<?php
}
else
{
	?>
	<a style="background-color: #D7B0FF;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
	<?php

if($rowselect['ewbstatus']!='CANCELLED')
	{
?><a href="#" style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white open-canceleModal" data-toggle="modal" data-target="#canceleModal" data-sono="<?=$rowselect['sono']?>">Cancel</a><br><?php
	if($rowselect['ewaypdf']!='1')
	{
?>
<a href="ewaybillpdf.php?id=<?=$rowselect['sono']?>" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">view</a><br>
<?php
	}
	else
	{
	?>
	<a href="../padhivetram/irnpdf/<?=$rowselect['ewbno']?>.pdf" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">View </a>
<?php	
	}}
	else
	{
		?>
		<a  style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white">Cancel</a>
		<?php
}}?></td>
	<td></td>
	<?php
}
else if($rowselect['consgst']!='' && $rowselect['concgst']!='' &&  $rowselect['grandtotal']>100000)
	{
		
	?>
	<td></td>
	<td style="text-align: center;">
	<?php
	if($rowselect['ewbno']=='')
{
	?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#ewayModal"  onclick="openModal1('<?=$rowselect['sono']?>')" style="background-color: #9F5EB3;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
<?php
}
else
{
	?>
	<a style="background-color: #D7B0FF;" class="btn btn-sm shadow-sm text-white">Generate</a><br>
	<?php

if($rowselect['ewbstatus']!='CANCELLED')
	{
?><a href="#" style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white open-canceleModal" data-toggle="modal" data-target="#canceleModal" data-sono="<?=$rowselect['sono']?>">Cancel</a><br><?php
	if($rowselect['ewaypdf']!='1')
	{
?>
<a href="ewaybillpdf.php?id=<?=$rowselect['sono']?>" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">view</a><br>
<?php
	}
	else
	{
	?>
	<a href="../padhivetram/irnpdf/<?=$rowselect['ewbno']?>.pdf" style="background-color: #00B3BC;" class="btn btn-sm shadow-sm text-white">View </a>
<?php	
	}}
	else
	{
		?>
		<a  style="background-color: #AFAFAF;" class="btn btn-sm shadow-sm text-white">Cancel</a>
		<?php
}}?></td>
	<td></td>
	<?php
}
else
{
	?>
	<td></td>
	<td></td>
	<td></td>
	<?php
}
}
else
{
	?>
	<td></td>
	<td></td>
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

<div class="modal" id="cancelIrnModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel IRN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cancelIrnForm" action="cancelirn.php" method="POST">
                    <input type="hidden" name="sono" id="cancelIrnSono" value="">
                    <div class="form-group">
                        <label for="reason">Reason for cancellation:</label>
                        <select class="form-control" name="reason" id="reason" required>
                            <option value="">Select a reason</option>
                            <option value="1">Duplicate</option>
                            <option value="2">Data entry mistake</option>
                            <option value="3">Order Cancelled</option>
                            <option value="4">Others</option>
                            <!-- Add more reasons as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea class="form-control" name="remarks" id="remarks" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger" onclick="return checkconfirm1()">Confirm Cancel IRN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="canceleModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel E-Waybill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="canceleForm" action="cancelewaybill.php" method="POST">
                    <input type="hidden" name="sono" id="canceleSono" value="">
                    <div class="form-group">
                        <label for="reason">Reason for cancellation:</label>
                        <select class="form-control" name="ereason" id="ereason" required>
                            <option value="">Select a reason</option>
                            <option value="DUPLICATE">Duplicate</option>
                            <option value="DATA_ENTRY_MISTAKE">Data entry mistake</option>
                            <option value="ORDER_CANCELLED">Order Cancelled</option>
                            <option value="OTHERS">Others</option>
                            <!-- Add more reasons as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea class="form-control" name="eremarks" id="eremarks" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger" onclick="return checkconfirm()">Confirm Cancel E-Waybill</button>
                </form>
            </div>
        </div>
    </div>
</div>



</div>
<!--a href="exporttallyfullxl.php?id=all">Export All</a-->
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
  <div class="modal" id="serialmodal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Serial Number Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalContent">
		
                <!-- Content will be dynamically loaded here -->
            </div>
      </div>
     
    </div>
  </div>
  
   <div class="modal" id="icmodal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update IC Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="icContent">
		
     
            </div>
      </div>
     
    </div>
  </div>
  
<div class="modal" id="coveringModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Covering Letter Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
			<div class="modal-body" id="coveringContent">
		
     
            </div>
            </div> 
            </div> 
            </div> 

<div class="modal" id="ewayModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transport Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
			<div class="modal-body" id="emodalContent">
		
     
            </div>
            </div> 
            </div> 
            </div> 
 
<!-----serial  change modal---->
<div class="modal" id="serialchangemodal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Serials</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="#" method="post" id="serialform">
<div id="seriallist">
</div>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="serialtag-form-submit" name="serialsubmit" value="Submit" onclick="serialsubmit1()">
</div>
</form>
      </div>
     
    </div>
  </div>
</div>

<!-----serial change modal---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

</script>

<script>
    $(document).ready(function(){
        $('.open-cancelIrnModal').click(function(){
            var sono = $(this).data('sono');
            $('#cancelIrnSono').val(sono);
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.open-canceleModal').click(function(){
            var sono = $(this).data('sono');
            $('#canceleSono').val(sono);
        });
    });
</script>

<script>
function openModal1(sono) {
		
        // Send an AJAX request to your PHP script
        $.ajax({
            type: 'POST',
            url: 'transdetails.php',
            data: { sono: sono },
            success: function (response) {
                // Handle the response from the server
                $('#emodalContent').html(response);
               showAdditionalFields();
                // After the form submission, show the modal
                $('#ewayModal').modal('show');
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
	
function openModal2(sono) {
		
        // Send an AJAX request to your PHP script
        $.ajax({
            type: 'POST',
            url: 'covering.php',
            data: { sono: sono },
            success: function (response) {
                // Handle the response from the server
                $('#coveringContent').html(response);
               showAdditionalFields();
                // After the form submission, show the modal
                $('#coveringModal').modal('show');
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }

    function showAdditionalFields() {
        var selectedOption = document.getElementById("deliverymethod").value;
        var additionalFieldsDiv = document.getElementById("additionalFields");
        var vehicleNoInput = document.getElementById("vechileno");

        if (selectedOption === "1") { // If Road is selected
            additionalFieldsDiv.style.display = "block";
            vehicleNoInput.required = true;
        } else {
            additionalFieldsDiv.style.display = "none";
            vehicleNoInput.required = false;
        }
    }
</script>

<script>
    function openModal(sono) {
		
        // Send an AJAX request to your PHP script
        $.ajax({
            type: 'POST',
            url: 'serialnumbershowpage.php',
            data: { sono: sono },
            success: function (response) {
                // Handle the response from the server
                $('#modalContent').html(response);

                // After the form submission, show the modal
                $('#serialmodal').modal('show');
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
	function icmodal(sono) {
		
        // Send an AJAX request to your PHP script
        $.ajax({
            type: 'POST',
            url: 'icdateupdate.php',
            data: { sono: sono },
            success: function (response) {
                // Handle the response from the server
                $('#icContent').html(response);

                // After the form submission, show the modal
                $('#icmodal').modal('show');
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
</script>
<script>
function serialnumbers(id)
{
	var conqty=document.getElementById("conqty"+id).value;
	var rserialnumber=document.getElementById('conserialno'+id).value;
var rdepartment=document.getElementById('condepartmentname'+id).value; 
const rserialnumbers = rserialnumber.split(" | ");
const rdepartments = rdepartment.split(" | ");
	if(conqty!="")
	{
		var nos=parseFloat(conqty);
		if(nos>0)
		{
			var output="<input type='hidden' name='serialformid' id='serialformid'  value='"+id+"'>";
			for(var i=1; i<=nos; i++)
			{
				var svalue='';
				if(rserialnumbers[i-1])
				{
					svalue=rserialnumbers[i-1];
				}var dvalue='';
				if(rdepartments[i-1])
				{
					dvalue=rdepartments[i-1];
				}
				
				
				output+='<div class="row"><div class="col-lg-6"><div class="form-group"><label for="kserialnumber">'+i+')&nbsp;Serial Number</label><input type="text" class="form-control" id="kserialnumber'+i+'" name="kserialnumber[]" value="'+svalue+'"></div></div><div class="col-lg-6"><div class="form-group"><label for="kdepartment">Department</label><input type="text" class="form-control" id="kdepartment'+i+'" name="kdepartment[]" value="'+dvalue+'" ></div></div></div>';
			}
			document.getElementById("seriallist").innerHTML=output;
		}
		else
		{
			document.getElementById("seriallist").innerHTML="";
			
		}
	}
	else
	{
		document.getElementById("seriallist").innerHTML="";
	}
}

</script>
<script>
function serialsubmit1()
{
var id=document.getElementById('serialformid').value;
 var kserialnumbers=document.getElementsByName('kserialnumber[]');
var kdepartments=document.getElementsByName('kdepartment[]');
var rserialnumber='';
var rdepartment='';
for(var k=0;k<kserialnumbers.length;k++)
{
	if(kserialnumbers[k].value!='')
	{
		
		if(rserialnumber!='')
		{
			rserialnumber+=' | '+kserialnumbers[k].value;
		}
		else
		{
		rserialnumber=kserialnumbers[k].value;
		}
		
	}
	if(kdepartments[k].value!='')
	{
	
		if(rdepartment!='')
		{
	
			rdepartment+=' | '+kdepartments[k].value;
		}
		else
		{
			rdepartment=kdepartments[k].value;
		}
		
	}
}
document.getElementById('conserialno'+id).value=rserialnumber;
document.getElementById('condepartmentname'+id).value=rdepartment; 
//for submit toggle
    $('#serialchangemodal').modal('toggle'); //or  $('#IDModal').modal('hide');
}
</script>
<script>
function checkconfirm()
{
	 var a=confirm("Are you sure?");
	if(a==true)
	{
	 return true;
	}
	else
	{
	 $('#canceleModal').modal('hide');
	 return false;
	} 
}	
</script>
<script>
function checkconfirm1()
{
	 var a=confirm ("Are you sure?");
	if(a==true)
	{
	 return true;
	}
	else
	{
	 $('#cancelIrnModal').modal('hide');
	 return false;
	} 
}	
</script>
<script>
$(document).ready(function(){
    $('.printLink').click(function(){
        var sono = $(this).data('sono');
        $.ajax({
            url: 'salesorderdcprint.php?id=' + sono,
            success: function(response){
                var newWindow = window.open();
                newWindow.document.write(response);
                newWindow.document.close();
                newWindow.print();
            }
        });
        return false;
    });
});

</script>
<script>
$(document).ready(function(){
    $('.printLinkic').click(function(){
        var sono = $(this).data('sono');
        $.ajax({
            url: 'salesordericprint1.php?id=' + sono,
            success: function(response){
                var newWindow = window.open();
                newWindow.document.write(response);
                newWindow.document.close();
                newWindow.print();
            }
        });
        return false;
    });
});
</script>
<script>
$(document).ready(function(){
    $('.printLinkin').click(function(){
        var sono = $(this).data('sono');
        $.ajax({
            url: 'salesorderinvoiceprint.php?id=' + sono,
            success: function(response){
                var newWindow = window.open();
                newWindow.document.write(response);
                newWindow.document.close();
                newWindow.print();
            }
        });
        return false;
    });
});
</script>
<script>
$(document).ready(function(){
    $('.printLinkein').click(function(){
        var sono = $(this).data('sono');
        $.ajax({
            url: 'einvoiceprint1.php?id=' + sono,
            success: function(response){
                var newWindow = window.open();
                newWindow.document.write(response);
                newWindow.document.close();
                newWindow.print();
            }
        });
        return false;
    });
});
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>