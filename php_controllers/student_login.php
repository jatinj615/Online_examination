<?php 
	session_start();
	$stu_id = $_POST['student_id'];
	$stu_pass = md5($_POST['student_password']);
	include 'database_connection.php';
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	$result = mysqli_query($con , 'Select STU_FIRST_NAME,STU_ID from STUDENTS where STU_ID="'.$stu_id.'" and STU_PASSWORD= "'.$stu_pass.'"');
	if($result && mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		echo $_SESSION['stu_first_name'] = $row['STU_FIRST_NAME'];
		echo $_SESSION['stu_id'] = $row['STU_ID'];
		header("Location: /Online_examination/student_profile.php");	
	}else {
		$error = 'error';
		header("Location: /Online_examination/index.php?error=$error");
	}
	$connection->closeConnection($con);
?>