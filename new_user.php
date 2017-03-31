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
               $first_n = test_input($_POST["fname"]); }
                // check if name only contains letters and whitespace
                if (empty($_POST["lname"])) {
                  $lastn_Err = "last name required too";
                } else {
               $last_n = test_input($_POST["lname"]);
                }



  // Connecting, selecting database
          $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_SESSION['username']." user=".$_SESSION['username']." password=".$_SESSION['password'])
          or die('Could not connect: ' . pg_last_error());
          echo "string";
       $query=pg_query("INSERT INTO db_smart_fridge.users (fname,lname) VALUES ($first_n,$last_n))";
       confirm($query);

       echo "before";
    $sql=pg_query("INSERT INTO db_smart_fridge.regular_user(user_id)
                    SELECT U.user_id FROM db_smart_fridge.users  as U
                       WHERE  U.fname =$first_n AND U.lname=$last_n)";
    confirm($sql);

    echo "after";

    $regular=pg_query("SELECT MAX(R.reg_id) FROM db_smart_fridge.regular_user AS R  NATURAL JOIN  db_smart_fridge.users");
    confirm($regular);
     // $row=pg_fetch_array($regular);
    while($row=pg_fetch_array($regular))
    {
        $return_fetch=$row[0];

    }
    //$DELIMETER="New User added. Your regular_id is <br>  $return_fetch"

   set_message("New User added. Your regular_id is: " . $return_fetch );

}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="create_meal_style.css">
 <link rel="stylesheet" href="styles.css?version=55">
 <title>Smart refrigirator</title>

</head>
<body>
<article>
<div class="center">

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
