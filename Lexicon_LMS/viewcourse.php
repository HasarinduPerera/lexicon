<?php 
//View Course Page - can be accessed by all users. Layout and permissions differ based on user type

$PageTitle="View Course"; //page title

include_once('header.php'); //header

if(isset($_GET['id'])){
	$id = $_GET['id']; //id retrieved from URL
	$result_stu = mysqli_query($dbconnect,"SELECT * FROM `course` WHERE `cID`='$id' LIMIT 1"); //get course information from database

	$row = mysqli_fetch_assoc($result_stu);	
	$lecAssigned = $row['lecAssigned']; //lecturer ID of lecturer assigned

	//retrieve lecturer information
	$lect_query = "SELECT * FROM 'lecturer' WHERE 'lecID' = '$lecAssigned' LIMIT 1";
	$lect_sql = mysqli_query($dbconnect,"SELECT * FROM `lecturer` WHERE `lecturer`.`lecID` = '$lecAssigned' LIMIT 1");
	$row1 = mysqli_fetch_assoc($lect_sql);

}
else{

	//if ID is not set, redirect user:

	//user logged in as admin
	if($_SESSION['usertype']=='admin'){
		header('location: managecourses.php');		
	}

	//user logged in as lecturer
	if($_SESSION['usertype']=='lecturer'){
		header('location: lect-dashboard.php');		
	}

	//user logged in as student	
	if($_SESSION['usertype']=='student'){
		header('location: coursesoffered.php');	
	}

	//user not logged in
	if(!isset($_SESSION['usertype'])){
		header('location: homepage.php');	
	}	
}

//set variables

//if user logged in
if(isset($_SESSION['usertype'])){
	$course_id = $_GET['id']; //course id

	//user logged in as admin
	if($_SESSION['usertype']=='admin'){
		$brc1_title = "Manage Courses"; //breadcrumb text
		$brc1_url ="managecourses.php";	 //breadcrumb url
		$page = "#aside-adm-courses"; // active navigation link
	}

	//user logged in as lecturer
	if($_SESSION['usertype']=='lecturer'){
		$brc1_title = "Dashboard"; //breadcrumb text
		$brc1_url ="lect-dashboard.php"; //breadcrumb url
		$page = "#aside-lec-dashboard"; // active navigation link		
	}

	//user logged in as student
	if($_SESSION['usertype']=='student'){
		//set variables
		$user_id = $_SESSION['username']; //student ID			

		//check if enrolled or not
		$fetch_query = "SELECT * FROM `course-enrolled` WHERE `courseID` = '$course_id' AND `studID` = '$user_id'";
		$check = mysqli_query($dbconnect, $fetch_query); //sql query

		if (mysqli_num_rows($check) > 0){
			//breadcrumb - if enrolled
			$brc1_title = "Courses Enrolled";
			$brc1_url ="coursesenrolled.php";
			$btn_text = "View Courses Offered";
			$btn_url = "coursesoffered.php";

			$page = "#aside-stu-enrolled"; // active navigation link
		}
		else {
			//breadcrumb - if not enrolled
			$brc1_title = "Courses Offered";
			$brc1_url ="coursesoffered.php";
			$btn_text = "View Courses Enrolled";
			$btn_url = "coursesenrolled.php";

			$page = "#aside-stu-offered"; // active navigation link
		}
	}
}
//if user is not logged in
else{
	//breadcrumb
	$brc1_title = "Home";
	$brc1_url ="homepage.php";
}

$brc2_title = "View Course Details";
$brc2_url ="?id=$id";		

if(!isset($_SESSION['usertype'])){
//main html tag if user is not logged in?>
<main class="row margin-0">
	<section class="col s12 padding-none-imp">
<?php }//end if

else{ //if user is logged in ?>
<main class="row flex width-full margin-0">
<?php 	include_once('aside.php');?>
		<section class="col s12 l9 m9  padding-none-imp">
<?php } //end else ?>

		<div class="breadcrumb-container bg-grey">	
			<div class="inline" style="display: inline;">
	        	<a href="<?php echo $brc1_url; ?>" class="breadcrumb"><?php echo $brc1_title; ?></a> <!--breadcrumb link 1-->
	        	<a href="<?php echo $brc2_url; ?>" class="breadcrumb"><?php echo $brc2_title; ?></a><!--breadcrumb link 2-->
	      	</div>

	      <?php 
	      	//if user logged in as admin
	      	if(isset($_SESSION['usertype']) && $_SESSION['usertype'] =='admin'){ ?>	   	
		      	<a class="waves-effect waves-light  btn right margin-left-15 " onclick="return confirm('Are you sure you want to delete <?php echo $row['cID'];?>?')" href="?type=course&delete=<?php echo $row['cID'];?>" style="margin-top:-6px;"><i class="far fa-trash-alt material-icon left" style="font-size: 16px;"></i>Delete Course</a> <!--delete button-->

		      	<a class="waves-effect waves-light  btn right " href="updatecourse.php?id=<?php echo $row['cID'];?>" style="margin-top:-6px;"><i class="far fa-edit material-icon left" style="font-size: 16px;"></i>Update Course</a> 	<!--update button-->

	 <?php  }//end usertype = admin 

	 		//if user logged in as student
	     	if(isset($_SESSION['usertype']) && $_SESSION['usertype'] =='student'){ ?>
		      	<a class="waves-effect waves-light  btn right " href="<?php echo $btn_url ?>" style="margin-top:-6px;"><i class="fas fa-book-open material-icon left" style="font-size: 16px;"></i><?php echo $btn_text ?></a> <!--button depending on whether enrolled or not-->
	<?php  	}?>
		</div><!--end breadcrumb-container-->
		<div class="padding-lr-20">	
			<div class="row">
				<div class="col s12 m5 l7">
					<h1 class="page-heading"><?php echo $row['cID']." - ".$row['cName']?></h1> <!--page title: Course ID - Course Name-->
			    	<p><?php echo $row['cDesc']?></p><!--Course Description-->
				</div>
				<div class="Lecturecou">
					<!--Course Extra Information-->
					<div class="card-info margin-top-40">
						<table class="highlight responsive-table">
							<tr>
					          	<th>Lecturer Assigned</th>
					          	<td ><?php echo $row1['lecName']?></td><!--Lecturer Name-->
					        </tr>
					        <tr>
					          	<th>Lecturer Email</th>
					          	<td ><?php echo $row1['lecEmail']?></td><!--Lecturer Email-->
					        </tr>
					        <tr>
					          	<th>Category</th>
					          	<td><?php echo $row['category']?></td><!--Course Category-->
					        </tr>
					        <tr>
					          	<th>Course Duration</th>
					          	<td> 
					          		<?php echo $row['startDate']?> - <?php echo $row['endDate']?> <!--Course Start and End Date-->
								</td>
							</tr>
							<?php 

							//if user is not logged in 
							//or if user is logged in as student and not enrolled in course
							if(!isset($_SESSION['username']) ||($_SESSION['usertype'] == 'student' && mysqli_num_rows($check) == 0)){ 

								$status = " "; //initialize variable

								//if user is student
								if(isset($_SESSION['username']) && ($_SESSION['usertype'] == 'student')){
									$status = $_SESSION['accStatus']; //registration status
								}
								?>
								<tr>
									<td colspan="2">
										<a onclick="return confirm('Are you sure you want to enroll for <?php echo $row['cID']." - ". $row['cName'];?> course?')" href="?id=<?php echo $row['cID'];?>&enroll=yes" class="btn waves-effect waves-light width-full <?php echo $status;?>">Enroll</a>
									</td><!--enroll button-->
								</tr>
						<?php
							} // end if ?>
				      </table>
					</div>	
				</div>
			</div><!--row end-->

			<?php
			//if user is logged in
			if(isset($_SESSION['username']) && (($_SESSION['usertype'] == 'lecturer' && $lecAssigned == $_SESSION['username']) || $_SESSION['usertype'] == 'admin' || ($_SESSION['usertype'] == 'student' && mysqli_num_rows($check) > 0) )){ ?>

				<div class="card">
					<div class="card-content">

					<!--if user is lecturer, show in form-->
	<?php 			if($_SESSION['usertype'] == 'lecturer'){?>
						
						<form action="#update" method="post">
							<input type="hidden" name="cID_assigned" id="cID_assigned" value="<?php echo $course_id;?>">
							
	<?php 			} //end if  ?>
					<!--end - user is lecturer -->

					<!--all logged in users-->
					<table class="highlight responsive-table">
						<thead>
							<tr>
					<!--end - all logged in users -->

					<!--user is enrolled student-->
	<?php 			if($_SESSION['usertype'] == 'student'){
						if (mysqli_num_rows($check) > 0){ ?>

					        <th colspan="6">Attendence</th>    
					        <th colspan="2">Assignments</th>
					        <th rowspan="2">Total Mark</th>

	<?php				} // end if - check row
					} // end if 

					// end - user is enrolled student 

					// user is lecturer or admin
					if($_SESSION['usertype'] == 'lecturer' || $_SESSION['usertype'] == 'admin'){ ?>
							<th rowspan="2">Student ID</th>
					        <th rowspan="2">Student Name</th>
					        <th colspan="6">Attendence</th>    
					        <th colspan="2">Assignments</th>
					        <th rowspan="2">Total Mark</th>

<?php				} //end - user is lecturer or admin ?>

					<!--all logged in users-->
						</tr>   
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
					<!--end - all logged in users-->

	<?php			//user is enrolled student - display student progress
					if($_SESSION['usertype'] == 'student'){
						if (mysqli_num_rows($check) > 0){ 
							$row_stu = mysqli_fetch_assoc($check); ?>
							<tr>
					        	<td><?php echo $row_stu['lect1'];?></td>
					        	<td><?php echo $row_stu['lect2'];?></td>
					            <td><?php echo $row_stu['lect3'];?></td>
					            <td><?php echo $row_stu['lect4'];?></td>
					            <td><?php echo $row_stu['lect5'];?></td>
					            <td><?php echo $row_stu['totalAttend'];?></td>
					            <td><?php echo $row_stu['asn1'];?></td>
					            <td><?php echo $row_stu['asn2'];?></td>
					            <td><?php echo $row_stu['courseMark'];?></td>
					        </tr>			      	

	<?php				}// end check
					} //end - user is enrolled student 

					//user is lecturer or admin

					if($_SESSION['usertype'] == 'lecturer' || $_SESSION['usertype'] == 'admin'){ 

						$fetch_query = "SELECT * FROM `course-enrolled` WHERE `courseID` = '$course_id'"; //retrieve course progress

						$check = mysqli_query($dbconnect, $fetch_query); //sql query

						if (mysqli_num_rows($check) > 0){ 

							$count = mysqli_num_rows($check); 

							$i = 0; //array count ?>
							<tr>
								<td>
									<input type="hidden" name="rowCount" id="rowCount" value="<?php echo $count;?>">
								</td>
							</tr>

						<?php	
						while($row_stu = mysqli_fetch_assoc($check)){ 
							$stu_id= $row_stu['studID']; 
							$student = mysqli_query($dbconnect, "SELECT * FROM `student` WHERE `sID` = '$stu_id'");	//retrieve student information
							$result_student = mysqli_fetch_assoc($student); ?>

							<tr>
								<?php
									$stu[$i] = $row_stu['studID']; //array to store student ID
								?>

								<td><?php echo $row_stu['studID'];?></td><!--student ID-->
								<td><?php echo $result_student['sName'];?></td><!--student name-->

								<!--user is admin-->
<?php							if($_SESSION['usertype'] == 'admin'){ ?>
									<td><?php echo $row_stu['lect1'];?></td>
									<td><?php echo $row_stu['lect2'];?></td>
									<td><?php echo $row_stu['lect3'];?></td>
									<td><?php echo $row_stu['lect4'];?></td>
									<td><?php echo $row_stu['lect5'];?></td>
									<td><?php echo $row_stu['totalAttend'];?></td>
									<td><?php echo $row_stu['asn1'];?></td>
									<td><?php echo $row_stu['asn2'];?></td>
									<td><?php echo $row_stu['courseMark'];?></td>
<?php							} //usertype - admin end

								//user is lecturer - show editable table rows
								if($_SESSION['usertype'] == 'lecturer'){ ?>
									<input type="hidden" name="stu[<?php echo $i; ?>]" value="<?php echo $stu[$i];?>"><!--student ID-->
									<!--attendence lect 1-->
									<td>
										<p>
									      <label>
									      	<input type="hidden" name="lect1[<?php echo $i; ?>]" value="0"> <!--if submitted without checking-->
									        <input name="lect1[<?php echo $i; ?>]" id="lect1[<?php echo $i; ?>]" class="status_<?php echo $row_stu['lect1'];?>" type="checkbox" value="1"/>
									 		<span></span>
									      </label><!--checkbox-->
									    </p>
									</td>
									<!--attendence lect 2-->
									<td>
										<p>
									      <label>
									      	<input type="hidden" name="lect2[<?php echo $i; ?>]" value="0"> <!--if submitted without checking-->
									        <input name="lect2[<?php echo $i; ?>]" id="lect2[<?php echo $i; ?>]" class="status_<?php echo $row_stu['lect2'];?>" type="checkbox" value="1"/>
									 		<span></span>
									      <</label><!--checkbox-->
									    </p>
									</td>
									<!--attendence lect 3-->
									<td>
										<p>
									      <label>
									      	<input type="hidden" name="lect3[<?php echo $i; ?>]" value="0"> <!--if submitted without checking-->
									        <input name="lect3[<?php echo $i; ?>]" id="lect3[<?php echo $i; ?>]" class="status_<?php echo $row_stu['lect3'];?>" type="checkbox" value="1"/>
									 		<span></span>
									      </label><!--checkbox-->
									    </p>
									</td>
									<!--attendence lect 4-->
									<td>
										<p>
									      <label>
									      	<input type="hidden" name="lect4[<?php echo $i; ?>]" value="0"> <!--if submitted without checking-->
									        <input name="lect4[<?php echo $i; ?>]" id="lect4[<?php echo $i; ?>]" class="status_<?php echo $row_stu['lect4'];?>" type="checkbox" value="1"/>
									 		<span></span>
									      </label><!--checkbox-->
									    </p>
									</td>
									<!--attendence lect 5-->
									<td>
										<p>
									      <label>
									      	<input type="hidden" name="lect5[<?php echo $i; ?>]" value="0"> <!--if submitted without checking-->
									        <input name="lect5[<?php echo $i; ?>]" id="lect5[<?php echo $i; ?>]" class="status_<?php echo $row_stu['lect5'];?>" type="checkbox" value="1"/>
									 		<span></span>
									      </label><!--checkbox-->
									    </p>
									</td>
									
									<td><?php echo $row_stu['totalAttend'];?></td> <!--Total Attendence - calculated after saving-->

									<!--assignment 1-->
									<td>
										<div class="input-field margin-0">
								          <input value="<?php echo $row_stu['asn1'];?>" id="asn1[<?php echo $i; ?>]" name="asn1[<?php echo $i; ?>]" type="number" value="<?php echo $row_stu['asn1'];?>" class="validate">
								        </div>
									</td>
									<!--assignment 2-->
									<td>
										<div class="input-field margin-0">
								          <input value="<?php echo $row_stu['asn2'];?>" id="asn2[<?php echo $i; ?>]" name="asn2[<?php echo $i; ?>] "type="number" value="<?php echo $row_stu['asn2'];?>" class="validate">
								        </div>
									</td>
									<td><?php echo $row_stu['courseMark'];?></td><!--Total Course Mark - calculated after saving-->
<?php							} //end if usertype is lecturer?>
							</tr> <!--end student row-->
<?php						$i++; //increment	
						} //while there are rows
					} // if rows are found
					else{
						echo "<tr><td colspan='11'>No students enrolled in course</td></tr>";
					} //end else
				}//end usertype lecturer and admin?>
				</tbody>
				<tfoot>				
					<?php 	
					//user is lecturer or student
					if($_SESSION['usertype'] == 'lecturer' || $_SESSION['usertype'] == 'student'){?>
						<tr>
							<td colspan='9'><em class="color-green">Marks Breakdown: Assignment 1 - 40%; Assignment 2 - 40%; Attendence: 20%</em></td>

						<?php 	
						//user is lecturer 
						if($_SESSION['usertype'] == 'lecturer'){?>		
									<td colspan='2'>
										<button class="btn waves-effect waves-light right"  type="submit" name="updatebtn">Save Progress</button> 
	  								</td>
	  					<?php 	} //end if: usertype = lecturer?>
						</tr>
					<?php 	
					} //end if: usertype = lecturer or usertype = student
					else{ ?>
						<tr>
							<td colspan='11'><em class="color-green">Marks Breakdown: Assignment 1 - 40%; Assignment 2 - 40%; Attendence: 20%</em></td>
						</tr>

			<?php 	}//end else ?>
				</tfoot>			
			</table>
		<?php 	
		if($_SESSION['usertype'] == 'lecturer'){?>
		<!--if user is lecturer, show in form-->
		</form>
<?php 	} //end if?>
		</div>
		</div>


<?php	 } // end isset - username check

		?>
	</section>
	<section class="" id="update">		
	</section>	
</main>
<?php

//if student clicks on enroll button
if(isset($_GET['enroll'])){
	$enroll_id = $_GET['id'];
	$user_id = $_SESSION['username'];

	$enroll_query = "INSERT INTO `course-enrolled`(`courseID`, `studID`) VALUES ('$enroll_id','$user_id')"; //insert into course-enrolled table
	$sql_insert = mysqli_query($dbconnect, $enroll_query); //execute query

	if($sql_insert){
		echo "successfully enrolled"; //success message
		?>
			<script type="text/javascript">
				window.location.replace("coursesenrolled.php"); //redirect to Course Enrolled page
			</script>
		<?php

	}
	else{
		echo "failed to enroll";
	}
}



include_once('footer.php');
?>

<script type="text/javascript">
	 $(document).ready(function(){
	 	//if boolean value is 1                   
        $(".status_1").attr("checked", "checked");

        //student is not approved. Disable enroll button
        $(".pending").addClass("disabled");
       
    });
</script>