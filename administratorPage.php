<?php
// Start the session
session_start();
?>
 <!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="styles.css">
 <title>Smart refrigirator</title>
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
    }
  </script>
<div class="center">

<h1 align="center">Administrator options</h1>

<img src="administrator.png" align="middle" alt="Chef" style="width:304px;height:228px;">
 <button type="button" class="btn">Place Orders</button>
 <button type="button" class="btn">Approve Orders</button>
 <button type="button" class="btn" onclick="display()">Reports</button>
 </div>
 <p id="demo"></p>
 <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $where_clause= "WHERE order_id=".$_SESSION['order_id'];
     echo $where_clause;
     echo "<script>approved()</script>";
   }
 ?>

</body>
</html>