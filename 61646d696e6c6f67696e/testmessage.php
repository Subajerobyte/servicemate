<?php
$calltid="20211454";
$otherremarksvalue="UPS PROBLEM";
$callfromvalue="8144617454";
$engineernamevalue="RUBAN";
$custmessage="Dear Customer, thank you for calling UEL . Your Complaint Registration number is : ".$calltid."(".$otherremarksvalue.").Our Service Engineer (".$engineernamevalue.") will contact you shortly.- UEL POWER";
//$custmessage="Dear Customer, thank you for calling UEL . Your Complaint Registration number is : {#var#}{#var#}.Our Service Engineer {#var#}{#var#} will contact you shortly.- UEL POWER";
$custmessage=urlencode($custmessage);
$url = "http://sms.tektrix.in/api/smsapi?key=cd03f736ce2cef0d3a5b406ccaa35c83&route=2&sender=UELABO&number=".$callfromvalue."&sms=".$custmessage."&templateid=1707164249593635593";
echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
echo $output = curl_exec($ch);
curl_close($ch);
?>