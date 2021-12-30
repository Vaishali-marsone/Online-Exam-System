<?php 
    include("../db.php");
## Read value
$exam_id=1;

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
$sel = mysqli_query($con,"select count(*) as allcount  from stud_exam_que_ans q
inner join  students s 
on q.stud_id=s.stud_id where 1  ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$totalRecordwithFilter = $totalRecords;

## Fetch records
$empQuery = " SELECT s.stud_id,s.exam_id,sum(q.mark) as total_mark
FROM stud_exam_que_ans q
INNER JOIN students s
ON s.stud_id = q.stud_id
WHERE 1";

$empRecords = mysqli_query($con, $empQuery);

//$total_row = $con->total_row();
$data = array();
//$row = mysqli_fetch_assoc($empRecords);


while ($row = mysqli_fetch_assoc($empRecords)) {
   $result_id=$row["result_id"];
   $stud_id=$row["stud_id"];
   $exam_id=$row["exam_id"];
   $result=$row["total_mark"];
   $data[] = array( 
      "stud_id" => $stud_id,
      "exam_id" => $exam_id,
      "result" => $result,
   'edit' => '<button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" 
       data-result_id="'.$result_id.'" 
       data-stud_id="'.$stud_id.'" 
       data-exam_id="'.$exam_id.'" 
       data-result="'.$result.'" 
       ><i class="fa fa-edit"></i></button></div>',
      'delete' => '<button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" 
      data-result_id="'.$result_id.'" 
      ><i class="fa fa-trash"></i></button></div>'
      );
      }

   //foreach ($data as $row) {
    //$sub_array = array();
     //$sub_array[] = $row["stud_id"];
     //$sub_array[] = $row["exam_id"];
     //$sub_array[] = $row["total_mark"];
     //$data[] = $sub_array;
//}
//$data[] = array( 
  //    "stud_id"=>$stud_id,
    //  "exam_id"=>$exam_id,
      //"result"=>$result);

   //}/

## Response
$response = array(
  "draw" => intval($draw),
  //"recordTotal" => $total_row;
  "iTotalRecords" => $totalRecordwithFilter,
  "iTotalDisplayRecords" => $totalRecords,
  "aaData" => $data
);

echo json_encode($response);
?>
