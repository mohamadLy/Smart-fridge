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
  <script>
   function test() {
     alert();
   }
  </script>
<?php

// Connecting, selecting database
$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_SESSION['username']." user=".$_SESSION['username']." password=".$_SESSION['password'])
or die('Could not connect: ' . pg_last_error());
//Query database
$query="SELECT O.*, fname, lname FROM db_smart_fridge.orders AS O, db_smart_fridge.regular_user AS R, db_smart_fridge.users AS U WHERE O.reg_id=R.reg_id AND R.user_id=U.user_id";


$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<table>
<tr>
<th>Order Number</th>
<th>Order Date</th>
<th>Client First Name</th>
<th>Client Last Name</th>
<th>Order state</th>
<th>Action</th>
</tr>";
//<form method="GET" action="administratorPage.php">
while($row = $line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['order_id'] . "</td>";
    echo "<td>" . $row['order_date'] . "</td>";
    echo "<td>" . $row['fname'] . "</td>";
    echo "<td>" . $row['lname'] . "</td>";
    echo "<td>" . $row['order_state'] . "</td>";
    $_SESSION[$line]=$row['order_id'];
    //echo '<td><button type="button" value="" onclick="test()" id="approve_order">Approve Order</button></td>';
    echo "<td><button type='button' onclick='test()'; name='order_button' value=''>Place Order</button></td>";

    echo "</tr>";

}
//</form>
echo "</table>";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>

</body>
</html>
