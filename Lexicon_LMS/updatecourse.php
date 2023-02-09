<?php

$PageTitle="Admin - Update Course"; //page title
$page = "#aside-adm-courses"; // active navigation link

include_once('header.php');

if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php');	
}

$type = "course";

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$result = mysqli_query($dbconnect,"SELECT * FROM `course` WHERE `cID`='$id' LIMIT 1");
	$row = mysqli_fetch_assoc($result);
}
else{
	header('location: managecourses.php');
}

$result_lect = mysqli_query($dbconnect,"SELECT `lecID`, `lecName` FROM `lecturer`");
?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php'); ?>	
	<section class="col s12 l9 m9 bg-grey padding-none-imp">	
		<div class="breadcrumb-container">	
			<div class="">
	        	<a href="managecourses.php" class="breadcrumb">Manage Courses</a>
	        	<a href="?id=<?php echo $id;?>" class="breadcrumb">Update Course</a>
	      	</div>
		</div>
		<div class="padding-lr-20">	
		<div class="card  margin-top-40 margin-bottom-40 margin-auto" style="max-width: 600px;">
			<div class="card-content">
				<h4 class="fontw-500 align-center">Update Course</h4>	
				<form method="post" class="row" action="">
					<div class="input-field col s12  l6  margin-bottom-0">
						
	          			<input id="cID1" name="cID1" type="text" class="validate" disabled readonly value="<?php echo $row['cID'];?>" >
          				<label for="cID1">Course ID</label>
          				<input id="cID" name="cID" type="hidden"   value="<?php echo $row['cID'];?>" >
	        		</div>
					<div class="input-field col s12 l6   margin-bottom-0">
	          			<input id="cName" name="cName" type="text" class="validate" value="<?php echo $row['cName'];?>">
          				<label for="cName">Course Name</label>
	        		</div>
	        		<div class="input-field col s12">
			          <textarea id="cDesc" class="materialize-textarea" name="cDesc" value=""><?php echo $row['cDesc'];?></textarea>
			          <label for="cDesc">Course Description</label>
			        </div>
	        		<div class="input-field col  l6 s12 margin-bottom-0">
	          		  <input type="text" class="datepicker" name="startDate" id="startDate" value="<?php echo $row['startDate'];?>">
	          		  <label for="startDate">Start Date</label>
	          		</div>
	          		<div class="input-field col  l6 s12 margin-bottom-0">
	          		  <input type="text" class="datepicker" name="endDate" id="endDate" value="<?php echo $row['endDate'];?>">
	          		  <label for="endDate">End Date</label>
	          		</div>
	          		<div class="input-field col s12 l6">
					    <select id="category" name="category" >

					      <option value="" disabled >Select Category</option>
					      <option value="Language">Language</option>
					      <option value="Maths">Maths</option>
					      <option value="Science">Science</option>
					      <option value="Art">Art</option>
					      <option value="Business">Business</option>
					      <option value="Technology">Technology</option>
					    </select>
					    <label>Category</label>
					</div>
					<div class="input-field col s12 l6">

 						<select id="lecAssigned" name="lecAssigned">
					      <option value="" disabled >Select Lecturer</option>
							<?php 
								if (mysqli_num_rows($result_lect) > 0) {
							    // output data of each row
							    while($row1 = mysqli_fetch_assoc($result_lect)) {

							    	if($row["lecAssigned"] === $row1['lecID']){ ?>
							    		<option selected value="<?php echo $row1["lecID"];?>"><?php echo $row1["lecName"];?></option>
							    	<?php
							    	}
							    	else{
							    	?>									?>
									<option value="<?php echo $row1["lecID"];?>"><?php echo $row1["lecName"];?></option>
							<?php	       
									} 
								}
							}else {
					    		echo "No lecturer accounts found";
								}
							?>	   
					    </select>
					    <label>Assign Lecturer</label> <!--fetch lecturer accounts from database-->
					</div>
					<?php include('errors.php');?> <!--Display PHP errors-->
		          	<p class="color-green padding-lr-10"><?php echo $msg;?>	</p>
        			<div class="input-field col s12 margin-bottom-0">
        				<button class="btn waves-effect waves-light btn-fullw"  type="submit" name="update-course-btn">Update
  						</button> <!--triggers model-->
        			</div>
				</form>
			</div>
		</div>
	</div>
	</section>

</main>
<script type="text/javascript">
	$(document).ready(function(){
		$('#category option[value="<?php echo $row['category'];?>"]').prop('selected', true);
	});
</script>
<?php
include_once('footer.php');
?>