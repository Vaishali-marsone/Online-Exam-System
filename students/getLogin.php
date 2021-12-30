<?php 
    include("../db/db.php"); 

	$email = trim($_REQUEST['email']);
	$password = trim($_REQUEST['password']);

    $sql = "SELECT `stud_id`, `stud_name`, `email`,`contact_no`,`dob` FROM `students` where email='$email' and password='$password'";
	$res = mysqli_query($con,$sql);
	
	$result = array();
	
	if(mysqli_num_rows($res) > 0){
	
		session_start();
		while($row = mysqli_fetch_array($res)){
			$_SESSION['stud_id'] = $row['stud_id'];
			$_SESSION['stud_name'] = $row['stud_name'];
			$_SESSION['contact_no'] = $row['contact_no'];
			$_SESSION['dob'] = $row['dob'];
			$_SESSION['user_type'] = "user";
			header('Location: index.php'); 
		}
	
	}
	else{
		array_push($result,array('data'=>'not found'));
		$_SESSION['stud_id'] = "";
		$_SESSION['stud_name']="";
		$_SESSION['contact_no']="";
		$_SESSION['dob']="";
		$_SESSION['user_type'] = "";
		header('Location: login.php?msg=1');
		
	}

	
    mysqli_close($con);
    
?>