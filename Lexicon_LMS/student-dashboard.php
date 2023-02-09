<?php
//student dashboard - only authorized to student usertype
$PageTitle="Student Portal - LEXICON"; //page title
$page = "#aside-stu-dashboard"; //sidenav link

include_once('header.php'); //header

//ensure that only student usertype is authorized to access this page
if($_SESSION['usertype'] != 'student'){
	header('location: 404.php');	
}
?>
<main class="row flex width-full margin-0">	
	<?php include_once('aside.php');?> <!--sidenav-->
	<section class="col s12 l9 m9 bg-grey">
		<div class="container-fluid">
			<h1 class="page-heading">Dashboard</h1> <!--title-->
			<div class="row">
				<!--student profile thumbnail-->
				<div class="col s12 m6 l4">
					<a href="studentprofile.php">
						<div class="card ">
					        <div class="card-content align-center">
					        	<img src="images/profile-icon.png" class="dashboard-icon" type="images/png" alt="My Profile"> <!--thumbnail image-->	
					          <h5 class=" fontw-500 color-red">My Profile</h5> 
					          <!--thumbnail title-->	
					        </div>
					    </div>
					</a>
				</div>
				<?php 
				//if student registration status is active
					if($_SESSION['accStatus'] != "pending"){ ?>
						<!--courses enrolled thumbnail-->
						<div class="col s12 m6 l4">
							<a href="coursesenrolled.php">
								<div class="card ">
							        <div class="card-content align-center">
							        	<img src="images/my-courses-icon.png" class="dashboard-icon" type="images/png" alt="Courses Enrolled"><!--thumbnail image-->
							          	<h5 class=" fontw-500 color-black">Courses Enrolled</h5><!--thumbnail title-->			
							        </div>
							    </div>
							</a>
						</div>
						<!--courses offered thumbnail-->
						<div class="col s12 m6 l4">
							<a href="coursesoffered.php">
								<div class="card ">
							        <div class="card-content align-center">
							        	<img src="images/courses-icon.png" class="dashboard-icon" type="images/png" alt="Courses Offered"><!--thumbnail image-->	
							          	<h5 class=" fontw-500 color-black">Courses Offered</h5><!--thumbnail title-->	
							        </div>
							    </div>
							</a>
						</div>
			<?php	} //end if
					//if student registration status is pending
					else{ ?>
							<div class="col s12 m6 l8">
								<div class="card ">
							        <div class="card-content align-center">	      
							          	<h5 class=" fontw-500 color-green">Status: Pending</h5>
							          	<p>Thank you for registering with LEXICON Your registration status is still pending. You will be able to enroll for courses once your application is approved by the administration.</p>
							          	<br/>
							          	<p >For further enquires please contact: <a href="mailto:admin@lexicon.com">admin@lexicon.com</a></p>		
							        </div>
							    </div>
							</div>
				<?php	} //end status pending ?>
			</div>
		</div>		
	</section>	
</main>
<?php
include_once('footer.php'); //footer
?>