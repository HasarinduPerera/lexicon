<?php
include_once('header.php');
	$viewMoreURL = "";

	$result_courses = mysqli_query($dbconnect,"SELECT * FROM `course`"); //select all courses from the database

	//if the course table has data in the database
	if (mysqli_num_rows($result_courses) > 0) { 

		//for each row of data
		while($row = mysqli_fetch_assoc($result_courses)) { 

			//retrieve lecturer assigned details
			$lecAssigned = $row['lecAssigned'];
			$lect_query = "SELECT * FROM 'lecturer' WHERE 'lecID' = '$lecAssigned' LIMIT 1"; //lecturer query
			$lect_sql = mysqli_query($dbconnect,"SELECT * FROM `lecturer` WHERE `lecturer`.`lecID` = '$lecAssigned' LIMIT 1");

			$row1 = mysqli_fetch_assoc($lect_sql); //store information on lecturer assigned in variable
			
?>
			<!--course card start-->
			<style type="text/css">
			.more {
				color: #ffab00;
			}
			            .icon {
				color: #ffab00;
			}
			            .teacher {
				color: #ffab00;
			}
			            .teacher {
				color: #ffab00;
			}
			            .fa-icon {
				color: #ffab00;
			}
            </style>
			
		  <div class=" card sticky-action ">
		        <div class="card-image course <?php echo $row['category'];?>"> <!--class name for thumbnail style-->
		        	<span class="card-corner"><?php echo $row['category'];?></span><!--course category-->
		        </div><!--card-image end-->
		        <div class="card-content">
		        	<div class="row margin-0">
		        		<span class="card-title activator"><?php echo $row['cName'];?><span class="icon"><i class="material-icons right">more_vert</i></span></span><!--course name-->
		        		<div class="col s12">
							<p class="left-align"><i class="material-icons icon">today</i> <?php echo $row['startDate'];?> - <?php echo $row['endDate'];?></p><!--course duration-->
						</div>
						<div class="col s12 margin-bottom-5">
							<p ><i class="fas fa-chalkboard-teacher fa-icon"></i> <?php echo $row1['lecName'];?></p><!--lecturer assigned name-->
						</div>					
						<div class="col s12 ">	
							<p ><a href="viewcourse.php?id=<?php echo $row['cID'];?>" class="more">Learn More</a></p>
						</div><!--Learn more button- redirect to "view course details" page-->		
					</div><!--row end-->
		        </div><!--card-content end-->
		        <!--card info overlay-->
		        <div class="card-reveal">
				    <span class="card-title grey-text text-darken-4">
				    	<?php echo $row['cName'];?>
				    	<i class="material-icons right">close</i> <!--close overlay icon-->
				    </span><!--course title-->
				    <br>	
				    <p><?php echo $row['cDesc'];?></p><!--course description-->
				</div><!--card-image end-->
				<!--course action button-->
		        <div class="card-action">
		        	<?php
		        	//if user is logged in
		        	if(isset($_SESSION['username'])){
		        		//if user is student
		        		if($_SESSION['usertype']== 'student'){
        					//check student status - pending or approved
        					$status = $_SESSION['accStatus']; 

        					//check if already enrolled
        					$stu_id = $_SESSION['username']; //student ID
        					$course_id = $row['cID']; //course ID
        					$query = "SELECT * FROM `course-enrolled` WHERE `studID`='$stu_id' AND `courseID`='$course_id'"; //sql query checking if student is enrolled in course
        					$check = mysqli_query($dbconnect, $query);

        					if (mysqli_num_rows($check) > 0){ ?>
        						<!--if student is enroll - button is disabled-->
        						<a href="?type=course&enroll=<?php echo $row['cID'];?>" class="btn waves-effect waves-light width-full disabled">Enrolled</a>
        					<?php
        					}
        					else{ ?>
        						<!--if student is not enrolled - allow to enroll on button click-->
        						<a onclick="return confirm('Are you sure you want to enroll for <?php echo $row['cID']." - ". $row['cName'];?> course?')" href="?type=course&enroll=<?php echo $row['cID'];?>" class="btn waves-effect waves-light width-full <?php echo $status; //student registration status?>">Enroll</a>
        				<?php
        					} //end else
        				} // end if - $_SESSION['usertype']== 'student'
	        			else{ //if user is lecturer or admin ?>
	        				<a href="viewcourse.php?id=<?php echo $row['cID'];?>" class="btn waves-effect waves-light width-full">View Course</a>
	        				<?php
	        			}
        			}//end if - isset($_SESSION['username']
	        		else{ //user is not logged in?>
	        			<a onclick="return confirm('Please log in to enroll for the course')" href="sign-in.php" class="btn waves-effect waves-light width-full">Enroll</a> <!--ask user to log in first - redirect to sign in page-->
	        			<?php
	        		} //end else - if user is not logged in
	        		?>		          
		        </div> <!--card-action end-->
			</div> <!--course card end-->
		<?php
		}//end while
	}//end if

	/*//if student clicks enroll button
	if(isset($_GET['enroll'])){
		$enroll_id = $_GET['enroll']; //course ID
		$user_id = $_SESSION['username']; //student ID

		$enroll_query = "INSERT INTO `course-enrolled`(`courseID`, `studID`) VALUES ('$enroll_id','$user_id')"; //enroll student query - insert course ID and student ID in course-enrolled table
		$sql_insert = mysqli_query($dbconnect, $enroll_query);

		if($sql_insert){
			echo "successfully enrolled";
		}
		else{
			echo "failed to enroll";
		}
	}*/

	//if student clicks enroll button
	if(isset($_GET['enroll'])){
		$enroll_id = $_GET['enroll']; //course ID
		$user_id = $_SESSION['username']; //student ID

		$enroll_query = "INSERT INTO `course-enrolled`(`courseID`, `studID`, `lect1`, `lect2`, `lect3`, `lect4`, `lect5`, `asn1`, `asn2`, `totalAttend`, `courseMark`) VALUES ('$enroll_id','$user_id', 0, 0, 0, 0, 0, 0, 0, 0, 0)"; //enroll student query - insert course ID and student ID in course-enrolled table
		$sql_insert = mysqli_query($dbconnect, $enroll_query);

		if($sql_insert){
			echo "successfully enrolled";
		}
		else{
			echo "failed to enroll";
		}
	}

?>
<script type="text/javascript">
	 $(document).ready(function(){
	 	//student is not approved. Disable enroll button                  
        $(".pending").addClass("disabled");
       
    });
</script>