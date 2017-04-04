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
<?php include 'menu.php' ?>
</head>
<body>

<div style="margin-left:25%;padding:1px 16px;height:1000px;" class="center">
<h1 align="center">Users options</h1>

<div class="image_meal">
<img src="customerOrderingFood.jpeg" alt="custumer ordering food" style="width:304px;height:228px;" >
</div>

<div class="dropdown">
 <select name="choice_made" id="choice">
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

<p id="demo"></p>
</div>




</body>
</html>
