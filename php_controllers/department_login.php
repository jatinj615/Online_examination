<?php  
	include 'database_connection.php';
	session_start();
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	$admin = mysqli_real_escape_string($con,$_POST['department_name']);
	$admin_pass = mysqli_real_escape_string($con,$_POST['department_pass']);
	$result = mysqli_query($con , 'Select DEPARTMENT_ADMIN,DEPARTMENT_NAME from DEPARTMENTS where DEPARTMENT_NAME="'.$admin.'" and DEPARTMENT_PASS= "'.$admin_pass.'"');
	if( $result && mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		$_SESSION['admin'] = $row['DEPARTMENT_ADMIN'];
		$_SESSION['department'] = $row['DEPARTMENT_NAME'];
		header("Location: /Online_examination/department_panel.php");
	}else{
		$error = 'error';
		header("Location: /Online_examination/index.php?error=$error");
	}
	$connection->closeConnection($con);
?>