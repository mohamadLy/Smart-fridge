<?php session_start(); ?>
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
}
</script>
<?php include 'menu.php' ?>
</head>
<body>

<div style="margin-left:25%;padding:1px 16px;height:1000px;" class="center">
<h1 align="center">Users options</h1>
<p>

</p>
<div class="image_meal">
<img src="customerOrderingFood.jpeg" alt="custumer ordering food" style="width:304px;height:228px;" >
</div>

<div class="dropdown">
  <form action="" method="GET">
  <select name="choice_made" id="choice">
  <option value="">Select food by category:</option>
  <option value="Grain">Grain</option>
  <option value="Dairy">Dairy</option>
  <option value="Meat">Meat</option>
  <option value="Fruit">Fruit</option>
  <option value="Juice">Juice</option>
  <option value="Egg">Egg</option>
  </select>
  <input type="submit" value="Select" id="select_category" class="">
</form>
</div>
<button type="button" value="" class="btn" onclick="display()" id="request_meal">Request Meal</button>

<p id="demo"></p>
 </div>

<?php
  if(isset($_GET['choice_made']) )
  {
    $_SESSION["choice_made"]=$_GET['choice_made'];
    echo $_SESSION['choice_made'];
    echo "<script type=\"text/javascript\">display_category()</script>";
  }
?>

</body>
</html>
