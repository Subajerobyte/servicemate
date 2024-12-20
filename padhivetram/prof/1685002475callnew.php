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
			include('callnavbar.php');  
		  }
		  ?>
        <div class="container-fluid">
          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Add New Call Details (New Customer)</h1>
            <a href="calls.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Call Details</a>
          </div>
		  <?php
if(isset($_GET['remarks']))
{
?>	
<div class="col-lg-12 mb-2">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      <?=$_GET['remarks']?>
                    </div>
                  </div>
                </div>
<?php
}
 if(isset($_GET['error']))
{
?>	 
  <div class="col-lg-12 mb-2">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                     <?=$_GET['error']?>
                    </div>
                  </div>
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
<form action="callnewadds.php" method="post">
<input type="hidden" name="consigneeid" id="consigneeid">
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
	<input type="hidden" name="invoiceno" id="invoiceno" value="<?=time()?>">
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
	<input type="hidden" name="invoicedate" id="invoicedate" value="<?=date('Y-m-d')?>">
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
<div class="col-lg-12">
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
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
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
					<input type="hidden" name="productid[]" id="productid" value="">
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
					  <select class="fav_clr form-control" name="warranty[]" id="warranty1" <?=($infolayoutproducts['warrantyreq']=='1')?'required':''?>>
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
<div class="row">
<?php
$businesstypes1=explode(',',$businesstype);	
if($infolayoutcall['businesstype']=='1')
{
if(count($businesstypes1)>1)
{
?>		
<div class="col-lg-2 mb-3">
<label for="businesstype">Business Type:</label>
</div>
<div class="col-lg-10 mb-3">
<?php
if($businesstype!='')
{
$businesstypes=explode(',',$businesstype);

foreach($businesstypes as $btype)
{
?>	
<label class="mr-2"><input type="radio" name="businesstype" value="<?=$btype?>" <?=($infolayoutcall['businesstypereq']=='1')?'required':''?>> <?=$btype?> </label>
<?php
}
}
?>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="businesstype" id="businesstype" value="<?=$businesstypes1[0]?>">
	<?php
}
}
else
{
	?>
	<input type="hidden" name="businesstype" id="businesstype" value="<?=$businesstypes1[0]?>">
	<?php
}

?>
<div class="col-lg-2 mb-3" <?=($infolayoutcall['servicetype']=='1')?'style="display:block"':'style="display:none"'?>>
<label for="servicetype">Service Type:</label>
</div>
<div class="col-lg-10 mb-3" <?=($infolayoutcall['servicetype']=='1')?'style="display:block"':'style="display:none"'?>>
<label class="mr-2"><input type="radio" name="servicetype" id="servicetypeonsite" <?=((isset($_GET['ts']))&&(($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> value="On-Site" <?=($infolayoutcall['servicetypereq']=='1')?'required':''?> onchange="checkcarry()"> On-Site </label>
<label class="mr-2" <?=(($liveplan=='GOLD')||($liveplan=='DIAMOND'))?'':'style="display:none"'?>><input type="radio" name="servicetype" id="servicetypecarry" value="Carry-In" <?=($infolayoutcall['servicetypereq']=='1')?'required':''?> onchange="checkcarry()" <?=((isset($_GET['at']))&&($_GET['at']=="in"))?'checked':''?>> Carry-In </label>
</div>
<?php

if($infolayoutcall['customernature']=='1')
{
?>
<div class="col-lg-2 mb-3">
<label for="customernature">Customer Nature:</label>
</div>
<div class="col-lg-10 mb-3">
<?php
						if(($infolayoutcall['customernaturea']=='1'))
					  {
						  ?>
<label class="mr-2"><input type="radio" name="customernature" <?=((isset($primarywarranty))&&(($primarywarranty=='AMC')))?'checked':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> value="AMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> AMC </label>
<?php
					  }
					  if(($infolayoutcall['customernaturew']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" <?=((isset($primarywarranty))&&(($primarywarranty=='Warranty')))?'checked':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')))?'checked':''?> value="Warranty" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Warranty </label>
<?php
					  }
					  if(($infolayoutcall['customernatureow']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Out of Warranty" <?=((isset($primarywarranty))&&(($primarywarranty=='Out of Warranty')))?'checked':''?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Out of Warranty </label>
<?php
					  }
					  if(($infolayoutcall['customernatureom']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Other Make" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Other Make</label>
<?php
					  }
					  if(($infolayoutcall['customernaturefsma']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="FSMA" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> FSMA</label>
<?php
					  }
					  if(($infolayoutcall['customernaturecamc']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="CAMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> CAMC</label>
<?php
					  }
					  ?>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="customernature" id="customernature" value="">
	<?php
}
?>
<div class="col-lg-2 mb-3" <?=($infolayoutcall['calltype']=='1')?'style="display:block"':'style="display:none"'?>>
<label for="callnature">Call Type:</label>
</div>
<div class="col-lg-10 mb-3" <?=($infolayoutcall['calltype']=='1')?'style="display:block"':'style="display:none"'?>>
<label class="mr-2"><input type="radio" name="calltype" id="calltypes" value="Service Call" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>> Service Call (Received from Customer) </label>
<label class="mr-2"><input type="radio" name="calltype" id="calltypeo" <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')||($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> value="Other Call" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>> Other Call (Service Related Activities) </label>
</div>
	<?php
if($infolayoutcall['callnature']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="callnature">Call Nature &nbsp;<span href="#" data-toggle="modal" data-target="#callnaturemodal">&nbsp;<i class="fa fa-plus text-primary"></i> </span></label>
<select class="form-control fav_clr" id="callnature" name="callnature" <?=($infolayoutcall['callnaturereq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrccallnature order by callnature asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['callnature']?>"><?=$rowrep['callnature']?></option>
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
	<input type="hidden" name="callnature" id="callnature" value="">
	<?php
}
if($infolayoutcall['callfrom']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="callfrom">Call Received From (Contact Number)</label>
	<input type="text" class="form-control" id="callfrom" name="callfrom" maxlength="10" <?=($infolayoutcall['callfromreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="callfrom" id="callfrom" value="">
	<?php
}
if($infolayoutcall['callon']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="callon">Call Received On</label>
    <input type="text" class="form-control" id="callon" name="callon" readonly  value="<?=date('Y-m-d H:i:s')?>" <?=($infolayoutcall['callonreq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="callon" id="callon" value="<?=date('Y-m-d H:i:s')?>">
	<?php
}
if($infolayoutcall['callhandling']=='1')
{
?>  
  <div class="col-lg-3">
  <div class="form-group">
    <label for="callhandlingname">Call Handled By</label>
	<?php
	$sqlrep2 = "SELECT id, adminusername From jrcadminuser where id='".$_SESSION['callhandlingid']."'  order by adminusername asc";
        $queryrep2 = mysqli_query($connection, $sqlrep2);
        $rowCountrep2 = mysqli_num_rows($queryrep2);
		$rowrep2 = mysqli_fetch_array($queryrep2);
		?>
	<input type="hidden" id="callhandlingname" name="callhandlingname" <?=($infolayoutcall['callhandlingreq']=='1')?'required':''?> value="<?=$rowrep2['adminusername']?>">	
	<select class="form-control fav_clr" id="callhandlingid" name="callhandlingid" <?=($infolayoutcall['callhandlingreq']=='1')?'required':''?> onchange="valchange('callhandling')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0' order by adminusername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
				<option value="<?=$rowrep['id']?>" <?=(($rowrep['id']==$_SESSION['callhandlingid'])?"selected":"")?>><?=$rowrep['adminusername']?></option>
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
	<input type="hidden" name="callhandlingid" id="callhandlingid" value="<?=$adminuserid?>">
	<input type="hidden" name="callhandlingname" id="callhandlingname" value="<?=$adminusername?>">
	<?php
}
if($infolayoutcall['reportedproblem']=='1')
{
?>  
<div class="col-lg-3">
      <div class="form-group">
    <label for="reportedproblem">Reported Problem &nbsp;<span href="#" data-toggle="modal" data-target="#reportmodal">&nbsp;<i class="fa fa-plus text-primary"></i> </span></label>
<select class="form-control fav_clr" id="reportedproblem" name="reportedproblem" <?=($infolayoutcall['reportedproblemreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcreportedproblem order by reportedproblem asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['reportedproblem']?>" <?=((isset($_GET['t']))&&($_GET['t']=='wm')&&($rowrep['reportedproblem']=='WARRANTY MAINTENANCE'))?'selected':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire'))&&($rowrep['reportedproblem']=='WARRANTY MAINTENANCE'))?'selected':''?> <?=((isset($_GET['t']))&&($_GET['t']=='am')&&($rowrep['reportedproblem']=='AMC MAINTENANCE'))?'selected':''?>><?=$rowrep['reportedproblem']?></option>
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
	<input type="hidden" name="reportedproblem" id="reportedproblem" value="">
	<?php
}


if($infolayoutcall['serial']=='1')
{
?>  
<div class="col-lg-3">
  <div class="form-group">
    <label for="serial">Serial Number </label>
	<select class="fav_clr form-control" name="serial" id="serial" <?=($infolayoutcall['serialreq']=='1')?'required':''?>>
	<?php
	$sqlserial = "SELECT * From jrcserials where sourceid='".$_GET['id']."' and sstatus='0' order by serialqty asc";
        $queryserial = mysqli_query($connection, $sqlserial);
        $rowCountserial = mysqli_num_rows($queryserial);
        if(!$queryserial){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountserial > 0) 
		{
			$count=1;
			while($rowserial = mysqli_fetch_array($queryserial)) 
			{
				?>
				<option value="<?=$rowserial['serialnumber']?>"><?=$rowserial['serialnumber']?></option>
				<?php
			}
		}
	?>
	<option value="Not Available">Not Available</option>
	</select>
  </div>
</div> 
<?php
}
else
{
	?>
	<input type="hidden" name="serial" id="serial" value="Not Available">
	<?php
}
if($infolayoutcall['coordinator']=='1')
{
?>  
<div class="col-lg-3">
      <div class="form-group">
    <label for="coordinatorname">Co-Ordinator Assigned</label>
	<?php
	$sqlrep1 = "SELECT id, adminusername From jrcadminuser where id='".$_SESSION['coordinatorid']."' order by adminusername asc";
        $queryrep1 = mysqli_query($connection, $sqlrep1);
        $rowCountrep1 = mysqli_num_rows($queryrep1);
		$rowrep1 = mysqli_fetch_array($queryrep1);
		?>
	<input type="hidden" id="coordinatorname" name="coordinatorname" <?=($infolayoutcall['coordinatorreq']=='1')?'required':''?> value="<?=$rowrep1['adminusername']?>" >	
	<select class="form-control fav_clr" id="coordinatorid" name="coordinatorid" <?=($infolayoutcall['coordinatorreq']=='1')?'required':''?> onchange="valchange('coordinator')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0'  order by adminusername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
				<option value="<?=$rowrep['id']?>" <?=(($rowrep['id']==$_SESSION['coordinatorid'])?"selected":"")?>><?=$rowrep['adminusername']?></option>
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
	<input type="hidden" name="coordinatorid" id="coordinatorid" value="<?=$adminuserid?>">
	<input type="hidden" name="coordinatorname" id="coordinatorname" value="<?=$adminusername?>">
	<?php
}

if($infolayoutcall['otherremarks']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="otherremarks">Other Remarks</label>
    <textarea type="text" class="form-control" id="otherremarks" name="otherremarks"  <?=($infolayoutcall['otherremarksreq']=='1')?'required':''?>></textarea>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="otherremarks" id="otherremarks" value="">
	<?php
}
?>
</div>
<hr>
<div id="carrydiv">
<div class="row">
<div class="col-lg-3">

<div class="form-group">
    <h5 for="diagnosisby" class="text-primary">Diagnosis By</h5><br>
	<label class="mr-2"><input type="radio" name="diagnosisby" id="diagnosisbyengineer" value="engineer" onchange="checkdiagnosis()"> Engineer </label>
	<label class="mr-2"><input type="radio" name="diagnosisby" id="diagnosisbycoordinator" value="coordinator" onchange="checkdiagnosis()"> Co-ordinator </label>
  </div>
</div>
<div class="col-lg-3">
	<div id="diagnosiseng">
  <div class="form-group">
    <label for="diagnosisname">Diagnosis By (Engineer Name)</label>
	<input type="hidden" id="diagnosisengineername" name="diagnosisengineername" >	
	<select class="form-control fav_clr" id="diagnosisengineerid" name="diagnosisengineerid" onchange="valchange('diagnosisengineer')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0' order by engineername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
	</div>

	<div id="diagnosiscoor">
  <div class="form-group">
    <label for="diagnosisname">Diagnosis By (Co-Ordinator Name)</label>

	<input type="hidden" id="diagnosiscoordinatorname" name="diagnosiscoordinatorname">	
	<select class="form-control fav_clr" id="diagnosiscoordinatorid" name="diagnosiscoordinatorid" onchange="valchange('diagnosiscoordinator')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0' order by adminusername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['adminusername']?></option>
<?php
			}
		}
		?>
</select>

  </div>
	</div>
   </div>

   <div class="col-lg-3">
    <div class="form-group">
    <label for="callon">Diagnosed On</label>
    <input type="datetime-local" class="form-control" id="diagnosison"  value="<?=date('Y-m-d H:i:s')?>" name="diagnosison" step="60">
  </div>
  </div>

  
<div class="col-lg-3">
      <div class="form-group">
    <label for="problemobserved">Problem Observed</label>
<select class="form-control fav_clr" id="problemobserved" name="problemobserved">
<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcproblemobserved order by problemobserved asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['problemobserved']?>"><?=$rowrep['problemobserved']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="diagnosisestdate">Estimated Date of Completion</label>
    <input type="datetime-local" class="form-control" id="diagnosisestdate" name="diagnosisestdate" step="60">
  </div>
  </div>

  <div class="col-lg-3">
    <div class="form-group">
    <label for="diagnosisestcharge">Estimated Charges</label>
    <input type="number" class="form-control" id="diagnosisestcharge" name="diagnosisestcharge" min="0" step="0.01">
  </div>
  </div>
	</div>
	<div class="row">
  <div class="col-lg-3">
<label for="diagnosisimg">Product Images (On Received Time)</label>
<div id="mulitplefileuploader" style="width:100%">Upload Site Images</div>
<div id="status"></div>
<div id="showData" class="imgcontainer">
</div>
<input id="diagnosisimg" type="hidden" name="diagnosisimg" value="">
<br />
	
	</div>


  <div class="col-lg-3">
      <div class="form-group">
    <label for="diagnosisremarks">Diagnosis Remarks</label>
<textarea class="form-control" id="diagnosisremarks" name="diagnosisremarks"></textarea>
  </div>
  </div>

<div class="col-lg-3">
      <div class="form-group">
    <label for="diagnosismaterial">Additional Materials</label>
<select class="form-control fav_clr" id="diagnosismaterial" name="diagnosismaterial[]" multiple>
<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcmaterial order by material asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['material']?>"><?=$rowrep['material']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>

  <!--div class="col-lg-3">
      <div class="form-group">
    <label for="diagnosismaterial">Additional Materials Remarks</label>
<textarea class="form-control" id="diagnosismaterial" name="diagnosismaterial"></textarea>
  </div>
  </div-->

  <div class="col-lg-3">
  <div class="form-group">
  <label for="diagnosissignname">Received From (Name)</label>
    <input type="text" class="form-control" name="diagnosissignname" id="diagnosissignname">
  </div>
	</div> 
	<div class="col-lg-3">
  <div class="form-group">
  <label for="diagnosissignmode">Received Mode</label>
   <select class="form-control fav_clr" id="diagnosissignmode" name="diagnosissignmode">
   <option value="">Select</option>
<option value="By Hand">By Hand</option>
<option value="By courier">By Courier</option>
</select>
  </div>
  </div>
  <div class="col-lg-3">
  <div class="form-group">
  <label for="diagnosissignmoderemark">Received Mode Remarks</label>
   <textarea  class="form-control" id="diagnosissignmoderemark" name="diagnosissignmoderemark" rows="1">
</textarea>
  </div>
	</div>
	<div class="col-lg-3">
  <div class="form-group">
  <label for="diagnosissignature">Signature</label>
    <input type="hidden" class="form-control" name="diagnosissignature" id="diagnosissignature" value="">
	<img id="diagnosissignatureimg" src="">
	<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#signModal">Get Signature</a>
	<div id="signModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Get Signature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" class="text-center" align="center">
        <p class="text-center"><div id="signpad" align="center" style="border:1px solid #000000; width:302px; height:202px;">
		<canvas class="pad" id="pad" width="300" height="200" ></canvas>
		</div></p>
      </div>
      <div class="modal-footer">
	  <input type="button" class="btn btn-warning" value="Clear" id="clear" />
			<input type="button" id="btnSaveSign" class="btn btn-success" value="Submit"  data-dismiss="modal"/>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>


  </div>
<div class="col-lg-3">
      <div class="form-group">
    <label for="godown">Move To(Warehouse)</label>
<select class="form-control fav_clr" id="godownname" name="godownname">
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, godownname From jrcgodown order by id asc";
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
<option value="<?=$rowgo['id']?>"><?=$rowgo['godownname']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
<div class="col-lg-3">
      <div class="form-group">
    <label for="godown">Supplier Name</label>
<select class="form-control fav_clr" id="suppliername" name="suppliername">
<option value="">Select</option>
<?php
$sqlsup = "SELECT id, suppliername From jrcsuppliers order by suppliername asc";
        $querysup = mysqli_query($connection, $sqlsup);
        $rowCountsup = mysqli_num_rows($querysup);
        if(!$querysup){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountsup > 0) 
		{
			$count=1;
			while($rowsup = mysqli_fetch_array($querysup)) 
			{
				?>
<option value="<?=$rowsup['id']?>"><?=$rowsup['suppliername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
	</div>



	<hr>
	</div>
<div class="row">
<?php

if($infolayoutcall['engineer']=='1')
{
?>


<div class="col-lg-3">

<div class="form-group">
    <label for="engineertype" class="text-primary">Engineer Type</label><br>
	<label class="mr-2"><input type="radio" name="engineertype" id="engineertypesingle" value="0" onchange="checkengineer()" checked> One Engineer </label>
	<label class="mr-2"><input type="radio" name="engineertype" id="engineertypemultiple" value="1" onchange="checkengineer()"> Multiple Engineers </label>
  </div>
</div>
<div class="col-lg-3">
	<div id="engineereng">
  <div class="form-group">
    <label for="engineername">Engineer Assigned</label>
	<input type="hidden" id="engineername" name="engineername"  >	
	<select class="form-control fav_clr" id="engineerid" name="engineerid" onchange="valchange('engineer')" >
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0' order by engineername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
	</div>

	<div id="engineercoor">
  <div class="form-group">
    <label for="engineername">Engineers Assigned</label>

	<input type="hidden" id="engineersname" name="engineersname">	
	<select class="form-control fav_clr" id="engineersid" name="engineersid[]" multiple onchange="valchanges('engineers')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0' order by engineername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>

  </div>
	</div>
   </div>
   
   
   
<div class="col-lg-3">
<div id="reportingengineertype">

  <div class="form-group">
    <label for="reportingengineername">Primary Engineer</label>
	<input type="hidden" id="reportingengineername" name="reportingengineername" >	
	<select class="form-control fav_clr" id="reportingengineerid" name="reportingengineerid" onchange="valchange('reportingengineer')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0' order by engineername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>
  </div>


</div>
</div>

<div class="col-lg-3">
	<div id="reportingengineereng">
<div class="form-group">
    <label for="reportingtype" class="text-primary">Reporting Type</label><br>
	<label class="mr-2"><input type="radio" name="reportingtype" id="reportingtypeone" value="0" onchange="checkreport()" checked> All in One Report </label>
	<label class="mr-2"><input type="radio" name="reportingtype" id="reportingtypeindividual" value="1" onchange="checkreport()"> Invidual Report </label>
  </div>
	</div>
	
</div>	

<?php
}
else
{
	?>
	<input type="hidden" name="engineerid" id="engineerid" value="">
	<input type="hidden" name="engineername" id="engineername" value="">
	
	<input type="hidden" name="engineersid[]" id="engineersid" value="">
	<input type="hidden" name="engineersname" id="engineersname" value="">
	
	<input type="hidden" name="reportingtype" id="reportingtype" value="0">
	
	<input type="hidden" name="reportingengineerid" id="reportingengineerid" value="">
	<input type="hidden" name="reportingengineername" id="reportingengineername" value="">
	
	<?php
}
?>
	</div>
<hr>
   <div class="row">
<?php
if($infolayoutcall['customersms']=='1')
{
?>
<div class="col-lg-12">
<div class="form-group">
<label><input type="checkbox" name="customersms" id="customersms" > SEND TO CUSTOMER </label> |
<?php
}
if($infolayoutcall['coordinatorsms']=='1')
{
?>
<input type="hidden" name="callhandledsms" id="callhandledsms">
<label><input type="checkbox" name="coordinatorsms" id="coordinatorsms"> SEND TO CO-ORDINATOR </label> |
<?php
}
if($infolayoutcall['engineersms']=='1')
{
?>
<label><input type="checkbox" name="engineersms" id="engineersms" > SEND TO ENGINEER </label>
</div>
</div>
<?php
}
?>
<div class="col-lg-12">
<div class="form-group">
<?php
if($infolayoutcall['sms']=='1')
{
?>
<label><input type="checkbox" name="customerwa" id="customerwa" checked > SMS <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a SMS Package to Send SMS to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label> |
<?php
}
if($infolayoutcall['whatsapp']=='1')
{
	?>
<input type="hidden" name="callhandledwa" id="callhandledwa">
<label><input type="checkbox" name="coordinatorwa" id="coordinatorwa" checked> WHATSAPP <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a WHATSAPP API Package to Send WHATSAPP to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label> |
<?php
}
if($infolayoutcall['mail']=='1')
{
?>
<label><input type="checkbox" name="engineerwa" id="engineerwa" checked > MAIL </label>
</div>
</div>
<hr>
<?php
}
?>
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
       source: 'consigneesearch.php?type=consigneename', minLength: 3
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
<!--call nature model-->
</body>
</html>
