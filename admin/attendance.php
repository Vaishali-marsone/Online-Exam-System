<?php include("header.php"); ?>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Add/Update Student Attendance</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


        <form id="" method="post" action="">
            <input type="hidden"  name="saveType" id="saveType" value="1">
            <input type="hidden"  name="id" id="id" value="">

            
              <div class="form-group">
                <label for="exam_id">  Id</label>
                <input id="exam_id" name="exam_id" class="form-control" aria-describedby="exam_id">
              </div>
            

              <div class="form-group">
                <label for="stud_id"> Student Id</label>
                <input id="stud_id" name="stud_id" class="form-control" aria-describedby="stud_id">
              </div>
              
              <div class="form-group">
                <label for="student_name">Student name  </label>
                <input id=" student_name=" name="student_name" class="form-control" aria-describedby="student_name">
              </div>
              
              <div class="form-group">
                <label for="date"> date</label>
                <input type="date" id="date" name="date" class="form-control" aria-describedby="date">
              </div>

              <div class="form-group">
                <label for="status"> status </label>
                <input id="status" name="status" class="form-control" aria-describedby="status">
              </div>
          </form>
        </div>

        <div class="modal-footer">
     
     <button type="submit" id="submit" class="btn btn-primary">Submit</button>
     <button type="reset" id="reset" class="btn btn-light">Reset</button>
     <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
           </div>
         </div>
         
       </div>
     </div>
   
   
 <div class="card" style="padding:10px;">

 <div class="card-body">

 <h5 class="card-title">Student Ateendance</h5>
<button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#myModal">Add</button>
</div>

<div class="table-responsive">
<table class="table table-bordered" id="dtable">
  <thead  >
    <tr>
      <th scope="col">#</th>
      <th scope="col"> Exam Id</th>
      <th scope="col"> student Id</th>
      <th scope="col"> Student name </th>
      <th scope="col">date </th>
      <th scope="col">status</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody id="tbody">
  
  </tbody>
</table>
</div>
</div>
</div>

<script >
$(document).ready(function() {
 
var filename="attendance.php";
var report_name="Scheme Report";
  $('#dtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
       "searching":false,
        "ajax": "../db/datatable/"+filename,
        
        
      'columns': [
         {"data": "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }},{ data: 'exam_id' },
    { data: 'stud_id' },
    { data: 'student_name' },
    { data: 'date' },
    { data: 'status' },
         { data: 'edit' },
         { data: 'delete' }
      ]
    });

function loadsubject(){
    $.getJSON("../db/json/attendance.php",function(data){
        $("#student_name").empty();
        $("#student_name").append("<option value=''>Select </option>");
            $.each(data,function(key,val) {
                $("#student_name").append("<option value='" + val.id+ "'>" + val.name + "</option>");
             });
    }); 
  }
  loadsubject();

  $(document).on("click", '#btnEdit', function() {
       $("#saveType").val("2");
        $("#exam_id").val($(this).attr("data-exam_id"));
        $("#stud_id").val($(this).attr("data-stud_id"));
        $("#student_name").val($(this).attr("data-student_name"));
        $("#date").val($(this).attr("data-date"));
        $("#status").val($(this).attr("data-status"));
        $('#myModal').modal('show');
    });

    $("#submit").click(function(e) {
          e.preventDefault();
          var form=$('form').serialize();
          saveData(form,'../db/save/'+filename);
     });

     $("#reset").click(function(e) {
      e.preventDefault();
      $("#exam_id").val("");
      $("#stud_id").val("");
              $("#student_name").val("");
               $("#date").val("");
              $("#status").val("");
              $("#saveType").val("1");
    });
    $(document).on("click", '#btnDelete', function() {
          var jid=$(this).attr("data-exam_id");
          deleteData(jid,'../db/delete/'+filename)
     });

     function refreshData(){
    $('#dtable').DataTable().ajax.reload(); 
  }
     function saveData(frm,url){
      $.ajax({
            type: 'POST',
            url: url,
            data: frm,
            success: function(resp) {
              var status=JSON.parse(resp);
              if(status.code==1){
                      $.dreamAlert({
                                'type'      :   'success',
                                'message'   :   'Operation completed!',
                                'position'  :   'right',
                                'summary'   :   'Data Submitted'
                        });
            
                        $('#myModal').modal('hide');
                      refreshData();
                }
            },
            error: function() {
              $.dreamAlert({
                                'type'      :   'error',
                                'message'   :   'Data Not Saved',
                                'position'  :   'right',
                                'summary'   :   'Data Submitted'
                        });
            }
          });
          $("#saveType").val("1");
     }
     function deleteData(did,url){
      $.ajax({
                  type: 'POST',
                  url: url,
                  data: {exam_id:did},
                  success: function(resp) {
                    var status=JSON.parse(resp);
                    if(status.code==1){
                      $.dreamAlert({
                                'type'      :   'success',
                                'message'   :   'Data deleted Successfully!',
                                'position'  :   'right',
                                'summary'   :   'Data Submitted'
                        });
                
                    refreshData();
                    }
                  }, 
                  error: function() {
                    $.dreamAlert({
                                'type'      :   'success',
                                'message'   :   'Data not deleted !',
                                'position'  :   'right',
                                'summary'   :   'Data Submitted'
                        });
                  }
          });
      }

});
</script>

<?php include("footer.php"); ?>