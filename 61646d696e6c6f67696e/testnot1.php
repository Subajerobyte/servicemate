<?php
include('lcheck.php');
    function sendNotifications($connection, $companyid){
        $content = array(
            "en" => 'Welcome to Jerobyte Softwares'
            );
			
	$arras=array();
	$sqli=mysqli_query($connection, "select userid from jrcdevices where companyid='".$companyid."' order by id asc");
	while($info=mysqli_fetch_array($sqli))
	{
		$arras[]=$info['userid'];
	}
        
        $fields = array(
            'app_id' => "2c0c6d16-4604-4e32-9514-38b6fdb1d3ee",
            'include_player_ids' => $arras,
            'data' => array("foo" => "bar"),
            'contents' => $content,
			'url'=>'https://jerobyte.com/demo'
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
    $response = sendNotifications($connection, $companyid);
    $return["allresponses"] = $response;
    $return = json_encode( $return);
    
    print("\n\nJSON received:\n");
    print($return);
    print("\n");
?>