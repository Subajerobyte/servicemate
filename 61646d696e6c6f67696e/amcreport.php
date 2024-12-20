<?php
include('lcheck.php'); 

if($amcmanagement=='0')
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - AMC Report</title>

  
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
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">AMC Report</h1>
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
	$sqlamc = "SELECT consigneeid  From jrcamc order by id desc";
		$queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountamc > 0) 
		{
			$ids="";
			while( $row = mysqli_fetch_array( $queryamc))
			{
				if($ids!="")
				{
					$ids.=",".$row['consigneeid'];
				}
				else
				{
					$ids.=$row['consigneeid'];o
				}
			}


	$sqlselect = "SELECT * From jrcxl where tdelete='0' and  consigneeid in (".$ids.") order by consigneeid asc";
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
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">AMC Report</h6>
            </div>
            <div class="card-body">
			<form action="" method="post">
<div class="row">
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
    <label for="address2">Address 2</label>
	<select class="fav_clr form-control" name="address2[]" id="address2" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['address2']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['address2']))&&(in_array($urep, $_POST['address2'])))?'selected':''?>><?=$urep?></option>
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
    <label for="contact">Contact Person </label>
	<select class="fav_clr form-control" name="contact[]" id="contact" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['contact']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['contact']))&&(in_array($urep, $_POST['contact'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="phone">Phone No </label>
	<select class="fav_clr form-control" name="phone[]" id="phone" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['phone']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['phone']))&&(in_array($urep, $_POST['phone'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="mobile">Mobile </label>
	<select class="fav_clr form-control" name="mobile[]" id="mobile" multiple="multiple">
	<?php
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['mobile']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['mobile']))&&(in_array($urep, $_POST['mobile'])))?'selected':''?>><?=$urep?></option>
				<?php
			}
	}
	?>
	</select>
  </div>
</div>

  </div>

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
			<?php
if(isset($_POST['submit']))
{
	
$staqu="";
$subquer="";			
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
			
			if(isset($_POST['address2']))
			{
				$subquer="";
				foreach($_POST['address2'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="address2='".$repp."'";
					}
					else
						{
						$subquer.=" or address2='".$repp."'";
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
			
			if(isset($_POST['phone']))
			{
				$subquer="";
				foreach($_POST['phone'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="phone='".$repp."'";
					}
					else
						{
						$subquer.=" or phone='".$repp."'";
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
			if(isset($_POST['contact']))
			{
				$subquer="";
				foreach($_POST['contact'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="contact='".$repp."'";
					}
					else
						{
						$subquer.=" or contact='".$repp."'";
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
			
			if(isset($_POST['mobile']))
			{
				$subquer="";
				foreach($_POST['mobile'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="mobile='".$repp."'";
					}
					else
						{
						$subquer.=" or mobile='".$repp."'";
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
			if($subquer=="")
				{
					if($staqu!="")
					{
						$staqu.=" and id in (".$ids.")";
					}
					else
					{
						$staqu.=" where id in (".$ids.")";
					}
				}
			
			
?>	
<br>
              <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  <th>Maintenance Type</th>
					   <th>Duration</th>
                      <th>Customer Details</th>
                      <th>Product Details</th>
                      <th>Serial Number</th>
                      <th>AMJ</th>
					  <th>JAS</th>
                      <th>OND</th>
					  <th>JFM</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $amcid="";
				  $sqlselect = "SELECT id, maincategory, subcategory, department, consigneename, address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee ".$staqu."  order by consigneename asc";
				  
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
				if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowselect['address1']!='')
		{
		$rowselect['address1']=jbsdecrypt($_SESSION['encpass'], $rowselect['address1']);
		}
		if($rowselect['phone']!='')
		{
		$rowselect['phone']=jbsdecrypt($_SESSION['encpass'], $rowselect['phone']);
		}
		if($rowselect['mobile']!='')
		{
		$rowselect['mobile']=jbsdecrypt($_SESSION['encpass'], $rowselect['mobile']);
		}
		if($rowselect['email']!='')
		{
		$rowselect['email']=jbsdecrypt($_SESSION['encpass'], $rowselect['email']);
		}
	}
}
				
				 $sqlamc = "SELECT productid, sourceid, id, amctype, datefrom, dateto From jrcamc where consigneeid='".$rowselect['id']."' order by id asc";
        $queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
          if($rowCountamc > 0) 
		{
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }		
			while($rowamc = mysqli_fetch_array($queryamc))
			{
			
			
			 $sqlproduct = "SELECT stockmaincategory, stocksubcategory, stockitem From jrcproduct where id='".$rowamc['productid']."' order by id asc";
        $queryproduct = mysqli_query($connection, $sqlproduct);
        $rowCountproduct = mysqli_num_rows($queryproduct);
		
         
        if(!$queryproduct){
           die("SQL query failed: " . mysqli_error($connection));
        }		
			$rowproduct = mysqli_fetch_array($queryproduct);
			 $sqlxl = "SELECT serialnumber From jrcxl where id='".$rowamc['sourceid']."' order by id asc";
        $queryxl = mysqli_query($connection, $sqlxl);
        $rowCountxl = mysqli_num_rows($queryxl);
		
         
        if(!$queryxl){
           die("SQL query failed: " . mysqli_error($connection));
        }		
			$rowxl = mysqli_fetch_array($queryxl);
			 
			$srls=explode("|",$rowxl['serialnumber']);
			for($sr=0;$sr<count($srls);$sr++)
					  {
						  if(isset($srls[$sr]))
						  {
			?>
			
                    <tr>
                      <td><?=$count?></td>
					  <?php
					  if($amcid!=$rowamc['id'])

					  {
						  ?>
					  
					  <td><?=$rowamc['amctype']?></td>
					  <td><?php if(isset($rowamc['datefrom'])) { echo date('d/m/Y', strtotime($rowamc['datefrom'])); } ?> - <?php if(isset($rowamc['dateto'])) { echo date('d/m/Y', strtotime($rowamc['dateto'])); } ?></td>
					  <td><?=$rowselect['maincategory']?><br><?=$rowselect['subcategory']?><br><?=$rowselect['department']?><br>
					  <b><?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <a href="consigneeview.php?id=<?=$rowselect['id']?>"><?=$rowselect['consigneename']?></a>
					  <?php
					  }
					  else
					  {
					  ?>
					  <a href="consigneeview.php?id=<?=$rowselect['id']?>">View</a>
					  <?php
					  }
					  ?></b><br><?=$rowselect['address1']?> <?=$rowselect['address2']?> <?=$rowselect['area']?> <?=$rowselect['district']?> <?=$rowselect['pincode']?><br><?=$rowselect['contact']?> <?=$rowselect['phone']?> <?=$rowselect['mobile']?> <?=$rowselect['email']?></td>
					  
					  <td><?=$rowproduct['stockmaincategory']?>-<?=$rowproduct['stocksubcategory']?>-<?=$rowproduct['stockitem']?></td>
					  <?php
					  }
					  else{
						  ?>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
						  <?php
						  
					  }
					  ?>
					  
					  
					  <td><?=$srls[$sr]?></td>
					  
<?php
$start    = (new DateTime($rowamc['datefrom']))->modify('first day of this month');
$end      = (new DateTime($rowamc['dateto']))->modify('first day of next month');
$interval = DateInterval::createFromDateString('1 month');
$period   = new DatePeriod($start, $interval, $end);

$amj="";
$jas="";
$ond="";
$jfm="";

foreach ($period as $dt) {
	$yemon=$dt->format("Y-m");
	$mon=$dt->format("m");
	
			$sqlcall = "SELECT calltid, callon From jrccalls where callon like '".$yemon."%' and consigneeid='".$rowselect['id']."' and reportedproblem='AMC MAINTENANCE' and serial='".$srls[$sr]."' order by id desc";
		$querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
         
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcall > 0) 
		{
			$rowcall = mysqli_fetch_array($querycall);
			if(($mon=="04")||($mon=="05")||($mon=="06"))
			{
				if($amj!="")
				{
					$amj.="<br><br><a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
				}
				else
				{
					$amj.="<a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
				}
			}
			if(($mon=="07")||($mon=="08")||($mon=="09"))
			{
				if($jas!="")
				{
				 $jas.="<br><br><a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
					
				}
				else
				{
					$jas.="<a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
					
				}
			}
			if(($mon=="10")||($mon=="11")||($mon=="12"))
			{
				if($ond!="")
				{
					$ond.="<br><br><a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
				}
				else
				{
					$ond.="<a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
				}
			}
			if(($mon=="01")||($mon=="02")||($mon=="03"))
			{
				if($jfm!="")
				{
					$jfm.="<br><br><a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
				}
				else
				{
					$jfm.="<a target='_blank' href='complaintprint1.php?id=".$rowcall['calltid']."'>".$rowcall['calltid']."</a><br>".date('d/m/Y',strtotime($rowcall['callon']));
				}
			}
		
		
	}
	
}
		
			
?>			  
					  <td><a target="_blank" href="complaintprint1.php?id=<?=$rowcall['calltid']?>"><?=$amj?></a></td>

					  <td><?=$jas?></td>
					  <td><?=$ond?></td>
					  <td><a target="_blank" href="complaintprint1.php?id=<?=$rowcall['calltid']?>"><?=$jfm?></a></td>
                    </tr>
					<?php
					$amcid=$rowamc['id'];
					
					
		}
					$count++;
					  }
		}
			}
			}
		}
			?>
					
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php
}
		}
		else
		{
?>	 
  <div class="col-lg-12 mb-2">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                     No AMC Records
                    </div>
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
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
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
						columns: [0,1,2,3,4,5,6,7]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: false,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7]
					}
			   }         
			]  
            });

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
<?php include('additionaljs.php');   ?>
</body>

</html>