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
		<button id="printButton" style="background-color: #00B3BC; float: right;" class="btn btn-lg shadow-sm text-white">Print</button>
            <div id="printContent">
						   <table border="0" style="border:1px solid #8c8c8c">
						  <tr>
    <td  align="center"><p style="padding:5px;"></p></td>

    <td  align="center">
        <!-- Add your text here -->
        
    </td>
</tr>

						  <tr>
						  <td rowspan="2" width="90%"><p class="heading" style="font-size:24px; padding:1px;">
							<b>e-Way Bill</b>
						  </p></td>
						  
						  <td align="left"> 
						   <div style="width: 144px; height: 144px;"><div id="qrcode"></div></div><br></td>
							</tr>
						  </table>
					 <table style="border:1px solid #8c8c8c">
						  <tr>
						  <td colspan="12"><p><b>1.E-WAY BILL Details</b></p>
						  </td>
						  </tr>
						  </table>
						 
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td style="text-align:center; padding:2px;">eWay Bill No : <b><?=$rowselect[0]['ewbno']?><b></td>
						  <td style="text-align:center; padding:2px;">Generated Date : <b><?=$rowselect[0]['ewbdt']?><b></td>
						  <td style="text-align:center; padding:2px;">Generated By : <b><?=$_SESSION['companygstno']?><b></td>
						  </tr>
						  <tr>
						  <td style="text-align:center; padding:2px;">Valid Upto : <b><?=$rowselect[0]['ewbvalidtill']?><b></td>
						  <td style="text-align:center; padding:2px;">Approx Distance : <b><?=$rowselect[0]['edistance'].' Km'?><b></td>
						  <td style="text-align:center; padding:2px;">Mode : <b><?php if($rowselect[0]['deliverymethod']=='1'){ echo 'Road';} else if($rowselect[0]['deliverymethod']=='2'){ echo 'Rail';} else if($rowselect[0]['deliverymethod']=='3'){echo 'Air';} else if($rowselect[0]['deliverymethod']=='4'){echo 'Ship';}?><b></td>
						  </tr>
						  <tr>
						  <td style="text-align:center; padding:2px;">Type : <b>Outward - Supply<b></td>
						  <td style="text-align:center; padding:2px;">Document Details : <b><?=$rowselect[0]['edocumentno']?> - <?=$rowselect[0]['shipment']?><b></td>
						  <td style="text-align:center; padding:2px;">Transaction type : <b>Bill To - Ship To<b></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td colspan="12"><p><b>2.Address Details</b></p>
						  </td>
						  </tr>
						  <tr>
						  <td rowspan="2" width="50%"> <b>From</b> 
						 <p style="margin-left:20px;"><strong><?=$rowselect[0]['consigneename']?></strong><br><?php if($rowselect[0]['conaddress1']!='') { echo $rowselect[0]['conaddress1'].'<br>';}?> <?php if($rowselect[0]['conaddress2']!=''){ echo $rowselect[0]['conaddress2'].'<br>';}?> <?php if($rowselect[0]['conaddress3']!=''){echo $rowselect[0]['conaddress3'].'<br>';}?><?if($rowselect[0]['contaluk']!=''){echo $rowselect[0]['contaluk'].'&nbsp;';}?><?php if($rowselect[0]['condistrict']!=''){ echo $rowselect[0]['condistrict'].' - ';}?><?php if($rowselect[0]['conpincode']!=''){ echo $rowselect[0]['conpincode'].'<br>';}?><?php if($rowselect[0]['conmobile']!=''){ echo '<br>' .$rowselect[0]['conmobile'];}?><br>
						  <b><?php if($rowselect[0]['constatecode']!=''){?>State Name / Code:</b> <?=$rowselect[0]['constatecode']?> &nbsp;<?php } ?>
						  <b><?php if($rowselect[0]['congstno']!=''){?>GSTIN:</b> <?php  if($rowselect[0]['congstno']!='') {echo $rowselect[0]['congstno'];} else {echo 'Unregistered';} } ?>
						  </p></td>
						 
						  <td align="left"> <b>To</b>
						   <p style="margin-left:20px;"><strong><?=$rowselect[0]['buyername']?></strong><br><?php if($rowselect[0]['buyeraddress1']!=''){ echo $rowselect[0]['buyeraddress1'].'<br>';}?> <?php if($rowselect[0]['buyeraddress2']!=''){ echo $rowselect[0]['buyeraddress2'].'<br>';}?> <?php if($rowselect[0]['buyeraddress3']!=''){ echo $rowselect[0]['buyeraddress3'].'<br>';}?><?php if($rowselect[0]['buyertaluk']!=''){echo $rowselect[0]['buyertaluk'].'&nbsp;';}?><?php if($rowselect[0]['buyerdistrict']!=''){ echo $rowselect[0]['buyerdistrict'].' - ';}?><?php if($rowselect[0]['buyerpincode']!=''){ echo $rowselect[0]['buyerpincode'].'<br>';}?><?php if($rowselect[0]['buyermobile']!=''){ echo $rowselect[0]['buyermobile'];}?><br>
						  <b><?php if($rowselect[0]['buyerstate']!=''){?>State Name / Code:</b> <?=$rowselect[0]['buyerstate']?> &nbsp;<?php } ?>
						  <b><?php if($rowselect[0]['bgst']!=''){?>GSTIN:</b> <?php  if($rowselect[0]['bgst']!='') {echo $rowselect[0]['bgst'];} else {echo 'Unregistered';}} ?>
						  </p></b></td>
						  </tr>
					     
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td colspan="12"><p><b>3.Goods Details</b></p>
						  </td>
						  </tr>
						  <tr>
						   <th style="text-align:center">HSN Code</th>
						  <th style="text-align:center">Product Name & Desc</th>
						  <th style="text-align:center">Quantity</th>
						  <th style="text-align:center">Taxable Amount Rs.</th>
						  <th style="text-align:center">Tax Rate (C+S+I+Cess+Cess Non.Advol)</th>
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
						 <td style="text-align:center; vertical-align:top;"><?=$row1['conhsncode']?></td>
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
						  
						  
						  <td style="text-align:right; vertical-align:top;"><?=$row1['conqty']?> <?=$beforeDash?></td>
						  <?php $producttotal=$row1['conqty']*$row1['conunit']; $total +=$producttotal;?>
						  <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$producttotal),2,'.',',')?></td>
						  <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$row1['concgst']),3,'.',',')?>+<?=number_format(((float)$row1['consgst']),3,'.',',')?>+NE+0.000+0.00</td>
						  </tr>
						  <?php
						  $i++;
						  }
						  ?>
						  </table>
						  
						<table border="1" style="border:1px solid #8c8c8c">
    <tr align="center" >
        <th style="padding:2.5px;" rowspan="2">Tot.Tax'ble Amt</th>
		<th style="padding:2.5px;" rowspan="2">CGST Amt</th>
		<th style="padding:2.5px;" rowspan="2">SGST Amt</th>
		<th style="padding:2.5px;" rowspan="2">IGST Amt</th>
		<th style="padding:2.5px;" rowspan="2">CESS Amt</th>
		<th style="padding:2.5px;" rowspan="2">CESS Non.Advol Amt</th>
		<th style="padding:2.5px;" rowspan="2">Other Amt</th>
		<th style="padding:2.5px;" rowspan="2">Total Inv.Amt</th>
    </tr>
    <tr>
       
       
    </tr>
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
						  
							  <tr>
							<td style="text-align:right; vertical-align:top;"><?=number_format(((float)$total),2,'.',',')?></td>
							 <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$totalcgst),2,'.',',')?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$totalsgst),2,'.',',')?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$totaligst),2,'.',',')?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=number_format(((float)0),2,'.',',')?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=number_format(((float)0),2,'.',',')?></td> 
							 <td style="text-align:right; vertical-align:top;"><?=number_format(((float)0),2,'.',',')?></td> 
							 <?php
						   if($row1['conigst']!='') 
						   {
							   $gtotal=$total+$totaligst;
						   }
						   else
						   {
							   $gtotal=$total+$totalcgst+$totalsgst;
						   }
						   ?>
						   <td style="text-align:right; vertical-align:top;"><?=number_format(((float)$gtotal),2,'.',',')?></td>
														
						   </tr>
						 
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <tr>
						  <td colspan="12"><p><b>4.Transportation Details</b></p>
						  </td>
						  </tr>
						  <td>
						  Transporter ID & Name : <b><?=$row1['etransportid']?> & <?=$row1['agentname']?></b>
						   </td>
						   <td>
						  Transporter Doc. No & Date : <b><?=$row1['edocumentno']?> & <?=$row1['shipment']?></b>
						   </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #8c8c8c">
						   <tr>
						  <td colspan="12"><p><b>5.Vehicle Details</b></p>
						  </td>
						  </tr>
						   <tr>
						   <th style="text-align:center">Mode</th>
						  <th style="text-align:center">Vehicle/Trans Doc NO & DL</th>
						  <th style="text-align:center">From</th>
						  <th style="text-align:center">Entered Date</th>
						  <th style="text-align:center">Entered By</th>
						  <th style="text-align:center">CEWE No.(if any)</th>
						  <th style="text-align:center">Multi Veh.Info (if any)</th>
						  </tr>
						   <tr>
							 <td style="text-align:center; vertical-align:top;"><?php if($rowselect[0]['deliverymethod']=='1'){ echo 'Road';} else if($rowselect[0]['deliverymethod']=='2'){ echo 'Rail';} else if($rowselect[0]['deliverymethod']=='3'){echo 'Air';} else if($rowselect[0]['deliverymethod']=='4'){echo 'Ship';}?></td> 
							 <td style="text-align:center; vertical-align:top;"><?=$row1['vechileno']?></td> 
							 <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['condistrict']?></td> 
							 <td style="text-align:center; vertical-align:top;"><?=$rowselect[0]['ewbdt']?></td> 
							 <td style="text-align:center; vertical-align:top;"><?=$row1['etransportid']?></td> 
							 <td style="text-align:center; vertical-align:top;">-</td> 
							 <td style="text-align:center; vertical-align:top;">-</td> 
							 							
						   </tr>
						 </table>
						 			  		
						 
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
        var textToEncode = "<?=$rowselect[0]['ewbqrcode']?>";

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
