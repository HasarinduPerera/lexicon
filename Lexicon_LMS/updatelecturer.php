<?php
//update selected lecturer account
$PageTitle="Admin - Update Lecturer"; //page title
$page = "#aside-adm-lecturer"; // active navigation link

include_once('header.php'); //header

if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php');	
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$result_lec = mysqli_query($dbconnect,"SELECT * FROM `lecturer` WHERE `lecID`='$id' LIMIT 1");	//retrieve lecturer information from lecturer table
}
else{
	header('location: managelecturers.php'); //if no ID is set in the URL, redirect
}	
?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php'); ?>	<!--sidebar-->
	<section class="col s12 l9 m9 bg-grey padding-none-imp">
		<!--breadcrumb links-->	
		<div class="breadcrumb-container">	
			<div class="">
	        	<a href="managelecturers.php" class="breadcrumb">Manage Lecturer</a>
	        	<a href="?id=<?php echo $id;?>" class="breadcrumb">Update Lecturer Account</a>
	      	</div>
		</div><!--breadcrumb links end-->
		<div class="padding-lr-20">	
			<?php if (mysqli_num_rows($result_lec) > 0) {
				//if lecturer account found 
				$row = mysqli_fetch_assoc($result_lec);
			?>
				<div class="card margin-top-40 margin-bottom-40 margin-auto" style="max-width: 600px;">
					<div class="card-content">
						<h4 class="fontw-500 align-center">Update Lecturer Account</h4>	
						<form method="post" class="row" action="#register-lec">
							<!--lecturer ID-->
							<div class="input-field col s12   margin-bottom-0">
			          			<input id="lecID" name="lecID" type="text" class="validate" disabled readonly value="<?php echo $row['lecID'];?>" >
		          				<label for="lecID">User ID</label>
		          				<input type="hidden" id="userid" name="userid" value="<?php echo $row['lecID'];?>">
			        		</div>
			        		<!--Full Name-->
							<div class="input-field col s12   margin-bottom-0">
			          			<input id="accName" name="accName" type="text" value="<?php echo $row['lecName'];?>" class="validate">
		          				<label for="accName">Full Name</label>
			        		</div>
			        		<!--Lecturer Email-->
			        		<div class="input-field col s12   margin-bottom-0">
			          			<input id="userEmail" name="userEmail" value="<?php echo $row['lecEmail'];?>" type="email" class="validate">
		          				<label for="userEmail">Email</label>
			        		</div>
			        		<!--Password-->
			        		<div class="input-field col s12 l6  margin-bottom-0">
			          			<input id="userPassword" name="userPassword" value="" type="password" class="validate">
			          			<label for="userPassword">Password</label>
			          		</div>
			          		<!--Retype Password-->
			          		<div class="input-field col s12 l6  margin-bottom-0">
			          			<input id="userPassword2" value="" name="userPassword2" type="password" class="validate">
			          			<label for="userPassword2">Retype Password</label>
			          		</div>
			          		<!--usertype-->
			          		<div class=" col s12">
			          			<input type="hidden" id="usertype" name="usertype" value="lecturer">
			          		</div> <!--to declare usertype-->
			          		<?php include('errors.php');?> <!--Display PHP errors-->
			          		<p class="color-green padding-lr-10"><?php echo $msg;?>	</p><!--Display success message-->
		        			<div class="input-field col s12 margin-bottom-0">
		        				<button class="btn waves-effect waves-light btn-fullw "  type="submit" name="update_account">Update
		  						</button> <!--update button-->
		        			</div>
						</form>
					</div>
				</div><!--card end-->
	<?php	} //end if
			else{
				echo "<br>";
				array_push($errors, "No lecturer account found with given Lecturer ID"); 
				include('errors.php'); //error message				
			}
		?>
		</div>
	</section>
</main>
<?php
include_once('footer.php');
?>