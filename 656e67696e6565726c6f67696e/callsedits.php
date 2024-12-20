<?php
include('lcheck.php');
if($calladd=='0')
{
header("location: dashboard.php");
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$sourceidvalue=mysqli_real_escape_string($connection, $_POST['sourceid']);
$consigneeidvalue=mysqli_real_escape_string($connection, $_POST['consigneeid']);
$callfromvalue=mysqli_real_escape_string($connection, $_POST['callfrom']);
$callnature=mysqli_real_escape_string($connection, $_POST['callnature']);
$servicetype=mysqli_real_escape_string($connection, $_POST['servicetype']);
$customernature=mysqli_real_escape_string($connection, $_POST['customernature']);
$calltype=mysqli_real_escape_string($connection, $_POST['calltype']);
$businesstype=mysqli_real_escape_string($connection, $_POST['businesstype']);
$callonvalue=mysqli_real_escape_string($connection, $_POST['callon']);
$callhandlingidvalue=mysqli_real_escape_string($connection, $_POST['callhandlingid']);
$callhandlingnamevalue=mysqli_real_escape_string($connection, $_POST['callhandlingname']);
$reportedproblemvalue=mysqli_real_escape_string($connection, $_POST['reportedproblem']);
$coordinatoridvalue=mysqli_real_escape_string($connection, $_POST['coordinatorid']);
$coordinatornamevalue=mysqli_real_escape_string($connection, $_POST['coordinatorname']);
$engineeridvalue=mysqli_real_escape_string($connection, $_POST['engineerid']);
$engineernamevalue=mysqli_real_escape_string($connection, $_POST['engineername']);
$otherremarksvalue=mysqli_real_escape_string($connection, $_POST['otherremarks']);
$id=mysqli_real_escape_string($connection, $_POST['id']);
$calltid=mysqli_real_escape_string($connection, $_POST['calltid']);
$callfromvalue=mysqli_real_escape_string($connection, $_POST['callfrom']);
$compstatusvalue=mysqli_real_escape_string($connection, $_POST['compstatus']);
$problemobservedvalue=mysqli_real_escape_string($connection, $_POST['problemobserved']);
$actiontakenvalue=mysqli_real_escape_string($connection, $_POST['actiontaken']);
$servicereportnovalue=mysqli_real_escape_string($connection, $_POST['servicereportno']);
$visitremarksvalue=mysqli_real_escape_string($connection, $_POST['visitremarks']);
$estimatedcostvalue=mysqli_real_escape_string($connection, $_POST['estimatedcost']);
$materialtrackingvalue=mysqli_real_escape_string($connection, $_POST['materialtracking']);
$narrationvalue=mysqli_real_escape_string($connection, $_POST['narration']);
$callhandlingidvalue=mysqli_real_escape_string($connection, $_POST['callhandlingid']);
$callhandlingnamevalue=mysqli_real_escape_string($connection, $_POST['callhandlingname']);
$reportedproblemvalue=mysqli_real_escape_string($connection, $_POST['reportedproblem']);
$coordinatoridvalue=mysqli_real_escape_string($connection, $_POST['coordinatorid']);
$coordinatornamevalue=mysqli_real_escape_string($connection, $_POST['coordinatorname']);
$engineeridvalue=mysqli_real_escape_string($connection, $_POST['engineerid']);
$engineernamevalue=mysqli_real_escape_string($connection, $_POST['engineername']);
$customersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['customersms']))?'0':'1'));
$callhandledsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['callhandledsms']))?'0':'1'));
$coordinatorsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['coordinatorsms']))?'0':'1'));
$engineersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['engineersms']))?'0':'1'));
$serial=mysqli_real_escape_string($connection, $_POST['serial']);
$startip=mysqli_real_escape_string($connection, $_POST['startip']);
$startiptime=mysqli_real_escape_string($connection, $_POST['startiptime']);
$endiptime=mysqli_real_escape_string($connection, $_POST['endiptime']);
$endip=mysqli_real_escape_string($connection, $_POST['endip']);
$kms=mysqli_real_escape_string($connection, $_POST['kms']);
$detailsid=mysqli_real_escape_string($connection, $_POST['detailsid']);
$pendingon1=mysqli_real_escape_string($connection, $_POST['pendingon1']);
$pendingon2=mysqli_real_escape_string($connection, $_POST['pendingon2']);
$pendingon3=mysqli_real_escape_string($connection, $_POST['pendingon3']);
if($compstatusvalue=='2')
{
$statitle="has been Closed";
}
else if($compstatusvalue=='1')
{
$statitle="is being Pending";
}
else
{
$statitle="is Still in Open Status";
}
if(($compstatusvalue!=""))
{
$sqlcon = "SELECT id From jrccalls WHERE id = '{$id}'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon > 0)
{
$sqlup = "update jrccalls set businesstype='$businesstype', calltype='$calltype', callnature='$callnature', customernature='$customernature', servicetype='$servicetype', compstatus='$compstatusvalue', problemobserved='$problemobservedvalue',  actiontaken='$actiontakenvalue', servicereportno='$servicereportnovalue', visitremarks='$visitremarksvalue', estimatedcost='$estimatedcostvalue', materialtracking='$materialtrackingvalue', narration='$narrationvalue', changeon='$times', customersms='$customersmsvalue', callhandledsms='$callhandledsmsvalue', coordinatorsms='$coordinatorsmsvalue', engineersms='$engineersmsvalue', detailsapprove='1' where id='$id'";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
if($compstatusvalue=='1')
{
if(($pendingon1=='')||($pendingon1 === NULL))
{
mysqli_query($connection,"update jrccalls set pendingon1='$times' where id='$id'");
}
else
{
if(($pendingon2=='')||($pendingon2 === NULL))
{
mysqli_query($connection,"update jrccalls set pendingon2='$times' where id='$id'");
}
else
{
if(($pendingon3=='')||($pendingon3 === NULL))
{
mysqli_query($connection,"update jrccalls set pendingon3='$times' where id='$id'");
}
}
}
}
$title = $calltid.'-'.$engineernamevalue;
$sqlUpdate = "UPDATE jrcnotification SET notif_loop = 0 WHERE title='$title'";
mysqli_query($connection, $sqlUpdate);
$callstatus='';
if($compstatusvalue=='1')
{
$callstatus='Pending';
}
if($compstatusvalue=='2')
{
$callstatus='Completed';
}
$sqlUpdate = "UPDATE jrccalldetails SET callstatus = '$callstatus', problemobserved = '$problemobservedvalue', actiontaken = '$actiontakenvalue', engineerreport = '$narrationvalue' WHERE calltid='$calltid' and reassign='0'";
mysqli_query($connection, $sqlUpdate);
$sqlup2 = "INSERT INTO jrccallshistory(calltid, sourceid, consigneeid, callfrom, callon, servicetype, businesstype, calltype, callnature, customernature, modifiedon, modifyreason, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, otherremarks, compstatus, problemobserved, actiontaken, servicereportno, visitremarks, estimatedcost, materialtracking, narration, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial, diagnosissignname, diagnosissignature, dcno, dcdate, suppliername, supwarrantytype, supcourierdate, supcourierdetails, supcouriercharges, supcourierpaytype, supcourierimg, supcomplaintno, supcomplaintremarks, supestimatedcost, supestdelivery, taxablevalue, changeon, pendingon1, pendingon2, pendingon3, customersms, callhandledsms, coordinatorsms, engineersms, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, detailsapprove, acknowlodge, suprcourierdate, suprcourierdetails, suprcouriercharges, suprcourierpaytype, suprcourierimg, supcompstatus, quotationgen) select calltid, sourceid, consigneeid, callfrom, callon, servicetype, businesstype, calltype, callnature, customernature, modifiedon, modifyreason, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, otherremarks, compstatus, problemobserved, actiontaken, servicereportno, visitremarks, estimatedcost, materialtracking, narration, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial, diagnosissignname, diagnosissignature, dcno, dcdate, suppliername, supwarrantytype, supcourierdate, supcourierdetails, supcouriercharges, supcourierpaytype, supcourierimg, supcomplaintno, supcomplaintremarks, supestimatedcost, supestdelivery, taxablevalue, changeon, pendingon1, pendingon2, pendingon3, customersms, callhandledsms, coordinatorsms, engineersms, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, detailsapprove, acknowlodge, suprcourierdate, suprcourierdetails, suprcouriercharges, suprcourierpaytype, suprcourierimg, supcompstatus, quotationgen from jrccalls where calltid='$calltid'";
$queryup2 = mysqli_query($connection, $sqlup2);
$sqlup2 = "INSERT INTO jrccallstravelhistory(calltid, sourceid, consigneeid, engineerid, engineername, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, workper, detailsapprove, acknowlodge) select calltid, sourceid, consigneeid, engineerid, engineername, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, workper, detailsapprove, acknowlodge FROM jrccallstravel where calltid='$calltid'";
$queryup2 = mysqli_query($connection, $sqlup2);
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A Call Complaint.', '{$id}')");
if($customersmsvalue=="0")
{
if($compstatusvalue=='2')
{
if($companyid=='1')
{
////////jrc
/* $custmessage="Dear Customer, Your Call with Call ID ".$calltid." is Completed. Kindly Share Your Feedback to improve our Service. Thank You - JRC";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "https://bulksms.agasoft.co.in/api/sendsms?username=jrcomm&password=jerald123&senderid=JRCUPS&message=".$custmessage."&numbers=".$callfromvalue."&dndrefund=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch); */
$custmessage="Dear Customer, Your Call with Call ID ".$calltid." is Completed. Kindly Share Your Feedback to improve our Service. Thank You - JRC";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=3ca2502224cfe2ef09eeb478616eb524&route=2&sender=UELABO&number=".$callfromvalue."&sms=".$custmessage."&templateid=1707161899525527417";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='6')
{
////////////uel
$custmessage="Dear Customer, Your Call with Call ID ".$calltid." is Completed. Kindly Share Your Feedback to improve our Service. Thank You -UEL";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$callfromvalue."&sms=".$custmessage."&templateid=1707164256974755074";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
}
else if($compstatusvalue=='1')
{
if($companyid=='1')
{
////////jrc
$custmessage="Dear Customer, Your Call Id(".$calltid.")is Pending. Regret for the inconvenience, Will be Closed Shortly - JRC";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "https://bulksms.agasoft.co.in/api/sendsms?username=jrcomm&password=jerald123&senderid=JRCUPS&message=".$custmessage."&numbers=".$callfromvalue."&dndrefund=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
if($companyid=='6')
{
////////////uel
$custmessage="Dear Customer, Your Call Id(".$calltid.")is Pending. Regret for the inconvenience, Will be Closed Shortly - UEL";
$custmessage=preg_replace('!\s+!', ' ', $custmessage);
$custmessage=str_replace(',,', ',', $custmessage);
$custmessage=urlencode($custmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$callfromvalue."&sms=".$custmessage."&templateid=1707164249571142565";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
}
}
else
{
}
}
if($engineersmsvalue=="0")
{
if($engineertype=="0")
{
$sqleng = "SELECT mobile From jrcengineer where id='".$engineeridvalue."' order by username asc";
}
else
{
$sqleng = "SELECT mobile From jrcengineer where id in ('".$engineersid."') order by username asc";
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
if($companyid=='1')
{
////////jrc
$engmessage="Dear Friend, Call ID: ".$calltid." ".$statitle;
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
$engmessage="Dear Friend, Call ID: ".$calltid."".$statitle." -UEL";
$engmessage=preg_replace('!\s+!', ' ', $engmessage);
$engmessage=str_replace(',,', ',', $engmessage);
$engmessage=urlencode($engmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$roweng['mobile']."&sms=".$engmessage."&templateid=1707164249577750803";
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
if($companyid=='1')
{
////////jrc
$coormessage="Dear Co-ordinator, Call ID ".$calltid." ".$statitle;
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
$coormessage="Dear Co-ordinator, Call ID ".$calltid."".$statitle." -UEL";
$coormessage=preg_replace('!\s+!', ' ', $coormessage);
$coormessage=str_replace(',,', ',', $coormessage);
$coormessage=urlencode($coormessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$rowcoor['mobile']."&sms=".$coormessage."&templateid=1707164249582801405";
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
sendNotifications("Call (".$calltid.") - ".$callstatus, $infost['userid'], $rowxl['stockitem']." - ".$problemobservedvalue."\n".$rowxl['consigneename']." - ".$rowxl['address1'].", ".$rowxl['address2'].", ".$rowxl['area'].", ".$rowxl['district']."-".$rowxl['pincode']."\n".$rowxl['contact']."-".$rowxl['mobile'], $_SESSION['companysiteurl'], $calltid);
}
}
}
/*Notifications*/
header("Location: calls.php?remarks=Your call has been closed successfully");
}
}
else
{
header("Location: calls.php?error=Already A Complaint is Open for this Customer and Product! Kindly Close it");
}
}
else
{
header("Location: calls.php?error=Error Data");
}
}
else
{
header("Location: calls.php");
}
?>