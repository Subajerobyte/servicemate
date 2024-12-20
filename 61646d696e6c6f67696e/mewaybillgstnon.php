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
	
    // Sanitize input data
    $sono = mysqli_real_escape_string($connection, $_POST['sono']);
    $deliverymethod = mysqli_real_escape_string($connection, $_POST['deliverymethod']);
    $edistance = mysqli_real_escape_string($connection, $_POST['edistance']);
    $etransportid = mysqli_real_escape_string($connection, $_POST['etransportid']);
    $agentname = mysqli_real_escape_string($connection, $_POST['agentname']);
    $edocumentno = mysqli_real_escape_string($connection, $_POST['edocumentno']);
    $shipment = mysqli_real_escape_string($connection, $_POST['shipment']);
    $vechileno = mysqli_real_escape_string($connection, $_POST['vechileno']);
    $vechiletype = "R";
    $lrno = mysqli_real_escape_string($connection, $_POST['lrno']);
    $deliveryremarks = mysqli_real_escape_string($connection, $_POST['deliveryremarks']);

    // Perform database update to mark IRN as canceled
    $sqlUpdate = "UPDATE jrctally SET deliverymethod='$deliverymethod', edistance='$edistance', etransportid='$etransportid', agentname='$agentname', edocumentno='$edocumentno', shipment='$shipment', vechileno='$vechileno', vechiletype='$vechiletype', deliveryremarks='$deliveryremarks', lrno='$lrno' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error => " . mysqli_error($connection);
        header("Location: compexporttally.php?error=$error");
        exit();
    }

    // Fetch data from jrctally
    $sqlselect = "SELECT * FROM jrctally WHERE sono='$sono'";
    $queryselect = mysqli_query($connection, $sqlselect);
    if (!$queryselect) {
        die("SQL query failed => " . mysqli_error($connection));
    }
    $rowselect = [];
    while ($row1 = mysqli_fetch_assoc($queryselect)) {
        $rowselect[] = $row1;
    }

    if (empty($rowselect)) {
        die("No data found for sono='$sono'");
    }

    // Validate vehicle type
    $validVehicleTypes = ['R', 'O'];
    if (!in_array($rowselect[0]['vechiletype'], $validVehicleTypes)) {
        die("Invalid vehicle type: " . $rowselect[0]['vechiletype']);
    }

    // Validate distance
    $maxDistance = 1000; // Example: maximum allowed distance
    if ($rowselect[0]['edistance'] > $maxDistance) {
        die("The distance between the pincodes given is too high: " . $rowselect[0]['edistance']);
    }
	$companygstno = "33AACCJ5647F1ZP";
	$bgst = $rowselect[0]['bgst'];
    // API endpoint and headers
    $url = 'https://api.mastergst.com/ewaybillapi/v1.03/ewayapi/genewaybill?email=ijerald%40jerobyte.com'; // Replace with the actual API endpoint
    //$authtoken = $_SESSION['authtoken'];
    $headers = [
        "Content-Type: application/json",
        "email: ijerald@jerobyte.com",
        "ip_address: 192.168.1.111",
        "client_id: 54b95dcf-a86a-47a6-a22a-b0f58666a0fc",
        "client_secret: 64caaabf-115e-452c-bd7a-ee766da3a9da",
        "gstin: 33AACCJ5647F1ZP",
    ];
	
    if($rowselect[0]['deliverymethod']=="5")
		{
    // Prepare request data
    $requestData = [
        "supplyType" => "O",
        "subSupplyType" => "1",
        "subSupplyDesc" => " ",
        "docType" => "INV",
        "docNo" => str_replace(' ', '', $rowselect[0]['invoiceno']),
        "docDate" => date('d/m/Y', strtotime($rowselect[0]['invoicedate'])),
        "fromGstin" => $companygstno,
        "fromTrdName" => $_SESSION['companyname'],
        "fromAddr1" => $_SESSION['companyaddress1'],
        "fromAddr2" => $_SESSION['companyaddress2'],
        "fromPlace" => $_SESSION['companydistrict'],
        "actFromStateCode" => intval($_SESSION['companystatecode']),
        "fromPincode" => intval($_SESSION['companypincode']),
        "fromStateCode" => intval($_SESSION['companystatecode']),
        "toGstin" => $bgst,
        "toTrdName" => $rowselect[0]['buyername'],
        "toAddr1" => $rowselect[0]['buyeraddress1'],
        "toAddr2" => $rowselect[0]['buyeraddress2'],
        "toPlace" => $rowselect[0]['buyerdistrict'],
        "toPincode" => intval($rowselect[0]['buyerpincode']),
        "actToStateCode" => intval($rowselect[0]['buyerstate']),
        "toStateCode" => intval($rowselect[0]['buyerstate']),
        "transactionType" => 4,
        "dispatchFromGSTIN" => $companygstno,
        "dispatchFromTradeName" => $_SESSION['companyname'],
        "shipToTradeName" => $rowselect[0]['consigneename'],
        "totalValue" => floatval($rowselect[0]['subtotalamount']),
        "cgstValue" => floatval($rowselect[0]['concgstamount']),
        "sgstValue" => floatval($rowselect[0]['consgstamount']),
        "igstValue" => floatval($rowselect[0]['conigstamount']),
        "cessValue" => 0,
        "cessNonAdvolValue" => 0,
        "totInvValue" => floatval($rowselect[0]['grandtotal']),
        //"transMode" => "1",
        "transDistance" => $rowselect[0]['edistance'],
        "transporterName" => $rowselect[0]['agentname'],
        "transporterId" => $rowselect[0]['etransportid'],
       // "transDocNo" => $rowselect[0]['edocumentno'],
        //"transDocDate" => date('d/m/Y', strtotime($rowselect[0]['shipment'])),
       // "vehicleNo" => $rowselect[0]['vechileno'],
       // "vehicleType" => $rowselect[0]['vechiletype'],
        "itemList" => array_map(function ($row1) {
            return [
                "productName" => $row1['conproduct'],
                "productDesc" => $row1['conproduct'],
                "hsnCode" => intval($row1['conhsncode']),
                "quantity" => intval($row1['conqty']),
                "qtyUnit" => "NOS",
                "taxableAmount" => floatval($row1['conunit'] * $row1['conqty']),
                "sgstRate" => floatval($row1['consgst']),
                "cgstRate" => floatval($row1['concgst']),
                "igstRate" => floatval($row1['conigst']),
                "cessRate" => 0,
            ];
        }, $rowselect)
    ];
		}
		else
		{
			// Prepare request data
    $requestData = [
        "supplyType" => "O",
        "subSupplyType" => "1",
        "subSupplyDesc" => " ",
        "docType" => "INV",
        "docNo" => str_replace(' ', '', $rowselect[0]['invoiceno']),
        "docDate" => date('d/m/Y', strtotime($rowselect[0]['invoicedate'])),
        "fromGstin" => $companygstno,
        "fromTrdName" => $_SESSION['companyname'],
        "fromAddr1" => $_SESSION['companyaddress1'],
        "fromAddr2" => $_SESSION['companyaddress2'],
        "fromPlace" => $_SESSION['companydistrict'],
        "actFromStateCode" => intval($_SESSION['companystatecode']),
        "fromPincode" => intval($_SESSION['companypincode']),
        "fromStateCode" => intval($_SESSION['companystatecode']),
        "toGstin" => $bgst,
        "toTrdName" => $rowselect[0]['buyername'],
        "toAddr1" => $rowselect[0]['buyeraddress1'],
        "toAddr2" => $rowselect[0]['buyeraddress2'],
        "toPlace" => $rowselect[0]['buyerdistrict'],
        "toPincode" => intval($rowselect[0]['buyerpincode']),
        "actToStateCode" => intval($rowselect[0]['buyerstate']),
        "toStateCode" => intval($rowselect[0]['buyerstate']),
        "transactionType" => 4,
        "dispatchFromGSTIN" => $companygstno,
        "dispatchFromTradeName" => $_SESSION['companyname'],
        "shipToTradeName" => $rowselect[0]['consigneename'],
        "totalValue" => floatval($rowselect[0]['subtotalamount']),
        "cgstValue" => floatval($rowselect[0]['concgstamount']),
        "sgstValue" => floatval($rowselect[0]['consgstamount']),
        "igstValue" => floatval($rowselect[0]['conigstamount']),
        "cessValue" => 0,
        "cessNonAdvolValue" => 0,
        "totInvValue" => floatval($rowselect[0]['grandtotal']),
        "transMode" => "1",
        "transDistance" => $rowselect[0]['edistance'],
        "transporterName" => $rowselect[0]['agentname'],
        "transporterId" => $rowselect[0]['etransportid'],
        "transDocNo" => $rowselect[0]['edocumentno'],
        "transDocDate" => date('d/m/Y', strtotime($rowselect[0]['shipment'])),
        "vehicleNo" => $rowselect[0]['vechileno'],
        "vehicleType" => $rowselect[0]['vechiletype'],
        "itemList" => array_map(function ($row1) {
            return [
                "productName" => $row1['conproduct'],
                "productDesc" => $row1['conproduct'],
                "hsnCode" => intval($row1['conhsncode']),
                "quantity" => intval($row1['conqty']),
                "qtyUnit" => "NOS",
                "taxableAmount" => floatval($row1['conunit'] * $row1['conqty']),
                "sgstRate" => floatval($row1['consgst']),
                "cgstRate" => floatval($row1['concgst']),
                "igstRate" => floatval($row1['conigst']),
                "cessRate" => 0,
            ];
        }, $rowselect)
    ];
		}

    // Initialize cURL and send request
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData));
    
    // Execute the cURL request
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

        if (isset($responseData['status_cd']) && $responseData['status_cd'] == "1") {
            $ewbno = $responseData['data']['ewayBillNo'] ?? '';
            $ewbdt = $responseData['data']['ewayBillDate'] ?? '';
            $ewbvalidtill = $responseData['data']['validUpto'] ?? '';
            
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
			
            $updateQuery = "UPDATE jrctally SET ewbno='$ewbno', ewbdt='$ewbdt', ewbvalidtill='$ewbvalidtill', ewbqrcode='$qrCodePath' WHERE sono='$sono'";
            $result = mysqli_query($connection, $updateQuery);
			
			if ($result) {
               header("Location: compexporttally.php?remarks=E-way Bill Generated successfully");
               exit();
            } else {
                $error = "Error updating E-way Bill details: " . mysqli_error($connection);
                header("Location: compexporttally.php?error=$error");
                exit();
            }
        } else {
            $error = "Error in response: " . ($responseData['data']['alert'] ?? 'Unknown error');
           header("Location: compexporttally.php?error=$error");
           exit();
        }
    } else {
        $error = "HTTP Code: $httpcode. Response: $response";
        header("Location: compexporttally.php?error=$error");
        exit();
    } 
}
?>
