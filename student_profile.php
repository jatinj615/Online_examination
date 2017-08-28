<?php 
	session_start();
	if(isset($_SESSION['stu_id']) && isset($_SESSION['stu_first_name'])){
		echo $_SESSION['stu_first_name'];	
	} else{
		header("Location: /Online_examination/index.php");
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Online Examination</title>
 </head>
 <body>
 	<form action="php_controllers/select_question_paper.php" method="GET">
 		Subject : <input type="text" name="subject">
 		Year    : <input type="text" name="year">
 		<input type="submit" name="submit_subject" value="Next">
 	</form>
	<a href="php_controllers/student_logout.php">Log Out</a>
 </body>
 </html>