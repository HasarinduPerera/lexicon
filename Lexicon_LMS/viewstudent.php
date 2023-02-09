<?php 
$PageTitle="Admin - View Student"; //page title
$page = "#aside-adm-students"; // active navigation link
include_once('header.php'); //header
if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php'); //redirect if user is not admin	
}
if(isset($_GET['id'])){
	$id = $_GET['id']; //student ID
	$result_stu = mysqli_query($dbconnect,"SELECT * FROM `student` WHERE `sID`='$id' LIMIT 1"); //query retrieving student account information
}
else{
	header('location: managestudents.php'); //redirect if there is no ID is not in URL
}
?>
<main class="row flex width-full margin-0">
	<?php include_once('aside.php');?> <!--sidebar navigation-->
	<section class="col s12 l9 m9 bg-grey  padding-none-imp">	
		<div class="breadcrumb-container">	
			<div class="inline" style="display: inline;">
	        	<a href="managestudents.php" class="breadcrumb">Manage Students</a>
	        	<a href="?id=<?php echo $id;?>" class="breadcrumb">View Student Details</a>
	      	</div>      	
	      	<a class="waves-effect waves-light  btn right " onclick="return confirm('Are you sure you want to delete <?php echo $row['sID'];?>?')" href="?type=student&delete=<?php echo $row['sID'];?>" style="margin-top:-6px;"><i class="far fa-trash-alt material-icon left" style="font-size: 16px;"></i>Delete Student</a> <!--delete button-->	
		</div><!--breadcrumb links and buttons end-->
		<div class="padding-lr-20">	
			<?php if (mysqli_num_rows($result_stu) > 0) {
				//if student account found 
				$row = mysqli_fetch_assoc($result_stu); ?>

				<!--student information-->
				<div class="card margin-top-40 margin-bottom-40 margin-auto" style="max-width:600px;" >
					<div class="card-content">
					    <h4 class="card-title center-align">Student Details</h4><!--Title-->
					    <br>
						<table class="highlight responsive-table">
					        <tr>
					            <th>Student ID</th>
					            <td colspan="2"><?php echo $row['sID']?></td>
					        </tr>
					        <tr>
					          	<th>Name</th>
					          	<td colspan="2"><?php echo $row['sName']?></td>
					        </tr>
					        <tr>
					          	<th>Birthdate</th>
					          	<td colspan="2"><?php echo $row['sDOB']?></td>
					        </tr>
					        <tr>
					          	<th>Email</th>
					          	<td colspan="2"><?php echo $row['sEmail']?></td>
					        </tr>
					        <tr>
					          	<th>Status</th>
					          	<!--if registration status is pending-->
					         	<?php 
					         	if($row['status'] == "pending"){ ?>
				          			<td> 
				          				<form action="?id=<?php echo $id;?>" method="post">
				      					<select name="status-update" id="status-update">
											<option selected value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option><!--pending-->
											<option value="active">approve</option><!--approve student -->
											<option value="delete">reject</option> <!--reject student and delete account-->
										</select>
									</td>
									<td>
										<button type="submit" class=" btn btn-small" name="save" ><i class="fas fa-save material-icon left"></i>Save</button>
										</form>	<!--form end-->
									</td>				
						<?php 	} //end if
								else{ ?>
									<td colspan="2"><?php echo $row['status']?></td>
						<?php 	} //end else ?>   	
					        </tr> <!--end status row--> 
					    </table><!--end table-->
					</div><!--card content end-->
				</div><!--card end-->
			<!--visible if student is approved-->
			<?php if($row['status'] != "pending"){ ?>

			<!--student progress table-->
			<div class=" card bg-white padding-lr-20 padding-tb-20 margin-top-40 margin-bottom-40">
				<table class="highlight responsive-table">
			        <thead>
			        	<!--heading-->
				        <tr>
				            <th rowspan="2">Course ID</th>
				            <th rowspan="2">Course Name</th>
				            <th colspan="6">Attendence</th>    
				            <th colspan="2">Assignments</th>
				            <th rowspan="2">Total Mark</th>
				        </tr>
				        <!--sub-heading-->   
				        <tr>
				        	<th>Lect1</th>
				        	<th>Lect2</th>
				            <th>Lect3</th>
				            <th>Lect4</th>
				            <th>Lect5</th>
				            <th>Total</th>
				            <th>Asn1</th>
				            <th>Asn2</th>
				        </tr>
				    </thead>
				    <tbody>

				    <?php 
			      		$fetch_query = "SELECT * FROM `course-enrolled` WHERE `studID` = '$id'"; //courses student is enrolled in query

						$check = mysqli_query($dbconnect, $fetch_query); //sql query

						if (mysqli_num_rows($check) > 0){ 
							//while student has enrolled in courses
							while($row_stu = mysqli_fetch_assoc($check)){ 
								$course_id= $row_stu['courseID']; //course ID

								//retrieve course information
								$course = mysqli_query($dbconnect, "SELECT * FROM `course` WHERE `cID` = '$course_id'");	

								$result_course = mysqli_fetch_assoc($course); 
								$course_name = $result_course['cName']; //store course name ?>

								<tr>
									<td><?php echo $row_stu['courseID'];?></td><!--course ID-->
									<td><?php echo $course_name;?></td><!--course Name-->

									<!--Attendence-->
									<td><?php echo $row_stu['lect1'];?></td>
									<td><?php echo $row_stu['lect2'];?></td>
									<td><?php echo $row_stu['lect3'];?></td>
									<td><?php echo $row_stu['lect4'];?></td>
									<td><?php echo $row_stu['lect5'];?></td>
									<td><?php echo $row_stu['totalAttend'];?></td>

									<!--Assignment-->
									<td><?php echo $row_stu['asn1'];?></td>
									<td><?php echo $row_stu['asn2'];?></td>
									<!--Total Mark-->
									<td><?php echo $row_stu['courseMark'];?></td>
								</tr>
					<?php
							}//end while
						} //end if
						else {
							echo "<tr><td colspan='11'>No courses enrolled by students</td></tr>";
						}
				      ?>				      	
				      </tbody>
				      <tfoot>
				      		<tr>
								<td colspan='11'><em class="color-green">Marks Breakdown: Assignment 1 - 40%; Assignment 2 - 40%; Attendence: 20%</em></td>
							</tr>
				      </tfoot>
				  </table>
			</div><!--student progress card-->
		
	<?php } //end if (student != pending)

		} //end if student information found

		else{
			echo "<br>";
			array_push($errors, "No student account found with given student ID"); 
			include('errors.php'); //error message				
		} ?>
		</div> <!--end padding-lr-20-->		
	</section>	
</main>
<?php
if(isset($_POST['save'])){
	// status updated
	if(isset($_POST['status-update'])){
		$status_update =  $_POST['status-update']; //value of option selected

		//if rejected
		if($status_update == "delete"){
			$update_query = "DELETE FROM `student` WHERE `student`.`sID` = '$id'"; //delete query
		}
		else{
			$update_query = "UPDATE `student` SET `status`='$status_update' WHERE  `sID` = '$id'"; //update query
		}
		$update_sql = mysqli_query($dbconnect, $update_query );	//execute sql query

		if($status_update == "delete" && $update_sql){
			?>
			<script type="text/javascript">
				window.location.replace("managestudents.php"); //redirect user to Manage Students page
			</script>
			<?php
		}
		if( $status_update != "delete" && $update_sql ){
			?>
			<!--refresh screen-->
			<script type="text/javascript">
				window.location.replace("viewstudent.php?id=<?php echo $id;?>");
			</script>
			<?php
		} //end if( $status_update != "delete" && $update_sql )
	} // end - if(isset($_POST['status-update']))
}// end if(isset($_POST['save']))
	
include_once('footer.php'); //footer
?>