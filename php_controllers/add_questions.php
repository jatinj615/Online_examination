<?php 
	session_start();
	include 'database_connection.php';
	$counter = 0 ;
	$no_of_questions = $_SESSION['questions'];
	$subject = $_SESSION['subject'];
	$sem = $_SESSION['semester'];
	$year =	$_SESSION['year'];
	$department = $_SESSION['department'];
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	for ($i = 1 ; $i <= $no_of_questions ; $i++) { 
		$question_no = $_GET['ques_no'.$i.''];
		$question = $_GET['ques'.$i.''];
		$option_1 = $_GET['option_'.$i.'1'];
		$option_2 = $_GET['option_'.$i.'2'];
		$option_3 = $_GET['option_'.$i.'3'];
		$option_4 = $_GET['option_'.$i.'4'];
		$correct_ans = $_GET['correct_ans'.$i.''];
		echo $query = 'Insert into QUESTION_PAPER (YEAR,QUES_NO,DEPARTMENT,SUBJECT,SEMESTER,QUESTION,OPTION_1,OPTION_2,OPTION_3,OPTION_4,CORRECT_OPTION) values ('.$year.','.$question_no.',"'.$department.'","'.$subject.'",'.$sem.',"'.$question.'","'.$option_1.'","'.$option_2.'","'.$option_3.'","'.$option_4.'","'.$correct_ans.'")';
		$result = mysqli_query($con, $query);
		if($result){
			$counter++;
		}
	}
	if($counter == $no_of_questions){
		unset($_SESSION['questions']);
		unset($_SESSION['subject']);
		unset($_SESSION['semester']);
		unset($_SESSION['year']);
		header("Location: /Online_examination/department_panel.php");
	}else{
		echo "error";
	}
?>