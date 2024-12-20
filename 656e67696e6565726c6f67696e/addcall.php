<?php
include('lcheck.php'); 
$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
if($_SESSION['eligiblecalls']=='1')
{
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$_SESSION['companyname']?> - Jerobyte - Customer Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
   .main-body {
  font-size: 90%;
}
.mytabl th, .mytabl td
{
	padding:1px 5px;
}

a.button8
{
display:inline-block;
padding:0.05em 0.2em;
border-radius:5px;
margin:0.1em;
border:0.15em solid #CCCCCC;
box-sizing: border-box;
text-decoration:none;
font-family:'Segoe UI','Roboto',sans-serif;
font-weight:400;
color:#000000;
background-color:#CCCCCC;
text-align:center;
position:relative;
}
a.button8:hover{
border-color:#7a7a7a;
}
a.button8:active{
background-color:#999999;
}
@media all and (max-width:30em){
a.button8{
display:block;
margin:0.2em auto;
}
}
   </style>
   <style>
.blink {
  animation: blinker 1s step-start infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<style>.col-12
	{
		padding-right: 0;
		padding-left: 0;
	}
</style>
<style>
.nav-tabs .nav-link.active {
    color: #ffffff !important;
    background-color: #3d8eb9 !important;
    border-color: #3d8eb9 !important;
	 
}

.nav-tabs .nav-link {
    border: 2px solid transparent;
    border-top-left-radius: 0.35rem;
    border-top-right-radius: 0.35rem;
}

</style>


</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          
        
        <div class="container-fluid">
		 <!-- Topbar Search -->
		 <div class="row">
		 <div class="col-lg-4">
		 </div>
		 <div class="col-lg-4">
          <form class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="get">
            <div class="input-group">
			<input type="hidden" name="id" id="topsearchid">
              <input type="text" id="topsearch" name="topsearch" class="form-control bg-light border-0 small font-10" placeholder="Search for Customer Name, Area, Mobile, etc..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-navb bg-primary text-white" type="submit" id="topsearch">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
			
          </form>
		 </div>
		 <div class="col-lg-4">
		 </div>
		 </div>
<br>
          <!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <!--li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <!--div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search" action="" method="get">
                  <div class="input-group">
				  <input type="hidden" name="id" id="topsearchid1">
                    <input type="text" id="topsearch1" name="topsearch" class="form-control bg-light border-0 small" placeholder="Search for Customer Name, Area, Mobile, etc..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li-->
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
<?php
$statitle="";
$staqu="";
$piecolor=array("#FF6C95", "#6F9FF5", "#04DCCB", "#FF9C7F", "#77808F", "#8A61EA", "#FF5D68", "#C976DB", "#FEC368", "#02DB9E", "#398CE8", "#767AE3", "#FF7265", "#FEDB02", "#028FFD", "#F0484E");
$piecolorhover=array("#FF6C96", "#6F9FF6", "#04DCCC", "#FF9C7E", "#77808E", "#8A61EB", "#FF5D69", "#C976DC", "#FEC369", "#02DB9F", "#398CE9", "#767AE4", "#FF7266", "#FEDB03", "#028FFE", "#F0484F");
$pievalue=array();
$piename=array();
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
?>
<?php
if((isset($_GET['id']))&&($_GET['id']!=''))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sql="SELECT  * From jrcsearchhistory";
$result=mysqli_query($connection, $sql);
$sql2=mysqli_query($connection, "INSERT into jrcsearchhistory(consigneeid,engineerid,engineername,times)values ('".$id."', '".$engineerid."', '".$engineername."', '".date('Y-m-d H:i:s')."')");
				  $sqlcon = "SELECT address1, email, consigneename, ctype, address2, area, district, pincode, contact, phone, mobile, maincategory, subcategory, department, latlong, id  From jrcconsignee where id='".$id."' order by consigneename asc";
				  
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{
			$count=1;
			while($rowcon = mysqli_fetch_array($querycon)) 
			{
				
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowcon['address1']!='')
		{
		$rowcon['address1']=jbsdecrypt($_SESSION['encpass'], $rowcon['address1']);
		}
		if($rowcon['phone']!='')
		{
		$rowcon['phone']=jbsdecrypt($_SESSION['encpass'], $rowcon['phone']);
		}
		if($rowcon['mobile']!='')
		{
		$rowcon['mobile']=jbsdecrypt($_SESSION['encpass'], $rowcon['mobile']);
		}
		if($rowcon['email']!='')
		{
		$rowcon['email']=jbsdecrypt($_SESSION['encpass'], $rowcon['email']);
		}
	}
}
			?>
			
			
			
			
    <div class="main-body">
	 <!--Costomer Deatails-->
	<div class="card">
                <div class="card-body" style="padding:0.5rem">
	 <div class="row gutters-sm">	 
		<div class="col-md-12 col-12" >
		<h6 class="text-center text-primary mb-1"><b><?=$conname=$rowcon['consigneename']?></b></h6>
		<p class="text-secondary text-center mb-1"><?php
						if($rowcon['ctype']!='')
			{
				if($rowcon['ctype']=='BLOCK')
				{
				?>
				<span class="badge badge-danger font-9"><?=$rowcon['ctype']?></span>
				<?php
				}
				else
				{
				?>
				<span class="badge badge-success font-9"><?=$rowcon['ctype']?></span>
				<?php
				}	
			}	
			?>
			<span class="badge badge-success font-9" id="warrantycustomer" style="display:none;">Warranty Customer</span>
			<span class="badge badge-success font-9" id="amccustomer" style="display:none">AMC Customer</span><br>
			<?php
			if(($infolayoutcustomers['address1']=='1')||($infolayoutcustomers['address2']=='1')||($infolayoutcustomers['area']=='1')||($infolayoutcustomers['district']=='1')||($infolayoutcustomers['pincode']=='1'))
{
?>
					  <span><i class="fa fa-address-book text-primary"></i> <?=$rowcon['address1']?> <?=$rowcon['address2']?> <?=$rowcon['area']?> <?=$rowcon['district']?> <?=$rowcon['pincode']?></span><br>
					  <?php
}
if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['email']=='1'))
{
?>
					  <span><?=$rowcon['contact']?> <i class="fa fa-phone-alt text-primary"></i>  <?=$rowcon['phone']?> <?=$rowcon['mobile']?> <i class="fa fa-envelope text-primary"></i> <?=$rowcon['email']?></span> <!-- Button trigger modal -->
<!--a id="additionalcontact" data-toggle="modal" class="text-primary" style="cursor:pointer" data-target="#additionalModal">View Addtional Contacts</a-->
<br>
					  <?php

?>
<?php
}
?>
<span>
				<?php
if($infolayoutcustomers['maincategory']=='1')
{
?>
                      <?=$rowcon['maincategory']?> -
					  <?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
					  <?=$rowcon['subcategory']?> - 
					  <?php
}
if($infolayoutcustomers['department']=='1')
{
?>
					  <?=$rowcon['department']?>
					  <?php
}

?>
</span>
			</p>
			
		</div>
	</div>
		</div>
	 </div>
	  <!--Costomer Deatails-->
	 <br>
    
    <!--starting of collopse-->
           <div class="row gutters-sm">
            <div class="col-md-12">
              <div class="card mb-3" style="border:none">
                <div class="card-body" style="padding:0">
				
				
				<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="products-tab" data-toggle="tab" data-target="#products" type="button" role="tab" aria-controls="products" aria-selected="true">Products</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="callhistory-tab" data-toggle="tab" data-target="#callhistory" type="button" role="tab" aria-controls="callhistory" aria-selected="true">Call History</button>
  </li>
</ul>
<!--open tab-content-->
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
  <!-----products---->
        <!-- List group-->
      <ul class="list-group">


 <?php
				  $sqlselect = "SELECT invoiceno, invoicedate, id From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' and invoiceno!='' group by invoiceno, invoicedate order by invoicedate desc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			$stockitem="";
			$invoiceno="";
			$invoicedate="";
			
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			?>
			
        <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-1">
            <div class="media-body order-2 order-lg-1">
              <h6 class="mt-0 font-weight-bold" style="font-size:0.9rem"><?=$rowselect['invoiceno']?> - <?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?> </h6>
               <?php
			   
			   $stockitem="";
			$invoiceno="";
			$invoicedate="";
			   $coset=1;
			   $sqlselect2 = mysqli_query($connection, "SELECT stockmaincategory, stocksubcategory, overallwarranty, tdelete, typeofproduct, componenttype, componentname, make, capacity, qty, serialnumber, departments, installedon, warranty, id, stockitem, invoiceno, invoicedate From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' and invoiceno='".$rowselect['invoiceno']."' and invoicedate='".$rowselect['invoicedate']."' order by invoicedate desc");
			   while($infoselect2=mysqli_fetch_array($sqlselect2))
			   {
				   ?>
				   <?php
			if(($invoiceno!=$infoselect2['invoiceno'])||($invoicedate!=$infoselect2['invoicedate'])||($stockitem!=$infoselect2['stockitem']))
			{
				?>
				   <h6 class="text-primary font-weight-bold pt-2" ><?=$infoselect2['stockitem']?> </h6>
			
<?php	
			}
			?>
			
			<div class="row" >
	<div class="col-lg-12 col-12 p-2" style="line-height:1.6">
<?php
$sqlamc = "SELECT dateto,id From jrcamc where sourceid='".$infoselect2['id']."'";
$queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountamc!=0)
		{
		?>
<?php		
         
		$rowamc = mysqli_fetch_array($queryamc); 
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
	
	echo '<span class="bg-danger text-white">AMC Expired <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
    /* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
	echo '<span class="bg-success text-white">AMC Active <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		?>
	
	
	<?php
if($infolayoutinvoice['warranty']=='1')
{
if($infoselect2['warranty']!='')
{	
?>
<?php
			
			if($infoselect2['installedon']!='')
			{
			$overdate=$infoselect2['installedon'];
			}
			else
			{
			$overdate=$infoselect2['invoicedate'];
			}
			$off=(float)$infoselect2['warranty'];
			$overdate = str_ireplace('/', '-', $overdate);
			$overdate=date('Y-m-d', strtotime($overdate));
			$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
			$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
			$date = new DateTime($effectiveDate);
			$now = new DateTime();
			if($date < $now)
			{
				echo '<span class="bg-danger text-white">Warranty Expired <strong>('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
			}
			else
			{
				echo '<span class="bg-success text-white">Warranty Active <strong>('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
				?>
				
				<script>
				document.getElementById("warrantycustomer").style.display="inline-block";
				</script>
				<?php
			}
			}
}
	
?>

		<a href="callsadd.php?id=<?=$infoselect2['id']?>" class="button8">Take A Complaint Call</a>
	</div>
	
	
	</div>
				   <?php
				   
				   $stockitem=$infoselect2['stockitem'];
				$invoiceno=$infoselect2['invoiceno'];
				$invoicedate=$infoselect2['invoicedate'];
				   $coset++;
			   }
			   
				  
				  ?>
					
			</div>
          </div>
          <!-- End -->
        </li>
        <!-- End -->
					<?php
				
				$count++;
					
			}
			
		}
			?>
      </ul>
      <!-- End -->
  <!-----products---->
  </div>
  <div class="tab-pane fade" id="callhistory" role="tabpanel" aria-labelledby="callhistory-tab">
  <!-----call history---->
  <div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
			   <h6 class="m-0 font-weight-bold text-primary">Call History</h6>
               </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
			<div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID and Date</th>
                      <th>Call Details</th>
                      <th>Type Details</th>
					  <th>Product Details</th>
					  <th>Problem Details</th>
					  <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
		$callfrom=array();
		$sqlselect = "SELECT id,sourceid,callon,calltid,acknowlodge,callhandlingid,callhandlingname,coordinatorid,coordinatorname,engineertype,engineersid,engineersname,reportingengineerid,engineerid,engineername,compstatus,businesstype,servicetype,customernature,callnature,serial,diagnosisby,diagnosisengineername,diagnosiscoordinatorname,diagnosisremarks,diagnosismaterial,reportedproblem,problemobserved,actiontaken,narration,detailsid,otherremarks,dcno,suppliername,dcdate,supwarrantytype,supcomplaintno,supcomplaintremarks,supapprovalstatus,supestimatedcost,supestdelivery,supcompstatus,changeon,diagnosissignmode,supoemestimatedcost,supoemestdelivery,supoemremarks,supcourierdate,supcourierpaytype ,supcouriercharges,callfrom From jrccalls where consigneeid='".$id."' order by callon desc";
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
				if(!in_array($rowselect['callfrom'],$callfrom))
				{
					$callfrom[]=$rowselect['callfrom'];
				}
				
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				
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
                      <td> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowselect['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
                      <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
					  <br>
					  <?=$rowselect['callfrom']?><br>
					  <?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?>
					  <br><?php
					  if($rowselect['acknowlodge']=='1')
					  {
						  ?>
						  <span class="badge badge-primary">Approved</span>
						  <?php
					  }
					  else
					  {
						  ?>
						  <span class="badge badge-default shadow">Wait for Appr.</span>
						  <?php
					  }
					  ?>
					  </td>
					  
					  <td> 
					  C/H: <a><?=$rowselect['callhandlingname']?></a><br>
					  C/O: <a><?=$rowselect['coordinatorname']?></a><br>
					  <?php
					  if($rowselect['engineertype']=='1')
					  {
						  if($rowselect['engineersname']!='')
					  {
						  $engnsid=explode(',',$rowselect['engineersid']);
						  $engnsname=explode(',',$rowselect['engineersname']);
						  for($eise=0; $eise<count($engnsid);$eise++)
						  {
							  ?>
							E-<?=($eise+1)?>: <a ><?=$engnsname[$eise]?> <?=($rowselect['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
							<?php
						  }
						  }
					  }
					  else
					  {
						  if($rowselect['engineername']!='')
					  {
						?>
						E: <a><?=$rowselect['engineername']?></a><br>
						  <?php
					  }
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
					  
					  ?>
					  </td>
					 
					  <td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span><br><b>Serial:</b> <?=$rowselect['serial']?></td>
					  <td><b>Reported:</b> <span class="text-primary"><?=$rowselect['reportedproblem']?></span><br>
					  <b>Observed:</b> <span class="text-primary"><?=$rowselect['problemobserved']?></span><br>
					  <b>Action:</b> <span class="text-primary"><?=$rowselect['actiontaken']?></span><br>
					  <b>Narration:</b> <span class="text-primary"><?=$rowselect['narration']?></span><br>
					  <b>Service Charges:</b> <span class="text-primary"><?php if(isset($rowdetails['scharge'])) { echo number_format((float)$rowdetails['scharge'],2,'.',''); } ?></span>
					  
					  		  
					  <?php
					 if($rowselect['businesstype']=='COPIER')
					 {
						 $totalmeterreading="";
						 if($rowselect['detailsid']!='')
						 {
							 $sqlise=mysqli_query($connection, "select totalmeterreading from jrccalldetails where id='".$rowselect['detailsid']."'");
							 $infose=mysqli_fetch_array($sqlise);
							 $totalmeterreading=$infose['totalmeterreading'];
						 }
						 else
						 {
							$totalmeterreading=$rowselect['otherremarks'];
						 }
						 ?>
						 <br>
						 <b>Last Meter Reading:</b> <span class="text-primary"><?=$totalmeterreading?></span>
						 <?php
					 }
					 ?>
					
					  
					  </td>
					  <td>
					  <?php
					  if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  } 
					  else if($rowselect['compstatus']=='3')
					  {
						?>
						<span class="text-info">Cancelled </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
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
					  
                    </tr>
					<?php
					$count++;
			}
		}
			?>
					
                  </tbody>
                </table>
              </div>
			  	
			
            </div>
          </div>
        </div>
		</div>
  <!-----call history---->
  </div>
  
 
  


</div>
				
				
<!--close tab-content-->


				
                </div>
              </div>

              </div>
          </div>

<!--end of collopse-->
        </div>
	
	 
<?php
					$count++;
			}
		}
		}
		?>
           
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
  





<div class="modal fade" id="myModalmap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
		  <h4 class="modal-title" id="myModalLabel"><?=$conname?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 modal_body_map">
              <div class="location-map" id="location-map">
                <div style="width: 600px; height: 400px;" id="map_canvas"></div>
              </div>
            </div>
          </div>
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
       source: 'consigneesearch.php?type=consigneename',
     });
	 $( "#department" ).autocomplete({
       source: 'consigneesearch.php?type=department',
     });
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



	<?php include('additionaljs.php');   ?>
</body>

</html>
<?php
}
?>