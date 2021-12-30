<?php 
    include("../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['name'])){
            $name = $_REQUEST['name'];
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }
        if($sType=='1'){
            $sql = "INSERT INTO `subjects`( `subject_name`) VALUES ('".$name."')";
        }
        else{
            $sql = "UPDATE `subjects` SET `subject_name`='".$name."' WHERE `subject_id`=".$id;
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