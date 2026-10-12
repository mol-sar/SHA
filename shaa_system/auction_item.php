<?php
include("db_connection.php");

$search = "";

	if(isset($_GET['search']))
	{
    		$search = mysqli_real_escape_string($conn, $_GET['search']);

    		$sql = "SELECT * FROM Auction_Item
            	WHERE itemID = '$search'
            	OR itemName LIKE '%$search%'";
			}else{
    			$sql = "SELECT * FROM Auction_Item";
		}

	$result = mysqli_query($conn, $sql);
?>

<html>
<body>

	<form method="GET">
    		Search Item:
    			<input type="text" name="search">
    			<input type="submit" value="Search">
		</form>

	<br>

		<table border="1">
	<tr>
    		<th>Item ID</th>
    		<th>Item Name</th>
    		<th>Price</th>
	</tr>

<?php
	while($row = mysqli_fetch_assoc($result))
	{
    		echo "<tr>";
    		echo "<td>".$row['itemID']."</td>";
    		echo "<td>".$row['itemName']."</td>";
    		echo "<td>".$row['price']."</td>";
   	 	echo "</tr>";
	}
?>

</table>

</body>
</html>