<?php
include "db_connection.php";

$row = null;

	if(isset($_GET['userID']))
	{
    		$id = $_GET['userID'];

    		$sql = "SELECT * FROM User WHERE userID = '$id'";
    		$result = mysqli_query($conn, $sql);
    		$row = mysqli_fetch_assoc($result);
	}

		if(isset($_POST['update']))
	{
    		$id = $_POST['userID'];
    		$name = $_POST['fullname'];
    		$role = $_POST['role'];

    		$sql = "UPDATE User 
            	SET userName = '$name',
                userType = '$role'
            	WHERE userID = '$id'";

    		mysqli_query($conn, $sql);

    		echo "<br>User updated successfully!<br>";
    	$row = null;
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>

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


		<h2>Update User</h2>

			<form method="GET">
    				Enter User ID:
    					<input type="text" name="userID" required>
    					<input type="submit" value="Search">
    					<input type="button" value="Back" onclick="window.location.href='view_user.php'">
			</form>

		<br><br>

		<?php if($row) { ?>

			<form method="POST">

    				<input type="hidden" name="userID"
           			value="<?php echo $row['userID']; ?>">

    					Name:
    					<input type="text" name="fullname"
           				value="<?php echo $row['userName']; ?>">

    					<br><br>

    					Role:
    					<select name="role">

        				<option value="Buyer"
        				<?php if($row['userType']=="Buyer") echo "selected"; ?>>
        				Buyer
        				</option>

        				<option value="Seller"
        				<?php if($row['userType']=="Seller") echo "selected"; ?>>
        				Seller
        				</option>

        				<option value="Both"
        				<?php if($row['userType']=="Both") echo "selected"; ?>>
        			Both
        		</option>

    		</select>

    	<br><br>

    		<input type="submit" name="update" value="Update User">
  

		</form>

	<?php } ?>

	</body>
</html>