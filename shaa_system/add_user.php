<?php
include "db_connection.php";

	if(isset($_POST['save']))
	{
    		$userName = $_POST['fullname'];
    		$userType = $_POST['role'];

    			$result = mysqli_query($conn, "SELECT IFNULL(MAX(userID),0)+1 AS nextID FROM User");
			$row = mysqli_fetch_assoc($result);
			$userID = $row['nextID'];

		$sql = "INSERT INTO User(userID, userName, userType, rgstrDate)
        		VALUES('$userID', '$userName', '$userType', CURDATE())";

    			if(mysqli_query($conn, $sql))
    			{
        			echo "User added successfully!";
    				}else{
        				echo mysqli_error($conn);
    					}
				}                                                                                                                                                                         
?>
<!DOCTYPE html>
<head>
    <title>Add Item</title>

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
    					padding: 10px;
    					margin: 8px;
    					background-color: #d9d9d8;
    					color: #2A4D88;
    					border: none;
    					border-radius: 15px;
    					font-size: 16px;
    					cursor: pointer;
				} .btn:hover {
    					background-color: #7c94b8;
    					color: white;
				}
	</style>

		</head>
			<body>

    <h2> Add User </h2>
    	<form method = "POST">
        
        Name:
        	<input type = "text" name = "fullname">
		<br><br>

        Role:
        	<select name = "role">
            		<option> Buyer </option>
            			<option> Seller </option>
            				<option> Both </option>
        			</select>
        			<br><br>

        			<input type="submit" name="save" value="Save">
				<input type="button" value="Back" onclick="window.location.href='view_user.php'">
    			</form>
		</body>
</html>