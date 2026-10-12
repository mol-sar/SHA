<?php
include("db_connection.php");

if(isset($_POST['delete']))
{
    $keyword = $_POST['keyword'];

    $sql = "DELETE FROM User
            WHERE userID='$keyword'
            OR userName='$keyword'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('User deleted successfully!');
        window.location='delete_user.php';
      </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Delete User</title>

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


	<h2>Delete User</h2>


		<form method="POST">

    		Enter User ID or User Name:

    			<input type="text"
           		name="keyword"
           		required>

    			<br><br>

    			<input type="submit"
       			name="delete"
      			value="Delete User"
       			onclick="return confirm('Are you sure you want to delete this user?')">

       				<input type="button"
       				value="Back"
       				onclick="window.location.href='view_user.php'">

			</form>

		</body>
</html>