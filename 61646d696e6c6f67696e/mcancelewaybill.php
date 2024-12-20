<?php
include('lcheck.php');

if (isset($_POST['sono'])) {
	$currentDateTime = new DateTime();
	$expiryDateTime = new DateTime($_SESSION['etokenexpiry']);
	$expiryDateTime->add(new DateInterval('PT6H'));
	$formattedExpiry = $expiryDateTime->format('Y-m-d H:i:s');

	if ($currentDateTime >= $formattedExpiry) 
	{
	$url = 'https://api.mastergst.com/ewaybillapi/v1.03/authenticate?email=ijerald%40jerobyte.com&username=jrcommpl_API_jbs&password=Rohan*123';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$headers = array(
		"accept: */*",
		"username: jrcommpl_API_jbs",
		"password: Rohan*123",
		"ip_address: 192.168.1.111",
		"client_id: 54b95dcf-a86a-47a6-a22a-b0f58666a0fc",
		"client_secret: 64caaabf-115e-452c-bd7a-ee766da3a9da",
		"gstin: 33AACCJ5647F1ZP",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$resp = curl_exec($curl);
	if (curl_errno($curl)) {
		$error_message = "Error making API request: " . curl_error($curl);
		curl_close($curl);
	  //  header("Location: compexporttally.php?error=" . urlencode($error_message));
	   }
	//var_dump($resp);
	curl_close($curl);
	if ($resp) {
		$etokenExpiry = new DateTime();
		$formattedExpiry = $etokenExpiry->format('Y-m-d H:i:s');
		$updateQuery = "UPDATE jrccompany SET etokenexpiry='$formattedExpiry'";
		$result = mysqli_query($connection, $updateQuery);
        if ($result) {
			//var_dump($resp);
          //  header("Location: compexporttally.php?remarks=Token expiry and auth token updated successfully");
                    } else {
            $error_message = "Error updating database: " . mysqli_error($connection);
           // header("Location: compexporttally.php?error=" . urlencode($error_message));
                   }
} else {
    $error_message = "Invalid API response or no response received";
   // header("Location: compexporttally.php?error=" . urlencode($error_message));
    }
	
	}
    $sono = mysqli_real_escape_string($connection, $_POST['sono']);
    $ereason = mysqli_real_escape_string($connection, $_POST['ereason']);
    $eremarks = mysqli_real_escape_string($connection, $_POST['eremarks']);

    $sqlUpdate = "UPDATE jrctally SET ereason='$ereason', eremarks='$eremarks' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error: " . mysqli_error($connection);
        header("Location: compexporttally.php?error=$error");
        exit();
    }

    // Select data from the database
    $sqlselect = "SELECT ewbno, ereason, eremarks FROM jrctally WHERE sono='$sono'";
    $queryselect = mysqli_query($connection, $sqlselect);

    if (!$queryselect) {
        die("SQL query failed: " . mysqli_error($connection));
    }

    if ($rowselect = mysqli_fetch_assoc($queryselect)) {
        $url = 'https://api.mastergst.com/ewaybillapi/v1.03/ewayapi/canewb?email=ijerald%40jerobyte.com'; // Replace with the actual API endpoint

        $headers = [
            "accept: */*",
            "ip_address: 192.168.1.111",
            "client_id: 54b95dcf-a86a-47a6-a22a-b0f58666a0fc",
            "client_secret: 64caaabf-115e-452c-bd7a-ee766da3a9da",
            "gstin: 33AACCJ5647F1ZP",
            "Content-Type: application/json",
        ];

        $requestData = [
            "ewbNo" => (int)$rowselect['ewbno'], // Convert to integer
            "cancelRsnCode" => (int)$rowselect['ereason'], // Convert to integer
            "cancelRmrk" => $rowselect['eremarks']
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($curl, CURLOPT_TIMEOUT, 60); // Set timeout to 60 seconds
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30); // Set connect timeout to 30 seconds

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {
            $error = 'Curl error: ' . curl_error($curl);
            header("Location: compexporttally.php?error=$error");
            exit();
        }

        curl_close($curl);
		
		// Debugging output
    echo 'HTTP Code: ' . $httpcode . '<br>';
    echo 'Response: ' . $response . '<br>';

        // Handle the response
        if ($httpcode === 200 && $response) {
            $responseData = json_decode($response, true);

            if (isset($responseData['status_cd']) && $responseData['status_cd'] === "1" && isset($responseData['data']['ewayBillNo']) && $responseData['data']['ewayBillNo'] == $rowselect['ewbno']) {
                $ewbno = $responseData['data']['ewayBillNo'];
                $ewbstatus = "CANCELLED";

                $updateQuery = "UPDATE jrctally SET ewbstatus='CANCELLED' WHERE ewbno='$ewbno'";
                $result = mysqli_query($connection, $updateQuery);

                if ($result) {
                    header("Location: compexporttally.php?remarks=E-Waybill Cancelled successfully");
                    exit();
                } else {
                    $error = "Error updating database: " . mysqli_error($connection);
                    header("Location: compexporttally.php?error=$error");
                    exit();
                }
            } else {
                $error = "API request was not successful or missing required data";
                header("Location: compexporttally.php?error=$error");
                exit();
            }
        } else {
            $error = "HTTP Code: $httpcode. Response: $response";
            header("Location: compexporttally.php?error=$error");
            exit();
        }
    }
}
?>
