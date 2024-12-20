<?php
include('lcheck.php');
if(isset($_GET['id']))
 {
	   $sono=mysqli_real_escape_string($connection,$_GET['id']);
	
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
$apiEndpoint = 'https://api-sandbox.clear.in/einv/v2/eInvoice/generate'; // Replace with the actual API endpoint
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
        die("SQL query failed: " . mysqli_error($connection));
    }
    if ($rowCountselect1 > 0) {
        $row3 = mysqli_fetch_assoc($queryselect1);
        $totalcgst = $row3['total_cgst'];
    }

    $sqlselect2 = "SELECT SUM(conigstamount) AS total_igst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect2 = mysqli_query($connection, $sqlselect2);
    $rowCountselect2 = mysqli_num_rows($queryselect2);
    if (!$queryselect2) {
        die("SQL query failed: " . mysqli_error($connection));
    }
    if ($rowCountselect2 > 0) {
        $row4 = mysqli_fetch_assoc($queryselect2);
        $totaligst = $row4['total_igst'];
    }

    $sqlselect3 = "SELECT SUM(consgstamount) AS total_sgst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect3 = mysqli_query($connection, $sqlselect3);
    $rowCountselect3 = mysqli_num_rows($queryselect3);
    if (!$queryselect3) {
        die("SQL query failed: " . mysqli_error($connection));
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
     [
        "transaction" => [
            "Version" => "1.1",
            "TranDtls" => [
                "TaxSch" => "GST",
                "SupTyp" => $rowselect[0]['invoicetype'],
                "RegRev" => "Y",
                "EcmGstin" => null,
                "IgstOnIntra" => "N"
            ],
            "DocDtls" => [
                "Typ" => "INV",
                "No" => $invoiceno,
                "Dt" => $rowselect[0]['invoicedate']
            ],
            "SellerDtls" => [
                "Gstin" => $_SESSION['companygstno'],
                "LglNm" => $_SESSION['companyname'],
				"TrdNm" => $_SESSION['companyname'],
                "Addr1" => $_SESSION['companyaddress1'],
                "Addr2" => $_SESSION['companyaddress2'],
                "Loc" => $_SESSION['companydistrict'],
                "Pin" => $_SESSION['companypincode'],
                "Stcd" => $stateCode,
                "Ph" => $_SESSION['companymobile'],
                "Em" => $_SESSION['companyemail']
            ],
            "BuyerDtls" => [
                "Gstin" => $rowselect[0]['bgst'],
                "LglNm" => $rowselect[0]['buyername'],
				"TrdNm" => $rowselect[0]['buyername'],
                "Pos" => $stateCode,
                "Addr1" => $rowselect[0]['buyeraddress1'],
                "Addr2" => $rowselect[0]['buyeraddress2'],
                "Loc" => $rowselect[0]['buyerdistrict'],
                "Pin" => $rowselect[0]['buyerpincode'],
                "Stcd" => $stateCodebuy,
                "Ph" => $rowselect[0]['buyermobile'],
                "Em" => $rowselect[0]['buyermail']
            ],
            "DispDtls" => [
                "Nm" => $rowselect[0]['consigneename'],
                "Addr1" => $rowselect[0]['conaddress1'],
                "Addr2" => $rowselect[0]['conaddress2'],
                "Loc" => $rowselect[0]['condistrict'],
                "Pin" => $rowselect[0]['conpincode'],
                "Stcd" => $stateCodecon
            ],
            "ShipDtls" => [
        "Gstin" => $rowselect[0]['congstno'],
        "LglNm" => $rowselect[0]['consigneename'],
        "TrdNm" => $rowselect[0]['consigneename'],
        "Addr1" => $rowselect[0]['conaddress1'],
        "Addr2" => $rowselect[0]['conaddress2'],
        "Loc" => $rowselect[0]['condistrict'],
        "Pin" => $rowselect[0]['conpincode'],
        "Stcd" => $stateCodecon
      ],
		
	"ItemList" => array_map(function ($row1) use ($sono, $connection, &$i) {
    $total = 0;

    $parts = explode(" - ", $row1['conper']);
    if (count($parts) == 2) {
        $beforeDash = $parts[0];
        $afterDash = $parts[1];
    } else {
        $beforeDash = $row1['conper'];
    }
    $producttotal = $row1['conqty'] * $row1['conunit'];
    $total += $producttotal;

    $sqlselect1 = "SELECT SUM(concgstamount) AS total_cgst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect1 = mysqli_query($connection, $sqlselect1);
    $rowCountselect1 = mysqli_num_rows($queryselect1);
    if (!$queryselect1) {
        die("SQL query failed: " . mysqli_error($connection));
    }
    if ($rowCountselect1 > 0) {
        $row3 = mysqli_fetch_assoc($queryselect1);
        $totalcgst = $row3['total_cgst'];
    }

    $sqlselect2 = "SELECT SUM(conigstamount) AS total_igst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect2 = mysqli_query($connection, $sqlselect2);
    $rowCountselect2 = mysqli_num_rows($queryselect2);
    if (!$queryselect2) {
        die("SQL query failed: " . mysqli_error($connection));
    }
    if ($rowCountselect2 > 0) {
        $row4 = mysqli_fetch_assoc($queryselect2);
        $totaligst = $row4['total_igst'];
    }

    $sqlselect3 = "SELECT SUM(consgstamount) AS total_sgst FROM jrctally WHERE sono='" . $sono . "'";
    $queryselect3 = mysqli_query($connection, $sqlselect3);
    $rowCountselect3 = mysqli_num_rows($queryselect3);
    if (!$queryselect3) {
        die("SQL query failed: " . mysqli_error($connection));
    }
    if ($rowCountselect3 > 0) {
        $row5 = mysqli_fetch_assoc($queryselect3);
        $totalsgst = $row5['total_sgst'];
    }

    if ($row1['conigst'] != '') {
        $gtotal = $total + $totaligst;
    } else {
        $gtotal = $total + $totalcgst + $totalsgst;
    }
	if ($row1['conigst'] != '') {
        $StateCesAmt = $totaligst;
    } else {
        $StateCesAmt = $totalcgst + $totalsgst;
    }
	if ($row1['conigst'] != '') {
        $congst=$row1['conigst'];
    } else {
       $congst=$row1['consgst']+$row1['concgst'];
    }
$i++;
    return [
            "SlNo" => $i,
            "PrdDesc" => $row1['conproduct'],
            "IsServc" => "N",
            "HsnCd" => $row1['conhsncode'],
            "Qty" => $row1['conqty'],
            "FreeQty" => 0,
            "Unit" => "NOS",
            "UnitPrice" => $row1['conunit'],
            "TotAmt" => $total,
            "Discount" => 0,
            "PreTaxVal" => 0,
            "AssAmt" => $total,
            "GstRt" => $congst,
            "IgstAmt" => $row1['conigstamount'],
            "CgstAmt" => $row1['concgstamount'],
            "SgstAmt" => $row1['consgstamount'],
			"CesRt" => 0,
            "CesAmt" => 0,
            "CesNonAdvlAmt" => 0,
            "StateCesRt" => 0,
            "StateCesAmt" => 0,
            "StateCesNonAdvlAmt" => 0,
            "OthChrg" => 0,
            "TotItemVal" => $row1['contotal'],
           // "OrdLineRef" => "3256",
           // "OrgCntry" => "AG",
            "PrdSlNo" => $row1['conserialno'],
            "AttribDtls" => [
                [
                    "Nm" =>  $row1['conproduct'],
                    "Val" => $total
                ]
            ]
    ];
}, $rowselect),

           
            "ValDtls" => [
                "AssVal" => $total,
                "CgstVal" => $totalcgst,
                "SgstVal" => $totalsgst,
                "IgstVal" => $totaligst,
                "CesVal" => 0,
                "StCesVal" => 0,
                "Discount" => 0,
                "OthChrg" => 0,
                "RndOffAmt" => 0,
                "TotInvVal" => $gtotal,
                "TotInvValFc" => $gtotal
            ],
        ],
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

// Your existing code here...

$response = curl_exec($ch);

if ($response) {
    // Parse the response JSON
    $responseData = json_decode($response, true);
    
    // Check if the response contains govt_response and it indicates success
    if(isset($responseData[0]['govt_response']) && isset($responseData[0]['govt_response']['Success']) && $responseData[0]['govt_response']['Success'] === "Y") {
        // Extract relevant information from the response
        $irn = isset($responseData[0]['govt_response']['Irn']) ? $responseData[0]['govt_response']['Irn'] : '';
        $acknowledgmentNumber = isset($responseData[0]['govt_response']['AckNo']) ? $responseData[0]['govt_response']['AckNo'] : '';
        $acknowledgmentDate = isset($responseData[0]['govt_response']['AckDt']) ? $responseData[0]['govt_response']['AckDt'] : '';
        $irnsuccess = isset($responseData[0]['govt_response']['Success']) ? $responseData[0]['govt_response']['Success'] : '';
        $invoicesign = isset($responseData[0]['govt_response']['SignedInvoice']) ? $responseData[0]['govt_response']['SignedInvoice'] : '';
        $invoiceqr = isset($responseData[0]['govt_response']['SignedQRCode']) ? $responseData[0]['govt_response']['SignedQRCode'] : '';
        $transactionid = isset($responseData[0]['transaction_id']) ? $responseData[0]['transaction_id'] : '';
        $documentstatus = isset($responseData[0]['document_status']) ? $responseData[0]['document_status'] : '';

        // Update your database with the extracted information
        $updateQuery = "UPDATE jrctally SET irn='$irn', acknowledgmentno='$acknowledgmentNumber', acknowledgmentdate='$acknowledgmentDate', irnsuccess='$irnsuccess', invoicesign='$invoicesign', invoiceqr='$invoiceqr', transactionid='$transactionid', documentstatus='$documentstatus' WHERE sono='$sono'";
        $result = mysqli_query($connection, $updateQuery);

        if($result) {
			header("Location:exporttally.php?remarks=IRN Generated successfully"); 
			 //echo "<pre>";
       // print_r($responseData);
       //echo "</pre>";
        } else {
			header("Location:exporttally.php?error=Error updating database: " . mysqli_error($connection));
        }
    } else {
		//echo "<pre>";
       // print_r($responseData);
       // echo "</pre>";
		header("Location:exporttally.php?error=API request was not successful or missing required data");
         //Output the response for debugging
       
    }
} else {
    // Handle cURL error or invalid response
	header("Location:exporttally.php?error=Error making API request:  " . curl_error($ch));
	//print_r($response);
}

// Your existing code here...


		}
 }
?>