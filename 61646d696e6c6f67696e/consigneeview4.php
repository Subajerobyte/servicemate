<?php
include('lcheck.php'); 

$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
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
   </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">


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
if((isset($_GET['id']))&&($_GET['id']!=''))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
				  $sqlcon = "SELECT * From jrcconsignee where id='".$id."' order by consigneename asc";
				  
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
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="../img/avatar.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?=$conname=$rowcon['consigneename']?></h4>
                      <p class="text-secondary mb-1"><?php
						if($rowcon['ctype']!='')
			{
				if($rowcon['ctype']=='BLOCK')
				{
				?>
				<span class="badge badge-danger"><?=$rowcon['ctype']?></span>
				<?php
				}
				else
				{
				?>
				<span class="badge badge-success"><?=$rowcon['ctype']?></span>
				<?php
				}	
			}	
			?>
			<span class="badge badge-success" id="warrantycustomer" style="display:none">Warranty Customer</span>
			<span class="badge badge-success" id="amccustomer" style="display:none">AMC Customer</span>
			</p>
                      <p class="text-muted font-size-sm">
					  <?php
											if($infolayoutcustomers['maincategory']=='1')
											{
												if($rowcon['maincategory']!='')
												{
											?>
												<?=$rowcon['maincategory']?><br>
											<?php
												}
											}
											if($infolayoutcustomers['subcategory']=='1')
											{
												if($rowcon['subcategory']!='')
												{
											?>											
												<?=$rowcon['subcategory']?><br>
											<?php
												}
											}
											if($infolayoutcustomers['department']=='1')
											{
												if($rowcon['department']!='')
												{
											?>	  
												 <?=$rowcon['department']?><br>
											<?php
												}
											}
					  ?>
					  
					  </p>
					  <a href="consigneeedit.php?id=<?=$rowcon['id']?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                      <!--button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <?php
				  if(($infolayoutcustomers['address1']=='1')||($infolayoutcustomers['address2']=='1')||($infolayoutcustomers['area']=='1')||($infolayoutcustomers['district']=='1')||($infolayoutcustomers['pincode']=='1')||($infolayoutcustomers['latlong']=='1'))
											{
											?>	  
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0 text-primary">Address</h6>
                    <span class="text-secondary"><?=$rowcon['address1']?> <?=$rowcon['address2']?> <?=$rowcon['area']?> <?=$rowcon['district']?> <?=$rowcon['pincode']?></span>
                  </li>
											
											<?php
											}
											?>
					<?php
					if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['email']=='1'))
											{
											?>
				  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0 text-primary">Contact</h6>
                    <span class="text-secondary"><?=$rowcon['contact']?></span>
                  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0 text-primary">Phone</h6>
                    <span class="text-secondary"><?=$rowcon['phone']?></span>
                  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0 text-primary">Mobile</h6>
                    <span class="text-secondary"><?=$rowcon['mobile']?></span>
                  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0 text-primary">E-mail</h6>
                    <span class="text-secondary"><?=$rowcon['email']?></span>
                  </li>
				  
												  <?php
											}
											?>
					
                </ul>
              </div>
			  <?php 
												  if($rowcon['latlong']!='')
												  {
													  $ll=explode(',',$rowcon['latlong']);
													  ?>
													 
													  
				<div class="card mt-3">
                <iframe 
  frameborder="0" 
  scrolling="no" 
  marginheight="0" 
  marginwidth="0" 
  src="https://maps.google.com/maps?q=<?=$ll[0]?>,<?=$ll[1]?>&hl=en&z=14&amp;output=embed"
 >
 </iframe>
              </div>
													  
													  <?php
												  }
												  ?>
			  
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
				
				


      <!-- List group-->
      <ul class="list-group">


 <?php
				  $sqlselect = "SELECT invoiceno, invoicedate, id From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' group by invoiceno, invoicedate order by invoicedate desc";
				  
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
              <h5 class="mt-0 font-weight-bold mb-2"><?=$rowselect['invoiceno']?> - <?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?> <a href="invoiceedit.php?id=<?=$rowselect['id']?>"><i class="fa fa-edit"></i></a> </h5>
               <?php
			   
			   $stockitem="";
			$invoiceno="";
			$invoicedate="";
			   
			   $sqlselect2 = mysqli_query($connection, "SELECT * From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' and invoiceno='".$rowselect['invoiceno']."' and invoicedate='".$rowselect['invoicedate']."' order by invoicedate desc");
			   while($infoselect2=mysqli_fetch_array($sqlselect2))
			   {
				   ?>
				   <?php
			if(($invoiceno!=$infoselect2['invoiceno'])||($invoicedate!=$infoselect2['invoicedate'])||($stockitem!=$infoselect2['stockitem']))
			{
				?>
				   <h6 class="text-primary pt-2" style="border-bottom: 1px solid #cccccc"><?=$infoselect2['stockitem']?> </h6>
			<?php
			if(($infolayoutproducts['stockmaincategory']=='1')||($infolayoutproducts['stockmaincategory']=='1'))
{
if($infoselect2['stockmaincategory']!="")
{	
?>	
Main Category: <?=$infoselect2['stockmaincategory']?><br>
<?php
}
if($infoselect2['stocksubcategory']!="")
{	
?>	
Sub Category: <?=$infoselect2['stocksubcategory']?><br>
<?php
}
?>

<?php
}
if($infolayoutinvoice['overallwarranty']=='1')
{
?>
			Overall Warranty: <?=$infoselect2['overallwarranty']?>
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
<br>
<?php	
			}
			?>
			
			<div class="row">
			<div class="col-lg-8">
			
				  <span style="font-style:italic"> <?php 
			  
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{	
?>
Type of Product: <?=$infoselect2['typeofproduct']?> <br>
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
Component Type: <?=$infoselect2['componenttype']?> <br>
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
Component Name: <b><?=$infoselect2['componentname']?> </b><br>
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
Make: <?=$infoselect2['make']?> <br>
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
Capacity: <?=$infoselect2['capacity']?> <br>
<?php
}
}
if($infolayoutinvoice['qty']=='1')
{
		?>
		Qty: <?=$infoselect2['qty']?><br>
		<?php
}
if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
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
							  echo '-'.$dpts[$sr];
						  }
						  
					  }
}

?><br>
	</span><br>
	
	</div>
	<div class="col-lg-4">
	<?php
	if($infolayoutinvoice['warranty']=='1')
{
if($infoselect2['warranty']!='')
{	
?>
Warranty: <?=$infoselect2['warranty']?> Months 
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
				echo '<span class="bg-danger text-white"><strong>('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
			}
			else
			{
				echo '<span class="bg-success text-white"><strong>('.$effectiveDate1.')</strong></span><br>';
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

<?php
			$sqlamc = "SELECT * From jrcamc where sourceid='".$infoselect2['id']."'";
				  
        $queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountamc!=0)
		{
		?>
		<b>AMC:</b>
<?php		
         
		$rowamc = mysqli_fetch_array($queryamc); 
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
    echo '<span class="text-danger"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintanence)</strong></span><br>';
}
else
{
	echo '<span class="text-success"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintanence)</strong></span><br>';
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		?>
		<a href="callsadd.php?id=<?=$infoselect2['id']?>" class="btn btn-primary btn-sm bg-white text-primary">Take A Complaint Call</a>
					  <?php
					  if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
	?>
					  <a href="serialnumberedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" class="btn btn-primary btn-sm bg-white text-primary">Edit Serials</a>
					  <?php
}
?>
					  <a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" class="btn btn-primary btn-sm bg-white text-primary">Add to AMC</a> 
					  <?php
					  if($deleteproduct=='1')
					  {
						  ?>
					  <a href="invoicedelete.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>&tdelete=<?=$infoselect2['tdelete']?>" onclick="return confirm('Are you sure want to Delete this Product')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					  <?php
					  }
					  ?>
	
	</div>
	
	
	</div>
				   <?php
				   
				   $stockitem=$infoselect2['stockitem'];
				$invoiceno=$infoselect2['invoiceno'];
				$invoicedate=$infoselect2['invoicedate'];
				   
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
				
                </div>
              </div>

              </div>
          </div>

        </div>
			
			
			
			
		<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
				<h5>Call History</h5>
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
		$sqlselect = "SELECT sourceid, callfrom, callon, calltid, acknowlodge, compstatus, changeon, id, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid,engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, callnature, customernature, businesstype, servicetype, calltype, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid, otherremarks From jrccalls where consigneeid='".$id."' order by id desc";
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
		?>
                    <tr>
                      <td> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowselect['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
                      <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
					  <br>
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
					  C/H: <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
					  C/O: <a href="coordinatorview.php?id=<?=$rowselect['coordinatorid']?>"><?=$rowselect['coordinatorname']?></a><br>
					  E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
					  <?php
					 if($rowselect['businesstype']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-success"><?=$rowselect['businesstype']?></span><br>
						   <?php						  
					 } 
					 if($rowselect['servicetype']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-danger"><?=$rowselect['servicetype']?></span><br>
						   <?php						  
					 } 
					  if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
						   <?php						  
					 }
					 if($rowselect['callnature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-primary"><?=$rowselect['callnature']?></span><br>
						   <?php						  
					 }
					  if($rowselect['compstatus']!='2')
					  {
						 if($callchange=='1')
						{  
					  ?>
					  <a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-warning">Change Details</a>
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
					  <td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span><br><b>Serial:</b> <?=$rowselect['serial']?></td>
					  <td><b>Reported:</b> <span class="text-primary"><?=$rowselect['reportedproblem']?></span><br>
					  <b>Observed:</b> <span class="text-primary"><?=$rowselect['problemobserved']?></span><br>
					  <b>Action:</b> <span class="text-primary"><?=$rowselect['actiontaken']?></span><br>
					  <b>Narration:</b> <span class="text-primary"><?=$rowselect['narration']?></span>
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
						  if($rowselect['compstatus']!='2')
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
<?php
					$count++;
			}
		}
		}
		else
		{
      
      if(isset($_GET['topsearch']))
      {
        $term=mysqli_real_escape_string($connection, $_GET['topsearch']);
        if(strlen($term)>2)
        {

        
        $terms=explode(' ',$term);
$q="";
$finds=array();
$replaces=array();

foreach($terms as $t)
{
  $finds[]=$t;
  $replaces[]='<span style="background-color:#CCFF00">'.$t.'</span>';
	if($q=="")
	{
		$q.="((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(email) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
	}
	else
		{
		$q.=" and ((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(email) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
	}
		
}
?>
<div class="row">
        <div class="col-xl-12 order-xl-1 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-body">
 <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  
<?php
$c=0;
?>
<th>Invoice No.</th>
<th>Invoice Date</th>
<th>Tender No.</th>
<th>Purchase Order No.</th>
<th>PO Date</th>
<th>DC No.</th>
<th>DC Date</th>
<th>Installed On</th>
<th>Installed By</th>
<th>Main Category</th>
<th>Sub Category</th>
<th>Customer Name(Unique)</th>
<th>Department</th>
<th>Address 1</th>
<th>Address 2</th>
<th>Area</th>
<th>District</th>
<th>Pin Code</th>
<th>Contact</th>
<th>Phone</th>
<th>Mobile</th>
<th>Email</th>
<th>Main Category</th>
<th>Sub Category</th>
<th>Product Name</th>
<th>Invoiced Qty</th>
<th>Overall Warranty Months</th>
<th>Type of Product</th>
<th>Component Type</th>
<th>Component Name</th>
<th>Make</th>
<th>Capacity</th>
<th>Warranty</th>
<th>Qty</th>
<th>Serial Numbers</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $sqlselect = "SELECT * FROM jrcxl WHERE tdelete='0' and (".$q.") group by consigneename ORDER BY consigneename ASC"; 
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
					  <td><?=str_ireplace($finds, $replaces,$rowselect['invoiceno'])?></td>
<td><?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['tenderno'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['pono'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['podate'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['dcno'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['dcdate'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['installedon'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['installedby'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['maincategory'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['subcategory'])?></td>
<?php
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
					  ?>
<td><?=str_ireplace($finds, $replaces,$rowselect['department'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['address1'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['address2'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['area'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['district'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['pincode'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['contact'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['phone'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['mobile'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['email'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['stockmaincategory'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['stocksubcategory'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['stockitem'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['invoicedqty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['overallwarranty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['typeofproduct'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['componenttype'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['componentname'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['make'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['capacity'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['warranty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['qty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['serialnumber'])?></td>
					  
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
<?php

}
else
{
  ?>
  <div class="alert alert-danger shadow">Please Enter Atleast 3 Characters to Search</div> 
  <?php
}
      }
			?>
			
			<?php
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
<script>
// Code goes here

$(document).ready(function() {
  var map = null;
  var myMarker;
  var myLatlng;

  function initializeGMap(lat, lng) {
    myLatlng = new google.maps.LatLng(lat, lng);

    var myOptions = {
      zoom: 15,
      zoomControl: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    myMarker = new google.maps.Marker({
      position: myLatlng
    });
    myMarker.setMap(map);
  }

  // Re-init map before show modal
  $('#myModalmap').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    initializeGMap(button.data('lat'), button.data('lng'));
    $("#location-map").css("width", "100%");
    $("#map_canvas").css("width", "100%");
  });

  // Trigger map resize event after modal shown
  $('#myModalmap').on('shown.bs.modal', function() {
    google.maps.event.trigger(map, "resize");
    map.setCenter(myLatlng);
  });
});
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=initMap&libraries=&v=weekly"
      async
    ></script>
	<?php include('additionaljs.php');   ?>
</body>

</html>
