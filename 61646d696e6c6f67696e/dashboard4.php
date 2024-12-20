<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once '../../1637028036/vendor/excel1/Classes/PHPExcel.php';	
include('lcheck.php');
function convertXLStoCSV($infile,$outfile)
{
	$fileType = PHPExcel_IOFactory::identify($infile);
	$objReader = PHPExcel_IOFactory::createReader($fileType);
			 
	$objReader->setReadDataOnly(false); 
	$objPHPExcel = $objReader->load($infile);    
				 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
	$objWriter->save($outfile);
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

    <title><?=$_SESSION['companyname']?> - Jerobyte - Dashboard</title>

    
    <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <meta name="theme-color" content="#3d8eb9">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    
    <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> 
    <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
    <style>
    .todo-list {
        margin: 0;
        padding: 0;
        list-style: none;
        overflow: auto;
    }

    .todo-list>li {
        border-radius: 2px;
        padding: 10px;
        background: #f4f4f4;
        margin-bottom: 2px;
        border-left: 2px solid #e6e7e8;
        color: #444;
    }

    .todo-list>li .label {
        margin-left: 10px;
        font-size: 9px;
    }

    .todo-list>li .tools {
        display: none;
        float: right;
        color: #dd4b39;
    }

    .todo-list>li:hover .tools {
        display: block;
    }

    .no-border {
        border: 0 !important;
    }

    .btn-sm {
        padding: .25rem .15rem;
        font-size: .675rem;
        line-height: 0.5;
        border-radius: .2rem;
    }

    .mybox:after {
        content: '';
        position: absolute;
        right: 0px;
        top: 25%;
        height: 50%;
        border-right: 2px solid #ffffff;
    }

    .card {
        border: none;
    }
	.col-12
	{
		padding-right: 0;
    padding-left: 0;
	}
	.contable td, .contable th {
    padding: 0.3rem;
    vertical-align: top;
    border-top: 1px solid #e3e6f0;
}


.cardnew
{
	background-clip: border-box;
    border: 1px solid rgba(0,0,0,.06);
    border-radius: 0.25rem;
	height:120px;
	overflow-y:hidden;
}
.cardnew:hover
{
	height:auto;
}
.primary {
    color: #00B5B8!important;
}

.warning {
    color: #FFA87D!important;
}

.success {
    color: #16D39A!important;
}
.danger {
    color: #FF7588!important;
}
.bg-primary, .sidebar-brand
{
	background-color: #3d8eb9 !important;
}
.btn-primary
{
	background-color: #3d8eb9 !important;
	border-color: #3d8eb9 !important;
}
.text-primary
{
	color: #3d8eb9!important;
}
.sidebar-dark .nav-item.active .nav-link, .sidebar-dark .nav-item.active .nav-link i
{
	color: #3d8eb9!important;
}
.go-corner
{
	background-color: #3d8eb9 !important;
}
.media-body h3
{
	margin-bottom:0;
}

.media-body span
{
	font-size:80%
}

    </style>
</head>

<body id="page-top" onLoad="getGeolocation()">

    
    <div id="wrapper">

        
        <?php include('sidebar.php');?>
        

        
        <div id="content-wrapper" class="d-flex flex-column">

            
            <div id="content">

                
                <?php include('navbar.php');?>
                

                
                <div class="container-fluid">

                   
                    <?php
		  if(isset($_POST['submit']))
		  {
			  $dashfromdate=date('Y-m-d',strtotime($_POST['dashfromdate']));
			  $dashtodate=date('Y-m-d',strtotime($_POST['dashtodate']));
			  $dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
		  }
		  else
		  {
			  $dashfromdate='';
			  $dashtodate='';
			  $dashcallonsearch='';
			  $dashschargesearch='';
		  }
		  $ad=1;
		  ?>
                    <div class="row">
					<div class="col-xl-4 col-md-4 mt-4 text-primary" style="font-weight:bold">
					Average TAT: <span id="tat">0</span> Hours
					</div>
                        <div class="col-xl-8 col-md-8 mb-2">
                            <form class="form-inline float-right" method="post">
                                <div class="form-group m-2 mt-1">
                                    <label for="dashfromdate">From &nbsp; &nbsp;</label>
                                    <input type="date" class="form-control" id="dashfromdate" name="dashfromdate"
                                        value="<?=$dashfromdate?>" required>
                                </div>
                                <div class="form-group m-2 mt-1">
                                    <label for="dashtodate">To &nbsp; &nbsp;</label>
                                    <input type="date" class="form-control" id="dashtodate" name="dashtodate"
                                        value="<?=$dashtodate?>" required>
                                </div>
								<div class="form-group mt-1">
                                <button type="submit" name="submit" class="btn btn-primary m-2 mt-1">GET INFO</button>
								<a href="dashboard.php" class="btn btn-primary m-2 mt-1">RESET</a>
								</div>
                            </form>

                        </div>
                    </div>
					

					
					
					
					
					
					
                    <div class="row">
						<div class="col-lg-12">
						
						
						
		
			
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
							<div class="row">
                        <?php
						if($callview=='1')
						{
					if(!isset($_POST['submit']))
		  {	
				  $totalcalls=0;
				  $totalopen=0;
				  $totalpending=0;
				  $totalcomplete=0;
				  				  
				  $totalwcalls=0;
				  $totalwopen=0;
				  $totalwpending=0;
				  $totalwcomplete=0;
				  
				  $totalacalls=0;
				  $totalaopen=0;
				  $totalapending=0;
				  $totalacomplete=0;
				  
				  $totalocalls=0;
				  $totaloopen=0;
				  $totalopending=0;
				  $totalocomplete=0;
				  
				  $totalomcalls=0;
				  $totalomopen=0;
				  $totalompending=0;
				  $totalomcomplete=0;
				  
				  $todaycalls=0;
				  $todayopen=0;
				  $todaypending=0;
				  $todaycomplete=0;
				  
				  $totaltodaycalls=0;
				  $totaltodayopen=0;
				  $totaltodaypending=0;
				  $totaltodaycomplete=0;
				  
				  $todaywcalls=0;
				  $todaywopen=0;
				  $todaywpending=0;
				  $todaywcomplete=0;
				  
				  $todayacalls=0;
				  $todayaopen=0;
				  $todayapending=0;
				  $todayacomplete=0;
				  
				  $todayocalls=0;
				  $todayoopen=0;
				  $todayopending=0;
				  $todayocomplete=0;
				  
				  $totaltodayacalls=0;
				  $totaltodayaopen=0;
				  $totaltodayapending=0;
				  $totaltodayacomplete=0;
				  
				  $totaltodayocalls=0;
				  $totaltodayoopen=0;
				  $totaltodayopending=0;
				  $totaltodayocomplete=0;
				  
				  $todayomcalls=0;
				  $todayomopen=0;
				  $todayompending=0;
				  $todayomcomplete=0;
				  
				  
				  $oldcalls=0;
				  $oldopen=0;
				  $oldpending=0;
				  $oldcomplete=0;
				  
				  $oldwcalls=0;
				  $oldwopen=0;
				  $oldwpending=0;
				  $oldwcomplete=0;
				  
				  $oldacalls=0;
				  $oldaopen=0;
				  $oldapending=0;
				  $oldacomplete=0;
				  
				  $oldocalls=0;
				  $oldoopen=0;
				  $oldopending=0;
				  $oldocomplete=0;
				  
				  $oldomcalls=0;
				  $oldomopen=0;
				  $oldompending=0;
				  $oldomcomplete=0;
				  $count=1;
			$ccount=1;
			$totaltat=0;
				  
				  $sqlcall = "SELECT calltype, compstatus, callon, changeon From jrccalls ".$dashcallonsearch." order by id desc";
				  
        $querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
         
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcall > 0) 
		{
			
			while($rowcall = mysqli_fetch_array($querycall)) 
			{
				$tatcal=0;
				$totalcalls++;
				if($rowcall['calltype']=='Service Call')
				{
					$totalacalls++;
				}
				if($rowcall['calltype']=='Other Call')
				{
					$totalocalls++;
				}
				
				
				
				if($rowcall['compstatus']=='0')
				{
					$totalopen++;
					if($rowcall['calltype']=='Service Call')
					{
						$totalaopen++;
					}
					if($rowcall['calltype']=='Other Call')
					{
						$totaloopen++;
					}
					
				}
				if($rowcall['compstatus']=='1')
				{
					$totalpending++;
					if($rowcall['calltype']=='Service Call')
					{
						$totalapending++;
					}
					if($rowcall['calltype']=='Other Call')
					{
						$totalopending++;
					}
					
				}
				if($rowcall['compstatus']=='2')
				{
					$totalcomplete++;
					if($rowcall['calltype']=='Service Call')
					{
						$totalacomplete++;
					}
					if($rowcall['calltype']=='Other Call')
					{
						$totalocomplete++;
					}
					
				}
				if(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))
				{
					$todaycalls++;
					if($rowcall['calltype']=='Service Call')
					{
						$todayacalls++;
					}
					if($rowcall['calltype']=='Other Call')
					{
						$todayocalls++;
					}
					if($rowcall['compstatus']=='0')
					{
						$todayopen++;
						if($rowcall['calltype']=='Service Call')
						{
							$todayaopen++;
						}
						if($rowcall['calltype']=='Other Call')
						{
							$todayoopen++;
						}
					}					
				}
				if(date('Y-m-d')!=date('Y-m-d',strtotime($rowcall['callon'])))
				{
					$oldcalls++;
					if($rowcall['calltype']=='Service Call')
					{
						$oldacalls++;
					}
					if($rowcall['calltype']=='Other Call')
					{
						$oldocalls++;
					}
					if($rowcall['compstatus']=='0')
					{
						$oldopen++;
						if($rowcall['calltype']=='Service Call')
						{
							$oldaopen++;
						}
						if($rowcall['calltype']=='Other Call')
						{
							$oldoopen++;
						}
					}					
				}
				if((date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))&&(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					if($rowcall['compstatus']=='2')
					{
						$totaltodaycomplete++;
						$todaycomplete++;
						if($rowcall['calltype']=='Service Call')
						{
							$todayacomplete++;
							$totaltodayacomplete++;
						}
						if($rowcall['calltype']=='Other Call')
						{
							$todayocomplete++;
							$totaltodayocomplete++;
						}
					}					
				}
				if((date('Y-m-d')!=date('Y-m-d',strtotime($rowcall['callon'])))&&(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					
					if($rowcall['compstatus']=='2')
					{
						$totaltodaycomplete++;
						$oldcomplete++;
						if($rowcall['calltype']=='Service Call')
						{
							$oldacomplete++;
							$totaltodayacomplete++;
						}
						if($rowcall['calltype']=='Other Call')
						{
							$oldocomplete++;
							$totaltodayocomplete++;
						}
					}
					
				}
				
				if((date('Y-m-d')==date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					if($rowcall['compstatus']=='1')
					{
						$totaltodaypending++;
						$todaypending++;
						if($rowcall['calltype']=='Service Call')
						{
							$todayapending++;
							$totaltodayapending++;
						}
						if($rowcall['calltype']=='Other Call')
						{
							$todayopending++;
							$totaltodayopending++;
						}
					}
									
				}
				if((date('Y-m-d')!=date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					if($rowcall['compstatus']=='1')
					{
						$totaltodaypending++;
						$oldpending++;
						if($rowcall['calltype']=='Service Call')
						{
							$oldapending++;
							$totaltodayapending++;
						}
						if($rowcall['calltype']=='Other Call')
						{
							$oldopending++;
							$totaltodayopending++;
						}
					}
					
					
				}
				
if(($rowcall['callon']!='')&&(!empty($rowcall['callon']))&&($rowcall['changeon']!='')&&(!empty($rowcall['changeon'])))
{
$changeon_now = strtotime($rowcall['changeon']);
$callon_old = strtotime($rowcall['callon']);
$datediff = $changeon_now - $callon_old;
$tatcal=round($datediff / (60 * 60));
$totaltat+=$tatcal;
$ccount++;
}

			}
		}
		$result = mysqli_query($connection,"select year(callon) as year, month(callon) as month, count(id) as total_calls from jrccalls group by year(callon), month(callon) order by id asc");
$i=0;
$months='';
$totals='';

while($row = mysqli_fetch_array($result)) 
{
	$month_name = date("F", mktime(0, 0, 0, $row["month"], 10));
	if($months=='')
	{		
	$months='"'.$row["year"].'-'.$month_name.'"';
	}
	else
	{
		$months.=', "'.$row["year"].'-'.$month_name.'"';
	}
	if($totals=='')
	{		
	$totals=''.$row["total_calls"].'';
	}
	else
	{
		$totals.=', '.$row["total_calls"].'';
	}
}
		$tat=($totaltat/$ccount);
		
		?>
		<script>document.getElementById("tat").innerHTML=" <?=round($tat,2)?>";</script>
		
		
		
		 <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-phone fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
				<span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Received Calls</span>
                  <?php
											if(isset($_POST['submit']))
											{
												?><h3><?=$totalcalls?></h3>
                                                <span style="font-size:1em;">SC : <?=$totalacalls?> | OC :
                                                    <?=$totalocalls?><br></span>
												<?php
											}
											else
											{
												?>
                                               <h3><?=$todaycalls?></h3>
                                                <span style="font-size:1em;">SC : <?=$todayacalls?> | OC :
                                                    <?=$todayocalls?><br></span>
												<?php
											}
											?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-envelope-open fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
                  <span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Open Calls</span>
				  
				   <h3><?=$totalopen?></h3>
					<span style="font-size:1em;">SC : <?=$totalaopen?> | OC : <?=$totaloopen?></span><br><br> 
					<span style="font-size:0.75em;">( Today - SC : <?=$todayaopen?> | OC : <?=$todayoopen?> )</span><br>
					<span style="font-size:0.75em;">( Old - SC : <?=$oldaopen?> | OC : <?=$oldoopen?> )</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-exclamation-triangle fa-2x danger float-left"></i>
                </div>
                <div class="media-body text-center">
                  <span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Pending Calls</span>
				  <h3><?=$totaltodaypending?></h3>
                  <span style="font-size:1em;">SC : <?=$totaltodayapending?> | OC : <?=$totaltodayopending?></span> <br>  <br> 
                                            
													<span style="font-size:0.75em;">(
                                                    Today - SC : <?=$todayapending?> | OC : <?=$todayopending?> )</span>
													<br>
													<span style="font-size:0.75em;">(
                                                    Old - SC : <?=$oldapending?> | OC : <?=$oldopending?> )</span>
				  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-check  success fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
                   <span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Completed Calls</span>
				
				   
											   <?php
											if(isset($_POST['submit']))
											{
												?>	
												 <h3><?=$totalcomplete?></h3>
                                                <span style="font-size:1em;">SC : <?=$totalacomplete?> | OC :
                                                    <?=$totalocomplete?></span>
                                          	<?php
											}
											else
											{
												?> <h3><?=$totaltodaycomplete?></h3>
                                                <span style="font-size:1em;">SC : <?=$totaltodayacomplete?> | OC :
                                                    <?=$totaltodayocomplete?></span><br><br>
                                            
											  <span style="font-size:0.7em;">(
                                                    Today Rec - SC : <?=$todayacomplete?> | OC : <?=$todayocomplete?> )
                                                </span>
												<br>
												<span style="font-size:0.7em;">(
                                                    Old Rec - SC : <?=$oldacomplete?> | OC : <?=$oldocomplete?> )
                                                </span>
												<?php
											}
											?>
				  
                </div>
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
			  
					<?php
						$datefrom=mysqli_real_escape_string($connection, $dashfromdate);
						$dateto=mysqli_real_escape_string($connection, $dashtodate);
						$result=mysqli_query($connection, "SELECT calltype, compstatus, callon, calltid, changeon, pendingon1, pendingon2, pendingon3 From jrccalls order by id asc");
						while($array = mysqli_fetch_assoc($result)){
						  
							$row[] = $array;
						}
						$result1=mysqli_query($connection, "SELECT calltype, compstatus, callon, calltid, changeon From jrccallshistory order by id asc");
						while($array1 = mysqli_fetch_assoc($result1)){
						  
							$row1[] = $array1;
						}
						$oldcalls=0;
							$oldopen=0;
							$oldopeningpending=0;
							$oldpending=0;
							$oldpendingcomplete=0;
							$oldcompleted=0;
							$oldbalance=0;
							$oldpendingbalance=0;
							foreach($row as $d)
							{
								if($datefrom>date('Y-m-d',strtotime($d['callon'])))
								{
									$oldcalls++;
									if($d['compstatus']=='0')
									{
										$oldopen++;
									}
								}
								if(($datefrom>date('Y-m-d',strtotime($d['changeon'])))&&($d['pendingon1']==''))
								{
									if($d['compstatus']=='2')
									{
										$oldcompleted++;
									}
								}
								/* if(($d['pendingon1']!='')&&($datefrom>date('Y-m-d',strtotime($d['changeon']))))
								{
									$oldpending++;
									if($d['compstatus']=='2')
									{
										$oldpendingcomplete++;
									}
								} */
								
								//if((($d['pendingon1']!='')&&($datefrom>date('Y-m-d',strtotime($d['pendingon1']))))||(($d['pendingon2']!='')&&($datefrom>date('Y-m-d',strtotime($d['pendingon2']))))||(($d['pendingon3']!='')&&($datefrom>date('Y-m-d',strtotime($d['pendingon3'])))))
								if((($d['pendingon1']!='')&&($datefrom>date('Y-m-d',strtotime($d['pendingon1'])))))	
								{
									$oldpending++;									
									if(($datefrom>date('Y-m-d',strtotime($d['changeon']))))
									{
										if($d['compstatus']=='2')
										{
											$oldpendingcomplete++;
										}
									}
								}								
							}
							$oldbalance=($oldcalls)-(($oldcompleted+$oldpendingcomplete)+($oldpending-$oldpendingcomplete));
							$oldpendingbalance=$oldpending-$oldpendingcomplete;
							$originaloldbalance=$oldbalance;
							$originaloldpendingbalance=$oldpendingbalance;
							
						?>
					
					<?php						
						$count=1;
						$sumtodaycalls=0;
						$sumtodaypending=0;
						
						$sumtodayoldcompleted=0;
						$sumtodayveryoldcompleted=0;
						$sumtodaynewcompleted=0;
						$sumtodaypendingcompleted=0;
						$sumtodaycompleted=0;
						
						$sumtodayveryoldpending=0;
						
						while(strtotime($datefrom) <= strtotime($dateto))
						{
							$todaycalls=0;
							$todayopen=0;
							$todayopeningpending=0;
							$todaypending=0;
							$todayveryoldcompleted=0;
							
							$todayveryoldpending=0;
							
							$todayoldcompleted=0;
							$todaynewcompleted=0;
							$todaypendingcompleted=0;
							$todaycompleted=0;
							$todayoldbalance=0;
							$todaynewbalance=0;
							$todaybalance=0;
							$todaypendingbalance=0;
							
							$todaypendingtodaycomplete=0;
							$oldpendingtodaycomplete=0;
							
							foreach($row as $d)
							{
								if($datefrom==date('Y-m-d',strtotime($d['callon'])))
								{
									$todaycalls++;
									if($d['compstatus']=='0')
									{
										$todayopen++;
									}
								}
								if($datefrom==date('Y-m-d',strtotime($d['changeon'])))
								{
									if($d['compstatus']=='2')
									{
										$todaycompleted++;
									}
								}
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($d['pendingon1']!=''))
								{
									if($d['compstatus']=='2')
									{
										$todaypendingcompleted++;										
										//if((($d['pendingon1']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon1']))))||(($d['pendingon2']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon2']))))||(($d['pendingon3']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon3'])))))
										if((($d['pendingon1']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon1'])))))	
										{
											$todaypendingtodaycomplete++;
										}
										else
										{
											$oldpendingtodaycomplete++;
										}
									}
								}
								
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($dashfromdate>date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']==''))
								{
									if($d['compstatus']=='2')
									{
										$todayveryoldcompleted++;
									}
								}
								
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($dashfromdate>date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']!=''))
								{
									if($d['compstatus']=='2')
									{
										$todayveryoldpending++;
									}
								}
								
								
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($datefrom!=date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']==''))
								{
									if($d['compstatus']=='2')
									{
										$todayoldcompleted++;
									}
								}
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($datefrom==date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']==''))
								{
									if($d['compstatus']=='2')
									{
										$todaynewcompleted++;
									}
								}
								//if((($d['pendingon1']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon1']))))||(($d['pendingon2']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon2']))))||(($d['pendingon3']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon3'])))))
								if((($d['pendingon1']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon1'])))))	
								{
									$todaypending++;
								}
							}
							$todayoldbalance=$oldbalance-$todayoldcompleted;
							$todaynewbalance=$todaycalls-$todaynewcompleted;
							$todaybalance=($todaycalls+$oldbalance)-($todaycompleted+($todaypending-$todaypendingcompleted));
							$todaypendingbalance=$oldpendingbalance+($todaypending-$todaypendingcompleted);
							
							$balanceoldpending=$oldpendingbalance-$oldpendingtodaycomplete;
							$balancetodaypending=$todaypending-$todaypendingtodaycomplete;
							$sumtodaycalls+=$todaycalls;
							$sumtodaypending+=$todaypending;
							$sumtodayveryoldcompleted+=$todayveryoldcompleted;
							
							$sumtodayveryoldpending+=$todayveryoldpending;
							
							$sumtodayoldcompleted+=$todayoldcompleted;
							$sumtodaynewcompleted+=$todaynewcompleted;
							$sumtodaypendingcompleted+=$todaypendingcompleted;
							$sumtodaycompleted+=$todaycompleted;
							
							
							$oldbalance=$todaybalance;
							$oldpendingbalance=$todaypendingbalance;
							$datefrom = date ("Y-m-d", strtotime("+1 days", strtotime($datefrom)));
							$count++;
						}
						
						
						
						
						
						//Contents will be here
						
						
						
						
						?>
						
						
						
		
			  <?php
		  }
						}
						?>
						

                        <?php
						if($amcmanagement=='1')
						{
						
					$a=array();
					$totalamc=0;
$monthamc=0;
$totalamc1=0;
	  $sqlselect = "SELECT sourceid, dateto, datefrom, amctype, consigneeid From jrcamc where dateto>='".date('Y-m-d')."' order by datefrom asc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
		$inarray="";
        if($rowCountselect > 0) 
		{
			$count=1;

			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				if($inarray=='')
				{
					$inarray=$rowselect['sourceid'];
				}
				else
				{
					$inarray.=','.$rowselect['sourceid'];
				}
if($rowselect['dateto']!='')
{
$date1=$rowselect['datefrom'];
$date = new DateTime($rowselect['dateto']);
$now = new DateTime();
$yesterday=date('Y-m-d',strtotime("-1 days"));
$today=date('Y-m-d');
if($date >= $now) 
{
$tyes=0;	
if(($rowselect['amctype']=='Quarterly')||($rowselect['amctype']=='Monthly'))
{
	$targetdate=date('Y-m-d', strtotime($date1. ' + 3 months'));
	if($targetdate==$today)
	{
		$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
		$tyes=1;
	}
	if($targetdate==$yesterday)
	{
		$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
		$tyes=1;
	}
	$targetdate=date('Y-m-d', strtotime($date1. ' + 6 months'));
	if($targetdate==$today)
	{
		$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
		$tyes=1;
	}
	if($targetdate==$yesterday)
	{
		$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
		$tyes=1;
	}
	
	$targetdate=date('Y-m-d', strtotime($date1. ' + 9 months'));
	if($targetdate==$today)
	{
		$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
		$tyes=1;
	}
	if($targetdate==$yesterday)
	{
		$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
		$tyes=1;
	}

}
if($rowselect['amctype']=='Half Yearly')
{
	$targetdate=date('Y-m-d', strtotime($date1. ' + 6 months'));
	if($targetdate==$today)
	{
		$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
		$tyes=1;
	}
	if($targetdate==$yesterday)
	{
		$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
		$tyes=1;
	}
}
	if($tyes!=0)
	{
		
	}	
$value=$rowselect['consigneeid'];
$a[]=$value;
$totalamc1++;
$datediff = strtotime($rowselect['dateto']) - strtotime($today);
$effectiveDate=$rowselect['dateto'];
$days=round($datediff / (60 * 60 * 24));
if($days<30)
{
$monthamc++;
}
}
					  }
			}
		}
		if($inarray!='')
		{
			$sqlselect1="SELECT sum(qty) as qty From jrcxl where id in (".$inarray.") order by id asc";
			$queryselect1=mysqli_query($connection, $sqlselect1);
			$infoselect1=mysqli_fetch_array($queryselect1);
			$totalamc=$infoselect1['qty'];
		}
	$a=array_unique($a);
		?>
		
					
		 <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-redo fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">AMC Customers</span>
                  <h3><?=count($a)?></h3>
                  <span style="font-size:1em;">Products : <?=$totalamc?><br></span>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


                        <?php
						}
						if($warrantymanagement=='1')
						{
					$a=array();
					$totalwarranty=0;
$monthwarranty=0;
	  $sqlselect = "SELECT warranty, installedon,consigneeid, invoicedate From jrcxl group by invoiceno, invoicedate, stockitem, typeofproduct, componenttype, componentname, serialnumber order by invoicedate desc, warranty asc";
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
				if($rowselect['warranty']!='')
				{
						  if($rowselect['installedon']!='')
						  {
							  $overdate=$rowselect['installedon'];
						  }
						  else
						  {
							  $overdate=$rowselect['invoicedate'];
						  }
						  $off=(float)$rowselect['warranty'];
						  $overdate = str_replace('/', '-', $overdate);
							$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
						$date = new DateTime($effectiveDate);
$now = new DateTime();
$today=date('Y-m-d');
if($date >= $now) {
	

				$value=$rowselect['consigneeid'];
		if(!in_array($value, $a)){
        $a[]=$value;
        }
		
$totalwarranty++;

$datediff = strtotime($effectiveDate) - strtotime($today);

$days=round($datediff / (60 * 60 * 24));
if(($days>0)&&($days<30))
{
$monthwarranty++;
}
}
					  }
			}
		}
		?>
 <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-car-battery fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:0.8rem;">Warranty Customers</span>
                  <h3><?=count($a)?></h3>
                  <span style="font-size:1em;">Products : <?=$totalwarranty?><br></span>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


<?php
						}
						?>

<!--col 2-->

					<?php
				$preventive=0;
				$warrantyexpire=0;
				$amcmaintenance=0;
				$amcexpire=0;
				$sqlselect = "SELECT count(id) as count, remindertype From jrcreminder where enabled='0' group by remindertype order by remindertype asc";
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
						if($rowselect['remindertype']=='PREVENTIVE MAINTENANCE')
						{
							$preventive=(float)$rowselect['count'];
						}
						if($rowselect['remindertype']=='WARRANTY EXPIRE')
						{
							$warrantyexpire=(float)$rowselect['count'];
						}
						if($rowselect['remindertype']=='AMC MAINTENANCE')
						{
							$amcmaintenance=(float)$rowselect['count'];
						}
						if($rowselect['remindertype']=='AMC EXPIRE')
						{
							$amcexpire=(float)$rowselect['count'];
						}
					}
				}
				?>
				
				 <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-history fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">AMC <br>Maintanence</span>
                  <h3><?=$amcmaintenance?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
						
		<div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-handshake fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Warranty <br>Maintanence</span>
                  <h3><?=$preventive?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
						
						<?php
	  $sqlw = "SELECT count(id) as count From jrccalls where actiontaken='WAITING FOR APPROVAL'";
	    $queryw = mysqli_query($connection, $sqlw);
        $rowCountw = mysqli_fetch_array($queryw);
		$wcount=(float)$rowCountw['count'];
		$sqlo = "SELECT count(id) as count From jrccalls where actiontaken='OBSERVATION'";
	    $queryo = mysqli_query($connection, $sqlo);
        $rowCounto = mysqli_fetch_array($queryo);
		$ocount=(float)$rowCounto['count'];
		?>
		<div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-pause-circle fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Waiting for Approval</span>
                  <h3><?=$wcount?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-hourglass-end fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">AMC <br>Expiry</span>
                  <h3><?=$amcexpire?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-battery-empty  fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Warranty <br>Expiry</span>
                  <h3><?=$warrantyexpire?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-clock  fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;"></i>
                </div>
                <div class="media-body text-center">
				<span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1rem;">Observation <br>Calls</span>
                  <h3><?=$ocount?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		
						
                       <!-- 
					   
					   <div class="col-xl-4 col-md-4 mb-4" >
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                                onClick="window.location.href= 'report.php'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <div class="card-icon card-icon-large mb-2"><i
                                                    class="fas fa-chart-bar fa-2x"></i></div>
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">Reports</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 mb-4" >
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                                onClick="window.location.href= 'mapengineer.php'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <div class="card-icon card-icon-large mb-2"><i
                                                    class="fas fa-users fa-2x"></i></div>
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">
                                                Engineers Activities</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>

					   
					   <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                                onClick="window.location.href= 'invoiceadd.php'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <div class="card-icon card-icon-large mb-2"><i
                                                    class="fas fa-file-invoice fa-2x"></i></div>
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">Add
                                                New <br>Invoice</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                                onClick="window.location.href= 'consigneeadd.php'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <div class="card-icon card-icon-large mb-2"><i
                                                    class="fas fa-user fa-2x"></i></div>
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">Add
                                                New <br>Customer</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>-->
                        
						<!--
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                                onClick="window.location.href= 'importtally.php'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <div class="card-icon card-icon-large mb-2"><i
                                                    class="fas fa-file-import fa-2x"></i></div>
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">
                                                Import Data<br>from Tally</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card bg-primary text-white shadow1 card1" role="button"
                                onClick="window.location.href= 'exporttally.php'">
                                <div class="card-statistic-3 p-3">
                                    <div class="row align-items-center  d-flex" style="font-size:14px;">
                                        <div class="col-12 text-center">
                                            <div class="card-icon card-icon-large mb-2"><i
                                                    class="fas fa-file-export fa-2x"></i></div>
                                            <h5 class="card-title mb-0" style="font-size:0.9rem; font-weight:bold">
                                                Export Data<br>to Tally</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-corner" href="#">
                                    <div class="go-arrow">→</div>
                                </div>
                            </div>
                        </div>-->
 </div>

<br>
    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Service Revenue <span
                                            class="text-primary float-right">Total: Rs. <span
                                                id="totalservicerevenue"></span> ( Today: Rs. <span
                                                id="todayservicerevenue"></span> ) </span></h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%; height:250px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Monthwise Service Revenue <span
                                            class="text-primary float-right"></span></h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart1" style="width:100%; height:250px;"></canvas>
                                </div>
                            </div>
                        </div>
                        

    </div>


    <div class="row">

        <div class="col-lg-4">

             
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Reminders<a href="reminder.php" class="float-right">Go
                            to Reminder</a></h6>
                </div>
                <div class="card-body">
                    <marquee width="100%" direction="up" height="189px" scrollamount="3" onmouseover="this.stop();"
                        onMouseOut="this.start();">
                        <ul class="todo-list ui-sortable">
                            <?php
				  $sqlselect = "SELECT enddate, reminder From jrcreminder where enabled='0' order by reminder asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$btstyle=array('btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary','btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary','btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary','btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary');
			$count=0;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			$hourdiff = round((strtotime($rowselect['enddate']) - time())/3600, 1);	
			?>
                            <li>
                                <span class="text"><?=$rowselect['reminder']?></span>
                                <small class="btn btn-sm <?=($hourdiff<=0)?'bg-danger text-white':''?> float-right"><i
                                        class="fa fa-clock"></i> <?=$hourdiff?> hours</small>
                            </li>
                            <?php
		  $count++;
			}
		}
		?>
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
        <div class="col-lg-4">

             
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Updates/Announcements<a href="updates.php"
                            class="float-right">Go to Updates</a></h6>
                </div>
                <div class="card-body">
                    <marquee width="100%" direction="up" height="189px" scrollamount="3" onmouseover="this.stop();"
                        onMouseOut="this.start();">
                        <ul class="todo-list ui-sortable">
                            <?php
				  $sqlselect = "SELECT enddate, updates, updatetype From jrcupdates where enabled='0' and DATE(enddate)>'".date('Y-m-d')."' order by id desc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$btstyle=array('btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary','btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary','btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary','btn-danger', 'btn-info', 'btn-warning', 'btn-success','btn-primary');
			$count=0;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			$hourdiff = round((strtotime($rowselect['enddate']) - time())/3600, 1);	
			?>
                            <li>
                                <span class="text"><?=$rowselect['updates']?></span>
                                <small class="btn btn-sm float-right"><i class="fa fa-clock"></i>
                                    <?=$rowselect['updatetype']?></small>
                            </li>
                            <?php
		  $count++;
			}
		}
		?>
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
        <div class="col-lg-4">

             
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Engineers Calls</h6>
                </div>
                <div class="card-body">
                    <ul class="todo-list ui-sortable" style="height:195px">
                        <?php
		$sqlselect1 = "SELECT id, engineername From jrcengineer where enabled='0' and designation='SERVICE ENGINEER' order by engineername asc";
				  
        $queryselect1 = mysqli_query($connection, $sqlselect1);
        $rowCountselect1 = mysqli_num_rows($queryselect1);
         
        if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect1 > 0) 
		{
			$count=1;
			while($rowselect1 = mysqli_fetch_array($queryselect1)) 
			{							
									
									
									
				  $sqlselect = "SELECT engineername, count(engineerid) as numbers From jrccalls where compstatus!='2' and engineerid='".$rowselect1['id']."' order by engineername asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		
         
        if($rowCountselect > 0) 
		{
			$count=0;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			if((float)$rowselect['numbers']>0)
			{				
			?>
                        <li>
                            <span class="text"><a
                                    href="mapengineerview.php?id=<?=$rowselect1['id']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a></span>
                            <span class="text float-right"><?=$rowselect['numbers']?></span>
                        </li>
                        <?php
			}
			else
			{				
			?>
                        <li class="text-danger">
                            <span class="text"><a
                                    href="mapengineerview.php?id=<?=$rowselect1['id']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect1['engineername']?></a></span>
                            <span class="text float-right"><?=$rowselect['numbers']?></span>
                        </li>
                        <?php
			}	
		  $count++;
			}
			
		}
		
			}
		}
		?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    
    </div>
     
    </div>
     

     
    <?php include('footer.php') ?>
     
    </div>
     
    </div>
     

     
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a>
     
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
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

    
    <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
    <script src="notification.js"></script>

    <script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
    
    <script src="../../1637028036/vendor/chart.js/Chart.js"></script>
    <script type="text/javascript">
    $(function() {
        $("#topsearch").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#topsearch").val(ui.item.value);
                $("#topsearchid").val(ui.item.id);
	        },
            minLength: 3
        });
        $("#topsearch1").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#topsearch1").val(ui.item.value);
                $("#topsearchid1").val(ui.item.id);
            },
            minLength: 3
        });
    });
    </script>

    <?php
$totalservicerevenue=0;
$todayservicerevenue=0;
$sdate=array();
$samount=array();
$monthsarray=array();
$monthsparray=array();
$montharray=array();
 $sqli=mysqli_query($connection, "select sum(scharge) as scharge, schargedate, cashstatus from jrccalldetails where srno!='' and scharge!='' and scharge!='0' and scharge!='0.00' and incgst!='2' and (schargedate > now() - INTERVAL 2 MONTH) ".$dashschargesearch." group by schargedate, cashstatus order by cast(schargedate as date) asc");
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $sdate[]=date('d M',strtotime($infoi['schargedate']));
	 $samount[]=$infoi['scharge'];
	 $totalservicerevenue+=(float)$infoi['scharge'];
	 if(date('d/m/Y')==date('d/m/Y',strtotime($infoi['schargedate'])))
	 {
		 $todayservicerevenue=$infoi['scharge'];
	 }
	 $monthsarray[date('Y-m-d',strtotime($infoi['schargedate']))]=$infoi['scharge'];
	 $montharray[]=date('M Y',strtotime($infoi['schargedate']));
	 if($infoi['cashstatus']=='1')
	 {
		 $monthsparray[date('Y-m-d',strtotime($infoi['schargedate']))]=$infoi['scharge'];
	 }
		else
		{
			$monthsparray[date('Y-m-d',strtotime($infoi['schargedate']))]=0;
		}	
 }
$montharray=array_unique($montharray); 
$result1=array(); 
$result2=array(); 
foreach($monthsarray as $key=>$val)
{
   if(isset($result1[substr($key,0,7)]))
   {
		$result1[substr($key,0,7)] += $val;
   }
   else
   {
		$result1[substr($key,0,7)] = $val;
   }
}

foreach($monthsparray as $key=>$val)
{
   if(isset($result2[substr($key,0,7)]))
   {
		$result2[substr($key,0,7)] += $val;
   }
   else
   {
		$result2[substr($key,0,7)] = $val;
   }
}
?>
    <script>
    var xValues = [<?php foreach ($sdate as $sd){ echo "'".$sd."',";}?>];
    var yValues = [<?php foreach ($samount as $sa){ echo $sa.',';}?>];
    document.getElementById("totalservicerevenue").innerHTML = '<?=$totalservicerevenue?>';
    document.getElementById("todayservicerevenue").innerHTML = '<?=$todayservicerevenue?>';
    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0, 181, 184,1.0)",
                borderColor: "rgba(0, 181, 184,0.1)",
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                /* yAxes: [{ticks: {min: 6, max:16}}], */
            }
        }
    });
    </script>


    <script>
    var xValues = [<?php foreach ($montharray as $sd){ echo "'".$sd."',"; echo "'Collected',";}?>];
    var yValues = [
	<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result1[date('Y-m',strtotime($sd))].','.$result2[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>
	];
    var barColors=[<?php $se=0; foreach ($result1 as $sa){ echo "'".$jerobytecolors[$se]."',"; echo "'#cccccc',"; $se++; }?>];
     
    var myData = {
        labels: xValues,
        datasets: [{
            fill: false,
            backgroundColor: barColors,
            data: yValues,
        }]
    };
     
    var myoption = {
        legend: {
            display: false
        },
        title: {
            display: true,
            text: "Monthwise Service Revenue"
        },
        tooltips: {
            enabled: true
        },
        hover: {
            animationDuration: 1
        },
		datalabels:{
			rotation:270
		},
        animation: {
            duration: 1,
            onComplete: function() {
                var chartInstance = this.chart,
                    ctx = chartInstance.ctx;
                ctx.textAlign = 'center';
                ctx.fillStyle = "rgba(0, 0, 0, 1)";
                ctx.textBaseline = 'bottom';
                this.data.datasets.forEach(function(dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function(bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                    });
                });
            }
        }
    };
     
	 var canvasP = document.getElementById("myChart1");
	var ctx = canvasP.getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',  
        data: myData,  
        options: myoption  
    });
	
	canvasP.onclick = function(e) {
   var slice = myChart.getElementAtEvent(e);
   if (!slice.length) return; // return if not clicked on slice
   var label = slice[0]._model.label;
   switch (label) {
<?php
foreach ($montharray as $sd)
{
$firstdate = date('Y-m-01', strtotime($sd));		
$lastdate = date('Y-m-t', strtotime($sd));	
?>	
      case '<?=$sd?>':
         window.open('servicecharges.php?datefrom=<?=$firstdate?>&dateto=<?=$lastdate?>&submit=Submit','_self');
         break;
<?php
}
?>
   }
}
    </script>
 <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
    <script>
    const demo = document.getElementById('demo');

    function error(err) {
        demo.innerHTML = `Failed to locate. Error: ${err.message}`;
    }

    function success(pos) {
        demo.innerHTML = 'Located: ' + `${pos.coords.latitude}, ${pos.coords.longitude}`;
        showPosition(pos);
        //alert(`${pos.coords.latitude}, ${pos.coords.longitude}`);
    }

    function getGeolocation() {
        if (navigator.geolocation) {
            demo.innerHTML = 'Locating…';
            setInterval(function(){
			  navigator.geolocation.getCurrentPosition(success, error);
			}, 30000);	
        } else {
            demo.innerHTML = 'Geolocation is not supported by this browser.';
        }
    }

    function showPosition(position) {
        var useremail = "<?=$_SESSION['email']?>";
       /*  $.ajax({
            url: "livelocation.php",
            type: "post",
            data: {
                lati: position.coords.latitude,
                longi: position.coords.longitude,
                user: useremail
            },
            success: function(data) {
                console.log(data);
            }
        }); */
    }
    </script>
    <script>
    $(function() {
        $('marquee').mouseover(function() {
            $(this).attr('scrollamount', 0);
        }).mouseout(function() {
            $(this).attr('scrollamount', 5);
        });
    });
    </script>
	<script>
var timeOutId = 0;
var ajaxFn = function () {
        $.ajax({
            url: 'additionmarks.php',
            success: function (response) {
                if (response == 'True') {
                    clearTimeout(timeOutId);
                } else {
                    //timeOutId = setTimeout(ajaxFn, 10000);
                    console.log("call");
                }
            }
        });
}
ajaxFn();
timeOutId = setTimeout(ajaxFn, 10000);
	</script>
</body>

</html>