<?php
include('lcheck.php');
$a=array();
$totalamc=0;
$monthamc=0;
$totalamc1=0;
$preventive=(float)$_SESSION['preventive'];
$preventivealert=(float)$_SESSION['preventivealert'];
$warrantyexpire=(float)$_SESSION['warrantyexpire'];
$amcmaintenance=(float)$_SESSION['amcmaintenance'];
$amcmaintenancealert=(float)$_SESSION['amcmaintenancealert'];
$amcexpire=(float)$_SESSION['amcexpire'];
$lifetime=(float)$_SESSION['lifetime'];
$sqlselect = "SELECT sourceid, dateto, datefrom, amctype, consigneeid From jrcamc where dateto>='".date('Y-m-d')."' order by datefrom asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
 die("SQL query failed: " . mysqli_error($connection));
}
$inarray="";
if($rowCountselect > 0) 
{
$count=1;

while($rowselect = mysqli_fetch_array($queryselect)) 
{
$sourceid=$rowselect['sourceid'];
if($inarray=='')
{
$inarray=$rowselect['sourceid'];
}
else
{
$inarray.=','.$rowselect['sourceid'];
}
if($rowselect['dateto']!='')
{
$date1=$rowselect['datefrom'];
$date = new DateTime($rowselect['dateto']);
$now = new DateTime();
$yesterday=date('Y-m-d',strtotime("-1 days"));
$today=date('Y-m-d');
if($date >= $now) 
{
$tyes=0;

if($rowselect['amctype']=='Monthly')
{
for($dc=1;$dc<=12;$dc++)
{	
$targetdate=date('Y-m-d', strtotime($date1. ' + '.$dc.' months'));
if($targetdate==$today)
{
$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
$tyes=1;
}
if($targetdate==$yesterday)
{
$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
$tyes=1;
}
}
$amcmaintenance='1';
}

if($rowselect['amctype']=='Quarterly')
{
$targetdate=date('Y-m-d', strtotime($date1. ' + 3 months'));
if($targetdate==$today)
{
$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
$tyes=1;
}
if($targetdate==$yesterday)
{
$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
$tyes=1;
}
$targetdate=date('Y-m-d', strtotime($date1. ' + 6 months'));
if($targetdate==$today)
{
$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
$tyes=1;
}
if($targetdate==$yesterday)
{
$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
$tyes=1;
}

$targetdate=date('Y-m-d', strtotime($date1. ' + 9 months'));
if($targetdate==$today)
{
$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
$tyes=1;
}
if($targetdate==$yesterday)
{
$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
$tyes=1;
}
$amcmaintenance='3';
}
if($rowselect['amctype']=='Half Yearly')
{
$targetdate=date('Y-m-d', strtotime($date1. ' + 6 months'));
if($targetdate==$today)
{
$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
$tyes=1;
}
if($targetdate==$yesterday)
{
$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
$tyes=1;
}
$amcmaintenance='6';
}
if($rowselect['amctype']=='Annually')
{
$targetdate=date('Y-m-d', strtotime($date1. ' + 12 months'));
if($targetdate==$today)
{
$enddate=date('Y-m-d', strtotime($today. ' + 7 days')).'T18:30';
$tyes=1;
}
if($targetdate==$yesterday)
{
$enddate=date('Y-m-d', strtotime($yesterday. ' + 7 days')).'T18:30';
$tyes=1;
}
$amcmaintenance='12';
}
if($tyes!=0)
{
$sqlcon = "SELECT id,consigneename,district From jrcconsignee where id='".$rowselect['consigneeid']."' order by consigneename asc";
$querycon = mysqli_query($connection, $sqlcon);
$rowcon = mysqli_fetch_array($querycon);
$remindervalue='AMC Invoice to be raised for <a href="consigneeview.php?id='.$rowcon['id'].'">'.preg_replace("/'/","",$rowcon['consigneename']).'-'.$rowcon['district'].'</a>';
 
$sqlrem = "SELECT id From jrcreminder WHERE remindertype='AMC INVOICE' and sourceid='{$sourceid}' and reminder = '{$remindervalue}' and enddate = '{$enddate}'";
$queryrem = mysqli_query($connection, $sqlrem);
$rowCountrem = mysqli_num_rows($queryrem);
 
if(!$queryrem){
 die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountrem == 0) 
{
 
$sqlup = "INSERT INTO jrcreminder( createdon,remindertype, sourceid, reminder,enddate) VALUES ( '$times','AMC INVOICE', '$sourceid', '$remindervalue','$enddate')";
$queryup = mysqli_query($connection, $sqlup);
 
if(!$queryup){
 die("SQL query failed: " . mysqli_error($connection));
}
else
{
$tid=mysqli_insert_id($connection);
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reminder', '{$tid}')");
} 
}
}

$value=$rowselect['consigneeid'];
$a[]=$value;


$totalamc1++;
$datediff = strtotime($rowselect['dateto']) - strtotime($today);
$effectiveDate=$rowselect['dateto'];
$days=round($datediff / (60 * 60 * 24));

 $overdate=$rowselect['datefrom'];
$effectiveDate=$rowselect['dateto'];

////amc
if($days>0)
{
	
	if($_SESSION['amcmaintype']=='Scalable')
	{ 

		$sqlcall=mysqli_query($connection,"SELECT callon from jrccalls where sourceid='$sourceid' and customernature='AMC' and callon<'$today' ");
		$rowcountcall=mysqli_num_rows($sqlcall);
		if($rowcountcall>0)
		{
		$rowcall=mysqli_fetch_array($sqlcall);
		 $overdate=date('Y-m-d',strtotime($rowcall['callon']));
		}
	}
	else
	{
		$overdate=$rowselect['datefrom'];
	}
	
	
	$start=strtotime($overdate);
	$end1 =strtotime($effectiveDate);
	$interval   = (float)$amcmaintenance*24*60*60;
	$chunks = array();
	$date=$overdate;
	$end_date=$effectiveDate;
	while (strtotime($date) < strtotime($end_date)) 
	{
		$date = date("Y-m-d", strtotime("+".$amcmaintenance." months", strtotime($date)));
		$chunks[] = $date;
	}
	foreach($chunks as $chunk)
	{
		$atdiff = strtotime($chunk) - strtotime($today);
		$atdays=round($atdiff / (60 * 60 * 24));
		if(($atdays>0)&&($atdays<$preventivealert))
		{
			$sqlcon = "SELECT id,consigneename,district From jrcconsignee where id='".$rowselect['consigneeid']."' order by consigneename asc";
			$querycon = mysqli_query($connection, $sqlcon);
			$rowcon = mysqli_fetch_array($querycon);
			$remindervalue='AMC Maintenance to be done on '.(date('d/m/Y',strtotime($chunk))).' for <a href="consigneeview.php?id='.$rowcon['id'].'">'.preg_replace("/'/","",$rowcon['consigneename']).'-'.$rowcon['district'].'</a>';
			 
			$sqlrem = "SELECT id From jrcreminder WHERE remindertype='AMC MAINTENANCE' and sourceid='{$sourceid}' and reminder = '{$remindervalue}' and enddate = '{$chunk}'";
			$queryrem = mysqli_query($connection, $sqlrem);
			$rowCountrem = mysqli_num_rows($queryrem);
			 
			if(!$queryrem){
			 die("SQL query failed: " . mysqli_error($connection));
			}
			 
			if($rowCountrem == 0) 
			{
			 
			$sqlup = "INSERT INTO jrcreminder( createdon,remindertype, sourceid, reminder,enddate) VALUES ( '$times','AMC MAINTENANCE', '$sourceid', '$remindervalue','$chunk')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			 die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
			$tid=mysqli_insert_id($connection);
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reminder', '{$tid}')");
			} 
			}
		}
	}
}
////amc


if($days<30)
{
$monthamc++;
$sqlcon = "SELECT id, consigneename, district From jrcconsignee where id='".$rowselect['consigneeid']."' order by consigneename asc";
$querycon = mysqli_query($connection, $sqlcon);
$rowcon = mysqli_fetch_array($querycon);
$remindervalue='AMC is going to Expire on '.(date('d/m/Y',strtotime($effectiveDate))).' for <a href="consigneeview.php?id='.$rowcon['id'].'">'.preg_replace("/'/","",$rowcon['consigneename']).'-'.$rowcon['district'].'</a>';
 
$sqlrem = "SELECT id From jrcreminder WHERE remindertype='AMC EXPIRE' and sourceid='{$sourceid}' and reminder = '{$remindervalue}' and enddate = '{$effectiveDate}'";
$queryrem = mysqli_query($connection, $sqlrem);
$rowCountrem = mysqli_num_rows($queryrem);
 
if(!$queryrem){
 die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountrem == 0) 
{
 
$sqlup = "INSERT INTO jrcreminder( createdon, remindertype, sourceid, reminder,enddate) VALUES ( '$times','AMC EXPIRE', '$sourceid', '$remindervalue','$effectiveDate')";
$queryup = mysqli_query($connection, $sqlup);
 
if(!$queryup){
 die("SQL query failed: " . mysqli_error($connection));
}
else
{
$tid=mysqli_insert_id($connection);
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reminder', '{$tid}')");
} 
}
}
}
}
}
}
if($inarray!='')
{
$sqlselect1="SELECT sum(qty) as qty From jrcxl where id in (".$inarray.") order by id asc";
$queryselect1=mysqli_query($connection, $sqlselect1);
$infoselect1=mysqli_fetch_array($queryselect1);
$totalamc=$infoselect1['qty'];
}
$a=array_unique($a);




//////////////////////////////////////////////////////////////////////////
$a=array();
$b=array();

$totalwarranty=0;
$monthwarranty=0;
$monthproduct=0;
$totalproduct=0;

$sqlselect = "SELECT id, warranty, installedon, consigneeid, invoicedate,productlifetime,lifetimedate,warrantycycle From jrcxl where warranty!='' group by invoiceno, invoicedate, stockitem, typeofproduct, componenttype, componentname, serialnumber order by invoicedate desc, warranty asc";
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
$sourceid=$rowselect['id'];	
if($rowselect['warranty']!='')
{
if($rowselect['installedon']!='')
{
$overdate=$rowselect['installedon'];
}
else
{
$overdate=$rowselect['invoicedate'];
}
$off=(float)$rowselect['warranty'];
$overdate=str_replace('/', '-', $overdate);
$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate =date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
$date  = new DateTime($effectiveDate);
$now   = new DateTime();
$today = date('Y-m-d');
if($date >= $now) 
{
$value=$rowselect['consigneeid'];
if(!in_array($value, $a))
{
$a[]=$value;
}
$totalwarranty++;
$datediff = strtotime($effectiveDate) - strtotime($today);
$days=round($datediff / (60 * 60 * 24));

////preventive
if($days>0)
{
	$start=strtotime($overdate);
	$end1 =strtotime($effectiveDate);
	if($rowselect['warrantycycle']!='' && $rowselect['warrantycycle']!='NULL')
	{
	$interval   = (float)$rowselect['warrantycycle']*24*60*60;
	}
	else
	{
	$interval   = (float)$preventive*24*60*60;
	}
	$chunks = array();
	$date=$overdate;
	$end_date=$effectiveDate;
	while (strtotime($date) < strtotime($end_date)) 
	{
		if($rowselect['warrantycycle']!='' && $rowselect['warrantycycle']!='NULL')
		{
		$date = date("Y-m-d", strtotime("+".$rowselect['warrantycycle']." months", strtotime($date)));
		}
		else
		{
			$date = date("Y-m-d", strtotime("+".$preventive." months", strtotime($date)));
		}
		$chunks[] = $date;
	}
	foreach($chunks as $chunk)
	{
		$atdiff = strtotime($chunk) - strtotime($today);
		$atdays=round($atdiff / (60 * 60 * 24));
		if(($atdays>0)&&($atdays<$preventivealert))
		{
			$sqlcon = "SELECT id,consigneename,district From jrcconsignee where id='".$rowselect['consigneeid']."' order by consigneename asc";
			$querycon = mysqli_query($connection, $sqlcon);
			$rowcon = mysqli_fetch_array($querycon);
			$remindervalue='Preventive Maintenance to be done on '.(date('d/m/Y',strtotime($chunk))).' for <a href="consigneeview.php?id='.$rowcon['id'].'">'.preg_replace("/'/","",$rowcon['consigneename']).'-'.$rowcon['district'].'</a>';
			 
		echo	$sqlrem = "SELECT id From jrcreminder WHERE remindertype='PREVENTIVE MAINTENANCE' and sourceid='{$sourceid}' and reminder = '{$remindervalue}' and enddate = '{$chunk}'";
			$queryrem = mysqli_query($connection, $sqlrem);
			$rowCountrem = mysqli_num_rows($queryrem);
			 
			if(!$queryrem){
			 die("SQL query failed: " . mysqli_error($connection));
			}
			 
			if($rowCountrem == 0) 
			{
			 
		echo 	$sqlup = "INSERT INTO jrcreminder( createdon, remindertype, sourceid, reminder,enddate) VALUES ( '$times','PREVENTIVE MAINTENANCE', '$sourceid', '$remindervalue','$chunk')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			 die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
			$tid=mysqli_insert_id($connection);
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reminder', '{$tid}')");
			} 
			}
		}
	}
}
////preventive

/////warranty expire
if(($days>0)&&($days<$warrantyexpire))
{
$monthwarranty++;
$sqlcon = "SELECT id,consigneename,district From jrcconsignee where id='".$rowselect['consigneeid']."' order by consigneename asc";
$querycon = mysqli_query($connection, $sqlcon);
$rowcon = mysqli_fetch_array($querycon);
$remindervalue='Warranty is going to Expire on '.(date('d/m/Y',strtotime($effectiveDate))).' for <a href="consigneeview.php?id='.$rowcon['id'].'">'.preg_replace("/'/","",$rowcon['consigneename']).'-'.$rowcon['district'].'</a>';
 
$sqlrem = "SELECT id From jrcreminder WHERE remindertype='WARRANTY EXPIRE' and sourceid='{$sourceid}' and reminder = '{$remindervalue}' and enddate = '{$effectiveDate}'";
$queryrem = mysqli_query($connection, $sqlrem);
$rowCountrem = mysqli_num_rows($queryrem);
 
if(!$queryrem){
 die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountrem == 0) 
{
 
$sqlup = "INSERT INTO jrcreminder( createdon, remindertype, sourceid, reminder,enddate) VALUES ( '$times','WARRANTY EXPIRE', '$sourceid', '$remindervalue','$effectiveDate')";
$queryup = mysqli_query($connection, $sqlup);
 
if(!$queryup){
 die("SQL query failed: " . mysqli_error($connection));
}
else
{
$tid=mysqli_insert_id($connection);
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reminder', '{$tid}')");
} 
}
}
//////warranty expire



}
}




//////product life time expire 




if($rowselect['productlifetime']!='')
{
	

if($rowselect['installedon']!='')
{
$overdate=$rowselect['installedon'];
}
else
{
$overdate=$rowselect['invoicedate'];
}
$off=(float)$rowselect['productlifetime'];
$overdate=str_replace('/', '-', $overdate);
$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate =date('Y-m-d', strtotime("+$off years", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
$date  = new DateTime($effectiveDate);
$now   = new DateTime();
$today = date('Y-m-d');
if($date >= $now) 
{
$value=$rowselect['consigneeid'];
if(!in_array($value, $b))
{
$b[]=$value;
}
$totalproduct++;
$datediff = strtotime($effectiveDate) - strtotime($today);
 $days=round($datediff / (60 * 60 * 24));

$lifetime=date('t',mktime(0,0,0,$lifetime,1));

if(($days>0)&&($days<$lifetime))
{
	
$monthproduct++;
 $sqlcon = "SELECT id,consigneename,district From jrcconsignee where id='".$rowselect['consigneeid']."' order by consigneename asc";
$querycon = mysqli_query($connection, $sqlcon);
$rowcon = mysqli_fetch_array($querycon);
$remindervalue='Product life time is going to Expire on '.(date('d/m/Y',strtotime($effectiveDate))).' for <a href="consigneeview.php?id='.$rowcon['id'].'">'.preg_replace("/'/","",$rowcon['consigneename']).'-'.$rowcon['district'].'</a>';
 
  $sqlrem = "SELECT id From jrcreminder WHERE remindertype='PRODUCT LIFETIME EXPIRE' and sourceid='{$sourceid}' and reminder = '{$remindervalue}' and enddate = '{$effectiveDate}'";
$queryrem = mysqli_query($connection, $sqlrem);
$rowCountrem = mysqli_num_rows($queryrem);
 
if(!$queryrem){
 die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountrem == 0) 
{
 
  $sqlup = "INSERT INTO jrcreminder( createdon, remindertype, sourceid, reminder,enddate) VALUES ( '$times','PRODUCT LIFETIME EXPIRE', '$sourceid', '$remindervalue','$effectiveDate')";
$queryup = mysqli_query($connection, $sqlup);
 
if(!$queryup){
 die("SQL query failed: " . mysqli_error($connection));
}
else
{
$tid=mysqli_insert_id($connection);
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reminder', '{$tid}')");
} 
}
}
}
}
//////product life time expire 







}
}
?>