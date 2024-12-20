<?php
include ('lcheck.php');
?>
<?php

if(isset($_GET['sparesused1']) || isset($_GET['sparesused2']) || isset($_GET['sparesused3']) || isset($_GET['sparesused4']) || isset($_GET['sparesused5']) || isset($_GET['sparesrequired1']) || isset($_GET['sparesrequired2']) || isset($_GET['sparesrequired3']) || isset($_GET['sparesrequired4']) || isset($_GET['sparesrequired5']))
{
	if(isset($_GET['sparesused1']))
	{
		$used=$_GET['sparesused1'];
	}
	if(isset($_GET['sparesused2']))
	{
		$used=$_GET['sparesused2'];
	}
	if(isset($_GET['sparesused3']))
	{
		$used=$_GET['sparesused3'];
	}if(isset($_GET['sparesused4']))
	{
		$used=$_GET['sparesused4'];
	}
	if(isset($_GET['sparesused5']))
	{
		$used=$_GET['sparesused5'];
	}
  if(isset($_GET['sparesrequired1']))
	{
		$used=$_GET['sparesrequired1'];
	}
	if(isset($_GET['sparesrequired2']))
	{
		$used=$_GET['sparesrequired2'];
	}
	if(isset($_GET['sparesrequired3']))
	{
		$used=$_GET['sparesrequired3'];
	}if(isset($_GET['sparesrequired4']))
	{
		$used=$_GET['sparesrequired4'];
	}
	if(isset($_GET['sparesrequired5']))
	{
		$used=$_GET['sparesrequired5'];
	}
$sparesused=mysqli_real_escape_string($connection,$used);	
$sql="select *from jrcspares where CONCAT(subcategory, ' - ', wattage)='".$sparesused."' or subcategory='".$sparesused."'";
$result=mysqli_query($connection,$sql);
if($result)
{
if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_array($result);
echo $row['spareunit'];
}
}
}
?>