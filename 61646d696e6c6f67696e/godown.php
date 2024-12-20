<?php
include('lcheck.php'); 

if($callview=='0')
{
	header("location: dashboard.php");
}
if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Carry-In Calls</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('inhousenavbar.php');?>
		  
		  
        

        
        <div class="container-fluid">
<?php
$statitle="";
$staqu=" where ((servicetype='Carry-In'))";
if(isset($_GET['status']))
{
	if($_GET['status']=='2')
	{
		$statitle="Completed";

		if($staqu!="")
		{
			$staqu.=" and compstatus='2'";
		}
		else
		{
			$staqu.=" where compstatus='2'";
		}	
	}
	else if($_GET['status']=='3')
	{
		$statitle="Cancelled";

		if($staqu!="")
		{
			$staqu.=" and compstatus='3'";
		}
		else
		{
			$staqu.=" where compstatus='2'";
		}	
	}
	else if($_GET['status']=='1')
	{
		$statitle="Pending";
		if($staqu!="")
		{
			$staqu.=" and compstatus='1'";
		}
		else
		{
			$staqu.=" where compstatus='1'";
		}
	}
	else
	{
		$statitle="Open";
		if($staqu!="")
		{
			$staqu.=" and compstatus='0'";
		}
		else
		{
			$staqu.=" where compstatus='0'";
		}
	}
}
?>
          <!-- Page Heading -->
<?php
if(isset($_GET['prob']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['prob']);
	if($staqu!="")
	{
		$staqu.=" and reportedproblem='".$prob."'";
	}
	else
	{
		$staqu.=" where reportedproblem='".$prob."'";
	}	
}
if(isset($_GET['action']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['action']);
	if($staqu!="")
	{
		$staqu.=" and actiontaken='".$prob."'";
	}
	else
	{
		$staqu.=" where actiontaken='".$prob."'";
	}	
}
if(isset($_GET['ctype']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['ctype']);
	if($staqu!="")
	{
		$staqu.=" and calltype='".$prob."'";
	}
	else
	{
		$staqu.=" where calltype='".$prob."'";
	}	
}
if(isset($_GET['nature']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['nature']);
	if($staqu!="")
	{
		$staqu.=" and callnature='".$prob."'";
	}
	else
	{
		$staqu.=" where callnature='".$prob."'";
	}	
}
?>
  
  
  <?php
          $godownname='';
          $suppliername='';
		  if(isset($_POST['submit']))
			  
		  {
			  $reportrange=mysqli_real_escape_string($connection,$_POST['reportrange']);

				$reportrange = explode(' - ', $reportrange);
				$from = $reportrange[0];
				$to   = $reportrange[1];
				
				$from = explode('/', $from);
				$month   =$from[0];
				$date   =$from[1];
				$year = $from[2];
				$fromdate =$from[2]."-".$from[0]."-".$from[1];
				
				$to = explode('/', $to);
				$month1   = $to[0];
				$date1   = $to[1];
				$year1 = $to[2];
				$todate =$to[2]."-".$to[0]."-".$to[1];
				
			   
			  $godownname=mysqli_real_escape_string($connection,$_POST['godownname']);								  
			  $suppliername=mysqli_real_escape_string($connection,$_POST['suppliername']);								  
			  $dashfromdate=mysqli_real_escape_string($connection,$fromdate);
			  $dashtodate=mysqli_real_escape_string($connection,$todate);
			  $dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  if(($_POST['godownname']!='')  )
			  {
			 
			  
				if($staqu!="")
				{
					$staqu.=' and godownname="'.$godownname.'"  and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				else
				{
					$staqu.=' where godownname="'.$godownname.'" and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}  
			  
				  
			  }
			   if(($_POST['suppliername']!='')  )
			  {
			 
			  
				if($staqu!="")
				{
					$staqu.=' and suppliername="'.$suppliername.'"  and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				else
				{
					$staqu.=' where suppliername="'.$suppliername.'" and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}  
			  
				  
			  }
			
			  else
			  {
				 if($staqu!="")
				{
					$staqu.=' and  callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				else
				{
					$staqu.=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				} 
			  }
			  
			  
				
		   }
		  else
		  {
			  $dashfromdate='';
			  $dashtodate='';
			  $dashcallonsearch='';
			  $dashschargesearch='';
			  if(isset($_GET['godownname']))
			  {
				 $godownname=mysqli_real_escape_string($connection,$_GET['godownname']);
			  $staqu='where godownname="'.$_GET['godownname'].'" and compstatus!=2';
			  }
			  if(isset($_GET['suppliername']))
			  {
				 $suppliername=mysqli_real_escape_string($connection,$_GET['suppliername']);
			  $staqu='where suppliername="'.$_GET['suppliername'].'" and compstatus!=2';
			  }
		  }
		  
		  ?>
          
  
  
  
  
 <div class="row">
    <div class="col">
        <h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:250px;"><b>Godown Details</b></h1>
    </div>
    <div class="col-auto" style="padding-top:10px;">
        <div class="row justify-content-end">
               <div class="col-sm-3 mb-1">
							
								<select class="form-control" id="godownname" name="godownname">
<option value="">Select Godown</option>
<?php
$sqlgo = "SELECT id, godownname From jrcgodown order by godownname asc";
        $querygo = mysqli_query($connection, $sqlgo);
        $rowCountgo = mysqli_num_rows($querygo);
        if(!$querygo){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountgo > 0) 
		{
			$count=1;
			while($rowgo = mysqli_fetch_array($querygo)) 
			{
				?>
<option value="<?=$rowgo['id']?>"<?php if($rowgo['id']==$godownname) { echo "selected"; } ?>><?=$rowgo['godownname']?></option>
<?php
			}
		}
		?>
</select>
                                </div>
							
								
								<div class="col-sm-3 mb-1">
								<select class="form-control" id="suppliername" name="suppliername">
<option value="">Select supplier</option>
<?php
$sqlsup = "SELECT id, suppliername From jrcsuppliers order by suppliername asc";
        $querysup = mysqli_query($connection, $sqlsup);
        $rowCountsup = mysqli_num_rows($querysup);
        if(!$querysup){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountsup > 0) 
		{
			$count=1;
			while($rowsup = mysqli_fetch_array($querysup)) 
			{
				?>
<option value="<?=$rowsup['id']?>"<?php if($rowsup['id']==$suppliername) { echo "selected"; } ?>><?=$rowsup['suppliername']?></option>
<?php
			}
		}
		?>
</select>
                                </div>
							
            </div>
    </div>
    <div class="col-auto" style="padding-top:10px;">
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
            <div class="input-group">
                <input type="text" id="reportrange" name="reportrange" class="form-control"/>
                <div class="input-group-append">
                    <button class="btn btn-navb" type="submit" name="submit">
                        <i class="fa-solid fa-calendar-days fa-sm" style="color: #3d8eb9;"></i>
                    </button>
                    <button class="btn btn-navb d-inline-block" type="submit">
                        <a href="godown.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
                    </button>
                </div>
            </div>
        </form>
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
}?>
<div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">In-House Calls <?=$statitle?></h6>
            </div>-->
            <div class="card-body">
			 <div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
			  <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  <th>Warehouse</th>
					  <th>Supplier Name</th>
					  <th>Call ID and Date</th>
                      <th>Call Details</th>
					  <th>Received Type</th>
					  <th>Type Details</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Diagnosis Details</th>
					  <th>Problem Details</th>
					  <th>OEM Sent Details</th>
					  <th>Estimate Cost </th>
					  <th>Customer Confirmation</th>
					  <th>OEM Received Details</th>
					  <th>Warehouse Product Repair Status</th>
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
	    $sqlselect = "SELECT godownname, sourceid, callon, acknowlodge, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineertype, engineersid, engineersname, reportingengineerid, engineerid, engineername, id, servicetype, customernature, callnature, serial, diagnosisby, diagnosisengineername, diagnosiscoordinatorname, diagnosisremarks, diagnosismaterial, calltid, reportedproblem, problemobserved, actiontaken, narration, businesstype, detailsid, otherremarks, suppliername, dcno, dcdate, supwarrantytype, supcomplaintno, supcomplaintremarks, supapprovalstatus, supestimatedcost, supestdelivery, supcompstatus, compstatus, supcustomerremarks ,changeon,diagnosissignmode,supoemestimatedcost,supoemestdelivery,supcourierdate,supcourierpaytype ,supoemestimatedcost ,supoemestdelivery,supcouriercharges ,supoemremarks ,suprcourierdetails ,readycompstatus ,readydate,readyremarks  From jrccalls ".$staqu." order by id desc";
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
				$sqlxl2 = "SELECT id, godownname From jrcgodown where id='".$rowselect['godownname']."'";
				$queryxl2 = mysqli_query($connection, $sqlxl2);
				$rowCountxl2 = mysqli_num_rows($queryxl2);
				$rowxl2 = mysqli_fetch_array($queryxl2);
				 
				$sqlsup= "SELECT id, suppliername From jrcsuppliers where id='".$rowselect['suppliername']."'";
				$querysup = mysqli_query($connection, $sqlsup);
				$rowCountsup = mysqli_num_rows($querysup);
				$rowsup = mysqli_fetch_array($querysup);
				
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
					  <td><?php if($rowCountxl2>0){ echo $rowxl2['godownname']; }?></td>
					  <td><?php if($rowCountsup>0){ echo $rowsup['suppliername']; }?></td>
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
					  <br>
					  <?php
					  if($rowselect['compstatus']!='2')
					  {
					if($rowselect['compstatus']!='3')
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
					  <?=$rowselect['diagnosissignmode']?>
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
						 <a href="acknowledgeprint1.php?id=<?=$rowselect['calltid']?>" target="_blank" class="text-success">Print Acknowledgement</a>
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
               
					<b>Complaint No:</b> <span class="text-primary"><?=$rowselect['supcomplaintno']?></span><br>
					
			  <a href="deliverynoteprint.php?id=<?=$rowselect['dcno']?>" class="text-info" target="_blank">Print Delivery Note</a><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=DC" class="text-success">View or Update Details</a>
			  <?php
			  }
              else if($rowselect['compstatus']!='2')
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
			 else if($rowselect['compstatus']!='2')
			 {
				?>
				   <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Estimate" class="text-danger">Estimate Cost</a>
<?php				
			 }
			 
?>									  
					</td>
					<td>

		  <?php 
              
				  if($rowselect['supapprovalstatus']!="")
				  {
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
				  }
				  else{
					  $status="";
				  }
				  if($rowselect['supestimatedcost']!='' ||  $rowselect['supestdelivery']!='' || $rowselect['supcustomerremarks']!='')
				 {
               ?>
                <b>Cost:</b> <span class="text-primary"><?=$rowselect['supestimatedcost']?></span><br>
				<b>Delivery:</b> <span class="text-primary"><?php if($rowselect['supestdelivery']) { echo date('d/m/Y',strtotime($rowselect['supestdelivery'])); } else { echo ''; } ?></span><br>
				<b>Approval Status:</b> <span class="text-primary"><?=$status?></span><br>
				 <b>Remarks:</b> <span class="text-primary"><?=$rowselect['supcustomerremarks']?></span><br>
                 <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Confirmation" class="text-success">View or Update Details</a>
                		<?php
				 }
else if($rowselect['compstatus']!='2')
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
				<b>Remarks:</b> <span class="text-primary"><?=$rowselect['suprcourierdetails']?></span><br>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Received" class="text-success">View or Update Details</a>
              <?php
				 }
				 else if($rowselect['compstatus']!='2')
				 {
					 ?>
					   <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Received" class="text-danger">Received From OEM</a>
					   <?php
				 }
				 ?>
              					  
					</td>
 <td>
         <?php
		 if($rowselect['readycompstatus']!='')
				 {	
		 ?>
                <b>Complaint Status:</b> <span class="text-primary"><?=$rowselect['readycompstatus']?></span><br>
                <b>Remarks:</b> <span class="text-primary"><?=$rowselect['readyremarks']?></span><br>
				<?php if($rowselect['compstatus']!='2'){
					?>
                <a href="readyproduct.php?id=<?=$rowselect['id']?>&active=Received" class="text-success">View or Update Details</a>
				<?php
				}
				 }
				 else
				 { if($rowselect['compstatus']!='2'){
					 ?>
					   <a href="readyproduct.php?id=<?=$rowselect['id']?>&active=Received" class="text-danger">Product Repair Detail</a>
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
						<span class="text-success">Completed </span><br>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span><br>on <?=date('d/m/Y', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='3')
					  {
						?>
						<span class="text-info">Cancelled </span><br>on <?=date('d/m/Y', strtotime($rowselect['changeon']))?>
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
       

       
      <?php include('footer.php'); ?>
       

    </div>
     

  </div>
   

   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<!--Modal starts Here-->
<div class="modal fade" id="dynamicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carry-In Calls</h5>
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
<!------------daterangepicker--->
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/moment.min.js"></script>
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(6, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'Last 365 Days': [moment().subtract(364, 'days'), moment()],
			'This Week': [moment().startOf('week'), moment().endOf('week')],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'This Year': [moment().startOf('year'), moment().endOf('year')],
			'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')], 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        }
    }, cb);

    cb(start, end);
	<?php
	if((isset($dashfromdate))&&($dashfromdate!=''))
	{
		?>
		$('#reportrange').data('daterangepicker').setStartDate('<?=date('m/d/Y',strtotime($dashfromdate))?>');
		$('#reportrange').data('daterangepicker').setEndDate('<?=date('m/d/Y',strtotime($dashtodate))?>');
		<?php
	}
	?>
});
</script>
<!------------daterangepicker--->


<?php include('additionaljs.php');   ?>
</body>

</html>
