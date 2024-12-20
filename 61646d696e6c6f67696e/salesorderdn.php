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
  <title><?=$_SESSION['companyname']?> - Sales Order Print - <?=$_GET['id']?></title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Qwigley&display=swap" rel="stylesheet">
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
.signfont
{
	font-family: 'Qwigley', cursive;
}
</style>
</head>
<body onLoad="window.print();">
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
	$sono=mysqli_real_escape_string($connection,$_GET['id']);
	
		$sqlselect = "SELECT * From jrcsaleorder where sono='".$sono."'";
		
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{
			$rowselect = array();
			while($row1 = mysqli_fetch_assoc($queryselect))
			{ 
			$rowselect[] = $row1;
			}
				$count=1;
			
				
				
		?>
	
					 <table style="border:1px solid #eeeeee">
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
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td colspan="5" align="center" class="heading" style="font-size:24px; padding:10px;">DELIVERY NOTE</td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <th style="text-align:center">Delivery Note No.</th>
						  <th style="text-align:center">Dated</th>
						  <th style="text-align:center">Reference No. & Date.</th>
						  <th style="text-align:center">Other References</th>
						   <th style="text-align:center">Buyer’s Order No.</th>
						  </tr>
						  <tr>
						   <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['dnno']?></td>
						  <td style="text-align:center; vertical-align:top;"><?=date('d-m-Y',strtotime($rowselect[0]['sodate']))?></td>
						  <td style="text-align:center; vertical-align:top;"><?=(($rowselect[0]['pono']!='') && ($rowselect[0]['podate']!=''))?$rowselect[0]['pono'].'.&.'.(date('d-m-Y',strtotime($rowselect[0]['podate']))):(($rowselect[0]['pono']!='')?$rowselect[0]['pono']:(date('d-m-Y',strtotime($rowselect[0]['podate']))))?> </td>
						  <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['otherreference']?> </td>
						  <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['pono']?></td>
						  </tr>
						  
						  <tr>
						  <th style="text-align:center">Dated</th>
						  <th style="text-align:center">Dispatch Doc No.</th>
						  <th style="text-align:center">Dispatched through</th>
						  <th style="text-align:center">Destination</th>
						  <th style="text-align:center">Terms of Delivery</th>
						  </tr>
						  <tr>
						   <td style="text-align:center; vertical-align:top;"><?=(date('d-m-Y',strtotime($rowselect[0]['podate'])))?></td>
						  <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['dispatch']?></td>
						  <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['deliverymethod']?></td>
						  <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['destination']?></td>
						  <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['deliveryremarks']?></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td rowspan="2" width="50%"> <b>Consignee (Ship to)</b> 
						  <?php
						  $consigneedetails=$rowselect[0]['consigneemainid'];
						  $sqlselectsup = "SELECT consigneename,address1,address2,area,district,pincode,mobile,gstno From jrcconsignee where id='".$consigneedetails."' order by id asc";
						  $queryselectsup = mysqli_query($connection, $sqlselectsup);
					      $rowselectsup = mysqli_fetch_array($queryselectsup);
						  $rowCountsup=mysqli_num_rows($queryselectsup);
						  ?>
						  
						  <?php
						  if($rowCountsup >0) { ?><p style="margin-left:20px;"><strong><?=$rowselectsup['consigneename']?></strong><br><?php if($rowselectsup['address1']!="") { echo $rowselectsup['address1']; echo ','; }?>
						  <br><?php if($rowselectsup['address2']!="") { echo $rowselectsup['address2']; echo ','; }?><?php if($rowselectsup['area']!="") { echo $rowselectsup['area']; echo ','; }?><br><?php if($rowselectsup['district']!="") { echo $rowselectsup['district'];  }?><?php if($rowselectsup['pincode']!="") { echo '-'; echo $rowselectsup['pincode']; }?> <br><?=$rowselectsup['mobile']?><br>
						  <b>State Code:</b> <?=($rowselectsup['gstno']!='')?substr($rowselectsup['gstno'],0,2):''?><br>
						  <b>GSTIN:</b> <?=$rowselectsup['gstno']?>
						  </p><?php } ?>
						  <?php
						  $buyerdetails=$rowselect[0]['buyermainid'];
						  $sqlselectsup1 = "SELECT consigneename,address1,address2,area,district,pincode,mobile,gstno From jrcconsignee where id='".$buyerdetails."' order by id asc";
						  $queryselectsup1 = mysqli_query($connection, $sqlselectsup1);
						  $rowselectsup1 = mysqli_fetch_array($queryselectsup1);
						  $rowCountsup1=mysqli_num_rows($queryselectsup1);
						  ?>
						  <td align="left"> <b>Buyer (Bill to)</b>
						  <?php
						  if($rowCountsup1 >0) { ?><p style="margin-left:20px;"><strong><?=$rowselectsup1['consigneename']?></strong><br><?php if($rowselectsup1['address1']!="") { echo $rowselectsup1['address1']; echo ','; }?>
						  <br><?php if($rowselectsup1['address2']!="") { echo $rowselectsup1['address2']; echo ','; }?><?php if($rowselectsup1['area']!="") { echo $rowselectsup1['area']; echo ','; }?><br><?php if($rowselectsup1['district']!="") { echo $rowselectsup1['district'];  }?><?php if($rowselectsup1['pincode']!="") { echo '-'; echo $rowselectsup1['pincode']; }?> <br><?=$rowselectsup1['mobile']?><br>
						  <b>State Code:</b> <?=($rowselectsup1['gstno']!='')?substr($rowselectsup1['gstno'],0,2):''?><br>
						  <b>GSTIN:</b> <?=$rowselectsup1['gstno']?>
						  </p><?php } ?></b></td>
						  </tr>
					     
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <th style="text-align:center; padding:10px;">S.NO</th>
						  <th style="text-align:center">DESCRIPTION OF GOODS</th>
						  <th style="text-align:center">HSN/SAC</th>
						  <th style="text-align:center">QTY</th>
						  <th style="text-align:center">Rate</th>
						  <th style="text-align:center">per</th>
						  <th style="text-align:center">Discount</th>
						  <th style="text-align:center">Amount</th>
						  </tr>
						  <?php
						  $i=0;
						  foreach($rowselect as $row1)
						  {

					 ?><tr>
						  <td style="text-align:center; vertical-align:top; height:200px;"><?=$i+1?></td>
						  <td style="text-align:left; vertical-align:top;">
						  <b><?=$row1['stockname']?></b> <br>
						  <i><font size="-1">Make:<?=$row1['make']?> &nbsp; Capacity:<?=$row1['capacity']?> &nbsp;Warranty:<?=$row1['warranty']?>M<br>Sl No:<?=$row1['serialnumber']?></font></i>
						  </td>
						  <td style="text-align:center; vertical-align:top;"><?=$row1['hsncode']?></td>
						  <td style="text-align:right; vertical-align:top;"><?=$row1['qty']?>.000 Nos</td>
						  <td style="text-align:right; vertical-align:top;"><?=$row1['rate']?></td>
						  <td style="text-align:right; vertical-align:top;">nos</td>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['discount']!="") { echo "".$row1['discount']."%";  }else {echo '0%';}?></td>
						  <td style="text-align:right; vertical-align:top;"><?=$row1['pretotalamount']?></td>
						  <?php
						  $i++;
						  }
						  ?>
						  </tr>
						   <tr>
						  <td></td>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['igstamount']!='') {?><b>OUTPUT IGST</b> <?php }else {?> <b>OUTPUT CGST</b> <br> <b>OUTPUT SGST</b><?php }?></td>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
						  <?php
						  $qty=$row1['totalgstamount'];
						  $sqty=$row1['totalgstamount']/2;
						  ?>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['igstamount']!='') { echo $row1['totalgstamount']; }else { echo $sqty; ?><br><?php echo $sqty; }?></td>
						  </tr>
						  <tr>
						  <td></td>
						  <td style="text-align:right;"><b>Total</br></td>
						  <td></td>
						   <td style="text-align:right; vertical-align:top;"><b><?=$row1['totalqty']?>.000 Nos</b></td>
						   <td></td>
						   <td></td>
						   <td></td>
						   <td style="text-align:right; vertical-align:top;"><b>RS <?=$row1['netamount']?></b></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td>
						  <span class="float-left"><i>Amount Chargeable (in words)</i></span></br>
						  <b><?=ucwords(getIndianCurrency((float)$row1['netamount']))?></b>
						   </td>
						   <td colspan="5">
						  <span class="float-right"><i>E. & O.E</i></span>
						  </td>
						  
						 
						  </tr>
						<table border="1" style="border:1px solid #eeeeee">
    <tr align="center" >
        <th style="padding:2.5px;" rowspan="2">Taxable Value</th>
		<?php if($row1['igstamount']!='') 
		{
			?>
        <th style="padding:2.5px;" colspan="2">International tax</th>
		<?php
		}
		else
		{
		?>
        <th style="padding:2.5px;" colspan="2">Central Tax</th>
        <th style="padding:2.5px;" colspan="2">State Tax</th>
		<th style="padding:2.5px;" rowspan="2">Total Tax Amount</th>
		<?php
		}
		?>
    </tr>
    <tr>
        <th style="text-align:center;">Rate</th>
        <th style="text-align:center;">Amount</th>
		<?php
		if($row1['igstamount']=='') 
	    {
		?>
        <th style="text-align:center;">Rate</th>
        <th style="text-align:center;">Amount</th>
		<?php
		}
		?>
    </tr>
						  <?php
						  foreach($rowselect as $row1)
						  {
							  ?>
							  <tr>
							 <td style="text-align:right; vertical-align:top;"><?=$row1['pretotalamount']?></td> 
							 
							 <?php if($row1['igstamount']!='') 
	                        	{
                              ?>
							 <td style="text-align:right; vertical-align:top;"><?=$row1['igstper']?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=$row1['igstamount']?></td> 
							 <?php
                              }
                             else
                              {
                              ?>
							 <td style="text-align:right; vertical-align:top;"><?=$row1['cgstper']?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=$row1['cgstamount']?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=$row1['sgstper']?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=$row1['sgstamount']?></td> 
							  <td style="text-align:right; vertical-align:top;"><?=$row1['gstamount']?></td>
							 <?php
                              }
                              ?>
						   </tr>
						 <?php
						  }
						  ?>
						  <tr>
						  <td style="text-align:right;"><b>Total:&nbsp;<?=$row1['subtotalamount']?></td>
						  <td></td>
						  <?php 
						  if($row1['igstamount']=='') 
	                       {
						  $ctax=$row1['totalgstamount'];
						  $cgst=$ctax/2;
						  ?>
						  <td style="text-align:right;"><b><?=$cgst?></td>
						  <td></td>
						  <td style="text-align:right;"><b><?=$cgst?></td>
						  <?php
						   }
						   ?>
						  <td style="text-align:right;"><b><?=$row1['totalgstamount']?></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td>
						  <span class="float-left"><i>Tax Amount (in words) :</i></span>
						  <b><?=ucwords(getIndianCurrency((float)$row1['totalgstamount']))?></b>
						   </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td align="left" width="33%" style="vertical-align:bottom">
						  Company's PAN: <b><?=$_SESSION['companypanno']?></b><br>
						   Received in Good Condition
						 </td>
						  <td align="center" width="33%" style="vertical-align:bottom"><b><font size="-1">for <?=$_SESSION['companyname']?></font></b>
						  <br>
						  <img src="<?=$_SESSION['companyauthsign']?>">
						  <img width="100" src="<?=$_SESSION['companyseal']?>">
						  <br>
						  <b>AUTHORISED SIGNATORY</b>
						  </td>
						  </tr>
						  <tr>
						  <td colspan="3" align="center"><font size="-1">SUBJECT TO TRICHY JURISDICTION<BR>This is a Computer Generated Document</font></td>
						  </tr>
						  </table>	
					  	  
					<?php
					$count++;
			}
		}
 		
			?>
  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
</body>
</html>
