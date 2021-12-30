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
   $searchQuery = " and (stud_id like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from result ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$totalRecordwithFilter = $totalRecords;

## Fetch records
$empQuery = "select students.stud_id,students.stud_name,sum(stud_exam_que_ans.mark) as total_mark
FROM stud_exam_que_ans
INNER JOIN students
ON students.stud_id = stud_exam_que_ans.stud_id
WHERE stud_exam_que_ans.exam_id = '$exam_id'";
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $result_id=$row["result_id"];
   $stud_id=$row["stud_id"];
   $exam_id=$row["exam_id"];
   $result=$row["total_mark"];
   $data[] = array( 
      "stud_id"=>$stud_id,
      "exam_id"=>$exam_id,
      "result"=>$result,
      'edit'=> '<button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" 
       data-result_id="'.$result_id.'" 
       data-stud_id="'.$stud_id.'" 
       data-exam_id="'.$exam_id.'" 
       data-result="'.$result.'" 
       ><i class="fa fa-edit"></i></button></div>',
      'delete'=> '<button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" 
      data-result_id="'.$result_id.'" 
      ><i class="fa fa-trash"></i></button></div>'
   );
}

## Response
$response = array(
  "draw" => intval($draw),
 // "recordTotal" => $total_rows;
  "iTotalRecords" => $totalRecordwithFilter,
  "iTotalDisplayRecords" => $totalRecords,
  "aaData" => $data
);

echo json_encode($response);
?>
