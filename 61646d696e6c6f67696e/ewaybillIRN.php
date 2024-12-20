<?php
include('lcheck.php');
if (isset($_POST['sono'])) 
{ 
	 
	$sono = mysqli_real_escape_string($connection, $_POST['sono']);
    $deliverymethod = mysqli_real_escape_string($connection, $_POST['deliverymethod']);
    $edistance = mysqli_real_escape_string($connection, $_POST['edistance']);
    $etransportid = mysqli_real_escape_string($connection, $_POST['etransportid']);
    $agentname = mysqli_real_escape_string($connection, $_POST['agentname']);
    $edocumentno = mysqli_real_escape_string($connection, $_POST['edocumentno']);
    $shipment = mysqli_real_escape_string($connection, $_POST['shipment']);
    $vechileno = mysqli_real_escape_string($connection, $_POST['vechileno']);
    $vechiletype = mysqli_real_escape_string($connection, $_POST['vechiletype']);
    $lrno = mysqli_real_escape_string($connection, $_POST['lrno']);
    $deliveryremarks = mysqli_real_escape_string($connection, $_POST['deliveryremarks']);

    // Perform database update to mark IRN as canceled
    $sqlUpdate = "UPDATE jrctally SET  deliverymethod='$deliverymethod', edistance='$edistance', etransportid='$etransportid', agentname='$agentname', edocumentno='$edocumentno', shipment='$shipment', vechileno='$vechileno', vechiletype='$vechiletype', lrno='$lrno', deliveryremarks='$deliveryremarks' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error: " . mysqli_error($connection);
        header("Location: exporttally.php?error=$error");
        exit();
    }
	 
	    $sqlselect = "SELECT * From jrctally where sono='".$sono."'";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{
			$rowselect = array();
			while($row1 = mysqli_fetch_assoc($queryselect))
			{ 
			$rowselect[] = $row1;
			}
$stateCodeconsignee = $rowselect[0]['constatecode'];
$partcon = explode('-', $stateCodeconsignee);
$stateCodecon = trim($partcon[0]);

$host = "https://api-sandbox.clear.in/einv/v2/eInvoice/ewaybill";
$authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
$gstin = "33AAFCD5862R009";

$requestHeaders = [
    'X-Cleartax-Auth-Token: ' . $authToken,
    'gstin: ' . $gstin,
    'Content-Type: application/json'
];

$requestPayload = [
    [
        "Irn" => $rowselect[0]['irn'],
        "Distance" => $rowselect[0]['edistance'],
        "TransMode" => $rowselect[0]['deliverymethod'],
        "TransId" => $rowselect[0]['etransportid'],
        "TransName" => $rowselect[0]['agentname'],
        "TransDocDt" => $rowselect[0]['shipment'],
        "TransDocNo" => $rowselect[0]['edocumentno'],
        "VehNo" => $rowselect[0]['vechileno'],
        "VehType" => $rowselect[0]['vechiletype'],
        "ExpShipDtls" => [
           "Addr1" => $rowselect[0]['conaddress1'],
           "Addr2" => $rowselect[0]['conaddress2'],
           "Loc" => $rowselect[0]['condistrict'],
           "Pin" => $rowselect[0]['conpincode'],
           "Stcd" => $stateCodecon
        ],
        "DispDtls" => [
            "Nm" => $rowselect[0]['consigneename'],
            "Addr1" => $rowselect[0]['conaddress1'],
            "Addr2" => $rowselect[0]['conaddress2'],
            "Loc" => $rowselect[0]['condistrict'],
            "Pin" => $rowselect[0]['conpincode'],
            "Stcd" => $stateCodecon,
        ]
    ]
];

$ch = curl_init($host);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestPayload));
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
    if(isset($responseData[0]['govt_response']) && isset($responseData[0]['govt_response']['Success']) && $responseData[0]['govt_response']['Success'] === "Y") {
        // Extract relevant information from the response
        $ewbno = isset($responseData[0]['govt_response']['EwbNo']) ? $responseData[0]['govt_response']['EwbNo'] : '';
        $ewbdt = isset($responseData[0]['govt_response']['EwbDt']) ? $responseData[0]['govt_response']['EwbDt'] : '';
        $ewbvalidtill = isset($responseData[0]['govt_response']['EwbValidTill']) ? $responseData[0]['govt_response']['EwbValidTill'] : '';
        
        // Update your database with the extracted information
        $updateQuery = "UPDATE jrctally SET ewbno='$ewbno', ewbdt='$ewbdt', ewbvalidtill='$ewbvalidtill' WHERE irn='".$rowselect[0]['irn']."'";
        $result = mysqli_query($connection, $updateQuery);

        if($result) {
			header("Location:exporttally.php?remarks=E-way Bill Generated successfully"); 
			 //echo "<pre>";
        //print_r($responseData);
       //echo "</pre>";
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
    // Handle cURL error or invalid response
	header("Location:exporttally.php?error=Error making API request:  " . curl_error($ch));
}

		}
 }
 ?>

