<?php
include('lcheck.php'); 
if(isset($_POST['id']))
{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$sqlselect = "SELECT stockitem From jrcquotationtype where id='$id' order by quotationtype asc";
	$queryselect = mysqli_query($connection, $sqlselect);
    $rowCountselect = mysqli_num_rows($queryselect);
    if(!$queryselect){
        die("SQL query failed: " . mysqli_error($connection));
    }
	echo "<option value=''>Select Product</option>";
    if($rowCountselect > 0) 
	{
		$count=1;
		while($rowprotype = mysqli_fetch_array($queryselect)) 
		{
			$stockitems=explode(',',$rowprotype['stockitem']);
			foreach($stockitems as $st)
			{
				$sqlselect2 = "SELECT * From jrcproduct where id='$st' order by stockitem asc";
				$queryselect2 = mysqli_query($connection, $sqlselect2);
				$infoselect2=mysqli_fetch_array($queryselect2);
		?>
		<option value="<?=$infoselect2['id']?>"><?=$infoselect2['stockitem']?><?=($infoselect2['make']!='')?' | '.$infoselect2['make']:''?></option>
		<?php
			}
		}
	}
}
if(isset($_POST['proid']))
{
	$id=mysqli_real_escape_string($connection, $_POST['proid']);
	$sqlselect2 = "SELECT * From jrcproduct where id='$id' order by stockitem asc";
	$queryselect2 = mysqli_query($connection, $sqlselect2);
	$infoselect2=mysqli_fetch_array($queryselect2);
	
echo $infoselect2['id'].'|'.$infoselect2['stockmaincategory'].'|'.$infoselect2['stocksubcategory'].'|'.$infoselect2['stockitem'].'|'.$infoselect2['typeofproduct'].'|'.$infoselect2['componenttype'].'|'.$infoselect2['componentname'].'|'.$infoselect2['make'].'|'.$infoselect2['capacity'].'|'.$infoselect2['warranty'].'|'.$infoselect2['description'].'|'.$infoselect2['price'].'|'.$infoselect2['minprice'].'|'.$infoselect2['gst'].'|'.$infoselect2['scrapvalue'].'|'.$infoselect2['amcvalue'].'|'.$infoselect2['amcgst'].'|'.$infoselect2['installvalue'].'|'.$infoselect2['gsttype'];
	
}
?>
	