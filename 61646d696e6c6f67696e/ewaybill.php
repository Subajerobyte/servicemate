<?php
$ewayBillEndpoint = 'http://app-sandbox.clear.in/einv/v3/ewaybill/generate';

//$HOST = 'https://ewb.cleartax.in' einv-gsp/eiewb/v1.03/ewaybill/generate;
//$putUrl = '{{HOST}}/ewayapi/GENEWAYBILL';
// Content-Type
$contentType = 'application/json';

$accessToken = '1.acee8664-43a7-4f30-9053-3c05b79e01ea_9658f45034eac2069dd0746d88ea1a9afb70306216c910815edc53d9f206a601';

// Your ClearTax account credentials


$data = [
    'supplyType' => 'O',
    'subSupplyType' => '1',
    'subSupplyDesc' => '',
    'docType' => 'INV',
    'docNo' => '7001-8',
    'docDate' => '15/12/2017',
    'fromGstin' => '33AAFCD5862R009',
    'fromTrdName' => 'welton',
    'fromAddr1' => '2ND CROSS NO 59  19  A',
    'fromAddr2' => 'GROUND FLOOR OSBORNE ROAD',
    'fromPlace' => "FRAZER TOWN",
    'fromPincode' => 560090,
    'actFromStateCode' => 29,
    'fromStateCode' => 29,
    'toGstin' => '02EHFPS5910D2Z0',
    'toTrdName' => 'sthuthya',
    'toAddr1' => 'Shree Nilaya',
    'toAddr2' => 'Dasarahosahalli',
    'toPlace' => 'Beml Nagar',
    'toPincode' => 560090,
    'actToStateCode' => 29,
    'toStateCode' => 27,
    'transactionType' => 4,
    'otherValue' => '-100',
    'totalValue' => 56099,
    'cgstValue' => 0,
    'sgstValue' => 0,
    'igstValue' => 300.67,
    'cessValue' => 400.56,
    'cessNonAdvolValue' => 400,
    'totInvValue' => 68358,
    'transporterId' => '',
    'transporterName' => '',
    'transDocNo' => '',
    'transMode' => 1,
    'transDistance' => 100,
    'transDocDate' => '',
    'vehicleNo' => 'PVC1234',
    'vehicleType' => 'R',
    'itemList' => [
        'productName' => 'Wheat',
        'productDesc' => 'Wheat',
        'hsnCode' => 1001,
        'quantity' => 4,
        'qtyUnit' => 'BOX',
        'cgstRate' => 0,
        'sgstRate' => 0,
        'igstRate' => 3,
        'cessRate' => 3,
        'cessNonadvol' => 0,
        'taxableAmount' => 5609889
    ]
];

// Add authentication parameters

$json_data_1 = json_encode($data);

// Create cURL session
$ch = curl_init($ewayBillEndpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data_1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    // Add any other required headers here
]);

// Execute cURL session and get the response
$response = curl_exec($ch);
// Close cURL session
curl_close($ch);

// Output the response
echo $response;
?>


