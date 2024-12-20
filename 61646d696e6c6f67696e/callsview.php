<?php
include('lcheck.php'); 

$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
$sqllayoutcall=mysqli_query($connection, "select * from jrclayoutcall");
$infolayoutcall=mysqli_fetch_array($sqllayoutcall);
if($calladd=='0')
{
	header("location: dashboard.php");
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
  <title><?=$_SESSION['companyname']?> - Jerobyte - View Complaint Call</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
   <style>
		.ajax-upload-dragdrop, .ajax-file-upload-statusbar
		{
			width: 100% !important;
		}
		</style>
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
</head>
<body id="page-top" onLoad="checkcarry(); checkdiagnosis()">
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">View Complaint Call</h1>
            <a href="calls.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Complaint Call</a>
          </div>

<?php
$id='';
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlcalls = "SELECT sourceid, id, startip, startiptime, endiptime, endip, kms, pendingon1, pendingon2, pendingon3, detailsid, businesstype, servicetype, customernature, calltype, callnature, callfrom, callon, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineernamem, engineerid, engineername, otherremarks, serial, diagnosisby, diagnosisengineername, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial, problemobserved, servicereportno, estimatedcost, materialtracking, actiontaken, compstatus, narration, visitremarks, customersms, callhandledsms, coordinatorsms, engineersms, calltid  From jrccalls where id='".$id."'";
}
if(isset($_GET['calltid']))
{
$id=mysqli_real_escape_string($connection,$_GET['calltid']);
$sqlcalls = "SELECT sourceid, id, startip, startiptime, endiptime, endip, kms, pendingon1, pendingon2, pendingon3, detailsid, businesstype, servicetype, customernature, calltype, callnature, callfrom, callon, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineernamem, engineerid, engineername, otherremarks, serial, diagnosisby, diagnosisengineername, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial, problemobserved, servicereportno, estimatedcost, materialtracking, actiontaken, compstatus, narration, visitremarks, customersms, callhandledsms, coordinatorsms, engineersms, calltid  From jrccalls where calltid='".$id."'";
}
if($id!='')
{
        $querycalls = mysqli_query($connection, $sqlcalls);
        $rowCountcalls = mysqli_num_rows($querycalls);
        if(!$querycalls){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcalls > 0) 
		{
			$count=1;
			while($rowcalls = mysqli_fetch_array($querycalls)) 
			{
$sourceid=mysqli_real_escape_string($connection,$rowcalls['sourceid']);
				  $sqlselect = "SELECT consigneeid, invoiceno, invoicedate, invoicedate, id  From jrcxl where tdelete='0' and  id='".$sourceid."' order by consigneename asc";
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
			<div class="row">
        <div class="col-xl-12 order-xl-1 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
		  
		  <?php
		  $sqlcon = "SELECT consigneename, ctype, address1, address2, area, district, pincode, contact, phone, mobile, email, maincategory, subcategory, department, latlong, id From jrcconsignee where id='".$rowselect['consigneeid']."' order by consigneename asc";
				  
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
	$rowcon = mysqli_fetch_array($querycon);
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
		  
		  <div class="card">
                <div class="card-body" style="padding:0.5rem">
	 <div class="row gutters-sm">
		<div class="col-md-2">
		<img src="../img/avatar.png" alt="Admin" class="rounded-circle" width="108">
		</div>	 
		<div class="<?=($rowcon['latlong']!='')?"col-md-6":"col-md-10"?>" >
		<h4 class="text-center text-primary mb-1"><?=$conname=$rowcon['consigneename']?> <a href="consigneeedit.php?id=<?=$rowcon['id']?>" ><i class="fa fa-edit"></i></a></h4>
		<p class="text-secondary text-center mb-1"><?php
						if($rowcon['ctype']!='')
			{
				if($rowcon['ctype']=='BLOCK')
				{
				?>
				<span class="badge badge-danger font-13"><?=$rowcon['ctype']?></span>
				<?php
				}
				else
				{
				?>
				<span class="badge badge-success font-13"><?=$rowcon['ctype']?></span>
				<?php
				}	
			}	
			?>
			<span class="badge badge-success font-13" id="warrantycustomer" style="display:none;">Warranty Customer</span>
			<span class="badge badge-success font-13" id="amccustomer" style="display:none">AMC Customer</span><br>
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
					  <span><?=$rowcon['contact']?> <i class="fa fa-phone text-primary"></i>  <?=$rowcon['phone']?> <?=$rowcon['mobile']?> <i class="fa fa-envelope text-primary"></i> <?=$rowcon['email']?></span><br>
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
		<?php 
												  if($rowcon['latlong']!='')
												  {
													  $ll=explode(',',$rowcon['latlong']);
													  ?>
													 
													  
				<div class="col-md-4">
                <iframe 
  frameborder="0" 
  scrolling="no" 
  marginheight="0" 
  marginwidth="0" 
  height="108"
  src="https://maps.google.com/maps?q=<?=$ll[0]?>,<?=$ll[1]?>&hl=en&z=14&amp;output=embed"
 >
 </iframe>
              </div>
													  
													  <?php
												  }
												  ?>
		
		
		</div>
		</div>
	 </div>
		  
		  
		  
		  </div>
        </div>
		</div><br>
		
		
		<div class="row gutters-sm">
            <div class="col-md-12">
              <div class="card mb-3" style="border:none">
                <div class="card-body" style="padding:0">
				
				


      <!-- List group-->
      <ul class="list-group">

		
        <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-1">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold" style="font-size:1.1rem"><?=$rowselect['invoiceno']?> - <?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?> <a href="invoiceedit.php?id=<?=$rowselect['id']?>"><i class="fa fa-edit"></i></a> </h5>
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
				   <h6 class="text-primary font-weight-bold pt-2" style="border-bottom: 1px solid #cccccc"><?=$infoselect2['stockitem']?> </h6>
			<?php
			if(($infolayoutproducts['stockmaincategory']=='1')||($infolayoutproducts['stockmaincategory']=='1'))
{
if($infoselect2['stockmaincategory']!="")
{	
?>	
<b>Main Category: </b><?=$infoselect2['stockmaincategory']?> &nbsp; &nbsp;
<?php
}
if($infoselect2['stocksubcategory']!="")
{	
?>	
<b>Sub Category: </b> <?=$infoselect2['stocksubcategory']?> &nbsp; &nbsp;
<?php
}
?>

<?php
}
if($infolayoutinvoice['overallwarranty']=='1')
{
?>
			<b>Overall Warranty: </b><?=$infoselect2['overallwarranty']?>
			<?php
			if($infoselect2['overallwarranty']!='')
			{
				if($infoselect2['installedon']!='')
				{
				$overdate=$infoselect2['installedon'];
				}
				else
				{
				$overdate=$infoselect2['invoicedate'];
				}
				$off=(float)$infoselect2['overallwarranty'];
				$overdate = str_ireplace('/', '-', $overdate);
				$overdate=date('Y-m-d', strtotime($overdate));
				$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
				$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
				$date = new DateTime($effectiveDate);
				$now = new DateTime();
				if($date < $now) 
				{
					echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
				else
				{
					echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
			}
}
?>
<?php	
			}
			?>
			
			<div class="row" style="background-color:#f1f1f1">
			<div class="col-lg-10 p-2">
			<table width="100%" class="mytabl">
			<tr>
			<th rowspan="4" style="width:40px; background-color:#8d8d8d !important; color:#ffffff; text-align:center"><?=$coset?>
			<?php
					  if($deleteproduct=='1')
					  {
						  ?>
					  <a href="invoicedelete.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>&tdelete=<?=$infoselect2['tdelete']?>" onclick="return confirm('Are you sure want to Delete this Product')" class="button8"><i class="fa fa-trash"></i></a>
					  <?php
					  }
					  ?>
			
			</th>
			<?php 
			  
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{	
?>
<th>Type of Product</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{		
?>
<th>Component Type</th>
<?php
}
}
?>	
<?php 
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{	
?>
<th>Component Name</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{	
?>
<th>Make</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{	
?>
<th>Capacity</th>
<?php
}
}
if($infolayoutinvoice['qty']=='1')
{
		?>
<th>Qty</th>
		<?php
}
if($infolayoutinvoice['warranty']=='1')
{
		?>
<th>Warranty</th>
		<?php
}
?>
			</tr>
			<tr>
			
			<?php 
			$colsp=0;  
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{	
?>
<td><?=$infoselect2['typeofproduct']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{		
?>
<td><?=$infoselect2['componenttype']?></td>
<?php
$colsp++;
}
}
?>	
<?php 
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{	
?>
<td><?=$infoselect2['componentname']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{	
?>
<td><?=$infoselect2['make']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{	
?>
<td><?=$infoselect2['capacity']?></td>
<?php
$colsp++;
}
}
if($infolayoutinvoice['qty']=='1')
{
		?>
<td><?=$infoselect2['qty']?></td>
		<?php
		$colsp++;
}
if($infolayoutinvoice['warranty']=='1')
{
		?>
<td><?=$infoselect2['warranty']?> Months</td>
		<?php
		$colsp++;
}
?>
			</tr>
		
<?php
if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
	?>
	<tr>
	<th colspan="<?=$colsp?>">Serial Number</th>
	</tr>
	<tr>
	<td colspan="<?=$colsp?>">
	<?php
					  $srls=explode("| ",$infoselect2['serialnumber']);
					  $dpts=explode("| ",$infoselect2['departments']);
					  for($sr=0;$sr<count($srls);$sr++)
					  {
						  if(isset($srls[$sr]))
						  {
							  echo ' '.$srls[$sr];
						  }
						  if(isset($dpts[$sr]))
						  {
							  echo '-'.$dpts[$sr].', &nbsp; ';
						  }
						  
					  }
					  ?>
					  </td>
					  </tr>
					  <?php
}
?>		
	
			</table>
	
	</div>
	<div class="col-lg-2 p-2" style="line-height:1.6">
	
	
<?php
$sqlamc = "SELECT dateto From jrcamc where sourceid='".$infoselect2['id']."'";
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
	echo '<span class="bg-success text-white">Warranty Active <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		else
		{
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
		}
?>

		<a href="callsadd.php?id=<?=$infoselect2['id']?>" class="button8">Take A Complaint Call</a>
					  <?php
					  if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
	?>
					  <a href="serialnumberedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" class="button8">Edit Serials</a>
					  <?php
}
?>
					  <a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" class="button8">Add to AMC</a> 
					  
	
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
					
      </ul>
      <!-- End -->
				
                </div>
              </div>

              </div>
          </div>

		
		
		
		<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>Call History</h5>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
			 <div class="table-responsive font-13">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                   <tr>
                      <th>S.No</th>
                      <th>Call ID and Date</th>
                      <th>Call Details</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Problem Details</th>
					  <th>Status</th>
					  <?php
					  if($calledit=='1')
					  {
						?>  
					  <th>Action</th>
					  <?php
					  }
					  ?>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
		$sqlcall = "SELECT sourceid, callon, calltid, acknowlodge, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineersid, engineersname, reportingengineerid, engineerid, engineername, businesstype, servicetype, customernature, callnature, serial, reportedproblem, problemobserved, actiontaken, narration, changeon, compstatus, id  From jrccalls where sourceid='".$sourceid."' order by id desc";
		$querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcall > 0) 
		{
			$count=1;
			while($rowcall = mysqli_fetch_array($querycall)) 
			{
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowcall['sourceid']."' order by id asc";
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
		?>
                    <tr>
                      <td> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
                      <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowcall['calltid'];?>')"><?=$rowcall['calltid']?></a>
					  <br>
					  <?=date('d/m/Y h:i:s a', strtotime($rowcall['callon']))?>
					  <br><?php
					  if($rowcall['acknowlodge']=='1')
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
					  C/H: <a href="callhandlingview.php?id=<?=$rowcall['callhandlingid']?>"><?=$rowcall['callhandlingname']?></a><br>
					  C/O: <a href="coordinatorview.php?id=<?=$rowcall['coordinatorid']?>"><?=$rowcall['coordinatorname']?></a><br>
					  <?php
					  if($rowcall['engineertype']=='1')
					  {
						  $engnsid=explode(',',$rowcall['engineersid']);
						  $engnsname=explode(',',$rowcall['engineersname']);
						  for($eise=0; $eise<count($engnsid);$eise++)
						  {
							  ?>
							E-<?=($eise+1)?>: <a href="mapengineerview.php?id=<?=$engnsid[$eise]?>&attdate=<?=date('Y-m-d')?>"><?=$engnsname[$eise]?> <?=($rowcall['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
							<?php
						  }
						
					  }
					  else
					  {
						?>
						E: <a href="mapengineerview.php?id=<?=$rowcall['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowcall['engineername']?></a><br>
						  <?php
					  }
					  ?>
					  <?php
					   if($rowcall['businesstype']!='')
					   {
							   ?>
							 <span class="btn btn-sm btn-success"><?=$rowcall['businesstype']?></span><br>
							 <?php						  
					   } 
					   if($rowcall['servicetype']!='')
					   {
							   ?>
							 <span class="btn btn-sm btn-danger"><?=$rowcall['servicetype']?></span><br>
							 <?php						  
					   } 
					  if($rowcall['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowcall['customernature']?></span><br>
						   <?php						  
					 }
					 if($rowcall['callnature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-primary"><?=$rowcall['callnature']?></span><br>
						   <?php						  
					 }
					  if($rowcall['compstatus']!='2')
					  {
						 if($callchange=='1')
						{  
					  ?>
					  <a href="callsmodify.php?id=<?=$rowcall['id']?>" class="text-warning">Change Details</a>
					 <?php
						}
					  }
					  ?>
					  </td>
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
					  <td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span><br><b>Serial:</b> <?=$rowcall['serial']?></td>
					  <td><b>Reported:</b> <?=$rowcall['reportedproblem']?><br>
					  <b>Observed:</b> <?=$rowcall['problemobserved']?><br>
					  <b>Action:</b> <?=$rowcall['actiontaken']?><br>
					  <b>Narration:</b> <?=$rowcall['narration']?></td>
					  <td>
					  <?php
					  if($rowcall['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowcall['changeon']))?>
						<?php
					  }
					  else if($rowcall['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span>on <?=date('d/m/Y h:i:s a', strtotime($rowcall['changeon']))?>
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
					  <?php
					  if($calledit=='1')
					  {
						 if($rowcall['compstatus']!='2')
						  { 
							  ?>
							  <td><a href="callsedit.php?id=<?=$rowcall['id']?>">Edit</a></td>
							  <?php						
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
		<br>
		<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div id="call" class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>Call Details</h5>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">

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

			  <form action="callsedits.php" method="post">
			  <input type="hidden" id="sourceid" name="sourceid" value="<?=$rowcalls['sourceid']?>">
			  <input type="hidden" id="id" name="id" value="<?=$rowcalls['id']?>">
			  <input type="hidden" id="calltid" name="calltid" value="<?=$rowcalls['calltid']?>">
			  <input type="hidden" id="consigneeid" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
			  <input type="hidden" id="startip" name="startip" value="<?=$rowcalls['startip']?>">
			  <input type="hidden" id="startiptime" name="startiptime" value="<?=$rowcalls['startiptime']?>">
			  <input type="hidden" id="endiptime" name="endiptime" value="<?=$rowcalls['endiptime']?>">
			  <input type="hidden" id="endip" name="endip" value="<?=$rowcalls['endip']?>">
			  <input type="hidden" id="kms" name="kms" value="<?=$rowcalls['kms']?>">
			  <input type="hidden" id="detailsid" name="detailsid" value="<?=$rowcalls['detailsid']?>">
			  <input type="hidden" id="pendingon1" name="pendingon1" value="<?=$rowcalls['pendingon1']?>">
			  <input type="hidden" id="pendingon2" name="pendingon2" value="<?=$rowcalls['pendingon2']?>">
			  <input type="hidden" id="pendingon3" name="pendingon3" value="<?=$rowcalls['pendingon3']?>">
			  <?php
			  if(isset($_GET['rd']))
			  {
				  ?>
				<input type="hidden" id="rd" name="rd" value="<?=$_GET['rd']?>">  
				  <?php
			  }
			  ?>
			  
			<?php
			if(($rowcalls['detailsid']!='')||($rowcalls['compstatus']!='0')||($rowcalls['engineerid']=='30'))
			{
          ?>
          <?php
		  if($servicereport=='1')
		  {
			?>  
          <a href="complaint.php?id=<?=$rowcalls['calltid']?>" target="_blank" class="float-right ml-2 btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Service Call Report</a> 
		  <?php
		  }
		  ?>
		  <a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowcalls['calltid']?>" target="_blank" class="float-right btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-pdf fa-sm text-white-50"></i> View Service Call Report</a><br>
			  <br>
		<?php
		$sqlcon4 = "SELECT stockitem, worktype, workpoint, problemobserved, srno, scharge, sparesused1, sparesused2, sparesused3, sparesused4, sparesused5, actiontaken, callstatus, engineerreport  From jrccalldetails WHERE id = '{$rowcalls['detailsid']}' and reassign='0' order by id desc";
		$querycon4 = mysqli_query($connection, $sqlcon4);
		$rowcon4=mysqli_num_rows($querycon4);
		$infocon4=mysqli_fetch_array($querycon4);
		if($infocon4['workpoint']=='0')
        {
			?>
            <div class="alert alert-warning text-center ">
              <table align="center">
                <tr>
                  <td>
					<b>Product Name:</b> <?=$infocon4['stockitem']?><br>
					<b>Work Type:</b> <?=$infocon4['worktype']?><br>
					<b>Points:</b> <?=$infocon4['workpoint']?><br>
					<b>Service Charges:</b> <?=$infocon4['scharge']?><br>
				  </td>
				</tr>
			  </table>
          </div>
            <?php
        }
        else
        {
            ?>
            <div class="alert alert-success shadow">
            <table align="center">
                <tr>
                  <td>
              <b>Product Name:</b> <?=$infocon4['stockitem']?><br>
              <b>Work Type:</b> <?=$infocon4['worktype']?><br>
              <b>Points:</b> <?=$infocon4['workpoint']?><br>
              <b>Service Charges:</b> <?=$infocon4['scharge']?><br>
        </td>
        </tr>
        </table>
          </div>
            <?php
        }
      ?>
<div class="row">
<?php
if($infolayoutcall['businesstype']=='1')
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
<label class="mr-2"><input type="radio" name="businesstype" value="<?=$btype?>" <?=($rowcalls['businesstype']==$btype)?"checked":""?> required> <?=$btype?> </label>
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
	<input type="hidden" name="businesstype" id="businesstype" value="">
	<?php
}
if($infolayoutcall['servicetype']=='1')
{
?>	
<div class="col-lg-2 mb-3">
<label for="servicetype">Service Type:</label>
</div>
<div class="col-lg-10 mb-3">
<label class="mr-2"><input type="radio" name="servicetype" value="On-Site"  id="servicetypeonsite" <?=($rowcalls['servicetype']=='On-Site')?"checked":""?> required onchange="checkcarry()"> On-Site </label>
<label class="mr-2" <?=(($liveplan=='GOLD')||($liveplan=='DIAMOND'))?'':'style="display:none"'?>><input type="radio" name="servicetype" value="Carry-In" id="servicetypecarry" <?=($rowcalls['servicetype']=='Carry-In')?"checked":""?> required onchange="checkcarry()"> Carry-In </label>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="servicetype" id="servicetype" value="<?=$rowcalls['servicetype']?>">
	<?php
}
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
<label class="mr-2"><input type="radio" name="customernature" value="AMC"  <?=($rowcalls['customernature']=='AMC')?"checked":""?> required> AMC </label>
 <?php
					  }
					  if(($infolayoutcall['customernaturew']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Warranty" <?=($rowcalls['customernature']=='Warranty')?"checked":""?> required> Warranty </label>
<?php
					  }
					  if(($infolayoutcall['customernatureow']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Out of Warranty" <?=($rowcalls['customernature']=='Out of Warranty')?"checked":""?> required> Out of Warranty </label>
<?php
					  }
					  if(($infolayoutcall['customernatureom']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Other Make" <?=($rowcalls['customernature']=='Other Make')?"checked":""?> required> Other Make</label>
<?php
					  }
					  if(($infolayoutcall['customernaturefsma']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="FSMA" <?=($rowcalls['customernature']=='FSMA')?"checked":""?> required> FSMA</label>
<?php
					  }
					  if(($infolayoutcall['customernaturecamc']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="CAMC" <?=($rowcalls['customernature']=='CAMC')?"checked":""?> required> CAMC</label>
<?php
					  }
					  ?>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="customernature" id="customernature" value="<?=$rowcalls['customernature']?>">
	<?php
}
if($infolayoutcall['calltype']=='1')
{
?>
<div class="col-lg-2 mb-3">
<label for="callnature">Call Type:</label>
</div>
<div class="col-lg-4 mb-3" style="border-right:1px solid #cccccc">
<label class="mr-2"><input type="radio" name="calltype" value="Service Call" <?=($rowcalls['calltype']=='Service Call')?"checked":""?> required> Service Call (Received from Customer) </label>
</div>
<div class="col-lg-6 mb-3">
<label class="mr-2"><input type="radio" name="calltype" value="Other Call" <?=($rowcalls['calltype']=='Other Call')?"checked":""?> required> Other Call (Service Related Activities) </label>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="calltype" id="calltype" value="<?=$rowcalls['calltype']?>">
	<?php
}
if($infolayoutcall['callnature']=='1')
{
?>

<div class="col-lg-4">
      <div class="form-group">
    <label for="callnature">Call Nature</label>
	<input type="text" class="form-control" id="callnature" name="callnature"   value="<?=$rowcalls['callnature']?>" readonly>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="callnature" id="callnature" value="<?=$rowcalls['callnature']?>">
	<?php
}
if($infolayoutcall['callfrom']=='1')
{
?>
<div class="col-lg-4">
  <div class="form-group">
    <label for="callfrom">Call Received From (Contact Number)</label>
    <input type="number" class="form-control" id="callfrom" name="callfrom"  value="<?=$rowcalls['callfrom']?>" readonly <?=($infolayoutcall['callfrom']=='1')?'required':''?>>
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="callfrom" id="callfrom" value="<?=$rowcalls['callfrom']?>">
	<?php
}
if($infolayoutcall['callon']=='1')
{
?>
<div class="col-lg-4">
    <div class="form-group">
    <label for="callon">Call Received On</label>
    <input type="text" class="form-control" id="callon" name="callon"   value="<?=$rowcalls['callon']?>" readonly <?=($infolayoutcall['callon']=='1')?'required':''?>>
  </div>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="callon" id="callon" value="<?=$rowcalls['callon']?>">
	<?php
}
if($infolayoutcall['callhandling']=='1')
{
?> 
  <div class="col-lg-4">
  <div class="form-group">
    <label for="callhandlingname">Call Handled By</label>
	<input type="hidden" id="callhandlingid" name="callhandlingid" value="<?=$rowcalls['callhandlingid']?>" <?=($infolayoutcall['callhandling']=='1')?'required':''?>>
    <input type="text" class="form-control" id="callhandlingname" name="callhandlingname" maxlength="3"  value="<?=$rowcalls['callhandlingname']?>" readonly <?=($infolayoutcall['callhandling']=='1')?'required':''?>>
  </div>
   </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="callhandlingid" id="callhandlingid" value="<?=$rowcalls['callhandlingid']?>">
	<input type="hidden" name="callhandlingname" id="callhandlingname" value="<?=$rowcalls['callhandlingname']?>">
	<?php
}
if($infolayoutcall['reportedproblem']=='1')
{
?> 
<div class="col-lg-4">
      <div class="form-group">
    <label for="reportedproblem">Reported Problem</label>
	<input type="text" class="form-control" id="reportedproblem" name="reportedproblem" placeholder="Reported Problem" value="<?=$rowcalls['reportedproblem']?>" readonly required>
  </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="reportedproblem" id="reportedproblem" value="<?=$rowcalls['reportedproblem']?>">
	<?php
}
if($infolayoutcall['coordinator']=='1')
{
?>   
<div class="col-lg-4">
      <div class="form-group">
    <label for="coordinatorname">Co-Ordinator Assigned</label>
	<input type="hidden" id="coordinatorid" name="coordinatorid" value="<?=$rowcalls['coordinatorid']?>" required>
    <input type="text" class="form-control" id="coordinatorname" name="coordinatorname" maxlength="3"  value="<?=$rowcalls['coordinatorname']?>" readonly required>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="coordinatorid" id="coordinatorid" value="<?=$rowcalls['coordinatorid']?>">
	<input type="hidden" name="coordinatorname" id="coordinatorname" value="<?=$rowcalls['coordinatorname']?>">
	<?php
}
if($infolayoutcall['engineer']=='1')
{
?>
<div class="col-lg-4">
  <div class="form-group">
    <label for="engineername">Engineer Assigned</label>
	<input type="hidden" id="engineerid" name="engineerid" value="<?=$rowcalls['engineerid']?>" required>
   <input type="text" class="form-control" id="engineername" name="engineername" maxlength="3"  value="<?=$rowcalls['engineername']?>" readonly required>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="engineerid" id="engineerid" value="<?=$rowcalls['engineerid']?>">
	<input type="hidden" name="engineername" id="engineername" value="<?=$rowcalls['engineername']?>">
	<?php
}
if($infolayoutcall['otherremarks']=='1')
{
?>
<div class="col-lg-4">
      <div class="form-group">
    <label for="otherremarks">Other Remarks</label>
    <textarea type="text" class="form-control" id="otherremarks" name="otherremarks" readonly rows="1"><?=$rowcalls['otherremarks']?></textarea>
  </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="otherremarks" id="otherremarks" value="<?=$rowcalls['otherremarks']?>">
	<?php
}
if($infolayoutcall['serial']=='1')
{
?>  
  <div class="col-lg-4">
  <div class="form-group">
    <label for="serial">Serial Number </label>
	 <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial Numbers" value="<?=$rowcalls['serial']?>" readonly required>
  </div>
</div> 
<?php
}
else
{
	?>
	<input type="hidden" name="serial" id="serial" value="<?=$rowcalls['serial']?>">
	<?php
}
?>
</div>

<hr>
<div id="carrydiv">
<div class="row">
<div class="col-lg-4">

<div class="form-group">
    <h5 for="diagnosisby" class="text-primary">Diagnosis By</h5><br>
	<label class="mr-2"><input type="radio" name="diagnosisby" id="diagnosisbyengineer" value="engineer" onchange="checkdiagnosis()" <?=(($rowcalls['diagnosisby']=='engineer')?"checked":"")?>> Engineer </label>
	<label class="mr-2"><input type="radio" name="diagnosisby" id="diagnosisbycoordinator" value="coordinator" onchange="checkdiagnosis()" <?=(($rowcalls['diagnosisby']=='coordinator')?"checked":"")?>> Co-ordinator </label>
  </div>
</div>
<div class="col-lg-4">
	<div id="diagnosiseng" <?=(($rowcalls['diagnosisby']=='engineer')?"style='display:block'":"style='display:none'")?>>
  <div class="form-group">
    <label for="diagnosisname">Diagnosis By (Engineer Name)</label>
	<input type="text" class="form-control" id="diagnosisengineername" name="diagnosisengineername" value="<?=$rowcalls['diagnosisengineername']?>" readonly required>
	<input type="hidden" id="diagnosisengineerid" name="diagnosisengineerid" >	
  </div>
	</div>

	<div id="diagnosiscoor" <?=(($rowcalls['diagnosisby']=='coordinator')?"style='display:block'":"style='display:none'")?>>
  <div class="form-group">
    <label for="diagnosisname">Diagnosis By (Co-Ordinator Name)</label>

	<input type="text" class="form-control" id="diagnosiscoordinatorname" name="diagnosiscoordinatorname" value="<?=$rowcalls['diagnosisengineername']?>" readonly required>
	<input type="hidden" id="diagnosiscoordinatorid" name="diagnosiscoordinatorid" >	
  </div>
	</div>
   </div>

   <div class="col-lg-4">
    <div class="form-group">
    <label for="callon">Diagnosed On</label>
    <input type="datetime-local" class="form-control" id="diagnosison" name="diagnosison" readonly value="<?=$rowcalls['diagnosison']?>">
  </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
    <label for="diagnosisestdate">Estimated Date of Completion</label>
    <input type="datetime-local" class="form-control" id="diagnosisestdate" name="diagnosisestdate" readonly value="<?=$rowcalls['diagnosisestdate']?>">
  </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
    <label for="diagnosisestcharge">Estimated Charges</label>
    <input type="number" class="form-control" id="diagnosisestcharge" name="diagnosisestcharge" min="0" step="0.01" value="<?=$rowcalls['diagnosisestcharge']?>" readonly>
  </div>
  </div>

  <div class="col-lg-4">
<label for="diagnosisimg">Product Images (On Received Time)</label>
<div id="showData" class="imgcontainer">
<?php
	$couns=1;
	$diaimg=explode(',',$rowcalls['diagnosisimg']);
	foreach($diaimg as $dimg)
	{
		?>
		<div class="imgcontent" id="imgcontent_<?=$couns?>"><img src="<?=$dimg?>" width="100" height="100"></div>
		<?php
		$couns++;
	}
	?>
</div>
<input id="diagnosisimg" type="hidden" name="diagnosisimg" value="<?=$rowcalls['diagnosisimg']?>">
<br />
	
	</div>


  <div class="col-lg-4">
      <div class="form-group">
    <label for="diagnosisremarks">Diagnosis Remarks</label>
<textarea class="form-control" id="diagnosisremarks" name="diagnosisremarks" readonly><?=$rowcalls['diagnosisremarks']?></textarea>
  </div>
  </div>

  <div class="col-lg-4">
      <div class="form-group">
    <label for="diagnosismaterial">Additional Materials Remarks</label>
<textarea class="form-control" id="diagnosismaterial" name="diagnosismaterial" readonly><?=$rowcalls['diagnosismaterial']?></textarea>
  </div>
  </div>



	</div>
	<hr>
	</div>


 <div class="row">
<?php

if($infolayoutcall['problemobserved']=='1')
{
?>
<div class="col-lg-4">
      <div class="form-group">
    <label for="problemobserved">Problem Observed</label>
<select class="form-control fav_clr" id="problemobserved" name="problemobserved" <?=($infolayoutcall['problemobservedreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT problemobserved  From jrcproblemobserved order by problemobserved asc";
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
<option value="<?=$rowrep['problemobserved']?>" <?=($rowcalls['problemobserved']!='')?(($rowcalls['problemobserved']==$rowrep['problemobserved'])?'selected':''):(($infocon4['problemobserved']!='')?(($infocon4['problemobserved']==$rowrep['problemobserved'])?'selected':''):"")?>><?=$rowrep['problemobserved']?></option>
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
	<input type="hidden" name="problemobserved" id="problemobserved" value="<?=$rowcalls['problemobserved']?>">
	<?php
}
if($infolayoutcall['servicereportno']=='1')
{
?>  
  <div class="col-lg-4">
    <div class="form-group">
    <label for="servicereportno">Service Report No</label>
    <input type="text" class="form-control" id="servicereportno" name="servicereportno" value="<?=($rowcalls['servicereportno']!='')?$rowcalls['servicereportno']:(($infocon4['srno']!='')?$infocon4['srno']:"")?>" required>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="servicereportno" id="servicereportno" value="<?=$rowcalls['servicereportno']?>">
	<?php
}
if($infolayoutcall['estimatedcost']=='1')
{
?>  
<div class="col-lg-4">
    <div class="form-group">
    <label for="estimatedcost">Service Charge</label>
    <input type="text" class="form-control" id="estimatedcost" name="estimatedcost" value="<?=($rowcalls['estimatedcost']!='')?$rowcalls['estimatedcost']:(($infocon4['scharge']!='')?$infocon4['scharge']:"")?>">
  </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="estimatedcost" id="estimatedcost" value="<?=$rowcalls['estimatedcost']?>">
	<?php
}
if($infolayoutcall['materialtracking']=='1')
{
?> 
  <div class="col-lg-4">
    <div class="form-group">
    <label for="materialtracking">Material Tracking</label>
    <input type="text" class="form-control" id="materialtracking" name="materialtracking"  value="<?=($rowcalls['materialtracking']!='')?$rowcalls['materialtracking']:((($infocon4['sparesused1']!='')?$infocon4['sparesused1']:"").(($infocon4['sparesused2']!='')?', '.$infocon4['sparesused2']:"").(($infocon4['sparesused3']!='')?', '.$infocon4['sparesused3']:"").(($infocon4['sparesused4']!='')?', '.$infocon4['sparesused4']:"").(($infocon4['sparesused5']!='')?', '.$infocon4['sparesused5']:""))?>">
  </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="materialtracking" id="materialtracking" value="<?=$rowcalls['materialtracking']?>">
	<?php
}
if($infolayoutcall['actiontaken']=='1')
{
?> 


<div class="col-lg-4">
      <div class="form-group">
    <label for="actiontaken">Action Taken</label>
<select class="form-control fav_clr" id="actiontaken" name="actiontaken" <?=($infolayoutcall['actiontakenreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT actiontaken From jrcactiontaken order by actiontaken asc";
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
<option value="<?=$rowrep['actiontaken']?>"  <?=($rowcalls['actiontaken']!='')?(($rowcalls['actiontaken']==$rowrep['actiontaken'])?'selected':''):(($infocon4['actiontaken']!='')?(($infocon4['actiontaken']==$rowrep['actiontaken'])?'selected':''):"")?>><?=$rowrep['actiontaken']?></option>
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
	<input type="hidden" name="actiontaken" id="actiontaken" value="<?=$rowcalls['actiontaken']?>">
	<?php
}
if($infolayoutcall['compstatus']=='1')
{
?> 
   <div class="col-lg-4">
    <div class="form-group">
    <label for="compstatus">Call Status</label>
    <select class="form-control" id="compstatus" name="compstatus" required>
	<option value="" <?=($rowcalls['compstatus']=="0")?"selected":""?> style="color:#3d8eb9" >Select</option>
	<option value="1" <?=($rowcalls['compstatus']=="1")?"selected":(($infocon4['callstatus']=='Pending')?"selected":"")?> style="color:#e74a3b" >Pending</option>
	<option value="2" <?=($rowcalls['compstatus']=="2")?"selected":(($infocon4['callstatus']=='Completed')?"selected":"")?> style="color:#1cc88a" >Closed</option>
	</select>
  </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="compstatus" id="compstatus" value="<?=$rowcalls['compstatus']?>">
	<?php
}
if($infolayoutcall['narration']=='1')
{
?>
<div class="col-lg-6">
      <div class="form-group">
    <label for="narration">Narration</label>
    <textarea type="text" class="form-control" id="narration" name="narration" style="text-transform:uppercase" required ><?=($rowcalls['narration']!='')?$rowcalls['narration']:(($infocon4['engineerreport']!='')?$infocon4['engineerreport']:"")?></textarea>
  </div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="narration" id="narration" value="<?=$rowcalls['narration']?>">
	<?php
}
if($infolayoutcall['visitremarks']=='1')
{
?> 
  <div class="col-lg-6">
      <div class="form-group">
    <label for="visitremarks">Visit Remarks</label>
    <textarea type="text" class="form-control" id="visitremarks" name="visitremarks" ><?=$rowcalls['visitremarks']?></textarea>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="visitremarks" id="visitremarks" value="<?=$rowcalls['visitremarks']?>">
	<?php
}
if($infolayoutcall['sms']=='1')
{
?>
<div class="col-lg-12">
<div class="form-group">
<label><input type="checkbox" name="customersms" id="customersms" <?=($rowcalls['customersms']=='0')?"checked":""?> value="1"> Customer SMS </label> | 
<input type="hidden" name="callhandledsms" id="callhandledsms" <?=($rowcalls['callhandledsms']=='0')?"checked":""?>>
<label><input type="checkbox" name="coordinatorsms" id="coordinatorsms" <?=($rowcalls['coordinatorsms']=='0')?"checked":""?>> Co-Ordinator SMS </label> | 
<label><input type="checkbox" name="engineersms" id="engineersms" <?=($rowcalls['engineersms']=='0')?"checked":""?>> Engineer SMS </label>
</div>
</div>
<?php
}
?>
</div>
  <input class="btn btn-primary" type="submit" name="submit" value="Approve & Submit">
  <?php
  }
  else
  {
	  ?>
	  <div class="alert alert-danger shadow">Service Call Report is not Submitted by Engineer! Kindly inform to the Engineer to Make Service Call Report</div>
	  <?php
			  if($infolayoutcall['withoutreport']=='1')
			  {
				  if($servicereport=='1')
				  {
					?> Or  
				  <a href="complaint.php?id=<?=$rowcalls['calltid']?>" target="_blank" class=" ml-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Click here to Make Service Call Report</a> 
				  <?php
				  }
			  }
			  ?>
	  <?php
  }
  ?>
</form>
            </div>
          </div>
        </div>
      </div>
<?php
					$count++;
			}
		}
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
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
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

		
		</script>
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
				$("#"+els+'name').val('');
			}
			else
			{
				$("#"+els+'name').val(data[0].text);
			}
		}
		else
		{
			$("#"+els+'name').val('');
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
	 $( "#callhandlingname" ).autocomplete({
       source: 'callsearch.php', select: function (event, ui) { $("#callhandlingname").val(ui.item.value); $("#callhandlingid").val(ui.item.id);}
     });
     $( "#coordinatorname" ).autocomplete({
       source: 'coorsearch.php', select: function (event, ui) { $("#coordinatorname").val(ui.item.value); $("#coordinatorid").val(ui.item.id);}
     });
	 $( "#engineername" ).autocomplete({
       source: 'engsearch.php', select: function (event, ui) { $("#engineername").val(ui.item.value); $("#engineerid").val(ui.item.id);}
     });
	 $( "#problemobserved" ).autocomplete({
       source: 'callssearch.php?type=problemobserved',
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
