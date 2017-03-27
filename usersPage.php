<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="usersPage.css">
<title>Smart refrigirator</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
 function display() {
      var xhttp;
   if (window.XMLHttpRequest) {
     // code for modern browsers
     xhttp = new XMLHttpRequest();
     } else {
     // code for IE6, IE5
     xhttp = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       document.getElementById("demo").innerHTML = this.responseText;
     }
   };
   xhttp.open("GET", "display_meals.php", true);
   xhttp.send();
 }
</script>

<script type="text/javascript">
 function display_category() {
      var xhttp;
   if (window.XMLHttpRequest) {
     // code for modern browsers
     xhttp = new XMLHttpRequest();
     } else {
     // code for IE6, IE5
     xhttp = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       document.getElementById("demo").innerHTML = this.responseText;
     }
   };
   xhttp.open("GET", "select_food_by_category.php", true);
   xhttp.send();
 }
</script>
<script>
function myFunction() {
   var x = document.getElementById("choice");
   var i = x.selectedIndex;
   document.getElementById("demo").innerHTML = x.options[i].text;
   $_SESSION["category_selected"] = x.option[i].text;
}
</script>
</head>
<body>

<div class="center">
<h1 align="center">Users options</h1>
<p>

</p>
<div class="image_meal">
<img src="customerOrderingFood.jpeg" alt="custumer ordering food" style="width:304px;height:228px;" >
</div>

<div class="dropdown">
 <select name="choice_made" id="choice" onchange="myFunction()">
 <option value="">Select food by category:</option>
 <option value="Grain">Grain</option>
 <option value="Dairy">Dairy</option>
 <option value="Meat">Meat</option>
 <option value="Fruit">Fruit</option>
 <option value="Juice">Juice</option>
 <option value="Egg">Egg</option>
 </select>
 <button type="button" value="" id="select_category" class="" onclick="display_category()">Select</button>
</div>
<button type="button" value="" class="btn" onclick="display()" id="request_meal">Request Meal</button>

</div>

<?php echo $_SESSION["username"] ?>
<p id="demo"></p>

<?php
if(isset($_POST['submit'])){
$selected_val = $_POST['Color'];  // Storing Selected Value In Variable
echo "You have selected :" .$selected_val;  // Displaying Selected Value
}
?>
<?php
echo dhad
  if (isset($_POST['choice_made']) && !empty($_POST["choice_made"])) {
    if (true) {
      echo choice_made;
      // Connecting, selecting database
      $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_SESSION['username']." user=".$_SESSION['username']." password=".$_SESSION['password'])
      or die('Could not connect: ' . pg_last_error());
      //Query database
      $query="SELECT * FROM db_smart_fridge.meal";


      $stmt=pg_prepare($dbconn, "ps", $query);
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());

      echo "somethi


    }
  }

?>


</body>
</html>
