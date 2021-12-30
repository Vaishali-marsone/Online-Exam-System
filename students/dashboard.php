<?php
include("../db/db.php");
include ("header.php");
$exam_id="";
$remaining_minutes="";
$exam_date = "";
$start_time = "";
$duration = "";
//$sql="SELECT exam_id FROM student_attendance
//				WHERE stud_id='".$_SESSION['stud_id']."' ORDER BY exam_id ASC LIMIT 1"

	$exam_id = 1;
	$sql = "SELECT exam_date, start_time, exam_duration FROM exams 
	WHERE exam_id = $exam_id ";

	$res = mysqli_query($con,$sql);
    $result = array();
            
     $row=mysqli_fetch_array($res);

            $result[] = array(
           
		//$exam_status = $row['online_exam_status'];
		$start_time = $row['start_time'],
		$exam_date = $row['exam_date'],
		$duration = $row['exam_duration']);

        foreach ($result as $row) 
        {
        	echo $exam_date ." ";
        	echo $start_time." ";
        	echo $duration ;
        $a = $exam_date.' '.$start_time;
        #echo $a;
        $end_time = strtotime($a.'+'.$duration);

		$end_time = date('Y-m-d H:i:s', $end_time);
		#echo $end_time;
		$remaining_minutes = strtotime($end_time) - time();
        echo $remaining_minutes;
        }
	

?>

<div class="row">
	<div class="col-md-8"> </div>
	<div class="col-md-4">
		<div id="exam_timer" date-timer="<?php echo $remaining_minutes; ?>" style="max-width: 400px; width: 100%; height: 200px;"></div>
	</div>
		
	</div>
</div>
	<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">Online Exam</div>
			<div class="card-body">
				<div id="single_question_area"></div>
			</div>
		</div>
		<br />
		<div id="question_navigation_area"></div>
	</div>
	
</div>

  
<script type="text/javascript">

$(document).ready(function(){
	var exam_id = 1;
    load_question();
	question_navigation();

	function load_question(question_id = '')
	{
		$.ajax({
			url:"load_questions.php",
			method:"POST",
			data:{exam_id:exam_id, question_id:question_id, page:'dashboard', action:'load_question'},
			success:function(data)
			{
				$('#single_question_area').html(data);
			}
		})
	}

	$(document).on('click', '.next', function(){
		var question_id = $(this).attr('id');
		
		load_question(question_id);

	});

	$(document).on('click', '.previous', function(){
		var question_id = $(this).attr('id');
		load_question(question_id);
	});

	function question_navigation()
	{
		$.ajax({
			url:"load_questions.php",
			method:"POST",
			data:{exam_id:exam_id, page:'dashboard', action:'question_navigation'},
			success:function(data)
			{
				$('#question_navigation_area').html(data);
			}
		})
	}

	$(document).on('click', '.question_navigation', function(){
		var question_id = $(this).data('question_id');
		load_question(question_id);
	});

	$("#exam_timer").TimeCircles({ 
		time:{
			Days:{
				show: false
			},
			Hours:{
				show: false
			}
		}
	});

	setInterval(function(){
		var remaining_second = $("#exam_timer").TimeCircles().getTime();
		if(remaining_second > 1)
		{
			//alert('Exam time over');
			//location.reload();
		}
	}, 1000);


	


	$(document).on('click', '.answer', function(){


		$("#submit").click(function(e) {
          e.preventDefault();
          var form=$('form').serialize();
          saveData(form,"load_questions.php");
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

   



		var question_id = $(this).data('question_id');

		var answer = $(this).data('id');

		$.ajax({
			url:"load_questions.php",
			method:"POST",
			data:{question_id:question_id, answer:answer, exam_id:exam_id, page:'dashboard', action:'answer'},
			success:function(data)
			{
             $('#answer').html(data);
			}
		})
	});

});

</script>
<?php
include "footer.php";
?>

