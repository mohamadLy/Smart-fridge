<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="create_meal_style.css">
 <link rel="stylesheet" href="styles.css">
 <title>Smart refrigirator</title>
</head>
<body>
<?php
// define variables and set to empty values
$meal_nameErr = $cuisineErr = "";
$meal_id = $ingredient_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["ingredient_name"])) {
    $nameErr = "Ingredient name is required";
  } else {
    $ingredient_name = test_input($_POST["ingredient_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$meal_name)) {
      $meal_nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["meal_id"])) {
    $emailErr = "Meal ID is required";
  } else {
	 $meal_id = test_input($_POST["meal_id"]);
  }


  // Connecting, selecting database
  $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_SESSION['username']." user=".$_SESSION['username']." password=".$_SESSION['password'])
  or die('Could not connect: ' . pg_last_error());
$query="INSERT INTO db_smart_fridge.ingredient(ingredient_name, meal_id) VALUES('$ingredient_name', $meal_id)";

//$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Closing connection
pg_close($dbconn);

echo '<script>alert("Ingredient Added Successfully")</script>';

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<article>
<div class="center">

<h1 align="center">Creation of a Meal</h1>

<div class="image_meal">
<img src="meal.jpg" alt="meal" style="width:304px;height:228px;">
</div>
<p><span class="error">All field are required.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 Ingredient name:<br>
  <input type="text" name="ingredient_name" value="">
  <span class="error" > <?php echo $meal_nameErr;?></span>
  <br>
  Meal ID:<br>
  <input type="text" name="meal_id" value="">
  <span class="error" > <?php echo $cuisineErr;?></span>
  <br>
  <br>
  <input type="submit" name="submit" value="ADD Ingredient">
</form>

 </article>
 </div>

</body>
</html>
