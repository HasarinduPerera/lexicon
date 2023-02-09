<?php
//Student Update Profile
$PageTitle="Student - Update Profile"; //page title
$page = "#aside-stu-profile"; // active navigation link

include_once('header.php'); //header
//authorization check
if($_SESSION['usertype'] != 'student'){
	header('location: 404.php');	
}

$id = $_SESSION['username']; //student ID
$result_stu = mysqli_query($dbconnect,"SELECT * FROM `student` WHERE `sID`='$id' LIMIT 1"); //Select Query
$row = mysqli_fetch_assoc($result_stu); //fetch result
?>
<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?> <!--sidenav-->
	<section class="col s12 l9 m9 bg-grey padding-none-imp">
		<!--Breadcrumb Links-->	
		<div class="breadcrumb-container">	
			<div class="inline" style="display: inline;">
	        	<a href="student-dashboard.php" class="breadcrumb">Dashboard</a>
	        	<a href="studentprofile.php" class="breadcrumb">View Profile</a>
	        	<a href="updatestudent.php" class="breadcrumb">Update Profile</a>
	      	</div>	
		</div>
		<div class="padding-lr-20">	
			<div class="row">
				<div class="col s12 offset-m2 m8 ">
					<div class="card margin-top-40">
						<div class="card-content">
							<h4 class="fontw-500 align-center">Update Profile</h4>	<!--Title-->	
							<form method="post" class="row" action="">
								<!--Student ID-->					
								<div class="input-field col s12   margin-bottom-0">
				          			<input id="sID" name="sID" type="text" class="validate" disabled readonly value="<?php echo $row['sID'];?>" >
			          				<label for="sID">User ID</label>
			          				<input type="hidden" id="userid" name="userid" value="<?php echo $row['sID'];?>"><!--Hidden Input-->	
				        		</div>
				        		<!--Student Name-->
								<div class="input-field col s12 l6  margin-bottom-0">
				          			<input id="accName" name="accName" type="text" value="<?php echo $row['sName']; ?>" class="validate" required>
			          				<label for="accName">Full Name</label>
			          				<span class="helper-text" data-error="Invalid Name Input"></span>
				        		</div>
				        		<!--Birthdate-->
				        		<div class="input-field col  l6 s12 margin-bottom-0">
					          		<input type="text" class="datepicker" name="userDOB" value="<?php echo $row['sDOB']; ?>" id="userDOB" required>
					          		<label for="userDOB">Birthdate</label>
					          		<span class="helper-text" data-error="Invalid Date Input" >Format: yyyy-mm-dd</span>
				          		</div>
				          		<!--Email-->
				        		<div class="input-field col s12   margin-bottom-0">
				          			<input id="userEmail" value="<?php echo $row['sEmail']; ?>" name="userEmail" type="email" class="validate" required>
			          				<label for="userEmail">Email</label>
			          				<span class="helper-text" data-error="Invalid Email Input"></span>
				        		</div>
				        		<!--Password-->
				        		<div class="input-field col s12 l6 margin-bottom-0">
				          			<input id="userPassword" name="userPassword" type="password" class="validate" required>
				          			<label for="userPassword">Password</label>
				          			<span class="helper-text" data-error="Invalid Password" ></span>
				          		</div>
				          		<!--Retype Password-->
				          		<div class="input-field col s12 l6 margin-bottom-0">
				          			<input id="userPassword2" name="userPassword2" type="password" class="validate" required>
				          			<label for="userPassword2">Retype Password</label>
				          			<span class="helper-text" data-error="Invalid Password" ></span>
				          		</div>
				          		<!--Usertype-->
				          		<div class=" col s12">
				          			<input type="hidden" id="usertype" name="usertype" value="student">
				          		</div> <!--to declare usertype-->
				          		<?php include('errors.php');?> <!--Display PHP errors-->
				          		<p class="color-green padding-lr-10"><?php echo $msg;?>	</p><!--Display Success Message-->
			        			<div class="input-field col s12 margin-bottom-0">
			        				<button class="btn waves-effect waves-light btn-fullw "  type="submit" name="update_account">Update
			  						</button> <!--Update Button-->
			        			</div>
							</form> <!--contact form end-->
						</div><!--card-content div close-->
					</div><!--card div close-->	
				</div> 
			</div>
		</div>
	</section>
</main>
<?php
include_once('footer.php');
?>