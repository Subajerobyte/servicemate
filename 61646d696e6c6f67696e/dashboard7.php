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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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

    .mybox:after 
	{
        content: '';
        position: absolute;
        right: 0px;
        top: 25%;
        height: 50%;
        border-right: 2px solid #ffffff;
    }

    .card 
	{
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
		  $jerobytecolors[$ad]='#3d8eb9';
		  ?>
                    <div class="row">
					<div class="col-xl-4 col-md-4 text-primary" style="font-weight:bold">
					Average TAT: <span id="tat">0</span> Hours
					</div>
                        <div class="col-xl-8 col-md-8 mb-2">
                            <form method="post">
							<div class="row">
							   <div class="col-lg-4 mb-1">
                                <div class="form-group row" style="margin-bottom: 0rem;">
                                    <label for="dashfromdate" class="col-sm-2 col-form-label">From &nbsp; &nbsp;</label>
									<div class="col-sm-10">
                                    <input type="date" class="form-control" id="dashfromdate" name="dashfromdate" value="<?=$dashfromdate?>" required>
									</div>	
                                </div>
								</div>
								<div class="col-lg-4 mb-1">
                                <div class="form-group row" style="margin-bottom: 0rem;">
                                    <label for="dashtodate" class="col-sm-2 col-form-label">To &nbsp; &nbsp;</label>
									<div class="col-sm-10">
                                    <input type="date" class="form-control" id="dashtodate" name="dashtodate" value="<?=$dashtodate?>" required>
									</div>	
                                </div>
								</div>
								<div class="col-lg-4">
								<div class="form-group row" style="margin-bottom: 0rem;">
								<div class="col-sm-6 mb-1">
                                <button type="submit" name="submit" class="btn btn-success btn-block">GET INFO</button>
								</div>
								<div class="col-sm-6 mb-1">
								<a href="dashboard.php" class="btn btn-primary btn-block">RESET</a>
								</div>
								</div>
								</div>
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
				  
				  /*i*/
				  
				  $itotalcalls=0;
				  $itotalopen=0;
				  $itotalpending=0;
				  $itotalcomplete=0;
				  				  
				  $itotalwcalls=0;
				  $itotalwopen=0;
				  $itotalwpending=0;
				  $itotalwcomplete=0;
				  
				  $itotalacalls=0;
				  $itotalaopen=0;
				  $itotalapending=0;
				  $itotalacomplete=0;
				  
				  $itotalocalls=0;
				  $itotaloopen=0;
				  $itotalopending=0;
				  $itotalocomplete=0;
				  
				  $itotalomcalls=0;
				  $itotalomopen=0;
				  $itotalompending=0;
				  $itotalomcomplete=0;
				  
				  $itodaycalls=0;
				  $itodayopen=0;
				  $itodaypending=0;
				  $itodaycomplete=0;
				  
				  $itotaltodaycalls=0;
				  $itotaltodayopen=0;
				  $itotaltodaypending=0;
				  $itotaltodaycomplete=0;
				  
				  $itodaywcalls=0;
				  $itodaywopen=0;
				  $itodaywpending=0;
				  $itodaywcomplete=0;
				  
				  $itodayacalls=0;
				  $itodayaopen=0;
				  $itodayapending=0;
				  $itodayacomplete=0;
				  
				  $itodayocalls=0;
				  $itodayoopen=0;
				  $itodayopending=0;
				  $itodayocomplete=0;
				  				  
				  $itotaltodayacalls=0;
				  $itotaltodayaopen=0;
				  $itotaltodayapending=0;
				  $itotaltodayacomplete=0;
				  
				  $itotaltodayocalls=0;
				  $itotaltodayoopen=0;
				  $itotaltodayopending=0;
				  $itotaltodayocomplete=0;
				  
				  $itodayomcalls=0;
				  $itodayomopen=0;
				  $itodayompending=0;
				  $itodayomcomplete=0;
				  				  
				  $ioldcalls=0;
				  $ioldopen=0;
				  $ioldpending=0;
				  $ioldcomplete=0;
				  
				  $ioldwcalls=0;
				  $ioldwopen=0;
				  $ioldwpending=0;
				  $ioldwcomplete=0;
				  
				  $ioldacalls=0;
				  $ioldaopen=0;
				  $ioldapending=0;
				  $ioldacomplete=0;
				  
				  $ioldocalls=0;
				  $ioldoopen=0;
				  $ioldopending=0;
				  $ioldocomplete=0;
				  
				  $ioldomcalls=0;
				  $ioldomopen=0;
				  $ioldompending=0;
				  $ioldomcomplete=0;	
				  
				  /*o*/
				  
				  $ototalcalls=0;
				  $ototalopen=0;
				  $ototalpending=0;
				  $ototalcomplete=0;
				  				  
				  $ototalwcalls=0;
				  $ototalwopen=0;
				  $ototalwpending=0;
				  $ototalwcomplete=0;
				  
				  $ototalacalls=0;
				  $ototalaopen=0;
				  $ototalapending=0;
				  $ototalacomplete=0;
				  
				  $ototalocalls=0;
				  $ototaloopen=0;
				  $ototalopending=0;
				  $ototalocomplete=0;
				  
				  $ototalomcalls=0;
				  $ototalomopen=0;
				  $ototalompending=0;
				  $ototalomcomplete=0;
				  
				  $otodaycalls=0;
				  $otodayopen=0;
				  $otodaypending=0;
				  $otodaycomplete=0;
				  
				  $ototaltodaycalls=0;
				  $ototaltodayopen=0;
				  $ototaltodaypending=0;
				  $ototaltodaycomplete=0;
				  
				  $otodaywcalls=0;
				  $otodaywopen=0;
				  $otodaywpending=0;
				  $otodaywcomplete=0;
				  
				  $otodayacalls=0;
				  $otodayaopen=0;
				  $otodayapending=0;
				  $otodayacomplete=0;
				  
				  $otodayocalls=0;
				  $otodayoopen=0;
				  $otodayopending=0;
				  $otodayocomplete=0;
				  				  
				  $ototaltodayacalls=0;
				  $ototaltodayaopen=0;
				  $ototaltodayapending=0;
				  $ototaltodayacomplete=0;
				  
				  $ototaltodayocalls=0;
				  $ototaltodayoopen=0;
				  $ototaltodayopending=0;
				  $ototaltodayocomplete=0;
				  
				  $otodayomcalls=0;
				  $otodayomopen=0;
				  $otodayompending=0;
				  $otodayomcomplete=0;
				  				  
				  $ooldcalls=0;
				  $ooldopen=0;
				  $ooldpending=0;
				  $ooldcomplete=0;
				  
				  $ooldwcalls=0;
				  $ooldwopen=0;
				  $ooldwpending=0;
				  $ooldwcomplete=0;
				  
				  $ooldacalls=0;
				  $ooldaopen=0;
				  $ooldapending=0;
				  $ooldacomplete=0;
				  
				  $ooldocalls=0;
				  $ooldoopen=0;
				  $ooldopending=0;
				  $ooldocomplete=0;
				  
				  $ooldomcalls=0;
				  $ooldomopen=0;
				  $ooldompending=0;
				  $ooldomcomplete=0;	
				  
		
		
		
		
		
		$count=1;
		$ccount=1;
		$totaltat=0;
				  
		$sqlcall = "SELECT calltype, compstatus, callon, changeon, servicetype From jrccalls ".$dashcallonsearch." order by id desc";
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
				if($rowcall['servicetype']=='Carry-In')
				{
					$itotalcalls++;
				}
				else
				{
					$ototalcalls++;
				}
				if($rowcall['calltype']=='Service Call')
				{
					$totalacalls++;
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalacalls++;
					}
					else
					{
						$ototalacalls++;
					}
				}
				if($rowcall['calltype']=='Other Call')
				{
					$totalocalls++;
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalocalls++;
					}
					else
					{
						$ototalocalls++;
					}
				}
				
				
				
				if($rowcall['compstatus']=='0')
				{
					$totalopen++;
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalopen++;
					}
					else
					{
						$ototalopen++;
					}
					if($rowcall['calltype']=='Service Call')
					{
						$totalaopen++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotalaopen++;
						}
						else
						{
							$ototalaopen++;
						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$totaloopen++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotaloopen++;
						}
						else
						{
							$ototaloopen++;
						}
					}
					
				}
				if($rowcall['compstatus']=='1')
				{
					$totalpending++;
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalpending++;
					}
					else
					{
						$ototalpending++;
					}
					if($rowcall['calltype']=='Service Call')
					{
						$totalapending++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotalapending++;
						}
						else
						{
							$ototalapending++;
						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$totalopending++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotalopending++;
						}
						else
						{
							$ototalopending++;
						}
					}
					
				}
				if($rowcall['compstatus']=='2')
				{
					$totalcomplete++;
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalcomplete++;
					}
					else
					{
						$ototalcomplete++;
					}
					if($rowcall['calltype']=='Service Call')
					{
						$totalacomplete++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotalacomplete++;
						}
						else
						{
							$ototalacomplete++;
						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$totalocomplete++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotalocomplete++;
						}
						else
						{
							$ototalocomplete++;
						}
					}
					
				}
				if(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))
				{
					$todaycalls++;
					if($rowcall['servicetype']=='Carry-In')
					{
						$itodaycalls++;
					}
					else
					{
						$otodaycalls++;
					}					
					
					if($rowcall['calltype']=='Service Call')
					{
						$todayacalls++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itodayacalls++;
						}
						else
						{
							$otodayacalls++;
						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$todayocalls++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itodayocalls++;
						}
						else
						{
							$otodayocalls++;
						}
					}
					if($rowcall['compstatus']=='0')
					{
						$todayopen++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itodayopen++;
						}
						else
						{
							$otodayopen++;
						}
						
						if($rowcall['calltype']=='Service Call')
						{
							$todayaopen++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayaopen++;
							}
							else
							{
								$otodayaopen++;
							}
						}
						if($rowcall['calltype']=='Other Call')
						{
							$todayoopen++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayoopen++;
							}
							else
							{
								$otodayoopen++;
							}
						}
					}					
				}
				if(date('Y-m-d')!=date('Y-m-d',strtotime($rowcall['callon'])))
				{
					$oldcalls++;
					if($rowcall['calltype']=='Service Call')
					{
						$oldacalls++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$ioldacalls++;
						}
						else
						{
							$ooldacalls++;
						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$oldocalls++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$ioldocalls++;
						}
						else
						{
							$ooldocalls++;
						}
					}
					if($rowcall['compstatus']=='0')
					{
						$oldopen++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$ioldopen++;
						}
						else
						{
							$ooldopen++;
						}
						if($rowcall['calltype']=='Service Call')
						{
							$oldaopen++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldaopen++;
							}
							else
							{
								$ooldaopen++;
							}
						}
						if($rowcall['calltype']=='Other Call') 
						{
							$oldoopen++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldoopen++;
							}
							else
							{
								$ooldoopen++;
							}
						}
					}					
				}
				if((date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))&&(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					if($rowcall['compstatus']=='2')
					{
						$totaltodaycomplete++;
						$todaycomplete++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotaltodaycomplete++;
							$itodaycomplete++;
						}
						else
						{
							$ototaltodaycomplete++;
							$otodaycomplete++;
						}
						
						if($rowcall['calltype']=='Service Call')
						{
							$todayacomplete++;
							$totaltodayacomplete++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayacomplete++;
								$itotaltodayacomplete++;
							}
							else
							{
								$otodayacomplete++;
								$ototaltodayacomplete++;
							}
						}
						if($rowcall['calltype']=='Other Call')
						{
							$todayocomplete++;
							$totaltodayocomplete++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayocomplete++;
								$itotaltodayocomplete++;
							}
							else
							{
								$otodayocomplete++;
								$ototaltodayocomplete++;
							}
						}
					}					
				}
				if((date('Y-m-d')!=date('Y-m-d',strtotime($rowcall['callon'])))&&(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					
					if($rowcall['compstatus']=='2')
					{
						$totaltodaycomplete++;
						$oldcomplete++;
						
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotaltodaycomplete++;
							$ioldcomplete++;
						}
						else
						{
							$ototaltodaycomplete++;
							$ooldcomplete++;
						}
						
						if($rowcall['calltype']=='Service Call')
						{
							$oldacomplete++;
							$totaltodayacomplete++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldacomplete++;
								$itotaltodayacomplete++;
							}
							else
							{
								$ooldacomplete++;
								$ototaltodayacomplete++;
							}
						}
						if($rowcall['calltype']=='Other Call')
						{
							$oldocomplete++;
							$totaltodayocomplete++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldocomplete++;
								$itotaltodayocomplete++;
							}
							else
							{
								$ooldocomplete++;
								$ototaltodayocomplete++;
							}
						}
					}
					
				}
				
				if((date('Y-m-d')==date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					if($rowcall['compstatus']=='1')
					{
						$totaltodaypending++;
						$todaypending++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotaltodaypending++;
							$itodaypending++;
						}
						else
						{
							$ototaltodaypending++;
							$otodaypending++;
						}
						if($rowcall['calltype']=='Service Call')
						{
							$todayapending++;
							$totaltodayapending++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayapending++;
								$itotaltodayapending++;
							}
							else
							{
								$otodayapending++;
								$ototaltodayapending++;
							}
						}
						if($rowcall['calltype']=='Other Call')
						{
							$todayopending++;
							$totaltodayopending++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayopending++;
								$itotaltodayopending++;
							}
							else
							{
								$otodayopending++;
								$ototaltodayopending++;
							}
						}
					}
									
				}
				if((date('Y-m-d')!=date('Y-m-d',strtotime($rowcall['changeon']))))
				{
					if($rowcall['compstatus']=='1')
					{
						$totaltodaypending++;
						$oldpending++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotaltodaypending++;
							$ioldpending++;
						}
						else
						{
							$ototaltodaypending++;
							$ooldpending++;
						}
						if($rowcall['calltype']=='Service Call')
						{
							$oldapending++;
							$totaltodayapending++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldapending++;
								$itotaltodayapending++;
							}
							else
							{
								$ooldapending++;
								$ototaltodayapending++;
							}
						}
						if($rowcall['calltype']=='Other Call')
						{
							$oldopending++;
							$totaltodayopending++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldopending++;
								$itotaltodayopending++;
							}
							else
							{
								$ooldopending++;
								$ototaltodayopending++;
							}
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
				<a href="calls.php?status=0"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Received & <br>Assigned Calls</span></a>
                  <?php
											if(isset($_POST['submit']))
											{
												?><h3><?=$totalcalls?></h3>
                                                <span style="font-size:1.1em;">SC : <?=$totalacalls?> | OC :
                                                    <?=$totalocalls?><br></span>
												<?php
											}
											else
											{
												?>
                                               <h3><?=$todaycalls?></h3>
                                                <span style="font-size:1.1em;">SC : <?=$todayacalls?> | OC :
                                                    <?=$todayocalls?><br></span>
													<br><br>
													<h6 class="text-primary mb-0" style="text-decoration:underline">Carry-In</h6>
													<span style="font-size:1em;">SC : <?=$itodayacalls?> | OC :
                                                    <?=$itodayocalls?><br></span>
													<h6 class="text-primary mt-1 mb-0" style="text-decoration:underline">On-Site</h6>
													<span style="font-size:1em;">SC : <?=$otodayacalls?> | OC :
                                                    <?=$otodayocalls?><br></span>
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
                  <a href="calls.php?status=0"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Open Calls</span></a>
				  
				   <h3><?=$totalopen?></h3>
				   <span style="font-size:1.1em;">SC : <?=$totalaopen?> | OC : <?=$totaloopen?></span><br>					
					<span style="font-size:0.8em;">( Today - SC : <?=$todayaopen?> | OC : <?=$todayoopen?> )</span><br>
					<span style="font-size:0.8em;">( Old - SC : <?=$oldaopen?> | OC : <?=$oldoopen?> )</span><br>
					
					
					<h6 class="text-primary mt-3 mb-1" style="text-decoration:underline">Carry-In</h6>
					 <span style="font-size:1em;">SC : <?=$itotalaopen?> | OC : <?=$itotaloopen?></span><br>
					<span style="font-size:0.9em;">( Today - SC : <?=$itodayaopen?> | OC : <?=$itodayoopen?> )</span><br>
					<span style="font-size:0.9em;">( Old - SC : <?=$ioldaopen?> | OC : <?=$ioldoopen?> )</span><br>
					<h6 class="text-primary mt-3 mb-1" style="text-decoration:underline">On-Site</h6> 
					<span style="font-size:1em;">SC : <?=$ototalaopen?> | OC : <?=$ototaloopen?></span><br>
					<span style="font-size:0.9em;">( Today - SC : <?=$otodayaopen?> | OC : <?=$otodayoopen?> )</span><br>
					<span style="font-size:0.9em;">( Old - SC : <?=$ooldaopen?> | OC : <?=$ooldoopen?> )</span><br>
					
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
                  <a href="calls.php?status=1"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Pending Calls</span></a>
				  <h3><?=$totaltodaypending?></h3>
                  <span style="font-size:1.1em;">SC : <?=$totaltodayapending?> | OC : <?=$totaltodayopending?></span> <br> 
                                            
					<span style="font-size:0.8em;">(Today - SC : <?=$todayapending?> | OC : <?=$todayopending?> )</span><br>
					<span style="font-size:0.8em;">(Old - SC : <?=$oldapending?> | OC : <?=$oldopending?> )</span>
					
					<h6 class="text-primary mt-3 mb-1" style="text-decoration:underline">Carry-In</h6> 
					<span style="font-size:1em;">SC : <?=$itotaltodayapending?> | OC : <?=$itotaltodayopending?></span> <br> 
					<span style="font-size:0.9em;">(Today - SC : <?=$itodayapending?> | OC : <?=$itodayopending?> )</span><br>
					<span style="font-size:0.9em;">(Old - SC : <?=$ioldapending?> | OC : <?=$ioldopending?> )</span>
					
					
					<h6 class="text-primary mt-3 mb-1" style="text-decoration:underline">On-Site</h6> 
					<span style="font-size:1em;">SC : <?=$ototaltodayapending?> | OC : <?=$ototaltodayopending?></span> <br> 
					<span style="font-size:0.9em;">(Today - SC : <?=$otodayapending?> | OC : <?=$otodayopending?> )</span><br>
					<span style="font-size:0.9em;">(Old - SC : <?=$ooldapending?> | OC : <?=$ooldopending?> )</span>
					
				  
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
                   <a href="calls.php?status=2"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Completed Calls</span></a>
				
				   
											   <?php
											if(isset($_POST['submit']))
											{
												?>	
												 <h3><?=$totalcomplete?></h3>
                                                <span style="font-size:1.1em;">SC : <?=$totalacomplete?> | OC : <?=$totalocomplete?></span>
                                          	<?php
											}
											else
											{
												?> <h3><?=$totaltodaycomplete?></h3>
                                            <span style="font-size:1.1em;">SC : <?=$totaltodayacomplete?> | OC : <?=$totaltodayocomplete?></span><br>
                                            
											<span style="font-size:0.8em;">(Today Rec - SC : <?=$todayacomplete?> | OC : <?=$todayocomplete?> )</span><br>
											<span style="font-size:0.8em;">(Old Rec - SC : <?=$oldacomplete?> | OC : <?=$oldocomplete?> )</span><br>
												
												
												<h6 class="text-primary mt-3 mb-1" style="text-decoration:underline">Carry-In</h6> 
											<span style="font-size:1em;">SC : <?=$itotaltodayacomplete?> | OC : <?=$itotaltodayocomplete?></span><br>
											<span style="font-size:0.8em;">(Today Rec - SC : <?=$itodayacomplete?> | OC : <?=$itodayocomplete?> )</span><br>
											<span style="font-size:0.8em;">(Old Rec - SC : <?=$ioldacomplete?> | OC : <?=$ioldocomplete?> )</span><br>
											
											<h6 class="text-primary mt-3 mb-1" style="text-decoration:underline">On-Site</h6> 
											<span style="font-size:1em;">SC : <?=$ototaltodayacomplete?> | OC : <?=$ototaltodayocomplete?></span><br>
											<span style="font-size:0.8em;">(Today Rec - SC : <?=$otodayacomplete?> | OC : <?=$otodayocomplete?> )</span><br>
											<span style="font-size:0.8em;">(Old Rec - SC : <?=$ooldacomplete?> | OC : <?=$ooldocomplete?> )</span><br>
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
						
							
		 <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-phone fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
				<a href="callstatus.php?dashfromdate=<?=$dashfromdate?>&dashtodate=<?=$dashtodate?>&submit=submit"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Opening Status</span></a>

                                               <h3>Open : <?=$originaloldbalance?> <br> Pending :
                                                    <?=$originaloldpendingbalance?></h3><br>
                                                <span style="font-size:1em;">( on <?=date('d/m/Y',strtotime($dashfromdate))?> )</span>
                  
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
                  <a href="callstatus.php?dashfromdate=<?=$dashfromdate?>&dashtodate=<?=$dashtodate?>&submit=submit"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">During Period</span></a>
				  
				   <h3>Received : <?=$sumtodaycalls?><br> Pending : <?=$sumtodaypending?></h3>
					<span style="font-size:1em;">(<?=date('d/m/Y',strtotime($dashfromdate))?> - <?=date('d/m/Y',strtotime($dashtodate))?>)</span><br>
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
                  <a href="callstatus.php?dashfromdate=<?=$dashfromdate?>&dashtodate=<?=$dashtodate?>&submit=submit"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Completed Calls</span></a>
				  <h3><?=$sumtodaycompleted?></h3>
                    <span style="font-size:1em;">( 
                    From Old Open - <?=$sumtodayveryoldcompleted?><br>
					From New Open - <?=($sumtodayoldcompleted+$sumtodaynewcompleted)-$sumtodayveryoldcompleted?><br>
					From Old Pending - <?=$sumtodayveryoldpending?><br>
					From New Pending - <?=$sumtodaypendingcompleted-$sumtodayveryoldpending?><br></span>
				  
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
                   <a href="callstatus.php?dashfromdate=<?=$dashfromdate?>&dashtodate=<?=$dashtodate?>&submit=submit"><span  class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Closing Status</span></a>
				<h3>Open : <?=$oldbalance?> <br> Pending : <?=$oldpendingbalance?></h3>
				   <br>
											   <span style="font-size:1em;">( As on <?=date('d/m/Y',strtotime($dashtodate))?> )</span><br>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
                  <i class="fas fa-redo fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center"><br>
				<a href="amccustomers.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">AMC Customers</span></a>
                  <h3><?=count($a)?></h3>
                  <span style="font-size:1em;">Products : <?=$totalamc?><br></span><br>
                  
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
                  <i class="fas fa-car-battery fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center"><br>
				<a href="warrantycustomers.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:0.95rem; line-height:1; text-decoration:underline;">Warranty Customers</span></a>
                  <h3><?=count($a)?></h3>
                  <span style="font-size:1em;">Products : <?=$totalwarranty?><br></span><br>
                  
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
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-history fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="alertamcmaintenance.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">AMC <br>Maintanence</span></a>
                  <h3><?=$amcmaintenance?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
						
		<div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-handshake fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="alertpreventive.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Warranty <br>Maintanence</span></a>
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
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-pause-circle fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="wcalls.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Waiting for <br>Approval</span></a>
                  <h3><?=$wcount?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-hourglass-end fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="alertamcexpire.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">AMC <br>Expiry</span></a>
                  <h3><?=$amcexpire?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-battery-empty  fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="alertwarrantyexpire.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Warranty <br>Expiry</span></a>
                  <h3><?=$warrantyexpire?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  <div class="col-xl-2 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-clock  fa-2x float-left" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="ocalls.php"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline;">Observation <br>Calls</span></a>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Monthwise Service Revenue <span
                                            class="text-primary float-right">( To be Collected: Rs. <span
                                                id="tobecollected"></span> )</span></h6>
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
                                <small class="btn btn-sm float-right" style="<?=($hourdiff<=0)?'background-color:#f23535; color:#ffffff':''?>"><i
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
    
    <script src="../../1637028036/vendor/chart.js/3.8/chart.js"></script>
	
    <script type="text/javascript" src="../../1637028036/vendor/chart.js/3.8/datalabels.js"></script>
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
 $sqli=mysqli_query($connection, "select sum(scharge) as scharge, schargedate, cashstatus from jrccalldetails where srno!='' and scharge!='' and scharge!='0' and scharge!='0.00' and incgst!='2' and (schargedate > now() - INTERVAL 7 MONTH) ".$dashschargesearch." group by schargedate, cashstatus order by cast(schargedate as date) asc");
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
                backgroundColor: "rgba(61, 142, 185,1.0)",
                borderColor: "rgba(61, 142, 185,0.1)",
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
    // setup 
    const data = {
      labels: [<?php foreach ($montharray as $sd){ echo "'".$sd."',";}?>],
      datasets: [{
        label: 'Total Amount',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result1[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
		backgroundColor: ['rgba(61, 142, 185, 0.8)'],
        borderColor: ['rgba(61, 142, 185, 0.8)'],
        borderWidth: 1
      }, {
        label: 'Collected',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result2[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
        backgroundColor: ['rgba(28, 200, 138, 0.8)'],
        borderColor: ['rgba(28, 200, 138, 0.8)'],
        borderWidth: 1
      }, {
        label: 'To be Collected',
        data: [
		<?php 
	$i=0;
	$tob=0;
	foreach ($montharray as $sd)
	{
		echo ((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]).','; 
		$tob+=((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]);
		$i++;
	}
	
	?>],
        backgroundColor: ['rgba(0, 0, 0, 0.2)'],
        borderColor: ['rgba(0, 0, 0, 0.2)'],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
		  x: {
			  stacked: false
		  },
          y: {
            beginAtZero: true,
			stacked: false
          }
        },
		plugins: {
			datalabels:{
				rotation:270,
			}
		},
      },
	  plugins: [ChartDataLabels]
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart1'),
      config
    );
	document.getElementById("tobecollected").innerHTML="<?=$tob?>";
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
//timeOutId = setTimeout(ajaxFn, 10000);
	</script>
</body>

</html>