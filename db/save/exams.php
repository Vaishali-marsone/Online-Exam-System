<?php 
    include("../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['subject_name'])){
            $sub_id = $_REQUEST['subject_name'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['exam_name'])){
            $exam_name = $_REQUEST['exam_name'];
            $sType = $_REQUEST['saveType'];
        }


        if(isset($_REQUEST['exam_date'])){
            $exam_date = $_REQUEST['exam_date'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['start_time'])){
            $start_time = $_REQUEST['start_time'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['end_time'])){
            $end_time = $_REQUEST['end_time'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['number_of_que'])){
            $number_of_que = $_REQUEST['number_of_que'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['mark_per_que'])){
            $mark_per_que = $_REQUEST['mark_per_que'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['exam_duration'])){
            $exam_duration = $_REQUEST['exam_duration'];
            $sType = $_REQUEST['saveType'];
        }


        if(isset($_REQUEST['exam_id'])){
            $exam_id = $_REQUEST['exam_id'];
        }

        if($sType=='1'){
            $sql = "INSERT INTO `exams`( `subject_id`,`exam_name`,`exam_date`,`start_time`,`end_time`,`number_of_que`,`mark_per_que`,`exam_duration`) VALUES ('".$sub_id."', '".$exam_name."', '".$exam_date."', '".$start_time."', '".$end_time."', '". $number_of_que."', '".$mark_per_que."', '".$exam_duration."')";
        }
        else{
            $sql = "UPDATE `exams` SET `subject_id`='".$sub_id."',`exam_name`='".$exam_name."',`exam_date`= '".$exam_date."', `start_time`= '".$start_time."' , `end_time`='".$end_time."', `number_of_que`='". $number_of_que."' , `mark_per_que`='".$mark_per_que."' , `exam_duration`= '".$exam_duration."'  WHERE `exam_id`=".$exam_id;
        }
  
    if ($con->query($sql) === TRUE)
        {
            $response["code"] = 1;
            $response["message"] = "successfully stored";
        } else {
            $response["code"] = 2;
            $response["message"] = mysqli_error($con);
        }       
        echo json_encode($response);
        mysqli_close($con);
} 
?>