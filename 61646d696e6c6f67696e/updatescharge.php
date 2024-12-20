<?php
include('lcheck.php');
$sqli=mysqli_query($connection, "select * from jrccalldetails where scharge!='0.00' and scharge!='0' and scharge!='' and scharge is not null");
while($infoi=mysqli_fetch_array($sqli))
{
	echo $infoi['']
}
?>