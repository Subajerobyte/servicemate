<?php

include('../../1637028036/vendor/autoload.php');

use Firebase\JWT\JWT;
use Endroid\QrCode\QrCode;

// Your JWT string
$jwtString = "eyJhbGciOiJSUzI1NiIsImtpZCI6IjE1MTNCODIxRUU0NkM3NDlBNjNCODZFMzE4QkY3MTEwOTkyODdEMUYiLCJ4NXQiOiJGUk80SWU1R3gwbW1PNGJqR0w5eEVKa29mUjgiLCJ0eXAiOiJKV1QifQ.eyJkYXRhIjoie1wiU2VsbGVyR3N0aW5cIjpcIjMzQUFGQ0Q1ODYyUjAwOVwiLFwiQnV5ZXJHc3RpblwiOlwiMjlBV0dQVjcxMDdCMVoxXCIsXCJEb2NOb1wiOlwiU0ovSlJDLzAyMjQvMDAxMVwiLFwiRG9jVHlwXCI6XCJJTlZcIixcIkRvY0R0XCI6XCIwMS8wMi8yMDI0XCIsXCJUb3RJbnZWYWxcIjoxMjkwOC4wMCxcIkl0ZW1DbnRcIjoxLFwiTWFpbkhzbkNvZGVcIjpcIjEwMDE5OTIwXCIsXCJJcm5cIjpcIjI1ZWM3MTQ1NjE5ZWM3NDViNzYyNWUxMTgxM2IwMjRiYzQxZjM2ZjNjYTVkZjhmYjAzNWE0NjNjYmE1NzJlMzJcIixcIklybkR0XCI6XCIyMDI0LTAyLTA5IDE4OjM3OjQ4XCJ9IiwiaXNzIjoiTklDIFNhbmRib3gifQ.CRKzeejMjXawoiiXALchBr-RiROrXD2TFeI6UZXnwRe1nxQrAcenq3HIS_YXLRSolG9VjFneNR4ADwPdkkT18HRQjAYm586YFbSFTYlLTgPldU_tFPQK5oY0N6V8YHRM4l3qek98V5v91y1x8gmrf4jJAw_tOrTZyQMI-OOaQtHSt4oR-B-AlLLQeMSDpGjUfYYX7GJ_35OS6I6fRfNuQUsqK8PmvYDrSQocRCZ5VcYVCqECXw11QycXqkskKYLFtJy2z_y096Vh5wEvOaTgJLIYgLetWfnMLlbY-u8-nA09BBDI7fADlb84j4Cs7d3IFOrAy7JgS7PovL0n9aJ14A";
$secret_key="MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArxd93uLDs8HTPqcSPpxZrf0Dc29r3iPp0a8filjAyeX4RAH6lWm9qFt26CcE8ESYtmo1sVtswvs7VH4Bjg/FDlRpd+MnAlXuxChij8/vjyAwE71ucMrmZhxM8rOSfPML8fniZ8trr3I4R2o4xWh6no/xTUtZ02/yUEXbphw3DEuefzHEQnEF+quGji9pvGnPO6Krmnri9H4WPY0ysPQQQd82bUZCk9XdhSZcW/am8wBulYokITRMVHlbRXqu1pOFmQMO5oSpyZU3pXbsx+OxIOc4EDX0WMa9aH4+snt18WAXVGwF2B4fmBk7AtmkFzrTmbpmyVqA3KO2IjzMZPw0hQIDAQAB";
// Decode the JWT string
$decodedJwt = JWT::decode($jwtString, 'secret_key', array('HS256'));

// Convert the decoded JWT data to a string
$jwtDataString = json_encode($decodedJwt);

// Generate a QR code from the JWT data
$qrCode = new QrCode($jwtDataString);

// Set QR code options if needed
// $qrCode->setSize(300);
// $qrCode->setMargin(10);

// Save the QR code as an image file
$qrCode->writeFile('jwt_qr_code.png');
?>
<?php
?>
