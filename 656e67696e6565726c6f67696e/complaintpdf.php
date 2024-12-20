<?php
include('lcheck.php');
require_once '../../1637028036/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


try {
    ob_start();
    //include 'https://jerobyte.com/jrc/61646d696e6c6f67696e/complaintprint.php?id=220104541';
    //$content = ob_get_clean();
$content='';
$content1='';
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

$content.='<table style="border:1px solid #eeeeee; width:70%;">
<tbody><tr>
<td colspan="3" align="center"><span class="heading" style="font-size:24px; font-weight:bold;"><img src="'.$_SESSION['companylogo'].'" height="50"> '.$_SESSION['companyname'].'</span>
</td>
</tr>
<tr>
<td colspan="3" align="center" width:50%>'.$_SESSION['companyaddress1'].' '.$_SESSION['companyaddress2'].' '.$_SESSION['companyarea'].' '.$_SESSION['companydistrict'].' '.$_SESSION['companypincode'].'</td>
</tr>
<tr>
<td style="width:48%;">E.mail: '.$_SESSION['companyemail'].'</td>
<td style="width:48%" align="center">Mobile: '.$_SESSION['companymobile'].'</td>
<td  style="width:47%" align="right">GSTIN: '.$_SESSION['companygstno'].'</td>
</tr>
</tbody></table>
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;width:98.8%">
<tbody><tr>
<td rowspan="2" style="width:25%;padding:1px;border:1px solid #eeeeee;">SCR. No.: <b><font size="+1">'.$infocon4['srno'].'</font></b></td>
<td align="center" rowspan="2" class="heading" style="font-size:18px; width:50%; border:1px solid #eeeeee; font-weight:bold; color:#3d8eb9; ">SERVICE CALL REPORT</td>
<td align="left" style="border:1px solid #eeeeee" >Call ID:</td>
<td align="left" style="border:1px solid #eeeeee" >'.$rowselect['calltid'].'</td>
</tr>
<tr>
<td align="left" style="border:1px solid #eeeeee">Date:</td>
<td align="left" style="border:1px solid #eeeeee">'.date('d/m/Y h:i:s a', strtotime($rowselect['callon'])).'</td>
</tr>
</tbody></table>';

$content.='

<table border="1" style="border:1px solid #eeeeee;width:102.8%;border-collapse:collapse;">
<tbody><tr>
<td align="left" style="border:1px solid #eeeeee;width:16%; height:15px;"  ><span class="float-left"><b>Customer Nature</b></span></td>
<td align="left" style="border:1px solid #eeeeee;width:8%; '.(($rowselect['customernature']=='AMC')?'font-weight:bold; color:#3d8eb9':'').'"  ><span class="float-left"><i class="far fa-'.(($rowselect['customernature']=='AMC')?'check-square':'square').'"></i></span> &nbsp;AMC</td>
<td align="left"  style="border:1px solid #eeeeee;width:10%; '.(($rowselect['customernature']=='Warranty')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['customernature']=='Warranty')?'check-square':'square').'"></i></span> &nbsp;Warranty</td>
<td align="left" style="border:1px solid #eeeeee;width:15%; '.(($rowselect['customernature']=='Out of Warranty')?'font-weight:bold; color:#3d8eb9':'').'" ><span class="float-left"><i class="far fa-'.(($rowselect['customernature']=='Out of Warranty')?'check-square':'square').'"></i></span> &nbsp;Out of Warranty</td>
<td align="left" style="border:1px solid #eeeeee;width:12%; '.(($rowselect['customernature']=='Other Make')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['customernature']=='Other Make')?'check-square':'square').'"></i></span> &nbsp;Other Make</td>
<td align="left" style="border:1px solid #eeeeee;width:12%; '.(($rowselect['customernature']=='FSMA')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['customernature']=='FSMA')?'check-square':'square').'"></i></span> &nbsp;FSMA</td>
<td align="left" style="border:1px solid #eeeeee;width:12%; '.(($rowselect['customernature']=='CAMC')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['customernature']=='CAMC')?'check-square':'square').'"></i></span> &nbsp;CAMC</td>

<td align="left" style="border:1px solid #eeeeee;width:9%;"  ><span class="float-left"><b>Call Type</b></span></td>
<td align="left" style="border:1px solid #eeeeee;width:13%; '.(($rowselect['calltype']=='Service Call')?'font-weight:bold; color:#3d8eb9':'').'"  ><span class="float-left"><i class="far fa-'.(($rowselect['calltype']=='Service Call')?'check-square':'square').'"></i></span> &nbsp;Service Call</td>
<td align="left"  style="border:1px solid #eeeeee;width:14%; '.(($rowselect['calltype']=='Other Call')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['calltype']=='Other Call')?'check-square':'square').'"></i></span> &nbsp;Other Call</td>

</tr>
</tbody></table>';

$content.='

<table border="1" style="border:1px solid #eeeeee;width:102.8%;border-collapse:collapse;">
<tbody><tr>
<td align="left" style="border:1px solid #eeeeee;width:16%; height:15px;"  ><span class="float-left"><b>Complaint Nature</b></span></td>
<td align="left"  style="border:1px solid #eeeeee;width:11%; '.(($rowselect['callnature']=='Complaint')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['callnature']=='Complaint')?'check-square':'square').'"></i></span> &nbsp;Complaint</td>
<td align="left" style="border:1px solid #eeeeee;width:15%; '.(($rowselect['callnature']=='Re-Installation')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['callnature']=='Re-Installation')?'check-square':'square').'"></i></span> &nbsp;Re-Installation</td>
<td align="left" style="border:1px solid #eeeeee;width:13%; '.(($rowselect['callnature']=='DC Sign Work')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['callnature']=='DC Sign Work')?'check-square':'square').'"></i></span> &nbsp;DC Sign Work</td>
<td align="left" style="border:1px solid #eeeeee;width:11%; '.(($rowselect['callnature']=='Site Survey')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['callnature']=='Site Survey')?'check-square':'square').'"></i></span> &nbsp;Site Survey</td>
<td align="left" style="border:1px solid #eeeeee;width:8%; '.(($rowselect['callnature']=='Delivery')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['callnature']=='Delivery')?'check-square':'square').'"></i></span> &nbsp;Delivery</td>

<td align="left" style="border:1px solid #eeeeee;width:11%; '.(($rowselect['callnature']=='Installation')?'font-weight:bold; color:#3d8eb9':'').' "><span class="float-left"><i class="far fa-check-'.(($rowselect['callnature']=='Installation')?'check-square':'square').'"></i></span> &nbsp;Installation</td>
<td align="left" style="border:1px solid #eeeeee;width:12%; '.(($rowselect['callnature']=='Maintanence')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($rowselect['callnature']=='Maintanence')?'check-square':'square').'"></i></span> &nbsp;Maintanence</td>
</tr>
</tbody></table>';
$content.='


<table border="1" style="border:1px solid #eeeeee;width:95.8%;border-collapse:collapse;">
<tbody>
<tr>
<td align="center" style="width: 40%;border:1px solid #eeeeee; height:15px;"><strong>CUSTOMER INFORMATION</strong></td>
<td colspan="4" align="center" style="width: 46%;border:1px solid #eeeeee;"><strong>PRODUCT INFORMATION</strong></td>
</tr>
<tr>
<td align="left"  rowspan="5" style=" word-wrap: break-word;width:58%;border:1px solid #eeeeee;"><p><strong style="color:#3d8eb9">'.$rowxl['consigneename'].',</strong><br>'.$rowcons['address1'].' '.$rowcons['address2'].' '.$rowcons['area'].' '.$rowcons['district'].' '.$rowcons['pincode'].' '.$rowcons['contact'].'  '.$rowcons['phone'].' '.$rowcons['mobile'].'</p></td>
<td align="left" style="border:1px solid #eeeeee; color:#3d8eb9; font-weight:bold;" colspan="4">'.$rowxl['stockitem'].'</td>
</tr>
<tr>
<td width="10%" style="border:1px solid #eeeeee;">Product</td><td style="border:1px solid #eeeeee;" width="18%">'.$infocon4['make'].'</td><td style="border:1px solid #eeeeee;" width="12%">Battery Make</td><td style="border:1px solid #eeeeee;">'.$infocon4['batterymake'].' </td>
</tr>
<tr>
<td width="10%" style="border:1px solid #eeeeee;">Capacity</td><td style="border:1px solid #eeeeee;">'.$infocon4['capacity'].'</td><td style="border:1px solid #eeeeee;" width="10%">Battery AH</td><td style="border:1px solid #eeeeee;">'.$infocon4['batteryah'].'</td>
</tr>
<tr>
<td width="10%" style="border:1px solid #eeeeee;">MFG Code</td><td style="border:1px solid #eeeeee;">'.$infocon4['mfgcode'].'</td><td style="border:1px solid #eeeeee;" width="10%">No.of Battery</td><td style="border:1px solid #eeeeee;">'.$infocon4['noofbattery'].'</td>
</tr>
<tr>
<td width="10%" style="border:1px solid #eeeeee;">Sl.No</td><td style="border:1px solid #eeeeee;">'.$rowselect['serial'].'</td><td width="10%" style="border:1px solid #eeeeee;">No.of Set</td><td style="border:1px solid #eeeeee;">'.$infocon4['noofset'].'</td>
</tr>
</tbody></table>';

$content.='
<table border="1" style="border:1px solid #eeeeee;width:99.8%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width: 50%;border:1px solid #eeeeee; height:15px;"><strong>PROBLEM REPORTED</strong></td>
<td align="center" style="width: 50%;border:1px solid #eeeeee;"><strong>PROBLEM OBSERVED</strong></td>
</tr>
<tr>
<td align="center" style="width: 50%;border:1px solid #eeeeee;color:#3d8eb9; font-weight:bold;" height="60">'.$rowselect['reportedproblem'].'</td>
<td align="center" height="60" style="width: 50%;border:1px solid #eeeeee; color:#3d8eb9; font-weight:bold;">'.$infocon4['problemobserved'].'</td>
</tr>
</tbody></table>';

$content.='
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;width80%;">
<tbody><tr>
<td align="center" style="width: 23%;border:1px solid #eeeeee;" rowspan="3"><strong>SITE VERIFICATION</strong></td>
<td style="width: 21%;border:1px solid #eeeeee;">Ventilation : <span class="float-right">'.(($infocon4['verification']=='1')?'Yes':'No').'</span></td>
<td style="width: 34.8%;border:1px solid #eeeeee;">Modification on Wiring : <span class="float-right">'.(($infocon4['modificationwiring']=='1')?'Yes':'No').'</span></td>
<td style="width: 21%;border:1px solid #eeeeee;">Pollution Level : <span class="float-right">'.(($infocon4['pollutionlevel']=='1')?'High':($infocon4['pollutionlevel']=='2')?'Medium':'Low').'</span></td>
</tr>
<tr>
<td style="border:1px solid #eeeeee;">Direct Sunlight : <span class="float-right">'.(($infocon4['directsunlight']=='1')?'Yes':($infocon4['directsunlight']=='2')?'Partial':'No').'</span></td>
<td style="border:1px solid #eeeeee;">Rain/Cleaning Water Dripping : <span class="float-right">'.(($infocon4['waterdripping']=='1')?'Yes':'No').'</span></td>
<td style="border:1px solid #eeeeee;">Moisture : <span class="float-right">'.(($infocon4['moisture']=='1')?'Yes':'No').'</span></td>
</tr>
<tr>
<td style="border:1px solid #eeeeee;">Wiring Ready : <span class="float-right">'.(($infocon4['wiringready']=='1')?'Yes':'No').'</span></td>
<td style="border:1px solid #eeeeee;">Coastal Area : <span class="float-right">'.(($infocon4['coastelarea']=='1')?'Yes':'No').'</span></td>
<td style="border:1px solid #eeeeee;"></td>
</tr>
</tbody></table>
';

$content.='
<table border="1" style="border:1px solid #eeeeee;width: 99.8%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="border:1px solid #eeeeee;" colspan="2"><strong>AC DATA</strong></td>
</tr>
<tr>
<td align="center" style="width:50%;border:1px solid #eeeeee;"><strong>INPUT - '.(($infocon4['phasetype']=='31')?'3Φ':'').' '.(($infocon4['phasetype']=='33')?'3Φ':'').'   '.(($infocon4['phasetype']=='11')?'1Φ':'').'
</strong></td>
<td align="center" style="width:50%;border:1px solid #eeeeee;"><strong>OUTPUT - '.(($infocon4['phasetype']=='31')?'1Φ':'').' '.(($infocon4['phasetype']=='33')?'3Φ':'').' '.(($infocon4['phasetype']=='11')?'1Φ':'').'</strong></td>
</tr>
<tr>
<td align="center" style="width:50%; padding:3px; vertical-align:top;border:1px solid #eeeeee;">';
	
if(($infocon4['phasetype']=='31')||($infocon4['phasetype']=='33'))
{
	$content.='<table border="1" style="border:1px solid #eeeeee;width:100%;border-collapse:collapse;">
<tbody><tr>
<td align="center" colspan="2" style="width:50%;border:1px solid #eeeeee;">Voltage</td>
<td align="center" style="width:25%;border:1px solid #eeeeee;">Current</td>
<td align="center" style="width:25%;border:1px solid #eeeeee;">Frequency</td>
</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;">RY: <span class="float-right">'.$infocon4['voliry'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">RN: <span class="float-right">'.$infocon4['volirn'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">R: <span class="float-right">'.$infocon4['curir'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">R: <span class="float-right">'.$infocon4['freir'].'</span></td>
</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;">YB: <span class="float-right">'.$infocon4['voliyb'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">BN: <span class="float-right">'.$infocon4['volibn'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">Y: <span class="float-right">'.$infocon4['curiy'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">Y: <span class="float-right">'.$infocon4['freiy'].'</span></td>

</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;">BR: <span class="float-right">'.$infocon4['volibr'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">YN: <span class="float-right">'.$infocon4['voliyn'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">B: <span class="float-right">'.$infocon4['curib'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">B: <span class="float-right">'.$infocon4['freib'].'</span></td>
</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;"><span class="float-right"></span></td>
<td width="25%" style="border:1px solid #eeeeee;">NE: <span class="float-right">'.$infocon4['voline'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">N: <span class="float-right">'.$infocon4['curin'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;"><span class="float-right"></span></td>
</tr>
</tbody></table>';
}
 if(($infocon4['phasetype']=='11'))
{


$content.='<table border="1" style="border:1px solid #eeeeee;width:100%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:33%;border:1px solid #eeeeee;">Voltage</td>
<td align="center" style="width:33%;border:1px solid #eeeeee;">Current</td>
<td align="center" style="width:33%;border:1px solid #eeeeee;">Frequency</td>
</tr>
<tr>
<td width="33%" style="border:1px solid #eeeeee;">PN: <span class="float-right">'.$infocon4['volipn'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;">P: <span class="float-right">'.$infocon4['curip'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;">P: <span class="float-right">'.$infocon4['freip'].'</span></td>
</tr>
<tr>
<td width="33%" style="border:1px solid #eeeeee;">PE: <span class="float-right">'.$infocon4['volipe'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;">N: <span class="float-right">'.$infocon4['cur1in'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;"></td>
</tr>
<tr>
<td width="33%" style="border:1px solid #eeeeee;">NE: <span class="float-right">'.$infocon4['vol1ine'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;"></td>
<td width="33%" style="border:1px solid #eeeeee;"></td>
</tr>
</tbody></table>';

} 
$content.='</td>
<td align="center" style="width:50%;padding:3px; vertical-align:top;border:1px solid #eeeeee;">';
  if(($infocon4['phasetype']=='33'))
{


$content.='<table border="1" style="border:1px solid #eeeeee;width:100%;border-collapse:collapse;">
<tbody><tr>
<td align="center" colspan="2" style="width:50%;border:1px solid #eeeeee;">Voltage</td>
<td align="center" style="width:25%;border:1px solid #eeeeee;">Current</td>
<td align="center" style="width:25%;border:1px solid #eeeeee;">Frequency</td>
</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;">RY: <span class="float-right">'.$infocon4['volory'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">RN: <span class="float-right">'.$infocon4['volorn'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">R: <span class="float-right">'.$infocon4['curor'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">R: <span class="float-right">'.$infocon4['freor'].'</span></td>
</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;">YB: <span class="float-right">'.$infocon4['voloyb'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">BN: <span class="float-right">'.$infocon4['volobn'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">Y: <span class="float-right">'.$infocon4['curoy'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">Y: <span class="float-right">'.$infocon4['freoy'].'</span></td>

</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;">BR: <span class="float-right">'.$infocon4['volobr'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">YN: <span class="float-right">'.$infocon4['voloyn'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">B: <span class="float-right">'.$infocon4['curob'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">B: <span class="float-right">'.$infocon4['freob'].'</span></td>
</tr>
<tr>
<td width="25%" style="border:1px solid #eeeeee;"><span class="float-right"></span></td>
<td width="25%" style="border:1px solid #eeeeee;">NE: <span class="float-right">'.$infocon4['volone'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;">N: <span class="float-right">'.$infocon4['curon'].'</span></td>
<td width="25%" style="border:1px solid #eeeeee;"><span class="float-right"></span></td>
</tr>
</tbody></table>';

}	
 if(($infocon4['phasetype']=='31')||($infocon4['phasetype']=='11'))
{	
$content.='<table border="1" style="border:1px solid #eeeeee;width:100%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:33%;border:1px solid #eeeeee;">Voltage</td>
<td align="center" style="width:33%;border:1px solid #eeeeee;">Current</td>
<td align="center" style="width:33%;border:1px solid #eeeeee;">Frequency</td>
</tr>
<tr>
<td width="33%" style="border:1px solid #eeeeee;">PN: <span class="float-right">'.$infocon4['volopn'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;">P: <span class="float-right">'.$infocon4['curop'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;">P: <span class="float-right">'.$infocon4['freop'].'</span></td>
</tr>
<tr>
<td width="33%" style="border:1px solid #eeeeee;">PE: <span class="float-right">'.$infocon4['volope'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;">N: <span class="float-right">'.$infocon4['cur1on'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;"></td>
</tr>
<tr>
<td width="33%" style="border:1px solid #eeeeee;">NE: <span class="float-right">'.$infocon4['vol1one'].'</span></td>
<td width="33%" style="border:1px solid #eeeeee;"></td>
<td width="33%" style="border:1px solid #eeeeee;"></td>
</tr>
</tbody></table>';

}


$content.='
</td>
					  </tr>
					  </tbody>
					  </table>';

$content.='
<table border="1" style="border:1px solid #eeeeee;width:68.4%;border-collapse:collapse;">
<tbody><tr>
<td style="width:38%;border:1px solid #eeeeee;">Stabilizer : <span class="float-right">'.(($infocon4['stabilizer']=='1')?'Yes':'No').'</span></td>
<td style="width:38%;border:1px solid #eeeeee;">Phase Reverse : <span class="float-right">'.(($infocon4['phasereverse']=='1')?'Yes':'No').'</span></td>
<td style="width:35%;border:1px solid #eeeeee;">Earthing : <span class="float-right">'.(($infocon4['earthing']=='1')?'Yes':'No').'</span></td>
<td style="width:35%;border:1px solid #eeeeee;">Overload : <span class="float-right">'.(($infocon4['overload']=='1')?'Yes':'No').'</span></td>
</tr></tbody></table>
';

$content.='
<table border="1" style="border:1px solid #eeeeee;width:83.1%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:20%;border:1px solid #eeeeee;" rowspan="2"><strong>DC Data</strong></td>
<td colspan="2" style="width:20%;border:1px solid #eeeeee;" align="center">@ Charging</td>
<td colspan="2" style="width:20%;border:1px solid #eeeeee;" align="center">@ Discharging with Load</td>
<td colspan="2" style="width:20%;border:1px solid #eeeeee;" align="center">@ Discharging without Load</td>
<td align="center" style="width:20%;border:1px solid #eeeeee;" rowspan="2"><strong>Battery Condition</strong></td>
<td align="center" style="width:20%;border:1px solid #eeeeee;" rowspan="2">'.$infocon4['batterycondition'].' </td>
</tr>
<tr>
<td style="border:1px solid #eeeeee;">'.$infocon4['chargingv'].' <span class="float-right">V</span></td>
<td style="border:1px solid #eeeeee;"> '.$infocon4['chargingo'].'<span class="float-right">A</span></td>
<td style="border:1px solid #eeeeee;">'.$infocon4['dischargingv'].' <span class="float-right">V</span></td>
<td style="border:1px solid #eeeeee;">'.$infocon4['dischargingo'].' <span class="float-right">A</span></td>
<td style="border:1px solid #eeeeee;">'.$infocon4['dischargingwv'].' <span class="float-right">V</span></td>
<td style="border:1px solid #eeeeee;">'.$infocon4['dischargingwo'].' <span class="float-right">A</span></td>
</tr>
</tbody></table>

';

$content.='
<table border="1" style="border:1px solid #eeeeee;width:99.8%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:45%;border:1px solid #eeeeee;"><strong>SPARES USED</strong></td>
<td align="center" style="width:45%;border:1px solid #eeeeee;"><strong>SPARES REQUIRED</strong></td>
</tr>
<tr>
<td align="center" style="padding:3px; vertical-align:top;width:50%;border:1px solid #eeeeee;">
					
<table border="1" style="border:1px solid #eeeeee;width:100%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:10%;border:1px solid #eeeeee;">S.No</td>
<td align="center" style="width:80%;border:1px solid #eeeeee;">Name</td>
<td align="center" style="width:10%;border:1px solid #eeeeee;">Qty</td>
</tr>';
for($i=1;$i<=5;$i++)
{
if($infocon4['sparesrequired'.$i]!='')
{
$content.='<tr>
<td style="width:10%;border:1px solid #eeeeee;" align="center">&nbsp;'.$i.'</td>
<td style="width:80%;border:1px solid #eeeeee;">&nbsp;'.$infocon4['sparesused'.$i].'</td>
<td style="width:10%;border:1px solid #eeeeee;" align="center">&nbsp;'.$infocon4['sparesused'.$i.'q'].'</td>
</tr>';
}
else
{
$content.='<tr>
<td width="10%" align="center" style="border:1px solid #eeeeee;">&nbsp;</td>
<td width="80%" style="border:1px solid #eeeeee;">&nbsp;</td>
<td width="10%" align="center" style="border:1px solid #eeeeee;">&nbsp;</td>
</tr>';
}
}
$content.='</tbody></table>
</td>
<td align="center" style="padding:3px; vertical-align:top;width:50%;border:1px solid #eeeeee;">
<table border="1" style="border:1px solid #eeeeee;width:100%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:10%;border:1px solid #eeeeee;">S.No</td>
<td align="center" style="width:80%;border:1px solid #eeeeee;">Name</td>
<td align="center" style="width:10%;border:1px solid #eeeeee;">Qty</td>
</tr>';
for($i=1;$i<=5;$i++)
{
if($infocon4['sparesrequired'.$i]!='')
{
$content.='  
<tr>
<td width="10%" align="center" style="border:1px solid #eeeeee;">&nbsp;'.$i.'</td>
<td width="80%" style="border:1px solid #eeeeee;">&nbsp;'.$infocon4['sparesrequired'.$i].'</td>
<td width="10%" align="center" style="border:1px solid #eeeeee;">&nbsp;'.$infocon4['sparesrequired'.$i.'q'].'</td>
</tr>';
}
else
{
$content.='  
<tr>
<td width="10%" align="center" style="border:1px solid #eeeeee;">&nbsp;</td>
<td width="80%" style="border:1px solid #eeeeee;">&nbsp;</td>
<td width="10%" align="center" style="border:1px solid #eeeeee;">&nbsp;</td>
</tr>';
}
}
$content.='</tbody></table>
</td>
</tr>
</tbody></table>';

$content.='


<table border="1" style="border:1px solid #eeeeee;width:100.7%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:23.2%;border:1px solid #eeeeee;"><strong>ENGINEER\' S REPORT</strong></td>
<td  style="border:1px solid #eeeeee;width:76.8%;color:#3d8eb9; font-weight:bold;">'.strtoupper($infocon4['engineerreport']).'&nbsp;</td>
</tr></tbody></table>
';

$content.='


<table border="1" style="border:1px solid #eeeeee;width:100.7%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:23.2%;border:1px solid #eeeeee;"><strong>CALL STATUS</strong></td>
<td align="left" style="width:33%;border:1px solid #eeeeee; '.(($infocon4['callstatus']=='Completed')?'font-weight:bold; color:#3d8eb9':'').'"> <span class="float-left"><i class="far fa-'.(($infocon4['callstatus']=='Completed')?'check-square':'square').'"></i></span> &nbsp;Completed</td>
<td align="left" style="width:46.8%;border:1px solid #eeeeee; '.(($infocon4['callstatus']=='Pending')?'font-weight:bold; color:#3d8eb9':'').'"><span class="float-left"><i class="far fa-'.(($infocon4['callstatus']=='Pending')?'check-square':'square').'"></i></span> &nbsp;Pending</td>
</tr>
</tbody></table>
';

$content.='

<table border="1" style="border:1px solid #eeeeee;width:100.7%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:23.2%;border:1px solid #eeeeee;"><strong>ACTION TAKEN</strong></td>
<td style="border:1px solid #eeeeee;width:66.3%;color:#3d8eb9; font-weight:bold;">'.$infocon4['actiontaken'].'</td>
</tr></tbody></table>

';

$content.='
<table border="1" style="border:1px solid #eeeeee;width:99.7%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:23.2%;border:1px solid #eeeeee;"><strong>SITE IMAGES</strong></td>
<td class="rotate" style="width:10%;border:1px solid #eeeeee;">BEFORE</td>
<td style="width:27.5%;border:1px solid #eeeeee;">';

					if($infocon4['imgbefuploads']!=='')
{
$as=explode(',',$infocon4['imgbefuploads']);
$c=1;
foreach($as as $a)
{
	$a=str_replace('uploads','padhivetram',$a);
	if($a!='')
	{
	$content.="<img src='".$a."' width='50' height='50' style='padding:5px;'>";
	}
	$c++;
}
}
					
					$content.='</td>
<td class="rotate" style="width:10%;border:1px solid #eeeeee;">AFTER</td>
<td style="border:1px solid #eeeeee;width:29.5%;">';

if($infocon4['imguploads']!=='')
{
$as=explode(',',$infocon4['imguploads']);
$c=1;
foreach($as as $a)
{
$a=str_replace('uploads','padhivetram',$a);	
if($a!='')
	{
$content.="<img src='".$a."' width='50' height='50' style='padding:5px;'>";
	}
$c++;
}
}
$content.='</td>
</tr>
</tbody></table>';

$content.='
<table style="border:1px solid #eeeeee;width:99.7%;border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:23.2%;border:1px solid #eeeeee;"><strong>CUSTOMER\'S FEEDBACK</strong></td>
<td style="width:37.5%;border:1px solid #eeeeee;">'.$infocon4['customerfeedback'].' </td>
<td align="center" style="width:15%;border:1px solid #eeeeee;"><strong>ENGINEER\'S APPROACH</strong></td>
<td style="width:24.5%;border:1px solid #eeeeee;">'.$infocon4['engapproach'].'</td>
</tr></tbody></table>';
if($infocon4['signature']!='')
{
$input_file = $infocon4['signature'];
$output_file = $infocon4['signature'];

$input = imagecreatefrompng($input_file);
$width = imagesx($input);
$height = imagesy($input);
$output = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($output,  255, 255, 255);
imagefilledrectangle($output, 0, 0, $width, $height, $white);
imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
imagepng($output, $output_file);
}

$content.='
<table style="border:1px solid #eeeeee; width:99.8%; border-collapse:collapse;">
<tbody><tr>
<td align="center" style="width:25%;border:1px solid #eeeeee;"><strong>CUSTOMER\'S SIGNATURE <br>'.$infocon4['signname'].'</strong></td>
<td style="width:25%; border:1px solid #eeeeee;"><img width="75" style="'.(($infocon4['signature']!='')?'display:block':'display:none').';border:1px solid #eeeeee;" src="'.$infocon4['signature'].'"> <img width="75" style="'.(($infocon4['imgseal']!='')?'display:block':'display:none').';border:1px solid #eeeeee;" src="'.$infocon4['imgseal'].'"></td>


<td align="center" style="width:25%;border:1px solid #eeeeee;"><strong>ENGINEER SIGNATURE <br>'.$engineername.'</strong></td>
<td style="width:25%;border:1px solid #eeeeee;"><img width="100" style="'.(($engsignature!='')?'display:block':'display:none').';" src="'.$engsignature.'"></td>
</tr>
</tbody></table>';


if($infocon4['incgst']!='2')
{
if(($infocon4['scharge']!='0')&&($infocon4['scharge']!='0.00')&&($infocon4['scharge']!='0')&&(!empty($infocon4['scharge'])))
{
$content.='<br pagebreak="true" />';

$content.='<table style="border:1px solid #eeeeee; width:70%;">
<tbody><tr>
<td colspan="3" align="center"><span class="heading" style="font-size:24px; font-weight:bold;"><img src="'.$_SESSION['companylogo'].'" height="50"> '.$_SESSION['companyname'].'</span>
</td>
</tr>
<tr>
<td colspan="3" align="center" width:50%>'.$_SESSION['companyaddress1'].' '.$_SESSION['companyaddress2'].' '.$_SESSION['companyarea'].' '.$_SESSION['companydistrict'].' '.$_SESSION['companypincode'].'</td>
</tr>
<tr>
<td style="width:48%;">E.mail: '.$_SESSION['companyemail'].'</td>
<td style="width:48%" align="center">Mobile: '.$_SESSION['companymobile'].'</td>
<td  style="width:47%" align="right">GSTIN: '.$_SESSION['companygstno'].'</td>
</tr>
</tbody></table>';


$content.='<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;width:51.8%;">
<tr>
<td colspan="3" align="center" class="heading" style="font-size:18px; padding:5px;border:1px solid #eeeeee;width:80%;color:#3d8eb9; font-weight:bold;">TAX INVOICE</td>
</tr>
<tr style="width:100%;">
<td rowspan="3"  style="width:100%;border:1px solid #eeeeee">
Invoice No.: <b><font size="+1">'.$infocon4['schargeno'].'</font></b><br>
Invoice Date: <b><font size="+1">'.date('d/m/Y',strtotime($infocon4['schargedate'])).'</font></b></td>
<td align="left" style="width:35%;border:1px solid #eeeeee">Call ID:</td>
<td align="left" style="width:58%;border:1px solid #eeeeee">'.$rowselect['calltid'].'</td>
</tr>
<tr>
<td align="left" style="width:35%;border:1px solid #eeeeee">SCR. No.:</td>
<td align="left" style="width:58%;border:1px solid #eeeeee">'.$infocon4['srno'].'</td>
</tr>
<tr>
<td align="left" style="width:35%;border:1px solid #eeeeee">Date:</td>
<td align="left" style="width:58%;border:1px solid #eeeeee">'.date('d/m/Y h:i:s a', strtotime($rowselect['callon'])).'</td>
</tr>
</table>
';


$content.='
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td align="left"style="width:99.7%;border:1px solid #eeeeee;"><strong>TO</strong><br><p style="margin-left:20px;"><strong style="color:#3d8eb9; font-weight:bold;">'.$rowxl['consigneename'].'</strong><br>'.$rowcons['address1'].' '.$rowcons['address2'].' '.$rowcons['area'].' '.$rowcons['district'].' '.$rowcons['pincode'].'<br>'.$rowcons['contact'].' '.$rowcons['phone'].' '.$rowcons['mobile'].'<br>
<b>GSTIN/UIN:</b>'.$rowcons['gstno'].' <br>
<b>State Code:</b>'.(($rowcons['gstno']!='')?substr($rowcons['gstno'],0,2):'').'</p>
</td>
</tr>
</table>
';


$content.='
 <table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;height:30%;">
<tr>
<th style="text-align:center; padding:10px;border:1px solid #eeeeee;">S.NO</th>
<th style="text-align:center;border:1px solid #eeeeee;width:67.5%;">DESCRIPTION OF GOODS</th>
<th style="text-align:center;border:1px solid #eeeeee;">HSN/SAC</th>
<th style="text-align:center;border:1px solid #eeeeee;">GST RATE</th>
<th style="text-align:center;border:1px solid #eeeeee;">AMOUNT</th>
</tr>
<tr>
<td style="text-align:center; vertical-align:top; height:350px;border:1px solid #eeeeee;">1</td>
<td style="text-align:right; vertical-align:top;border:1px solid #eeeeee;">
<b>Service Charges</b><br>
<i><font size="-1">For '.$rowxl['stockitem'].'
</font></i><br>
<b>OUTPUT CGST</b><br>
<b>OUTPUT SGST</b>
</td>
<td style="text-align:center; vertical-align:top;border:1px solid #eeeeee;">998729</td>
<td style="text-align:center; vertical-align:top;border:1px solid #eeeeee;">'.number_format((float)$infocon4['schargegst'],2,'.',',').'%</td>
<td style="text-align:right; vertical-align:top;border:1px solid #eeeeee;"><b>'.number_format((float)$infocon4['schargepre'],2,'.',',').'</b><br><br>
<b>'.number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',').'</b><br>
<b>'.number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',').'</b></td>
</tr>
<tr>
<td style="border:1px solid #eeeeee;"></td>
<td style="border:1px solid #eeeeee;">Total</td>
<td style="border:1px solid #eeeeee;"></td>
<td style="border:1px solid #eeeeee;"></td>
 <td style="text-align:right; vertical-align:top;border:1px solid #eeeeee;"><b style="color:#3d8eb9; font-weight:bold;">'.number_format((float)$infocon4['scharge'],2,'.',',').'</b></td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #eeeeee;">Amount Chargable (in words)<br><b>Indian Rupees: '.(ucwords(strtolower(getIndianCurrency($infocon4['scharge'])))).'  Only</b>
<span class="float-right"><i>E. & O.E</i></span>
</td>
</tr>
</table>
';


$content.='
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td rowspan="2" style="text-align:right;border:1px solid #eeeeee;width:66%;" >Taxable<br>Value</td>
<td colspan="2" align="center" style="border:1px solid #eeeeee;">Central Tax</td>
<td colspan="2" align="center" style="border:1px solid #eeeeee;">State Tax</td>
<td rowspan="2" align="center" style="border:1px solid #eeeeee;">Total<br>Tax Amount</td> 
</tr>
<tr>
<td align="center" style="border:1px solid #eeeeee;">Rate</td>
<td align="center" style="border:1px solid #eeeeee;">Amount</td>
<td align="center" style="border:1px solid #eeeeee;">Rate</td>
<td align="center" style="border:1px solid #eeeeee;">Amount</td>
</tr>
<tr>
<td style="text-align:right;border:1px solid #eeeeee;">'.number_format((float)$infocon4['schargepre'],2,'.',',').'</td>
<td style="text-align:right;border:1px solid #eeeeee;">'.number_format(((float)$infocon4['schargegst']/2),2,'.',',').'%</td>
<td style="text-align:right;border:1px solid #eeeeee;">'.number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',').'</td>
<td style="text-align:right;border:1px solid #eeeeee;">'.number_format(((float)$infocon4['schargegst']/2),2,'.',',').'%</td>
<td style="text-align:right;border:1px solid #eeeeee;">'.number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',').'</td>
<td style="text-align:right;border:1px solid #eeeeee;">'.number_format((float)$infocon4['schargegstvalue'],2,'.',',').'</td>
</tr>
 <tr>
<th style="text-align:right;border:1px solid #eeeeee;">'.number_format((float)$infocon4['schargepre'],2,'.',',').'</th>
<th style="text-align:right;border:1px solid #eeeeee;"></th>
<th style="text-align:right;border:1px solid #eeeeee;">'.number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',').'</th>
<th style="text-align:right;border:1px solid #eeeeee;"></th>
<th style="text-align:right;border:1px solid #eeeeee;">'.number_format(((float)$infocon4['schargegstvalue']/2),2,'.',',').'</th>
<th style="text-align:right;border:1px solid #eeeeee;">'.number_format((float)$infocon4['schargegstvalue'],2,'.',',').'</th>
</tr>
<tr>
<td colspan="6" style="border:1px solid #eeeeee;">Tax Amount (in words)<br><b>Indian Rupees: '.(ucwords(strtolower(getIndianCurrency($infocon4['schargegstvalue'])))).'  Only</b>
</td>
</tr>
</table>
';


$content.='
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td  style="border:1px solid #eeeeee;width:54.2%;">Remarks: '.$rowxl['consigneename'].' '.$rowxl['district'].'<br>
Company\'s PAN: <b>'.$_SESSION['companybankname'].'</b></td>

<td colspan="2" align="left" style="border:1px solid #eeeeee;"><i>Company Bank Details:</i><br>
Bank Name: <b>'.$_SESSION['companybankname'].'</b><br>
A/c No: <b>'.$_SESSION['companyacno'].'</b><br>
Branch & IFS Code: <b>'.$_SESSION['companybranchname'].' '.$_SESSION['companyifscode'].'</b>

</td>
</tr>
</table>
';


$content.='
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td style="width:99.7%;border:1px solid #eeeeee;"><b><i>Declaration:</i></b><br>
We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
</td>
</tr>
</table>
';


$content.='
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td align="center" style="vertical-align:bottom;border:1px solid #eeeeee;width:32.8%;">
<img width="75" style="'.(($infocon4['signature']!='')?'display:block':'display:none').';border:1px solid #eeeeee;" src="'.$infocon4['signature'].'"> <img width="75" style="'.(($infocon4['imgseal']!='')?'display:block':'display:none').';" src="'.$infocon4['imgseal'].'"><br>
<strong>CUSTOMER\'S SIGNATURE <br>'.$infocon4['signname'].'</strong></td>

<td align="center"  style="vertical-align:bottom;border:1px solid #eeeeee;width:33%;">
<img id="signatureimg" height="60" style="'.(($infocon4['signature']!='')?'display:block':'display:none').'" src="'.$engsignature.'"><br>
<strong>ENGINEER\'S SIGNATURE <br>('.$engineername.')</strong></td>
<td align="center" style="vertical-align:bottom;border:1px solid #eeeeee;width:33.9%;font-size:10px"><b><font size="-1">for '.$_SESSION['companyname'].'</font></b>
<br>';
if($_SESSION['companyauthsign']!='')
{
$content.='<img src="'.$_SESSION['companyauthsign'].'">
<br>';
}
$content.='<b>AUTHORISED SIGNATORY</b>
</td>
</tr>
<tr>
<td colspan="3" align="center" style="border:1px solid #eeeeee"><font size="-1">SUBJECT TO TRICHY JURISDICTION<BR>This is a Computer Generated Invoice</font></td>
</tr>
</table>';	

}
}
else
{
	if(($infocon4['scharge']!='0')&&($infocon4['scharge']!='0.00')&&($infocon4['scharge']!='0')&&(!empty($infocon4['scharge'])))
	{


$content.='<table style="border:1px solid #eeeeee; width:70%;">
<tbody><tr>
<td colspan="3" align="center"><span class="heading" style="font-size:24px; font-weight:bold;"><img src="'.$_SESSION['companylogo'].'" height="50"> '.$_SESSION['companyname'].'</span>
</td>
</tr>
<tr>
<td colspan="3" align="center" width:50%>'.$_SESSION['companyaddress1'].' '.$_SESSION['companyaddress2'].' '.$_SESSION['companyarea'].' '.$_SESSION['companydistrict'].' '.$_SESSION['companypincode'].'</td>
</tr>
<tr>
<td style="width:48%;">E.mail: '.$_SESSION['companyemail'].'</td>
<td style="width:48%" align="center">Mobile: '.$_SESSION['companymobile'].'</td>
<td  style="width:47%" align="right">GSTIN: '.$_SESSION['companygstno'].'</td>
</tr>
</tbody></table>


<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;width:51.7%;">
<tr>
<td colspan="3" align="center" class="heading" style="font-size:18px; padding:5px;border:1px solid #eeeeee;width:80%; color:#3d8eb9; font-weight:bold;">ESTIMATE</td>
</tr>
<tr style="width:100%;">
<td rowspan="3"  style="width:100%;border:1px solid #eeeeee">
Estimate No.: <b><font size="+1">'.$infocon4['schargeno'].'</font></b><br>
Estimate Date: <b><font size="+1"> '.date('d/m/Y',strtotime($infocon4['schargedate'])).'</font></b></td>
<td align="left" style="width:35%;border:1px solid #eeeeee">Call ID:</td>
<td align="left" style="width:58%;border:1px solid #eeeeee">'.$rowselect['calltid'].'</td>
</tr>
<tr>
<td align="left" style="width:35%;border:1px solid #eeeeee">SCR. No.:</td>
<td align="left" style="width:58%;border:1px solid #eeeeee">'.$infocon4['srno'].'</td>
</tr>
<tr>
<td align="left" style="width:35%;border:1px solid #eeeeee">Date:</td>
<td align="left" style="width:58%;border:1px solid #eeeeee">'.date('d/m/Y h:i:s a', strtotime($rowselect['callon'])).'</td>
</tr>
</table>

<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td align="left"style="width:99.5%;border:1px solid #eeeeee;"><strong>TO</strong><br><p style="margin-left:20px;"><strong style="color:#3d8eb9; font-weight:bold;">'.$rowxl['consigneename'].'</strong><br>'.$rowcons['address1'].' '.$rowcons['address2'].' '.$rowcons['area'].' '.$rowcons['district'].' '.$rowcons['pincode'].'<br> '.$rowcons['contact'].' '.$rowcons['phone'].' '.$rowcons['mobile'].'<br>

<b>State Code:</b>'.(($rowcons['gstno']!='')?substr($rowcons['gstno'],0,2):'').' </p>
</td>
</tr>
</table>

 <table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;height:30%;">
<tr>
<th style="text-align:center; padding:10px;border:1px solid #eeeeee;">S.NO</th>
<th style="text-align:center;border:1px solid #eeeeee;width:70%;">DESCRIPTION OF GOODS</th>
<th style="text-align:center;border:1px solid #eeeeee;width:11%;">HSN/SAC</th>

<th style="text-align:center;border:1px solid #eeeeee;width:11.3%;">AMOUNT</th>
</tr>
<tr>
<td style="text-align:center; vertical-align:top; height:350px;border:1px solid #eeeeee;">1</td>
<td style="text-align:right; vertical-align:top;border:1px solid #eeeeee;">
<b>Service Charges</b><br>
<i><font size="-1">For '.$rowxl['stockitem'].'</font></i><br>
<br>

</td>
<td style="text-align:center; vertical-align:top;border:1px solid #eeeeee;">998729</td>

<td style="text-align:right; vertical-align:top;border:1px solid #eeeeee;"><b>'.number_format((float)$infocon4['schargepre'],2,'.',',').'</b><br><br>
<b></b><br>
<b></b></td>
</tr>
<tr>
<td style="border:1px solid #eeeeee;"></td>
<td style="border:1px solid #eeeeee;">Total</td>

<td style="border:1px solid #eeeeee;"></td>
 <td style="text-align:right; vertical-align:top;border:1px solid #eeeeee; color:#3d8eb9; font-weight:bold;"><b>'.number_format((float)$infocon4['scharge'],2,'.',',').'</b></td>
</tr>
<tr>
<td colspan="4" style="border:1px solid #eeeeee;">Amount Chargable (in words)<br><b>Indian Rupees: '.(ucwords(strtolower(getIndianCurrency($infocon4['scharge'])))).'  Only</b>
<span class="float-right" style="margin-left:225px;"><i>E. & O.E</i></span>
</td>
</tr>
</table>





<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td  style="border:1px solid #eeeeee;width:54%;">Remarks: '.$rowxl['consigneename'].' '.$rowxl['district'].'<br>
Company\'s PAN: <b>'.$_SESSION['companypanno'].'</b></td>

<td colspan="2" align="left" style="border:1px solid #eeeeee;"><i>Company Bank Details:</i><br>
Bank Name: <b>'.$_SESSION['companybankname'].'</b><br>
A/c No: <b>'.$_SESSION['companyacno'].'</b><br>
Branch & IFS Code: <b>'.$_SESSION['companybranchname'].' '.$_SESSION['companyifscode'].'</b>

</td>
</tr>
</table>


<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td style="width:99.5%;border:1px solid #eeeeee;"><b><i>Declaration:</i></b><br>
We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
</td>
</tr>
</table>
';


$content.='
<table border="1" style="border:1px solid #eeeeee;border-collapse:collapse;">
<tr>
<td align="center" style="vertical-align:bottom;border:1px solid #eeeeee;width:32.8%;">
<img width="75" style="'.(($infocon4['signature']!='')?'display:block':'display:none').';border:1px solid #eeeeee;" src="'.$infocon4['signature'].'"> <img width="75" style="'.(($infocon4['imgseal']!='')?'display:block':'display:none').';" src="'.$infocon4['imgseal'].'"><br>
<strong>CUSTOMER\'S SIGNATURE <br>'.$infocon4['signname'].'</strong></td>

<td align="center"  style="vertical-align:bottom;border:1px solid #eeeeee;width:33%;">
<img id="signatureimg" height="60" style="'.(($infocon4['signature']!='')?'display:block':'display:none').'" src="'.$engsignature.'"><br>
<strong>ENGINEER\'S SIGNATURE <br>('.$engineername.')</strong></td>
<td align="center" style="vertical-align:bottom;border:1px solid #eeeeee;width:33.9%;font-size:10px"><b><font size="-1">for '.$_SESSION['companyname'].'</font></b>
<br>';
if($_SESSION['companyauthsign']!='')
{
$content.='<img src="'.$_SESSION['companyauthsign'].'">
<br>';
}
$content.='<b>AUTHORISED SIGNATORY</b>
</td>
</tr>
<tr>
<td colspan="3" align="center" style="border:1px solid #eeeeee"><font size="-1">SUBJECT TO TRICHY JURISDICTION<BR>This is a Computer Generated Invoice</font></td>
</tr>
</table>';

			}
		} 


				
				
					$count++;
			}
		}
 }		
			
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output();
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
