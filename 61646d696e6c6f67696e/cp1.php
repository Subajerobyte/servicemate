<?php 
include('lcheck.php');
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
	$_SESSION['calltid']=$calltid;
		$sqlselect = "SELECT * From jrccalls where calltid='".$calltid."' order by id desc";
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
$engsignature=$rowengselect['signature'];   
$engineername=$rowengselect['engineername'];   
$compno=$rowengselect['compno'];   
$compprefix=$rowengselect['compprefix'];   
$engineerid=$rowengselect['id']; 
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
		$sqlcon4 = "SELECT * From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
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
					  <td>E.mail: <?=$_SESSION['companyemail']?></td>
					  <td align="center">Mobile: <?=$_SESSION['companymobile']?></td>
					  <td align="right">GSTIN: <?=$_SESSION['companygstno']?></td>
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
					  <td align="left" class="<?=($rowselect['servicetype']=='On-Site')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['servicetype']=='On-Site')?'check-square':'square'?>"></i></span> &nbsp;On-Site</td>
					  <td align="left" class="<?=($rowselect['servicetype']=='Carry-In')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['servicetype']=='Carry-In')?'check-square':'square'?>"></i></span> &nbsp;Carry-In</td>	
					  <?php 
					  }
					  if(($infolayoutcall['customernature']=='1'))
					  {
						?> 
						<th>CUSTOMER NATURE</th>
					  <?php
						if(($infolayoutcall['customernaturea']=='1'))
					  {
						  ?>
					  <td align="left" class="<?=($rowselect['customernature']=='AMC')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['customernature']=='AMC')?'check-square':'square'?>"></i></span> &nbsp;AMC</td>
					  <?php
					  }
					  if(($infolayoutcall['customernaturew']=='1'))
					  {
					  ?>
					  <td align="left" class="<?=($rowselect['customernature']=='Warranty')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['customernature']=='Warranty')?'check-square':'square'?>"></i></span> &nbsp;Warranty</td>	
					  <?php
					  }
					  if(($infolayoutcall['customernatureow']=='1'))
					  {
					  ?>
					  <td align="left" class="<?=($rowselect['customernature']=='Out of Warranty')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['customernature']=='Out of Warranty')?'check-square':'square'?>"></i></span> &nbsp;Out of Warranty</td>	
					  <?php
					  }
					  if(($infolayoutcall['customernatureom']=='1'))
					  {
					  ?>
					  <td align="left" class="<?=($rowselect['customernature']=='Other Make')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['customernature']=='Other Make')?'check-square':'square'?>"></i></span> &nbsp;Other Make</td>	
					  <?php
					  }
					  if(($infolayoutcall['customernaturefsma']=='1'))
					  {
					  ?>
					  <td align="left" class="<?=($rowselect['customernature']=='FSMA')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['customernature']=='FSMA')?'check-square':'square'?>"></i></span> &nbsp;FSMA</td>
					  <?php
					  }
					  if(($infolayoutcall['customernaturecamc']=='1'))
					  {
					  ?>
<td align="left" class="<?=($rowselect['customernature']=='CAMC')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['customernature']=='CAMC')?'check-square':'square'?>"></i></span> &nbsp;CAMC</td>					  
					  <?php
					  }
					  ?>	
					  <?php 
					  }
					  ?>
					  </tr>
					  </table>
					  <?php 
					  }
					  ?>
					  <?php 
					  if(($infolayoutcall['callnature']=='1')||($infolayoutcall['servicetype']=='1'))
					  {
						?>  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <?php 
					   if($infolayoutcall['callnature']=='1')
					  {
					  ?>
					  <th style="width:130px">CALL NATURE</th>
					  <td align="left" class="<?=($rowselect['callnature']=='Complaint')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['callnature']=='Complaint')?'check-square':'square'?>"></i></span> &nbsp;Complaint</td>
					  <td align="left" class="<?=($rowselect['callnature']=='Re-Installation')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['callnature']=='Re-Installation')?'check-square':'square'?>"></i></span> &nbsp;Re-Installation</td>
					  <td align="left" class="<?=($rowselect['callnature']=='DC Sign Work')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['callnature']=='DC Sign Work')?'check-square':'square'?>"></i></span> &nbsp;DC Sign Work</td>
					  <td align="left" class="<?=($rowselect['callnature']=='Site Survey')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['callnature']=='Site Survey')?'check-square':'square'?>"></i></span> &nbsp;Site Survey</td>
					  <td align="left" class="<?=($rowselect['callnature']=='Delivery')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['callnature']=='Delivery')?'check-square':'square'?>"></i></span> &nbsp;Delivery</td>
					  <td align="left" class="<?=($rowselect['callnature']=='Installation')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['callnature']=='Installation')?'check-square':'square'?>"></i></span> &nbsp;Installation</td>
					  <td align="left" class="<?=($rowselect['callnature']=='Maintanence')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($rowselect['callnature']=='Maintanence')?'check-square':'square'?>"></i></span> &nbsp;Maintanence</td> 
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
					  <td align="left" width="40%" rowspan="5"><p><strong><?=$rowxl['consigneename']?></strong> - 
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
					  </p></td>
					  </tr>
					  </table>
					   <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td colspan="6" align="center"><strong>PRODUCT INFORMATION</strong></td>
					  </tr>
					  <tr>
					  <td align="left" colspan="6">
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
					  <td width="15%">Make</td><td width="15%"><?=$infocon4['make']?></td>
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
					  <td width="15%">MFG Code</td><td width="15%"><?=$infocon4['mfgcode']?></td>
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
					  <td width="15%">Capacity</td><td width="15%"><?=$infocon4['capacity']?></td>
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
					  <td width="15%">Sl.No</td><td width="15%"><?=$rowselect['serial']?></td>
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
					  <td width="15%">Battery Make</td><td width="15%"><?=$infocon4['batterymake']?></td>
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
					  <td width="15%">Battery AH</td><td width="15%"><?=$infocon4['batteryah']?></td>
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
					  <td width="15%">No.of Battery</td><td width="15%"><?=$infocon4['noofbattery']?></td>
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
					  <td width="15%">No.of Set</td><td width="15%"><?=$infocon4['noofset']?></td>
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
					  <td width="15%">Make</td><td width="15%"><?=$infocon4['pvmake']?></td>
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
					  <td width="15%">Type</td><td width="15%"><?=$infocon4['pvtype']?></td>
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
					  <td width="15%">Capacity</td><td width="15%"><?=$infocon4['pvcapacity']?></td>
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
					  <td width="15%">Qty</td><td width="15%"><?=$infocon4['pvqty']?></td>
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
					  <td width="15%">SL No</td><td width="15%"><?=$infocon4['pvslno']?></td>
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
					  <td width="15%">Make</td><td width="15%"><?=$infocon4['ntmake']?></td>
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
					  <td width="15%">Type</td><td width="15%"><?=$infocon4['nttype']?></td>
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
					  <td width="15%">Capacity</td><td width="15%"><?=$infocon4['ntcapacity']?></td>
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
					  <td width="15%">Qty</td><td width="15%"><?=$infocon4['ntqty']?></td>
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
					  <td width="15%">SL No</td><td width="15%"><?=$infocon4['ntslno']?></td>
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
					  <td width="20%">Shadow Free Area</td><td width="10%"><?=($infocon4['shadow']=='1')?'Yes':'No'?></td>
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
					  <td width="20%">No of Panel in String</td><td width="10%"><?=$infocon4['noofplstr']?></td>
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
					  <td width="20%">No of Strings</td><td width="10%"><?=$infocon4['noofstr']?></td>
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
					  <td width="20%">Tilt Angle</td><td width="10%"><?=$infocon4['tilt']?></td>
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
					  <td width="20%">Panel Position</td><td width="10%"><?=$infocon4['plposter']?></td>
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
					  <td width="20%">Civil Structure</td><td width="10%"><?=($infocon4['civil']=='1')?'Yes':'No'?></td>
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
					  <td width="15%">Mechanical Structure</td><td width="15%"><?=($infocon4['mechanical']=='1')?'Yes':'No'?></td>
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
					  <td width="15%">Electrical Wiring</td><td width="15%"><?=($infocon4['elecwiring']=='1')?'Yes':'No'?></td>
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
					  <td width="15%">AC Earthing</td><td width="15%"><?=($infocon4['acearth']=='1')?'Yes':'No'?></td>
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
					  <td width="15%">DC Earthing</td><td width="15%"><?=($infocon4['dcearth']=='1')?'Yes':'No'?></td>
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
					  <td width="15%">LA Earthing</td><td width="15%"><?=($infocon4['laearth']=='1')?'Yes':'No'?></td>
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
					  <td width="20%">SPV Charging Volt.</td><td width="10%"><?=$infocon4['spvvol']?></td>
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
					  <td width="20%">SPV Charging Current</td><td width="10%"><?=$infocon4['spvcur']?></td>
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
					  <td width="20%">Panel VOC (String)</td><td width="10%"><?=$infocon4['plvoc']?></td>
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
					  <td width="20%">Panel Cells</td><td width="10%"><?=$infocon4['plcell']?></td>
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
					  <td width="20%">Panel String in Series</td><td width="10%"><?=$infocon4['plseries']?></td>
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
					  <td width="20%">Panel String in Parallel</td><td width="10%"><?=$infocon4['plparallel']?></td>
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
					  <td width="20%">Panel Volt. at SPV Chg. ON</td><td width="10%"><?=$infocon4['plvol']?></td>
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
					  <td width="20%">SPV Charging Voltage</td><td width="10%"><?=$infocon4['plangel']?></td>
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
					  <td width="20%">Panel Power</td><td width="10%"><?=$infocon4['plpower']?></td>
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
					  <td width="20%">Time</td><td width="10%"><?=$infocon4['pltime']?></td>
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
					  <td width="20%">Average Load (night)</td><td width="10%"><?=$infocon4['avgloadnight']?></td>
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
					  <td width="20%">Average Load (day)</td><td width="10%"><?=$infocon4['avgloadday']?></td>
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
					  <td width="20%">Total Load</td><td width="10%"><?=$infocon4['totalload']?></td>
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
						  <td>Input Supply : <span class="float-right"><?=($infocon4['inputsupply']=='1')?'Yes':'No'?></span></td>
						  <td>Dust Free : <span class="float-right"><?=($infocon4['dvstfree']=='1')?'Yes':'No'?></span></td>
						  <td>Earthing : <span class="float-right"><?=($infocon4['earthingcheck']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td>UPS Availability : <span class="float-right"><?=($infocon4['upsavailability']=='1')?'Yes':'No'?></span></td>
						  <td>Air Conditioned : <span class="float-right"><?=($infocon4['airconditioned']=='1')?'Yes':'No'?></span></td>
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
						  <td>Input Voltage : <span class="float-right"><?=$infocon4['inputvoltage']?></span></td>
						  <td>Earth Leakage : <span class="float-right"><?=$infocon4['earthleakage']?></span></td>
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
						  <td>Cleaning : <span class="float-right"><?=($infocon4['cleaning']=='1')?'Yes':'No'?></span></td>
						  <td>Software Check : <span class="float-right"><?=($infocon4['softwarecheck']=='1')?'Yes':'No'?></span></td>
						  <td>Antivirus Check : <span class="float-right"><?=($infocon4['antiviruscheck']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td>Loose Connection : <span class="float-right"><?=($infocon4['looseconnection']=='1')?'Yes':'No'?></span></td>
						  <td>Speed Check : <span class="float-right"><?=($infocon4['speedcheck']=='1')?'Yes':'No'?></span></td>
						  <td>Temp File Cleaning : <span class="float-right"><?=($infocon4['tempfilecleaning']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td>Hardware Check : <span class="float-right"><?=($infocon4['hardwarecheck']=='1')?'Yes':'No'?></span></td>
						  <td>Print Check : <span class="float-right"><?=($infocon4['printcheck']=='1')?'Yes':'No'?></span></td>
						  <td>Keyboard : <span class="float-right"><?=($infocon4['keyboard']=='1')?'Yes':'No'?></span></td>
						  </tr>
						  <tr>
						  <td>Mouse : <span class="float-right"><?=($infocon4['mouse']=='1')?'Yes':'No'?></span></td>
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
									  <th rowspan="3" style="width:150px;">MFP B/W A4</th>
									  <th style="width:150px;">COPY PRINTER</th>									  
									  <td><?=$infocon4['mfpbwa4cpr']?></td>
									  </tr>
									  <tr>
									  <th>FAX</th>
									  <td><?=$infocon4['mfpbwa4fax']?></td>
									  </tr>
									  <tr>
									  <th>PRINTER</th>
									  <td><?=$infocon4['mfpbwa4prp']?></td>
									  </tr>
									  
									   <tr>
									  <th rowspan="3">MFP COLOR</th>
									  <th>COPY PRINTER</th>									  
									  <td><?=$infocon4['mfpclcpr']?></td>
									  </tr>
									  <tr>
									  <th>FAX</th>
									  <td><?=$infocon4['mfpclfax']?></td>
									  </tr>
									  <tr>
									  <th>PRINTER</th>
									  <td><?=$infocon4['mfpclprp']?></td>
									  </tr>
									  
									   <tr>
									  <th rowspan="2">PRI-PORT</th>
									  <th>MASTER</th>									  
									  <td><?=$infocon4['priportmaster']?></td>
									  </tr>
									  <tr>
									  <th>COPIES</th>
									  <td><?=$infocon4['priportcopies']?></td>
									  </tr>
									  
									  <tr>
									  <th colspan="2">TOTAL</th>
									  <td><?=$infocon4['totalmeterreading']?></td>
									  </tr>

									  
								  </table>
								  </td>
								  </tr>
								  </table>
								  <?php 
							  }
					  
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
					  <td>Ventilation : <span class="float-right"><?=($infocon4['verification']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($infolayoutservice['modificationwiring']=='1')
					  {
						?> 
					  <td>Modification on Wiring : <span class="float-right"><?=($infocon4['modificationwiring']=='1')?'Yes':'No'?></span></td>
					  <?php
					  $se++;
					  }
					  ?>
					  <?php
					  if($infolayoutservice['pollutionlevel']=='1')
					  {
						?> 
					  <td>Pollution Level : <span class="float-right"><?=($infocon4['pollutionlevel']=='1')?'High':($infocon4['pollutionlevel']=='2')?'Medium':'Low'?></span></td>
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
					  <td>Direct Sunlight : <span class="float-right"><?=($infocon4['directsunlight']=='1')?'Yes':($infocon4['directsunlight']=='2')?'Partial':'No'?></span></td>
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
					  <td>Rain/Cleaning Water Dripping : <span class="float-right"><?=($infocon4['waterdripping']=='1')?'Yes':'No'?></span></td>
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
					  <td>Moisture : <span class="float-right"><?=($infocon4['moisture']=='1')?'Yes':'No'?></span></td>
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
					  <td>Wiring Ready : <span class="float-right"><?=($infocon4['wiringready']=='1')?'Yes':'No'?></span></td>
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
					  <td>Coastal Area : <span class="float-right"><?=($infocon4['coastelarea']=='1')?'Yes':'No'?></span></td>
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
					  <td width="25%" style="padding:0px 50px;">Stabilizer : <span class="float-right"><?=($infocon4['stabilizer']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;">Phase Reverse : <span class="float-right"><?=($infocon4['phasereverse']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;">Earthing : <span class="float-right"><?=($infocon4['earthing']=='1')?'Yes':'No'?></span></td>
					  <td width="25%" style="padding:0px 50px;">Overload : <span class="float-right"><?=($infocon4['overload']=='1')?'Yes':'No'?></span></td>
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
					  <td align="center">S.No</td>
					  <td align="center">Name</td>
					  <td align="center">Qty</td>
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
					  <td width="80%"><?=$infocon4['sparesused'.$i]?></span></td>
					  <td width="10%" align="center"><?=$infocon4['sparesused'.$i.'q']?></span></td>
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
					  <td align="center">S.No</td>
					  <td align="center">Name</td>
					  <td align="center">Qty</td>
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
					  <td width="80%"><?=$infocon4['sparesrequired'.$i]?></span></td>
					  <td width="10%" align="center"><?=$infocon4['sparesrequired'.$i.'q']?></span></td>
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
					  <td align="left" width="40%" class="<?=($infocon4['callstatus']=='Completed')?'font-weight-bold text-primary ':''?>"> <span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Completed')?'check-square':'square'?>"></i></span> &nbsp;Completed <?=($infocon4['callstatus']=='Completed')?'on '.(($infocon4['editedon']!="")?date('d/m/Y h:i:s a', strtotime($infocon4['editedon'])):date('d/m/Y h:i:s a', strtotime($infocon4['addedon']))):''?></td>
					  <!--<td align="left" width="13%" class="<?=($infocon4['callstatus']=='Observation')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Observation')?'check-square':'square'?>"></i></span> &nbsp;Observation</td>-->
					  <td align="left" class="<?=($infocon4['callstatus']=='Pending')?'font-weight-bold text-primary ':''?>"><span class="float-left"><i class="far fa-<?=($infocon4['callstatus']=='Pending')?'check-square':'square'?>"></i></span> &nbsp;Pending <?=($infocon4['callstatus']=='Pending')?'on '.(($infocon4['editedon']!="")?date('d/m/Y h:i:s a', strtotime($infocon4['editedon'])):date('d/m/Y h:i:s a', strtotime($infocon4['addedon']))):''?></td>
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
					  <td width="71">BEFORE</td>
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
					  <td width="71">AFTER</td>
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
									  <th width="20%">No.</th>
									  <td><?=$infocon4['schargeno']?></td>
									  </tr>
									  <tr>
									  <th>Date</th>
									  <td><?=date('d/m/Y', strtotime($infocon4['schargedate']))?></td>
									  </tr>
									  <tr>
									  <th>Service Charges</th>
									  <td><?=$infocon4['schargepre']?></td>
									  </tr>
									  <tr>
									  <th>GST (<?=$infocon4['schargegst']?> %)</th>
									  <td><?=$infocon4['schargegstvalue']?></td>
									  </tr>
									  <tr>
									  <th>Total Amount</th>
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
									  <th width="20%">No.</th>
									  <td><?=$infocon4['schargeno']?></td>
									  </tr>
									  <tr>
									  <th>Date</th>
									  <td><?=date('d/m/Y', strtotime($infocon4['schargedate']))?></td>
									  </tr>
									  <tr>
									  <th>Service Charges</th>
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
					  <td>E.mail: <?=$_SESSION['companyemail']?></td>
					  <td align="center">Mobile: <?=$_SESSION['companymobile']?></td>
					  <td align="right">GSTIN: <?=$_SESSION['companygstno']?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td rowspan="2" width="25%">SCR. No.: <b><font size="+1"><?=$infocon4['srno']?></font></b></td>
					  <td align="center" width="50%" rowspan="2" class="heading" style="font-size:24px;">SITE IMAGES</td>
					  <td align="left">Call ID:</td>
					  <td align="left"><?=$rowselect['calltid']?></td>
					  </tr>
					  <tr>
					  <td align="left">Date:</td>
					  <td align="left"><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <th style="text-align:center">BEFORE ACTION TAKEN</th>
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
					  <th style="text-align:center">AFTER ACTION TAKEN</th>
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
					  <th style="text-align:center">HSN/SAC</th>
					  <th style="text-align:center">GST RATE</th>
					  <th style="text-align:center">AMOUNT</th>
					  </tr>
					  <tr>
					  <td style="text-align:center; vertical-align:top; height:450px;">1</td>
					  <td style="text-align:right; vertical-align:top;">
					  <b>Service Charges</b><br>
					  <i><font size="-1">For <?=$rowxl['stocksubcategory']?> - <?=$rowxl['componentname']?></font></i><br>
					  <b>OUTPUT CGST</b><br>
					  <b>OUTPUT SGST</b>
					  </td>
					  <td style="text-align:center; vertical-align:top;">998729</td>
					  <td style="text-align:center; vertical-align:top;"><?=number_format((float)$infocon4['schargegst'],2,'.',',')?>%</td>
					  <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['schargepre'],2,'.',',')?></b><br><br>
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
						  <th style="text-align:center">HSN/SAC</th>
						  <th style="text-align:center">AMOUNT</th>
						  </tr>
						  <tr>
						  <td style="text-align:center; vertical-align:top; height:450px;">1</td>
						  <td style="text-align:right; vertical-align:top;">
						  <b>Service Charges</b><br>
						  <i><font size="-1">For <?=$rowxl['stocksubcategory']?> - <?=$rowxl['componentname']?></font></i><br>
						  </td>
						  <td style="text-align:center; vertical-align:top;">998729</td>
						  <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$infocon4['schargepre'],2,'.',',')?></b><br><br>
						  </td>
						  </tr>
						  <tr>
						  <td></td>
						  <td>Total</td>
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
