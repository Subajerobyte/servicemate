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
  <title><?=$_SESSION['companyname']?> - AMC Report - <?=$_GET['id']?></title>
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
	$id=mysqli_real_escape_string($connection,$_GET['id']);
	$_SESSION['id']=$id;
		$sqlselect = "SELECT * From jrcamc where id='".$id."' order by id desc";
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
				
				if($rowselect['receivedby']!='')
{
	$engineerId = str_replace('e_', '', $rowselect['receivedby']);
    $sqlengineer = "select engineername as name, id from jrcengineer where enabled='0'  order by name asc";
    $queryengineer = mysqli_query($connection, $sqlengineer);
    if(!$queryengineer){
        die("SQL query failed: " . mysqli_error($connection));
    }
    while($rowengineer = mysqli_fetch_array($queryengineer)) {
        ?>
		<?php
		$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where id='".$rowengineer['id']."' order by id desc";   
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
?>
        <?php
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
					  <td colspan="5" align="center" class="heading" style="font-size:24px; padding:10px;">AMC INVOICE</td>
					  </tr>
					  <tr>
					  <td rowspan="3" width="65%">
					  AMC Invoice No.: <b><font size="+1"><?=$rowselect['amcinvoiceno']?></font></b><br>
					  AMC Invoice Date: <b><font size="+1"><?=date('d/m/Y',strtotime($rowselect['createdon']))?></font></b></td>
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
					
					   
					  <tr>
					  <td style="text-align:center; vertical-align:top; height:250px;">1</td>
					  <td style="text-align:right; vertical-align:top;">
					  <b>AMC Charge</b><br>
					  <i><font size="-1">For <?=$rowxl['stocksubcategory']?> - <?=$rowxl['componentname']?></font></i><br>
					 
					  <b>PERIOD</b> : <?=date('d/m/Y',strtotime($rowselect['datefrom']))?> - <?=date('d/m/Y',strtotime($rowselect['dateto']))?><br>
					  <b>OUTPUT CGST</b><br>
					  <b>OUTPUT SGST</b>
					  </td>
					  <td style="text-align:center; vertical-align:top;"></td>
					  <td style="text-align:center; vertical-align:top;">9959</td>
					  <td style="text-align:center; vertical-align:top;"><?=number_format((float)$rowselect['amcgst'],2,'.',',')?>%</td>
					  <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$rowselect['priceperyear'],2,'.',',')?></b><br><br><br>
					 
					 
					  <b><?=number_format(((float)$rowselect['amcgstvalue']/2),2,'.',',')?></b><br>
					  <b><?=number_format(((float)$rowselect['amcgstvalue']/2),2,'.',',')?></b></td>
					  </tr>
					  <tr>
					  <td></td>
					  <td>Total</td>
					  <td></td>
					  <td></td> 
					  <td></td>
					   <td style="text-align:right; vertical-align:top;"><b><?=number_format((float)$rowselect['totalvalue'],2,'.',',')?></b></td>
					  </tr>
					  <tr>
					  <td colspan="5">Amount Chargable (in words)<br><b>Indian Rupees: <?php  echo ucwords(strtolower(getIndianCurrency($rowselect['totalvalue']))); ?> Only</b>
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
					  <td style="text-align:right"><?=number_format((float)$rowselect['priceperyear'],2,'.',',')?></td>
					  <td style="text-align:right"><?=number_format(((float)$rowselect['amcgst']/2),2,'.',',')?>%</td>
					  <td style="text-align:right"><?=number_format(((float)$rowselect['amcgstvalue']/2),2,'.',',')?></td>
					  <td style="text-align:right"><?=number_format(((float)$rowselect['amcgst']/2),2,'.',',')?>%</td>
					  <td style="text-align:right"><?=number_format(((float)$rowselect['amcgstvalue']/2),2,'.',',')?></td>
					  <td style="text-align:right"><?=number_format((float)$rowselect['amcgstvalue'],2,'.',',')?></td>
					  </tr>
					  <tr>
					  <th style="text-align:right"><?=number_format((float)$rowselect['priceperyear'],2,'.',',')?></th>
					  <th style="text-align:right"></th>
					  <th style="text-align:right"><?=number_format(((float)$rowselect['amcgstvalue']/2),2,'.',',')?></th>
					  <th style="text-align:right"></th>
					  <th style="text-align:right"><?=number_format(((float)$rowselect['amcgstvalue']/2),2,'.',',')?></th>
					  <th style="text-align:right"><?=number_format((float)$rowselect['amcgstvalue'],2,'.',',')?></th>
					  </tr>
					  <tr>
					  <td colspan="6">Tax Amount (in words)<br><b>Indian Rupees: <?php  echo ucwords(strtolower(getIndianCurrency($rowselect['totalvalue']))); ?> Only</b>
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
					  <br>
					  <strong>CUSTOMER'S SIGNATURE <br>(<?=$rowxl['consigneename']?>)</strong></td>
					  <td align="center" width="33%" style="vertical-align:bottom">
					 <br>
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
