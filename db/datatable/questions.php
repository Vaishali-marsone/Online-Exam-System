<?php 
    include("../db.php");
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page

if(isset($_POST['search']['value'])){
   $searchValue = $_POST['search']['value']; // Search value  
}
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (question like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount  from questions q
inner join  exams e 
on q.exam_id=e.exam_id where 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$totalRecordwithFilter = $totalRecords;

## Fetch records
$empQuery =  "select q.question_id, q.exam_id,q.question,q.op1,q.op2,q.op3,q.op4,q.answer,e.exam_name
 from questions q
inner join exams e
on q.exam_id=e.exam_id where 1  ".$searchQuery." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $question_id=$row["question_id"];
   $exam_id=$row["exam_id"];
   $exam_name=$row["exam_name"];
   $question=$row["question"];
   $A=$row["op1"];
   $B=$row["op2"];
   $C=$row["op3"];
   $D=$row["op4"];
   $answer=$row["answer"];
   $data[] = array( 
      "exam_id"=>$exam_id,
       "exam_name"=>$exam_name,
      "question"=>$question,
      "A"=>$A,
      "B"=>$B,
      "C"=>$C,
      "D"=>$D,
      "answer"=>$answer,
      'edit'=> '<button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" 
      data-question_id="'.$question_id.'" 
       data-exam_id="'.$exam_id.'" 
       data-question="'.$question.'" 
        data-A="'.$A.'" 
         data-B="'.$B.'" 
          data-C="'.$C.'" 
           data-D="'.$D.'" 
            data-answer="'.$answer.'" 
       ><i class="fa fa-edit"></i></button></div>',
      'delete'=> '<button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" 
      data-question_id="'.$question_id.'" 
      ><i class="fa fa-trash"></i></button></div>'
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecordwithFilter,
  "iTotalDisplayRecords" => $totalRecords,
  "aaData" => $data
);

echo json_encode($response);
?>
