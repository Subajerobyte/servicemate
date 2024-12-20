<?php
include('lcheck.php');
$transportname = $_POST['stateCode'];
$sql = "SELECT transportid, transportname FROM jrctransport WHERE transportname LIKE '$transportname%'";
$result = mysqli_query($connection, $sql);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stateName = $row['transportid'];
        echo $stateName; 
    } 
} else {
    echo "Error executing query: " . mysqli_error($connection);
}
mysqli_close($connection);
?>
