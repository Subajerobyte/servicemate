<?php
include('lcheck.php');
if(isset($_GET['id']))
 {
	 $date=date('Y-m-d');
	 mysqli_query($connection,"update jrctally set installedon='".$date."' where sono='".$_GET['id']."'");
	 mysqli_query($connection,"update jrcxl set installedon='".$date."' where sono='".$_GET['id']."'");
	 header("Location:exporttally.php?remarks=Installation Certificate Generated Successfully"); 	
 }
 else
 {
	 header("Location:exporttally.php?error=Installation Certificate Not Generated");
 }