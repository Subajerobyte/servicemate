<?php
$privateKey 	= 'AA74CDCC2BBRT935136HH7B63C27'; // user define key
    $secretKey 		= '5fgf5HJ5g27'; // user define secret key
    $encryptMethod      = "AES-256-CBC";
    $string 		= '123456789012345123456789012345123456789012345'; // user define value

    $key = hash('sha256', $privateKey);
    $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
    $result = openssl_encrypt($string, $encryptMethod, $key, 0, $ivalue);
    echo $output = base64_encode($result);  // output is a encripted value
	echo "<br>";
	
	$privateKey 	= 'AA74CDCC2BBRT935136HH7B63C27'; // user define key
    $secretKey 		= '5fgf5HJ5g27'; // user define secret key
    $encryptMethod      = "AES-256-CBC";
    $stringEncrypt      = $output; // user encrypt value
    $key    = hash('sha256', $privateKey);
    $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
    echo $output = openssl_decrypt(base64_decode($stringEncrypt), $encryptMethod, $key, 0, $ivalue);
	// output is a decripted value