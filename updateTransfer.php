<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "banking";
	
	$conn = mysqli_connect($server, $username, $password,$dbname);
	
	if(isset($_POST['submit'])){
		
		if(!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['amount'])){
			
			$id = $_POST['id'];
			$name = $_POST['name'];
			$amount = $_POST['amount'];
			
			$query = "UPDATE customers set `Balance` = `Balance` + '$amount' WHERE SR_No = $id ";
			$run = mysqli_query($conn,$query) or die(mysqli_error());
			
			$query_1 = "UPDATE customers set `Balance` = `Balance` - '$amount' WHERE Email = '$uname'";
			$run_1 = mysqli_query($conn,$query_1) or die(mysqli_error());
			
			if($run && $run_1){
				echo "Money Transferred succesfully";
			}
			
			else{
				echo "Unsuccesful";
			}
				
			}
		else{
			echo "All fields compulsory";
		}
	}
?>