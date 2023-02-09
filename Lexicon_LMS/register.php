<?php
//student registration page
$PageTitle="Register"; //page title

require_once('header.php'); //mandatory header.php file
include('session.php'); // check if user is logged in. If user is logged in, this page cannot be accessed
?>
<style type="text/css">
.Signin {
	color: #F05354;
}
</style>

<main class=" bg-grey">
	<section class="container">
		<div class="row">
			<div class="col s12 offset-m2 m8 ">
				<div class="card margin-top-40">
					<div class="card-content">
						<h4 class="fontw-500 align-center">Register</h4> <!--title-->
						<form method="post" class="row" action="#register-stu">	
							<!--Full Name-->						
							<div class="input-field col s12 l6  margin-bottom-0">
			          			<input id="accName" name="accName" type="text" class="validate" required><!--input field-->	
		          				<label for="accName">Full Name</label>
		          				<span class="helper-text" data-error="Invalid Name Input"></span><!--materialize js validation-->	
			        		</div>
			        		<!--Birthdate-->	
			        		<div class="input-field col  l6 s12 margin-bottom-0">
			          		  <input type="text" class="datepicker" name="userDOB" id="userDOB" required><!--input field-->	
			          		  <label for="userDOB">Birthdate</label>
			          		  <span class="helper-text" data-error="Invalid Date Input" >Format: yyyy-mm-dd</span><!--materialize js validation-->	
			          		 </div>
			          		<!--Email-->
			        		<div class="input-field col s12   margin-bottom-0">
			          			<input id="userEmail" name="userEmail" type="email" class="validate" required><!--input field-->	
		          				<label for="userEmail">Email</label>
		          				<span class="helper-text" data-error="Invalid Email Input"></span><!--materialize js validation-->	
			        		</div>
			        		<!--Password-->
			        		<div class="input-field col s12 l6 margin-bottom-0">
			          			<input id="userPassword" name="userPassword" type="password" class="validate" required><!--input field-->	
			          			<label for="userPassword">Password</label>
			          			<span class="helper-text" data-error="Invalid Password" ></span><!--materialize js validation-->	
			          		</div>
			          		<!--Retype Password-->
			          		<div class="input-field col s12 l6 margin-bottom-0">
			          			<input id="userPassword2" name="userPassword2" type="password" class="validate" required><!--input field-->	
			          			<label for="userPassword2">Retype Password</label>
			          			<span class="helper-text" data-error="Invalid Password" ></span><!--materialize js validation-->	
			          		</div>
			          		<!--Hidden usertype input field-->
			          		<div class=" col s12">
			          			<input type="hidden" id="usertype" name="usertype" value="student">
			          		</div> <!--to declare usertype-->

			          		<?php include('errors.php');?> <!--Display PHP errors-->

		        			<div class="input-field col s12 margin-bottom-0">
		        				<button class="btn waves-effect waves-light btn-fullw "  type="submit" name="submit_account">Submit
		  						</button> <!--submit button-->
		        			</div>
						</form> <!--contact form end-->

						<p>Existing student? <a href="sign-in.php" class="Signin">Sign In</a></p>
					</div><!--card-content div close-->
				</div><!--card div close-->	
		</div> 
	</div>
</section>
<section id="register-stu">


</section>
</main>

<?php
include_once('footer.php');
?>