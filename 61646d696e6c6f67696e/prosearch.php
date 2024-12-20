<?php
include ('lcheck.php');
?>
<?php
if(isset($_GET['godownname']))
{
$godownname=mysqli_real_escape_string($connection, $_GET['godownname']);
echo "<option value=''>Select</option>";
echo $sql="select id from jrcgodown where godownname='".$godownname."'";
$result=mysqli_query($connection,$sql);
if($result)
{
if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_array($result);

	$sql1="select id, godownid,productid from jrcproductstock where godownid='".$row['id']."'";
$result1=mysqli_query($connection,$sql1);
while($row1=mysqli_fetch_array($result1))
{
$sql2="select id, stockitem from jrcproduct where id='".$row1['productid']."'";
$result2=mysqli_query($connection,$sql2);
$row2=mysqli_fetch_array($result2);
?>
<option value="<?=$row2['id']?>"><?=$row2['stockitem']?></option>
<?php
}
}
}
}
if(isset($_GET['stockitem']))
{
$stockitem=mysqli_real_escape_string($connection, $_GET['stockitem']);
$sql="select id, currentstock,stockitem from jrcproduct where id='".$stockitem."'";
$result=mysqli_query($connection,$sql);
if($result)
{
if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_array($result);
echo $row['id']."|".$row['currentstock'];
}
}
}
?>