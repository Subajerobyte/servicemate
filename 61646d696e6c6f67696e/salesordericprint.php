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
  <title><?=$_SESSION['companyname']?> - Installation Certificate Print - <?=$_GET['id']?></title>
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

.signfont
{
	font-family: 'Qwigley', cursive;
}
</style>
<style>

@media print {
    .page-header, .page-header-space {
        height: 100px;
    }

    .page-footer, .page-footer-space {
        height: 100px;
    }

    .page-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .page-header {
        position: fixed;
        top: 0mm;
        width: 100%;
    }

    .page {
        page-break-after: auto;
        height: auto;
    }

    .footer21 {
        page-break-after: always;
    }

    /* Add any additional print-specific styles */
    thead {
        display: table-header-group;
    }

    tfoot {
        display: table-footer-group;
    }

    button {
        display: none;
    }

    body {
        margin: 0;
    }

    /* Add your custom styling here */
    .your-element-selector {
        min-height: 450px;
        background-color: #784513;
        vertical-align: top;
    }
}
</style>

</head>
<body">
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
						  <table border="1" style="border:1px solid #999999">
						  <tr>
						
		
		<?php
		$sql=mysqli_query($connection,"select * from jrctender where tender='".$rowselect[0]['tender']."'");
		$rowcount=mysqli_num_rows($sql);
		$row=mysqli_fetch_assoc($sql);
		if($rowselect[0]['tender']!=''){
		?>
		<td colspan="1">
            <img src="<?=$row['logo']?>" alt="Your Logo" width="100" height="100" style="padding:5px;">
        </td>
        <td colspan="11">
            <p class="heading" align="center" style="font-size:24px; padding:5px;">
                INSTALLATION CERTIFICATE<br>(PROCUREMENT SERVICES GROUP)
            </p>
        </td>
		<?php } else{ ?>
        <td colspan="12">
            <p class="heading" align="center" style="font-size:24px; padding:5px;">
                INSTALLATION CERTIFICATE
            </p>
        </td>
		<?php } ?>
						  </tr>
						  </table>
						  
						  <table border="1" style="border:1px solid #999999">
						  <tr>
						  
						 <?php
						 /*  $buyerdetails=$rowselect[0]['buyername'];
						  $sqlselectsup1 = "SELECT consigneename,address1,address2,area,district,pincode,mobile,gstno From jrcconsignee where consigneename='".$buyerdetails."' order by id asc";
						  $queryselectsup1 = mysqli_query($connection, $sqlselectsup1);
						  $rowselectsup1 = mysqli_fetch_array($queryselectsup1);
						  $rowCountsup1=mysqli_num_rows($queryselectsup1); */
						  ?>
						  <td align="left"> <b>Billing Address</b>
						  <?php
						 /*  if($rowCountsup1 >0) { */ ?>
						  
						  <p style="margin-left:20px;"><strong><?=$rowselect[0]['buyername']?></strong><br><?php if($rowselect[0]['buyeraddress1']!=''){ echo $rowselect[0]['buyeraddress1'];}?> <?php if($rowselect[0]['buyeraddress2']!=''){ echo $rowselect[0]['buyeraddress2'];}?> <?php if($rowselect[0]['buyeraddress3']!=''){ echo $rowselect[0]['buyeraddress3'].'<br>';}?><?php if($rowselect[0]['buyertaluk']!=''){echo $rowselect[0]['buyertaluk'].'<br>';}?><?php if($rowselect[0]['buyerdistrict']!=''){ echo $rowselect[0]['buyerdistrict'].' - ';}?><?php if($rowselect[0]['buyerpincode']!=''){ echo $rowselect[0]['buyerpincode'];}?><?php ?><br>
						  <b><?php if($rowselect[0]['bgst']!=''){?>GSTIN:</b> <?php  if($rowselect[0]['bgst']!='') {echo $rowselect[0]['bgst']; if($rowselect[0]['buyermobile']!=''){ echo ', Mobile : ' .$rowselect[0]['buyermobile'];}} else {echo 'Unregistered'; if($rowselect[0]['buyermobile']!=''){ echo ', Mobile : ' .$rowselect[0]['buyermobile'];}}} ?>
						  </p></b>
						  <?php /* } */ ?></b>
						  </td>
						  
						  <td rowspan="2" width="50%"> <b>Consignee Address</b> 
						  <p style="margin-left:20px;"><strong><?=$rowselect[0]['consigneename']?></strong><br><?php if($rowselect[0]['conaddress1']!='') { echo $rowselect[0]['conaddress1'];}?> <?php if($rowselect[0]['conaddress2']!=''){ echo $rowselect[0]['conaddress2'];}?> <?php if($rowselect[0]['conaddress3']!=''){ echo $rowselect[0]['conaddress3'].'<br>';}?><?php if($rowselect[0]['contaluk']!=''){echo $rowselect[0]['contaluk'].'<br>';}?><?php if($rowselect[0]['condistrict']!=''){ echo $rowselect[0]['condistrict'].' - ';}?><?php if($rowselect[0]['conpincode']!=''){ echo $rowselect[0]['conpincode'];}?>
						  <br><b><?php if($rowselect[0]['congstno']!=''){?>GSTIN:</b> <?php  if($rowselect[0]['congstno']!='') {echo $rowselect[0]['congstno']; if($rowselect[0]['buyermobile']!=''){ echo ', Mobile : ' .$rowselect[0]['buyermobile'];}} else { echo 'Unregistered'; if($rowselect[0]['buyermobile']!=''){ echo ', Mobile : ' .$rowselect[0]['buyermobile'];}} } ?>
						  </p>
						  </td>
						  </tr>
					     
						  </table>
						  
						  
						  	  <table border="1" style="border:1px solid #999999">
						  <tr>
						  <th style="text-align:center;height:30px;">Consignee Contact</th>
						  <th style="text-align:center;height:30px;">PO No. & Date</th>
						  <th style="text-align:center;height:30px;">DC No. & Date</th>
						  <th style="text-align:center;height:30px;">IC No.</th>
						  </tr>
						 <tr>
						  <td style="text-align:center; vertical-align:center;height:30px;" ><?=$rowselect[0]['conmobile']?></td>
						  <td style="text-align:center; vertical-align:center;height:30px;"><?php $poFive = substr($rowselect[0]['pono'], -5); echo substr($rowselect[0]['pono'], 0, -5) . '<strong style="font-size: larger;">' . $poFive . '</strong>'; ?> & <?=date('d/m/Y',strtotime($rowselect[0]['podate']))?></td>
						  <td style="text-align:center; vertical-align:center;height:30px;"><?php $dcFour = substr($rowselect[0]['dcno'], -4); echo substr($rowselect[0]['dcno'], 0, -4) . '<strong style="font-size: larger;">' . $dcFour . '</strong>'; ?> & <?=date('d/m/Y',strtotime($rowselect[0]['dcdate']))?></td>
						  <td style="text-align:center; vertical-align:center;height:30px;">I-<?php $dcFour = substr($rowselect[0]['dcno'], -4); echo substr($rowselect[0]['dcno'], 0, -4) . '<strong style="font-size: larger;">' . $dcFour . '</strong>'; ?> </td>
						  </tr>
						  </table>
						  
						
						  <table  border="1" style="border:1px solid #999999">
    <tr>
        <th style="text-align:center; padding:10px;">S.NO</th>
        <th style="text-align:center">INSTALLED HARDWARE & CONFIGURATION</th>
        <th style="text-align:center">QTY</th>
		<th style="text-align:center">EXPIRY DATE</th>
        
    </tr>
    <?php
    $i = 0;
    foreach ($rowselect as $row1) {
		$parts = explode(" - ", $row1['conper']);
							if (count($parts) == 2) {
								$beforeDash = $parts[0]; 
								$afterDash = $parts[1];
							} else {
								$beforeDash = $row1['conper']; 
							}
        ?>
        <tr>
            <td style="text-align:center; vertical-align:top; "><?= $i + 1 ?></td>
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
if($row1['conqty']!=''){ ?> Qty:<?php if($beforeDash=='SET'){ echo $row1['conqty'] * 16; } else{ echo $row1['conqty'];}?>&nbsp;<?php }  
?>  
<br>
Sl No:</font></i>

           <?php   
		   if($row1['conserialno']!='') { 
		   $string =  $row1['conserialno'];
		   $items = explode(' | ', $string);
		   foreach ($items as $key => $value) {
		   echo ($key + 1) . ") $value" . ($key < count($items) - 1 ? ',' : '') . "\n";
		   }}?></td>
            <?php
							$parts = explode(" - ", $row1['conper']);
							if (count($parts) == 2) {
								$beforeDash = $parts[0]; 
								$afterDash = $parts[1];
							} else {
								$beforeDash = $row1['conper']; 
							}
                          ?>
            <td style="text-align:right; vertical-align:top;"><?= $row1['conqty'] ?> <?= $beforeDash?></td>
<?php
if($row1['conwarranty']!='')
{
// Convert installation date string to DateTime object
$installedOnDate = new DateTime($row1['installedon']);

// Calculate the end of warranty date
$outOfWarrantyDate = clone $installedOnDate;
$outOfWarrantyDate->modify('+' . $row1['conwarranty'] . ' months');

// Format the out of warranty date
$outOfWarrantyFormatted = $outOfWarrantyDate->format('Y-m-d');

//echo "Out of Warranty Date: " . $outOfWarrantyFormatted;
}
?>
             <td style="text-align:center; vertical-align:top;"><?php if($row1['conwarranty']!=''){ echo date('d/m/Y',strtotime($outOfWarrantyFormatted)); }?></td>
			
        </tr>
        <?php
        $i++;
    }
?>

</table>
						  <table border="1" style="border:1px solid #999999">
						  <tr>
						  <td>
						  <b>Certified that the above items along with software are installed on ___________ 2024 and are in good working condition. Also trianing has been imparted on ____________ 2024 about usage of these Items.</b>
						   </td>
						   </tr>
						   </table>
						   
						  	  <table border="1" style="border:1px solid #999999">
						  <tr>
						  <th style="text-align:left">CUSTOMER</th>
						  <?php if($rowselect[0]['tender']=="ELCOT")
						  {
							  ?>
						  <th style="text-align:left">ELCOT</th>
						  <?php } ?>
						  <th style="text-align:left">SUPPLIER</th>
						  <th style="text-align:left">INSTALLATION DATE</th>
						  </tr>
						  <tr>
						  <td style="text-align:left; vertical-align:top;">REMARKS: <br><br><br>SIGN WITH DATE: <br><br><br>NAME SEAL: <br><br><br></td>
						  <?php if($rowselect[0]['tender']=="ELCOT")
						  {
							  ?>
						  
						  <td style="text-align:left; vertical-align:top;">REMARKS: <br><br><br>SIGN WITH DATE: <br><br><br>NAME SEAL: <br><br><br></td>
						   <?php } ?>
						  <td style="text-align:left; vertical-align:top;">REMARKS: <br><br><br>SIGN WITH DATE: <br><br><br>NAME SEAL: <br><br><br></td>
						<td style="text-align:left; vertical-align:top;"></td>
						  <!--<td style="text-align:left; vertical-align:top;">INSTALLATION DATE: <br><br>WARRANTY EXPIRY DATE: <br><br></td>-->
						<!-- <td style="text-align:left; vertical-align:top;">
    <table>
        <tr>
            <th>S.No</th>
            <th>Install Date</th>
            <th>Expiry Date</th>
        </tr>
        <?php
            foreach ($rowselect as $i => $row1) {
                echo "<tr>";
                echo "<td>" . ($i + 1).") ".($row1['conwarranty'] / 12)." Year </td>";
                echo "<td>____________</td>";
                echo "<td>____________</td>";
                echo "</tr>";
            }
        ?>
    </table>
</td>-->
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
<!-- Add this script block after including jQuery -->
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