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
if ($_SESSION['choice_made'] == "Dairy") {
  $query="SELECT food_name, fridge_id, count, price, threshold FROM db_smart_fridge.food AS F, db_smart_fridge.Dairy AS D WHERE D.food_id=F.food_id";
} elseif ($_SESSION['choice_made'] == "Fruit") {
  $query="SELECT food_name, fridge_id, count, price, threshold FROM db_smart_fridge.food AS F, db_smart_fridge.Fruit AS D WHERE D.food_id=F.food_id";
} elseif ($_SESSION['choice_made'] == "Meat") {
  $query="SELECT food_name, fridge_id, count, price, threshold FROM db_smart_fridge.food AS F, db_smart_fridge.Meat AS D WHERE D.food_id=F.food_id";
} elseif ($_SESSION['choice_made'] == "Juice") {
  $query="SELECT food_name, fridge_id, count, price, threshold FROM db_smart_fridge.food AS F, db_smart_fridge.Juice AS D WHERE D.food_id=F.food_id";
} elseif ($_SESSION['choice_made'] == "Egg") {
  $query="SELECT food_name, fridge_id, count, price, threshold FROM db_smart_fridge.food AS F, db_smart_fridge.Egg AS D WHERE D.food_id=F.food_id";
} elseif ($_SESSION['choice_made'] == "Grain") {
  $query="SELECT food_name, fridge_id, count, price, threshold FROM db_smart_fridge.food AS F, db_smart_fridge.Grain AS D WHERE D.food_id=F.food_id";
}

$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<table>
<tr>
<th>Food name</th>
<th>Fridge ID</th>
<th>Number of Items</th>
<th>Price</th>
<th>Threshold</th>
<th>Action</th>
</tr>";
while($row = $line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['food_name'] . "</td>";
    echo "<td>" . $row['fridge_id'] . "</td>";
    echo "<td>" . $row['count'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['threshold'] . "</td>";
    $_SESSION["food_name"] = $row['food_name'];
    $_SESSION["number_items"] = $row['count'];
    $_SESSION["fridge_id"] = $row['fridge_id'];
    $_SESSION["threshold"] = $row['threshold'];
    $_SESSION["price"] = $row['price'];

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
