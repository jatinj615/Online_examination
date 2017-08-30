<?php 
	session_start();
	if(isset($_SESSION['stu_id']) && isset($_SESSION['stu_first_name'])){
		echo 'Welcome '.$_SESSION['stu_first_name'];	
		include 'php_controllers/database_connection.php';
		if (isset($_SESSION['no_of_questions']) && isset($_GET['question'])) {
			$stu_id = $_SESSION['stu_id'];
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
				$query_2 = 'Select ANSWER_GIVEN from SUBMITTED_ANSWERS where STU_ID="'.$stu_id.'" and STU_DEPARTMENT="'.$department.'" and STU_SEM='.$sem.' and SUBJECT="'.$subject.'" and YEAR='.$year.' and QUESTION_NO='.$question_no;
				$get_check = mysqli_query($con , $query_2);
				if ($get_check && mysqli_num_rows($get_check) == 1) {
					$check_value = mysqli_fetch_assoc($get_check);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Online Examination</title> 
	<script type="text/javascript">
 		var countDownDate = new Date("<?php echo $_SESSION['logout_time'] ?>").getTime();
 		var x = setInterval(function() {

		    // Get todays date and time
		    var now = new Date().getTime();
		    
		    // Find the distance between now an the count down date
		    var distance = countDownDate - now;
		    
		    // Time calculations for days, hours, minutes and seconds
		    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		    
		    // Output the result in an element with id="demo"
		    document.getElementById("demo").innerHTML =  hours + "h "
		    + minutes + "m " + seconds + "s ";
		    
		    // If the count down is over, write some text 
		    if (distance < 0) {
		        clearInterval(x);
		        document.getElementById("demo").innerHTML = "Time Up";
		    }
		}, 1000);
 	</script>
 	<?php 
 					if($check_value['ANSWER_GIVEN'] != null){
						$check_id = $check_value['ANSWER_GIVEN'];
 	 ?>
 	<script type="text/javascript">
 	function checkRadio(){
 		document.getElementById("<?php echo $check_id; ?>").checked = true;
 	}
 	</script>
 	<?php 
 					}
 				}
 	 ?>
</head>
<body onload="checkRadio()">
<p id="demo"></p>
<div>
	<ul>
	<!-- Get no of questions -->
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
 	 <!-- Show question paper to student -->
 	 </ul>
	Question <?php echo $question_no; ?> : <?php echo $row['QUESTION']; ?><br>
	options<br>
	<form action="php_controllers/submit_answer.php?question_no=<?php echo $question_no; ?>" method="POST">
	1.<input type="radio" name="answer" value="<?php echo $row['OPTION_1']; ?>" id="<?php echo $row['OPTION_1']; ?>">
		<?php echo $row['OPTION_1']; ?><br>
	2.<input type="radio" name="answer" value="<?php echo $row['OPTION_2']; ?>" id="<?php echo $row['OPTION_2']; ?>">
		<?php echo $row['OPTION_2']; ?><br>
	3.<input type="radio" name="answer" value="<?php echo $row['OPTION_3']; ?>" id="<?php echo $row['OPTION_3']; ?>">
		<?php echo $row['OPTION_3']; ?><br>
	4.<input type="radio" name="answer" value="<?php echo $row['OPTION_4']; ?>" id="<?php echo $row['OPTION_4']; ?>">
		<?php echo $row['OPTION_4']; ?><br>
				<?php 
					}
				if ($question_no == $max_question) {
				?>	
		<input type="submit" name="submit_answer" value="Submit">
				<?php
				}else {
					?>
		<input type="submit" name="submit_answer" value="Submit And Move To Next">	
	</form>
	<!-- Navigation for next or previous question -->
				<?php 
					}
				if ($question_no == 1) {
				?>
		<a href="question_paper.php?question=<?php echo $question_no+1; ?>">Next</a>
				<?php
					}elseif ($question_no == $max_question) {
						?>
		<a href="question_paper.php?question=<?php echo $question_no-1; ?>">Previous</a>
		<a href="php_controllers/show_result.php">Finish Exam</a>
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
	}else{
		header("Location: index.php");
	}
	$connection->closeConnection($con);
 ?>

</div>		
</body>
</html>