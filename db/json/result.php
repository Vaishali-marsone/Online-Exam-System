<?php 
    include("../db.php"); 

    $sql = "SELECT `exam_id`, `exam_name`FROM `exams` ";
	$res = mysqli_query($con,$sql);
	
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result,array('exam_id'=>$row['exam_id'],'exam_name'=>$row['exam_name']));
	}
	echo json_encode($result);
    mysqli_close($con);  
?>