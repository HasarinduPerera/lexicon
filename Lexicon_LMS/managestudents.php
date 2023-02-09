<?php 
//manage student page

$PageTitle="Admin - Manage Students"; //page title
$page = "#aside-adm-students"; // active navigation link

include_once('header.php'); //header

if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php'); //if user is not admin	
}

$result_stu = mysqli_query($dbconnect,"SELECT * FROM `student` ORDER BY `status` DESC , `sID` ASC "); //select all student accounts - sort in descending order making "pending" accounts first
?>

<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?> <!--sidebar navigation-->
	<section class="col s12 l9 m9 bg-grey padding-none-imp">	
		<div class="breadcrumb-container margin-bottom-40 bg-grey" >	
			<h1 class="font-w500 page-heading display-inline">Manage Students</h1><!--title-->
		</div>	
		<div class="padding-lr-20">	
			<div class="card">
				<div class="card-content">
					<table class="highlight responsive-table">
				        <thead>
				          <tr>
				              <th>Student ID</th>
				              <th>Name</th>
				              <th>Birthdate</th>
				              <th>Email</th>
				              <th>Status</th>
				              <th>Action</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        	//if student accounts are found
				       		if (mysqli_num_rows($result_stu) > 0) { 
				       			//while there are rows
				       			while($row = mysqli_fetch_assoc($result_stu)) { ?>
				       				<!--clickable rows-->
						       		<tr class='clickable-row' data-href="viewstudent.php?id=<?php echo $row['sID'];?>">
						       			<td><?php echo $row['sID'];?></td><!--Student ID-->
										<td><?php echo $row['sName'];?></td><!--Student Name-->
										<td><?php echo $row['sDOB'];?></td><!--Birthdate-->
										<td><?php echo $row['sEmail'];?></td><!--Student Email-->
										<td><?php echo $row['status'];?></td><!--Registration Status-->
										<td>
											<a class="btn btn-icon btn-action" href="viewstudent.php?id=<?php echo $row['sID'];?>"><span class="material-icons icon">visibility</span></a> <!--view student profile-->
											<a class="btn btn-icon btn-action " onclick="return confirm('Are you sure you want to delete <?php echo $row['sID'];?>?')" href="?type=student&delete=<?php echo $row['sID'];?>"><i class="far fa-trash-alt icon " style="font-size:20px;"></i></a><!--delete student profile-->
										</td><!--Action-->
									</tr><!--end table row - student row-->		
						<?php 	}//end while
							} //end if
						    else{ //no rows found in student table (database) ?>
				       			<tr>
				       				<td colspan="6">No students registered</td>
				       			</tr>
						<?php }// end else?>
				       	</tbody>
				    </table><!--table end-->
				</div><!--card-content end-->
			</div><!--card end-->
		</div><!--padding-lr-20 end-->
	</section>	
</main>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $(".clickable-row").click(function() {
	        window.location = $(this).data("href");
	    });
	});
</script>
<?php	
include_once('footer.php');
?>
