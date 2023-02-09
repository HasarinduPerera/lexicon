<?php
//courses enrolled page
$PageTitle="Courses Enrolled"; //page title
$page = "#aside-stu-enrolled"; //active sidenav link

include_once('header.php'); //header

//authorization check
if($_SESSION['usertype'] != 'student'){
	header('location: 404.php');	
}
//student status pending
if($_SESSION['usertype'] == 'student' && $_SESSION['accStatus'] == 'pending'){
		header('location: student-dashboard.php');			
	}
$id = $_SESSION['username']; //student ID
//echo $id;
?>
<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?><!--sidenav-->
	<section class="col s12 l9 m9 bg-grey padding-none-imp">
		<!--breadcrumb-->	
		<div class="breadcrumb-container">	
			<div class="inline" style="display: inline;">
	        	<a href="student-dashboard.php" class="breadcrumb">Dashboard</a>
	        	<a href="coursesenrolled.php" class="breadcrumb">Courses Enrolled</a>
	      	</div>
	      	<a class="waves-effect waves-light  btn right " style="margin-top:-6px;" href="coursesoffered.php" ><span class="material-icons left margin-right-5" style="line-height: 32px;">post_add</span></i>Courses Offered</a> <!--Courses Offered button-->	
		</div>
		<div class="padding-lr-20">	
		<div class="row">
			<div class="col s12  ">
				<div class="card margin-top-40">
					<div class="card-content">
						<h4 class="fontw-500 align-center">Courses Enrolled</h4><!--title-->	
						<div class="card-flex post-login">							
						<?php
						//$get_studID = mysqli_query($dbconnect,"SELECT 'sID' FROM `student` WHERE `sEmail`='$id'");
						$courses_enrolled = mysqli_query($dbconnect,"SELECT * FROM `course-enrolled` WHERE `studID`='$id'"); //retrieve courses enrolled by student

						//if query fetches rows
						if (mysqli_num_rows($courses_enrolled) > 0) { 
							//while there are rows
							while($row_c_enrolled = mysqli_fetch_assoc($courses_enrolled)) { 

								$cID = $row_c_enrolled['courseID']; //course ID

								$result_courses = mysqli_query($dbconnect,"SELECT * FROM `course` WHERE `cID` = '$cID'"); //retrieve course information

								$row = mysqli_fetch_assoc($result_courses);

								//retrieve lecturer assigned details
								$lecAssigned = $row['lecAssigned'];
								$lect_query = "SELECT * FROM 'lecturer' WHERE 'lecID' = '$lecAssigned' LIMIT 1";
								$lect_sql = mysqli_query($dbconnect,"SELECT * FROM `lecturer` WHERE `lecturer`.`lecID` = '$lecAssigned' LIMIT 1");

								$row1 = mysqli_fetch_assoc($lect_sql); ?>

								<!--course card start-->
								<div class=" card sticky-action ">
							        <div class="card-image course <?php echo $row['category'];?>">				          
							          <span class="card-corner"><?php echo $row['category'];?></span> <!--course card category-->
							        </div>
							        <div class="card-content">
							        	<div class="row margin-0">
							        		<span class="card-title activator">
							        			<?php echo $row['cName'];?><i class="material-icons right">more_vert</i>
							        		</span><!--course name-->
							        		<div class="col s12">
												<p class="left-align"><i class="material-icons icon">today</i> <?php echo $row['startDate'];?> - <?php echo $row['endDate'];?></p>
											</div><!--course duration-->
											<div class="col s12 margin-bottom-5">
												<p ><i class="fas fa-chalkboard-teacher fa-icon"></i> <?php echo $row1['lecName'];?></p>
											</div>	<!--lecturer assigned-->
										</div>
							        </div>
							        <div class="card-reveal">
							        	<!--course name-->
									      <span class="card-title grey-text text-darken-4"><?php echo $row['cName'];?><i class="material-icons right">close</i></span>
									      <!--course description-->
									      <p><?php echo $row['cDesc'];?></p>
									</div>
									<!--view progress button-->
							        <div class="card-action">
							        	<a href="viewcourse.php?id=<?php echo $row['cID'];?>" class="btn waves-effect waves-light width-full">View Progress</a> 
							        </div>
								</div> <!--course card end-->
						<?php
							}//end while
						}//end if

						//if student has not enrolled in any course
						else{ ?>

							<div  class=' align-center width-full	'>	
							<p  class='align-center	'>You have not enrolled for any courses yet. Check out the courses offered and enroll now:</p>
							<a class="waves-effect waves-light  btn margin-top-20 "  href="coursesoffered.php" ><span class="material-icons left margin-right-5" style="line-height: 32px;">post_add</span></i>Courses Offered</a>
							</div>				
						<?php
						} //end else ?>
				</div> <!--card flex-->
			</div><!--card-content div close-->
		</div><!--card div close-->	
		</div> <!--col s12-->
	</div> <!--row-->
</div><!--row-->
</section>
</main>
<?php include_once('footer.php');?>