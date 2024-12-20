<?php

$host = "https://api-sandbox.clear.in/einv/v2/eInvoice/download";
$authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
$gstin = "33AAFCD5862R009";
$pan = "AAFCD5862R";
//$irns = "25ec7145619ec745b7625e11813b024bc41f36f3ca5df8fb035a463cba572e32";
$irns = "f81e9f444dc10a829bd297de04f58b959b32697e3818dd2949d0de5097073d78";  // Replace with the actual IRNs

$requestHeaders = [
    'X-Cleartax-Auth-Token: ' . $authToken,
    'gstin: ' . $gstin,
    'pan: ' . $pan,
];

$queryParameters = [
    'irns' => $irns,
];

$ch = curl_init($host . '?' . http_build_query($queryParameters));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

curl_close($ch);

// Assuming the response contains the PDF content
// You can save the content to a file or display it as needed
file_put_contents('einvoice.pdf', $response);

echo "PDF generated successfully and saved";
?>
