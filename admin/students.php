<?php include("header.php"); ?>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Add/Update Students</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


        <form id="" method="post" action="">
            <input type="hidden"  name="saveType" id="saveType" value="1">
            <input type="hidden"  name="stud_id" id="stud_id" value="">

              <div class="form-group">
                <label for="stud_name"> Student Name </label>
                <input id="stud_name" name="stud_name" class="form-control" aria-describedby="stud_name">
              </div>
  
  <div class="form-group">
                <label for="password"> Password </label>
                <input type="password" id="password" name="password" class="form-control" aria-describedby="password">
              </div>
  
  <div class="form-group">
                <label for="email"> Email </label>
                <input type="text" id="email" name="email" class="form-control" aria-describedby="email">
              </div>
  
  <div class="form-group">
                <label for="dob"> DOB </label>
                <input type="date" id="dob" name="dob" class="form-control" aria-describedby="dob">
              </div>
  
  <div class="form-group">
                <label for="contact"> Contact NO </label>
                <input type="number" id="contact" name="contact" class="form-control" aria-describedby="contact">
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

 <h5 class="card-title">Students </h5>
<button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#myModal">Add</button>
</div>

<div class="table-responsive">
<table class="table table-bordered" id="dtable">
  <thead  >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student Name</th>
      <th scope="col">Password</th>
      <th scope="col">Email</th>
      <th scope="col">DOB</th>
      <th scope="col">contact</th>
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
 
var filename="students.php";
var report_name="Scheme Report";
  $('#dtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
       "searching":false,
        "ajax": "../db/datatable/"+filename,
        
        
      'columns': [
         {"data": "stud_id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }},
    { data: 'stud_name' },
    { data: 'password' },
    { data: 'email' },
    { data: 'dob' },
    { data: 'contact' },
         { data: 'edit' },
         { data: 'delete' }
      ]
    });

  $(document).on("click", '#btnEdit', function() {
       $("#saveType").val("6");
        $("#stud_id").val($(this).attr("data-stud_id"));
        $("#stud_name").val($(this).attr("data-stud_name"));
        $("#password").val($(this).attr("data-password"));
        $("#email").val($(this).attr("data-email"));
        $("#dob").val($(this).attr("data-dob"));
        $("#contact").val($(this).attr("data-contact"));
        $('#myModal').modal('show');
    });

    $("#submit").click(function(e) {
          e.preventDefault();
          var form=$('form').serialize();
          saveData(form,'../db/save/'+filename);
     });

     $("#reset").click(function(e) {
      e.preventDefault();
       $("#stud_id").val("")
              $("#stud_name").val("");
              $("#password").val("");
               $("#email").val("");
              $("#dob").val("");
               $("#contact").val("");
              $("#saveType").val("1");
    });
    $(document).on("click", '#btnDelete', function() {
          var jid=$(this).attr("data-stud_id");
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
                  data: {stud_id:did},
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