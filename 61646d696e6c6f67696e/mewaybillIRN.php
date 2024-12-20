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
    $sqlUpdate = "UPDATE jrctally SET deliverymethod='$deliverymethod', edistance='$edistance', etransportid='$etransportid', agentname='$agentname', edocumentno='$edocumentno', shipment='$shipment', vechileno='$vechileno', vechiletype='$vechiletype', lrno='$lrno', deliveryremarks='$deliveryremarks' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error: " . mysqli_error($connection);
        header("Location: compexporttally.php?error=$error");
        exit();
    }

    $sqlselect = "SELECT * FROM jrctally WHERE sono='$sono'";
    $queryselect = mysqli_query($connection, $sqlselect);
    $rowCountselect = mysqli_num_rows($queryselect);

    if (!$queryselect) {
        die("SQL query failed: " . mysqli_error($connection));
    }

    if ($rowCountselect > 0) {
        $rowselect = array();
        while ($row1 = mysqli_fetch_assoc($queryselect)) {
            $rowselect[] = $row1;
        }
        
        $stateCodeconsignee = $rowselect[0]['constatecode'];
        $partcon = explode('-', $stateCodeconsignee);
        $stateCodecon = trim($partcon[0]);

        $url = 'https://api.mastergst.com/einvoice/type/GENERATE_EWAYBILL/version/V1_03?email=ijerald%40jerobyte.com'; // Replace with the actual API endpoint

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $authtoken = $_SESSION['authtoken'];
        $headers = [
            "accept: */*",
            "ip_address: 192.168.1.111",
            "client_id: 9823d6bc-0c3a-4297-ac49-165fe7e22b42",
            "client_secret: c54de1ec-f55f-4757-81fe-a74f4fceb35e",
            "username: jrcommpl_API_jbs",
            "auth-token: $authtoken",
            "gstin: 33AACCJ5647F1ZP",
            "Content-Type: application/json",
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Correct the Transport Document Date format to DD/MM/YYYY
        $shipmentDate = date("d/m/Y", strtotime($rowselect[0]['shipment']));

        // Ensure that the Vehicle Type is either 'O' or 'R'
        $vechileType = substr($rowselect[0]['vechiletype'], 0, 1);

       if($rowselect[0]['deliverymethod']=="5")
		{
			$requestPayload = [
            "Irn" => $rowselect[0]['irn'],
            "Distance" => $rowselect[0]['edistance'],
            "TransId" => $rowselect[0]['etransportid'],
            "TransName" => $rowselect[0]['agentname'],
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
        ];
		}
		else
		{
			$requestPayload = [
            "Irn" => $rowselect[0]['irn'],
            "Distance" => $rowselect[0]['edistance'],
            "TransMode" => $rowselect[0]['deliverymethod'],
            "TransId" => $rowselect[0]['etransportid'],
            "TransName" => $rowselect[0]['agentname'],
            "TransDocDt" => $shipmentDate,
            "TransDocNo" => $rowselect[0]['edocumentno'],
            "VehNo" => $rowselect[0]['vechileno'],
            "VehType" => $vechileType,
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
        ];
		}
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestPayload));

        $resp = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
			echo "<pre>";
        print_r($requestPayload);
        echo "</pre>";
		
            echo 'HTTP Code: ' . $httpcode . '<br>';
            echo 'Response: ' . $resp;

            if ($httpcode == 200) {
                $responseData = json_decode($resp, true);

                if ($responseData['status_cd'] == "1") {
                    // Extract relevant information from the response
                    $ewbno = isset($responseData['data']['EwbNo']) ? $responseData['data']['EwbNo'] : '';
                    $ewbdt = isset($responseData['data']['EwbDt']) ? $responseData['data']['EwbDt'] : '';
                    $ewbvalidtill = isset($responseData['data']['EwbValidTill']) ? $responseData['data']['EwbValidTill'] : '';
                    if (!file_exists('img/qrcode/'))
					{
					mkdir('img/qrcode/', 0777, true);
					}
					// Include the phpqrcode library using an absolute path
					require_once '../../1637028036/vendor/phpqrcode/qrlib.php';
					function generateQRCode($data, $path)
					{
						QRcode::png($data, $path, QR_ECLEVEL_L, 10);
						return $path;
					}
					$productDetail = json_encode([
						'eway Bill No' => $ewbno,
						'Generated Date' => $ewbdt
					]);					
					$productDetailArray = json_decode($productDetail, true);
					$ewayBillNo = $productDetailArray['eway Bill No'];
					$filename = preg_replace('/[^a-zA-Z0-9_]/', '_', $ewayBillNo) . '.png';
					$qrCodePath = 'img/qrcode/' . $filename;
					$generatedPath = generateQRCode($productDetail, $qrCodePath);
					//echo "QR code generated and saved to: " . $generatedPath;

                    $updateQuery = "UPDATE jrctally SET ewbno='$ewbno', ewbdt='$ewbdt', ewbvalidtill='$ewbvalidtill', ewbqrcode='$qrCodePath' WHERE irn='" . $rowselect[0]['irn'] . "'";
                    $result = mysqli_query($connection, $updateQuery);
					
                    if ($result) {
                        header("Location:compexporttally.php?remarks=E-way Bill Generated successfully");
                    } else {
                        header("Location:compexporttally.php?error=Error updating database: " . mysqli_error($connection));
                    }
                } else {
                    header("Location:compexporttally.php?error=API request was not successful or missing required data");
                }
            } else {
                header("Location:compexporttally.php?error=Error making API request: " . curl_error($curl));
            }
        }

        curl_close($curl);
    }
}
?>
