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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Sales Product</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Add New Sales Product</h1>
            <a href="saleproduct.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Sales Product Details</a>
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
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Sales Product</h6>
            </div>
<div class="card-body">
<form action="saleproductadds.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label for="protype">Product Type</label>
    <input type="text" class="form-control" id="protype" name="protype" required>
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="productname">Product Name</label>
    <input type="text" class="form-control" id="productname" name="productname" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="make">Make</label>
    <input type="text" class="form-control" id="make" name="make">
  </div>
</div>
<div class="col-lg-12">
  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description" name="description" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="price">Selling Price</label>
    <input type="number" min="0" step="0.01" class="form-control" id="price" name="price" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="minprice">Minimum Selling Price</label>
    <input type="number" min="0" step="0.01" class="form-control" id="minprice" name="minprice" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="warranty">Warranty</label>
    <input type="number" min="0" step="0.01" class="form-control" id="warranty" name="warranty" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="gst">GST %</label>
    <input type="number" min="0" step="0.01" class="form-control" id="gst" name="gst" required>
  </div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label for="amcvalue">AMC Value</label>
    <input type="number" min="0" step="0.01" class="form-control" id="amcvalue" name="amcvalue" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="amcvalue">Min. AMC Value</label>
    <input type="number" min="0" step="0.01" class="form-control" id="amcminvalue" name="amcminvalue" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="amcgst">AMC GST %</label>
    <input type="number" min="0" step="0.01" class="form-control" id="amcgst" name="amcgst" required>
  </div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label for="gst">GST %</label>
    <input type="number" min="0" step="0.01" class="form-control" id="gst" name="gst" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="scrapvalue">Scrap Value</label>
    <input type="number" min="0" step="0.01" class="form-control" id="scrapvalue" name="scrapvalue" required>
  </div>
</div>


</div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
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
	 $( "#productname" ).autocomplete({
       source: 'saleproductsearch.php?type=productname',
     });
	 $( "#description" ).autocomplete({
       source: 'saleproductsearch.php?type=description',
     });
  });
</script>
<script>
var password = document.getElementById("password");
password.addEventListener('keyup', function() {

  var pwd = password.value

  // Reset if password length is zero
  if (pwd.length === 0) {
    document.getElementById("progresslabel").innerHTML = "";
    document.getElementById("progress").value = "0";
    return;
  }

  // Check progress
  var prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
    .reduce((memo, test) => memo + test.test(pwd), 0);

  // Length must be at least 8 chars
  if(prog > 2 && pwd.length > 7){
    prog++;
  }

  // Display it
  var progress = "";
  var strength = "";
  switch (prog) {
    case 0:
    case 1:
    case 2:
      strength = "25%";
      progress = "25";
      break;
    case 3:
      strength = "50%";
      progress = "50";
      break;
    case 4:
      strength = "75%";
      progress = "75";
      break;
    case 5:
      strength = "100% - Password strength is good";
      progress = "100";
      break;
  }
  document.getElementById("progresslabel").innerHTML = strength;
  document.getElementById("progress").value = progress;

});
</script>
<script>
function checkvalidate()
{
	if(document.getElementById("progress").value!="100")
	{
		alert("Kindly give Strength Password");
		document.getElementById("password").focus();
		return false;
	}
}
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
