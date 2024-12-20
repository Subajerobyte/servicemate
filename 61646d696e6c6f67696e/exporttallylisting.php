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
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php /* include('salesnavbar.php'); */?>
<div class="container-fluid">
<?php
$statitle="";
$staqu="";
if(isset($_GET['type']))
{
$type=mysqli_real_escape_string($connection, $_GET['type']);
//start inhouse dashboard
if($type=='dc')
{
$statitle="Delivery Challan";
}
if($type=='ic')
{
$statitle="Installation Certificate";
}
if($type=='inv')
{
$statitle="Invoice";
}
}
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800"><?=$statitle?></h1>
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
<?php
if(isset($_GET['type']))
{
$type=mysqli_real_escape_string($connection, $_GET['type']);
//start - from inhouse dashboard
if($type=='dc')
{
if($staqu!="")
{
$staqu.=" and (dcno='' or dcno IS  NULL) and (dcdate='' or dcdate IS  NULL) and (invoiceno='' or invoiceno IS NULL )";
}
else
{
$staqu.=" where (dcno='' or dcno IS  NULL)  and (dcdate='' or dcdate IS  NULL) and (invoiceno='' or invoiceno IS NULL )";
}
}
if($type=='ic')
{
if($staqu!="")
{
$staqu.=" and (dcno!='' or dcno IS NOT NULL) and (dcdate!='' or dcdate IS NOT NULL) and (installedon='' or installedon IS  NULL) and (invoiceno='' or invoiceno IS NULL )";
}
else
{
$staqu.=" where (dcno!='' or dcno IS NOT NULL) and (dcdate!='' or dcdate IS NOT NULL) and (installedon='' or installedon IS  NULL) and (invoiceno='' or invoiceno IS NULL )";
}
}if($type=='inv')
{
if($staqu!="")
{
$staqu.=" and (invoiceno='' or invoiceno IS  NULL) and (invoicedate1='' or invoicedate1 IS  NULL) ";
}
else
{
$staqu.=" where (invoiceno='' or invoiceno IS  NULL) and (invoicedate1='' or invoicedate1 IS  NULL) ";
}
}
}
else {
echo "dhfd";
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
<thead>
<tr>
<th>S.No</th>
<th>Createdon</th>
<th>PO No</th>
<th>PO Date</th>
<th>SO No</th>
<th>Invoice From</th>
<th>Invoice To</th>
<th>Sales Order Export</th>
<?php
if($type=='dc')
{
?>
<th>DC</th>
<?php
}
if($type=='ic')
{
?>
<th>IC</th>
<?php
}
if($type=='inv')
{
?>
<th>Invoice</th>
<?php
}
?>
</tr>
</thead>
<tbody>
<?php
$sqlselect = "SELECT dcno, sono, pono, podate, dname, createdon, invoicenofrom, invoicenoto, exp, invoiceno,installedon, expinvoice, expdc, irn, ewbno, canceldocumentstatus, ewbstatus, ewaypdf From jrctally   ".$staqu." group by sono order by id desc";
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
<td><?=date('d/m/Y h:i:s a',strtotime($rowselect['createdon']))?></td>
<td><?=$rowselect['pono']?></td>
<td><?=date('d/m/Y',strtotime($rowselect['podate']))?></td>
<td><?=$rowselect['sono']?></td>
<td><?=$rowselect['invoicenofrom']?></td>
<td><?=$rowselect['invoicenoto']?></td>
<td><a href="exporttallyxl.php?id=<?=$rowselect['dname']?>">Export</a><br><?php
if($rowselect['exp']=='1')
{
?>
<a href="../padhivetram/TallyImport-<?=$rowselect['dname']?>.xlsx" class="text-success">Download</a>
<?php
}?></td>
<?php
if($type=='dc')
{
if($rowselect['dcno']=='')
{
if($rowselect['invoiceno']=='')
{
?>
<td><a href="javascript:void(0);" data-toggle="modal" data-target="#serialmodal" class="btn btn-danger text-white blink btn-sm" onclick="openModal('<?=$rowselect['sono']?>')">Serials</a><br><a href="salesorderdcadds.php?id=<?=$rowselect['sono']?>&dc=generate">Generate DC</a></td>
<?php
}
else
{
?>
<td></td>
<?php
}
}
else
{
?>
<td><a href="salesorderdc.php?id=<?=$rowselect['sono']?>" class="text-success">View DC</a><br>
<a href="#" class="printLink" data-sono="<?php  $sono = $rowselect['sono']; echo $sono; ?>">Print</a>
<br><a href="exporttallydcxl.php?id=<?=$rowselect['dname']?>">Export</a><br><?php
if($rowselect['expdc']=='1')
{
?>
<a href="../padhivetram/DC-<?=$rowselect['dname']?>.xlsx" class="text-success">Download</a>
<?php
}?></td>
<?php
}
}
?>
<?php
if($type=='ic')
{
if($rowselect['dcno']!='')
{
if($rowselect['invoiceno']=='')
{
?>
<td> <?php if($rowselect['installedon']=='') { ?> <a href="javascript:void(0);" data-toggle="modal" data-target="#icmodal" class="btn btn-danger text-white blink btn-sm" onclick="icmodal('<?=$rowselect['sono']?>')">IC Date</a> <?php } else { echo  '<span class="text-success"><b>'.date('d/m/Y',strtotime($rowselect['installedon'])).'</b></span><br>'; } ?><br><a href="salesordericprint.php?id=<?=$rowselect['sono']?>&dc=generate" class="text-success">View IC</a><br>
<a href="#" class="printLinkic" data-sono="<?php  $sono = $rowselect['sono']; echo $sono; ?>">Print</a></td>
<?php }}}
?>
<?php
if($type=='inv'){
if($rowselect['invoiceno']=='')
{
?>
<td><a href="salesorderiadds.php?id=<?=$rowselect['sono']?>&invoice=generate">Generate Invoice</a></td>
<?php
}
else
{
?>
<td><a href="salesorderinvoice.php?id=<?=$rowselect['sono']?>" class="text-success">View Invoice</a>
<a href="#" class="printLinkin" data-sono="<?php  $sono = $rowselect['sono']; echo $sono; ?>">Print</a>
<br><a href="exporttallyixl.php?id=<?=$rowselect['dname']?>">Export</a><br><?php
if($rowselect['expinvoice']=='1')
{
?>
<a href="../padhivetram/Invoice-<?=$rowselect['dname']?>.xlsx" class="text-success">Download</a>
<?php
}?></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
var a=confirm("Are you sure?");
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
url: 'salesorderdc.php?id=' + sono,
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
url: 'salesordericprint.php?id=' + sono,
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
url: 'salesorderinvoice.php?id=' + sono,
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
url: 'einvoiceprint.php?id=' + sono,
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