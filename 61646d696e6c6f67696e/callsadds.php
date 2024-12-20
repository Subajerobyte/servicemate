<?php
include('lcheck.php');
if($calladd=='0')
{
	header("location: dashboard.php");
}
if(isset($_POST['submit']))
{
	
	$sourceidvalue=mysqli_real_escape_string($connection, $_POST['sourceid']);
	$consigneeidvalue=mysqli_real_escape_string($connection, $_POST['consigneeid']);
	$wcalltid=mysqli_real_escape_string($connection, $_POST['wcalltid']);
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
		$customersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['customersms']))?'0':'1'));
		$callhandledsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['callhandledsms']))?'0':'1'));
		$coordinatorsmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['coordinatorsms']))?'0':'1'));
		$engineersmsvalue=mysqli_real_escape_string($connection, ((isset($_POST['engineersms']))?'0':'1'));
		$serials= $_POST['serial'];
				
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
		$diagnosissignmode=mysqli_real_escape_string($connection, $_POST['diagnosissignmode']);
		$diagnosissignmoderemark=mysqli_real_escape_string($connection, $_POST['diagnosissignmoderemark']);
		$godownname=mysqli_real_escape_string($connection, $_POST['godownname']);
		$suppliername=mysqli_real_escape_string($connection, $_POST['suppliername']);
		
		
		$i=0;
		$j=0;
      if(($callonvalue!="")&&($callonvalue!="User Name(Unique)"))
	{
foreach ($serials as $serial)
		  {
			
        $sqlcon = "SELECT id From jrccalls WHERE sourceid = '{$sourceidvalue}' and serial = '{$serial}' and (compstatus = '0' or compstatus = '1')";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
		$queryup2 = mysqli_query($connection, $sqlup2);
				$sqlup3 = "UPDATE jrccalls set wastatus='1' where calltid='".$wcalltid."' ";
				
				$queryup2 = mysqli_query($connection, $sqlup3);
        if($rowCountcon == 0) 
		{			
			 $sqlup = "INSERT INTO jrccalls( sourceid, consigneeid, callfrom, callnature, customernature, businesstype, servicetype, calltype, callon, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, otherremarks, customersms, callhandledsms, coordinatorsms, engineersms, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial,problemobserved, diagnosissignname,diagnosissignmode,diagnosissignmoderemark, godownname,suppliername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername,times) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$callfromvalue', '$callnature', '$customernature', '$businesstype', '$servicetype', '$calltype', '$callonvalue', '$callhandlingidvalue', '$callhandlingnamevalue', '$reportedproblemvalue', '$coordinatoridvalue', '$coordinatornamevalue', '$engineeridvalue', '$engineernamevalue', '$otherremarksvalue', '$customersmsvalue', '$callhandledsmsvalue', '$coordinatorsmsvalue', '$engineersmsvalue', '$serial', '$diagnosisby', '$diagnosisengineername', '$diagnosisengineerid', '$diagnosiscoordinatorname', '$diagnosiscoordinatorid', '$diagnosison', '$diagnosisestdate', '$diagnosisestcharge', '$diagnosisimg', '$diagnosisremarks', '$diagnosismaterial','$problemobserved' ,'$diagnosissignname' ,'$diagnosissignmode' ,'$diagnosissignmoderemark' ,'$godownname','$suppliername', '$engineertype', '$engineersname', '$engineersid', '$reportingtype', '$reportingengineerid', '$reportingengineername','$times')";
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
						$engid=mysqli_real_escape_string($connection, $_POST['engineersid'][$i]);
						if($engid!='')
						{
							mysqli_query($connection, "INSERT INTO jrccallstravel( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engid', '$engname')");					
						}						
					}
				}
				
				$sqlup2 = "INSERT INTO jrccallshistory( sourceid, consigneeid, callfrom, callnature, customernature, businesstype, servicetype, calltype, callon, callhandlingid, callhandlingname, reportedproblem, coordinatorid, coordinatorname, engineerid, engineername, otherremarks, customersms, callhandledsms, coordinatorsms, engineersms, serial, diagnosisby, diagnosisengineername, diagnosisengineerid, diagnosiscoordinatorname, diagnosiscoordinatorid, diagnosison, diagnosisestdate, diagnosisestcharge, diagnosisimg, diagnosisremarks, diagnosismaterial,problemobserved, diagnosissignname,diagnosissignmode,diagnosissignmoderemark,  godownname,suppliername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, times) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$callfromvalue', '$callnature', '$customernature', '$businesstype', '$servicetype', '$calltype', '$callonvalue', '$callhandlingidvalue', '$callhandlingnamevalue', '$reportedproblemvalue', '$coordinatoridvalue', '$coordinatornamevalue', '$engineeridvalue', '$engineernamevalue', '$otherremarksvalue', '$customersmsvalue', '$callhandledsmsvalue', '$coordinatorsmsvalue', '$engineersmsvalue', '$serial', '$diagnosisby', '$diagnosisengineername', '$diagnosisengineerid', '$diagnosiscoordinatorname', '$diagnosiscoordinatorid', '$diagnosison', '$diagnosisestdate', '$diagnosisestcharge', '$diagnosisimg', '$diagnosisremarks', '$diagnosismaterial','$problemobserved' ,'$diagnosissignname' ,'$diagnosissignmode' ,'$diagnosissignmoderemark' ,'$godownname','$suppliername', '$engineertype', '$engineersname', '$engineersid', '$reportingtype', '$reportingengineerid', '$reportingengineername', '$times')";
				
				
				
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
						$engid=mysqli_real_escape_string($connection, $_POST['engineersid'][$i]);
						if($engid!='')
						{
							mysqli_query($connection, "INSERT INTO jrccallstravelhistory( sourceid, consigneeid, calltid, engineerid, engineername) VALUES ( '$sourceidvalue', '$consigneeidvalue', '$calltid', '$engid', '$engname')");					
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
				if(isset($_POST['engineerwa']))
				{
				if($row['email']!="")
			       {
			        $mailsubject="New ".$callnature." call Assigned: Call ID ".$calltid;
					$mailcontent="Dear Customer, Your ".$callnature." Call is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") - ".$_SESSION['companyname']; 
					$mailsendto=trim($row['email']);
					sendmail($_SESSION['mailer'], $_SESSION['companyname'], $mailsubject, $mailcontent, $_SESSION['mailname'], $_SESSION['apppassword'], $mailsendto);
				   }
				}
				}
				
				if($companyid=='1')
				{
					/* $custmessage="Dear Customer, your service request is registered with ID: ".$calltid." It will be attended shortly. For further assistance please contact ".$_SESSION['companyshortname']." on ".$_SESSION['companyphone']." - JEROBYTE.";
					$custmessage=preg_replace('!\s+!', ' ', $custmessage);
					$custmessage=str_replace(',,', ',', $custmessage);
					$custmessage=urlencode($custmessage);
					$url = "https://bulksms.agasoft.co.in/api/sendsms?username=jerobyte&password=jerobyte&senderid=JROBYT&message=".$custmessage."&numbers=".$callfromvalue."&dndrefund=1";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$output = curl_exec($ch);
					curl_close($ch); */
					$custmessage = "Dear Customer, your service request is registered with ID: " . $calltid . " It will be attended shortly. For further assistance please contact " . $companyshortname . " on " . $companyphone . " - JEROBYTE";
					$custmessage = preg_replace('!\s+!', ' ', $custmessage);
					$custmessage = str_replace(',,', ',', $custmessage);
					//DONT ENCODE
					//$custmessage = urlencode($custmessage);
					$params = array(
						'username' => 'jerobyte',
						'password' => 'jerobyte',
						'senderid' => 'JROBYT',
						'message' => $custmessage,
						'numbers' => $callfromvalue  
					);
					$url = "https://bulksms.agasoft.co.in/api/sendsms?" . http_build_query($params);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					// Disable SSL certificate verification 
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
					$output = curl_exec($ch);
					// only for checking
					if (curl_errno($ch)) {
						echo 'Curl error: ' . curl_error($ch);
					}
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
					$custmessage="Dear Customer, Your ".$callnature." Call is Registered, the Call id is ".$calltid." (".$otherremarksvalue.") - Sharp";
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
		$sqlxl = "SELECT phone, email, stockitem, consigneename, address1, address2, area, district, pincode, contact, mobile  From jrcxl where tdelete='0' and  id='".$sourceidvalue."' order by id asc";
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
				if(isset($_POST['engineerwa']))
				{
				if($roweng['email']!="")
			       {
				/* Mail*/	
			        $mailsubject="New ".$callnature." call Assigned: Call ID ".$calltid;
					$mailcontent=$engmessage1="Dear Friend, Call ID: ".$calltid." <br>
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
				   
				if($companyid=='1' || $companyid=='123')
				{
					////////jrc
				$engmessage=$engmessage1="Dear Friend, Call ID: ".$calltid." %0aCo-Ordntr: ".$coordinatornamevalue."%0aProblem: ".$reportedproblemvalue."%0aProduct: ".$rowxl['stockitem']."%0aSerial: ".$serial."%0aAddress:".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']."%0aDistrict:".$rowxl['district']."-".$rowxl['pincode']."%0aContact: ".$rowxl['contact']."-".$rowxl['mobile']."%0aJr Comm";
				$engmessage=preg_replace('!\s+!', ' ', $engmessage);
				$engmessage=str_replace(',,', ',', $engmessage);
				$engmessage=urlencode($engmessage);
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
				////////////Sharp
				$engmessage=$engmessage1="Dear Friend, Call ID: ".$calltid."%0aCo-Ordntr: ".$coordinatornamevalue."%0aProblem: ".$reportedproblemvalue."%0aProduct: ".$rowxl['stockitem']."%0aSerial: ".$serial."%0aAddress:".$rowxl['consigneename'].",".$rowxl['address1'].",".$rowxl['address2'].",".$rowxl['area']."%0aDistrict:".$rowxl['district']."-".$rowxl['pincode']."%0aContact: ".$rowxl['contact']."-".$rowxl['mobile']."%0aSharp";
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
	if(isset($_POST['ts1']))
	{
		$ts1=mysqli_real_escape_string($connection, $_POST['ts1']);
		$sqlts=mysqli_query($connection, "select id from jrcreminder where id='$ts1'");
		if(mysqli_num_rows($sqlts)>0)
		{
			$sqlits1=mysqli_query($connection, "update jrcreminder set status='CALL ASSIGNED on ".date('d/m/Y')."', enabled='1' where id='$ts1' ");
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
	$i++;

		}
	 }
	 else
	 {
		$j++; 
	 }
	 
 	if($i!=0 && $j==0)
	{
		if($servicetype=='Carry-In')
		{
			
				header("Location: inhousecalls.php?remarks=Added Successfully");
			
		}
		else
		{
			header("Location: consigneeview.php?id=".$consigneeidvalue."&remarks=Added Successfully");
		}
	}
	elseif($i==0 && $j!=0)
	{
		header("Location: consigneeview.php?id=".$consigneeidvalue."&error=All Calls Already Inserted A Complaint is Open for this Customer and Product! Kindly Close it");
	}
	elseif($i==0 && $j==0)
	{
		header("Location: consigneeview.php?id=".$consigneeidvalue."&error=NO Calls Inserted");
	}
		else
	{
		header("Location: consigneeview.php?id=".$consigneeidvalue."&remarks=Already A Complaint is Open for this Customer and Product! Kindly Close it");
	}	 
	  
	 
	}
	}
	else
	{
		header("Location: calls.php?error=Error Data");
	}
	}
	
	

else
{
	header("Location: calls.php?error=No Data");
}
?>