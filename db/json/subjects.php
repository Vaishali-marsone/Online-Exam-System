<?php 
    include("../db.php"); 

    $sql = "SELECT `subject_id`, `subject_name`FROM `subjects` ";
	$res = mysqli_query($con,$sql);
	
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result,array('id'=>$row['subject_id'],'name'=>$row['subject_name']));
	}
	echo json_encode($result);
    mysqli_close($con);  
?>