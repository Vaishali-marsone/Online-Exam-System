<?php include("header.php"); ?>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Add/Update Exam</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


        <form id="" method="post" action="">
            <input type="hidden"  name="saveType" id="saveType" value="1">
            <input type="hidden"  name="exam_id" id="exam_id" value="">

            
              <div class="form-group">
                    <label for="subject"> Subject </label>
                    <select id="subject_name" name="subject_name" class="form-control" aria-describedby="subject_id"></select>
                  </div>
            

              <div class="form-group">
                <label for="exam_name"> Exam name </label>
                <input id="exam_name" name="exam_name" class="form-control" aria-describedby="exam_name">
              </div>
              
              <div class="form-group">
                <label for="exam_date"> Exam date</label>
                <input type="date" id=" exam_date=" name="exam_date" class="form-control" aria-describedby="exam_date">
              </div>
              
              <div class="form-group">
                <label for="start_time"> Start time </label>
                <input id="start_time" name="start_time" class="form-control" aria-describedby="start_time">
              </div>
              
              <div class="form-group">
                <label for="end_time"> End time</label>
                <input id="end_time" name="end_time" class="form-control" aria-describedby="end_time">
              </div>
              <div class="form-group">
                <label for="number_of_que"> Number of question </label>
                <input id="number_of_que" name="number_of_que" class="form-control" aria-describedby="number_of_que">
              </div>

               <div class="form-group">
                <label for="mark_per_que"> Mark per Question</label>
                <input id="mark_per_que" name="mark_per_que" class="form-control" aria-describedby="mark_per_que">
              </div>

              <div class="form-group">
                <label for="exam_duration"> Exam Duration </label>
                <input id="exam_duration" name="exam_duration" class="form-control" aria-describedby="exam_duration">
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

 <h5 class="card-title">Exam </h5>
<button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#myModal">Add</button>
</div>

<div class="table-responsive">
<table class="table table-bordered" id="dtable">
  <thead  >
    <tr>
      <th scope="col">#</th>
      <th scope="col"> Subject Name</th>
      <th scope="col"> Exam name</th>
      <th scope="col"> Exam date</th>
      <th scope="col"> Start time</th>
      <th scope="col"> End time</th>
      <th scope="col">  Number of question </th>
      <th scope="col">  Mark per que </th>
      <th scope="col"> Exam Duration </th>
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
 
var filename="exams.php";
var report_name="Scheme Report";
  $('#dtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
       "searching":true,
        "ajax": "../db/datatable/"+filename,
        
        
      'columns': [
         {"data": "exam_id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }},{ data: 'subject_name' },
    { data: 'exam_name' },
    { data: 'exam_date' },
    { data: 'start_time' },
    { data: 'end_time' },
    { data: 'number_of_que' },
    { data: 'mark_per_que' },
    { data: 'exam_duration' },
         { data: 'edit' },
         { data: 'delete' }
      ]
    });

function loadsubject(){
    $.getJSON("../db/json/subjects.php",function(data){
        $("#subject_name").empty();
        $("#subject_name").append("<option value=''>Select </option>");
            $.each(data,function(key,val) {
                $("#subject_name").append("<option value='" + val.id+ "'>" + val.name + "</option>");
             });
    }); 
  }
  loadsubject();

  $(document).on("click", '#btnEdit', function() {
       $("#saveType").val("2");
        $("#exam_id").val($(this).attr("data-exam_id"));
        $("#subject_name").val($(this).attr("data-sub_id"));
        $("#exam_name").val($(this).attr("data-exam_name"));
        $("#exam_date").val($(this).attr("data-exam_date"));
        $("#start_time").val($(this).attr("data-start_time"));
        $("#end_time").val($(this).attr("data-end_time"));
        $("#number_of_que").val($(this).attr("date-number_of_que"));
        $("#mark_per_que").val($(this).attr("data-mark_per_que"));
        $("#exam_duration").val($(this).attr("data-exam_duration"));
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
      $("#sub_id").val("");
              $("#exam_name").val("");
               $("#exam_date").val("");
              $("#start_time").val("");
               $("#end_time").val("");
              $("#number_of_que").val("");
               $("#mark_per_que").val("");
              $("#exam_duration").val("");
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