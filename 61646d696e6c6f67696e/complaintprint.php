<?php
include('lcheck.php'); 
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

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
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
	$_SESSION['calltid']=$calltid;
		$sqlselect = "SELECT engineerid, sourceid, compstatus, servicetype, customernature, calltype, callnature, serial, reportedproblem, calltid, callon  From jrccalls where calltid='".$calltid."' order by id desc";
				 
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
				$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where id='".$rowselect['engineerid']."' order by id desc";
				$queryengselect = mysqli_query($connection, $sqlengselect);
				$rowCountengselect = mysqli_num_rows($queryengselect);
				$rowengselect = mysqli_fetch_array($queryengselect);
				if($rowengselect>0)
				{
				$engsignature=$rowengselect['signature'];
				$engsignature=str_replace('uploads','padhivetram',$engsignature);
				$engineername=$rowengselect['engineername'];
				$compno=$rowengselect['compno'];
				$compprefix=$rowengselect['compprefix'];
				$engineerid=$rowengselect['id'];
				}
				
				$sqlxl = "SELECT address1, phone, mobile, email, consigneeid, stockitem, consigneename, stocksubcategory, componentname, district From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
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
				  $sqlcons = "SELECT  email, address1, address2, area, district, pincode, contact, phone, mobile, gstno  From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
				  
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
		$sqlcon4 = "SELECT make, mfgcode, capacity, batterymake, batteryah, noofbattery, noofset, pvmake, pvtype, pvcapacity, pvqty, pvslno, ntmake, nttype, ntcapacity, ntqty, ntslno, problemobserved, shadow, noofplstr, noofstr, tilt, plposter, civil, mechanical, elecwiring, acearth, dcearth, laearth, spvvol, spvcur, plvoc, plcell, plseries, plparallel, plvol, plangel, plpower, pltime, avgloadnight, avgloadday, totalload, inputsupply, dvstfree, earthingcheck, upsavailability, airconditioned, inputvoltage, earthleakage, cleaning, softwarecheck, antiviruscheck, looseconnection, speedcheck, tempfilecleaning, hardwarecheck, printcheck, keyboard, mouse, mfpbwa4cpr, mfpbwa4fax, mfpbwa4prp, mfpclcpr, mfpclfax, mfpclprp, priportmaster, priportcopies, totalmeterreading, verification, modificationwiring, pollutionlevel, directsunlight, waterdripping, moisture, wiringready, coastelarea, voliry, volirn, curir, freir, voliyb, volibn, curiy, freiy, volibr, voliyn, curib, freib, voline, curin, volipn, curip, freip, volipe, cur1in, vol1ine, volory, volorn, curor, freor, voloyb, volobn, curoy, freoy, volobr, voloyn, curob, freob, volone, curon, phasetype, volopn, curop, freop, volope, cur1on, vol1one, stabilizer, phasereverse, earthing, overload, batterycondition, chargingv, chargingo, dischargingv, dischargingo, dischargingwv, dischargingwo, sparesused1q, sparesused2q, sparesused3q, sparesused4q, sparesused5q, sparesrequired1q, sparesrequired2q, sparesrequired3q, sparesrequired4q, sparesrequired5q, engineerreport, callstatus, editedon, addedon, actiontaken, customerfeedback, engapproach, imgbefuploads, imguploads, incgst, schargegst, schargegstvalue, imgseal, schargeno, schargedate, srno, schargepre, scharge, signname,signature,smaterial1,smaterial2,smaterial3,smaterial4,smaterial5,sgstper1,sgstper2,sgstper3,sgstper4,sgstper5,schargepre1,schargepre2,schargepre3,schargepre4,schargepre5,sgstpervalue1,sgstpervalue2,sgstpervalue3,sgstpervalue4,sgstpervalue5,schargescharge,schargegst,mchargegstvalue,squantity1,squantity2,squantity3,squantity4,squantity5,stotal1,stotal2,stotal3,stotal4,stotal5,sgstpervalue1,sgstpervalue2,sgstpervalue3,sgstpervalue4,sgstpervalue5,sparesused1,sparesused2,sparesused3,sparesused4,sparesused5,sparesrequired1,sparesrequired2,sparesrequired3,sparesrequired4,sparesrequired5  From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
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
					  <td rowspan="2" width="25%">SCR. No.: <b><font size="+1"><?=$infocon4['srno']?></font></b></td>
					  <td align="center" width="50%" rowspan="2" class="heading" style="font-size:24px;">SERVICE CALL REPORT</td>
					  <td align="left">Call ID:</td>
					  <td align="left"><?=$rowselect['calltid']?></td>
					  </tr>
					  <tr>
					  <td align="left">Date:</td>
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
					  <th style="width:130px">SERVICE TYPE</th>
					  <td align="left" style="width:130px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['servicetype']?></td>
					  <?php
					  }
					  if(($infolayoutcall['customernature']=='1'))
					  {
						?> 
						<th style="width:130px">CUSTOMER NATURE</th>
						<td align="left" style="width:130px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['customernature']?></td>
					  <?php
					  }
					  ?>
					  <?php
					  }
					  if($infolayoutcall['calltype']=='1')
					  {
					  ?>
					  <th style="width:130px">CALL TYPE</th>
					  <td align="left" style="width:130px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['calltype']?></td> 
					  <?php
					  }
					  if(($infolayoutcall['callnature']=='1')||($infolayoutcall['servicetype']=='1'))
					  {
					   if($infolayoutcall['callnature']=='1')
					  {
					  ?>
					  
					  <th style="width:130px">CALL NATURE</th>
					  <td align="left" style="width:130px;text-transform: uppercase;" class="font-weight-bold text-primary"><?=$rowselect['callnature']?></td>
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
					  <td colspan="4" align="center"><strong>PRODUCT INFORMATION</strong></td>
					  </tr>
					  <tr>
					  <td align="left" width="40%" rowspan="5"><p><strong><?=$rowxl['consigneename']?></strong><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?><br><?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></p></td>
					  <td align="left" colspan="4"><?=$rowxl['stockitem']?></p></td>
					  </tr>
					  <tr>
					  <td width="10%">Product</td><td width="18%"><?=$infocon4['make']?></td><td width="12%">Battery Make</td><td><?=$infocon4['batterymake']?></td>
					  </tr>
					  <tr>
					  <td width="10%">Capacity</td><td><?=$infocon4['capacity']?></td><td width="10%">Battery AH</td><td><?=$infocon4['batteryah']?></td>
					  </tr>
					  <tr>
					  <td width="10%">MFG Code</td><td><?=$infocon4['mfgcode']?></td><td width="10%">No.of Battery</td><td><?=$infocon4['noofbattery']?></td>
					  </tr>
					  <tr>
					  <td width="10%">Sl.No</td><td><?=$rowselect['serial']?></td><td width="10%">No.of Set</td><td><?=$infocon4['noofset']?></td>
					  </tr>
					  </table>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center"><strong>PROBLEM REPORTED</strong></td>
					  <td align="center"><strong>PROBLEM OBSERVED</strong></td>
					  </tr>
					  <tr>
					  <td align="center" height="60" class="font-weight-bold text-primary"><?=$rowselect['reportedproblem']?></td>
					  <td align="center" height="60" class="font-weight-bold text-primary"><?=$infocon4['problemobserved']?></td>
					  </tr>
					  </table>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="3"><strong>SITE VERIFICATION</strong></td>
					  <td>Ventilation : <span class="float-right"><?=($infocon4['verification']=='1')?'Yes':'No'?></span></td>
					  <td>Modification on Wiring : <span class="float-right"><?=($infocon4['modificationwiring']=='1')?'Yes':'No'?></span></td>
					  <td>Pollution Level : <span class="float-right"><?=($infocon4['pollutionlevel']=='1')?'High':($infocon4['pollutionlevel']=='2')?'Medium':'Low'?></span></td>
					  </tr>
					  <tr>
					  <td>Direct Sunlight : <span class="float-right"><?=($infocon4['directsunlight']=='1')?'Yes':($infocon4['directsunlight']=='2')?'Partial':'No'?></span></td>
					  <td>Rain/Cleaning Water Dripping : <span class="float-right"><?=($infocon4['waterdripping']=='1')?'Yes':'No'?></span></td>
					  <td>Moisture : <span class="float-right"><?=($infocon4['moisture']=='1')?'Yes':'No'?></span></td>
					  </tr>
					  <tr>
					  <td>Wiring Ready : <span class="float-right"><?=($infocon4['wiringready']=='1')?'Yes':'No'?></span></td>
					  <td>Coastal Area : <span class="float-right"><?=($infocon4['coastelarea']=='1')?'Yes':'No'?></span></td>
					  <td></td>
					  </tr>
					  </table>
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
					  <td align="center" colspan="2">Voltage</td>
					  <td align="center">Current</td>
					  <td align="center">Frequency</td>
					  </tr>
					  <tr>
					  <td width="25%">RY: <span class="float-right"><?=$infocon4['voliry']?></span></td>
					  <td width="25%">RN: <span class="float-right"><?=$infocon4['volirn']?></span></td>
					  <td width="25%">R: <span class="float-right"><?=$infocon4['curir']?></span></td>
					  <td width="25%">R: <span class="float-right"><?=$infocon4['freir']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%">YB: <span class="float-right"><?=$infocon4['voliyb']?></span></td>
					  <td width="25%">BN: <span class="float-right"><?=$infocon4['volibn']?></span></td>
					  <td width="25%">Y: <span class="float-right"><?=$infocon4['curiy']?></span></td>
					  <td width="25%">Y: <span class="float-right"><?=$infocon4['freiy']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%">BR: <span class="float-right"><?=$infocon4['volibr']?></span></td>
					  <td width="25%">YN: <span class="float-right"><?=$infocon4['voliyn']?></span></td>
					  <td width="25%">B: <span class="float-right"><?=$infocon4['curib']?></span></td>
					  <td width="25%">B: <span class="float-right"><?=$infocon4['freib']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"></td>
					  <td width="25%">NE: <span class="float-right"><?=$infocon4['voline']?></span></td>
					  <td width="25%">N: <span class="float-right"><?=$infocon4['curin']?></span></td>
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
					  <td align="center">Voltage</td>
					  <td align="center">Current</td>
					  <td align="center">Frequency</td>
					  </tr>
					  <tr>
					  <td width="25%">PN: <span class="float-right"><?=$infocon4['volipn']?></span></td>
					  <td width="25%">P: <span class="float-right"><?=$infocon4['curip']?></span></td>
					  <td width="25%">P: <span class="float-right"><?=$infocon4['freip']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%">PE: <span class="float-right"><?=$infocon4['volipe']?></span></td>
					  <td width="25%">N: <span class="float-right"><?=$infocon4['cur1in']?></span></td>
					  <td width="25%"></td>
					  </tr>
					  <tr>
					  <td width="25%">NE: <span class="float-right"><?=$infocon4['vol1ine']?></span></td>
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
					  <td align="center" colspan="2">Voltage</td>
					  <td align="center">Current</td>
					  <td align="center">Frequency</td>
					  </tr>
					  <tr>
					  <td width="25%">RY: <span class="float-right"><?=$infocon4['volory']?></span></td>
					  <td width="25%">RN: <span class="float-right"><?=$infocon4['volorn']?></span></td>
					  <td width="25%">R: <span class="float-right"><?=$infocon4['curor']?></span></td>
					  <td width="25%">R: <span class="float-right"><?=$infocon4['freor']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%">YB: <span class="float-right"><?=$infocon4['voloyb']?></span></td>
					  <td width="25%">BN: <span class="float-right"><?=$infocon4['volobn']?></span></td>
					  <td width="25%">Y: <span class="float-right"><?=$infocon4['curoy']?></span></td>
					  <td width="25%">Y: <span class="float-right"><?=$infocon4['freoy']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%">BR: <span class="float-right"><?=$infocon4['volobr']?></span></td>
					  <td width="25%">YN: <span class="float-right"><?=$infocon4['voloyn']?></span></td>
					  <td width="25%">B: <span class="float-right"><?=$infocon4['curob']?></span></td>
					  <td width="25%">B: <span class="float-right"><?=$infocon4['freob']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%"></td>
					  <td width="25%">NE: <span class="float-right"><?=$infocon4['volone']?></span></td>
					  <td width="25%">N: <span class="float-right"><?=$infocon4['curon']?></span></td>
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
					  <td align="center">Voltage</td>
					  <td align="center">Current</td>
					  <td align="center">Frequency</td>
					  </tr>
					  <tr>
					  <td width="25%">PN: <span class="float-right"><?=$infocon4['volopn']?></span></td>
					  <td width="25%">P: <span class="float-right"><?=$infocon4['curop']?></span></td>
					  <td width="25%">P: <span class="float-right"><?=$infocon4['freop']?></span></td>
					  </tr>
					  <tr>
					  <td width="25%">PE: <span class="float-right"><?=$infocon4['volope']?></span></td>
					  <td width="25%">N: <span class="float-right"><?=$infocon4['cur1on']?></span></td>
					  <td width="25%"></td>
					  </tr>
					  <tr>
					  <td width="25%">NE: <span class="float-right"><?=$infocon4['vol1one']?></span></td>
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
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td width="25%" style="padding:0px 50px;">Stabilizer : <span class="float-right"><?=($infocon4['stabilizer']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;">Phase Reverse : <span class="float-right"><?=($infocon4['phasereverse']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;">Earthing : <span class="float-right"><?=($infocon4['earthing']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;">Overload : <span class="float-right"><?=($infocon4['overload']=='1')?'Yes':'No'?></span></td>
					  </table>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="10%" rowspan="2"><strong>DC Data</strong></td>
					  <td colspan="2" width="20%" align="center">@ Charging</td>
					  <td colspan="2" width="25%" align="center">@ Discharging with Load</td>
					  <td colspan="2" width="25%" align="center">@ Discharging without Load</td>
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
					  
					  
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="50%"><strong>SPARES USED</strong></td>
					  <td align="center"><strong>SPARES REQUIRED</strong></td>
					  </tr>
					  <tr>
					  <td align="center" style="padding:3px; vertical-align:top">
					
					  <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center">S.No</td>
					  <td align="center">Name</td>
					  <td align="center">Qty</td>
					  </tr>
					  <?php
					  for($i=1;$i<=5;$i++)
					  {
						  if($infocon4['sparesused'.$i]!='')
						  {
						?>  
					  <tr>
					  <td width="10%" align="center"><?=$i?></span></td>
					  <td width="80%"><?=$infocon4['sparesused'.$i]?></span></td>
					  <td width="10%" align="center"><?=$infocon4['sparesused'.$i.'q']?></span></td>
					  </tr>
					  <?php
						  }
						  else
						  {
							?>  
					  <tr>
					  <td width="10%" align="center">&nbsp;</span></td>
					  <td width="80%">&nbsp;</span></td>
					  <td width="10%" align="center">&nbsp;</span></td>
					  </tr>
					  <?php  
						  }
					  }
					  ?>
					  </table>
					 </td>
					 <td align="center" style="padding:3px; vertical-align:top">
					 <table width="100%" border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center">S.No</td>
					  <td align="center">Name</td>
					  <td align="center">Qty</td>
					  </tr>
					  <?php
					  for($i=1;$i<=5;$i++)
					  {
						  if($infocon4['sparesrequired'.$i]!='')
						  {
						?>  
					  <tr>
					  <td width="10%" align="center"><?=$i?></span></td>
					  <td width="80%"><?=$infocon4['sparesrequired'.$i]?></span></td>
					  <td width="10%" align="center"><?=$infocon4['sparesrequired'.$i.'q']?></span></td>
					  </tr>
					  <?php
						  }
						  else
						  {
							?>  
					  <tr>
					  <td width="10%" align="center">&nbsp;</span></td>
					  <td width="80%">&nbsp;</span></td>
					  <td width="10%" align="center">&nbsp;</span></td>
					  </tr>
					  <?php  
						  }
					  }
					  ?>
					  </table>
					 </td>
					 </tr>
					 </table>
					 
					 <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="20%" height="60"><strong>ENGINEER'S REPORT</strong></td>
					  <td class="font-weight-bold text-primary"><?=strtoupper($infocon4['engineerreport'])?></td>
					  </table>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="20%"><strong>CALL STATUS</strong></td>
					  <td align="left" width="13%" class="<?=($infocon4['callstatus']=='Completed')?'font-weight-bold text-primary ':''?>"> <span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Completed')?'check-square':'square'?>"></i></span> &nbsp;Completed</td>
					  <!--<td align="left" width="13%" class="<?=($infocon4['callstatus']=='Observation')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Observation')?'check-square':'square'?>"></i></span> &nbsp;Observation</td>-->
					  <td align="left" class="<?=($infocon4['callstatus']=='Pending')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Pending')?'check-square':'square'?>"></i></span> &nbsp;Pending</td>
					  <!--<td align="left" class="<?=($infocon4['callstatus']=='Awaiting for Approval')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Awaiting for Approval')?'check-square':'square'?>"></i> &nbsp;Awaiting for Approval</span></td>
					  <td align="left" width="13%" class="<?=($infocon4['callstatus']=='Claim')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Claim')?'check-square':'square'?>"></i></span> &nbsp;Claim</td>			  -->
					  </tr>
					  </table>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="20%" height="60"><strong>ACTION TAKEN</strong></td>
					  <td class="font-weight-bold text-primary"><?=$infocon4['actiontaken']?></td>
					  </table>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="13%"><strong>SITE IMAGES</strong></td>
					  <td class="rotate" width="71">BEFORE</td>
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
					  <td class="rotate" width="71">AFTER</td>
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
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="13%"><strong>CUSTOMER'S FEEDBACK</strong></td>
					  <td><?=$infocon4['customerfeedback']?></td>
					  <td align="center" width="13%"><strong>ENGINEER'S APPROACH</strong></td>
					  <td width="10%"><?=$infocon4['engapproach']?></td>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <?php
					 /*  if($infocon4['signature']!='')
					  {
						 $imageloca=str_replace('uploads','padhivetram',$infocon4['signature']);
					  $img = imagecreatefrompng($imageloca);
						$white = imagecolorallocate($img, 255, 255, 255);
						imagecolortransparent($img, $white);
						imagepng($img, $imageloca);
					} */
?>
					  <tr>
					 
					  <td align="center" width="25%"><strong>CUSTOMER'S SIGNATURE <br>(<?=$infocon4['signname']?>)</strong></td>
					  
					  <td ><img id="signatureimg" width="150" style="<?=($infocon4['signature']!='')?'display:block; float:left':'display:none'?>" src="<?=$infocon4['signature']?>"> <img id="signatureimg1" width="150" style="<?=($infocon4['imgseal']!='')?'display:block; float:left':'display:none'?>" src="<?=$infocon4['imgseal']?>"></td>
					  
					 <!-- <td style="background:<?//=($infocon4['imgseal']!='')?'url('.$infocon4['imgseal'].'); background-repeat: no-repeat;  background-size: 100px auto;':'none'?>"><img id="signatureimg" width="150" style="<?//=($infocon4['signature']!='')?'display:block':'display:none'?>" src="<?//=$infocon4['signature']?>"></td> -->
					  <td align="center" width="25%"><strong>ENGINEER'S SIGNATURE <br>(<?=($rowCountengselect > 0)?$engineername:''?>)</strong></td>
					  <td width="10%"><img id="signatureimg" width="100" style="<?=($engsignature!='')?'display:block':'display:none'?>" src="<?=$engsignature?>"></td>
					  <?php
					  if($_SESSION['companyseal']!='')
					  {
					  ?>
					  <td width="10%"><img id="signatureimg" width="100" style="<?=($_SESSION['companyseal']!='')?'display:block':'display:none'?>" src="<?=$_SESSION['companyseal']?>"></td>
					  <?php
					  }
					  ?>
					  </tr>
					  </table>
					  <?php
					  if($infocon4['incgst']!='2')
					  {
					  if(($infocon4['scharge']!='0')&&($infocon4['scharge']!='0.00')&&($infocon4['scharge']!='0')&&(!empty($infocon4['scharge'])))
					  {
						  ?>
					  <p class="footer21"></p>
					  
					   <table style="border:1px solid #bbbbbb">
					  <tr>
					  <td colspan="3"><p class="heading" style="font-size:31px;"><img src="<?=$_SESSION['companylogo']?>" width="160"> <?=$_SESSION['companyname']?></p>
					  </td>
					  </tr>
					  <tr>
					  <td colspan="3" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?></td>
					  </tr>
					  <tr>
					  <td>e.mail: <?=$_SESSION['companyemail']?></td>
					  <td align="center">Mobile: <?=$_SESSION['companymobile']?></td>
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
					  <td style="text-align:center; vertical-align:top; height:250px;"><?=$inc?></td>
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
					  <td colspan="6">Tax Amount (in words)<br><b>Indian Rupees: <?php echo ucwords(strtolower(getIndianCurrency($infocon4['schargegstvalue']))); ?> Only</b>
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
					  <strong>ENGINEER'S SIGNATURE <br>(<?=($rowCountengselect>0)?$engineername:''?>)</strong></td>
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
						  <td colspan="3"><p class="heading" style="font-size:31px;"><img src="<?=$_SESSION['companylogo']?>" width="160"> <?=$_SESSION['companyname']?></p>
						  </td>
						  </tr>
						  <tr>
						  <td colspan="3" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?></td>
						  </tr>
						  <tr>
						  <td>e.mail: <?=$_SESSION['companyemail']?></td>
						  <td align="center">Mobile: <?=$_SESSION['companymobile']?></td>
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
					  <td style="text-align:center; vertical-align:top; height:250px;"><?=$inc?></td>
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
