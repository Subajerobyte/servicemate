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
	
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>

:root {
    --bs-blue: #0d6efd;
    --bs-indigo: #6610f2;
    --bs-purple: #6f42c1;
    --bs-pink: #d63384;
    --bs-red: #dc3545;
    --bs-orange: #fd7e14;
    --bs-yellow: #ffc107;
    --bs-green: #198754;
    --bs-teal: #20c997;
    --bs-cyan: #0dcaf0;
    --bs-black: #000;
    --bs-white: #fff;
    --bs-gray: #6c757d;
    --bs-gray-dark: #343a40;
    --bs-gray-100: #f8f9fa;
    --bs-gray-200: #e9ecef;
    --bs-gray-300: #dee2e6;
    --bs-gray-400: #ced4da;
    --bs-gray-500: #adb5bd;
    --bs-gray-600: #6c757d;
    --bs-gray-700: #495057;
    --bs-gray-800: #343a40;
    --bs-gray-900: #212529;
    --bs-primary: #0d6efd;
    --bs-secondary: #6c757d;
    --bs-success: #198754;
    --bs-info: #0dcaf0;
    --bs-warning: #ffc107;
    --bs-danger: #dc3545;
    --bs-light: #f8f9fa;
    --bs-dark: #212529;
    --bs-expresso: #ad5389;
    --bs-primary-rgb: 13, 110, 253;
    --bs-secondary-rgb: 108, 117, 125;
    --bs-success-rgb: 25, 135, 84;
    --bs-info-rgb: 13, 202, 240;
    --bs-warning-rgb: 255, 193, 7;
    --bs-danger-rgb: 220, 53, 69;
    --bs-light-rgb: 248, 249, 250;
    --bs-dark-rgb: 33, 37, 41;
    --bs-white-rgb: 255, 255, 255;
    --bs-black-rgb: 0, 0, 0;
    --bs-body-color-rgb: 33, 37, 41;
    --bs-body-bg-rgb: 255, 255, 255;
    --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
    --bs-body-font-family: var(--bs-font-sans-serif);
    --bs-body-font-size: 1rem;
    --bs-body-font-weight: 400;
    --bs-body-line-height: 1.5;
    --bs-body-color: #212529;
    --bs-body-bg: #fff;
    --bs-border-width: 1px;
    --bs-border-style: solid;
    --bs-border-color: #dee2e6;
    --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
    --bs-border-radius: 0.375rem;
    --bs-border-radius-sm: 0.25rem;
    --bs-border-radius-lg: 0.5rem;
    --bs-border-radius-xl: 1rem;
    --bs-border-radius-2xl: 2rem;
    --bs-border-radius-pill: 50rem;
    --bs-link-color: #0d6efd;
    --bs-link-hover-color: #0a58ca;
    --bs-code-color: #d63384;
    --bs-highlight-bg: #fff3cd;
}
.rounded-circle {
    border-radius: 50%!important;
	width: 30px!important;
    height: 30px!important;
	
}

.bx {
    font-family: boxicons!important;
    font-weight: 400;
    font-style: normal;
    font-variant: normal;
    line-height: inherit;
    display: inline-block;
    text-transform: none;
    speak: none;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.cardb{
    border: 1px solid #cccccc!important;
}

.cardnew1
{
	height:100px!important;
	
}
p {
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}
h6{
	font-size:14px;
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

.widgets-icons-info1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #0078d7;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-info2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #0063b1;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-danger1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #da3b01;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-danger2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #ef6950;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-success1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #00cc6a;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-success2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #10893e;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-warning1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #ffb900;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-warning2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #ff8c00;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-express1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #b146c2;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-express2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #881798;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-green1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #00b7c3;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-green2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #038387;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-pink1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #e3008c;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-pink2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #bf0077;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-grey1 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #68768a;
    font-size: 35px;
    border-radius: 10px;
}
.widgets-icons-grey2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
	color: #515c6b;
    font-size: 35px;
    border-radius: 10px;
}

.page-content {
    padding: 1.5rem 1.5rem 0.7rem 1.5rem;
}
div {
    display: block;
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
.ms-auto
{
	margin-left: auto!important;
}


    </style>
	
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
		
      }
	  .tooltip7 {
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
	  
	  .callouts--top:before {
	content: "";
	position: absolute;
	width: 0;
	height: 0;
	left: 23px;
	top: -42px;
  border: 10px solid transparent;
  border-bottom: 32px solid rgb(193,193,193); /* IE8 Fallback */
  border-bottom: 32px solid rgba(193,193,193,0.5);
  z-index: 2;
}
.callouts--top:after {
  content: "";
	position: absolute;
	width: 0;
	height: 0;
	left: 25px;
	top: -32px;
  border: 8px solid transparent;
  border-bottom: 25px solid #fff;
  z-index: 3;
}
	   </style>
</head>

<body id="page-top" onLoad="getGeolocation()">
    
    <div id="wrapper">

        <?php include('sidebar.php');?>
        
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
			
                <?php include('navbar.php');?>
                <?php include('salesnavbar.php');?>
				
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
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Sales Order Dashboard</b></h1>
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
                    <a href="salesdashboard.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
                </button>
            </div>
        </div>
    </form>
</div>
</div>			
		
		
		
                    <div class="row">
						<div class="col-lg-12">
							<div class="row">
<div class="col-lg-12 mb-3">
<div class="card shadow cardb" role="button">
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0  text-center"><b>Order Management</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">
	  <?php
				$sqlselect = "SELECT COUNT(id) AS id,sum(grandtotal) as amount FROM jrctally";
				  
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
			
			 $totalorder=$rowselect['id'];
			 $totalamount=$rowselect['amount'];
			
			}
			
		}
			?>
   <div class="col-xl-4 col-sm-6 mb-3 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				<a href="inhousecalls.php?call=received"><span  class="mb-0 text-dark"><b>Sales Order</b></span></a>
                <?php if(isset($_POST['submit'])) {  ?>
				<h4 class="my-1 text-info1"> </h4>
				<?php } else { ?>
				<h4 class="my-1 text-info1"> <?=$totalorder?></h4>
				<h4 class="my-1 text-info1"> <?=$totalamount?>₹</h4>
                </div>  
				<div class="widgets-icons-info1 ms-auto" >
				<i class="bx bxs-phone-incoming"></i>
				</div>				
												<?php
										
											}
											?>
            </div>
          </div>
        </div>
		<span class="tooltip6 callouts--top">
											<span style="font-size:1em;"><b>Quantity  :</b> </span><br>
											<span style="font-size:1em;"><b>Amount :</b> </span></span>
      </div>
	   <?php
	  
	   
		/* $sqlselect = "SELECT COUNT(docdc) AS docdc,COUNT(docic) AS docic,COUNT(docinvoice) AS docinvoice,count(invoiceno) as invoiceno,sum(invoiceamt) as invoiceamt FROM jrcxl where (docdc!='' and docdc!='NULL') and (docic!='' and docic!='NULL') or invoiceno!='' "; */
		 $sqlselect = "SELECT docic,docdc,docinvoice,invoiceno, invoiceamt  FROM jrcxl group by invoiceno,invoicedate "; 
				
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=0;
			$sum=0;
			$a=0;
			$totaldc=0;
			$totalic=0;
			$totalinvoice=0;
			$totalinvoice1=0;
			$totalinvoiceamt=0;
			$totalinvoiceamt1=0;
			$totaldcamt=0;
			$totalicamt=0;
			$totalinvoicesubamt=0;
		
			$totaldcamount=0;
			$totalicamount=0;
			$totalinvoiceamount=0;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				
			if($rowselect['docdc']!='')
			{
			 $totaldc++;
			  $totaldcamount1=+$rowselect['invoiceamt'];
			 $totaldcamount+= $totaldcamount1;
			}
			if($rowselect['docic']!='')
			{
			 $totalic++;
			 $totalicamount1=+$rowselect['invoiceamt'];
			 $totalicamount+= $totalicamount1;
			}
			if($rowselect['docinvoice']!='')
			{
			 $totalinvoice++;
			 $totalinvoiceamount1=+$rowselect['invoiceamt'];
			 $totalinvoiceamount+= $totalinvoiceamount1;
			}
			if($rowselect['invoiceno']!='')
			{
			 $totalinvoice1++;
			 if($rowselect['invoiceamt']!='')
			 {
			 $totalinvoiceamt1=+$rowselect['invoiceamt'];
			 $totalinvoiceamt+= $totalinvoiceamt1;
			 }
			
			}
			
			
		
			
			}
			
		}
			?>
	   <div class="col-xl-4 col-sm-6 mb-3 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
				<a href="inhousecalls.php?call=assinged"><span  class="mb-0 text-dark"><b>DC</b></span></a>
                  <?php if(isset($_POST['submit'])) { ?>
				  <h4 class="my-1 text-danger1"></h4>
                                                <!--span style="font-size:1.1em;">SC : <?//=$itotalaassigned?> <br> OC :
                                                    <?//=$itotaloassigned?><br></span-->
					<?php } else { 	?>
					<h4 class="my-1 text-info1"> <?=$totaldc?></h4>
				<h4 class="my-1 text-info1"> <?=$totaldcamount?>₹</h4>
					<?php } ?>
              </div>
			  <div class="widgets-icons-danger1 ms-auto" >
				<i class="bx bxs-user-pin"></i>
				</div>
            </div>
          </div>
        </div>
		<span class="tooltip5 callouts--top">
											<span style="font-size:1em;"><b>Quantity  :</b>  </span><br>
											<span style="font-size:1em;"><b>Amount :</b> </span></span>
      </div>
      <div class="col-xl-4 col-sm-6 mb-3 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
                  <a href="inhousecalls.php?status=0"><span  class="mb-0 text-dark"><b>IC</b></span></a>
				  <h4 class="my-1 text-info1"> <?=$totalic?></h4>
				<h4 class="my-1 text-info1"> <?=$totalicamount?>₹</h4>
				  </div>
				  <div class="widgets-icons-warning1 ms-auto" >
		<i class="bx bxs-phone"></i>
		</div>
		</div>
            </div>
          </div>
					
												
					 <!--span style="font-size:1.1em;">SC : <?//=$itotalaopen?> <br> OC : <?//=$itotaloopen?></span><br-->	
					 <span class="tooltip1 callouts--top">				
					<span style="font-size:1em;"><b>Quantity  :</b> </span><br>
					<span style="font-size:1em;"> <b>Amount :</b> </span><br>
					</span>
			
              
      </div>
     <div class="col-xl-4 col-sm-6 mb-3 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv1">
			  <div>
                  <a href="inhousecalls.php?status=1"><span  class="mb-0 text-dark"><b>Invoice</b></span></a>
				<h4 class="my-1 text-info1"> <?=$totalinvoice1?></h4>
				<h4 class="my-1 text-info1"> <?=$totalinvoiceamt?>₹</h4>
				</div>
				  <div class="widgets-icons-info2 ms-auto" >
		<i class="bx bxs-file-find"></i>
		</div>	
            </div>
          </div>
        </div>		
					
				 
					<!--span style="font-size:1em;">SC : <?//=$itotaltodayapending?> <br> OC : <?//=$itotaltodayopending?></span> <br--> 
					 <span class="tooltip2 callouts--top">
					<span style="font-size:1em;"><b>Quantity  :</b>  </span><br>
					<span style="font-size:1em;"><b>Amount :</b> </span></span>
					
             
      </div>
     <div class="col-xl-4 col-sm-6 mb-3 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv2">
			<div>
                   <a href="inhousecalls.php?status=2&lform=dashboard"><span class="mb-0 text-dark"><b>Invoice Submission</b></span></a>
				   <?php if(isset($_POST['submit'])) { ?>	
					<h4 class="my-1 text-danger2"></h4>
                                                <!--span style="font-size:1.1em;">SC : <?//=$itotalacomplete?> <br> OC : <?//=$itotalocomplete?></span-->
                    <?php } else { ?> 
					<h4 class="my-1 text-info1"> <?=$totalinvoice?></h4>
				<h4 class="my-1 text-info1"> <?=$totalinvoiceamount?>₹</h4>
					<?php } ?>
            </div>
			<div class="widgets-icons-danger2 ms-auto" >
		<i class="bx bxs-badge-check"></i>
		</div>
          </div>
        </div>
        </div>
												
											<!--span style="font-size:1em;">SC : <?//=$itotaltodayacomplete?> <br>OC : <?//=$itotaltodayocomplete?></span><br-->
											<span class="tooltip3 callouts--top">
											<span style="font-size:1em;"><b>Quantity  :</b> </span><br>
											<span style="font-size:1em;"><b>Amount :</b> </span> </span>
										
												
             
      </div>
		 <div class="col-xl-4 col-sm-6 mb-3 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
				<div>
                   <a href="inhousecalls.php?status=3&lform=dashboard"><span  class="mb-0 text-dark"><b>Payment<br>Received</b></span></a>
				 <?php if(isset($_POST['submit'])) { ?>	
												 <h4 class="my-1 text-warning2"></h3>
                                                <!--span style="font-size:1.1em;">SC : <?//=$itotalacancel?> <br> OC : <?//=$itotalocancel?></span><br-->
                                          	<?php } else { ?> 
											 <h4 class="my-1 text-warning2"></h4>
                                            <?php } ?>
											 </div>
											<div class="widgets-icons-warning2 ms-auto" >
		<i class="bx bxs-phone-off"></i>
		</div>
			 </div>
            </div>
          </div>

											<!--span style="font-size:1em;">SC : <?//=$itotaltodayacancel?> <br> OC : <?//=$itotaltodayocancel?></span><br-->
											<span class="tooltip4 callouts--top">
											<span style="font-size:1em;"><b>Quantity  :</b>  </span><br>
											<span style="font-size:1em;"><b>Amount :</b> </span></span>
											
												
          
      </div>
		
	</div>
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



 $sqli=mysqli_query($connection, "select sum(t1.scharge) as scharge, t1.schargedate, t1.cashstatus,t1.calltid,t2.calltid,t2.servicetype  from jrccalldetails t1, jrccalls t2 where t1.srno!='' and t1.scharge!='' and t1.calltid=t2.calltid and t2.servicetype='Carry-In' and t1.scharge!='0' and t1.scharge!='0.00' and t1.incgst!='2' and (t1.schargedate > now() - INTERVAL 7 MONTH) ".$dashschargesearch." group by t1.schargedate, t1.cashstatus order by cast(t1.schargedate as date) asc");
 //ECHO "select sum(t1.scharge) as scharge, t1.schargedate, t1.cashstatus,t1.calltid,t2.calltid,t2.servicetype  from jrccalldetails t1, jrccalls t2 where t1.srno!='' and t1.scharge!='' and t1.calltid=t2.calltid and t2.servicetype='Carry-In' and t1.scharge!='0' and t1.scharge!='0.00' and t1.incgst!='2' and (t1.schargedate > now() - INTERVAL 7 MONTH) ".$dashschargesearch." group by t1.schargedate, t1.cashstatus order by cast(t1.schargedate as date) asc";
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
                backgroundColor: ['<?=$_SESSION['bgcolor']?>'],
                borderColor: ['<?=$_SESSION['bgcolor']?>'],
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
				x: {
			   ticks: {
                    color: 'black' // Change the font color here
                }
				},
				y: {
			   ticks: {
                    color: 'black' // Change the font color here
                }
				}
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
		backgroundColor: ['<?=$_SESSION['bgcolor']?>'],
        borderColor: ['<?=$_SESSION['bgcolor']?>'],
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
        backgroundColor: ['<?=$_SESSION['lightbgcolor']?>'],
        borderColor: ['<?=$_SESSION['lightbgcolor']?>'],
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
			  ticks: {
                    color: 'black' // Change the font color here
                },
			  stacked: false
		  },
          y: {
            beginAtZero: true,
			ticks: {
                    color: 'black' // Change the font color here
                },
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
 <script>
      const myDiv = document.getElementById("myDiv");
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
  </script> <script>
      const myDiv1 = document.getElementById("myDiv1");
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
  </script>
  <script>
      const myDiv2 = document.getElementById("myDiv2");
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
  </script>
  <script>
      const myDiv3 = document.getElementById("myDiv3");
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
  </script>
  <script>
      const myDiv4 = document.getElementById("myDiv4");
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
  </script>
  <script>
      const myDiv5 = document.getElementById("myDiv5");
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
  </script>
  <script>
      const myDiv6 = document.getElementById("myDiv6");
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
  </script>
  <script>
      const myDiv7 = document.getElementById("myDiv7");
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
  </script>
  <script>
      const myDiv8 = document.getElementById("myDiv8");
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
  </script>

</body>

</html>