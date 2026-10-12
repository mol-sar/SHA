<?php
include("db_connection.php");

if(isset($_POST['update']))
{
    $itemID = mysqli_real_escape_string($conn, $_POST['itemID']);
    $itemStatus = mysqli_real_escape_string($conn, $_POST['itemStatus']);
    $buyNowPrice = mysqli_real_escape_string($conn, $_POST['buyNowPrice']);

  
    $sql = "UPDATE auction_item 
            SET itemStatus='$itemStatus', buyNowPrice='$buyNowPrice' 
            WHERE itemID='$itemID'";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Item Updated Successfully'); window.location.href='view_item.php';</script>";
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
    <title>Select Item to Update</title>

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

<!DOCTYPE html>
<html>
<head>
    <h2>UPDATE ITEM DETAILS</h2>

	<div class="form-box">
		<form method="POST">

			<label>Select Item to Update:</label><br>
            <select name="itemID" required>
                <option value="">Select Item</option>
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

            <label>New Item Status:</label><br>
            <select name="itemStatus" required>
                <option value="Open">Open</option>
                <option value="Closed">Closed</option>
                <option value="Suspended">Suspended</option>
            </select>
            <br><br>

            <label>New Buy Now Price (RM):</label><br>
            <input type="number" step="0.01" name="buyNowPrice" required>
            <br><br>

			<input type="submit" name="update" value="Update Item" class="btn">
			<input type="button" value="Back" class="btn" onclick="window.location.href='view_item.php'">

		</form>
	</div>

</body>
</html>