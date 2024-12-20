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

$sqlselect = "SELECT createdon FROM swupdates  group by createdon ORDER BY id DESC LIMIT 2";
$queryselect = mysqli_query($connection1, $sqlselect);
$dates = array();

while ($rowselect = mysqli_fetch_array($queryselect)) {
    $dates[] = date('Y-m-d', strtotime($rowselect['createdon']));
}
if (count($dates) == 2) {
    $previous_createdon = $dates[1];
    $current_createdon = $dates[0];
} elseif (count($dates) == 1) {
    /* Only one date found, use it as the current_createdon and set the previous_createdon to NULL */
    $previous_createdon = '2023-10-07';
    $current_createdon = $dates[0];
} else {
     /* No dates found, both previous and current_createdon set to NULL */
    $previous_createdon = '2023-10-07';
    $current_createdon = null;
}
/* if(($previous_createdon>=$current_createdon) && ($current_createdon>$_SESSION['last_notification_update'])) */
if(($current_createdon>$_SESSION['last_notification_update']))
{
$sql = "UPDATE jrccompany SET notificationview ='0' WHERE id ='".$_SESSION['companyid']."'";
if ($connection->query($sql) === TRUE) {
}
}
if(isset($_GET['close_popup'])) {
   
    	$currenttime=date('Y-m-d');
$sql = "UPDATE jrccompany SET notificationview = '1',last_notification_update='".$currenttime."' WHERE id ='".$_SESSION['companyid']."'";

    if ($connection->query($sql) === TRUE) {
		header("Location:dashboard.php");
    } else {
      
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

.bx {
    font-family: boxicons!important;
    font-weight: 400;
    font-style: normal;
    font-variant: normal;
	font-size: 20px;
    line-height: inherit;
    display: inline-block;
    text-transform: none;
    speak: none;
}
.cardb{
    border: 2.5px solid <?=$_SESSION['bgcolor']?>!important;
}

.cardnew1
{
	height:100px!important;
	
}

.cardnew2
{
	height:120px!important;
	
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
.btn-blue {
    background-color: <?=$_SESSION['bgcolor']?>!important;
    color: #fff!important;
}
.btn-blue-reverse {
    background-color: #fff!important;
    color: #1899dd!important;
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

@keyframes marquee {
  0% {
    transform: translate(0, 0)
  }
  100% {
    transform: translate(-100%, 0)
  }
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
	  .tooltip11 {
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
	  .tooltip12 {
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
	  .tooltip13 {
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
	  .tooltip14 {
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
	  .tooltip15 {
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
	  .tooltipopen {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltippend {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltipcomp {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltipdeli {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltipopsts {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltipdp {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltipcc {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltipclsts {
         display: none;
         background-color: white;
		 text-align: center;
         color: black;
		 width: 94%;
         position: absolute;
		 z-index: 999999;
		 padding: 20px;
         box-shadow: 0 5px 5px 5px  rgba(0, 0, 0, 0.2);
		
      }.tooltipawait {
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



.popup-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.popup-container {
  background-color: white;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
  overflow: hidden;
  width: 30em;
  opacity: 0;
  transform: scale(0.8);
  transition: all 0.3s ease-in-out;
}

.popup-card {
  padding: 20px;
  text-align: center;
}

.popup-card h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.popup-card p {
  font-size: 16px;
  margin-bottom: 20px;
}

#close_popup  {
  background-color: <?=$_SESSION['bgcolor']?>;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 18px;
}

#close_popup:hover {
  background-color: <?=$_SESSION['darkcolor']?>;
}
#yesButton  {
  background-color: <?=$_SESSION['bgcolor']?>;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 18px;
}

#yesButton:hover {
  background-color: <?=$_SESSION['darkcolor']?>;
}

   </style>
   
   <!-- start new-->
   <style>
  .number-box {
    position: absolute;
    bottom: 0;
    padding: 2px 16px 8px 8px;
    font-size: 15px;
    border-radius: 50px 50px 50px 50px;
    width: 30px;
    height: 30px;
    right: 1%;
    top: 20%;
    transform: translateY(51%);
    box-shadow: inset 0.25em 0.25em 0.25em rgba(0, 0, 0, 0.2), 0em 0.05em rgba(255, 255, 255, 0);
    font-weight: 800;
    color: #fff;
}
   </style>
   <style>.d-flex1 {
    display: flex !important;
    flex-direction: column;
}
   </style>
   <style>
   #search-icon {
    color: #1899dd!important; /* Change to the desired color */
}
#existsearch::placeholder {
    color: white; /* Change to the desired color */
	font-weight: bold;
}	
   </style>
    <style>
       .container1 {
            display: flex;
            justify-content: space-between;
            margin: 0 auto;
            max-width: 800px; /* Adjust this width as needed */
        }
        .left, .right {
            width: 45%; /* Adjust the width as needed */
        }
        .left p, .right p {
            line-height: normal;
        }
		  
    </style>
	
   <!-- end new-->
</head>

<body id="page-top" onLoad="getGeolocation()">
<?php

/* 	echo $sqlselect = "SELECT createdon, mainmenu, submenu, remarks, title, version FROM swupdates WHERE DATE(createdon) = CURDATE();";
				  
        $queryselect = mysqli_query($connection1, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         if($rowCountselect > 0) 
		{
			$count=1;
			echo $rowCountselect;
			$rowselect = mysqli_fetch_array($queryselect); 
			*/
				
				if(($_SESSION['notificationview']=='0') && ($_SESSION['notificationview']!='1') )
{ 
?>
 <div class="popup-overlay">
    <div class="popup-container">
      <div class="popup-card">
        <h2><b>"Don't Miss Out"</b></h2>
        <p>Explore Our Software's Recent Updates!</p>
        <button   name="close_popup" id="close_popup">ok</button> 
		
          <button  name="yesButton" id="yesButton">View</button>
          <!-- Include any hidden fields needed for your database update here -->
        
      </div>
    </div>
  </div>
    <?php
			
		}

?>
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
		  
		  <!-- start tat part--->
                   <div class="row mt-3">
					<div class="col-xl-6 col-md-6 text-primary" style="font-weight:bold">
					<!--PLAN:<?php
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
					?><BR>-->
					Average TAT: <span id="tat">0</span> Hours
					</div>
                        <!--<div class="col-xl-6 col-md-6 ">
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

                        </div>-->
                    </div>
					
<!-- end tat part--->
					<br>
					
					
					
					
					
                    <div class="row">
						<div class="col-lg-12">
						
						
						
		
						
							<div class="row">
                        <?php
						if($callview=='1')
						{
					if(!isset($_POST['submit']))
		  {	
				  $carryinoemopen=0;
				  $carryingodownopen=0;
				  $carryinoempend=0;
				  $carryingodownpend=0;
				  $carryinoemcomp=0;
				  $carryingodowncomp=0;
				  
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
				  
		 $sqlcall = "SELECT engineerid,engineersid,calltype, compstatus, callon, changeon, servicetype, suppliername,godownname, dcno From jrccalls ".$dashcallonsearch." order by id desc";
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
					
											//start carry in
						if($rowcall['servicetype']=='Carry-In')
						{
							if($rowcall['compstatus']=='0')
				{
				if(($rowcall['suppliername']!='')&&($rowcall['suppliername']!='NULL'))
				{
					$carryinoemopen++;
				}
				if(($rowcall['godownname']!='')&&($rowcall['godownname']!='NULL'))
				{
					$carryingodownopen++;
				}
				}
				
						
				if($rowcall['compstatus']=='1')
				{
				if(($rowcall['dcno']!='')&&($rowcall['dcno']!='NULL'))
				{
					$carryinoempend++;
				}else{
					$carryingodownpend++;
				}
				}
				if($rowcall['compstatus']=='2')
				{
				if(($rowcall['dcno']!='')&&($rowcall['dcno']!='NULL'))
				{
					$carryinoemcomp++;
				}else{
					$carryingodowncomp++;
				}
				}
				}
				
				
		//end carry in
		 
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
		
		
		
		
 
		
	
		<div class="col-lg-12 mb-4">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
    <div class="row align-items-center">
	
	
<!--<div class="col-lg-4 col-md-3 col-3 text-center">
    <button class="btn btn-blue btn-md" id="book-complaint" onclick="showSearchBox()"><b>Book Complaint</b></button>
    <div class="search-container" id="search-container" style="display:none;">
        <form class="form-inline navbar-search" action="consigneeview.php" method="get">
            <div class="input-group">
                <input type="hidden" name="id" id="existsearchid">
                <input type="text" id="existsearch" name="existsearch1" class="form-control border-0 small btn-blue" placeholder="Customer Name, Area, Mobile, etc..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-navb" type="submit">
                        <i class="fas fa-search fa-sm" id="search-icon"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>	
</div>-->
<div class="col-lg-4 col-md-6 col-6 text-center">
			<form class="form-inline navbar-search" action="consigneeview.php" method="get">

            <div class="input-group">
                <input type="hidden" name="id" id="existsearchid"> <button class="btn btn-blue btn-md" ><b>Book Complaint</b></button>
       
        <!--<label style="font-size:15px"><b>Book Complaint </b></label>-->
				
                <input type="text" id="existsearch" name="existsearch1" class="form-control border-0 small" placeholder="Customer Name, Area, Mobile, etc..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-navb" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
			
</form>
        </div>


        <div class="col-lg-4 col-md-6 col-6 text-center">
            <h6 style="color:#04121f; font-size:20px;" class="m-0"><b>Easy Profit - Post Sales Service CRM</b></h6>
        </div>
        <div class="col-lg-4 col-md-3 col-3 text-center">
            
			 <button class="btn btn-blue btn-md" onclick="location.href='callnew.php'"><b>Add New Customer</b></button>
       
        </div>
    </div>
</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">		
				<!--<div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-color1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex1 align-items-center text-center">
				<div> 
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><span  class="mb-0 text-dark"><b>Service Calls</b></span></h5>
				<p style="text-align: center;line-height:normal;"><a href="existingcon.php"><span  class="mb-0 text-dark"><b>New Call</b></span></a></p>
				<p style="text-align: center;"><a href="callreportpage.php"><span  class="mb-0 text-dark"><b>Call Report</b></span></a></p>
                </div>
				<div class="number-box" style="background-color:#6cdade"> 
                    <i class="fa fa-phone"></i>
                   </div>     
                </div>
              </div>
            </div>
          </div>
		  <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-color5">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex1 align-items-center text-center">
				<div>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a href="inhousedashboard.php"><span  class="mb-0 text-dark"><b>Carry In<br>Dashboard</b></span></a></h5>
                </div>
				<div class="number-box" style="background-color:#a2cef1"> 
                    <i class="fa-solid fa-house"></i>
                   </div>      
                </div>
              </div>
            </div>
          </div> -->
		  
		   <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew2 shadow radius-10 border-start border-0 border-3 border-color1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex1 align-items-center text-center">
				<div>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a><span  class="mb-0 text-dark"><b>Reports</b></span></a></h5>
				
				<p style="text-align: center;line-height:normal;"><a href="scrdetails.php"><span  class="mb-0 text-dark"><b>Service Call Reports</b></span></a></p>
				<?php
				if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
				{
				?>
					<p style="text-align: center; line-height:normal;"><a href="report.php"><span  class="mb-0 text-dark"><b>Analytical Reports</b></span></a></p><?php
				}
				else
				{
					?>
				<p style="text-align: center; line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Analytical Reports</b></span></a></p><?php
				}
				?>
				
				<!--<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a href="report.php"><span  class="mb-0 text-dark"><b>Analytical Report</b></span></a></h5>-->
                </div>
				<!--<div class="number-box" style="background-color:#6cdade"> 
                    <i class="fa fa-bar-chart"></i>
                   </div>  	-->
				   <br>
				   <!--<p style="text-align: center;"><a href="scrdetails.php"><span  class="mb-0 text-dark"><b>Call Report</b></span></a></p>  -->
				<div>
				<!--<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a href="scrdetails.php"><span  class="mb-0 text-dark"><b>Call Report</b></span></a></h5>-->
                </div>				   
                </div>
              </div>
            </div>
          </div>
		  
		  
		  <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew2 shadow radius-10 border-start border-0 border-3 border-color2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex1 align-items-center text-center">
				<div>
				
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a><span  class="mb-0 text-dark"><b>Quotations</b></span></a></h5>
				<p style="text-align: center;line-height:normal;"><a href="newquotationadd.php?noofproduts=1&noofscraps=1&submit="><span  class="mb-0 text-dark"><b>New Quotation</b></span></a></p>
				<p style="text-align: center; line-height:normal;"><a href="quotationpage.php"><span  class="mb-0 text-dark"><b>View Quotations</b></span></a></p>
				<p style="text-align: left;line-height:normal;"><a href="quotationtoso.php"><span  class="mb-0 text-dark"><b>Convert Quote to SO</b></span></a></p>
				<?php
				}
				else
				{
					?>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Quotations</b></span></a></h5>
				<p style="text-align: center;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>New Quotation</b></span></a></p>
				<p style="text-align: center; line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>View Quotations</b></span></a></p>
				<p style="text-align: left;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Convert Quote to SO</b></span></a></p>
				<?php
				}
				?>
                </div>
				<!--<div class="number-box" style="background-color:#eda0cf"> 
                    <i class="fa fa-check"></i>
                   </div>   -->       
                </div>
              </div>
            </div>
          </div> 
		
		    <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew2 shadow radius-10 border-start border-0 border-3 border-color3">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex1 align-item text-center ">
				<div>
				 <?php if(($liveplan=='DIAMOND'))
				{?>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a><span  class="mb-0 text-dark"><b>Sales Order Management</b></span></a></h5>
		<div class="container1">
        <div class="left">
            <p><a href="singleexporttallyadd.php?noofconsignee=1&maxproduct=1&getsubmit=Submit"><span class="mb-0 text-dark"><b>Single Sales Order Entry</b></span></a></p>
			<p><a href="draftlisting.php"><span class="mb-0 text-dark"><b>Sales Order Draft</b></span></a></p>
			<p><a href="exporttally.php"><span class="mb-0 text-dark"><b>Pending Sales Orders</b></span></a></p>
        </div>
        <div class="right">
		
            <p><a href="exporttallyadd.php"><span class="mb-0 text-dark"><b>Multiple Sales Orders Entry</b></span></a></p>
			
            <p><a href="exporttallysearch.php"><span class="mb-0 text-dark"><b>Search Sales Orders</b></span></a></p>
            <p><a href="compexporttally.php"><span class="mb-0 text-dark"><b>Completed Sales Orders</b></span></a></p>
        </div>
    </div>
	<?php }else{ ?>
		<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><a><span  class="mb-0 text-dark" style=" opacity:0.5;"><b>Sales Order Management</b></span></a></h5>
		<div class="container1">
        <div class="left">
		
		
		
            <p><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style=" opacity:0.5;"><b>Single Sales Order Entry</b></span></a></p>
			<p><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style=" opacity:0.5;"><b>Sales Order Draft</b></span></a></p>
			<p><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style=" opacity:0.5;"><b>Pending Sales Orders</b></span></a></p>
        </div>
        <div class="right">
		
            <p><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style=" opacity:0.5;"><b>Multiple Sales Orders Entry</b></span></a></p>
			
            <p><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style=" opacity:0.5;"><b>Search Sales Orders</b></span></a></p>
            <p><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style=" opacity:0.5;"><b>Completed Sales Orders</b></span></a></p>
        </div>
    </div>
		<?php } ?>
                </div>
				<!--<div class="number-box" style="background-color:#b590e1"> 
                    <i class="fa fa-check"></i>
                   </div>   -->       
                </div>
              </div>
            </div>
          </div> 
				
		  
		  <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew2 shadow radius-10 border-start border-0 border-3 border-color4">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex1 align-items-center text-center">
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
				?>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><span  class="mb-0 text-dark"><b>Bills</b></span></h5>
				<p style="text-align: center;line-height:normal;"><a href="exporttallylisting.php?type=dc"><span class="mb-0 text-dark"><b>Delivery Challan</b></span></a></p>
			   <!--	<p style="text-align: center;line-height:normal;"><a href="exporttallylisting.php?type=ic"><span  class="mb-0 text-dark"><b>Installation Certificate</b></span></a></p>-->
				<p style="text-align: center;line-height:normal;"><a href="exporttallylisting.php?type=inv"><span  class="mb-0 text-dark"><b>Invoice /  E-Invoice</b></span></a></p>
				<p style="text-align: center;line-height:normal;"><a href="exporttally.php"><span  class="mb-0 text-dark"><b>E-Way Bill</b></span></a></p>
				<?php
				}
				else
				{
				?>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Bills</b></span></h5>
				<p style="text-align: center;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style="opacity:0.5;"><b>Delivery Challan</b></span></a></p>
			   <!--	<p style="text-align: center;line-height:normal;"><a href="exporttallylisting.php?type=ic"><span  class="mb-0 text-dark"><b>Installation Certificate</b></span></a></p>-->
				<p style="text-align: center;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Invoice /  E-Invoice</b></span></a></p>
				<p style="text-align: center;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;" ><b>E-Way Bill</b></span></a></p>
				<?php
				}
				?>
                </div>
				<!--<div class="number-box" style="background-color:#aeeba3"> 
                    <i class="fas fa-file-alt"></i>
                   </div>  -->    
                </div>
              </div>
            </div>
          </div> 
		  <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew2 shadow radius-10 border-start border-0 border-3 border-color5">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex1 align-items-center text-center">
				<div><?php
				if(($liveplan=='DIAMOND'))
				{
					?>
				<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><span  class="mb-0 text-dark"><b>Payments</b></span></h5>
				<p style="text-align: center;line-height:normal;"><a href="salespayadd.php"><span class="mb-0 text-dark"><b>Payment Entry</b></span></a></p>
			   	<p style="text-align: center;line-height:normal;"><a href="outsalespay.php"><span  class="mb-0 text-dark"><b>Outstanding Payments</b></span></a></p>
				<p style="text-align: center;line-height:normal;"><a href="resalespay.php"><span  class="mb-0 text-dark"><b>Received Payments</b></span></a></p>
				 <?php
				}
				else
				{
					?>
					
					<h5 style="font-size: 13px;font-weight: 800; margin-bottom: 5px;text-decoration: underline;"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Payments</b></span></h5>
				<p style="text-align: center;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark" style="opacity:0.5;"><b>Payment Entry</b></span></a></p>
			   	<p style="text-align: center;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Outstanding Payments</b></span></a></p>
				<p style="text-align: center;line-height:normal;"><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Received Payments</b></span></a></p>
				<?php
				}
				?>
                </div>
				<!--<div class="number-box" style="background-color:#a2cef1"> 
                    <i class="fas fa-file-alt"></i>
                   </div>  -->    
                </div>
              </div>
            </div>
          </div> 
		
		 
		 
        
          </div>
          </div>		
</div>						
</div>	













<div class="col-lg-6 mb-4">
			<div class="card shadow cardb" role="button">
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Call Progress Statistics</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				
				<div class="row ">
	
					  
   <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
		
				
					<a href="calls.php?status=Received"><span  class="mb-0 text-dark"><b>Received Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-info1 text-center" style="font-size:1.5em;"><?=$totalcalls?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-info1 text-center" style="font-size:1.5em;"><?=$todaycalls?></h4>
				<?php } ?>
				
				
				
				<div class="row">
				<div class="col-12 text-center">
				<?php $reconsite=$otodayacalls+$otodayocalls; ?>
				<span  class="mb-0 text-dark "><b>On-Site</b></span>-<span  class="mb-0 text-info1"><?=$reconsite?></span>
				</div>
				<!--<div class="col-12 text-center">
				<?php $reccarryin=$itodayacalls+$itodayocalls; ?>
				<span  class="mb-0 text-dark "><b>Carry-In</b></span>-<span  class="mb-0 text-info1"><?=$reccarryin?></span>
				</div>-->
				</div>
				
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
												<!--<div class="col-6">
													<h6 class="text-info1 mt-3 mb-1">Carry-In</h6>
													<span style="font-size:1em;">SC : <?=$itodayacalls?> <br> OC :
                                                    <?=$itodayocalls?><br></span></div>-->
													
													<div class="col-12">
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
				<a href="calls.php?status=Assigned"><span  class="mb-0 text-dark"><b>Assigned Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-danger1 text-center" style="font-size:1.5em;"><?=$totalassigned?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-danger1 text-center" style="font-size:1.5em;"><?=$todayassigned?></h4>
				<?php } ?>
				
				<div class="row">
				<div class="col-12 text-center">
				<?php $assignonsite=$otodayaassigned+$otodayoassigned; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-danger1"><?=$assignonsite?></span>
				</div>
				<!--<div class="col-12 text-center">
				<?php $assigncarryin=$itodayaassigned+$itodayoassigned; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-danger1"><?=$assigncarryin?></span>
				</div>-->
				</div>
				
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
													<div class="row">
													<!--<div class="col-6"><h6 class="text-danger1 mt-3 mb-1">Carry-In</h6>
													<span style="font-size:1em;">SC : <?=$itodayaassigned?> <br> OC :
                                                    <?=$itodayoassigned?><br></span></div>-->
													
													
													<div class="col-12">
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
                  <a href="calls.php?status=0"><span  class="mb-0 text-dark"><b>Open Calls</b></span></a>
				   <h4 class="my-1 text-success1 text-center" style="font-size:1.5em;"><?=$totalopen?></h4>
				<div class="row">
				<div class="col-12 text-center">
				<?php $openonsite=$ototalaopen+$ototaloopen; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-success1"><?=$openonsite?></span>
				</div>
				<!--<div class="col-12 text-center">
				<?php $opencarryin=$itotalaopen+$itotaloopen; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-success1"><?=$opencarryin?></span>
				</div>-->
				</div>
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
					<div class="row">
					<!--<div class="col-6"><h6 class="text-success1 mt-3 mb-1">Carry-In</h6>
					 <span style="font-size:1em;">SC : <?=$itotalaopen?> <br> OC : <?=$itotaloopen?></span><br>
					<span style="font-size:0.75em;"><b>Today</b> <br> SC : <?=$itodayaopen?> <br> OC : <?=$itodayoopen?> </span><br>
					<span style="font-size:0.75em;"> <b>Old</b> <br>  SC : <?=$ioldaopen?> <br> OC : <?=$ioldoopen?> </span></div>-->
					<br>
					<div class="col-12"><h6 class="text-success1 mt-3 mb-1" >On-Site</h6> 
					<span style="font-size:1em;">SC : <?=$ototalaopen?> <br> OC : <?=$ototaloopen?></span><br>
					<span style="font-size:0.75em;"><b>Today</b><br>  SC : <?=$otodayaopen?> <br> OC : <?=$otodayoopen?> </span><br>
					<span style="font-size:0.75em;"><b> Old</b> <br>SC : <?=$ooldaopen?> <br> OC : <?=$ooldoopen?> </span></div></div><br>
					<?php
												}
										?>	</span>	
      </div>
	  <!--
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
                   <h4 class="my-1 text-warning2"><?=$wcount?></h4>
				  
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
          </div>		-->  
		  <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
			   <div>
                   <a href="calls.php?status=1"><span  class="mb-0 text-dark"><b>Pending Calls</b></span></a>
				   <h4 class="my-1 text-info2 text-center" style="font-size:1.5em;"><?=$totaltodaypending?></h4> 
				   
				   	<div class="row">
				<div class="col-12 text-center">
				<?php $pendonsite=$ototaltodayapending+$ototaltodayopending; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-info2"><?=$pendonsite?></span>
				</div>
				<!--<div class="col-12 text-center">
				<?php $pendcarryin=$itotaltodayapending+$itotaltodayopending; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-info2"><?=$pendcarryin?></span>
				</div>-->
				</div>
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
					<!--<div class="col-6">
					<h6 class="text-info2 mt-3 mb-1">Carry-In</h6> 
					<span style="font-size:1em;">SC : <?=$itotaltodayapending?> <br> OC : <?=$itotaltodayopending?></span> <br> 
					<span style="font-size:0.75em;"><b>Today</b> <br> SC : <?=$itodayapending?> <br> OC : <?=$itodayopending?> </span><br>
					<span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$ioldapending?> <br> OC : <?=$ioldopending?> </span>
					</div>-->
					<div class="col-12">
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
				  <a href="calls.php?status=2&lform=dashboard"><span  class="mb-0 text-dark"><b>Completed Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-danger2 text-center" style="font-size:1.5em;"><?=$totalcomplete?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-danger2 text-center" style="font-size:1.5em;"><?=$totaltodaycomplete?></h4>
				<?php } ?>
				
				
				<div class="row">
				<div class="col-12 text-center">
				<?php $componsite=$ototaltodayacomplete+$ototaltodayocomplete; ?>
				<span  class="mb-0 text-dark"><b>On-Site</b></span>-<span  class="mb-0 text-danger2"><?=$componsite?></span>
				</div>
				<!--<div class="col-12 text-center">
				<?php $compcarryin=$itotaltodayacomplete+$itotaltodayocomplete; ?>
				<span  class="mb-0 text-dark"><b>Carry-In</b></span>-<span  class="mb-0 text-danger2"><?=$compcarryin?></span>
				</div>-->
				</div>
				
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
												
												<div class="row">
												<!--<div class="col-6"><h6 class="text-danger2 mt-3 mb-1">Carry-In</h6> 
											<span style="font-size:1em;">SC : <?=$itotaltodayacomplete?> <br>OC : <?=$itotaltodayocomplete?></span><br>
											<span style="font-size:0.7em;"><b>Today</b> <br> SC : <?=$itodayacomplete?> <br> OC : <?=$itodayocomplete?> </span><br>
											<span style="font-size:0.75em;"><b>Old</b><br> SC : <?=$ioldacomplete?> <br> OC : <?=$ioldocomplete?> </span><br></div>-->
											<div class="col-12"><h6 class="text-danger2 mt-3 mb-1">On-Site</h6> 
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
		
   <!--<div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-success2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv5">
				<div>
				  <a href="calls.php?status=3&lform=dashboard"><span  class="mb-0 text-dark"><b>Cancelled Calls</b></span></a>
				<?php  if(isset($_POST['submit'])) { ?> 
				<h4 class="my-1 text-success2"><?=$totalcancel?></h4>
				<?php } else { ?>
				<h4 class="my-1 text-success2"><?=$totaltodaycancel?></h4>
				<?php } ?>
				</div>
				<div class="widgets-icons-success2 ms-auto" >
		<i class="bx bxs-phone-off"></i>
		</div>
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
												
												<div class="row"><div class="col-6"><h6 class="text-success2 mt-3 mb-1">Carry-In</h6> 
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
				  
           
      </div>-->
	  
	  
   <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="ocalls.php"><span class="mb-0 text-dark" ><b>Observation Calls</b></span></a>
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
						
						
				
						
<div class="col-lg-6 mb-4">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Call Progress Statistics</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px!important">		
				<div class="row">

   <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
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
	  
      <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
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
	  
	     <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-success1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
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
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="wcalls.php"><span class="mb-0 text-dark"><b>Waiting for </br>Approval</b></span></a>
                   <h4 class="my-1 text-success1" style="font-size:1.5em;"><?=$wcount?></h4>
				   
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Waiting for </br>Approval</b></span></a>
					<?php
				}
				?>    
</div>
				  <div class="widgets-icons-success1 ms-auto">
		<i class="bx bxs-message-rounded-check"></i>
		</div>				
                </div>
              </div>
            </div>
          </div>
     
     <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
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
      <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
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
	  <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-success2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="ocalls.php"><span class="mb-0 text-dark" ><b>Observation <br>Calls</b></span></a>
				  <h4 class="my-1 text-success2" style="font-size:1.5em;"><?=$ocount?></h4>
				  
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Observation <br>Calls</b></span></a>
					<?php
				}
				?>
				 </div>
				  <div class="widgets-icons-success2 ms-auto">
		<i class="bx bxs-phone-call"></i>
		</div>
             </div>
              </div>
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
/* if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
{ */
?>

<?php
if(($amcmanagement=="1")||($warrantymanagement=="1"))
{
	?>
	<!--<div class="col-lg-2 mb-4">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0   text-center"><b>AMC & WTY</b></h6>
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
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-express1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv10">
				<div>
               <?php
				if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
				{
					?>
				<a href="amccustomers.php"><span  class="mb-0 text-dark"><b>AMC <BR>Customers</b></span></a>
				
                  <h4 class="mb-2 text-express1"><?=count($a)?></h4>
                   
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe GOLD PLAN or DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>AMC <BR>Customers</b></span></a>
					<?php
				}
				?>
                </div><div class="widgets-icons-express1 ms-auto" >
		<i class="bx bxs-user-check"></i>
		</div>
              </div>
            </div>
          </div><span class="tooltip11 callouts--top"> <span style="font-size:1em;">Products : <?=$totalamc?></span><br>
                  <span style="font-size:1em;">AMC Denied : <?=$denied?></span></span>
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
		<div class="col-xl-12 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-express2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv11">
				<div>
				<?php
				if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
				{
					?>
				<a href="warrantycustomers.php"><span class=" mb-0 text-dark" style="color:<?=$jerobytecolors[$ad];?>; "><b>Warranty Customers</b></span></a>
                  <h4 class="mb-2 text-express2"><?=count($a)?></h4>
                
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe GOLD PLAN or DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Warranty Customers</b></span></a>
					<?php
				}
				?>
				 </div>
				 <div class="widgets-icons-express2 ms-auto" >
		<i class="bx bxs-award"></i>
		</div>
              </div>
            </div>
          </div>
		   <span class="tooltip12 callouts--top"> <span style="font-size:1em;">Products : <?=$totalwarranty?></span></span>
		</div>
   


<?php
						}
						?>
</div>
</div>
</div>
</div> -->
<?php
}
/* } */
?>
<!--col 2-->

					
	<?php
/* if($liveplan=='DIAMOND')
{ */
?>													
		<div class="col-lg-3 mb-4">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Co-Ordinator Dashboard</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">		
				  <!--<div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-pink1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
				<a href="#.php"><span  class="mb-0 text-dark"><b>Assigning Status</b></span></a>
				</div><div class="widgets-icons-pink1 ms-auto" >
		<i class="bx bxs-package"></i>
		</div>
	</div>
      </div>
  </div>
      </div>-->
      <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-express2">
            
					 <div class="card shadow mb-2">
                <div class="card-header py-1">
                    <a class="m-0 text-dark"><b>Engineer's Call Request</b>
					<?php
				/* if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="callrequest.php" class="float-right"><b>View Call Request</b></a>
							<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-right"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;"><b>View Call Request</b></span></a>
					<?php
				} */
				?>
							</a>
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
				  $sqlselect = "SELECT id,engineerid,requestengineerid,consigneeid From jrccalls where callrequest='1' and compstatus!='2' group by id order by id asc";
				  
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
if($rowselect['engineerid']!=$rowselect['requestengineerid'])
{	
			$sqlselect1 = "SELECT id,consigneename,engineername From jrcconsignee where id='".$rowselect['consigneeid']."'";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowselect1 = mysqli_fetch_array($queryselect1);
			$sqlselect2 = "SELECT id,engineername From jrcengineer where id='".$rowselect['requestengineerid']."'";
			$queryselect2 = mysqli_query($connection, $sqlselect2);
			$rowselect2 = mysqli_fetch_array($queryselect2);
			?>
                            <li>
                               <b> <span class="text-dark">Call Transfer request from <?=$rowselect2['engineername']?></span> for <span class="text-primary"><a
                                    href="callsmodify.php?id=<?=$rowselect['id']?>"><?=$rowselect1['consigneename']?></a></span></b>
                                
                            </li>
                            <?php
		  $count++;
}
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
					
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-center"><span class="mb-0 text-secondary"><b>Call Request From Engineer</b></span></a>
					</p>
					<?php
					
				}
				?>
                </div>
				
            </div>
					</div>
				
            </div>
					
		 		<div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-pink1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertpreventive.php"><span class="mb-0 text-dark" ><b>Warranty <br>Maintenance</b></span></a>
					
                
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>warranty <BR>Maintenance</b></span></a>
					<?php
				}
				?></div>
				<div class="widgets-icons-pink1 ms-auto" >
		<i class="bx bxs-calendar-check"></i>
		</div>
				              
                </div>
              </div>
            </div>
          </div>
		  <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-pink1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
				<?php if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
				{ ?>
				<a href="mapengineerda.php"><span  class="mb-0 text-dark"><b>Engineer Performance Report</b></span></a>
				 <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark"style="opacity:0.5;" ><b>Engineer Performance Report</b></span></a>
				<?php } ?>
				</div>
				
				<div class="widgets-icons-pink1 ms-auto" >
		<i class="bx bxs-package"></i>
		</div>
	</div>
      </div>
  </div>
      </div>
         
		<!--  <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				
					<a href="alertpreventive.php"><span class="mb-0 text-dark" ><b>Average <br>TAT</b></span></a>
                  <h4 class="mb-2 text-warning1"><?=$preventive?></h4> 
                
                  
				</div>
				<div class="widgets-icons-warning1 ms-auto" >
		<i class="bx bxs-calendar-check"></i>
		</div>
				              
                </div>
              </div>
            </div>
          </div>
		  <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				
					<a href="alertpreventive.php"><span class="mb-0 text-dark" ><b>Notifications</b></span></a>
                  <h4 class="mb-2 text-danger2"><?=$preventive?></h4> 
                
                  </div>
				<div class="widgets-icons-danger1 ms-auto" >
		<i class="bx bxs-calendar-check"></i>
		</div>
				              
                </div>
              </div>
            </div>
          </div>-->
		    <!-- <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div> 
                <a href="mapcustomers.php"><span class="mb-0 text-dark"><b>Customer Population Map</b></span></a>
			</div>
				<div class="widgets-icons-info2 ms-auto" >
		<i class="bx bxs-map-pin"></i>
		</div>
				              
                </div>
              </div>
            </div>
          </div>-->
		 <!--  <div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-express2">
            
				<!--callreq-->
					
					<!-- <div class="card shadow mb-2">
                <div class="card-header py-1">
                    <a class="m-0 text-dark"><b>Engineer's Call Request</b>
					<?php
				/* if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="callrequest.php" class="float-right"><b>View Call Request</b></a>
							<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-right"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;"><b>View Call Request</b></span></a>
					<?php
				} */
				?>
							</a>
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
				  $sqlselect = "SELECT id,engineerid,requestengineerid,consigneeid From jrccalls where callrequest='1' and compstatus!='2' group by id order by id asc";
				  
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
if($rowselect['engineerid']!=$rowselect['requestengineerid'])
{	
			$sqlselect1 = "SELECT id,consigneename,engineername From jrcconsignee where id='".$rowselect['consigneeid']."'";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowselect1 = mysqli_fetch_array($queryselect1);
			$sqlselect2 = "SELECT id,engineername From jrcengineer where id='".$rowselect['requestengineerid']."'";
			$queryselect2 = mysqli_query($connection, $sqlselect2);
			$rowselect2 = mysqli_fetch_array($queryselect2);
			?>
                            <li>
                               <b> <span class="text-dark">Call Transfer request from <?=$rowselect2['engineername']?></span> for <span class="text-primary"><a
                                    href="callsmodify.php?id=<?=$rowselect['id']?>"><?=$rowselect1['consigneename']?></a></span></b>
                                
                            </li>
                            <?php
		  $count++;
}
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
					
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-center"><span class="mb-0 text-secondary"><b>Call Request From Engineer</b></span></a>
					</p>
					<?php
					
				}
				?>
                </div>
				
            </div>-->
					
					
					
				<!--callreq-->
				
				
				
				          
		
		  
        
					
					
	  
	 <!-- <div class="col-xl-3 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-green1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" >
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertamcexpire.php"><span class="mb-0 text-dark" ><b>AMC <br>Expiry</b></span></a>
				   <h4 class="mb-2 text-green1"><?=$amcexpire?></h4> 
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>AMC <BR>Expiry</b></span></a>
					<?php
				}
				?></div>
				<div class="widgets-icons-green1 ms-auto" >
		<i class="bx bxs-pie-chart"></i>
		</div>
				
				
				                
                </div>
              </div>
            </div>
          </div>
		
	  
	  <div class="col-xl-3 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-pink2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" >
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertwarrantyexpire.php"><span class="mb-0 text-dark" style="color:<?=$jerobytecolors[$ad]?>;"><b>Warranty <br>Expiry</b></span></a>
                  <h4 class="mb-2 text-pink2"><?=$warrantyexpire?></h4> 
                  <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Warranty <BR>Expiry</b></span></a>
					<?php
				}
				?>
				</div>
				<div class="widgets-icons-pink2 ms-auto" >
		<i class="bx bxs-pie-chart-alt"></i>
		</div>
				
				                
                </div>
              </div>
            </div>
          </div>-->
		  
	 
	  
	  
				
					 <!--<div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
			   <div>
                   <a href="currentlocation.php"><span  class="mb-0 text-dark"><b>Available Engineer - Nearby the Customer Location</b></span></a>
				   
				   </div>
				<div class="widgets-icons-danger1 ms-auto" >
		<i class="bx bxs-location-plus"></i>
		</div>
				  
				   </div>
          </div>
        </div>
               
      </div> -->
	  
        <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-green2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="alertamcmaintenance.php"><span class="mb-0 text-dark" style="color:<?=$jerobytecolors[$ad]?>;"><b>AMC <br>Maintenance</b></span></a>
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
		
		  
	 
	  
	  
		
</div>						
</div>						
</div>						
</div>		

<div class="col-lg-3 mb-4">
			<div class="card shadow cardb" role="button" >
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Profit Alerts</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">		
				
				
        <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv1">
				<div>
				<a href="warrantycustomers.php"><b><span  class="mb-0 text-dark">Warranty Ending Soon - </span><span  class="mb-0 text-success">Act Now</span></b></a>
				</div>
				<div class="widgets-icons-danger1 ms-auto" >
		<i class="bx bxs-layer-minus"></i>
		</div>
		
            </div>
          </div>
        </div> 
      </div>
	 <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv4">
				<div>
				  <a href="amcgoingtoexpirecustomers.php?day=90"><b><span  class="mb-0 text-dark">AMC Ending Soon - </span><span  class="mb-0 text-success">Act Now</span></b></a>
				</div>
				<div class="widgets-icons-danger2 ms-auto" >
		<i class="bx bxs-layer-minus"></i>
		</div>
		 </div>
          </div>
        </div>
     
				  
           
      </div>
		
		
		 <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="wcalls.php"><span class="mb-0 text-dark"><b>Waiting for Approval</b></span></a>
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
		  
		<!--  <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
					<a href="revenue.php"><span class="mb-0 text-dark"><b>Serv / AMC Income (₹)</b></span></a>
					<?php  

$sqli=mysqli_query($connection, "select sum(scharge) as scharge, schargedate, cashstatus from jrccalldetails where srno!='' and scharge!='' and scharge!='0' and scharge!='0.00' and incgst!='2' and (schargedate > now() - INTERVAL 7 MONTH) ".$dashschargesearch."  and cashstatus!='1' group by schargedate, cashstatus order by cast(schargedate as date) asc");

        $rowCount=mysqli_num_rows($sqli);
		 if($rowCount > 0) 
		{ $tobecollect=0;
			while($rowi = mysqli_fetch_array($sqli)) 
			{
				

$tobecollect+=$rowi['scharge'];
		}}	$roundedValue = round($tobecollect);
		
	 $sqli2=mysqli_query($connection, "select sum(totalvalue) as totalvalue,sum(receivedamount) as receivedamount, datefrom from jrcamc where totalvalue!='' and totalvalue!='0' and totalvalue!='0.00'  and (datefrom > now() - INTERVAL 7 MONTH) ".$dashschargesearch1." group by datefrom order by cast(datefrom as date) asc");
  $rowCount2=mysqli_num_rows($sqli2);
		 if($rowCount2 > 0) 
		{ $tobecollect2=0;
			while($rowi2 = mysqli_fetch_array($sqli2)) 
			{
				
$s=$rowi2['totalvalue']-$rowi2['receivedamount'];
$tobecollect2+=$s;
		}}
		$roundedValue2 = round($tobecollect2);
	
?>
	<?php  ?>	
		<h6 class="my-1 text-warning2"><?=$roundedValue?> / <?=$roundedValue2?></h6>
		
 </div>
				  <div class="widgets-icons-warning2 ms-auto">
		<i class="bx bxs-message-rounded-check"></i>
		</div>				
                </div>
              </div>
            </div>
          </div>	-->	
		
	  
		
	  
	  <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
					<!--<a href="productlifetimeexpire.php?datefrom=<?=date('Y-m-01')?>&dateto=<?=date('Y-m-t')?>"><span class="mb-0 text-dark"><b>Product Lifetime Expiry</b></span></a>-->
					<a href="productlifetimeexpire.php?datefrom=<?= date('Y-m-01') ?>&dateto=<?= date('Y-m-t', strtotime('+2 months')) ?>"><span class="mb-0 text-dark"><b>Product Lifetime Expiry</b></span></a>
				  	
		
 </div>
				  <div class="widgets-icons-warning2 ms-auto">
		<i class="bx bxs-message-rounded-check"></i>
		</div>				
                </div>
              </div>
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
<!--- customer and engineer -->
			 
						
	<div class="col-lg-3">
	
	
	<div class="card shadow cardb" role="button">
        <div class="card-header py-2">
            <h6 style="color:#04121f" class="m-0 text-center"><b>Overall Revenue</b></h6>
        </div>
        <div class="card-body">
            <canvas id="combinedChart" style="width:100%; height:215px;"></canvas>
        </div>
    </div>
                         <!--   <div class="card shadow cardb" role="button">
                                <div class="card-header py-2">
                                    <h6 style="color:#04121f" class="m-0  "><b>Carry-In Monthwise Revenue </b><span
                                            class="text-primary float-right"><b>( To be Collected: Rs. <span
                                                id="tobecollectedcarry"></span> )</b></span></h6>
                                </div>
                                <div class="card-body">
								
								<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<canvas id="myChart1" style="width:100%; height:200px;"></canvas>
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
							</div>-->
                        </div>
						
				
				
				
				
				<div class="col-lg-4 mb-4">
			<div class="card shadow cardb" role="button">
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Customer Dashboard</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">
	 <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
				<a href="warrantycustomersall.php"><span  class="mb-0 text-dark"><b>Warranty Customers</b></span></a>
                   
				</div>
				<div class="widgets-icons-info1 ms-auto" >
		<i class="bx bx-check"></i>
		</div>
				
	</div>
      </div>
  </div>
      </div>
		  <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
			   <div>
                   <a href="amccustomers.php"><span  class="mb-0 text-dark"><b>AMC Customers</b></span></a>
				   </div>
				<div class="widgets-icons-info2 ms-auto" >
		<i class="bx bx-check"></i>
		</div>
				  
				   </div>
          </div>
        </div>
               
      </div>
<div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
				<div> 
                <a href="mapcustomers.php"><span class="mb-0 text-dark"><b>Customer Population Map</b></span></a>
			</div>
				<div class="widgets-icons-danger2 ms-auto" >
		<i class="bx bxs-map-pin"></i>
		</div>
				              
                </div>
              </div>
            </div>
          </div>
		  
		  <?php
				$preventive=0;
				$amcmaintenance=0;
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
						if($rowselect['remindertype']=='AMC MAINTENANCE')
						{
							$amcmaintenance=(float)$rowselect['count'];
						}
					}
				}
				?>
   <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-success1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv2">
			   <div>
			   <?php
				if(($liveplan=='DIAMOND'))
				{
					?>
                  <a href="warrantycustomersexpired.php"><span  class="mb-0 text-dark"><b>Warrranty Expired Customers</b></span></a>
				   <?php
				}
				else
				{
					?>
				   <a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Warrranty Expired Customers</b></span></a>
				<?php } ?>
				   </div>
				                  
				   <div class="widgets-icons-success1 ms-auto" >
		<i class="bx bx-notification"></i>
		</div>
		
            </div>
          </div>
        </div>
	
      </div>
	  
   <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-success2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv5">
				<div>
				 <?php
				if(($liveplan=='DIAMOND'))
				{
					?>
				
				  <a href="amcexpiredcustomers.php"><span  class="mb-0 text-dark"><b>AMC Expired Customers</b></span></a>
				  <?php
				}
				else
				{
					?>
				  <a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>AMC Expired Customers</b></span></a>
				  <?php } ?>
				  
				</div>
				<div class="widgets-icons-success2 ms-auto" >
		<i class="bx bx-notification"></i>
		</div>
				   </div>
          </div>
        </div> 
     
				  
           
      </div> 
	  
	 <div class="col-xl-4 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-danger1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv5">
				<div>
				  <a href="consignee.php"><span  class="mb-0 text-dark"><b>Customers Details</b></span></a>
				 </div>
				<div class="widgets-icons-danger1 ms-auto" >
		<i class="bx bx-notification"></i>
		</div>
				   </div>
          </div>
        </div> 
      
           
      </div>
  
       
	   
    
	  	
		
		
		
		
       
		
	  
        </div>
      </div>
		
	</div>
</div>


<div class="col-lg-3 mb-4">
			<div class="card shadow cardb" role="button">
				<div class="card-header py-2">
				  <h6 style="color:#04121f" class="m-0 text-center"><b>Engineer Dashboard</b></h6>
				</div>
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">
	
				<!--<div class="col-xl-2 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-green2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
			   <div>
                   <a href="currentlocation.php"><span  class="mb-0 text-dark"><b>Engineer TA/DA Report</b></span></a>
				   
				   </div>
				<div class="widgets-icons-green2 ms-auto" >
		<i class="bx bx-trip"></i>
		</div>
				  
				   </div>
          </div>
        </div>-->
		
          <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-warning2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
			   <div>
                   <?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="dailyengreport.php"><span  class="mb-0 text-dark"><b>Engineer Report</b></span></a>
				    <?php
				}
				else
				{
					?><a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Engineer Report</b></span></a>
					<?php
				}
				?>
				   </div><div class="widgets-icons-warning2 ms-auto" >
		<i class="bx bxs-report"></i>
		</div>
				
				  
				   </div>
          </div>
        </div>
               
      </div> 
	  <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-express2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv3">
			   <div><?php 	if(($liveplan=='GOLD')||($liveplan=='DIAMOND')) { ?>
                   <a href="dailyattendance.php"><span  class="mb-0 text-dark"><b>Engineer Attendance</b></span></a>
				    <?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Engineer Attendance</b></span></a>
				<?php } ?>
				   </div>
				<div class="widgets-icons-express2 ms-auto" >
		<i class="bx bxs-face"></i>
		</div>
				  
				   </div>
          </div>
        </div>
               
      </div>
   <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-pink1">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center" id="myDiv">
				<div>
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
				<a href="dareport.php"><span  class="mb-0 text-dark"><b>Engineer DA / TA Report</b></span></a>
				<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span  class="mb-0 text-dark" style="opacity:0.5;"><b>Engineer DA / TA Report</b></span></a>
					<?php
				}
				?>
				</div>
				<div class="widgets-icons-pink1 ms-auto" >
		<i class="bx bxs-package"></i>
		</div>
	</div>
      </div>
  </div>
     
    
      </div>
       
	   
		
		
		 <div class="col-xl-6 col-sm-6 mb-4 col-6"> 
         <div class="card cardnew1 shadow radius-10 border-start border-0 border-3 border-info2">
            <div class="card-body" style="padding-right:0.2rem">
			   <div class="d-flex align-items-center">
		<div>
		<?php if(($liveplan=='GOLD')||($liveplan=='DIAMOND')) { ?>
					<a href="engrealmap.php"><span class="mb-0 text-dark"><b>Real-Time Engineer Location</b></span></a>
                  
			<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe GOLD / DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-dark"style="opacity:0.5;"><b>Real-Time Engineer Location</b></span></a>  
<?php
				}
				?>					
                     
 </div>
 <div class="widgets-icons-info2 ms-auto" >
		<i class="bx bxs-edit-location"></i>
		</div>
				 		
                </div>
              </div>
            </div>
		 
        </div>
        </div>
		
	</div>
</div>
</div>
	<!--- customer and engineer -->


 
					<?php
					?>
						<!--div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#04121f" class="m-0  ">Service Revenue <span
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
				
				



<!--for amc revenue-->
				<!--div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#04121f" class="m-0  ">AMC Revenue <span
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
				
					<?php
					/* } */
					?>

<?php
					/* if(($liveplan=='DIAMOND'))
					{ */
					?>
       <!-- <div class="col-lg-3">

             
            <div class="card shadow cardb mb-4">
                <div class="card-header py-2">
                    <h6 style="color:#04121f" class="m-0  "><b>Reminders</b>
					<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="reminder.php" class="float-right"><b>Go
                            to Reminder</b></a>
							<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-right"><span class="mb-0 text-secondary"><b>Go to Reminder</b></span></a>
					<?php
				}
				?>
							</h6>
                </div>
                <div class="card-body">
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					  <marquee width="100%" direction="up" height="194px" scrollamount="3" onmouseover="this.stop();"
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
			$hourdiff = round((strtotime($rowselect['enddate']) - time()) / 3600, 1);
			//$daydiff = round($hourdiff / 24, 1); remove second argument
			$daydiff = round($hourdiff / 24);
			if ($daydiff >= (-90)) {
			?>
                            <li>
                               <b> <span class="text-dark"><?=$rowselect['reminder']?></span></b>
                                <small class="btn btn-sm float-right" style="<?=($daydiff<=0)?'background-color:#f23535; color:#ffffff':''?>"><i
                                        class="fa fa-clock"></i> <?=$daydiff?> Days</small>
                            </li>
                            <?php
			}else{}
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
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Reminder</b></span></a>
					</p>
					<?php
				}
				?>
                  
                </div>
				
            </div>
        </div>-->
        
		<?php
					/* } (($liveplan=="GOLD")||($liveplan=="DIAMOND"))?'4':'6'*/
					?>
     <!--   <div class="col-lg-3">

             
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
                            <span class="text-dark float-right"><?=$rowselect['numbers']?></span>
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
        </div>-->
		<!-- <div class="col-lg-3">

             
            <div class="card shadow cardb mb-4">
                <div class="card-header py-2">
                    <h6 style="color:#04121f" class="m-0   text-center"><b>Customer Search Ratio</b>&nbsp;<i class="fa fa-info-circle" data-toggle="tooltip" title="Call Assigned / Total Customer Search"></i></h6>
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
        </div>-->
		<div class="col-lg-2">

             
            <div class="card shadow cardb mb-4">
                <div class="card-header py-2">
                    <h6 style="color:#04121f" class="m-0"><b>Updates / Announcements</b>
					
					<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<a href="updates.php" class="float-right"><b>Updates</b></a>
							<?php
				}
				else
				{
					?>
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')" class="float-right"><span class="mb-0 text-secondary"><b>Updates</b></span></a>
					<?php
				}
				?>
					</h6>
                </div>
                <div class="card-body">
				
				<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					    <marquee width="100%" direction="up" height="175px" scrollamount="3" onmouseover="this.stop();"
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
					<p style="width:100%; height:160px; text-align:center">
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Updates/Announcements</b></span></a>
					</p>
					<?php
				}
				?>
				
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
        <script>
   // script.js
   
   window.addEventListener("load", function() {
  // Ensure closePopupButton exists before adding event listener
  var closePopupButton = document.getElementById("closePopupButton");
  if (closePopupButton) {
    closePopupButton.addEventListener("click", closePopup);
  }

  // Ensure yesbutton exists before adding event listener
  var yesbutton = document.getElementById("yesbutton");
  if (yesbutton) {
    yesbutton.addEventListener("click", openAnotherURL);
  }

  // Automatically open the popup when the page loads
  openPopup();
});
   
   function openPopup() {
  var popupOverlay = document.getElementById("popupOverlay");
  var popupContainer = document.getElementById("popupContainer");
  
  // Check if elements exist before manipulating them
  if (popupOverlay && popupContainer) {
    popupOverlay.style.display = "flex";
    setTimeout(() => {
      popupContainer.style.opacity = "1";
      popupContainer.style.transform = "scale(1)";
    }, 100);
  }
}

function closePopup() {
  var popupOverlay = document.getElementById("popupOverlay");
  var popupContainer = document.getElementById("popupContainer");

  // Check if elements exist before manipulating them
  if (popupOverlay && popupContainer) {
    window.location.href = 'dashboard.php?close_popup';
    popupContainer.style.opacity = "0";
    popupContainer.style.transform = "scale(0.8)";
    setTimeout(() => {
      popupOverlay.style.display = "none";
    }, 300);
  }
}
 
function openAnotherURL() {
            // Change the URL to the one you want to open
            window.location.href = 'swupdates.php?yesButton';
        }

  </script>
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
	<!---------start carryin--->
	

	
	
	<?php
// Get the current month start and end date
$currentMonthStart = date('Y-m-01');
$currentMonthEnd = date('Y-m-t');

// Query for Service Revenue
$sqliService = mysqli_query($connection, "SELECT SUM(t1.scharge) AS totalServiceRevenue, 
                                                 SUM(CASE WHEN cashstatus = '1' THEN t1.scharge ELSE 0 END) AS collectedServiceRevenue 
                                          FROM jrccalldetails t1, jrccalls t2 
                                          WHERE t1.srno != '' 
                                            AND t1.scharge != '' 
                                            AND t1.calltid = t2.calltid 
                                            AND t2.servicetype = 'On-Site' 
                                            AND t1.scharge != '0' 
                                            AND t1.scharge != '0.00' 
                                            AND t1.incgst != '2' 
                                            AND t1.schargedate BETWEEN '$currentMonthStart' AND '$currentMonthEnd'");
$infoService = mysqli_fetch_array($sqliService);
$totalServiceRevenue = $infoService['totalServiceRevenue'] ?? 0;
$collectedServiceRevenue = $infoService['collectedServiceRevenue'] ?? 0;
$toBeCollectedServiceRevenue = $totalServiceRevenue - $collectedServiceRevenue;

// Query for AMC Revenue
$sqliAMC = mysqli_query($connection, "SELECT SUM(totalvalue) AS totalAMCRevenue, 
                                           SUM(receivedamount) AS collectedAMCRevenue 
                                    FROM jrcamc 
                                    WHERE totalvalue != '' 
                                      AND totalvalue != '0' 
                                      AND totalvalue != '0.00'  
                                      AND datefrom BETWEEN '$currentMonthStart' AND '$currentMonthEnd'");
$infoAMC = mysqli_fetch_array($sqliAMC);
$totalAMCRevenue = $infoAMC['totalAMCRevenue'] ?? 0;
$collectedAMCRevenue = $infoAMC['collectedAMCRevenue'] ?? 0;
$toBeCollectedAMCRevenue = $totalAMCRevenue - $collectedAMCRevenue;

// Query for Carry-In Revenue
$sqliCarryIn = mysqli_query($connection, "SELECT SUM(t1.scharge) AS totalCarryInRevenue, 
                                                 SUM(CASE WHEN cashstatus = '1' THEN t1.scharge ELSE 0 END) AS collectedCarryInRevenue 
                                          FROM jrccalldetails t1, jrccalls t2 
                                          WHERE t1.srno != '' 
                                            AND t1.scharge != '' 
                                            AND t1.calltid = t2.calltid 
                                            AND t2.servicetype = 'Carry-In' 
                                            AND t1.scharge != '0' 
                                            AND t1.scharge != '0.00' 
                                            AND t1.incgst != '2' 
                                            AND t1.schargedate BETWEEN '$currentMonthStart' AND '$currentMonthEnd'");
$infoCarryIn = mysqli_fetch_array($sqliCarryIn);
$totalCarryInRevenue = $infoCarryIn['totalCarryInRevenue'] ?? 0;
$collectedCarryInRevenue = $infoCarryIn['collectedCarryInRevenue'] ?? 0;
$toBeCollectedCarryInRevenue = $totalCarryInRevenue - $collectedCarryInRevenue;
?>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Define canvas element for the combined chart -->

<script>
    const combinedData = {
        labels: ['Service', 'AMC'],
        datasets: [{
            label: 'Total Amount',
		    data: [<?= $totalServiceRevenue ?>, <?= $totalAMCRevenue ?>],
            backgroundColor: '<?=$_SESSION['bgcolor']?>',
            borderColor: '<?=$_SESSION['bgcolor']?>',
            borderWidth: 1
        }, {
            label: 'Collected Amount',
            data: [<?= $collectedServiceRevenue ?>, <?= $collectedAMCRevenue ?>],
            backgroundColor: '<?=$_SESSION['lightbgcolor']?>',
            borderColor: '<?=$_SESSION['lightbgcolor']?>',
            borderWidth: 1
        }, {
            label: 'To be Collected Amount',
            data: [<?= $toBeCollectedServiceRevenue ?>, <?= $toBeCollectedAMCRevenue ?>],
            backgroundColor: 'rgba(0, 0, 0, 0.2)',
            borderColor: 'rgba(0, 0, 0, 0.2)',
            borderWidth: 1
        }]
    };

    const combinedConfig = {
        type: 'bar',
        data: combinedData,
        options: {
            scales: {
                x: {
                    ticks: {
                        color: 'black'
                    }
                },
                y: {
                    ticks: {
                        color: 'black'
                    },
                    beginAtZero: true
                }
            }
			
        }
    };

    const combinedChart = new Chart(
        document.getElementById('combinedChart'),
        combinedConfig
    );
	
	const canvas1 = document.getElementById('combinedChart'); // Updated canvas ID
canvas1.onclick = function (e) {
  const bar = combinedChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
  console.log(bar);
  if (bar.length > 0) {
   
 
    const index1 = bar[0].index;

    
    const clickedLabel = combinedChart.data.labels[index1];

   
    const datasetIndex = bar[0].datasetIndex;

   
    const datasetLabel = combinedChart.data.datasets[datasetIndex].label;
switch(clickedLabel) {
      case 'Service':
    if (datasetLabel === 'Total Amount') {

      window.location.href = 'servicecharges.php?datefrom=<?=$currentMonthStart?>&dateto=<?=$currentMonthEnd?>&submit=';
    } else if (datasetLabel === 'Collected Amount') {
     
      window.location.href = 'servicecharges.php?datefrom=<?=$currentMonthStart?>&dateto=<?=$currentMonthEnd?>&ty=1&submit=';
    } else if (datasetLabel === 'To be Collected Amount') {
     
      window.location.href = 'servicecharges.php?datefrom=<?=$currentMonthStart?>&dateto=<?=$currentMonthEnd?>&ty=0&submit=';
    } break;
	case 'AMC':
    if (datasetLabel === 'Total Amount') {

      window.location.href = 'amccharges.php?datefrom=<?=$currentMonthStart?>&dateto=<?=$currentMonthEnd?>&submit=';
    } else if (datasetLabel === 'Collected Amount') {
     
      window.location.href = 'amccharges.php?datefrom=<?=$currentMonthStart?>&dateto=<?=$currentMonthEnd?>&ty=1&submit=';
    } else if (datasetLabel === 'To be Collected Amount') {
     
      window.location.href = 'amccharges.php?datefrom=<?=$currentMonthStart?>&dateto=<?=$currentMonthEnd?>&ty=0&submit=';
    }
	break;
		 default:
        // Handle unexpected labels or provide a default action
    }

	
	
   /*  if (datasetLabel === 'Total Amount') {

      window.location.href = 'amccharges.php?datefrom=2024-05-01&dateto=2024-05-31&submit=';
    } else if (datasetLabel === 'Collected') {
     
      window.location.href = 'amccharges.php?datefrom='+currentMonthStart+'&dateto='+currentMonthEnd+'&ty=collected&submit=';
    } else if (datasetLabel === 'To be Collected') {
     
      window.location.href = 'amccharges.php?datefrom='+currentMonthStart+'&dateto='+currentMonthEnd+'&ty=pending&submit=';
    } */
	
  }
}
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
  </script>
  <script>
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
  <script>
      const myDiv10 = document.getElementById("myDiv10");
	  if(myDiv10)
	  {
      myDiv10.addEventListener("mouseover", showTooltip);
      myDiv10.addEventListener("mouseout", hideTooltip);
	  
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip11");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip11");
         tooltip.style.display = "none";
      }  
	  }
  </script>
  <script>
      const myDiv11 = document.getElementById("myDiv11");
	  if(myDiv11)
	  {
      myDiv11.addEventListener("mouseover", showTooltip);
      myDiv11.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip12");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip12");
         tooltip.style.display = "none";
      }  
	  }
  </script>
  <script>
      const myDiv12 = document.getElementById("myDiv12");
	  if(myDiv12)
	  {
      myDiv12.addEventListener("mouseover", showTooltip);
      myDiv12.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip13");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip13");
         tooltip.style.display = "none";
      } 
}	  
  </script>
  <script>
      const myDiv13 = document.getElementById("myDiv13");
	  if(myDiv13)
	  {
      myDiv13.addEventListener("mouseover", showTooltip);
      myDiv13.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip14");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip14");
         tooltip.style.display = "none";
      } 
}	  
  </script>
  <script>
      const myDiv14 = document.getElementById("myDiv14");
	  if(myDiv14)
	  {
      myDiv14.addEventListener("mouseover", showTooltip);
      myDiv14.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip15");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip15");
         tooltip.style.display = "none";
      } 
}	  
  </script>
  
  
  <!-- start carry in tooltip-->
 <script>
      const myDivopen = document.getElementById("myDivopen");
	  if(myDivopen)
      {
      myDivopen.addEventListener("mouseover", showTooltip);
      myDivopen.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipopen");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipopen");
         tooltip.style.display = "none";
      }  
      }  
  </script> <script>
      const myDivpend = document.getElementById("myDivpend");
      if(myDivpend)
      {
	  myDivpend.addEventListener("mouseover", showTooltip);
      myDivpend.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltippend");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltippend");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDivcomp = document.getElementById("myDivcomp");
      if(myDivcomp)
      {
	  myDivcomp.addEventListener("mouseover", showTooltip);
      myDivcomp.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipcomp");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipcomp");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDivdeli = document.getElementById("myDivdeli");
	  if(myDivdeli)
      {
      myDivdeli.addEventListener("mouseover", showTooltip);
      myDivdeli.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipdeli");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipdeli");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDivopsts = document.getElementById("myDivopsts");
	  if(myDivopsts)
      {
      myDivopsts.addEventListener("mouseover", showTooltip);
      myDivopsts.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipopsts");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipopsts");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDivdp = document.getElementById("myDivdp");
	  if(myDivdp)
      {
      myDivdp.addEventListener("mouseover", showTooltip);
      myDivdp.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipdp");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipdp");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDivcc = document.getElementById("myDivcc");
      if(myDivcc)
      {
	  myDivcc.addEventListener("mouseover", showTooltip);
      myDivcc.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipcc");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipcc");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
      const myDivclsts = document.getElementById("myDivclsts");
      if(myDivclsts)
      {
	  myDivclsts.addEventListener("mouseover", showTooltip);
      myDivclsts.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipclsts");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipclsts");
         tooltip.style.display = "none";
      }  
      }  
  </script>
  <script>
/*       const myDivawait = document.getElementById("myDivawait");
      if(myDivawait)
      {
	  myDivawait.addEventListener("mouseover", showTooltip);
      myDivawait.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltipawait");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltipawait");
         tooltip.style.display = "none";
      }  
      }   */
  </script>
  

  <!--carry in tooltip-->
  <!------------daterangepicker--->
<script>
var tob = sessionStorage.getItem("tob");

</script>
<script>
$(".drag-me").draggable({
  axis: "y"
});
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
  <script type="text/javascript">
    $(function() {
		document.getElementById(existsearch.id).focus();
document.getElementById(existsearch.id).select();
        $("#existsearch").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#existsearch").val(ui.item.value);
                $("#existsearchid").val(ui.item.id);
	        },
            minLength: 3
        });
        $("#existsearch1").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#existsearch1").val(ui.item.value);
                $("#existsearchid1").val(ui.item.id);
            },
            minLength: 3
        });
    });
    </script>


<script> function showSearchBox() {
    var bookComplaint = document.getElementById("book-complaint");
    var searchContainer = document.getElementById("search-container");
            bookComplaint.style.display = 'none';
            searchContainer.style.display = 'block';
        	}
</script>

<?php include('additionaljs.php');   ?>

</body>
</html>