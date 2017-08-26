<?php 
	/**
	* 
	*/
	class DatabaseConnect
	{
		public function connect() {
			$connect_var = mysqli_connect('localhost','root','','online_examination');
			if(!$connect_var){
				echo "Connection Failed";
			}else {
				return $connect_var;
			}
		}
		public function closeConnection($conn){
			mysqli_close($conn);
		}
	}
?>