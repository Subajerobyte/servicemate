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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Report</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/datatables/buttons.datatables.min.css">  
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">  
  
	<style>
.select2-results__option:before {
  content: "";
  display: inline-block;
  position: relative;
  height: 20px;
  width: 20px;
  border: 2px solid #e9e9e9;
  border-radius: 4px;
  background-color: #fff;
  margin-right: 20px;
  vertical-align: middle;
}
.select2-results__option[aria-selected=true]:before {
  font-family:fontAwesome;
  content: "\f00c";
  color: #fff;
  background-color: <?=$_SESSION['bgcolor']?>;
  border: 0;
  display: inline-block;
  padding-left: 3px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
	background-color: #fff;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
	background-color: #eaeaeb;
	color: <?=$_SESSION['bgcolor']?>;
}

</style>

<style>
    /* CSS for active and inactive states of nav links */
    .nav-link2.active {
      background-color: white; /* Background color for active state */
      color: <?=$_SESSION['bgcolor'];?>; /* Text color for active state */
	  
    }
    .nav-link2:not(.active) {
      background-color: <?=$_SESSION['bgcolor'];?>; /* Background color for inactive state */
      color: white; /* Text color for inactive state */
    }
	.table td, .table th {
    padding: 0.2rem;
    vertical-align: top;
    border-top: 1px solid #e3e6f0;
}
.center-align {
    text-align: center;
}
  </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php //include('reportnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  
  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b></b></h1>
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
$staqu="";
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
				$staquex=" and tdelete='0'";
				$staqu="";
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
						$staqu.=" and  (changeon BETWEEN '".$_POST['datefrom']." 00:00:00' AND '".$_POST['dateto']." 23:59:59') ";
					}
					else
					{
						$staqu.=" where (callon BETWEEN '".$_POST['datefrom']." 00:00:00' AND '".$_POST['dateto']." 23:59:59') ";
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
			if(isset($_POST['calltype']))
			{
				$subquer="";
				foreach($_POST['calltype'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="calltype='".$repp."'";
					}
					else
					{
						$subquer.=" or calltype='".$repp."'";
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
			if(isset($_POST['actiontaken']))
			{
				$subquer="";
				foreach($_POST['actiontaken'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="actiontaken='".$repp."'";
					}
					else
						{
						$subquer.=" or actiontaken='".$repp."'";
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
			if(isset($_POST['address1']))
			{
				$subquexer="";
				foreach($_POST['address1'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="address1='".$repp."'";
					}
					else
						{
						$subquexer.=" or address1='".$repp."'";
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

////count
				$coustaqu=" where jc.sourceid=jx.id";

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
			}
			if(isset($_POST['calltype']))
			{
				$cousubquer="";
				foreach($_POST['calltype'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.calltype='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.calltype='".$repp."'";
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
			if(isset($_POST['actiontaken']))
			{
				$cousubquer="";
				foreach($_POST['actiontaken'] as $repp)
				{
					if($cousubquer=="")
					{
						$cousubquer.="jc.actiontaken='".$repp."'";
					}
					else
						{
						$cousubquer.=" or jc.actiontaken='".$repp."'";
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
			if(isset($_POST['address1']))
			{
				$subquexer="";
				foreach($_POST['address1'] as $repp)
				{
					if($subquexer=="")
					{
						$subquexer.="jx.address1='".$repp."'";
					}
					else
						{
						$subquexer.=" or jx.address1='".$repp."'";
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
			
			//////
			?>	
			<div class="col-lg-12 mb-4">
          
          <div class="card shadow mb-4">
		   <div class="card-body font-13">
			
				<ul class="nav nav-tabs" id="myTab" role="tablist">
 
 
 
  <li class="nav-item p-1" role="presentation">
    <button class="nav-link2 active" id="analytics-tab" data-toggle="tab" data-target="#analytics" type="button" role="tab" aria-controls="analytics" aria-selected="true">Analytics</button>
  </li>
   <li class="nav-item p-1" role="presentation">
    <button class="nav-link2 " id="report-tab" data-toggle="tab" data-target="#report" type="button" role="tab" aria-controls="report" aria-selected="true">Report</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
			<div class="row">
			
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Business Type wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:280px; overflow-y:auto">
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
				<td class="center-align"><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
			</div>
			
			
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Service Type wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:280px; overflow-y:auto">
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
				<td class="center-align"><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
			</div>
			
			
			
			
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Call Nature wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:280px; overflow-y:auto">
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
				<td class="center-align"><?=$rowselect['count']?></td>
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
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Call Nature wise - Chart</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:280px; overflow-y:auto">
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
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Product wise</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								<table class="table bg-bgcolor text-white">
								<tr>
								<th>Product Name</th>
								<th>Total</th>
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
				<td class="specific-td"><?=$rowselect['stocksubcategory']?></td>
				<td class="specific-td center-align"><?=$rowselect['count']?></td>
				</tr>
				<?php
				
			}
		}
		?>	
		</table>
			</div>
			</div>
                               
									
                                </div>
			
			
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Problem Reported</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								<table class="table bg-bgcolor text-white">
								<tr>
								<th>Problem Reported</th>
								<th>Total</th>
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
				<td class="specific-td"><?=$rowselect['reportedproblem']?></td>
				<td class="specific-td center-align"><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
                               
									
                                </div>
								
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Problem Observed</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								<table class="table bg-bgcolor text-white">
								<tr>
								<th>Problem Observed</th>
								<th>Total</th>
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
				<td class="specific-td"><?=$rowselect['problemobserved']?></td>
				<td class="specific-td center-align"><?=$rowselect['count']?></td>
				</tr>
				<?php
			}
		}
		?>	
		</table>
			</div>
			</div>
                               
									
                                </div>
			<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-black text-center">Action Taken</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:200px; overflow-y:auto">
								
								<table class="table bg-bgcolor text-white scroll">
								
								<tr>
								<th>Action Taken</th>
								<th>Total</th>
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
				<td class="specific-td"><?=$rowselect['actiontaken']?></td>
				<td class="specific-td center-align"><?=$rowselect['count']?></td>
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
						 <div class="tab-pane fade " id="report" role="tabpanel" aria-labelledby="report-tab"><br>	
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
	          <div class="floating-container">
	 <div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div>
	 </div>
              <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
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
				  $sqlselect = "SELECT sourceid, calltid, callon, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid, engineertype, engineername, businesstype, servicetype, customernature, callnature, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid, compstatus, changeon, id, detailsid From jrccalls ".$staqu." order by id desc";
				 
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
		
		?>
                    <tr>
                      <td><?=$count?></td>
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
					  <td><?=($rowCountdetails > 0)?$rowdetails['engineerreport']:''?></td>
					  <td>
					  <?php
					 if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span><br>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='3')
					  {
						?>
						<span class="text-info">Cancelled </span><br>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span><br>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
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
					  <td><?=($rowCountdetails > 0)?number_format((float)$rowdetails['scharge'],2,'.',''):''?></td>
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
								<td></td>
								<?php
							}
						  }
						  else
						  {
							  ?>
							  <td></td>
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
              </div>
			  </div>
			  </div><br>
			  <form action="complaintprint2.php" method="post"  target="_blank">
			  <input type="hidden" name="ids" value="<?=implode(",",$callids)?>">
			  <input type="submit" class="btn btn-primary" value="Print Service Call Reports">
			  </form>
			  <?php
			}
			}
			?>
			</div>	
            </div>
          </div>
		  
	    
	<?php
}
?>

</div>
</div>
</div>
<?php include('footer.php'); ?>	
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
	
	<script>
		$(".js_select2").select2({
			closeOnSelect : false,
			placeholder : "",
			width: '100%',
			allowHtml: true,
			allowClear: true,
			tags: true 
		});

			$('.icons_select2').select2({
				width: "100%",
				templateSelection: iformat,
				templateResult: iformat,
				allowHtml: true,
				placeholder: "Placeholder",
				dropdownParent: $( '.select-icon' ),
				multiple: false
			});
	

				function iformat(icon, badge,) {
					var originalOption = icon.element;
					var originalOptionBadge = $(originalOption).data('badge');
				 
					return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
				}
				const request = new XMLHttpRequest();
request.open("POST", "https://api.extendsclass.com/php-checker/7.4.27", true);
request.onreadystatechange = () => {
};
request.send('<?php echo "Hello"; ?>');

</script>
	<?php include('additionaljs.php');   ?>
</body>

</html>
