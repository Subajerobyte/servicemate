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
  <title><?=$_SESSION['companyname']?> - Carry In Acknowledgement - <?=$_GET['id']?></title>
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
		$sqlselect = "SELECT engineerid,sourceid,calltid,compstatus,callon,servicetype,customernature,callnature,serial,reportedproblem,problemobserved,diagnosisby,diagnosisengineername,diagnosiscoordinatorname,diagnosison,diagnosisremarks,diagnosisestcharge,diagnosisestdate,diagnosisimg,diagnosismaterial,diagnosissignname,diagnosissignature,coordinatorname From jrccalls where calltid='".$calltid."' order by id desc";
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
				if($rowselect['engineerid']!='')
				{
				$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where id='".$rowselect['engineerid']."' order by id desc";
				$queryengselect = mysqli_query($connection, $sqlengselect);
				$rowCountengselect = mysqli_num_rows($queryengselect);
				$rowengselect = mysqli_fetch_array($queryengselect);
				$engsignature=$rowengselect['signature'];
				$engsignature=str_replace('uploads','padhivetram',$engsignature);
				$engineername=$rowengselect['engineername'];
				$compno=$rowengselect['compno'];
				$compprefix=$rowengselect['compprefix'];
				$engineerid=$rowengselect['id'];
				}
				$sqlxl = "SELECT address1,phone,mobile,email,consigneeid,consigneename,stocksubcategory,componentname,stockitem, make,  capacity From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
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
				  $sqlcons = "SELECT address1,address2,area,district,pincode,contact,phone,mobile,email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
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
					  <td align="right" rowspan="4"><img src="<?=$_SESSION['companylogo']?>" height="50">
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
					  <td><strong>E.mail: </strong><?=$_SESSION['companyemail']?></td>
					  <td align="center"><strong>Mobile:</strong> <?=$_SESSION['companymobile']?><?=($_SESSION['companymobile1']!='')?' | '.$_SESSION['companymobile1']:''?><?=($_SESSION['companymobile2']!='')?' | '.$_SESSION['companymobile2']:''?></td>
					  <td align="right"><strong>GSTIN: </strong><?=$_SESSION['companygstno']?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td width="25%"><strong>Call ID.:</strong> <b><font size="+1"><?=$rowselect['calltid']?></font></b></td>
					  <td align="center" width="50%" rowspan="2" class="heading" style="font-size:24px;">CARRY-IN ACKNOWLEDGEMENT</td>
					  <td width="25%" align="right"><strong>Date:</strong> <b><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></b></td>
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
					  ?>
					  <?php
					  if(($infolayoutcall['callnature']=='1')||($infolayoutcall['servicetype']=='1'))
					  {
						?>  
					  <?php
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
					  </tr>
					  <tr>
					  <td align="left" width="40%" rowspan="5"><p><strong><?=$rowxl['consigneename']?></strong> - <strong>
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
					  <td align="left" colspan="6"><b>Product Name-</b>
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
					  if(($infolayoutservice['make']=='1')||($infolayoutservice['capacity']=='1'))
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
					  <td width="10%"><strong>Make</strong></td><td width="23%"><?=$rowxl['make']?></td>
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
					  if($infolayoutservice['capacity']=='1')
					  {
					  ?> 
					  <td width="10%"><strong>Capacity/Model </strong></td><td width="23%"><?=$rowxl['capacity']?></td>
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
					  <td width="10%"><strong>Sl.No</strong></td><td width="23%"><?=$rowselect['serial']?></td>
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
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <?php
					  if($infolayoutcall['reportedproblem']=='1')
					  {
					  ?> 
					  <td align="center"><strong>PROBLEM REPORTED</strong></td>
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
					  <td align="center" class="font-weight-bold text-primary"><?=$rowselect['problemobserved']?></td>
					  <?php
					  }
					  ?>
					  </tr>
					  </table>
					 <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="25%"><strong>DIAGNOSIS INFORMATION</strong></td>
					  <td>
						  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <?php
 if($infolayoutservice['diagnosis']=='1')
					  {
						  ?>
					  <tr>
					  <td align="left" width="28%"><strong>Diagnosis By</strong></td>
					  <td><?php
						if($rowselect['diagnosisby']=='engineer')
						{
							echo $rowselect['diagnosisengineername'];
						}
						else
						{
							echo $rowselect['diagnosiscoordinatorname'];
						}
					  ?>
					  </td>
					</tr>
					<?php
					  }
					  if($infolayoutservice['diagnosison']=='1')
					  {
					  ?>
					<tr>
					  <td align="left" width="28%"><strong>Diagnosis On</strong></td>
					  <td><?php
						if($rowselect['diagnosison']!='')
						{
							echo date('d/m/Y',strtotime($rowselect['diagnosison']));
						}
					  ?>
					  </td>
					</tr>
					<?php
					  }
					  if($infolayoutservice['diagnosisremark']=='1')
					  {
					  ?>
					<tr>
					  <td align="left" width="28%"><strong>Remarks</strong></td>
					  <td><?php
						if($rowselect['diagnosisremarks']!='')
						{
							echo $rowselect['diagnosisremarks'];
						}
					  ?>
					  </td>
					</tr>
					<?php
					  }
					  ?>
					  </table>
					</td>
					</tr>
					  </table>

					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="25%"><strong>ESTIMATION</strong></td>
					  <td>
						  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <?php
					 
					   if($infolayoutservice['estimation']=='1')
					  {
					  ?>
					  <tr>
					  <td align="left" width="28%"><strong>Estimate Charge (Approximate)</strong>
					</td>
					  <td>Rs.<?=$rowselect['diagnosisestcharge']?><br>
				(<?=ucwords(getIndianCurrency((float)$rowselect['diagnosisestcharge']))?>)
					  </td>
					</tr>
					<?php
					  }
					   if($infolayoutservice['estimatedate']=='1')
					  {
						if($rowselect['diagnosisestdate']!='')
						{
							?>
					<tr>
					  <td align="left" width="28%"><strong>Estimated Delivery Date</strong></td>
					  <td>
						  <?php
							echo date('d/m/Y',strtotime($rowselect['diagnosisestdate']));
						  ?>
					  </td>
					</tr>
					<?php
					}
					}
					?>
					  </table>
					</td>
					</tr>
					  </table>
<?php
					  
					   if($infolayoutservice['productimg']=='1')
					  {
					  ?>
					  
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="25%"><strong>PRODUCT IMAGES</strong></td>
					  <td >
					  <?php
					  if($rowselect['diagnosisimg']!=='')
					  {
						$as=explode(',',$rowselect['diagnosisimg']);
						$c=1;
						foreach($as as $a)
						{
							echo "<img src='".$a."' height='70' style='padding:5px;'>";
							$c++;
						}
					  }
					  ?>
					  </td>
					  
					  </tr>
					  </table>
					<?php
					  }
					   if($infolayoutservice['addmaterial']=='1')
					  {
					  ?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  <td align="center" width="25%"><strong>ADDITIONAL MATERIALS</strong></td>
					  <td>
						  <?=$rowselect['diagnosismaterial']?>
					</td>
					</tr>
					  </table>
					  <?php
					  }
					  $sqlcon = "SELECT acknowledgement From jrcacknowledgement";
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
					  <td><?=$infoacknowledge['acknowledgement']?></td>
					  </tr>
					  </table>
					 <?php
		}
		?>
					  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					  
					  <td align="center" width="25%"><strong>CUSTOMER'S SIGNATURE <br>(<?=$rowselect['diagnosissignname']?>)</strong></td>
					  <td><img id="signatureimg" width="150" style="<?=($rowselect['diagnosissignature']!='')?'display:block':'display:none'?>" src="<?=$rowselect['diagnosissignature']?>"></td>
					  <td align="center" width="25%"><strong>RECEIVER'S SIGNATURE <br>(<?=$rowselect['coordinatorname']?>)</strong></td>
					  <td width="20%" class="signfont" style="text-transform:capitalize; font-size:40px;"><?=strtolower($rowselect['coordinatorname'])?></td>
					  </tr>
					  </table>
					  	  
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
