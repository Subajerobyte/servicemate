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
<title><?=$_SESSION['companyname']?> - Jerobyte - Opening Stock</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php include('productnavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Opening Stock</h1>
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
if((isset($error))&&($error!=''))
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<?=$error?>
</div>
</div>
</div>
<?php
}
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-body">
<form method="post" method="post" action="salesorderadds.php" enctype="multipart/form-data">
<div class="row">

<div class="col-xl-12">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label for="sodate">As on Date</label>
<input type="date" class="form-control" id="sodate" name="sodate" placeholder="SO Date" value="<?=date('Y-m-d')?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="godownname">Godown Name</label>
<select class="form-control" id="godownname" name="godownname" required>
					  <option value="" >Select</option>
					  <?php
					  

						$sql="select DISTINCT godownname from jrcgodown";
						$result=mysqli_query($connection,$sql);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{
								while($row=mysqli_fetch_array($result))
								{
									?>
									<option value="<?=$row['godownname']?>"><?=$row['godownname']?></option>
								<?php
								}
							}
						}
					  ?>	  
					</select>
</div>
</div>


</div>
</div>
</div>
<hr>
<div class="row">

<div class="col-lg-3">
<div class="markresponse">
</div>
</div>
</div>
<div class="table-responsive">
<table class="table table-bordered" id="table-data">
<tr>
<th>PRODUCT </th><th>QTY</th>
</tr>
<tr class="tr_clone">
<!--th><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="32"></th-->
<td>
<select class="form-control fav_clr stockitem1" id="stockitem" name="stockitem" >
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, stockitem, currentstock From jrcproduct order by stockitem asc ";
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
<option value="<?=$rowgo['id']?>"><?=$rowgo['stockitem']?></option>
<?php
}
}
?>
</select>
</td>
<td style="width:8%"><input type="number" name="currentstock" id="currentstock" class="form-control" min="0" style="text-align:right" value="<?=$rowgo['currentstock']?>" readonly>
 </td>
</tr>
</table>
</div>	



</form>
</div>
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
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
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
</script>
<script>
$(document).on("keypress", 'form', function (e) {
var code = e.keyCode || e.which;
if (code == 13) {
e.preventDefault();
return false;
}
});
</script>
<script>
$(document).ready(function(){
		$("#godownname").change(function(){
		 var godownname=$("#godownname").val();
		 if(godownname=="")
		 {
			 $("#stockitem").html('<option value="">Select</option>');
		 }
		 else
		 { 
	 //console.log(godownname);
			$.get("prosearch.php", {godownname: godownname} , function(data){
            $("#stockitem").html(data);
			});
		 }
		 
	});
	$("#stockitem").change(function(){
		 var stockitem=$("#stockitem").val();
		 if(stockitem=="")
		 {
			 //console.log(stockitem);
			 $("#currentstock").val('');
			 
		 }
		 else
		 {
			 //console.log(stockitem);
			$.get("prosearch.php", {stockitem: stockitem} , function(data){
				var dataarray=data.split("|");
				//console.log(dataarray);
				$("#id").val(dataarray[0].trim());
				$("#currentstock").val(dataarray[1]);
			});
		 }
	});
	
});
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>