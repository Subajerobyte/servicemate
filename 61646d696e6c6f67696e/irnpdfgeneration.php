<?php
include('lcheck.php');
if(isset($_GET['id']))
{
	$host = "https://api-sandbox.clear.in/einv/v2/eInvoice/download";
$authToken = "1.d8d14bd8-2e38-44e5-83b8-5d201be0c57c_9c7f24a362e80fb1c5d097509393b5419b65e8bb04a17c53ef8c241aaf3805b8";
echo $gstin = $_SESSION['companygstno'];
echo $pan = $_SESSION['companypanno'];
	 $sono=mysqli_real_escape_string($connection,$_GET['id']);
	 $sqlselect = "SELECT irn,sono From jrctally where sono='".$sono."'";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
		$row1 = mysqli_fetch_assoc($queryselect);
echo '<br>';

echo '<br>';
echo $irn = $row1['irn'];  // Replace with the actual IRNs

$requestHeaders = [
    'X-Cleartax-Auth-Token: ' . $authToken,
    'gstin: ' . $gstin,
    'pan: ' . $pan,
];

$queryParameters = [
    'irns' => $irn,
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
$filepath='../padhivetram/irnpdf/'.$irn.'.pdf';
file_put_contents('../padhivetram/irnpdf/'.$irn.'.pdf', $response);
header("Location: ".$filepath);
}
?>