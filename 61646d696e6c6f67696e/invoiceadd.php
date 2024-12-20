<?php
include('lcheck.php'); 

$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
if($addinvoice=='0')
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add Invoice Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"><link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  
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
		<?php
	$sqlexcel = "SELECT * From jrcxl order by id desc";
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

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('salesnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  
		    <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Add Invoice Details</b></h1>
  </div>
  <!--<div class="col-auto">
    <a href="invoice.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Invoice Details</a>
  </div>-->
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
              <h6 class="m-0 font-weight-bold text-primary">Add Invoice Details</h6>
            </div>-->
<div class="card-body">
<form action="invoiceadds.php" method="post">
<input type="hidden" name="consigneeid" id="consigneeid" value="">
<div class="row">
<?php
if($infolayoutinvoice['invoiceno']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="invoiceno">Invoice No </label> <label><input type="checkbox" name="invoicetick" id="invoicetick" onclick="funtick()">(Click here for Unknown Invoice)</label>
    <input type="text" class="form-control" id="invoiceno" name="invoiceno" <?=($infolayoutinvoice['invoicenoreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="invoiceno" id="invoiceno" value="">
	<?php
}
if($infolayoutinvoice['invoicedate']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="invoicedate">Invoice Date</label>
	<input type="date" class="form-control" id="invoicedate" name="invoicedate" <?=($infolayoutinvoice['invoicedatereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="invoicedate" id="invoicedate" value="">
	<?php
}
if($infolayoutinvoice['tenderno']=='1')
{
?>	
<div class="col-lg-3">
  <div class="form-group">
    <label for="tenderno">Tender No</label>
    <input type="text" class="form-control" id="tenderno" name="tenderno" <?=($infolayoutinvoice['tendernoreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="tenderno" id="tenderno" value="">
	<?php
}
if($infolayoutinvoice['pono']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="pono">PO No</label>
    <input type="text" class="form-control" id="pono" name="pono" <?=($infolayoutinvoice['ponoreq']=='1')?'required':''?>>
  </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="pono" id="pono" value="">
	<?php
}
if($infolayoutinvoice['podate']=='1')
{
?> 
  <div class="col-lg-3">
    <div class="form-group">
    <label for="podate">PO Date</label>
    <input type="date" class="form-control" id="podate" name="podate" <?=($infolayoutinvoice['podatereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="podate" id="podate" value="">
	<?php
}



if($infolayoutinvoice['claimsubon']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="claimsubon">Invoice Submitted On</label>
    <input type="date" class="form-control" id="claimsubon" name="claimsubon" <?=($infolayoutinvoice['claimsubonreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="claimsubon" id="claimsubon" value="">
	<?php
}

if($infolayoutinvoice['invoiceamt']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="invoiceamt">Invoice Amount</label>
    <input type="text" class="form-control" id="invoiceamt" name="invoiceamt" <?=($infolayoutinvoice['invoiceamtreq']=='1')?'required':''?> onchange="amount()">
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="invoiceamt" id="invoiceamt" value="">
	<?php
}
if($infolayoutinvoice['claimper']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="claimper">Claim %</label>
    <input type="number" class="form-control" id="claimper" name="claimper" <?=($infolayoutinvoice['claimperreq']=='1')?'required':''?> max="100" min="0" value="100" onchange="amount()">
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="claimper" id="claimper" value="">
	<?php
}

if($infolayoutinvoice['claimamt']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="claimamt">Claim Amount</label>
    <input type="text" class="form-control" id="claimamt" name="claimamt" <?=($infolayoutinvoice['claimamtreq']=='1')?'required':''?> readonly onchange="amount()">
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="claimamt" id="claimamt" value="">
	<?php
}


if($infolayoutinvoice['installrefno']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="installrefno">Installation Ref.No</label>
    <input type="text" class="form-control" id="installrefno" name="installrefno" <?=($infolayoutinvoice['installrefnoreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="installrefno" id="installrefno" value="">
	<?php
}

if($infolayoutinvoice['suprefno']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="suprefno">Supplier Invoice / Ref.No</label>
    <input type="text" class="form-control" id="suprefno" name="suprefno" <?=($infolayoutinvoice['suprefnoreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="suprefno" id="suprefno" value="">
	<?php
}



if($infolayoutinvoice['dcno']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="dcno">DC No</label>
    <input type="text" class="form-control" id="dcno" name="dcno" <?=($infolayoutinvoice['dcnoreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="dcno" id="dcno" value="">
	<?php
}
if($infolayoutinvoice['dcdate']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="dcdate">DC Date</label>
	<input type="date" class="form-control" id="dcdate" name="dcdate" <?=($infolayoutinvoice['dcdatereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="dcdate" id="dcdate" value="">
	<?php
}
if($infolayoutinvoice['installedon']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="installedon">Installed on</label>
    <input type="date" class="form-control" id="installedon" name="installedon" <?=($infolayoutinvoice['installedonreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="installedon" id="installedon" value="">
	<?php
}
if($infolayoutinvoice['installedby']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="installedby">Installed by</label>
    <input type="text" class="form-control" id="installedby" name="installedby" <?=($infolayoutinvoice['installedbyreq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="installedby" id="installedby" value="">
	<?php
}
if($infolayoutcustomers['maincategory']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="maincategory">Main Category</label>
    <input type="text" class="form-control" id="maincategory" name="maincategory" <?=($infolayoutcustomers['maincategoryreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="maincategory" id="maincategory" value="">
	<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="subcategory">Sub Category</label>
    <input type="text" class="form-control" id="subcategory" name="subcategory" <?=($infolayoutcustomers['subcategoryreq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="subcategory" id="subcategory" value="">
	<?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="consigneename">Customer Name</label>
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
if($infolayoutcustomers['department']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="department">Department</label>
    <input type="text" class="form-control" id="department" name="department" <?=($infolayoutcustomers['departmentreq']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="department" id="department" value="">
	<?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="address1">Address 1</label>
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
if($infolayoutcustomers['address2']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="address2">Address 2</label>
   <input type="text" class="form-control" id="address2" name="address2" <?=($infolayoutcustomers['address2req']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="address2" id="address2" value="">
	<?php
}
if($infolayoutcustomers['area']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="area">Area</label>
    <input type="text" class="form-control" id="area" name="area" <?=($infolayoutcustomers['areareq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="area" id="area" value="">
	<?php
}
if($infolayoutcustomers['district']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District</label>
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
if($infolayoutcustomers['pincode']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="pincode">Pincode</label>
    <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6"  <?=($infolayoutcustomers['pincodereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="pincode" id="pincode" value="">
	<?php
}
if($infolayoutcustomers['contact']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="contact">Contact Person</label>
    <input type="text" class="form-control" id="contact" name="contact" <?=($infolayoutcustomers['contactreq']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="contact" id="contact" value="">
	<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="phone">Phone No</label>
    <input type="text" class="form-control" id="phone" name="phone" maxlength="11" <?=($infolayoutcustomers['phonereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="phone" id="phone" value="">
	<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="mobile">Mobile No</label>
    <input type="text" class="form-control" id="mobile" name="mobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?>>
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
if($infolayoutcustomers['email']=='1')
{
?> 
<div class="col-lg-3">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?>>
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
if($infolayoutinvoice['invoicedqty']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="invoicedqty">Invoiced Qty</label>
    <input type="text" class="form-control" id="invoicedqty" name="invoicedqty" <?=($infolayoutinvoice['invoicedqtyreq']=='1')?'required':''?>>
  </div>
   </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="invoicedqty" id="invoicedqty" value="">
	<?php
}
if($infolayoutinvoice['overallwarranty']=='1')
{
?> 
<div class="col-lg-3">
  <div class="form-group">
    <label for="overallwarranty">Overall Warranty</label>
    <input type="text" class="form-control" id="overallwarranty" name="overallwarranty" <?=($infolayoutinvoice['overallwarrantyreq']=='1')?'required':''?>>
  </div>
   </div>
   <?php
}
else
{
	?>
	<input type="hidden" name="overallwarranty" id="overallwarranty" value="">
	<?php
}
?>
</div>
  
      <div class="row">
<div class="col-lg-12">
   <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
<?php
$cco=0;
if($infolayoutproducts['stockmaincategory']=='1')
{
?>	
					  <th>Main Category</th>
<?php
$cco++;
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>					  
					  <th>Sub Category</th>
<?php
$cco++;
}
if($infolayoutproducts['stockitem']=='1')
{
?>						  
                      <th>Product Name</th>
<?php
$cco++;
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>	
                      <th>Type of Product</th>
<?php
$cco++;
}
if($infolayoutproducts['componenttype']=='1')
{
?>
					  <th>Component Type</th>
<?php
$cco++;
}
if($infolayoutproducts['componentname']=='1')
{
?>
					  <th>Component Name</th>
<?php
$cco++;
}
if($infolayoutproducts['make']=='1')
{
?>					  
                      <th>Make</th>
<?php
$cco++;
}
if($infolayoutproducts['capacity']=='1')
{
?>
					  <th>Capacity</th>
<?php
$cco++;
}
if($infolayoutinvoice['warranty']=='1')
{
?>
					  <th>Warranty</th>
<?php
$cco++;
}
if($infolayoutinvoice['qty']=='1')
{
?>					  
					  <th>Qty</th>
<?php
$cco++;
}
if($infolayoutinvoice['serialnumber']=='1')
{
?>
					  <th>Serial Number</th>
<?php
$cco++;
}
?>					  
                    </tr>
                  </thead>
                  <tbody>
				    <tr>
					<input type="hidden" name="oldxlid[]" id="oldxlid1" value="">
					<input type="hidden" name="productid[]" id="productid1" value="">
<?php
if($infolayoutproducts['stockmaincategory']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					
 					  <td style="width:<?=$cco/100?>%">
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
	</select></td>
<?php
	}
	else
	{
		?>
		 <td style="width:<?=$cco/100?>%"><textarea rows="6" name="stockmaincategory[]" id="stockmaincategory1"  class="form-control" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?>></textarea></td>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="stockmaincategory[]" id="stockmaincategory1" value="">
	<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
					  <td style="width:<?=$cco/100?>%">
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
	</select></td>
<?php
	}
	else
	{
		?>
		<td style="width:<?=$cco/100?>%"><textarea rows="6" name="stocksubcategory[]" id="stocksubcategory1"  class="form-control"  <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?>></textarea></td>
		<?php
	}

}
else
{
	?>
	<input type="hidden" name="stocksubcategory[]" id="stocksubcategory1" value="">
	<?php
}

if($infolayoutproducts['stockitem']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
					  <td style="width:<?=$cco/100?>%">
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
					  
				</td>
<?php
	}
	else
	{
		?>
		<td style="width:<?=$cco/100?>%"><textarea rows="6" name="stockitem[]" id="stockitem1"  class="form-control"  <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>></textarea></td>
		<?php
	}

}
else
{
	?>
	<input type="hidden" name="stockitem[]" id="stockitem1" value="">
	<?php
}
if($infolayoutproducts['typeofproduct']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
                      <td style="width:<?=$cco/100?>%">
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
	</select></td>
<?php
	}
	else
	{
		?>
		 <td style="width:<?=$cco/100?>%"><textarea rows="6" name="typeofproduct[]" id="typeofproduct1"  class="form-control" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?> ></textarea></td>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="typeofproduct[]" id="typeofproduct1" value="">
	<?php
}

if($infolayoutproducts['componenttype']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
					  <td style="width:<?=$cco/100?>%">
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
	</select></td>
<?php
	}
	else
	{
		?>
		 <td style="width:<?=$cco/100?>%"><textarea rows="6" name="componenttype[]" id="componenttype1"  class="form-control" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?> ></textarea></td>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="componenttype[]" id="componenttype1" value="">
	<?php
}
if($infolayoutproducts['componentname']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
					  <td style="width:<?=$cco/100?>%">
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
	</select></td>
<?php
	}
	else
	{
		?>
		<td style="width:<?=$cco/100?>%"><textarea rows="6" name="componentname[]" id="componentname1"  class="form-control" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?> ></textarea></td>
		
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="componentname[]" id="componentname1" value="">
	<?php
}

if($infolayoutproducts['make']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>
					  <td style="width:<?=$cco/100?>%">
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
	</select></td>
<?php
	}
	else
	{
		?>
		<td style="width:<?=$cco/100?>%"><textarea rows="6" name="make[]" id="make1"  class="form-control" <?=($infolayoutproducts['makereq']=='1')?'required':''?>></textarea></td>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="make[]" id="make1" value="">
	<?php
}
if($infolayoutproducts['capacity']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
					  <td style="width:<?=$cco/100?>%"><select class="fav_clr form-control" name="capacity[]" id="capacity1" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>>
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
	</td>
<?php
	}
	else
	{
		?>
		 <td style="width:<?=$cco/100?>%"><textarea rows="6" name="capacity[]" id="capacity1"  class="form-control" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>></textarea></td>
		<?php
	}
}
else
{
	?>
	<input type="hidden" name="capacity[]" id="capacity1" value="">
	<?php
}

if($infolayoutinvoice['warranty']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>
					  <td style="width:<?=$cco/100?>%">
					  <select class="fav_clr form-control" name="warranty[]" id="warranty1" <?=($infolayoutinvoice['warrantyreq']=='1')?'required':''?>>
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniqueval = array_unique(array_map(function ($i) { return $i['warranty']; }, $newexcel_array));
	sort($uniqueval);
			foreach($uniqueval as $urep) 
			{
				if(is_numeric($urep))
				{
				?>
				<option value="<?=$urep?>"><?=$urep?></option>
				<?php
				}
			}
	}
	?>
	</select></td>
<?php
	}
	else
	{
		?>
		 <td style="width:<?=$cco/100?>%"><textarea rows="6" name="warranty[]" id="warranty1"  class="form-control" <?=($infolayoutinvoice['warrantyreq']=='1')?'required':''?>></textarea></td>
		<?php
	}

}
else
{
	?>
	<input type="hidden" name="warranty[]" id="warranty1" value="">
	<?php
}
if($infolayoutinvoice['qty']=='1')
{
?>					  <td style="width:<?=$cco/100?>%"><input type="number" name="qty[]" id="qty1"  class="form-control" <?=($infolayoutinvoice['qtyreq']=='1')?'required':''?>></td>
<?php
}
else
{
	?>
	<input type="hidden" name="qty[]" id="qty1" value="">
	<?php
}
if($infolayoutinvoice['serialnumber']=='1')
{
?>					  <td style="width:<?=$cco/100?>%"><input type="text" name="serialnumber[]" id="serialnumber1"  class="form-control" <?=($infolayoutinvoice['serialnumberreq']=='1')?'required':''?> onchange="addserial(this.value, this.value)"></td>
<?php
}
else
{
	?>
	<input type="hidden" name="serialnumber[]" id="serialnumber1" value="">
	<?php
}
?>
                    </tr>
					
                  </tbody>
                </table>
              </div>
			  </div>
			  </div>
			   <div align="right">
			 <span class="pull-right"> <a class="add-row btn-sm btn-warning "> 
        Add New Product 
    </a> </span>
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
  <script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
  
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
       source: 'consigneesearch.php?type=maincategory',
     });
	 $( "#subcategory" ).autocomplete({
       source: 'consigneesearch.php?type=subcategory',
     });
	 $( "#consigneename" ).autocomplete({
       //source: 'consigneesearch.php?type=consigneename',
	   source: 'consearch.php', select: function (event, ui) { $("#consigneename").val(ui.item.value); $("#consigneeid").val(ui.item.id); $("#maincategory").val(ui.item.maincategory); $("#subcategory").val(ui.item.subcategory); $("#department").val(ui.item.department); $("#address1").val(ui.item.address1); $("#address2").val(ui.item.address2); $("#area").val(ui.item.area); $("#district").val(ui.item.district); $("#pincode").val(ui.item.pincode); $("#contact").val(ui.item.contact); $("#phone").val(ui.item.phone); $("#mobile").val(ui.item.mobile); $("#email").val(ui.item.email);}, minLength: 3
     });
	 $( "#department" ).autocomplete({
       source: 'consigneesearch.php?type=department',
     });
	 $( "#stockmaincategory1" ).autocomplete({
       source: 'productsearch.php?type=stockmaincategory',
     });
	 $( "#stocksubcategory1" ).autocomplete({
       source: 'productsearch.php?type=stocksubcategory',
     });
	 $( "#stockitem1" ).autocomplete({
       source: 'productsearch.php?type=stockitem',
     });
     $( "#typeofproduct1" ).autocomplete({
       source: 'productsearch.php?type=typeofproduct',
     });
	 $( "#make1" ).autocomplete({
       source: 'productsearch.php?type=make',
     });
	 $( "#capacity1" ).autocomplete({
       source: 'productsearch.php?type=capacity',
     });
	 $( "#componenttype1" ).autocomplete({
       source: 'productsearch.php?type=componenttype',
     });
	 $( "#componentname1" ).autocomplete({
       source: 'productsearch.php?type=componentname',
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
	var invoicetick=document.getElementById("invoicetick");
	if(invoicetick.checked==true)
	{
		document.getElementById("invoiceno").value=<?=time()?>;
	}
	else
	{
		document.getElementById("invoiceno").value="";
	}
		
}
</script>
<script> 
        let lineNo = 2; 
        $(document).ready(function () { 
            $(".add-row").click(function () { 
                markup= '<tr><input type="hidden" name="oldxlid[]" id="oldxlid'+ lineNo + '" value=""><input type="hidden" name="productid[]" id="productid'+ lineNo + '" value="">'; 
			<?php
if($infolayoutproducts['stockmaincategory']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>		
 			    	markup+='<td style="width:<?=$cco/100?>%">';
					markup+='<select class="fav_clr form-control" name="stockmaincategory[]" id="stockmaincategory1'+ lineNo +'" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?>>';
	                <?php
                	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                {
	                $uniqueval = array_unique(array_map(function ($i) { return $i['stockmaincategory']; }, $newexcel_array));
	                sort($uniqueval);
			        foreach($uniqueval as $urep) 
			        {
				    ?>
				    markup+='<option value="<?=preg_replace( "/\r|\n/", "", $urep )?>"><?=preg_replace( "/\r|\n/", "", $urep )?></option>';
				    <?php
			        }
	                }
	                ?>
                 	markup+='</select></td>';
<?php
}
else
	{
		?>
		markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="stockmaincategory[]" id="stockmaincategory1'+ lineNo + '"  class="form-control" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?>></textarea></td>';
		<?php
	}
}
if($infolayoutproducts['stocksubcategory']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
					 markup+='<td style="width:<?=$cco/100?>%">';
					 markup+='<select class="fav_clr form-control" name="stocksubcategory[]" id="stocksubcategory1'+ lineNo +'" <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?>>';
	                 <?php
	                 if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                 {	
	                 $uniqueval = array_unique(array_map(function ($i) { return $i['stocksubcategory']; }, $newexcel_array));
	                 sort($uniqueval);
			         foreach($uniqueval as $urep) 
			         {
				     ?>
				     markup+='<option value="<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "", $urep ))?>"><?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "", $urep ))?></option>';
			       	 <?php
			         }
	                 }
	                 ?>
	                 markup+='</select></td>'; 
<?php
}
	else
	{
		?>
		markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="stocksubcategory[]" id="stocksubcategory1'+ lineNo +'"  class="form-control"  <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?>></textarea></td>';
		<?php
	}
}
if($infolayoutproducts['stockitem']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>						
                    markup+='<td style="width:<?=$cco/100?>%">';
                    markup+='<select class="fav_clr form-control" name="stockitem[]" id="stockitem'+ lineNo +'" <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>>';
	                <?php
	                if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                {
	                $uniqueval = array_unique(array_map(function ($i) { return $i['stockitem']; }, $newexcel_array));
	                sort($uniqueval);
		         	foreach($uniqueval as $urep) 
		        	{
			    	?>
				    markup+='<option value="<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "", $urep ))?>"><?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "", $urep ))?></option>';
				   <?php
			        }
	                }
	                ?>
	                markup+='</select></td> '; 
<?php
}
else
	{
		?>
		markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="stockitem[]" id="stockitem1'+ lineNo + '"  class="form-control"  <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>></textarea></td>';
		<?php
	}
}
if($infolayoutproducts['typeofproduct']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>	
                      markup+='<td style="width:<?=$cco/100?>%">';
					  markup+='<select class="fav_clr form-control" name="typeofproduct[]" id="typeofproduct1'+ lineNo +'" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?>>';
	                  <?php
	                  if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                  {
	                  $uniqueval = array_unique(array_map(function ($i) { return $i['typeofproduct']; }, $newexcel_array));
	                  sort($uniqueval);
			          foreach($uniqueval as $urep) 
			          {
				      ?>
				      markup+='<option value="<?=preg_replace( "/\r|\n/", "", $urep )?>"><?=preg_replace( "/\r|\n/", "", $urep )?></option>';
				      <?php
			          }
	                  }
	                  ?>
	                  markup+='</select></td>';
<?php
}
else
	{
		?>
		markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="typeofproduct[]" id="typeofproduct1'+ lineNo +'"  class="form-control" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?> ></textarea></td>';
		<?php
	}
}
if($infolayoutproducts['componenttype']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>
					 markup+='<td style="width:<?=$cco/100?>%">';
					 markup+='<select class="fav_clr form-control" name="componenttype[]" id="componenttype1'+ lineNo +'" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?>>';
	                 <?php
	                 if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                 {
	                 $uniqueval = array_unique(array_map(function ($i) { return $i['componenttype']; }, $newexcel_array));
	                 sort($uniqueval);
			         foreach($uniqueval as $urep) 
			         {
				     ?>
				     markup+='<option value="<?=preg_replace( "/\r|\n/", "", $urep )?>"><?=preg_replace( "/\r|\n/", "", $urep )?></option>';
				     <?php
			         }
	                 }
	                 ?>
	                 markup+='</select></td>'; 
<?php
}
else
	{
		?>
		 markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="componenttype[]" id="componenttype1'+ lineNo + '"  class="form-control" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?> ></textarea></td>';
		<?php
	}
}
if($infolayoutproducts['componentname']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>
					 markup+='<td style="width:<?=$cco/100?>%">';
					 markup+='<select class="fav_clr form-control" name="componentname[]" id="componentname1'+ lineNo +'" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?>>';
	                 <?php
	                 if((isset($newexcel_array))&&(is_array($newexcel_array)))
           	         {
                     $uniqueval = array_unique(array_map(function ($i) { return $i['componentname']; }, $newexcel_array));
	                 sort($uniqueval);
			         foreach($uniqueval as $urep) 
			         {
				     ?>
				     markup+='<option value="<?=preg_replace( "/\r|\n/", "", $urep )?>"><?=preg_replace( "/\r|\n/", "", $urep )?></option>';
				     <?php
			         }
	                 }
	                 ?>
	                 markup+='</select></td>'; 
<?php
}
else
	{
		?>
		markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="componentname[]" id="componentname1'+ lineNo + '"  class="form-control" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?> ></textarea></td>';
		
		<?php
}
}
if($infolayoutproducts['make']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>					  
                    markup+='<td style="width:<?=$cco/100?>%">';
					markup+='<select class="fav_clr form-control" name="make[]" id="make1'+ lineNo +'" <?=($infolayoutproducts['makereq']=='1')?'required':''?>>';
	                <?php
	                if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                {
	                $uniqueval = array_unique(array_map(function ($i) { return $i['make']; }, $newexcel_array));
	                sort($uniqueval);
			        foreach($uniqueval as $urep) 
			        {
			    	?>
				    markup+='<option value="<?=preg_replace( "/\r|\n/", "", $urep )?>"><?=preg_replace( "/\r|\n/", "", $urep )?></option>';
				    <?php
			        }
	                }
	                ?>
	                markup+='</select></td>';
<?php
}
	else
	{
		?>
		markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="make[]" id="make1'+ lineNo + '"  class="form-control" <?=($infolayoutproducts['makereq']=='1')?'required':''?>></textarea></td>';
		<?php
	}
}
if($infolayoutproducts['capacity']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>
					  markup+='<td style="width:<?=$cco/100?>%">';
					  markup+='<select class="fav_clr form-control" name="capacity[]" id="capacity1'+ lineNo +'" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>>';
	                  <?php
	                  if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                  {
	                  $uniqueval = array_unique(array_map(function ($i) { return $i['capacity']; }, $newexcel_array));
	                  sort($uniqueval);
			          foreach($uniqueval as $urep) 
			          {
				      ?>
				      markup+='<option value="<?=preg_replace( "/\r|\n/", "", $urep )?>"><?=preg_replace( "/\r|\n/", "", $urep )?></option>';
				      <?php
			          }
	                  }
	                  ?>
	                  markup+='</select></td>'; 
<?php
}
	else
	{
		?>
		 markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="capacity[]" id="capacity1'+ lineNo + '"  class="form-control" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>></textarea></td>';
		<?php
	}
}
if($infolayoutinvoice['warranty']=='1')
{
	if($infolayoutinvoice['proinput']=='1')
	{
?>
					  markup+='<td style="width:<?=$cco/100?>%">';
					  markup+='<select class="fav_clr form-control" name="warranty[]" id="warranty1'+ lineNo +'" <?=($infolayoutinvoice['warrantyreq']=='1')?'required':''?>>';
	                  <?php
	                  if((isset($newexcel_array))&&(is_array($newexcel_array)))
	                  {
	                  $uniqueval = array_unique(array_map(function ($i) { return $i['warranty']; }, $newexcel_array));
	                  sort($uniqueval);
                      foreach($uniqueval as $urep) 
			          {
				      if(is_numeric($urep))
				      {
				      ?>
				      markup+='<option value="<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "", $urep ))?>"><?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "", $urep ))?></option>';
				      <?php
				      }
			          }
	                  }
	                  ?>
	                  markup+='</select></td>';
<?php
}

else
	{
		?>
		 markup+='<td style="width:<?=$cco/100?>%"><textarea rows="6" name="warranty[]" id="warranty1'+ lineNo + '"  class="form-control" <?=($infolayoutinvoice['warrantyreq']=='1')?'required':''?>></textarea></td>';
		<?php
	}
}
if($infolayoutinvoice['qty']=='1')
{
?>					  
					  markup+= '<td style="width:<?=$cco/100?>%"><input type="number" name="qty[]" id="qty1'+ lineNo +'"  class="form-control" <?=($infolayoutinvoice['qtyreq']=='1')?'required':''?>></td>'; 
<?php
}
if($infolayoutinvoice['serialnumber']=='1')
{
?>					  
					  markup+= ' <td style="width:<?=$cco/100?>%"><input type="text" name="serialnumber[]" id="serialnumber1'+ lineNo +'"  class="form-control" <?=($infolayoutinvoice['serialnumberreq']=='1')?'required':''?> onchange="addserial(this.value, this.value)"></td>'; 
<?php
}
?>
			
                markup+= '</tr>'; 
                tableBody = $("table#dataTable tbody"); 
				tableBody.append(markup); 
				
				$( "#stockmaincategory1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=stockmaincategory',
				 });
				 $( "#stocksubcategory1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=stocksubcategory',
				 });
				 $( "#stockitem1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=stockitem',
				 });
				 $( "#typeofproduct1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=typeofproduct',
				 });
				 $( "#make1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=make',
				 });
				 $( "#capacity1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=capacity',
				 });
				 $( "#componenttype1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=componenttype',
				 });
				 $( "#componentname1"+lineNo ).autocomplete({
				   source: 'productsearch.php?type=componentname',
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
                lineNo++; 
                numberinput();                                                   
            }); 
        });  
		
		
		
    </script> 
    <script>
	$( "#tenderno" ).autocomplete({
source: 'tallysearch.php?type=tenderno&table=jrctenderno',
});
	</script> 
    <script>
 function numberinput()
 {     
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
 }
 numberinput();
  </script>
  <script>
  function amount()
{   
	var invoiceamt = document.getElementById("invoiceamt").value;
	if(invoiceamt=='')
	{
		invoiceamt=0;
	}
	var claimper = document.getElementById("claimper").value;
	document.getElementById("claimamt").value =((((parseFloat(invoiceamt))/100))*parseFloat(claimper));
	

}
  </script>
  <?php include('additionaljs.php');   ?>
</body>

</html>
