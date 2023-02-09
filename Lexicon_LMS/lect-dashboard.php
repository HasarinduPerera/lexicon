<?php
//lecturer dashboard
$PageTitle="Lecturer Dashboard - LEXICON LMS"; //page title
$page = "#aside-lec-dashboard"; //active side nav
function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }
include_once('header.php');
//authorization check
if($_SESSION['usertype'] != 'lecturer'){
	header('location: 404.php');	
}
?>

<main class="row flex width-full margin-0">	
	<?php include_once('aside.php');?><!--side nav-->
	<section class="col s12 l9 m9 bg-grey">
		<div class="container-fluid">
			<h1 class="page-heading">Dashboard</h1><!--title-->
			<div class="row">
				<div class="col s12  ">
					<div class="card margin-top-40">
						<div class="card-content">
							<h4 class="fontw-500 align-center">Courses Assigned</h4><!--subtitle-->	
							<div class="card-flex post-login">							
							<?php
							$id =$_SESSION['username']; //lecturer ID

							//retrieve all courses assigned to lecturer
							$courses_assigned = mysqli_query($dbconnect,"SELECT * FROM `course` WHERE `lecAssigned`='$id'"); 
							//if query fetches rows
							if (mysqli_num_rows($courses_assigned) > 0) { 
								//while there are rows
								while($row = mysqli_fetch_assoc($courses_assigned)) { 				
									//retrieve lecturer assigned details
									$lecAssigned = $row['lecAssigned']; //lecturer ID
									$lect_query = "SELECT * FROM 'lecturer' WHERE 'lecID' = '$lecAssigned' LIMIT 1";
									$lect_sql = mysqli_query($dbconnect,"SELECT * FROM `lecturer` WHERE `lecturer`.`lecID` = '$lecAssigned' LIMIT 1");

									$row1 = mysqli_fetch_assoc($lect_sql); 	?>

									<!--course card start-->
									<div class=" card sticky-action ">
								        <div class="card-image course <?php echo $row['category'];?>">				          
								          <span class="card-corner"><?php echo $row['category'];?></span> <!--course category-->
								        </div>
								        <div class="card-content">
								        	<div class="row margin-0">
								        		<!--course name-->
								        		<span class="card-title activator"><?php echo $row['cName'];?><i class="material-icons right">more_vert</i></span>
								        		<!--course duration-->
								        		<div class="col s12">
													<p class="left-align"><i class="material-icons icon">today</i> <?php echo $row['startDate'];?> - <?php echo $row['endDate'];?></p>
												</div>
												<!--lecturer assigned-->
												<div class="col s12 margin-bottom-5">
													<p ><i class="fas fa-chalkboard-teacher fa-icon"></i> <?php echo $row1['lecName'];?></p>
												</div>	
											</div>
								        </div>
								        <!--course more info-->
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
							else{  //no courses assigned?>
								<div  class=' align-center width-full	'>	
									<p  class='align-center	'>No courses have been assigned to you yet. For queries, please contact the admin:</p>
									<a class="waves-effect waves-light margin-top-20 "  href="mailto:admin@lexicon.com" >admin@lexicon.com</a>
								</div>	
						<?php
							} //end else	?>
					</div> <!--card flex-->
				</div><!--card-content div close-->
			</div><!--card div close-->	
			</div> <!--col s12-->
		</div> <!--row-->	
	</section>	
</main>
<?php include_once('footer.php'); ?>