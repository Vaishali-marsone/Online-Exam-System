<?php 
    include("../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['stud_name'])){
            $stud_name = $_REQUEST['stud_name'];
            $sType = $_REQUEST['saveType'];
        }
        
        if(isset($_REQUEST['password'])){
            $password = $_REQUEST['password'];
             $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['email'])){
            $email = $_REQUEST['email'];
             $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['dob'])){
            $dob = $_REQUEST['dob'];
             $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['contact'])){
            $contact = $_REQUEST['contact'];
             $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['stud_id'])){
            $stud_id = $_REQUEST['stud_id'];
        }

        if($sType=='1'){
            $sql = "INSERT INTO `students`( `stud_name`,`password`,`email`,`dob`,`contact_no`) VALUES ('".$stud_name."' ,'".$password."','".$email."','".$dob."','".$contact."')";
        }
        else{
            $sql = "UPDATE `students` SET `stud_name`='".$stud_name."',`password`='".$password."',`email`='".$email."',`dob`='".$dob."',`contact_no`='".$contact."' WHERE `stud_id`=".$stud_id;
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