<?php
include('lcheck.php');
if(isset($_GET['id'])) {
    $sono = mysqli_real_escape_string($connection, $_GET['id']);

    $sqlselect = "SELECT * FROM jrctally WHERE sono='".$sono."'";
    $queryselect = mysqli_query($connection, $sqlselect);
    $rowCountselect = mysqli_num_rows($queryselect);

    if(!$queryselect){
        die("SQL query failed: " . mysqli_error($connection));
    }

    if($rowCountselect > 0) {
        $rowselect = [];
        while($row1 = mysqli_fetch_assoc($queryselect)) {
            $rowselect[] = $row1;
        }

        $url = 'https://api.mastergst.com/einvoice/type/GENERATE/version/V1_03?email=ijerald%40jerobyte.com'; // Replace with the actual API endpoint

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $authtoken=$_SESSION['authtoken'];
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

        $stateCodeseller = $_SESSION['companystatecode'];
        $partseller = explode('-', $stateCodeseller);
        $stateCode = trim($partseller[0]);

        $stateCodebuyer = $rowselect[0]['buyerstate'];
        $partbuyer = explode('-', $stateCodebuyer);
        $stateCodebuy = trim($partbuyer[0]);

        $stateCodeconsignee = $rowselect[0]['constatecode'];
        $partcon = explode('-', $stateCodeconsignee);
        $stateCodecon = trim($partcon[0]);
        $total = 0;
        foreach($rowselect as $row1) {
            $producttotal = $row1['conqty'] * $row1['conunit'];
            $total += $producttotal - $row1['discountamount'];
        }

        $sqlselect1 = "SELECT SUM(concgstamount) AS total_cgst FROM jrctally WHERE sono='" . $sono . "'";
        $queryselect1 = mysqli_query($connection, $sqlselect1);
        $rowCountselect1 = mysqli_num_rows($queryselect1);
        if (!$queryselect1) {
            die("SQL query failed: " . mysqli_error($connection));
        }
        if ($rowCountselect1 > 0) {
            $row3 = mysqli_fetch_assoc($queryselect1);
            $totalcgst = round($row3['total_cgst']);
        }

        $sqlselect2 = "SELECT SUM(conigstamount) AS total_igst FROM jrctally WHERE sono='" . $sono . "'";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if (!$queryselect2) {
            die("SQL query failed: " . mysqli_error($connection));
        }
        if ($rowCountselect2 > 0) {
            $row4 = mysqli_fetch_assoc($queryselect2);
            $totaligst = round($row4['total_igst']);
        }

        $sqlselect3 = "SELECT SUM(consgstamount) AS total_sgst FROM jrctally WHERE sono='" . $sono . "'";
        $queryselect3 = mysqli_query($connection, $sqlselect3);
        $rowCountselect3 = mysqli_num_rows($queryselect3);
        if (!$queryselect3) {
            die("SQL query failed: " . mysqli_error($connection));
        }
        if ($rowCountselect3 > 0) {
            $row5 = mysqli_fetch_assoc($queryselect3);
            $totalsgst = round($row5['total_sgst']);
        }

        if ($rowselect[0]['conigst'] != '') {
            $gtotal = $total + $totaligst;
        } else {
            $gtotal = $total + $totalcgst + $totalsgst;
        }

        // Remove spaces
        $invoiceno = str_replace(' ', '', $rowselect[0]['invoiceno']);

        // Convert dates to DD/MM/YYYY format
        $invoicedate = date('d/m/Y', strtotime($rowselect[0]['invoicedate']));
        $companygstno = $_SESSION['companygstno'];
        $bgst = $rowselect[0]['bgst'];
        $congstno = $rowselect[0]['congstno'];
        $buyermobile = $rowselect[0]['buyermobile'];
        // Sample JSON data for the request
        $data = [
            "Version" => "1.1",
            "TranDtls" => [
                "TaxSch" => "GST",
                "SupTyp" => $rowselect[0]['invoicetype'],
                "RegRev" => "Y",
                "EcmGstin" => null, // Replace with the valid GSTIN if applicable
                "IgstOnIntra" => "N"
            ],
            "DocDtls" => [
                "Typ" => "INV",
                "No" => $invoiceno,
                "Dt" => $invoicedate
            ],
            "SellerDtls" => [
                "Gstin" => $companygstno,
                "LglNm" => $_SESSION['companyname'],
                "TrdNm" => $_SESSION['companyname'],
                "Addr1" => $_SESSION['companyaddress1'],
                "Addr2" => $_SESSION['companyaddress2'],
                "Loc" => $_SESSION['companydistrict'],
                "Pin" => intval($_SESSION['companypincode']),
                "Stcd" => $stateCode,
                "Ph" => $_SESSION['companymobile'],
                "Em" => $_SESSION['companyemail']
            ],
            "BuyerDtls" => [
                "Gstin" => $bgst,
                "LglNm" => $rowselect[0]['buyername'],
                "TrdNm" => $rowselect[0]['buyername'],
                "Pos" => $stateCode,
                "Addr1" => $rowselect[0]['buyeraddress1'],
                "Addr2" => $rowselect[0]['buyeraddress2'],
                "Loc" => $rowselect[0]['buyerdistrict'],
                "Pin" => intval($rowselect[0]['buyerpincode']),
                "Stcd" => $stateCodebuy,
               "Ph" => $buyermobile,
                "Em" => $rowselect[0]['buyermail']
            ],
            "DispDtls" => [
                "Nm" => $_SESSION['companyname'],
                "Addr1" => $_SESSION['companyaddress1'],
                "Addr2" => $_SESSION['companyaddress2'],
                "Loc" => $_SESSION['companydistrict'],
                "Pin" => intval($_SESSION['companypincode']),
                "Stcd" => $stateCode
            ],
            "ShipDtls" => [
                "Gstin" => $congstno,
                "LglNm" => $rowselect[0]['consigneename'],
                "TrdNm" => $rowselect[0]['consigneename'],
                "Addr1" => $rowselect[0]['conaddress1'],
                "Addr2" => $rowselect[0]['conaddress2'],
                "Loc" => $rowselect[0]['condistrict'],
                "Pin" => intval($_SESSION['companypincode']),
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
                $totaldisval = $producttotal - $row1['discountamount'];
                $total += $totaldisval;

                // Convert empty strings to null
                $igstAmt = $row1['conigstamount'] !== '' ? round(floatval($row1['conigstamount'])) : null;
                $cgstAmt = $row1['concgstamount'] !== '' ? round(floatval($row1['concgstamount'])) : null;
                $sgstAmt = $row1['consgstamount'] !== '' ? round(floatval($row1['consgstamount'])) : null;

                // Ensure Unit length is between 3 and 8 characters
                $unit = str_pad($beforeDash, 3, " ", STR_PAD_RIGHT);
                $unit = substr($unit, 0, 8);
                
                // Validate and correct the UQC (Unit Quantity Code)
                $valid_uqc_codes = [
                    "BAG", "BAL", "BDL", "BKL", "BOU", "BOX", "BTL", "BUN", "CAN", "CBM", 
                    "CCM", "CMS", "CTN", "DOZ", "DRM", "GGK", "GMS", "GRS", "GYD", "KGS", 
                    "KLR", "KME", "LTR", "MLS", "MTR", "NOS", "PAC", "PCS", "PRS", "QTL", 
                    "ROL", "SET", "SQF", "SQM", "SQY", "TBS", "TGM", "THD", "TON", "TUB", 
                    "UGS", "UNT", "VLS", "YDS"
                ];

                // Default to "NOS" if the unit is invalid
                if (!in_array($unit, $valid_uqc_codes)) {
                    $unit = "NOS";
                }

                if ($row1['conigst'] != '') {
                    $congst = $row1['conigst'];
                } else {
                    $congst = $row1['consgst'] + $row1['concgst'];
                }
                
                $i++;
                
                return [
                    "SlNo" => strval($i), // Convert SlNo to string
                    "PrdDesc" => $row1['conproduct'],
                    "IsServc" => $row1['hsntype'],
                    "HsnCd" => $row1['conhsncode'],
                    "Barcde" => null,
                    "Qty" => $row1['conqty'],
                    "FreeQty" => 0,
                    "Unit" => $unit,
                    "UnitPrice" => $row1['conunit'],
                    "TotAmt" => $producttotal,
                    "Discount" => $row1['discountamount'],
                    "PreTaxVal" => $producttotal,
                    "AssAmt" => $producttotal - $row1['discountamount'],
                    "GstRt" => $congst,
                    "IgstAmt" => $igstAmt,
                    "CgstAmt" => $cgstAmt,
                    "SgstAmt" => $sgstAmt,
                    "CesRt" => 0,
                    "CesAmt" => 0,
                    "CesNonAdvlAmt" => 0,
                    "StateCesRt" => 0,
                    "StateCesAmt" => 0,
                    "StateCesNonAdvlAmt" => 0,
                    "OthChrg" => 0,
                    "TotItemVal" => $producttotal + $igstAmt + $cgstAmt + $sgstAmt - $row1['discountamount'],
                    "OrdLineRef" => null,
                    "OrgCntry" => null,
                    "PrdSlNo" => null,
                    "BchDtls" => null,
                    "AttribDtls" => []
                ];
            }, $rowselect),
		
            "ValDtls" => [
                "AssVal" => $total,
                "CgstVal" => $totalcgst,
                "SgstVal" => $totalsgst,
                "IgstVal" => $totaligst,
                "CesVal" => 0,
                "StCesVal" => 0,
                "Discount" => $rowselect[0]['buyback'],
                "OthChrg" => 0,
                "RndOffAmt" => 0,
                "TotInvVal" => $gtotal - $rowselect[0]['buyback'],
                "TotInvValFc" => 0
            ],
            "PayDtls" => [
                "Nm" => "COD",
                "Mode" => "01",
                "FinInsBr" => null,
                "PayTerm" => "NA",
                "PayInstr" => "NA",
                "CrTrn" => null,
                "DirDr" => null,
                "CrDay" => 0,
                "PaidAmt" => 0,
                "PaymtDue" => 0
            ],
            "RefDtls" => [
                "InvRm" => $sono,
                "DocPerdDtls" => [
                    "InvStDt" => $invoicedate,
                    "InvEndDt" => $invoicedate
                ]
            ],
            
        ];
        echo "<pre>";
        print_r($data);
        echo "</pre>";
		
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

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

    // Check if the response contains govt_response and it indicates success
    if (isset($responseData['data']) && isset($responseData['status_cd']) && $responseData['status_cd'] == "1") {
        $govtResponse = $responseData['data'];

        // Extract relevant information from the response
        $irn = isset($govtResponse['Irn']) ? $govtResponse['Irn'] : '';
        $acknowledgmentNumber = isset($govtResponse['AckNo']) ? $govtResponse['AckNo'] : '';
        $acknowledgmentDate = isset($govtResponse['AckDt']) ? $govtResponse['AckDt'] : '';
        $irnsuccess = "Y"; // Since it's successful
        $invoicesign = isset($govtResponse['SignedInvoice']) ? $govtResponse['SignedInvoice'] : '';
        $invoiceqr = isset($govtResponse['SignedQRCode']) ? $govtResponse['SignedQRCode'] : '';
       
        // Update your database with the extracted information
        $updateQuery = "UPDATE jrctally SET irn='$irn', acknowledgmentno='$acknowledgmentNumber', acknowledgmentdate='$acknowledgmentDate', irnsuccess='$irnsuccess', invoicesign='$invoicesign', invoiceqr='$invoiceqr', transactionid='$transactionid', documentstatus='$documentstatus' WHERE sono='$sono'";
        $result = mysqli_query($connection, $updateQuery);

        if ($result) {
            header("Location: compexporttally.php?remarks=IRN Generated successfully");
        } else {
            header("Location: compexporttally.php?error=" . urlencode("Error updating database: " . mysqli_error($connection)));
        }
    } else {
		//echo 'Response: ' . $resp;
        //header("Location: compexporttally.php?error=" . urlencode("API request was not successful or missing required data"));
    }
} else {
    header("Location: compexporttally.php?error=" . urlencode("Error making API request: " . curl_error($curl)));
}		
        }
        curl_close($curl);
    } else {
        echo "No records found.";
    }
} else {
    echo "ID not provided.";
}
?>
