<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="styles.css">
 <title>Smart refrigirator</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $id = $_POST["id"];
    if ($id == 1) {
      $_SESSION["chef_view"] = "chef1";
      echo "SELECT * FROM " .$_SESSION['chef_view'];
    } elseif ($id == 2) {
      $_SESSION["chef_view"] = "chef2";
    }
  }
   ?>
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
      xhttp.open("GET", "chef_report_order.php", true);
      xhttp.send();
    }
  </script>
<div class="center">

	<h1 align="center">Chef options</h1>

	<img src="chef.png" alt="Chef" style="width:304px;height:228px;">
	<a href="create_meal.php">
		<button type="button" class="btn">New Meals</button>
	</a>
 	<a href="place_order.php">
    <button type="button" class="btn">Place Orders</button>
  </a>
<button type="button" class="btn" onclick="display()" id="reportButton">Reports</button>

<p id="demo"></p>
</div>

</body>
</html>
