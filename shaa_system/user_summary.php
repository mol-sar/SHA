<?php
include("db_connection.php");

$sql ="
SELECT
    u.userID,
    u.userName,
    u.userType,

    COUNT(DISTINCT ai.itemID) AS total_items,

    COUNT(DISTINCT b.bidID) AS total_bids,

    COUNT(DISTINCT CASE 
        WHEN o.buyerID = u.userID 
        THEN o.orderID 
    END) AS successful_purchases,

    COUNT(DISTINCT CASE 
        WHEN o.sellerID = u.userID
        THEN o.orderID 
    END) AS successful_sales

FROM user u

LEFT JOIN auction_item ai
ON u.userID = ai.sellerID

LEFT JOIN bid b
ON u.userID = b.buyerID

LEFT JOIN orders o
ON u.userID = o.buyerID OR u.userID = o.sellerID

GROUP BY 
    u.userID,
    u.userName,
    u.userType;
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Registered Users Report </title>

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
        <h2> Registered Users Summary </h2>
        
        <table border="1">

        <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Role</th>
        <th>Total Items</th>
        <th>Total Bids</th>
        <th>Successful Purchases</th>
        <th>Successful Sales</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result))
        {
        ?>

        <tr>
        <td><?= $row['userID']; ?></td>
        <td><?= $row['userName']; ?></td>
        <td><?= $row['userType']; ?></td>
        <td><?= $row['total_items']; ?></td>
        <td><?= $row['total_bids']; ?></td>
        <td><?= $row['successful_purchases']; ?></td>
        <td><?= $row['successful_sales']; ?></td>
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