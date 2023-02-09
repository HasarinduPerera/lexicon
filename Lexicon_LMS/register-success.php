<?php
//Student registration success page
$PageTitle="Registration Success";

include_once('header.php'); //mandatory header content
include('session.php'); //user not allowed to access this page if logged in

if(!isset($_SESSION['sID'])){
	//if user ID is not set abd saved in $_SESSION variable during registration 
    	header("location: register.php"); //redirect user
	}
?>

<main class=" bg-grey">
	<section class="container">
		<div class="row">
			<div class="col s12 offset-m2 m8 ">
				<div class="card margin-top-40">
					<div class="card-content">
						<h4 class="color-green fontw-500 center-align">Registration Application Received!</h4>
				      	
				      	<h5 class="fontw-500 center-align id-highlight">Your Student ID is : <span class="font-bold"><?php echo $_SESSION['sID'];?></span></h5>
				      
				      	<p class="color-grey align-justify margin-bottom-10">Thank you for registering with LEXICON Learning Management System. Please save your student ID. It will act as your username while you are studying in LEXICON.</p>
				      	<p class="color-grey align-justify">You will be able to enroll for courses once your reigstration application is reviewed and approved by the administrative staff.</p>
					</div><!--card-content div close-->
				</div><!--card div close-->	
			</div> 
		</div>
	</section>
</main>	

<?php
unset($_SESSION['sID']); //remove $_SESSION['sID'] value after landing on this page to prevent user from coming to this page again unauthorized
include_once('footer.php');
?>