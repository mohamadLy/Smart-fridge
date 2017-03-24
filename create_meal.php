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
$meal_nameErr = $cuisineErr = $descriptionErr = $priceErr = $fridge_numberErr = "";
$meal_name = $cuisine = $description = $price = $fridge_number = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["meal_name"])) {
    $nameErr = "Meal name is required";
  } else {
    $meal_name = test_input($_POST["meal_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$meal_name)) {
      $meal_nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["cuisine"])) {
    $emailErr = "Cuisine is required";
  } else {
	 $cuisine = test_input($_POST["cuisine"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z]*$/",$cuisine)) {
      $cuisineErr = "Only letters allowed";
    }
  }

  if (empty($_POST["description"])) {
    $descriptionErr = "description is required";
  } else {
   $description = test_input($_POST["description"]);
  }

  if (empty($_POST["price"])) {
    $commentErr = "Price is required";
  } else {
	$price = test_input($_POST["price"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9.]*$/",$price)) {
      $priceErr = "Only numbers allowed";
    }
  }

  if (empty($_POST["fridge_number"])) {
    $genderErr = "fridge_number is required";
  } else {
	 $fridge_number = test_input($_POST["fridge_number"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$fridge_number)) {
      $fridge_numberErr = "Only numbers allowed";
    }
  }

  // Connecting, selecting database
$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=username user=username password=password") or die('Could not connect: ' . pg_last_error());
//Query database
$query="INSERT INTO db_smart_fridge.meal(cuisine, fridge_id, description, price, meal_name) VALUES('$cuisine', '$fridge_number', '$description', '$price', '$meal_name')";

//$stmt=pg_prepare($dbconn, "ps", $query);
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
  //header("http://localhost/smart_refrigerator/chefPage.html")
  //exit();
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
<div class="center">

<h1 align="center">Creation of a Meal</h1>

<div class="image_meal">
<img src="meal.jpg" alt="meal" style="width:304px;height:228px;">
</div>
<p><span class="error">All field are required.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 Meal name:<br>
  <input type="text" name="meal_name" value="">
  <span class="error" > <?php echo $meal_nameErr;?></span>
  <br>
  Cuisine:<br>
  <input type="text" name="cuisine" value="">
  <span class="error" > <?php echo $cuisineErr;?></span>
  <br>
   Description:<br>
  <input type="text" name="description" value="">
  <span class="error" > <?php echo $descriptionErr;?></span>
  <br>
   Price:<br>
  <input type="text" name="price" value="">
  <span class="error" > <?php echo $priceErr;?></span>
  <br>
  Fridge number:<br>
  <input type="text" name="fridge_number" value="">
  <span class="error" > <?php echo $fridge_numberErr;?></span>
  <br>

  <br>
  <input type="submit" name="submit" value="create Meal">
</form>


<p>If you click the "create Meal" button, a meal will be added on the meal database.</p>

 </article>
 </div>

</body>
</html>
