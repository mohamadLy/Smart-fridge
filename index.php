<?php session_start(); ?>
 <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="welcomeStyle.css">
 <link rel="stylesheet" href="styles.css">
 <title>Smart refrigirator</title>
</head>
<body>
<article>
<div class="center">

<h1 align="center">Welcome to smart refrigirator</h1>
<h2 align="center"> The idea behind the Project</h2>
<p>
	The Internet of Things is allowing "people and things to be connected anytime,</br>
	anyplace,  with  anything  and  anyone,  ideally  using  any  path/network  and  any </br>
service." Smart refrigerator is a refrigerator which has been programmed to </br>
sense what kinds of products are being stored inside it and keep a track of the <br>
stock. This kind of refrigerator is often equipped to automatically determine when <br>
a food item needs to be replenished. We will simplify the project and let the  <br>
user interact with the refrigerator and provide users with different information<br>
about their products and consumption history.<br>
</p>

<img src="foodManager.jpg" alt="Chef" style="width:304px;height:228px;" align="middle">
<a href="users_page.php">
 <button type="button" class="btn" >login as Customer</button>
 </a>
 <a href="chefPage.html">
 <button type="button" class="btn">login as Chef</button>
  </a>
 <a href="administratorPage.php">
 <button type="button" class="btn">login as Administrator</button>
  </a>
 </article>

 <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $_SESSION["username"] = $_POST["iuser"];
   //echo $_SESSION["username"];
   $_SESSION["password"] = $_POST["ipass"];
 }
?>
 </div>
</body>
</html>
