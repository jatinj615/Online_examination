<?php 
	session_start();
	include 'php_controllers/database_connection.php';
	if (isset($_SESSION['no_of_questions']) && isset($_GET['question'])) {
		$question_no = $_GET['question'];
		$max_question = $_SESSION['no_of_questions'];
		$year = $_SESSION['year'];
		$sem = $_SESSION['stu_sem'];
		$department = $_SESSION['stu_department'];
		$subject = $_SESSION['subject'];
		$connection = new DatabaseConnect();
		$con = $connection->connect();
		$query = 'Select QUESTION,OPTION_1,OPTION_2,OPTION_3,OPTION_4 from QUESTION_PAPER where YEAR='.$year.' and SEMESTER='.$sem.' and DEPARTMENT="'.$department.'" and SUBJECT="'.$subject.'" and QUES_NO='.$question_no.'';
		$result = mysqli_query($con , $query);
		if($result && mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Online Examination</title>
</head>
<body>
<div>
	<ul>
 	<?php 
 		if(isset($_SESSION['no_of_questions'])){
 			$no_of_questions = $_SESSION['no_of_questions'];
 			for($i = 1 ; $i <= $no_of_questions ; $i++ ){
 	?>
 		<a href="question_paper.php?question=<?php echo $i; ?>">
		<li>Question <?php echo $i; ?></li>
		</a>
 	<?php		
 			}
 		}
 	 ?>
 	 </ul>
	Question <?php echo $question_no; ?> : <?php echo $row['QUESTION']; ?>
	options<br>
	<form action="#">
	1.<input type="radio" name="answer" value="<?php echo $row['OPTION_1']; ?>">
		<?php echo $row['OPTION_1']; ?><br>
	2.<input type="radio" name="answer" value="<?php echo $row['OPTION_2']; ?>">
		<?php echo $row['OPTION_2']; ?><br>
	3.<input type="radio" name="answer" value="<?php echo $row['OPTION_3']; ?>">
		<?php echo $row['OPTION_3']; ?><br>
	4.<input type="radio" name="answer" value="<?php echo $row['OPTION_4']; ?>">
		<?php echo $row['OPTION_4']; ?><br>
	</form>
</div>		
<?php 
		}
	if ($question_no == 1) {
	?>
		<a href="question_paper.php?question=<?php echo $question_no+1; ?>">Next</a>
<?php
	}elseif ($question_no == $max_question) {
		?>
		<a href="question_paper.php?question=<?php echo $question_no-1; ?>">Previous</a>
		<a href="show_result.php">Submit</a>
<?php 
	}else {
		?>
	<a href="question_paper.php?question=<?php echo $question_no-1 ?>">Previous</a>
	<a href="question_paper.php?question=<?php echo $question_no+1 ?>">Next</a>	
<?php	
	}
}else{
	header("Location: student_profile.php");
}
 ?>

	
</body>
</html>