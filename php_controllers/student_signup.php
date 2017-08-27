<?php  
	include 'database_connection.php';
	session_start();
	$stu_first_name = $_POST['student_first_name'];
	$stu_last_name = $_POST['student_last_name'];
	$stu_id = $_POST['student_id'];
	$stu_sem = $_POST['student_sem'];
	$student_branch = $_POST['student_branch'];
	$stu_password = md5($_POST['password']);
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	$query = 'Insert into STUDENTS (STU_ID,STU_SEM,STU_DEPARTMENT,STU_FIRST_NAME,STU_LAST_NAME,STU_PASSWORD) values ("'.$stu_id.'",'.$stu_sem.',"'.$student_branch.'","'.$stu_first_name.'","'.$stu_last_name.'","'.$stu_password.'")';
	$result = mysqli_query($con , $query);
	if($result){
		header("Location: /Online_examination/department_panel.php");
	}else{
		echo "error";
	}
	$connection->closeConnection($con);
?>