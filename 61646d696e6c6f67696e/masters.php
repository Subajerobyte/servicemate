<?php
include('lcheck.php');
if($uploaddata=='0')
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Product Details</title>

  
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
          <?php include('mastersnavbar.php');?>
        

        
        <div class="container-fluid">  
		
		
		
		<!--page heading-->
				 <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Masters</b></h1>
  </div>
 
</div>
		    <div class="card shadow mb-4">
			 <div class="card-body">
<div class="row">
<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    General
  </a>
  
  <a href="ctype.php"  class="list-group-item list-group-item-action" >Customer Type</a>
  <a href="formsettings.php"  class="list-group-item list-group-item-action" >Mandatory Field Settings</a>
  <?php
  if(($liveplan=='DIAMOND'))
  {
  ?>
  <a href="alertsettings.php"  class="list-group-item list-group-item-action">Alert Settings</a>
  <?php
  }
 else
  {
	  ?>	  
 
  <?php
  }
  ?>
  <?php
  if($branch=='1')
  {

	  ?>	  
  <a href="branches.php" class="list-group-item list-group-item-action">Branch Settings</a>
  <?php
  }
 else
  {
	  ?>	  
  <?php
  }
  ?>
  <a href="gstsettings.php" class="list-group-item list-group-item-action">GST Settings</a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
</div>
</div>
<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
 Account Settings
  </a>
  <?php
    if(($liveplan=='DIAMOND'))
{
	?>
  <a href="expense.php"  class="list-group-item list-group-item-action">Expense Category</a>
  <a href="gstpercentage.php" class="list-group-item list-group-item-action">GST Rates</a>
  <a href="regtype.php"  class="list-group-item list-group-item-action">GST Registration Type</a>
  <a href="places.php"  class="list-group-item list-group-item-action">State Code</a>
   <?php
}
else
{
	?>
	 <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Expense Category</b></a>
  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>GST Rates</b></a>
   <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>GST Registration Type</b></a>
  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>State Code</b></a>
  <?php
}
?>
</div>
</div>
<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
 Call Settings
  </a>
   <a href="actiontaken.php"  class="list-group-item list-group-item-action">Action Taken</a>
  <a href="callnature.php"  class="list-group-item list-group-item-action">Call Nature</a>
  <a href="problemobserved.php" class="list-group-item list-group-item-action" >Problem Observed</a>
  <a href="reportedproblem.php"  class="list-group-item list-group-item-action" >Reported problem</a>
  <a href="worktype.php"  class="list-group-item list-group-item-action">Work Type</a>
 
  
</div>
</div>

<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Quotation Settings
  </a>
  <?php
   if(($liveplan=='DIAMOND'))
{
	?>
  <a href="quotationsettings.php"  class="list-group-item list-group-item-action">General Settings</a>
  <a href="quotationtype.php"  class="list-group-item list-group-item-action" >Quotation Type</a>
  <a href="quotationatype.php"  class="list-group-item list-group-item-action" > AMC Quotation Type</a>
       
  <?php
  
	if($settings=='1')
{
  ?>
  <a href="subcompany.php"  class="list-group-item list-group-item-action">Sub Companies</a>
  
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  
  <?php
}
}
else
{
	?>
	  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>General Settings</b></span></a>
  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Quotation Type</b></span></a>
  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>AMC Quotation Type</b></span></a>
    <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Sub Companies</b></span></a>
	<?php

}
?>
</div>
</div>

</div>
<br>
<div class="row">
<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Sales
  </a>
  <?php
    if(($liveplan=='DIAMOND'))
  {
  ?>
  <a href="custcategory.php"  class="list-group-item list-group-item-action" >Customer Main Category</a>
  <a href="assest.php"  class="list-group-item list-group-item-action">Other Reference</a>
   <a href="tender.php" class="list-group-item list-group-item-action">Tender Type</a>
   <a href="tenderno.php" class="list-group-item list-group-item-action">Tender Number</a>
    <?php
  }
  else
  {
	  ?>
	  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Customer Main Category</b></span></a>
	  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Other Reference</b></span></a>
	  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Tender Type</b></span></a>
	  <a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Tender Number</b></span></a>
	  
   <?php
  }

?>  
</div>
</div>

<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Products
  </a>
  <?php
    if(($liveplan=='DIAMOND'))
  {
  ?>
  <a href="material.php" class="list-group-item list-group-item-action">Additional Materials</a>
  <a href="godowns.php"  class="list-group-item list-group-item-action" >Warehouses</a>
  <a href="supply.php"  class="list-group-item list-group-item-action">Suppliers</a>
   <a href="spare.php"  class="list-group-item list-group-item-action" >Spares</a>
     <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
   <?php
  }
  else
  {
	  ?>
	  <a href="material.php" class="list-group-item list-group-item-action">Additional Materials</a>
 	<a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Warehouses</b></a> 
		<a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Suppliers</b></a> 
   <a href="spare.php"  class="list-group-item list-group-item-action" >Spares</a>
   <?php
  }
   ?>
</div>
</div>
<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Installation
  </a>
  <?php
    if(($liveplan=='DIAMOND') )
{
	?>
  <a href="rentalagreeedit.php" class="list-group-item list-group-item-action">Rental Agreement</a> 
  <!--<a href="salesinstall.php" class="list-group-item list-group-item-action">Sales Installation Certificate</a> -->
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <?php
}
else
{
	?>
	<a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Rental Agreement</b></a> 
	<?php
}
?>
   
</div>
</div>
<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Others
  </a>
  <a href="district.php" class="list-group-item list-group-item-action" >Districts</a>
   <a href="holiday.php"  class="list-group-item list-group-item-action" >Holidays</a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  
   
</div>
</div>	
</div>
<br>
<div class="row">
<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
   Site Settings
  </a>
  <?php
if(($liveplan=='DIAMOND'))
{
?>
  <a href="sidebarorder.php" class="list-group-item list-group-item-action" >Sidebar</a>
  <a href="themecolor.php" class="list-group-item list-group-item-action" >Theme</a>
   <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <?php
}
else
{
	?>
	<a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Sidebar</b></a> 
	<a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Theme</b></a> 
	<?php
}
?>
   
</div>
</div> 
<div class="col-lg-3">	
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
   Service Report
  </a>
  <a href="acknowledgementsettings.php"  class="list-group-item list-group-item-action">Acknowledgement Receipt Settings</a>
  <a href="termconditionservice.php" class="list-group-item list-group-item-action" >Terms and Conditions</a>
   <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  <a href="#" class="list-group-item list-group-item-action" style="display:none"></a>
  
   
</div>
</div>

<div class="col-lg-3">		
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Products Master
  </a>
  <?php
    if(($liveplan=='DIAMOND'))
  {
  ?>
  <a href="productaddnew.php" class="list-group-item list-group-item-action">Add New Product</a>
  <a href="product.php"  class="list-group-item list-group-item-action" >Product Details</a>
  <a href="productmerge.php"  class="list-group-item list-group-item-action">Merge Product</a>
   <a href="warrantycycle.php"  class="list-group-item list-group-item-action" >Warranty Cycle Missing Products</a>
     <a href="productlifetime.php" class="list-group-item list-group-item-action">Lifetime Missing Products</a>
     <a href="saleproduct.php" class="list-group-item list-group-item-action" >Price Details</a>
   <?php
  }
  /* else
  {
	  ?>
	  <a href="material.php" class="list-group-item list-group-item-action">Additional Materials</a>
 	<a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Warehouses</b></a> 
		<a class="list-group-item list-group-item-action" onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"><b>Suppliers</b></a> 
   <a href="spare.php"  class="list-group-item list-group-item-action" >Spares</a>
   <?php
  } */
   ?>
</div>
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
</body>

</html>
