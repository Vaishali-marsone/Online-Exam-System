<?php 
    include("../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['stud_id'])){
            $stud_id = $_REQUEST['stud_id'];
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['exam_id'])){
            $exam_id = $_REQUEST['exam_id'];
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['result'])){
            $result = $_REQUEST['result'];
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['result_id'])){
            $result_id = $_REQUEST['result_id'];
        }
        if($sType=='1'){
            $sql = "INSERT INTO `result`( `stud_id`,`exam_id`,`result`) VALUES ('".$stud_id."','".$exam_id."','".$result."')";
        }
        else{
            $sql = "UPDATE `result` SET `stud_id`='".$stud_id."',`exam_id`='".$exam_id."',`result`='".$result."' WHERE `result_id`=".$result_id;
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