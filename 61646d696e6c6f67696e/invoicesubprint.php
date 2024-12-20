<?php
include('lcheck.php');
 if(isset($_GET['pono']))
 {
$getpono=mysqli_real_escape_string($connection, $_GET['pono']);
		$sqlselect = "SELECT * From jrcxl where pono='".$getpono."' order by pono desc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{
			
			$rowselect=array();
			while($row = mysqli_fetch_array($queryselect)) 
			{
				$rowselect[]=$row;
			}
			
			
$x=1;

$totalrows=count($rowselect);
$fullval=floor($totalrows/5);
$remain=$totalrows%5;
$tdata=array();
$kr=1;
for($k=0;$k<$fullval;$k++)
{
	$tdata[]=5;
	$kr++;
}
if($remain!=0)
{
if($remain>1)
{
	$tdata[]=$remain;
}
else
	{
		$tdata[$kr-1]=$remain;
	}
}
$term=array();


?>									
										
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Invoice Submission - <?=$rowselect[0]['pono']?> - <?=$_SESSION['companyname']?></title>
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
	
	
	<?php // $i=1;
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
$total = 0;
	?>
      <tr>
        <td>
		<?php
		$vstart=0;
$vend=0;
		for($j=0;$j<count($tdata);$j++)
{
	$vend+=$tdata[$j];
		?>
          <div class="page">
		  <div class="row">
		  <div class="col-6 mb-2">
		  <strong>Chennai </strong> <br>
			<?php $currentdate = date("d.m.Y");  
			echo $currentdate; ?>
		  </div>
		  </div>
		  <div class="row mb-2">
		  <div class="col-12"><br>
		  <strong>To </strong> 
		  <br>
		  The Managing Director,<br>
		  Electronics Corporation of Tamil Nadu Limited, Chennai.

		  
		  </div>
		  </div>
		  <div class="row mb-2">
		  <div class="col-12"><br>
		  Respected Sir/Madam,<br><br>
		  <strong>Sub :</strong> Request for Payment of Submitted Bills - Purchase Order No: <strong> <?=$rowselect[0]['pono']?></strong> Dated: <strong> <?=$rowselect[0]['podate']?></strong><br>
		  
		  <br>
		  We are writing to formally submit the attached bills for the supply of materials in accordance with Purchase Order mentioned below.
		  </div>
		  </div>
	<br> 
	<br>
	<div class="row">
	<div class="col-12" style="min-height:700px;">
	<table class="table table-bordered">
	<thead>
	<tr>
	<th width="22%">Purchase Order No</th>
	<th width="48%"><strong> <?=$rowselect[0]['pono']?></strong></th>
	<th width="10%">Date</th>
	<th width="20%"><strong> <?=$rowselect[0]['podate']?></strong></th>
	</tr>
	</thead>
	</table>
	<table class="table table-bordered">
	<thead>
	<tr>
	<th>S.No.</th>
	<th>Installation Ref. No</th>
	<th>Supplier Invoice Ref.</th>
	<th>Qty</th>
	<th>Invoice No</th>
	<th>Claim Amount 100%</th>
	</tr>
	</thead>
	<tbody>
	<?php
            $i = 1;
            $total = 0;
            $totalRows = count($rowselect);
           for($m=$vstart;$m<$vend;$m++)
		   {
			   if ($rowselect[$m]['installrefno'] && $rowselect[$m]['suprefno'] != '') {
				   
				$claimamount = $rowselect[$m]['invoiceamt']/100*$rowselect[$m]['claimper'];
				
				if($rowselect[$m]['claimper']!='')
				{
                $total += $claimamount;
				}
            ?>
			
			
			<?php /* $total=0;
			
			
$vstart=0;
$vend=0;
			
for($j=0;$j<count($tdata);$j++)
{
	$total+=$rowselect[$j]['claimamt'];
	
	
	
for($m=$vstart;$m<$vend;$m++)
{ */
?>
	<tr>
	<td><?=$m+1?></td>
	<td><b><?=$rowselect[$m]['installrefno']?></b></td>
	<td><b><?=$rowselect[$m]['suprefno']?></b></td>
	<td><?=$rowselect[$m]['qty']?></td>
	<td><?=$rowselect[$m]['invoiceno']?></td>
	<td><?=$claimamount?></td>
	</tr>
						
						<?php
}
}
            ?>
			<tr>
						
						<td colspan="5" style="text-align:right">Total</td>
						<td><?=$total?></td>
						</tr>
						<?php
/* 						
}
}
 */
?>
		
	</tbody>
	</table>
	
	<p>We kindly request the release of payment amounting to Rs <?=$total?> /- (<?=ucwords(getIndianCurrency((float)$total))?>) for the supplies and installations covered by this Purchase Order.
<br>
<br>
Thank you for your cooperation and understanding.<br>
Sincerely,
<br>
For JR Communications & Power Controls Pvt. Ltd,
<br>
<br>
<br>
Authorized Signatory.</p>
	</div>	
	</div>
	 
          </div>
		  <?php
		  $vstart=$m;
		  if($j<(count($tdata)-1))
{
	echo '<p style="page-break-after: always">&nbsp;</p>';
}
          }
		  ?>
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
}
?>
 <?php
 }
?>