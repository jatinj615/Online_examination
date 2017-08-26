<?php 
	session_start();
	unset($_SESSION['stu_id']);
	unset($_SESSION['stu_first_name']);
	header('Location: /Online_examination/');
?>