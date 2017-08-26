<?php  
	include 'database_connection.php';
	session_start();
	$admin = $_POST['department_name'];
	$admin_pass = $_POST['department_pass'];
	$connection = new DatabaseConnect();
	$con = $connection->connect();
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