<?php 
	session_start();
	unset($_SESSION['admin']);
	header("Location: /Online_examination/")
?>