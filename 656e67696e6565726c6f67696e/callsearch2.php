<?php
include('lcheck.php');
if(isset($_GET['callnature']))
{
$callnature=mysqli_real_escape_string($connection, $_GET['callnature']);
$sql="select id, calltype, callnature from jrccallnature where callnature='".$callnature."'";
$result=mysqli_query($connection,$sql);
if($result)
{
if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_array($result);
if($row['calltype']!='')
{
echo $row['calltype'];
}
else
{
echo "Other Call";
}
}
}
}
?>