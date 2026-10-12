<?php

$conn = mysqli_connect("localhost", "root", "", "shaa_system");

	if(!$conn)
	{
    	die("Connection failed: " . mysqli_connect_error());
	}

		$result = false;

			if(isset($_GET['keyword']) && $_GET['keyword'] != "")
			{
    		$keyword = $_GET['keyword'];

    			$sql = "SELECT * FROM User
            		WHERE userID LIKE '%$keyword%'
            		OR userName LIKE '%$keyword%'";

    		$result = mysqli_query($conn, $sql);
		}

?>

<!DOCTYPE html>
	<html>
		<head>
    		<title>User</title>

    	<style>
		body {
    			font-family: Times New Roman;
    			background-color: #b1bbc8;
    			text-align: center;

				} h2 {
    				color: #2A4D88;

				} table {
    					margin: auto;
    					border-collapse: collapse;
    					background-color: white;
				} th {
    					background-color: #2A4D88;
    					color: white;
    					padding: 10px;
				} td {
    					padding: 10px;
				} .btn {
    					display: block;
    					width: 300px;
    					margin: 10px auto;
    					padding: 15px;
    					background-color: #d9d9d8;
    					color: #2A4D88;
    					text-decoration: none;
    					border-radius: 25px;
    					font-size: 20px;
    					text-align: center;
				}

					.btn:hover {
    					background-color: #7c94b8;
    					color: white;
				}
	</style>

		</head>
			<body>

			<h2>USER</h2>

				<form method="GET">
    				Search User:
    					<input type="text" name="keyword" placeholder="User ID or Name">
    					<input type="submit" value="Search">
				</form>

			<br><br>

<?php

	if($result)
	{
    		if(mysqli_num_rows($result) > 0)
    		{
        		echo "
        		<table border='1'>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Type</th>
                <th>Register Date</th>
            </tr>";

        		while($row = mysqli_fetch_assoc($result))
        		{
            			echo "<tr>";
            			echo "<td>".$row['userID']."</td>";
            			echo "<td>".$row['userName']."</td>";
            			echo "<td>".$row['userType']."</td>";
            			echo "<td>".$row['rgstrDate']."</td>";
            			echo "</tr>";
        	}

        		echo "</table>";
    				}else{
        				echo "<h3>No user found.</h3>";
    				}
			}


		?>

		<br><br>

			<div class="menu">
    				<a class="btn" href="add_user.php">Add User</a>
    				<a class="btn" href="update_user.php">Update User</a>
    				<a class="btn" href="delete_user.php">Delete User</a>
    				<a class="btn" href="index.php">Back</a>
			</div>

		</body>
	</html>