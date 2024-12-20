<?php
include('lcheck.php');
if($settings=='0')
{
header("Location: dashboard.php");
}
if (isset($_GET['yesButton'])) {
	$currenttime=date('Y-m-d');
$sql = "UPDATE jrccompany SET notificationview = '1',last_notification_update='".$currenttime."' WHERE id ='".$_SESSION['companyid']."'";
if ($connection->query($sql) === TRUE) {
} else {
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Software Updates</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
.card {
margin-bottom: 1rem;
}
.list-view {
.row {
> [class*='col-'] {
max-width: 100%;
flex: 0 0 100%;
}
}
.card {
@media (max-width: 575.98px) {
flex-direction: column;
}
flex-direction: row;
> .card-img-top {
width: auto;
}
.card-body {
display: inline-block;
}
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
<?php include('swupdatesnavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->


  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Software Updates</b></h1>
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
<div class=" mb-3 mt-3">
<button class="btn btn-info btn-list">List View</button>
<button class="btn btn-primary btn-grid">Grid View</button>

</div>
<div class=" grid-container list-view">
<div class="row">
<?php
$sqlselect = "SELECT createdon,mainmenu,submenu,remarks,title,version From swupdates order by id desc";
$queryselect = mysqli_query($connection1, $sqlselect);
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
<div class="col-12 col-md-6 col-lg-4" >
<div class="card" style="background-color:<?=$_SESSION['lightbgcolor1']?>; text-color:<?=$_SESSION['textcolor']?>;">
<div class="card-body">
<p class="float-right"><?=date('d/m/Y h:i a',strtotime($rowselect['createdon']))?><br><span style=" font-size: 20px; font-style: italic;"><?=$rowselect['version']?>v</span></p>
<h6 class="card-title"><b><?=$rowselect['remarks']?></b></h6>
<p class="card-text">	<?=$rowselect['title']?> <?= ($rowselect['mainmenu'] != '') ? "&rarr; " . $rowselect['mainmenu'] : '' ?> <?= ($rowselect['submenu'] != '') ? "&rarr; " . $rowselect['submenu'] : '' ?></p>
</div>
</div>
</div>
<?php
$count++;
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
function showList(e) {
var $gridCont = $('.grid-container');
e.preventDefault();
$gridCont.hasClass('list-view') ? $gridCont.removeClass('list-view') : $gridCont.addClass('list-view');
}
function gridList(e) {
var $gridCont = $('.grid-container')
e.preventDefault();
$gridCont.removeClass('list-view');
}
$(document).on('click', '.btn-grid', gridList);
$(document).on('click', '.btn-list', showList);
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>