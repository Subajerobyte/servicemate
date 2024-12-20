<?php
include('lcheck.php'); 

if(isset($_POST['pono'])) {
  
    $pono = mysqli_real_escape_string($connection,$_POST['pono']);
    $salesorderno = mysqli_real_escape_string($connection,$_POST['salesorderno']);
	$installrefno = mysqli_real_escape_string($connection, $_POST['installrefno']);
    $suprefno = mysqli_real_escape_string($connection, $_POST['suprefno']);
    $claimper = mysqli_real_escape_string($connection, $_POST['claimper']);

    // Perform database update to mark IRN as canceled
    $sqlUpdate = "UPDATE jrcxl SET  installrefno='$installrefno', suprefno='$suprefno', claimper='$claimper' WHERE sono = '$salesorderno'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error => " . mysqli_error($connection);
        header("Location => exporttally.php?error=$error");
        exit();
    }
	else
	{
		header("Location: invoicesubprint.php?pono=" . $pono);
	}
}
?>