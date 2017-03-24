<!DOCTYPE html>
<html>
<head>

<?php

// Connecting, selecting database
$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=username user=username password=password") or die('Could not connect: ' . pg_last_error());
// Get database connection string


//Query database
$query="INSERT INTO db_smart_fridge.meal(cuisine, meal_id, fridge_id, description, price, meal_name)
VALUES()";



$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
</body>
</html>
