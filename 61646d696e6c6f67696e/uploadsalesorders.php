<?php
include ('lcheck.php');
date_default_timezone_set('Asia/Kolkata');
$createdon=date("Y-m-d H:i:s");
$createdby=$_SESSION['email'];
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
 if (!file_exists('uploadsalesorder/')) {
    mkdir('uploadsalesorder/', 0777, true);
}

$filename = $_FILES["file"]["name"];
/*  if (isset($_FILES["file"]["name"])) {
   
}  */  
if($connection)
{
 $sql="SELECT * FROM jrctally where file_name='$filename' ";
$result=mysqli_query($connection, $sql);
if(mysqli_num_rows($result)>0)
{
header("location:exporttally.php?error= This File Name Already Exists");
}
else
{
	$fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
   if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
		/*  $uploadDirectory = 'surveyorder/';

    // Get the uploaded file's name and temporary file path
    $uploadedFileName = $_FILES['file']['name'];
    $uploadedFilePath = $_FILES['file']['tmp_name'];
$filemove=move_uploaded_file($uploadedFilePath, $uploadDirectory . $uploadedFileName); 
		 */
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
        fgetcsv($csvFile);
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        {
			$sono=mysqli_real_escape_string($connection, $getData[0]);
			$sodate=mysqli_real_escape_string($connection, $getData[1]);
			$maincategory=mysqli_real_escape_string($connection, $getData[2]);
			$tender=mysqli_real_escape_string($connection, $getData[3]);
			$subcategory=mysqli_real_escape_string($connection, $getData[4]);
			$department=mysqli_real_escape_string($connection, $getData[5]);
			$otherreference=mysqli_real_escape_string($connection, $getData[6]);
			$pono=mysqli_real_escape_string($connection, $getData[7]);
			$podate=mysqli_real_escape_string($connection, $getData[8]);
			$custreference=mysqli_real_escape_string($connection, $getData[9]);
			$duedays=mysqli_real_escape_string($connection, $getData[10]);
			$buyername=mysqli_real_escape_string($connection, $getData[11]);
			$buyeraddress1=mysqli_real_escape_string($connection, $getData[12]);
			$buyeraddress2=mysqli_real_escape_string($connection, $getData[13]);
			$buyeraddress3=mysqli_real_escape_string($connection, $getData[14]);
			$buyertaluk=mysqli_real_escape_string($connection, $getData[15]);
			$buyerdistrict=mysqli_real_escape_string($connection, $getData[16]);
			$buyerstate=mysqli_real_escape_string($connection, $getData[17]);
			$rtype=mysqli_real_escape_string($connection, $getData[18]);
			$bgst=mysqli_real_escape_string($connection, $getData[19]);
			$consigneeno=mysqli_real_escape_string($connection, $getData[20]);$consigneename=mysqli_real_escape_string($connection, $getData[21]);
			$conaddress1=mysqli_real_escape_string($connection, $getData[22]);
			$conaddress2=mysqli_real_escape_string($connection, $getData[23]);
			$conaddress3=mysqli_real_escape_string($connection, $getData[24]);
			$contaluk=mysqli_real_escape_string($connection, $getData[25]);
			$condistrict=mysqli_real_escape_string($connection, $getData[26]);
			$conpincode=mysqli_real_escape_string($connection, $getData[27]);
			$concontact=mysqli_real_escape_string($connection, $getData[28]);
			$conphone=mysqli_real_escape_string($connection, $getData[29]);
			$conmobile=mysqli_real_escape_string($connection, $getData[30]);
			$conemail=mysqli_real_escape_string($connection, $getData[31]);
			$conprogroup=mysqli_real_escape_string($connection, $getData[32]);
			$conmultiple=mysqli_real_escape_string($connection, $getData[33]);
			$conproduct=mysqli_real_escape_string($connection, $getData[34]);
			$conqty=mysqli_real_escape_string($connection, $getData[35]);
			if($getData[36]!='')
			{
			$conserialno=mysqli_real_escape_string($connection, $getData[36]);
			}
			else if($getData[37]!='')
			{
			$conserialno=mysqli_real_escape_string($connection, $getData[37]);
			}
			$conunit=mysqli_real_escape_string($connection, $getData[38]);
			$installcost=mysqli_real_escape_string($connection, $getData[39]);
			$discount=mysqli_real_escape_string($connection, $getData[40]);
			$conigst=mysqli_real_escape_string($connection, $getData[41]);
			$consgst=mysqli_real_escape_string($connection, $getData[42]);
			$concgst=mysqli_real_escape_string($connection, $getData[43]);
			$conigstamount=mysqli_real_escape_string($connection, $getData[44]);
			$consgstamount=mysqli_real_escape_string($connection, $getData[45]);
			$concgstamount=mysqli_real_escape_string($connection, $getData[46]);
			$contotal=mysqli_real_escape_string($connection, $getData[47]);
			$grandtotal=mysqli_real_escape_string($connection, $getData[48]);
			$conwarranty =mysqli_real_escape_string($connection, $getData[49]);
			$overallwarranty=mysqli_real_escape_string($connection, $getData[50]);


            if($pono!='' ||  $sono!="")
			{
				
				
				  $sql="SELECT * FROM jrctally where  conproduct = '{$conproduct}' and conprogroup = '{$conprogroup}' and conserialno = '{$conserialno}'  and pono='$pono' and podate='$podate' and consigneename='$consigneename' and conaddress1='$conaddress1' and conaddress2='$conaddress2' and conaddress3='{$conaddress3}'";
$result=mysqli_query($connection, $sql);
if(mysqli_num_rows($result)>0)
{
$sql123=mysqli_query($connection, "UPDATE jrctally SET  maincategory='$maincategory', tender='$tender', subcategory='$subcategory', department='$department', otherreference='$otherreference', pono='$pono', podate='$podate', custreference='$custreference', duedays='$duedays', buyername='$buyername', buyeraddress1='$buyeraddress1', buyeraddress2='$buyeraddress2', buyeraddress3='$buyeraddress3', buyertaluk='$buyertaluk', buyerdistrict='$buyerdistrict', buyerstate='$buyerstate', rtype='$rtype', bgst='$bgst', consigneeno='$consigneeno', consigneename='$consigneename',conaddress1='$conaddress1', conaddress2='$conaddress2', conaddress3='$conaddress3', contaluk='$contaluk', condistrict='$condistrict', conpincode='$conpincode', concontact='$concontact', conphone='$conphone', conmobile='$conmobile', conemail='$conemail', conprogroup='$conprogroup', conmultiple='$conmultiple', conproduct='$conproduct', conqty='$conqty', conserialno='$conserialno', conunit='$conunit', discount='$discount', conigst='$conigst', consgst='$consgst', concgst='$concgst', conigstamount='$conigstamount', consgstamount='$consgstamount', concgstamount='$concgstamount', contotal='$contotal', grandtotal='$grandtotal' , conwarranty='$conwarranty' where sono='$sono' and sodate='sodate'");
//header("location:exporttally.php?remarks=This Sales Order Information has be Updated Successfully");
//mysqli_query($connection,"UPDATE csurveyorders SET department='$department' where wsurveytitle='".$wsurveytitle."'");
}
else
{	
				
				$sql23=mysqli_query($connection, "INSERT into jrctally(createdon,createdby,file_name,sono, sodate, maincategory, tender, subcategory, department, otherreference, pono, podate, custreference, duedays, buyername, buyeraddress1, buyeraddress2, buyeraddress3, buyertaluk, buyerdistrict, buyerstate, rtype, bgst, consigneeno, consigneename, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, concontact, conphone, conmobile, conemail, conprogroup, conmultiple, conproduct, conqty, conserialno, conunit, discount, conigst, consgst, concgst, conigstamount, consgstamount, concgstamount, contotal, grandtotal , conwarranty) values ('$createdon', '$createdby','$filename', '$sono', '$sodate', '$maincategory', '$tender', '$subcategory', '$department', '$otherreference', '$pono', '$podate', '$custreference', '$duedays', '$buyername', '$buyeraddress1', '$buyeraddress2', '$buyeraddress3', '$buyertaluk', '$buyerdistrict', '$buyerstate', '$rtype', '$bgst', '$consigneeno', '$consigneename', '$conaddress1', '$conaddress2', '$conaddress3', '$contaluk', '$condistrict', '$conpincode', '$concontact', '$conphone', '$conmobile', '$conemail', '$conprogroup', '$conmultiple', '$conproduct', '$conqty', '$conserialno', '$conunit', '$discount', '$conigst', '$consgst', '$concgst', '$conigstamount', '$consgstamount', '$concgstamount', '$contotal', '$grandtotal', '$conwarranty')");
				//mysqli_query($connection,"UPDATE jrctally SET department='$department' where wsurveytitle='".$wsurveytitle."'");
				
}

}
		
        }
        fclose($csvFile);
    }
 if($sql23)
 {
header("location:exporttally.php?remarks=This Sales Order Information has been Added Successfully");
 }
 /* else if($sql123)
 {
	 header("location:exporttally.php?remarks=This Sales Order Information has been Updated Successfully");
 } */
 else
 {
header("location:exporttally.php?error=Your uploaded file is empty. Kindly upload the correct file.");
 }
}
}
else
{
header("location:exporttally.php?error=".mysqli_error($connection));
}
}
else
{
header("location:exporttally.php?error=No Information");
}
?>