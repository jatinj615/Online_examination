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
 	<a href="php_controllers/student_logout.php">Log Out</a>
 </body>
 </html>