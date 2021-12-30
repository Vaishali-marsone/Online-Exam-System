<?php 
    include("../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['question'])){
            $question = $_REQUEST['question'];
            $sType = $_REQUEST['saveType'];
        }
       
        if(isset($_REQUEST['exam_name'])){
            $exam_name = $_REQUEST['exam_name'];
             $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['A'])){
            $A = $_REQUEST['A'];
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['B'])){
            $B = $_REQUEST['B'];
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['C'])){
            $C = $_REQUEST['C'];
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['D'])){
            $D = $_REQUEST['D'];
            $sType = $_REQUEST['saveType'];
        }
       if(isset($_REQUEST['answer'])){
            $answer = $_REQUEST['answer'];
            $sType = $_REQUEST['saveType'];
        }

         if(isset($_REQUEST['question_id'])){
            $question_id = $_REQUEST['question_id'];
        }

        if($sType=='1'){
            $sql = "INSERT INTO `questions`( `exam_id`,`question`,`op1`,`op2`,`op3`,`op4`,`answer`) VALUES ('".$exam_name."','".$question."','".$A."','".$B."','".$C."','".$D."','".$answer."')";
        }
        else{
            $sql = "UPDATE `questions` SET `exam_id`='".$exam_name."',`question`='".$question."',`op1`='".$A."',`op2`='".$B."',`op3`='".$C."',`op4`='".$D."',`answer`='".$answer."' WHERE `question_id`=".$question_id;
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