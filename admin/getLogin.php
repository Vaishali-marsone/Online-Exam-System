<?php 
    include("../db/db.php"); 

	$email = trim($_REQUEST['email']);
	$password = trim($_REQUEST['password']);

    $sql = "SELECT `admin_id`, `admin_name`, `admin_email` FROM `admin` where admin_email='$email' and admin_password='$password'";
	$res = mysqli_query($con,$sql);
	
	$result = array();
	
	if(mysqli_num_rows($res) > 0){
	
		session_start();
		while($row = mysqli_fetch_array($res)){
			$_SESSION['admin_id'] = $row['admin_id'];
			$_SESSION['first_name'] = $row['admin_name'];
			$_SESSION['user_type'] = "admin";
			header('Location: index.php'); 
		}
	
	}
	else{
		array_push($result,array('data'=>'not found'));
		$_SESSION['admin_id'] = "";
		$_SESSION['first_name']="";
		$_SESSION['user_type'] = "";
		header('Location: login.php?msg=1');
		
	}

	
    mysqli_close($con);
    
?>