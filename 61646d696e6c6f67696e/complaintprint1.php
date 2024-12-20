<?php 
include('lcheck.php');
$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
$sqllayoutcall=mysqli_query($connection, "select * from jrclayoutcall");
$infolayoutcall=mysqli_fetch_array($sqllayoutcall);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?=$_SESSION['companyname']?> - Service Report - <?=$_GET['id']?></title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
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
@media print {
  .footer21 {page-break-after: always;}
}
</style>
</head>
<body onLoad="window.print();">
 <div style="border-style: double; padding:3px; border-color:#666666">
 <?php 
 if(isset($_GET['id']))
 {
	  function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;
}
	$calltid=mysqli_real_escape_string($connection,$_GET['id']);
	$Q=' ';
	if(isset($_GET['s']) && $_GET['s']=='p')
	{
	$Q="and reassign='1'";
	}
	else
	{
		
		$Q="and reassign='0'";
	}
	$_SESSION['calltid']=$calltid;
		$sqlselect = "SELECT engineerid, reportingengineerid, sourceid, compstatus, servicetype, customernature, calltype, callnature, serial, reportedproblem, businesstype, engineertype, engineersname, engineersid, callon, calltid  From jrccalls where calltid='".$calltid."' order by id desc";
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
				if($rowselect['engineertype']=='0')
{
$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where id='".$rowselect['engineerid']."' order by id desc";   
$queryengselect = mysqli_query($connection, $sqlengselect);   
$rowCountengselect = mysqli_num_rows($queryengselect);   
$rowengselect = mysqli_fetch_array($queryengselect);  
if($rowCountengselect>0) 
{
$engsignature=$rowengselect['signature'];   
$engineername=$rowengselect['engineername'];   
$compno=$rowengselect['compno'];   
$compprefix=$rowengselect['compprefix'];   
$engineerid=$rowengselect['id']; 
}
}
else
{
$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where id='".$rowselect['reportingengineerid']."' order by id desc";   
$queryengselect = mysqli_query($connection, $sqlengselect);   
$rowCountengselect = mysqli_num_rows($queryengselect);   
$rowengselect = mysqli_fetch_array($queryengselect);   
$engsignature=$rowengselect['signature'];   
$engineername=$rowengselect['engineername'];   
$compno=$rowengselect['compno'];   
$compprefix=$rowengselect['compprefix'];   
$engineerid=$rowengselect['id']; 
}
				
				$sqlxl = "SELECT address1, phone, mobile, email, consigneeid, stockitem, district, consigneename, stocksubcategory, componentname  From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
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
		$rowxl['address1']=jbsdecrypt($_SESSION['encpass'], $rowxl['address1']);
		}
		if($rowxl['phone']!='')
		{
		$rowxl['phone']=jbsdecrypt($_SESSION['encpass'], $rowxl['phone']);
		}
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($_SESSION['encpass'], $rowxl['mobile']);
		}
		if($rowxl['email']!='')
		{
		$rowxl['email']=jbsdecrypt($_SESSION['encpass'], $rowxl['email']);
		}
	}
}
				}
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				  $sqlcons = "SELECT address1, email, address2, area, district, pincode, contact, phone, mobile, gstno,consigneename  From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
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
		if($rowcons['consigneename']!='')
		{
		$rowcons['consigneename']=jbsdecrypt($_SESSION['encpass'], $rowcons['consigneename']);
		}
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
                $sqlserial = "SELECT location  From jrcserials where sourceid='".$rowselect['sourceid']."' order by id asc";
				$queryserial = mysqli_query($connection, $sqlserial);
				$rowCountserial = mysqli_num_rows($queryserial);
				$rowserial = mysqli_fetch_array($queryserial);
				
		$sqlcon4 = "SELECT make, mfgcode, capacity, batterymake, batteryah, noofbattery, noofset, pvmake, pvtype, pvcapacity, pvqty, pvslno, ntmake, nttype, ntcapacity, ntqty, ntslno, problemobserved, shadow, noofplstr, noofstr, tilt, plposter, civil, mechanical, elecwiring, acearth, dcearth, laearth, spvvol, spvcur, plvoc, plcell, plseries, plparallel, plvol, plangel, plpower, pltime, avgloadnight, avgloadday, totalload, inputsupply, dvstfree, earthingcheck, upsavailability, airconditioned, inputvoltage, earthleakage, cleaning, softwarecheck, antiviruscheck, looseconnection, speedcheck, tempfilecleaning, hardwarecheck, printcheck, keyboard, mouse, mfpbwa4cpr, mfpbwa4fax, mfpbwa4prp, mfpclcpr, mfpclfax, mfpclprp, priportmaster, priportcopies, totalmeterreading, verification, modificationwiring, pollutionlevel, directsunlight, waterdripping, moisture, wiringready, coastelarea, voliry, volirn, curir, freir, voliyb, volibn, curiy, freiy, volibr, voliyn, curib, freib, voline, curin, volipn, curip, freip, volipe, cur1in, vol1ine, volory, volorn, curor, freor, voloyb, volobn, curoy, freoy, volobr, voloyn, curob, freob, volone, curon, phasetype, volopn, curop, freop, volope, cur1on, vol1one, stabilizer, phasereverse, earthing, overload, batterycondition, chargingv, chargingo, dischargingv, dischargingo, dischargingwv, dischargingwo, sparesused1q, sparesused2q, sparesused3q, sparesused4q, sparesused5q, sparesrequired1q, sparesrequired2q, sparesrequired3q, sparesrequired4q, sparesrequired5q, engineerreport, callstatus, editedon, addedon, actiontaken, customerfeedback, engapproach, imgbefuploads, imguploads, incgst, schargegst, schargegstvalue, imgseal, schargeno, schargedate, srno, schargepre, scharge, signname,signature,smaterial1,smaterial2,smaterial3,smaterial4,smaterial5,sgstper1,sgstper2,sgstper3,sgstper4,sgstper5,schargepre1,schargepre2,schargepre3,schargepre4,schargepre5,sgstpervalue1,sgstpervalue2,sgstpervalue3,sgstpervalue4,sgstpervalue5,schargescharge,schargegst,mchargegstvalue,squantity1,squantity2,squantity3,squantity4,squantity5,stotal1,stotal2,stotal3,stotal4,stotal5,sgstpervalue1,sgstpervalue2,sgstpervalue3,sgstpervalue4,sgstpervalue5,sparesused1,sparesused2,sparesused3,sparesused4,sparesused5,sparesrequired1,sparesrequired2,sparesrequired3,sparesrequired4,sparesrequired5,airearthing,airstabilizer,airtonnage,airipvolt,airopvolt,aircurrent,airgril,airroom,airdpressure,airspressure,airothers,airambient  From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' $Q";
		$querycon4 = mysqli_query($connection, $sqlcon4);
		$rowcon4=mysqli_num_rows($querycon4);
		$infocon4=mysqli_fetch_array($querycon4);
		?>
		<?php 
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
					  else if($rowselect['compstatus']=='3')
					  {
						$bg="bg-info";
						$bgtext="Cancelled";
					  }
					  else
					 {
						 $bg="bg-danger";
						$bgtext="Open";
					  }
					  ?>
					  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="right" rowspan="2"><img src="<?=$_SESSION['companylogo']?>" height="50">
					  </td>
					  <td colspan="2" align="center"><p class="heading" style="font-size:31px;"><?=$_SESSION['companyname']?></p>
					  </td>
					  </tr>
					  <tr>
					  <td colspan="2" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?></td>
					  </tr>
					  </table>
					  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td><strong>E.mail:</strong> <?=$_SESSION['companyemail']?></td>
					  <td align="center"><strong>Mobile:</strong> <?=$_SESSION['companymobile']?><?=($_SESSION['companymobile1']!='')?' | '.$_SESSION['companymobile1']:''?><?=($_SESSION['companymobile2']!='')?' | '.$_SESSION['companymobile2']:''?></td>
					  <td align="right"><strong>GSTIN:</strong> <?=$_SESSION['companygstno']?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td rowspan="2" width="25%"><strong>SCR. No.:</strong> <b><font size="+1"><?=$infocon4['srno']?></font></b></td>
					  <td align="center" width="50%" rowspan="2" class="heading" style="font-size:24px;">SERVICE CALL REPORT</td>
					  <td align="left"><strong>Call ID:</strong></td>
					  <td align="left"><?=$rowselect['calltid']?></td>
					  </tr>
					  <tr>
					  <td align="left"><strong>Date:</strong></td>
					  <td align="left"><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
					  </tr>
					  </table>
					  <?php 
					  if(($infolayoutcall['servicetype']=='1')||($infolayoutcall['customernature']=='1'))
					  {
						?>  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					   <?php 
					  if(($infolayoutcall['servicetype']=='1'))
					  {
						?> 
					  <th style="width:10px">SERVICE TYPE</th>
					  <td align="left" style="width:10px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['servicetype']?></td>
					  <?php 
					  }
					  if(($infolayoutcall['customernature']=='1'))
					  {
						?> 
					  <th style="width:10px">CUSTOMER NATURE</th>
					  <td align="left" style="width:10px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['customernature']?></td>
					  <?php 
					  } 
					  }
					  if($infolayoutcall['calltype']=='1')
					  {
					  ?>
					  <th style="width:10px">CALL TYPE</th>
					  <td align="left" style="width:10px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['calltype']?></td> 
					  <?php 
					  }
					  ?>
					  <?php 
					  if(($infolayoutcall['callnature']=='1')||($infolayoutcall['servicetype']=='1'))
					  {
						?>  
					 
					  <?php 
					   if($infolayoutcall['callnature']=='1')
					  {
					  ?>
					  <th style="width:10px">CALL NATURE</th>
					  <td align="left" style="width:10px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['callnature']?></td> 
					  <?php 
					  }
					  ?>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center"><strong>CUSTOMER INFORMATION</strong></td>
					  </tr>
					  <tr>
					  <td align="left" width="40%" rowspan="5"><p><strong><?=$rowcons['consigneename']?></strong> - <strong>
					   <?php 
					  if($infolayoutcustomers['address1']=='1')
					  {
						?> 
					  <?=$rowcons['address1']?> 
					  <?php 
					  }
					  ?> 
					  <?php 
					  if($infolayoutcustomers['address2']=='1')
					  {
					  ?> 
					  <?=$rowcons['address2']?> 
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutcustomers['area']=='1')
					  {
					  ?> 
					  <?=$rowcons['area']?> 
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutcustomers['district']=='1')
					  {
					  ?> 
					  <?=$rowcons['district']?> 
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutcustomers['pincode']=='1')
					  {
					  ?> 
					  <?=$rowcons['pincode']?> 
					  <?php 
					  }
					  ?> - 
					  <?php 
					  if($infolayoutcustomers['contact']=='1')
					  {
					  ?> 
					  <?=$rowcons['contact']?> 
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutcustomers['phone']=='1')
					  {
					  ?> 
					  <?=$rowcons['phone']?> 
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutcustomers['mobile']=='1')
					  {
					  ?> 
					  <?=$rowcons['mobile']?> 
					  <?php 
					  }
					  ?>
					  </strong></p></td>
					  </tr>
					  </table>
					   <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td colspan="6" align="center"><strong>PRODUCT INFORMATION</strong></td>
					  </tr>
					  <tr>
					  <td align="left" colspan="6"><b>Product Name -</b> 
					  <?php 
					  if($infolayoutproducts['stocksubcategory']=='1')
					  {
					  ?> 					  
					  <?=$rowxl['stocksubcategory']?> - 
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutproducts['componentname']=='1')
					  {
					  ?> 					  
					  <?=$rowxl['componentname']?> - 
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutproducts['stockitem']=='1')
					  {
					  ?> 					  
					  <?=$rowxl['stockitem']?>
					  <?php 
					  }
					  ?></p></td>
					  </tr>
					  <?php 
					  if(($infolayoutservice['make']=='1')||($infolayoutservice['mfgcode']=='1')||($infolayoutservice['capacity']=='1'))
					  {
					  ?>
					  <tr>
					  <?php 
					  $pi=0;
					  ?>
					  <?php 
					  if($infolayoutservice['make']=='1')
					  {
					  ?> 
					  <td width="10%"><strong>Make</strong></td><td width="23%"><?=$infocon4['make']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['mfgcode']=='1')
					  {
					  ?> 
					  <td width="10%"><strong>MFG Code</strong></td><td width="23%"><?=$infocon4['mfgcode']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?><?php 
					  if($infolayoutservice['capacity']=='1')
					  {
					  ?> 
					  <td width="10%"><strong>Capacity/Model</strong></td><td width="23%"><?=$infocon4['capacity']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutcall['serial']=='1')
					  {
					  ?> 
					  <td width="10%"><strong>Sl.No</strong></td><td><?=$rowselect['serial']?><?=($rowserial['location']!='')?'-'.$rowserial['location']:''?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  </tr>
					  <?php
					  }
					  ?>
					  </table>
					  <?php 
					  if(($rowselect['businesstype']=='UPS BATTERY')||($rowselect['businesstype']=='SOLAR'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>BATTERY</strong></td>
					  <td style="padding:0px;">
					  <table border="1" style="border:1px solid #bbbbbb; margin-bottom: 0px; border-top:0;">
					  <tr>
					  <?php 
					  $pi=0;
					  ?>
					  <?php 
					  if($infolayoutservice['batterymake']=='1')
					  {
					  ?> 
					  <td width="5%"><strong>Battery Make</strong></td><td width="5%"><?=$infocon4['batterymake']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					   
					  <?php 
					  if($infolayoutservice['batteryah']=='1')
					  {
					  ?> 
					  <td width="5%"><strong>Battery AH</strong></td><td width="5%"><?=$infocon4['batteryah']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['noofbattery']=='1')
					  {
					  ?> 
					  <td width="5%"><strong>No.of Battery</strong></td><td width="5%"><?=$infocon4['noofbattery']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['noofset']=='1')
					  {
					  ?> 
					  <td width="5%"><strong>No.of Set</strong></td><td width="5%"><?=$infocon4['noofset']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  </tr>
					  </table>
					  </td>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  
					  <?php 
					  if($rowselect['businesstype']=='SOLAR')
					  {
					  if(($infolayoutservice['pvmake']=='1')||($infolayoutservice['pvtype']=='1')||($infolayoutservice['pvcapacity']=='1')||($infolayoutservice['pvqty']=='1')||($infolayoutservice['pvslno']=='1'))
					  {  
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>PV PANEL</strong></td>
					  <td style="padding:0px;">
					  <table border="1" style="border:1px solid #bbbbbb; margin-bottom: 0px; border-top:0;">
					  <tr>
					  <?php 
					  $pi=0;
					  ?>
					  <?php 
					  if($infolayoutservice['pvmake']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Make</strong></td><td width="15%"><?=$infocon4['pvmake']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					   
					  <?php 
					  if($infolayoutservice['pvtype']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Type</strong></td><td width="15%"><?=$infocon4['pvtype']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['pvcapacity']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Capacity/Model</strong></td><td width="15%"><?=$infocon4['pvcapacity']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['pvqty']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Qty</strong></td><td width="15%"><?=$infocon4['pvqty']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['pvslno']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>SL No</strong></td><td width="15%"><?=$infocon4['pvslno']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  </tr>
					  </table>
					  </td>
					  </tr>
					  </table>
					  <?php 
					  }
					  if(($infolayoutservice['ntmake']=='1')||($infolayoutservice['nttype']=='1')||($infolayoutservice['ntcapacity']=='1')||($infolayoutservice['ntqty']=='1')||($infolayoutservice['ntslno']=='1'))
					  {  
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>NET METER</strong></td>
					  <td style="padding:0px;">
					  <table border="1" style="border:1px solid #bbbbbb; margin-bottom: 0px; border-top:0;">
					  <tr>
					  <?php 
					  $pi=0;
					  ?>
					  <?php 
					  if($infolayoutservice['ntmake']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Make</strong></td><td width="15%"><?=$infocon4['ntmake']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					   
					  <?php 
					  if($infolayoutservice['nttype']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Type</strong></td><td width="15%"><?=$infocon4['nttype']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['ntcapacity']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Capacity/Model</strong></td><td width="15%"><?=$infocon4['ntcapacity']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['ntqty']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Qty</strong></td><td width="15%"><?=$infocon4['ntqty']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['ntslno']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>SL No</strong></td><td width="15%"><?=$infocon4['ntslno']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  </tr>
					  </table>
					  </td>
					  </tr>
					  </table>
					  <?php 
					  }
					  }
					  ?>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <?php 
					  if($infolayoutcall['reportedproblem']=='1')
					  {
					  ?> 
					  <td align="center" width="50%"><strong>PROBLEM REPORTED</strong></td>
					  <?php 
					  }
					  ?>
					   <?php 
					  if($infolayoutservice['problemobserved']=='1')
					  {
					  ?>
					  <td align="center"><strong>PROBLEM OBSERVED</strong></td>
					  <?php 
					  }
					  ?>
					  </tr>
					  <tr>
					  <?php 
					  if($infolayoutcall['reportedproblem']=='1')
					  {
					  ?> 
					  <td align="center" class="font-weight-bold text-primary"><?=$rowselect['reportedproblem']?></td>
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['problemobserved']=='1')
					  {
					  ?>
					  <td align="center" class="font-weight-bold text-primary"><?=$infocon4['problemobserved']?></td>
					  <?php 
					  }
					  ?>
					  </tr>
					  </table>
					  <?php 
					  if($rowselect['businesstype']=='SOLAR')
					  {
						  if(($infolayoutservice['shadow']=='1')||($infolayoutservice['noofplstr']=='1')||($infolayoutservice['noofstr']=='1')||($infolayoutservice['tilt']=='1')||($infolayoutservice['plposter']=='1')||($infolayoutservice['civil']=='1')||($infolayoutservice['mechanical']=='1')||($infolayoutservice['elecwiring']=='1')||($infolayoutservice['acearth']=='1')||($infolayoutservice['dcearth']=='1')||($infolayoutservice['laearth']=='1'))
						  {
						  ?>
						  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>SITE DETAILS</strong></td>
					  <td style="padding:0px;">
					  <table border="1" style="border:1px solid #bbbbbb; margin-bottom: 0px; border-top:0;">
					  <tr>
					  <?php 
					  $pi=0;
					  ?>
					  <?php 
					  if($infolayoutservice['shadow']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Shadow Free Area</strong></td><td width="10%"><?=($infocon4['shadow']=='1')?'Yes':'No'?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					   
					  <?php 
					  if($infolayoutservice['noofplstr']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>No of Panel in String</strong></td><td width="10%"><?=$infocon4['noofplstr']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['noofstr']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>No of Strings</strong></td><td width="10%"><?=$infocon4['noofstr']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['tilt']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Tilt Angle</strong></td><td width="10%"><?=$infocon4['tilt']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['plposter']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Panel Position</strong></td><td width="10%"><?=$infocon4['plposter']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['civil']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Civil Structure</strong></td><td width="10%"><?=($infocon4['civil']=='1')?'Yes':'No'?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  <?php 
					  if($infolayoutservice['mechanical']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Mechanical Structure</strong></td><td width="15%"><?=($infocon4['mechanical']=='1')?'Yes':'No'?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['elecwiring']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>Electrical Wiring</strong></td><td width="15%"><?=($infocon4['elecwiring']=='1')?'Yes':'No'?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['acearth']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>AC Earthing</strong></td><td width="15%"><?=($infocon4['acearth']=='1')?'Yes':'No'?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['dcearth']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>DC Earthing</strong></td><td width="15%"><?=($infocon4['dcearth']=='1')?'Yes':'No'?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['laearth']=='1')
					  {
					  ?> 
					  <td width="15%"><strong>LA Earthing</strong></td><td width="15%"><?=($infocon4['laearth']=='1')?'Yes':'No'?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  
					  </tr>
					  </table>
					  </td>
					  </tr>
					  </table>
					  
						  <?php 
						  }
					  if(($infolayoutservice['ntmake']=='1')||($infolayoutservice['nttype']=='1')||($infolayoutservice['ntcapacity']=='1')||($infolayoutservice['ntqty']=='1')||($infolayoutservice['ntslno']=='1'))
					  {  
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>SOLAR DETAILS</strong></td>
					  <td style="padding:0px;">
					  <table border="1" style="border:1px solid #bbbbbb; margin-bottom: 0px; border-top:0;">
					  <tr>
					  <?php 
					  $pi=0;
					  ?>
					  <?php 
					  if($infolayoutservice['spvvol']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>SPV Charging Volt.</strong></td><td width="10%"><?=$infocon4['spvvol']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['spvcur']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>SPV Charging Current</strong></td><td width="10%"><?=$infocon4['spvcur']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['plvoc']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Panel VOC (String)</strong></td><td width="10%"><?=$infocon4['plvoc']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['plcell']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Panel Cells</strong></td><td width="10%"><?=$infocon4['plcell']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['plseries']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Panel String in Series</strong></td><td width="10%"><?=$infocon4['plseries']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['plparallel']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Panel String in Parallel</strong></td><td width="10%"><?=$infocon4['plparallel']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['plvol']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Panel Volt. at SPV Chg. ON</strong></td><td width="10%"><?=$infocon4['plvol']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['plangel']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>SPV Charging Voltage</strong></td><td width="10%"><?=$infocon4['plangel']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['plpower']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Panel Power</strong></td><td width="10%"><?=$infocon4['plpower']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['pltime']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Time</strong></td><td width="10%"><?=$infocon4['pltime']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['avgloadnight']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Average Load (night)</strong></td><td width="10%"><?=$infocon4['avgloadnight']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['avgloadday']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Average Load (day)</strong></td><td width="10%"><?=$infocon4['avgloadday']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['totalload']=='1')
					  {
					  ?> 
					  <td width="20%"><strong>Total Load</strong></td><td width="10%"><?=$infocon4['totalload']?></td>
					  <?php 
					  $pi++;
					  if(($pi%3)==0)
					  {
						  ?>
						  </tr>
						  <tr>
						  <?php 
					  }
					  }
					  ?>
					   
					  </tr>
					  </table>
					  </td>
					  </tr>
					  </table>
					  <?php 
					  }
					  }
					  
					  if($rowselect['businesstype']=='COMPUTERS')
					  {
						  if(($infolayoutservice['inputsupply']=='1')||($infolayoutservice['dvstfree']=='1')||($infolayoutservice['earthingcheck']=='1')||($infolayoutservice['upsavailability']=='1')||($infolayoutservice['airconditioned']=='1'))
						  {
						  ?>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td align="center" width="20%" rowspan="3"><strong>SITE VERIFICATION</strong></td>
						  <td><strong>Input Supply : </strong><span class="float-right"><?=($infocon4['inputsupply']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Dust Free : </strong><span class="float-right"><?=($infocon4['dvstfree']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Earthing : </strong><span class="float-right"><?=($infocon4['earthingcheck']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td><strong>UPS Availability : </strong><span class="float-right"><?=($infocon4['upsavailability']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Air Conditioned :</strong> <span class="float-right"><?=($infocon4['airconditioned']=='1')?'Yes':'No'?></span></td>
						  <td></td>
						  </tr>
						  </table>
						  <?php 
						  }
						  if(($infolayoutservice['inputvoltage']=='1')||($infolayoutservice['earthleakage']=='1'))
						  {
						  ?>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td align="center" width="20%"><strong>VOLTAGE INFO</strong></td>
						  <td><strong>Input Voltage :</strong> <span class="float-right"><?=$infocon4['inputvoltage']?></span></td>
						  <td><strong>Earth Leakage :</strong> <span class="float-right"><?=$infocon4['earthleakage']?></span></td>
						  </tr>
						  </table>
						  <?php 
						  }
						  if(($infolayoutservice['cleaning']=='1')||($infolayoutservice['softwarecheck']=='1')||($infolayoutservice['antiviruscheck']=='1')||($infolayoutservice['looseconnection']=='1')||($infolayoutservice['speedcheck']=='1')||($infolayoutservice['tempfilecleaning']=='1')||($infolayoutservice['hardwarecheck']=='1')||($infolayoutservice['printcheck']=='1')||($infolayoutservice['keyboard']=='1')||($infolayoutservice['mouse']=='1'))
						  {
						  ?>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td align="center" width="20%" rowspan="4"><strong>MAINTENANCE INFO</strong></td>
						  <td><strong>Cleaning : </strong><span class="float-right"><?=($infocon4['cleaning']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Software Check :</strong> <span class="float-right"><?=($infocon4['softwarecheck']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Antivirus Check : </strong><span class="float-right"><?=($infocon4['antiviruscheck']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td><strong>Loose Connection :</strong> <span class="float-right"><?=($infocon4['looseconnection']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Speed Check :</strong> <span class="float-right"><?=($infocon4['speedcheck']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Temp File Cleaning : </strong><span class="float-right"><?=($infocon4['tempfilecleaning']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td><strong>Hardware Check : </strong><span class="float-right"><?=($infocon4['hardwarecheck']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Print Check :</strong> <span class="float-right"><?=($infocon4['printcheck']=='1')?'Yes':'No'?></span></td>
						  <td><strong>Keyboard :</strong> <span class="float-right"><?=($infocon4['keyboard']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td><strong>Mouse :</strong> <span class="float-right"><?=($infocon4['mouse']=='1')?'Yes':'No'?></span></td>
						  <td></td>
						  <td></td>
						  </tr>
						  </table>
						  <?php 
						  }
					  }
					  if($rowselect['businesstype']=='COPIER')
					  {
					  if($infolayoutservice['meterreading']=='1')
					  {
								  ?>
								  <table border="1" style="border:1px solid #bbbbbb">
								  <tr>
								  <td align="center" width="13%"><strong>METER READING</strong></td>
								  <td>
								  <table border="1" style="border:1px solid #bbbbbb">
									  <tr>
									  <th rowspan="3" style="width:150px;"><strong>MFP B/W A4</strong></th>
									  <th style="width:150px;"><strong>COPY PRINTER</strong></th>									  
									  <td><?=$infocon4['mfpbwa4cpr']?></td>
									  </tr>
									  <tr>
									  <th><strong>FAX</strong></th>
									  <td><?=$infocon4['mfpbwa4fax']?></td>
									  </tr>
									  <tr>
									  <th><strong>PRINTER</strong></th>
									  <td><?=$infocon4['mfpbwa4prp']?></td>
									  </tr>
									  
									   <tr>
									  <th rowspan="3"><strong>MFP COLOR</strong></th>
									  <th><strong>COPY PRINTER</strong></th>									  
									  <td><?=$infocon4['mfpclcpr']?></td>
									  </tr>
									  <tr>
									  <th><strong>FAX</strong></th>
									  <td><?=$infocon4['mfpclfax']?></td>
									  </tr>
									  <tr>
									  <th><strong>PRINTER</strong></th>
									  <td><?=$infocon4['mfpclprp']?></td>
									  </tr>
									  
									   <tr>
									  <th rowspan="2"><strong>PRI-PORT</strong></th>
									  <th><strong>MASTER</strong></th>									  
									  <td><?=$infocon4['priportmaster']?></td>
									  </tr>
									  <tr>
									  <th><strong>COPIES</strong></th>
									  <td><?=$infocon4['priportcopies']?></td>
									  </tr>
									  
									  <tr>
									  <th colspan="2"><strong>TOTAL</strong></th>
									  <td><?=$infocon4['totalmeterreading']?></td>
									  </tr>

									  
								  </table>
								  </td>
								  </tr>
								  </table>
								  <?php 
							  }
					  
					  }
					  
					  
					      if($rowselect['businesstype']=='AIR CONDITIONERS')
					  {
					
								  ?>
								  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" colspan="12"><strong>TECHNICAL DETAILS</strong></td>
					  </tr>
									  <th colspan="2"  width="10%">Earthing</th>
									  <td><?=$infocon4['airearthing']?></td> 
									  <th colspan="2"  width="10%">I/P Voltage</th>
									  <td><?=($infocon4['airipvolt']!='')?$infocon4['airipvolt'].'V':''?></td> 
									  <th colspan="2"  width="10%">Grill</th>
									  <td><?=($infocon4['airgril']!='')?$infocon4['airgril'].'°C':''?></td> 
									  <th colspan="2"  width="10%">D.Pressure</th>
									  <td><?=($infocon4['airdpressure']!='')?$infocon4['airdpressure'].'PSI':''?></td> 
									 
									  
					  </tr>  
					  <tr>
					 <th colspan="2"  width="10%">stabilizer</th>
									  <td><?=($infocon4['airstabilizer']!='')?$infocon4['airstabilizer']:''?></td>
									   <th colspan="2"  width="10%">O/P Voltage</th>
									  <td><?=($infocon4['airopvolt']!='')?$infocon4['airopvolt'].'V':''?></td>  
									  <th colspan="2"  width="10%">Room</th>
									  <td><?=($infocon4['airroom']!='')?$infocon4['airroom'].'°C':''?></td> 
									  <th colspan="2"  width="10%">S.Pressure</th>
									  <td><?=($infocon4['airspressure']!='')?$infocon4['airspressure'].'PSI':''?></td> 
									 
					  </tr> 
					  <tr>
					 <th colspan="2"  width="10%">Tonnage / R.Size</th>
									  <td><?=($infocon4['airtonnage']!='')?$infocon4['airtonnage']:''?></td>
									   <th colspan="2"  width="10%">Current Drawn</th>
									  <td><?=($infocon4['aircurrent']!='')?$infocon4['aircurrent'].'A':''?></td>
									  <th colspan="2"  width="10%">Ambient</th>
									  <td><?=($infocon4['airambient']!='')?$infocon4['airambient'].'°C':''?></td>
									  <th  colspan="2" >Refrigerant Gas</th>
									  <td><?=($infocon4['airothers']!='')?$infocon4['airothers']:''?></td> 
					  </tr>
					  </table>	
								  <?php
					  }
					  
					  if($rowselect['businesstype']=='UPS BATTERY')
					  {
					  if(($infolayoutservice['verification']=='1')||($infolayoutservice['modificationwiring']=='1')||($infolayoutservice['pollutionlevel']=='1')||($infolayoutservice['directsunlight']=='1')||($infolayoutservice['waterdripping']=='1')||($infolayoutservice['moisture']=='1')||($infolayoutservice['wiringready']=='1')||($infolayoutservice['coastelarea']=='1'))
					  {
						  
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="3"><strong>SITE VERIFICATION</strong></td>
					  <?php
					  $se=0;
					  $se1=0;
					  if($infolayoutservice['verification']=='1')
					  {
						?>  
					  <td><strong>Ventilation :</strong> <span class="float-right"><?=($infocon4['verification']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($infolayoutservice['modificationwiring']=='1')
					  {
						?> 
					  <td><strong>Modification on Wiring :</strong> <span class="float-right"><?=($infocon4['modificationwiring']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($infolayoutservice['pollutionlevel']=='1')
					  {
						?> 
					  <td><strong>Pollution Level :</strong> <span class="float-right"><?=($infocon4['pollutionlevel']=='1')?'High':($infocon4['pollutionlevel']=='2')?'Medium':'Low'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($se%3==0)
					  {
						  ?>
						  </tr>
						  <?php 
						  $se1=1;						  
					  }
					  ?>
					  <?php
					  if($infolayoutservice['directsunlight']=='1')
					  {
						  if($se1==1)
						  {
							  ?>
							  <tr>
							  <?php
							  $se1=0;
						  }
						?> 
					  <td><strong>Direct Sunlight : </strong><span class="float-right"><?=($infocon4['directsunlight']=='1')?'Yes':($infocon4['directsunlight']=='2')?'Partial':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($se%3==0)
					  {
						  ?>
						  </tr>
						  <?php 
						  $se1=1;						  
					  }
					  ?>
					  <?php
					  if($infolayoutservice['waterdripping']=='1')
					  {
						  if($se1==1)
						  {
							  ?>
							  <tr>
							  <?php
							  $se1=0;
						  }
						?> 
					  <td><strong>Rain/Cleaning Water Dripping :</strong> <span class="float-right"><?=($infocon4['waterdripping']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($se%3==0)
					  {
						  ?>
						  </tr>
						  <?php 
						  $se1=1;						  
					  }
					  ?>
					  <?php
					  if($infolayoutservice['moisture']=='1')
					  {
						  if($se1==1)
						  {
							  ?>
							  <tr>
							  <?php
							  $se1=0;
						  }
						?>
					  <td><strong>Moisture :</strong> <span class="float-right"><?=($infocon4['moisture']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($se%3==0)
					  {
						  ?>
						  </tr>
						  <?php 
						  $se1=1;						  
					  }
					  ?>
					  <?php
					  if($infolayoutservice['wiringready']=='1')
					  {
						  if($se1==1)
						  {
							  ?>
							  <tr>
							  <?php
							  $se1=0;
						  }
					  ?>
					  <td><strong>Wiring Ready :</strong> <span class="float-right"><?=($infocon4['wiringready']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($se%3==0)
					  {
						  ?>
						  </tr>
						  <?php 
						  $se1=1;						  
					  }
					  ?>
					  <?php
					  if($infolayoutservice['coastelarea']=='1')
					  {
						  if($se1==1)
						  {
							  ?>
							  <tr>
							  <?php
							  $se1=0;
						  }
					  ?>
					  <td><strong>Coastal Area :</strong> <span class="float-right"><?=($infocon4['coastelarea']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($se%3==0)
					  {
						  ?>
						  </tr>
						  <?php 
						  $se1=1;						  
					  }
					  if($se1!=1)
					  {
						 $y=($se%3);
						 $z=3-$y;
						  
						  for($i=0;$i<$z;$i++)
						  {
							  ?>
							  <td></td>
							  <?php
						  }
						  ?>
						  </tr>
						  <?php
					  }
					  ?>
					  
					  
					  </tr>
					  </table>
					  <?php 
					  }
					  }
					  if(($rowselect['businesstype']=='UPS BATTERY')||($rowselect['businesstype']=='SOLAR'))
					  {
					  ?>
					  <?php 
					  if($infolayoutservice['acdata']=='1')
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" colspan="2"><strong>AC DATA</strong></td>
					  </tr>
					  <tr>
					  <td align="center" width="50%"><strong>INPUT - <?=($infocon4['phasetype']=='31')?'3Φ':''?><?=($infocon4['phasetype']=='33')?'3Φ':''?><?=($infocon4['phasetype']=='11')?'1Φ':''?></strong></td>
					  <td align="center"><strong>OUTPUT - <?=($infocon4['phasetype']=='31')?'1Φ':''?><?=($infocon4['phasetype']=='33')?'3Φ':''?><?=($infocon4['phasetype']=='11')?'1Φ':''?></strong></td>
					  </tr>
					  <tr>
					  <td align="center" style="padding:3px; vertical-align:top">
					  <?php 
					  if(($infocon4['phasetype']=='31')||($infocon4['phasetype']=='33'))
					  {
						?>  
					  <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" colspan="2"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>RY:</strong> <span class="float-right"><?=$infocon4['voliry']?></span></td>
					  <td width="25%"><strong>RN:</strong> <span class="float-right"><?=$infocon4['volirn']?></span></td>
					  <td width="25%"><strong>R:</strong> <span class="float-right"><?=$infocon4['curir']?></span></td>
					  <td width="25%"><strong>R:</strong> <span class="float-right"><?=$infocon4['freir']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>YB:</strong> <span class="float-right"><?=$infocon4['voliyb']?></span></td>
					  <td width="25%"><strong>BN:</strong> <span class="float-right"><?=$infocon4['volibn']?></span></td>
					  <td width="25%"><strong>Y:</strong> <span class="float-right"><?=$infocon4['curiy']?></span></td>
					  <td width="25%"><strong>Y: </strong><span class="float-right"><?=$infocon4['freiy']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>BR:</strong> <span class="float-right"><?=$infocon4['volibr']?></span></td>
					  <td width="25%"><strong>YN:</strong> <span class="float-right"><?=$infocon4['voliyn']?></span></td>
					  <td width="25%"><strong>B:</strong> <span class="float-right"><?=$infocon4['curib']?></span></td>
					  <td width="25%"><strong>B:</strong> <span class="float-right"><?=$infocon4['freib']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"></td>
					  <td width="25%"><strong>NE:</strong> <span class="float-right"><?=$infocon4['voline']?></span></td>
					  <td width="25%"><strong>N:</strong> <span class="float-right"><?=$infocon4['curin']?></span></td>
					  <td width="25%"></td>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  <?php 
					  if(($infocon4['phasetype']=='11'))
					  {
						?>  
					  <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>PN:</strong> <span class="float-right"><?=$infocon4['volipn']?></span></td>
					  <td width="25%"><strong>P:</strong> <span class="float-right"><?=$infocon4['curip']?></span></td>
					  <td width="25%"><strong>P: </strong><span class="float-right"><?=$infocon4['freip']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>PE:</strong> <span class="float-right"><?=$infocon4['volipe']?></span></td>
					  <td width="25%"><strong>N:</strong> <span class="float-right"><?=$infocon4['cur1in']?></span></td>
					  <td width="25%"></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>NE:</strong> <span class="float-right"><?=$infocon4['vol1ine']?></span></td>
					  <td width="25%"></td>
					  <td width="25%"></td>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  </td>
					  <td align="center" style="padding:3px; vertical-align:top">
					  <?php 
					  if(($infocon4['phasetype']=='33'))
					  {
						 ?> 
					  <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" colspan="2"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>RY: </strong><span class="float-right"><?=$infocon4['volory']?></span></td>
					  <td width="25%"><strong>RN:</strong> <span class="float-right"><?=$infocon4['volorn']?></span></td>
					  <td width="25%"><strong>R: </strong><span class="float-right"><?=$infocon4['curor']?></span></td>
					  <td width="25%"><strong>R: </strong><span class="float-right"><?=$infocon4['freor']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>YB:</strong> <span class="float-right"><?=$infocon4['voloyb']?></span></td>
					  <td width="25%"><strong>BN:</strong> <span class="float-right"><?=$infocon4['volobn']?></span></td>
					  <td width="25%"><strong>Y:</strong> <span class="float-right"><?=$infocon4['curoy']?></span></td>
					  <td width="25%"><strong>Y:</strong> <span class="float-right"><?=$infocon4['freoy']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>BR:</strong> <span class="float-right"><?=$infocon4['volobr']?></span></td>
					  <td width="25%"><strong>YN:</strong> <span class="float-right"><?=$infocon4['voloyn']?></span></td>
					  <td width="25%"><strong>B:</strong> <span class="float-right"><?=$infocon4['curob']?></span></td>
					  <td width="25%"><strong>B:</strong> <span class="float-right"><?=$infocon4['freob']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"></td>
					  <td width="25%"><strong>NE:</strong> <span class="float-right"><?=$infocon4['volone']?></span></td>
					  <td width="25%"><strong>N:</strong> <span class="float-right"><?=$infocon4['curon']?></span></td>
					  <td width="25%"></td>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  <?php 
					  if(($infocon4['phasetype']=='31')||($infocon4['phasetype']=='11'))
					  {
						?>  
					  <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center"><strong>Voltage</strong></td>
					  <td align="center"><strong>Current</strong></td>
					  <td align="center"><strong>Frequency</strong></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>PN:</strong> <span class="float-right"><?=$infocon4['volopn']?></span></td>
					  <td width="25%"><strong>P: </strong><span class="float-right"><?=$infocon4['curop']?></span></td>
					  <td width="25%"><strong>P:</strong><span class="float-right"><?=$infocon4['freop']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>PE:</strong> <span class="float-right"><?=$infocon4['volope']?></span></td>
					  <td width="25%"><strong>N:</strong> <span class="float-right"><?=$infocon4['cur1on']?></span></td>
					  <td width="25%"></td>
					  </tr>
					  <tr>
					  <td width="25%"><strong>NE:</strong> <span class="float-right"><?=$infocon4['vol1one']?></span></td>
					  <td width="25%"></td>
					  <td width="25%"></td>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  </td>
					  </tr>
					  </table>
					  <?php 
					  }
					  }
					  if($rowselect['businesstype']=='UPS BATTERY')
					  {
					  ?>
					   <?php 
					  if(($infolayoutservice['stabilizer']=='1')||($infolayoutservice['phasereverse']=='1')||($infolayoutservice['earthing']=='1')||($infolayoutservice['overload']=='1'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td width="25%" style="padding:0px 50px;"><strong>Stabilizer :</strong> <span class="float-right"><?=($infocon4['stabilizer']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;"><strong>Phase Reverse : </strong><span class="float-right"><?=($infocon4['phasereverse']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;"><strong>Earthing :</strong> <span class="float-right"><?=($infocon4['earthing']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;"><strong>Overload : </strong><span class="float-right"><?=($infocon4['overload']=='1')?'Yes':'No'?></span></td>
					  </table>
					  <?php 
					  }
					  }
					  if(($rowselect['businesstype']=='UPS BATTERY')||($rowselect['businesstype']=='SOLAR'))
					  {
					  ?>
					  <?php 
					  if(($infolayoutservice['dcdata']=='1'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>DC Data</strong></td>
					  <td colspan="2" width="20%" align="center"><strong>@ Charging</strong></td>
					  <td colspan="2" width="25%" align="center"><strong>@ Discharging with Load</strong></td>
					  <td colspan="2" width="25%" align="center"><strong>@ Discharging without Load</strong></td>
					  <td align="center" width="10%" rowspan="2"><strong>Battery Condition</strong></td>
					  <td align="center" width="10%" rowspan="2"><?=$infocon4['batterycondition']?></td>
					  </tr>
					  <tr>
					  <td><?=$infocon4['chargingv']?> <span class="float-right">V</span></td>
					  <td><?=$infocon4['chargingo']?> <span class="float-right">A</span></td>
					  <td><?=$infocon4['dischargingv']?> <span class="float-right">V</span></td>
					  <td><?=$infocon4['dischargingo']?> <span class="float-right">A</span></td>
					  <td><?=$infocon4['dischargingwv']?> <span class="float-right">V</span></td>
					  <td><?=$infocon4['dischargingwo']?> <span class="float-right">A</span></td>
					  </tr>
					  </table>
					  <?php 
					  }
					  }
					  ?>				  
					  <?php 
					  if(($infolayoutservice['sparesused']=='1')||($infolayoutservice['sparesrequired']=='1'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <?php 
if(($infolayoutservice['sparesused']=='1'))
{
?>
					  <td align="center" width="50%"><strong>SPARES USED</strong></td>
<?php 
}
?>
<?php 
if(($infolayoutservice['sparesrequired']=='1'))
{
?>
					  <td align="center"><strong>SPARES REQUIRED</strong></td>
<?php 
}
?>
					  </tr>
					  <tr>
					  <?php 
if(($infolayoutservice['sparesused']=='1'))
{
?>
					  <td align="center" style="padding:3px; vertical-align:top">
					  <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center"><strong>S.No</strong></td>
					  <td align="center"><strong>Name</strong></td>
					  <td align="center"><strong>Qty</strong></td>
					  </tr>
					  <?php
$j=0;					  
					  for($i=1;$i<=5;$i++)
					  {
						  if($infocon4['sparesused'.$i]!='')
						  {
						?>  
					  <tr>
					  <td width="10%" align="center"><?=$i?></span></td>
					  <?php
					  $sqlproduct=mysqli_query($connection,"select  spareunit from jrcspares where CONCAT(subcategory, ' - ', wattage)='".$infocon4['sparesused'.$i]."'  or subcategory='".$infocon4['sparesused'.$i]."'");
					  $unit='';
					  if(mysqli_num_rows($sqlproduct) > 0) 
					  {
					  $rowproduct=mysqli_fetch_array($sqlproduct);
					  if($rowproduct['spareunit']!='')
					  {
						  $unit=$rowproduct['spareunit'];
					  }
					  }
					  
					  ?>
					  <td width="80%"><?=$infocon4['sparesused'.$i]?></span></td>
					  <td width="10%" align="center"><?=$infocon4['sparesused'.$i.'q']?> <?=$unit?></span></td>
					  </tr>
					  <?php 
						  }
						  else
						  {
							  if($j<2)
							  {
							?>  
					  <tr>
					  <td width="10%" align="center">&nbsp;</span></td>
					  <td width="80%">&nbsp;</span></td>
					  <td width="10%" align="center">&nbsp;</span></td>
					  </tr>
					  <?php   
					  $j++;
							  }
						  }
					  }
					  ?>
					  </table>
					 </td>
					 <?php 
}
?>
<?php 
if(($infolayoutservice['sparesrequired']=='1'))
{
?>
					 <td align="center" style="padding:3px; vertical-align:top">
					 <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center"><strong>S.No</strong></td>
					  <td align="center"><strong>Name</strong></td>
					  <td align="center"><strong>Qty</strong></td>
					  </tr>
					  <?php 
					  $j=0;
					  for($i=1;$i<=5;$i++)
					  {
						  if($infocon4['sparesrequired'.$i]!='')
						  {
						?>  
					  <tr>
					  <td width="10%" align="center"><?=$i?></span></td>
					
					  <?php
					  $sqlproduct1=mysqli_query($connection,"select  spareunit from jrcspares where CONCAT(subcategory, ' - ', wattage)='".$infocon4['sparesused'.$i]."'  or subcategory='".$infocon4['sparesused'.$i]."'");
					  $unit1='';
					  if(mysqli_num_rows($sqlproduct1) > 0) 
					  {
					  $rowproduct1=mysqli_fetch_array($sqlproduct1);
					  if($rowproduct1['spareunit']!='')
					  {
						  $unit1=$rowproduct1['spareunit'];
					  }
					  }
					  ?>
					 
					  <td width="80%"><?=$infocon4['sparesrequired'.$i]?></span></td>
					  <td width="10%" align="center"><?=$infocon4['sparesrequired'.$i.'q']?><?=$unit1?></span></td>
					  </tr>
					  <?php 
						  }
						  else
						  {
							  if($j<2)
							  {
							?>  
					  <tr>
					  <td width="10%" align="center">&nbsp;</span></td>
					  <td width="80%">&nbsp;</span></td>
					  <td width="10%" align="center">&nbsp;</span></td>
					  </tr>
					  <?php   
					  $j++;
							  }  
						  }
					  }
					  ?>
					  </table>
					 </td>
					 <?php 
}
?>
					 </tr>
					 </table>
					 <?php 
					  }
					  ?>
					  <?php 
					  if(($infolayoutservice['engineerreport']=='1'))
					  {
					  ?>
					 <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="20%"><strong>ENGINEER'S REPORT</strong></td>
					  <td class="font-weight-bold text-primary"><?=strtoupper($infocon4['engineerreport'])?></td>
					  </table>
					  <?php 
					  }
					  ?>
					  <?php 
					  if(($infolayoutservice['callstatus']=='1'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="20%"><strong>CALL STATUS</strong></td>
					  <td  width="26.67%" class="<?=($infocon4['callstatus']=='Completed')?'font-weight-bold text-primary ':''?>"> <span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Completed')?'check-square':'square'?>"></i></span> &nbsp;Completed <?=($infocon4['callstatus']=='Completed')?'on '.(($infocon4['editedon']!="")?date('d/m/Y h:i:s a', strtotime($infocon4['editedon'])):date('d/m/Y h:i:s a', strtotime($infocon4['addedon']))):''?></td>
					  <!--<td align="left" width="13%" class="<?=($infocon4['callstatus']=='Observation')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Observation')?'check-square':'square'?>"></i></span> &nbsp;Observation</td>-->
					  <td width="26.67%" class="<?=($infocon4['callstatus']=='Pending')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Pending')?'check-square':'square'?>"></i></span> &nbsp;Pending <?=($infocon4['callstatus']=='Pending')?'on '.(($infocon4['editedon']!="")?date('d/m/Y h:i:s a', strtotime($infocon4['editedon'])):date('d/m/Y h:i:s a', strtotime($infocon4['addedon']))):''?></td>
					   <td width="26.67%" class="<?=($infocon4['callstatus']=='Cancelled')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Cancelled')?'check-square':'square'?>"></i></span> &nbsp;Cancelled <?=($infocon4['callstatus']=='Cancelled')?'on '.(($infocon4['editedon']!="")?date('d/m/Y h:i:s a', strtotime($infocon4['editedon'])):date('d/m/Y h:i:s a', strtotime($infocon4['addedon']))):''?></td>
					  <!--<td align="left" class="<?=($infocon4['callstatus']=='Awaiting for Approval')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Awaiting for Approval')?'check-square':'square'?>"></i> &nbsp;Awaiting for Approval</span></td>
					  <td align="left" width="13%" class="<?=($infocon4['callstatus']=='Claim')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Claim')?'check-square':'square'?>"></i></span> &nbsp;Claim</td>			  -->
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  <?php 
					  if(($infolayoutservice['actiontaken']=='1'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="20%"><strong>ACTION TAKEN</strong></td>
					  <td class="font-weight-bold text-primary"><?=$infocon4['actiontaken']?></td>
					  </table>
					  <?php 
					  }
					  ?>
					  
					  
					  
					  <?php 
					  if($infolayoutservice['separateimage']=='0')
					  {
					  if(($infolayoutservice['imgbefuploads']=='1')||($infolayoutservice['imguploads']=='1'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="20%"><strong>SITE IMAGES</strong></td>
					  <?php 
					  if(($infolayoutservice['imgbefuploads']=='1'))
					  {
					  ?>
					  <td width="71"><strong>BEFORE</strong></td>
					  <td >
					  <?php 
					  if($infocon4['imgbefuploads']!=='')
					  {
						$as=explode(',',$infocon4['imgbefuploads']);
						$c=1;
						foreach($as as $a)
						{
							echo "<img src='".$a."' width='70' height='70' style='padding:5px;'>";
							$c++;
						}
					  }
					  ?>
					  </td>
					  <?php 
					  }
					  if(($infolayoutservice['imguploads']=='1'))
					  {
					  ?>
					  <td width="71"><strong>AFTER</strong></td>
					  <td width="35%">
					  <?php 
					  if($infocon4['imguploads']!=='')
					  {
						$as=explode(',',$infocon4['imguploads']);
						$c=1;
						foreach($as as $a)
						{
							echo "<img src='".$a."' width='70' height='70' style='padding:5px;'>";
							$c++;
						}
					  }
					  ?>
					  </td>
					  <?php 
					  }
					  ?>
					  </tr>
					  </table>
					  <?php 
					  }
					  }
					  ?>
					  <?php 
					  if(($infolayoutservice['customerfeedback']=='1')||($infolayoutservice['engineerapproach']=='1'))
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <?php 
					  if(($infolayoutservice['customerfeedback']=='1'))
					  {
					  ?>
					  <td align="center" width="20%"><strong>CUSTOMER'S FEEDBACK</strong></td>
					  <td><?=$infocon4['customerfeedback']?></td>
					  <?php 
					  }
					  ?>
					  <?php 
					  if(($infolayoutservice['engineerapproach']=='1'))
					  {
					  ?>
					  <td align="center" width="20%"><strong>ENGINEER'S APPROACH</strong></td>
					  <td width="10%"><?=$infocon4['engapproach']?></td>
					  <?php 
					  }
					  ?>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  <?php 
					  if($infolayoutservice['servicechargeformat']=='1')
					  {
						  if($infocon4['incgst']!='2')
						  {
							  if(($infocon4['scharge']!='0')&&($infocon4['scharge']!='0.00')&&($infocon4['scharge']!='0')&&(!empty($infocon4['scharge'])))
							  {
								  ?>
								  <table border="1" style="border:1px solid #bbbbbb">
								  <tr>
								  <td align="center" width="13%"><strong>SERVICE CHARGES</strong></td>
								  <td>
								  <table>
									  <tr>
									  <th width="20%"><strong>No.</strong></th>
									  <td><?=$infocon4['schargeno']?></td>
									  </tr>
									  <tr>
									  <th><strong>Date</strong></th>
									  <td><?=date('d/m/Y', strtotime($infocon4['schargedate']))?></td>
									  </tr>
									  <tr>
									  <th><strong>Service Charges</strong></th>
									  <td><?=$infocon4['schargepre']?></td>
									  </tr>
									  <tr>
									  <th><strong>GST (<?=$infocon4['schargegst']?> %)</strong></th>
									  <td><?=$infocon4['schargegstvalue']?></td>
									  </tr>
									  <tr>
									  <th><strong>Total Amount</strong></th>
									  <td class="font-weight-bold text-primary"><?=$infocon4['scharge']?></td>
									  </tr>									  
								  </table>
								  </td>
								  </tr>
								  </table>
								  <?php 
							  }
						  }
						  else
						  {
							  if(($infocon4['scharge']!='0')&&($infocon4['scharge']!='0.00')&&($infocon4['scharge']!='0')&&(!empty($infocon4['scharge'])))
							  {
								  ?>
								  <table border="1" style="border:1px solid #bbbbbb">
								  <tr>
								  <td align="center" width="13%" height="60"><strong>SERVICE CHARGES</strong></td>
								  <td>
								  <table>
									  <tr>
									  <th width="20%"><strong>No.</strong></th>
									  <td><?=$infocon4['schargeno']?></td>
									  </tr>
									  <tr>
									  <th><strong>Date</strong></th>
									  <td><?=date('d/m/Y', strtotime($infocon4['schargedate']))?></td>
									  </tr>
									  <tr>
									  <th><strong>Service Charges<strong></th>
									  <td class="font-weight-bold text-primary"><?=$infocon4['schargepre']?></td>
									  </tr>						  
								  </table>
								  </td>
								  </tr>
								  </table>
								  <?php 
							  }
						  }
					  }
					  ?>
					  <?php 
					  if($rowselect['engineertype']=='1')
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
						<td align="center" width="20%"><strong>ATTENDED ENGINEERS</strong></td>
						<td>
						<?php
$enggs='';
$engnames=explode(',', $rowselect['engineersname']);
$engids=explode(',', $rowselect['engineersid']);
  for($i=0; $i<count($engids); $i++)
  {
	  if($engids!='')
	  {
		  if($enggs!='')
		  {
			  $enggs.=', '.$engnames[$i];
		  }
		  else
		  {
			  $enggs.=''.$engnames[$i];
		  }  
	  }
  }
  echo $enggs;
  ?>
						</td>
					  </tr>
					  </table>
					  <?php
					  }
					  ?>
					  <?php
					    $sqlcon = "SELECT termscondition From jrctermsservice";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon>0) 
		{
			$infoacknowledge=mysqli_fetch_array($querycon);
			?>
			 <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <th style="text-align:center"><strong>TERMS AND CONDITIONS</strong></th>
					  </tr>
					  <tr>
					  <td><?=$infoacknowledge['termscondition']?></td>
					  </tr>
					  </table>
					 <?php
		}
		?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <?php 
					 /*  if($infocon4['signature']!='')
					  {
						  if(file_exists($infocon4['signature']))
						  {
						 $imageloca=str_replace('uploads','padhivetram',$infocon4['signature']);
					  $img = imagecreatefrompng($imageloca);
						$white = imagecolorallocate($img, 255, 255, 255);
						imagecolortransparent($img, $white);
						imagepng($img, $imageloca);
						  }
						} */
						?>
					  <tr>
					  <?php 
					  if(($infolayoutservice['signature']=='1')||($infolayoutservice['seal']=='1'))
					  {
					  ?>
					  <td align="center" width="25%"><strong>CUSTOMER'S SIGNATURE <br>(<?=$infocon4['signname']?>)</strong></td>
					  <td style="background:<?=($infocon4['imgseal']!='')?'url('.$infocon4['imgseal'].'); background-repeat: no-repeat;  background-size: 100px auto;':'none'?>"><img id="signatureimg" width="150" style="<?=($infocon4['signature']!='')?'display:block':'display:none'?>" src="<?=$infocon4['signature']?>"></td>
					  <?php 
					  }
					  ?>
					  <td align="center" width="25%"><strong>ENGINEER'S SIGNATURE <br>(<?=($rowCountengselect>0)?$engineername:''?>)</strong></td>
					  <td width="10%"><img id="signatureimg" width="100" style="<?=($engsignature!='')?'display:block':'display:none'?>" src="<?=$engsignature?>"></td>
					  <?php
					  if((isset($_SESSION['companyseal']))&&($_SESSION['companyseal']!=''))
					  {
					  ?>
					  <td width="10%"><img id="signatureimg" width="100" style="<?=($_SESSION['companyseal']!='')?'display:block':'display:none'?>" src="<?=$_SESSION['companyseal']?>"></td>
					  <?php
					  }
					  ?>
					  </tr>
					  </table>
					  <?php
					  if($infolayoutservice['separateimage']=='1')
					  {
						  ?>
						  <p class="footer21"></p>
					  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="right" rowspan="2"><img src="<?=$_SESSION['companylogo']?>" height="50">
					  </td>
					  <td colspan="2" align="center"><p class="heading" style="font-size:31px;"><?=$_SESSION['companyname']?></p>
					  </td>
					  </tr>
					  <tr>
					  <td colspan="2" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?></td>
					  </tr>
					  </table>
					  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td><strong>E.mail:</strong> <?=$_SESSION['companyemail']?></td>
					  <td align="center"><strong>Mobile:</strong> <?=$_SESSION['companymobile']?><?=($_SESSION['companymobile1']!='')?' | '.$_SESSION['companymobile1']:''?><?=($_SESSION['companymobile2']!='')?' | '.$_SESSION['companymobile2']:''?></td>
					  <td align="right"><strong>GSTIN: </strong><?=$_SESSION['companygstno']?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td rowspan="2" width="25%"><strong>SCR. No.: </strong><b><font size="+1"><?=$infocon4['srno']?></font></b></td>
					  <td align="center" width="50%" rowspan="2" class="heading" style="font-size:24px;"><strong>SITE IMAGES</strong></td>
					  <td align="left"><strong>Call ID:</strong></td>
					  <td align="left"><?=$rowselect['calltid']?></td>
					  </tr>
					  <tr>
					  <td align="left"><strong>Date:</strong></td>
					  <td align="left"><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <th style="text-align:center"><strong>BEFORE ACTION TAKEN</strong></th>
					  </tr>
					  <tr>
					  <td><?php 
					  if($infocon4['imgbefuploads']!=='')
					  {
						$as=explode(',',$infocon4['imgbefuploads']);
						$c=1;
						foreach($as as $a)
						{
							echo "<img src='".$a."' height='250' style='padding:5px; max-width:100%'>";
							$c++;
						}
					  }
					  ?></td>
					  
					  </tr>
					  <tr>
					  <th style="text-align:center"><strong>AFTER ACTION TAKEN</strong></th>
					  </tr>
					  <tr>
					  <td><?php 
					  if($infocon4['imguploads']!=='')
					  {
						$as=explode(',',$infocon4['imguploads']);
						$c=1;
						foreach($as as $a)
						{
							echo "<img src='".$a."' height='250' style='padding:5px; max-width:100%'>";
							$c++;
						}
					  }
					  ?></td>
					  </tr>
					  </table>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <?php 
					  if(($infolayoutservice['signature']=='1')||($infolayoutservice['seal']=='1'))
					  {
					  ?>
					  <td align="center" width="25%"><strong>CUSTOMER'S SIGNATURE <br>(<?=$infocon4['signname']?>)</strong></td>
					  <td style="background:<?=($infocon4['imgseal']!='')?'url('.$infocon4['imgseal'].'); background-repeat: no-repeat;  background-size: 100px auto;':'none'?>"><img id="signatureimg" width="150" style="<?=($infocon4['signature']!='')?'display:block':'display:none'?>" src="<?=$infocon4['signature']?>"></td>
					  <?php 
					  }
					  ?>
					  <td align="center" width="25%"><strong>ENGINEER'S SIGNATURE <br>(<?=$engineername?>)</strong></td>
					  <td width="10%"><img id="signatureimg" width="100" style="<?=($engsignature!='')?'display:block':'display:none'?>" src="<?=$engsignature?>"></td>
					  <?php
					  if((isset($_SESSION['companyseal']))&&($_SESSION['companyseal']!=''))
					  {
					  ?>
					  <td width="10%"><img id="signatureimg" width="100" style="<?=($_SESSION['companyseal']!='')?'display:block':'display:none'?>" src="<?=$_SESSION['companyseal']?>"></td>
					  <?php
					  }
					  ?>
					  </tr>
					  </table>
					  
						  <?php
					  }
					  ?>
					  
					  
					  
					  
					  
					  
					  
					  <?php 
					  if($infolayoutservice['servicechargeformat']=='0')
					  {
					  if($infocon4['incgst']!='2')
					  {
					  if(($infocon4['scharge']!='0')&&($infocon4['scharge']!='0.00')&&($infocon4['scharge']!='0')&&(!empty($infocon4['scharge'])))
					  {
						  ?>
					  <p class="footer21"></p>
					  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="right" rowspan="2"><img src="<?=$_SESSION['companylogo']?>" height="50">
					  </td>
					  <td colspan="2" align="center"><p class="heading" style="font-size:31px;"><?=$_SESSION['companyname']?></p>
					  </td>
					  </tr>
					  <tr>
					  <td colspan="2" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?></td>
					  </tr>
					  </table>
					  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td>E.mail: <?=$_SESSION['companyemail']?></td>
					  <td align="center"><strong>Mobile:</strong> <?=$_SESSION['companymobile']?><?=($_SESSION['companymobile1']!='')?' | '.$_SESSION['companymobile1']:''?><?=($_SESSION['companymobile2']!='')?' | '.$_SESSION['companymobile2']:''?></td>
					  <td align="right">GSTIN: <?=$_SESSION['companygstno']?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td colspan="5" align="center" class="heading" style="font-size:24px; padding:10px;">TAX INVOICE</td>
					  </tr>
					  <tr>
					  <td rowspan="3" width="65%">
					  Invoice No.: <b><font size="+1"><?=$infocon4['schargeno']?></font></b><br>
					  Invoice Date: <b><font size="+1"><?=date('d/m/Y',strtotime($infocon4['schargedate']))?></font></b></td>
					  <td align="left">Call ID:</td>
					  <td align="left" width="25%"><?=$rowselect['calltid']?></td>
					  </tr>
					  <tr>
					  <td align="left">SCR. No.:</td>
					  <td align="left"><?=$infocon4['srno']?></td>
					  </tr>
					  <tr>
					  <td align="left">Date:</td>
					  <td align="left"><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="left" width="100%"><strong>TO</strong><br><p style="margin-left:20px;"><strong><?=$rowxl['consigneename']?></strong><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> - <?=$rowcons['pincode']?><br><?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><br>
					  <b>GSTIN/UIN:</b> <?=$rowcons['gstno']?><br>
					  <b>State Code:</b> <?=($rowcons['gstno']!='')?substr($rowcons['gstno'],0,2):''?></p>
					  </td>
					  </tr>
					  </table>
					  
					  
					  
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <th style="text-align:center; padding:10px;">S.NO</th>
					  <th style="text-align:center" width="60%">DESCRIPTION OF GOODS</th>
					  <th style="text-align:center">QTY</th>
					  <th style="text-align:center">HSN/SAC</th>
					  <th style="text-align:center">GST %</th>
					  <th style="text-align:center">AMOUNT</th>
					  </tr>
					  <?php
					  for($i=1;$i<=5;$i++)
					  {
						  $material=$infocon4['smaterial'.$i];
						  if($material!='')
						  {
							  $sqlspares = "SELECT id, maincategory, subcategory  From jrcspares where id='".$material."'";
			$queryspares = mysqli_query($connection, $sqlspares);
			$rowCountspares = mysqli_num_rows($queryspares);
			$rowspares = mysqli_fetch_array($queryspares)
					  ?>
					  <tr>
					  <td style="text-align:center; vertical-align:top; height:100px;"><?=$i?></td>
					  <td style="text-align:right; vertical-align:top;">
					  <b><?=$rowspares['maincategory']?><?=$rowspares['subcategory']?></b><br>
					   <b>MATERIAL GST</b>
					  
					  </td>
					  <td style="text-align:center; vertical-align:top;"><?=$infocon4['squantity'.$i]?></td>
					  <td style="text-align:center; vertical-align:top;">998729</td>
					  <td style="text-align:center; vertical-align:top;"><?=number_format((float)$infocon4['sgstper'.$i],2,'.',',')?>%
					   </td>
					  <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['stotal'.$i],2,'.',',')?></b><br><b><?=number_format((float)$infocon4['sgstpervalue'.$i],2,'.',',')?></b></td>
					  </tr>
					  <?php
					   $inc=$i+1;
						  }
						 
					  }
					  ?>
					   
					  <tr>
					  <td style="text-align:center; vertical-align:top; height:250px;">1</td>
					  <td style="text-align:right; vertical-align:top;">
					  <b>Service Charge</b><br>
					  <i><font size="-1">For <?=$rowxl['stocksubcategory']?> - <?=$rowxl['componentname']?></font></i><br>
					 
					  <b>OUTPUT CGST</b><br>
					  <b>OUTPUT SGST</b>
					  </td>
					  <td style="text-align:center; vertical-align:top;"></td>
					  <td style="text-align:center; vertical-align:top;">998729</td>
					  <td style="text-align:center; vertical-align:top;"><?=number_format((float)$infocon4['schargegst'],2,'.',',')?>%</td>
					  <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['schargescharge'],2,'.',',')?></b><br><br>
					 
					 
					  <b><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></b><br>
					  <b><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></b></td>
					  </tr>
					  <tr>
					  <td></td>
					  <td>Total</td>
					  <td></td>
					  <td></td> 
					  <td></td>
					   <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['scharge'],2,'.',',')?></b></td>
					  </tr>
					  <tr>
					  <td colspan="5">Amount Chargable (in words)<br><b>Indian Rupees: <?php  echo ucwords(strtolower(getIndianCurrency($infocon4['scharge']))); ?> Only</b>
					  <span class="float-right"><i>E. & O.E</i></span>
					  </td>
					  </tr>
					  </table>
					 
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td width="50%" rowspan="2" style="text-align:right" >Taxable<br>Value</td>
					  <td colspan="2" align="center">Central Tax</td>
					  <td colspan="2" align="center">State Tax</td>
					  <td rowspan="2" align="center">Total<br>Tax Amount</td>					   
					  </tr>
					  <tr>
					  <td align="center">Rate</td>
					  <td align="center">Amount</td>
					  <td align="center">Rate</td>
					  <td align="center">Amount</td>
					  </tr>
					  <tr>
					  <td style="text-align:right"><?=number_format((float)$infocon4['schargepre'],2,'.',',')?></td>
					  <td style="text-align:right"><?=number_format(((float)$infocon4['schargegst']/2),2,'.',',')?>%</td>
					  <td style="text-align:right"><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></td>
					  <td style="text-align:right"><?=number_format(((float)$infocon4['schargegst']/2),2,'.',',')?>%</td>
					  <td style="text-align:right"><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></td>
					  <td style="text-align:right"><?=number_format((float)$infocon4['schargegstvalue'],2,'.',',')?></td>
					  </tr>
					  <tr>
					  <th style="text-align:right"><?=number_format((float)$infocon4['schargepre'],2,'.',',')?></th>
					  <th style="text-align:right"></th>
					  <th style="text-align:right"><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></th>
					  <th style="text-align:right"></th>
					  <th style="text-align:right"><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></th>
					  <th style="text-align:right"><?=number_format((float)$infocon4['schargegstvalue'],2,'.',',')?></th>
					  </tr>
					  <tr>
					  <td colspan="6">Tax Amount (in words)<br><b>Indian Rupees: <?php  echo ucwords(strtolower(getIndianCurrency($infocon4['schargegstvalue']))); ?> Only</b>
					  </td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td width="50%">Remarks: <?=$rowxl['consigneename']?>-<?=$rowxl['district']?><br>
					  Company's PAN: <b><?=$_SESSION['companybankname']?></b></td>
					  <td colspan="2" align="left"><i>Company Bank Details:</i><br>
					  Bank Name: <b><?=$_SESSION['companybankname']?></b><br>
					  A/c No: <b><?=$_SESSION['companyacno']?></b><br>
					  Branch & IFS Code: <b><?=$_SESSION['companybranchname']?>. <?=$_SESSION['companyifscode']?></b>
					  </td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td width="100%"><b><i>Declaration:</i></b><br>
					  We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
					  </td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="33%" style="vertical-align:bottom">
					  <div style="background:<?=($infocon4['imgseal']!='')?'url('.$infocon4['imgseal'].'); background-repeat: no-repeat;  background-size: 100px auto;':'none'?>"><img id="signatureimg" width="150" style="<?=($infocon4['signature']!='')?'display:block':'display:none'?>" src="<?=$infocon4['signature']?>"></div><br>
					  <strong>CUSTOMER'S SIGNATURE <br>(<?=$infocon4['signname']?>)</strong></td>
					  <td align="center" width="33%" style="vertical-align:bottom">
					  <img id="signatureimg" width="150" style="<?=($infocon4['signature']!='')?'display:block':'display:none'?>" src="<?=$engsignature?>"><br>
					  <strong>ENGINEER'S SIGNATURE <br>(<?=($rowCountengselect >0)?$engineername:''?>)</strong></td>
					  <td align="center" width="33%" style="vertical-align:bottom"><b><font size="-1">for <?=$_SESSION['companyname']?></font></b>
					  <br>
					  <img src="<?=$_SESSION['companyauthsign']?>">
					  <img width="100" src="<?=$_SESSION['companyseal']?>">
					  <br>
					  <b>AUTHORISED SIGNATORY</b>
					  </td>
					  </tr>
					  <tr>
					  <td colspan="3" align="center"><font size="-1">SUBJECT TO TRICHY JURISDICTION<BR>This is a Computer Generated Invoice</font></td>
					  </tr>
					  </table>		
<?php 
					  }
					  }
					  else
					  {
						  if(($infocon4['scharge']!='0')&&($infocon4['scharge']!='0.00')&&($infocon4['scharge']!='0')&&(!empty($infocon4['scharge'])))
						  {
						?>
						  <p class="footer21"></p>
						  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="right" rowspan="2"><img src="<?=$_SESSION['companylogo']?>" height="50">
					  </td>
					  <td colspan="2" align="center"><p class="heading" style="font-size:31px;"><?=$_SESSION['companyname']?></p>
					  </td>
					  </tr>
					  <tr>
					  <td colspan="2" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?></td>
					  </tr>
					  </table>
					  <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td>E.mail: <?=$_SESSION['companyemail']?></td>
					  <td align="center"><strong>Mobile:</strong> <?=$_SESSION['companymobile']?><?=($_SESSION['companymobile1']!='')?' | '.$_SESSION['companymobile1']:''?><?=($_SESSION['companymobile2']!='')?' | '.$_SESSION['companymobile2']:''?></td>
					  <td align="right">GSTIN: <?=$_SESSION['companygstno']?></td>
					  </tr>
					  </table>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td colspan="5" align="center" class="heading" style="font-size:24px; padding:10px;">ESTIMATE</td>
						  </tr>
						  <tr>
						  <td rowspan="3" width="65%">
						  Estimate No.: <b><font size="+1"><?=$infocon4['schargeno']?></font></b><br>
						  Estimate Date: <b><font size="+1"><?=date('d/m/Y',strtotime($infocon4['schargedate']))?></font></b></td>
						  <td align="left">Call ID:</td>
						  <td align="left" width="25%"><?=$rowselect['calltid']?></td>
						  </tr>
						  <tr>
						  <td align="left">SCR. No.:</td>
						  <td align="left"><?=$infocon4['srno']?></td>
						  </tr>
						  <tr>
						  <td align="left">Date:</td>
						  <td align="left"><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td align="left" width="100%"><strong>TO</strong><br><p style="margin-left:20px;"><strong><?=$rowxl['consigneename']?></strong><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> - <?=$rowcons['pincode']?><br><?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><br>
						  <b>State Code:</b> <?=($rowcons['gstno']!='')?substr($rowcons['gstno'],0,2):''?></p>
						  </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <th style="text-align:center; padding:10px;">S.NO</th>
					  <th style="text-align:center" width="70%">DESCRIPTION OF GOODS</th>
					  <th style="text-align:center">HSN/SAC</th>
					  <th style="text-align:center">GST %</th>
					  <th style="text-align:center">AMOUNT</th>
					  </tr>
					  <?php
					  for($i=1;$i<=5;$i++)
					  {
						  $material=$infocon4['smaterial'.$i];
						  if($material!='')
						  {
							  $sqlspares = "SELECT id, maincategory, subcategory  From jrcspares where id='".$material."'";
			$queryspares = mysqli_query($connection, $sqlspares);
			$rowCountspares = mysqli_num_rows($queryspares);
			$rowspares = mysqli_fetch_array($queryspares)
					  ?>
					  <tr>
					  <td style="text-align:center; vertical-align:top; height:100px;"><?=$i?></td>
					  <td style="text-align:right; vertical-align:top;">
					  <b><?=$rowspares['maincategory']?><?=$rowspares['subcategory']?></b><br>
					   <b>MATERIAL GST</b>
					  </td>
					  <td style="text-align:center; vertical-align:top;">998729</td>
					  <td style="text-align:center; vertical-align:top;"><?=number_format((float)$infocon4['sgstper'.$i],2,'.',',')?>%
					   </td>
					  <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['stotal'.$i],2,'.',',')?></b><br><b><?=number_format((float)$infocon4['sgstpervalue'.$i],2,'.',',')?></b></td>
					  </tr>
					  <?php
					   $inc=$i+1;
						  }
						 
					  }
					  ?>
					   
					  <tr>
					  <td style="text-align:center; vertical-align:top; height:250px;">1</td>
					  <td style="text-align:right; vertical-align:top;">
					  <b>Service Charge</b><br>
					  <i><font size="-1">For <?=$rowxl['stocksubcategory']?> - <?=$rowxl['componentname']?></font></i><br>
					 
					  <b>OUTPUT CGST</b><br>
					  <b>OUTPUT SGST</b>
					  </td>
					  
					  <td style="text-align:center; vertical-align:top;">998729</td>
					  <td style="text-align:center; vertical-align:top;"><?=number_format((float)$infocon4['schargegst'],2,'.',',')?>%</td>
					  <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['schargescharge'],2,'.',',')?></b><br><br>
					 
					 
					  <b><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></b><br>
					  <b><?=number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',')?></b></td>
					  </tr>
					  <tr>
					  <td></td>
					  <td>Total</td>
					  <td></td>
					  <td></td> 
				
					   <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['scharge'],2,'.',',')?></b></td>
					  </tr>
					  <tr>
					  <td colspan="5">Amount Chargable (in words)<br><b>Indian Rupees: <?php  echo ucwords(strtolower(getIndianCurrency($infocon4['scharge']))); ?> Only</b>
					  <span class="float-right"><i>E. & O.E</i></span>
					  </td>
					  </tr>
					  </table>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td width="50%">Remarks: <?=$rowxl['consigneename']?>-<?=$rowxl['district']?><br>
						  Company's PAN: <b><?=$_SESSION['companypanno']?></b></td>
						  <td colspan="2" align="left"><i>Company Bank Details:</i><br>
						  Bank Name: <b><?=$_SESSION['companybankname']?></b><br>
						  A/c No: <b><?=$_SESSION['companyacno']?></b><br>
						  Branch & IFS Code: <b><?=$_SESSION['companybranchname']?>. <?=$_SESSION['companyifscode']?></b>
						  </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td width="100%"><b><i>Declaration:</i></b><br>
						  We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
						  </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <td align="center" width="33%" style="vertical-align:bottom">
						  <div style="background:<?=($infocon4['imgseal']!='')?'url('.$infocon4['imgseal'].'); background-repeat: no-repeat;  background-size: 100px auto;':'none'?>"><img id="signatureimg" width="150" style="<?=($infocon4['signature']!='')?'display:block':'display:none'?>" src="<?=$infocon4['signature']?>"></div><br>
						  <strong>CUSTOMER'S SIGNATURE <br>(<?=$infocon4['signname']?>)</strong></td>
						  <td align="center" width="33%" style="vertical-align:bottom">
						  <img id="signatureimg" width="150" style="<?=($infocon4['signature']!='')?'display:block':'display:none'?>" src="<?=$engsignature?>"><br>
						  <strong>ENGINEER'S SIGNATURE <br>(<?=$engineername?>)</strong></td>
						  <td align="center" width="33%" style="vertical-align:bottom"><b><font size="-1">for <?=$_SESSION['companyname']?></font></b>
						  <br>
						  <img src="<?=$_SESSION['companyauthsign']?>">
						  <img width="100" src="<?=$_SESSION['companyseal']?>">
						  <br>
						  <b>AUTHORISED SIGNATORY</b>
						  </td>
						  </tr>
						  <tr>
						  <td colspan="3" align="center"><font size="-1">SUBJECT TO TRICHY JURISDICTION<BR>This is a Computer Generated Invoice</font></td>
						  </tr>
						  </table>		
	<?php 
						  }
					  ////
					  }
			}
					  //////
?>					  
					<?php 
					$count++;
			}
		}
 }		
			?>
			</div>
  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
</body>
</html>
