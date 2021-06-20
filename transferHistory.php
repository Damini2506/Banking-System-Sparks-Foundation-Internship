<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "banking";
	
	$conn = mysqli_connect($server, $username, $password,$dbname);
	
?>

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
            <a href="transferHistory.php" class="nav-link active pr-3"><h4>Transaction History</a>
             </li> 
            <li class="nav-item">
            <a href="index.php" class="nav-link pr-3"><h4>About Us</a>
             </li> 
         </ul>
        </div>
    </div>
</nav>
<body>
	<table align="center" border="1px" style="width:600px; line-height:40px">
			<tr>
				<th colspan="4" id="t01"><h2>Transaction History</h2></th>
			</tr>
			<t>
				<th id="t01"> Receiver ID</th>
				<th id="t01"> Receiver Name </th>
				<th id="t01"> Sender Name </th>
				<th id="t01"> Amount (Rs.) </th>
			</t>
		<?php

			
			$query = "SELECT * FROM transaction";
			$run = mysqli_query($conn,$query) or die(mysqli_error());	

			while($rows = mysqli_fetch_array($run))
				{
			?>
			
			<tr>
				<td align="center"><?php echo $rows['User_ID'];?></td>
				<td align="center"><?php echo $rows['Name'];?></td>
				<td align="center"><?php echo $rows['Email'];?></td>
				<td align="center"><?php echo $rows['Amount'];?></td>
			<?php
				}
		?>
	</body>
</html>