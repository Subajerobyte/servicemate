<?php
$host = "https://api-sandbox.clear.in";
$irnNumber = '25ec7145619ec745b7625e11813b024bc41f36f3ca5df8fb035a463cba572e32';//sample IRN number

$authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
$gstin = "33AAFCD5862R009";

// Endpoint for fetching e-invoice details
$endpoint = "/einv/v2/eInvoice/get?irn=$irnNumber";

// Build the complete URL
$url = $host . $endpoint;

// Set headers
$headers = array(
    'X-Cleartax-Auth-Token: ' . $authToken,
    'gstin: ' . $gstin,
);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Process the response
if ($response) {
    // Parse and process the response as needed
    echo $response;
} else {
    echo 'Error fetching e-invoice details.';
}

?>
