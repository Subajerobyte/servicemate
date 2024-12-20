<?php 
include('lcheck.php');
include('push.php');  
$push = new push(); 
$array=array(); 
$rows=array(); 
$notifList = $push->listNotificationUser($_SESSION['email']); 
$record = 0;

foreach ($notifList as $key) {
 $data['title'] = $key['title'];
 $callid=explode("-",$data['title']);
 $q=mysqli_query($connection,"select id from jrccalls where calltid='".$callid[0]."'");
 $st=mysqli_fetch_array($q);
 $data['msg'] = $key['notif_msg'];
 $data['icon'] = 'https://jerobyte.com/jrc/img/avatar.png';
 $data['url'] = 'https://jerobyte.com/jrc/61646d696e6c6f67696e/callsedit.php?id='.$st['id'];
 $rows[] = $data;
 $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($key['notif_repeat']*60));
 $push->updateNotification($key['id'],$nextime);
 $record++;
}
$array['notif'] = $rows;
$array['count'] = $record;
$array['result'] = true;
echo json_encode($array);
?>