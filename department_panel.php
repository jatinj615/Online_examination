<?php 
	session_start();
	if ( isset($_SESSION['admin']) && isset($_SESSION['department'])) {
		echo "Welcome".$_SESSION['admin'];
	} else {
		header("Location: /Online_examination/");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Online Examination</title>
</head>
<body>
	Student register
	<div class="stu_register">
		<form name="sign_up" action="php_controllers/student_signup.php" method="POST">
			First Name : <input type="text" name="student_first_name"><br>
			Last Name  : <input type="text" name="student_last_name"><br>
			Student Id : <input type="text" name="student_id"><br>
			Semester   : <input type="text" name="student_sem"><br>
			Branch     : <input type="text" name="student_branch"><br>
			Password(DOB)   : <input type="password" name="password"><br>
			Confirm Password(DOB) : <input type="password" name="confirm_password"><br>
			<input type="submit" name="sign_up" value="Sign Up">
		</form>
	</div>
	<br><br>
	input questions
	<div class="no_of_questions">
		<form action="php_controllers/set_no_questions.php" method="GET">
			Year : <input type="text" name="year"><br>
			Semester : <input type="text" name="semester"><br>
			Subject : <input type="text" name="subject"><br>
			No. of Questions : <input type="text" name="questions"><br>
			<input type="submit" value="Set">
		</form>
	</div>
	<br><br>
	<div class="add_questions">
		Add Questions
		<form action="php_controllers/add_questions.php" method="GET">
		<?php if(isset($_GET['questions'])){
				for($count = 1 ; $count <= $_GET['questions'] ; $count++) {
		?>
			Question No. : <input type="text" name="ques_no<?php echo $count; ?>"  value="<?php echo $count ?>"><br>
			<!--text area at place of input tag-->
			Question     : <textarea name="ques<?php echo $count; ?>" rows="5" cols="50"></textarea><br>
			Options<br>
			1    : <input type="text" name="option_<?php echo $count; ?>1"><br>
			2    : <input type="text" name="option_<?php echo $count; ?>2"><br>
			3    : <input type="text" name="option_<?php echo $count; ?>3"><br>
			4    : <input type="text" name="option_<?php echo $count; ?>4"><br>
			Correct Answer : <input type="text" name="correct_ans<?php echo $count; ?>"><br>
		<?php } 
		}?>
			<input type="submit" value="Next">
		</form>
	</div>
	<div>
		<a href="php_controllers/department_logout.php">Log Out</a>
	</div>
</body>
</html>