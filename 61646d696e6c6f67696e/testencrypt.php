<?php
include("../session.php");
if($ip=="103.135.189.105")
{
$content=file_get_contents("http://103.135.189.105:2909/index.php");
}
else
{
$content=file_get_contents("http://192.168.1.25:2909/index.php");
}
if($content=="no file")
{
echo "Please Connect your Security Key on your Main Computer";	
}
else
{
$p=explode("R",$content);
$n=0;
$a=array();
foreach ($p as $c) 
{
if($n!=0)
{
$a[]=substr ( $c, ($n-1),1);
}
$n++;
}
$ase=implode("",$a); 	
$k41=explode("~",$ase);
$key=$k41[0];
echo $key;		

function jbsencrypt($key, $str)
{
$privateKey 	= 'WERULETHEWORLD';
    $secretKey 		= $key; 
    $encryptMethod      = "AES-256-CBC";
    $string 		= $str;
    $key = hash('sha256', $privateKey);
    $ivalue = substr(hash('sha256', $secretKey), 0, 16); 
    $result = openssl_encrypt($string, $encryptMethod, $key, 0, $ivalue);
    return $output = base64_encode($result);  
}	
function jbsdecrypt($key, $str)
{
	$privateKey 	= 'WERULETHEWORLD'; 
    $secretKey 		= $key; 
    $encryptMethod      = "AES-256-CBC";
    $stringEncrypt      = $str; 
    $key    = hash('sha256', $privateKey);
    $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
    return $output = openssl_decrypt(base64_decode($stringEncrypt), $encryptMethod, $key, 0, $ivalue);
}
echo '<br>';
$enc=jbsencrypt($key, "Test String");
echo $enc.'<br>';
$dec=jbsdecrypt($key, $enc);
echo $dec.'<br>';
}
