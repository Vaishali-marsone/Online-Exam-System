<?php include("header.php"); ?>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Add/Update Result</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
       <form id="" method="post" action="">
            <input type="hidden"  name="saveType" id="saveType" value="1">
            <input type="hidden"  name="result_id" id="result_id" value="">

              <div class="form-group">
                <label for="stud_id"> Student Id </label>
                <input id="stud_id" name="stud_id" class="form-control" aria-describedby="stud_id">
              </div>

              <div class="form-group">
                <label for="exam_id"> Exam Id </label>
                <input id="exam_id" name="exam_id" class="form-control" aria-describedby="exam_id">
              </div>

              <div class="form-group">
                <label for="result">  Result </label>
                <input id="result" name="result" class="form-control" aria-describedby="total_mark">
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

 <h5 class="card-title">Result </h5>
<button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#myModal">Add</button>
</div>

<div class="table-responsive">
<table class="table table-bordered" id="dtable">
  <thead  >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student Id</th>
       <th scope="col">Exam Id</th>
        <th scope="col"> Result</th>
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
 
var filename="result.php";
var report_name="Scheme Report";
  $('#dtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order" : [],
        'serverMethod': 'post',
       "searching":false,
        "ajax": "../db/datatable/"+filename,
        
        
      'columns': [
         {"data": "result_id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }},{ data: 'stud_id' },
    { data: 'exam_id' },
    { data: 'result' },
         { data: 'edit' },
         { data: 'delete' }
      ]
    });

  $(document).on("click", '#btnEdit', function() {
       $("#saveType").val("2");
        $("#result_id").val($(this).attr("data-result_id"));
        $("#stud_id").val($(this).attr("data-stud_id"));
         $("#exam_id").val($(this).attr("data-exam_id"));
          $("#result").val($(this).attr("data-result"));
        $('#myModal').modal('show');
    });

    $("#submit").click(function(e) {
          e.preventDefault();
          var form=$('form').serialize();
          saveData(form,'../db/save/'+filename);
     });

     $("#reset").click(function(e) {
      e.preventDefault();
              $("#stud_id").val("");
               $("#exam_id").val("");
                $("#result").val("");
              $("#result_id").val("");
              $("#saveType").val("1");
    });
    $(document).on("click", '#btnDelete', function() {
          var jid=$(this).attr("data-result_id");
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
                  data: {result_id:did},
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