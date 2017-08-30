<?php 
	session_start();
	if(isset($_SESSION['stu_id']) && isset($_SESSION['stu_first_name'])){
		if(isset($_SESSION['marks_obtained']) && isset($_SESSION['no_of_questions'])){
			$marks_obtained = $_SESSION['marks_obtained'];
			$no_of_questions = $_SESSION['no_of_questions'];
			$max_marks = $no_of_questions*3;
			echo "Marks obtained : ".$marks_obtained."/".$max_marks;
		}else{
			header("Location: student_profile.php");
		}
	}else{
		header("Location: index.php");
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Online Examination</title>
 </head>
 <body>
 	<a href="php_controllers/student_logout.php">OK</a>
 </body>
 </html>