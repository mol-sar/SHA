<?php
include "db_connection.php";


if(isset($_POST['save']))
{
    $itemName = $_POST['itemName'];
    $startingPrice = $_POST['startingPrice'];
    $reservePrice = $_POST['reservePrice'];
    $buyNowPrice = $_POST['buyNowPrice'];
    $categoryID = $_POST['categoryID'];
    $sellerID = $_POST['sellerID'];
    $AucStart = $_POST['AucStart'];
    $AucEnd = $_POST['AucEnd'];

    $result = mysqli_query($conn,
        "SELECT IFNULL(MAX(itemID),0)+1 AS nextID FROM auction_item");

    $row = mysqli_fetch_assoc($result);
    $itemID = $row['nextID'];

    $sql = "INSERT INTO auction_item
            (itemID,itemName,startingPrice,AucStart,AucEnd,
             itemStatus,reservePrice,buyNowPrice,categoryID,sellerID)
            VALUES
            ('$itemID','$itemName','$startingPrice','$AucStart','$AucEnd',
             'Open','$reservePrice','$buyNowPrice',
             '$categoryID','$sellerID')";

    if(mysqli_query($conn,$sql))
    {
        echo "Item added successfully!";
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


		<h2>Add Item</h2>

		<form method="POST">

    			Item Name:
    				<input type="text" name="itemName" required>
    				<br><br>

    			Starting Price:
    				<input type="text" name="startingPrice" step="0.01" min="0" required>
    				<br><br>

    			Reserve Price:
    				<input type="text" name="reservePrice" step="0.01" min="0" required>
    				<br><br>

    			Buy Now Price:
    				<input type="text" name="buyNowPrice" step="0.01" min="0" required>
    				<br><br>

    			Auction Start:
    				<input type="date" name="AucStart" required>
    				<br><br>

    			Auction End:
    				<input type="date" name="AucEnd" required>
    				<br><br>

    			Category:
    			<select name="categoryID" required>
    				<option value="1">1.Textile</option>
    					<option value="2">2.Handicraft</option>
    						<option value="3">3.Collectible</option>
    							<option value="4">4.Cultural architect</option>
    						</select>
    					<br><br>

    			Seller ID:
				<select name="sellerID" required>

<?php
	$result = mysqli_query($conn,"SELECT userID, username FROM user");

		while($row = mysqli_fetch_assoc($result))
			{
    				echo "<option value='".$row['userID']."'>";
    				echo $row['userID']." - ".$row['username'];
    				echo "</option>";
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