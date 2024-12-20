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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Invoice Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/datatables/buttons.datatables.min.css">  
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
          <?php //include('salesnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Invoice Details</b></h1>
  </div>
  <div class="col-auto">
    <a href="invoiceadd.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Add New Invoice</a>
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
              <h6 class="m-0 font-weight-bold text-primary">Invoice Details</h6>
            </div>-->
            <div class="card-body">
			<?php
	$sqlselect = "SELECT * From jrcxl order by id desc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			while( $row = mysqli_fetch_assoc( $queryselect)){
    $new_array[] = $row; // Inside while loop
}}
	?>
			
			
			<form action="" method="post" onsubmit="return checkvalidate()">
<div class="row">
 <?php
if($infolayoutinvoice['invoiceno']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="invoiceno">Invoice No </label>
	<select class="fav_clr form-control" name="invoiceno[]" id="invoiceno" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['invoiceno']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['invoiceno']))&&(in_array($urep, $_POST['invoiceno'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutinvoice['invoicedate']=='1')
{
?>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="datefrom">Invoice Date From</label>
    <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="Invoice Date From" value="<?=(isset($_POST['datefrom']))?$_POST['datefrom']:''?>" >
  </div>
</div>
 <?php
}
if($infolayoutinvoice['invoicedate']=='1')
{
?>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="dateto">Invoice Date To</label>
    <input type="date" class="form-control" id="dateto" name="dateto" placeholder="Invoice Date To" value="<?=(isset($_POST['dateto']))?$_POST['dateto']:''?>">
  </div>
</div>
 <?php
}
if($infolayoutcustomers['maincategory']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="maincategory">Main Category </label>
	<select class="fav_clr form-control" name="maincategory[]" id="maincategory" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['maincategory']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['maincategory']))&&(in_array($urep, $_POST['maincategory'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="subcategory">Sub Category </label>
	<select class="fav_clr form-control" name="subcategory[]" id="subcategory" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['subcategory']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['subcategory']))&&(in_array($urep, $_POST['subcategory'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="consigneename">Customer Name </label>
	<select class="fav_clr form-control" name="consigneename[]" id="consigneename" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['consigneename']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['consigneename']))&&(in_array($urep, $_POST['consigneename'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutcustomers['department']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="department">Department </label>
	<select class="fav_clr form-control" name="department[]" id="department" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['department']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['department']))&&(in_array($urep, $_POST['department'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="address1">Address 1</label>
	<select class="fav_clr form-control" name="address1[]" id="address1" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['address1']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['address1']))&&(in_array($urep, $_POST['address1'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutcustomers['area']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="area">Area </label>
	<select class="fav_clr form-control" name="area[]" id="area" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['area']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['area']))&&(in_array($urep, $_POST['area'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutcustomers['district']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District </label>
	<select class="fav_clr form-control" name="district[]" id="district" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['district']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['district']))&&(in_array($urep, $_POST['district'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutcustomers['pincode']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="pincode">Pin Code </label>
	<select class="fav_clr form-control" name="pincode[]" id="pincode" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['pincode']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['pincode']))&&(in_array($urep, $_POST['pincode'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="stockmaincategory">Stock Main Category </label>
	<select class="fav_clr form-control" name="stockmaincategory[]" id="stockmaincategory" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stockmaincategory']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['stockmaincategory']))&&(in_array($urep, $_POST['stockmaincategory'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="stocksubcategory">Stock Sub Category </label>
	<select class="fav_clr form-control" name="stocksubcategory[]" id="stocksubcategory" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stocksubcategory']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['stocksubcategory']))&&(in_array($urep, $_POST['stocksubcategory'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="stockitem">Product Name </label>
	<select class="fav_clr form-control" name="stockitem[]" id="stockitem" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stockitem']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['stockitem']))&&(in_array($urep, $_POST['stockitem'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
 <?php
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="typeofproduct">Type of Product </label>
	<select class="fav_clr form-control" name="typeofproduct[]" id="typeofproduct" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['typeofproduct']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['typeofproduct']))&&(in_array($urep, $_POST['typeofproduct'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	
	</select>
  </div>
</div>
 <?php
}

if($infolayoutproducts['componenttype']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="componenttype">Component Type </label>
	<select class="fav_clr form-control" name="componenttype[]" id="componenttype" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['componenttype']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['componenttype']))&&(in_array($urep, $_POST['componenttype'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	
	</select>
  </div>
</div>
 <?php
}

if($infolayoutproducts['componentname']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="componentname">Component Name </label>
	<select class="fav_clr form-control" name="componentname[]" id="componentname" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['componentname']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['componentname']))&&(in_array($urep, $_POST['componentname'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	
	</select>
  </div>
</div>
 <?php
}

if($infolayoutinvoice['serialnumber']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="serialnumber">Serial Number </label>
	<input type="text" class="form-control" id="serialnumber" name="serialnumber" <?=(isset($_POST['serialnumber']))?$_POST['serialnumber']:''?> >
  </div>
</div>
 <?php
}
?>
 </div>
 <div class="row">
<div class="col-lg-6">
  <label><b>Type of Results</b> <input type="checkbox" id="ckbCheckAll" /> Select All </label>
  </div>
  </div>
   <div class="row">
<?php
if($infolayoutinvoice['invoiceno']=='1')
{
?>	
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="invoiceno" <?=((isset($_POST['results']))&&(in_array("invoiceno", $_POST['results'])))?'checked':''?>> Invoice No.</label></div>
<?php
}
if($infolayoutinvoice['invoicedate']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="invoicedate" <?=((isset($_POST['results']))&&(in_array("invoicedate", $_POST['results'])))?'checked':''?>> Invoice Date</label></div>
<?php
}
if($infolayoutinvoice['tenderno']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="tenderno" <?=((isset($_POST['results']))&&(in_array("tenderno", $_POST['results'])))?'checked':''?>> Tender No.</label></div>
<?php
}


if($infolayoutinvoice['claimsubon']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="claimsubon" <?=((isset($_POST['results']))&&(in_array("claimsubon", $_POST['results'])))?'checked':''?>> Invoice Submitted On </label></div>
<?php
}
if($infolayoutinvoice['claimper']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="claimper" <?=((isset($_POST['results']))&&(in_array("claimper", $_POST['results'])))?'checked':''?>> Claim %</label></div>
<?php
}
if($infolayoutinvoice['claimamt']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="claimamt" <?=((isset($_POST['results']))&&(in_array("claimamt", $_POST['results'])))?'checked':''?>> Claim Amount</label></div>
<?php
}
if($infolayoutinvoice['invoiceamt']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="invoiceamt" <?=((isset($_POST['results']))&&(in_array("claimamt", $_POST['results'])))?'checked':''?>> Invoice Amount</label></div>
<?php
}
if($infolayoutinvoice['installrefno']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="installrefno" <?=((isset($_POST['results']))&&(in_array("installrefno", $_POST['results'])))?'checked':''?>> Installation Ref.No</label></div>
<?php
}
if($infolayoutinvoice['suprefno']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="suprefno" <?=((isset($_POST['results']))&&(in_array("suprefno", $_POST['results'])))?'checked':''?>> Sup. Invoice / Ref.No</label></div>
<?php
}


if($infolayoutinvoice['pono']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="pono" <?=((isset($_POST['results']))&&(in_array("pono", $_POST['results'])))?'checked':''?>> Purchase Order No.</label></div>
<?php
}
if($infolayoutinvoice['podate']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="podate" <?=((isset($_POST['results']))&&(in_array("podate", $_POST['results'])))?'checked':''?>> PO Date</label></div>
<?php
}
if($infolayoutinvoice['dcno']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="dcno" <?=((isset($_POST['results']))&&(in_array("dcno", $_POST['results'])))?'checked':''?>> DC No.</label></div>
<?php
}
if($infolayoutinvoice['dcdate']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="dcdate" <?=((isset($_POST['results']))&&(in_array("dcdate", $_POST['results'])))?'checked':''?>> DC Date</label></div>
<?php
}
if($infolayoutinvoice['installedon']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="installedon" <?=((isset($_POST['results']))&&(in_array("installedon", $_POST['results'])))?'checked':''?>> Installed On</label></div>
<?php
}
if($infolayoutinvoice['installedby']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="installedby" <?=((isset($_POST['results']))&&(in_array("installedby", $_POST['results'])))?'checked':''?>> Installed By</label></div>
<?php
}
if($infolayoutcustomers['maincategory']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="maincategory" <?=((isset($_POST['results']))&&(in_array("maincategory", $_POST['results'])))?'checked':''?>> Main Category</label></div>
<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="subcategory" <?=((isset($_POST['results']))&&(in_array("subcategory", $_POST['results'])))?'checked':''?>> Sub Category</label></div>
<?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="consigneename" <?=((isset($_POST['results']))&&(in_array("consigneename", $_POST['results'])))?'checked':''?>> Customer Name</label></div>
<?php
}
if($infolayoutcustomers['department']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="department" <?=((isset($_POST['results']))&&(in_array("department", $_POST['results'])))?'checked':''?>> Department</label></div>
<?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="address1" <?=((isset($_POST['results']))&&(in_array("address1", $_POST['results'])))?'checked':''?>> Address 1</label></div>
<?php
}
if($infolayoutcustomers['address2']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="address2" <?=((isset($_POST['results']))&&(in_array("address2", $_POST['results'])))?'checked':''?>> Address 2</label></div>
<?php
}
if($infolayoutcustomers['area']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="area" <?=((isset($_POST['results']))&&(in_array("area", $_POST['results'])))?'checked':''?>> Area</label></div>
<?php
}
if($infolayoutcustomers['district']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="district" <?=((isset($_POST['results']))&&(in_array("district", $_POST['results'])))?'checked':''?>> District</label></div>
<?php
}
if($infolayoutcustomers['pincode']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="pincode" <?=((isset($_POST['results']))&&(in_array("pincode", $_POST['results'])))?'checked':''?>> Pin Code</label></div>
<?php
}
if($infolayoutcustomers['contact']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="contact" <?=((isset($_POST['results']))&&(in_array("contact", $_POST['results'])))?'checked':''?>> Contact</label></div>
<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="phone" <?=((isset($_POST['results']))&&(in_array("phone", $_POST['results'])))?'checked':''?>> Phone</label></div>
<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="mobile" <?=((isset($_POST['results']))&&(in_array("mobile", $_POST['results'])))?'checked':''?>> Mobile</label></div>
<?php
}
if($infolayoutcustomers['email']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="email" <?=((isset($_POST['results']))&&(in_array("email", $_POST['results'])))?'checked':''?>> Email</label></div>
<?php
}
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="stockmaincategory" <?=((isset($_POST['results']))&&(in_array("stockmaincategory", $_POST['results'])))?'checked':''?>> Main Category</label></div>
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="stocksubcategory" <?=((isset($_POST['results']))&&(in_array("stocksubcategory", $_POST['results'])))?'checked':''?>> Sub Category</label></div>
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="stockitem" <?=((isset($_POST['results']))&&(in_array("stockitem", $_POST['results'])))?'checked':''?>> Product Name</label></div>
<?php
}
if($infolayoutinvoice['invoicedqty']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="invoicedqty" <?=((isset($_POST['results']))&&(in_array("invoicedqty", $_POST['results'])))?'checked':''?>> Invoiced Qty</label></div>
<?php
}
if($infolayoutinvoice['overallwarranty']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="overallwarranty" <?=((isset($_POST['results']))&&(in_array("overallwarranty", $_POST['results'])))?'checked':''?>> Overall Warranty</label></div>
<?php
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="typeofproduct" <?=((isset($_POST['results']))&&(in_array("typeofproduct", $_POST['results'])))?'checked':''?>> Type of Product</label></div>
<?php
}
if($infolayoutproducts['componenttype']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="componenttype" <?=((isset($_POST['results']))&&(in_array("componenttype", $_POST['results'])))?'checked':''?>> Component Type</label></div>
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="componentname" <?=((isset($_POST['results']))&&(in_array("componentname", $_POST['results'])))?'checked':''?>> Component Name</label></div>
<?php
}
if($infolayoutproducts['make']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="make" <?=((isset($_POST['results']))&&(in_array("make", $_POST['results'])))?'checked':''?>> Make</label></div>
<?php
}
if($infolayoutproducts['capacity']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="capacity" <?=((isset($_POST['results']))&&(in_array("capacity", $_POST['results'])))?'checked':''?>> Capacity</label></div>
<?php
}
if($infolayoutinvoice['warranty']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="warranty" <?=((isset($_POST['results']))&&(in_array("warranty", $_POST['results'])))?'checked':''?>> Warranty</label></div>
<?php
}
if($infolayoutinvoice['qty']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="qty" <?=((isset($_POST['results']))&&(in_array("qty", $_POST['results'])))?'checked':''?>> Qty</label></div>
<?php
}
if($infolayoutinvoice['serialnumber']=='1')
{
?>
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="serialnumber" <?=((isset($_POST['results']))&&(in_array("serialnumber", $_POST['results'])))?'checked':''?>> Serial Numbers</label></div>
<?php
}
?>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyername" <?=((isset($_POST['results']))&&(in_array("buyername", $_POST['results'])))?'checked':''?>> Buyer Name</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyerdepartment" <?=((isset($_POST['results']))&&(in_array("buyerdepartment", $_POST['results'])))?'checked':''?>> Buyer Department</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyeraddress1" <?=((isset($_POST['results']))&&(in_array("buyeraddress1", $_POST['results'])))?'checked':''?>> Buyer Address1</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyeraddress2" <?=((isset($_POST['results']))&&(in_array("buyeraddress2", $_POST['results'])))?'checked':''?>> Buyer Address2</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyerarea" <?=((isset($_POST['results']))&&(in_array("buyerarea", $_POST['results'])))?'checked':''?>> Buyer Area</label></div>
 
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyerdistrict" <?=((isset($_POST['results']))&&(in_array("buyerdistrict", $_POST['results'])))?'checked':''?>> Buyer District</label></div>
 
<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyerstate" <?=((isset($_POST['results']))&&(in_array("buyerstate", $_POST['results'])))?'checked':''?>> Buyer State</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyerpincode" <?=((isset($_POST['results']))&&(in_array("buyerpincode", $_POST['results'])))?'checked':''?>> Buyer Pin Code</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyercontact" <?=((isset($_POST['results']))&&(in_array("buyercontact", $_POST['results'])))?'checked':''?>> Buyer Contact</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyerphone" <?=((isset($_POST['results']))&&(in_array("buyerphone", $_POST['results'])))?'checked':''?>> Buyer Phone</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="buyermobile" <?=((isset($_POST['results']))&&(in_array("buyermobile", $_POST['results'])))?'checked':''?>> Buyer Mobile</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="type" <?=((isset($_POST['results']))&&(in_array("type", $_POST['results'])))?'checked':''?>> Type</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="unit" <?=((isset($_POST['results']))&&(in_array("unit", $_POST['results'])))?'checked':''?>> Unit </label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="exemption" <?=((isset($_POST['results']))&&(in_array("exemption", $_POST['results'])))?'checked':''?>> Exemption</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="rate" <?=((isset($_POST['results']))&&(in_array("rate", $_POST['results'])))?'checked':''?>> Rate</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="igstamount" <?=((isset($_POST['results']))&&(in_array("igstamount", $_POST['results'])))?'checked':''?>> IGST Amount</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="cgstamount" <?=((isset($_POST['results']))&&(in_array("cgstamount", $_POST['results'])))?'checked':''?>> CGST Amount</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="sgstamount" <?=((isset($_POST['results']))&&(in_array("sgstamount", $_POST['results'])))?'checked':''?>> SGST Amount</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="totalamount" <?=((isset($_POST['results']))&&(in_array("totalamount", $_POST['results'])))?'checked':''?>> Total Amount</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="discount" <?=((isset($_POST['results']))&&(in_array("discount", $_POST['results'])))?'checked':''?>> Discount</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="departments" <?=((isset($_POST['results']))&&(in_array("departments", $_POST['results'])))?'checked':''?>> Departments</label></div>

<div class="col-lg-2"><label><input type="checkbox" class="checkBoxClass"  name="results[]" id="result" value="serialqty" <?=((isset($_POST['results']))&&(in_array("serialqty", $_POST['results'])))?'checked':''?>> Serial Qty</label></div>

  </div>
<?php
	if($secsystem=='1')
	{
	?>
  <hr>
  <div class="alert alert-info">To View Invoice Details you must validate yourself by enter your Password</div>
  <div class="row">
  <div class="col-lg-3">
  <div class="form-group">

    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
	</div>
</div>
  </div>
  <?php
	}
	?>
  
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

<?php
if(isset($_POST['submit']))
{
$permit="";	
if(isset($_POST['password']))	
{
	$password=mysqli_real_escape_string($connection, $_POST['password']);
	if($password!='')
	{
		$sqlcon = "SELECT id From jrcadminuser WHERE username='".$_SESSION['email']."' and password='".$password."'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{
			$permit="yes";
		}
		else
		{
			?><br>
			<div class="alert alert-danger shadow">Sorry! Your Password is Wrong! You unable to view this Details</div>
			<?php
		}
	}
}
else
{
	$permit="yes";
}
if($permit=="yes")
{	
$staqu="";
				if(($_POST['datefrom'])&&($_POST['dateto']))
				{
					if($staqu!="")
					{
						$staqu.=" and invoicedate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
					else
					{
						$staqu.=" where invoicedate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
				}
			if(isset($_POST['invoiceno']))
			{
				$subquer="";
				foreach($_POST['invoiceno'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="invoiceno='".$repp."'";
					}
					else
						{
						$subquer.=" or invoiceno='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}	
			if(isset($_POST['maincategory']))
			{
				$subquer="";
				foreach($_POST['maincategory'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="maincategory='".$repp."'";
					}
					else
						{
						$subquer.=" or maincategory='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['subcategory']))
			{
				$subquer="";
				foreach($_POST['subcategory'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="subcategory='".$repp."'";
					}
					else
						{
						$subquer.=" or subcategory='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['consigneename']))
			{
				$subquer="";
				foreach($_POST['consigneename'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="consigneename='".$repp."'";
					}
					else
						{
						$subquer.=" or consigneename='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
if(isset($_POST['department']))
			{
				$subquer="";
				foreach($_POST['department'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="department='".$repp."'";
					}
					else
						{
						$subquer.=" or department='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['area']))
			{
				$subquer="";
				foreach($_POST['area'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="area='".$repp."'";
					}
					else
						{
						$subquer.=" or area='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['district']))
			{
				$subquer="";
				foreach($_POST['district'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="district='".$repp."'";
					}
					else
						{
						$subquer.=" or district='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['pincode']))
			{
				$subquer="";
				foreach($_POST['pincode'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="pincode='".$repp."'";
					}
					else
						{
						$subquer.=" or pincode='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['stockmaincategory']))
			{
				$subquer="";
				foreach($_POST['stockmaincategory'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="stockmaincategory='".$repp."'";
					}
					else
						{
						$subquer.=" or stockmaincategory='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['stocksubcategory']))
			{
				$subquer="";
				foreach($_POST['stocksubcategory'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="stocksubcategory='".$repp."'";
					}
					else
						{
						$subquer.=" or stocksubcategory='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['stockitem']))
			{
				$subquer="";
				foreach($_POST['stockitem'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="stockitem='".$repp."'";
					}
					else
						{
						$subquer.=" or stockitem='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['typeofproduct']))
			{
				$subquer="";
				foreach($_POST['typeofproduct'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="typeofproduct='".$repp."'";
					}
					else
						{
						$subquer.=" or typeofproduct='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			
			if(isset($_POST['componenttype']))
			{
				$subquer="";
				foreach($_POST['componenttype'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="componenttype='".$repp."'";
					}
					else
						{
						$subquer.=" or componenttype='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			
			
			if(isset($_POST['componentname']))
			{
				$subquer="";
				foreach($_POST['componentname'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="componentname='".$repp."'";
					}
					else
						{
						$subquer.=" or componentname='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			
			
			
			if(isset($_POST['serialnumber']))
			{
				if($staqu!="")
				{
					$staqu.=" and (lower(serialnumber) like '%".$_POST['serialnumber']."%')";
				}
				else
				{
					$staqu.=" where (lower(serialnumber) like '%".$_POST['serialnumber']."%')";
				}
			}
			
		
?>	
<br>
 <div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
		  <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  
<?php
$c=0;
?>
<?php if(in_array("invoiceno", $_POST['results'])){?><th>Invoice No.</th><?php $c++;} ?>
<?php if(in_array("invoicedate", $_POST['results'])){?><th>Invoice Date</th><?php $c++;} ?>
<?php if(in_array("tenderno", $_POST['results'])){?><th>Tender No.</th><?php $c++;} ?>

<?php if(in_array("claimsubon", $_POST['results'])){?><th> Claim Submitted On</th><?php $c++;} ?>
<?php if(in_array("claimper", $_POST['results'])){?><th>Claim %</th><?php $c++;} ?>
<?php if(in_array("claimamt", $_POST['results'])){?><th>Claim Amount</th><?php $c++;} ?>
<?php if(in_array("installrefno", $_POST['results'])){?><th>Installation Ref.No</th><?php $c++;} ?>
<?php if(in_array("suprefno", $_POST['results'])){?><th>Supplier Invoice / Ref.No</th><?php $c++;} ?>

<?php if(in_array("pono", $_POST['results'])){?><th>Purchase Order No.</th><?php $c++;} ?>
<?php if(in_array("podate", $_POST['results'])){?><th>PO Date</th><?php $c++;} ?>
<?php if(in_array("dcno", $_POST['results'])){?><th>DC No.</th><?php $c++;} ?>
<?php if(in_array("dcdate", $_POST['results'])){?><th>DC Date</th><?php $c++;} ?>
<?php if(in_array("installedon", $_POST['results'])){?><th>Installed On</th><?php $c++;} ?>
<?php if(in_array("installedby", $_POST['results'])){?><th>Installed By</th><?php $c++;} ?>
<?php if(in_array("maincategory", $_POST['results'])){?><th>Main Category</th><?php $c++;} ?>
<?php if(in_array("subcategory", $_POST['results'])){?><th>Sub Category</th><?php $c++;} ?>
<?php if(in_array("consigneename", $_POST['results'])){?><th>Customer Name(Unique)</th><?php $c++;} ?>
<?php if(in_array("department", $_POST['results'])){?><th>Department</th><?php $c++;} ?>
<?php if(in_array("address1", $_POST['results'])){?><th>Address 1</th><?php $c++;} ?>
<?php if(in_array("address2", $_POST['results'])){?><th>Address 2</th><?php $c++;} ?>
<?php if(in_array("area", $_POST['results'])){?><th>Area</th><?php $c++;} ?>
<?php if(in_array("district", $_POST['results'])){?><th>District</th><?php $c++;} ?>
<?php if(in_array("pincode", $_POST['results'])){?><th>Pin Code</th><?php $c++;} ?>
<?php if(in_array("contact", $_POST['results'])){?><th>Contact</th><?php $c++;} ?>
<?php if(in_array("phone", $_POST['results'])){?><th>Phone</th><?php $c++;} ?>
<?php if(in_array("mobile", $_POST['results'])){?><th>Mobile</th><?php $c++;} ?>
<?php if(in_array("email", $_POST['results'])){?><th>Email</th><?php $c++;} ?>
<?php if(in_array("stockmaincategory", $_POST['results'])){?><th>Main Category</th><?php $c++;} ?>
<?php if(in_array("stocksubcategory", $_POST['results'])){?><th>Sub Category</th><?php $c++;} ?>
<?php if(in_array("stockitem", $_POST['results'])){?><th>Product Name</th><?php $c++;} ?>
<?php if(in_array("invoicedqty", $_POST['results'])){?><th>Invoiced Qty</th><?php $c++;} ?>
<?php if(in_array("overallwarranty", $_POST['results'])){?><th>Overall Warranty Months</th><?php $c++;} ?>
<?php if(in_array("typeofproduct", $_POST['results'])){?><th>Type of Product</th><?php $c++;} ?>
<?php if(in_array("componenttype", $_POST['results'])){?><th>Component Type</th><?php $c++;} ?>
<?php if(in_array("componentname", $_POST['results'])){?><th>Component Name</th><?php $c++;} ?>
<?php if(in_array("make", $_POST['results'])){?><th>Make</th><?php $c++;} ?>
<?php if(in_array("capacity", $_POST['results'])){?><th>Capacity</th><?php $c++;} ?>
<?php if(in_array("warranty", $_POST['results'])){?><th>Warranty</th><?php $c++;} ?>
<?php if(in_array("qty", $_POST['results'])){?><th>Qty</th><?php $c++;} ?>
<?php if(in_array("serialnumber", $_POST['results'])){?><th>Serial Numbers</th><?php $c++;} ?>
<?php if(in_array("buyername", $_POST['results'])){?><th>Buyer Name</th><?php $c++;} ?>
<?php if(in_array("buyerdepartment", $_POST['results'])){?><th>Buyer Department</th><?php $c++;} ?>
<?php if(in_array("buyeraddress1", $_POST['results'])){?><th>Buyer Address1</th><?php $c++;} ?>
<?php if(in_array("buyeraddress2", $_POST['results'])){?><th>Buyer Address2</th><?php $c++;} ?>
<?php if(in_array("buyerarea", $_POST['results'])){?><th>Buyer Area</th><?php $c++;} ?>
<?php if(in_array("buyerdistrict", $_POST['results'])){?><th>Buyer District</th><?php $c++;} ?>
<?php if(in_array("buyerstate", $_POST['results'])){?><th>Buyer State</th><?php $c++;} ?>
<?php if(in_array("buyerpincode", $_POST['results'])){?><th>Buyer Pin Code</th><?php $c++;} ?>
<?php if(in_array("buyercontact", $_POST['results'])){?><th>Buyer Contact</th><?php $c++;} ?>
<?php if(in_array("buyerphone", $_POST['results'])){?><th>Buyer Phone</th><?php $c++;} ?>
<?php if(in_array("buyermobile", $_POST['results'])){?><th>Buyer Mobile</th><?php $c++;} ?>
<?php if(in_array("type", $_POST['results'])){?><th>Type</th><?php $c++;} ?>
<?php if(in_array("unit", $_POST['results'])){?><th>Unit</th><?php $c++;} ?>
<?php if(in_array("exemption", $_POST['results'])){?><th>Exemption</th><?php $c++;} ?>
<?php if(in_array("rate", $_POST['results'])){?><th>Rate</th><?php $c++;} ?>
<?php if(in_array("igstamount", $_POST['results'])){?><th>IGST Amount</th><?php $c++;} ?>
<?php if(in_array("cgstamount", $_POST['results'])){?><th>CGST Amount</th><?php $c++;} ?>
<?php if(in_array("sgstamount", $_POST['results'])){?><th>SGST Amount</th><?php $c++;} ?>
<?php if(in_array("totalamount", $_POST['results'])){?><th>Total Amount</th><?php $c++;} ?>
<?php if(in_array("discount", $_POST['results'])){?><th>Discount</th><?php $c++;} ?>
<?php if(in_array("departments", $_POST['results'])){?><th>Departments</th><?php $c++;} ?>
<?php if(in_array("serialqty", $_POST['results'])){?><th>Serial Qty</th><?php $c++;} ?>

					  <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $sqlselect = "SELECT id, invoiceno, invoicedate, tenderno, claimsubon, claimper, installrefno, suprefno, pono, podate, dcno, dcdate, installedon, installedby, maincategory, subcategory, consigneename, consigneeid, consigneename, department ,address1, address2, area, district, pincode, contact, phone, mobile, email, stockmaincategory, stocksubcategory, stockitem, invoicedqty, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, warranty, qty, serialnumber, buyername, buyerdepartment, buyeraddress1, buyeraddress2, buyerarea, buyerdistrict, buyerstate, buyerpincode, buyercontact, buyerphone, buyermobile, type, unit, exemption, rate, igstamount, cgstamount, sgstamount, totalamount, discount, departments, serialqty From jrcxl ".$staqu." group by invoiceno, invoicedate order by consigneename asc";
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
                      <td><?=$count?></td>
					  <?php if(in_array("invoiceno", $_POST['results'])){?><td><?=$rowselect['invoiceno']?></td><?php } ?>
<?php if(in_array("invoicedate", $_POST['results'])){?><td><?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?></td><?php } ?>
<?php if(in_array("tenderno", $_POST['results'])){?><td><?=$rowselect['tenderno']?></td><?php } ?>
<?php if(in_array("claimsubon", $_POST['results'])){?><td><?=$rowselect['claimsubon']?></td><?php } ?>
<?php if(in_array("claimper", $_POST['results'])){?><td><?=$rowselect['claimper']?></td><?php } ?>
<?php if(in_array("claimamt", $_POST['results'])){?><td><?=$rowselect['claimper']?></td><?php } ?>
<?php if(in_array("installrefno", $_POST['results'])){?><td><?=$rowselect['installrefno']?></td><?php } ?>
<?php if(in_array("suprefno", $_POST['results'])){?><td><?=$rowselect['suprefno']?></td><?php } ?>
<?php if(in_array("pono", $_POST['results'])){?><td><?=$rowselect['pono']?></td><?php } ?>
<?php if(in_array("podate", $_POST['results'])){?><td><?=$rowselect['podate']?></td><?php } ?>
<?php if(in_array("dcno", $_POST['results'])){?><td><?=$rowselect['dcno']?></td><?php } ?>
<?php if(in_array("dcdate", $_POST['results'])){?><td><?=$rowselect['dcdate']?></td><?php } ?>
<?php if(in_array("installedon", $_POST['results'])){?><td><?=$rowselect['installedon']?></td><?php } ?>
<?php if(in_array("installedby", $_POST['results'])){?><td><?=$rowselect['installedby']?></td><?php } ?>
<?php if(in_array("maincategory", $_POST['results'])){?><td><?=$rowselect['maincategory']?></td><?php } ?>
<?php if(in_array("subcategory", $_POST['results'])){?><td><?=$rowselect['subcategory']?></td><?php } ?>
<?php if(in_array("consigneename", $_POST['results'])){?><?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowselect['consigneename']?></a></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?><?php } ?>
<?php if(in_array("department", $_POST['results'])){?><td><?=$rowselect['department']?></td><?php } ?>
<?php if(in_array("address1", $_POST['results'])){?><td><?=$rowselect['address1']?></td><?php } ?>
<?php if(in_array("address2", $_POST['results'])){?><td><?=$rowselect['address2']?></td><?php } ?>
<?php if(in_array("area", $_POST['results'])){?><td><?=$rowselect['area']?></td><?php } ?>
<?php if(in_array("district", $_POST['results'])){?><td><?=$rowselect['district']?></td><?php } ?>
<?php if(in_array("pincode", $_POST['results'])){?><td><?=$rowselect['pincode']?></td><?php } ?>
<?php if(in_array("contact", $_POST['results'])){?><td><?=$rowselect['contact']?></td><?php } ?>
<?php if(in_array("phone", $_POST['results'])){?><td><?=$rowselect['phone']?></td><?php } ?>
<?php if(in_array("mobile", $_POST['results'])){?><td><?=$rowselect['mobile']?></td><?php } ?>
<?php if(in_array("email", $_POST['results'])){?><td><?=$rowselect['email']?></td><?php } ?>
<?php if(in_array("stockmaincategory", $_POST['results'])){?><td><?=$rowselect['stockmaincategory']?></td><?php } ?>
<?php if(in_array("stocksubcategory", $_POST['results'])){?><td><?=$rowselect['stocksubcategory']?></td><?php } ?>
<?php if(in_array("stockitem", $_POST['results'])){?><td><?=$rowselect['stockitem']?></td><?php } ?>
<?php if(in_array("invoicedqty", $_POST['results'])){?><td><?=$rowselect['invoicedqty']?></td><?php } ?>
<?php if(in_array("overallwarranty", $_POST['results'])){?><td><?=$rowselect['overallwarranty']?></td><?php } ?>
<?php if(in_array("typeofproduct", $_POST['results'])){?><td><?=$rowselect['typeofproduct']?></td><?php } ?>
<?php if(in_array("componenttype", $_POST['results'])){?><td><?=$rowselect['componenttype']?></td><?php } ?>
<?php if(in_array("componentname", $_POST['results'])){?><td><?=$rowselect['componentname']?></td><?php } ?>
<?php if(in_array("make", $_POST['results'])){?><td><?=$rowselect['make']?></td><?php } ?>
<?php if(in_array("capacity", $_POST['results'])){?><td><?=$rowselect['capacity']?></td><?php } ?>
<?php if(in_array("warranty", $_POST['results'])){?><td><?=$rowselect['warranty']?></td><?php } ?>
<?php if(in_array("qty", $_POST['results'])){?><td><?=$rowselect['qty']?></td><?php } ?>
<?php if(in_array("serialnumber", $_POST['results'])){?><td><?=$rowselect['serialnumber']?></td><?php } ?>
<?php if(in_array("buyername", $_POST['results'])){?><td><?=$rowselect['buyername']?></td><?php } ?>
<?php if(in_array("buyerdepartment", $_POST['results'])){?><td><?=$rowselect['buyerdepartment']?></td><?php } ?>
<?php if(in_array("buyeraddress1", $_POST['results'])){?><td><?=$rowselect['buyeraddress1']?></td><?php } ?>
<?php if(in_array("buyeraddress2", $_POST['results'])){?><td><?=$rowselect['buyeraddress2']?></td><?php } ?>
<?php if(in_array("buyerarea", $_POST['results'])){?><td><?=$rowselect['buyerarea']?></td><?php } ?>
<?php if(in_array("buyerdistrict", $_POST['results'])){?><td><?=$rowselect['buyerdistrict']?></td><?php } ?>
<?php if(in_array("buyerstate", $_POST['results'])){?><td><?=$rowselect['buyerstate']?></td><?php } ?>
<?php if(in_array("buyerpincode", $_POST['results'])){?><td><?=$rowselect['buyerpincode']?></td><?php } ?>
<?php if(in_array("buyercontact", $_POST['results'])){?><td><?=$rowselect['buyercontact']?></td><?php } ?>
<?php if(in_array("buyerphone", $_POST['results'])){?><td><?=$rowselect['buyerphone']?></td><?php } ?>
<?php if(in_array("buyermobile", $_POST['results'])){?><td><?=$rowselect['buyermobile']?></td><?php } ?>
<?php if(in_array("type", $_POST['results'])){?><td><?=$rowselect['type']?></td><?php } ?>
<?php if(in_array("unit", $_POST['results'])){?><td><?=$rowselect['unit']?></td><?php } ?>
<?php if(in_array("exemption", $_POST['results'])){?><td><?=$rowselect['exemption']?></td><?php } ?>
<?php if(in_array("rate", $_POST['results'])){?><td><?=$rowselect['rate']?></td><?php } ?>
<?php if(in_array("igstamount", $_POST['results'])){?><td><?=$rowselect['igstamount']?></td><?php } ?>
<?php if(in_array("cgstamount", $_POST['results'])){?><td><?=$rowselect['cgstamount']?></td><?php } ?>
<?php if(in_array("sgstamount", $_POST['results'])){?><td><?=$rowselect['sgstamount']?></td><?php } ?>
<?php if(in_array("totalamount", $_POST['results'])){?><td><?=$rowselect['totalamount']?></td><?php } ?>
<?php if(in_array("discount", $_POST['results'])){?><td><?=$rowselect['discount']?></td><?php } ?>
<?php if(in_array("departments", $_POST['results'])){?><td><?=$rowselect['departments']?></td><?php } ?>
<?php if(in_array("serialqty", $_POST['results'])){?><td><?=$rowselect['serialqty']?></td><?php } ?>

					  
				  <td><a href="invoiceedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
                    </tr>
					<?php
					$count++;
			}
		}
			?>
					
                  </tbody>
                </table>
              </div>
			  <?php
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
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
  <!--<script src="../../1637028036/js/datatables.js"></script> Page level custom scripts -->
  
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>	
<script type="text/javascript">
 $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "paging": false,
                "processing": true,
                dom: 'Blfrtip',
				<?php
				if($exportinvoice=='1')
				{
				?>	
				buttons: [
			   {
				   extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
				   orientation: 'landscape',
				   footer: true,
				   //messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
				   exportOptions: {
						columns: [0<?php if(isset($c)){for($i=1;$i<=$c;$i++){ echo ','.$i;}}?>]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: false,
				   exportOptions: {
						columns: [0<?php if(isset($c)){for($i=1;$i<=$c;$i++){ echo ','.$i;}}?>]
					}
			   } 
			   
			] 
<?php
				}
?>				
            });

        });


  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3, minLength: 3
     });
  });
  $(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
minimumInputLength: 3,
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
	var results=document.getElementsByName("results[]");
	var j=0;
	for(var i=0;i<results.length; i++)
	{
		if(results[i].checked==true)
		{
			j++;
		}
	}
	if(j==0)
	{
		alert("Please select Type of Results");
		return false;
	}
}
</script>
<script>
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
        }
    });
});
</script><?php include('additionaljs.php');   ?>
</body>
</html>