<?php
include("db_connection.php");

if(isset($_POST['delete']))
{
    $orderID = $_POST['orderID'];

    $sql = "DELETE FROM orders
            WHERE orderID='$orderID'";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Order Deleted Successfully');</script>";
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
    <title>Delete Order</title>

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


	<h2>DELETE ORDER</h2>

	<div class="form-box">
		<form method="POST">

			<label>Select Order to Delete:</label><br><br>

            <select name="orderID" required style="padding: 8px; width: 380px;">
                <option value="">Select an Order</option>
                <?php
                
                $order_list = mysqli_query($conn, "
                    SELECT o.orderID, o.orderDate, o.totalAmount, u.userName 
                    FROM orders o
                    JOIN user u ON o.buyerID = u.userID
                    ORDER BY o.orderID DESC
                ");
                while($row = mysqli_fetch_assoc($order_list)) {
                    echo "<option value='" . $row['orderID'] . "'>";
                    echo "ID: " . $row['orderID'] . " | " . $row['userName'] . " - RM " . $row['totalAmount'] . " (" . $row['orderDate'] . ")";
                    echo "</option>";
                }
                ?>
            </select>
			<br><br>

			<input type="submit" name="delete" value="Delete Order" class="btn" onclick="return confirm('Are you sure you want to delete this order?')">
			<input type="button" value="Back" class="btn" onclick="window.location.href='view_order.php'">

		</form>
	</div>

</body>
</html>