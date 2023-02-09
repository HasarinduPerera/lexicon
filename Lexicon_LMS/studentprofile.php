<?php 
//Student Profile - Authorized only to student as user
$PageTitle="Student - Profile"; //page title
$page = "#aside-stu-profile"; // active navigation link

include_once('header.php');
//ensure that only student usertype is authorized to access this page
if($_SESSION['usertype'] != 'student'){
	header('location: 404.php');	
}

?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?>
	<section class="col s12 l9 m9 bg-grey padding-none-imp">
		<!--breadcrumb navigation-->	
		<div class="breadcrumb-container">	
			<div class="inline" style="display: inline;">
	        	<a href="student-dashboard.php" class="breadcrumb">Dashboard</a>
	        	<a href="studentprofile.php" class="breadcrumb">View Profile</a>
	      	</div>
	      	
	      	<a class="waves-effect waves-light  btn right " href="updatestudent.php" style="margin-top:-6px;"><i class="far fa-edit material-icon left" style="font-size: 16px;"></i>Update Profile</a> <!--update profile button-->	
		</div><!--breadcrumb navigation end-->

		<div class="padding-lr-20">	
			<div class="card margin-top-40 margin-bottom-40 margin-auto" style="max-width: 600px; color: #000;">
				<div class="card-content">
				    <h4 class="card-title center-align">Student Profile</h4> <!--title-->
				    <br>
				    <!--Student Information Table-->
					<table class="highlight responsive-table">
						<!--Student ID-->		       
				        <tr>
				            <th>Student ID</th>
				            <td colspan="2"><?php echo $_SESSION['username']?></td>
				        </tr>
				        <!--Student Name-->	
				         <tr>
				          	<th>Name</th>
				          	<td colspan="2"><?php echo $_SESSION['accName']?></td>
				         </tr>
				         <!--Student Birthday-->	
				         <tr>
				          	<th>Birthdate</th>
				          	<td colspan="2"><?php echo $_SESSION['accDOB']?></td>
				         </tr>
				         <!--Student Email-->	
				         <tr>
				          	<th>Email</th>
				          	<td colspan="2"><?php echo $_SESSION['accEmail']?></td>
				         </tr>
				         <!--Student Registration Status-->	
				         <tr>
				          	<th>Status</th>
				          	<td><?php echo $_SESSION['accStatus']?></td>		          	
				        </tr>  
				    </table>	
				</div><!--card content end-->
			</div><!--card end-->
		</div>		
	</section>	
</main>
<?php
include_once('footer.php'); //footer
?>