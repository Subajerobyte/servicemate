<?php 
include('lcheck.php');

if($sellprice=='0')
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

<title><?=$_SESSION['companyname']?> - Jerobyte - Edit Product Details</title>


<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
.img-placeholder {
width: 100px;
color: white;
height: 100px;
background: black;
opacity: .7;
height: 125px;
border-radius: 5%;
z-index: 2;
position: absolute;
left: 50%;
transform: translateX(-50%);
display: none;
}
.img-placeholder h4 {
margin-top: 40%;
color: white;
}
.img-div:hover .img-placeholder {
display: block;
cursor: pointer;
}
</style>
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
<div class="d-sm-flex align-items-center justify-content-between mb-2">
<h1 class="h4 mb-0 text-gray-800">Edit Product Details</h1>
<a href="saleproduct.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Product Details</a>
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
<!-- <div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Edit Sales Product Details</h6>
</div>-->
<div class="card-body">
<?php
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT stockitem,stockmaincategory,stocksubcategory, componenttype,typeofproduct,componentname, make, description, price, minprice, warranty, warrantycycle, gst, amcvalue, amcminvalue, amcgst, camcvalue, camcminvalue, camcgst, rentalvalue, rentalminvalue, rentalgst, installvalue, scrapvalue,capacity,model,productlifetime,gsttype, hsntype From jrcproduct where id='".$id."' order by stockitem asc";

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
$sqlcon = "SELECT id, price, changedon, minprice, gst, scrapvalue From jrcsaleprohistory WHERE productid = '{$id}' order by id asc";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);

if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
$sdate=array();
$samount=array();
$mamount=array();

if($rowCountcon>0)
{
while($infos=mysqli_fetch_array($querycon))
{
$sdate[]=date('d M',strtotime($infos['changedon']));
$samount[]=number_format((float)$infos['price'],2,".","");
$mamount[]=number_format((float)$infos['minprice'],2,".","");
}

}


?>
<div class="row">
<div class="col-lg-5">
<canvas id="myChart" style="width:100%;max-width:100%; height:100%"></canvas>
</div>
<div class="col-lg-7">

<form action="saleproductedits.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">

<div class="row">
<?php
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="stockmaincategory">Main Category</label>
<input type="text" class="form-control" id="stockmaincategory" name="stockmaincategory" value="<?=$rowselect['stockmaincategory']?>" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stockmaincategory" id="stockmaincategory" value="<?=$rowselect['stockmaincategory']?>">
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="stocksubcategory">Sub Category</label>
<input type="text" class="form-control" id="stocksubcategory" name="stocksubcategory" value="<?=$rowselect['stocksubcategory']?>" <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stocksubcategory" id="stocksubcategory" value="<?=$rowselect['stocksubcategory']?>">
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<div class="col-lg-12">
<div class="form-group">
<label for="stockitem">Product Name</label>
<input type="text" class="form-control" id="stockitem" name="stockitem" value="<?=$rowselect['stockitem']?>" <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stockitem" id="stockitem" value="<?=$rowselect['stockitem']?>">
<?php
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="typeofproduct">Type of Product</label>
<input type="text" class="form-control" id="typeofproduct" name="typeofproduct" value="<?=$rowselect['typeofproduct']?>" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="typeofproduct" id="typeofproduct" value="<?=$rowselect['typeofproduct']?>">
<?php
}
if($infolayoutproducts['componenttype']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="componenttype">Component Type</label>
<input type="text" class="form-control" id="componenttype" name="componenttype" value="<?=$rowselect['componenttype']?>" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="componenttype" id="componenttype" value="<?=$rowselect['componenttype']?>">
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="componentname">Component Name</label>
<input type="text" class="form-control" id="componentname" name="componentname" value="<?=$rowselect['componentname']?>" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="componentname" id="componentname" value="<?=$rowselect['componentname']?>" >
<?php
}
if($infolayoutproducts['make']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="make">Make</label>
<input type="text" class="form-control" id="make" name="make" value="<?=$rowselect['make']?>" <?=($infolayoutproducts['makereq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="make" id="make" value="<?=$rowselect['make']?>">
<?php
}
if($infolayoutproducts['capacity']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="capacity">Capacity</label>
<input type="text" class="form-control" id="capacity" name="capacity" value="<?=$rowselect['capacity']?>" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="capacity" id="capacity" value="<?=$rowselect['capacity']?>">
<?php
}
if($infolayoutproducts['model']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="model">Model</label>
<input type="text" class="form-control" id="model" name="model" value="<?=$rowselect['model']?>" <?=($infolayoutproducts['modelreq']=='1')?'required':''?> readonly>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="model" id="model" value="<?=$rowselect['model']?>">
<?php
}

if($infolayoutproducts['description']=='1')
{
?>
<div class="col-lg-12">
<div class="form-group">
<label for="description">Description</label>
<textarea class="form-control" id="description" name="description"  rows="3" <?=($infolayoutproducts['descriptionreq']=='1')?'required':''?>><?=$rowselect['description']?></textarea>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="description" id="description" value="<?=$rowselect['description']?>">
<?php
}
if($infolayoutproducts['hsntype']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">HSN Type</label>
<select class="fav_clr form-control" id="hsntype" name="hsntype" <?=($infolayoutproducts['hsntypereq']=='1')?'required':''?>>
<option value="">Select</option>
<option value="N" <?=($rowselect['hsntype']=="N")?"selected":""?>>Product</option>
<option value="Y" <?=($rowselect['hsntype']=="Y")?"selected":""?>>Service</option>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="hsntype" id="hsntype" value="<?=$rowselect['hsntype']?>">
<?php
}
?>
<div class="col-lg-6">
  <div class="form-group">
    <label for="categoryname">Category Name</label>
	<select class="fav_clr form-control" name="categoryname" id="categoryname">
	<option value="">Select</option>
	<?php
	$sqlserial = "SELECT id, categoryname From jrcexpense order by id asc";
        $queryserial = mysqli_query($connection, $sqlserial);
        $rowCountserial = mysqli_num_rows($queryserial);
        if(!$queryserial){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountserial > 0) 
		{
			$count=1;
			while($rowcategory = mysqli_fetch_array($queryserial)) 
			{
				?>
				<option value="<?=$rowcategory['id']?>" <?=(($rowcategory['id']==$rowselect['categoryname'])?"selected":"")?>><?=$rowcategory['categoryname']?></option>
				<?php
			}
		}
	?>
	</select>
  </div>
</div>

<div class="col-lg-6">
<div class="form-group">
<label for="price">GST Type</label>
<br>
<label><input type="radio" id="gsttype" name="gsttype" value="1" <?=($rowselect['gsttype']=='1')?'checked':''?>> Inclusive GST &nbsp;
</label>
<label><input type="radio" id="gsttype" name="gsttype" value="0" <?=($rowselect['gsttype']=='0')?'checked':''?>> Exclusive GST
</label>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="price">Selling Price</label>
<input type="number" min="0" step="0.01" class="form-control" id="price" name="price" value="<?=$rowselect['price']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="minprice">Min. Selling Price</label>
<input type="number" min="0" step="0.01" class="form-control" id="minprice" name="minprice"  value="<?=$rowselect['minprice']?>">
</div>
</div>

<div class="col-lg-3">
<div class="form-group">
<label for="warranty">Warranty</label>
<input type="number" min="0" step="0.01" class="form-control" id="warranty" name="warranty"  value="<?=$rowselect['warranty']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="warrantycycle">Warranty Maintance Cycle ( Month )</label>
<input type="number" min="0" max="12" class="form-control" id="warrantycycle" name="warrantycycle"  value="<?=$rowselect['warrantycycle']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="productlifetime">Product Life Time ( Year )</label>
<input type="number" min="0" max="12" class="form-control" id="productlifetime" name="productlifetime"  value="<?=$rowselect['productlifetime']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="gst">GST %</label>
<input type="number" min="0" step="0.01" class="form-control" id="gst" name="gst"  value="<?=$rowselect['gst']?>">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="amcvalue">AMC Value</label>
<input type="number" min="0" step="0.01" class="form-control" id="amcvalue" name="amcvalue" value="<?=$rowselect['amcvalue']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="amcvalue">Min. AMC Value</label>
<input type="number" min="0" step="0.01" class="form-control" id="amcminvalue" name="amcminvalue" value="<?=$rowselect['amcminvalue']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="amcgst">AMC GST %</label>
<input type="number" min="0" step="0.01" class="form-control" id="amcgst" name="amcgst" value="<?=$rowselect['amcgst']?>">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="camcvalue">CAMC Value</label>
<input type="number" min="0" step="0.01" class="form-control" id="camcvalue" name="camcvalue" value="<?=$rowselect['camcvalue']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="amcvalue">Min. CAMC Value</label>
<input type="number" min="0" step="0.01" class="form-control" id="camcminvalue" name="camcminvalue" value="<?=$rowselect['camcminvalue']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="camcgst">CAMC GST %</label>
<input type="number" min="0" step="0.01" class="form-control" id="camcgst" name="camcgst" value="<?=$rowselect['camcgst']?>">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="rentalvalue">Rental Value</label>
<input type="number" min="0" step="0.01" class="form-control" id="rentalvalue" name="rentalvalue" value="<?=$rowselect['rentalvalue']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="rentalvalue">Min. Rental Value</label>
<input type="number" min="0" step="0.01" class="form-control" id="rentalminvalue" name="rentalminvalue" value="<?=$rowselect['rentalminvalue']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="rentalgst">Rental GST %</label>
<input type="number" min="0" step="0.01" class="form-control" id="rentalgst" name="rentalgst"  value="<?=$rowselect['rentalgst']?>">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="installvalue">Installation Charges</label>
<input type="number" min="0" step="0.01" class="form-control" id="installvalue" name="installvalue"  value="<?=$rowselect['installvalue']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="scrapvalue">Scrap Value</label>
<input type="number" min="0" step="0.01" class="form-control" id="scrapvalue" name="scrapvalue"  value="<?=$rowselect['scrapvalue']?>">
</div>
</div>


</div>


<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
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
$( "#protype" ).autocomplete({
source: 'saleproductsearch.php?type=protype',
});
$( "#stockitem" ).autocomplete({
source: 'saleproductsearch.php?type=stockitem',
});
$( "#description" ).autocomplete({
source: 'saleproductsearch.php?type=description',
});
});
</script>
<script>
var options = {
type: 'line',
data: {
labels: [<?php foreach ($sdate as $sd){ echo "'".$sd."',";}?>],
datasets: [
{
label: 'Minimum Selling Price',
data: [<?php foreach ($mamount as $sa){ echo $sa.',';}?>],
backgroundColor: "#FF6C95",
borderWidth: 1
},

{
label: 'Selling Price',
data: [<?php foreach ($samount as $sa){ echo $sa.',';}?>],
backgroundColor: "#04DCCB",
borderWidth: 1,
}

]
},
options: {
scales: {
yAxes: [{
ticks: {
reverse: false,
beginAtZero: true
}
}]
},

}
}

var ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, options);
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
