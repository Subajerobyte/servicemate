<?php
include('pointsys.php');
$emp = new Points();
if(!empty($_POST['action']) && $_POST['action'] == 'listPoints') {
	$emp->PointsList();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addPoints') {
	$emp->addPoints();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getPoints') {
	$emp->getPoints();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updatePoints') {
	$emp->updatePoints();
}
if(!empty($_POST['action']) && $_POST['action'] == 'empDelete') {
	$emp->deletePoints();
}
?>