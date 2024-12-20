<?php
include('lcheck.php');

if (isset($_POST['sono'])) {
    $sono = mysqli_real_escape_string($connection, $_POST['sono']);
    $reason = mysqli_real_escape_string($connection, $_POST['reason']);
    $remarks = mysqli_real_escape_string($connection, $_POST['remarks']);

    // Perform database update to mark IRN as canceled
    $sqlUpdate = "UPDATE jrctally SET reason='$reason', remarks='$remarks' WHERE sono = '$sono'";
    $queryUpdate = mysqli_query($connection, $sqlUpdate);

    if (!$queryUpdate) {
        $error = "Error: " . mysqli_error($connection);
        header("Location: compexporttally.php?error=$error");
        exit();
    }

    // Select data from the database
    $sqlselect = "SELECT irn, reason, remarks FROM jrctally WHERE sono='$sono'";
    $queryselect = mysqli_query($connection, $sqlselect);

    if (!$queryselect) {
        die("SQL query failed: " . mysqli_error($connection));
    }

    if ($rowselect = mysqli_fetch_assoc($queryselect)) {
        
        $url = 'https://api.mastergst.com/einvoice/type/CANCEL/version/V1_03?email=ijerald%40jerobyte.com'; // Replace with the actual API endpoint

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

        // Sample JSON data for the request
        $requestData = [
            "irn" => $rowselect['irn'],
            "CnlRsn" => $rowselect['reason'],
            "CnlRem" => $rowselect['remarks']
        ];

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData));

        $resp = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            echo 'HTTP Code: ' . $httpcode . '<br>';
            echo 'Response: ' . $resp;

            if ($resp) {
                // Parse the response JSON
                $responseData = json_decode($resp, true);

                // Check if the response contains the required data
                if (isset($responseData['data']) && isset($responseData['data']['Irn']) && isset($responseData['data']['CancelDate']) && isset($responseData['status_cd'])) {
                    $irn = $responseData['data']['Irn'];
                    $canceldocumentstatus = $responseData['status_cd'];
                    $canceldate = $responseData['data']['CancelDate'];

                    // Update your database with the extracted information
                    $updateQuery = "UPDATE jrctally SET canceldocumentstatus='$canceldocumentstatus', canceldate='$canceldate' WHERE irn='$irn'";
                    $result = mysqli_query($connection, $updateQuery);

                    if ($result) {
                        header("Location: compexporttally.php?remarks=IRN Cancelled successfully");
                    } else {
                        header("Location: compexporttally.php?error=Error updating database: " . mysqli_error($connection));
                    }
                } else {
                    header("Location: compexporttally.php?error=API request was not successful or missing required data");
                }
            } else {
                $error = "Error making API request: " . curl_error($ch);
                header("Location: compexporttally.php?error=$error");
                exit();
            }
        }

        curl_close($curl);
    }
}
?>
