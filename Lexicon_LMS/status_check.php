<?php 
	if($_SESSION['usertype'] == 'student' && $_SESSION['accStatus'] == 'pending'){
		header('location: student-dashboard.php');			
	}	
?>