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
   $searchQuery = " and (exam_name like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount  from exams e
inner join subjects s 
on e.subject_id=s.subject_id where 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$totalRecordwithFilter = $totalRecords;

## Fetch records
$empQuery = "select e.exam_id,e.subject_id,e.exam_name,e.exam_date,e.start_time,e.end_time,e.number_of_que
,e.mark_per_que,e.exam_duration,s.subject_name from exams e
inner join subjects s 
on e.subject_id=s.subject_id where 1  ".$searchQuery." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $exam_id=$row['exam_id'];
   $sub_id=$row['subject_id']; 
   $exam_name=$row['exam_name'];
   $subject_name=$row['subject_name'];
   $exam_date=$row['exam_date'];
   $start_time=$row['start_time'];
   $end_time=$row['end_time'];
   $number_of_que=$row['number_of_que'];
   $mark_per_que=$row['mark_per_que'];
   $exam_duration=$row['exam_duration'];
   $data[] = array( 
      "sub_id"=>$sub_id,
       "exam_name"=>$exam_name,
       "subject_name"=>$subject_name,
      "exam_date"=>$exam_date,
      "start_time"=>$start_time,
      "end_time"=>$end_time,
      "number_of_que"=>$number_of_que,
      "mark_per_que"=>$mark_per_que,
      "exam_duration"=>$exam_duration,
      'edit'=> '<button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" 
       data-exam_id="'.$exam_id.'" 
        data-sub_id="'.$sub_id.'" 
        data-exam_name="'.$exam_name.'" 
       data-exam_date="'.$exam_date.'" 
       data-start_time="'.$start_time.'" 
       data-end_time="'.$end_time.'" 
      data-number_of_que="'.$number_of_que.'" 
       data-mark_per_que="'.$mark_per_que.'" 
        data-exam_duration="'.$exam_duration.'" 
       ><i class="fa fa-edit"></i></button></div>',
      'delete'=> '<button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" 
      data-exam_id="'.$exam_id.'" 
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
