<?php

function sendSMS($template, $variables, $recipient) {
    // API credentials
    $username = "jerobyte";
    $password = "jerobyte";
    $senderId = "JROBYT";

    // API URL
    $apiUrl = "http://bulksms.agasoft.co.in/api/sendsms";

     // Split variables by comma
    $variableArray = explode(', ', $variables);

	foreach ($variableArray as $variable) {
        $template = preg_replace('/{#var#}/', $variable, $template, 1);
    }
	$message=$template;

      // Prepare API parameters in the URL
    $apiUrl .= '?' . http_build_query([
        'username' => $username,
        'password' => $password,
        'senderid' => $senderId,
        'message' => $template,
        'numbers' => $recipient,
        'dndrefund' => 1,
    ]);
echo $apiUrl.'<br>';
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $response = curl_exec($ch);
	
	if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

    // Close cURL session
    curl_close($ch);

    // Display response
    echo "API Response: " . $response . PHP_EOL;
}

// Test templates with sample content
$callRegistrationTemplate = "Dear Customer, your service request is registered with ID: {#var#} It will be attended shortly. For further assistance please contact {#var#} on {#var#} - JEROBYTE";
$engineerAssignTemplate = "Dear Customer, Engineer {#var#} from {#var#} mobile - {#var#} has been assigned to assist you for your service request - JEROBYTE";
$callFollowupTemplate = "Dear Customer, We hope your recent service was satisfactory. If you require any further support, please contact {#var#} on {#var#}. -JEROBYTE";
$callCancelTemplate = "Dear Customer, Your service request with ID {#var#} has been canceled as per your request. If you need assistance in the future, contact {#var#} on {#var#}. - JEROBYTE";
$callPendingTemplate = "Dear Customer, Apologies for the delay in servicing your request with ID {#var#}. It will be completed shortly. Please contact {#var#} for further assistance. - JEROBYTE";
$callCompletedTemplate = "Dear Customer, Your request ID {#var#} has been successfully resolved. For any kind of {#var#} requirements, please contact {#var#} on {#var#}. - JEROBYTE";
$warrantyExpiryTemplate = "Dear Customer, The warranty for your product {#var#} is expiring on {#var#}. Kindly proceed with AMC to continue uninterrupted services. If you need assistance, contact {#var#} on {#var#}. - JEROBYTE";
$amcExpiryTemplate = "Dear Customer, The Annual Maintenance is expiring on {#var#}. Kindly renew to continue uninterrupted services. If you need assistance, contact {#var#} on {#var#} - JEROBYTE";
$otpVerificationTemplate = "Dear Customer, Your OTP for Login Verification is {#var#} - JROBYT";

// Test phone number
$recipient = "8144617454";  // Replace with the actual phone number

// Testing each template
sendSMS($callRegistrationTemplate, "123456, JRC, 9442150005", $recipient);
sendSMS($engineerAssignTemplate, "Ramesh, JRC, 9442150005", $recipient);
sendSMS($callFollowupTemplate, "JRC, 9442150005", $recipient);
sendSMS($callCancelTemplate, "123456, JRC, 9442150005", $recipient);
sendSMS($callPendingTemplate, "123456, JRC", $recipient);
sendSMS($callCompletedTemplate, "123456, UPS, JRC, 9442150005", $recipient);
sendSMS($warrantyExpiryTemplate, "UPS, 07-12-2023, JRC, 9442150005", $recipient);
sendSMS($amcExpiryTemplate, "23-11-2023, JRC, 9442150005", $recipient);
sendSMS($otpVerificationTemplate, "123456", $recipient);

?>
