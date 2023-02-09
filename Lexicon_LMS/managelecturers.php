<?php 
// Manage Lecturers - Admin Portal
$PageTitle="Admin - Manage Lecturers"; //page title
$page = "#aside-adm-lecturer"; // active navigation link

include_once('header.php'); //header

//ensure that only admin is able to access this page
if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php');	
}

$result_lec = mysqli_query($dbconnect,"SELECT * FROM `lecturer`"); //lecturer query

//refer: https://www.w3schools.com/php/php_mysql_select_where.asp

?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?> <!--sidebar nav-->

	<section class="col s12 l9 m9 bg-grey padding-none-imp">	
		<div class="breadcrumb-container margin-bottom-40 bg-grey" >	
			<h1 class="font-w500 page-heading display-inline">Manage Lecturers</h1><!--Title-->
			<a class="waves-effect waves-light  btn right " href="newlecturer.php" style="margin-top:-6px;"><i class="fas fa-user-plus material-icon left" style="font-size: 16px;"></i>Add Lecturer</a> <!--add new lecturer button-->
		</div>	
		<div class="padding-lr-20">	
			<?php include('errors.php');?> <!--errors while deleting account-->
			<!--if lecturer query fetches rows of lecturer accounts-->
			<?php if (mysqli_num_rows($result_lec) > 0) { 
				//while there are rows of lecturer accounts
	   			while($row = mysqli_fetch_assoc($result_lec)) { ?>
	   				<!--display each lecturer information in a card-->
					<div class="card">	
						<div class="card-content">	
							<div class="row">
								<div class="col l6 s12">
									<!--lecturer information-->
									<div class="card-info">	
										<!--end lecturer profile table-->
										<table class="responsive-table">	
											<tr>	
												<th>Lecturer ID</th>
												<td><?php echo $row['lecID'];?></td>
											</tr><!--lecturer ID-->  
											<tr>
												<th>Name</th>
												<td><?php echo $row['lecName'];?></td>
											</tr><!--lecturer Name-->  
											<tr>
												<th>Email</th>
												<td><?php echo $row['lecEmail'];?></td>
											</tr><!--lecturer Email-->  
										</table><!--end lecturer profile table-->
									</div><!--card-info end-->			
								</div><!--col end-->
								<div class="col l6 s12">
									<!--courses assigned to lecturer-->
									<table class="responsive-table highlight">	
										<thead>	
											<tr>	
												<th colspan="2">Courses Assigned</th>	
											</tr>
										</thead>
										<?php $l_id = $row["lecID"]; //lecturer ID

										//Query to fetch courses assigned to lecturer
										$result_courses = mysqli_query($dbconnect,"SELECT * FROM `course` WHERE `lecAssigned` = '$l_id'");?>
										<tbody>	
											<!--if there are courses assigned to lecturer-->
											<?php if (mysqli_num_rows($result_courses) > 0) { 
									   			while($row_course = mysqli_fetch_assoc($result_courses)) {
									   				?>
									   				<!--clickable course rows-->
													<tr class="clickable-row" data-href="viewcourse.php?id=<?php echo $row_course['cID'];?>">
														<td ><?php echo $row_course['cID'];?></td><!--Course ID-->  
														<td ><?php echo $row_course['cName'];?></td><!--course name-->  
													</tr>
											<?php }//end while
											} //end if
											else{ //no courses assigned to lecturer?>
												<tr>
													<td colspan="2">No courses assigned</td>	
												</tr>
											<?php }//end else?>
										</tbody>
									</table><!--course assigned table end-->
								</div><!--col end-->
							</div><!--row end-->
						</div><!--card-content end-->
						<!--card footer - call-to-action icons-->
						<div class="card-action right-align">
							<a class="btn btn-icon btn-action " href="updatelecturer.php?id=<?php echo $row['lecID'];?>"><i class="fas fa-user-edit icon"></i></a><!--update lecturer information-->
							<a class="btn btn-icon btn-action " onclick="return confirm('Are you sure you want to delete <?php echo $row['lecID'];?>?')" href="?type=lecturer&delete=<?php echo $row['lecID'];?>"><i class="far fa-trash-alt icon "></i></a> <!--delete function-->
						</div><!--card footer end-->
					</div><!--card end-->
	<?php 		} //end while
			} //end if
			else {  //if there are no lecturer accounts?>
				<div class="card">	
					<div class="card-content">
						<div  class=' align-center width-full	'>	
							<p  class='align-center	'>There are no lecturer accounts on the system.</p>
							<br>
							<a class="waves-effect waves-light  btn  " href="newlecturer.php"><i class="fas fa-user-plus material-icon left" style="font-size: 16px;"></i>Add Lecturer</a> <!--add new lecturer button-->
						</div>
					</div>
				</div>
	<?php 	} //end else?>	
		</div> <!--padding-lr-20 end-->	
	</section>	
</main>

<script type="text/javascript">
	//clickable row function
	jQuery(document).ready(function($) {
	    $(".clickable-row").click(function() {
	        window.location = $(this).data("href");
	    });
	});
</script>

<?php
include_once('footer.php');
?>