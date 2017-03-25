<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php

// Connecting, selecting database
$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_SESSION['username']." user=".$_SESSION['username']." password=".$_SESSION['password'])
or die('Could not connect: ' . pg_last_error());
//Query database
$query="SELECT * FROM db_smart_fridge.orders";


$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<table>
<tr>
<th>Order Number</th>
<th>Order Date</th>
<th>Order state</th>
<th>Action</th>
</tr>";
while($row = $line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['order_id'] . "</td>";
    echo "<td>" . $row['order_date'] . "</td>";
    echo "<td>" . $row['fridge_id'] . "</td>";
    echo "<td><a href='place_order.php'><button type='button' name='order_button' value=''>Approve Order</button></a></td>";
    echo "</tr>";
}
echo "</table>";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
</body>
</html>