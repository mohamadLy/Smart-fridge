<?php
// Start the session
session_start();
?>
 <!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="styles.css">
 <title>Smart refrigirator</title>
 <style>
  button {
    float: right;
    margin: 50px;
  }
  </style>
</head>
<body>
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
      xhttp.open("GET", "report_orders.php", true);
      xhttp.send();
    }
  </script>
  <script type="text/javascript">
    function approved() {
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
      xhttp.open("GET", "approve_order.php", true);
      xhttp.send();
      alert("Order approve!!")
    }
  </script>
<div class="center">

<h1 align="center">Administrator options</h1>

<img src="administrator.png" align="middle" alt="Chef" style="width:304px;height:228px;">
<a href="add_ingredient.php">
 <button type="button" class="btn">Place Orders</button>
</a>
 <button type="button" class="btn" onclick="display()" id="reportButton">Reports</button>
 </div>
 <p id="demo"></p>
 <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $order_id = $_POST['varname'];
    
     $_SESSION['order_id']=$order_id;
     echo "<script>approved()</script>";
   }
 ?>

</body>
</html>
