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
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
	<style>
		  .plancentered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background:rgba(255, 255, 255, 0.6);
  color:#6e707e;
  font-size:20px;
  line-height:1.5;
  text-align:center;
  padding:15%;
}
.plancenteredlg {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background:rgba(255, 255, 255, 0.6);
  color:#6e707e;
  font-size:20px;
  line-height:1.5;
  text-align:center;
  padding:15% 28%;
}
		  </style>
		  <style>

@keyframes marquee {
  0% {
    transform: translate(0, 0)
  }
  100% {
    transform: translate(-100%, 0)
  }
}
		  </style>
		  
		  
		  <!--start new Css-->
		  <style>
			.cardb{
			border: 2.5px solid <?=$_SESSION['bgcolor']?>!important;
			}
			.border-info1
{
	border-left: 3px solid #0078d7!important;
}
.border-info2
{
	border-left: 3px solid #0063b1!important;
}
.border-danger1
{
	border-left: 3px solid #da3b01!important;
}
.border-danger2
{
	border-left: 3px solid #ef6950!important;
}
.border-success1
{
	border-left: 3px solid #00cc6a!important;
}
.border-success2
{
	border-left: 3px solid #10893e!important;
}
.border-warning1
{
	border-left: 3px solid #ffb900!important;
}

.border-warning2
{
	border-left: 3px solid #ff8c00!important;
}
.border-express1
{
	border-left: 3px solid #b146c2!important;
}
.border-express2
{
	border-left: 3px solid #881798!important;
}
.border-green1
{
	border-left: 3px solid #00b7c3!important;
}
.border-green2
{
	border-left: 3px solid #038387!important;
}
.border-pink1
{
	border-left: 3px solid #e3008c!important;
}
.border-pink2
{
	border-left: 3px solid #bf0077!important;
}
.border-grey1
{
	border-left: 3px solid #68768a!important;
}
.border-grey2
{
	border-left: 3px solid #515c6b!important;
}

.border-color1
{
	border: 2px solid #6cdade!important;
	border-radius : 15px;
}.border-color2
{
	border: 2px solid #eda0cf!important;
		border-radius : 15px;
}.border-color3
{
	border: 2px solid #b590e1!important;
		border-radius : 15px;
}.border-color4
{
	border: 2px solid #aeeba3!important;
		border-radius : 15px;
}.border-color5
{
	border: 2px solid #a2cef1!important;
		border-radius : 15px;
}.border-color6
{
	border: 2px solid #f59f9f!important;
		border-radius : 15px;
}

.text-info1 {
    color: #0078d7!important;
}
.text-info2 {
    color: #0063b1!important;
}
.text-warning1 {
    color: #ffb900!important;
}
.text-warning2 {
    color: #ff8c00!important;
}
.text-success1 {
    color: #00cc6a!important;
}
.text-success2 {
    color: #10893e!important;
}
.text-express1 {
    color: #b146c2!important;
}
.text-express2 {
    color: #881798!important;
}
.text-danger1 {
    color: #da3b01!important;
}
.text-danger2 {
    color: #ef6950!important;
}
.text-violet1 {
    color: #8764b8!important;
}
.text-violet2 {
    color: #744da9!important;
}
.text-pink1 {
    color: #e3008c!important;
}
.text-pink2 {
    color: #bf0077!important;
}
.text-grey1 {
    color: #68768a!important;
}
.text-gery2 {
    color: #515c6b!important;
}
.text-green1 {
    color: #00b7c3!important;
}
.text-green2 {
    color: #038387!important;
}
.text-secondary {
    color: #6c757d!important;
}
.text-dark {
    color: #000000!important;
}

.text-darkgrey {
    color: #23526b!important;
}
.text-white {
    color: #fff!important;
}

      .tooltip1 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
	  .tooltip2 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
	  .tooltip3 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
	  .tooltip4 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
      }
	  .tooltip5 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
	  .tooltip6 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      } .tooltip7 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
	  .tooltip8 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
	  .tooltip9 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
	  .tooltip10 {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }
		  </style>
		  <!--end new Css-->
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
			   $reportrange=mysqli_real_escape_string($connection, $_POST['reportrange']);

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
				
			 $dashfromdate=mysqli_real_escape_string($connection, $dashfromdate);
						$dashtodate=mysqli_real_escape_string($connection, $dashtodate);
					$dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch1=' and datefrom between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
		  }
		  else
		  {
			  $dashfromdate='';
			  $dashtodate='';
			  $dashcallonsearch='';
			  $dashschargesearch='';
			  $dashschargesearch1='';
		  }
		  $ad=1;
		  $jerobytecolors[$ad]='#3d8eb9';
		  ?>
                    <div class="row mt-3">
					<div class="col-xl-6 col-md-6 text-primary" style="font-weight:bold">
					PLAN:<?php
					if($liveplan=='DIAMOND')
					{
						echo '<span style="background-color:#D7D7D7; color:#000000; padding:5px; border-radius:5px;">'.$liveplan.'</span>';
					}
					if($liveplan=='GOLD')
					{
						echo '<span style="background-color:#AF9500; color:#FFFFFF; padding:5px; border-radius:5px;">'.$liveplan.'</span>';
					}
					if($liveplan=='SILVER')
					{
						echo '<span style="background-color:#B4B4B4; color:#000000; padding:5px; border-radius:5px;">'.$liveplan.'</span>';
					}
					?><BR>
					Average TAT: <span id="tat">0</span> Hours
					</div>
                        <div class="col-xl-6 col-md-6 ">
                            <form method="post">
							<div class="row">
							<div class="col-lg-6 col-6">
                                <div class="form-group row" style="margin-bottom: 0rem;">
                                   <div class="col-sm-12">
                                    <input type="text"  id="reportrange"  name="reportrange" class="form-control"/>
									</div>	
                                </div>
								</div>
							
								<div class="col-lg-6 col-6">
								<div class="form-group row mb-2">
								<div class="col-sm-6 mb-1 col-7">
                                <button type="submit" name="submit" class="btn btn-success btn-block">GET INFO</button>
								</div>
								<div class="col-sm-6 mb-1 col-5">
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
				  $totalassigned=0;
				  $totalopen=0;
				  $totalpending=0;
				  $totalcomplete=0;
				  $totalcancel=0;
				  				  
				  $totalwcalls=0;
				  $totalwassigned=0;
				  $totalwopen=0;
				  $totalwpending=0;
				  $totalwcomplete=0;
				  $totalwcancel=0;
				  
				  $totalacalls=0;
				  $totalaassigned=0;
				  $totalaopen=0;
				  $totalapending=0;
				  $totalacomplete=0;
				  $totalacancel=0;
				  
				  $totalocalls=0;
				  $totaloassigned=0;
				  $totaloopen=0;
				  $totalopending=0;
				  $totalocomplete=0;
				  $totalocancel=0;
				  
				  $totalomcalls=0;
				  $totalomassigned=0;
				  $totalomopen=0;
				  $totalompending=0;
				  $totalomcomplete=0;
				  $totalomcancel=0;
				  
				  $todaycalls=0;
				  $todayassigned=0;
				  $todayopen=0;
				  $todaypending=0;
				  $todaycomplete=0;
				  $todaycancel=0;
				  
				  $totaltodaycalls=0;
				  $totaltodayassigned=0;
				  $totaltodayopen=0;
				  $totaltodaypending=0;
				  $totaltodaycomplete=0;
				  $totaltodaycancel=0;
				  
				  $todaywcalls=0;
				  $todaywassigned=0;
				  $todaywopen=0;
				  $todaywpending=0;
				  $todaywcomplete=0;
				  $todaywcancel=0;
				  
				  $todayacalls=0;
				  $todayaassigned=0;
				  $todayaopen=0;
				  $todayapending=0;
				  $todayacomplete=0;
				  $todayacancel=0;
				  
				  $todayocalls=0;
				  $todayoassigned=0;
				  $todayoopen=0;
				  $todayopending=0;
				  $todayocomplete=0;
				  $todayocancel=0;
				  				  
				  $totaltodayacalls=0;
				  $totaltodayaassigned=0;
				  $totaltodayaopen=0;
				  $totaltodayapending=0;
				  $totaltodayacomplete=0;
				  $totaltodayacancel=0;
				  
				  $totaltodayocalls=0;
				  $totaltodayoassigned=0;
				  $totaltodayoopen=0;
				  $totaltodayopending=0;
				  $totaltodayocomplete=0;
				  $totaltodayocancel=0;
				  
				  $todayomcalls=0;
				  $todayomassigned=0;
				  $todayomopen=0;
				  $todayompending=0;
				  $todayomcomplete=0;
				  $todayomcancel=0;
				  				  
				  $oldcalls=0;
				  $oldassigned=0;
				  $oldopen=0;
				  $oldpending=0;
				  $oldcomplete=0;
				  $oldcancel=0;
				  
				  $oldwcalls=0;
				  $oldwassigned=0;
				  $oldwopen=0;
				  $oldwpending=0;
				  $oldwcomplete=0;
				  $oldwcancel=0;
				  
				  $oldacalls=0;
				  $oldaassigned=0;
				  $oldaopen=0;
				  $oldapending=0;
				  $oldacomplete=0;
				  $oldacancel=0;
				  
				  $oldocalls=0;
				  $oldoassigned=0;
				  $oldoopen=0;
				  $oldopending=0;
				  $oldocomplete=0;
				  $oldocancel=0;
				  
				  $oldomcalls=0;
				  $oldomassigned=0;
				  $oldomopen=0;
				  $oldompending=0;
				  $oldomcomplete=0;	
				  $oldomcancel=0;	
				  
				  /*i*/
				  
				  $itotalcalls=0;
				  $itotalassigned=0;
				  $itotalopen=0;
				  $itotalpending=0;
				  $itotalcomplete=0;
				  $itotalcancel=0;
				  				  
				  $itotalwcalls=0;
				  $itotalwassigned=0;
				  $itotalwopen=0;
				  $itotalwpending=0;
				  $itotalwcomplete=0;
				  $itotalwcancel=0;
				  
				  $itotalacalls=0;
				  $itotalaassigned=0;
				  $itotalaopen=0;
				  $itotalapending=0;
				  $itotalacomplete=0;
				  $itotalacancel=0;
				  
				  $itotalocalls=0;
				  $itotaloassigned=0;
				  $itotaloopen=0;
				  $itotalopending=0;
				  $itotalocomplete=0;
				  $itotalocancel=0;
				  
				  $itotalomcalls=0;
				  $itotalomassigned=0;
				  $itotalomopen=0;
				  $itotalompending=0;
				  $itotalomcomplete=0;
				  $itotalomcancel=0;
				  
				  $itodaycalls=0;
				  $itodayassigned=0;
				  $itodayopen=0;
				  $itodaypending=0;
				  $itodaycomplete=0;
				  $itodaycancel=0;
				  
				  $itotaltodaycalls=0;
				  $itotaltodayassigned=0;
				  $itotaltodayopen=0;
				  $itotaltodaypending=0;
				  $itotaltodaycomplete=0;
				  $itotaltodaycancel=0;
				  
				  $itodaywcalls=0;
				  $itodaywassigned=0;
				  $itodaywopen=0;
				  $itodaywpending=0;
				  $itodaywcomplete=0;
				  $itodaywcancel=0;
				  
				  $itodayacalls=0;
				  $itodayaassigned=0;
				  $itodayaopen=0;
				  $itodayapending=0;
				  $itodayacomplete=0;
				  $itodayacancel=0;
				  
				  $itodayocalls=0;
				  $itodayoassigned=0;
				  $itodayoopen=0;
				  $itodayopending=0;
				  $itodayocomplete=0;
				  $itodayocancel=0;
				  				  
				  $itotaltodayacalls=0;
				  $itotaltodayaassigned=0;
				  $itotaltodayaopen=0;
				  $itotaltodayapending=0;
				  $itotaltodayacomplete=0;
				  $itotaltodayacancel=0;
				  
				  $itotaltodayocalls=0;
				  $itotaltodayoassigned=0;
				  $itotaltodayoopen=0;
				  $itotaltodayopending=0;
				  $itotaltodayocomplete=0;
				  $itotaltodayocancel=0;
				  
				  $itodayomcalls=0;
				  $itodayomassigned=0;
				  $itodayomopen=0;
				  $itodayompending=0;
				  $itodayomcomplete=0;
				  $itodayomcancel=0;
				  				  
				  $ioldcalls=0;
				  $ioldassigned=0;
				  $ioldopen=0;
				  $ioldpending=0;
				  $ioldcomplete=0;
				  $ioldcancel=0;
				  
				  $ioldwcalls=0;
				  $ioldwassigned=0;
				  $ioldwopen=0;
				  $ioldwpending=0;
				  $ioldwcomplete=0;
				  $ioldwcancel=0;
				  
				  $ioldacalls=0;
				  $ioldaassigned=0;
				  $ioldaopen=0;
				  $ioldapending=0;
				  $ioldacomplete=0;
				  $ioldacancel=0;
				  
				  $ioldocalls=0;
				  $ioldoassigned=0;
				  $ioldoopen=0;
				  $ioldopending=0;
				  $ioldocomplete=0;
				  $ioldocancel=0;
				  
				  $ioldomcalls=0;
				  $ioldomassigned=0;
				  $ioldomopen=0;
				  $ioldompending=0;
				  $ioldomcomplete=0;	
				  $ioldomcancel=0;	
				  
				  /*o*/
				  
				  $ototalcalls=0;
				  $ototalassigned=0;
				  $ototalopen=0;
				  $ototalpending=0;
				  $ototalcomplete=0;
				  $ototalcancel=0;
				  				  
				  $ototalwcalls=0;
				  $ototalwassigned=0;
				  $ototalwopen=0;
				  $ototalwpending=0;
				  $ototalwcomplete=0;
				  $ototalwcancel=0;
				  
				  $ototalacalls=0;
				  $ototalaassigned=0;
				  $ototalaopen=0;
				  $ototalapending=0;
				  $ototalacomplete=0;
				  $ototalacancel=0;
				  
				  $ototalocalls=0;
				  $ototaloassigned=0;
				  $ototaloopen=0;
				  $ototalopending=0;
				  $ototalocomplete=0;
				  $ototalocancel=0;
				  
				  $ototalomcalls=0;
				  $ototalomassigned=0;
				  $ototalomopen=0;
				  $ototalompending=0;
				  $ototalomcomplete=0;
				  $ototalomcancel=0;
				  
				  $otodaycalls=0;
				  $otodayassigned=0;
				  $otodayopen=0;
				  $otodaypending=0;
				  $otodaycomplete=0;
				  $otodaycancel=0;
				  
				  $ototaltodaycalls=0;
				  $ototaltodayassigned=0;
				  $ototaltodayopen=0;
				  $ototaltodaypending=0;
				  $ototaltodaycomplete=0;
				  $ototaltodaycancel=0;
				  
				  $otodaywcalls=0;
				  $otodaywassigned=0;
				  $otodaywopen=0;
				  $otodaywpending=0;
				  $otodaywcomplete=0;
				  $otodaywcancel=0;
				  
				  $otodayacalls=0;
				  $otodayaassigned=0;
				  $otodayaopen=0;
				  $otodayapending=0;
				  $otodayacomplete=0;
				  $otodayacancel=0;
				  
				  $otodayocalls=0;
				  $otodayoassigned=0;
				  $otodayoopen=0;
				  $otodayopending=0;
				  $otodayocomplete=0;
				  $otodayocancel=0;
				  				  
				  $ototaltodayacalls=0;
				  $ototaltodayaassigned=0;
				  $ototaltodayaopen=0;
				  $ototaltodayapending=0;
				  $ototaltodayacomplete=0;
				  $ototaltodayacancel=0;
				  
				  $ototaltodayocalls=0;
				  $ototaltodayoassigned=0;
				  $ototaltodayoopen=0;
				  $ototaltodayopending=0;
				  $ototaltodayocomplete=0;
				  $ototaltodayocancel=0;
				  
				  $otodayomcalls=0;
				  $otodayomassigned=0;
				  $otodayomopen=0;
				  $otodayompending=0;
				  $otodayomcomplete=0;
				  $otodayomcancel=0;
				  				  
				  $ooldcalls=0;
				  $ooldassigned=0;
				  $ooldopen=0;
				  $ooldpending=0;
				  $ooldcomplete=0;
				  $ooldcancel=0;
				  
				  $ooldwcalls=0;
				  $ooldwassigned=0;
				  $ooldwopen=0;
				  $ooldwpending=0;
				  $ooldwcomplete=0;
				  $ooldwcancel=0;
				  
				  $ooldacalls=0;
				  $ooldaassigned=0;
				  $ooldaopen=0;
				  $ooldapending=0;
				  $ooldacomplete=0;
				  $ooldacancel=0;
				  
				  $ooldocalls=0;
				  $ooldoassigned=0;
				  $ooldoopen=0;
				  $ooldopending=0;
				  $ooldocomplete=0;
				  $ooldocancel=0;
				  
				  $ooldomcalls=0;
				  $ooldomassigned=0;
				  $ooldomopen=0;
				  $ooldompending=0;
				  $ooldomcomplete=0;	
				  $ooldomcancel=0;	
				  
		
		
		
		
		
		$count=1;
		$ccount=1;
		$totaltat=0;
				  
		$sqlcall = "SELECT engineerid,engineersid,calltype, compstatus, callon, changeon, servicetype From jrccalls ".$dashcallonsearch." order by id desc";
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
				if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
				{
					$totalassigned++;
				}
				if($rowcall['servicetype']=='Carry-In')
				{
					$itotalcalls++;
					if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
					{
						$itotalassigned++;
					}
				}
				else
				{
					$ototalcalls++;
					if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
					{
						$ototalassigned++;
					}
				}
				if($rowcall['calltype']=='Service Call')
				{
					$totalacalls++;
					if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
					{
						$totalaassigned++;
					}
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalacalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$itotalaassigned++;
						}
					}
					else
					{
						$ototalacalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$ototalaassigned++;
						}
					}
				}
				if($rowcall['calltype']=='Other Call')
				{
					$totalocalls++;
					if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
					{
						$totaloassigned++;
					}
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalocalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$itotaloassigned++;
						}
					}
					else
					{
						$ototalocalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$ototaloassigned++;
						}
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
				if($rowcall['compstatus']=='3')
				{
					$totalcancel++;
					if($rowcall['servicetype']=='Carry-In')
					{
						$itotalcancel++;
					}
					else
					{
						$ototalcancel++;
					}
					if($rowcall['calltype']=='Service Call')
					{
						$totalacancel++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotalacancel++;
						}
						else
						{
							$ototalacancel++;
						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$totalocancel++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotalocancel++;
						}
						else
						{
							$ototalocancel++;
						}
					}
					
				}
				if(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))
				{
					$todaycalls++;
					if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
					{
						$todayassigned++;
					}
					if($rowcall['servicetype']=='Carry-In')
					{
						$itodaycalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$itodayassigned++;
						}
					}
					else
					{
						$otodaycalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$otodayassigned++;
						}

					}					
					
					if($rowcall['calltype']=='Service Call')
					{
						$todayacalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$todayaassigned++;
						}

						if($rowcall['servicetype']=='Carry-In')
						{
							$itodayacalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$itodayaassigned++;
							}

						}
						else
						{
							$otodayacalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$otodayaassigned++;
							}

						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$todayocalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$todayoassigned++;
						}

						if($rowcall['servicetype']=='Carry-In')
						{
							$itodayocalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$itodayoassigned++;
							}
						}
						else
						{
							$otodayocalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$todayoassigned++;
							}
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
					if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
					{
						$oldassigned++;
					}
					if($rowcall['calltype']=='Service Call')
					{
						$oldacalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$oldaassigned++;
						}
						if($rowcall['servicetype']=='Carry-In')
						{
							$ioldacalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$ioldaassigned++;
							}
							
						}
						else
						{
							$ooldacalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$ooldaassigned++;
							}
						}
					}
					if($rowcall['calltype']=='Other Call')
					{
						$oldocalls++;
						if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
						{
							$oldoassigned++;
						}
						if($rowcall['servicetype']=='Carry-In')
						{
							$ioldocalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$ioldoassigned++;
							}
						}
						else
						{
							$ooldocalls++;
							if(($rowcall['engineerid']!='')||($rowcall['engineersid']!=''))
							{
								$ooldoassigned++;
							}
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
				if($rowcall['compstatus']=='3')
					{
						$totaltodaycancel++;
						$todaycancel++;
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotaltodaycancel++;
							$itodaycancel++;
						}
						else
						{
							$ototaltodaycancel++;
							$otodaycancel++;
						}
						
						if($rowcall['calltype']=='Service Call')
						{
							$todayacancel++;
							$totaltodayacancel++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayacancel++;
								$itotaltodayacancel++;
							}
							else
							{
								$otodayacancel++;
								$ototaltodayacancel++;
							}
						}
						if($rowcall['calltype']=='Other Call')
						{
							$todayocancel++;
							$totaltodayocancel++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$itodayocancel++;
								$itotaltodayocancel++;
							}
							else
							{
								$otodayocancel++;
								$ototaltodayocancel++;
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
					
					if($rowcall['compstatus']=='3')
					{
						$totaltodaycancel++;
						$oldcancel++;
						
						if($rowcall['servicetype']=='Carry-In')
						{
							$itotaltodaycancel++;
							$ioldcancel++;
						}
						else
						{
							$ototaltodaycancel++;
							$ooldcancel++;
						}
						
						if($rowcall['calltype']=='Service Call')
						{
							$oldacancel++;
							$totaltodayacancel++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldacancel++;
								$itotaltodayacancel++;
							}
							else
							{
								$ooldacancel++;
								$ototaltodayacancel++;
							}
						}
						if($rowcall['calltype']=='Other Call')
						{
							$oldocancel++;
							$totaltodayocancel++;
							if($rowcall['servicetype']=='Carry-In')
							{
								$ioldocancel++;
								$itotaltodayocancel++;
							}
							else
							{
								$ooldocancel++;
								$ototaltodayocancel++;
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
		//(($liveplan=="GOLD")||($liveplan=="DIAMOND"))?'4':'6'
		?>
		<script>document.getElementById("tat").innerHTML=" <?=round($tat,2)?>";</script>
		
<div class="col-lg-5 mb-3">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Call Progress Statistics</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">
	
	   
	   
	   <!--start new one-->
	    <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
		
				
					<a href="calls.php?status=Received"><span  class="mb-0 text-dark"><b>Total Received Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-info1 text-center" style="font-size:1.5em;"><?=$totalcalls?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-info1 text-center" style="font-size:1.5em;"><?=$todaycalls?></h4>
				<?php } ?>
				
				
				<!--<div class="row">
				<div class="col-12 text-center">
				<?php $reconsite=$otodayacalls+$otodayocalls; ?>
				<span  class="mb-0 text-dark "><b>On-Site</b></span>-<span  class="mb-0 text-info1"><?=$reconsite?></span>
				</div>
				<div class="col-12 text-center">
				<?php $reccarryin=$itodayacalls+$itodayocalls; ?>
				<span  class="mb-0 text-dark "><b>Carry-In</b></span>-<span  class="mb-0 text-info1"><?=$reccarryin?></span>
				</div>
				</div>-->
				
				
				</div>
		<!--<div class="widgets-icons-info1 ms-auto" >
		<i class="bx bxs-phone-incoming"></i>
		</div>-->
	</div>
      </div>
  </div>
      <span class="tooltip1 callouts--top"> <?php  if(isset($_POST['submit']))
											{
												?> 
												<span style="font-size:1.1em;">SC : <?=$totalacalls?> <br> OC :
                                                    <?=$totalocalls?><br></span>
											<?php
											}
											else
											{
												?>
												<b><span style="font-size:1.1em;">SC : <?=$todayacalls?> <br> OC :
                                                    <?=$todayocalls?><br></span></b>
												<?php
												if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
												{
													?>												
												<br><div class="row">
												<div class="col-6">
													<h6 class="text-info1 mt-3 mb-1">Carry-In</h6>
													<span style="font-size:1em;">SC : <?=$itodayacalls?> <br> OC :
                                                    <?=$itodayocalls?><br></span></div>
													<div class="col-6">
													<h6 class="text-info1 mt-3 mb-1">On-Site</h6>
													<span style="font-size:1em;">SC : <?=$otodayacalls?> <br> OC :
                                                    <?=$otodayocalls?><br></span>
													</div>
													</div>
													<?php
												}
												?>
												<?php
											}
											?></span>
    
      </div>
	  
	  
	   <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv1">
				<div>
				<a href="calls.php?status=Assigned"><span  class="mb-0 text-dark"><b>Total Assigned Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-danger1 text-center" style="font-size:1.5em;"><?=$totalassigned?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-danger1 text-center" style="font-size:1.5em;"><?=$todayassigned?></h4>
				<?php } ?>
				
				<!--<div class="row">
				<div class="col-12 text-center">
				<?php $assignonsite=$otodayaassigned+$otodayoassigned; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-danger1"><?=$assignonsite?></span>
				</div>
				<div class="col-12 text-center">
				<?php $assigncarryin=$itodayaassigned+$itodayoassigned; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-danger1"><?=$assigncarryin?></span>
				</div>
				</div>-->
				
				</div>
				<!--<div class="widgets-icons-danger1 ms-auto">
		<i class="bx bxs-user-pin"></i>
		</div>-->
                 
            </div>
          </div>
        </div> 
      <span class="tooltip2 callouts--top"> <?php
											if(isset($_POST['submit']))
											{
												?>
													<b><span style="font-size:1.1em;">SC : <?=$totalaassigned?> <br> OC :
                                                    <?=$totaloassigned?><br></span></b>
												<?php
											}
											else
											{
												?>
												<b><span style="font-size:1.1em;">SC : <?=$todayaassigned?> <br> OC :
                                                    <?=$todayoassigned?><br></span></b>
												<?php
												if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
												{
													?>												
												<br>
													<div class="row"><div class="col-6"><h6 class="text-danger1 mt-3 mb-1">Carry-In</h6>
													<span style="font-size:1em;">SC : <?=$itodayaassigned?> <br> OC :
                                                    <?=$itodayoassigned?><br></span></div>
													<div class="col-6">
													<h6 class="text-danger1 mt-3 mb-1">On-Site</h6>
													<span style="font-size:1em;">SC : <?=$otodayaassigned?> <br> OC :
                                                    <?=$otodayoassigned?><br></span></div></div>
													<?php
												}
												?>
												<?php
											}
											?></span>
      </div>
	 
      <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-success1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv2">
			   <div>
                  <a href="calls.php?status=0"><span  class="mb-0 text-dark"><b>Total Open Calls</b></span></a>
				   <h4 class="my-1 text-success1 text-center" style="font-size:1.5em;"><?=$totalopen?></h4>
				<!--<div class="row">
				<div class="col-12 text-center">
				<?php $openonsite=$ototalaopen+$ototaloopen; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-success1"><?=$openonsite?></span>
				</div>
				<div class="col-12 text-center">
				<?php $opencarryin=$itotalaopen+$itotaloopen; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-success1"><?=$opencarryin?></span>
				</div>
				</div>-->
				   </div>
				   <!--<div class="widgets-icons-success1 ms-auto" >
		<i class="bx bxs-phone"></i>
		</div>-->
                                                
				   
            </div>
          </div>
        </div>
		 <span class="tooltip3 callouts--top">
		<b><span style="font-size:1.1em;">SC : <?=$totalaopen?> <br> OC : <?=$totaloopen?></span></b><br>			
					<div class="row"><div class="col-12 text-center"><span style="font-size:0.75em;"><b>Today</b> <br>SC : <?=$todayaopen?> <br> OC : <?=$todayoopen?> </span></div><br>
					<div class="col-12 text-center"><span style="font-size:0.75em;"> <b>Old</b> <br> SC : <?=$oldaopen?> <br> OC : <?=$oldoopen?> </span></div></div><br>
					
					<?php
												if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
												{
													?>
					<div class="row"><div class="col-6"><h6 class="text-success1 mt-3 mb-1">Carry-In</h6>
					 <span style="font-size:1em;">SC : <?=$itotalaopen?> <br> OC : <?=$itotaloopen?></span><br>
					<span style="font-size:0.75em;"><b>Today</b> <br> SC : <?=$itodayaopen?> <br> OC : <?=$itodayoopen?> </span><br>
					<span style="font-size:0.75em;"> <b>Old</b> <br>  SC : <?=$ioldaopen?> <br> OC : <?=$ioldoopen?> </span></div><br>
					<div class="col-6"><h6 class="text-success1 mt-3 mb-1" >On-Site</h6> 
					<span style="font-size:1em;">SC : <?=$ototalaopen?> <br> OC : <?=$ototaloopen?></span><br>
					<span style="font-size:0.75em;"><b>Today</b><br>  SC : <?=$otodayaopen?> <br> OC : <?=$otodayoopen?> </span><br>
					<span style="font-size:0.75em;"><b> Old</b> <br>SC : <?=$ooldaopen?> <br> OC : <?=$ooldoopen?> </span></div></div><br>
					<?php
												}
										?>	</span>	
      </div>
	  
	   <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
			   <div>
                   <a href="calls.php?status=1"><span  class="mb-0 text-dark"><b>Total Pending Calls</b></span></a>
				   <h4 class="my-1 text-info2 text-center" style="font-size:1.5em;"><?=$totaltodaypending?></h4> 
				   
				<!--<div class="row">
				<div class="col-12 text-center">
				<?php $pendonsite=$ototaltodayapending+$ototaltodayopending; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-info2"><?=$pendonsite?></span>
				</div>
				<div class="col-12 text-center">
				<?php $pendcarryin=$itotaltodayapending+$itotaltodayopending; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-info2"><?=$pendcarryin?></span>
				</div>
				</div>-->
				</div>
				<!--<div class="widgets-icons-info2 ms-auto" >
		<i class="bx bxs-file-find"></i>
		</div>-->
				  
				   </div>
          </div>
        </div>
                <span class="tooltip4 callouts--top">  <b> <span style="font-size:1.1em;">SC : <?=$totaltodayapending?> <br> OC : <?=$totaltodayopending?></span> </b><br> 
                                            
					<div class="row"> <div class="col-6"><span style="font-size:0.75em;"><b>Today</b> <br> SC : <?=$todayapending?> <br> OC : <?=$todayopending?> </span></div><br>
					<div class="col-6"><span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$oldapending?> <br> OC : <?=$oldopending?> </span></div>
					<?php
												if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
												{
													?>
					<div class="col-6">
					<h6 class="text-info2 mt-3 mb-1">Carry-In</h6> 
					<span style="font-size:1em;">SC : <?=$itotaltodayapending?> <br> OC : <?=$itotaltodayopending?></span> <br> 
					<span style="font-size:0.75em;"><b>Today</b> <br> SC : <?=$itodayapending?> <br> OC : <?=$itodayopending?> </span><br>
					<span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$ioldapending?> <br> OC : <?=$ioldopending?> </span>
					</div>
					<div class="col-6">
					<h6 class="text-info2 mt-3 mb-1">On-Site</h6> 
					<span style="font-size:1em;">SC : <?=$ototaltodayapending?> <br> OC : <?=$ototaltodayopending?></span> <br> 
					<span style="font-size:0.75em;"><b>Today</b> <br> SC : <?=$otodayapending?> <br>OC : <?=$otodayopending?> </span><br>
					<span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$ooldapending?> <br> OC : <?=$ooldopending?> </span></div>
					<?php
												}
												?>
												</div>
</span>		
      </div>
	  <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv4">
				<div>
				  <a href="calls.php?status=2&lform=dashboard"><span  class="mb-0 text-dark"><b>Total Completed Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-danger2 text-center" style="font-size:1.5em;"><?=$totalcomplete?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-danger2 text-center" style="font-size:1.5em;"><?=$totaltodaycomplete?></h4>
				<?php } ?>
				
				
				<!--<div class="row">
				<div class="col-12 text-center">
				<?php $componsite=$ototaltodayacomplete+$ototaltodayocomplete; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-danger2"><?=$componsite?></span>
				</div>
				<div class="col-12 text-center">
				<?php $compcarryin=$itotaltodayacomplete+$itotaltodayocomplete; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-danger2"><?=$compcarryin?></span>
				</div>
				</div>-->
				
				</div>
				<!--<div class="widgets-icons-danger2 ms-auto" >
		<i class="bx bxs-badge-check"></i>
		</div>-->
		 </div>
          </div>
        </div>
      <span class="tooltip5 callouts--top">	   <?php
											if(isset($_POST['submit']))
											{
												?>	
                                                <b><span style="font-size:1.1em;">SC : <?=$totalacomplete?> <br> OC : <?=$totalocomplete?></span></b>
                                          	<?php
											}
											else
											{
												?> 
                                           <b> <span style="font-size:1.1em;">SC : <?=$totaltodayacomplete?> <br> OC : <?=$totaltodayocomplete?></span></b><br>
                                            
											<div class="row"><div class="col"><span style="font-size:0.7em;"><b>Today</b> <br> SC : <?=$todayacomplete?> <br> OC : <?=$todayocomplete?> </span></div><br>
											<div class="col"><span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$oldacomplete?> <br> OC : <?=$oldocomplete?> </span></div></div><br>
												<?php
												if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
												{
													?>
												
												<div class="row"><div class="col-6"><h6 class="text-danger2 mt-3 mb-1">Carry-In</h6> 
											<span style="font-size:1em;">SC : <?=$itotaltodayacomplete?> <br>OC : <?=$itotaltodayocomplete?></span><br>
											<span style="font-size:0.7em;"><b>Today</b> <br> SC : <?=$itodayacomplete?> <br> OC : <?=$itodayocomplete?> </span><br>
											<span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$ioldacomplete?> <br> OC : <?=$ioldocomplete?> </span><br></div>
											<div class="col-6"><h6 class="text-danger2 mt-3 mb-1">On-Site</h6> 
											<span style="font-size:1em;">SC : <?=$ototaltodayacomplete?> <br> OC : <?=$ototaltodayocomplete?></span><br>
											<span style="font-size:0.7em;"><b>Today</b> <br> SC : <?=$otodayacomplete?> <br> OC : <?=$otodayocomplete?> </span><br>
											<span style="font-size:0.75em;"><b>Old</b> <br> SC : <?=$ooldacomplete?> <br> OC : <?=$ooldocomplete?> </span><br></div></div>
											<?php
												}
												?>
												<?php
											}
											?>
											</span>
				  
           
      </div>
		<div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-success2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv5">
				<div>
				  <a href="calls.php?status=3&lform=dashboard"><span  class="mb-0 text-dark"><b>Cancelled Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-success2 text-center"><?=$totalcancel?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-success2 text-center"><?=$totaltodaycancel?></h4>
				<?php } ?>
				<!--<div class="row">
				<div class="col-12 text-center">
				<?php $canonsite=$ototaltodayacancel+$ototaltodayocancel; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-danger2"><?=$componsite?></span>
				</div>
				<div class="col-12 text-center">
				<?php $cancarryin=$itotaltodayacancel+$itotaltodayocancel; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-danger2"><?=$compcarryin?></span>
				</div>
				</div>-->
				</div>
			
				<!--<div class="widgets-icons-success2 ms-auto" >
		<i class="bx bxs-phone-off"></i>
		</div>-->
				   </div>
          </div>
        </div> 
      <span class="tooltip6 callouts--top">					   <?php
											if(isset($_POST['submit']))
											{
												?>	
												<b> <span style="font-size:1.1em;">SC : <?=$totalacomplete?> <br> OC : <?=$totalocancel?></span></b>
                                          	<?php
											}
											else
											{
												?>
												<b> <span style="font-size:1.1em;">SC : <?=$totaltodayacancel?> <br> OC : <?=$totaltodayocancel?></span></b><br>
                                            
											<div class="row"><div class="col-6"><span style="font-size:0.7em;"><b>Today </b> <br> SC : <?=$todayacancel?> <br> OC : <?=$todayocancel?> </span><br></div>
											<div class="col-6"><span style="font-size:0.75em;"><b>Old </b><br> SC : <?=$oldacancel?> <br> OC : <?=$oldocancel?> </span><br></div></div>
												<?php
												if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
												{
													?>
												
												<div class="row">
												<div class="col-6"><h6 class="text-success2 mt-3 mb-1">Carry-In</h6> 
											<span style="font-size:1em;">SC : <?=$itotaltodayacancel?> <br>OC : <?=$itotaltodayocancel?></span><br>
											<span style="font-size:0.7em;"><b>Today</b> <br> SC : <?=$itodayacancel?> <br> OC : <?=$itodayocancel?> </span><br>
											<span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$ioldacancel?> <br> OC : <?=$ioldocancel?> </span><br></div>
											<div class="col-6">
											<h6 class="text-success2 mt-3 mb-1">On-Site</h6> 
											<span style="font-size:1em;">SC : <?=$ototaltodayacancel?> <br> OC : <?=$ototaltodayocancel?></span><br>
											<span style="font-size:0.7em;"><b>Today</b> <br> SC : <?=$otodayacancel?> <br> OC : <?=$otodayocancel?> </span><br>
											<span style="font-size:0.75em;"><b>Old</b> <br> SC : <?=$ooldacancel?> <br> OC : <?=$ooldocancel?> </span><br></div></div>
											<?php
												}
												?>
												<?php
											}
											?>
											</span>
				  
           
      </div>
       <!--end new one-->	
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
						//Contents will be here(($liveplan=="GOLD")||($liveplan=="DIAMOND"))?'4':'6'
						?>
						
<div class="col-lg-4 mb-3">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				    <h6 style="color:#04121f" class="m-0 text-center"><b>Call Progress Statistics</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">

   <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv6">
			   <div>
				<a href="callstatus.php?fromdate=<?=$dashfromdate?>&todate=<?=$dashtodate?>&submit=submit"><span  class="mb-0 text-dark" style="color:<?=$jerobytecolors[$ad];?>; "><b>Opening </br>Status</b></span></a>
				<h4 class="mb-2 text-info1" style="font-size:1.5em;"><?=$originaloldbalance?> </h4>
				</div>
				<div class="widgets-icons-info1 ms-auto">
				<i class="bx bxs-lock-open-alt"></i></div>
              </div>
            </div>
          </div>
                <span class="tooltip7 callouts--top"><h6 class="mb-2 text-info1">Open : <?=$originaloldbalance?> <br> Pending :<?=$originaloldpendingbalance?></h6> <span style="font-size:1em;">( on <?=date('d/m/Y',strtotime($dashfromdate))?> )</span></span>   
      </div>
	  
      <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv7">
			   <div>
                  <a href="callstatus.php?fromdate=<?=$dashfromdate?>&todate=<?=$dashtodate?>"><span  class="mb-0 text-dark" style="color:<?=$jerobytecolors[$ad];?>;"><b>During </br>Period</span></b></a>
				  <h4 class="mb-2 text-danger1"><?=$sumtodaycalls?></h4>
				  </div>
				   <div class="widgets-icons-danger1 ms-auto" >
		<i class="bx bxs-time"></i>
		</div> </div>
          </div>
        </div>
					<span class="tooltip8 callouts--top"> <h6 class="mb-2 text-danger1">Received : <?=$sumtodaycalls?><br> Pending : <?=$sumtodaypending?></h6><span style="font-size:1em;">(<?=date('d/m/Y',strtotime($dashfromdate))?> - <?=date('d/m/Y',strtotime($dashtodate))?>)</span></span>
      </div>
	  
	    <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv8">
			   <div>
                  <a href="callstatus.php?fromdate=<?=$dashfromdate?>&todate=<?=$dashtodate?>"><span  class="mb-0 text-dark" style="color:<?=$jerobytecolors[$ad];?>;"><b>Completed<br>Calls</b></span></a>
				  <h4 class="mb-2 text-info2" style="font-size:1.5em;"><?=$sumtodaycompleted?></h4></div>
				  <div class="widgets-icons-info2 ms-auto" >
		<i class="bx bxs-badge-check"></i>
		</div> 
		 </div>
          </div>
        </div>
                  <span class="tooltip9 callouts--top"  style="font-size:1em;">( 
                    From Old Open - <?=$sumtodayveryoldcompleted?><br>
					From New Open - <?=($sumtodayoldcompleted+$sumtodaynewcompleted)-$sumtodayveryoldcompleted?><br>
					From Old Pending - <?=$sumtodayveryoldpending?><br>
					From New Pending - <?=$sumtodaypendingcompleted-$sumtodayveryoldpending?>)</span>
				  
               
      </div>
      <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv9">
			   <div>
                   <a href="callstatus.php?fromdate=<?=$dashfromdate?>&todate=<?=$dashtodate?>&submit=submit"><span  class="mb-0 text-dark" style="color:<?=$jerobytecolors[$ad];?>;"><b>Closing <br>Status</b></span></a>
				   <h4 class="mb-2 text-danger2"><?=$oldbalance?></h4>
				</div>
				  <div class="widgets-icons-danger2 ms-auto" >
		<i class="bx bxs-lock-alt"></i>
		</div> </div>
          </div>
        </div>
				 
											   <span class="tooltip10 callouts--top"><span style="font-size:1em;"><h6 class="mb-2 text-danger2">Open : <?=$oldbalance?> <br> Pending : <?=$oldpendingbalance?></h6>( As on <?=date('d/m/Y',strtotime($dashtodate))?> )</span></span>
                  
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
/* if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
{ */
?>
<?php
if(($amcmanagement=="1")||($warrantymanagement=="1"))
{
	?>
	<div class="col-lg-2 mb-4">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>AMC & WTY</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">
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
	
	        $sqlselect2="SELECT count(enabled) as denied From jrcreminder where enabled='2' order by id asc";
			$queryselect2=mysqli_query($connection, $sqlselect2);
			$infoselect2 = mysqli_fetch_array($queryselect2); 
			$denied=$infoselect2['denied'];
		?>
		

				
  <div class="col-xl-12 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
			   <div>
                   <a href="amccustomers.php"><span  class="mb-0 text-dark"><b>AMC Customers</b></span></a>
				    <h4 class="mb-2 text-info2 text-center"><?=count($a)?></h4>
				   </div>
				<div class="widgets-icons-info2 ms-auto" >
		<i class="bx bx-check"></i>
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
		?> <div class="col-xl-12 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				<a href="warrantycustomersall.php"><span  class="mb-0 text-dark"><b>Warranty Customers</b></span></a>
				<h4 class="mb-2 text-info1 text-center"><?=count($a)?></h4>
                   
				</div>
				<div class="widgets-icons-info1 ms-auto" >
		<i class="bx bx-check"></i>
		</div>
				
	</div>
      </div>
  </div>
      </div>


<?php
						}
						?>
</div>
</div>
</div>
</div>
<?php
}
/* } */
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
				
	<?php
/* if($liveplan=='DIAMOND')
{ */
?>													
		<div class="col-lg-5 mb-4">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Business Alerts</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">		

        <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-green2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertamcmaintenance.php"><span class="mb-0 text-dark" style="color:<?=$jerobytecolors[$ad]?>;"><b>AMC <br>Maintenance</b></span></a>
					<h4 class="my-1 text-green2 text-center"><?=$amcmaintenance?></h4>
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>AMC <BR>Maintenance</b></span></a>
					<?php
				}
				?>
				</div>
				<div class="widgets-icons-green2 ms-auto" >
		<i class="bx bxs-calendar"></i>
		</div>
		</div>
              </div>
            </div>
          </div> 
		
		  
	 
						
		<div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-pink1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertpreventive.php"><span class="mb-0 text-dark" ><b>Warranty Maintenance</b></span></a>
                  <h4 class="mb-2 text-pink1 text-center"><?=$preventive?></h4> 
                
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Warranty Maintenance</b></span></a>
					<?php
				}
				?></div>
				<div class="widgets-icons-pink1 ms-auto" >
		<i class="bx bxs-calendar-check"></i>
		</div>
				             
                </div>
              </div>
            </div>
          </div>				<?php
	  $sqlw = "SELECT count(id) as count From jrccalls where actiontaken='WAITING FOR APPROVAL' and wastatus='0'";
	    $queryw = mysqli_query($connection, $sqlw);
        $rowCountw = mysqli_fetch_array($queryw);
		$wcount=(float)$rowCountw['count'];
		$sqlo = "SELECT count(id) as count From jrccalls where actiontaken='OBSERVATION'";
	    $queryo = mysqli_query($connection, $sqlo);
        $rowCounto = mysqli_fetch_array($queryo);
		$ocount=(float)$rowCounto['count']; 
		?>
		
		 <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="wcalls.php"><span class="mb-0 text-dark"><b>Waiting for Approval</b></span></a>
                   <h4 class="my-1 text-warning2 text-center"><?=$wcount?></h4>
				  
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Waiting for Approval</b></span></a>
					<?php
				}
				?>    
 </div>
				  <div class="widgets-icons-warning2 ms-auto">
		<i class="bx bxs-message-rounded-check"></i>
		</div>				
                </div>
              </div>
            </div>
          </div>	
		  
		  
		 <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-green1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertamcexpire.php"><span class="mb-0 text-dark"><b>AMC Expiry</b></span></a>
                   <h4 class="my-1 text-green1 text-center"><?=$amcexpire?></h4>
				 

                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>AMC Expiry</b></span></a>
					
					
					<?php
				}
				?>    
 </div>
				  <div class="widgets-icons-green1 ms-auto">
		<i class="bx bxs-message-rounded-check"></i>
		</div>				
                </div>
              </div>
            </div>
          </div>		
		  		 
		
		<div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-pink2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertwarrantyexpire.php"><span class="mb-0 text-dark"><b>Warranty Expiry</b></span></a>
                   <h4 class="my-1 text-pink2 text-center"><?=$warrantyexpire?></h4>
				 <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Warranty Expiry</b></span></a>
				
					<?php
				}
				?>    
 </div>
				  <div class="widgets-icons-pink2 ms-auto">
		<i class="bx bxs-message-rounded-check"></i>
		</div>				
                </div>
              </div>
            </div>
          </div>		
		  
	  
	  
	    <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="ocalls.php"><span class="mb-0 text-dark" ><b>Total Observation Calls</b></span></a>
				  <h4 class="my-1 text-warning1 text-center" style="font-size:1.5em;"><?=$ocount?></h4>
				  
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Total Observation Calls</b></span></a>
					<?php
				}
				?>
				 </div>
				<!--  <div class="widgets-icons-warning1 ms-auto">
		<i class="bx bxs-phone-call"></i>
		</div>-->
             </div>
              </div>
            </div>
          </div>
	  
	  
		
</div>						
</div>						
</div>						
</div>						
<?php
/* } */
?> 


 
					<?php
					?>
						<!--div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#6e707e" class="m-0  ">Service Revenue <span
                                            class="text-primary float-right">Total: Rs. <span
                                                id="totalservicerevenue"></span> ( Today: Rs. <span
                                                id="todayservicerevenue"></span> ) </span></h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%; height:232px;"></canvas>
                                </div>
                            </div>
                        </div-->
						<?php
					/* if($liveplan=='DIAMOND')
					{ */
					?>                    
					<div class="col-lg-6">
                            <div class="card shadow cardb mb-4">
                                <div class="card-header py-2">
								
                                    <h6 style="color:#04121f" class="m-0  "><b>Monthwise Service Revenue <span
                                            class="text-primary float-right">( To be Collected: Rs. <span
                                                id="tobecollected"></span> )</span></b></h6>
                                </div>
                                <div class="card-body">
								
								<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<canvas id="myChart1" style="width:100%; height:232px;"></canvas>
                  <?php
				}
				else
				{
					?>
					<p style="width:100%; height:222px; text-align:center">
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;">Monthwise Service Revenue</span></a>
					</p>
					<?php
				}
				?>
								
                                    
                                </div>
							</div>
                        </div>



<!--for amc revenue-->
				<!--div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#6e707e" class="m-0  ">AMC Revenue <span
                                            class="text-primary float-right">Total: Rs. <span
                                                id="totalamcrevenue"></span> ( Today: Rs. <span
                                                id="todayamcrevenue"></span> ) </span></h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="myCharta" style="width:100%; height:232px;"></canvas>
                                </div>
                            </div>
                        </div-->
						<?php
					/* if($liveplan=='DIAMOND')
					{ */
					?>                    
					<div class="col-lg-6">
                            <div class="card shadow cardb mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#04121f" class="m-0  "><b>Monthwise AMC Revenue <span
                                            class="text-primary float-right">( To be Collected: Rs. <span
                                                id="tobecollected1"></span> )</span></b></h6>
                                </div>
                                <div class="card-body">
								
								<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<canvas id="myCharta1" style="width:100%; height:232px;"></canvas>
                  <?php
				}
				else
				{
					?>
					<p style="width:100%; height:222px; text-align:center">
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;">Monthwise AMC Revenue</span></a>
					</p>
					<?php
				}
				?>
								
                                    
                                </div>
							</div>
                        </div>
					<?php
					/* } */
					?>

<?php
					/* if(($liveplan=='DIAMOND'))
					{ */
					?>
        <div class="col-lg-4">

             
            <div class="card shadow cardb mb-4">
                <div class="card-header py-2">
							
                    <h6 style="color:#04121f" class="m-0  "><b>Reminders
					<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="reminder.php" class="float-right">Go
                            to Reminder</a>
							<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-right"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;">Go to Reminder</span></a>
					<?php
				}
				?>
							</b></h6>
                </div>
                <div class="card-body">
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					  <marquee width="100%" direction="up" height="226px" scrollamount="3" onmouseover="this.stop();"
                        onMouseOut="this.start();">
                        <ul class="todo-list ui-sortable drag-me">
                            <?php
				  $sqlselect = "SELECT enddate, reminder From jrcreminder where enabled='0' group by reminder order by reminder asc limit 50";
				  
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
                  <?php
				}
				else
				{
					?>
					<p style="width:100%; height:218px; text-align:center">
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;">Reminders</span></a>
					</p>
					<?php
				}
				?>
                  
                </div>
				
            </div>
        </div>
        <div class="col-lg-4">

             
            <div class="card shadow cardb mb-4">
                <div class="card-header py-2">	
                    <h6 style="color:#04121f" class="m-0  "><b>Updates/Announcements
					
					<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="updates.php" class="float-right">Go to Updates</a>
							<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-right"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;">Go to Updates</span></a>
					<?php
				}
				?>
					</b></h6>
                </div>
                <div class="card-body">
				
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					    <marquee width="100%" direction="up" height="226px" scrollamount="3" onmouseover="this.stop();"
                        onMouseOut="this.start();">
                        <ul class="todo-list ui-sortable drag-me">
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
                  <?php
				}
				else
				{
					?>
					<p style="width:100%; height:218px; text-align:center">
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;">Updates/Announcements</span></a>
					</p>
					<?php
				}
				?>
				
				
                  
                </div>
				
            </div>
        </div>
		<?php
					/* } (($liveplan=="GOLD")||($liveplan=="DIAMOND"))?'4':'6'*/
					?>
        <div class="col-lg-4">

             
            <div class="card shadow cardb mb-4">
                <div class="card-header py-2">
				     <h6 style="color:#04121f" class="m-0   text-center"><b>Engineers Calls</b></h6>
                </div>
                <div class="card-body">
                    <ul class="todo-list ui-sortable" style="height:232px">
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
    <!--script>
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
    </script-->

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
		backgroundColor:  '<?=$_SESSION['bgcolor']?>',
        borderColor:  '<?=$_SESSION['bgcolor']?>',
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
        backgroundColor: '<?=$_SESSION['lightbgcolor']?>',
        borderColor:'<?=$_SESSION['lightbgcolor']?>',
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
	
	
	
	<!--for amc service chart-->
	
	
	<?php
$totalamcrevenue=0;
$todayamcrevenue=0;
$sdate=array();
$samount=array();
$monthsarray=array();
$monthsparray=array();
$montharray=array();
 $sqli=mysqli_query($connection, "select sum(totalvalue) as totalvalue,sum(receivedamount) as receivedamount, datefrom from jrcamc where totalvalue!='' and totalvalue!='0' and totalvalue!='0.00'  and (datefrom > now() - INTERVAL 7 MONTH) ".$dashschargesearch1." group by datefrom order by cast(datefrom as date) asc");
 
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $sdate[]=date('d M',strtotime($infoi['datefrom']));
	 $samount[]=$infoi['totalvalue'];
	 $totalamcrevenue+=(float)$infoi['receivedamount'];
	 if(date('d/m/Y')==date('d/m/Y',strtotime($infoi['datefrom'])))
	 {
		 $todayamcrevenue=$infoi['receivedamount'];
	 }
	 $monthsarray[date('Y-m-d',strtotime($infoi['datefrom']))]=$infoi['totalvalue'];
	 $montharray[]=date('M Y',strtotime($infoi['datefrom']));
	 
		 $monthsparray[date('Y-m-d',strtotime($infoi['datefrom']))]=$infoi['receivedamount'];
	 
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
    <!--script>
    var xValues = [<?php foreach ($sdate as $sd){ echo "'".$sd."',";}?>];
    var yValues = [<?php foreach ($samount as $sa){ echo $sa.',';}?>];
    document.getElementById("totalamcrevenue").innerHTML = '<?=$totalamcrevenue?>';
    document.getElementById("todayamcrevenue").innerHTML = '<?=$todayamcrevenue?>';
    new Chart("myCharta", {
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
    </script-->

<script>
    // setup 
    const data1 = {
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
		backgroundColor: '<?=$_SESSION['bgcolor']?>',
        borderColor: '<?=$_SESSION['bgcolor']?>',
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
        backgroundColor: '<?=$_SESSION['lightbgcolor']?>',
        borderColor: '<?=$_SESSION['lightbgcolor']?>',
        borderWidth: 1
      }, {
        label: 'To be Collected',
        data: [
		<?php 
	$i=0;
	$tob1=0;
	foreach ($montharray as $sd)
	{
		echo ((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]).','; 
		$tob1+=((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]);
		$i++;
	}
	
	?>],
        backgroundColor: ['rgba(0, 0, 0, 0.2)'],
        borderColor: ['rgba(0, 0, 0, 0.2)'],
        borderWidth: 1
      }]
    };

    // config 
    const config1 = {
      type: 'bar',
      data:data1,
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
    const myCharta = new Chart(
      document.getElementById('myCharta1'),
      config1
    );
	document.getElementById("tobecollected1").innerHTML="<?=$tob1?>";
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
	<!------------daterangepicker--->
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/moment.min.js"></script>
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

    var start = moment();
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
<script>
$(".drag-me").draggable({
  axis: "y"
});
</script>
<!--start new one-->
 <script>
      const myDiv = document.getElementById("myDiv");
	  if(myDiv)
      {
      myDiv.addEventListener("mouseover", showTooltip);
      myDiv.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip1");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip1");
         tooltip.style.display = "none";
      }  
      }  
</script> <script>
      const myDiv1 = document.getElementById("myDiv1");
	  if(myDiv1)
      {
      myDiv1.addEventListener("mouseover", showTooltip);
      myDiv1.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip2");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip2");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDiv2 = document.getElementById("myDiv2");
	  if(myDiv2)
      {
      myDiv2.addEventListener("mouseover", showTooltip);
      myDiv2.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip3");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip3");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDiv3 = document.getElementById("myDiv3");
	  if(myDiv3)
      {
      myDiv3.addEventListener("mouseover", showTooltip);
      myDiv3.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip4");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip4");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDiv4 = document.getElementById("myDiv4");
	  if(myDiv4)
      {
      myDiv4.addEventListener("mouseover", showTooltip);
      myDiv4.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip5");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip5");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDiv5 = document.getElementById("myDiv5");
	  if(myDiv5)
      {
      myDiv5.addEventListener("mouseover", showTooltip);
      myDiv5.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip6");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip6");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDiv6 = document.getElementById("myDiv6");
      if(myDiv6)
      {
      myDiv6.addEventListener("mouseover", showTooltip);
      myDiv6.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip7");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip7");
         tooltip.style.display = "none";
      }  
      }
  </script>
  <script>
      const myDiv7 = document.getElementById("myDiv7");
      if(myDiv7)
      {
      myDiv7.addEventListener("mouseover", showTooltip);
      myDiv7.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip8");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip8");
         tooltip.style.display = "none";
      }  
      }
  </script>
  <script>
      const myDiv8 = document.getElementById("myDiv8");
      if(myDiv8)
      {
      myDiv8.addEventListener("mouseover", showTooltip);
      myDiv8.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip9");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip9");
         tooltip.style.display = "none";
      } 
      }
  </script>
  
  <script>
      const myDiv9 = document.getElementById("myDiv9");
      if(myDiv9)
      {
      myDiv9.addEventListener("mouseover", showTooltip);
      myDiv9.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip10");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip10");
         tooltip.style.display = "none";
      } 
      }
  </script>
<!--end new one-->
</body>

</html>