<?php
include('lcheck.php');
if((isset($_GET['start']))&&(isset($_GET['limit'])))
{
$start=mysqli_real_escape_string($connection, $_GET['start']);
$limit=mysqli_real_escape_string($connection, $_GET['limit']);
echo $start.'-'.$limit.'<br>';
$sqlis=mysqli_query($connection, "select id, stockmaincategory, stocksubcategory, stockitem, componenttype, componentname, typeofproduct, make, capacity from jrcxl order by id asc limit $start, $limit");

while($info=mysqli_fetch_array($sqlis))
{
$stockmaincategory=mysqli_real_escape_string($connection, $info['stockmaincategory']);
$stocksubcategory=mysqli_real_escape_string($connection, $info['stocksubcategory']);
$stockitem=mysqli_real_escape_string($connection, $info['stockitem']);
$componenttype=mysqli_real_escape_string($connection, $info['componenttype']);
$componentname=mysqli_real_escape_string($connection, $info['componentname']);
$typeofproduct=mysqli_real_escape_string($connection, $info['typeofproduct']);
$make=mysqli_real_escape_string($connection, $info['make']);
$capacity=mysqli_real_escape_string($connection, $info['capacity']);
$id=mysqli_real_escape_string($connection, $info['id']);


$sqlconpro = "SELECT id From jrcproduct WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
$queryconpro = mysqli_query($connection, $sqlconpro);
$rowCountconpro = mysqli_num_rows($queryconpro);
 
if(!$queryconpro){
   die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountconpro == 0) 
{
 
$sqluppro = "INSERT INTO jrcproduct( stockmaincategory, stocksubcategory, stockitem, componenttype, componentname, typeofproduct, make, capacity) VALUES ('$stockmaincategory', '$stocksubcategory', '$stockitem', '$componenttype', '$componentname', '$typeofproduct', '$make', '$capacity')";
$queryuppro = mysqli_query($connection, $sqluppro);
 
if(!$queryuppro){
   die("SQL query failed: " . mysqli_error($connection));
}
else
{
$productid=mysqli_insert_id($connection);
$sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
$queryup1pro = mysqli_query($connection, $sqlup1pro);
 
if(!$queryup1pro){
   die("SQL query failed: " . mysqli_error($connection));
}
}
}
else
{
$rowcopro = mysqli_fetch_array($queryconpro);
$productid=$rowcopro['id'];
$sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
$queryup1pro = mysqli_query($connection, $sqlup1pro);
 
if(!$queryup1pro){
   die("SQL query failed: " . mysqli_error($connection));
}
}
echo $id.'-'.$productid.'<br>';
}
}
?>