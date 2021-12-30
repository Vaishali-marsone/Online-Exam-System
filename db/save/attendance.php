<?php 
    include("../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['exam_id'])){
            $exam_id = $_REQUEST['exam_id'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['stud_id'])){
            $stud_id = $_REQUEST['stud_id'];
            $sType = $_REQUEST['saveType'];
        }


        if(isset($_REQUEST['student_name'])){
            $student_name = $_REQUEST['student_name'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['date'])){
            $date = $_REQUEST['date'];
            $sType = $_REQUEST['saveType'];
        }

        if(isset($_REQUEST['status'])){
            $status = $_REQUEST['status'];
            $sType = $_REQUEST['saveType'];
        }

        if($sType=='1'){
            $sql = "INSERT INTO `student_attendance`( `exam_id`,`stud_id`,`student_name`,`date`,`status`) VALUES ('".$exam_id."', '".$stud_id."', '".$student_name."', '".$date."', '".$status."')";
        }
        else{
            $sql = "UPDATE `student_attendance` SET `exam_id`='".$exam_id."',`stud_id`='".$stud_id."',`student_name`= '".$student_name."', `date`= '".$date."' , `status`='".$status."'  WHERE `exam_id`=".$exam_id;
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