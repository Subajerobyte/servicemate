<?php
include('lcheck.php');
if($celigiblecalls=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
if(isset($_POST['submit']))
{
$fileName = "From Invoice Edit (Engineer)";
$upload_time=date("Y-m-d H:i:s");
$uploadby=$_SESSION['email'];
$invoicenovalue=mysqli_real_escape_string($connection, $_POST['invoiceno']);
$invoicedatevalue=mysqli_real_escape_string($connection, $_POST['invoicedate']);
$tendernovalue=mysqli_real_escape_string($connection, $_POST['tenderno']);
$ponovalue=mysqli_real_escape_string($connection, $_POST['pono']);
$podatevalue=mysqli_real_escape_string($connection, $_POST['podate']);
$dcnovalue=mysqli_real_escape_string($connection, $_POST['dcno']);
$dcdatevalue=mysqli_real_escape_string($connection, $_POST['dcdate']);
$installedonvalue=mysqli_real_escape_string($connection, $_POST['installedon']);
$installedbyvalue=mysqli_real_escape_string($connection, $_POST['installedby']);
$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['maincategory']);
$subcategoryvalue=mysqli_real_escape_string($connection, $_POST['subcategory']);
$consigneenamevalue=mysqli_real_escape_string($connection, $_POST['consigneename']);
$departmentvalue=mysqli_real_escape_string($connection, $_POST['department']);
$address1value=mysqli_real_escape_string($connection, $_POST['address1']);
$address2value=mysqli_real_escape_string($connection, $_POST['address2']);
$areavalue=mysqli_real_escape_string($connection, $_POST['area']);
$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
$pincodevalue=mysqli_real_escape_string($connection, $_POST['pincode']);
$contactvalue=mysqli_real_escape_string($connection, $_POST['contact']);
$phonevalue=mysqli_real_escape_string($connection, $_POST['phone']);
$mobilevalue=mysqli_real_escape_string($connection, $_POST['mobile']);
$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
$encstatus=0;
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
$encstatus=1;
$address1value=jbsencrypt($_SESSION['encpass'], $address1value);
$phonevalue=jbsencrypt($_SESSION['encpass'], $phonevalue);
$mobilevalue=jbsencrypt($_SESSION['encpass'], $mobilevalue);
$emailvalue=jbsencrypt($_SESSION['encpass'], $emailvalue);
}
}
$invoicedqtyvalue=mysqli_real_escape_string($connection, $_POST['invoicedqty']);
$overallwarrantyvalue=mysqli_real_escape_string($connection, $_POST['overallwarranty']);
$customersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['customersms']))?'0':'1'));
$callhandledsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['callhandledsms']))?'0':'1'));
$coordinatorsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['coordinatorsms']))?'0':'1'));
$engineersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['engineersms']))?'0':'1'));
$serial=mysqli_real_escape_string($connection, $_POST['serial']);
$diagnosisby=mysqli_real_escape_string($connection, ((isset($_POST['diagnosisby']))?$_POST['diagnosisby']:''));
$diagnosisengineername=mysqli_real_escape_string($connection, $_POST['diagnosisengineername']);
$diagnosisengineerid=mysqli_real_escape_string($connection, $_POST['diagnosisengineerid']);
$diagnosiscoordinatorname=mysqli_real_escape_string($connection, $_POST['diagnosiscoordinatorname']);
$diagnosiscoordinatorid=mysqli_real_escape_string($connection, $_POST['diagnosiscoordinatorid']);
$diagnosison=mysqli_real_escape_string($connection, $_POST['diagnosison']);
$problemobserved=mysqli_real_escape_string($connection, $_POST['problemobserved']);
$diagnosisestdate=mysqli_real_escape_string($connection, $_POST['diagnosisestdate']);
$diagnosisestcharge=(float)mysqli_real_escape_string($connection, $_POST['diagnosisestcharge']);
$diagnosisimg=mysqli_real_escape_string($connection, $_POST['diagnosisimg']);
$diagnosisremarks=mysqli_real_escape_string($connection, $_POST['diagnosisremarks']);
if(isset($_POST['diagnosismaterial']))
{
$diagnosismaterial=mysqli_real_escape_string($connection, implode(' | ',$_POST['diagnosismaterial']));
}
else
{
$diagnosismaterial="";
}
$diagnosissignname=mysqli_real_escape_string($connection, $_POST['diagnosissignname']);
$diagnosissignmode =mysqli_real_escape_string($connection, $_POST['diagnosissignmode']);
$diagnosissignmoderemark=mysqli_real_escape_string($connection, $_POST['diagnosissignmoderemark']);
$diagnosissignature=mysqli_real_escape_string($connection, $_POST['diagnosissignature']);
$godownname=mysqli_real_escape_string($connection, $_POST['godownname']);
$suppliername=mysqli_real_escape_string($connection, $_POST['suppliername']);
if((isset($_POST['stockitem']))&&is_array($_POST['stockitem']))
{
for($i=0;$i<count($_POST['stockitem']);$i++)
{
$productidvalue=mysqli_real_escape_string($connection, $_POST['productid'][$i]);
$stockmaincategoryvalue=mysqli_real_escape_string($connection, $_POST['stockmaincategory'][$i]);
$stocksubcategoryvalue=mysqli_real_escape_string($connection, $_POST['stocksubcategory'][$i]);
$stockitemvalue=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
$typeofproductvalue=mysqli_real_escape_string($connection, $_POST['typeofproduct'][$i]);
$componenttypevalue=mysqli_real_escape_string($connection, $_POST['componenttype'][$i]);
$componentnamevalue=mysqli_real_escape_string($connection, $_POST['componentname'][$i]);
$makevalue=mysqli_real_escape_string($connection, $_POST['make'][$i]);
$capacityvalue=mysqli_real_escape_string($connection, $_POST['capacity'][$i]);
$warrantyvalue=mysqli_real_escape_string($connection, $_POST['warranty'][$i]);
$qtyvalue=mysqli_real_escape_string($connection, $_POST['qty'][$i]);
$serialnumbervalue=mysqli_real_escape_string($connection, $_POST['serialnumber'][$i]);
$sqlselect = "SELECT id From jrcxl WHERE tdelete='0' and  invoiceno = '{$invoicenovalue}' and invoicedate = '{$invoicedatevalue}' and maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' and stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and typeofproduct = '{$typeofproductvalue}' and componenttype = '{$componenttypevalue}' ";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect == 0)
{
$sqlup = "INSERT INTO jrcxl(encstatus, file_name, upload_time, invoiceno, invoicedate, tenderno, pono, podate, dcno, dcdate, installedon, installedby, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, stockmaincategory, stocksubcategory, stockitem, invoicedqty, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, warranty, qty, serialnumber) VALUES ('$encstatus','$fileName', '$upload_time', '$invoicenovalue', '$invoicedatevalue', '$tendernovalue', '$ponovalue', '$podatevalue', '$dcnovalue', '$dcdatevalue', '$installedonvalue', '$installedbyvalue', '$maincategoryvalue', '$subcategoryvalue', '$consigneenamevalue', '$departmentvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue', '$stockmaincategoryvalue', '$stocksubcategoryvalue', '$stockitemvalue', '$invoicedqtyvalue', '$overallwarrantyvalue', '$typeofproductvalue', '$componenttypevalue', '$componentnamevalue', '$makevalue', '$capacityvalue', '$warrantyvalue', '$qtyvalue', '$serialnumbervalue')";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$sourceidvalue=$id=mysqli_insert_id($connection);
}
}
else
{
$rowselect = mysqli_fetch_array($queryselect);
$sourceidvalue=$id=$rowselect['id'];
$sqlup = "update jrcxl set invoiceno='$invoicenovalue', invoicedate='$invoicedatevalue', tenderno='$tendernovalue', pono='$ponovalue', podate='$podatevalue', dcno='$dcnovalue', dcdate='$dcdatevalue', installedon='$installedonvalue', installedby='$installedbyvalue', maincategory='$maincategoryvalue', subcategory='$subcategoryvalue', consigneename='$consigneenamevalue', department='$departmentvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', stockmaincategory='$stockmaincategoryvalue', stocksubcategory='$stocksubcategoryvalue', stockitem='$stockitemvalue', invoicedqty='$invoicedqtyvalue', overallwarranty='$overallwarrantyvalue', typeofproduct='$typeofproductvalue', componenttype='$componenttypevalue', componentname='$componentnamevalue', make='$makevalue', capacity='$capacityvalue', warranty='$warrantyvalue', qty='$qtyvalue', serialnumber='$serialnumbervalue' WHERE invoiceno = '{$invoicenovalue}' and invoicedate = '{$invoicedatevalue}' and maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' and stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and typeofproduct = '{$typeofproductvalue}' and componenttype = '{$componenttypevalue}' ";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup)
{
die("SQL query failed: " . mysqli_error($connection));
}
else
{
}
}
if(($maincategoryvalue!="")||($subcategoryvalue!="")||($consigneenamevalue!="")||($departmentvalue!=""))
{
$sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon == 0)
{
$sqlup = "INSERT INTO jrcconsignee( encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email) VALUES ( '$encstatus', '$maincategoryvalue', '$subcategoryvalue', '$consigneenamevalue', '$departmentvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue')";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$consigneeidvalue=$id=mysqli_insert_id($connection);
$sqlup1 = "update jrcxl set consigneeid='{$id}' WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$queryup1 = mysqli_query($connection, $sqlup1);
if(!$queryup1){
die("SQL query failed: " . mysqli_error($connection));
}
}
}
else
{
$rowselect = mysqli_fetch_array($querycon);
$consigneeidvalue=$id=$rowselect['id'];
$sqlup = "update jrcxl set consigneeid='{$id}' WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
}
}
if(($stockitemvalue!=""))
{
$sqlcon = "SELECT id From jrcproduct WHERE stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and stockitem = '{$stockitemvalue}' and componenttype = '{$componenttypevalue}' and componentname = '{$componentnamevalue}' and typeofproduct = '{$typeofproductvalue}' and make = '{$makevalue}' and capacity = '{$capacityvalue}' ";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon == 0)
{
$sqlup = "insert into jrcproduct set stockmaincategory='$stockmaincategoryvalue', stocksubcategory='$stocksubcategoryvalue', stockitem='$stockitemvalue', typeofproduct='$typeofproductvalue', componenttype='$componenttypevalue', componentname='$componentnamevalue', make='$makevalue', capacity='$capacityvalue'";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$productid=mysqli_insert_id($connection);
$sqlup1 = "update jrcxl set productid='$productid' WHERE stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and stockitem = '{$stockitemvalue}' and componenttype = '{$componenttypevalue}' and componentname = '{$componentnamevalue}' and typeofproduct = '{$typeofproductvalue}' and make = '{$makevalue}' and capacity = '{$capacityvalue}' ";
$queryup1 = mysqli_query($connection, $sqlup1);
if(!$queryup1){
die("SQL query failed: " . mysqli_error($connection));
}
}
}
else
{
$rowselect = mysqli_fetch_array($querycon);
$id=$rowselect['id'];
$sqlup = "update jrcxl set productid='{$id}'  WHERE stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and stockitem = '{$stockitemvalue}' and componenttype = '{$componenttypevalue}' and componentname = '{$componentnamevalue}' and typeofproduct = '{$typeofproductvalue}' and make = '{$makevalue}' and capacity = '{$capacityvalue}' ";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
}
}
}
}
$callfromvalue=mysqli_real_escape_string($connection, $_POST['callfrom']);
$calltype=mysqli_real_escape_string($connection, $_POST['calltype']);
$callnature=mysqli_real_escape_string($connection, $_POST['callnature']);
$servicetype=mysqli_real_escape_string($connection, $_POST['servicetype']);
$businesstype=mysqli_real_escape_string($connection, $_POST['businesstype']);
$customernature=mysqli_real_escape_string($connection, $_POST['customernature']);
$callonvalue=mysqli_real_escape_string($connection, $_POST['callon']);
$callhandlingidvalue=mysqli_real_escape_string($connection, $_POST['callhandlingid']);
$callhandlingnamevalue=mysqli_real_escape_string($connection, $_POST['callhandlingname']);
$reportedproblemvalue=mysqli_real_escape_string($connection, $_POST['reportedproblem']);
$coordinatoridvalue=mysqli_real_escape_string($connection, $_POST['coordinatorid']);
$coordinatornamevalue=mysqli_real_escape_string($connection, $_POST['coordinatorname']);
$engineeridvalue=mysqli_real_escape_string($connection, $_POST['engineerid']);
$engineernamevalue=mysqli_real_escape_string($connection, $_POST['engineername']);
$otherremarksvalue=mysqli_real_escape_string($connection, $_POST['otherremarks']);
$engineertype=mysqli_real_escape_string($connection, $_POST['engineertype']);
$engineersname=mysqli_real_escape_string($connection, $_POST['engineersname']);
if(!empty($_POST['engineersid']))
{
$engineersid=mysqli_real_escape_string($connection, implode(',',$_POST['engineersid']));
}
else
{
$engineersid="";
}
$reportingtype=mysqli_real_escape_string($connection, $_POST['reportingtype']);
$reportingengineerid=mysqli_real_escape_string($connection, $_POST['reportingengineerid']);
$reportingengineername=mysqli_real_escape_string($connection, $_POST['reportingengineername']);
if(($callonvalue!="")&&($callonvalue!="User Name(Unique)"))
{
$sqlcon = "SELECT id From jrccalls WHERE sourceid = '{$sourceidvalue}' and compstatus = '0'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon == 0)
{
$sqlup = "INSERT INTO jrccalls( sourceid, consigneeid, callfrom, callnature, customernature, businesstype, servicetype, calltype, callon, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, otherremarks, customersms, callhandledsms, coordinatorsms, engineersms, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial,problemobserved, diagnosissignname,diagnosissignmode ,diagnosissignmoderemark, diagnosissignature, godownname,suppliername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, times) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$callfromvalue', '$callnature', '$customernature', '$businesstype', '$servicetype', '$calltype', '$callonvalue', '$callhandlingidvalue', '$callhandlingnamevalue', '$reportedproblemvalue', '$coordinatoridvalue', '$coordinatornamevalue', '$engineeridvalue', '$engineernamevalue', '$otherremarksvalue', '$customersmsvalue', '$callhandledsmsvalue', '$coordinatorsmsvalue', '$engineersmsvalue', '$serial', '$diagnosisby', '$diagnosisengineername', '$diagnosisengineerid', '$diagnosiscoordinatorname', '$diagnosiscoordinatorid', '$diagnosison', '$diagnosisestdate', '$diagnosisestcharge', '$diagnosisimg', '$diagnosisremarks', '$diagnosismaterial','$problemobserved' ,'$diagnosissignname' ,'$diagnosissignmode' ,'$diagnosissignmoderemark' ,'$diagnosissignature', '$godownname','$suppliername', '$engineertype', '$engineersname', '$engineersid', '$reportingtype', '$reportingengineerid', '$reportingengineername', '$times')";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$callid=mysqli_insert_id($connection);
if($servicetype=="Carry-In")
{
mysqli_query($connection, "INSERT INTO jrcgodowninventory (date, callid, godownid, consigneeid, sourceid, inworddate, remarks) VALUES ('{$callonvalue}', '{$callid}', '{$godownname}', '{$consigneeidvalue}', '{$sourceidvalue}', '{$callonvalue}', 'Insert A Godown Complaint Call')");
}
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Call Complaint', '{$callid}')");
$calltid=str_pad($callid,5,"0",STR_PAD_LEFT);
$calltid=$_SESSION['shortname'].$_SESSION['currentyear'].$_SESSION['financialyear'].$_SESSION['month'].$calltid;
$sqlcallup = "update jrccalls set calltid='$calltid' where id='$callid'";
$querycallup = mysqli_query($connection, $sqlcallup);
if(!$querycallup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
if($engineertype=="0")
{
mysqli_query($connection, "INSERT INTO jrccallstravel( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engineeridvalue', '$engineernamevalue')");
}
else
{
$engnames=explode(',',$_POST['engineersname']);
for($i=0; $i<count($_POST['engineersid']); $i++)
{
$engname=$engnames[$i];
$engid=$_POST['engineersid'][$i];
if($engid!='')
{
mysqli_query($connection, "INSERT INTO jrccallstravel( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engid', '$engname')");
}
}
}
$sqlup2 = "INSERT INTO jrccallshistory( sourceid, consigneeid, callfrom, callnature, customernature, businesstype, servicetype, calltype, callon, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, otherremarks, customersms, callhandledsms, coordinatorsms, engineersms, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial,problemobserved, diagnosissignname,diagnosissignmode ,diagnosissignmoderemark, diagnosissignature, godownname,engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$callfromvalue', '$callnature', '$customernature', '$businesstype', '$servicetype', '$calltype', '$callonvalue', '$callhandlingidvalue', '$callhandlingnamevalue', '$reportedproblemvalue', '$coordinatoridvalue', '$coordinatornamevalue', '$engineeridvalue', '$engineernamevalue', '$otherremarksvalue', '$customersmsvalue', '$callhandledsmsvalue', '$coordinatorsmsvalue', '$engineersmsvalue', '$serial', '$diagnosisby', '$diagnosisengineername', '$diagnosisengineerid', '$diagnosiscoordinatorname', '$diagnosiscoordinatorid', '$diagnosison', '$diagnosisestdate', '$diagnosisestcharge', '$diagnosisimg', '$diagnosisremarks', '$diagnosismaterial','$problemobserved' ,'$diagnosissignname' ,'$diagnosissignmode' ,'$diagnosissignmoderemark' ,'$diagnosissignature', '$godownname', '$engineertype', '$engineersname', '$engineersid', '$reportingtype', '$reportingengineerid', '$reportingengineername')";
$queryup2 = mysqli_query($connection, $sqlup2);
if($engineertype=="0")
{
mysqli_query($connection, "INSERT INTO jrccallstravelhistory( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engineeridvalue', '$engineernamevalue')");
}
else
{
$engnames=explode(',',$_POST['engineersname']);
for($i=0; $i<count($_POST['engineersid']); $i++)
{
$engname=$engnames[$i];
$engid=$_POST['engineersid'][$i];
if($engid!='')
{
mysqli_query($connection, "INSERT INTO jrccallstravelhistory( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engid', '$engname')");
}
}
}
}
if($customersmsvalue=="0")
{
	            $sql = "SELECT email From jrcconsignee where id='".$id."' order by id asc";
				$query = mysqli_query($connection, $sql);
				$rowCount = mysqli_num_rows($query);
				if(!$query){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCount > 0)
				{
					$count=1;
				$row = mysqli_fetch_array($query);
		        /* Mail*/	
				 if($row['email']!="")
			       {
					   if(isset($_POST['engineerwa']))
				{
			        $mailsubject="New ".$callnature." call Assigned: Call ID ".$calltid;
					$mailcontent="Dear Customer, Your ".$callnature." call is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") - JRC";
					$mailsendto=trim($row['email']);
					sendmail($_SESSION['mailer'], $_SESSION['companyname'], $mailsubject, $mailcontent, $_SESSION['mailname'], $_SESSION['apppassword'], $mailsendto);
				   }
				}
				}
if($companyid=='1')
{
////////jrc
/* $custmessage="Dear Customer, Your Complaint is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") JR.";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "https://bulksms.agasoft.co.in/api/sendsms?username=jrcomm&password=jerald123&senderid=JRCUPS&message=".$custmessage."&numbers=".$callfromvalue."&dndrefund=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch); */
$custmessage="Dear Customer, Your Complaint is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") - JRC";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=3ca2502224cfe2ef09eeb478616eb524&route=2&sender=JRCUPS&number=".$callfromvalue."&sms=".$custmessage."&templateid=1707161899511929324";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='6')
{
////////////uel
$custmessage="Dear Customer, thank you for calling UEL . Your Complaint Registration number is : ".$calltid."(".$otherremarksvalue.").Our Service Engineer (".$engineernamevalue.") will contact you shortly.- UEL POWER";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$callfromvalue."&sms=".$custmessage."&templateid=1707164249593635593";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='84')
{
////////////Sharp
$custmessage="Dear Customer, Your ".$callnature." call is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") - Sharp";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "http://www.nminfotech.in/smsautosend.aspx?id=SHARPC&PWD=SHARPC&mob=".$callfromvalue."&msg=".$custmessage."&tm=T";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
}
if($engineersmsvalue=="0")
{
$sqlxl = "SELECT * From jrcxl where tdelete='0' and  id='".$sourceidvalue."' order by id asc";
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
if($engineertype=="0")
{
$sqleng = "SELECT mobile,email From jrcengineer where id='".$engineeridvalue."' order by username asc";
}
else
{
$sqleng = "SELECT mobile,email From jrcengineer where id in ('".$engineersid."') order by username asc";
}
$queryeng = mysqli_query($connection, $sqleng);
$rowCounteng = mysqli_num_rows($queryeng);
if(!$queryeng){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCounteng > 0)
{
$count=1;
while($roweng = mysqli_fetch_array($queryeng))
{
	if($roweng['email']!="")
	{
		if(isset($_POST['engineerwa']))
				{
	/* Mail*/	
$mailsubject="New ".$callnature." call Assigned: Call ID ".$calltid;
$mailcontent=$engmessage1="Dear Friend, Call ID: ".$calltid."<br>
Co-Ordntr: ".$coordinatornamevalue."<br>
Problem: ".$reportedproblemvalue."<br>
Product: ".$rowxl['stockitem']."<br>
Serial: ".$serial."<br>
Address:".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']."<br>
District:".$rowxl['district']."-".$rowxl['pincode']."<br>
Contact: ".$rowxl['contact']."-".$rowxl['mobile']."<br>
Jr Comm";
$mailsendto=$roweng['email'];
sendmail($_SESSION['mailer'], $_SESSION['companyname'], $mailsubject, $mailcontent, $_SESSION['mailname'], $_SESSION['apppassword'], $mailsendto);
	}
	}
if($companyid=='1')
{
////////jrc
$engmessage=$engmessage1="Dear Friend, Call ID: ".$calltid." %0aCo-Ordntr: ".$coordinatornamevalue."%0aProblem: ".$reportedproblemvalue."%0aProduct: ".$rowxl['stockitem']."%0aSerial: ".$serial."%0aAddress:".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']."%0aDistrict:".$rowxl['district']."-".$rowxl['pincode']."%0aContact: ".$rowxl['contact']."-".$rowxl['mobile']."%0aJr Comm";
$engmessage=preg_replace('!\s+!', ' ', $engmessage);
$engmessage=str_replace(',,', ',', $engmessage);
$engmessage=urlencode($engmessage);
$url = "https://bulksms.agasoft.co.in/api/sendsms?username=jrcomm&password=jerald123&senderid=JRCUPS&message=".$engmessage."&numbers=".$roweng['mobile']."&dndrefund=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='6')
{
////////////uel
$engmessage=$engmessage1="Dear Friend, Call ID: ".$calltid."%0aCo-Ordntr: ".$coordinatornamevalue." %0aProblem: ".$reportedproblemvalue." (".$otherremarksvalue.") %0aProduct: ".$rowxl['stockitem']." %0aSerial: ".$serial." %0aAddress: ".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']." %0aDistrict: ".$rowxl['district']."-".$rowxl['pincode']." %0aContact: ".$rowxl['contact']."-".$rowxl['mobile']." %0aUEL POWER";
$engmessage=preg_replace('!\s+!', ' ', $engmessage);
$engmessage=str_replace(',,', ',', $engmessage);
$engmessage=urlencode($engmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$roweng['mobile']."&sms=".$engmessage."&templateid=1707164249561407061";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='84')
{
////////////Sharp
$engmessage=$engmessage1="Dear Friend, Call ID: ".$calltid." %0aCo-Ordntr: ".$coordinatornamevalue."%0aProblem: ".$reportedproblemvalue."%0a
Product: ".$rowxl['stockitem']."%0aSerial: ".$serial."%0aAddress:".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']."%0aDistrict:".$rowxl['district']."-".$rowxl['pincode']."%0aContact: ".$rowxl['contact']."-".$rowxl['mobile']."%0aSharp";
$engmessage=preg_replace('!\s+!', ' ', $engmessage);
$engmessage=str_replace(',,', ',', $engmessage);
$engmessage=urlencode($engmessage);
$url ="http://www.nminfotech.in/smsautosend.aspx?id=SHARPC&PWD=SHARPC&mob=".$roweng['mobile']."&msg=".$engmessage."&tm=T";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
}
}
}
if($coordinatorsmsvalue=="0")
{
$sqlcoor = "SELECT * From jrccoordinator where id='".$coordinatoridvalue."' order by username asc";
$querycoor = mysqli_query($connection, $sqlcoor);
$rowCountcoor = mysqli_num_rows($querycoor);
if(!$querycoor){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcoor > 0)
{
$count=1;
while($rowcoor = mysqli_fetch_array($querycoor))
{
	if($rowcoor['email']!="")
	{
		if(isset($_POST['engineerwa']))
				{
	/* Mail*/	
$mailsubject="New ".$callnature." call Assigned: Call ID ".$calltid;
$mailcontent="Dear Co-ordinator, Call ID ".$calltid." is Assigned to Engineer: ".$engineernamevalue."\n";
$mailsendto=$rowcoor['email'];
sendmail($_SESSION['mailer'], $_SESSION['companyname'], $mailsubject, $mailcontent, $_SESSION['mailname'], $_SESSION['apppassword'], $mailsendto);
	}
	}
if($companyid=='1')
{
////////jrc
$coormessage=$coormessage1="Dear Co-ordinator, Call ID ".$calltid." is Assigned to Engineer: ".$engineernamevalue."\n";
$coormessage=preg_replace('!\s+!', ' ', $coormessage);
$coormessage=str_replace(',,', ',', $coormessage);
$coormessage=urlencode($coormessage);
$url = "https://bulksms.agasoft.co.in/api/sendsms?username=jrcomm&password=jerald123&senderid=JRCUPS&message=".$coormessage."&numbers=".$rowcoor['mobile']."&dndrefund=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='6')
{
////////////uel
$coormessage=$coormessage1="Dear Co-ordinator, Call ID ".$calltid." is Assigned to Engineer: ".$engineernamevalue." -UEL";
$coormessage=preg_replace('!\s+!', ' ', $coormessage);
$coormessage=str_replace(',,', ',', $coormessage);
$coormessage=urlencode($coormessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$rowcoor['mobile']."&sms=".$coormessage."&templateid=1707164249566055820";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='84')
{
////////////Sharp
$coormessage=$coormessage1="Dear Co-ordinator, Call ID ".$calltid." is Assigned to Engineer: ".$engineernamevalue."\n";
$coormessage=preg_replace('!\s+!', ' ', $coormessage);
$coormessage=str_replace(',,', ',', $coormessage);
$coormessage=urlencode($coormessage);
$url = "http://www.nminfotech.in/smsautosend.aspx?id=SHARPC&PWD=SHARPC&mob=".$rowcoor['mobile']."&msg=".$coormessage."&tm=T"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
}
}
}
/* Notifications */
$sqlxl = "SELECT id, stockitem, consigneename, address1, address2, area, district, pincode, contact, mobile From jrcxl where tdelete='0' and  id='".$sourceidvalue."' order by id asc";
$queryxl = mysqli_query($connection, $sqlxl);
$rowCountxl = mysqli_num_rows($queryxl);
if(!$queryxl){
die("SQL query failed: " . mysqli_error($connection));
}
$rowxl = mysqli_fetch_array($queryxl);
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowxl['address1']!='')
		{
		$rowxl['address1']=jbsdecrypt($_SESSION['encpass'], $rowxl['address1']);
		}
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($_SESSION['encpass'], $rowxl['mobile']);
		}
	}
}
if($engineertype=="0")
{
$sqleng = "SELECT username From jrcengineer where id='".$engineeridvalue."' order by username asc";
}
else
{
$sqleng = "SELECT username From jrcengineer where id in ('".$engineersid."') order by username asc";
}
$queryeng = mysqli_query($connection, $sqleng);
$rowCounteng = mysqli_num_rows($queryeng);
if(!$queryeng){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCounteng > 0)
{
$count=1;
while($roweng = mysqli_fetch_array($queryeng))
{
$sqlist=mysqli_query($connection, "select userid from jrcdevices where loginid='".$roweng['username']."'");
while($infost=mysqli_fetch_array($sqlist))
{
sendNotifications("New Call (".$calltid.") - Assigned", $infost['userid'], $rowxl['stockitem']." - ".$reportedproblemvalue."\n".$rowxl['consigneename']." - ".$rowxl['address1'].", ".$rowxl['address2'].", ".$rowxl['area'].", ".$rowxl['district']."-".$rowxl['pincode']."\n".$rowxl['contact']."-".$rowxl['mobile'], $_SESSION['companysiteurl'], $calltid);
}
}
}
/*Notifications*/
if($servicetype=='Carry-In')
		{
			
				header("Location: calls.php?status=0&emarks=Added Successfully");
			
		}
		else{
//header("Location: calls.php?status=0&remarks=Added Successfully");
		}
}
}
else
{
header("Location: calls.php?status=0&&error=Already A Complaint is Open for this Customer and Product! Kindly Close it");
}
}
}
else
{
header("Location: consignee.php?error=Error Data");
}
}
else
{
header("Location: dashboard.php");
}
?>