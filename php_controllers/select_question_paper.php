<?php
	session_start();
	include 'database_connection.php';
	$subject = $_GET['subject'];
	$year = $_GET['year'];
	$sem = $_SESSION['stu_sem'];
	$department = $_SESSION['stu_department'];
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	$query = 'Select QUES_NO,QUESTION,OPTION_1,OPTION_2,OPTION_3,OPTION_4 from QUESTION_PAPER where YEAR='.$year.' AND DEPARTMENT="'.$department.'" AND SEMESTER='.$sem.' AND SUBJECT="'.$subject.'"';
	$result = mysqli_query($con , $query);
	if($result && mysqli_num_rows($result) > 0 ){
		$no_of_questions = mysqli_num_rows($result);
		$_SESSION['subject'] = $subject;
		$_SESSION['year'] = $year;
		$_SESSION['no_of_questions'] = $no_of_questions;
		header("Location: /Online_examination/question_paper.php?question=1");
	}else{
		echo "<script>window.alert('Provied year or subject is no correct..')</script>";
		header("Location: /Online_examination/student_profile.php");
	}
	$connection->closeConnection($con);
?>
