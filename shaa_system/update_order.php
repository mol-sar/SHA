<?php
include("db_connection.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Order to Update</title>

    <style>
        body {
            font-family: Times New Roman;
            background-color: #b1bbc8;
            text-align: center;
        }

        h2 {
            margin-top: 30px;
            color: #2a4d88;
        }

        .btn {
            padding: 10px;
            margin: 8px;
            background-color: #d9d9d8;
            color: #2A4D88;
            text-decoration: none;
            border-radius: 15px;
            font-size: 20px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #7c94b8;
            color: white;
        }

        input[type=text] {
            width: 250px;
            padding: 8px;
            border-radius: 10px;
            border: 1px solid #999;
        }

        .form-box {
            width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
        }
    </style>

<body>


<?php
include("db_connection.php");

if(isset($_POST['update']))
{
    $orderID = mysqli_real_escape_string($conn, $_POST['orderID']);
    $orderStatus = mysqli_real_escape_string($conn, $_POST['orderStatus']);

    
    $sql = "UPDATE orders SET orderStatus='$orderStatus' WHERE orderID='$orderID'";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Order Status Updated Successfully'); window.location.href='view_order.php';</script>";
    }
    else
    {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Order</title>

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


		<h2>UPDATE ORDER STATUS</h2>

	<div class="form-box">
		<form method="POST">

			<label>Select Order to Update:</label><br>
            <select name="orderID" required>
                <option value="">Select an Order</option>
                <?php
               
                $order_list = mysqli_query($conn, "
                    SELECT o.orderID, o.orderStatus, o.totalAmount, u.userName 
                    FROM orders o
                    JOIN user u ON o.buyerID = u.userID
                    ORDER BY o.orderID DESC
                ");
                while($row = mysqli_fetch_assoc($order_list)) {
                    echo "<option value='" . $row['orderID'] . "'>";
                    echo "ID: " . $row['orderID'] . " | " . $row['userName'] . " - Status: [" . $row['orderStatus'] . "] (RM " . $row['totalAmount'] . ")";
                    echo "</option>";
                }
                ?>
            </select>
			<br><br>

            <label>New Order Status:</label><br>
            <select name="orderStatus" required>
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
                <option value="Shipped">Shipped</option>
                <option value="Completed">Completed</option>
            </select>
            <br><br>

			<input type="submit" name="update" value="Update Order" class="btn">
			<input type="button" value="Back" class="btn" onclick="window.location.href='view_order.php'">

		</form>
	</div>

</body>
</html>