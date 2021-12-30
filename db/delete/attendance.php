<?php 
    include("../db.php"); 
  
    $value_id=$_REQUEST['exam_id'];
    $table_name='student_attendance';
    $column_id='exam_id';
    

    $current_date=date("Y-m-d H:i:s");
    //$sql = "UPDATE ".$table_name." WHERE ".$column_id."=".$value_id;
    $sql = "DELETE FROM ".$table_name." WHERE ".$column_id."=".$value_id;
    $res = mysqli_query($con,$sql);
    $result = array();
        
    if ($con->query($sql) === TRUE)
    {
        $response["code"] = 1;
        $response["message"] = "successfully deleted";
        
    } else {
        $response["code"] = 2;
        $response["message"] = mysqli_error($con);
    }
    echo json_encode($response);
    mysqli_close($con);   
?>