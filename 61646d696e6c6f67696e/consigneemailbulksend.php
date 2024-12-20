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

if(isset($_POST['submit']))
{
//print_r($_POST);

$createdon=date('Y-m-d H:i:s');
function sendreportemail1($mailer, $apppassword, $companyname,$subject, $message, $email, $senderemail){
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
$mail->Username = $senderemail;
$mail->Password = $apppassword;
$mail->From = $senderemail;
$mail->FromName = $companyname;
$mail->addAddress($email);
// Content
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->Subject = $subject;
$body = $message;
$mail->Body = $message;
if($mail->send()){
    header("Location: consigneemailbulk.php?remarks=E-mail Sent Successfully");
  //echo 'Success Message';
//  exit;
}else{
	header("Location: consigneemailbulk.php?error=Error Message");
 // echo 'Error Message';
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
			$mail->SetFrom("alerts@jerobyte.com", $_SESSION['companyname']);
			$mail->AddAddress($email);
			$mail->addReplyTo($_SESSION['companyemail']);
			$mail->AddCC($_SESSION['companyemail']);
			$mail->Subject =$subject ;
			$mail->Body    = $message;
			
			if(!$mail->Send()) {
				header("Location: bulkemail.php?error=Error Message");
					//echo 'error';
				 } else {
			   header("Location: bulkemail.php?remarks=Message Send Successfully");
					 //echo 'sent';
				 }
	}
	}



function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
if(isset($_POST['submit']))
{
//print_r($_POST);


$senderemail=mysqli_real_escape_string($connection,$_POST['senderemail']);
$count=1;
$counts=1;
$idarray=array();
if(isset($_POST['checkboxs']))
{
	foreach($_POST['checkboxs'] as $mem)
	{
		
	$sqlselect = "SELECT id, consigneename, maincategory, subcategory, district, email From jrcconsignee where id='".$mem."' order by consigneename asc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			while($rowselect1 = mysqli_fetch_array($queryselect)) 
			{			
						
	
	$idarray[]=$rowselect1['id'];
	$consigneename=$rowselect1['consigneename'];
	$maincategory=$rowselect1['maincategory'];
	$subcategory=$rowselect1['subcategory'];
	$district=$rowselect1['district'];
	
	$fromdate=mysqli_real_escape_string($connection,$_POST['fromdate']);
	$todate=mysqli_real_escape_string($connection,$_POST['todate']);
	$email=mysqli_real_escape_string($connection,$rowselect1['email']);
	$id=mysqli_real_escape_string($connection,$rowselect1['id']);
	
		 
        $sqlcon = "SELECT id From jrcconsignee WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcconsignee set email='$email' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			 
	    }
		

$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>'.$_SESSION['companyname'].' - Call Report</title>
  
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
	 border: 0.02px solid black;
	width:100%;
	margin-bottom:10px;
}
td, th
{
	  border: 0.02px solid  black;
  border-collapse: collapse;
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
	font-family: Qwigley, cursive;
}
</style>
</head>
<body onLoad="window.print();">
<div class="row">
<div class="col-12">';
 $sqlc = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email,consigneename From jrcconsignee where id='".$id."' order by consigneename asc";
				  
        $queryc = mysqli_query($connection, $sqlc);
        $rowCountc = mysqli_num_rows($queryc);
         $rowc = mysqli_fetch_array($queryc);
$html.='<label>&nbsp;Hello '.$rowc['consigneename'].'<br>&nbsp;we have sent you the call report from <b>'.date('d-m-Y', strtotime($fromdate)).' to '.date('d-m-Y', strtotime($todate)).'</b> for your perusal</label>
</div>
</div>

    <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0"> 
                    <tr>
                      <th>S.No</th>
                      <th>Call ID</th>
					  <th>Date</th>
					  <th>Type Details</th>
					  <th>Product Details</th>
					  <th>Serial Number</th>
					  <th>Problem Reported</th>
					  <th>Problem Observed</th>
					  <th>Action Taken</th>
                      <th>Status</th>
					  <th>Service Charges</th>
                    </tr>
                  </thead>
                  <tbody>';
		
				  $callids=array();
				  $sqlselect = "SELECT sourceid, calltid, callon, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid, engineertype, engineername, businesstype, servicetype, customernature, callnature, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid, compstatus, changeon, id, detailsid From jrccalls where (callon BETWEEN '".$fromdate." 00:00:00' AND '".$todate." 23:59:59') and consigneeid='".$id."' order by id desc";
				 
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
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem, id From jrcxl where id='".$rowselect['sourceid']."'  order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountxl > 0) 
				{
					$rowxl = mysqli_fetch_array($queryxl);
				
				$consigneeid=mysqli_real_escape_string($connection,$rowselect['id']);
				  $sqlcons = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email,consigneename From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
				  
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
		$detailsid=mysqli_real_escape_string($connection,$rowselect['detailsid']);
				  $sqldetails = "SELECT engineerreport, scharge From jrccalldetails where id='".$detailsid."' order by engineerreport asc";
				  
        $querydetails = mysqli_query($connection, $sqldetails);
        $rowCountdetails = mysqli_num_rows($querydetails);
         
        if(!$querydetails){
           die("SQL query failed: " . mysqli_error($connection));
        }
        $rowdetails = mysqli_fetch_array($querydetails);
		

                    $html.='<tr>
                      <td>'.$count.'</td>
                      <td><a style="color:#3d8eb9;" >'.$rowselect['calltid'].'</td>
					  <td>'.date('d/m/Y h:i:s a', strtotime($rowselect['callon'])).'</td>
					  
					  <td>';
					  
					  if($rowselect['businesstype']!='')
					  {
							
							$html.='<span class="text-success text-bold">'.$rowselect['businesstype'].'</span><br>';
													  
					  } 
					  if($rowselect['servicetype']!='')
					  {
							
							$html.='<span class="text-danger text-bold">'.$rowselect['servicetype'].'</span><br>';
												  
					  } 
					 if($rowselect['customernature']!='')
					 {
							
						  $html.='<span class="text-info text-bold">'.$rowselect['customernature'].'</span><br>';
						   						  
					 }
					 if($rowselect['callnature']!='')
					 {
							
						  $html.='<span class="text-primary text-bold">'.$rowselect['callnature'].'</span><br>';
						   					  
					 }
					 $html.=' </td>
					 
					  <td>';
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													
												 $html.=$rowxl['stockmaincategory'].'-' ;
												
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													
												$html.=$rowxl['stocksubcategory']. '-'; 
												
												}
												if($infolayoutproducts['componentname']=='1')
												{
													
												$html.=$rowxl['componentname'].' -'; 
												
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													
												$html.=$rowxl['stockitem'];
												
												}
												$html.='</td>
					  <td>'.$rowselect['serial'].'</td>
					  <td>'.$rowselect['reportedproblem'].'</td>
					  <td>'.$rowselect['problemobserved'].'</td>
					  <td>'.$rowselect['actiontaken'].'</td>
					  <td>';
					  
					 if($rowselect['compstatus']=='2')
					  {
						
						$html.='<span class="text-success">Completed </span><br>on '.date('d/m/Y h:i:s a', strtotime($rowselect['changeon']));
						
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						
						$html.='<span class="text-danger">Pending </span><br>on '.date('d/m/Y h:i:s a', strtotime($rowselect['changeon']));
					
					  }
					  else if($rowselect['compstatus']=='3')
					  {
						
						$html.='<span class="text-info">Cancelled </span><br>on '.date('d/m/Y h:i:s a', strtotime($rowselect['changeon']));
					
					  }
					  else
					 {
						
						$html.='<span class="text-warning">Open<br></span>';
					
						
					  }
					  
					  $html.='</td>
					  <td>'.(($rowCountdetails > 0)?number_format((float)$rowdetails['scharge'],2,'.',''):'').'</td>
					  
                    </tr>';
					
					$count++;
				$callids[]=$rowselect['calltid'];
				}
				
			}
		}
			
					
                 $html.=' </tbody>
                </table>
              </div>
			  <br>
				<div class="row"><div class="col-12">&nbsp;for further queries contact <b>'.$_SESSION['email'].'</b></h6></div></div>
				<br>
				<h5>&nbsp;Regards,<br>&nbsp;
				'.$_SESSION['companyname'].'</h5>

  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
</body>
</html>';


$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');

	
	
echo	$message = $html;
 if($rowselect1['email']!='')
{
$email=$rowselect1['email'];
$subject="Call Report (".date('d/m/Y',strtotime($fromdate))." - ".date('d/m/Y',strtotime($todate)).") - ".$_SESSION['companyname'];
sendreportemail1($_SESSION['mailer'], $_SESSION['apppassword'], $_SESSION['companyname'], $subject,$message, $email, $senderemail);
} 
$count++;
					}
				}				
			}
		}

}
}
?>