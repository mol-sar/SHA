<?php
include "db_connection.php";


if(isset($_POST['save']))
{
    //$orderID = $_POST['orderID'];
    $orderDate = $_POST['orderDate'];
    $orderStatus = $_POST['orderStatus'];
    $totalAmount = $_POST['totalAmount'];
    $sellerID = $_POST['sellerID'];
    $buyerID = $_POST['buyerID'];
    $itemID = $_POST['itemID'];

    $result = mysqli_query($conn,
        "SELECT IFNULL(MAX(orderID),0)+1 AS nextID FROM orders");

    $row = mysqli_fetch_assoc($result);
    $orderID = $row['nextID'];

    $sql = "INSERT INTO orders
            (orderID, orderDate, orderStatus, totalAmount, sellerID, buyerID, itemID)
            VALUES
            ('$orderID', '$orderDate', '$orderStatus', '$totalAmount', '$sellerID', '$buyerID', '$itemID')";

    if(mysqli_query($conn,$sql))
    {
        echo "Order added successfully!";
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
    <title>Add Order</title>

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


		<h2>Add Order</h2>

		<form method="POST">

    			Order Date:
    				<input type="date" name="orderDate" required>
    				<br><br>

    			Order Status:
    				<select name="orderStatus" required>
                        <option value = "Pending"> Pending </option>
                        <option value = "Paid"> Paid </option>
                        <option value = "Shipped"> Shipped </option>
                        <option value = "Completed"> Completed </option>
                    </select>
                    <br><br>

    			Total Amount:
                    <input type = "number" name = "totalAmount" step="0.01" required>
    				<br><br>

    			Seller ID:
    			<select name="sellerID" required>
                    <?php
                    $sellers = mysqli_query($conn, "SELECT userID, username FROM user WHERE userType='Seller' OR userType='Both'");
                    while($row = mysqli_fetch_assoc($sellers)) {
                        echo "<option value='".$row['userID']."'>".$row['userID']." - ".$row['username']."</option>";
                    }
                    ?>
    			</select>
    			<br><br>

    			Buyer ID:
    			<select name="buyerID" required>
                    <?php
                    $buyers = mysqli_query($conn, "SELECT userID, username FROM user WHERE userType='Buyer' OR userType='Both'");
                    while($row = mysqli_fetch_assoc($buyers)) {
                        echo "<option value='".$row['userID']."'>".$row['userID']." - ".$row['username']."</option>";
                    }
                    ?>
    			</select>
    			<br><br>

    			Item ID:
                <select name="itemID" required>
                    <?php
                    $items = mysqli_query($conn, "SELECT itemID, itemName FROM auction_item");
                    while($row = mysqli_fetch_assoc($items)) {
                        echo "<option value='".$row['itemID']."'>".$row['itemID']." - ".$row['itemName']."</option>";
                    }
                    ?>
                </select>
    			<br><br>
					<input type="submit" name="save" value="Save">
    				<input type="button" value="Back"
           			onclick="window.location.href='view_item.php'">
	

			</form>
	
		</body>
</html>