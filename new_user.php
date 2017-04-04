<?php
ob_start();
session_start();
include("functions.php");

$firstn_Err = $last_n = $return_fetch= "";
$first_n = $lastn_Err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $firstn_Err = "first name is required";
  } else {
    $first_n = test_input($_POST["fname"]);
  }
    // check if name only contains letters and whitespace
    if (empty($_POST["lname"])) {
      $lastn_Err = "last name required too";
    } else {
      $last_n = test_input($_POST["lname"]);
    }

    if ($first_n != NULL && $last_n != NULL) {

      // Connecting, selecting database
      $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_SESSION['username']." user=".$_SESSION['username']." password=".$_SESSION['password'])
      or die('Could not connect: ' . pg_last_error());

      $query="INSERT INTO db_smart_fridge.users(fname, lname) VALUES('$first_n', '$last_n')";

      $stmt=pg_prepare($dbconn, "ps", $query);
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());

      confirm($result);

      $sql="INSERT INTO db_smart_fridge.regular_user(user_id)
      SELECT U.user_id FROM db_smart_fridge.users  AS U
      WHERE  U.fname ='$first_n' AND U.lname='$last_n'";

      $stmt=pg_prepare($dbconn, "ps", $sql);
      $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
      confirm($sql);

      $regular=pg_query("SELECT MAX(R.reg_id) FROM db_smart_fridge.regular_user AS R  NATURAL JOIN  db_smart_fridge.users");
      confirm($regular);
      // $row=pg_fetch_array($regular);
      while($row=pg_fetch_array($regular))
      {
        $return_fetch=$row[0];

      }
      //$DELIMETER="New User added. Your regular_id is <br>  $return_fetch"

      set_message("New User added. Your regular_id is: " . $return_fetch );

      // Free resultset
      pg_free_result($result);

      // Closing connection
      pg_close($dbconn);

    }


}


  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <link rel="stylesheet" href="create_meal_style.css">
      <link rel="stylesheet" href="styles.css?version=55">
      <title>Smart refrigirator</title>
      <?php include 'menu.php' ?>
    </head>
    <body>
      <article >
        <div style="margin-left:25%;padding:1px 16px;height:1000px;" class="center">

          <h1 align="center">New User</h1>
          <h2 align="center"><?php  display_message();?> </h2>
          <h2 align="center"><?php //display_omessage();?></h2>


          <p><span class="error">All fields are required.</span></p>
          <form class="" action="" method="post" enctype="multipart/form-data">

            <?php // login_user();  ?>
            <div class="form-group"><label for="">
              First Name<input type="text" name="fname" class="form-control"></label>
            </div>
            <div class="form-group"><label for="">
              Last Name<input type="text" name="lname" class="form-control"></label>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Add User">
            </div>
          </form>
        </div>
      </article>
      <?php include("footer.php"); ?>
