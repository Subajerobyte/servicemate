<?php
include('lcheck.php');
function get_maincategory($connection , $term, $type, $encsystem, $encpass){ 
$a="";
if(($encsystem=='1')||($encsystem=='2'))
{
	if((isset($encpass))&&($encpass!=""))
	{
		$a=" encstatus='1' ";
	}
}
else
{
	$a=" encstatus='0' and (LOWER(".$type.") LIKE LOWER('%".$term."%'))";
}

 $query = "SELECT distinct ".$type." FROM jrcconsignee WHERE ".$a." ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
 $data=array();
while($row = mysqli_fetch_assoc($result)) { 
if(($encsystem=='1')||($encsystem=='2'))
{
	if((isset($encpass))&&($encpass!=""))
	{
		if($row[$type]!='')
		{
		$row[$type]=jbsdecrypt($_SESSION['encpass'], $row[$type]);
		}
		if(strpos(strtolower($row[$type]), strtolower($term)) !== false)
		{
			$data[] = $row; 
		}
	}
}
else
{
$data[] = $row; 	
}




}
 return $data; 
}
 
if (isset($_GET['term'])) {
	
if(isset($_SESSION['encpass']))
{
	$encpass=$_SESSION['encpass'];
}
else
{
	$encpass="";
}
	
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']), $infocompany1['encsystem'], $encpass);
 $maincategoryList = array();
 if(!empty($getmaincategory))
 {
 foreach($getmaincategory as $maincategory){
 $maincategoryList[] = $maincategory[$type];
 }
 }
 echo json_encode($maincategoryList);
}
?>