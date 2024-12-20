<?php
include('lcheck.php');
include('../../1637028036/vendor2/autoload.php');

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
$editor=$_POST['editor'];
$createdon=date('Y-m-d H:i:s');
$members='';
if(isset($_POST['members']))
{
	$members=implode(',',$membersarray);
}
function sendreportemail($mailer, $apppassword, $companyname, $subject, $message, $email, $senderemail){
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
    header("Location: bulkemail.php?remarks=Message Sent Successfully");
  //echo 'Success Message';
//  exit;
}else{
	header("Location: bulkemail.php?error=Error Message");
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

$subject=mysqli_real_escape_string($connection,$_POST['subject']);
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
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{			
						 $toppost='';
							  /* if($infose['postingname']==$infose['level1'])
							  {
								  $toppost='';
							  }
							  if($infose['postingname']==$infose['level2'])
							  {
								  $toppost='';
							  }
							  if($infose['postingname']==$infose['level3'])
							  {
								  $toppost=$infose['level2'];
							  }
							  if($infose['postingname']==$infose['level4'])
							  {
								  $toppost=$infose['level3'];
							  }
							  if($infose['postingname']==$infose['level5'])
							  {
								  $toppost=$infose['level4'];
							  }
							  if($infose['postingname']==$infose['level6'])
							  {
								  $toppost=$infose['level3'];
							  }
							  if($infose['postingname']==$infose['level7'])
							  {
								  $toppost=$infose['level6'];
							  }
							  if($toppost==$rowselect['groupname'])
							  {
								  $toppost='';
							  }
								if (strpos($toppost, 'REGIONAL SECRETARY - ADMIN') !== false) {
									$toppost='';
								}
								if (strpos($toppost, 'ASSISTANT GOVERNOR') !== false) {
									$toppost='';
								} */
	$message1=$editor;
	$idarray[]=$rowselect['id'];
	$consigneename=$rowselect['consigneename'];
	$maincategory=$rowselect['maincategory'];
	$subcategory=$rowselect['subcategory'];
	$district=$rowselect['district'];
	
	$message1=str_replace("\r\n",'', $message1);
	$message1=str_replace('<consigneename>',$consigneename,$message1);
	$message1=str_replace('&lt;consigneename&gt;',$consigneename,$message1);
	$message1=str_replace('<maincategory>',$maincategory,$message1);
	$message1=str_replace('&lt;maincategory&gt;',$maincategory,$message1);
	$message1=str_replace('<subcategory>',$subcategory,$message1);
	$message1=str_replace('&lt;subcategory&gt;',$subcategory,$message1);
	$message1=str_replace('<district>',$district,$message1);
	$message1=str_replace('&lt;district&gt;',$district,$message1);
	
	
	$message = $message1;
if($rowselect['email']!='')
{
$email=$rowselect['email'];
sendreportemail($_SESSION['mailer'], $_SESSION['apppassword'], $_SESSION['companyname'],$subject, $message, $email, $senderemail,);
}
$count++;
					}
				}				
			}
		}

}
}
?>