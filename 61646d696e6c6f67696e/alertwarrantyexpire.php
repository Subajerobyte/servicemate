<?php
include('lcheck.php'); 

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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Warranty Expiry Alert</title>

  
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

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php //include('alertnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  		  
<div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Warranty Expiry Alert</b></h1>
  </div>
</div>
		  
		  
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
<?php

$soure="";
		$sqlsels = "SELECT sourceid From jrcreminder where remindertype='WARRANTY EXPIRE' and enabled='0' order by sourceid asc";
	    $querysels = mysqli_query($connection, $sqlsels);
        $rowCountsels = mysqli_num_rows($querysels);
         
        if(!$querysels)
		{
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountsels > 0) 
		{
			$count=1;
			while($rowsels = mysqli_fetch_array($querysels)) 
			{
				if($soure=="")
				{
					$soure.="".$rowsels['sourceid'];
				}
				else
				{
					$soure.=",".$rowsels['sourceid'];
				}
			
			}
		}
		if($soure!="")
		{
			$soure=" where id in (".$soure.")";
		}


	$sqlselect = "SELECT maincategory, subcategory, consigneename, department, address1, area, district, pincode, stockmaincategory, stocksubcategory, stockitem, typeofproduct From jrcxl ".$soure." order by id desc";
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
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
             <div class="card-body">		
			 <form action="" method="post">
<div class="row">

<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="datefrom">Alert Date From</label>
    <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="Alert Date From" value="<?=(isset($_POST['datefrom']))?$_POST['datefrom']:date('Y-m-01')?>" >
  </div>
</div>

<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="dateto">Alert Date To</label>
    <input type="date" class="form-control" id="dateto" name="dateto" placeholder="Alert Date To" value="<?=(isset($_POST['dateto']))?$_POST['dateto']:date('Y-m-t')?>">
  </div>
</div>
 <?php
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
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="alertstatus">Alert Status </label>
	<select class="fav_clr1 form-control" name="alertstatus[]" id="alertstatus" multiple="multiple">
	<option value="0" <?=((isset($_POST['alertstatus']))&&(in_array('0', $_POST['alertstatus'])))?'selected':''?>>Pending</option>	
	<option value="1" <?=((isset($_POST['alertstatus']))&&(in_array('1', $_POST['alertstatus'])))?'selected':''?>>Completed</option>	
	</select>
  </div>
</div>
 </div>

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>
</div>
<div class="card shadow mb-4">
             <div class="card-body">		
			 
<br>			 
<?php
if((isset($_POST['submit']))||(!isset($_POST['submit'])))
{
	
$staqu="";
$staqu1="";
if((isset($_POST['datefrom']))&&(isset($_POST['dateto'])))
			{
				if(($_POST['datefrom'])&&($_POST['dateto']))
				{
					if($staqu1!="")
					{
						$staqu1.=" and (enddate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."')";
					}
					else
					{
						$staqu1.=" and (enddate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."')";
					}
				}
			}else{
				
				$datefrom=date('Y-m-01');
			  $dateto=date('Y-m-t');
			  
			  
			  if($staqu1!="")
				{
					$staqu1.=' and (enddate between "'.$datefrom.' 00:00:00" and "'.$dateto.' 23:59:59")';
				}
				else
				{
					$staqu1.=' and (enddate between "'.$datefrom.' 00:00:00" and "'.$dateto.' 23:59:59")';
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
			if(isset($_POST['address1']))
			{
				$subquer="";
				foreach($_POST['address1'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="address1='".$repp."'";
					}
					else
						{
						$subquer.=" or address1='".$repp."'";
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
			
			if(isset($_POST['alertstatus']))
			{
				$subquer="";
				foreach($_POST['alertstatus'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="enabled='".$repp."'";
					}
					else
						{
						$subquer.=" or enabled='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu1!="")
					{
						$staqu1.=" and (".$subquer.")";
					}
					else
					{
						$staqu1.=" where (".$subquer.")";
					}
				}
			}
			
			
		
?>	
<?php
$sour="";
		$sqlselect = "SELECT id From jrcxl ".$staqu." order by id asc";
	    $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect)
		{
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				if($sour=="")
				{
					$sour.="".$rowselect['id'];
				}
				else
				{
					$sour.=",".$rowselect['id'];
				}
			
			}
		}
		if($sour!="")
		{
			$sour=" and sourceid in (".$sour.")";
		}
		?>
			 <div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
              <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Generated On</th>
					  <th>Warranty Expire Alert</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>End Date</th>
					  <th>Feedback</th>
					  <th>Edit</th>
					  <th>Take Call</th>
					  <th>AMC Quotation Generation</th>
					  <th>Pending/Completed</th>
                    </tr>
                  </thead>
                  <tbody>
				<?php
				$sqlselect = "SELECT sourceid, createdon, reminder, enddate, status, id, enabled From jrcreminder where remindertype='WARRANTY EXPIRE' and enabled='0' ".$sour." ".$staqu1." order by DATE(enddate) asc";
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
						$sqlxl = "SELECT id, consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
						$queryxl = mysqli_query($connection, $sqlxl);
						$rowCountxl = mysqli_num_rows($queryxl);
						$rowxl = mysqli_fetch_array($queryxl);
						
						$sqlq = "SELECT DISTINCT stockitem, amcvalue,amcgst From jrcproduct where stockitem='".$rowxl['stockitem']."' order by id asc";
						$queryq = mysqli_query($connection, $sqlq);
						$rowq = mysqli_fetch_array($queryq);
						
						
						$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
						$sqlcons = "SELECT id,address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
						$querycons = mysqli_query($connection, $sqlcons);
						$rowCountcons = mysqli_num_rows($querycons);
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
					?>
							<tr>
							  <td><?=$count?></td>
							  <td><?php if($rowselect['createdon']!="" && $rowselect['createdon']!='NULL') { echo date('d/m/Y',strtotime($rowselect['createdon'])); } else { echo "";}?> </td>
							  <td><?=$rowselect['reminder']?></td>
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
					   <?php 
					  $val=floatval($rowq['amcvalue']);
					  $gst=floatval($rowq['amcgst']);
					  $gstval=(($val*$gst)/100);
					  $totprice=$val+$gstval;
					  
					  ?>
					  <td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span> - Rs.<?=$totprice?></td>
							  <td><?=date('d/m/Y',strtotime($rowselect['enddate']))?></td>
							  <td><?=$rowselect['status']?></td>
							  <td><a href="reminderedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
							  
							  <?php
							  if($rowselect['enabled']=='1')
							  {
								?>
								<td></td>
								<td></td>
								<td>
								<a href="reminderchange.php?id=<?=$rowselect['id']?>&val=0" onclick="return confirm('Are you sure want to make Pending this Warranty Expire Alert?')" ><span class="text-success">Completed</span></a>
								</td>
								<?php 
							  }
							  else
							  {
								  ?>
								  <td><a target="_blank" href="callsadd.php?id=<?=$rowxl['id']?>&ts=warrantyexpire&ts1=<?=$rowselect['id']?>" class="btn btn-primary btn-sm">Take Call</a></td>
								  <td><a target="_blank" href="amcquotationgen.php?id=<?=$rowcons['id']?>&xlid=<?=$rowxl['id']?>&ts=warrantyexpire&ts1=<?=$rowselect['id']?>" class="btn btn-primary btn-sm">Generate AMC Quotation</a></td>
								<td><a href="reminderchange.php?id=<?=$rowselect['id']?>&val=1" onclick="return confirm('Are you sure want to Complete this Warranty Expire Alert?')" ><span class="text-danger">Pending</span></a></td>
								<?php 
							  }
				?>	
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
						columns: [0,1,2,3,4,5,8]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: false,
				   exportOptions: {
						columns:  [0,1,2,3,4,5,8]
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
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
  });
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
	  
$(document).ready(function() {
$('.fav_clr1').select2({
width: '100%',
  allowClear: true,
  placeholder: ''
    });
});
$('.fav_clr1').on("select2:select", function (e) { 
var data = e.params.data.text;
if(data=='all'){
$(".fav_clr1 > option").prop("selected","selected");
$(".fav_clr1").trigger("change");
}
});	  
</script>

<script>
/* $(document).ready(function(){
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
}()); */
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
