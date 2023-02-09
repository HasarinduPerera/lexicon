<?php
//admin - add new lecturer
$PageTitle="Admin - Add Lecturer"; //page title
$page = "#aside-adm-lecturer"; // active navigation link

include_once('header.php'); // header
// usertype of logged in user
if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php');	
}
$usertype = "lecturer"; //user type of new account to add
include_once("setid.php"); //set lecturer ID
?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php'); ?>	<!--sidebar navigation-->
	<section class="col s12 l9 m9 bg-grey padding-none-imp">
		<!--breadcrumb links-->	
		<div class="breadcrumb-container">	
			<div class="">
	        	<a href="managelecturers.php" class="breadcrumb">Manage Lecturer</a>
	        	<a href="newlecturer.php" class="breadcrumb">Add New Lecturer</a>
	      	</div>
		</div><!--breadcrumb links end-->	
		<div class="padding-lr-20">	
			<div class="card margin-top-40 margin-bottom-40 margin-auto" style="max-width: 600px;">
				<div class="card-content">
					<h4 class="fontw-500 align-center">Add New Lecturer</h4>	
					<form method="post" class="row" action="#register-lec">
						<!--Lecturer ID - non-editable-->	
						<div class="input-field col s12   margin-bottom-0">
		          			<input id="lecID" name="lecID" type="text" class="validate" disabled readonly value="<?php echo $setID;?>" >
	          				<label for="lecID">User ID</label>
		        		</div>
		        		<!--Lecturer Full Name-->
						<div class="input-field col s12   margin-bottom-0">
		          			<input id="accName" name="accName" type="text" class="validate" required>
	          				<label for="accName">Full Name</label>
	          				<span class="helper-text" data-error="Invalid Name Input"></span><!--materialize js validation-->	
		        		</div>
		        		<!--Lecturer Email-->
		        		<div class="input-field col s12   margin-bottom-0">
		          			<input id="userEmail" name="userEmail" type="email" class="validate" required>
	          				<label for="userEmail">Email</label>
	          				<span class="helper-text" data-error="Invalid Email Input"></span><!--materialize js validation-->	
		        		</div>
		        		<!--Password-->
		        		<div class="input-field col s12 l6  margin-bottom-0">
		          			<input id="userPassword" name="userPassword" type="password" class="validate" required>
		          			<label for="userPassword">Password</label>
		          			<span class="helper-text" data-error="Invalid Password" ></span><!--materialize js validation-->
		          		</div>
		          		<!--Retype Password-->
		          		<div class="input-field col s12 l6  margin-bottom-0">
		          			<input id="userPassword2" name="userPassword2" type="password" class="validate" required>
		          			<label for="userPassword2">Retype Password</label>
		          			<span class="helper-text" data-error="Invalid Password" ></span><!--materialize js validation-->
		          		</div>
		          		<!--Hidden field - usertype-->
		          		<div class=" col s12">
		          			<input type="hidden" id="usertype" name="usertype" value="lecturer">
		          		</div> <!--to declare usertype-->
		          		<?php include('errors.php');?> <!--Display PHP errors-->
		          		<p class="color-green"><?php echo $msg;?></p><!--Display success message-->
	        			<div class="input-field col s12 margin-bottom-0">
	        				<button class="btn waves-effect waves-light btn-fullw "  type="submit" name="submit_account">Submit
	  						</button> <!--submit button-->
	        			</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<section id="register-lec">

	</section>

</main>

<?php
include_once('footer.php');
?>