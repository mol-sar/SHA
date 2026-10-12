<?php
include("db_connection.php");

$message = "";

	if(isset($_POST['submit']))
	{
    		$bidTotal = $_POST['bidTotal'];
    		$buyerID = $_POST['buyerID'];
    		$itemID = $_POST['itemID'];

    		$checkBuyer = mysqli_query($conn,
        		"SELECT * FROM User WHERE userID='$buyerID'");

    		$checkItem = mysqli_query($conn,
        		"SELECT * FROM auction_item WHERE itemID='$itemID'");

    			if(mysqli_num_rows($checkBuyer) == 0)
    				{
        				echo "<script>
                			alert('Buyer ID does not exist!');
              			</script>";
    				}else if(mysqli_num_rows($checkItem) == 0)
    				{
        		echo "<script>
                alert('Item ID does not exist!');
              </script>";
    }else{

        $highestBidQuery = mysqli_query($conn,
        "SELECT MAX(bidTotal) AS highestBid
         FROM bid
         WHERE itemID='$itemID'");

        	$highestBidRow = mysqli_fetch_assoc($highestBidQuery);

        	$highestBid = $highestBidRow['highestBid'];

        		if($highestBid != NULL && $bidTotal <= $highestBid)
        			{
            				echo "<script>
                    				alert('Your bid must be higher than the current highest bid (RM $highestBid)');
                  			</script>";
        					} else {
    								$bidDate = date("Y-m-d H:i:s");
  									  $bidStatus = "Valid";
    
   
   									 $result = mysqli_query($conn, "SELECT IFNULL(MAX(bidID), 0) + 1 AS nextID FROM bid");
    									$row = mysqli_fetch_assoc($result);
   										 $bidID = $row['nextID'];

  
   									 $sql = "INSERT INTO bid (bidID, buyerID, itemID, bidTotal, bidDate, bidStatus) 
     									       VALUES ('$bidID', '$buyerID', '$itemID', '$bidTotal', '$bidDate', '$bidStatus')";

    
    							if (mysqli_query($conn, $sql)) {
     									   echo "<script>
        							        alert('Bid placed successfully!');
          								    </script>";
   									 } else {
       									 echo "<script>
            								    alert('" . mysqli_error($conn) . "');
            								  </script>";
  													  }
												}
            			
        				}
	}
			
?>
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
		<h2>Place Bid</h2>

<form method="POST">

    Buyer ID:
    <select name="buyerID" required style="padding: 5px; width: 200px;">
        <option value="">Select Buyer</option>
        <?php
        
        $buyerQuery = mysqli_query($conn, "SELECT userID, userName FROM User WHERE userType = 'Buyer' OR userType = 'Both'");
        while($buyerRow = mysqli_fetch_assoc($buyerQuery)) {
            echo "<option value='" . $buyerRow['userID'] . "'>" . $buyerRow['userID'] . " - " . $buyerRow['userName'] . "</option>";
        }
        ?>
    </select>

    <br><br>

    Item ID:
    <select name="itemID" required style="padding: 5px; width: 200px;">
        <option value="">Select Item</option>
        <?php
        
        $itemQuery = mysqli_query($conn, "SELECT itemID, itemName FROM auction_item");
        while($itemRow = mysqli_fetch_assoc($itemQuery)) {
            echo "<option value='" . $itemRow['itemID'] . "'>" . $itemRow['itemID'] . " - " . $itemRow['itemName'] . "</option>";
        }
        ?>
    </select>

    <br><br>

    Bid Total:
    <input type="number" step="0.01" name="bidTotal" required>

    <br><br>

    <input type="submit" name="submit" value="Place Bid">
    <input type="button" value="Back" onclick="window.location.href='view_bid.php'">

</form>