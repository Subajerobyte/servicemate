<?php
include('lcheck.php'); 

$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
$sqllayoutcall=mysqli_query($connection, "select * from jrclayoutcall");
$infolayoutcall=mysqli_fetch_array($sqllayoutcall);
$showSubmitButton = true;
if(isset($_POST['submit'])) {
	$createdon=date("Y-m-d H:i:s");
	$createdby=$_SESSION['email'];
	$invoicenovalue=mysqli_real_escape_string($connection, $_POST['invoiceno']);
	$invoicedatevalue=mysqli_real_escape_string($connection, $_POST['invoicedate']);
    $consigneenamevalue = mysqli_real_escape_string($connection, $_POST['consigneename']);
    $address1value = mysqli_real_escape_string($connection, $_POST['address1']);
    $mobilevalue = mysqli_real_escape_string($connection, $_POST['mobile']);
    $emailvalue = mysqli_real_escape_string($connection, $_POST['email']);
    $districtvalue = mysqli_real_escape_string($connection, $_POST['district']);
    //$productidvalue=mysqli_real_escape_string($connection, $_POST['productid']);
	if((isset($_POST['stockitem']))&&is_array($_POST['stockitem']))
{
for($i=0;$i<count($_POST['stockitem']);$i++)
{
$stockmaincategoryvalue=mysqli_real_escape_string($connection, $_POST['stockmaincategory'][$i]);
$stocksubcategoryvalue=mysqli_real_escape_string($connection, $_POST['stocksubcategory'][$i]);
$stockitemvalue=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
$makevalue=mysqli_real_escape_string($connection, $_POST['make'][$i]);
$capacityvalue=mysqli_real_escape_string($connection, $_POST['capacity'][$i]);
$qtyvalue=mysqli_real_escape_string($connection, $_POST['qty'][$i]);
$serialnumbervalue=mysqli_real_escape_string($connection, $_POST['serialnumber'][$i]);

}
}
    $sqlselect = "SELECT id FROM jrcxl WHERE tdelete='0' AND mobile = '{$mobilevalue}'";
    $queryselect = mysqli_query($connection, $sqlselect);
    if(!$queryselect){
        die("SQL query failed: " . mysqli_error($connection));
    }

    $rowCountselect = mysqli_num_rows($queryselect);
    if($rowCountselect == 0) {
      //  $sqlup = "INSERT INTO jrcconsignee (createdon, createdby,consigneename, address1, district, mobile, email) VALUES ('$createdon', '$createdby','$consigneenamevalue', '$address1value', '$districtvalue', '$mobilevalue', '$emailvalue')";

$sqlup = "INSERT INTO jrcconsignee (createdon, createdby, encstatus, maincategory, subcategory,consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, latlong, gsttype, statecode, gstno, ctype) VALUES ('$createdon', '$createdby','$encstatus','', '', '$consigneenamevalue', '','$address1value','', '' , '$districtvalue','','','', '$mobilevalue', '$emailvalue','','','','','')";

        $queryup = mysqli_query($connection, $sqlup);
        if(!$queryup){
            die("SQL query failed: " . mysqli_error($connection));
        } else {
            $consigneeid = mysqli_insert_id($connection);
			//$productid=mysqli_insert_id($connection);
            $sqlup = "INSERT INTO jrcxl (createdon, createdby,invoiceno,invoicedate,consigneeid, consigneename, address1, district, mobile, email,stockmaincategory, stocksubcategory, stockitem, make, capacity,qty, serialnumber) 
                      VALUES ('$createdon', '$createdby','$invoicenovalue','$invoicedatevalue','$consigneeid', '$consigneenamevalue', '$address1value', '$districtvalue', '$mobilevalue', '$emailvalue', '$stockmaincategoryvalue', '$stocksubcategoryvalue', '$stockitemvalue','$makevalue', '$capacityvalue','$qtyvalue', '$serialnumbervalue')";
            $queryup = mysqli_query($connection, $sqlup);
            if(!$queryup){
                die("SQL query failed: " . mysqli_error($connection));
            }else{
				echo $sqlselect1 = "SELECT id FROM jrcxl WHERE tdelete='0' AND consigneeid = '$consigneeid'";
    $queryselect1 = mysqli_query($connection, $sqlselect1);
    if(!$queryselect1){
        die("SQL query failed: " . mysqli_error($connection));
    }
	
if (strpos($invoicenovalue, $_SESSION['companyshortname'].' / NSI') === 0) {
 $querysr = mysqli_query($connection, "SELECT nsino From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		mysqli_query($connection,"update jrcsrno set nsino='".$infosr['nsino']."'+1");
}
    $rowselect =mysqli_fetch_array($queryselect1);
    /* header("Location: ".$_SERVER['PHP_SELF']."?id='".$rowselect['id']."' && remarks=Customer details saved successfully");
	
	
    exit(); */
	
	
	// Redirect to the page for booking complaint with the consignee ID
  
  header("Location: callsadd.php?id='".$rowselect['id']."'");
   exit();
			}
        }
    }
	
}

// Check if the form is submitted to book a complaint
/* if(isset($_POST['book'])) {
    // Retrieve the consignee ID based on the newly inserted customer details
	
    $consigneeid = $_GET['id'];
   
    // Redirect to the page for booking complaint with the consignee ID
   header("Location: callsadd.php?id='".$consigneeid."'");
   exit();
} */
if(isset($_GET['remarks']) || isset($_GET['error'])) {
    $showSubmitButton = false;
}
// The rest of your HTML and PHP code remains unchanged
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Call Details (New Customer)</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <style>
			.form-control
			{
				font-size: 0.9rem !important;
			}
			</style>
				<style>
		.ajax-upload-dragdrop, .ajax-file-upload-statusbar
		{
			width: 100% !important;
		}
		</style>
		<style>
h6 {
line-height: 0.6;
font-size: 0.8rem;

}
.font-13 {
    font-size: 0.7rem !important;
}
</style>
		<?php
$sqlexcel = "SELECT id, stockmaincategory, stocksubcategory, stockitem, typeofproduct, componenttype, componentname, make, model, capacity, qty, serialnumber  From jrcxl order by id desc";
		$queryexcel = mysqli_query($connection, $sqlexcel);
        $rowCountexcel = mysqli_num_rows($queryexcel);
         
        if(!$queryexcel){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountexcel > 0) 
		{
			while( $row = mysqli_fetch_assoc( $queryexcel)){
    $newexcel_array[] = $row; 
}}
	?>
</head>
<body id="page-top" onLoad="checkcarry(); checkdiagnosis(); checkengineer(); checkreport()">
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
          <?php 
		 if(isset($_GET['at']))
		  {
		  include('inhousenavbar.php');
		  }
		  else
		  {
			//include('callnavbar.php');  
		  } 
		  ?>
        <div class="container-fluid">
          <!-- Page Heading -->
		  <?php
		  if(isset($_GET['at']))
		  {
		  ?>
		  
		  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Add Complaint(New Customer)</b></h1>
  </div>
  <div class="col-auto">
    <a href="calls.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Complaint Details</a>
  </div>
</div>
		  
		  
		  <?php
		  }
		 
		  else
		  {
		  ?>
		  
		    <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Add New Call Details (New Customer)</b></h1>
  </div>
  <div class="col-auto">
    <a href="calls.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Complaint Details</a>
  </div>
</div>
		  
		  <?php
		  }
		  ?>
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
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Call Details</h6>
            </div>-->
<div class="card-body">
<form action="" method="post" name="call_frm" id = "call_frm" >
<input type="hidden" name="consigneeid" id="consigneeid">
<div class="row">




  <div class="col-lg-4">
  <div class="cardbox2">
  <div class="card-header2" style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2" onclick="toggleCustomerInput()" style="color:#fff;"><b>Customer Details</b></h6>
    </div>
    <div class="card-body2" id="customerBody" ><?php

 
if($infolayoutinvoice['invoiceno']=='1')
{
	
	 $querysr = mysqli_query($connection, "SELECT nsino From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		 $invoiceno=$_SESSION['companyshortname'].' / NSI / '.date('m').date('y').' / '. (str_pad(((float)$infosr['nsino']+1),5,"0",STR_PAD_LEFT));
		$invoicedate=date('Y-m-d');
	
	
	
	
	
	?>	
	<div class="form-group">
    <div class="input-container"> 
        <label for="invoiceno">Invoice No<?=($infolayoutinvoice['invoicenoreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
        <input type="text" name="invoiceno" id="invoiceno" class="form-control" value="<?php echo (isset($invoiceno))?$invoiceno:'';?>"  <?=($infolayoutinvoice['invoicenoreq']=='1')?'required':''?>>
        <p style="margin-top: 0;margin-bottom: 0;"><input type="checkbox" name="invoicetick" id="invoicetick" onclick="funtick()"> (Click here for known Invoice)</p>
    </div>
</div>
	
	
	
 
<?php
	}
	else
	{
		?>
		<input type="hidden" name="invoiceno" id="invoiceno" value="<?=time()?>">
		<?php
	}
?>
<?php

if($infolayoutinvoice['invoicedate']=='1')
{
?>					
  <div class="form-group">
    <div class="input-container">
	<label for="invoicedate">Invoice Date<?=($infolayoutinvoice['invoicedatereq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
	<input type="date" class="form-control" id="invoicedate" name="invoicedate" value="<?=date('Y-m-d')?>" <?=($infolayoutinvoice['invoicedatereq']=='1')?'required':''?>>
	</div>
	</div>
<?php
	}
	else
	{
		?>
		<input type="hidden" name="invoicedate" id="invoicedate" value="<?=date('Y-m-d')?>">
	<?php
	}
?>



	<?php
	if($infolayoutcustomers['consigneename']=='1')
{
?>
  <div class="form-group">
    <div class="input-container">
	  <label for="consigneename" >Customer Name<?=($infolayoutcustomers['consigneenamereq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
     <input type="text" class="form-control" id="consigneename" name="consigneename"  <?=($infolayoutcustomers['consigneenamereq']=='1')?'required':''?>>
	 </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="consigneename" id="consigneename" value="">
	<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
  <div class="form-group">
    <div class="input-container">
	  <label for="mobile" >Mobile No<?=($infolayoutcustomers['mobilereq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
      <input type="number" class="form-control" id="mobile" name="mobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?>>
    </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="mobile" id="mobile" value="">
	<?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
  <div class="form-group">
    <div class="input-container">
	  <label for="address1" >Address<?=($infolayoutcustomers['address1req']=='1')?'<span class="text-danger">*</span>':''?> :</label>
      <input type="text" class="form-control" id="address1" name="address1" <?=($infolayoutcustomers['address1req']=='1')?'required':''?>>
    </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="address1" id="address1" value="">
	<?php
}

if($infolayoutcustomers['district']=='1')
{
?>
  <div class="form-group">
    <div class="input-container">
	  <label for="district">District<?=($infolayoutcustomers['districtreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
      <input type="text" class="form-control" id="district" name="district" <?=($infolayoutcustomers['districtreq']=='1')?'required':''?>>
    </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="district" id="district" value="">
	<?php
}
if($infolayoutcustomers['email']=='1')
{
?> 
<div id="customerInputBox5" >
  <div class="form-group">
    <div class="input-container">
	  <label for="email">Email<?=($infolayoutcustomers['emailreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
      <input type="email" class="form-control" id="email" name="email" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?>>
    </div>
  </div>
</div>  
<?php
}
else
{
	?>
	<input type="hidden" name="email" id="email" value="">
	<?php
}
?>

</div>
</div>
</div>


<div class="col-lg-4">
  <div class="cardbox2">
  <div class="card-header2" style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2" onclick="toggleProductInput()" style="color:#fff;"><b>Product Details</b></h6>
    </div>
    <div class="card-body2" id="productBody" >
	
<?php 


if($infolayoutproducts['stockmaincategory']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{?>	
  <div class="form-group">
    <div class="input-container">
	  <label for="stockitem" >Main Category<?=($infolayoutproducts['stockmaincategoryreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
					  <select class="fav_clr form-control" name="stockmaincategory[]" id="stockmaincategory1" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['stockmaincategory']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		<div class="input-container">
	  <label for="stockmaincategory" >Main Category<?=($infolayoutproducts['stockmaincategoryreq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="stockmaincategory[]" id="stockmaincategory1"  class="form-control" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?>></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="stockmaincategory[]" id="stockmaincategory1" value="">
	<?php
}
?>
<?php

if($infolayoutproducts['stocksubcategory']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					
  <div class="form-group">
    <div class="input-container">
	  <label for="stocksubcategory" >Sub Category<?=($infolayoutproducts['stocksubcategoryreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>
					 <select class="fav_clr form-control" name="stocksubcategory[]" id="stocksubcategory1" <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['stocksubcategory']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		<div class="input-container">
	  <label for="stocksubcategory" >Sub Category<?=($infolayoutproducts['stocksubcategoryreq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="stocksubcategory[]" id="stocksubcategory1"  class="form-control"  <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?>></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="stocksubcategory[]" id="stocksubcategory1" value="">
	<?php
}
?>

<?php

if($infolayoutproducts['stockitem']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="stockitem" >Product Name<?=($infolayoutproducts['stockitemreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
<select class="fav_clr form-control" name="stockitem[]" id="stockitem1" <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['stockitem']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		?>    <div class="input-container">
	  <label for="stockitem" >Product Name<?=($infolayoutproducts['stockitemreq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="stockitem[]" id="stockitem1"  class="form-control"  <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="stockitem[]" id="stockitem1" value="">
	<?php
}
?>
<?php
if($infolayoutproducts['typeofproduct']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="typeofproduct" >Type of Product<?=($infolayoutproducts['typeofproductreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
 <select class="fav_clr form-control" name="typeofproduct[]" id="typeofproduct1" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['typeofproduct']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		?>    <div class="input-container">
	  <label for="typeofproduct" >Type of Product<?=($infolayoutproducts['typeofproductreq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="typeofproduct[]" id="typeofproduct1"  class="form-control" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?> ></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="typeofproduct[]" id="typeofproduct1" value="">
	<?php
}
?>

<?php

if($infolayoutproducts['componenttype']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="componenttype" >Component Type<?=($infolayoutproducts['componenttypereq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
  <select class="fav_clr form-control" name="componenttype[]" id="componenttype1" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['componenttype']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		?>    <div class="input-container">
	  <label for="componenttype" >Component Type<?=($infolayoutproducts['componenttypereq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="componenttype[]" id="componenttype1"  class="form-control" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?> ></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="componenttype[]" id="componenttype1" value="">
	<?php
}
?>
<?php 

if($infolayoutproducts['componentname']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="componentname" >Component Name<?=($infolayoutproducts['componentnamereq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
   <select class="fav_clr form-control" name="componentname[]" id="componentname1" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['componentname']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		?>    <div class="input-container">
	  <label for="componentname" >Component Name<?=($infolayoutproducts['componentnamereq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="componentname[]" id="componentname1"  class="form-control" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?> ></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="componentname[]" id="componentname1" value="">
	<?php
}
?>
<?php



if($infolayoutproducts['make']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="make" >Make<?=($infolayoutproducts['makereq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
   <select class="fav_clr form-control" name="make[]" id="make1" <?=($infolayoutproducts['makereq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['make']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		?>    <div class="input-container">
	  <label for="make" >Make<?=($infolayoutproducts['makereq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="make[]" id="make1"  class="form-control" <?=($infolayoutproducts['makereq']=='1')?'required':''?>></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="componentname[]" id="componentname1" value="">
	<?php
}?>
<?php

if($infolayoutproducts['capacity']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="capacity" >Capacity<?=($infolayoutproducts['capacityreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
   <select class="fav_clr form-control" name="capacity[]" id="capacity1" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['capacity']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
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
		?>    <div class="input-container">
	  <label for="capacity" >Capacity<?=($infolayoutproducts['capacityreq']=='1')?'<span class="text-danger">*</span>':''?> :</label><textarea rows="6" name="capacity[]" id="capacity1"  class="form-control" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>></textarea></div>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="capacity[]" id="capacity1" value="">
	<?php
}
?>
<?php

if($infolayoutinvoice['qty']=='1')
{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="qty" >Qty<?=($infolayoutinvoice['qtyreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
    <input type="number" name="qty[]" id="qty1"  class="form-control" <?=($infolayoutinvoice['qtyreq']=='1')?'required':''?>>
</div>
</div>
<?php
	}
	else
	{
		?>   
		<input type="hidden" name="qty[]" id="qty1" value="">
		<?php
	}
	?>

	<?php

if($infolayoutinvoice['serialnumber']=='1')
{
?>		
  <div class="form-group">
    <div class="input-container">
	  <label for="serialnumber" >Serial Number<?=($infolayoutinvoice['serialnumberreq']=='1')?'<span class="text-danger">*</span>':''?> :</label>			  
    <input type="text" name="serialnumber[]" id="serialnumber1"  class="form-control" <?=($infolayoutinvoice['serialnumberreq']=='1')?'required':''?> onchange="addserial(this.value, this.value)">
	</div>
</div>

<?php
	}
	else
	{
		?>   
		<input type="hidden" name="serialnumber[]" id="serialnumber1" value="">
	<?php
	}
///dfd




?>

</div>
</div>
</div>


  </div>
    
    <!--<input class="btn btn-primary" type="submit" name="submit" value="Submit">-->
	   <?php if($showSubmitButton) { ?> <input id="submitBtn" class="btn btn-primary" type="submit" name="submit" value="Book Complaint">
                <?php } ?>
                <!--<input class="btn btn-success" type="submit" name="book" value="Book Complaint">-->
              
			  
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
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=initMap&libraries=&v=weekly"
      async
    ></script>
	<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
	<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
	<script>
document.addEventListener('DOMContentLoaded', function() {
    const numericInputs = document.querySelectorAll('input[type="text"][inputmode="numeric"]');

    numericInputs.forEach(input => {
        input.addEventListener('input', function(event) {
            // Remove all non-numeric characters
            const cleanedValue = event.target.value.replace(/[^0-9]/g, '');
            event.target.value = cleanedValue;
        });
    });
});
</script>
	<script>
function addserial(id, text)
{
if ($('#serial').find("option[value='" + id + "']").length) {
    $('#serial').val(id).trigger('change');
} else { 
    // Create a DOM Option and pre-select by default
    var newOption = new Option(text, id, true, true);
    // Append it to the select
    $('#serial').append(newOption).trigger('change');
}
} 
	</script>
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
		<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
		<script>
  (function(window) {
    var $canvas,
        onResize = function(event) {
          $canvas.attr({
          });
        };
    $(document).ready(function() {
		//phasechange();
      $canvas = $('canvas');
      window.addEventListener('orientationchange', onResize, false);
      window.addEventListener('resize', onResize, false);
      onResize();
	  $('#clear').click(function() {
  $('#signpad').signaturePad().clearCanvas();
});
      $('#signpad').signaturePad({
        drawOnly: true,
        defaultAction: 'drawIt',
        validateFields: false,
        lineWidth: 0,
        output :'.output',
        sigNav: null,
        name: null,
        typed: null,
        clear: '#clear',
        typeIt: null,
        drawIt: null,
        typeItDesc: null,
        drawItDesc: null
      });
	  $("#btnSaveSign").click(function(e){
			html2canvas([document.getElementById('pad')], {
				onrendered: function (canvas) {
					var canvas_img_data = canvas.toDataURL('image/png');
					var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					//ajax call to save image inside folder
					$.ajax({
						url: 'save_sign.php',
						data: { img_data:img_data },
						type: 'post',
						success: function (response) {
							//console.log(response);
						    $("#diagnosissignatureimg").attr("src",response);
							$("#diagnosissignatureimg").show();
						   $("#diagnosissignature").val(response);
						   $("#diagnosissignname").focus();
						   forceDownload(response);
						}
					});
				}, 
				backgroundColor: null, 
			});
		});
    });
  }(this));
  </script>
    <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
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
	 $( "#maincategory" ).autocomplete({
       source: 'consigneesearch.php?type=maincategory', minLength: 3
     });
	 $( "#subcategory" ).autocomplete({
       source: 'consigneesearch.php?type=subcategory', minLength: 3
     });
	 $( "#consigneename" ).autocomplete({
       //source: 'consigneesearch.php?type=consigneename', minLength: 3
	   source: 'consearch.php', select: function (event, ui) { $("#consigneename").val(ui.item.value); $("#address1").val(ui.item.address1); $("#address2").val(ui.item.address2); $("#area").val(ui.item.area);$("#district").val(ui.item.district); $("#pincode").val(ui.item.pincode);$("#phone").val(ui.item.phone); $("#mobile").val(ui.item.mobile);$("#email").val(ui.item.email);$("#contact").val(ui.item.contact); $("#maincategory").val(ui.item.maincategory);$("#subcategory").val(ui.item.subcategory);$("#department").val(ui.item.department);}, minLength: 3 
     });
	 $( "#department" ).autocomplete({
       source: 'consigneesearch.php?type=department', minLength: 3
     });
	 $( "#stockmaincategory1" ).autocomplete({
       source: 'productsearch.php?type=stockmaincategory', minLength: 3
     });
	 $( "#stocksubcategory1" ).autocomplete({
       source: 'productsearch.php?type=stocksubcategory', minLength: 3
     });
	 $( "#stockitem1" ).autocomplete({
       source: 'productsearch.php?type=stockitem', minLength: 3
     });
     $( "#typeofproduct1" ).autocomplete({
       source: 'productsearch.php?type=typeofproduct', minLength: 3
     });
	 $( "#componenttype1" ).autocomplete({
       source: 'productsearch.php?type=componenttype', minLength: 3
     });
	 $( "#make1" ).autocomplete({
       source: 'productsearch.php?type=make', minLength: 3
     });
	 $( "#capacity1" ).autocomplete({
       source: 'productsearch.php?type=capacity', minLength: 3
     });
	 $( "#componentname1" ).autocomplete({
       source: 'productsearch.php?type=componentname', minLength: 3
     });
	 $( "#callhandlingname" ).autocomplete({
       source: 'callsearch.php', select: function (event, ui) { $("#callhandlingname").val(ui.item.value); $("#callhandlingid").val(ui.item.id);}
     });
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
  dropdownAutoWidth : true,
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
function funtick()
{
	var invoicetick = document.getElementById("invoicetick");
if (invoicetick.checked == false) {
    document.getElementById("invoiceno").value = "<?=$invoiceno?>";
} else {
    document.getElementById("invoiceno").value = "";
}
}
</script>

<script>
  $('textarea[name^="qty"]').keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
        a.push(i);

    if (!(a.indexOf(k)>=0))
        e.preventDefault();
});
$('textarea[name^="warranty"]').keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
        a.push(i);

    if (!(a.indexOf(k)>=0))
        e.preventDefault();
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
				console.log(data);
    if (data=="Service Call")
	{
            document.getElementById("calltypes").checked=true;
	}
	else
	{
		 document.getElementById("calltypeo").checked=true;
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


<script>
  function toggleCustomerInput() {
    var customerBody = document.getElementById('customerBody');
	 if (customerBody.style.display === 'none') {
      customerBody.style.display = 'block';
	} else {
      customerBody.style.display = 'none';
      }
  }
</script>
<script>
  function toggleProductInput() {
    var productBody = document.getElementById('productBody');
     if (productBody.style.display === 'none') {
      productBody.style.display = 'block';
      } else {
      productBody.style.display = 'none';
     }
  }
</script>

<script>
// JavaScript code to disable form elements and hide the submit button after submission
window.onload = function() {
  <?php if(!$showSubmitButton) { ?>
    // If the Submit button should not be shown, hide the submit button and disable all other form elements
    var submitBtn = document.getElementById("submitBtn");
    if (submitBtn) {
      submitBtn.style.display = "none";
    }
    var formElements = document.getElementById("call_frm").elements;
    for (var i = 0; i < formElements.length; i++) {
      if (formElements[i].type !== "submit") {
        formElements[i].disabled = true;
      }
    }
  <?php } ?>
};
</script>

<!--call nature model-->
<?php include('additionaljs.php');   ?>
</body>
</html>
