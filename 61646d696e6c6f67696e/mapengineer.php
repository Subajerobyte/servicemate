<?php
include('lcheck.php'); 
$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
if(($livelocation=='0'))
{
	header("location: dashboard.php");
}
if(isset($_GET['attdate']))
{
$attdate=$_GET['attdate'];
}
else
{
$attdate=date('Y-m-d');
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Service Engineer Details - <?=$attdate?></title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById("map_div"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 7,
        });
    }
</script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=initMap&libraries=visualization&v=3.49"></script>
  
    <script type="text/javascript">
    google.charts.load("current", {
        packages: ["map"],
        mapsApiKey: "AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg"
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Lat', 'Long', 'Name'],
            <?php
            $sqlselect = "SELECT id, latlong, engineername,username From jrcengineer where enabled='0' order by engineername asc";
            $queryselect = mysqli_query($connection, $sqlselect);
            while ($rowselect = mysqli_fetch_array($queryselect)) {
                $sqlselect2 = "SELECT lati, longi FROM jrclive WHERE user = '{$rowselect['username']}' AND ldate LIKE '{$attdate}%' ORDER BY id DESC LIMIT 1";
                $queryselect2 = mysqli_query($connection, $sqlselect2);
                if ($rowselect2 = mysqli_fetch_array($queryselect2)) {
                    echo "[{$rowselect2['lati']}, {$rowselect2['longi']}, '<a href=\"mapengineerview.php?id={$rowselect['id']}&attdate=" . (isset($_GET['attdate']) ? $_GET['attdate'] : date('Y-m-d')) . "\">{$rowselect['engineername']}</a>'],";
                }
            }
            ?>
        ]);

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {
            mapType: 'styledMap',
            zoomLevel: 7,
            showTooltip: true,
            showInfoWindow: true,
            useMapTypeControl: true
        });
    }
</script>
 
</head>

<body id="page-top">

  <div id="wrapper">

    <?php include('sidebar.php');?>
    
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

          <?php include('navbar.php');?>
          <?php include('engineernavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
		  
		  			
		    <div class="row" style="padding: 10px;">
			<div class="col-lg-12">
     <div class="card shadow cardb mb-4">
                <div class="card-header py-2">
                    <h6 style="color:#04121f" class="m-0  text-center"><b>Customer Search Ratio</b>&nbsp;<i class="fa fa-info-circle" data-toggle="tooltip" title="Call Assigned / Total Customer Search"></i></h6>
                </div>
               <?php
// Count the number of rows with id and calltid != '' for today
 $sqlCountToday = "SELECT 
    COUNT(*) AS total_today, 
    COUNT(CASE WHEN calltid != '' THEN 1 END) AS total_with_calltid 
    FROM jrcsearchhistory 
    WHERE DATE(times) = CURDATE()";

$queryCountToday = mysqli_query($connection, $sqlCountToday);

if (!$queryCountToday) {
    die("SQL query failed: " . mysqli_error($connection));
}

$rowCountToday = mysqli_fetch_assoc($queryCountToday);

// Count the number of rows per engineer for today
$sqlCountPerEngineer = "SELECT engineername, engineerid, 
    COUNT(*) AS total_per_engineer, 
    COUNT(CASE WHEN calltid != '' THEN 1 END) AS total_with_calltid_per_engineer 
    FROM jrcsearchhistory 
    WHERE DATE(times) = CURDATE() 
    GROUP BY engineername, engineerid";

$queryCountPerEngineer = mysqli_query($connection, $sqlCountPerEngineer);

if (!$queryCountPerEngineer) {
    die("SQL query failed: " . mysqli_error($connection));
}
?>

<div class="card-body">

    <ul class="todo-list ui-sortable" style="height: 232px">
        <?php
        while ($rowEngineer = mysqli_fetch_assoc($queryCountPerEngineer)) {
            $engineername = $rowEngineer['engineername'];
            $totalPerEngineer = $rowEngineer['total_per_engineer'];
			/* echo 'total_with_calltid_per_engineer'.$rowEngineer['total_with_calltid_per_engineer'];
			echo 'total_per_engineer'.$rowEngineer['total_per_engineer']; */
     $totalWithCalltidPerEngineer = number_format(($rowEngineer['total_with_calltid_per_engineer']/$rowEngineer['total_per_engineer'])*100,2);
            ?>
            <li>
                <span class="text"><a
                                    href="mapengineerview.php?id=<?=$rowEngineer['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowEngineer['engineername']?></a></span>
				
                <span class="text-dark float-right"><?= $totalWithCalltidPerEngineer?>%</span>&nbsp; 
				<span style="float: right;right: 20px;position: relative;top: 0;" > <?=$rowEngineer['total_with_calltid_per_engineer']?>/<?= $rowEngineer['total_per_engineer']?></span>
				
                
            </li>
            <?php
        }
        ?>
    </ul>
</div>

            </div>
    </div>
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Service Engineer Details</b></h1>
  </div>
<div class="col-auto" style="padding-top:10px; text-align: right;">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
        <div class="input-group">
                                    <input type="date" name="attdate" class="form-control" value="<?=((isset($_GET['attdate']))?$_GET['attdate']:date('Y-m-d'))?>">
									
            <div class="input-group-append">
                <button class="btn btn-navb" type="submit" name="submit">
                    <i class="fa-solid fa-calendar-days fa-sm" style="color: #3d8eb9;"></i>
                </button>
                <button class="btn btn-navb" type="submit">
                    <a href="mapengineer.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
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
          
            <div class="card-body">
		
 <div class="row">
	  <div class="col-lg-12">
	   <div id="map_div" style="width: 100%; height: 400px"></div>
		  </div>
		  </div>


<br>
</div>
</div>
	<div class="card shadow mb-4">
          
            <div class="card-body">
			<h6 class="m-0 font-weight-bold text-primary">Report as on <?=date('d/m/Y',strtotime($attdate))?></h6>
			<br>
		
			<div class="table-responsive1">
                <table class="table table-bordered font-13" width="100%" cellspacing="0" id="dataTable" >
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Engineer Name</th>
					  <th>Total Calls</th>
					  <th>Pending Calls</th>
					  <th>Completed Calls</th>
					  <th>Completion %</th>
					  <?php
					  if($liveplan=='DIAMOND')
					  {
						  ?>
						
					  <th>Call Points</th>					  
					  <th>Total Kms</th>
					  <th>Travel Points</th>
					  	  <?php
					  }
					  ?>				  

                    </tr>
                  </thead>
                  <tbody>
		<?php
		$totaltotalcalls=0;
		$totaltotalstatuscomplete=0;
$totaltotalstatuspending=0; 
$totaltotalstatusper=0; 
		$engineerarray=array();
		$engineerpoints=array();
		$engineercpoints=array();
		$sqlselect = "SELECT id, engineername From jrcengineer where enabled='0' and designation='SERVICE ENGINEER' order by username asc";
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
$totalcalls=0;

$totaldays=0;
$totalpresent=0;
$totalabsent=0;	
$totalkmtravelled=0;	
$totalpoints=0;
$totalcpoints=0;
$totalexpenses=0; 
$totalstatuscomplete=0;
$totalstatuspending=0; 
$totalstatusper=0; 
$totalda=0; 
$date=$attdate;
$end=$attdate;
			?>
                    <tr>
                      <td><?=$count?></td>
                      <td><a href="mapengineerview.php?id=<?=$rowselect['id']?>&attdate=<?=((isset($_GET['attdate']))?$_GET['attdate']:date('Y-m-d'))?>"><?=$rowselect['engineername']?></a></td>
					 
<?php
			while(strtotime($date) <= strtotime($end)) 
			{
			$totaldays++;	
		$sqlmap = "SELECT location1, location2, location3, location4, location5, location6, location7, lockm1, lockm2, lockm3, lockm4, lockm5, lockm6, lockm7, points1, points2, points3, points4, points5, points6, points7, callstatus1, callstatus2, callstatus3, callstatus4, callstatus5, callstatus6, callstatus7, endkm, daamount, totexpense From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$date."%' order by attdate desc";
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
			for($i=1;$i<=7;$i++)
			{
			if($infomap['location'.$i]!='')
			{
			$totalcalls++;	
			$totalkms=$totalkms+(float)$infomap['lockm'.$i];
			$dakms=$dakms+(float)$infomap['lockm'.$i];
			$cpoints+=(float)$infomap['points'.$i];
			
			if($infomap['callstatus'.$i]=="Completed")
			{
				$statuscomplete++;
			}
			if($infomap['callstatus'.$i]=="Pending")
			{
				$statuspending++;
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
<td><?=$totalcalls?></td>
<td><?=$totalstatuspending?></td>
<td><?=$totalstatuscomplete?></td>
<td><?=($totalcalls!=0)?round(($totalstatuscomplete/$totalcalls)*100,2):0?></td>
<?php
					  if($liveplan=='DIAMOND')
					  {
						  ?>
						
<td><?=$totalcpoints?></td>
<td><?=$totalkmtravelled?></td>
<td><?=$totalpoints?></td>
<?php
					  }
					  ?>
                    </tr>
					<?php
					$count++;
				$engineerarray[]=$rowselect['engineername'];
				$engineerpoints[]=$totalpoints;
				$engineercpoints[]=$totalcpoints;
				$totaltotalcalls+=$totalcalls;	
$totaltotalstatuscomplete+=$totalstatuscomplete;
$totaltotalstatuspending+=$totalstatuspending;
			}
		}
			?>
					
                  </tbody>
				  <tfoot>
				  <tr>
				  <td colspan="2"></td>
				  <td><?=$totaltotalcalls?></td>
				  <th><?=$totaltotalstatuspending?></th>
				  <th><?=$totaltotalstatuscomplete?></th>
				  <th><?=($totaltotalcalls!=0)?round(($totaltotalstatuscomplete/$totaltotalcalls)*100,2):0?></th>
				  <?php
					  if($liveplan=='DIAMOND')
					  {
						  ?>
						
				  <td colspan="3"></td>
				  <?php
					  }
					  ?>
				  </tr>
				  </tfoot>
                </table>
              </div>
			  </div>
			  </div>
		
			<div class="card shadow mb-4">
          
            <div class="card-body">
			
			<div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
              <div class="table-responsive scroll">
                <table class="table table-bordered font-13"  id="DataTable1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Engineer Name</th>
					  <th>View</th>
					  <th>Attendance</th>
					  <?php
					  if($liveplan=='DIAMOND')
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
				  
				  $sqlselect = "SELECT engineername, id From jrcengineer where enabled='0' and designation='SERVICE ENGINEER' order by username asc";
				  
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
                      <td><?=$rowselect['engineername']?></td>
					  <td>
					  <a href="mapengineerview.php?id=<?=$rowselect['id']?>&attdate=<?=$attdate?>" target="_blank">View</a>
					  </td>
					  <?php
					  $output='';
					  $sqlmap = "SELECT ticketapprove, starttime, location1, location2, location3, location4, location5, location6, location7, detailsid1, detailsid2, detailsid3, detailsid4, detailsid5, detailsid6, detailsid7, loccall1, loccall2, loccall3, loccall4, loccall5, loccall6, loccall7, loctime1, loctime2, loctime3, loctime4, loctime5, loctime6, loctime7, lockm1, lockm2, lockm3, lockm4, lockm5, lockm6, lockm7, callstatus1, callstatus2, callstatus3, callstatus4, callstatus5, callstatus6, callstatus7, points1, points2, points3, points4, points5, points6, points7, worktime1, worktime2, worktime3, worktime4, worktime5, worktime6, worktime7, endtime, endkm, daamount, totexpense  From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$attdate."%' order by attdate desc";
				  
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
					  if($liveplan=='DIAMOND')
					  {
						  ?>
						
			<?php
			
			if($infomap['ticketapprove']!='0')
			{
				
				?>
				<td><a href="mapengineerview.php?id=<?=$rowselect['id']?>&attdate=<?=$attdate?>" target="_blank"  class="text-success">Verified</a></td>
				<?php
			}
			else
			{
				?>
				<td><a href="mapengineerview.php?id=<?=$rowselect['id']?>&attdate=<?=$attdate?>" target="_blank"  class="text-danger">Pending</a></td>
				<?php
			}	
			?>
			<?php
					  }
					  ?>
					  <?php
			$output.='<td>'.(($infomap['starttime']!='')?date('d/m/Y h:i:s a',strtotime($infomap['starttime'])):'').'</td>';
			$totalkms=0;
			$dakms=0;
			$cpoints=0;
			for($i=1;$i<=7;$i++)
			{
			if($infomap['location'.$i]!='')
			{
			$details='';
			/* if($infomap['detailsid'.$i]!='')
			{
				$sqlcon4 = "SELECT worktype, stockitem, callstatus From jrccalldetails WHERE id = '".$infomap['detailsid'.$i]."'";
				$querycon4 = mysqli_query($connection, $sqlcon4);
				$rowcon4=mysqli_num_rows($querycon4);
				$infocon4=mysqli_fetch_array($querycon4);
				$details='<b>Product:</b> <br>'.$infocon4['stockitem'].'<br><br><b>Work Type:</b> <br>'.$infocon4['worktype'].'<br><br><b>Call Status:</b> <br>'.$infocon4['callstatus'].'';
			}
			$output.='<td><a href="callsedit.php?calltid='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a><br>'.(date('d/m/Y h:i:sa',strtotime($infomap['loctime'.$i]))).' <br>'.$infomap['lockm'.$i].' Kms <br>'.(($infomap['callstatus'.$i]=="Completed")?'<span class="text-success">Completed</span>':(($infomap['callstatus'.$i]=="Pending")?'<span class="text-danger">Pending</span>':(($infomap['callstatus'.$i]=="Open")?'<span class="text-warning">Open</span>':$infomap['callstatus'.$i]))).'<br><div class="tooltip1"><b>'.$infomap['points'.$i].' Points</b><span class="tooltiptext1">'.$details.'</span></div><br>'.$infomap['worktime'.$i].' Duration</td>';
			
			$totalkms=$totalkms+(float)$infomap['lockm'.$i];
			$dakms=$dakms+(float)$infomap['lockm'.$i];
			$cpoints+=$infomap['points'.$i]; */
			if($infomap['detailsid'.$i]!='')
{
$sqlcon4 = "SELECT worktype, stockitem, callstatus From jrccalldetails WHERE id = '".$infomap['detailsid'.$i]."'";
$querycon4 = mysqli_query($connection, $sqlcon4);
$rowcon4=mysqli_num_rows($querycon4);
$infocon4=mysqli_fetch_array($querycon4);
if($rowcon4>0)
{
$details='<b>Product:</b> <br>'.$infocon4['stockitem'].'<br><br><b>Work Type:</b> <br>'.$infocon4['worktype'].'<br><br><b>Call Status:</b> <br>'.$infocon4['callstatus'].'';
}
}
/* $output.='<td><a href="callsedit.php?calltid='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a><br>'.(date('d/m/Y h:i:sa',strtotime($infomap['loctime'.$i]))).' <br>'.$infomap['lockm'.$i].' Kms <br>'.(($infomap['callstatus'.$i]=="Completed")?'<span class="text-success">Completed</span>':(($infomap['callstatus'.$i]=="Pending")?'<span class="text-danger">Pending</span>':(($infomap['callstatus'.$i]=="Open")?'<span class="text-warning">Open</span>':$infomap['callstatus'.$i]))).'<br><div class="tooltip1"><b>'.$infomap['points'.$i].' Points</b><span class="tooltiptext1">'.$details.'</span></div><br>'.$infomap['worktime'.$i].' Duration</td>';
$totalkms=$totalkms+(float)$infomap['lockm'.$i];
$dakms=$totalkms+(float)$infomap['lockm'.$i];
$cpoints+=$infomap['points'.$i]; */
if (($infolayoutservice['reportformat']=='1')) {
	if(($infomap['callstatus'.$i] == "Completed") || ($infomap['callstatus'.$i] == "Pending") )
	{
    $output .= '<td><a href="complaintprint.php?id='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
	else
	{
		$output .= '<td><a href="callsedit.php?calltid='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
} 
else
	{
 if(($infomap['callstatus'.$i] == "Completed") || ($infomap['callstatus'.$i] == "Pending")|| ($infomap['callstatus'.$i] == "Cancelled") )
	{
    $output .= '<td><a href="complaintprint1.php?id='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
	else
	{
		$output .= '<td><a href="callsedit.php?calltid='.$infomap['loccall'.$i].'" target="_blank">'.$infomap['loccall'.$i].'</a>';
	}
}
$output.='<br>'.(date('d/m/Y h:i:sa',strtotime($infomap['loctime'.$i]))).' <br>'.$infomap['lockm'.$i].' Kms <br>'.(($infomap['callstatus'.$i]=="Completed")?'<span class="text-success">Completed</span>':(($infomap['callstatus'.$i]=="Pending")?'<span class="text-danger">Pending</span>':(($infomap['callstatus'.$i]=="Cancelled")?'<span class="text-info">Cancelled</span>':(($infomap['callstatus'.$i]=="")?'<span class="text-warning">Open</span>':$infomap['callstatus'.$i]))))
.'<br><div class="tooltip1"><b>'.$infomap['points'.$i].' Points</b><span class="tooltiptext1">'.$details.'</span></div><br>'.$infomap['worktime'.$i].' Duration</td>';
$totalkms=$totalkms+(float)$infomap['lockm'.$i];
$dakms=$totalkms+(float)$infomap['lockm'.$i];
$cpoints+=$infomap['points'.$i];
			}
			else
			{
			$output.='<td></td>';
			}
			}
			$output.='<td>'.(($infomap['endtime']!='')?date('d/m/Y h:i:s a',strtotime($infomap['endtime'])):'').'</td>';
			$totalkms=$totalkms+(float)$infomap['endkm'];
			if($liveplan=="DIAMOND")
			{
			?>
			<td><?=$totalkms?></td>
			<?php
			}
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
			if($liveplan=="DIAMOND")
			{
			?>
			<td><?=$points?></td>
			<td><?=$cpoints?></td>
			<td><?=$da?> (<?=$dakms?>)</td>
			<td><?=$infomap['totexpense']?></td>
			<?php
			}
			?>
			<?php
			echo $output;
			
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
		?>          </tr>
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
				buttons: [
			   {
				   extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
				   orientation: 'landscape',
				   footer: true,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: false,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
					}
			   }         
			]  
            });
			var table = $('#dataTable1').DataTable({
                "paging": false,
                "processing": true,
                dom: 'Blfrtip',
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
				   footer: false,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7]
					}
			   }         
			]  
            });

        });
  
  });
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
