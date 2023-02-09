<?php 
  session_start(); 

  //if user is not logged in - retrieved from server.php $_SESSION variable
  if (!isset($_SESSION['username'])) {
  	header('location: homepage.php');
  }
 else{
    //if user is logged in - check usertype
    if($_SESSION['usertype'] == "student"){
        header('location: student-dashboard.php'); //redirect to student dashboard
    }    
    if($_SESSION['usertype'] == "lecturer"){
        header('location: lect-dashboard.php'); //redirect to lecturer dashboard
    }
    if($_SESSION['usertype'] == "admin") {
        header('location: admin-dashboard.php'); //redirect to admin dashboard
    }
  } // end else

//if user logs out - destroy session and redirect to homepage
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
    unset($_SESSION['usertype']);
  	header("location: homepage.php");
  }

?>

