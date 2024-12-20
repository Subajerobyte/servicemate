<?php
include('lcheck.php'); 
$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
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
.whatsapp{
  display: inline-block;
  background-color: #1cc88a;
  color: #ffffff !important; 
  padding: 10px 20px;
  text-decoration: none; 
  border: none; 
  border-radius: 5px; 
  margin: 5px; 
  font-size:12px;
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
	.specific-th {
           
            background-color: #f1f1f1 !important;
            color: #000000 !important;
            text-align: left !important;
            
	vertical-align: middle !important;
	
        }
</style>
<style>
button, input, optgroup, select, textarea {
    margin: 0;
    font-family: inherit;
    font-size: medium;
    line-height: inherit;
	border-radius: 5px;
    border: 2px solid <?=$_SESSION['bgcolor']?>;
}
<!---
a {
    color: #000000 !important;
    text-decoration: none;
    background-color: transparent;
}--->

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
  </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php //include('consigneenavbar.php');?>
        

        
        <div class="container-fluid" >
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
			
			
			
			
    <div class="main-body" style="padding-top:0.50rem;">
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
					  <span><?=$rowcon['contact']?> <i class="fa fa-phone-alt text-primary"></i>  <?=$rowcon['phone']?> <?=$rowcon['mobile']?> <i class="fa fa-envelope text-primary"></i> <?=$rowcon['email']?></span> <!-- Button trigger modal -->
<!--a id="additionalcontact" data-toggle="modal" class="text-primary" style="cursor:pointer" data-target="#additionalModal">View Addtional Contacts</a-->
<br>
					  <?php

?>
<?php
if((($infolayoutcustomers['contact']=='1')&&($rowcon['contact']=='')) || (($infolayoutcustomers['phone']=='1')&&($rowcon['phone']=='')) || (($infolayoutcustomers['mobile']=='1')&&($rowcon['mobile']=='')) || (($infolayoutcustomers['email']=='1')&&($rowcon['email']=='')))
{
	?>
	<a href="#" data-toggle="modal" data-target="#contactmodal" class="btn btn-success blink btn-sm">Update Contact Information</a> 
<?php
}
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
	 <br>
    
    
          <div class="row gutters-sm">
            <div class="col-md-12">
              <div class="card mb-3" style="border:none">
                <div class="card-body" style="padding:0">
				
				
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item  p-1" role="presentation">
    <button class="nav-link2 active" id="products-tab" data-toggle="tab" data-target="#products" type="button" role="tab" aria-controls="products" aria-selected="true" >Products</button>
  </li>
  <li class="nav-item p-1" role="presentation">
    <button class="nav-link2" id="callhistory-tab" data-toggle="tab" data-target="#callhistory" type="button" role="tab" aria-controls="callhistory" aria-selected="true">Call History</button>
  </li>
   <li class="nav-item p-1" role="presentation">
    <button class="nav-link2" id="enquiry-tab" data-toggle="tab" data-target="#enquiry" type="button" role="tab" aria-controls="enquiry" aria-selected="true">Enquiry</button>
  </li>
  <li class="nav-item p-1" role="presentation">
    <button class="nav-link2" id="quotations-tab" data-toggle="tab" data-target="#quotations" type="button" role="tab" aria-controls="quotations" aria-selected="false">Quotations</button>
  </li>
  <li class="nav-item p-1" role="presentation">
    <button class="nav-link2" id="amcquotations-tab" data-toggle="tab" data-target="#amcquotations" type="button" role="tab" aria-controls="amcquotations" aria-selected="false">AMC Quotations</button>
  </li>
  <li class="nav-item p-1" role="presentation">
    <button class="nav-link2" id="followup-tab" data-toggle="tab" data-target="#followup" type="button" role="tab" aria-controls="followup" aria-selected="true">Followup</button>
  </li> 
  <li class="nav-item p-1" role="presentation">
    <button class="nav-link2" id="rental-tab" data-toggle="tab" data-target="#rental" type="button" role="tab" aria-controls="rental" aria-selected="true">Rental</button>
  </li> 
 
  
</ul>
<!--open tab-content-->
<div class="tab-content" id="myTabContent">






  <!-----products---->
  <!-----start---->
  <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
   <!-- Button -->
     <div class="d-sm-flex align-items-center justify-content-between mb-1">
   <h1 class="h4 mb-2 mt-2 text-gray-800"></h1>
   <?php
	 $sqlselect = "SELECT * From jrcconsignee where id='".$rowcon['id']."' ";
	 $queryselect = mysqli_query($connection, $sqlselect);
     $rowselect = mysqli_fetch_array($queryselect)
	?>
   <a href="invoicenewadd.php?id=<?=$rowselect['id']?>" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Invoice</a>
   </div>
    <!-- Button -->
  <!-----products---->
		
		
				  <!--- start table-->

		
  <div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="justify-content-between">
			   <h6 class="m-0 font-weight-bold text-black">Products</h6>
               </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
			
              <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Date</th>
                      <th>Invoice No</th>
                      <th>Products</th>
                      <th>Serial No</th>
					  <th>Take Call</th>
					  <th>AMC</th>
                    </tr>
                  </thead>
                  <tbody>
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
				 $stockitem="";
			$invoiceno="";
			$invoicedate="";
			$make="";
			$capacity="";
			
			   $coset=1;
			   $sqlselect2 = mysqli_query($connection, "SELECT stockmaincategory, stocksubcategory, overallwarranty, tdelete, typeofproduct, componenttype, componentname, make, capacity, qty, serialnumber, departments, installedon, warranty, id, stockitem, invoiceno, invoicedate From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' and invoiceno='".$rowselect['invoiceno']."' and invoicedate='".$rowselect['invoicedate']."' order by invoicedate desc");
			   while($infoselect2=mysqli_fetch_array($sqlselect2))
			   {
			?>
                    <tr>
                      <td style="text-align: center;"><?=$count?></td>
                      <td width=8%><?=date('d-m-Y', strtotime($rowselect['invoicedate']))?></td>
					  
                      <td width=17%> <a href="invoiceedit.php?id=<?=$rowselect['id']?>"><?=$rowselect['invoiceno']?></a><br>
					  <div class="row"><div class="col-2"><a href="documentupload.php?id=<?=$rowselect['id']?>" target="_blank" class="btn btn-primary" style="   padding: 0.1rem 0.1rem;"><i class="fa fa-upload" data-toggle="tooltip" title="Upload Documents"></i></a></div>
					  <div class="col-10"><?php
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
				echo '<span class="text-danger"><b>O/W</b><strong class="text-dark"> ('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
			}
			else
			{
				echo '<span class="text-success"><b>WAR</b><strong class="text-dark"> ('.$effectiveDate1.')</strong></span><br>';
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
$sqlamc = "SELECT dateto,id From jrcamc where sourceid='".$infoselect2['id']."' order by id desc";
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
		$_SESSION['amcid']=$rowamc['id'];
		$_SESSION['dateto']=$rowamc['dateto'];
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
	
	echo '<span class="text-danger"><b>AMC Expired</b> <strong class="text-dark">('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
    /* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
	echo '<span class=" text-success"><b>AMC Active</b> <strong class="text-dark">('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		?>
	
	
	
<div></div>
</td>
                      <td><?=$infoselect2['stockitem']?></td>
					  
                      <td style="position: relative;">
    <?=$infoselect2['serialnumber']?>
    <?php if (($infolayoutinvoice['serialnumber'] == '1') || ($infolayoutinvoice['departments'] == '1')) { ?>
        <a href="serialnumberedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" class="button8" style="position: absolute; bottom: 0; right: 0;color: #7e57d5 !important;background-color: #fff;"><b>Edit</b></a>
    <?php } ?>
</td>

                      <td width=10%><div class="col-lg-12 pt-0" style="line-height:1.2">
					 
	
	

		<a href="callsadd.php?id=<?=$infoselect2['id']?>" class="button8"     style="color: #0a0a0a !important;background-color: #f6f8ff;"><b>Book Complaint</b></a>
					  
	</div></td>
	<td width=10%><div class="col-lg-12 pt-0" style="line-height:1.2;text-align:center;">
					 
	
	
	<a href="newamcquotationadd.php?id=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" style="color: #6836DB !important;"><b>AMC Quote</b></a> 
<?php
$sqlamc = "SELECT dateto,id From jrcamc where sourceid='".$infoselect2['id']."' order by id desc";
$queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
if($rowCountamc > 0)
{
	if($_SESSION['dateto']>date('Y-m-d')) {
?>
<br><br><a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>&i=<?=$_SESSION['amcid']?>"  style="color: #2de5df !important;"><b>Edit</b></a>
	<?php
	}
	else
	{
		?>
		<br><br><a href="amcrenew.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>&date="  style="color: #ED0DD1 !important;background-color: #fff;"><b>Renew AMC</b></a>
		<?php
	}
	?>
<br><br><a href="amcrenewal.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>"  style="color: #ED841A !important;background-color: #fff;"><b>History</b></a>
<?php
}
else{					  
?>					 
</br></br><a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>"  style="color: #08CF7C !important;background-color: #fff;"><b>Add to AMC</b></a> 
<?php } ?>
					  
	</div></td>
                      
                    </tr>
					<?php
					$count++;
			}
			
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
		  
		  
		  <!--- end table-->
		
		
		
        <!-- List group-->
     
  </div>
      <!-- End -->
  <!-----products---->
  
  
  
  
  
  
  
  <div class="tab-pane fade" id="callhistory" role="tabpanel" aria-labelledby="callhistory-tab">
  <!-----call history---->
  <div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d- justify-content-between">
			   <h6 class="m-0 font-weight-bold text-black">Call History</h6>
               </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
			<?php
			if($infolayoutcustomers['email']=='1')
{
			?>
			<a href="#" data-toggle="modal" data-target="#emailmodal" class="btn btn-success btn-sm" style="float: right;">Call Report</a>
			<?php
			
}
			?>
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
					  <th>Sent to OEM</th>
					  <th>Received from OEM</th>
					  <th>Status</th>
					  <th>Whatsapp</th>
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
					  C/H: <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
					  C/O: <a href="coordinatorview.php?id=<?=$rowselect['coordinatorid']?>"><?=$rowselect['coordinatorname']?></a><br>
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
							E-<?=($eise+1)?>: <a href="mapengineerview.php?id=<?=$engnsid[$eise]?>&attdate=<?=date('Y-m-d')?>"><?=$engnsname[$eise]?> <?=($rowselect['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
							<?php
						  }
						  }
						  else
					  {
						  ?>
						  <a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-danger blink">Assign Engineer</a>
						   <?php
					  }
					  }
					  else
					  {
						  if($rowselect['engineername']!='')
					  {
						?>
						E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
						  <?php
						  											  }
					  else
					  {
						  ?>
						  <a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-danger blink">Assign Engineer</a>
						   <?php
					  }
					  }
					  ?>
					  <br>
					  <?php
					  if($rowselect['compstatus']!='2')
					  {
						  if(($rowselect['compstatus']!='3'))
					  {
						 if($callchange=='1')
						{  
					  ?>
					  <a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-warning">Change Details</a>
					 <?php
						}
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
					 
					  <td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span><br><b>Serial:</b> <?=$rowselect['serial']?>
					  <?php 
					 
					  $sqldepartments=mysqli_query($connection,"Select * from jrcserials where sourceid='".$rowselect['sourceid']."'  and serialnumber='".$rowselect['serial']."'");
					  $rowdepartmentscount=mysqli_num_rows($sqldepartments);
					  if($rowdepartmentscount > 0)
					  {
					  $rowdepartments=mysqli_fetch_array($sqldepartments);
					  if($rowdepartments['location']!='')
					  {
					 echo '<br><b>Department:</b>'.$rowdepartments['location'];
					  }
					  }
					  
					  
					  ?></td>
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
					  <td><?php 
					   if($rowselect['servicetype']=='Carry-In')
					   {
              if($rowselect['dcno']!='')
              {
                $sqlrep2 = "SELECT id,suppliername From jrcsuppliers where id='".$rowselect['suppliername']."' order by suppliername asc";
                $queryrep2 = mysqli_query($connection, $sqlrep2);
                $inforep2=mysqli_fetch_array($queryrep2);

                ?>
                <b>DN No:</b> <span class="text-primary"><?=$rowselect['dcno']?></span><br>
                <b>DN Date:</b> <span class="text-primary"><?=date('d/m/Y',strtotime($rowselect['dcdate']))?></span><br>

                <b>Supplier Name:</b> <span class="text-primary"><?php if(isset($inforep2['suppliername'])){ echo $inforep2['suppliername']; } else {echo ''; }?></span><br>
                <b>Warranty Type:</b> <span class="text-primary"><?=$rowselect['supwarrantytype']?></span><br>
      
                <b>Complaint Remarks:</b> <span class="text-primary"><?=$rowselect['supcomplaintremarks']?></span><br>
                <?php 
				if(($rowselect['supcomplaintno']!=''))
				{
					?>
					<b>Complaint No:</b> <span class="text-primary"><?=$rowselect['supcomplaintno']?></span><br>
			
					 <?php
				}
				if($rowselect['supcourierdate']!='' || $rowselect['supcourierpaytype']!='' || $rowselect['supcouriercharges']!='')
				{
					
				}
				else
				{
					?>
					 <a href="oemprocess.php?id=<?=$rowselect['id']?>" class="text-danger">Send to OEM</a><br>
					<?php
				}
			  ?>
			  
			  <a href="deliverynoteprint.php?id=<?=$rowselect['dcno']?>" class="text-info" target="_blank">Print Delivery Note</a><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>" class="text-success">View or Update Details</a>
			  <?php
			  }
              else
              {
				  
                ?>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>" class="text-danger">Create DN</a>
                <?php 
              }
					   }
              ?></td>
					  <td>
					  
					  
					  <?php 
					   if($rowselect['servicetype']=='Carry-In')
					   {
              if($rowselect['supcompstatus']!='')
              {
               ?>
                <b>Complaint Status:</b> <span class="text-primary"><?=$rowselect['supcompstatus']?></span><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>" class="text-success">View or Update Details</a>
                <?php 
              }
              else if($rowselect['supapprovalstatus']!='')
              {
                ?>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>" class="text-danger">Received from OEM</a>
                <?php 
              }
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
					  <td><?php if(($rowselect['compstatus']!='2') && ($rowselect['compstatus']!='1') && ($rowselect['compstatus']!='3' )) { ?><a href="https://api.whatsapp.com/send?phone=<?php echo $rowselect['callfrom']; ?>&text=Dear customer, we have received your complaint and are currently reviewing it. Our engineer will be reaching out to you soon. Thank you for reaching out to us." target="_blank" class="whatsapp">App</a>

					  <a href="https://web.whatsapp.com/send?phone=<?php echo $rowselect['callfrom']; ?>&text=Dear customer, we have received your complaint and are currently reviewing it. Our engineer will be reaching out to you soon. Thank you for reaching out to us." target="_blank" class="whatsapp">Web</a><?php } ?>
</td>
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
							  <td><a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>">View Report</a></td>
							  <?php
						  }
						  }
						  else
						  {
							  ?>
							  <td><a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>">View Report</a></td>
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
			  
			<div class="modal fade" id="additionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
		$s=0;
		foreach($callfrom as $cf)
		{
			if(trim($cf)!='')
			{
			echo $cf.'<br>';
			$s++;
			}
		}
		if($s==0)
		{
			?>
			<script>document.getElementById("additionalcontact").style.display="none";</script>
			<?php
		}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
			
            </div>
          </div>
        </div>
		</div>
  <!-----call history---->
  </div>
  
   <div class="tab-pane fade" id="enquiry" role="tabpanel" aria-labelledby="enquiry-tab">
  <!-----Enquiry---->
  <div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class=" justify-content-between">
			  <h6 class="m-0 font-weight-bold text-black">Enquiry Management</h6>
               </div>
            </div>
			  <div class="card-body pt-0 pt-md-4">
			<a href="enquiryadd.php?id=<?=$id?>" class="btn btn-primary btn-sm mb-3 float-right"><i class="fa fa-plus"></i>  New Enquiry</a>
			
			<div class="table-responsive">

<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
 <tr>
		<th>S.No</th>
		<th>Enquiry Date</th>
		<th>Description</th> 
		<th>Edit</th> 
		
		
      </tr>	
</thead>
<tbody>

<?php



  $sqlselect = "select id,enquirydate,enquirydesc from jrcenquiry where consigneeid='".$id."' order by enquirydate desc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$i=1;
			while($rowselect=mysqli_fetch_array($queryselect))
			{
		
				?>
	<tr>
		<td data-label="S.No"><?=$i?></td>
	
		<td data-label="Enquiry Date"><?php if($rowselect['enquirydate']!="") { echo date('d-m-Y',strtotime($rowselect['enquirydate'])); } ?></td>
		
		<td data-label="Description"><?=$rowselect['enquirydesc']?></td>
		<td data-label="Edit"><a href="enquiryedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
		
		
	</tr>
	<?php
				
	$i++;
			}
		}
	
	
	?>

</tbody>
</table>







</div>
			  
			<div class="modal fade" id="additionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
		$s=0;
		foreach($callfrom as $cf)
		{
			if(trim($cf)!='')
			{
			echo $cf.'<br>';
			$s++;
			}
		}
		if($s==0)
		{
			?>
			<script>document.getElementById("additionalcontact").style.display="none";</script>
			<?php
		}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
			
            </div>
          </div>
        </div>
		</div>	
  <!-----Enquiry---->
  </div><div class="tab-pane fade" id="quotations" role="tabpanel" aria-labelledby="quotations-tab">
  <!-----quotations---->
  <div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="justify-content-between">
			  <h6 class="m-0 font-weight-bold text-black">Quotations</h6>
               </div>
            </div>
			
            <div class="card-body pt-0 pt-md-4">
			<a href="quotationgen.php?id=<?=$id?>" class="btn btn-primary btn-sm mb-3 float-right"><i class="fa fa-plus"></i> New Quotation</a>
			<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>S.No</th>
<th>Age</th>
<th>Quotation No</th>
<th>Quotation Date</th>
<th>Given By</th>
<th>Customer Details</th>
<th>Product Total</th>
<th>Scrap Total</th>
<th>Net Total</th>
<th>Status</th>
<th>Convert to Sales Order</th>
<th>Edit</th>
<th>View / Print</th>
<?php
$ids=array();
 $sqlselect = "SELECT id From jrcsubcompany where enabled='0'   order by id asc";
				  
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
				$ids[]=$rowselect['id'];
				?>
				<th>SC <?=$count?></th>
				<?php
				$count++;
			}
		}
?>
</tr>
</thead>
<tbody>
<?php 

		$sqlselect = "SELECT  engineerid, createdby, qdate, qno, consigneeid, prototal, scrtotal, gratotal, compstatus, changeon, sono, sodate, id, createdon From jrcquotation ".$staqu."  where consigneeid='".$id."' group by qno, qdate order by id desc";
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
				$engineerid=mysqli_real_escape_string($connection,$rowselect['engineerid']);
				$sqleng = "SELECT engineername From jrcengineer where id='".$engineerid."' order by engineername asc";
				$queryeng = mysqli_query($connection, $sqleng);
				$roweng = mysqli_fetch_array($queryeng);
				
				$createdby=mysqli_real_escape_string($connection,$rowselect['createdby']);
				$sqladmin = "SELECT adminusername From  jrcadminuser where username='".$createdby."' order by adminusername asc";
				$queryadmin = mysqli_query($connection, $sqladmin);
				$rowadmin = mysqli_fetch_array($queryadmin);
				
				$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
				$sqlcons = "SELECT consigneename, address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
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
				
				$diff = abs(time() - strtotime($rowselect['qdate']));
$days = floor(($diff)/ (60*60*24));
				?>
				<tr>
				<td><?=$count?></td>
				<td><?=$days?></td>
				<td><a href="quotationgenview.php?id=<?=$rowselect['qno']?>" target="_blank"><?=$rowselect['qno']?></a></td>
				<td><?=date('d/m/Y', strtotime($rowselect['qdate']))?></td>
				<td><?php if(isset($rowadmin['adminusername'])) { echo $rowadmin['adminusername']; } else { echo $roweng['engineername']; } ?></td>
				 <?php
					  if($rowselect['consigneeid']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowcons['consigneename']?></a><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?>
<td class="text-right"><?=number_format((float)$rowselect['prototal'],2,'.','')?></td>
<td class="text-right"><?=number_format((float)$rowselect['scrtotal'],2,'.','')?></td>
<td class="text-right"><?=number_format((float)$rowselect['gratotal'],2,'.','')?></td>
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
					  <td>
					  <?php
					  if($rowselect['sono']!='')
					  {
						?>
						<span class="text-success">Converted<br><?=$rowselect['sono']?><br><?=date('d-m-Y',strtotime($rowselect['sodate']))?></span>
						<?php
						
					  }
					  else
					  {
						  ?>
						  <a href="salesorderadd.php?id=<?=$rowselect['id']?>" target="_blank" class="text-danger" onclick="return confirm('Are you sure want to Convert?')">Click to Convert</a>
						  <?php
					  }
					  ?>
					  </td>  
					  <td>
					  <a href="quotationgenedit.php?id=<?=$rowselect['qno']?>&&date=<?=$rowselect['createdon']?>"  class="text-primary">Edit</a>
					  </td> 
					  <td>
					  <a href="quotationprint.php?id=<?=$rowselect['id']?>" target="_blank" class="text-primary">View / Print</a>
					  </td> 
					  <?php
					  $is=1;
					  foreach($ids as $idd)
					  {
						  ?>
					  <td>
					  <a href="quotationprintsub.php?sc=<?=$idd?>&id=<?=$rowselect['id']?>" target="_blank" class="text-primary">View / Print</a>
					  </td>
					  <?php
					  $is++;
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
			  
			<div class="modal fade" id="additionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
		$s=0;
		foreach($callfrom as $cf)
		{
			if(trim($cf)!='')
			{
			echo $cf.'<br>';
			$s++;
			}
		}
		if($s==0)
		{
			?>
			<script>document.getElementById("additionalcontact").style.display="none";</script>
			<?php
		}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
			
            </div>
          </div>
        </div>
		</div>
  <!-----quotations---->
  </div>
  <div class="tab-pane fade" id="amcquotations" role="tabpanel" aria-labelledby="amcquotations-tab">
  <!-----amc quotations---->
  <div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class=" justify-content-between">
			  <h6 class="m-0 font-weight-bold text-black"> AMC Quotations</h6>
               </div>
            </div>
			
            <div class="card-body pt-0 pt-md-4">
			<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>S.No</th>
<th>Age</th>
<th>Quotation No</th>
<th>Quotation Date</th>
<th>Given By</th>
<th>Customer Details</th>
<th>Total Value</th>
<th>From Date</th>
<th>To Date</th>
<th>Maintenance Type</th>
<th>Status</th>
<th>Convert to AMC</th>
<th>Edit</th>
<th>View / Print</th>
</tr>
</thead>
<tbody>
<?php 

		$sqlselect = "SELECT  engineerid, createdby, qdate, qno, consigneeid, datefrom,dateto,totalvalue,maintenancetype, compstatus,  id, createdon,sourceid,adate From jrcamcquotation ".$staqu."  where consigneeid='".$id."' group by qno, qdate order by id desc";
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
				$engineerid=mysqli_real_escape_string($connection,$rowselect['engineerid']);
				$sqleng = "SELECT engineername From jrcengineer where id='".$engineerid."' order by engineername asc";
				$queryeng = mysqli_query($connection, $sqleng);
				$roweng = mysqli_fetch_array($queryeng);
				
				$createdby=mysqli_real_escape_string($connection,$rowselect['createdby']);
				$sqladmin = "SELECT adminusername From  jrcadminuser where username='".$createdby."' order by adminusername asc";
				$queryadmin = mysqli_query($connection, $sqladmin);
				$rowadmin = mysqli_fetch_array($queryadmin);
				
				$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
				$sqlcons = "SELECT consigneename, address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
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
				
				$diff = abs(time() - strtotime($rowselect['qdate']));
$days = floor(($diff)/ (60*60*24));
				?>
				<tr>
				<td><?=$count?></td>
				<td><?=$days?></td>
				<td><a href="amcquotationgenview.php?id=<?=$rowselect['qno']?>" target="_blank"><?=$rowselect['qno']?></a></td>
				<td><?=date('d/m/Y', strtotime($rowselect['qdate']))?></td>
				<td><?php if(isset($rowadmin['adminusername'])) { echo $rowadmin['adminusername']; } else { echo $roweng['engineername']; } ?></td>
				 <?php
					  if($rowselect['consigneeid']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowcons['consigneename']?></a><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?>
<td class="text-right"><?=$rowselect['totalvalue']?></td>
<td class="text-right"><?=date('d/m/Y', strtotime($rowselect['datefrom']))?></td>
<td class="text-right"><?=date('d/m/Y ', strtotime($rowselect['dateto']))?></td>
<td class="text-right"><?=$rowselect['maintenancetype']?></td>
<td>
					  <?php
					 if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['adate']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span>on <?=date('d-m-Y h:i:s a', strtotime($rowselect['adate']))?>
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
					 
					

<td>
<?php
					  if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Converted</span><br><?=$rowselect['qno']?>    On<br><?=date('d-m-Y',strtotime($rowselect['qdate']))?>
						<?php
						
					  }
					  else
					  {
						  ?>
						    <a href="amcedit.php?consigneeid=<?=$rowselect['consigneeid']?>&xlid=<?=$rowselect['sourceid']?>&qid=<?=$rowselect['id']?>&qdate=<?=$rowselect['qdate']?>"class="text-danger" onclick="return confirm('Are you sure want to Convert?')">Click to Convert </a>
						 <?php
					  }
					  ?>
					  </td>  
					  <td>
					  <a href="amcquotationgenedit.php?id=<?=$rowselect['qno']?>&date=<?=$rowselect['createdon']?>"  class="text-primary">Edit</a>
					  </td> 
					  <td>
					  <a href="amcquotationprint.php?id=<?=$rowselect['qno']?>" target="_blank" class="text-primary">View / Print</a>
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
			  
			<div class="modal fade" id="additionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
		$s=0;
		foreach($callfrom as $cf)
		{
			if(trim($cf)!='')
			{
			echo $cf.'<br>';
			$s++;
			}
		}
		if($s==0)
		{
			?>
			<script>document.getElementById("additionalcontact").style.display="none";</script>
			<?php
		}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
			
            </div>
          </div>
        </div>
		</div>
  <!-----amc quotations---->
  </div>
  <div class="tab-pane fade" id="followup" role="tabpanel" aria-labelledby="followup-tab">
  <!-----followup---->
  <div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class=" justify-content-between">
			  <h6 class="m-0 font-weight-bold text-black"> General Followup</h6>
               </div>
            </div>
			  <div class="card-body pt-0 pt-md-4">
			<a href="genfollowupadd.php?id=<?=$id?>" class="btn btn-primary btn-sm mb-3 float-right"><i class="fa fa-plus"></i>  New General Followup</a>
			
			<div class="table-responsive">

<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
 <tr>
		<th>S.No</th>
		<th>Followup Type</th>
		<th>Followup Date and Time</th>
		<th>Postponed Date and Time</th>
		<th>Remarks Given</th> 
		<th>Followup Status</th> 
		
		
      </tr>	
</thead>
<tbody>

<?php



  $sqlselect = "select followuptype, followupdate, followupback, reason, status from jrcfollowup where consigneeid='".$id."' order by followupdate desc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$i=1;
			while($rowselect=mysqli_fetch_array($queryselect))
			{
		
				?>
	<tr>
		<td data-label="S.No"><?=$i?></td>
		<td data-label="Followup Type"><?=$rowselect['followuptype']?></td>
		<td data-label="Followup Date and Time"><?php if($rowselect['followupdate']!="") { echo date('d-m-Y h:i a',strtotime($rowselect['followupdate'])); } ?></td>
		<td data-label="Postponed Date and Time"><?php if($rowselect['followupback']!="") { echo date('d-m-Y h:i a',strtotime($rowselect['followupback'])); }  ?></td>
		<td data-label="Remarks Given"><?=$rowselect['reason']?></td>
		<td data-label="Followup Status"><?php  if($rowselect['status']=='Completed'){ ?><span class="text-success"><b><?=$rowselect['status']?></b></span><?php } else { ?><span class="text-danger"><b><?=$rowselect['status']?></b></span><?php } ?></td>
		
	</tr>
	<?php
				
	$i++;
			}
		}
	
	
	?>

</tbody>
</table>







</div>
			  
			<div class="modal fade" id="additionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
		$s=0;
		foreach($callfrom as $cf)
		{
			if(trim($cf)!='')
			{
			echo $cf.'<br>';
			$s++;
			}
		}
		if($s==0)
		{
			?>
			<script>document.getElementById("additionalcontact").style.display="none";</script>
			<?php
		}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
			
            </div>
          </div>
        </div>
		</div>	
  <!-----followup---->
  </div>

<div class="tab-pane fade show" id="rental" role="tabpanel" aria-labelledby="rental-tab">
  <!-----Rental---->
        <!-- List group-->
      <ul class="list-group">


 <?php
				  $sqlselect = "SELECT rono, rentaldate, id From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."'  and rono!='' group by rono, rentaldate order by rentaldate desc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			$stockitem="";
			$rono="";
			$rentaldate="";
			
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			?>
			
        <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-1">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold" style="font-size:1.1rem"><?=$rowselect['rono']?> - <?=($rowselect['rentaldate']!='')?(date('d/m/Y',strtotime($rowselect['rentaldate']))):''?> <a href="rentalprint.php?id=<?=$rowselect['rono']?>"><i class="fa fa-print text-danger"></i></a> &nbsp;<a href="rentaledit.php?id=<?=$rowselect['rono']?>"><i class="fa fa-edit"></i></a> </h5>
               <?php
			   
			   $stockitem="";
			$rono="";
			$rentaldate="";
			   $coset1=1;
			
			
			$sqlselect2 = mysqli_query($connection, "SELECT stockmaincategory, stocksubcategory, overallwarranty, tdelete, typeofproduct, componenttype, componentname, make, capacity, qty, serialnumber, departments, datefrom,dateto, warranty, id, stockitem, rono, rentaldate,productid From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' and rono='".$rowselect['rono']."' and rentaldate='".$rowselect['rentaldate']."' order by rentaldate desc");
			   while($infoselect2=mysqli_fetch_array($sqlselect2))
			   {
				  
				   ?>
				   <?php
			if(($rono!=$infoselect2['rono'])||($rentaldate!=$infoselect2['rentaldate'])||($stockitem!=$infoselect2['stockitem']))
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
if($infoselect2['datefrom']!="")
{	
?>	
<b>Date From: </b> <?=date('d/m/Y h:i a',strtotime($infoselect2['datefrom']))?>&nbsp;
<?php
}
if($infoselect2['dateto']!="")
{	
?>	
<b>Date To: </b> <?=date('d/m/Y h:i a',strtotime($infoselect2['dateto']))?>&nbsp;
<?php
}
?>


<?php
}


			}
			?>
			
			<div class="row" style="background-color:#f1f1f1">
			<div class="col-lg-10 p-2">
			<table width="100%" class="mytabl">
			<tr>
			<th rowspan="4" style="width:40px; background-color:#8d8d8d!important; color:#ffffff; text-align:center"><?=$coset?>
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
$date=date('d/m/Y h:i a',strtotime($infoselect2['dateto']));
			$now=date('d/m/Y h:i a');
			if($date < $now)
			{
				echo '<span class="bg-danger text-white">Lapsed Rental <strong>('.$date.')</strong></span><br>';
				?>
					<?php
			}
			else
			{
				echo '<span class="bg-success text-white">Rental Active <strong>('.$date.')</strong></span><br>';
				?>
				<script>
				document.getElementById("rentalcustomer").style.display="inline-block";
				</script>
				<?php
			}
			
?>
<?php
$sql=mysqli_query($connection,"SELECT id from jrcrental where rono='".$infoselect2['rono']."' and productid='".$infoselect2['productid']."'");
$rental=mysqli_fetch_array($sql);
?>
		
		<a href="callsadd.php?id=<?=$infoselect2['id']?>&type=<?=$rental['id']?>" class="button8 bg-primary text-white">Take a call</a>
	</div>
	
	
	</div>
				   <?php
				   
				   $stockitem=$infoselect2['stockitem'];
				$rono=$infoselect2['rono'];
				$rentaldate=$infoselect2['rentaldate'];
				   $coset1++;
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
  <!-----Retal---->
  </div>


</div>
				
				
<!--close tab-content-->


				
                </div>
              </div>

              </div>
          </div>

        </div>
	
	 
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
        <div class="col-xl-12 order-xl-1 mb-5 mb-xl-0 p-1">
          <div class="card card-profile shadow">
            <div class="card-body">
 <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  
<?php
$c=0;
?><!--
<th>Invoice No.</th>
<th>Invoice Date</th>
<th>Tender No.</th>
<th>Purchase Order No.</th>
<th>PO Date</th>
<th>DC No.</th>
<th>DC Date</th>
<th>Installed On</th>
<th>Installed By</th>-->
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
<!--
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
<th>Serial Numbers</th>-->
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $sqlselect = "SELECT invoiceno, invoicedate, tenderno, pono, podate, dcno, dcdate, installedon, installedby, maincategory, subcategory, consigneename, consigneeid, department, address1, address2, area, district, pincode, contact, phone, mobile, email, stockmaincategory, stocksubcategory, stockitem, invoicedqty, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, warranty, qty, serialnumber FROM jrcxl WHERE tdelete='0' and (".$q.") group by consigneename ORDER BY consigneename ASC"; 
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
					<!--  <td><?=str_ireplace($finds, $replaces,$rowselect['invoiceno'])?></td>
<td><?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['tenderno'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['pono'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['podate'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['dcno'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['dcdate'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['installedon'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['installedby'])?></td>-->
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
<!--
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
<td><?=str_ireplace($finds, $replaces,$rowselect['serialnumber'])?></td> -->
					  
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
  
  <div class="modal fade" id="contactmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Information</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
		<?php
		$id=mysqli_real_escape_string($connection,$_GET['id']);
				  $sqlselect = "SELECT address1, phone, mobile, email, contact From jrcconsignee where id='".$id."' order by consigneename asc";
				  
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
<form action="contactedit.php" method="post">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
<?php
if($infolayoutcustomers['contact']=='1')
{
?>
<div class="col-lg-6">
  <div class="form-group">
    <label for="contact">Contact Person</label>
    <input type="text" class="form-control" id="contact" name="contact" <?=($infolayoutcustomers['contactreq']=='1')?'required':''?> value="<?=$rowselect['contact']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="contact" id="contact"  value="<?=$rowselect['contact']?>">
	<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
<div class="col-lg-6">
      <div class="form-group">
    <label for="phone">Phone No</label>
    <input type="text" class="form-control" id="phone" name="phone" maxlength="11" <?=($infolayoutcustomers['phonereq']=='1')?'required':''?> value="<?=$rowselect['phone']?>">
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="phone" id="phone" value="<?=$rowselect['phone']?>">
	<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
<div class="col-lg-6">
  <div class="form-group">
    <label for="mobile">Mobile No</label>
    <input type="text" class="form-control" id="mobile" name="mobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?> value="<?=$rowselect['mobile']?>">
  </div>
   </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="mobile" id="mobile" value="<?=$rowselect['mobile']?>">
	<?php
}
if($infolayoutcustomers['email']=='1')
{
?> 
<div class="col-lg-6">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?> value="<?=$rowselect['email']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="email" id="email" value="<?=$rowselect['email']?>">
	<?php
}
?> 
  </div>
  
  
  

<?php
					$count++;
			}
		}
			?>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        </div>
		</form>
      </div>
    </div>
  </div>



<div class="modal fade" id="emailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Dates</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
		<?php
				  $sqlcon = "SELECT email,id From jrcconsignee where id='".$id."'";
				  
        $querycon = mysqli_query($connection, $sqlcon);
		$rowcon = mysqli_fetch_array($querycon);
			?>
<form action="consigneemail.php" method="post">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">

<div class="col-lg-6">
  <div class="form-group">
    <label for="fromdate">From Date</label>
    <input type="date" class="form-control" id="fromdate" name="fromdate"  value="<?=date('Y-m-d')?>" required>
  </div>
   </div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="todate">To Date</label>
    <input type="date" class="form-control" id="todate" name="todate"  value="<?=date('Y-m-d')?>" required>
  </div>
   </div>
   <?php
   if($infolayoutcustomers['email']=='1')
{
?> 
<div class="col-lg-12">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?> value="<?=$rowcon['email']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="email" id="email" value="<?=$rowselect['email']?>">
	<?php
}
?>
  </div>
  
  
  


		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input class="btn btn-primary" type="submit" name="submit1" value="Submit">
        </div>
		</form>
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
