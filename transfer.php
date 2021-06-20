<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "banking";
	
	$conn = mysqli_connect($server, $username, $password,$dbname);

?>

<!doctype html>
<html>
<head>
		
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sparks Bank</title>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapsdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="home.css" rel="stylesheet">

	</head>
	<body>
		<nav class="navbar navbar-expand-md navbar-light">
    <a href="#" class="navbar-brand">
       <h3>SPARKS BANK</h3>
    </a>
   

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="index.php" class="nav-link pr-3"><h4>Home</a>
       </li> 
        <li class="nav-item">
            <a href="customerList.php" class="nav-link pr-3"><h4>Customer List</a>
             </li> 
            <li class="nav-item">
            <a href="transferHistory.php" class="nav-link pr-3"><h4>Transaction History</a>
             </li> 
            <li class="nav-item">
            <a href="index.php" class="nav-link pr-3"><h4>About Us</a>
             </li> 
         </ul>
        </div>
    </div>
</nav>
	<body>
		
			<?php
                $sid=$_GET['id'];	//sid => to
                $sql = "SELECT * FROM  customers where User_ID = $sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
            ?>
            <form method="post">
        <div>
			<table align="center" border="1px" style="width:600px; line-height:40px">
			<tr>
				<th colspan="4" id="t01"><h2>Customer</h2></th>
			</tr>
				
                <tr>
					<th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
			<?php
				while($rows=mysqli_fetch_array($result))
				{
			?>
                <tr>
					<td align="center"><?php echo $rows['User_ID'];?></td>
                    <td align="center"><?php echo $rows['Name'];?></td>
                    <td align="center"><?php echo $rows['Email'];?></td>
                    <td align="center"><?php echo $rows['Balance']; ?></td>
                </tr>
			<?php
				}
			?>
            </table>
        </div>
        <div class="chibi">
		<select name="from" class="form-control" required>
            <option value="" disabled selected>Choose</option>
			<?php
                $sid=$_GET['id'];
                $sql_4 = "SELECT * FROM customers where User_ID!=$sid";
                $result_4=mysqli_query($conn,$sql_4);
                if(!$result_4)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result_4)) {
            ?>
                <option class="table" value="<?php echo $rows['User_ID'];?>" >
                
                    <?php echo $rows['Name'] ;?> (Balance: 
                    <?php echo $rows['Balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
			  
			   </select><br>
			<label> Amount:</label><input type="text" name="amount"><br>
			<button type="submit" name="submit">Submit</button>
          </div>
		</form>
	</body>
</html>
<?php

	$conn = mysqli_connect($server, $username, $password,$dbname);
	
	if(isset($_POST['submit'])){
		
		if(!empty($_GET['id']) && !empty($_POST['from']) && !empty($_POST['amount'])){
			
			$id = $_GET['id'];
			$amount = $_POST['amount'];
			$from = $_POST['from'];
			
			$sql_1 = "SELECT * FROM  customers where User_ID = $id";
            $result_1 = mysqli_query($conn,$sql_1);
			$sql1 = mysqli_fetch_array($result_1);
			
			$sql_2 = "SELECT * FROM  customers where User_ID = $from";
            $result_2 = mysqli_query($conn,$sql_2);
			$sql2 = mysqli_fetch_array($result_2);
			
			$receiver = $sql1['Name'];
			$sender = $sql2['Name'];
			
            			
			$query = "UPDATE customers set `Balance` = `Balance` + '$amount' WHERE User_ID = $id";
			$run = mysqli_query($conn,$query) or die(mysqli_error());
			
			$query_1 = "UPDATE customers set `Balance` = `Balance` - '$amount' WHERE User_ID = $from";
			$run_1 = mysqli_query($conn,$query_1) or die(mysqli_error());
			
			$query_2 = "INSERT into transaction(User_ID,Name,Email,Amount) Values ($id,'$receiver','$sender',$amount ) ";
			$run_2 = mysqli_query($conn,$query_2) or die(mysqli_error());
			
			if($run && $run_1){
				echo "Money Transferred succesfully";
			}
			
			}
		else{
			echo "All fields compulsory";
		}
	}
?>

