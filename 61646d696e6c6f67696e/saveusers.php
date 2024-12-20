<?php
include('lcheck.php');
if((isset($_POST['loginid']))&&(isset($_POST['userid'])))
{
if(($_POST['loginid']!='')&&($_POST['userid']!='')&&($companyid!=''))
{
$data['loginid'] = mysqli_real_escape_string($connection, $_POST['loginid']);
$data['userid'] = mysqli_real_escape_string($connection, $_POST['userid']);
$sqli=mysqli_query($connection, "select id from jrcdevices where loginid='".$data['loginid']."' and userid='".$data['userid']."' and companyid='".$companyid."'");
if(mysqli_num_rows($sqli)==0)
{
	$sqli2=mysqli_query($connection, "insert into jrcdevices set loginid='".$data['loginid']."', userid='".$data['userid']."', companyid='".$companyid."'");
	if($sqli2)
	{
		$data['message']="Inserted";
	}
	else
	{
		$data['message']=mysqli_error($connection);
	}
}
else
{
	$data['message']="Already Registered";
}
echo json_encode($data);
exit;
}
}
?>