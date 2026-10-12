<?php

$conn = mysqli_connect("localhost", "root", "", "shaa_system");

    if(!$conn)
        {
            die("Connection failed: " . mysqli_connect_error());
        }

    $result = false;

        if(isset($_GET['keyword']) && $_GET['keyword'] != "")
        {
            $keyword = $_GET['keyword'];

            $sql = "SELECT * FROM auction_item
                WHERE itemID LIKE '%$keyword%'
                OR itemName LIKE '%$keyword%'
                OR itemStatus LIKE '%$keyword%'";

            $result = mysqli_query($conn, $sql);
    }   

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Auction Item </title>

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

            .menu {
                width: 300px;
                margin: auto;
            }

            .btn {
                display: block;
                padding: 10px;
                margin: 8px;
                background-color: #d9d9d8;
                color: #2A4D88;
                text-decoration: none;
                border-radius: 15px;
                font-size: 20px;
            }

            .btn:hover {
                background-color: #7c94b8;
                color: white;
            }
        </style>
    </head>

    <body>
        <h1> Sarawak Heritage Online Auction (SHAA) </h1>
        <h2> AUCTION ITEM </h2>

        <form method="GET">
    Search Item:
                <input type="text" name="keyword"
                       placeholder="Item ID, Name or Status">
                <input type="submit" value="Search">
            </form>
        <br><br>
    <?php

if($result)
{
    if(mysqli_num_rows($result) > 0)
    {
        echo "
        <table border='1' style='margin:auto; background:white;'>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Starting Price</th>
            <th>Item Status</th>
        </tr>";

        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>".$row['itemID']."</td>";
            echo "<td>".$row['itemName']."</td>";
            echo "<td>".$row['startingPrice']."</td>";
            echo "<td>".$row['itemStatus']."</td>";
            echo "</tr>";
        }

        echo "</table>";
            }else{
                echo "<h3>No item found.</h3>";
        }
    }

?> 
    <div
        class = "menu">
        <a class = "btn" href = "add_item.php"> Add Item </a>
        <a class = "btn" href = "update_item.php"> Update Item </a>
        <a class = "btn" href = "delete_item.php"> Delete Item </a>
        <a class = "btn" href = "index.php"> Back </a>
    </div>

    </body>
</html>