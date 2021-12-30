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
   $searchQuery = " and (stud_name like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from students ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$totalRecordwithFilter = $totalRecords;

## Fetch records
$empQuery = "select * from students  ".$searchQuery." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $stud_id=$row["stud_id"];
   $stud_name=$row["stud_name"];
    $password=$row["password"];
     $email=$row["email"];
      $dob=$row["dob"];
       $contact=$row["contact_no"];
   $data[] = array( 
      "stud_name"=>$stud_name,
      "password"=>$password,
      "email"=>$email,
      "dob"=>$dob,
      "contact"=>$contact,
      'edit'=> '<button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" 
       data-stud_id="'.$stud_id.'" 
       data-stud_name="'.$stud_name.'" 
       data-password="'.$password.'" 
       data-email="'.$email.'" 
       data-dob="'.$dob.'" 
       data-contact="'.$contact.'" 
       ><i class="fa fa-edit"></i></button></div>',
      'delete'=> '<button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" 
      data-stud_id="'.$stud_id.'" 
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
