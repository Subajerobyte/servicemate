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
  <title><?=$_SESSION['companyname']?> - Invoice Print - <?=$_GET['id']?></title>
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
	font-size: 16px;
}
.heading
{
	font-family: Arial Black,Arial,Gadget,sans-serif; 
	font-size: 16px;
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
<body>
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
	
	  $sqlselect = "SELECT * From jrctally where sono='".$sono."'";
		
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
					 <div id="printContent">	
					 <table border="0" style="border:1px solid #8c8c8c">
						  <tr>
    <td  align="center"><p class="heading" style="font-size:24px; padding:1px;">TAX INVOICE</p></td>

    <td  align="center">
        <!-- Add your text here -->
        <p><b>e-invoice</b></p>
    </td>
</tr>

						  
						  <tr>
						  <td rowspan="2" width="90%"><p>
						<?php if($rowselect[0]['irn']!=''){?>IRN:<b> <?=$rowselect[0]['irn']?></b> &nbsp;<?php } ?><br>
						  <?php if($rowselect[0]['acknowledgmentno']!=''){?>ACK NO:<b> <?=$rowselect[0]['acknowledgmentno']?></b> &nbsp;<?php } ?><br>
						  <?php if($rowselect[0]['acknowledgmentdate']!=''){?>ACK DATE:<b> <?=date('d-m-Y',strtotime($rowselect[0]['acknowledgmentdate']))?></b> &nbsp;<?php } ?>
						  </p></td>
						  
						  <td align="left"> 
						   <div style="width: 144px; height: 144px;"><div id="qrcode"></div></div><br></td>
							</tr>
						  </table>
					 <table style="border:1px solid #8c8c8c">
						  <tr>
						  <td colspan="12"><p class="heading" style="font-size:31px;" align="center"><img src="<?=$_SESSION['companylogo']?>" width="160" style="padding-right: 20px;"> <?=$_SESSION['companyname']?></p>
						  </td>
						  </tr>
						  <tr>
						  <?php
						  $state = explode(" - ", $_SESSION['companystatecode']);
							if (count($state) == 3) {
								$beforeDash = $state[0]; 
								$afterDash = $state[1];
								$afterDash1 = $state[2];
							}
							else
							{
								$afterDash1 = $_SESSION['companystatecode'];
							}								
							?>
						  <td colspan="3" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?>, <?=$afterDash1?></td>
						  </tr>
						  <tr>
						  <td>E-mail: <?=$_SESSION['companyemail']?></td>
						  <td align="center">Mobile: <?=$_SESSION['companymobile']?></td>
						  <td align="right">GSTIN: <?=$_SESSION['companygstno']?></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <th style="text-align:center; padding:2px;">Invoice No.</th>
						  <th style="text-align:center; padding:2px;">Dated</th>
						  <th style="text-align:center; padding:2px;">Delivery Note No.</th>
						  <th style="text-align:center; padding:2px;">Dated</th>
						  </tr>
						  <tr>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=$rowselect[0]['invoiceno']?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?php if($rowselect[0]['invoicedate1']!=''){ echo date('d-m-Y',strtotime($rowselect[0]['invoicedate1']));}?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=$rowselect[0]['dcno']?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?php if($rowselect[0]['dcdate']!=''){ echo date('d-m-Y',strtotime($rowselect[0]['dcdate']));}?></td>
						  </tr> 
						  <tr>
						  <th style="text-align:center; padding:2px;">Reference No. & Date.</th>
						  <th style="text-align:center; padding:2px;">Other References</th>
						   <th style="text-align:center; padding:2px;">Buyer’s Order No.</th>
						  <th style="text-align:center; padding:2px;">Dated</th>
						  </tr>
						  <tr>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=(($rowselect[0]['pono']!='') && ($rowselect[0]['podate']!=''))?$rowselect[0]['pono'].' & '.(date('d-m-Y',strtotime($rowselect[0]['podate']))):(($rowselect[0]['pono']!='')?$rowselect[0]['pono']:(date('d-m-Y',strtotime($rowselect[0]['podate']))))?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=$rowselect[0]['otherreference']?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=$rowselect[0]['pono']?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=date('d-m-Y',strtotime($rowselect[0]['podate']))?></td>
						  </tr>
						  
						  <tr>
						  <th style="text-align:center; padding:2px;">Dispatch Doc No.</th>
						  <th style="text-align:center; padding:2px;">Dispatched through</th>
						  <th style="text-align:center; padding:2px;">Terms of Delivery</th>
						  <th style="text-align:center; padding:2px;">Destination</th>
						  </tr>
						  <tr>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=$rowselect[0]['dispatchdocno']?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=$rowselect[0]['disthrough']?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px; font-size:17px;"><?=(($rowselect[0]['pono']!='') && ($rowselect[0]['podate']!=''))?$rowselect[0]['pono'].' & '.(date('d-m-Y',strtotime($rowselect[0]['podate']))):(($rowselect[0]['pono']!='')?$rowselect[0]['pono']:(date('d-m-Y',strtotime($rowselect[0]['podate']))))?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;">Con :-<strong style="font-size: larger;"><?=$rowselect[0]['consigneeno']?></strong></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td rowspan="2" width="50%"> <b>Consignee (Ship to)</b> 
						 <p style="margin-left:20px;"><strong><?=$rowselect[0]['consigneename']?></strong><br><?php if($rowselect[0]['conaddress1']!='') { echo $rowselect[0]['conaddress1'];}?> <?php if($rowselect[0]['conaddress2']!=''){ echo $rowselect[0]['conaddress2'];}?> <?php if($rowselect[0]['conaddress3']!=''){echo $rowselect[0]['conaddress3'];}?><?if($rowselect[0]['contaluk']!=''){echo $rowselect[0]['contaluk'].'&nbsp;';}?><?php if($rowselect[0]['condistrict']!=''){ echo $rowselect[0]['condistrict'].' - ';}?><?php if($rowselect[0]['conpincode']!=''){ echo $rowselect[0]['conpincode'];}?><?php ?><br>
						  <b><?php if($rowselect[0]['congstno']!=''){?>GSTIN:</b> <?php  if($rowselect[0]['congstno']!='') {echo $rowselect[0]['congstno']; if($rowselect[0]['conmobile']!=''){ echo ', Mobile : ' .$rowselect[0]['conmobile'];}} else {echo 'Unregistered'; if($rowselect[0]['constatecode']!=''){?>Code / State Name:</b> <?=$rowselect[0]['constatecode']?> &nbsp;<?php if($rowselect[0]['conmobile']!=''){ echo ', Mobile : ' .$rowselect[0]['conmobile'];} }} } ?>
						  </p></td>
						 
						  <td align="left"> <b>Buyer (Bill to)</b>
						   <p style="margin-left:20px;"><strong><?=$rowselect[0]['buyername']?></strong><br><?php if($rowselect[0]['buyeraddress1']!=''){ echo $rowselect[0]['buyeraddress1'];}?> <?php if($rowselect[0]['buyeraddress2']!=''){ echo $rowselect[0]['buyeraddress2'];}?> <?php if($rowselect[0]['buyeraddress3']!=''){ echo $rowselect[0]['buyeraddress3'];}?><?php if($rowselect[0]['buyertaluk']!=''){echo $rowselect[0]['buyertaluk'].'&nbsp;';}?><?php if($rowselect[0]['buyerdistrict']!=''){ echo $rowselect[0]['buyerdistrict'].' - ';}?><?php if($rowselect[0]['buyerpincode']!=''){ echo $rowselect[0]['buyerpincode'];}?><br>
						  <b><?php if($rowselect[0]['bgst']!=''){?>GSTIN:</b> <?php  if($rowselect[0]['bgst']!='') {echo $rowselect[0]['bgst']; if($rowselect[0]['buyermobile']!=''){ echo ', Mobile : ' . $rowselect[0]['buyermobile'];}} else {echo 'Unregistered';  if($rowselect[0]['buyerstate']!=''){?>Code / State Name:</b> <?=$rowselect[0]['buyerstate']?> &nbsp;<?php  if($rowselect[0]['buyermobile']!=''){ echo ', Mobile : ' . $rowselect[0]['buyermobile'];} }}} ?>
						  </p></b></td>
						  </tr>
					     
						  </table>
						  <?php
						 $allZero = true;
						foreach($rowselect as $row1){
							if($row1['discountamount'] != 0){
								$allZero = false;
								break;
							}
						}
						 ?>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <th style="text-align:center; padding:10px;">S.NO</th>
						  <th style="text-align:center">DESCRIPTION OF GOODS</th>
						  <th style="text-align:center">HSN/SAC</th>
						  <th style="text-align:center">Quantity</th>
						  <th style="text-align:center">Rate</th>
						  <!--th style="text-align:center">Per</th-->
						  <?php
						  if(!$allZero) 
						  {
						  ?>
						  <th style="text-align:center">Discount <br>% / ₹</th>
						  <th style="text-align:center">Discount Amount</th>
						  <?php
						  }
						  ?>
						  <th style="text-align:center">Amount</th>
						  </tr>
						  <?php
						  $i=0;
						  $total=0;
						  foreach($rowselect as $row1)
						  {
							$parts = explode(" - ", $row1['conper']);
							if (count($parts) == 2) {
								$beforeDash = $parts[0]; 
								$afterDash = $parts[1];
							} else {
								$beforeDash = $row1['conper']; 
							}
                          ?><tr>
						  <td style="text-align:center; vertical-align:top; height:50px;"><?=$i+1?></td>
						  <td style="text-align:left; vertical-align:top;">
						  
<b>
<?php 
if($row1['conproductcode']!='' && $row1['conproduct']==''){ 
echo $row1['conproductcode']; } 
if($row1['conproductcode']=='' && $row1['conproduct']!=''){ 
echo $row1['conproduct']; } 
if($row1['conproductcode']!='' && $row1['conproduct']!=''){ 
echo $row1['conproductcode'];  ?> - <?php echo $row1['conproduct']; }?>
				
				
<?php if($row1['conmake']!='' && $row1['conpromodel']==''){ ?> 
   ( Make:<?= $row1['conmake'];?> ) 
<?php } if($row1['conmake']=='' && $row1['conpromodel']!=''){ ?> 
    ( Model:<?= $row1['conpromodel'];?> ) 
<?php } if($row1['conmake']!='' && $row1['conpromodel']!=''){ ?> 
   ( Make:<?= $row1['conmake'];?> & Model:<?= $row1['conpromodel'];?> ) 
<?php }?> 
</b>
 
<br>
 
<i><font size="-1">
<?php 
if($row1['componenttype']!='' && $row1['componentname']==''){ 
echo $row1['componenttype']; ?>&nbsp;<?php } 
if($row1['componenttype']=='' && $row1['componentname']!=''){ 
echo $row1['componentname']; ?>&nbsp;<?php } 
if($row1['componenttype']!='' && $row1['componentname']!=''){ 
echo $row1['componenttype'];?> - <?=$row1['componentname']; ?>&nbsp;<?php } 

if($row1['conmake']!=''){ ?> Make:<?=$row1['conmake']?>&nbsp;<?php } 
if($row1['concapacity']!=''){ ?> Capacity:<?=$row1['concapacity']?>&nbsp;<?php } 
if($row1['conwarranty']!=''){ ?> Warranty:<?=$row1['conwarranty']?>&nbsp;<?php } 
if($row1['conqty']!=''){ ?> Qty:<?=$row1['conqty']?>&nbsp;<?php }  
?>  
<?php   
           if ($row1['conqty'] < 16) {
			   echo '<br>';
			   echo 'Sl No:</font></i>';
		   if($row1['conserialno']!='') { 
		   $string =  $row1['conserialno'];
		   $items = explode(' | ', $string);
		   foreach ($items as $key => $value) {
		   echo ($key + 1) . ") $value" . ($key < count($items) - 1 ? ',' : '') . "\n";
		   }}}?></td>
						  
						  
						  <td style="text-align:center; vertical-align:top;"><?=$row1['conhsncode']?></td>
						  <td style="text-align:right; vertical-align:top;"><?=$row1['conqty']?> <?=$beforeDash?></td>
						  <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$row1['conunit']),2,'.',',')?></td>
						  <!--td style="text-align:right; vertical-align:top;"><?=$beforeDash?></td-->
						  <?php $producttotal=$row1['conqty']*$row1['conunit']-$row1['discountamount']; $total +=$producttotal;?>
						  <?php
						  if(!$allZero) 
						  {
						  ?>
						  <td style="text-align:right; vertical-align:top;"><?=$row1['discount']?> <?php if($row1['discountamount']!='0'){ if($row1['discountmode']=='percentage') { echo '%';} else { echo '₹';}}?></td>
						  <td style="text-align:right; vertical-align:top;"><?=$row1['discountamount']?></td>
						  <?php
						  }
						  ?>
						  <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$producttotal),2,'.',',')?></td>
						  </tr>
						  <?php
						  $i++;
						  }
						  ?>
						  <tr>
						  <td></td>
						  <td style="text-align:right;"><b>Sub Total</br></td>
						  <?php
						  if(!$allZero) 
						  {
						  ?>
						  <td></td>
						  <td></td>
						  <?php
						  }
						  ?>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$total),2,'.',',')?></td>
						  </tr>
						   <tr>
						  <td></td>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['conigst']!='') {?><?php if($rowselect[0]['addamount']!=''){ ?> <b>Rounded Off</b>(<?php echo $rowselect[0]['ichargeremark']?>)<?php }}else { ?><?php if($rowselect[0]['addamount']!=''){ ?> <b>Rounded Off</b>  (<?php echo $rowselect[0]['ichargeremark']?>)<?php }}?></td>
						  <?php
						  if(!$allZero) 
						  {
						  ?>
						  <td></td>
						  <td></td>
						  <?php
						  }
						  ?>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['conigst']!='') {?><?php if($rowselect[0]['addamount']!=''){ ?><br><?php echo number_format(((float)$rowselect[0]['addamount']), 2, '.', ',') ; }}else {?><?php if($rowselect[0]['addamount']!=''){ ?><?php echo '(+)'.number_format(((float)$rowselect[0]['addamount']), 2, '.', ',') ; }}?></td>
						  </tr>
						  <tr>
						  <td></td>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['conigst']!='') {?><b>OUTPUT IGST</b><?php }else { ?><b>TOTAL OUTPUT CGST</b> <br> <b>TOTAL OUTPUT SGST</b><?php }?></td>
						  <?php
						  if(!$allZero) 
						  {
						  ?>
						  <td></td>
						  <td></td>
						  <?php
						  }
						  ?>
						  <td></td>
						  <td></td>
						  <td></td>
						   <?php
						  $sqlselect1 = "SELECT SUM(concgstamount) AS total_cgst FROM jrctally WHERE sono='".$sono."'";
						   $queryselect1 = mysqli_query($connection, $sqlselect1);
						   $rowCountselect1 = mysqli_num_rows($queryselect1);
						   if(!$queryselect1){
						   die("SQL query failed: " . mysqli_error($connection));
						   }
						   if($rowCountselect1 > 0) 
	                      {
							  $row3 = mysqli_fetch_assoc($queryselect1);
							  $totalcgst=$row3['total_cgst'];
						  }
						  ?>
						  <?php
						  $sqlselect2 = "SELECT SUM(conigstamount) AS total_igst FROM jrctally WHERE sono='".$sono."'";
						   $queryselect2 = mysqli_query($connection, $sqlselect2);
						   $rowCountselect2 = mysqli_num_rows($queryselect2);
						   if(!$queryselect2){
						   die("SQL query failed: " . mysqli_error($connection));
						   }
						   if($rowCountselect2 > 0) 
	                      {
							  $row4 = mysqli_fetch_assoc($queryselect2);
							  $totaligst=$row4['total_igst'];
						  }
						  ?>
						  <?php
						  $sqlselect3 = "SELECT SUM(consgstamount) AS total_sgst FROM jrctally WHERE sono='".$sono."'";
						   $queryselect3 = mysqli_query($connection, $sqlselect3);
						   $rowCountselect3 = mysqli_num_rows($queryselect3);
						   if(!$queryselect3){
						   die("SQL query failed: " . mysqli_error($connection));
						   }
						   if($rowCountselect3 > 0) 
	                      {
							  $row5 = mysqli_fetch_assoc($queryselect3);
							  $totalsgst=$row5['total_sgst'];
						  }
						  ?>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['conigst']!='') { echo number_format(((float)$totaligst),2,'.',','); }else { echo number_format(((float)$totalcgst),2,'.',','); ?><br><?php echo number_format(((float)$totalsgst),2,'.',','); }?></td>
						  </tr>
						  <tr>
						  <td></td>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['conigst']!='') {?><?php if($rowselect[0]['buyback']!=''){ ?> <b>Buyback</b><?php } }else { ?><?php if($rowselect[0]['buyback']!=''){?> <b>Buyback</b> (<?php echo $rowselect[0]['buyremark']?>) <br> <?php }}?></td>
						  <?php
						  if(!$allZero) 
						  {
						  ?>
						  <td></td>
						  <td></td>
						  <?php
						  }
						  ?>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td style="text-align:right; vertical-align:top;"><?php if($row1['conigst']!='') {?><?php if($rowselect[0]['buyback']!=''){ ?><br><?php echo '(-)' . number_format(((float)$rowselect[0]['buyback']), 2, '.', ',') ;?><?php }}else {?><?php if($rowselect[0]['buyback']!=''){ ?><?php echo '(-)' . number_format(((float)$rowselect[0]['buyback']), 2, '.', ',') ;?><?php }}?></td>
						  </tr>
						 
						  <tr>
						  <td></td>
						  <td style="text-align:right; font-size:20px;"><b>Total</br></td>
						  <td></td>
						  <?php
						  $sqlselect = "SELECT SUM(conqty) AS total_conqty FROM jrctally WHERE sono='".$sono."'";
						   $queryselect = mysqli_query($connection, $sqlselect);
						   $rowCountselect = mysqli_num_rows($queryselect);
						   if(!$queryselect){
						   die("SQL query failed: " . mysqli_error($connection));
						   }
						   if($rowCountselect > 0) 
	                      {
							  $row2 = mysqli_fetch_assoc($queryselect);
							  $totalqty=$row2['total_conqty'];
						  }
						  ?>
						   <td style="text-align:right; vertical-align:top;"><b><?=$totalqty?> Nos</b></td>
						  <?php
						  if(!$allZero) 
						  {
						  ?>
						   <td></td>
						   <td></td>
						   <?php
						  }
						   ?>
						   <td></td>
						   <?php
						   if($rowselect[0]['addamount']=='')
						   {
							   $rowselect[0]['addamount']='0';
						   }
						   if($rowselect[0]['buyback']=='')
						   {
							   $rowselect[0]['buyback']='0';
						   }
						   if($row1['conigst']!='') 
						   {
							   $gtotal=$total+$totaligst+$rowselect[0]['addamount']-$rowselect[0]['buyback'];
						   }
						   else
						   {
							   $gtotal=$total+$totalcgst+$totalsgst+$rowselect[0]['addamount']-$rowselect[0]['buyback'];
						   }
						   ?>
						   <td style="text-align:right; vertical-align:top;"><b>Rs <?=number_format(((float)$gtotal),2,'.',',')?></b></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td>
						  <span class="float-left"><i>Amount Chargeable (in words) : </i><b><?=ucwords(getIndianCurrency((float)$gtotal))?> Only</b></span></br>
						   </td>
						   <td colspan="5">
						  <span class="float-right"><i>E. & O.E</i></span>
						  </td>
						  
						 
						  </tr>
						<table border="1" style="border:1px solid #8c8c8c">
    <tr align="center" >
        <th style="padding:2.5px;" rowspan="2">Taxable Value</th>
		<?php if($row1['conigst']!='') 
		{
			?>
        <th style="padding:2.5px;" colspan="2">Integrated tax</th>
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
		if($row1['conigst']=='') 
	    {
		?>
        <th style="text-align:center;">Rate</th>
        <th style="text-align:center;">Amount</th>
		<?php
		}
		?>
    </tr>
								 <?php
$taxtotal = 0;
$taxctotal = 0;
$taxstotal = 0;
$taxgstamount = 0;

// Initialize arrays to accumulate totals for different GST rates
$gst_totals = [];

foreach ($rowselect as $row1) {
    $producttotal = $row1['conqty'] * $row1['conunit'] - $row1['discountamount'];

    // For handling IGST case
    if ($row1['conigst'] != '') {
        $gst_rate = $row1['conigst'];
        $gst_amount = $row1['conigstamount'];

        // Accumulate totals for IGST rates
        if (!isset($gst_totals[$gst_rate])) {
            $gst_totals[$gst_rate] = [
                'taxable' => 0,
                'central_tax' => 0,
                'state_tax' => 0,
                'total_tax' => 0
            ];
        }
        $gst_totals[$gst_rate]['taxable'] += $producttotal;
        $gst_totals[$gst_rate]['total_tax'] += $gst_amount;

        $taxtotal += $producttotal;
        $taxgstamount += $gst_amount;
    } else {
        // For handling CGST + SGST case
        $central_rate = $row1['concgst'];
        $state_rate = $row1['consgst'];

        $central_amount = $row1['concgstamount'];
        $state_amount = $row1['consgstamount'];
        $total_tax = $central_amount + $state_amount;

        // Accumulate totals for CGST + SGST rates
        if (!isset($gst_totals[$central_rate])) {
            $gst_totals[$central_rate] = [
                'taxable' => 0,
                'central_tax' => 0,
                'state_tax' => 0,
                'total_tax' => 0
            ];
        }

        // Accumulate CGST, SGST, and taxable value
        $gst_totals[$central_rate]['taxable'] += $producttotal;
        $gst_totals[$central_rate]['central_tax'] += $central_amount;
        $gst_totals[$central_rate]['state_tax'] += $state_amount;
        $gst_totals[$central_rate]['total_tax'] += $total_tax;

        $taxtotal += $producttotal;
        $taxctotal += $central_amount;
        $taxstotal += $state_amount;
        $taxgstamount = $taxctotal + $taxstotal;
    }
}
?>

<!-- Table Header -->


<!-- Loop through GST rate totals and display -->
<?php foreach ($gst_totals as $rate => $totals) { ?>
    <tr>
        <td style="text-align:right;"><?php echo number_format($totals['taxable'], 2, '.', ','); ?></td>
        <td style="text-align:right;"><?=$rate?>%</td>
        <td style="text-align:right;"><?php echo number_format($totals['central_tax'], 2, '.', ','); ?></td>
        <td style="text-align:right;"><?=$rate?>%</td>
        <td style="text-align:right;"><?php echo number_format($totals['state_tax'], 2, '.', ','); ?></td>
        <td style="text-align:right;"><?php echo number_format($totals['total_tax'], 2, '.', ','); ?></td>
    </tr>
<?php } ?>
<tr>
    <td style="text-align:right;"><b>Total:&nbsp;<?php echo number_format($taxtotal, 2, '.', ','); ?></b></td>
    <td></td>
    <?php if ($row1['conigst'] == '') { ?>
        <td style="text-align:right;"><b><?php echo number_format($taxctotal, 2, '.', ','); ?></b></td>
        <td></td>
        <td style="text-align:right;"><b><?php echo number_format($taxstotal, 2, '.', ','); ?></b></td>
    <?php } ?>
    <td style="text-align:right;"><b><?php echo number_format($taxgstamount, 2, '.', ','); ?></b></td>
</tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td>
						  <span class="float-left"><i>Tax Amount (in words) : </i><b><?=ucwords(getIndianCurrency((float)$taxgstamount))?> only</b></span>
						   </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td align="left">
						  Remarks:  <b><?=$rowselect[0]['buyername'].'&nbsp&nbsp;'?></b><?php if($rowselect[0]['conaddress1']!='') { echo $rowselect[0]['conaddress1'].'&nbsp;';}?> <?php if($rowselect[0]['conaddress2']!=''){ echo $rowselect[0]['conaddress2'].'&nbsp;';}?> <?php if($rowselect[0]['conaddress3']!=''){ echo $rowselect[0]['conaddress3'].'&nbsp;';}?> <?php if($rowselect[0]['contaluk']!=''){echo $rowselect[0]['contaluk'].'&nbsp;';}?><?php if($rowselect[0]['condistrict']!=''){ echo $rowselect[0]['condistrict'];}?>
						  <br>
						  Company's PAN: <?=$_SESSION['companypanno']?> 
						  </td>
						 </tr>
						 </table>
						 <table border="1" style="border:1px solid #8c8c8c">
  <tr>
    <td align="left" width="33%" style="vertical-align:bottom">
      <font size="-1">
        <table width="100%">
          <tr>
            <td style="vertical-align:top;">
              <b>Company's Bank Details</b><br>
              Bank Name:<?=$_SESSION['companybankname']?><br>
              A/c No:<?=$_SESSION['companyacno']?><br>
              IFS Code:<?=$_SESSION['companyifscode']?><br>
              Branch:<?=$_SESSION['companybranchname']?><br><br>
            </td>
            <td style="vertical-align:center; text-align:right;">
              <img width="100" src="<?=$_SESSION['companyqrcode']?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <b>Declaration</b><br>
              We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
            </td>
          </tr>
        </table>
      </font>
    </td>
	 <td align="center" width="33%" style="vertical-align:bottom">
						  <br>
						  
						  <br>
						  <b>CUSTOMER AUTHORISED SIGNATORY</b>
						  </td>
    <td align="center" width="33%" style="vertical-align:bottom">
      <b><font size="-1">for <?=$_SESSION['companyname']?></font></b>
      <br>
      <img src="../img/sealsign.png" height="120">
      <br>
      <b>AUTHORISED SIGNATORY</b>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center">
      <font size="-1">SUBJECT TO TRICHY JURISDICTION. (This is a Computer Generated Document.)</font>
    </td>
  </tr>
</table>
						  <?PHP
						  if ($row1['conqty'] > 16) { ?>
						  <table class="keerthiga" style="page-break-before:always;">
                          <table style="border:1px solid #8c8c8c">
						  <tr>
						  <td colspan="3">
						  <p class="heading" style="font-size:31px;" align="center"><img src="<?=$_SESSION['companylogo']?>" width="160" style="padding-right: 20px;"> <?=$_SESSION['companyname']?></p>
						  </td>
						  </tr>
						  <tr>
						  <?php
						  $state = explode(" - ", $_SESSION['companystatecode']);
							if (count($state) == 3) {
								$beforeDash = $state[0]; 
								$afterDash = $state[1];
								$afterDash1 = $state[2];
							}
							else
							{
								$afterDash1 = $_SESSION['companystatecode'];
							}								
							?>
						  <td colspan="3" align="center"><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> <?=$_SESSION['companypincode']?>, <?=$afterDash1?></td>
						  </tr>
						  <tr>
						  <td>e.mail: <?=$_SESSION['companyemail']?></td>
						  <td align="center">Mobile: <?=$_SESSION['companymobile']?></td>
						  <td align="right">GSTIN: <?=$_SESSION['companygstno']?></td>
						  </tr>
						  </table>
						   
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td colspan="5" align="center"><p class="heading" style="font-size:24px; padding:1px;">TAX INVOICE</p></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <th style="text-align:center; padding:2px;">Invoice No.</th>
						  <th style="text-align:center; padding:2px;">Dated</th>
						  <th style="text-align:center; padding:2px;">Delivery Note No.</th>
						  <th style="text-align:center; padding:2px;">Dated</th>
						  </tr>
						  <tr>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?php $invoiceFour = substr($rowselect[0]['invoiceno'], -4); echo substr($rowselect[0]['invoiceno'], 0, -4) . '<strong style="font-size: larger;">' . $invoiceFour . '</strong>'; ?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?php if($rowselect[0]['invoicedate']!=''){ echo date('d-m-Y',strtotime($rowselect[0]['invoicedate']));}?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?php $dcFour = substr($rowselect[0]['dcno'], -4); echo substr($rowselect[0]['dcno'], 0, -4) . '<strong style="font-size: larger;">' . $dcFour . '</strong>'; ?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?php if($rowselect[0]['dcdate']!=''){ echo date('d-m-Y',strtotime($rowselect[0]['dcdate']));}?></td>
						  </tr> 
						  <tr>
						  <th style="text-align:center; padding:2px;">Reference No. & Date.</th>
						  <th style="text-align:center; padding:2px;">Other References</th>
						   <th style="text-align:center; padding:2px;">Buyer’s Order No.</th>
						  <th style="text-align:center; padding:2px;">Dated</th>
						  </tr>
						  <tr>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=(($rowselect[0]['pono']!='') && ($rowselect[0]['podate']!=''))?$rowselect[0]['pono'].'&'.(date('d-m-Y',strtotime($rowselect[0]['podate']))):(($rowselect[0]['pono']!='')?$rowselect[0]['pono']:(date('d-m-Y',strtotime($rowselect[0]['podate']))))?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=$rowselect[0]['otherreference']?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?php $lastFiveDigits = substr($rowselect[0]['pono'], 5); echo substr($rowselect[0]['pono'], 0, -5) . '<strong style="font-size: larger;">' . $lastFiveDigits . '</strong>'; ?></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"><?=date('d-m-Y',strtotime($rowselect[0]['podate']))?></td>
						  </tr>
						  
						  <tr>
						  <th style="text-align:center; padding:2px;">Dispatch Doc No.</th>
						  <th style="text-align:center; padding:2px;">Dispatched through</th>
						  <th style="text-align:center; padding:2px;">Destination</th>
						  <th style="text-align:center; padding:2px;">Terms of Delivery</th>
						  </tr>
						  <tr>
						  <td style="text-align:center; vertical-align:top; padding:2px;"></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;"></td>
						  <td style="text-align:center; vertical-align:top; padding:2px;">Con :-<strong style="font-size: larger;"><?=$rowselect[0]['consigneeno']?></strong></td>
						  <td style="text-align:center; vertical-align:top; padding:2px; font-size:17px;"><?=(($rowselect[0]['pono']!='') && ($rowselect[0]['podate']!=''))?$rowselect[0]['pono'].'&'.(date('d-m-Y',strtotime($rowselect[0]['podate']))):(($rowselect[0]['pono']!='')?$rowselect[0]['pono']:(date('d-m-Y',strtotime($rowselect[0]['podate']))))?></td>
						  </tr>
						  </table>
						    
 <?php
echo '<table border="1" style="border:1px solid #8c8c8c">';
echo '<tr><th style="text-align:center; padding:2px;">S.No</th><th style="text-align:center; padding:2px;">DESCRIPTION OF GOODS</th></tr>';
 
						  $i=0;
						  $total=0;
						  foreach($rowselect as $row1)
						  {
							  if ($row1['conqty'] > 16) { 
							$parts = explode(" - ", $row1['conper']);
							if (count($parts) == 2) {
								$beforeDash = $parts[0]; 
								$afterDash = $parts[1];
							} else {
								$beforeDash = $row1['conper']; 
							}
                          ?>
 

    <tr>
      <td style="text-align:center; vertical-align:top; height:50px;"><?= $i + 1 ?></td>
      <td style="text-align:left; vertical-align:top;">

        <b>
          <?php
          if ($row1['conproductcode'] != '' && $row1['conproduct'] == '') {
            echo $row1['conproductcode'];
          }
          if ($row1['conproductcode'] == '' && $row1['conproduct'] != '') {
            echo $row1['conproduct'];
          }
          if ($row1['conproductcode'] != '' && $row1['conproduct'] != '') {
            echo $row1['conproductcode'];  ?> - <?php echo $row1['conproduct'];
          } ?>
        </b>

        <br>

        <i><font size="-1">
            <?php
            if ($row1['componenttype'] != '' && $row1['componentname'] == '') {
              echo $row1['componenttype']; ?>&nbsp;<?php }
            if ($row1['componenttype'] == '' && $row1['componentname'] != '') {
              echo $row1['componentname']; ?>&nbsp;<?php }
            if ($row1['componenttype'] != '' && $row1['componentname'] != '') {
              echo $row1['componenttype']; ?> - <?= $row1['componentname']; ?>&nbsp;<?php }

            if ($row1['conmake'] != '') { ?> Make:<?= $row1['conmake'] ?>&nbsp;<?php }
            if ($row1['concapacity'] != '') { ?> Capacity:<?= $row1['concapacity'] ?>&nbsp;<?php }
            if ($row1['conwarranty'] != '') { ?> Warranty:<?= $row1['conwarranty'] ?>&nbsp;<?php }
            if ($row1['conqty'] != '') { ?> Qty:<?= $row1['conqty'] ?>&nbsp;<?php }  ?>
          </font></i>
        <?php 
          echo '<br>';
          echo 'Sl No:</font></i>';
          if ($row1['conserialno'] != '') {
            $string = $row1['conserialno'];
            $items = explode(' | ', $string);
            foreach ($items as $key => $value) {
              echo ($key + 1) . ") $value" . ($key < count($items) - 1 ? ',' : '') . "\n";
            }
          
        } ?>
      </td>
    </tr>
  <?php
						  }
   $i++;
						  }
   
echo '</table>';
echo '</table>';

}
?>
</div>
  
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


<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script>
        // Replace 'Your Text Here' with your actual text
        var textToEncode = "<?=$rowselect[0]['invoiceqr']?>";

        // Create QR code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: textToEncode,
            width: 144,
            height: 144
        });
    </script>
	<script>
    document.getElementById("printButton").addEventListener("click", function() {
        // Hide the print button before printing
        this.style.display = "none";

        // Print the content inside the printContent div
        window.print();

        // Show the print button after printing is done (optional)
        this.style.display = "block";
    });
</script>
</body>
</html>
