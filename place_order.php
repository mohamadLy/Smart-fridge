<?php
// Start the session
ob_start();
session_start();
include("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="create_meal_style.css">
 <link rel="stylesheet" href="styles.css">
 <title>Smart refrigirator</title>

</head>
<style>

h2 {
    background-color: #dff0d8;
}

</style>
<body>
<?php
// define variables and set to empty values
$reg_idErr = $order_dateErr = "";
$reg_id = $order_date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["reg_id"])) {
    $reg_idErr = "regular user ID is required";
  } else {
	 $reg_id = test_input($_POST["reg_id"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$price)) {
      $reg_idErr = "Only numbers allowed";
    }
  }
  if (empty($_POST["order_date"])) {
    $order_dateErr = "order_date is required";      
  } else {
	 $order_date = test_input($_POST["order_date"]);
  }

  // Connecting, selecting database
  $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_SESSION['username']." user=".$_SESSION['username']." password=".$_SESSION['password'])
  or die('Could not connect: ' . pg_last_error());

$select = pg_query("SELECT R.reg_id FROM  project.regular_user as R WHERE R.reg_id = '{$reg_id}' ");
confirm($select);
 if(pg_num_rows($select) == 0){
               
               set_message("ID not present in our database. You can create one here");
              header("place_order.php");

          }  else{     
$query="INSERT INTO project.orders(reg_id, order_date) VALUES('$reg_id', '$order_date')";

//$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) ;
//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
 confirm($result);
 set_message("order succesfully placed, have a nice meal!!! you will be redirected in a few.");
 header('Refresh: 5;url=index.php');
   
          
          }
/*
$regular_user= pg_query("INSERT INTO project.regular_user(user_id) VALUES('$query_id')");
    confirm($regular_user);
   $query_prim=pg_query("SELECT R.reg_id FROM project.regular_user  AS R WHERE R.user_id = '$query_id' ");
   confirm($query_prim);


*/

// Closing connection
pg_close($dbconn);

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<article>
<div class="center" align="center">

<h1 align="center">Creation of a Meal</h1>
<h2 align="center"><?php  display_message();?> </h2>

<div class="image_meal">
<img src="meal.jpg" alt="meal" style="width:304px;height:228px;">
</div>
<p><span class="error">All field are required.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Regular user ID:<br>
  <input type="text" name="reg_id" value="">
  <span class="error" > <?php echo $reg_idErr;?></span>
  <br>
  Order date:<br>
  <input type="date" name="order_date" value="">
  <span class="error" > <?php echo $order_dateErr;?></span>
  <br>
  <br>
  <input type="submit" name="submit" value="create Order">
</form>


<p>If you click the "create Meal" button, a meal will be added on the meal database.</p>
</div>
 </article>

<?php //echo $_SESSION["meal_name"]; ?>

<script>
function myFunction() {
    var person = prompt("Please enter your name", "Harry Potter");

    if (person != null) {
        document.getElementById("demo").innerHTML =
        "Hello " + person + "! How are you today?";
    }
}
</script>
<?php include("footer.php");?>
