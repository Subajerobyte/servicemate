<?php
include('lcheck.php');
if(isset($_POST['sono'])) 
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
    $sqlUpdate = "UPDATE jrctally SET  deliverymethod='$deliverymethod', edistance='$edistance', etransportid='$etransportid', agentname='$agentname', edocumentno='$edocumentno', shipment='$shipment', vechileno='$vechileno', vechiletype='$vechiletype', deliveryremarks='$deliveryremarks', lrno='$lrno' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error => " . mysqli_error($connection);
        header("Location => exporttally.php?error=$error");
        exit();
    }
	 
	   $sqlselect = "SELECT * From jrctally where sono='".$sono."'";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed => " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{
			$rowselect = array();
			while($row1 = mysqli_fetch_assoc($queryselect))
			{ 
			$rowselect[] = $row1;
			}
$apiEndpoint = 'https://api-sandbox.clear.in/einv/v3/ewaybill/generate'; // Replace with the actual API endpoint
$authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
$gstin = "33AAFCD5862R009";


$stateCodeseller = $_SESSION['companystatecode'];
$partseller = explode('-', $stateCodeseller);
$stateCode = trim($partseller[0]);

$stateCodebuyer = $rowselect[0]['buyerstate'];
$partbuyer = explode('-', $stateCodebuyer);
$stateCodebuy = trim($partbuyer[0]);

$stateCodeconsignee = $rowselect[0]['constatecode'];
$partcon = explode('-', $stateCodeconsignee);
$stateCodecon = trim($partcon[0]);
$total=0;
foreach($rowselect as $row1)
{
 $producttotal = $row1['conqty'] * $row1['conunit'];
    $total += $producttotal;
}
$sqlselect1 = "SELECT SUM(concgstamount) AS total_cgst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect1 = mysqli_query($connection, $sqlselect1);
    $rowCountselect1 = mysqli_num_rows($queryselect1);
    if (!$queryselect1) {
        die("SQL query failed => " . mysqli_error($connection));
    }
    if ($rowCountselect1 > 0) {
        $row3 = mysqli_fetch_assoc($queryselect1);
        $totalcgst = $row3['total_cgst'];
    }

    $sqlselect2 = "SELECT SUM(conigstamount) AS total_igst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect2 = mysqli_query($connection, $sqlselect2);
    $rowCountselect2 = mysqli_num_rows($queryselect2);
    if (!$queryselect2) {
        die("SQL query failed => " . mysqli_error($connection));
    }
    if ($rowCountselect2 > 0) {
        $row4 = mysqli_fetch_assoc($queryselect2);
        $totaligst = $row4['total_igst'];
    }

    $sqlselect3 = "SELECT SUM(consgstamount) AS total_sgst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect3 = mysqli_query($connection, $sqlselect3);
    $rowCountselect3 = mysqli_num_rows($queryselect3);
    if (!$queryselect3) {
        die("SQL query failed => " . mysqli_error($connection));
    }
    if ($rowCountselect3 > 0) {
        $row5 = mysqli_fetch_assoc($queryselect3);
        $totalsgst = $row5['total_sgst'];
    }

    if ($rowselect[0]['conigst'] != '') {
        $gtotal = $total + $totaligst;
    } else {
        $gtotal = $total + $totalcgst + $totalsgst;
    }
	// Remove spaces
$invoiceno = str_replace(' ', '', $rowselect[0]['invoiceno']);
// Sample JSON data for the request
$requestData = [
    "DocumentNumber" => $invoiceno,
    "DocumentType" => "INV",
    "DocumentDate" => date('d/m/Y',strtotime($rowselect[0]['invoicedate'])),
    "SupplyType" => "OUTWARD",
    "SubSupplyType" => "SUPPLY",
    "SubSupplyTypeDesc" => "TEST",
    "TransactionType" => "Bill from",
    "BuyerDtls" => [
        "Gstin" => "URP",
        "LglNm" => $rowselect[0]['buyername'],
        "TrdNm" => $rowselect[0]['buyername'],
        "Addr1" => $rowselect[0]['buyeraddress1'],
        "Addr2" => $rowselect[0]['buyeraddress2'],
        "Loc" => $rowselect[0]['buyerdistrict'],
        "Pin" => $rowselect[0]['buyerpincode'],
        "Stcd" => $stateCode
    ],
    "SellerDtls" => [
        "Gstin" => $_SESSION['companygstno'],
        "LglNm" => $_SESSION['companyname'],
        "TrdNm" => $_SESSION['companyname'],
        "Addr1" => $_SESSION['companyaddress1'],
        "Addr2" => $_SESSION['companyaddress2'],
        "Loc" => $_SESSION['companydistrict'],
        "Pin" => $_SESSION['companypincode'],
        "Stcd" => $stateCode
    ],
     "ExpShipDtls" => [
        "LglNm" => $rowselect[0]['consigneename'],
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
        "Stcd" => $stateCodecon
     ],
	 
	 "ItemList" => array_map(function ($row1) use ($sono, $connection, &$i) {
    
    $parts = explode(" - ", $row1['conper']);
    if (count($parts) == 2) {
        $beforeDash = $parts[0];
        $afterDash = $parts[1];
    } else {
        $beforeDash = $row1['conper'];
    }
    $conigst=0;
    $concsgst=0;
	if ($row1['conigst'] != '') {
        $conigst=$row1['conunit']*$row1['conigst']/100;
    } else {
       $concsgst=$row1['conunit']*$row1['concgst']/100;
    }
	$assamt=$row1['conqty']*$row1['conunit'];
$i++;
    return [
            "ProdName" => $row1['conproduct'],
            "ProdDesc" => $row1['conproduct'],
            "HsnCd" => $row1['conhsncode'],
            "Qty" => $row1['conqty'],
            "Unit" => "NOS",
            "AssAmt" => $assamt,
            "CgstRt" => $row1['concgst'],
            "CgstAmt" => $row1['concgstamount'],
            "SgstRt" => $row1['consgst'],
            "SgstAmt" => $row1['consgstamount'],
            "IgstRt" => $row1['conigst'],
            "IgstAmt" => $row1['conigstamount'],
            "CesRt" => 0,
            "CesAmt" => 0,
            "OthChrg" => 0,
            "CesNonAdvAmt" => 0
        ];
}, $rowselect),
	  
    "TotalInvoiceAmount" => $rowselect[0]['grandtotal'],
    "TotalCgstAmount" => $totalcgst,
    "TotalSgstAmount" => $totalsgst,
    "TotalIgstAmount" => $totaligst,
    "TotalCessAmount" => 0,
    "TotalCessNonAdvolAmount" => 0,
    "TotalAssessableAmount" => $rowselect[0]['subtotalamount'],
    "OtherAmount" => 0,
    "OtherTcsAmount" => 0,
    "TransId" => $rowselect[0]['etransportid'],
    "TransName" => $rowselect[0]['agentname'],
    "TransMode" => $rowselect[0]['deliverymethod'],
    "Distance" => $rowselect[0]['edistance'],
    "TransDocNo" => $rowselect[0]['edocumentno'],
    "TransDocDt" => date('d/m/Y',strtotime($rowselect[0]['shipment'])),
    "VehNo" => $rowselect[0]['vechileno'],
    "VehType" => $rowselect[0]['vechiletype']
	
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


// Your existing code here...

$response = curl_exec($ch);

if ($response) {
    // Parse the response JSON
    $responseData = json_decode($response, true);
        
    // Check if the response contains govt_response and it indicates success
     if(isset($responseData['govt_response']) && isset($responseData['govt_response']['Success']) && $responseData['govt_response']['Success'] === "Y") { 
        // Extract relevant information from the response
        $ewbno = isset($responseData['govt_response']['EwbNo']) ? $responseData['govt_response']['EwbNo'] : '';
        $ewbdt = isset($responseData['govt_response']['EwbDt']) ? $responseData['govt_response']['EwbDt'] : '';
        $ewbvalidtill = isset($responseData['govt_response']['EwbValidTill']) ? $responseData['govt_response']['EwbValidTill'] : '';
        
        // Update your database with the extracted information
        $updateQuery = "UPDATE jrctally SET ewbno='$ewbno', ewbdt='$ewbdt', ewbvalidtill='$ewbvalidtill' WHERE sono='".$rowselect[0]['sono']."'";
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
        //echo "<pre>";
        //print_r($responseData);
        //echo "</pre>";
    } 
} else {
    // Handle cURL error or invalid response
	header("Location:exporttally.php?error=Error making API request =>  " . curl_error($ch));
}
		}
 }
 ?>
































