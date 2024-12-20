<?php
include('lcheck.php'); 
$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
if(($engineerperformance=='0'))
{
	header("location: dashboard.php");
}


if(isset($_GET['date']))
{
$date=mysqli_real_escape_string($connection,$_GET['date']);
$end=mysqli_real_escape_string($connection,$_GET['end']);
$date1=mysqli_real_escape_string($connection,$_GET['date']);
$end1=mysqli_real_escape_string($connection,$_GET['end']);
$id=mysqli_real_escape_string($connection,$_GET['id']);
}
else if(isset($_GET['reportrange']))
{
	 $reportrange=mysqli_real_escape_string($connection, $_GET['reportrange']);

				$reportrange = explode(' - ', $reportrange);
				$from = $reportrange[0];
				$to   = $reportrange[1];
				
				$from = explode('/', $from);
				$month   =$from[0];
				$date   =$from[1];
				$year = $from[2];
				$dashfromdate =$from[2]."-".$from[0]."-".$from[1];
				
				$to = explode('/', $to);
				$month1   = $to[0];
				$date1   = $to[1];
				$year1 = $to[2];
				$dashtodate =$to[2]."-".$to[0]."-".$to[1];
				
$date=mysqli_real_escape_string($connection,$dashfromdate);
$end=mysqli_real_escape_string($connection,$dashtodate);
$date1=mysqli_real_escape_string($connection,$dashfromdate);
$end1=mysqli_real_escape_string($connection,$dashtodate);
$id=mysqli_real_escape_string($connection,$_GET['id']);
}
else
{
$date = date("Y-m-d", strtotime("Monday this week"));
for ($i=0; $i<7;$i++){
    $end=date("Y-m-d", strtotime($date . " + $i day"));
}
$date1=$date;
$end1=$end;
$id=mysqli_real_escape_string($connection,$_GET['id']);
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

  <title>Engineer - Jerobyte - Service Engineer Details - <?=date('d/m/Y',strtotime($date))?> to <?=date('d/m/Y',strtotime($end))?></title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('engineernavbar.php');?>
        

        
        <div class="container-fluid">

		  
		
          
		  
		  
		    <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Service Engineer Details</b></h1>
  </div>
<div class="col-auto" style="padding-top:10px; text-align: right;">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
        <div class="input-group">
            <input type="text" id="reportrange" name="reportrange" class="form-control"/>
            <div class="input-group-append">
                <button class="btn btn-navb" type="submit" name="submit">
                    <i class="fa-solid fa-calendar-days fa-sm" style="color: #3d8eb9;"></i>
                </button>
                <button class="btn btn-navb" type="submit">
                    <a href="mapengineerda1.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
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
}
?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Service Engineer Details</h6>
            </div>-->
			
         <div class="card-body">
		 <?php
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
		
		$sqlselect = "SELECT engineername, designation, engineergrade, compprefix, phone, mobile, email, address1, address2, area, district, pincode, contact, compno, targetpoint, sincentiveper, incentiveper, avatar From jrcengineer where enabled='0' and id='".$id."'";
				  
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
		 
		<div class="col-lg-10 mt-2">
		 <div class="row">
			<div class="col-lg-3 mt-2">
					<label><b>Engineer Name</b></label>
					<p><?=$rowselect['engineername']?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Designation</b></label>
					<p><?=$rowselect['designation']?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Engineer Grade</b></label>
					<p><?=$rowselect['engineergrade']?></p>
				</div>
	           <div class="col-lg-3 mt-2">
					<label><b>Service Report Prefix</b></label>
					<p><?=$rowselect['compprefix'];?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Phone/Mobile</b></label>
					<p><?=$rowselect['phone']."/".$rowselect['mobile']; ?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Alternate E-mail</b></label>
					<p><?=$rowselect['email'];?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Address</b></label>
					<p><?=$rowselect['address1'].",<br>".$rowselect['address2'].",<br>".$rowselect['area'].",<br>".$rowselect['district']."-".$rowselect['pincode']; ?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Contact</b></label>
					<p><?=$rowselect['contact'];?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Service Report No</b></label>
					<p><?=$rowselect['compno'];?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Target Point</b></label>
					<p><?=$rowselect['targetpoint'];?></p>
				</div>
				
				
				<div class="col-lg-3 mt-2">
					<label><b>Sales Incentive %</b></label>
					<p><?=$rowselect['sincentiveper'];?></p>
				</div>
				<div class="col-lg-3 mt-2">
					<label><b>Service Incentive %</b></label>
					<p><?=$rowselect['incentiveper'];?></p>
				</div>
				</div>
		
				
				</div>
				
				<div class="col-md-2 mt-2">
				
				 <img src="<?=$rowselect['avatar']?>" height="150" width="150" onClick="triggerClick()" id="profileDisplay">
				</div>
				</div>
				
	<?php
					$count++;
			}
		}
}
			?>
           <div class="row">
  	
				  <?php
				  $engineerarray=array();
				  $engineerpoints=array();
				  $engineercpoints=array();
				  $sqlselect = "SELECT id,engineername From jrcengineer where enabled='0' and designation='SERVICE ENGINEER' and id='".$id."'order by username asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
$totaltotalamount=0;
$totaltotalcalls=0;
$totaltotalscalls=0;
$totaltotalocalls=0;
$totaltotaldays=0;
$totaltotalpresent=0;
$totaltotalabsent=0;	
$totaltotalkmtravelled=0;	
$totaltotalavgkmtravelled=0;	
$totaltotalpoints=0;
$totaltotalcpoints=0;
$totaltotalexpenses=0; 
$totaltotalda=0; 
$totaltotalstatuscomplete=0;
$totaltotalstatusscomplete=0;
$totaltotalstatusocomplete=0;
$totaltotalstatuspending=0; 
$totaltotalstatusspending=0; 
$totaltotalstatusopending=0; 
$totaltotalstatusper=0; 


	while($rowselect = mysqli_fetch_array($queryselect)) 
			{
$totalcalls=0;
$totalscalls=0;
$totalocalls=0;
$totaldays=0;
$totalpresent=0;
$totalabsent=0;	
$totalkmtravelled=0;	
$totalpoints=0;
$totalcpoints=0;
$totalexpenses=0;
$totalstatuscomplete=0;
$totalstatusscomplete=0;
$totalstatusocomplete=0;
$totalstatuspending=0; 
$totalstatusspending=0; 
$totalstatusopending=0; 
$totalstatusper=0; 
$totalda=0; 
$date=$date1;
$end=$end1;

			?>
                    
					 
<?php
			while(strtotime($date) <= strtotime($end)) 
			{
			$totaldays++;	
		$sqlmap = "SELECT location1, location2, location3, location4, location5, location6, location7, lockm1, lockm2, lockm3, lockm4, lockm5, lockm6, lockm7, points1, points2, points3, points4, points5, points6, points7, calltype1, calltype2, calltype3, calltype4, calltype5, calltype6, calltype7, callstatus1, callstatus2, callstatus3, callstatus4, callstatus5, callstatus6, callstatus7, endkm, daamount, totexpense From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$date."%' order by attdate desc";
		$querymap = mysqli_query($connection, $sqlmap);
        $rowCountmap = mysqli_num_rows($querymap);
         
        if(!$querymap){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountmap > 0) 
		{
			$infomap=mysqli_fetch_array($querymap);
			$totalpresent++;
			$totalkms=0;
			$dakms=0;
			$cpoints=0;
			$statuscomplete=0;
			$statuspending=0;
			$statusscomplete=0;
			$statusspending=0;
			$statusocomplete=0;
			$statusopending=0;
			
			for($i=1;$i<=7;$i++)
			{
			if($infomap['location'.$i]!='')
			{
			$totalcalls++;	
			if($infomap['calltype'.$i]=="Service Call")
			{
			$totalscalls++;	
			}
			else
			{
			$totalocalls++;	
			}
			$totalkms=$totalkms+(float)$infomap['lockm'.$i];
			$dakms=$dakms+(float)$infomap['lockm'.$i];
			$cpoints+=(float)$infomap['points'.$i];
			if($infomap['callstatus'.$i]=="Completed")
			{
				$statuscomplete++;
				if($infomap['calltype'.$i]=="Service Call")
				{
				$statusscomplete++;	
				}
				else
				{
				$statusocomplete++;	
				}
			}
			if($infomap['callstatus'.$i]=="Pending")
			{
				$statuspending++;
				if($infomap['calltype'.$i]=="Service Call")
				{
				$statusspending++;	
				}
				else
				{
				$statusopending++;	
				}
			}
			
			}
			else
			{
			}
			}
			$totalkms=$totalkms+(float)$infomap['endkm'];
			$points=0;
			if($totalkms<75)
			{
				$points=0;
			}
			else if(($totalkms>74)&&($totalkms<201))
			{
				$points=5;
			}
			else if(($totalkms>200)&&($totalkms<301))
			{
				$points=10;
			}
			else if(($totalkms>300)&&($totalkms<401))
			{
				$points=15;
			}
			else
			{
				$points=20;
			}
			$da=0;
if($dakms<75)
{
	$da=0;
}
else if(($dakms>74)&&($dakms<121))
{
	$da=50;
}
else
{
	$da=120;
}
if(($infomap['daamount']!='')&&($infomap['daamount']!='0'))
{
	$da=(float)$infomap['daamount'];
}

			$totalkmtravelled+=$totalkms;
			$totalda+=$da;
			$totalcpoints+=$cpoints;
			$totalstatuscomplete+=$statuscomplete;
			$totalstatusscomplete+=$statusscomplete;
			$totalstatusocomplete+=$statusocomplete;
			$totalstatuspending+=$statuspending;
			$totalstatusspending+=$statusspending;
			$totalstatusopending+=$statusopending;
$totalexpenses+=(float)$infomap['totexpense'];
$totalpoints+=$points;
		}
		else
		{
			$totalabsent++;
		}
			
					$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
			}
?>		

<?php
					  if($liveplan=="DIAMOND")
					  {
						  ?>

					 <?php 
					 
					 
					  }
					 ${'eng'.$rowselect['id'].'totaldays'}=$totaldays;
					 ${'eng'.$rowselect['id'].'totalpresent'}=$totalpresent;
					 ${'eng'.$rowselect['id'].'totalabsent'}=$totalabsent;
					 ${'eng'.$rowselect['id'].'totalcalls'}=$totalcalls;
					 ${'eng'.$rowselect['id'].'totalscalls'}=$totalscalls;
					 ${'eng'.$rowselect['id'].'totalocalls'}=$totalocalls;
					 ${'eng'.$rowselect['id'].'totalcpoints'}=$totalcpoints;
					 ${'eng'.$rowselect['id'].'totalstatuscomplete'}=$totalstatuscomplete;
					 ${'eng'.$rowselect['id'].'totalstatusscomplete'}=$totalstatusscomplete;
					 ${'eng'.$rowselect['id'].'totalstatusocomplete'}=$totalstatusocomplete;
					 ${'eng'.$rowselect['id'].'totalstatuspending'}=$totalstatuspending;
					 ${'eng'.$rowselect['id'].'totalstatusspending'}=$totalstatusspending;
					 ${'eng'.$rowselect['id'].'totalstatusopending'}=$totalstatusopending;
					 ${'eng'.$rowselect['id'].'totalstatusper'}=($totalcalls!=0)?round(($totalstatuscomplete/$totalcalls)*100,2):0;
					 ${'eng'.$rowselect['id'].'totalkmtravelled'}=$totalkmtravelled;
					 ${'eng'.$rowselect['id'].'totalavg'}=(($totalpresent!=0)?(round(($totalkmtravelled/$totalpresent),2)):'0');
					 ${'eng'.$rowselect['id'].'totalpoints'}=$totalpoints;
					 ${'eng'.$rowselect['id'].'totalda'}=$totalda;
					 ${'eng'.$rowselect['id'].'totalexpenses'}=$totalexpenses;
					 ${'eng'.$rowselect['id'].'totaldaexpenses'}=(float)$totalda+(float)$totalexpenses;
					  ?>
                 
					<?php
					$count++;
				$engineerarray[]=$rowselect['engineername'];
				$engineerpoints[]=$totalpoints;
				$engineercpoints[]=$totalcpoints;
				
$totaltotaldays+=$totaldays;
$totaltotalpresent+=$totalpresent;
$totaltotalabsent+=$totalabsent;
$totaltotalcalls+=$totalcalls;
$totaltotalscalls+=$totalscalls;
$totaltotalocalls+=$totalocalls;
$totaltotalstatuscomplete+=$totalstatuscomplete;
$totaltotalstatusscomplete+=$totalstatusscomplete;
$totaltotalstatusocomplete+=$totalstatusocomplete;
$totaltotalstatuspending+=$totalstatuspending;
$totaltotalstatusspending+=$totalstatusspending;
$totaltotalstatusopending+=$totalstatusopending;
$totaltotalcpoints+=$totalcpoints;
$totaltotalkmtravelled+=$totalkmtravelled;
$totaltotalavgkmtravelled+=(($totalpresent!=0)?(round(($totalkmtravelled/$totalpresent),2)):0);
$totaltotalpoints+=$totalpoints;
$totaltotalda+=$totalda;
$totaltotalexpenses+=$totalexpenses;				
$totaltotalamount+=((float)$totalda+(float)$totalexpenses);
			}
		}
			?>
					
                  
              </div>
				
</div>			
</div>			
			<div class="card shadow mb-4">
          
		
			<div class="card shadow mb-4">
           <div class="card-body">
<?php
		
	  $sqlengselect = "SELECT id, engineername From jrcengineer where enabled='0' and designation='SERVICE ENGINEER' and id='".$id."' order by username asc";
	   $queryengselect = mysqli_query($connection, $sqlengselect);
        $rowCountengselect = mysqli_num_rows($queryengselect);
         
        if(!$queryengselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountengselect > 0) 
		{
			$count=1;
	
	while($rowengselect = mysqli_fetch_array($queryengselect)) 
			{
$date=$date1;
$end=$end1;	  
				?>
				
				 <h5 class="text-primary text-weight-bold" id="eng<?=$rowengselect['id']?>">Report for <?=$rowengselect['engineername']?> (<?=date('d/m/Y',strtotime($date))?> to <?=date('d/m/Y',strtotime($end))?>)</h5>
			<br>
				<div class="row">
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Total Days</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totaldays'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Present</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalpresent'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Absent</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalabsent'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Calls Attended</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalcalls'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Pending Calls</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalstatuspending'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Completed Calls</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalstatuscomplete'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-success text-center text-white p-2">
				<h6>Completion %</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalstatusper'};?></h4>
				</div>
				</div> <?php
					  if($liveplan=='DIAMOND')
					  {
						  ?>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Call Points</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalcpoints'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Total Kms</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalkmtravelled'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Avg Kms</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalavg'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Travel Points</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalpoints'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Total DA</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalda'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Total TA</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totalexpenses'};?></h4>
				</div>
				</div>
				<div class="col-lg-2 mb-2">
				<div class="card bg-primary text-center text-white p-2">
				<h6>Total TA + DA</h6>
				<h4><?=${'eng'.$rowengselect['id'].'totaldaexpenses'};?></h4>
				</div>
				</div>
				<?php
					  }

					  ?>
			</div>
			<br>
              <div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th colspan="5"></th>
					  <th id="totalkms<?=$rowengselect['id']?>" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Total Kms</th>
					  <th id="totalpoints<?=$rowengselect['id']?>" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Travel Points</th>
					  <th id="totalcpoints<?=$rowengselect['id']?>" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>Service Points</th>
					  <th id="totalda<?=$rowengselect['id']?>" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>DA</th>
					  <th id="totalexpenses<?=$rowengselect['id']?>" <?=($liveplan=="DIAMOND")?'':'style="display:none"';?>>TA</th>
					  <th colspan="9"></th>					  
                    </tr>
					<tr>
                      <th>S.No</th>
                      <th>Date</th>
					  <th>View</th>
					  <th>Attendance</th>
					  <?php
					  if($liveplan=="DIAMOND")
					  {
						  ?>
					  <th>Ticket Verify</th>
					  <th>Total Kms</th>
					  <th>Travel Points</th>
					  <th>Service Points</th>
					  <th>DA</th>
					  <th>TA</th>
					  <?php
					  }
					  ?>
					  <th>Start</th>
                      <th>Location 1</th>
					  <th>Location 2</th>
					  <th>Location 3</th>
					  <th>Location 4</th>
					  <th>Location 5</th>
					  <th>Location 6</th>
					  <th>Location 7</th>
					  <th>End</th>
					  
                    </tr>
                  </thead>
                  <tbody>
	<?php
	$startdate=date('Y-m-01', strtotime($date1));	
	$enddate=date('Y-m-t', strtotime($end1));
	$sqlselect = "SELECT id From jrcengineer where enabled='0' and id='".mysqli_real_escape_string($connection,$rowengselect['id'])."' order by username asc";
				  
    $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
if($rowCountselect > 0) 
{
$totalkmtravelled=0;
$totalexpenses=0; $totalda=0;
$totalpoints=0;
$totalcpoints=0;
$totalda=0;
$count=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			$date=$date1;	
			$end=$end1;
			while(strtotime($date) <= strtotime($end)) 
			{
				$output='';
			?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?=date('d/m/Y',strtotime($date))?></td>
					  
					  <td>
					  <a target="_blank" href="mapengineerview.php?id=<?=$rowselect['id']?>&attdate=<?=$date?>">View</a>
					  </td>
		<?php
		$sqlmap = "SELECT ticketapprove, starttime, location1, location2, location3, location4, location5, location6, location7, detailsid1, detailsid2, detailsid3, detailsid4, detailsid5, detailsid6, detailsid7, loccall1, loccall2, loccall3, loccall4, loccall5, loccall6, loccall7, loctime1, loctime2, loctime3, loctime4, loctime5, loctime6, loctime7, callstatus1, callstatus2, callstatus3, callstatus4, callstatus5, callstatus6, callstatus7, points1, points2, points3, points4, points5, points6, points7, worktime1, worktime2, worktime3, worktime4, worktime5, worktime6, worktime7, lockm1, lockm2, lockm3, lockm4, lockm5, lockm6, lockm7, endtime, endkm, daamount, totexpense From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$date."%' order by attdate desc";
		$querymap = mysqli_query($connection, $sqlmap);
        $rowCountmap = mysqli_num_rows($querymap);
         
        if(!$querymap){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountmap > 0) 
		{
			$infomap=mysqli_fetch_array($querymap);
			?>
			<td class="text-success">Present</td>
			<?php
					  if($liveplan=="DIAMOND")
					  {
						  ?>
			<?php
			if($infomap['ticketapprove']!='0')
			{
				?>
				<td><a href="mapengineerview.php?id=<?=$rowselect['id']?>&attdate=<?=$date?>" target="_blank"  class="text-success">Verified</a></td>
				<?php
			}
			else
			{
				?>
				<td><a href="mapengineerview.php?id=<?=$rowselect['id']?>&attdate=<?=$date?>" target="_blank"  class="text-danger">Pending</a></td>
				<?php
			}	
					  }
			$output.='<td>'.(($infomap['starttime']!='')?date('d/m/Y h:i:s a',strtotime($infomap['starttime'])):'').'</td>';
			$totalkms=0;
			$dakms=0;
			$cpoints=0;
			for($i=1;$i<=7;$i++)
			{
			if($infomap['location'.$i]!='')
			{
			$details='';
			if($infomap['detailsid'.$i]!='')
			{
				$sqlcon4 = "SELECT worktype, stockitem, callstatus From jrccalldetails WHERE id = '".$infomap['detailsid'.$i]."'";
				$querycon4 = mysqli_query($connection, $sqlcon4);
				$rowcon4=mysqli_num_rows($querycon4);
				$infocon4=mysqli_fetch_array($querycon4);
				$details='<b>Product:</b> <br>'.$infocon4['stockitem'].'<br><br><b>Work Type:</b> <br>'.$infocon4['worktype'].'<br><br><b>Call Status:</b> <br>'.$infocon4['callstatus'].'';
			}
		/* 	$output.='<td><a href="callsedit.php?calltid='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a><br>'.(date('d/m/Y h:i:sa',strtotime($infomap['loctime'.$i]))).' <br>'.$infomap['lockm'.$i].' Kms <br>'.(($infomap['callstatus'.$i]=="Completed")?'<span class="text-success">Completed</span>':(($infomap['callstatus'.$i]=="Pending")?'<span class="text-danger">Pending</span>':(($infomap['callstatus'.$i]=="Open")?'<span class="text-warning">Open</span>':$infomap['callstatus'.$i]))).'<br><div class="tooltip1"><b>'.$infomap['points'.$i].' Points</b><span class="tooltiptext1">'.$details.'</span></div><br>'.$infomap['worktime'.$i].' Duration</td>'; */
		if (($infolayoutservice['reportformat']=='1')) {
	if(($infomap['callstatus'.$i] == "Completed") || ($infomap['callstatus'.$i] == "Pending") )
	{
    $output .= '<td><a href="complaintprint.php?id='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
	else
	{
		$output .= '<td><a href="callsedit.php?id='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
} 
else
	{
 if(($infomap['callstatus'.$i] == "Completed") || ($infomap['callstatus'.$i] == "Pending") )
	{
    $output .= '<td><a href="complaintprint1.php?id='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
	else
	{
		$output .= '<td><a href="callsedit.php?id='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
}
$output.='<br>'.(date('d/m/Y h:i:sa',strtotime($infomap['loctime'.$i]))).' <br>'.$infomap['lockm'.$i].' Kms <br>'.(($infomap['callstatus'.$i]=="Completed")?'<span class="text-success">Completed</span>':(($infomap['callstatus'.$i]=="Pending")?'<span class="text-danger">Pending</span>':(($infomap['callstatus'.$i]=="")?'<span class="text-warning">Open</span>':$infomap['callstatus'.$i]))).'<br><div class="tooltip1"><b>'.$infomap['points'.$i].' Points</b><span class="tooltiptext1">'.$details.'</span></div><br>'.$infomap['worktime'.$i].' Duration</td>';
			$totalkms=$totalkms+(float)$infomap['lockm'.$i];
			$dakms=$dakms+(float)$infomap['lockm'.$i];
			$cpoints+=$infomap['points'.$i];
			}
			else
			{
			$output.='<td></td>';
			}
			}
			$output.='<td>'.(($infomap['endtime']!='')?date('d/m/Y h:i:s a',strtotime($infomap['endtime'])):'').'</td>';
			$totalkms=$totalkms+(float)$infomap['endkm'];
			?>
			<?php
					  if($liveplan=="DIAMOND")
					  {
						  ?>
			<td><?=$totalkms?></td>
			<?php
					  }
					  ?>
			<?php
			$points=0;
			if($totalkms<75)
			{
				$points=0;
			}
			else if(($totalkms>74)&&($totalkms<201))
			{
				$points=5;
			}
			else if(($totalkms>200)&&($totalkms<301))
			{
				$points=10;
			}
			else if(($totalkms>300)&&($totalkms<401))
			{
				$points=15;
			}
			else
			{
				$points=20;
			}
			$da=0;
if($dakms<75)
{
	$da=0;
}
else if(($dakms>74)&&($dakms<121))
{
	$da=50;
}
else
{
	$da=120;
}
if(($infomap['daamount']!='')&&($infomap['daamount']!='0'))
{
	$da=(float)$infomap['daamount'];
}
			?>
			<?php
					  if($liveplan=="DIAMOND")
					  {
						  ?>
			<td><?=$points?></td>
			<td><?=$cpoints?></td>
			<td><?=$da?></td>
			<td><?=$infomap['totexpense']?></td>
			<?php
					  }
					  ?>
			<?php
			echo $output;
			$totalkmtravelled+=$totalkms;
			$totalda+=$da;
$totalexpenses+=(float)$infomap['totexpense'];
$totalpoints+=$points;
$totalcpoints+=$cpoints;
		}
		else
		{
			?>
			<td class="text-danger">Absent</td>
			<?php
			if($liveplan=="DIAMOND")
			{
				$k=15;
			}
			else
			{
				$k=9;
			}
			
			for($i=1;$i<=$k;$i++)
			{
				?>
			<td></td>
			<?php
			}
			?>
			<?php
		}
		?>
                    </tr>
					<?php
					$count++;
					$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
			}
			}
			?>
			<?php
		}
			?>
					
                  </tbody>
                </table>
              </div>
				
				<script>
document.getElementById("totalkms<?=$rowengselect['id']?>").innerHTML=" <?=$totalkmtravelled?>";
document.getElementById("totalpoints<?=$rowengselect['id']?>").innerHTML=" <?=$totalpoints?>";
document.getElementById("totalcpoints<?=$rowengselect['id']?>").innerHTML=" <?=$totalcpoints?>";
document.getElementById("totalda<?=$rowengselect['id']?>").innerHTML=" <?=$totalda?>";
document.getElementById("totalexpenses<?=$rowengselect['id']?>").innerHTML=" <?=$totalexpenses?>";
</script>
				<?php
				
			}
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

  <!-- Page level custom scripts -->
  
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
</script>
<script type="text/javascript">
  $(document).ready(function() {
$(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "paging": false,
                "processing": true,
                dom: 'Blfrtip',
				<?php
				if($engineerta=='1')
				{
				?>	
				buttons: [
			   {
				   extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
				   title: "Engineer's TA Report from <?=date('d/m/Y',strtotime($date1))?> to <?=date('d/m/Y',strtotime($end1))?>",
				   orientation: 'landscape',
				   footer: true,
				   exportOptions: {
					   <?php
					  if($liveplan=="DIAMOND")
					  {
						  ?>
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]
						<?php
					  }
					  else
					  {
						  ?>
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
						<?php
					  }
					  ?>
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   title: "Engineer's TA Report from <?=date('d/m/Y',strtotime($date1))?> to <?=date('d/m/Y',strtotime($end1))?>",
				   footer: true,
				   exportOptions: {
						<?php
					  if($liveplan=="DIAMOND")
					  {
						  ?>
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]
						<?php
					  }
					  else
					  {
						  ?>
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
						<?php
					  }
					  ?>
					}
			   }     
			
			]  
			<?php
				}
?>	
            });
			var table = $('#dataTable1').DataTable({
                "paging": false,
                "processing": true,
                dom: 'Blfrtip',
				<?php
				if($engineerta=='1')
				{
				?>
				buttons: [
			   {
				   extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
				   orientation: 'landscape',
				   footer: true,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: true,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7]
					}
			   }     
			
			]  
			<?php
				}
?>	
            });

        });
  
  });
</script>
<script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>

<script>
var xValues = [<?php foreach ($engineerarray as $sd){ echo "'".$sd."',";}?>];
var yValues = [<?php foreach ($engineercpoints as $sa){ echo $sa.',';}?>];
var barColors = [<?php foreach ($engineercpoints as $sa){ echo "'#FEC368',";}?>];
			 
			var myData = {
				labels: xValues,
				datasets: [{
					fill: false,
					backgroundColor: barColors,
					data: yValues,
				}]
			};
			 
			var myoption = {
				legend: {display: false},
				title: {
				  display: true,
				  text: "Call Points"
				},
				tooltips: {
					enabled: true
				},
				hover: {
					animationDuration: 1
				},
				animation: {
				duration: 1,
				onComplete: function () {
					var chartInstance = this.chart,
						ctx = chartInstance.ctx;
						ctx.textAlign = 'center';
						ctx.fillStyle = "rgba(0, 0, 0, 1)";
						ctx.textBaseline = 'bottom';
						this.data.datasets.forEach(function (dataset, i) {
							var meta = chartInstance.controller.getDatasetMeta(i);
							meta.data.forEach(function (bar, index) {
								var data = dataset.data[index];
								ctx.fillText(data, bar._model.x, bar._model.y - 5);
							});
						});
					}
				}
			};
			 
			var ctx = document.getElementById('myChart1').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',    	 
				data: myData,    	 
				options: myoption 	 
			});
</script>
<script>
var xValues = [<?php foreach ($engineerarray as $sd){ echo "'".$sd."',";}?>];
var yValues = [<?php foreach ($engineerpoints as $sa){ echo $sa.',';}?>];
var barColors = [<?php foreach ($engineerpoints as $sa){ echo "'#04DCCB',";}?>];
			 
			var myData = {
				labels: xValues,
				datasets: [{
					fill: false,
					backgroundColor: barColors,
					data: yValues,
				}]
			};
			 
			var myoption = {
				legend: {display: false},
				title: {
				  display: true,
				  text: "Travel Points"
				},
				tooltips: {
					enabled: true
				},
				hover: {
					animationDuration: 1
				},
				animation: {
				duration: 1,
				onComplete: function () {
					var chartInstance = this.chart,
						ctx = chartInstance.ctx;
						ctx.textAlign = 'center';
						ctx.fillStyle = "rgba(0, 0, 0, 1)";
						ctx.textBaseline = 'bottom';
						this.data.datasets.forEach(function (dataset, i) {
							var meta = chartInstance.controller.getDatasetMeta(i);
							meta.data.forEach(function (bar, index) {
								var data = dataset.data[index];
								ctx.fillText(data, bar._model.x, bar._model.y - 5);
							});
						});
					}
				}
			};
			 
			var ctx = document.getElementById('myChart2').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',    	 
				data: myData,    	 
				options: myoption 	 
			});
</script>
<script>
var ctx = document.getElementById("myChart4").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: [<?php foreach ($engineerarray as $sd){ echo "'".$sd."',";}?>],
		datasets: [{
			label: 'Call Points',
			backgroundColor: "#4287f5",
			data: [<?php foreach ($engineercpoints as $sa){ echo $sa.',';}?>],
		}, {
			label: 'Travel Points',
			backgroundColor: "#45c490",
			data: [<?php foreach ($engineerpoints as $sa){ echo $sa.',';}?>],
		}],
	},
options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          labels: {
            render: 'value',
          }
        },
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
      }
});
</script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
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
	if((isset($date))&&($date!=''))
	{
		?>
		$('#reportrange').data('daterangepicker').setStartDate('<?=date('m/d/Y',strtotime($date1))?>');
		$('#reportrange').data('daterangepicker').setEndDate('<?=date('m/d/Y',strtotime($end1))?>');
		<?php
	}
	?>
});
</script>
<!------------daterangepicker--->
<?php include('additionaljs.php');   ?>
</body>

</html>
