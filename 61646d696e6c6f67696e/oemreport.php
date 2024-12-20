<?php
include('lcheck.php'); 

if($exportreport=='0')
{
	header("Location: dashboard.php");
}
if($liveplan=='DIAMOND')
{
	
}
else
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Carry-In Report</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/datatables/buttons.datatables.min.css">  
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">  
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">
	  <?php include('navbar.php');?>
          <?php include('inhousenavbar.php');?>
        <div class="container-fluid">

          <!-- Page Heading -->

		  
		    <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Carry-In Report</b></h1>
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
$statitle="";
$staqu="where ((servicetype='Carry-In'))";
if(isset($_GET['status']))
{
	if($_GET['status']=='2')
					  {
						$statitle=" - Completed";
						$staqu=" where compstatus='2'";
					  }
					  else if($_GET['status']=='1')
					  {
						$statitle=" - Pending";
						$staqu=" where compstatus='1'";
					  }
					  else if($_GET['status']=='3')
					  {
						$statitle=" - Cancelled";
						$staqu=" where compstatus='3'";
					  }
					  else
					 {
						$statitle=" - Open";
						$staqu=" where compstatus='0'";
						
					  }
}
if(isset($_GET['cn']))
{
	$cn=mysqli_real_escape_string($connection,$_GET['cn']);
	if($cn!='')
	{
		$statitle.=" - ".$cn." Calls";
		if($staqu!='')
		{
			$staqu=" and callnature='$cn'";
		}
		else
		{
			$staqu=" where callnature='$cn'";
		}
	}
}
?>
<?php
$excelids="";
	 $sqlselect = "SELECT * From jrccalls ".$staqu." order by id desc";
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
if(!empty($new_array))
{
foreach($new_array as $ids)
{
	$sourceid=$ids['sourceid'];
	if($excelids!="")
	{
		$excelids.=",".$sourceid;
	}
	else
	{
		$excelids.="".$sourceid;
	}
}
	?>
<?php
	 $sqlexcel = "SELECT * From jrcxl where id in (".$excelids.") order by id desc";
		$queryexcel = mysqli_query($connection, $sqlexcel);
        $rowCountexcel = mysqli_num_rows($queryexcel);
         
        if(!$queryexcel){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountexcel > 0) 
		{
			while( $row = mysqli_fetch_assoc( $queryexcel)){
    $newexcel_array[] = $row; // Inside while loop <i class="fas fa-tag fa-fw text-purple me-2"></i> <i class="fas fa-mouse-pointer fa-fw text-green me-2"></i> <i class="fas fa-percentage fa-fw text-yellow me-2"></i> 
}}
	?>
	<div class="row">
	<div class="col-lg-12 mb-4">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
		  
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Calls Report <?=$statitle?></h6>
            </div>-->
            <div class="card-body font-13">
			<form action="" method="post">
<div class="row">
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="datefrom">Report From</label>
    <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="Report From" value="<?php /* if(isset($_POST['datefrom'])) { echo $_POST['datefrom']; }  */?>">
  </div>
</div>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="dateto">Report To</label>
    <input type="date" class="form-control" id="dateto" name="dateto" placeholder="Report To" value="<?php /* if(isset($_POST['dateto'])) { echo $_POST['dateto']; }  */?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="reportedproblem">Calls Status </label>
	<select class="fav_clr form-control" name="compstatus[]" id="compstatus" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['compstatus']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				if($urep=='0')
				{
					?>
				<option value="<?=$urep?>" <>Open</option>
				<?php
				}
				if($urep=='1')
				{
					?>
				<option value="<?=$urep?>" >Pending</option>
				<?php
				}
				if($urep=='2')
				{
					?>
				<option value="<?=$urep?>">Completed</option>
				<?php
				}
				if($urep=='3')
				{
					?>
				<option value="<?=$urep?>" >Cancelled</option>
				<?php
				}
				
			}
	}
	?>
	</select>
  </div>
</div>


<!--div class="col-lg-3">
  <div class="form-group">
    <label for="businesstype">Business Type</label>
	<select class="fav_clr form-control" name="businesstype[]" id="businesstype" multiple="multiple">
	<?php
	/* if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecalltype = array_unique(array_map(function ($i) { return $i['businesstype']; }, $new_array));
	sort($uniquecalltype);
			foreach($uniquecalltype as $urep) 
			{
				
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
				<?php
			}
	} */
	?>
	</select>
  </div>
</div-->



<div class="col-lg-3">
  <div class="form-group">
    <label for="godownname">Warehouse Name</label>
	<select class="fav_clr form-control" name="godownname[]" id="godownname" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecalltype = array_unique(array_map(function ($i) { return $i['godownname']; }, $new_array));
	sort($uniquecalltype);
			foreach($uniquecalltype as $urep) 
			{
				$sqlgo = "SELECT id, godownname From jrcgodown where id='".$urep."' order by id asc";
        $querygo = mysqli_query($connection, $sqlgo);
        $rowCountgo = mysqli_num_rows($querygo);
		$rowgo = mysqli_fetch_array($querygo);
		
				?>
				<option value="<?=$urep?>" ><?=$rowgo['godownname'];?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="suppliername">Supplier Name</label>
	<select class="fav_clr form-control" name="suppliername[]" id="suppliername" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecalltype = array_unique(array_map(function ($i) { return $i['suppliername']; }, $new_array));
	sort($uniquecalltype);
			foreach($uniquecalltype as $urep) 
			{
				$sqlgo = "SELECT id, suppliername From jrcsuppliers where id='".$urep."' order by id asc";
        $querygo = mysqli_query($connection, $sqlgo);
        $rowCountgo = mysqli_num_rows($querygo);
		$rowgo = mysqli_fetch_array($querygo);
		
				?>
				<option value="<?=$urep?>" ><?=$rowgo['suppliername'];?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>


<!--div class="col-lg-3">
  <div class="form-group">
    <label for="callnature">Call Nature</label>
	<select class="fav_clr form-control" name="callnature[]" id="callnature" multiple="multiple">
	<?php
	/* if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecalltype = array_unique(array_map(function ($i) { return $i['callnature']; }, $new_array));
	sort($uniquecalltype);
			foreach($uniquecalltype as $urep) 
			{
				
				
				<option value="<?=$urep?>" <?=((isset($_POST['callnature']))&&(in_array($urep, $_POST['callnature'])))?'selected':''?>><?=$urep?></option>
			
			}
	} */
	?>
	</select>
  </div>
</div-->

<div class="col-lg-3">
  <div class="form-group">
    <label for="customernature">Customer Nature</label>
	<select class="fav_clr form-control" name="customernature[]" id="customernature" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecalltype = array_unique(array_map(function ($i) { return $i['customernature']; }, $new_array));
	sort($uniquecalltype);
			foreach($uniquecalltype as $urep) 
			{
				
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="calltype">Call Type</label>
	<select class="fav_clr form-control" name="calltype[]" id="calltype" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecalltype = array_unique(array_map(function ($i) { return $i['calltype']; }, $new_array));
	sort($uniquecalltype);
			foreach($uniquecalltype as $urep) 
			{
				
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="calltid">Call ID</label>
	<select class="fav_clr form-control" name="calltid[]" id="calltid" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecalltid = array_unique(array_map(function ($i) { return $i['calltid']; }, $new_array));
	sort($uniquecalltid);
			foreach($uniquecalltid as $urep) 
			{
				
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
<!--div class="col-lg-3">
  <div class="form-group">
    <label for="callhandlingname">Call Handling </label>
	<select class="fav_clr form-control" name="callhandlingname[]" id="callhandlingname" multiple="multiple">
	<?php
	/*if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecallhandlingname = array_unique(array_map(function ($i) { return $i['callhandlingname']; }, $new_array));
	sort($uniquecallhandlingname);
			foreach($uniquecallhandlingname as $urep) 
			{
				
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['callhandlingname']))&&(in_array($urep, $_POST['callhandlingname'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}/*
	?>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="coordinatorname">Co-Ordinator </label>
	<select class="fav_clr form-control" name="coordinatorname[]" id="coordinatorname" multiple="multiple">
	<?php
	/*if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquecoordinatorname = array_unique(array_map(function ($i) { return $i['coordinatorname']; }, $new_array));
	sort($uniquecoordinatorname);
			foreach($uniquecoordinatorname as $urep) 
			{
				
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['coordinatorname']))&&(in_array($urep, $_POST['coordinatorname'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}*/
	?>
	</select>
  </div>
</div-->
<div class="col-lg-3">
  <div class="form-group">
    <label for="engineername">Engineer </label>
	<select class="fav_clr form-control" name="engineername[]" id="engineername" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniqueengineername = array_unique(array_map(function ($i) { return $i['engineername']; }, $new_array));
	sort($uniqueengineername);
			foreach($uniqueengineername as $urep) 
			{
				
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="reportedproblem">Problems Reported </label>
	<select class="fav_clr form-control" name="reportedproblem[]" id="reportedproblem" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['reportedproblem']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
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
<div class="col-lg-3">
  <div class="form-group">
    <label for="problemobserved">Problems Observed </label>
    <select class="fav_clr form-control" name="problemobserved[]" id="problemobserved" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
	$uniqueproblemobserved = array_unique(array_map(function ($i) { return $i['problemobserved']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniqueproblemobserved as $urep) 
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
<div class="col-lg-3">
  <div class="form-group">
    <label for="actiontaken">Action Taken </label>
    <select class="fav_clr form-control" name="actiontaken[]" id="actiontaken" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
	$uniqueactiontaken = array_unique(array_map(function ($i) { return $i['actiontaken']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniqueactiontaken as $urep) 
			{
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
<!--div class="col-lg-3">
  <div class="form-group">
    <label for="maincategory">Main Category </label>
	<select class="fav_clr form-control" name="maincategory[]" id="maincategory" multiple="multiple">
	<?php
	/*if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['maincategory']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['maincategory']))&&(in_array($urep, $_POST['maincategory'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}*/
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="subcategory">Sub Category </label>
	<select class="fav_clr form-control" name="subcategory[]" id="subcategory" multiple="multiple">
	<?php
	/*if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['subcategory']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['subcategory']))&&(in_array($urep, $_POST['subcategory'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}*/
	?>
	</select>
  </div>
</div-->
<div class="col-lg-3">
  <div class="form-group">
    <label for="consigneename">Customer Name </label>
	<select class="fav_clr form-control" name="consigneename[]" id="consigneename" multiple="multiple">
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['consigneename']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>
<!--div class="col-lg-3">
  <div class="form-group">
    <label for="department">Department </label>
	<select class="fav_clr form-control" name="department[]" id="department" multiple="multiple">
	<?php
	/*if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['department']; }, $newexcel_array));
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
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['address1']; }, $newexcel_array));
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
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['area']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['area']))&&(in_array($urep, $_POST['area'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}*/
	?>
	</select>
  </div>
</div-->
<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District </label>
	<select class="fav_clr form-control" name="district[]" id="district" multiple="multiple">
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['district']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
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
<!--div class="col-lg-3">
  <div class="form-group">
    <label for="pincode">Pin Code </label>
	<select class="fav_clr form-control" name="pincode[]" id="pincode" multiple="multiple">
	<?php
/*if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['pincode']; }, $newexcel_array));
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
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stockmaincategory']; }, $newexcel_array));
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
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stocksubcategory']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['stocksubcategory']))&&(in_array($urep, $_POST['stocksubcategory'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}*/
	?>
	</select>
  </div>
</div-->
<div class="col-lg-3">
  <div class="form-group">
    <label for="stockitem">Product Name </label>
	<select class="fav_clr form-control" name="stockitem[]" id="stockitem" multiple="multiple">
	<?php
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stockitem']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
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
	if((isset($newexcel_array))&&(is_array($newexcel_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['typeofproduct']; }, $newexcel_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" ><?=$urep?></option>
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
	<input type="text" class="form-control" id="serialnumber" name="serialnumber"  >
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="oemdetails">OEM Claims</label>
	<select class="fav_clr form-control" name="oemdetails" id="oemdetails">
	<option value=" " <?=(isset($_POST['oemdetails'])&&($_POST['oemdetails']==''))?'selected':' '?>>Select</option>
				<option value="To be Sent" >To be Sent</option>
				<option value="Sent to OEM" >Sent to OEM</option>
				<option value="To be Received" >To be Received</option>
				<option value="OEM" >Received From OEM</option>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="deliverystatus">Serviced Products</label>
	<select class="fav_clr form-control" name="deliverystatus" id="deliverystatus">
	<option value=" " >Select</option>
				<option value="Ready To Delivery" >Ready To Delivery</option>
				<option value="Delivered" >Delivered</option>
	</select>
  </div>
</div>



</div>
<?php
	if($secsystem=='1')
	{
	?>
  <hr>
  <div class="alert alert-info">To View Call Report you must validate yourself by enter your Password</div>
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
				$staquex="  and tdelete='0'";
				$staqu="  where  servicetype='Carry-In'";
				if(isset($_GET['cn']))
				{
					$cn=mysqli_real_escape_string($connection,$_GET['cn']);
					if($cn!='')
					{
						$statitle.=" - ".$cn." Calls";
						if($staqu!='')
						{
							$staqu=" and callnature='$cn'";
						}
						else
						{
							$staqu=" where callnature='$cn'";
						}
					}
				}
				if(($_POST['datefrom'])&&($_POST['dateto']))
				{
					if($staqu!="")
					{
						$staqu.=" and callon BETWEEN '".$_POST['datefrom']." 00:00:00' AND '".$_POST['dateto']." 23:59:59'";
					}
					else
					{
						$staqu.=" where callon BETWEEN '".$_POST['datefrom']." 00:00:00' AND '".$_POST['dateto']." 23:59:59'";
					}
				}
			if(isset($_POST['compstatus']))
			{
				$subquer="";
				foreach($_POST['compstatus'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="compstatus='".$repp."'";
					}
					else
						{
						$subquer.=" or compstatus='".$repp."'";
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
			
			if(isset($_POST['reportedproblem']))
			{
				$subquer="";
				foreach($_POST['reportedproblem'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="reportedproblem='".$repp."'";
					}
					else
						{
						$subquer.=" or reportedproblem='".$repp."'";
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
			
			if(isset($_POST['engineername']))
			{
				$subquer="";
				foreach($_POST['engineername'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="engineername='".$repp."'";
					}
					else
						{
						$subquer.=" or engineername='".$repp."'";
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
			
			if(isset($_POST['coordinatorname']))
			{
				$subquer="";
				foreach($_POST['coordinatorname'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="coordinatorname='".$repp."'";
					}
					else
						{
						$subquer.=" or coordinatorname='".$repp."'";
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
			
			if(isset($_POST['businesstype']))
			{
				$subquer="";
				foreach($_POST['businesstype'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="businesstype='".$repp."'";
					}
					else
						{
						$subquer.=" or businesstype='".$repp."'";
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
			
			if(isset($_POST['servicetype']))
			{
				$subquer="";
				foreach($_POST['servicetype'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="servicetype='".$repp."'";
					}
					else
						{
						$subquer.=" or servicetype='".$repp."'";
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
			
			if(isset($_POST['godownname']))
			{
				$subquer="";
				foreach($_POST['godownname'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="godownname='".$repp."'";
					}
					else
						{
						$subquer.=" or godownname='".$repp."'";
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
			
			if(isset($_POST['suppliername']))
			{
				$subquer="";
				foreach($_POST['suppliername'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="suppliername='".$repp."'";
					}
					else
						{
						$subquer.=" or suppliername='".$repp."'";
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
			
			
			if(isset($_POST['callnature']))
			{
				$subquer="";
				foreach($_POST['callnature'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="callnature='".$repp."'";
					}
					else
						{
						$subquer.=" or callnature='".$repp."'";
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
			
			if(isset($_POST['customernature']))
			{
				$subquer="";
				foreach($_POST['customernature'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="customernature='".$repp."'";
					}
					else
					{
						$subquer.=" or customernature='".$repp."'";
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
			}if(isset($_POST['callnature']))
			{
				$subquer="";
				foreach($_POST['callnature'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="callnature='".$repp."'";
					}
					else
					{
						$subquer.=" or callnature='".$repp."'";
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
			if(isset($_POST['calltid']))
			{
				$subquer="";
				foreach($_POST['calltid'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="calltid='".$repp."'";
					}
					else
					{
						$subquer.=" or calltid='".$repp."'";
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
			
			if(isset($_POST['callhandlingname']))
			{
				$subquer="";
				foreach($_POST['callhandlingname'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="callhandlingname='".$repp."'";
					}
					else
						{
						$subquer.=" or callhandlingname='".$repp."'";
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
if(isset($_POST['problemobserved']))
			{
				$subquer="";
				foreach($_POST['problemobserved'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="problemobserved='".$repp."'";
					}
					else
						{
						$subquer.=" or problemobserved='".$repp."'";
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
				$subquexer="";
				foreach($_POST['maincategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="maincategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or maincategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['subcategory']))
			{
				$subquexer="";
				foreach($_POST['subcategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="subcategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or subcategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			
			
			if(isset($_POST['consigneename']))
			{
				$subquexer="";
				foreach($_POST['consigneename'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="consigneename='".$repp."'";
					}
					else
						{
						$subquexer.=" or consigneename='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['department']))
			{
				$subquexer="";
				foreach($_POST['department'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="department='".$repp."'";
					}
					else
						{
						$subquexer.=" or department='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['area']))
			{
				$subquexer="";
				foreach($_POST['area'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="area='".$repp."'";
					}
					else
						{
						$subquexer.=" or area='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['district']))
			{
				$subquexer="";
				foreach($_POST['district'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="district='".$repp."'";
					}
					else
						{
						$subquexer.=" or district='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['pincode']))
			{
				$subquexer="";
				foreach($_POST['pincode'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="pincode='".$repp."'";
					}
					else
						{
						$subquexer.=" or pincode='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['stockmaincategory']))
			{
				$subquexer="";
				foreach($_POST['stockmaincategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="stockmaincategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or stockmaincategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['stocksubcategory']))
			{
				$subquexer="";
				foreach($_POST['stocksubcategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="stocksubcategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or stocksubcategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['stockitem']))
			{
				$subquexer="";
				foreach($_POST['stockitem'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="stockitem='".$repp."'";
					}
					else
						{
						$subquexer.=" or stockitem='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['typeofproduct']))
			{
				$subquexer="";
				foreach($_POST['typeofproduct'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="typeofproduct='".$repp."'";
					}
					else
						{
						$subquexer.=" or typeofproduct='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (".$subquexer.")";
					}
					else
					{
						$staquex.=" where (".$subquexer.")";
					}
				}
			}
			if((isset($_POST['serialnumber']))&&($_POST['serialnumber']!=''))
			{
				if($staqu!="")
				{
					$staqu.=" and (lower(serial) like '%".$_POST['serialnumber']."%')";
				}
				else
				{
					$staqu.=" where (lower(serial) like '%".$_POST['serialnumber']."%')";
				}
			}

//for oem details
if(isset($_POST['oemdetails']))
{
				$subquexer="";
				
				if($_POST['oemdetails']=='To be Sent')
				{
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and ((suppliername IS NULL) or (suppliername IS NOT NULL))  and  ((supcourierdate IS NULL or supcourierdate='') or (supcouriercharges IS NULL or supcouriercharges=''))  and (supcompstatus IS NULL or supcompstatus='') and compstatus='0'";
					}
					else
					{
						$staquex.=" where ((suppliername IS NULL) or (suppliername IS NOT NULL))  and  ((supcourierdate IS NULL or supcourierdate='') or (supcouriercharges IS NULL or supcouriercharges=''))  and (supcompstatus IS NULL or supcompstatus='') and compstatus='0'";
					}
				}
				if($staqu!="")
				{
					$staqu.=" and ((suppliername IS NULL) or (suppliername IS NOT NULL))  and  (((supcourierdate IS NULL) or (supcourierdate='')) or ((supcouriercharges IS NULL) or (supcouriercharges='')))  and ((supcompstatus IS NULL) or (supcompstatus='')) and compstatus='0' and servicetype='Carry-In'";
				}
				else
				{
					$staqu.=" where ((suppliername IS NULL) or (suppliername IS NOT NULL))  and  (((supcourierdate IS NULL) or (supcourierdate='')) or ((supcouriercharges IS NULL) or (supcouriercharges='')))  and ((supcompstatus IS NULL) or (supcompstatus='')) and compstatus='0' and servicetype='Carry-In'";
				}
				}
				if($_POST['oemdetails']=='Sent to OEM')
				{
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL )";
					}
					else
					{
						$staquex.=" where (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL )";
					}
				}
				if($staqu!="")
				{
					$staqu.=" and (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL ) and servicetype='Carry-In'";
				}
				else
				{
					$staqu.=" where (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL ) and servicetype='Carry-In'";
				}
				}
				if($_POST['oemdetails']=='To be Received')
				{
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and  (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL )";
					}
					else
					{
						$staquex.=" where (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL )";
					}
				}
				if($staqu!="")
				{
					$staqu.=" and (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL ) and servicetype='Carry-In'";
				}
				else
				{
					$staqu.=" where (suppliername!='' or suppliername='') and (dcno!='' or dcno IS NOT NULL) and compstatus!='2' and  ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL ) and servicetype='Carry-In'";
				}
				}
					if($_POST['oemdetails']=='OEM')
				{
				if($subquexer!="")
				{
					if($staquex!="")
					{
						$staquex.=" and supcompstatus!='' and compstatus!='2'";
					}
					else
					{
						$staquex.=" where supcompstatus!='' and compstatus!='2'";
					}
				}
				if($staqu!="")
				{
					$staqu.=" and supcompstatus!='' and compstatus!='2' and servicetype='Carry-In'";
				}
				else
				{
					$staqu.=" where supcompstatus!='' and compstatus!='2' and servicetype='Carry-In'";
				}
				}
				
			
}
	

//end for oem details			

////count
				$coustaqu=" where jc.sourceid=jx.id and jc.servicetype='Carry-In'";

				if(isset($_GET['cn']))
				{
					$cn=mysqli_real_escape_string($connection,$_GET['cn']);
					if($cn!='')
					{
						$cousubquer="jc.callnature='".$cn."'";
						if($cousubquer!="")
						{
							if($coustaqu!="")
							{
								$coustaqu.=" and (".$cousubquer.")";
							}
							else
							{
								$coustaqu.=" where (".$cousubquer.")";
							}
						}
					}
				}

				if(($_POST['datefrom'])&&($_POST['dateto']))
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and jc.callon BETWEEN '".$_POST['datefrom']." 00:00:00' AND '".$_POST['dateto']." 23:59:59'";
					}
					else
					{
						$coustaqu.=" where jc.callon BETWEEN '".$_POST['datefrom']." 00:00:00' AND '".$_POST['dateto']." 23:59:59'";
					}
				}
			if(isset($_POST['compstatus']))
			{
				$cousubquer="";
				foreach($_POST['compstatus'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.compstatus='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.compstatus='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			if(isset($_POST['reportedproblem']))
			{
				$cousubquer="";
				foreach($_POST['reportedproblem'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.reportedproblem='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.reportedproblem='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			if(isset($_POST['engineername']))
			{
				$cousubquer="";
				foreach($_POST['engineername'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.engineername='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.engineername='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			if(isset($_POST['coordinatorname']))
			{
				$cousubquer="";
				foreach($_POST['coordinatorname'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.coordinatorname='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.coordinatorname='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			
			if(isset($_POST['businesstype']))
			{
				$cousubquer="";
				foreach($_POST['businesstype'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.businesstype='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.businesstype='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			
			if(isset($_POST['servicetype']))
			{
				$cousubquer="";
				foreach($_POST['servicetype'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.servicetype='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.servicetype='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			if(isset($_POST['godownname']))
			{
				$cousubquer="";
				foreach($_POST['godownname'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.godownname='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.godownname='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			
			if(isset($_POST['suppliername']))
			{
				$cousubquer="";
				foreach($_POST['suppliername'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.suppliername='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.suppliername='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			
			
			if(isset($_POST['calltid']))
			{
				$cousubquer="";
				foreach($_POST['calltid'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.calltid='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.calltid='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			if(isset($_POST['callnature']))
			{
				$cousubquer="";
				foreach($_POST['callnature'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.callnature='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.callnature='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			if(isset($_POST['customernature']))
			{
				$cousubquer="";
				foreach($_POST['customernature'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.customernature='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.customernature='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}if(isset($_POST['callnature']))
			{
				$cousubquer="";
				foreach($_POST['callnature'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.callnature='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.callnature='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			
			if(isset($_POST['callhandlingname']))
			{
				$cousubquer="";
				foreach($_POST['callhandlingname'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.callhandlingname='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.callhandlingname='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
if(isset($_POST['problemobserved']))
			{
				$cousubquer="";
				foreach($_POST['problemobserved'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.problemobserved='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.problemobserved='".$repp."'";
					}
				}
				if($cousubquer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$cousubquer.")";
					}
					else
					{
						$coustaqu.=" where (".$cousubquer.")";
					}
				}
			}
			if(isset($_POST['maincategory']))
			{
				$subquexer="";
				foreach($_POST['maincategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.maincategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.maincategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			
			if(isset($_POST['subcategory']))
			{
				$subquexer="";
				foreach($_POST['subcategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.subcategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.subcategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			
			if(isset($_POST['consigneename']))
			{
				$subquexer="";
				foreach($_POST['consigneename'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.consigneename='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.consigneename='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['department']))
			{
				$subquexer="";
				foreach($_POST['department'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.department='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.department='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['area']))
			{
				$subquexer="";
				foreach($_POST['area'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.area='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.area='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['district']))
			{
				$subquexer="";
				foreach($_POST['district'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.district='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.district='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['pincode']))
			{
				$subquexer="";
				foreach($_POST['pincode'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.pincode='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.pincode='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['stockmaincategory']))
			{
				$subquexer="";
				foreach($_POST['stockmaincategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.stockmaincategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.stockmaincategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['stocksubcategory']))
			{
				$subquexer="";
				foreach($_POST['stocksubcategory'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.stocksubcategory='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.stocksubcategory='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['stockitem']))
			{
				$subquexer="";
				foreach($_POST['stockitem'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.stockitem='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.stockitem='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if(isset($_POST['typeofproduct']))
			{
				$subquexer="";
				foreach($_POST['typeofproduct'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.typeofproduct='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.typeofproduct='".$repp."'";
					}
				}
				if($subquexer!="")
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				}
			}
			if((isset($_POST['serialnumber']))&&($_POST['serialnumber']!=''))
			{
				if($coustaqu!="")
				{
					$coustaqu.=" and (lower(jc.serial) like '%".$_POST['serialnumber']."%')";
				}
				else
				{
					$coustaqu.=" where (lower(jc.serial) like '%".$_POST['serialnumber']."%')";
				}
			}
			if(isset($_POST['oemdetails']))
			{
				
				if($_POST['oemdetails']=='To be Sent')
				{
					$subquexer="";
					
				if($subquexer=="")
				{
					$subquexer.="jc. compstatus='0' and ((suppliername IS NULL) or (suppliername IS NOT NULL)) and ((supcourierdate IS NULL) or (supcourierdate='')) or ((supcouriercharges IS NULL) or (supcouriercharges=''))  and ((supcompstatus IS NULL) or (supcompstatus=''))";
				}
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				
				}
				if($_POST['oemdetails']=='Sent to OEM')
				{
					$subquexer="";
					
				if($subquexer=="")
				{
					$subquexer.="jc.compstatus!='2' and (suppliername!='' or suppliername='') and ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL )";
				}
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				
				}
				if($_POST['oemdetails']=='To be Received')
				{
					$subquexer="";
					
				if($subquexer=="")
				{
					$subquexer.="jc. compstatus!='2' and (suppliername!='' or suppliername='') and ((supcourierdate!='' or supcourierdate IS NOT NULL))  and (supcompstatus='' or supcompstatus IS NULL )";
				}
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				
				}
				if($_POST['oemdetails']=='OEM')
				{
					$subquexer="";
					
				if($subquexer=="")
				{
					$subquexer.="jc.supcompstatus!='' and compstatus!='2'";
				}
					if($coustaqu!="")
					{
						$coustaqu.=" and (".$subquexer.")";
					}
					else
					{
						$coustaqu.=" where (".$subquexer.")";
					}
				
				}
			}
			
			
			if(isset($_POST['deliverystatus']))
			{
				if($_POST['deliverystatus']=='Ready To Delivery')
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and supcompstatus!='' and compstatus!='2'";
					}
					else
					{
						$coustaqu.=" where supcompstatus!='' and compstatus!='2'";
					}
				if($staqu!="")
				{
					$staqu.=" and supcompstatus!='' and compstatus!='2'";
				}
				else
				{
					$staqu.=" where supcompstatus!='' and compstatus!='2'";
				}
				}
				if($_POST['deliverystatus']=='Delivered')
				{
					if($coustaqu!="")
					{
						$coustaqu.=" and   compstatus='2'";
					}
					else
					{
						$coustaqu.=" where  compstatus='2'";
					}
				if($staqu!="")
				{
					$staqu.="and   compstatus='2'";
				}
				else
				{
					$staqu.=" where  compstatus='2'";
				}
				}
				
			}
			
			
			//////
			?>	</div></div>
			
			
			<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="report-tab" data-toggle="tab" data-target="#report" type="button" role="tab" aria-controls="report" aria-selected="true">Report</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="analytics-tab" data-toggle="tab" data-target="#analytics" type="button" role="tab" aria-controls="analytics" aria-selected="true">Analytics</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
<div class="row">
			
			<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Business Type wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:180px; overflow-y:auto">
								<table class="table">
								<tr>
								<th>Business Type</th>
								<th>Total Calls</th>
								</tr>
								
        <?php
		 $sqlselect = "SELECT count(jc.id) as count, jc.businesstype From jrccalls jc, jrcxl jx ".$coustaqu." group by jc.businesstype order by count desc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
		
        if($rowCountselect > 0) 
		{
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				?>
				<tr>
				<td><?=$rowselect['businesstype']?></td>
				<td><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
			</div>
			
			
			<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Service Type wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:180px; overflow-y:auto">
								<table class="table">
								<tr>
								<th>Service Type</th>
								<th>Total Calls</th>
								</tr>
								
        <?php
		$sqlselect = "SELECT count(jc.id) as count, jc.servicetype From jrccalls jc, jrcxl jx ".$coustaqu." group by jc.servicetype order by count desc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
		
        if($rowCountselect > 0) 
		{
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				?>
				<tr>
				<td><?=$rowselect['servicetype']?></td>
				<td><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
			</div>
			
			
			
			
			<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Call Nature wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:330px; overflow-y:auto">
								<table class="table">
								<tr>
								<th>Nature</th>
								<th>Total Calls</th>
								</tr>
								
        <?php
		$sqlselect = "SELECT count(jc.id) as count, jc.callnature From jrccalls jc, jrcxl jx ".$coustaqu." group by jc.callnature order by count desc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
		



		$piecolor=array("#FF6C95", "#6F9FF5", "#04DCCB", "#FF9C7F", "#77808F", "#8A61EA", "#FF5D68", "#C976DB", "#FEC368", "#02DB9E", "#398CE8", "#767AE3", "#FF7265", "#FEDB02", "#028FFD", "#F0484E");
		$piecolorhover=array("#FF6C96", "#6F9FF6", "#04DCCC", "#FF9C7E", "#77808E", "#8A61EB", "#FF5D69", "#C976DC", "#FEC369", "#02DB9F", "#398CE9", "#767AE4", "#FF7266", "#FEDB03", "#028FFE", "#F0484F");
		$pievalue=array();
		$piename=array();
        if($rowCountselect > 0) 
		{
			$piecount=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				?>
				<tr>
				<td><?=$rowselect['callnature']?></td>
				<td><?=$rowselect['count']?></td>
				</tr>
				<?php
				$pievalue[]=(float)$rowselect['count'];
				$piename[]=$rowselect['callnature'];
				$piecount++;
			}
		}
		?>	
		</table>
			</div>
			</div>
			</div>
			<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Call Nature wise - Chart</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:330px; overflow-y:auto">
								<div class="chart-pie pt-4">
								<div class="chartjs-size-monitor">
								<div class="chartjs-size-monitor-expand">
								<div class=""></div>
								</div>
								<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
								</div>
								</div>
								<canvas id="myPieChart" width="301" height="253" style="display: block; width: 301px; height: 253px;" class="chartjs-render-monitor"></canvas>
                                    </div>
								</div>
								</div>
												   
									
                                </div>
								</div>
			
			<div class="row">			
			<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Product wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								<table class="table bg-bgcolor text-white">
								<tr>
								<th>Product Name</th>
								<th>Total Calls</th>
								</tr>
                                   <?php
				  $sqlselect = "SELECT count(jc.id) as count, jx.stocksubcategory From jrccalls jc, jrcxl jx ".$coustaqu." group by jx.stocksubcategory order by count desc";
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
				<td><?=$rowselect['stocksubcategory']?></td>
				<td><?=$rowselect['count']?></td>
				</tr>
				<?php
				
			}
		}
		?>	
		</table>
			</div>
			</div>
                               
									
                                </div>
			
			
			<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Problem Reported</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								<table class="table bg-bgcolor text-white">
								<tr>
								<th>Problem Reported</th>
								<th>Total Calls</th>
								</tr>
                                   <?php
								   $sqlselect = "SELECT count(jc.id) as count, jc.reportedproblem From jrccalls jc, jrcxl jx ".$coustaqu." group by jc.reportedproblem order by count desc";
					 
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
				<td><?=$rowselect['reportedproblem']?></td>
				<td><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
                               
									
                                </div>
								
			<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Problem Observed</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								<table class="table bg-bgcolor text-white">
								<tr>
								<th>Problem Observed</th>
								<th>Total Calls</th>
								</tr>
                                   <?php
								   $sqlselect = "SELECT count(jc.id) as count, jc.problemobserved From jrccalls jc, jrcxl jx ".$coustaqu." group by jc.problemobserved order by count desc";
			
				 
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
				<td><?=$rowselect['problemobserved']?></td>
				<td><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
                               
									
                                </div>
								<div class="col-xl-6 col-md-6 mb-1">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Action Taken</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								<table class="table bg-bgcolor text-white">
								<tr>
								<th>Action Taken</th>
								<th>Total Calls</th>
								</tr>
                                   <?php
		
 $sqlselect = "SELECT count(jc.id) as count, jc.actiontaken From jrccalls jc, jrcxl jx ".$coustaqu." group by jc.actiontaken order by count desc";
 
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
				<td><?=$rowselect['actiontaken']?></td>
				<td><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
                               
									
                                </div>

								
                            </div>
			
</div>
  <div class="tab-pane fade show active" id="report" role="tabpanel" aria-labelledby="report-tab">
  <!-----products---->
			
			<!---------------->
			
			 <div class="card shadow mb-4">
		  <div class="card-body font-13">
			<h4 class="text-danger">
			Report 
			<?php
			if($_POST['datefrom']!="")
			{
				?>
				From <?=date('d/m/Y',strtotime($_POST['datefrom']))?>
				<?php
			}
			if($_POST['dateto']!="")
			{
				?>
			to  <?=date('d/m/Y',strtotime($_POST['dateto']))?>
			<?php
			}
			?>
			</h4>
			 <div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
              <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Warehouse</th>
                      <th>Supplier Name</th>
                      <th>Call ID</th>
					  <th>Date</th>
					  <th>Call Details</th>
					  <th>Type Details</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Serial Number</th>
					  <th>Problem Reported</th>
					  <th>Problem Observed</th>
					  <th>Action Taken</th>
					  <th>Narration</th>
					  <th>Engineers Report</th>
                      <th>Status</th>
					  <th>Service Charges</th>
					  <th>Change</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $callids=array();
				  
				  $sqlselect = "SELECT sourceid, calltid, callon, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid, engineertype, engineername, businesstype, servicetype, customernature, callnature, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid, 
compstatus, changeon, id, detailsid,godownname,suppliername,engineersid ,engineersname,reportingengineerid  From jrccalls ".$staqu." order by id desc";
				 
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
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem, id From jrcxl where id='".$rowselect['sourceid']."' ".$staquex." order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountxl > 0) 
				{
					$rowxl = mysqli_fetch_array($queryxl);
				
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				  $sqlcons = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
				  
        $querycons = mysqli_query($connection, $sqlcons);
        $rowCountcons = mysqli_num_rows($querycons);
         
        if(!$querycons){
           die("SQL query failed: " . mysqli_error($connection));
        }
        $rowcons = mysqli_fetch_array($querycons);
		if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowcons['address1']!='')
		{
		$rowcons['address1']=jbsdecrypt($_SESSION['encpass'], $rowcons['address1']);
		}
		if($rowcons['phone']!='')
		{
		$rowcons['phone']=jbsdecrypt($_SESSION['encpass'], $rowcons['phone']);
		}
		if($rowcons['mobile']!='')
		{
		$rowcons['mobile']=jbsdecrypt($_SESSION['encpass'], $rowcons['mobile']);
		}
		if($rowcons['email']!='')
		{
		$rowcons['email']=jbsdecrypt($_SESSION['encpass'], $rowcons['email']);
		}
	}
}
		$detailsid=mysqli_real_escape_string($connection,$rowselect['detailsid']);
				  $sqldetails = "SELECT engineerreport, scharge From jrccalldetails where id='".$detailsid."' order by engineerreport asc";
				  
        $querydetails = mysqli_query($connection, $sqldetails);
        $rowCountdetails = mysqli_num_rows($querydetails);
         
        if(!$querydetails){
           die("SQL query failed: " . mysqli_error($connection));
        }
        $rowdetails = mysqli_fetch_array($querydetails);
		if($rowselect['godownname']!='')
		{
		$sqlxl2 = "SELECT id, godownname From jrcgodown where id='".$rowselect['godownname']."'";
				$queryxl2 = mysqli_query($connection, $sqlxl2);
				$rowCountxl2 = mysqli_num_rows($queryxl2);
				 if(!$queryxl2){
           die("SQL query failed: " . mysqli_error($connection));
        }
				$rowxl2 = mysqli_fetch_array($queryxl2);
		}
		if($rowselect['suppliername']!='')
		{
				
				$sqlsup = "SELECT id, suppliername From jrcsuppliers where id='".$rowselect['suppliername']."'";
				$querysup = mysqli_query($connection, $sqlsup);
				$rowCountsup = mysqli_num_rows($querysup);
				 if(!$querysup){
           die("SQL query failed: " . mysqli_error($connection));
        }
				$rowsup = mysqli_fetch_array($querysup);
		}
		?>
                    <tr>
                      <td><?=$count?></td>
					  <td><?php if($rowCountxl2>0){ echo $rowxl2['godownname']; }?></td>
					  <td><?php if($rowCountsup>0){ echo $rowsup['suppliername']; }?></td>
					  <td><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a></td>
					  <td><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
					  <td>C/H: <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
					  C/O: <a href="coordinatorview.php?id=<?=$rowselect['coordinatorid']?>"><?=$rowselect['coordinatorname']?></a><br>
					  <?php
					  if($rowselect['engineertype']=='1')
					  {
						  $engnsid=explode(',',$rowselect['engineersid']);
						  $engnsname=explode(',',$rowselect['engineersname']);
						  for($eise=0;$eise<count($engnsid);$eise++)
						  {
							  ?>
							E-<?=($eise+1)?>: <a href="mapengineerview.php?id=<?=$engnsid[$eise]?>&attdate=<?=date('Y-m-d')?>"><?=$engnsname[$eise]?> <?=($rowselect['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
							<?php
						  }
					  }
					  else
					  {
						?>
						E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
						  <?php
					  }
					  ?>
					  </td>
					  <td>
					  <?php 
					  if($rowselect['businesstype']!='')
					  {
							  ?>
							<span class="text-success text-bold"><?=$rowselect['businesstype']?></span><br>
							<?php						  
					  } 
					  if($rowselect['servicetype']!='')
					  {
							  ?>
							<span class="text-danger text-bold"><?=$rowselect['servicetype']?></span><br>
							<?php						  
					  } 
					 if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="text-info text-bold"><?=$rowselect['customernature']?></span><br>
						   <?php						  
					 }
					 if($rowselect['callnature']!='')
					 {
							 ?>
						   <span class="text-primary text-bold"><?=$rowselect['callnature']?></span><br>
						   <?php						  
					 }
					  ?></td>
					   <?php
					  if($rowxl['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>"><?=$rowxl['consigneename']?></a><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?>
					  <td><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowxl['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowxl['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowxl['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowxl['stockitem']?>
												<?php
												}
												?></td>
					  <td><?=$rowselect['serial']?></td>
					  <td><?=$rowselect['reportedproblem']?></td>
					  <td><?=$rowselect['problemobserved']?></td>
					  <td><?=$rowselect['actiontaken']?></td>
					  <td><?=$rowselect['narration']?></td>
					  <td><?php if($rowCountdetails>0) { echo $rowdetails['engineerreport']; } ?></td>
					  <td>
					  <?php
					 if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span><br>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span><br>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='3')
					  {
						?>
						<span class="text-info">Cancelled </span><br>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else
					 {
						?>
						<span class="text-warning">Open</span>
						<?php
						
					  }
					  ?>
					  </td>
					  <td><?php if($rowCountdetails>0) { echo number_format((float)$rowdetails['scharge'],2,'.',''); } ?></td>
					  <?php
					  if($calledit=='1')
					  {
						 if($rowselect['compstatus']!='2')
						  { 
						  if($rowselect['compstatus']!='3')
						  {
							  ?>
							  <td><a href="callsedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
							  <?php						
						  }
						  else
						  {
							  ?>
							  <td><a href="complaintprint1.php?id=<?=$rowselect['calltid']?>" target="_blank">Print</a></td>
							  <?php
						  }
						  }
						  else
						  {
							  ?>
							  <td><a href="complaintprint1.php?id=<?=$rowselect['calltid']?>" target="_blank">Print</a></td>
							  <?php
						  }
					  }

					  ?>
                    </tr>
					<?php
					$count++;
				$callids[]=$rowselect['calltid'];
				}
				
			}
		}
			?>
					
                  </tbody>
                </table>
              </div><br>
			  <form action="complaintprint2.php" method="post"  target="_blank">
			  <input type="hidden" name="ids" value="<?=implode(",",$callids)?>">
			  <input type="submit" class="btn btn-primary" value="Print Carry-In Call Reports">
			  </form>
			  <?php
			}
			}
			?>
            </div>
          </div>
<!----------------------------->
</div>

</div>



	</div>
	
	<?php
}
?>
        </div>
<?php include('footer.php'); ?>
      </div>
    </div>
  </div>
   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<!--Modal starts Here-->
<div class="modal fade" id="dynamicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Call History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="callhistorybody">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
   
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

<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>	
  <!-- Page level custom scripts<script src="../../1637028036/js/datatables.js"></script> -->
  
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000000';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: [<?php foreach($piename as $pname){?>"<?=$pname?>",<?php }?>],
    datasets: [{
      data: [<?php foreach($pievalue as $pvalue){?><?=$pvalue?>,<?php }?>],
      backgroundColor: [<?php for($i=0;$i<$piecount;$i++){?>'<?=$piecolor[$i]?>', <?php } ?>],
      hoverBackgroundColor: [<?php for($i=0;$i<$piecount;$i++){?>'<?=$piecolorhover[$i]?>', <?php } ?>],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#000000",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 0,
  },
});

</script>

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
<script>
$("#allreportedproblem").click(function () {
    $(".reportedproblemclass").prop('checked', $(this).prop('checked'));
});
$("#allproblemobserved").click(function () {
    $(".problemobservedclass").prop('checked', $(this).prop('checked'));
});
function searchhistory(id)
   {
        var id=id;
        
        $.ajax({
            url:"searchcallhistory.php",
            method:"post",
            data:{id:id},
            success:function(response){
                $("#callhistorybody").html(response);
                $("#dynamicModal").modal('show'); 
            }
        }) 
    }
</script>
 <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "paging": false,
                "processing": true,
                dom: 'Blfrtip',
				buttons: [
			   {
				   extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
				   orientation: 'landscape',
				   footer: true,
				   //messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: false,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
					}
			   }         
			]  
            });

        });
		$(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  placeholder: ''
    });
});

/* $('.fav_clr').on("select2:select", function (e) { 
           var data = e.params.data.text;
           if(data=='Select All'){
            $(".fav_clr > option").prop("selected","selected");
            $(".fav_clr").trigger("change");
           }
      }); */

		
    </script>
	<?php include('additionaljs.php');   ?>
</body>

</html>
