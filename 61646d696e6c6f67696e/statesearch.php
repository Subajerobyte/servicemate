<?php
include('lcheck.php');
$stateCode = $_POST['stateCode'];
$sql = "SELECT statecode FROM jrcplace WHERE statecode LIKE '$stateCode%'";
$result = mysqli_query($connection, $sql);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stateName = $row['statecode'];
        echo $stateName; 
    } 
} else {
    echo "Error executing query: " . mysqli_error($connection);
}
mysqli_close($connection);
?>
