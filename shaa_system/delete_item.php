<?php
include("db_connection.php");

if(isset($_POST['delete']))
{
    $itemID = $_POST['itemID'];

    $sql = "DELETE FROM auction_item
            WHERE itemID='$itemID'";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Item Deleted Successfully');</script>";
    }
    else
    {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Item</title>

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

<h2>DELETE ITEM</h2>

	<div class="form-box">
		<form method="POST">

			<label>Select Item to Delete:</label><br><br>

            <select name="itemID" required style="padding: 8px; width: 300px;">
                <option value="">Select an Item</option>
                <?php
           
                $item_list = mysqli_query($conn, "SELECT itemID, itemName FROM auction_item");
                while($row = mysqli_fetch_assoc($item_list)) {
                    echo "<option value='" . $row['itemID'] . "'>";
                    echo "ID: " . $row['itemID'] . " - " . $row['itemName'];
                    echo "</option>";
                }
                ?>
            </select>
			<br><br>

			<input type="submit" name="delete" value="Delete" class="btn" onclick="return confirm('Are you sure?')">
			<input type="button" value="Back" class="btn" onclick="window.location.href='view_item.php'">

		</form>
	</div>

</body>
</html>