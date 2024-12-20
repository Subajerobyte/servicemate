<?php
include('lcheck.php');

if (isset($_POST['sono'])) {
    $sono = mysqli_real_escape_string($connection, $_POST['sono']);
    $reason = mysqli_real_escape_string($connection, $_POST['reason']);
    $remarks = mysqli_real_escape_string($connection, $_POST['remarks']);

    // Perform database update to mark IRN as canceled
    $sqlUpdate = "UPDATE jrctally SET reason='$reason', remarks='$remarks' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error: " . mysqli_error($connection);
        header("Location: exporttally.php?error=$error");
        exit();
    }

    // Select data from the database
    $sqlselect = "SELECT irn, reason, remarks FROM jrctally WHERE sono='$sono'";
    $queryselect = mysqli_query($connection, $sqlselect);

    if (!$queryselect) {
        die("SQL query failed: " . mysqli_error($connection));
    }

    if ($rowselect = mysqli_fetch_assoc($queryselect)) {
        $apiEndpoint = 'https://api-sandbox.clear.in/einv/v2/eInvoice/cancel';
        $authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
        $gstin = "33AAFCD5862R009";

        // Sample JSON data for the request
        $requestData = [
            [
                "irn" => $rowselect['irn'],
                "CnlRsn" => $rowselect['reason'],
                "CnlRem" => $rowselect['remarks']
            ]
        ];

        // Use cURL to send PUT request
        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Cleartax-Auth-Token: ' . $authToken,
            'Gstin: ' . $gstin,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        if ($response) {
            // Parse the response JSON
            $responseData = json_decode($response, true);
			
			// Check if the response contains govt_response and it indicates success
    if(isset($responseData[0]['govt_response']) && isset($responseData[0]['govt_response']['Success']) && $responseData[0]['govt_response']['Success'] === "Y") {
        // Extract relevant information from the response
        $irn = isset($responseData[0]['govt_response']['Irn']) ? $responseData[0]['govt_response']['Irn'] : '';
        $canceldocumentstatus = isset($responseData[0]['document_status']) ? $responseData[0]['document_status'] : '';
        $canceldate = isset($responseData[0]['govt_response']['CancelDate']) ? $responseData[0]['govt_response']['CancelDate'] : '';
        
        // Update your database with the extracted information
         $updateQuery = "UPDATE jrctally SET canceldocumentstatus='$canceldocumentstatus', canceldate='$canceldate' WHERE irn='$irn'";
        $result = mysqli_query($connection, $updateQuery);

        if($result) {
			header("Location:exporttally.php?remarks=IRN Cancel successfully"); 
			 //echo "<pre>";
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
