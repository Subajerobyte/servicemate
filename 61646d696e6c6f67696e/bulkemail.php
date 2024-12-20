<?php
include('lcheck.php'); 
if($addconsignee=='0')
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Bulk E-mails</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/datatables/buttons.datatables.min.css">  
  <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
  
   <script src="../../1637028036/vendor/ckeditor/ckeditor.js"></script>
   <script src="../../1637028036/vendor/ckeditor/samples/js/sample.js"></script>
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
	<style>
	pre code {
  background-color: #eee;
  border: 1px solid #999;
  display: block;
  padding: 5px;
}
p
{
	margin-bottom:0.5rem;
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
          <?php include('officialnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  
		    <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Bulk E-mails</b></h1>
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


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
            </div>-->
            <div class="card-body">
<form action="" method="post">		
<div class="row">
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
if($infolayoutcustomers['address2']=='1')
{
?>
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
if($infolayoutcustomers['contact']=='1')
{
?>
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
<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
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
<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
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
<?php
}
?>
  </div>
  <?php
	if($secsystem=='1')
	{
	?>
  <hr>
  <div class="alert alert-info">To View Consignee Details you must validate yourself by enter your Password</div>
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
						

?>	
<br>
 <form action="newmail.php" method="post" enctype="multipart/form-data">	
 <div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
<label><input type="checkbox" id="ckbCheckAll" checked /> Select All</label>
  
                <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th>S.No</th>
					  <?php
if($infolayoutcustomers['maincategory']=='1')
{
?>
                      <th>Main Category</th>
<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>					  
					  <th>Sub Category</th>
					  <?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>	
                      <th>Customer Name</th>
					  <?php
}
if($infolayoutcustomers['department']=='1')
{
?>	
					  <th>Department</th>
					  <?php
}
if(($infolayoutcustomers['address1']=='1')||($infolayoutcustomers['address2']=='1')||($infolayoutcustomers['area']=='1')||($infolayoutcustomers['district']=='1')||($infolayoutcustomers['pincode']=='1')||($infolayoutcustomers['latlong']=='1'))
{
?>	
                      <th>Address</th>
					  <?php
}
if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['email']=='1'))
{
?>	
					  <th>Contact</th>
					  <?php
}
?>	
					  <th>Email</th>
					  <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
		<?php
		$sqlselect = "SELECT address1,phone,mobile,email,id,maincategory,subcategory,consigneename,department,address2,area,district,pincode, latlong,contact From jrcconsignee ".$staqu." order by consigneename asc";
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
			?>
                    <tr>
					 <td><?=$count?> <input type="checkbox" class="clb" name="checkboxs[]" id="checkboxs<?=$rowselect['id']?>" value="<?=$rowselect['id']?>" checked /></td>
					 <?php
if($infolayoutcustomers['maincategory']=='1')
{
?>
                      <td><?=$rowselect['maincategory']?></td>
					  <?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
					  <td><?=$rowselect['subcategory']?></td>
					  <?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
					  <?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['id']?>"><?=$rowselect['consigneename']?></a></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['id']?>">View</a></td>
					  <?php
					  }
					  ?>
					  <?php
}
if($infolayoutcustomers['department']=='1')
{
?>
					  <td><?=$rowselect['department']?></td>
<?php
}
if(($infolayoutcustomers['address1']=='1')||($infolayoutcustomers['address2']=='1')||($infolayoutcustomers['area']=='1')||($infolayoutcustomers['district']=='1')||($infolayoutcustomers['pincode']=='1')||($infolayoutcustomers['latlong']=='1'))
{
?>						  
					  <td><?=$rowselect['address1']?> <?=$rowselect['address2']?> <?=$rowselect['area']?> <?=$rowselect['district']?> <?=$rowselect['pincode']?> <?=$rowselect['latlong']?></td>
<?php
}
if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['email']=='1'))
{
?>					  
					  <td><?=$rowselect['contact']?> <?=$rowselect['phone']?> <?=$rowselect['mobile']?></td>
<?php
}
?>					  
                      <td><?=$rowselect['email']?></td>
					  <td><a href="consigneeedit.php?id=<?=$rowselect['id']?>" target="_blank">Edit</td>
                    </tr>
					<?php
					$count++;
			}
		}
			?>
					
                  </tbody>
                </table>
              </div>
			  
			  </br>		  
 			  <?php
			  $sqlselect = "SELECT mailname From jrccompany order by id asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		$rowselect1 = mysqli_fetch_array($queryselect);
		?>
	<div class="row">
	<div class="col-lg-8">
	<div class="form-group">
    <label for="senderemail">From</label>
	<?php
	if($_SESSION['mailer']=="1")
	{
	?>
     <input type="email" class="form-control" id="senderemail" name="senderemail" value="<?=$rowselect1['mailname']?>">
	 <?php
	}
	else
	{
	?>
     <input type="email" class="form-control" id="senderemail" name="senderemail" value="alerts@jerobyte.com">
    <?php
	}
    ?>	 
  </div>
  <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" required value="">
  </div>	
	
  <div class="form-group">
    <label for="editor">Message</label>
	<textarea id="editor" name="editor" required>
	</textarea>
	</div>
	
	</div>
	<div class="col-lg-4">
	<h4>Variable Codes</h4>
	<span id="messagetip" class="text-primary"></span>
	<p>Name: <pre><code id="selectable" onclick="selectText('selectable')">&lt;consigneename&gt;</code></pre></p>
	<p>Main Category: <pre><code id="selectable2" onclick="selectText('selectable2')">&lt;maincategory&gt;</code></pre></p>
	<p>Sub Category: <pre><code id="selectable5" onclick="selectText('selectable5')">&lt;subcategory&gt;</code></pre></p>
	<p>Address : <pre><code id="selectable1" onclick="selectText('selectable1')">&lt;district&gt;</code></pre></p>
	</div>
	</div>		
	  <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3"><i class="fa fa-print"></i> Send Mail</button>
  </form>
			  
            </div>
          </div>
<?php
}
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

  <!-- Page level custom scripts -->
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
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "paging": false,
                "processing": true,
                dom: 'Blfrtip',
				<?php
				if($exportconsignee=='1')
				{
				?>	
				buttons: [
			   {
				   extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
				   orientation: 'landscape',
				   footer: true,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: false,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6]
					}
			   } 
			   <?php 
				}
				?>
			   
			]  
            });

        });
		
		
    </script>
	<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
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
function refselect()
{
	if ($('select').data('select2')) {
   $('select').select2('destroy');
 }
}
</script>

<script type="text/javascript">
/*     $(document).ready(function () {
 
      $('.btn-popup').click(function () {
        var custId = $(this).data('id');
        $.ajax({
          url: 'postingget_data.php',
          type: 'post',
          data: { custId: custId },
          success: function (response) {
            $('.modal-body').html(response);
			refselect();
            $('#custModal').modal('show');
		  }
        });
      });
 
    }); */
  </script>
<script type="text/javascript"> 
function selectText(containerid) {
    if (document.selection) { // IE
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select();
		var copy=document.execCommand("Copy");
		var copied=document.getElementById(containerid).innerHTML;
		document.getElementById("messagetip").innerHTML="Variable "+copied+" Copied.. <br>Paste by usnig Ctrl + V at Editor";
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
		var copy=document.execCommand("Copy");
		var copied=document.getElementById(containerid).innerHTML;
		document.getElementById("messagetip").innerHTML="Variable "+copied+" Copied.. <br>Paste by usnig Ctrl + V at Editor";
    }
}
</script>
<script>
function checkvalidate()
{
	var data = CKEDITOR.instances.editor.getData();
	if ($('.clb:checked').length ==0)
	{
		  alert('Select any Post to Share');
		  return false;
	}
	else if(data=='')
	{
		alert('Letter content is Empty! Please Provide needed Information');
		return false;
	}
	else
	{
		var a=confirm('Are you sure want to Print this Letter?');
		if(a==true)
		{
		return true;
		}
		else
		{
			return false;
		}
	}
}
</script>
  <script>
//select all checkboxes
$("#select_all").change(function(){  //"select all" change 
	var status = this.checked; // "select all" checked status
	$('.clb').each(function(){ //iterate all listed checkbox items
		this.checked = status; //change ".checkbox" checked status
	});
});

$('.clb').change(function(){ //".checkbox" change 
	//uncheck "select all", if one of the listed checkbox item is unchecked
	if(this.checked == false){ //if this item is unchecked
		$("#select_all")[0].checked = false; //change "select all" checked status to false
	}
	
	//check "select all" if all checkbox items are checked
	if ($('.clb:checked').length == $('.clb').length ){ 
		$("#select_all")[0].checked = true; //change "select all" checked status to true
	}
});
</script>
<script>
CKEDITOR.replace('editor', {
height:375,
filebrowserUploadUrl:"upimg.php",
filebrowserUploadMethod:"form"
})
</script>
<script>
 $("#ckbCheckAll").click(function () {
    $(".clb").prop('checked', $(this).prop('checked'));
});
 </script>
 <?php include('additionaljs.php');   ?>
</body>

</html>