<?php 
include('lcheck.php');
if(isset($_POST['submit']))
{
function calculateFiscalYearForDate($month)
{
if($month > 3)
{
$y = date('y');
$pt = date('y', strtotime('+1 year'));
$fy = $y."-".$pt;
}
else
{
$y = date('y', strtotime('-1 year'));
$pt = date('y');
$fy = $y."-".$pt;
}
return $fy;
}
$curr_date_month = date('m');
$fyear = calculateFiscalYearForDate($curr_date_month);
	$addedon=date('Y-m-d H:i:s');
	$editedon=date('Y-m-d H:i:s');
	$calltid=mysqli_real_escape_string($connection, $_POST['calltid']);
	$calloid=mysqli_real_escape_string($connection, $_POST['calloid']);
	$srno=mysqli_real_escape_string($connection, $_POST['srno']);
	$worktype=mysqli_real_escape_string($connection, $_POST['worktype']);
	$calltype=mysqli_real_escape_string($connection, $_POST['calltype']);
	$businesstype=mysqli_real_escape_string($connection, $_POST['businesstype']);
	$workpoint=0;
	$colname=0;
	$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem']);
	
	
	$engsignature=mysqli_real_escape_string($connection, $_POST['engsignature']);
	$engineername=mysqli_real_escape_string($connection, $_POST['engineername']);
	$compno=mysqli_real_escape_string($connection, $_POST['compno']);
	$compprefix=mysqli_real_escape_string($connection, $_POST['compprefix']);
	$engineerid=mysqli_real_escape_string($connection, $_POST['engineerid']);
    $airearthing=mysqli_real_escape_string($connection, $_POST['airearthing']);
	$airstabilizer=mysqli_real_escape_string($connection, $_POST['airstabilizer']);
	$airtonnage=mysqli_real_escape_string($connection, $_POST['airtonnage']);    
	$airipvolt=mysqli_real_escape_string($connection, $_POST['airipvolt']);
	$airopvolt=mysqli_real_escape_string($connection, $_POST['airopvolt']);
	$aircurrent=mysqli_real_escape_string($connection, $_POST['aircurrent']);
	$airgril=mysqli_real_escape_string($connection, $_POST['airgril']);
	$airroom=mysqli_real_escape_string($connection, $_POST['airroom']);
	$airdpressure=mysqli_real_escape_string($connection, $_POST['airdpressure']);
	$airspressure=mysqli_real_escape_string($connection, $_POST['airspressure']);
	$airothers=mysqli_real_escape_string($connection, $_POST['airothers']);
	$airambient=mysqli_real_escape_string($connection, $_POST['airambient']);
	$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
	$problemobserved=mysqli_real_escape_string($connection, $_POST['problemobserved']);
	$actiontaken=mysqli_real_escape_string($connection, $_POST['actiontaken']);
	$verification='0';
	$directsunlight=(float)mysqli_real_escape_string($connection, ((isset($_POST['directsunlight']))?$_POST['directsunlight']:'0'));
	$wiringready=(float)mysqli_real_escape_string($connection, ((isset($_POST['wiringready']))?$_POST['wiringready']:'0'));
	$modificationwiring=(float)mysqli_real_escape_string($connection, ((isset($_POST['modificationwiring']))?$_POST['modificationwiring']:'0'));
	$waterdripping=(float)mysqli_real_escape_string($connection, ((isset($_POST['waterdripping']))?$_POST['waterdripping']:'0'));
	$coastelarea=(float)mysqli_real_escape_string($connection, ((isset($_POST['coastelarea']))?$_POST['coastelarea']:'0'));
	$pollutionlevel=(float)mysqli_real_escape_string($connection, ((isset($_POST['pollutionlevel']))?$_POST['pollutionlevel']:'0'));
	$moisture=(float)mysqli_real_escape_string($connection, ((isset($_POST['moisture']))?$_POST['moisture']:'0'));
	
	
	
	
	$inputsupply=(float)mysqli_real_escape_string($connection, ((isset($_POST['inputsupply']))?$_POST['inputsupply']:'0'));
	$dvstfree=(float)mysqli_real_escape_string($connection, ((isset($_POST['dvstfree']))?$_POST['dvstfree']:'0'));
	$earthingcheck=(float)mysqli_real_escape_string($connection, ((isset($_POST['earthingcheck']))?$_POST['earthingcheck']:'0'));
	$upsavailability=(float)mysqli_real_escape_string($connection, ((isset($_POST['upsavailability']))?$_POST['upsavailability']:'0'));
	$airconditioned=(float)mysqli_real_escape_string($connection, ((isset($_POST['airconditioned']))?$_POST['airconditioned']:'0'));
	
	$inputvoltage=mysqli_real_escape_string($connection, $_POST['inputvoltage']);
	$earthleakage=mysqli_real_escape_string($connection, $_POST['earthleakage']);
	
	$cleaning=(float)mysqli_real_escape_string($connection, ((isset($_POST['cleaning']))?$_POST['cleaning']:'0'));
	$softwarecheck=(float)mysqli_real_escape_string($connection, ((isset($_POST['softwarecheck']))?$_POST['softwarecheck']:'0'));
	$antiviruscheck=(float)mysqli_real_escape_string($connection, ((isset($_POST['antiviruscheck']))?$_POST['antiviruscheck']:'0'));
	$looseconnection=(float)mysqli_real_escape_string($connection, ((isset($_POST['looseconnection']))?$_POST['looseconnection']:'0'));
	$speedcheck=(float)mysqli_real_escape_string($connection, ((isset($_POST['speedcheck']))?$_POST['speedcheck']:'0'));
	$tempfilecleaning=(float)mysqli_real_escape_string($connection, ((isset($_POST['tempfilecleaning']))?$_POST['tempfilecleaning']:'0'));
	$hardwarecheck=(float)mysqli_real_escape_string($connection, ((isset($_POST['hardwarecheck']))?$_POST['hardwarecheck']:'0'));
	$printcheck=(float)mysqli_real_escape_string($connection, ((isset($_POST['printcheck']))?$_POST['printcheck']:'0'));
	$keyboard=(float)mysqli_real_escape_string($connection, ((isset($_POST['keyboard']))?$_POST['keyboard']:'0'));
	$mouse=(float)mysqli_real_escape_string($connection, ((isset($_POST['mouse']))?$_POST['mouse']:'0'));
	
	$imguploads=mysqli_real_escape_string($connection, $_POST['imguploads']);
	
	$make=mysqli_real_escape_string($connection, $_POST['make']);
	$capacity=mysqli_real_escape_string($connection, $_POST['capacity']);
	$mfgcode=mysqli_real_escape_string($connection, $_POST['mfgcode']);
	$batterymake=mysqli_real_escape_string($connection, $_POST['batterymake']);
	$batteryah=mysqli_real_escape_string($connection, $_POST['batteryah']);
	$noofbattery=(float)mysqli_real_escape_string($connection, $_POST['noofbattery']);
	$noofset=(float)mysqli_real_escape_string($connection, $_POST['noofset']);
	
	$sqli=mysqli_query($connection, "select point, mult from jrcworkpoints where stockitem='".$stockitem."' and worktype='".$worktype."'");
	if(mysqli_num_rows($sqli)>0)
	{
		$infos=mysqli_fetch_array($sqli);
		if($infos['mult']=='1')
		{
			if($noofbattery!=0)
			{
				$workpoint=(float)$infos['point']*$noofbattery;		
			}
			else
			{
				$workpoint=$infos['point'];	
			}			
		}
		else
		{
			$workpoint=$infos['point'];		
		}
		
	}
	
	$phasetype=(float)mysqli_real_escape_string($connection, $_POST['phasetype']);
	$voliry=(float)mysqli_real_escape_string($connection, $_POST['voliry']);
	$volirn=(float)mysqli_real_escape_string($connection, $_POST['volirn']);
	$voliyb=(float)mysqli_real_escape_string($connection, $_POST['voliyb']);
	$volibn=(float)mysqli_real_escape_string($connection, $_POST['volibn']);
	$volibr=(float)mysqli_real_escape_string($connection, $_POST['volibr']);
	$voliyn=(float)mysqli_real_escape_string($connection, $_POST['voliyn']);
	$voline=(float)mysqli_real_escape_string($connection, $_POST['voline']);
	$curir=(float)mysqli_real_escape_string($connection, $_POST['curir']);
	$freir=(float)mysqli_real_escape_string($connection, $_POST['freir']);
	$curiy=(float)mysqli_real_escape_string($connection, $_POST['curiy']);
	$freiy=(float)mysqli_real_escape_string($connection, $_POST['freiy']);
	$curib=(float)mysqli_real_escape_string($connection, $_POST['curib']);
	$freib=(float)mysqli_real_escape_string($connection, $_POST['freib']);
	$curin=(float)mysqli_real_escape_string($connection, $_POST['curin']);
	$volipn=(float)mysqli_real_escape_string($connection, $_POST['volipn']);
	$curip=(float)mysqli_real_escape_string($connection, $_POST['curip']);
	$volipe=(float)mysqli_real_escape_string($connection, $_POST['volipe']);
	$cur1in=(float)mysqli_real_escape_string($connection, $_POST['cur1in']);
	$vol1ine=(float)mysqli_real_escape_string($connection, $_POST['vol1ine']);
	$freip=(float)mysqli_real_escape_string($connection, $_POST['freip']);
	$volory=(float)mysqli_real_escape_string($connection, $_POST['volory']);
	$volorn=(float)mysqli_real_escape_string($connection, $_POST['volorn']);
	$voloyb=(float)mysqli_real_escape_string($connection, $_POST['voloyb']);
	$volobn=(float)mysqli_real_escape_string($connection, $_POST['volobn']);
	$volobr=(float)mysqli_real_escape_string($connection, $_POST['volobr']);
	$voloyn=(float)mysqli_real_escape_string($connection, $_POST['voloyn']);
	$volone=(float)mysqli_real_escape_string($connection, $_POST['volone']);
	$curor=(float)mysqli_real_escape_string($connection, $_POST['curor']);
	$freor=(float)mysqli_real_escape_string($connection, $_POST['freor']);
	$curoy=(float)mysqli_real_escape_string($connection, $_POST['curoy']);
	$freoy=(float)mysqli_real_escape_string($connection, $_POST['freoy']);
	$curob=(float)mysqli_real_escape_string($connection, $_POST['curob']);
	$freob=(float)mysqli_real_escape_string($connection, $_POST['freob']);
	$curon=(float)mysqli_real_escape_string($connection, $_POST['curon']);
	$volopn=(float)mysqli_real_escape_string($connection, $_POST['volopn']);
	$curop=(float)mysqli_real_escape_string($connection, $_POST['curop']);
	$volope=(float)mysqli_real_escape_string($connection, $_POST['volope']);
	$cur1on=(float)mysqli_real_escape_string($connection, $_POST['cur1on']);
	$vol1one=(float)mysqli_real_escape_string($connection, $_POST['vol1one']);
	$freop=(float)mysqli_real_escape_string($connection, $_POST['freop']);
	
	$stabilizer=(float)mysqli_real_escape_string($connection, ((isset($_POST['stabilizer']))?$_POST['stabilizer']:'0'));
	$phasereverse=(float)mysqli_real_escape_string($connection, ((isset($_POST['phasereverse']))?$_POST['phasereverse']:'0'));
	$earthing=(float)mysqli_real_escape_string($connection, ((isset($_POST['earthing']))?$_POST['earthing']:'0'));
	$overload=(float)mysqli_real_escape_string($connection, ((isset($_POST['overload']))?$_POST['overload']:'0'));
		
	$chargingv=(float)mysqli_real_escape_string($connection, $_POST['chargingv']);
	$chargingo=(float)mysqli_real_escape_string($connection, $_POST['chargingo']);
	$dischargingv=(float)mysqli_real_escape_string($connection, $_POST['dischargingv']);
	$dischargingo=(float)mysqli_real_escape_string($connection, $_POST['dischargingo']);
	$dischargingwv=(float)mysqli_real_escape_string($connection, $_POST['dischargingwv']);
	$dischargingwo=(float)mysqli_real_escape_string($connection, $_POST['dischargingwo']);
	$batterycondition=mysqli_real_escape_string($connection, $_POST['batterycondition']);
	$sparesrequired1=mysqli_real_escape_string($connection, $_POST['sparesrequired1']);
	$sparesrequired1q=mysqli_real_escape_string($connection, $_POST['sparesrequired1q']);
	$sparesrequired2=mysqli_real_escape_string($connection, $_POST['sparesrequired2']);
	$sparesrequired2q=mysqli_real_escape_string($connection, $_POST['sparesrequired2q']);
	$sparesrequired3=mysqli_real_escape_string($connection, $_POST['sparesrequired3']);
	$sparesrequired3q=mysqli_real_escape_string($connection, $_POST['sparesrequired3q']);
	$sparesrequired4=mysqli_real_escape_string($connection, $_POST['sparesrequired4']);
	$sparesrequired4q=mysqli_real_escape_string($connection, $_POST['sparesrequired4q']);
	$sparesrequired5=mysqli_real_escape_string($connection, $_POST['sparesrequired5']);
	$sparesrequired5q=mysqli_real_escape_string($connection, $_POST['sparesrequired5q']);
	
	$sparesused1=mysqli_real_escape_string($connection, $_POST['sparesused1']);
	$sparesused1q=mysqli_real_escape_string($connection, $_POST['sparesused1q']);
	$sparesused2=mysqli_real_escape_string($connection, $_POST['sparesused2']);
	$sparesused2q=mysqli_real_escape_string($connection, $_POST['sparesused2q']);
	$sparesused3=mysqli_real_escape_string($connection, $_POST['sparesused3']);
	$sparesused3q=mysqli_real_escape_string($connection, $_POST['sparesused3q']);
	$sparesused4=mysqli_real_escape_string($connection, $_POST['sparesused4']);
	$sparesused4q=mysqli_real_escape_string($connection, $_POST['sparesused4q']);
	$sparesused5=mysqli_real_escape_string($connection, $_POST['sparesused5']);
	$sparesused5q=mysqli_real_escape_string($connection, $_POST['sparesused5q']);
	
	$engineerreport=mysqli_real_escape_string($connection, $_POST['engineerreport']);
	$callstatus=mysqli_real_escape_string($connection, $_POST['callstatus']);
	$consigneeavailable=mysqli_real_escape_string($connection, $_POST['consigneeavailable']);
	$customerfeedback=mysqli_real_escape_string($connection, $_POST['customerfeedback']);
	$engapproach=mysqli_real_escape_string($connection, $_POST['engapproach']);
	$signname=mysqli_real_escape_string($connection, $_POST['signname']);
	$signature=mysqli_real_escape_string($connection, $_POST['signature']);
	
	
	
	
	
	$smaterial1=mysqli_real_escape_string($connection, $_POST['smaterial1']);
	$smaterial2=mysqli_real_escape_string($connection, $_POST['smaterial2']);
	$smaterial3=mysqli_real_escape_string($connection, $_POST['smaterial3']);
	$smaterial4=mysqli_real_escape_string($connection, $_POST['smaterial4']);
	$smaterial5=mysqli_real_escape_string($connection, $_POST['smaterial5']);
	
	$sprice1=(float)mysqli_real_escape_string($connection, $_POST['sprice1']);
	$sprice2=(float)mysqli_real_escape_string($connection, $_POST['sprice2']);
	$sprice3=(float)mysqli_real_escape_string($connection, $_POST['sprice3']);
	$sprice4=(float)mysqli_real_escape_string($connection, $_POST['sprice4']);
	$sprice5=(float)mysqli_real_escape_string($connection, $_POST['sprice5']);
	for ($i = 1; $i <= 5; $i++) {
		$sprice = (float)mysqli_real_escape_string($connection, $_POST['sprice' . $i]);
		$smaterial = (float)mysqli_real_escape_string($connection, $_POST['smaterial' . $i]);
		
		mysqli_query($connection, "UPDATE jrcspares SET price = $sprice WHERE id = $smaterial");
	}
	$squantity1=(float)mysqli_real_escape_string($connection, $_POST['squantity1']);
	$squantity2=(float)mysqli_real_escape_string($connection, $_POST['squantity2']);
	$squantity3=(float)mysqli_real_escape_string($connection, $_POST['squantity3']);
	$squantity4=(float)mysqli_real_escape_string($connection, $_POST['squantity4']);
	$squantity5=(float)mysqli_real_escape_string($connection, $_POST['squantity5']);
	
	
	$stotal1=(float)mysqli_real_escape_string($connection, $_POST['stotal1']);
	$stotal2=(float)mysqli_real_escape_string($connection, $_POST['stotal2']);
	$stotal3=(float)mysqli_real_escape_string($connection, $_POST['stotal3']);
	$stotal4=(float)mysqli_real_escape_string($connection, $_POST['stotal4']);
	$stotal5=(float)mysqli_real_escape_string($connection, $_POST['stotal5']);
	
	$sgstper1=(float)mysqli_real_escape_string($connection, $_POST['sgstper1']);
	$sgstper2=(float)mysqli_real_escape_string($connection, $_POST['sgstper2']);
	$sgstper3=(float)mysqli_real_escape_string($connection, $_POST['sgstper3']);
	$sgstper4=(float)mysqli_real_escape_string($connection, $_POST['sgstper4']);
	$sgstper5=(float)mysqli_real_escape_string($connection, $_POST['sgstper5']);
	
	$sgstpervalue1=(float)mysqli_real_escape_string($connection, $_POST['sgstpervalue1']);
	$sgstpervalue2=(float)mysqli_real_escape_string($connection, $_POST['sgstpervalue2']);
	$sgstpervalue3=(float)mysqli_real_escape_string($connection, $_POST['sgstpervalue3']);
	$sgstpervalue4=(float)mysqli_real_escape_string($connection, $_POST['sgstpervalue4']);
	$sgstpervalue5=(float)mysqli_real_escape_string($connection, $_POST['sgstpervalue5']);
	
	$schargepre1=(float)mysqli_real_escape_string($connection, $_POST['schargepre1']);
	$schargepre2=(float)mysqli_real_escape_string($connection, $_POST['schargepre2']);
	$schargepre3=(float)mysqli_real_escape_string($connection, $_POST['schargepre3']);
	$schargepre4=(float)mysqli_real_escape_string($connection, $_POST['schargepre4']);
	$schargepre5=(float)mysqli_real_escape_string($connection, $_POST['schargepre5']);
	
	$mchargescharge=(float)mysqli_real_escape_string($connection, $_POST['mchargescharge']);
	$mchargegstvalue=(float)mysqli_real_escape_string($connection, $_POST['mchargegstvalue']);
	$schargematerial=(float)mysqli_real_escape_string($connection, $_POST['schargematerial']);
	
	$schargescharge=(float)mysqli_real_escape_string($connection, $_POST['schargescharge']);
	
	
	
	
	$schargegstvalue=(float)mysqli_real_escape_string($connection, $_POST['schargegstvalue']);
	$schargegst=(float)mysqli_real_escape_string($connection, $_POST['schargegst']);
	$sercharge=(float)mysqli_real_escape_string($connection, $_POST['sercharge']);
	
	
	
	
	
	$schargepre=(float)mysqli_real_escape_string($connection, $_POST['schargepre']);
	$sgstamt=(float)mysqli_real_escape_string($connection, $_POST['sgstamt']);
	
	
	
	
	
	
	$scharge=(float)mysqli_real_escape_string($connection, $_POST['scharge']);
	$schargeno=mysqli_real_escape_string($connection, $_POST['schargeno']);
	$schargedate=mysqli_real_escape_string($connection, $_POST['schargedate']);
	$imgseal=mysqli_real_escape_string($connection, $_POST['imgseal']);
	$imgmanual=mysqli_real_escape_string($connection, $_POST['imgmanual']);
	$gstno=mysqli_real_escape_string($connection, $_POST['gstno']);
	$email=mysqli_real_escape_string($connection, $_POST['email']);
	$incgst=(float)mysqli_real_escape_string($connection, ((isset($_POST['incgst']))?$_POST['incgst']:'1'));
	
	$mfpbwa4cpr=(float)mysqli_real_escape_string($connection, $_POST['mfpbwa4cpr']);
	$mfpbwa4fax=(float)mysqli_real_escape_string($connection, $_POST['mfpbwa4fax']);
	$mfpbwa4prp=(float)mysqli_real_escape_string($connection, $_POST['mfpbwa4prp']);
	$mfpclcpr=(float)mysqli_real_escape_string($connection, $_POST['mfpclcpr']);
	$mfpclfax=(float)mysqli_real_escape_string($connection, $_POST['mfpclfax']);
	$mfpclprp=(float)mysqli_real_escape_string($connection, $_POST['mfpclprp']);
	$priportmaster=(float)mysqli_real_escape_string($connection, $_POST['priportmaster']);
	$priportcopies=(float)mysqli_real_escape_string($connection, $_POST['priportcopies']);
	$totalmeterreading=(float)mysqli_real_escape_string($connection, $_POST['totalmeterreading']);
	
$producttype=mysqli_real_escape_string($connection, $_POST['producttype']);
$pvmake=mysqli_real_escape_string($connection, $_POST['pvmake']);
$pvtype=mysqli_real_escape_string($connection, $_POST['pvtype']);
$pvcapacity=mysqli_real_escape_string($connection, $_POST['pvcapacity']);
$pvqty=mysqli_real_escape_string($connection, $_POST['pvqty']);
$pvslno=mysqli_real_escape_string($connection, $_POST['pvslno']);
$ntmake=mysqli_real_escape_string($connection, $_POST['ntmake']);
$nttype=mysqli_real_escape_string($connection, $_POST['nttype']);
$ntcapacity=mysqli_real_escape_string($connection, $_POST['ntcapacity']);
$ntqty=mysqli_real_escape_string($connection, $_POST['ntqty']);
$ntslno=mysqli_real_escape_string($connection, $_POST['ntslno']);
$shadow=(float)mysqli_real_escape_string($connection, ((isset($_POST['shadow']))?'1':'0'));
$noofplstr=mysqli_real_escape_string($connection, $_POST['noofplstr']);
$noofstr=mysqli_real_escape_string($connection, $_POST['noofstr']);
$tilt=mysqli_real_escape_string($connection, $_POST['tilt']);
$plposter=mysqli_real_escape_string($connection, $_POST['plposter']);
$civil=(float)mysqli_real_escape_string($connection, ((isset($_POST['civil']))?'1':'0'));
$mechanical=(float)mysqli_real_escape_string($connection, ((isset($_POST['mechanical']))?'1':'0'));
$elecwiring=(float)mysqli_real_escape_string($connection, ((isset($_POST['elecwiring']))?'1':'0'));
$acearth=(float)mysqli_real_escape_string($connection, ((isset($_POST['acearth']))?'1':'0'));
$dcearth=(float)mysqli_real_escape_string($connection, ((isset($_POST['dcearth']))?'1':'0'));
$laearth=(float)mysqli_real_escape_string($connection, ((isset($_POST['laearth']))?'1':'0'));
$spvvol=mysqli_real_escape_string($connection, $_POST['spvvol']);
$spvcur=mysqli_real_escape_string($connection, $_POST['spvcur']);
$plvoc=mysqli_real_escape_string($connection, $_POST['plvoc']);
$plcell=mysqli_real_escape_string($connection, $_POST['plcell']);
$plseries=mysqli_real_escape_string($connection, $_POST['plseries']);
$plparallel=mysqli_real_escape_string($connection, $_POST['plparallel']);
$plvol=mysqli_real_escape_string($connection, $_POST['plvol']);
$plangel=mysqli_real_escape_string($connection, $_POST['plangel']);
$plpower=mysqli_real_escape_string($connection, $_POST['plpower']);
$pltime=mysqli_real_escape_string($connection, $_POST['pltime']);
$avgloadnight=mysqli_real_escape_string($connection, $_POST['avgloadnight']);
$avgloadday=mysqli_real_escape_string($connection, $_POST['avgloadday']);
$totalload=mysqli_real_escape_string($connection, $_POST['totalload']);
	
	if(($callstatus=='Pending')||($callstatus=='Claim'))
	{
		$workpoint='0';
	}
	
	if($gstno!="")
	{
		mysqli_query($connection, "update jrcconsignee set gstno='$gstno' where id='$consigneeid'");
	}
	if($email!="")
	{
		
		if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{
		$email=jbsencrypt($_SESSION['encpass'], $email);
	}
}
		
		mysqli_query($connection, "update jrcconsignee set email='$email' where id='$consigneeid'");
	}
	$msg = "";
  $msg_class = "";
  $title = $calltid.'-'.$engineername;	
			$msg = 'Service Call Report Updated'; 
			$time = date('Y-m-d H:i:s'); 
			$loop= '5'; 
			$loop_every='5'; 
			$user = $email; 
			/*$isSaved = $push->saveNotification($title, $msg,$time,$loop,$loop_every,$user);
			 if($isSaved) {
				
			} else {
				
			} */
			if($incgst=='2')
			{
				$schargegst='0';
				if(($scharge!='')&&($scharge!='0')&&($scharge!='0.00'))
				{
					if($schargeno=='')
					{
						$querysr = mysqli_query($connection, "SELECT esno From jrcsrno");
						$infosr=mysqli_fetch_array($querysr);
						$schargeno=$_SESSION['estprefix'].' / ES / '.date('m').date('y').' /'.(str_pad(((float)$infosr['esno']+1),5,"0",STR_PAD_LEFT));
						$schargedate=date('Y-m-d');
						mysqli_query($connection, "update jrcsrno set esno=esno+1");
					}
				}
			}
			else
			{
				if(($scharge!='')&&($scharge!='0')&&($scharge!='0.00'))
				{
					if($schargeno=='')
					{
						$querysr = mysqli_query($connection, "SELECT srno From jrcsrno");
						$infosr=mysqli_fetch_array($querysr);
						$schargeno=$_SESSION['serprefix'].' / SER / '.date('m').date('y').' /'.(str_pad(((float)$infosr['srno']+1),5,"0",STR_PAD_LEFT));
						$schargedate=date('Y-m-d');
						mysqli_query($connection, "update jrcsrno set srno=srno+1");
					}
				}
			}
			
			
	 
        $sqlcon = "SELECT id From jrccalldetails WHERE calltid = '{$calltid}' and reassign='0'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{
			if($srno=='')
			{
			$srno=$compprefix.' / '.date('m').date('y').' / '.(str_pad(((float)$compno+1),4,"0",STR_PAD_LEFT)); 
			$sqlt=mysqli_query($connection,"update jrcengineer set compno=compno+1 where id='$engineerid'");
			}
			 
			 $sqlup = "INSERT INTO jrccalldetails set businesstype='$businesstype', inputsupply='$inputsupply', dvstfree='$dvstfree', earthingcheck='$earthingcheck', upsavailability='$upsavailability', airconditioned='$airconditioned', inputvoltage='$inputvoltage', earthleakage='$earthleakage', cleaning='$cleaning', softwarecheck='$softwarecheck', antiviruscheck='$antiviruscheck', looseconnection='$looseconnection', speedcheck='$speedcheck', tempfilecleaning='$tempfilecleaning', hardwarecheck='$hardwarecheck', printcheck='$printcheck', keyboard='$keyboard', mouse='$mouse',  addedon='$addedon', srno='$srno', calltid='$calltid', stockitem='$stockitem', make='$make', capacity='$capacity', mfgcode='$mfgcode', batterymake='$batterymake', batteryah='$batteryah', noofbattery='$noofbattery', noofset='$noofset', problemobserved='$problemobserved', actiontaken='$actiontaken', verification='$verification', directsunlight='$directsunlight', wiringready='$wiringready', modificationwiring='$modificationwiring', waterdripping='$waterdripping', coastelarea='$coastelarea', pollutionlevel='$pollutionlevel', moisture='$moisture', phasetype='$phasetype', voliry='$voliry', volirn='$volirn', voliyb='$voliyb', volibn='$volibn', volibr='$volibr', voliyn='$voliyn', voline='$voline', curir='$curir', freir='$freir', curiy='$curiy', freiy='$freiy', curib='$curib', freib='$freib', curin='$curin', volipn='$volipn', curip='$curip', volipe='$volipe', cur1in='$cur1in', vol1ine='$vol1ine', freip='$freip', volory='$volory', volorn='$volorn', voloyb='$voloyb', volobn='$volobn', volobr='$volobr', voloyn='$voloyn', volone='$volone', curor='$curor', freor='$freor', curoy='$curoy', freoy='$freoy', curob='$curob', freob='$freob', curon='$curon', volopn='$volopn', curop='$curop', volope='$volope', cur1on='$cur1on', vol1one='$vol1one', freop='$freop', stabilizer='$stabilizer', phasereverse='$phasereverse', earthing='$earthing', overload='$overload', airearthing='$airearthing',  airstabilizer='$airstabilizer',  airtonnage='$airtonnage',airipvolt='$airipvolt' ,airopvolt='$airopvolt', aircurrent='$aircurrent', airgril='$airgril',airroom='$airroom', airdpressure='$airdpressure',airspressure='$airspressure', airothers='$airothers',airambient='$airambient', chargingv='$chargingv', chargingo='$chargingo', dischargingv='$dischargingv', dischargingo='$dischargingo', dischargingwv='$dischargingwv', dischargingwo='$dischargingwo', batterycondition='$batterycondition', engineerreport='$engineerreport', sparesrequired1='$sparesrequired1', sparesrequired1q='$sparesrequired1q', sparesrequired2='$sparesrequired2', sparesrequired2q='$sparesrequired2q', sparesrequired3='$sparesrequired3', sparesrequired3q='$sparesrequired3q', sparesrequired4='$sparesrequired4', sparesrequired4q='$sparesrequired4q', sparesrequired5='$sparesrequired5', sparesrequired5q='$sparesrequired5q', sparesused1='$sparesused1', sparesused1q='$sparesused1q', sparesused2='$sparesused2', sparesused2q='$sparesused2q', sparesused3='$sparesused3', sparesused3q='$sparesused3q', sparesused4='$sparesused4', sparesused4q='$sparesused4q', sparesused5='$sparesused5', sparesused5q='$sparesused5q', callstatus='$callstatus',consigneeavailable='$consigneeavailable', customerfeedback='$customerfeedback', engapproach='$engapproach', signname='$signname', signature='$signature', incgst='$incgst',  smaterial1='$smaterial1', smaterial2='$smaterial2', smaterial3='$smaterial3', smaterial4='$smaterial4', smaterial5='$smaterial5', sprice1='$sprice1', sprice2='$sprice2', sprice3='$sprice3', sprice4='$sprice4', sprice5='$sprice5', squantity1='$squantity1', squantity2='$squantity2', squantity3='$squantity3', squantity4='$squantity4', squantity5='$squantity5', stotal1='$stotal1', stotal2='$stotal2', stotal3='$stotal3', stotal4='$stotal4', stotal5='$stotal5', sgstper1='$sgstper1', sgstper2='$sgstper2',sgstper3='$sgstper3', sgstper4='$sgstper4',sgstper5='$sgstper5',schargepre1='$schargepre1',schargepre2='$schargepre2',schargepre3='$schargepre3',schargepre4='$schargepre4',schargepre5='$schargepre5',sgstpervalue1='$sgstpervalue1',sgstpervalue2='$sgstpervalue2',sgstpervalue3='$sgstpervalue3',sgstpervalue4='$sgstpervalue4',sgstpervalue5='$sgstpervalue5',mchargescharge='$mchargescharge', mchargegstvalue='$mchargegstvalue',schargematerial='$schargematerial',schargescharge='$schargescharge', schargegst='$schargegst',schargegstvalue='$schargegstvalue', sercharge='$sercharge', schargepre='$schargepre', sgstamt='$sgstamt', scharge='$scharge', schargeno='$schargeno', schargedate='$schargedate', imguploads='$imguploads', imgseal='$imgseal',imgmanual='$imgmanual', worktype='$worktype', workpoint='$workpoint', mfpbwa4cpr='$mfpbwa4cpr', mfpbwa4fax='$mfpbwa4fax', mfpbwa4prp='$mfpbwa4prp', mfpclcpr='$mfpclcpr', mfpclfax='$mfpclfax', mfpclprp='$mfpclprp', priportmaster='$priportmaster', priportcopies='$priportcopies', totalmeterreading='$totalmeterreading', producttype='$producttype', pvmake='$pvmake', pvtype='$pvtype', pvcapacity='$pvcapacity', pvqty='$pvqty', pvslno='$pvslno',  ntmake='$ntmake', nttype='$nttype', ntcapacity='$ntcapacity', ntqty='$ntqty', ntslno='$ntslno', shadow='$shadow', noofplstr='$noofplstr', noofstr='$noofstr', tilt='$tilt', plposter='$plposter', civil='$civil', mechanical='$mechanical', elecwiring='$elecwiring', acearth='$acearth', dcearth='$dcearth', laearth='$laearth', spvvol='$spvvol', spvcur='$spvcur', plvoc='$plvoc', plcell='$plcell', plseries='$plseries', plparallel='$plparallel', plvol='$plvol', plangel='$plangel', plpower='$plpower', pltime='$pltime', avgloadnight='$avgloadnight', avgloadday='$avgloadday', totalload='$totalload'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "update jrccalls set detailsid='$tid' where calltid='$calltid'");
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Call Report', '{$tid}', 'jrccalls')");
				
				//header("Location: callsedit.php?id=".$calloid."&auto=submit&remarks=Added Successfully");
			} 
	    }
		else
			{
				$info=mysqli_fetch_array($querycon);
				$tid=$info['id'];
				if($srno=='')
			{
			$srno=$compprefix.' / '.date('m').date('y').' / '.(str_pad(((float)$compno+1),4,"0",STR_PAD_LEFT)); 
			$sqlt=mysqli_query($connection,"update jrcengineer set compno=compno+1 where id='$engineerid'");
			}
				 
			$sqlup = "update jrccalldetails set businesstype='$businesstype', inputsupply='$inputsupply', dvstfree='$dvstfree', earthingcheck='$earthingcheck', upsavailability='$upsavailability', airconditioned='$airconditioned', inputvoltage='$inputvoltage', earthleakage='$earthleakage', cleaning='$cleaning', softwarecheck='$softwarecheck', antiviruscheck='$antiviruscheck', looseconnection='$looseconnection', speedcheck='$speedcheck', tempfilecleaning='$tempfilecleaning', hardwarecheck='$hardwarecheck', printcheck='$printcheck', keyboard='$keyboard', mouse='$mouse',  editedon='$editedon', srno='$srno',  calltid='$calltid', stockitem='$stockitem', make='$make', capacity='$capacity', mfgcode='$mfgcode', batterymake='$batterymake', batteryah='$batteryah', noofbattery='$noofbattery', noofset='$noofset', problemobserved='$problemobserved', actiontaken='$actiontaken', verification='$verification', directsunlight='$directsunlight', wiringready='$wiringready', modificationwiring='$modificationwiring', waterdripping='$waterdripping', coastelarea='$coastelarea', pollutionlevel='$pollutionlevel', moisture='$moisture', phasetype='$phasetype', voliry='$voliry', volirn='$volirn', voliyb='$voliyb', volibn='$volibn', volibr='$volibr', voliyn='$voliyn', voline='$voline', curir='$curir', freir='$freir', curiy='$curiy', freiy='$freiy', curib='$curib', freib='$freib', curin='$curin', volipn='$volipn', curip='$curip', volipe='$volipe', cur1in='$cur1in', vol1ine='$vol1ine', freip='$freip', volory='$volory', volorn='$volorn', voloyb='$voloyb', volobn='$volobn', volobr='$volobr', voloyn='$voloyn', volone='$volone', curor='$curor', freor='$freor', curoy='$curoy', freoy='$freoy', curob='$curob', freob='$freob', curon='$curon', volopn='$volopn', curop='$curop', volope='$volope', cur1on='$cur1on', vol1one='$vol1one', freop='$freop', stabilizer='$stabilizer', phasereverse='$phasereverse', earthing='$earthing', overload='$overload',airearthing='$airearthing',  airstabilizer='$airstabilizer',  airtonnage='$airtonnage',airipvolt='$airipvolt' ,airopvolt='$airopvolt', aircurrent='$aircurrent', airgril='$airgril',airroom='$airroom', airdpressure='$airdpressure',airspressure='$airspressure', airothers='$airothers',airambient='$airambient', chargingv='$chargingv', chargingo='$chargingo', dischargingv='$dischargingv', dischargingo='$dischargingo', dischargingwv='$dischargingwv', dischargingwo='$dischargingwo', batterycondition='$batterycondition', engineerreport='$engineerreport', sparesrequired1='$sparesrequired1', sparesrequired1q='$sparesrequired1q', sparesrequired2='$sparesrequired2', sparesrequired2q='$sparesrequired2q', sparesrequired3='$sparesrequired3', sparesrequired3q='$sparesrequired3q', sparesrequired4='$sparesrequired4', sparesrequired4q='$sparesrequired4q', sparesrequired5='$sparesrequired5', sparesrequired5q='$sparesrequired5q', sparesused1='$sparesused1', sparesused1q='$sparesused1q', sparesused2='$sparesused2', sparesused2q='$sparesused2q', sparesused3='$sparesused3', sparesused3q='$sparesused3q', sparesused4='$sparesused4', sparesused4q='$sparesused4q', sparesused5='$sparesused5', sparesused5q='$sparesused5q', callstatus='$callstatus', consigneeavailable='$consigneeavailable',customerfeedback='$customerfeedback', engapproach='$engapproach', signname='$signname', signature='$signature', incgst='$incgst',  smaterial1='$smaterial1', smaterial2='$smaterial2', smaterial3='$smaterial3', smaterial4='$smaterial4', smaterial5='$smaterial5', sprice1='$sprice1', sprice2='$sprice2', sprice3='$sprice3', sprice4='$sprice4', sprice5='$sprice5', squantity1='$squantity1', squantity2='$squantity2', squantity3='$squantity3', squantity4='$squantity4', squantity5='$squantity5', stotal1='$stotal1', stotal2='$stotal2', stotal3='$stotal3', stotal4='$stotal4', stotal5='$stotal5', sgstper1='$sgstper1', sgstper2='$sgstper2',sgstper3='$sgstper3', sgstper4='$sgstper4',sgstper5='$sgstper5',schargepre1='$schargepre1',schargepre2='$schargepre2',schargepre3='$schargepre3',schargepre4='$schargepre4',schargepre5='$schargepre5',sgstpervalue1='$sgstpervalue1',sgstpervalue2='$sgstpervalue2',sgstpervalue3='$sgstpervalue3',sgstpervalue4='$sgstpervalue4',sgstpervalue5='$sgstpervalue5',mchargescharge='$mchargescharge', mchargegstvalue='$mchargegstvalue',schargematerial='$schargematerial',schargescharge='$schargescharge', schargegst='$schargegst',schargegstvalue='$schargegstvalue', sercharge='$sercharge', schargepre='$schargepre', sgstamt='$sgstamt', scharge='$scharge', schargeno='$schargeno', schargedate='$schargedate', imguploads='$imguploads', imgseal='$imgseal',imgmanual='$imgmanual', worktype='$worktype', workpoint='$workpoint', mfpbwa4cpr='$mfpbwa4cpr', mfpbwa4fax='$mfpbwa4fax', mfpbwa4prp='$mfpbwa4prp', mfpclcpr='$mfpclcpr', mfpclfax='$mfpclfax', mfpclprp='$mfpclprp', priportmaster='$priportmaster', priportcopies='$priportcopies', totalmeterreading='$totalmeterreading', producttype='$producttype', pvmake='$pvmake', pvtype='$pvtype', pvcapacity='$pvcapacity', pvqty='$pvqty', pvslno='$pvslno',  ntmake='$ntmake', nttype='$nttype', ntcapacity='$ntcapacity', ntqty='$ntqty', ntslno='$ntslno', shadow='$shadow', noofplstr='$noofplstr', noofstr='$noofstr', tilt='$tilt', plposter='$plposter', civil='$civil', mechanical='$mechanical', elecwiring='$elecwiring', acearth='$acearth', dcearth='$dcearth', laearth='$laearth', spvvol='$spvvol', spvcur='$spvcur', plvoc='$plvoc', plcell='$plcell', plseries='$plseries', plparallel='$plparallel', plvol='$plvol', plangel='$plangel', plpower='$plpower', pltime='$pltime', avgloadnight='$avgloadnight', avgloadday='$avgloadday', totalload='$totalload' where calltid='$calltid' and reassign='0'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "update jrccalls set detailsid='$tid' where calltid='$calltid'");
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A Call Report', '{$tid}', 'tablename')");
				
				//header("Location: callsedit.php?id=".$calloid."&auto=submit&remarks=Updated Successfully");
			} 
			}
			
			$engineertype=mysqli_real_escape_string($connection, $_POST['engineertype']);
		if($engineertype=='1')
		{
			$cengineersid=mysqli_real_escape_string($connection, $_POST['cengineersid']);
			$cengineersper=mysqli_real_escape_string($connection, $_POST['cengineersper']);
			for($is=0;$is<count($cengineersid);$is++)
			{
				if($cengineersid[$is]!='')
				{
					$wp=((float)$cengineersper[$is]/100)*(float)$workpoint;
					$sqleng=mysqli_query($connection,"select loccall1, loccall2, loccall3, loccall4, loccall5, loccall6, loccall7, loctime1, loctime2, loctime3, loctime4, loctime5, loctime6, loctime7, id from jrcengroute where (loccall1='$calltid' or loccall2='$calltid' or loccall3='$calltid' or loccall4='$calltid' or loccall5='$calltid' or loccall6='$calltid' or loccall7='$calltid') and engineerid='".$cengineersid[$is]."' order by id desc limit 1");
					if(mysqli_num_rows($sqleng)>0)
					{
						$infoeng=mysqli_fetch_array($sqleng);
						for($i=1;$i<=7;$i++)
						{
							if($infoeng['loccall'.$i]==$calltid)
							{
								$detailscol='detailsid'.$i;
								$timecol='detailstime'.$i;
								$pointcol='points'.$i;
								$worktimecol='worktime'.$i;
								$statuscol='callstatus'.$i;
								$typecol='calltype'.$i;
								$date_a = new DateTime($infoeng['loctime'.$i]);
								$date_b = new DateTime($editedon);
								$interval = date_diff($date_a,$date_b);
								$worktime=$interval->format('%d d, %h h, %i m, %s s');
							}
						}
						$sqlieng=mysqli_query($connection,"update jrcengroute set $detailscol='$tid', $timecol='$editedon', $pointcol='$wp', $worktimecol='$worktime', $statuscol='$callstatus', $typecol='$calltype' where id='".$infoeng['id']."'");
					}
					mysqli_query($connection, "update jrccallstravel set detailsid='$tid', worktype='$worktype', workpoint='$wp', workper='".$cengineersper[$is]."' where calltid='$calltid' and engineerid='".$cengineersid[$is]."'");
				}
			}
		}
		else
		{
			$sqleng=mysqli_query($connection,"select loccall1, loccall2, loccall3, loccall4, loccall5, loccall6, loccall7, loctime1, loctime2, loctime3, loctime4, loctime5, loctime6, loctime7, id from jrcengroute where (loccall1='$calltid' or loccall2='$calltid' or loccall3='$calltid' or loccall4='$calltid' or loccall5='$calltid' or loccall6='$calltid' or loccall7='$calltid') and engineerid='$engineerid' order by id desc limit 1");
			if(mysqli_num_rows($sqleng)>0)
			{
				$infoeng=mysqli_fetch_array($sqleng);
				for($i=1;$i<=7;$i++)
				{
					if($infoeng['loccall'.$i]==$calltid)
					{
						$detailscol='detailsid'.$i;
						$timecol='detailstime'.$i;
						$pointcol='points'.$i;
						$worktimecol='worktime'.$i;
						$statuscol='callstatus'.$i;
						$typecol='calltype'.$i;
						$date_a = new DateTime($infoeng['loctime'.$i]);
						$date_b = new DateTime($editedon);
						$interval = date_diff($date_a,$date_b);
						$worktime=$interval->format('%d d, %h h, %i m, %s s');
					}
				}
				$sqlieng=mysqli_query($connection,"update jrcengroute set $detailscol='$tid', $timecol='$editedon', $pointcol='$workpoint', $worktimecol='$worktime', $statuscol='$callstatus', $typecol='$calltype' where id='".$infoeng['id']."'");
				
				mysqli_query($connection, "update jrccallstravel set detailsid='$tid', worktype='$worktype', workpoint='$workpoint', workper='100' where calltid='$calltid' and engineerid='".$engineerid."'");
			}	
		}
		header("Location: callsedit.php?id=".$calloid."&auto=submit&remarks=Added Successfully");
}
else
			{
				header("Location: complaint.php?id={$calltid}");
			}
?>