<?php
include('lcheck.php');

if(isset($_GET['id'])) {
    $host = "https://api-sandbox.clear.in/einv/v2/eInvoice/ewaybill/print?format=PDF"; // Replace with the actual API host
    $authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8"; // Replace with your authentication token
    $gstin = $_SESSION['companygstno'];
    $sono = mysqli_real_escape_string($connection, $_GET['id']);
    $sqlselect = "SELECT ewbno, sono FROM jrctally WHERE sono = '".$sono."'";
    $queryselect = mysqli_query($connection, $sqlselect);
    $rowCountselect = mysqli_num_rows($queryselect);
    $row1 = mysqli_fetch_assoc($queryselect);
    $ewbno = $row1['ewbno'];

    $requestHeaders = [
        'X-Cleartax-Auth-Token: ' . $authToken,
        'gstin: ' . $gstin,
        'Content-Type: application/json' // Specify JSON content type
    ];

    $requestData = [
        "ewb_numbers" => [
            $ewbno
        ],
        "print_type" => "DETAILED", 
    ];

    $ch = curl_init($host);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Assuming the response contains the PDF content
        if ($response) {
			echo $response;
            $filepath = '../padhivetram/irnpdf/' . $ewbno . '.pdf';
            if (file_put_contents($filepath, $response) !== false) {
                // Check if the file is valid
                if (filesize($filepath) > 0) {
					$sqlUpdate = "UPDATE jrctally SET  ewaypdf='1' WHERE ewbno = '$ewbno'";
                    $queryUpdate = mysqli_query($connection, $sqlUpdate);
                    header("Location: " . $filepath);
                    exit;
                } else {
                    echo "Empty PDF file received.";
                }
            } else {
                echo "Failed to save PDF file.";
            }
        } else {
            echo "Empty response received.";
        }
    }

    curl_close($ch);
}
?>
