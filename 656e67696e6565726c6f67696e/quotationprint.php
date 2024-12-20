<?php
include('lcheck.php'); 
 if(isset($_GET['id']))
 {
$quoteid=mysqli_real_escape_string($connection, $_GET['id']);
		$sqlselect = "SELECT * From jrcquotation where engineerid='".$id."' and id='".$quoteid."' group by qno, qdate order by id desc";
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
				  	$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
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
	$addterms.="<p>".$infoquotation['quotationtype'].":".$infoquotation['terms']."</p>";
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
height:100px;
}
.page-footer, .page-footer-space {
height:100px;
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
margin: 20mm
}
@media print {
thead { display: table-header-group; }
tfoot { display: table-footer-group; }
button { display: none; }
body {
margin: 0;
}
.footer21 { page-break-after: auto; }
/* Add your custom styling here */
.your-element-selector {
min-height: 450px;
background-color: #784513;
vertical-align: top;
}
}
body
{
font-size:130%;
}
.table td, .table th
{
padding: 0.2rem 0.5rem;
}
.parent {
position: relative;
top: 0;
left: 0;
}
.image1 {
position: relative;
top: 0;
left: 0;
}
.image2 {
position: absolute;
top: 30px;
left: 60px;
mix-blend-mode: multiply;
}
.image3 {
position: absolute;
top: 30px;
left: 60px;
mix-blend-mode: multiply;
}
</style>
</head>

<body onLoad="window.print()">

  <div class="page-header" style="text-align: center">
    <img src="<?=$_SESSION['companyheaderimage']?>" style="width:100%; height:100px">
  </div>

  <div class="page-footer">
    <img src="<?=$_SESSION['companyfooterimage']?>" style="width:100%; height:100px">
  </div>

  <table>

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
		  <div class="row p-3">
		  <div class="col-6 mb-2">
		  <strong>Ref: </strong> <?=$rowselect['qno']?>
		  </div>
		  <div class="col-6 text-right">
		  <strong>Date:</strong> <?=date('d/m/Y',strtotime($rowselect['qdate']))?>
		  </div>
		  </div>
		  <div class="row mb-2">
		  <div class="col-12"><br>
		  <strong>To </strong> 
		  <br>
		  <strong><?=$rowcons['consigneename']?></strong><br><?=$rowcons['address1']?> <?=$rowcons['address2']?><br><?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?><br><?=$rowcons['contact']?>
		  <?=$rowcons['phone']?> <?=$rowcons['mobile']?>
		  </div>
		  </div>
		  <div class="row mb-2">
		  <div class="col-12"><br>
		  Dear Sir/Madam,<br><br>
		  <strong>Sub: <?=$infoquotationsettings['subject']?> <?=$qtypes?></strong> <br>
		  Pleasant Greetings,
		  <br>
		  <?=$infoquotationsettings['contentmessage']?>
		  </div>
		  </div>
	
	<div class="row">
	<div class="col-12" style="min-height:700px;">
	<table class="table table-bordered">
	<thead>
	<tr>
	<th style="width:85px;">Sl. No.</th>
	<th>Product Description</th>
	<th style="width:160px;">Unit Price</th>
	<th>Qty</th>
	<th style="width:160px;">Total Amount</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	$warrs="";	
	$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='PRODUCT' order by id ASC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
		
		while($rowselect2 = mysqli_fetch_array($queryselect2)) 
		{
			
	$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
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
					$warrs.="<p><b>Warranty: </b>".$rowxl['warranty']." Months (".$rowxl['stockitem']."</p>";
				
				}
			}
			
	?>		
	<tr>
	<td><?=$i?></td>
	<td><b><?=$rowxl['stockitem']?></b><br>
	<?=nl2br($rowxl['description'])?> </td>
	<td class="text-right">Rs. <?=number_format((float)$rowselect2['saleprice'],2,'.',',')?></td>
	<td class="text-center"><?=$rowselect2['salequantity']?></td>
	<td class="text-right">Rs. <?=number_format(((float)$rowselect2['saleprice']*(float)$rowselect2['salequantity']),2,'.',',')?></td>
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
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesinstallcost'],2,'.',',')?></td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td></td>
	<td>ADD: GST <?=$rowselect2['gst']?>% </td>
	<td></td>
	<td></td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesgst'],2,'.',',')?></td>
	</tr>
	<tr>
	<td></td>
	<th>Total Amount Inclusive of GST</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesnettotal'],2,'.',',')?></th>
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
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect['prototal'],2,'.',',')?></th>
	</tr>
	<?php 
		}
	
	$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='SCRAP' order by id ASC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
		while($rowselect2 = mysqli_fetch_array($queryselect2)) 
		{
	
	$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
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
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salescrapvalue'],2,'.',',')?></td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td></td>
	<th>SCRAP TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect['scrtotal'],2,'.',',')?></th>
	</tr>
	<?php 
		}
		?>
		<tr>
	<td></td>
	<th>NET TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect['gratotal'],2,'.',',')?></th>
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
	<p style="text-align:center;">(<?=ucwords(getIndianCurrency((float)$rowselect['gratotal']))?>)</p>
	</div>	
	</div>
	
	
		 
<br>
<table width="100%" >
<tr>
<td  style="height:900px; vertical-align:top;" >
	<h4 style="font-weight:bold; text-decoration:underline; text-align:center">TERMS & CONDITIONS</h4><br>
			<?=$infoquotationsettings['terms']?>
			<?=$warrs?>
	        <?=$addterms?>
	

	<div class="row mb-2">
		  <div class="col-12"><br>
		  We are eagerly looking forward to receiving order. <br>
		  Thanking you & assuring you of our best service and prompt attention at all times. 
		  <br><br>
		  </div>
		  </div>
</td>
</tr>
		  <tr>
		  <td>
		  <div class="row mb-2 align-items-center">
		
		  <div class="col-4">
		 
 <?php
 if($_SESSION['engineersignature']!='')
 {
	 ?>
	 <img src="<?=$_SESSION['engineersignature']?>" width="120"><br>
	 <?php
 }
 ?>
    <?=$_SESSION['engineername']?><br>
     (<?=$_SESSION['engineermobile']?>)<br>
</b>
		  </div>
		 	   <div class="col-8" style="text-align:right;">
		   With Regards,<br><b> 
   For <?=$_SESSION['companyname']?><br>
		  <?php
		  if($_SESSION['companyseal']!="")
		  {
			?>
			<img src="<?=$_SESSION['companyseal']?>" width="130">
			<?php			
		  }		  
		  ?>
		  </div>
		  </div>	
			</td>
			</tr>
			</table>
         
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