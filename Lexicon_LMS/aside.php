<aside class="col m3 l3 s12	" >
	<div class="sticky-object">	<!--sticky navbar-->

	<?php 
		//different links depending on usertype

		//if admin
		if($_SESSION['usertype'] == 'admin'){ ?>

			<ul class=" hide-on-med-and-down section table-of-contents" >
		        <li><a href="admin-dashboard.php" id="aside-adm-dashboard">Dashboard</a></li>
		        <li><a href="managelecturers.php" id="aside-adm-lecturer">Manage Lecturers</a></li>
		        <li><a href="managecourses.php" id="aside-adm-courses">Manage Courses</a></li>
		        <li><a href="managestudents.php" id="aside-adm-students">Manage Students</a></li>
      		</ul> <!--Sidenav links-->
      		<hr>
      		<div class="card-panel">
		       <p class="white-text">For technical issues, contact: </p>
	          <a class="white-text" href="mailto:tech@lexicon.com">tech@lexicon.com</a>
		    </div><!--Emergency contact-->

	<?php 	} //end if

		//if user is student
		if($_SESSION['usertype'] == 'student'){ ?>

			<ul class=" hide-on-med-and-down section table-of-contents" >
		        <li><a href="student-dashboard.php" id="aside-stu-dashboard">Dashboard</a></li>
		        <li><a href="studentprofile.php" id="aside-stu-profile">My Profile</a></li>
		        <li><a href="coursesenrolled.php" id="aside-stu-enrolled">Courses Enrolled</a></li>
		        <li><a href="coursesoffered.php" id="aside-stu-offered">Courses Offered</a></li>	        
      		</ul><!--Sidenav links-->
      		<hr>
      		<div class="card-panel">
		       <p class="white-text">For technical issues, contact: </p>
	          <a class="white-text" href="mailto:tech@lexicon.com">tech@lexicon.com</a>
		    </div><!--Emergency contact-->

	<?php 	} //end if

		//if user is lecturer
		if($_SESSION['usertype'] == 'lecturer'){ ?>
			<!--lecturer profile information-->
			<div class="card-panel">
				<h6 class="card-title white-text">Profile:</h6>
				<table>
					<tr>
						<th class="">Lecturer ID: </td>
						<td class="white-text"><?php echo $_SESSION['username']?></td>
					</tr>
					<tr>
						<th class="">Name: </td>
						<td class="white-text"><?php echo $_SESSION['accName']?></td>
					</tr>
					<tr>
						<th class="">Email: </td>
						<td class="white-text"><?php echo $_SESSION['accEmail']?></td>
					</tr>
				</table>			
		    </div>

			<ul class=" hide-on-med-and-down section table-of-contents" >
		        <li><a href="lect-dashboard.php" id="aside-lec-dashboard">Courses Assigned</a></li>		        
      		</ul><!--Sidenav links-->
      		<hr>
      		<br>
      		<p class="white-text">For technical issues, contact: </p>
	        <a class="white-text" href="mailto:tech@lexicon.com">tech@lexicon.com</a><!--Emergency Contact-->      		

<?php 	} //end if
	?>		 
</aside>

<script type="text/javascript">	
	$(document).ready(function(){
		$("<?php echo $page;?>").addClass("active"); //add "active" class to sidenav link of active page
	});
</script>