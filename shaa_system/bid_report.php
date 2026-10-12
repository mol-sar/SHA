<?php
include("db_connection.php");

$sql = "
SELECT 
    b.bidID,
    u.userName AS bidder,
    ai.itemName,
    b.bidTotal,
    b.bidDate,
    b.bidStatus

FROM bid b

JOIN user u 
ON b.buyerID=u.userID

JOIN auction_item ai 
ON b.itemID=ai.itemID;
";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Bidding Records Report </title>

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

            table {
                margin: auto;
                border-collapse: collapse;
                background-color: white;
                width: 60%;
            }

            td {
                padding: 10px;
            }

            th {
                background-color: #2a4d88;
                color: white;
                padding: 10px;
            }

            .btn {
                padding: 10px;
                margin: auto;
                background-color: #d9d9d8;
                color: #2a4d88;
                border: none;
                border-radius: 15px;
                font-size: 16px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #7c94b8;
                color: white;
            }

        </style>
    </head>

            
    <body>
        <h2> Bidding Records Report </h2>
        
        <table border="1">
        <tr>
        <th>Bid ID</th><th>User</th><th>Item</th><th>Amount</th><th>Date</th><th>Status</th>
        </tr>

        <?php 
        while($row=mysqli_fetch_assoc($result)) { ?>
        <tr>
        <td><?= $row['bidID'] ?></td>
        <td><?= $row['bidder'] ?></td>
        <td><?= $row['itemName'] ?></td>
        <td><?= $row['bidTotal'] ?></td>
        <td><?= $row['bidDate'] ?></td>
        <td><?= $row['bidStatus'] ?></td>
        </tr>
        <?php } ?>
        </table>

        <input type="button"
           		value="Back"
           		onclick="window.location.href='view_report.php'">
        
    </body>
</html>