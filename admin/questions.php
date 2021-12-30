<?php include("header.php"); ?>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Add/Update Questions</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


        <form id="" method="post" action="">
            <input type="hidden"  name="saveType" id="saveType" value="1">
            <input type="hidden"  name="question_id" id="question_id" value="">

 <div class="form-group">
                    <label for="exam_name"> Exam Name</label>
                    <select id="exam_name" name="exam_name" class="form-control" aria-describedby="exam_name"></select>
                  </div>
           

              <div class="form-group">
                <label for="question"> Question </label>
                <input type="text" id="question" name="question" class="form-control" aria-describedby="question">
              </div>

  <div class="form-group">
                <label for="A"> A </label>
                <input id="A" name="A" class="form-control" aria-describedby="A">
              </div>

  <div class="form-group">
                <label for="B"> B </label>
                <input id="B" name="B" class="form-control" aria-describedby="B">
              </div>

  <div class="form-group">
                <label for="C"> C </label>
                <input id="C" name="C" class="form-control" aria-describedby="C">
              </div>

  <div class="form-group">
                <label for="D"> D </label>
                <input id="D" name="D" class="form-control" aria-describedby="D">
              </div>

  <div class="form-group">
                <label for="answer"> Answer </label>
                <input id="answer" name="answer" class="form-control" aria-describedby="answer">
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

 <h5 class="card-title">Exam Question </h5>
<button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#myModal">Add</button>
</div>

<div class="table-responsive">
<table class="table table-bordered" id="dtable">
  <thead  >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Exam name</th>
      <th scope="col">Question</th>
      <th scope="col">A</th>
      <th scope="col">B</th>
      <th scope="col">C</th>
      <th scope="col">D</th>
      <th scope="col">Answer</th>
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
 
var filename="questions.php";
var report_name="Scheme Report";
  $('#dtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
       "searching":false,
        "ajax": "../db/datatable/"+filename,
        
        
      'columns': [
         {"data": "question_id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }},{ data: 'exam_name' },
    { data: 'question' },
    { data: 'A' },
    { data: 'B' },
    { data: 'C' },
    { data: 'D' },
    { data: 'answer' },
         { data: 'edit' },
         { data: 'delete' }
      ]
    });

  function loadexam(){
    $.getJSON("../db/json/exams.php",function(data){
        $("#exam_name").empty();
        $("#exam_name").append("<option value=''>Select </option>");
            $.each(data,function(key,val) {
                $("#exam_name").append("<option value='" + val.exam_id+ "'>" + val.exam_name + "</option>");
             });
    }); 
  }
  loadexam();

  $(document).on("click", '#btnEdit', function() {
       $("#saveType").val("2");
        $("#question_id").val($(this).attr("data-question_id"));
        //$("#exam_id").val($(this).attr("data-exam_id"));
        $("#exam_name").val($(this).attr("data-exam_id"));
        $("#question").val($(this).attr("data-question"));
        $("#A").val($(this).attr("data-A"));
        $("#B").val($(this).attr("data-B"));
        $("#C").val($(this).attr("data-C"));
        $("#D").val($(this).attr("data-D"));
        $("#answer").val($(this).attr("data-answer"));
        $('#myModal').modal('show');
    });

    $("#submit").click(function(e) {
          e.preventDefault();
          var form=$('form').serialize();
          saveData(form,'../db/save/'+filename);
     });

     $("#reset").click(function(e) {
      e.preventDefault();
              $("#question_id").val("");
              $("#exam_id").val("");
               $("#question").val("");
                $("#A").val("");
                 $("#B").val("");
                  $("#C").val("");
                   $("#D").val("");
                    $("#answer").val("");
              $("#saveType").val("1");
    });
    $(document).on("click", '#btnDelete', function() {
          var jid=$(this).attr("data-question_id");
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
                  data: {question_id:did},
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