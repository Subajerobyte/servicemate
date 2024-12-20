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

if((isset($_GET['id']))&&(isset($_GET['email'])))
{
$dcno=mysqli_real_escape_string($connection,$_GET['id']);
$dcno1=str_replace('/','-',$dcno);
$email=mysqli_real_escape_string($connection,$_GET['email']);
if($email!='')
{	
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>'.$_SESSION['companyname'].' - Carry In Acknowledgement - '.$_GET['id'].'</title>

<style>

table {
    width: 100%;
    margin-bottom: 3px;
}
table {
    border-collapse: collapse;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
body {
    margin: 0;
    
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.5;
    color: #000000;
    text-align: left;
    background-color: #fff;
}
td, th {
    vertical-align: middle;
    padding: 0px 6px;
}
.heading {
    font-family: Arial Black,Arial,Gadget,sans-serif;
}
p {
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
	font-family: Qwigley, cursive;
}
</style>
</head>
<body onLoad="window.print();">
';

 if(isset($_GET['id']))
 {
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
	$dcno=mysqli_real_escape_string($connection,$_GET['id']);
	$_SESSION['dcno']=$dcno;
		$sqlselect = "SELECT sourceid,engineerid,compstatus,dcno,dcdate,calltid,callon,suppliername,serial,taxablevalue,supcomplaintremarks,supcourierimg From jrccalls where dcno='".$dcno."'";
		
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
			
				$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where enabled='0' and id='".$rowselect[0]['engineerid']."' order by id desc";
				$queryengselect = mysqli_query($connection, $sqlengselect);
				$rowCountengselect = mysqli_num_rows($queryengselect);
				$rowengselect = mysqli_fetch_array($queryengselect);
				if($rowCountengselect>0)
				{
				$engsignature=$rowengselect['signature'];
				$engsignature=str_replace('uploads','padhivetram',$engsignature);
				$engineername=$rowengselect['engineername'];
				$compno=$rowengselect['compno'];
				$compprefix=$rowengselect['compprefix'];
				$engineerid=$rowengselect['id'];
				}
		
					 if($rowselect[0]['compstatus']=='2')
					  {
						$bg="bg-success";
						$bgtext="Completed";
					  }
					  else if($rowselect[0]['compstatus']=='1')
					  {
						$bg="bg-warning";
						$bgtext="Pending";
					  }
					  else
					 {
						 $bg="bg-danger";
						$bgtext="Open";
					  }
					
						$html.='<table  style="border:1px solid #eeeeee">
						  <tr>
						  <td colspan="3"><p class="heading" style="font-size:22px;"><img src='.$_SESSION['companylogo'].' width="100" > <strong>'.$_SESSION['companyname'].'</strong></p>
						  </td>
						  </tr>
						  <tr>
						  <td colspan="3" align="center">'.$_SESSION['companyaddress1'].' '.$_SESSION['companyaddress2'].' '.$_SESSION['companyarea'].'
 '.$_SESSION['companydistrict'].' '.$_SESSION['companypincode'].'</td>
						  </tr>
						  <tr>
						  <td>e.mail: '.$_SESSION['companyemail'].'</td>
						  <td align="center">Mobile: '.$_SESSION['companymobile'].'</td>
						  <td align="right">GSTIN: '.$_SESSION['companygstno'].'</td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td colspan="5" align="center" class="heading" style="font-size:20px; padding:5px;">DELIVERY NOTE</td>
						  </tr>
						  <tr>
						  <td rowspan="2" width="65%">
						  DN No.: <b><font size="+1">'.$rowselect[0]['dcno'].'</font></b><br>
						  DN Date: <b><font size="+1">'.date('d/m/Y',strtotime($rowselect[0]['dcdate'])).'</font></b></td>
						  <td align="left">Call ID:</td>
						  <td align="left">';
							
							foreach($rowselect as $row1)
							{
								
								$html.=' '.$row1['calltid'].'
								<br>';
								
							}
							
						  $html.='</td>
						  </tr>
						  <tr>
						  <td align="left">Date:</td>
						  <td align="left" >'.date('d/m/Y h:i:s a', strtotime($rowselect[0]['callon'])).'</td>
						  </tr>
					     
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>';
						  
						 
						  $suppliername=$rowselect[0]['suppliername'];
						 $sqlselectsup = "SELECT suppliername,address1,address2,area,district,pincode,mobile,gstno From jrcsuppliers where id='".$suppliername."' order by id asc";
						 $queryselectsup = mysqli_query($connection, $sqlselectsup);
						 $rowselectsup = mysqli_fetch_array($queryselectsup);
										
						 $html.=' <td align="left" width="100%"><strong>TO</strong><p style="margin-left:20px;">
						 '.$rowselectsup['suppliername'].'</strong>
						 '.(($rowselectsup['address1']!='')?$rowselectsup['address1']:'').'<br> '.(($rowselectsup['address2']!='')?$rowselectsup['address2']:'').'<br> '.(($rowselectsup['area']!='')?$rowselectsup['area']:'').' <br>'.(($rowselectsup['district']!='')?$rowselectsup['district']:'').' '.(($rowselectsup['pincode']!='')?-$rowselectsup['pincode']:'').'<br> '.(($rowselectsup['mobile']!='')?$rowselectsup['mobile']:'').' <br>
						 
						 
						 <b>State Code:</b> '.(($rowselectsup['gstno']!='')?substr($rowselectsup['gstno'],0,2):'').'<br>
						  <b>GSTIN:</b> '.$rowselectsup['gstno'].'
						  </p>
						  </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <th style="text-align:center; padding:10px;">S.NO</th>
						  <th style="text-align:center" width="60%">DESCRIPTION OF GOODS</th>
						  <th style="text-align:center">HSN/SAC</th>
						  <th style="text-align:center">QTY</th>
						  </tr>';
						 
						  $i=0;
						  foreach($rowselect as $row1)
						  {
							 
$sqlxl = "SELECT address1,phone,mobile,email,consigneeid,stockitem From jrcxl where tdelete='0' and  id='".$row1['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountxl > 0) 
				{
					
					$rowxl = array();
					while($row = mysqli_fetch_assoc($queryxl)){ 
					$rowxl[] = $row;
					}
										if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
					{
						if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
						{		
							if($rowxl[0]['address1']!='')
							{
							$rowxl[0]['address1']=jbsdecrypt($_SESSION['encpass'], $rowxl[0]['address1']);
							}
							if($rowxl['phone']!='')
							{
							$rowxl[0]['phone']=jbsdecrypt($_SESSION['encpass'], $rowxl[0]['phone']);
							}
							if($rowxl[0]['mobile']!='')
							{
							$rowxl[0]['mobile']=jbsdecrypt($_SESSION['encpass'], $rowxl[0]['mobile']);
							}
							if($rowxl[0]['email']!='')
							{
							$rowxl[0]['email']=jbsdecrypt($_SESSION['encpass'], $rowxl[0]['email']);
							}
						}
					}
									}
				






							$html.='<tr>
						  <td style="text-align:center; vertical-align:top; height:200px;">'.($i+1).'</td>
						  
						  <td style="text-align:right; vertical-align:top;">';
						 
						  foreach($rowxl as $row)
						  {
						  
						  $html.='<b>'.$row['stockitem'].'</b> <br>';
						  
						  }
						 
						  $html.='<br>
						 
						   <b>Remarks:</b> '.$row1['supcomplaintremarks'].'
						  </td>
						  <td style="text-align:center; vertical-align:top;">8507</td>
						  <td style="text-align:right; vertical-align:top;"><b> 1.000 Nos</b><br><br>
						  </td>';
						  
						  $i++;
						  }
						 
						 $html.='</tr>
						  <tr>
						  <td></td>
						  <td style="text-align:right;">Total</td>
						  <td></td>
						   <td style="text-align:right; vertical-align:top;"><b>'.$i.'.000 Nos</b></td>
						  </tr>
						  <tr>
						  <td colspan="5">
						  <span class="float-right"><i>E. & O.E</i></span>
						  </td>
						  </tr>
						  <tr>
						  <td colspan="3" style="text-align:center;">HSN/SAC</td>
						   <td style="text-align:right; vertical-align:top;"><b>Taxable Value</b></td>
						  </tr>
						  <tr>
						  <td colspan="3">8507</td>
						   <td style="text-align:right; vertical-align:top;"><b>'.$rowselect[0]['taxablevalue'].'</b></td>
						  </tr>
						  <tr>
						  <th colspan="3" align="right">Total</th>
						   <th style="text-align:right; vertical-align:top;"><b>'.$rowselect[0]['taxablevalue'].'</b></th>
						  </tr>
						  <tr>
						  <td colspan="4">Tax Amount Inwords INR: <b>NIL</b></td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td width="50%">
						  Company PAN: <b>'.$_SESSION['companypanno'].'</b></td>
						  <td colspan="2" align="left">
						  </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  <td width="100%"><b><i></i></b><br>
						 Received in Good Condition
						  </td>
						  </tr>
						  </table>
						  <table border="1" style="border:1px solid #eeeeee">
						  <tr>
						  ';
						  if($rowselect[0]['supcourierimg']!='')
						  {
							  
						 $html.= '<td align="center" width="33%" style="vertical-align:bottom"><br>
						 <img src='.$rowselect[0]['supcourierimg'].' width="20%" height="20%">
						 <br> <b>PRODUCT IMAGE</b>
						</td>
						';
						  }
						  else
						  {
							  
							$html.='  <td align="center" width="33%" style="vertical-align:bottom">
						 
						</td>';
							 
						  }
						
						 $html.=' <td align="center" width="33%" style="vertical-align:bottom">
						 </td>
						  <td align="center" width="33%" style="vertical-align:bottom"><b><font size="-1">for '.$_SESSION['companyname'].'</font></b>
						  <br>
						  <img src='.$_SESSION['companyauthsign'].'>
						  <img width="100" src='.$_SESSION['companyseal'].'>
						  <br>
						  <b>AUTHORISED SIGNATORY</b>
						  </td>
						  </tr>
						  <tr>
						  <td colspan="3" align="center"><font size="-1">SUBJECT TO TRICHY JURISDICTION<BR>This is a Computer Generated Document</font></td>
						  </tr>
						  </table>';	
					  	  
					
					$count++;
			
		}
 }		
			
  $html.=' <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
</body>
</html>
						 
';
 
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');
//save the file put which location you need folder/filname
$mpdf->Output("pdf/".$dcno1.".pdf");
$pdf="pdf/".$dcno1.".pdf";
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
 
 $mailsubject="Delivery Chellan- ".$_SESSION['companyname']."";
					$mailcontent=" ";
					$mailsendto=$email;
					sendmail2($_SESSION['mailer'], $_SESSION['companyname'], $mailsubject, $mailcontent, $_SESSION['mailname'], $_SESSION['apppassword'], $mailsendto,$pdf);
					header("Location: deliverynotes.php?remarks=DC Sent to a Supplier"); 
}
 else
 {
	 header("Location: deliverynotes.php?error=Supplier E-mail Not Found!!!!");
 }
  
}
?>