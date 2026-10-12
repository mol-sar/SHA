<?php
include("db_connection.php");

$sql = "
SELECT 
    ai.itemID,
    ai.itemName,
    COUNT(b.bidID) AS total_bids

FROM auction_item ai

JOIN bid b 
ON ai.itemID = b.itemID

GROUP BY 
    ai.itemID,
    ai.itemName

ORDER BY total_bids DESC
LIMIT 5;
";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> TOP 5 POPULAR AUCTION ITEMS </title>

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
        <h2> Top 5 Popular Auction Items </h2>
        
        <table border="1">
        <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Total Bids</th>
        </tr>

        <?php 
        while($row=mysqli_fetch_assoc($result)) { ?>
        <tr>
        <td><?= $row['itemID'] ?></td>
        <td><?= $row['itemName'] ?></td>
        <td><?= $row['total_bids'] ?></td>
        </tr>
        <?php 
        }
        ?>
        </table>
        <input type="button"
           		value="Back"
           		onclick="window.location.href='view_report.php'">
        
    </body>
</html>