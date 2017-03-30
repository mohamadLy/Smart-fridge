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
$where_clause= "WHERE order_id=".$_SESSION['order_id'];
$query="UPDATE db_smart_fridge.orders SET order_state='APPROVED' $where_clause";


$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());


// Free resultset
pg_free_result($result);
// Closing connection
pg_close($dbconn);
?>
