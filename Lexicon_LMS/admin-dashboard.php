<?php
//Admin Dashboard - post log in
$PageTitle="Admin Portal - Lexicon"; //page title
$page = "#aside-adm-dashboard"; //sidebar active page class implementation

include_once('header.php'); //header element

//ensure that only admin is able to access this page
if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php'); //any unathorized users will be redirected to the 404 error page
}
?>

<main class="row flex width-full margin-0">	
	<?php include_once('aside.php');?>96 <!--sidebar-->
	<section class="col s12 l9 m9 bg-grey">
		<div class="container-fluid">
			<h1 class="page-heading">Dashboard</h1><!--heading-->
			<div class="row">
				<!--manage lecturers-->
				<div class="col s12 m6 l4">
					<a href="managelecturers.php">
						<div class="card ">
					        <div class="card-content align-center">
					        	<img src="images/lecturer-icon.png" class="dashboard-icon" type="images/png" alt="My Profile">
					          <h5 class=" fontw-500 color-black margin-top-0 margin-bottom-25">Manage Lecturers</h5>
				          </div>
					    </div>
					</a>
				</div><!--col end-->
				<!--manage courses-->
				<div class="col s12 m6 l4">
					<a href="managecourses.php">
						<div class="card ">
					        <div class="card-content align-center">
					        	<img src="images/courses-icon.png" class="dashboard-icon" type="images/png" alt="My Profile">
					          	<h5 class=" fontw-500 color-black margin-top-0 margin-bottom-25">Manage Courses</h5>
					        </div>
					    </div>
					</a>
				</div><!--col end-->
				<!--manage students-->
				<div class="col s12 m6 l4">
					<a href="managestudents.php">
						<div class="card ">
					        <div class="card-content align-center">
					        	<img src="images/my-courses-icon.png" class="dashboard-icon" type="images/png" alt="My Profile">
					          	<h5 class=" fontw-500 color-black margin-top-0 margin-bottom-25">Manage Students</h5>
				          </div>
					    </div>
					</a>
				</div><!--col end-->
			</div><!--row end-->
		</div><!--container end-->		
	</section>
</main>

<?php
include_once('footer.php'); //footer code
?>