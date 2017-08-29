<?php
	session_start();
	$stu_id = $_POST['student_id'];
	$stu_pass = md5($_POST['student_password']);
	include 'database_connection.php';
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	//Inserting login and logout time
	$add_login_time_query = 'Update STUDENTS set LOGIN_AT=now(),LOGOUT_AT=ADDTIME(now(), "03:00:00") where STU_ID="'.$stu_id.'" and STU_PASSWORD="'.$stu_pass.'"';
	$selection_query =  'Select STU_FIRST_NAME,STU_ID,STU_SEM,STU_DEPARTMENT,LOGOUT_AT from STUDENTS where STU_ID="'.$stu_id.'" and STU_PASSWORD= "'.$stu_pass.'"';
	$login_time = mysqli_query($con , $add_login_time_query);
	//Create sessions for furthur info
	if ($login_time) {
		$result = mysqli_query($con , $selection_query);
		if($result && mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['stu_first_name'] = $row['STU_FIRST_NAME'];
			$_SESSION['stu_id'] = $row['STU_ID'];
			$_SESSION['logout_time'] = $row['LOGOUT_AT'];
			$_SESSION['stu_sem'] = $row['STU_SEM'];
			$_SESSION['stu_department'] = $row['STU_DEPARTMENT'];
			header("Location: /Online_examination/student_profile.php");
		}	
	}else {
		$error = 'error';
		header("Location: /Online_examination/index.php?error=$error");
	}
	$connection->closeConnection($con);
?>
