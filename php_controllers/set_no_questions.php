<?php 
	session_start();
	$department = $_SESSION['department'];
	include 'database_connection.php';
	$sem = $_GET['semester'];
	$no_of_questions = $_GET['questions'];
	$subject = $_GET['subject'];
	$year = $_GET['year'];
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	$result = mysqli_query($con, 'Insert into QUESTIONS_AMOUNT (NO_OF_QUES,DEPARTMENT,SEMESTER,SUBJECT) values('.$no_of_questions.',"'.$department.'",'.$sem.',"'.$subject.'")');
	if ($result) {
		$_SESSION['subject'] = $subject;
		$_SESSION['questions'] = $no_of_questions;
		$_SESSION['semester'] = $sem;
		$_SESSION['year'] = $year;
		header("Location: /Online_examination/department_panel.php?questions=$no_of_questions");
	}else{
		echo "string";
	}
	$connection->closeConnection($con);
?>