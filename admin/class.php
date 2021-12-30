<?php include("header.php"); ?>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
    
          <h4 class="modal-title">Add/Update Class</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


        <form id="" method="post" action="">
            <input type="hidden"  name="saveType" id="saveType" value="1">
            <input type="hidden"  name="id" id="id" value="">

              <div class="form-group">
                <label for="name"> Name </label>
                <textarea id="name" name="name" class="form-control" aria-describedby="name"></textarea>
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

 <h5 class="card-title">Class </h5>
<button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#myModal">Add</button>
</div>

<div class="table-responsive">
<table class="table table-bordered" id="dtable">
  <thead  >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
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
 

  $('#dtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
       
        "ajax": "../db/datatable/Class.php",
        dom: 'lBfrtip',
        buttons: [
           {
                    extend: 'csv',
                    text:      '<i class="fa fa-file-text-o"></i>',
                    title: 'Class Report',
                    exportOptions: {
                      columns: [ 0, 1]
                    }
                },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                title: 'Class Report',
                exportOptions: {
                    columns: [ 0, 1]
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                title: 'Class Report',
                exportOptions: {
                  columns: [ 0, 1]
                }
            },
            {
                extend: 'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                title: 'Class Report',
                exportOptions: {
                    columns: [ 0, 1 ]
                },
                customize : function(doc) {
                   doc.content[1].table.widths = [ '45%', '45%'];
                }
            }
        ],
      'columns': [
         {"data": "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }},{ data: 'name' },
         { data: 'edit' },
         { data: 'delete' }
      ]
    });

    
    $("#reset").click(function(e) {
      e.preventDefault();
              $("#name").val("");
              $("#id").val("");
              $("#saveType").val("1");
    });
 

  function refreshData(){
    $('#dtable').DataTable().ajax.reload();
  
  }
  $(document).on("click", '#btnEdit', function() {
       $("#saveType").val("2");
        $("#id").val($(this).attr("data-id"));
        $("#name").val($(this).attr("data-name"));
        $('#myModal').modal('show');
    });

    $("#submit").click(function(e) {
          e.preventDefault();
          var form=$('form').serialize();
          saveData(form,'../db/save/Class.php');
     });
    $(document).on("click", '#btnDelete', function() {
          var jid=$(this).attr("data-id");
          deleteData(jid,'../db/delete/Class.php')
     });
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
                  data: {id:did},
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