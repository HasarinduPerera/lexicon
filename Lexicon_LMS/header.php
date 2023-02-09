<?php require_once('server.php');?> <!--server.php file for mandatory server side functionalities-->

<!DOCTYPE html>
<html>
<head>
	<!--meta tags-->
	<meta charset="utf-8">
	<meta name="description" content="This website helps you to learn online education courses at your comfortable place for free. The courses for these websites are offered by top teachers in Sri Lanka. You can learn a specific subject without any investment.This websites offer many audio, video, articles and e-books to increase your knowledge as well. This platforms enable you to learn the best free online courses.">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= isset($PageTitle) ? $PageTitle : "LEXICON"?></title> <!--Page title function implemented to implement different title for each page from $PageTitle variable-->
	<link rel="icon" type="image/png" href="images/logo.png"> <!--logo-->

     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> <!--Import Google Icon Font--> 
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/> <!--materialize css-->

    <link rel="stylesheet" href="css/font-awesome.min.css"> <!--font awesome icons-->
	<link rel="stylesheet" type="text/css" href="css/style.css"> <!--stylesheet-->

	<script src="js/jquery.js"></script> <!--jquery-->
    <script src="js/materialize.min.js"></script>	<!--materialize.js file-->	
<style type="text/css">
.header {
	color: #000;
}
</style>
</head>
<body>
	<!--page header-->
	<header>
		<nav>
		    <div class="nav-wrapper">
		      <a href="homepage.php" class="brand-logo"><img src="images/logo.png" alt="LEXICON"></a> <!--logo-->
		      <ul class="right ">
		      	<?php
		      		//if user is not logged in
		      		if(!isset($_SESSION['username'])){ ?>
						<li><a href="sign-in.php"  class="waves-effect waves-light btn">Sign In</a></li>
		        		<li><a href="register.php"  class="waves-effect waves-light btn">Register</a></li>

		      	<?php	} //end if
		      		else{ ?>

		      			<!--if user is logged in-->

		      			<!--username of user - stored in session retrieved from server.php-->
		      			<li>
		      			  <h6 class="color-yellow.darken-1  margin-0">Welcome: <a href="index.php"><i class="fas fa-user fa-sm "></i> <?php echo $_SESSION['accName'];?></a></h6></li>
		      			
		      			<!--logout function-->
		        		<li>
		        			<form method="get" action="index.php">
		        				<button class="waves-effect waves-light btn btn-icon" title="Sign Out" type="submit" name="logout" id="logout"><i class="fas icon fa-xs fa-sign-out-alt"></i></button>
		        			</form>	
		        		</li>		  					        			        			
		      	<?php	} //end else - checking if user is logged in ?>	        
		      </ul>
		    </div>
		  </nav>		
</header> <!--header end-->