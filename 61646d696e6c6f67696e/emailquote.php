<?php
include('lcheck.php');

require_once __DIR__ .'/../../1637028036/vendor/autoload.php';
// Import PHPMailer classes at the top
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require_once '../../1637028036/vendor/phpmailer/src/Exception.php';
require_once '../../1637028036/vendor/phpmailer/src/PHPMailer.php';
require_once '../../1637028036/vendor/phpmailer/src/SMTP.php';



$sqlinfoquotationsettings=mysqli_query($connection, "select * from jrcquotsettings");
$infoquotationsettings=mysqli_fetch_array($sqlinfoquotationsettings);


if((isset($_GET['id']))&&(isset($_GET['email'])))
{
$quoteid=mysqli_real_escape_string($connection,$_GET['id']);
$quoteid1=str_replace('/','-',$quoteid);
$email=mysqli_real_escape_string($connection,$_GET['email']);


 $quoteid=mysqli_real_escape_string($connection, $_GET['id']);
$sqlselect = "SELECT * From jrcquotation where id='".$quoteid."' group by qno, qdate order by id desc";
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

if($email!='')
{	

//content start


$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Quotation - '.$rowselect['qno'].' '.$_SESSION['companyname'].'</title>
<style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body onLoad="window.print();">
';

 if(isset($_GET['id']))
 {
	
	 // currency function start
	  function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => "", 1 => "one", 2 => "two",
        3 => "three", 4 => "four", 5 => "five", 6 => "six",
        7 => "seven", 8 => "eight", 9 => "nine",
        10 => "ten", 11 => "eleven", 12 => "twelve",
        13 => "thirteen", 14 => "fourteen", 15 => "fifteen",
        16 => "sixteen", 17 => "seventeen", 18 => "eighteen",
        19 => "nineteen", 20 => "twenty", 30 => "thirty",
        40 => "forty", 50 => "fifty", 60 => "sixty",
        70 => "seventy", 80 => "eighty", 90 => "ninety");
    $digits = array("", "hundred","thousand","lakh", "crore");
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? "s" : null;
            $hundred = ($counter == 1 && $str[0]) ? " and " : null;
            $str [] = ($number < 21) ? $words[$number].''. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;
}
	//currency function end
		
		$html.='
		<div  class="row">
		<div class="col-12 text-center">
						  <p class="heading" style="font-size:22px;"><img src='.$_SESSION['companylogo'].' width="100" > <strong>'.$_SESSION['companyname'].'</strong></p>
						  </div>
						   </div>
		<div class="row">
		<div class="col-12 text-center">
						  '.$_SESSION['companyaddress1'].' '.$_SESSION['companyaddress2'].' '.$_SESSION['companyarea'].'
 '.$_SESSION['companydistrict'].' '.$_SESSION['companypincode'].'
						 </div> </div>
						 
		<div class="row">
		<div class="col-4 text-center">
						 E.mail: '.$_SESSION['companyemail'].'
						 </div>
						 <div class="col-4 text-center">
						 Mobile: '.$_SESSION['companymobile'].'
						 </div>
						 <div class="col-4 text-center">
						 GSTIN: '.$_SESSION['companygstno'].'
						 </div>
						 </div>
						  </div><br><br>
						 <div class="row">
						 <div class="col-6 text-center">
    Ref: <strong>'.$rowselect['qno'].'</strong>
	</div>
	<div class="col-6 text-center">
	Date: <strong>'.date('d/m/Y',strtotime($rowselect['qdate'])).'</strong>
						  </div>  
						  </div>
	
<div class="row mb-2">
<div class="col-12"><br>
<strong>To </strong>
<br>
<strong>'.$rowcons['consigneename'].'</strong><br>'.$rowcons['address1'].' '.$rowcons['address2'].'<br>'.$rowcons['area'].' '.$rowcons['district'].' '.$rowcons['pincode'].'<br>'.$rowcons['contact'].'
'.$rowcons['phone'].' '.$rowcons['mobile'].'
</div>
</div>

<div class="row mb-2">
<div class="col-12"><br>
Dear Sir/Madam,<br><br>
<strong>Sub: '.$infoquotationsettings['subject'].' '.$qtypes.' - Reg.</strong> <br>
Warm Greetings,
<br>
'.$infoquotationsettings['contentmessage'].'
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
<tbody>';
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
$sqlengselect = "SELECT id, compprefix, compno, engineername,designation, signature, mobile From jrcengineer where enabled='0' and id='".$rowselect2['engineerid']."' order by id desc";
$queryengselect = mysqli_query($connection, $sqlengselect);
$rowCountengselect = mysqli_num_rows($queryengselect);
$rowengselect = mysqli_fetch_array($queryengselect);
if($rowCountengselect >0 )
{
$engineersignature=$rowengselect['signature'];
$engineersignature=str_replace('uploads','padhivetram',$engineersignature);
$engineername=$rowengselect['engineername'];
$engineerdesignation=$rowengselect['designation'];

//$engineermobile=$rowengselect['mobile'];
$compno=$rowengselect['compno'];
$compprefix=$rowengselect['compprefix'];
$engineerid=$rowengselect['id'];
}
$sqladmin = "SELECT id,signature,mobile,designation,adminusername From jrcadminuser where username='".$rowselect2['createdby']."' order by id desc";
$queryadmin = mysqli_query($connection, $sqladmin);
$rowadmin = mysqli_num_rows($queryadmin);
$rowSelectadmin = mysqli_fetch_array($queryadmin);
if($rowadmin >0 )
{
$adminsignature=$rowSelectadmin['signature'];
$adminsignature=str_replace('uploads','padhivetram',$adminsignature);
$adminname=$rowSelectadmin['adminusername'];
//$adminmobile=$rowSelectadmin['mobile'];
$admindesignation=$rowSelectadmin['designation'];
}
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
$warrs.="<p><b>Warranty: </b>".$rowxl['warranty']." Months (".$rowxl['stockitem'].")<br></p>";
}
}

$html.='<tr>
<td>'.$i.'</td>
<td><b>'.$rowxl['stockitem'].'</b><br>
'.nl2br($rowxl['description']).' </td>
<td class="text-right">Rs. '.number_format((float)$rowselect2['saleprice'],2,'.',',').'</td>
<td class="text-center">'.$rowselect2['salequantity'].'</td>
<td class="text-right">Rs. '.number_format(((float)$rowselect2['saleprice']*(float)$rowselect2['salequantity']),2,'.',',').'</td>
</tr>';
if($rowselect2['salesinstallation']=='1')
{
$html.='
<tr>
<td></td>
<td>Delivery & Installation charges</td>
<td></td>
<td></td>
<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. '.number_format((float)$rowselect2['salesinstallcost'],2,'.',',').'</td>
</tr>';
}
$html.='<tr>
<td></td>
<td>ADD: GST '.$rowselect2['gst'].'% </td>
<td></td>
<td></td>
<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. '.number_format((float)$rowselect2['salesgst'],2,'.',',').'</td>
</tr>
<tr>
<td></td>
<th>Total Amount Inclusive of GST</th>
<td></td>
<td></td>
<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. '.number_format((float)$rowselect2['salesnettotal'],2,'.',',').'</th>
</tr>';
$i++;
$html.='
<tr>
<td></td>
<th>PRODUCT TOTAL</th>
<td></td>
<td></td>
<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. '.number_format((float)$rowselect['prototal'],2,'.',',').'</th>
</tr>';
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

$html.='
<tr>
<td>'.$i.'</td>
<td><b>LESS: Scrap Value</b><br>
('.$rowxl['stockitem'].' - '.$rowselect2['salescrap'].' Nos)</td>
<td></td>
<td>
</td>
<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. '.number_format((float)$rowselect2['salescrapvalue'],2,'.',',').'</td>
</tr>';
}
$html.='
<tr>
<td></td>
<th>SCRAP TOTAL</th>
<td></td>
<td></td>
<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. '.number_format((float)$rowselect['scrtotal'],2,'.',',').'</th>
</tr>';
}
$html.='
<tr>
<td></td>
<th>NET TOTAL</th>
<td></td>
<td></td>
<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. '.number_format((float)$rowselect['gratotal'],2,'.',',').'</th>
</tr>
</tbody>
</table>

<p style="text-align:center;">('.ucwords(getIndianCurrency((float)$rowselect['gratotal'])).')</p>
</div>
</div>


<br>
<table width="100%" style="table-layout: auto;">
<tr>
<td  style="height:900px; vertical-align:top;" >
<h4 style="font-weight:bold; text-decoration:underline; text-align:center; p-6">TERMS & CONDITIONS</h4><br>
'. trim($infoquotationsettings['terms']).'
'.$warrs.'
'.$addterms.'
<div class="row mb-2">
<div class="col-12">
Thank you for the opportunity to serve you, and we look forward to the possibility of establishing a mutually beneficial partnership.
<br><br>
</div>
</div>
</td>
</tr>
<tr>
<td >
<div class="row mb-2 align-items-center">
<div class="col-4">
<div class="parent">';
if( $rowCountengselect >0 )
{
if($engineersignature!='')
{
$html.='<img  src="'.$engineersignature.'" width="130">
<br>';
}
}
if( $rowadmin > 0 )
{
if($adminsignature!='')
{
$html.='<img  src="<?=$adminsignature?>" width="130">
<br>';
}
}
$html.='</div>';
if( $rowCountengselect >0 )
{
if($engineername!='')
{ echo $engineername; 
$html.='<br>
('.$engineerdesignation.')<br>';
}
}
if( $rowadmin >0 )
{
if($adminname!='')
{
 echo $adminname; 
 $html.='<br>
('.$admindesignation.')<br>';

}
}
$html.='</b>
</div>
<div class="col-8" style="text-align:center;">';
if($_SESSION['companyseal']!="")
{
	$html.='
<img class="image1" src="'.$_SESSION['companyseal'].'" width="130">';
}
$html.='
<br>
With Regards,<br><b>
For '.$_SESSION['companyname'].'<br>
</div>
</div>
</td>
</tr>
</table>

	</body>
	</html>';
 }		
 }		
 }		
 }		
	
	
	
 // content end
 
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');
//save the file put which location you need folder/filname
$mpdf->Output("pdf/quote/".$quoteid.".pdf");
$pdf="pdf/quote/".$quoteid.".pdf";
//output in browser
//$mpdf->Output(); 

 

 function sendmail2($mailer, $companyname,$subject,$body,$mailname,$apppassword,$addaddress,$pdf){
	if($mailer=="1")
	{
	// Instantiation
$mail = new PHPMailer(true);
// Server settings
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure= 'tls';
$mail->Port = 587;
$mail->Username = $mailname;
$mail->Password = $apppassword;
$mail->From = $mailname;
$mail->FromName = $companyname." - Jerobyte.com";
$mail->addAddress($addaddress);
// Content
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->Subject = $subject;
$body = $body;
$mail->Body = $body;
$mail->AddAttachment($pdf);

if($mail->send()){
  //echo 'Success Message';
//  exit;
}else{
  //echo 'Error Message';
  //exit;
}
	}
	else
	{
		$mail = new PHPMailer(true); // create a new object
			$mail->isSMTP();
			$mail->Host = 'localhost';
			$mail->SMTPAuth = false;
			$mail->SMTPAutoTLS = false; 
			$mail->Port = 25; 
			$mail->IsHTML(true);
			$mail->Username = "alerts@jerobyte.com";
			$mail->Password = "pretO@#*^JOPJWER1";
			$mail->SetFrom("alerts@jerobyte.com", $_SESSION['companyname']." - Jerobyte.com");
			$mail->AddAddress($addaddress);
			$mail->addReplyTo($_SESSION['companyemail']);
			$mail->AddCC($_SESSION['companyemail']);
			$mail->Subject =$subject ;
			$mail->Body    = $body;
			$mail->AddAttachment($pdf);
			if(!$mail->Send()) {
					//echo 'error';
				 } else {
					 //echo 'sent';
				 }
	}
}
 
 $mailsubject="Quotation- ".$_SESSION['companyname']."";
					$mailcontent=" ";
					$mailsendto=$email;
					sendmail2($_SESSION['mailer'], $_SESSION['companyname'], $mailsubject, $mailcontent, $_SESSION['mailname'], $_SESSION['apppassword'], $mailsendto,$pdf);
					header("Location: quotations.php?remarks=Quotation Sent to a Customer"); 

}
}
 else
 {
	 header("Location: quotations.php?error=Customer E-mail Not Found!!!!");
 }
  
}
?>