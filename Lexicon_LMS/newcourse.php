<?php

$PageTitle="Admin - Add Course"; //page title
$page = "#aside-adm-courses"; // active navigation link

include_once('header.php');

if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php');	
}
$type = "course";
include_once("setid.php"); //set Course ID

$cID = $setID; //course ID

$result_lect = mysqli_query($dbconnect,"SELECT `lecID`, `lecName` FROM `lecturer`");

//refer: https://www.w3schools.com/php/php_mysql_select_where.asp

?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php'); ?>	
	<section class="col s12 l9 m9 bg-grey padding-none-imp">	
		<div class="breadcrumb-container">	
			<div class="">
	        	<a href="managecourses.php" class="breadcrumb">Manage Courses</a>
	        	<a href="newcourse.php" class="breadcrumb">Add New Course</a>
	      	</div>
		</div>
		<div class="padding-lr-20">	
		<div class="card  margin-top-40 margin-bottom-40 margin-auto" style="max-width: 600px;">
			<div class="card-content">
				<h4 class="fontw-500 align-center">Add New Course</h4>	
				<form method="post" class="row" action="#addcourse">
					<div class="input-field col s12  l6  margin-bottom-0">
						
	          			<input id="cID1" name="cID1" type="text" class="validate" disabled readonly value="<?php echo $cID;?>" >
          				<label for="cID1">Course ID</label>
          				<input id="cID" name="cID" type="hidden"   value="<?php echo $cID;?>" >
	        		</div>
					<div class="input-field col s12 l6   margin-bottom-0">
	          			<input id="cName" name="cName" type="text" class="validate">
          				<label for="cName">Course Name</label>
	        		</div>
	        		<div class="input-field col s12">
			          <textarea id="cDesc" class="materialize-textarea" name="cDesc"></textarea>
			          <label for="cDesc">Course Description</label>
			        </div>
	        		<div class="input-field col  l6 s12 margin-bottom-0">
	          		  <input type="text" class="datepicker" name="startDate" id="startDate">
	          		  <label for="startDate">Start Date</label>
	          		</div>
	          		<div class="input-field col  l6 s12 margin-bottom-0">
	          		  <input type="text" class="datepicker" name="endDate" id="endDate">
	          		  <label for="endDate">End Date</label>
	          		</div>
	          		<div class="input-field col s12 l6">
					    <select id="category" name="category">
					      <option value="" disabled selected>Select Category</option>
					      <option value="Web Design">Web Design</option>
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
					      <option value="" disabled selected>Select Lecturer</option>
							<?php 
								if (mysqli_num_rows($result_lect) > 0) {
							    // output data of each row
							    	while($row1 = mysqli_fetch_assoc($result_lect)) { ?>
										<option value="<?php echo $row1["lecID"];?>"><?php echo $row1["lecName"];?></option>
									<?php      
									} //end while
								} //end if
								else {
						    		echo "No lecturer accounts found";
									}
								?>	   
					    </select>
					    <label>Assign Lecturer</label> <!--fetch lecturer accounts from database-->
					</div>
					<?php include('errors.php');?> <!--Display PHP errors-->
		          	<p class="color-green padding-lr-10"><?php echo $msg;?>	</p>
        			<div class="input-field col s12 margin-bottom-0">
        				<button class="btn waves-effect waves-light btn-fullw"  type="submit" name="course-btn">Submit
  						</button> <!--submit button-->
        			</div>
				</form>
			</div>
		</div>
	</div>
	</section>
	<section id="addcourse">
	
	</section>
</main>

<?php include_once('footer.php'); ?>