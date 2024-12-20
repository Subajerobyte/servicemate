<?php 
include('lcheck.php'); 

if($settings=='0')
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Edit Spare Name Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
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

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>
        <?php  include('mastersnavbar.php');?>

        
        <div class="container-fluid">

          <!-- Page Heading -->
<!--<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Edit Spare Name Details</h1>
            <a href="spare.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Spare Name Details</a>
          </div>-->
		  
		  
		     <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" ><b>Edit Spare Name Details</b></h1>
  </div>
<div class="col-auto" style=" text-align: right;">
    <a href="spare.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Spare Name Details</a>
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
          <!--  <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Spare Name Details</h6>
            </div>-->
<div class="card-body">
<?php 
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
				  $sqlselect = "SELECT maincategory, subcategory, wattage, price, gstper, id,spareunit  From jrcspares where id='".$id."' order by maincategory asc, subcategory asc";
				  
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
<form action="spareedits.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
<div class="col-lg-6">
  <div class="form-group">
    <label for="maincategory">Category</label>
    <input type="text" class="form-control" id="maincategory" name="maincategory" placeholder="Category" value="<?=htmlspecialchars($rowselect['maincategory'])?>">
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="subcategory">Spare Name</label>
    <input type="text" class="form-control" id="subcategory" name="subcategory" placeholder="Spare Name" value="<?=htmlspecialchars($rowselect['subcategory'])?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="spareunit">Unit</label>
<select class="form-control fav_clr" id="spareunit" name="spareunit" >
<option value="">select</option>
<option value="km" <?=($rowselect['spareunit']=="km")?'selected':''?>>kilometer(km)</option>
<option value="mtr" <?=($rowselect['spareunit']=="mtr")?'selected':''?>>meter(mtr)</option>
<option value="cm" <?=($rowselect['spareunit']=="cm")?'selected':''?>>centimeter(cm)</option>
<option value="mm" <?=($rowselect['spareunit']=="mm")?'selected':''?>>millimeter(mm)</option>
<option value="kg" <?=($rowselect['spareunit']=="kg")?'selected':''?>>kilogram(kg)</option>
<option value="gram" <?=($rowselect['spareunit']=="gram")?'selected':''?>>gram(gram)</option>
<option value="mg" <?=($rowselect['spareunit']=="mg")?'selected':''?>>milligram(mg)</option>
<option value="kl" <?=($rowselect['spareunit']=="kl")?'selected':''?>>kiloliter(kl)</option>
<option value="ltr" <?=($rowselect['spareunit']=="ltr")?'selected':''?>>liter(ltr)</option>
<option value="ml" <?=($rowselect['spareunit']=="ml")?'selected':''?>>milliliter(ml)</option>
<option value="cl" <?=($rowselect['spareunit']=="cl")?'selected':''?>>centiliter(cl)</option>
<option value="pcs" <?=($rowselect['spareunit']=="pcs")?'selected':''?>>piece(pcs)</option>
<option value="nos" <?=($rowselect['spareunit']=="nos")?'selected':''?>>number(nos)</option>
<option value="doz" <?=($rowselect['spareunit']=="doz")?'selected':''?>>dozen(doz)</option>
<option value="bdl" <?=($rowselect['spareunit']=="bdl")?'selected':''?>>bundles(bdl)</option>
</select>
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="wattage">Wattage</label>
    <input type="text" class="form-control" id="wattage" name="wattage" placeholder="Wattage" value="<?=$rowselect['wattage']?>">
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" min="0" step="0.01" class="form-control" id="price" name="price" placeholder="Price" value="<?=$rowselect['price']?>">
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="gstper">GST Percentage</label>
    <input type="number" min="0" step="0.01" class="form-control" id="gstper" name="gstper" placeholder="GST Percentage" value="<?=$rowselect['gstper']?>">
  </div>
</div>

  </div>

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
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
       

       
      <?php  include('footer.php'); ?>
       

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
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
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
	 $( "#maincategory" ).autocomplete({
       source: 'sparesearch.php?type=maincategory',
     });
	 $( "#subcategory" ).autocomplete({
       source: 'sparesearch.php?type=subcategory',
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
<?php include('additionaljs.php');   ?>
</body>

</html>
