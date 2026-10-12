<?php
include("db_connection.php");

$sql = "
SELECT
    YEAR(orderDate) AS year,
    QUARTER(orderDate) AS quarter,
    COUNT(orderID) AS total_orders,
    SUM(totalAmount) AS total_sales
            
FROM orders
GROUP BY
    YEAR(orderDate),
    QUARTER(orderDate)
            
ORDER BY
    year,
    quarter;
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Quarterly Orders Report </title>

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
        <h2> Quarterly Orders Report </h2>
        
        <table border="1">
            <tr>
                <th> Year </th>
                <th> Quarter </th>
                <th> Total Orders </th>
                <th> Total Sales (RM) </th>
            </tr>

            <?php
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                echo "<td>" . $row['year'] . "</td>";
                echo "<td>" . $row['quarter'] . "</td>";
                echo "<td>" . $row['total_orders'] . "</td>";
                echo "<td>" . $row['total_sales'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <input type="button"
           		value="Back"
           		onclick="window.location.href='order_report.php'">
        
    </body>
</html>