<?php
include("db_connection.php");

if(isset($_POST['delete']))
{
    $bidID = mysqli_real_escape_string($conn, $_POST['bidID']);

    $sql = "DELETE FROM bid WHERE bidID='$bidID'";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Bid deleted successfully.'); window.location.href='view_bid.php';</script>";
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
			<title>Delete Bid</title>

    		<style>
        	body{
            		font-family: Times New Roman;
            		background-color: #b1bbc8;
            		text-align: center;
        		}h2{
            		color: #2A4D88;

        		}.form-box{
            		width: 400px;
            		margin: auto;
            		background: white;
            		padding: 20px;
            		border-radius: 15px;

        		}input[type=text]{
            		width: 250px;
            		padding: 8px;

        		}.btn{
            		padding: 10px;
            		margin: 8px;
            		background-color: #d9d9d8;
            		color: #2A4D88;
            		border: none;
            		border-radius: 15px;
            		font-size: 18px;
            		cursor: pointer;
        		
			}.btn:hover{
            		background-color: #7c94b8;
            		color: white;
        		}
    		</style>

	</head>
<body>


<h2>DELETE BID</h2>

<form method="post">

    <label>Select Bid to Delete:</label><br><br>
    
    <select name="bidID" required style="padding: 8px; width: 350px;">
        <option value="">Select Bid Record</option>
        <?php
        
        $bid_list = mysqli_query($conn, "
            SELECT b.bidID, u.userName, ai.itemName, b.bidTotal 
            FROM bid b
            JOIN user u ON b.buyerID = u.userID
            JOIN auction_item ai ON b.itemID = ai.itemID
        ");
        
        while($row = mysqli_fetch_assoc($bid_list)) {
            echo "<option value='" . $row['bidID'] . "'>";
            echo "ID: " . $row['bidID'] . " | " . $row['userName'] . " - " . $row['itemName'] . " (RM " . $row['bidTotal'] . ")";
            echo "</option>";
        }
        ?>
    </select>
    <br><br>

    <input type="submit" name="delete" value="Delete Bid" class="btn">
    <input type="button" value="Back" class="btn" onclick="window.location.href='view_bid.php'">

</form>