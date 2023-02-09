<?php
//Sign In Page - Student
$PageTitle="Sign In"; //title tag

include_once('header.php'); //including header elements
include('session.php'); //check if there is an active log in session
?>
<style type="text/css">
.Btn {
	color: #F05354;
}
.registerbtn {
	color: #F05354;
}
.signin {
	color: #F05354;
}
.username {
	color: #F05354;
}
</style>


<main class=" bg-grey">
	<section class="container">
		<div class="row">
			<div class="col s12 offset-m2 m8 offset-l3 l6">
				<div class="card margin-top-40">
					<div class="card-content">
						<h4 class="fontw-500 align-center">Sign In</h4>	
						<form method="post" class="row" action="sign-in.php">
							<!--Username-->
			        		<div class="input-field col s12 margin-bottom-0">
			          			<input id="username" name="username" type="text" class="validate"  required>
		          				<label for="username">Username</label>
		          				<span class="helper-text" data-error="Invalid input. Please enter email or student ID" >Email or Student ID</span>		     
			        		</div>	
			        		<!--Password-->
			        		<div class="input-field col s12 margin-bottom-0">
			          			<input id="userPassword" name="userPassword" type="password" class="validate"  required>
			          			<label for="userPassword">Password</label>
			          			<span class="helper-text" data-error="Invalid password input" ></span>		          			
			          		</div>
			          		<!--Hidden Input Field - Usertype Value-->
			          		<div class=" col s12">
			          			<input type="hidden" id="usertype" name="usertype" value="student">
			          		</div> <!--to declare usertype-->
			          		
			          		<?php include('errors.php');?> <!--Display PHP errors-->
		        			<div id="submit-btn" class="input-field col s12 margin-bottom-0">
		        				<span class="Btn">
		        				<button class="btn waves-effect waves-light btn-fullw"  type="submit" name="action">Sign In
		  						</button>
		        				</span> <!--Sign In Button-->
		        			</div>
						</form> <!--sign in form end-->

						<p>Don't have an account? <a href="register.php" class="registerbtn">Register Now</a></p>
						<p>Are you staff? <a href="staff-signin.php" class="registerbtn">Signin Here</a></p>
					</div><!--card-content div close-->
				</div><!--card div close-->	
			</div> 
		</div>
	</section>
</main>

<?php
include_once('footer.php'); //footer 
?>