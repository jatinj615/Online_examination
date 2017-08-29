<?php 
	session_start();
	if(isset($_SESSION['stu_id']) && isset($_SESSION['stu_first_name'])){
		echo 'Welcome '.$_SESSION['stu_first_name'];	
	} else{
		header("Location: index.php");
	}
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
		        window.location.href = "show_result.php";
		    }
		}, 1000);
 	</script>
 </head>
 <body>
 	<p id="demo"></p>
 	<!-- Selection of Question paper by Student -->
 	<form action="php_controllers/select_question_paper.php" method="GET">
 		Subject : <input type="text" name="subject">
 		Year    : <input type="text" name="year">
 		<input type="submit" name="submit_subject" value="Next">
 	</form>
	<a href="php_controllers/student_logout.php">Log Out</a>
 </body>
 </html>