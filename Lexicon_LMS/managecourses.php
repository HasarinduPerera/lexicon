<?php 

$PageTitle="Admin - Manage Courses"; //page title
$page = "#aside-adm-courses"; // active navigation link

include_once('header.php');

if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php');	
}

$result_courses = mysqli_query($dbconnect,"SELECT * FROM `course`");

//refer: https://www.w3schools.com/php/php_mysql_select_where.asp

?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?> <!--sidebar nav-->

	<section class="col s12 l9 m9 bg-grey padding-none-imp">	
		<div class="breadcrumb-container margin-bottom-40 bg-grey" >	
			<h1 class="font-w500 page-heading display-inline">Manage Courses</h1>
			<a class="waves-effect waves-light  btn right " href="newcourse.php" ><span class="material-icons left margin-right-5" style="line-height: 32px;">post_add</span></i>Add Course</a> <!--add new course button--> 
		</div>	
		<div class="padding-lr-20">	
			<div class="card">	
				<div class="padding-lr-20">	
					<table class="responsive-table highlight">	
						<thead>
							<tr>
								<th>Course ID</th>
								<th>Course Name</th>
								<th>Category</th>
								<th>Lecturer Assigned</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<!--if query fetches rows-->
						<?php if (mysqli_num_rows($result_courses) > 0) { 
						//while there are rows
			   			while($row = mysqli_fetch_assoc($result_courses)) { 

			   			
							$lecAssigned = $row['lecAssigned'];
							$lect_query = "SELECT * FROM 'lecturer' WHERE 'lecID' = '$lecAssigned' LIMIT 1";
							$lect_sql = mysqli_query($dbconnect,"SELECT * FROM `lecturer` WHERE `lecturer`.`lecID` = '$lecAssigned' LIMIT 1");

							$row1 = mysqli_fetch_assoc($lect_sql); ?>
							<tr class="clickable-row" data-href="viewcourse.php?id=<?php echo $row['cID'];?>">
								<td><?php echo $row['cID'];?></td><!--course ID-->  
								<td><?php echo $row['cName'];?></td> <!--course name-->
								<td><?php echo $row['category'];?></td><!--category-->
								<td><?php echo $row1["lecName"];?></td><!--Name of lecturer assigned-->
								<td>
									<a class="btn btn-icon btn-action" href="viewcourse.php?id=<?php echo $row['cID'];?>" title="View Course"><i class="far fa-eye icon " style="font-size:20px;"></i></a> <!--View Details Button-->
									<a class="btn btn-icon btn-action" href="updatecourse.php?id=<?php echo $row['cID'];?>" title="Update Course"><i class="far fa-edit icon " style="font-size:20px;"></i></a> <!--Edit Details Button-->
									<a class="btn btn-icon btn-action " onclick="return confirm('Are you sure you want to delete <?php echo $row['cID'];?>?')" href="?type=course&delete=<?php echo $row['cID'];?>" title="Delete Course"><i class="far fa-trash-alt icon " style="font-size:20px;"></i></a> <!--Delete button-->
								</td>
							</tr>
							<?php }}
							else {
								echo "<tr><td colspan='11'>No courses added to the system</td></tr>";
							}

							?>
						</tbody>	
					</table>
				</div>					
			</div>	
		</div> <!--padding-lr-20-->		
	</section>
	
</main>

<?php
	
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});

</script>

<?php include_once('footer.php'); ?>