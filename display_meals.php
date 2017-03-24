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
$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=username user=username password=password") or die('Could not connect: ' . pg_last_error());
// Get database connection string
//$dbconn = pg_connect($conn_string) or die 'Connection die';
//Query database
$query="SELECT * FROM db_smart_fridge.meal";


$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<table>
<tr>
<th>cuisine</th>
<th>meal_id</th>
<th>fridge_id</th>
<th>description</th>
<th>price</th>
<th>meal_name</th>
</tr>";
while($row = $line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['cuisine'] . "</td>";
    echo "<td>" . $row['meal_id'] . "</td>";
    echo "<td>" . $row['fridge_id'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['meal_name'] . "</td>";
    $_SESSION["cuisine"] = $row['cuisine'];
    $_SESSION["meal_id"] = $row['meal_id'];
    $_SESSION["fridge_id"] = $row['fridge_id'];
    $_SESSION["description"] = $row['description'];
    $_SESSION["price"] = $row['price'];
    $_SESSION["meal_name"] = $row['meal_name'];

    echo "<td><a href='place_order.php'><button type='button' name='order_button' value=''>Place Order</button></a></td>";

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
