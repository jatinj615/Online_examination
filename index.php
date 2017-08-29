<?php 
	if (isset($_GET['error']) && $_GET['error']=='error') {
		echo "<script type=\"text/javascript\">window.alert('Login Id Or Password Is Incorrect...')</script>";
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Online Examination</title>
</head>
<body>
	<!-- Student Login Panel -->
	<div class="stu_sign_in">
		<form name="sign_in" action="php_controllers/student_login.php" method="POST">
			Student Id : <input type="text" name="student_id"><br>
			Password   : <input type="password" name="student_password"><br>
			<input type="submit" name="Login" value="Sign In">
		</form>
	</div>
	<br><br>
	<!-- Department Login Panel -->
	<div class="admin_sign_in">
		<form name="admin_login" action="php_controllers/department_login.php" method="POST">
			Department : <input type="text" name="department_name">
			Password   : <input type="password" name="department_pass">
			<input type="submit" name="submit" value="SIgn In">
		</form>
	</div>
</body>
</html>