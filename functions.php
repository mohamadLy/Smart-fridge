<?php 
function confirm($result){
    global $connection;
	if(!$result) {
		die("Query FAILED " . pg_last_error());
	}  

}

   function set_message($msg){

        if(!empty($msg)){
        	$_SESSION['message'] = $msg;
        	 // echo $_SESSION['message'];
        } else{
        	$msg="";
        }

    }

  function display_message(){
          if(isset($_SESSION['message'])){
          	echo $_SESSION['message'];
          	// echo "echodisp";
          	unset ($_SESSION['message']);
          }

    }
  
?>