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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Unique Customer Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
<style>
#overlay{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  background:rgba(0,0,0,0.1);
  transition: 1s 0.4s;
}
#progress{
  height:1px;
  background:#fff;
  position:absolute;
  width:0;
  top:50%;
}
#progstat{
  font-size:1.7em;
  letter-spacing: 3px;
  position:absolute;
  top:50%;
  margin-top:-40px;
  width:100%;
  text-align:center;
  color:#ff0000;
}
</style>
</head>

<body id="page-top">
 <div id="overlay">
    <div id="progstat">Loading...</div>
    <div id="progress"></div>
  </div>
  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('datanavbar.php');?>
          <?php // include('consigneenavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Unique Customer Details</b></h1>
  </div>
  <div class="col-auto">
    <a href="consigneeadd.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Customer</a>
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
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Unique Customer Details</h6>
            </div>-->
            <div class="card-body">
			<form action="" method="get">
<div class="row">
<div class="col-lg-6">
  <div class="form-group">
    <label for="maincategory">Search Word </label>
	<input type="text" class="form-control" name="searchtext" id="searchtext" value="<?=(isset($_GET['searchtext']))?$_GET['searchtext']:''?>" minlength="3">
  </div>
</div>
</div>
 <div class="row">
<div class="col-lg-2">
  <label><b>Type of Results</b></label>
  </div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="invoiceno" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="invoiceno"))?'checked':''?>> Invoice No.</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="invoicedate" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="invoicedate"))?'checked':''?>> Invoice Date</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="tenderno" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="tenderno"))?'checked':''?>> Tender No.</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="pono" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="pono"))?'checked':''?>> Purchase Order No.</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="podate" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="podate"))?'checked':''?>> PO Date</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="dcno" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="dcno"))?'checked':''?>> DC No.</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="dcdate" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="dcdate"))?'checked':''?>> DC Date</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="installedon" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="installedon"))?'checked':''?>> Installed On</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="installedby" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="installedby"))?'checked':''?>> Installed By</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="maincategory" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="maincategory"))?'checked':''?>> Main Category</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="subcategory" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="subcategory"))?'checked':''?>> Sub Category</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="consigneename" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="consigneename"))?'checked':''?>> Customer Name</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="department" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="department"))?'checked':''?>> Department</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="address1" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="address1"))?'checked':''?>> Address 1</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="address2" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="address2"))?'checked':''?>> Address 2</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="area" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="area"))?'checked':''?>> Area</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="district" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="district"))?'checked':''?>> District</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="pincode" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="pincode"))?'checked':''?>> Pin Code</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="contact" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="contact"))?'checked':''?>> Contact</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="phone" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="phone"))?'checked':''?>> Phone</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="mobile" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="mobile"))?'checked':''?>> Mobile</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="email" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="email"))?'checked':''?>> Email</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="stockmaincategory" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="stockmaincategory"))?'checked':''?>> Main Category</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="stocksubcategory" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="stocksubcategory"))?'checked':''?>> Sub Category</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="stockitem" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="stockitem"))?'checked':''?>> Product Name</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="invoicedqty" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="invoicedqty"))?'checked':''?>> Invoiced Qty</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="overallwarranty" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="overallwarranty"))?'checked':''?>> Overall Warranty</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="typeofproduct" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="typeofproduct"))?'checked':''?>> Type of Product</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="componenttype" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="componenttype"))?'checked':''?>> Component Type</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="componentname" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="componentname"))?'checked':''?>> Component Name</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="make" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="make"))?'checked':''?>> Make</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="capacity" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="capacity"))?'checked':''?>> Capacity</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="warranty" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="warranty"))?'checked':''?>> Warranty</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="qty" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="qty"))?'checked':''?>> Qty</label></div>
<div class="col-lg-2"><label><input type="radio" name="searchby" required id="searchby" value="serialnumber" <?=((isset($_GET['searchby']))&&($_GET['searchby']=="serialnumber"))?'checked':''?>> Serial Numbers</label></div>


  </div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>
</div>
			<?php
if(isset($_GET['submit']))
{
	
$staqu="";
			
			$searchtext=mysqli_real_escape_string($connection,$_GET['searchtext']);
			$searchby=mysqli_real_escape_string($connection,$_GET['searchby']);
			
?>	
<div class="card shadow mb-4">
            <div class="card-body">
<form action="consigneeuniques.php" method="post" onsubmit="return checkvalidate()">
<input type="hidden" name="searchfield" id="searchfield" value="<?=$_GET['searchby']?>">
<input type="hidden" name="qs" id="qs" value="<?=$_SERVER['QUERY_STRING']?>">
              <div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Existing Values</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $sqlselect = "SELECT * From jrcxl where LOWER($searchby) like LOWER('%".$searchtext."%') group by $searchby order by $searchby asc";
				  
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
                      <td><?=$count?> <input type="checkbox" name="finds[]" value="<?=$rowselect[$searchby]?>"></td>
                      <td><?=$rowselect[$searchby]?></td>
                    </tr>
					<?php
					$count++;
			}
			?>
			<tr>
			<td colspan="8">
  <div class="form-group">
    <label for="mobile">New Word </label>
	<input type="text" class="form-control" name="changetext" id="changetext" value="<?=(isset($_GET['searchtext']))?$_GET['searchtext']:''?>" minlength="3">
  </div>
			</td>
			</tr>
			<tr>
			<td colspan="8" style="text-align:center"><input type="submit" name="submit" class="btn btn-success" value="Submit"></td>
			</tr>
			<?php
		}
			?>
					
                  </tbody>
                </table>
              </div>
			  </form>
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
    $(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
minimumInputLength: 2,
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
;(function(){
  function id(v){return document.getElementById(v); }
  function loadbar() {
    var ovrl = id("overlay"),
        prog = id("progress"),
        stat = id("progstat"),
        img = document.images,
        c = 0;
        tot = img.length;

    function imgLoaded(){
      c += 1;
      var perc = ((100/tot*c) << 0) +"%";
      prog.style.width = perc;
      stat.innerHTML = "Loading "+ perc;
      if(c===tot) return doneLoading();
    }
    function doneLoading(){
      ovrl.style.opacity = 0;
      setTimeout(function(){ 
        ovrl.style.display = "none";
      }, 1200);
    }
    for(var i=0; i<tot; i++) {
      var tImg     = new Image();
      tImg.onload  = imgLoaded;
      tImg.onerror = imgLoaded;
      tImg.src     = img[i].src;
    }    
  }
  document.addEventListener('DOMContentLoaded', loadbar, false);
}());
</script>
<script>
function checkvalidate()
{
	var ids=document.getElementsByName("finds[]");
	var j=0;
	for(var i=0;i<ids.length;i++)
	{
		if(ids[i].checked==true)
		{
			j++;
		}
	}
	if(j==0)
	{
		alert("Please Select any Customer to Merge");
		return false;
	}
	else
	{
		return confirm("Are you sure want to change this consignee?");
	}
}
</script>
<?php include('additionaljs.php');   ?>
</body>










</html>