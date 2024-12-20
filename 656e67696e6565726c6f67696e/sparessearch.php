<?php
include ('lcheck.php');
?>
<?php
if(isset($_GET['smaterial1']))
{
$smaterial=mysqli_real_escape_string($connection, $_GET['smaterial1']);
$sql="select * from jrcspares where id='".$smaterial."'";
$result=mysqli_query($connection,$sql);
if($result)
{
if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_array($result);
echo $row['id']."|".(float)$row['price']."|".(float)$row['gstper'];
}
}
}
?>