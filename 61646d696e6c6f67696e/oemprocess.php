<?php 
include('lcheck.php');
if($calladd=='0')
{
	header("location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$dcno=mysqli_real_escape_string($connection, $_POST['dcno']);
	$dcdate=mysqli_real_escape_string($connection, $_POST['dcdate']);
	$suppliername=mysqli_real_escape_string($connection, $_POST['suppliername']);
	$supwarrantytype=mysqli_real_escape_string($connection, $_POST['supwarrantytype']);
	$supcomplaintno=mysqli_real_escape_string($connection, $_POST['supcomplaintno']);
	$supcomplaintremarks=mysqli_real_escape_string($connection, $_POST['supcomplaintremarks']);
	$supcourierdate=mysqli_real_escape_string($connection, $_POST['supcourierdate']);
	$supcourierpaytype=mysqli_real_escape_string($connection, $_POST['supcourierpaytype']);
	$supcouriercharges=mysqli_real_escape_string($connection, $_POST['supcouriercharges']);
	$supcourierdetails=mysqli_real_escape_string($connection, $_POST['supcourierdetails']);
	$supcourierimg=mysqli_real_escape_string($connection, $_POST['supcourierimg']);
	$taxablevalue=(float)mysqli_real_escape_string($connection, $_POST['taxablevalue']);
  
	$supestimatedcost=mysqli_real_escape_string($connection, $_POST['supestimatedcost']);
	$supestdelivery=mysqli_real_escape_string($connection, $_POST['supestdelivery']);
	$supapprovalstatus=mysqli_real_escape_string($connection, $_POST['supapprovalstatus']);
	$supcustomerremarks=mysqli_real_escape_string($connection, $_POST['supcustomerremarks']);
	$suprcourierdate=mysqli_real_escape_string($connection, $_POST['suprcourierdate']);
	$suprcourierpaytype=mysqli_real_escape_string($connection, $_POST['suprcourierpaytype']);
	$suprcouriercharges=mysqli_real_escape_string($connection, $_POST['suprcouriercharges']);
	$suprcourierdetails=mysqli_real_escape_string($connection, $_POST['suprcourierdetails']);
	$suprcourierimg=mysqli_real_escape_string($connection, $_POST['suprcourierimg']);
	$supcompstatus=mysqli_real_escape_string($connection, $_POST['supcompstatus']);
	$revserialnumber =mysqli_real_escape_string($connection, $_POST['revserialnumber']);
	
	$supoemestimatedcost=mysqli_real_escape_string($connection, $_POST['supoemestimatedcost']);
	$supoemestdelivery=mysqli_real_escape_string($connection, $_POST['supoemestdelivery']);
	$supoemremarks =mysqli_real_escape_string($connection, $_POST['supoemremarks']);
	
	$suptype=mysqli_real_escape_string($connection, $_POST['suptype']);
	$suprtype =mysqli_real_escape_string($connection, $_POST['suprtype']);
	
	
	$callonvalue =mysqli_real_escape_string($connection, $_POST['callonvalue']);
	$callid =mysqli_real_escape_string($connection, $_POST['callid']);
	$godownname  =mysqli_real_escape_string($connection, $_POST['godownname']);
	$consigneeidvalue  =mysqli_real_escape_string($connection, $_POST['consigneeidvalue']);
	$sourceidvalue =mysqli_real_escape_string($connection, $_POST['sourceidvalue']); 
	
	
 
	$sqlis=mysqli_query($connection, "select id from jrccalls where id='$id'");
	if(mysqli_num_rows($sqlis)>0)
	{
		if($dcno=='')
		{
		$querysr = mysqli_query($connection, "SELECT dcno From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		$dcno='DN / '.date('m').date('y').' /'.(str_pad(((float)$infosr['dcno']+1),5,"0",STR_PAD_LEFT));
		$dcdate=date('Y-m-d');
		
		mysqli_query($connection, "update jrcsrno set dcno=dcno+1");
		}

		echo $sqlise=mysqli_query($connection, "update jrccalls set  supestimatedcost='$supestimatedcost',revserialnumber ='$revserialnumber ',supestdelivery='$supestdelivery',supapprovalstatus='$supapprovalstatus',supcustomerremarks='$supcustomerremarks',suprcourierdate='$suprcourierdate',suprcourierpaytype='$suprcourierpaytype',suprcouriercharges='$suprcouriercharges',suprcourierdetails='$suprcourierdetails',suprcourierimg='$suprcourierimg',supcompstatus='$supcompstatus',dcno='$dcno', dcdate='$dcdate', suppliername='$suppliername', supwarrantytype='$supwarrantytype', supcomplaintno='$supcomplaintno', supcomplaintremarks='$supcomplaintremarks', supcourierdate='$supcourierdate', supcourierpaytype='$supcourierpaytype', supcouriercharges='$supcouriercharges', supcourierdetails='$supcourierdetails', supcourierimg='$supcourierimg', taxablevalue='$taxablevalue', supoemestimatedcost='$supoemestimatedcost', supoemestdelivery='$supoemestdelivery', supoemremarks='$supoemremarks', suptype='$suptype', suprtype='$suprtype', compstatus='1',changeon='$dcdate' where id='$id'");
	
		if($sqlise)
		{
			$tid=$id;
			if(($suppliername!=""))
			{
			mysqli_query($connection, "update jrcgodownproduct set type='OEM Sent' where callid='$id'");
			}
			if(($supcompstatus=='Completed'))
			{
			mysqli_query($connection, "update jrcgodownproduct set type='OEM Received' where callid='$id'");
			}
			mysqli_query($connection, "INSERT INTO jrcgodowninventory (date, callid, godownid, consigneeid, sourceid, inworddate, remarks) VALUES ('{$callonvalue}', '{$callid}', '{$godownname}', '{$consigneeidvalue}', '{$sourceidvalue}', '{$callonvalue}', 'Insert A Godown Complaint Call')");
		header("Location: inhousecalls.php?remarks=Updated Successfully");
		}
		else
		{
			header("Location: inhousecalls.php?error=".mysqli_error($connection));
		}
	}
	else
	{
		header("Location: inhousecalls.php?error=No Data Found");
	}
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
  <title><?=$_SESSION['companyname']?> - Jerobyte - OEM Product Movements</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
   <style>
		
.collapsible {
  background-color: #3d8eb9 !important;
  color: white;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.collapsible1 {
  background-color: #3d8eb9 !important;
  color: white;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.active, .collapsible:hover {
  background-color: #fff;
}

.content {
  padding: 10px;
  display: none;
  overflow: hidden;
  background-color: #fff;
}

		</style>
</head>
<body id="page-top" OnLoad="courierreceived();couriersent()">
  <div id="wrapper">
    <?php  include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php  include('navbar.php');?>
          <?php  include('inhousenavbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">OEM Product Movements</h1>
            <a href="inhousecalls.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Carry-In Calls</a>
          </div>

<?php 
$id='';
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlcalls = "SELECT id,sourceid,callon,calltid,acknowlodge,callhandlingid,callhandlingname,coordinatorid,coordinatorname,engineertype,engineersid,engineersname,reportingengineerid,engineerid,engineername,compstatus,businesstype,servicetype,customernature,callnature,serial,diagnosisby,diagnosisengineername,diagnosiscoordinatorname,diagnosisremarks,diagnosismaterial,reportedproblem,problemobserved,actiontaken,narration,detailsid,otherremarks,dcno,suppliername,dcdate,supwarrantytype,supcomplaintno,supcomplaintremarks,supapprovalstatus,supestimatedcost,supestdelivery,supcompstatus,changeon,supcourierdate,supcourierpaytype,supcouriercharges,supcourierdetails,supcourierimg,taxablevalue,supcustomerremarks,suprcourierdate,suprcourierpaytype,suprcourierdetails,suprcourierimg,suprcouriercharges,suptype,suprtype  From jrccalls where id='".$id."'";
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
			
			?>

		<div class="row">
			<div class="col-lg-12">

			<div id="call" class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>Call Details</h5>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">

			<div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID and Date</th>
                      <th>Call Details</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Diagnosis Details</th>
					  <th>Problem Details</th>
					  <th>OEM Sent Details</th>
					  <th>Estimate Cost</th>
					  <th>Customer Confirmation</th>
					  <th>OEM Received Details</th>
					  <th>Status</th>
					</tr>
                  </thead>
                  <tbody>
				  <?php 
		$sqlselect = "SELECT id,sourceid,callon,calltid,acknowlodge,callhandlingid,callhandlingname,coordinatorid,coordinatorname,engineertype,engineersid,engineersname,reportingengineerid,engineerid,engineername,compstatus,businesstype,servicetype,customernature,callnature,serial,diagnosisby,diagnosisengineername,diagnosiscoordinatorname,diagnosisremarks,diagnosismaterial,diagnosissignmode,reportedproblem,problemobserved,actiontaken,narration,detailsid,otherremarks,dcno,suppliername,dcdate,supwarrantytype,supcomplaintno,supcomplaintremarks,supapprovalstatus,supestimatedcost,supestdelivery,supcompstatus,changeon,supcourierdate,supcourierpaytype,supoemestimatedcost,supoemestdelivery,supoemremarks,supcouriercharges,supcourierdetails,supcourierimg,taxablevalue,supcustomerremarks,suprcourierdetails,suprcourierimg,revserialnumber,suprcourierdate,suprcourierpaytype,godownname,consigneeid,suptype,suprtype,suprcouriercharges  From jrccalls where id='$id' order by id desc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0)  
		{
			$count=1;
			$rowselect = mysqli_fetch_array($queryselect);
			
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
                      <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php  echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
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
					Received Mode: <?=$rowselect['coordinatorname']?><br>
					  <?php
					  if($rowselect['engineertype']=='1')
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
						E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
						  <?php
					  }
					  ?>
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
					  
					 <td>
						 <b>Diagnosis By:</b> <span class="text-primary"><?=($rowselect['diagnosisby']=='engineer')?$rowselect['diagnosisengineername']:$rowselect['diagnosiscoordinatorname']?></span><br>
						 <b>Remarks:</b> <span class="text-primary"><?=$rowselect['diagnosisremarks']?></span><br>
						 <b>Other Materials:</b> <span class="text-primary"><?=$rowselect['diagnosismaterial']?></span><br>

					</td>
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
             
                $sqlrep2 = "SELECT id,suppliername From jrcsuppliers where id='".$rowselect['suppliername']."' order by suppliername asc";
                $queryrep2 = mysqli_query($connection, $sqlrep2);
                $inforep2=mysqli_fetch_array($queryrep2);
if($rowselect['dcno']!='' && $rowselect['dcdate']!='')
{
                ?>
				
                <b>DN No:</b> <span class="text-primary"><?=$rowselect['dcno']?></span><br>
                <b>DN Date:</b> <span class="text-primary"><?=date('d/m/Y',strtotime($rowselect['dcdate']))?></span><br>

                <b>Supplier Name:</b> <span class="text-primary"><?php if(isset($inforep2['suppliername'])){ echo $inforep2['suppliername']; } else {echo ''; }?></span><br>
                <b>Warranty Type:</b> <span class="text-primary"><?=$rowselect['supwarrantytype']?></span><br>
      
                <b>Complaint Remarks:</b> <span class="text-primary"><?=$rowselect['supcomplaintremarks']?></span><br>
             
				<b>Complaint No:</b> <span class="text-primary"><?=$rowselect['supcomplaintno']?></span><br>
				 
			  
			  <a href="deliverynoteprint.php?id=<?=$rowselect['dcno']?>" class="text-info" target="_blank">Print Delivery Note</a><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=DC" class="text-success">View or Update Details</a>
			  <?php
			  
}
else
{
	?>
	 <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=DC" class="text-danger">Create DN</a>
	 <?php 
}
			  ?>
			  
					  
					</td>
				<td>
             <?php  
			 if($rowselect['supoemestimatedcost']!='' || $rowselect['supoemestdelivery']!='' ||$rowselect['supoemremarks']!='')
			 {
				 ?>
			<b>Cost:</b> <span class="text-primary"><?=$rowselect['supoemestimatedcost']?></span><br>
                <b>Delivery:</b> <span class="text-primary"><?php if($rowselect['supoemestdelivery']) { echo date('d/m/Y',strtotime($rowselect['supoemestdelivery'])); } else { echo ''; } ?></span><br>
				<b>Remarks:</b> <span class="text-primary"><?=$rowselect['supoemremarks']?></span><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Estimate" class="text-success">View or Update Details</a>
                	<?php
			 }
			 else
			 {
				?>
				   <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Estimate" class="text-danger">Estimate Cost</a>
<?php				
			 }
			 
?>					
					</td>
					
					<td>

		  <?php 
             
					  if($rowselect['supapprovalstatus']=='0')
					  {
						  $status="Waiting For Approval";
					  }
					  if($rowselect['supapprovalstatus']=='1')
					  {
						  $status="Confirm";
					  }
					  if($rowselect['supapprovalstatus']=='2')
					  {
						  $status="Rejected";
					  }
					  else{
						  $status="";
					  }
				
				 if($rowselect['supestimatedcost']!='' ||  $rowselect['supestdelivery']!='' || $rowselect['supcustomerremarks']!='')
				 {					 
               ?>
       
			<b>Cost:</b> <span class="text-primary"><?=$rowselect['supestimatedcost']?></span><br>
			<b>Approval Status:</b> <span class="text-primary"><?=$status?></span><br>
                <b>Delivery:</b> <span class="text-primary"><?php if($rowselect['supestdelivery']!='') { echo date('d/m/Y',strtotime($rowselect['supestdelivery'])); } else { echo '';}?></span><br>
				<b>Remarks:</b> <span class="text-primary"><?=$rowselect['supcustomerremarks']?></span><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Confirmation" class="text-success">View or Update Details</a>
                		<?php
				 }
else
{
	?>
	<a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Confirmation" class="text-danger">Customer Confirmation</a>
	<?php
}?>	
					</td>
					
					
					
          <td>
         <?php
		 if($rowselect['supcompstatus']!='')
				 {	
		 ?>
                <b>Complaint Status:</b> <span class="text-primary"><?=$rowselect['supcompstatus']?></span><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Received" class="text-success">View or Update Details</a>
              <?php
				 }
				 else
				 {
					 ?>
					   <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Received" class="text-danger">Received From OEM</a>
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
						<span class="text-danger">Pending </span>on <?=date('d/m/Y', strtotime($rowselect['changeon']))?>
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
			?>
					
                  </tbody>
                </table>
              </div>
			</div>
			</div>
	</div>
	</div>
	<br>
<!--collapse-->
<div  class="card card-profile shadow">
 <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>OEM Process</h5>
              </div>
            </div>
<div class="card-body pt-0 pt-md-4">

<form onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<input type="hidden" name="callonvalue" id="callonvalue" value="<?=$rowselect['callon']?>">
<input type="hidden" name="callid" id="callid" value="<?=$rowselect['calltid']?>">
<input type="hidden" name="godownname" id="godownname" value="<?=$rowselect['godownname']?>">
<input type="hidden" name="consigneeidvalue" id="consigneeidvalue" value="<?=$rowselect['consigneeid']?>">
<input type="hidden" name="sourceidvalue" id="sourceidvalue" value="<?=$rowselect['sourceid']?>">
<!--start accordion -->
<div id="accordion">
  <div class="card" style="width:100%">
    <div class="card-header" id="headingOne" style="padding: .1rem 2rem;">
      <h5 class="mb-0">
	
        <a class="btn btn-link text-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><b>Delivery Note</b>
		 </a>
		
       
      </h5>
    </div>

    <div id="collapseOne" class="collapse <?=($_GET['active']=='DC' && $_GET['active']=='Sent')?'show':($_GET['active']=='DC')?'show':''?>" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
<div class="row" id="deliverychallan">
<div class="col-lg-3">
  <div class="form-group">
    <label for="dcno">DN No</label>
    <input type="text" class="form-control" id="dcno" name="dcno" value="<?=$rowselect['dcno']?>" readonly>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="dcdate">DN Date</label>
    <input type="text" class="form-control" id="dcdate" name="dcdate"  value="<?=($rowselect['dcdate']!='')?date('d-m-Y',strtotime($rowselect['dcdate'])):''?>" readonly>
  </div>
</div>	
<div class="col-lg-3">
  <div class="form-group">
    <label for="suppliername">Supplier Name</label>
<select class="form-control fav_clr" id="suppliername" name="suppliername" >
<option value="">Select</option>
<?php 
$sqlrep = "SELECT id,suppliername From jrcsuppliers order by suppliername asc";
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
<option value="<?=$rowrep['id']?>" <?=($rowselect['suppliername']==$rowrep['id'])?'selected':''?>><?=$rowrep['suppliername']?></option>
<?php 
			}
		}
		?>
</select>

  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supwarrantytype">Supplier Warranty Type</label>
    <select class="form-control" id="supwarrantytype" name="supwarrantytype">
	<option value="">Select</option>	
	<option value="Warranty" <?=($rowselect['supwarrantytype']=="Warranty")?'selected':''?>>Warranty</option>
	<option value="Out of Warranty" <?=($rowselect['supwarrantytype']=="Out of Warranty")?'selected':''?>>Out of Warranty</option>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supcomplaintno">Complaint No</label>
    <input type="text" class="form-control" id="supcomplaintno" name="supcomplaintno" value="<?=$rowselect['supcomplaintno']?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supcomplaintremarks">Product Remarks</label>
    <input type="text" class="form-control" id="supcomplaintremarks" name="supcomplaintremarks"  value="<?=$rowselect['supcomplaintremarks']?>">
  </div>
</div>
<div class="col-lg-3">
<div id="mulitplefileuploader" style="width:100%">Product Images</div>
<div id="status"></div>
<?php
 if($rowselect['supcourierimg']!='')
{
	?>
<div id="showData" class="imgcontainer">
	<?php 
	$couns=1;
	$diaimg=explode(',',$rowselect['supcourierimg']);
	if(is_array($diaimg))
	{
	foreach($diaimg as $dimg)
	{
		?>
		<div class="imgcontent" id="imgcontent_<?=$couns?>"><img src="<?=$dimg?>" width="100" height="100"><span class="imgdelete" id="imgdelete_<?=$couns?>">Delete</span></div>
		<?php 
		$couns++;
	}
}
	?>
	
</div>
<?php
}
?>
<input id="supcourierimg" type="hidden" name="supcourierimg" value="<?=$rowselect['supcourierimg']?>">
<br />
	
	</div>
	</div>
      </div>
    </div>
  </div>
  
  
  
  <div class="card" style="width:100%">
    <div class="card-header" id="headingTwo" style="padding: .1rem 2rem;">
      <h5 class="mb-0">
        <a class="btn btn-link collapsed text-primary" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
         <b>Sent to OEM</b>
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse <?=($_GET['active']=='DC')?'show':''?>" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        
	<div class="row" id="sendtooem">
<div class="col-lg-3">
  <div class="form-group">
    <label for="supcourierdate">Sent Date</label>
    <input type="date" class="form-control" id="supcourierdate" name="supcourierdate"  value="<?=($rowselect['supcourierdate'])?$rowselect['supcourierdate']:date('Y-m-d')?>">
  </div>
</div>
<div class="col-lg-3" >
  <div class="form-group">
    <label for="suptype">Sent Through</label>
	<select class="form-control" id="suptype" name="suptype" OnClick="couriersent()">
	<option value="" >Select</option>	
	<option value="Courier" <?=(isset($rowselect['suptype'])&&$rowselect['suptype']=="Courier")?'selected':''?> >Courier</option>
	<option value="Direct" <?=(isset($rowselect['suptype'])&&$rowselect['suptype']=="Direct")?'selected':''?> >Direct</option>
	</select>
  </div>
</div>

<div class="col-lg-3"  style="display:none" id="couriersent1">
  <div class="form-group">
    <label for="supcourierpaytype">Pay Type</label>
	<select class="form-control" id="supcourierpaytype" name="supcourierpaytype"  OnChange="couriersent()"> 
	<option value="">Select</option>	
	<option value="Paid" <?=($rowselect['supcourierpaytype']=="Paid")?'selected':''?>>Paid</option>
	<option value="To Pay" <?=($rowselect['supcourierpaytype']=="To Pay")?'selected':''?>>To Pay</option>
	</select>
  </div>
</div>
<div class="col-lg-3"  style="display:none" id="couriersent2"> 
  <div class="form-group">
    <label for="supcouriercharges">Charges If Any</label>
    <input type="number" min="0" step="0.01" class="form-control" id="supcouriercharges" name="supcouriercharges"  value="<?=$rowselect['supcouriercharges']?>"  OnChange="couriersent()">
  </div>
</div>
<div class="col-lg-3" style="display:none" id="couriersent3">
  <div class="form-group">
    <label for="taxablevalue">Taxable Value</label>
    <input type="number" min="0" step="0.01" class="form-control" id="taxablevalue" name="taxablevalue"  value="<?=$rowselect['taxablevalue']?>" OnChange="couriersent()">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supcourierdetails">Remarks</label>
    <textarea class="form-control" id="supcourierdetails" name="supcourierdetails"><?=$rowselect['supcourierdetails']?></textarea>
  </div>
</div>
  
  
  </div>
  </div>
    </div>
  </div>
  
  <div class="card" style="width:100%">
    <div class="card-header" id="headingThree" style="padding: .1rem 2rem;">
      <h5 class="mb-0">
        <a class="btn btn-link collapsed text-primary" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
        <b> Estimate Cost</b>
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse <?=($_GET['active']=='Estimate')?'show':''?>" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      
	<div class="row" id="oemestimatecost">
<div class="col-lg-3">
  <div class="form-group">
    <label for="supoemestimatedcost">Estimated Cost</label>
    <input type="number" min="0" step="0.01" class="form-control" id="supoemestimatedcost" name="supoemestimatedcost" value="<?=$rowselect['supoemestimatedcost']?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supoemestdelivery">Estimated Delivery</label>
    <input type="date" class="form-control" id="supoemestdelivery" name="supoemestdelivery"  value="<?=$rowselect['supoemestdelivery']?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supoemremarks">Remarks</label>
    <input type="text" class="form-control" id="supoemremarks" name="supoemremarks"  value="<?=$rowselect['supoemremarks']?>">
  </div>
</div>
  </div>
      </div>
    </div>
  </div>
	
<div class="card" style="width:100%">
    <div class="card-header" id="headingFour" style="padding: .1rem 2rem;">
      <h5 class="mb-0">
        <a class="btn btn-link collapsed text-primary" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
      <b> Customer Confirmation</b>
        </a>
      </h5>
    </div>
    <div id="collapseFour" class="collapse <?=($_GET['active']=='Confirmation')?'show':''?>" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
	<div class="row" id="oemestimatecost">
<div class="col-lg-3">
  <div class="form-group">
    <label for="supestimatedcost">Estimated Cost</label>
    <input type="number" min="0" step="0.01" class="form-control" id="supestimatedcost" name="supestimatedcost" value="<?=$rowselect['supestimatedcost']?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supcomplaintremarks">Estimated Delivery</label>
    <input type="date" class="form-control" id="supestdelivery" name="supestdelivery"  value="<?=$rowselect['supestdelivery']?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supapprovalstatus">Approval Status</label>
	<select class="form-control fav_clr" id="supapprovalstatus" name="supapprovalstatus">
<option value=" " <?=($rowselect['supapprovalstatus']==' ')?'selected':''?> selected>Select</option>
<option value="0" <?=($rowselect['supapprovalstatus']=='0')?'selected':''?> >Wait For Approval</option>
<option value="1" <?=($rowselect['supapprovalstatus']=='1')?'selected':''?>>Confirm</option>
<option value="2" <?=($rowselect['supapprovalstatus']=='2')?'selected':''?>>Rejected</option>
</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="supcustomerremarks">Customer Remarks</label>
    <input type="text" class="form-control" id="supcustomerremarks" name="supcustomerremarks"  value="<?=$rowselect['supcustomerremarks']?>">
  </div>
</div>
  </div>
      </div>
    </div>
  </div>
  
<div class="card" style="width:100%">
    <div class="card-header" id="headingFive" style="padding: .1rem 2rem;">
      <h5 class="mb-0">
        <a class="btn btn-link collapsed text-primary" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
      <b>Received from OEM</b>
        </a>
      </h5>
    </div>
    <div id="collapseFive" class="collapse <?=($_GET['active']=='Received')?'show':''?>" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
	<div class="row" id="oemestimatecost">
<div class="col-lg-3">
  <div class="form-group">
    <label for="suprcourierdate">Received Date</label>
    <input type="date" class="form-control" id="suprcourierdate" name="suprcourierdate"  value="<?=$rowselect['suprcourierdate']?>">
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="suprtype">Received Through</label>
	<select class="form-control" id="suprtype" name="suprtype" OnClick="courierreceived()">
	<option value="">Select</option>	
	<option value="Courier" <?=(isset($rowselect['suprtype'])&&$rowselect['suprtype']=="Courier")?'selected':''?>>Courier</option>
	<option value="Direct" <?=(isset($rowselect['suprtype'])&&$rowselect['suprtype']=="Direct")?'selected':''?>>Direct</option>
	</select>
  </div>
</div>
<div class="col-lg-3" id="couriershow1" style="display:none">
  <div class="form-group" >
    <label for="suprcourierpaytype">Pay Type</label>
	<select class="form-control" id="suprcourierpaytype" name="suprcourierpaytype" OnChange="courierreceived()">
	<option value="">Select</option>	
	<option value="Paid" <?=($rowselect['suprcourierpaytype']=="Paid")?'selected':''?>>Paid</option>
	<option value="To Pay" <?=($rowselect['suprcourierpaytype']=="To Pay")?'selected':''?>>To Pay</option>
	</select>
  </div>
</div>
<div class="col-lg-3" id="couriershow2" style="display:none">
  <div class="form-group">
   <label for="suprcouriercharges">Charges If Any</label>
    <input type="number" min="0" step="0.01" class="form-control" id="suprcouriercharges" name="suprcouriercharges"  value="<?=$rowselect['suprcouriercharges']?>" OnChange="courierreceived()">
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="suprcourierdetails">Remarks</label>
    <textarea class="form-control" id="suprcourierdetails" name="suprcourierdetails"><?=$rowselect['suprcourierdetails']?></textarea>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="supcompstatus">Product Service Status</label>
	<select class="form-control" id="supcompstatus" name="supcompstatus" OnClick="change()">
	<option value="">Select</option>	
	<option value="Completed" <?=($rowselect['supcompstatus']=="Completed")?'selected':''?>>Completed</option>
	<option value="Non Repairable" <?=($rowselect['supcompstatus']=="Non Repairable")?'selected':''?>>Non Repairable</option>
	<option value="Replaced" <?=($rowselect['supcompstatus']=="Replaced")?'selected':''?>>Replaced</option>
	</select>
  </div>
</div>
<div id="sample" class="col-lg-3" style="display:none;">
  <div class="form-group">
    <label for="revserialnumber">Received Product Serial Number</label>
	<input type="text" class="form-control" id="revserialnumber" name="revserialnumber" OnChange="change()" value="<?=$rowselect['revserialnumber']?>">
  </div>
</div>
<div class="col-lg-3">
<div id="mulitplefileuploader1" style="width:100%">Upload Site Images</div>
<div id="status1"></div>
<?php
 if($rowselect['suprcourierimg']!='')
{
	?>
<div id="showData1" class="imgcontainer1">
	<?php
	$couns=1;
	$diaimg=explode(',',$rowselect['suprcourierimg']);
	if(is_array($diaimg))
	{
	foreach($diaimg as $dimg)
	{
		?>
		<div class="imgcontent1" id="imgcontent1_<?=$couns?>"><img src="<?=$dimg?>" width="100" height="100"><span class="imgdelete1" id="imgdelete1_<?=$couns?>">Delete</span></div>
		<?php
		$couns++;
	}
}
	?>
	
</div>

<?php
}
?>
<input id="suprcourierimg" type="hidden" name="suprcourierimg" value="<?=$rowselect['suprcourierimg']?>">
<br />
	
	</div>

  </div>
  </div>
    </div>
  </div>     
</div>

<!--end accordion -->
<br>
&nbsp;<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

</div>
<?php
		}
		}
		?>



<!--collapse-->
      </div>
	  
      </div>
      </div>
      <?php  include('footer.php'); ?>
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
                var vals = $("#supcourierimg").val();
                if (vals != '') {
                    $("#supcourierimg").val(vals + ',' + obj.imglist);
                } else {
                    $("#supcourierimg").val(obj.imglist);
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
    function image(thisImg) {
        // var img = document.createElement("IMG");
        // img.src = thisImg;
        // img.className="img-fluid";
        // document.getElementById('showData').appendChild(img);
        var count = $('.imgcontainer1 .imgcontent1').length;
        count = Number(count) + 1;
        $('.imgcontainer1').append("<div class='imgcontent1' id='imgcontent1_" + count + "' ><img src='" + thisImg +
            "' width='100' height='100'><span class='imgdelete1' id='imgdelete1_" + count + "'>Delete</span></div>");
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
                var vals = $("#suprcourierimg").val();
                if (vals != '') {
                    $("#suprcourierimg").val(vals + ',' + obj.imglist);
                } else {
                    $("#suprcourierimg").val(obj.imglist);
                }
                $("#status1").html("<font color='green'>Upload is success</font>");
            },
            onError: function(files, status, errMsg) {
                $("#status1").html("<font color='red'>Upload is Failed</font>" + errMsg);
            }
        }
        $("#mulitplefileuploader1").uploadFile(settings);
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
            var vals = $("#supcourierimg").val();
            let newStr = vals.replace(imgElement_src + ',', '');
            newStr = newStr.replace(',' + imgElement_src, '');
            newStr = newStr.replace(imgElement_src, '');
            $("#supcourierimg").val(newStr);
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
    // Remove file
    $('.imgcontainer1').on('click', '.imgcontent1 .imgdelete1', function() {
        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#imgcontent1_' + num + ' img').attr("src");
        var deleteFile = confirm("Do you really want to Delete?");
        if (deleteFile == true) {
            var vals = $("#suprcourierimg").val();
            let newStr = vals.replace(imgElement_src + ',', '');
            newStr = newStr.replace(',' + imgElement_src, '');
            newStr = newStr.replace(imgElement_src, '');
            $("#suprcourierimg").val(newStr);
            $('#imgcontent1_' + num).remove();
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
	
	function change()
{
	var supcompstatus=document.getElementById("supcompstatus").value;
	var sample=document.getElementById("sample");
	if(supcompstatus=="Replaced")
	{
		sample.style.display="block";
	}
	else
	{
		sample.style.display="none";
	}
}
function couriersent()
{
	
	var suptype=document.getElementById("suptype").value;
	var couriersent1=document.getElementById("couriersent1");
	var couriersent2=document.getElementById("couriersent2");
	var couriersent3=document.getElementById("couriersent3");
	if(suptype=="Courier")
	{ 

		couriersent1.style.display="block";
		couriersent2.style.display="block";
		couriersent3.style.display="block";
	}
	else
	{
		couriersent1.style.display="none";
		couriersent2.style.display="none";
		couriersent3.style.display="none";
		
		supcourierpaytype.value="";
		supcouriercharges.value="";
		taxablevalue.value="";
	}
}
function courierreceived()
{
	
	var suprtype=document.getElementById("suprtype").value;
	var couriershow1=document.getElementById("couriershow1");
	var couriershow2=document.getElementById("couriershow2");
	if(suprtype=="Courier")
	{ 

		couriershow1.style.display="block";
		couriershow2.style.display="block";
	}
	else
	{
		couriershow1.style.display="none";
		couriershow2.style.display="none";
		suprcourierpaytype.value="";
		suprcouriercharges.value="";
		
	}
}
</script>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<script>
var coll1 = document.getElementsByClassName("collapsible1");
var i;

for (i = 0; i < coll1.length; i++) {
  coll1[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
</body>
</html>
