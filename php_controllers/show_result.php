<?php 
	include 'database_connection.php';
	session_start();
	$connection = new DatabaseConnect();
	$con = $connection->connect();
	if(isset($_SESSION['stu_id']) && isset($_SESSION['stu_first_name'])){
		echo $_SESSION['stu_first_name'];
		$marks_obtained = 0;
		$stu_id = $_SESSION['stu_id'];
		$year = $_SESSION['year'];
		$sem = $_SESSION['stu_sem'];
		$department = $_SESSION['stu_department'];
		$subject = $_SESSION['subject'];
		$query = 'Select MARKS_OBTAINED from SUBMITTED_ANSWERS where STU_ID="'.$stu_id.'" and STU_DEPARTMENT="'.$department.'" and YEAR='.$year.' and STU_SEM='.$sem.' and SUBJECT="'.$subject.'"';
		$result = mysqli_query($con ,$query);
		if($result && mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				$marks_obtained += $row['MARKS_OBTAINED'];
			}
			$query_2='Insert into RESULTS(STU_ID,STU_SEM,STU_DEPARTMENT,STU_SUBJECT,YEAR,MARKS_OBTAINED) values ("'.$stu_id.'",'.$sem.',"'.$department.'","'.$subject.'",'.$year.','.$marks_obtained.')';
			$result_2 = mysqli_query($con ,$query_2);
			if ($result_2) {
				$_SESSION['marks_obtained'] = $marks_obtained;
				header("Location: /Online_examination/result.php");
			}
		}
	}else{
		header("Location: /Online_examination/index.php");
	}
?>