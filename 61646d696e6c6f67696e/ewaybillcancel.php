<?php

$host = "https://api-sandbox.clear.in/einv/v2/eInvoice/ewaybill/cancel";
$authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
$gstin = "33AAFCD5862R009";

$requestHeaders = [
    'X-Cleartax-Auth-Token: ' . $authToken,
    'gstin: ' . $gstin,
    'Content-Type: application/json'
];

$requestPayload = [
    [
        "Irn" => "25ec7145619ec745b7625e11813b024bc41f36f3ca5df8fb035a463cba572e32",
        "Distance" => 90,
        "TransMode" => "1",
        "TransId" => "12AWGPV7107B1Z1",
        "TransName" => "trans name",
        "TransDocDt" => "02/02/2024",
        "TransDocNo" => "TRAN/DOC/12",
        "VehNo" => "KA12ER1234",
        "VehType" => "R",
        "ExpShipDtls" => [
            "Addr1" => "7th block, kuvempu layout",
            "Addr2" => "kuvempu layout",
            "Loc" => "Banagalore",
            "Pin" => 562160,
            "Stcd" => "29"
        ],
        "DispDtls" => [
            "Nm" => "ABC company pvt ltd",
            "Addr1" => "7th block, kuvempu layout",
            "Addr2" => "kuvempu layout",
            "Loc" => "Bangalore",
            "Pin" => 562160,
            "Stcd" => "29"
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

echo $response;

?>





















