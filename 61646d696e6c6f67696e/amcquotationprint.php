<?php
include('lcheck.php');
$sqlamcquotation=mysqli_query($connection, "select * from jrcamcquotationtype");
$infoamcquotation =mysqli_fetch_array($sqlamcquotation); 
 if(isset($_GET['id']))
 {
$quoteid=mysqli_real_escape_string($connection, $_GET['id']);
		$sqlselect = "SELECT * From jrcamcquotation where qno='".$quoteid."' group by qno, qdate order by id desc";
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


$addterms="";
$addaterms="";
$quotationtypes="";
$sqlselect3=mysqli_query($connection, "select quotationtype from jrcamcquotation  where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."'");
$countselect3=mysqli_num_rows($sqlselect3);
$ci=1;
while($rowselect3=mysqli_fetch_array($sqlselect3))
{
$sqlquotation=mysqli_query($connection, "select quotationtype, terms,aterms from jrcamcquotationtype where id='".$rowselect3['quotationtype']."'");
while($infoquotation=mysqli_fetch_array($sqlquotation))
{
	if($infoquotation['terms']!="")
	{
	$addterms.="<p style='font-style:italic'>".$infoquotation['quotationtype'].":</p>";
	$addterms.=$infoquotation['terms'];
	}
	if($infoquotation['aterms']!="")
	{
	$addaterms.="<p style='font-style:italic'>".$infoquotation['quotationtype'].":</p>";
	$addaterms.=$infoquotation['aterms'];
	}
	if($quotationtypes!="")
	{
		if($ci==$countselect3)
		{
			$quotationtypes.=" and ".$infoamcquotation['quotationtype'];	
		}
		else
		{
			$quotationtypes.=", ".$infoamcquotation['quotationtype'];
		}
	}
	else
	{
		$quotationtypes.=$infoamcquotation['quotationtype'];
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
  <title>AMC Quotation - <?=$rowselect['qno']?> - <?=$_SESSION['companyname']?></title>
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
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;}
   .footer21 {page-break-after: auto;}
}
body
{
	font-size:130%;
}
.table td, .table th
{
	padding: 0.2rem 0.5rem;
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
		  <div class="row">
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
		  <strong>Sub: <?=$infoamcquotation['subject']?></strong> <br>
		 
		  <br>
		  <?=$infoamcquotation['contentmessage']?>
		  </div>
		  </div>
	
	<div class="row">
	<div class="col-12" style="min-height:700px;">
	<table class="table table-bordered">
	<thead>
	<tr>
	<th style="width:85px;">Sl. No.</th>
	<th>Description</th>
	<th style="width:160px;">Unit Price</th>
	<th>Qty</th>
	<th style="width:160px;">Total Price</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	$warrs="";	
		
     $sqlselect2 = "SELECT * From jrcamcquotationtype order by id ASC";
	   $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
		
		if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
		
		$rowselect2 = mysqli_fetch_array($queryselect2);
	$sqlxl = "SELECT * From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
	$queryxl = mysqli_query($connection, $sqlxl);
	$rowCountxl = mysqli_num_rows($queryxl);
	
	if(!$queryxl){
	   die("SQL query failed: " . mysqli_error($connection));
	}
	$rowxl = mysqli_fetch_array($queryxl);
	
	?>		
	<tr>
	<td><?=$i?></td>
	<td><b><?=$rowxl['stockitem']?></b><br>Serial No:<?=nl2br($rowselect['serialnumber'])?><br>Make:<?=nl2br($rowxl['make'])?><br>Model:<?=nl2br($rowxl['model'])?></td>
	<td class="text-right">Rs. <?=number_format((float)$rowselect['resultvalue'],2,'.',',')?></td>
	<td class="text-center"><?=$rowselect['quantity']?></td>
	<td class="text-right">Rs. <?=number_format(((float)$rowselect['resultvalue']*(float)$rowselect['quantity']),2,'.',',')?></td>
	</tr>

	<tr>
	<td></td>
	<td>GST <?=$rowselect['amcgst']?>% </td>
	<td></td>
	<td></td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect['amcgstvalue'],2,'.',',')?></td>
	</tr>
		<?php 
	?>

	<?php 
		}
	
		?>
		<tr>
	<td></td>
	<th>TOTAL AMOUNT</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect['totalvalue'],2,'.',',')?></th>
	</tr>
	</tbody>
	</table>
	<?php
	
	function getIndianCurrency($numberx)
{
    $decimal = round($numberx - ($no = floor($numberx)), 2) * 100;
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
        $numberx = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($numberx) {
            $plural = (($counter = count($str)) && $numberx > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($numberx < 21) ? $words[$numberx].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($numberx / 10) * 10].' '.$words[$numberx % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;
}
	?>
	<p>(<?=ucwords(getIndianCurrency((float)$rowselect['totalvalue']))?>)</p>
	</div>	
	</div>
	
	
	
	
		  <p class="text-right">----2</p>
<br>

	<h4 style="font-weight:bold; text-decoration:underline; text-align:center">TERMS & CONDITIONS</h4><br>
			<?=$infoamcquotation['terms']?>
	<h4 style="font-weight:bold; text-decoration:underline; text-align:center">ADDITIONAL TERMS & CONDITIONS</h4><br>
			<?=$infoamcquotation['aterms']?>
			<h6 style="font-weight:bold;"><?=date('d/m/Y', strtotime($rowselect['datefrom']))?> - <?=date('d/m/Y', strtotime($rowselect['dateto']))?></h6>
	<?=$warrs?>

	<div class="row mb-2">
		  <div class="col-12"><br>
		  We look forward to the opportunity to serve you and establish a mutually beneficial partnership. 
		  Thanking you & assuring you of our best service and prompt attention at all times.
		  <br><br>
		  </div>
		  </div>
		  <div class="row mb-2 align-items-center">
		  <div class="col-8">
		 With Regards,<br><b> 
   For <?=$_SESSION['companyname']?><br>
   <style>
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
   
		  <div class="col-4">
		  <?php
		  if($_SESSION['companyseal']!="")
		  {
			?>
			<img class="image1" src="<?=$_SESSION['companyseal']?>" width="130">
			<?php			
		  }		  
		  ?>
		  </div>
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