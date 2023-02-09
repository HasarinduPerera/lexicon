<?php
//Staff Sign In Page
$PageTitle="Staff Sign In";

include_once('header.php'); //page header
include('session.php'); //This page cannot be access if user is already logged in

?>
<style type="text/css">
.staff {
	color: #F05354;
}
.email {
	color: #F05354;
}
.type {
	color: #000;
}
</style>

<main class=" bg-grey">
	<section class="container">
		<div class="row">
			<div class="col s12 offset-m2 m8 offset-l3 l6">
				<div class="card margin-top-40">
					<div class="card-content">
						<h4 class="fontw-500 align-center"><span class="staff">Staff Sign In</span></h4><!--title-->
						<form method="post" class="row" action="staff-signin.php">
							<!--username-->
			        		<div class="input-field col s12 margin-bottom-0">
			          			<span class="type">
			          			<input id="username" name="username" type="text" class="validate"  required>
		          				<label for="username">Username</label>
		          				<span class="helper-text" data-error="Invalid input. Please enter email or user ID" >Email or User ID</span>
	          			    </span></div>	
		          			<span class="type"><!--password-->
			        		</span>
		          			<div class="input-field col s12 margin-bottom-0">
		          			  <span class="type">
		          			    <input id="userPassword" name="userPassword" type="password" class="validate" required >
		          			    <label for="userPassword">Password</label>
          			        </span></div>
			          		<!--usertype-->
			          		<div class=" col s12">
			          			<p class="fontw-500" style="margin-bottom:5px;">Usertype:</p>
			          			<p>
								    <label for="lecturer" style="margin-left:-5px;">
								      <input class="with-gap" value="lecturer" name="usertype" type="radio" id="lecturer" required />
								      <span>Lecturer</span>
								    </label>
								    <label for="admin" class="margin-left-15">
								      <input class="with-gap" value="admin" name="usertype" type="radio" id="admin"  required/>
								      <span>Admin</span>
								    </label>
							  	</p>
							  	<br>
			          		</div>
			          		<?php include('errors.php');?><!--display errors-->
		        			<div id="submit-btn" class="input-field col s12 margin-bottom-0">
		        				<button class="btn waves-effect waves-light btn-fullw" type="submit" name="action">Sign In
		  						</button> <!--Sign In Button-->
		        			</div>
						</form> <!--Sign In form end-->
						<p class="align-left">Trouble logging in? Contact: <a href="mailto:support@abctuitioncentre.com" class="email">support@lexicon.com</a></p>
					</div><!--card-content div close-->
				</div><!--card div close-->	
			</div> 
		</div>
	</section>
</main>

<?php
include_once('footer.php'); //page footer
?>