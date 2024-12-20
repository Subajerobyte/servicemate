<?php
include('lcheck.php');

if (isset($_POST['sono'])) {
    $sono = mysqli_real_escape_string($connection, $_POST['sono']);
    $ereason = mysqli_real_escape_string($connection, $_POST['ereason']);
    $eremarks = mysqli_real_escape_string($connection, $_POST['eremarks']);

    // Perform database update to mark IRN as canceled
    $sqlUpdate = "UPDATE jrctally SET  ereason='$ereason', eremarks='$eremarks' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error: " . mysqli_error($connection);
        header("Location: exporttally.php?error=$error");
        exit();
    }

    // Select data from the database
    $sqlselect = "SELECT ewbno, ereason, eremarks FROM jrctally WHERE sono='$sono'";
    $queryselect = mysqli_query($connection, $sqlselect);

    if (!$queryselect) {
        die("SQL query failed: " . mysqli_error($connection));
    }
    
    if ($rowselect = mysqli_fetch_assoc($queryselect)) {
		$host = "https://api-sandbox.clear.in/einv/v2/eInvoice/ewaybill/cancel";
        $authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
        $gstin = "33AAFCD5862R009";

$requestHeaders = [
    'X-Cleartax-Auth-Token: ' . $authToken,
    'gstin: ' . $gstin,
    'Content-Type: application/json'
];
        // Sample JSON data for the request
        $requestData = [
                "ewbNo" => $rowselect['ewbno'],
                "cancelRsnCode" => $rowselect['ereason'],
                "cancelRmrk" => $rowselect['eremarks']
        ];

        $ch = curl_init($host);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

curl_close($ch);


if ($response) {
            // Parse the response JSON
            $responseData = json_decode($response, true);
			// Check if the response contains govt_response and it indicates success
     if(isset($responseData['ewbNumber']) == $rowselect['ewbno']) {
        // Extract relevant information from the response
        $irn = isset($responseData['Irn']) ? $responseData['Irn'] : '';
        $ewbno = isset($responseData['ewbNumber']) ? $responseData['ewbNumber'] : '';
        $ewbstatus = isset($responseData['ewbStatus']) ? $responseData['ewbStatus'] : '';
        
        // Update your database with the extracted information
         $updateQuery = "UPDATE jrctally SET ewbstatus='$ewbstatus' WHERE ewbno='$ewbno'";
        $result = mysqli_query($connection, $updateQuery);

        if($result) {
			header("Location:exporttally.php?remarks=E-Waybill Cancel successfully"); 
			// echo "<pre>";
            // print_r($responseData);
            // echo "</pre>";
        } else {
			header("Location:exporttally.php?error=Error updating database: " . mysqli_error($connection));
        }
    } else {
		header("Location:exporttally.php?error=API request was not successful or missing required data");
        // Output the response for debugging
       // echo "<pre>";
       // print_r($responseData);
       // echo "</pre>";
    } 
			
        } else {
            $error = "Error making API request: " . curl_error($ch);
            header("Location: exporttally.php?error=$error");
            exit();
        }
    }
}
?>
