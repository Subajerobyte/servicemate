<?php
include('lcheck.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

if((isset($_GET['calltid']))&&(isset($_GET['email'])))
{

		//Load composer's autoloader
		require_once '../../1637028036/vendor/phpmailer/src/Exception.php';
		require_once '../../1637028036/vendor/phpmailer/src/PHPMailer.php';
		require_once '../../1637028036/vendor/phpmailer/src/SMTP.php';
		//include('../../1637028036/vendor/pdf/mpdf.php');
 $whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    $siteurl="https://jerobyte.com/jrc/";
}
else
{
	$siteurl="http://localhost/jrcnew/";
}
function sendreportemail($connection, $username, $userEmail, $id,  $engineername, $engsignature, $calltid)
{
$message = '<!DOCTYPE html>
    <html lang="en">
	
    <head>
<meta charset="UTF-8">
<title>Service Call Report - '.$calltid.'</title>
 <link href="https://jerobyte.com/1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://jerobyte.com/1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"><link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
<style>
body
{
	font-family: Arial,sans-serif; 
}
.heading
{
	font-family: Arial Black,Arial,Gadget,sans-serif; 
}
table
{
	width:100%;
	margin-bottom:3px;
}
td, th
{
	vertical-align:middle;
	padding:0px 6px;
}
p
{
	margin-bottom: 0rem;
}
td.rotate {
  -ms-transform: rotate(-90deg); /* IE 9 */
  transform: rotate(-90deg);
  width:71px;
  height:71px;
}
table
{
	width:100%;
}
.text-primary
{
	color: #3d8eb9 !important;
}
</style>
    </head>

    <body>
	<div style="margin:0;Margin:0;padding:0;border:0;outline:0;width:100%;min-width:100%;height:100%;font-family:\'Effra\',\'Montserrat\',Helvetica,Arial,sans-serif;line-height:24px;font-weight:normal;font-size:16px;box-sizing:border-box;background-color:#f8f9fa; width:100%;">
	<table width="100%"  valign="top" border="0" cellpadding="0" cellspacing="0" style="border-spacing:0px;border-collapse:collapse;margin:0;Margin:0;padding:0;border:0;outline:0;width:100%;min-width:100%;height:100%;font-family:\'Effra\',\'Montserrat\',Helvetica,Arial,sans-serif;line-height:24px;font-weight:normal;font-size:16px;box-sizing:border-box" width="100%" height="100%">
	<tbody>
	<tr>
		<td valign="top" style="line-height:24px;font-size:16px;margin:0;border-spacing:0px;border-collapse:collapse">
			
		
    
<table width="100%"  border="0" cellpadding="0" cellspacing="0" style="font-family:\'Effra\',\'Montserrat\',Helvetica,Arial,sans-serif;border-spacing:0px;border-collapse:collapse;width:100%" width="100%">
	<tbody>
	<tr>
		<td align="center" style="line-height:24px;font-size:15px;margin:0;border-spacing:0px;border-collapse:collapse">
	
			
';
  if(isset($id))
 {
		$_SESSION['calltid']=$calltid;
		$sqlselect = "SELECT * From jrccalls where (engineerid='".$id."' or find_in_set('".$id."', engineersid)) and calltid='".$calltid."' order by id desc";
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
				$sqlxl = "SELECT * From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountxl > 0) 
				{
					$rowxl = mysqli_fetch_array($queryxl);
					if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowxl['address1']!='')
		{
		$rowxl['address1']=jbsdecrypt($encpass, $rowxl['address1']);
		}
		if($rowxl['phone']!='')
		{
		$rowxl['phone']=jbsdecrypt($encpass, $rowxl['phone']);
		}
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($encpass, $rowxl['mobile']);
		}
		if($rowxl['email']!='')
		{
		$rowxl['email']=jbsdecrypt($encpass, $rowxl['email']);
		}
	}
}
				}
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
				 
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
		$rowcons['address1']=jbsdecrypt($encpass, $rowcons['address1']);
		}
		if($rowcons['phone']!='')
		{
		$rowcons['phone']=jbsdecrypt($encpass, $rowcons['phone']);
		}
		if($rowcons['mobile']!='')
		{
		$rowcons['mobile']=jbsdecrypt($encpass, $rowcons['mobile']);
		}
		if($rowcons['email']!='')
		{
		$rowcons['email']=jbsdecrypt($encpass, $rowcons['email']);
		}
	}
}
		$sqlcon4 = "SELECT * From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
		$querycon4 = mysqli_query($connection, $sqlcon4);
		$rowcon4=mysqli_num_rows($querycon4);
		$infocon4=mysqli_fetch_array($querycon4);
					 if($rowselect['compstatus']=='2')
					  {
						$bg="bg-success";
						$bgtext="Completed";
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						$bg="bg-warning";
						$bgtext="Pending";
					  }
					  else
					 {
						 $bg="bg-danger";
						$bgtext="Open";
					  }
					  $message.= '<table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td colspan="3"><p class="heading" style="font-size: 26px; align-items: center; text-align: center; line-height: 40px;"><img src="https://jerobyte.com/jrc/img/logo.jpg" width="160"> '.$_SESSION['companyname'].'</p>
					  </td>
					  </tr>
					  <tr>
					  <td colspan="3" align="center">H.O.: G-4, Royal Towers, A-20, 1st Cross West, Thillai Nagar, Trichy -620 018.</td>
					  </tr>
					  <tr>
					  <td><strong>E.mail: </strong>'.$_SESSION['companyemail'].'</td>
					  <td align="center"><strong>Mobile:</strong> '.$_SESSION['companymobile'].''.($_SESSION['companymobile1']!='')?' | '.$_SESSION['companymobile1']:''.''.($_SESSION['companymobile2']!='')?' | '.$_SESSION['companymobile2']:''.'</td>
					  <td align="right"><strong>GSTIN: </strong>'.$_SESSION['companygstno'].'</td>
					  </tr>
					  </table>
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td rowspan="2" width="25%">SCR. No.: <b><font size="+1">'.$infocon4['srno'].'</font></b></td>
					  <td align="center" width="40%" rowspan="2" class="heading" style="font-size:20px; font-weight:bold;">SERVICE CALL REPORT</td>
					  <td align="left"><strong>Call ID:</strong></td>
					  <td align="left">'.$rowselect['calltid'].'</td>
					  </tr>
					  <tr>
					  <td align="left"><strong>Date:</strong></td>
					  <td align="left">'.(date('d/m/Y h:i:s a', strtotime($rowselect['callon']))).'</td>
					  </tr>
					  </table>
					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="left" class="'.(($rowselect['callnature']=='Site Survey')?'font-weight-bold text-primary ':'').'">Site Survey <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='Site Survey')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($rowselect['callnature']=='Delivery')?'font-weight-bold text-primary ':'').'">Delivery <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='Delivery')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($rowselect['callnature']=='Installation')?'font-weight-bold text-primary ':'').'">Installation <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='Installation')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($rowselect['callnature']=='Warranty')?'font-weight-bold text-primary ':'').'">Warranty <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='Warranty')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($rowselect['callnature']=='AMC')?'font-weight-bold text-primary ':'').'">AMC <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='AMC')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($rowselect['callnature']=='Out of Warranty')?'font-weight-bold text-primary ':'').'">Out of Warranty <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='Out of Warranty')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($rowselect['callnature']=='Maintanence')?'font-weight-bold text-primary ':'').'">Maintanence <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='Maintanence')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($rowselect['callnature']=='Other Make')?'font-weight-bold text-primary ':'').'">Other Make <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='Other Make')?'check-square':'square').'"></i></span></td>
<td align="left" class="'.(($rowselect['callnature']=='FSMA')?'font-weight-bold text-primary ':'').'">FSMA <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='FSMA')?'check-square':'square').'"></i></span></td>
<td align="left" class="'.(($rowselect['callnature']=='CAMC')?'font-weight-bold text-primary ':'').'">CAMC <span class="float-right"><i class="far fa-'.(($rowselect['callnature']=='CAMC')?'check-square':'square').'"></i></span></td>					  
					  </tr>
					  </table>
					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center"><strong>CUSTOMER INFORMATION</strong></td>
					  <td colspan="4" align="center"><strong>PRODUCT INFORMATION</strong></td>
					  </tr>
					  <tr>
					  <td align="left" width="40%" rowspan="5"><p><strong>'.$rowxl['consigneename'].'</strong><br>'.$rowcons['address1'].' '.$rowcons['address2'].' '.$rowcons['area'].' '.$rowcons['pincode'].'<br>'.$rowcons['contact'].'  '.$rowcons['phone'].' '.$rowcons['mobile'].'</p></td>
					  <td align="left" colspan="4"><b>Product Name-</b>'.$rowxl['stocksubcategory'].' - '.$rowxl['componentname'].'</p></td>
					  </tr>
					  <tr>
					  <td width="10%"><strong>Product</strong></td><td width="18%">'.$infocon4['make'].'</td><td width="12%">Battery Make</td><td>'.$infocon4['batterymake'].'</td>
					  </tr>
					  <tr>
					  <td width="10%"><strong>Capacity/Model</strong></td><td>'.$infocon4['capacity'].'</td><td width="10%">Battery AH</td><td>'.$infocon4['batteryah'].'</td>
					  </tr>
					  <tr>
					  <td width="10%"><strong>MFG Code</strong></td><td>'.$infocon4['mfgcode'].'</td><td width="10%">No.of Battery</td><td>'.$infocon4['noofbattery'].'</td>
					  </tr>
					  <tr>
					  <td width="10%"><strong>Sl.No</strong></td><td>'.$rowselect['serial'].'</td><td width="10%">No.of Set</td><td>'.$infocon4['noofset'].'</td>
					  </tr>
					  </table>
					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center"><strong>PROBLEM REPORTED</strong></td>
					  <td align="center"><strong>PROBLEM OBSERVED</strong></td>
					  </tr>
					  <tr>
					  <td align="center" height="60" class="font-weight-bold text-primary">'.$rowselect['reportedproblem'].'</td>
					  <td align="center" height="60" class="font-weight-bold text-primary">'.$infocon4['problemobserved'].'</td>
					  </tr>
					  </table>
					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="10%" rowspan="3"><strong>SITE VERIFICATION</strong></td>
					  <td><strong>Ventilation : </strong><span class="float-right">'.(($infocon4['verification']=='1')?'Yes':'No').'</span></td>
					  <td><strong>Modification on Wiring :</strong> <span class="float-right">'.(($infocon4['modificationwiring']=='1')?'Yes':'No').'</span></td>
					  <td><strong>Pollution Level :</strong> <span class="float-right">'.(($infocon4['pollutionlevel']=='1')?'High':($infocon4['pollutionlevel']=='2')?'Medium':'Low').'</span></td>
					  </tr>
					  <tr>
					  <td><strong>Direct Sunlight :</strong> <span class="float-right">'.(($infocon4['directsunlight']=='1')?'Yes':($infocon4['directsunlight']=='2')?'Partial':'No').'</span></td>
					  <td><strong>Rain/Cleaning Water Dripping :</strong> <span class="float-right">'.(($infocon4['waterdripping']=='1')?'Yes':'No').'</span></td>
					  <td><strong>Moisture :</strong> <span class="float-right">'.(($infocon4['moisture']=='1')?'Yes':'No').'</span></td>
					  </tr>
					  <tr>
					  <td><strong>Wiring Ready : </strong><span class="float-right">'.(($infocon4['wiringready']=='1')?'Yes':'No').'</span></td>
					  <td><strong>Coastal Area : </strong><span class="float-right">'.(($infocon4['coastelarea']=='1')?'Yes':'No').'</span></td>
					  <td></td>
					  </tr>
					  </table>
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" colspan="2"><strong>AC DATA</strong></td>
					  </tr>
					  <tr>
					  <td align="center" width="50%"><strong>INPUT - '.(($infocon4['phasetype']=='31')?'3Φ':'').''.(($infocon4['phasetype']=='33')?'3Φ':'').''.(($infocon4['phasetype']=='11')?'1Φ':'').'</strong></td>
					  <td align="center"><strong>OUTPUT - '.(($infocon4['phasetype']=='31')?'1Φ':'').''.(($infocon4['phasetype']=='33')?'3Φ':'').''.(($infocon4['phasetype']=='11')?'1Φ':'').'</strong></td>
					  </tr>
					  <tr>
					  <td align="center" style="padding:3px; vertical-align:top">';
					  if(($infocon4['phasetype']=='31')||($infocon4['phasetype']=='33'))
					  {
					  $message.= '<table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" colspan="2"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%">RY: <span class="float-right">'.$infocon4['voliry'].'</span></td>
					  <td width="25%">RN: <span class="float-right">'.$infocon4['volirn'].'</span></td>
					  <td width="25%">R: <span class="float-right">'.$infocon4['curir'].'</span></td>
					  <td width="25%">R: <span class="float-right">'.$infocon4['freir'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%">YB: <span class="float-right">'.$infocon4['voliyb'].'</span></td>
					  <td width="25%">BN: <span class="float-right">'.$infocon4['volibn'].'</span></td>
					  <td width="25%">Y: <span class="float-right">'.$infocon4['curiy'].'</span></td>
					  <td width="25%">Y: <span class="float-right">'.$infocon4['freiy'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%">BR: <span class="float-right">'.$infocon4['volibr'].'</span></td>
					  <td width="25%">YN: <span class="float-right">'.$infocon4['voliyn'].'</span></td>
					  <td width="25%">B: <span class="float-right">'.$infocon4['curib'].'</span></td>
					  <td width="25%">B: <span class="float-right">'.$infocon4['freib'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%"></td>
					  <td width="25%">NE: <span class="float-right">'.$infocon4['voline'].'</span></td>
					  <td width="25%">N: <span class="float-right">'.$infocon4['curin'].'</span></td>
					  <td width="25%"></td>
					  </tr>
					  </table>';
					  }
					  if(($infocon4['phasetype']=='11'))
					  {
						  
					  $message.= '<table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%">PN: <span class="float-right">'.$infocon4['volipn'].'</span></td>
					  <td width="25%">P: <span class="float-right">'.$infocon4['curip'].'</span></td>
					  <td width="25%">P: <span class="float-right">'.$infocon4['freip'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%">PE: <span class="float-right">'.$infocon4['volipe'].'</span></td>
					  <td width="25%">N: <span class="float-right">'.$infocon4['cur1in'].'</span></td>
					  <td width="25%"></td>
					  </tr>
					  <tr>
					  <td width="25%">NE: <span class="float-right">'.$infocon4['vol1ine'].'</span></td>
					  <td width="25%"></td>
					  <td width="25%"></td>
					  </tr>
					  </table>';
					  }
					  $message.= '</td>
					  <td align="center" style="padding:3px; vertical-align:top">';
					  if(($infocon4['phasetype']=='33'))
					  {
						 $message.= '<table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" colspan="2"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%">RY: <span class="float-right">'.$infocon4['volory'].'</span></td>
					  <td width="25%">RN: <span class="float-right">'.$infocon4['volorn'].'</span></td>
					  <td width="25%">R: <span class="float-right">'.$infocon4['curor'].'</span></td>
					  <td width="25%">R: <span class="float-right">'.$infocon4['freor'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%">YB: <span class="float-right">'.$infocon4['voloyb'].'</span></td>
					  <td width="25%">BN: <span class="float-right">'.$infocon4['volobn'].'</span></td>
					  <td width="25%">Y: <span class="float-right">'.$infocon4['curoy'].'</span></td>
					  <td width="25%">Y: <span class="float-right">'.$infocon4['freoy'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%">BR: <span class="float-right">'.$infocon4['volobr'].'</span></td>
					  <td width="25%">YN: <span class="float-right">'.$infocon4['voloyn'].'</span></td>
					  <td width="25%">B: <span class="float-right">'.$infocon4['curob'].'</span></td>
					  <td width="25%">B: <span class="float-right">'.$infocon4['freob'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%"></td>
					  <td width="25%">NE: <span class="float-right">'.$infocon4['volone'].'</span></td>
					  <td width="25%">N: <span class="float-right">'.$infocon4['curon'].'</span></td>
					  <td width="25%"></td>
					  </tr>
					  </table>';
					  }
					  if(($infocon4['phasetype']=='31')||($infocon4['phasetype']=='11'))
					  {
					$message.= ' <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%">PN: <span class="float-right">'.$infocon4['volopn'].'</span></td>
					  <td width="25%">P: <span class="float-right">'.$infocon4['curop'].'</span></td>
					  <td width="25%">P: <span class="float-right">'.$infocon4['freop'].'</span></td>
					  </tr>
					  <tr>
					  <td width="25%">PE: <span class="float-right">'.$infocon4['volope'].'</span></td>
					  <td width="25%">N: <span class="float-right">'.$infocon4['cur1on'].'</span></td>
					  <td width="25%"></td>
					  </tr>
					  <tr>
					  <td width="25%">NE: <span class="float-right">'.$infocon4['vol1one'].'</span></td>
					  <td width="25%"></td>
					  <td width="25%"></td>
					  </tr>
					  </table>';
					  }
					  $message.= '</td>
					  </tr>
					  </table>
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td width="25%" style="padding:0px 50px;">Stabilizer : <span class="float-right">'.(($infocon4['stabilizer']=='1')?'Yes':'No').'</span></td>
					  <td width="25%" style="padding:0px 50px;">Phase Reverse : <span class="float-right">'.(($infocon4['phasereverse']=='1')?'Yes':'No').'</span></td>
					  <td width="25%" style="padding:0px 50px;">Earthing : <span class="float-right">'.(($infocon4['earthing']=='1')?'Yes':'No').'</span></td>
					  <td width="25%" style="padding:0px 50px;">Overload : <span class="float-right">'.(($infocon4['overload']=='1')?'Yes':'No').'</span></td>
					  </table>
					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>DC Data</strong></td>
					  <td colspan="2" width="20%" align="center">@ Charging</td>
					  <td colspan="2" width="25%" align="center">@ Discharging with Load</td>
					  <td colspan="2" width="25%" align="center">@ Discharging without Load</td>
					  <td align="center" width="10%" rowspan="2"><strong>Battery Condition</strong></td>
					  <td align="center" width="10%" rowspan="2">'.$infocon4['batterycondition'].'</td>
					  </tr>
					  <tr>
					  <td>'.$infocon4['chargingv'].' <span class="float-right">V</span></td>
					  <td>'.$infocon4['chargingo'].' <span class="float-right">A</span></td>
					  <td>'.$infocon4['dischargingv'].' <span class="float-right">V</span></td>
					  <td>'.$infocon4['dischargingo'].' <span class="float-right">A</span></td>
					  <td>'.$infocon4['dischargingwv'].' <span class="float-right">V</span></td>
					  <td>'.$infocon4['dischargingwo'].' <span class="float-right">A</span></td>
					  </tr>
					  </table>
					  		  					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="50%"><strong>SPARES USED</strong></td>
					  <td align="center"><strong>SPARES REQUIRED</strong></td>
					  </tr>
					  <tr>
					  <td align="center" style="padding:3px; vertical-align:top">
					
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center"><strong>S.No</strong></td>
					  <td align="center"><strong>Name</strong></td>
					  <td align="center"><strong>Qty</strong></td>
					  </tr>';
					  for($i=1;$i<=5;$i++)
					  {
						  if($infocon4['sparesused'.$i]!='')
						  {
					$message.= '<tr>
					  <td width="10%" align="center">'.$i.'</span></td>
					  <td width="80%">'.$infocon4['sparesused'.$i].'</span></td>
					  <td width="10%" align="center">'.$infocon4['sparesused'.$i.'q'].'</span></td>
					  </tr>';
						  }
						  else
						  {
					$message.= '<tr>
					  <td width="10%" align="center">&nbsp;</span></td>
					  <td width="80%">&nbsp;</span></td>
					  <td width="10%" align="center">&nbsp;</span></td>
					  </tr>';
						  }
					  }
					  $message.= '</table>
					 </td>
					 <td align="center" style="padding:3px; vertical-align:top">
					 <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center"><strong>S.No</strong></td>
					  <td align="center"><strong>Name</strong></td>
					  <td align="center"><strong>Qty</strong></td>
					  </tr>';
					  for($i=1;$i<=5;$i++)
					  {
						  if($infocon4['sparesrequired'.$i]!='')
						  {
					$message.= '<tr>
					  <td width="10%" align="center">'.$i.'</span></td>
					  <td width="80%">'.$infocon4['sparesrequired'.$i].'</span></td>
					  <td width="10%" align="center">'.$infocon4['sparesrequired'.$i.'q'].'</span></td>
					  </tr>';
						  }
						  else
						  {
						$message.= '<tr>
					  <td width="10%" align="center">&nbsp;</span></td>
					  <td width="80%">&nbsp;</span></td>
					  <td width="10%" align="center">&nbsp;</span></td>
					  </tr>';
						  }
					  }
					  $message.= '</table>
					 </td>
					 </tr>
					 </table>
					 
					 <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="20%" height="60"><strong>ENGINEER\'S REPORT</strong></td>
					  <td class="font-weight-bold text-primary">'.$infocon4['engineerreport'].'</td>
					  </table>
					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="20%"><strong>CALL STATUS</strong></td>
					  <td align="left" width="13%" class="'.(($infocon4['callstatus']=='Completed')?'font-weight-bold text-primary ':'').'">Completed <span class="float-right"><i class="far fa-'.(($infocon4['callstatus']=='Completed')?'check-square':'square').'"></i></span></td>
					  <td align="left" width="13%" class="'.(($infocon4['callstatus']=='Observation')?'font-weight-bold text-primary ':'').'">Observation <span class="float-right"><i class="far fa-'.(($infocon4['callstatus']=='Observation')?'check-square':'square').'"></i></span></td>
					  <td align="left" width="13%" class="'.(($infocon4['callstatus']=='Pending')?'font-weight-bold text-primary ':'').'">Pending <span class="float-right"><i class="far fa-'.(($infocon4['callstatus']=='Pending')?'check-square':'square').'"></i></span></td>
					  <td align="left" class="'.(($infocon4['callstatus']=='Awaiting for Approval')?'font-weight-bold text-primary ':'').'">Awaiting for Approval <span class="float-right"><i class="far fa-'.(($infocon4['callstatus']=='Awaiting for Approval')?'check-square':'square').'"></i></span></td>
					  <td align="left" width="13%" class="'.(($infocon4['callstatus']=='Claim')?'font-weight-bold text-primary ':'').'">Claim <span class="float-right"><i class="far fa-'.(($infocon4['callstatus']=='Claim')?'check-square':'square').'"></i></span></td>			  
					  </tr>
					  </table>
					  
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="13%"><strong>SITE IMAGES</strong></td>
					  <td class="rotate" width="71">BEFORE</td>
					  <td >';
					  if($infocon4['imgbefuploads']!=='')
					  {
						$as=explode(',',$infocon4['imgbefuploads']);
						$c=1;
						foreach($as as $a)
						{
							$a=str_replace('../','https://jerobyte.com/jrc/',$a);
							$message.= "<img src='".$a."' width='70' height='70' style='padding:5px;'>";
							$c++;
						}
					  }
					  $message.= '</td>
					  <td class="rotate" width="71">AFTER</td>
					  <td width="35%">';
					  if($infocon4['imguploads']!=='')
					  {
						$as=explode(',',$infocon4['imguploads']);
						$c=1;
						foreach($as as $a)
						{
							$a=str_replace('../','https://jerobyte.com/jrc/',$a);
							$message.= "<img src='".$a."' width='70' height='70' style='padding:5px;'>";
							$c++;
						}
					  }
					  $engsignature=str_replace('../','https://jerobyte.com/jrc/',$engsignature);
					  $message.= '</td>
					  </tr>
					  </table>
					  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="13%"><strong>CUSTOMER\'S FEEDBACK</strong></td>
					  <td>'.$infocon4['customerfeedback'].'</td>
					  <td align="center" width="13%"><strong>ENGINEER\'S APPROACH</strong></td>
					  <td width="10%">'.$infocon4['engapproach'].'</td>
					  </table>';
					    
		$sqlcon = "SELECT termscondition From jrctermsservice";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon>0) 
		{
			$infoacknowledge=mysqli_fetch_array($querycon);
			
			 $message.= ' <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <th style="text-align:center"><strong>TERMS AND CONDITIONS</strong></th>
					  </tr>
					  <tr>
					  <td>'.$infoacknowledge['termscondition'].'</td>
					  </tr>
					  </table>';
					 
		}
		
					 $message.= '  <table width="100%"  width="100%" border="1" style="border:1px solid #bbbbbb; border-collapse: collapse;">
					  <tr>
					  <td align="center" width="25%"><strong>CUSTOMER\'S SIGNATURE <br>('.$infocon4['signname'].')</strong></td>
					  <td style="background:'.(($infocon4['imgseal']!='')?'url('.$infocon4['imgseal'].')':'none').'"><img id="signatureimg" width="150" style="'.(($infocon4['signature']!='')?'display:block':'display:none').'" src="'.(str_replace('../','https://jerobyte.com/jrc/',$infocon4['signature'])).'"></td>
					  <td align="center" width="25%"><strong>ENGINEER\'S SIGNATURE <br>('.$engineername.')</strong></td>
					  <td width="20%"><img id="signatureimg" width="150" style="'.(($infocon4['signature']!='')?'display:block':'display:none').'" src="'.$engsignature.'"></td>
					  </table>';
					$count++;
			}
		}
 }	
  
  
  
  $message.= '</p>
  
  

    <p style="line-height:24px;font-size:16px;margin:0;width:100%;text-align:left"><br>
	<br>
	<br>
	<br>
	<br>
	Regards,<br>
    Team '.$_SESSION['companyname'].'.</p>
  <p style="line-height:24px;font-size:16px;margin:0;width:100%"></p>



<table width="100%"  class="m_-5838261325328941685bte-spacing-container m_-5838261325328941685sb-4" border="0" cellpadding="0" cellspacing="0" style="font-family:\'Effra\',\'Montserrat\',Helvetica,Arial,sans-serif;border-spacing:0px;border-collapse:collapse;table-layout:fixed;width:100%" width="100%">
	<tbody>
	<tr>
		<td class="m_-5838261325328941685bte-space-top m_-5838261325328941685bte-space-left" style="margin:0;border-spacing:0px;border-collapse:collapse;width:0;line-height:0;height:0;font-size:0;padding:0">&nbsp;</td>
		<td class="m_-5838261325328941685bte-space-top" style="margin:0;border-spacing:0px;border-collapse:collapse;line-height:0;height:0;font-size:0;padding:0">&nbsp;</td>
		<td class="m_-5838261325328941685bte-space-top m_-5838261325328941685bte-space-right" style="margin:0;border-spacing:0px;border-collapse:collapse;width:0;line-height:0;height:0;font-size:0;padding:0">&nbsp;</td>
	</tr>
	<tr>
		<td class="m_-5838261325328941685bte-space-left" style="margin:0;border-spacing:0px;border-collapse:collapse;width:0;line-height:0;height:0;font-size:0;padding:0">&nbsp;</td>
		<td style="line-height:24px;font-size:16px;margin:0;border-spacing:0px;border-collapse:collapse">
			

<strong><div class="m_-5838261325328941685blue" style="text-align:center">IMPORTANT</div></strong>
<div class="m_-5838261325328941685blue" style="margin-top:0;margin-bottom:0;font-weight:400;color:inherit;vertical-align:baseline;font-size:16px;line-height:20.8px;text-align:center">Please do not reply to this email</div>
<p style="line-height:24px;font-size:16px;margin:0;width:100%"></p>
<div class="m_-5838261325328941685small m_-5838261325328941685blue" style="font-size:12.8px;font-weight:400">© 2021 '.$_SESSION['companyname'].'. All rights reserved.</div>


		</td>
		<td class="m_-5838261325328941685bte-space-right" style="margin:0;border-spacing:0px;border-collapse:collapse;width:0;line-height:0;height:0;font-size:0;padding:0">&nbsp;</td>
	</tr>
	<tr>
		<td class="m_-5838261325328941685bte-space-bottom m_-5838261325328941685bte-space-left" style="margin:0;border-spacing:0px;border-collapse:collapse;width:0;line-height:24px;height:24px;font-size:0;padding:0" height="24">&nbsp;</td>
		<td class="m_-5838261325328941685bte-space-bottom" style="margin:0;border-spacing:0px;border-collapse:collapse;line-height:24px;height:24px;font-size:0;padding:0" height="24">&nbsp;</td>
		<td class="m_-5838261325328941685bte-space-bottom m_-5838261325328941685bte-space-right" style="margin:0;border-spacing:0px;border-collapse:collapse;width:0;line-height:24px;height:24px;font-size:0;padding:0" height="24">&nbsp;</td>
	</tr>
	</tbody>
</table>



            
        </td>
    </tr>
    </tbody>
</table>


			

			
				
			

		</td>
	</tr>
	</tbody>
</table>


		</td>
	</tr>
	</tbody>
</table>
      </div>
    </body>

    </html>';
		
		$mail = new PHPMailer(true);                            
   
		try {
									
			$mail = new PHPMailer(true); // create a new object
			$mail->isSMTP();
			$mail->Host = 'localhost';
			$mail->SMTPAuth = false;
			$mail->SMTPAutoTLS = false; 
			$mail->Port = 25; 
			$mail->IsHTML(true);
			$mail->Username = "jrc@jerobyte.com";
			$mail->Password = "Jrc@2021";
			$mail->SetFrom("jrc@jerobyte.com", $_SESSION['companyname']." - Jerobyte.com");
			$mail->AddAddress($userEmail);
			$mail->addReplyTo($_SESSION['companyemail']);
			$mail->AddCC($_SESSION['companyemail']);
			$mail->Subject = $_SESSION['companyname']." - Service Call Report - ".$calltid;
			$mail->Body    = $message;
			
			if(!$mail->Send()) {
					echo 'error';
				 } else {
					 echo 'sent';
				 }
			
		} catch (Exception $e) {
			$_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			$_SESSION['status'] = 'error';
		} 
/* $mpdf = new mPDF('A4');
$mpdf->shrink_tables_to_fit = 1;
$mpdf->WriteHTML($message);
$mpdf->Output('Service Call Report - '.$calltid.'.pdf'); */
}
sendreportemail($connection, '', $_GET['email'], $engineerid, $engineername, $engsignature, $_GET['calltid']);
header("Location: calls.php?remarks=Mail Sent ( to ".$_GET['email'].") Successfully!");
}
else
{
	header("Location: calls.php?remarks=No Data Found");
}
?>