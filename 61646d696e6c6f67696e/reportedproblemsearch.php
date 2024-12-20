<?php
include('lcheck.php');
function get_reportedproblem($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcreportedproblem WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getreportedproblem = get_reportedproblem($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $reportedproblemList = array();
 foreach($getreportedproblem as $reportedproblem){
 $reportedproblemList[] = $reportedproblem[$type];
 }
 echo json_encode($reportedproblemList);
}
?>