<?php
//courses offered page - authorized for student user only
$PageTitle="Courses Offered"; //page title
$page = "#aside-stu-offered"; //sidenav active link

include_once('header.php');//header

//authorization check
if($_SESSION['usertype'] != 'student'){
	header('location: 404.php'); //redirect	
}
//student status pending
if($_SESSION['usertype'] == 'student' && $_SESSION['accStatus'] == 'pending'){
	header('location: student-dashboard.php');			
}

$id = $_SESSION['username']; //student ID
$result_stu = mysqli_query($dbconnect,"SELECT * FROM `student` WHERE `sID`='$id' LIMIT 1");
$row = mysqli_fetch_assoc($result_stu);
?>
<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?> <!--sidenav-->
	<section class="col s12 l9 m9 bg-grey padding-none-imp">
		<!--breadcrumb links-->	
		<div class="breadcrumb-container">	
			<div class="inline" style="display: inline;">
	        	<a href="student-dashboard.php" class="breadcrumb">Dashboard</a>
	        	<a href="coursesoffered.php" class="breadcrumb">Courses Offered</a>
	      	</div>
	      	<a class="waves-effect waves-light  btn right " style="margin-top:-6px;" href="coursesenrolled.php" ><i class="fas fa-book-open material-icon left" style="font-size: 16px;"></i></i>Courses Enrolled</a> <!--Courses Enrolled button-->	
		</div>

		<div class="padding-lr-20">	

		<div class="row">
			<div class="col s12  ">
				<div class="card margin-top-40">
					<div class="card-content">
						<h4 class="fontw-500 align-center">Courses Offered</h4><!--title-->	
						<div class="card-flex post-login">
							<?php include_once('courses.php');?> <!--populate  courses-->
						</div>
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