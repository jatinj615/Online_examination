<?php 
	session_start();
	include 'database_connection.php';
	if(isset($_GET['question_no'])){
		$question_no = $_GET['question_no'];
		if (isset($_POST['answer'])) {
			$last_question_no = $_SESSION['no_of_questions'];
			$marks = 0;
			$answer_given = $_POST['answer'];
			$stu_id = $_SESSION['stu_id'];
			$stu_sem = $_SESSION['stu_sem'];
			$year = $_SESSION['year'];
			$department = $_SESSION['stu_department'];
			$subject = $_SESSION['subject'];
			$connection = new DatabaseConnect();
			$con = $connection->connect();
			$query = 'Select CORRECT_OPTION from QUESTION_PAPER where YEAR='.$year.' and QUES_NO='.$question_no.' and DEPARTMENT="'.$department.'" and SUBJECT="'.$subject.'" and SEMESTER='.$stu_sem;
			$result = mysqli_query($con , $query);
			if($result && mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$correct_ans = $row['CORRECT_OPTION'];
				if ($answer_given == $correct_ans) {
					$marks = 3;
				}else{
					$marks = -1;
				}
				$query_1 = 'Update SUBMITTED_ANSWERS set ANSWER_GIVEN="'.$answer_given.'", MARKS_OBTAINED='.$marks.' where STU_ID="'.$stu_id.'" and STU_DEPARTMENT="'.$department.'" and STU_SEM='.$stu_sem.' and SUBJECT="'.$subject.'" and YEAR='.$year.' and QUESTION_NO='.$question_no;
				$insert_marks = mysqli_query($con, $query_1);
				if ($insert_marks) {
					if($question_no < $last_question_no){
						$question_no++;
						header("Location: /Online_examination/question_paper.php?question=$question_no");
					}elseif ($question_no == $last_question_no) {
						header("Location: /Online_examination/question_paper.php?question=$question_no");
					}
				}
			}
		}else{
			$question_no++;
			header("Location: /Online_examination/question_paper.php?question=$question_no");
		}
	}else{
		echo "error";
	}
	$connection->closeConnection($con);
?>