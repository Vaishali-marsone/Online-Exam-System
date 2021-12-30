<?php include("header.php"); ?>

<div class="bg-white" style="padding:10px; text-align: center;">
<h4 class="text-muted my-3">
Welcome in Online Exam System
</h4>
</div>
<div style="background-color:#f2dac4; width:1100px; height:350px;"  >
<p >
	<ul>
		<li>
	You have 120 minute to complete the test.

</li>
<li>
	The text contains a total of 50 questions.
</li>
<li>
	There is only one correct answer to each question.click on the most appropriate option to mark is as your answer.
</li>
<li>
	You will be awarded 1 for each correct answer.
	</li>
	<li>
	You can change your answer by clicking on some other option.
	</li>
	<li>
	You can move back and forth between the question by clicking the buttons "previous" and "Next" respectively.
	</li>
	<li>
	You can use rough sheet while taking the test. do not use calculators,log tables ,dictionaries or any other printed / online reference material during the test.
	</li>
	<li>
	Do not click the button "Submit Test"  before complecting the test.A test once sumitted can not be resumed.</li>
</ul>
</p>
<form action="dashboard.php">
<input type="hidden" value="0" name="exam_id"id="exam_id" >
<input type="hidden" value="1" name="quesno"id="quesno" >
<input type="Checkbox" id="exam" name="exam" value="online exam" required>
<label for=exam style="color:red"; >I have read and understand the instructions. I agree that in case of not adhering to the exam instructions,I will be disqualified from giving the exam.</label>

</div>
<div class="container">
 <div class="modal-footer">
     
     <a href="dashboard.php"><button type="submit" id="submit" class="btn btn-primary">Start Exam</button></a>
 </div>
</div>
</form>

<script >
$(document).ready(function() {
   $.getJSON("load_exam.php",function(data){
        $("#exam_id").val(data);
      
    });
});
</script>


<?php include("footer.php"); ?>