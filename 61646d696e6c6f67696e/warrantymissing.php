<?php
include('lcheck.php'); 

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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Warranty Missing Invoices</title>

  
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
          <?php include('datanavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Warranty Missing Invoices</b></h1>
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
              <h6 class="m-0 font-weight-bold text-primary">Warranty Missing Invoices</h6>
            </div>-->
            <div class="card-body">
			<?php
	$sqlselect = "SELECT * From jrcxl where (warrantycycle IS NULL  or  warrantycycle='') order by id desc";
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
			
			
			<form action="warrantymissing.php" method="post" onsubmit="return checkvalidate()">
<div class="row">
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
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="datefrom">Invoice Date From</label>
    <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="Invoice Date From" <?=(isset($_POST['datefrom']))?$_POST['datefrom']:''?> >
  </div>
</div>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="dateto">Invoice Date To</label>
    <input type="date" class="form-control" id="dateto" name="dateto" placeholder="Invoice Date To" <?=(isset($_POST['dateto']))?$_POST['dateto']:''?>>
  </div>
</div>
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
<div class="col-lg-3">
  <div class="form-group">
    <label for="serialnumber">Serial Number </label>
	<input type="text" class="form-control" id="serialnumber" name="serialnumber" <?=(isset($_POST['serialnumber']))?$_POST['serialnumber']:''?> >
  </div>
</div>
 </div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>
</div>
<?php
if(isset($_POST['submit']))
{
	
$staqu="where warranty='' ";
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
<div class="card shadow mb-4">
            <div class="card-body">
<form action="warrantymissings.php" method="post">
<div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
		  <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  
<?php
$c=0;
?>
<th>Invoice No.</th>
<th>Invoice Date</th>
<th>Customer Name(Unique)</th>
<th>Product Name</th>
<th>Warranty (In Months)</th>
                    </tr>
                  </thead>
                  <tbody>
		<?php
		$sqlselect = "SELECT id, invoiceno, installedon, invoicedate, consigneeid, consigneename, warranty, stockitem From jrcxl ".$staqu." group by invoiceno, invoicedate order by stockitem asc";
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
<td><?=$count?><input type="hidden" name="ids[]" value="<?=$rowselect['id']?>"><input type="hidden" name="installedon[]" value="<?=$rowselect['installedon']?>"><input type="hidden" name="invoicedate[]" value="<?=$rowselect['invoicedate']?>"></td>
<td><?=$rowselect['invoiceno']?></td>
<td><?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?></td>
<?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>" tabindex="-1"><?=$rowselect['consigneename']?></a></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>" tabindex="-1">View</a></td>
					  <?php
					  }
					  ?>
					  <td><?=$rowselect['stockitem']?></td>					  
				  <td><input type="number" max="120" name="warranty[]" id="warranty" value="<?=trim($rowselect['warranty'])?>" class="form-control"></td>
                    </tr>
					<?php
					$count++;
			}
		}
			?>
					
                  </tbody>
				  <tfoot>
				  <tr>
				  <td colspan="6"><input type="submit" name="warrantysubmit" id="submit" value="Submit" class="btn btn-primary"></td>
				  </tr>
				  </tfoot>
                </table>
              </div>
			  </form>
			  <?php
}
?>
            </div>
          </div>

       
       

       
      <?php include('footer.php'); ?>
       
 </div>
         

      </div>
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
	
}
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>