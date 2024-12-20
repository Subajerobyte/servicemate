<?php
include('lcheck.php'); 
$sqlinfoquotationsettings=mysqli_query($connection, "select * from jrcquotsettings");
$infoquotationsettings=mysqli_fetch_array($sqlinfoquotationsettings);
 if((isset($_GET['id']))&&(isset($_GET['sc'])))
 {
$quoteid=mysqli_real_escape_string($connection, $_GET['id']);
$sc=mysqli_real_escape_string($connection, $_GET['sc']);
		 $sqlselect = "SELECT consigneeid, compstatus, qno, qdate, prototal, scrtotal From jrcquotation where  id='".$quoteid."' group by qno, qdate order by id desc";
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
				$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
				  	$sqlcons = "SELECT email, consigneename, address1, address2, area, district, pincode, contact, phone, mobile From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
        $querycons = mysqli_query($connection, $sqlcons);
        $rowCountcons = mysqli_num_rows($querycons);
        if(!$querycons){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountcons > 0) 
		{
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

$sqlquotationsettings=mysqli_query($connection, "select fontname, headerimage, footerimage, subject, contentmessage, diffper, terms, companyname, authsign from jrcsubcompany where id='$sc'");
$infoquotationsettings=mysqli_fetch_array($sqlquotationsettings);

$addterms="";
$qtypes="";
$sqlselect3=mysqli_query($connection, "select quotationtype from jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='PRODUCT'");
$countselect3=mysqli_num_rows($sqlselect3);
$ci=1;
while($rowselect3=mysqli_fetch_array($sqlselect3))
{
$sqlquotation=mysqli_query($connection, "select quotationtype, terms from jrcquotationtype where id='".$rowselect3['quotationtype']."'");
while($infoquotation=mysqli_fetch_array($sqlquotation))
{
	if($infoquotation['terms']!="")
	{
	$addterms.="<p style='font-style:italic'>".$infoquotation['quotationtype'].":</p>";
	$addterms.=$infoquotation['terms'];
	}
	if($qtypes!="")
	{
		if($ci==$countselect3)
		{
			$qtypes.=" and ".$infoquotation['quotationtype'];	
		}
		else
		{
			$qtypes.=", ".$infoquotation['quotationtype'];
		}
	}
	else
	{
		$qtypes.=$infoquotation['quotationtype'];
	}
}
$ci++;
}
?>
										
										
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Quotation - <?=$rowselect['qno']?> - <?=$_SESSION['companyname']?></title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <style>
  /* Styles go here */

.page-header, .page-header-space {
height:123.5px;
border-bottom: 2px solid #000000;
}

.page-footer, .page-footer-space {

height:123.5px;
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
}

@page {
  margin: 25mm
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;}
   .footer21 {page-break-after: auto;}
}
body
{
	
	font-family: <?=$infoquotationsettings['fontname']?> !important;
	<?php
	if(($infoquotationsettings['fontname']=="Verdana, sans-serif")||($infoquotationsettings['fontname']=="Tahoma, sans-serif")||($infoquotationsettings['fontname']=="Georgia, serif")||($infoquotationsettings['fontname']=="'Courier New', monospace"))
	{
		?>
		font-size:100%;
		<?php
	}
	else
	{
		?>
		font-size:130%;
		<?php
	}
	?>
}
.table td, .table th
{
	padding: 0.2rem 0.5rem;
}
  </style>
</head>

<body onLoad="window.print()">

  <div class="page-header">
    <img src="<?=$infoquotationsettings['headerimage']?>" style="max-height:100%; max-width:100%; width:100%">
  </div>

  <div class="page-footer">
    <img src="<?=$infoquotationsettings['footerimage']?>" style="max-height:100%; max-width:100%; width:100%">
  </div>

  <table style="width:100%;">

    <thead>
      <tr>
        <td>
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <div class="page">
		  
		  <div class="row mb-2 mt-3">
		  <div class="col-8">
		  <strong>To </strong> 
		  <br>
		  <strong><?=$rowcons['consigneename']?></strong><br><?=$rowcons['address1']?> <?=$rowcons['address2']?><?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?><br><?=$rowcons['contact']?>
		  <?=$rowcons['phone']?> <?=$rowcons['mobile']?>
		  </div>
		  <div class="col-4 mb-2 text-right">
		  <strong>Ref: </strong> <?=$rowselect['qno']?><br>
		  <strong>Date:</strong> <?=date('d/m/Y',strtotime($rowselect['qdate']))?>
		  </div>
		  </div>
		  <div class="row mb-2">
		  <div class="col-12">
		  Dear Sir/Madam,<br><br>
		  <strong>Sub: <?=$infoquotationsettings['subject']?> <?=$qtypes?></strong> <br>
		  Pleasant Greetings,
		  <br>
		  <?=$infoquotationsettings['contentmessage']?>
		  </div>
		  </div>
	
	<div class="row">
	<div class="col-12">
	<table class="table table-bordered">
	<thead>
	<tr>
	<th style="width:85px;">Sl. No.</th>
	<th>Product Description</th>
	<th style="width:160px;">Unit Price</th>
	<th>Qty</th>
	<th style="width:180px;">Total Amount</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	$diffper=(float)$infoquotationsettings['diffper']/100;
	$warrs="";	
	$sqlselect2 = "SELECT engineerid, createdby, productname, saleprice, salequantity, salesinstallation, salesinstallcost, gst, salesgst, salesnettotal From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='PRODUCT' order by id ASC";
	$sqlselect2 = "SELECT engineerid, createdby, productname, saleprice, salequantity, salesinstallation, salesinstallcost, gst, salesgst, salesnettotal From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='PRODUCT' order by id ASC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
		
		while($rowselect2 = mysqli_fetch_array($queryselect2)) 
		{
			
			$sqlengselect = "SELECT id, compprefix, compno, engineername, signature, mobile From jrcengineer where enabled='0' and id='".$rowselect2['engineerid']."' order by id desc";
				$queryengselect = mysqli_query($connection, $sqlengselect);
				$rowCountengselect = mysqli_num_rows($queryengselect);
				$rowengselect = mysqli_fetch_array($queryengselect);
				if($rowCountengselect >0 )
					{
				$engineersignature=$rowengselect['signature'];
				$engineersignature=str_replace('uploads','padhivetram',$engineersignature);
				$engineername=$rowengselect['engineername'];
				$engineermobile=$rowengselect['mobile'];
				$compno=$rowengselect['compno'];
				$compprefix=$rowengselect['compprefix'];
				$engineerid=$rowengselect['id'];
					}
			
			$sqladmin = "SELECT id,signature,mobile,adminusername From jrcadminuser where username='".$rowselect2['createdby']."' order by id desc";
				$queryadmin = mysqli_query($connection, $sqladmin);
				$rowadmin = mysqli_num_rows($queryadmin);
				$rowSelectadmin = mysqli_fetch_array($queryadmin);
				if($rowadmin >0 )
					{
				$adminsignature=$rowSelectadmin['signature'];
				$adminsignature=str_replace('uploads','padhivetram',$adminsignature);
				$adminname=$rowSelectadmin['adminusername'];
				$adminmobile=$rowSelectadmin['mobile'];
				
					}
	$sqlxl = "SELECT warranty, stockitem From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
	$queryxl = mysqli_query($connection, $sqlxl);
	$rowCountxl = mysqli_num_rows($queryxl);
	if(!$queryxl){
	   die("SQL query failed: " . mysqli_error($connection));
	}
	$rowxl = mysqli_fetch_array($queryxl);
	
	if(($rowxl['warranty']!="")&&($rowxl['warranty']!="0"))
			{
				if($warrs!="")
				{
					$warrs.="".$rowxl['warranty']." Months (".$rowxl['stockitem'].")<br>";
				}
				else
				{
					$warrs.="<p><b>Warranty: </b></p>";
					$warrs.="".$rowxl['warranty']." Months (".$rowxl['stockitem'].")<br>";
				}
			}
		
	?>		
	<tr>
	<td><?=$i?></td>
	<td><b><?=$rowxl['stockitem']?></b>
	<?php
	/*<br>
	<?=nl2br($rowxl['description'])?> 
	*/
	?></td>
	<td class="text-right">Rs. <?=number_format((float)$rowselect2['saleprice']+((float)$rowselect2['saleprice']*$diffper),2,'.',',')?>/-</td>
	<td class="text-center"><?=$rowselect2['salequantity']?></td>
	<td class="text-right">Rs. <?=number_format((((float)$rowselect2['saleprice']+((float)$rowselect2['saleprice']*$diffper))*(float)$rowselect2['salequantity']),2,'.',',')?>/-</td>
	</tr>
	<?php
	if($rowselect2['salesinstallation']=='1')
	{
		?>
	<tr>
	<td></td>
	<td>Delivery & Installation charges</td>
	<td></td>
	<td></td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesinstallcost']+((float)$rowselect2['salesinstallcost']*$diffper),2,'.',',')?>/-</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td></td>
	<td>ADD: GST <?=$rowselect2['gst']?>% </td>
	<td></td>
	<td></td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesgst']+((float)$rowselect2['salesgst']*$diffper),2,'.',',')?>/-</td>
	</tr>
	<tr>
	<td></td>
	<th>Total Amount Inclusive of GST</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesnettotal']+((float)$rowselect2['salesnettotal']*$diffper),2,'.',',')?>/-</th>
	</tr>
	<?php 
	$i++;
	}
	?>
	<tr>
	<td></td>
	<th>PRODUCT TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect['prototal']+((float)$rowselect['prototal']*$diffper),2,'.',',')?>/-</th>
	</tr>
	<?php 
		}
	
	$sqlselect2 = "SELECT productname, salescrap, salescrapvalue  From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='SCRAP' order by id ASC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
		while($rowselect2 = mysqli_fetch_array($queryselect2)) 
		{
	
	$sqlxl = "SELECT stockitem From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
	$queryxl = mysqli_query($connection, $sqlxl);
	$rowCountxl = mysqli_num_rows($queryxl);
	if(!$queryxl){
	   die("SQL query failed: " . mysqli_error($connection));
	}
	$rowxl = mysqli_fetch_array($queryxl);
	?>	
	
	<tr>
	<td><?=$i?></td>
	<td><b>LESS: Scrap Value</b><br>
	(<?=$rowxl['stockitem']?> - <?=$rowselect2['salescrap']?> Nos)</td>
	<td></td>
	<td>
	
	</td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salescrapvalue']-((float)$rowselect2['salescrapvalue']*$diffper),2,'.',',')?>/-</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td></td>
	<th>SCRAP TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect['scrtotal']-((float)$rowselect['scrtotal']*$diffper),2,'.',',')?>/-</th>
	</tr>
	<?php 
		}
		?>
		<tr>
	<td></td>
	<th>NET TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format(((float)$rowselect['prototal']+((float)$rowselect['prototal']*$diffper))-((float)$rowselect['scrtotal']-((float)$rowselect['scrtotal']*$diffper)),2,'.',',')?>/-</th>
	</tr>
	</tbody>
	</table>
	<?php
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
	?>
	<p>(<?=ucwords(getIndianCurrency(((float)$rowselect['prototal']+((float)$rowselect['prototal']*$diffper))-((float)$rowselect['scrtotal']-((float)$rowselect['scrtotal']*$diffper))))?>)</p>
	</div>	
	</div>
	<br>
	<h4 style="font-weight:bold; text-decoration:underline;">TERMS</h4>
		 <?php if($addterms=='') {echo trim($infoquotationsettings['terms']);} ?>
			<?=$addterms?>
	
	<!--div class="row mb-2">
		  <div class="col-12"><br>
		  We are eagerly looking forward to receiving order. <br>
		  Thanking you & assuring you of our best service and prompt attention at all times. 
		  <br><br>
		  </div>
		  </div-->
<br>	
	<div class="row mb-2 align-items-center">
		  <div class="col-8">
		 With Regards,<br><b> 
   For <?=$infoquotationsettings['companyname']?><br>
 <?php
 if($infoquotationsettings['authsign']!='')
 {
	 ?>
	 <img src="<?=$infoquotationsettings['authsign']?>" width="120"><br>
	 <?php
 }
 ?>
</b>
		  </div>
		  <div class="col-4">
		  <?php
		  /* if($infoquotationsettings['companyseal']!="")
		  {
			?>
			<img src="<?=$infoquotationsettings['companyseal']?>" width="130">
			<?php			
		  }	 */	  
		  ?>
		  </div>
		  </div>	
			
         
          </div>
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>
<?php
					$count++;
			}
			}
		}
			?>
 <?php
 }
?>