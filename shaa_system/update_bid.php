<?php
include "db_connection.php";

$row = null;

if(isset($_POST['update'])) {
    $bidID = $_POST['bidID'];
    $newBidTotal = $_POST['newBidTotal'];


    $sql = "UPDATE bid SET bidTotal='$newBidTotal', bidDate=NOW() WHERE bidID='$bidID'";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Bid updated successfully!'); window.location.href='view_bid.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Bid</title>

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

	<h2>UPDATE BID</h2>

    <div class="form-box">
        <form method="POST">

            <label>Select Bid to Update:</label><br>
            <select name="bidID" required>
                <option value="">-- Select Bid Record --</option>
                <?php
                $bid_list = mysqli_query($conn, "
                    SELECT b.bidID, u.userName, ai.itemName, b.bidTotal, b.bidStatus
                    FROM bid b
                    JOIN user u ON b.buyerID = u.userID
                    JOIN auction_item ai ON b.itemID = ai.itemID
                    ORDER BY b.bidID DESC
                ");
                
                while($dropdown_row = mysqli_fetch_assoc($bid_list)) {
                    echo "<option value='" . $dropdown_row['bidID'] . "'>";
                    echo "ID: " . $dropdown_row['bidID'] . " | " . $dropdown_row['userName'] . " - " . $dropdown_row['itemName'] . " [RM " . $dropdown_row['bidTotal'] . " - " . $dropdown_row['bidStatus'] . "]";
                    echo "</option>";
                }
                ?>
            </select>
            <br>

            <label>Enter New Bid Amount (RM):</label><br>
            <input type="number" step="0.01" name="newBidTotal" required placeholder="0.00">
            <br>

            <label>Select New Bid Status:</label><br>
            <select name="bidStatus" required>
                <option value="Valid">Valid</option>
                <option value="Outbid">Outbid</option>
                <option value="Winning">Winning</option>
            </select>
            <br><br>

            <input type="submit" name="update" value="Update Bid" class="btn">
            <input type="button" value="Back" class="btn" onclick="window.location.href='view_bid.php'">

        </form>
    </div>

</body>
</html>