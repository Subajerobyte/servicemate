<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
		$calltid=mysqli_real_escape_string($connection, $_POST['calltid']);
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
	$oldcoordinatoridvalue=mysqli_real_escape_string($connection, $_POST['oldcoordinatorid']);
	$oldcoordinatornamevalue=mysqli_real_escape_string($connection, $_POST['oldcoordinatorname']);
	$oldengineeridvalue=mysqli_real_escape_string($connection, $_POST['oldengineerid']);
	$oldengineernamevalue=mysqli_real_escape_string($connection, $_POST['oldengineername']);
	$coordinatoridvalue=mysqli_real_escape_string($connection, $_POST['coordinatorid']);
	$coordinatornamevalue=mysqli_real_escape_string($connection, $_POST['coordinatorname']);
	$engineeridvalue=mysqli_real_escape_string($connection, $_POST['engineerid']);
	$engineernamevalue=mysqli_real_escape_string($connection, $_POST['engineername']);
	
	$oldengineertype=mysqli_real_escape_string($connection, $_POST['oldengineertype']);
		$oldengineersname=mysqli_real_escape_string($connection, $_POST['oldengineersname']);
		$oldengineersid=mysqli_real_escape_string($connection, $_POST['oldengineersid']);
		$oldreportingtype=mysqli_real_escape_string($connection, $_POST['oldreportingtype']);
		$oldreportingengineerid=mysqli_real_escape_string($connection, $_POST['oldreportingengineerid']);
		$oldreportingengineername=mysqli_real_escape_string($connection, $_POST['oldreportingengineername']);	
		
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
	
	
	
	$otherremarksvalue=mysqli_real_escape_string($connection, $_POST['otherremarks']);
	$modifyreasonvalue=mysqli_real_escape_string($connection, $_POST['modifyreason']);
	$compstatusvalue=mysqli_real_escape_string($connection, $_POST['compstatus']);
		$problemobservedvalue=mysqli_real_escape_string($connection, $_POST['problemobserved']);
		$actiontakenvalue=mysqli_real_escape_string($connection, $_POST['actiontaken']);
		$servicereportnovalue=mysqli_real_escape_string($connection, $_POST['servicereportno']);
		$visitremarksvalue=mysqli_real_escape_string($connection, $_POST['visitremarks']);
		$estimatedcostvalue=mysqli_real_escape_string($connection, $_POST['estimatedcost']);
		$materialtrackingvalue=mysqli_real_escape_string($connection, $_POST['materialtracking']);
		$narrationvalue=mysqli_real_escape_string($connection, $_POST['narration']);
		$changeon=mysqli_real_escape_string($connection, $_POST['changeon']);
		$startip=mysqli_real_escape_string($connection, $_POST['startip']);
		$startiptime=mysqli_real_escape_string($connection, $_POST['startiptime']);
		$endiptime=mysqli_real_escape_string($connection, $_POST['endiptime']);
		$endip=mysqli_real_escape_string($connection, $_POST['endip']);
		$kms=mysqli_real_escape_string($connection, $_POST['kms']);
		$detailsid=mysqli_real_escape_string($connection, $_POST['detailsid']);
		$detailsapprove=mysqli_real_escape_string($connection, $_POST['detailsapprove']);
	$customersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['customersms']))?'0':'1'));
	$callhandledsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['callhandledsms']))?'0':'1'));
	$coordinatorsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['coordinatorsms']))?'0':'1'));
	$engineersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['engineersms']))?'0':'1'));
	$reassign=mysqli_real_escape_string($connection, $_POST['reassign']);
	$serial=mysqli_real_escape_string($connection, $_POST['serial']);
	$diagnosisby=mysqli_real_escape_string($connection, ((isset($_POST['diagnosisby']))?$_POST['diagnosisby']:''));
	$diagnosisengineername=mysqli_real_escape_string($connection, $_POST['diagnosisengineername']);
	$diagnosisengineerid=mysqli_real_escape_string($connection, $_POST['diagnosisengineerid']);
	$diagnosissignname=mysqli_real_escape_string($connection, $_POST['diagnosissignname']);
	$diagnosissignmode=mysqli_real_escape_string($connection, $_POST['diagnosissignmode']);
	$diagnosiscoordinatorname=mysqli_real_escape_string($connection, $_POST['diagnosiscoordinatorname']);
	$diagnosiscoordinatorid=mysqli_real_escape_string($connection, $_POST['diagnosiscoordinatorid']);
	$diagnosison=mysqli_real_escape_string($connection, $_POST['diagnosison']);
	$problemobserved=mysqli_real_escape_string($connection, $_POST['problemobserved']);
	$diagnosisestdate=mysqli_real_escape_string($connection, $_POST['diagnosisestdate']);
	$diagnosisestcharge=(float)mysqli_real_escape_string($connection, $_POST['diagnosisestcharge']);
	$diagnosisimg=mysqli_real_escape_string($connection, $_POST['diagnosisimg']);
	$godownname=mysqli_real_escape_string($connection, $_POST['godownname']);
	$suppliername=mysqli_real_escape_string($connection, $_POST['suppliername']);
	$diagnosisremarks=mysqli_real_escape_string($connection, $_POST['diagnosisremarks']);
	if(!empty($_POST['diagnosismaterial']))
	{
		$diagnosismaterial=mysqli_real_escape_string($connection, implode(' | ',$_POST['diagnosismaterial']));
	}
	else
	{
		$diagnosismaterial="";
	}
	
	


	if(($callonvalue!="")&&($callonvalue!="User Name(Unique)"))
	{		
        $sqlcon = "SELECT id From jrccalls WHERE sourceid = '{$sourceidvalue}' and calltid = '{$calltid}' and serial = '{$serial}' and compstatus = '2'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcon == 0)  
		{
			
			$sqlup2 = "INSERT INTO jrccallshistory(calltid, sourceid, consigneeid, callfrom, callon, servicetype, businesstype, calltype, callnature, customernature, modifiedon, modifyreason, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, otherremarks, compstatus, problemobserved, actiontaken, servicereportno, visitremarks, estimatedcost, materialtracking, narration, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, godownname, diagnosisremarks, diagnosismaterial, diagnosissignname, diagnosissignmode,diagnosissignmoderemark,  dcno, dcdate, suppliername, supwarrantytype, supcourierdate, supcourierdetails, supcouriercharges, supcourierpaytype, supcourierimg, supcomplaintno, supcomplaintremarks, supestimatedcost, supestdelivery, taxablevalue, changeon, pendingon1, pendingon2, pendingon3, customersms, callhandledsms, coordinatorsms, engineersms, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, detailsapprove, acknowlodge, suprcourierdate, suprcourierdetails, suprcouriercharges, suprcourierpaytype, suprcourierimg, supcompstatus, quotationgen) select calltid, sourceid, consigneeid, callfrom, callon, servicetype, businesstype, calltype, callnature, customernature, modifiedon, modifyreason, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, otherremarks, compstatus, problemobserved, actiontaken, servicereportno, visitremarks, estimatedcost, materialtracking, narration, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, godownname, diagnosisremarks, diagnosismaterial, diagnosissignname,  diagnosissignmode,diagnosissignmoderemark, dcno, dcdate, suppliername, supwarrantytype, supcourierdate, supcourierdetails, supcouriercharges, supcourierpaytype, supcourierimg, supcomplaintno, supcomplaintremarks, supestimatedcost, supestdelivery, taxablevalue, changeon, pendingon1, pendingon2, pendingon3, customersms, callhandledsms, coordinatorsms, engineersms, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, detailsapprove, acknowlodge, suprcourierdate, suprcourierdetails, suprcouriercharges, suprcourierpaytype, suprcourierimg, supcompstatus, quotationgen from jrccalls where calltid='$calltid'";
			$queryup2 = mysqli_query($connection, $sqlup2);
			
			$sqlup2 = "INSERT INTO jrccallstravelhistory(calltid, sourceid, consigneeid, engineerid, engineername, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, workper, detailsapprove, acknowlodge) select calltid, sourceid, consigneeid, engineerid, engineername, startip, startiptime, endip, endiptime, kms, detailsid, worktype, workpoint, workper, detailsapprove, acknowlodge FROM jrccallstravel where calltid='$calltid'";
			$queryup2 = mysqli_query($connection, $sqlup2); 
			
				if($reassign=='1')
				{
					$sqlup = "update jrccalls set businesstype='$businesstype', calltype='$calltype',compstatus='0', callnature='$callnature', customernature='$customernature', servicetype='$servicetype', callhandlingid='$callhandlingidvalue', callhandlingname='$callhandlingnamevalue', reportedproblem='$reportedproblemvalue',  coordinatorid='$coordinatoridvalue', coordinatorname='$coordinatornamevalue', engineerid='$engineeridvalue', engineername='$engineernamevalue', otherremarks='$otherremarksvalue', modifiedon='$times', modifyreason='$modifyreasonvalue', customersms='$customersmsvalue', callhandledsms='$callhandledsmsvalue', coordinatorsms='$coordinatorsmsvalue', engineersms='$engineersmsvalue', serial='$serial', diagnosisby='$diagnosisby', diagnosisengineername='$diagnosisengineername', diagnosisengineerid='$diagnosisengineerid', diagnosissignmode ='$diagnosissignmode', diagnosissignname='$diagnosissignname', diagnosiscoordinatorname='$diagnosiscoordinatorname', diagnosiscoordinatorid='$diagnosiscoordinatorid', diagnosison='$diagnosison', diagnosisestdate='$diagnosisestdate', diagnosisestcharge='$diagnosisestcharge', engineertype='$engineertype', engineersname='$engineersname', engineersid='$engineersid', reportingtype='$reportingtype', reportingengineerid='$reportingengineerid', reportingengineername='$reportingengineername', diagnosisimg='$diagnosisimg', godownname='$godownname', suppliername='$suppliername', diagnosisremarks='$diagnosisremarks', diagnosismaterial='$diagnosismaterial', problemobserved='', actiontaken='', servicereportno='', visitremarks='', estimatedcost='', materialtracking='', narration='', startip='', startiptime='', endiptime='', endip='', kms='', detailsid='', detailsapprove='0', acknowlodge='0', callfrom='$callfromvalue' where id='$id'";
					
					
					mysqli_query($connection, "update jrccallstravel set startip='', startiptime='', endiptime='', endip='', kms='', detailsid='', worktype='', workpoint='', workper='', detailsapprove='0', acknowlodge='0' where calltid='$calltid'");
					
				}
				else
				{
					$sqlup = "update jrccalls set businesstype='$businesstype', calltype='$calltype', callnature='$callnature', customernature='$customernature', servicetype='$servicetype', callhandlingid='$callhandlingidvalue', callhandlingname='$callhandlingnamevalue', reportedproblem='$reportedproblemvalue',  coordinatorid='$coordinatoridvalue', coordinatorname='$coordinatornamevalue', engineerid='$engineeridvalue', engineername='$engineernamevalue', otherremarks='$otherremarksvalue', modifiedon='$times', modifyreason='$modifyreasonvalue', customersms='$customersmsvalue', callhandledsms='$callhandledsmsvalue', coordinatorsms='$coordinatorsmsvalue', engineersms='$engineersmsvalue', serial='$serial', diagnosisby='$diagnosisby', diagnosisengineername='$diagnosisengineername', diagnosisengineerid='$diagnosisengineerid', diagnosissignmode ='$diagnosissignmode', diagnosissignname='$diagnosissignname', diagnosiscoordinatorname='$diagnosiscoordinatorname', diagnosiscoordinatorid='$diagnosiscoordinatorid', diagnosison='$diagnosison', diagnosisestdate='$diagnosisestdate', diagnosisestcharge='$diagnosisestcharge', engineertype='$engineertype', engineersname='$engineersname', engineersid='$engineersid', reportingtype='$reportingtype', reportingengineerid='$reportingengineerid', reportingengineername='$reportingengineername', diagnosisimg='$diagnosisimg', godownname='$godownname', suppliername='$suppliername', diagnosisremarks='$diagnosisremarks', diagnosismaterial='$diagnosismaterial', problemobserved='$problemobserved', callfrom='$callfromvalue'  where id='$id'";
				}
			
			$queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				if($servicetype=="Carry-In")
				{
				 mysqli_query($connection,"update jrcgodownproduct set  godownid='$godownname',  receivedby='$diagnosissignname' where callid='$id'");	
				}
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Change Details in A Call Complaint', '{$id}')");
			$sqlcallup = "update jrccalldetails set reassign='1' where id='$detailsid'";
			$querycallup = mysqli_query($connection, $sqlcallup);
			if(!$querycallup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				if($engineertype!=$oldengineertype)
				{
					mysqli_query($connection, "delete from jrccallstravel where calltid='$calltid'");
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
							$engid=mysqli_real_escape_string($connection, $_POST['engineersid'][$i]);
							if($engid!='')
							{
								mysqli_query($connection, "INSERT INTO jrccallstravel( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engid', '$engname')");					
							}						
						}
					}
				}
				else
				{
					if($engineertype=="0")
					{
						if($engineeridvalue!=$oldengineeridvalue)
						{
							mysqli_query($connection, "delete from jrccallstravel where calltid='$calltid'");
							mysqli_query($connection, "INSERT INTO jrccallstravel( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engineeridvalue', '$engineernamevalue')");	
							/* //Notifications
							/* Notifications */			
 /* $sqlxl = "SELECT phone, email, stockitem, consigneename, address1, address2, area, district, pincode, contact, mobile  From jrcxl where tdelete='0' and  id='".$sourceidvalue."' order by id asc";
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
	
	echo 	$sqleng = "SELECT username From jrcengineer where id='".$oldengineeridvalue."' order by username asc";
		$queryeng = mysqli_query($connection, $sqleng);
        $rowCounteng = mysqli_num_rows($queryeng);
        if(!$queryeng){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCounteng > 0) 
		{
			$count=1;
			$sentmem=array();
			while($roweng = mysqli_fetch_array($queryeng)) 
			{
				$sqlist=mysqli_query($connection, "select userid from jrcdevices where loginid='".$roweng['username']."'");
				while($infost=mysqli_fetch_array($sqlist))
				{
					if(!in_array($infost['userid'],$sentmem))
					{
sendNotifications("Your call (".$calltid.")", $infost['userid'], $rowxl['stockitem']." - ".$reportedproblemvalue."\n".$rowxl['consigneename']." - ".$rowxl['address1'].", ".$rowxl['address2'].", ".$rowxl['area'].", ".$rowxl['district']."-".$rowxl['pincode']."\n".$rowxl['contact']."-".$rowxl['mobile'], $_SESSION['companysiteurl'], $calltid);							
					$sentmem[]=$infost['userid'];
					}					
				}
			}
		} */
/*Notifications*/
							
							//Notifications */
						}
						
					}
					else
					{
						if($engineersid!=$oldengineersid)
						{
							echo "Hello";
							mysqli_query($connection, "delete from jrccallstravel where calltid='$calltid'");
							$engnames=explode(',',$_POST['engineersname']);
							for($i=0; $i<count($_POST['engineersid']); $i++)
							{
								$engname=$engnames[$i];
								$engid=mysqli_real_escape_string($connection, $_POST['engineersid'][$i]);
								if($engid!='')
								{
									mysqli_query($connection, "INSERT INTO jrccallstravel( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engid', '$engname')");					
								}						
							}
							
							
							
						}
					}
				}
			
			}
			if($customersmsvalue=="0")
			{
				$sql = "SELECT email From jrcconsignee where id='".$consigneeidvalue."' order by id asc";
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
			        $mailsubject="New ".$callnature." Call Assigned: Call ID ".$calltid;
					$mailcontent="Dear Customer, Your ".$callnature." Call is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") - ".$_SESSION['companyname'];
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
					////////Sharp
				    $custmessage="Dear Customer, Your ".$callnature." Call is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") - Sharp";
					$custmessage=preg_replace('!\s+!', ' ', $custmessage);
					$custmessage=str_replace(',,', ',', $custmessage);
					$custmessage=urlencode($custmessage);
					$url =  "http://www.nminfotech.in/smsautosend.aspx?id=SHARPC&PWD=SHARPC&mob=".$callfromvalue."&msg=".$custmessage."&tm=T";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$output = curl_exec($ch);
					curl_close($ch);
				}
			}	
			if($engineersmsvalue=="0")
			{
		$sqlxl = "SELECT id, stockitem, consigneename, address1, address2, area, district, pincode, contact, mobile From jrcxl where tdelete='0' and  id='".$sourceidvalue."' order by id asc";
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
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($_SESSION['encpass'], $rowxl['mobile']);
		}
	}
}
		}
		if($engineertype=="0")
		{
		$sqleng = "SELECT mobile,email From jrcengineer where enabled='0' and id='".$engineeridvalue."' order by username asc";
		}
		else
		{
		$sqleng = "SELECT mobile,email From jrcengineer where enabled='0' and id in ('".$engineersid."') order by username asc";	
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
$engmessage=$engmessage1="Dear Friend, Call ID: ".$calltid." %0aCo-Ordntr: ".$coordinatornamevalue." %0aProblem: ".$reportedproblemvalue." (".$otherremarksvalue.") %0aProduct: ".$rowxl['stockitem']." %0aSerial: ".$serial." %0aAddress: ".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']." %0aDistrict: ".$rowxl['district']."-".$rowxl['pincode']." %0aContact: ".$rowxl['contact']."-".$rowxl['mobile']." %0aUEL POWER";
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
					////////Sharp
$engmessage=$engmessage1="Dear Friend, Call ID: ".$calltid." %0aCo-Ordntr: ".$coordinatornamevalue."%0aProblem: ".$reportedproblemvalue."%0aProduct: ".$rowxl['stockitem']."%0aSerial: ".$serial."%0aAddress:".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']."%0aDistrict:".$rowxl['district']."-".$rowxl['pincode']."%0aContact: ".$rowxl['contact']."-".$rowxl['mobile']."%0aSharp";
$engmessage=preg_replace('!\s+!', ' ', $engmessage);
$engmessage=str_replace(',,', ',', $engmessage);
$engmessage=urlencode($engmessage);
				$url = "http://www.nminfotech.in/smsautosend.aspx?id=SHARPC&PWD=SHARPC&mob=".$roweng['mobile']."&msg=".$engmessage."&tm=T"; 
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
		$sqlcoor = "SELECT email, mobile From jrccoordinator where id='".$coordinatoridvalue."' order by username asc";
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
						////////Sharp
						$coormessage=$coormessage1="Dear Co-ordinator, Call ID ".$calltid." is Assigned to Engineer: ".$engineernamevalue."\n";
						$coormessage=preg_replace('!\s+!', ' ', $coormessage);
						$coormessage=str_replace(',,', ',', $coormessage);
						$coormessage=urlencode($coormessage);
						$url =  "http://www.nminfotech.in/smsautosend.aspx?id=SHARPC&PWD=SHARPC&mob=".$rowcoor['mobile']."&msg=".$coormessage."&tm=T"; 
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
			
			
		if($oldengineeridvalue!=$engineeridvalue)
		{
		$sqloeng = "SELECT username From jrcengineer where enabled='0' and id='".$oldengineeridvalue."' order by username asc";

		
$queryoeng = mysqli_query($connection, $sqloeng);
        $rowCountoeng = mysqli_num_rows($queryoeng);
        if(!$queryoeng){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountoeng > 0) 
		{
			$count=1;
			while($rowoeng = mysqli_fetch_array($queryoeng)) 
			{
				$sqlist1=mysqli_query($connection, "select userid from jrcdevices where loginid='".$rowoeng['username']."'");
				while($infost1=mysqli_fetch_array($sqlist1))
				{
					
						sendNotifications("Your Call Id (".$calltid.") Transfered", $infost['userid1'], $rowxl['stockitem']." - ".$reportedproblemvalue."\n".$rowxl['consigneename']." - ".$rowxl['address1'].", ".$rowxl['address2'].", ".$rowxl['area'].", ".$rowxl['district']."-".$rowxl['pincode']."\n".$rowxl['contact']."-".$rowxl['mobile'], $_SESSION['companysiteurl'], $calltid);				
				}
			}
		}
		}
			
		if($engineertype=="0")
		{
		$sqleng = "SELECT username From jrcengineer where enabled='0' and id='".$engineeridvalue."' order by username asc";
		}
		else
		{
		$sqleng = "SELECT username From jrcengineer where enabled='0' and id in ('".$engineersid."') order by username asc";	
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
					if($reassign=='1')
					{	
						sendNotifications("Call (".$calltid.") - Re-Assigned", $infost['userid'], $rowxl['stockitem']." - ".$reportedproblemvalue."\n".$rowxl['consigneename']." - ".$rowxl['address1'].", ".$rowxl['address2'].", ".$rowxl['area'].", ".$rowxl['district']."-".$rowxl['pincode']."\n".$rowxl['contact']."-".$rowxl['mobile'], $_SESSION['companysiteurl'], $calltid);
					} 
					else
					{
						sendNotifications("Call (".$calltid.") - Modified", $infost['userid'], $rowxl['stockitem']." - ".$reportedproblemvalue."\n".$rowxl['consigneename']." - ".$rowxl['address1'].", ".$rowxl['address2'].", ".$rowxl['area'].", ".$rowxl['district']."-".$rowxl['pincode']."\n".$rowxl['contact']."-".$rowxl['mobile'], $_SESSION['companysiteurl'], $calltid);
					}					
				}
			}
		}
/*Notifications*/

			
				header("Location: consigneeview.php?id=".$consigneeidvalue."&remarks=Modified Successfully");
			} 
	    }
		else
			{
				header("Location: callsadd.php?id=".$sourceidvalue."&error=Already A Complaint is Closed for this Customer and Product! Kindly Open a New complaint");
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