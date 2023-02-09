<?php 
session_start();

//connect to database
$dbconnect = mysqli_connect('localhost', 'root', '' , 'lexicon');
if (!$dbconnect) {
    die("Connection failed: " . mysqli_connect_error()); //if cannot establish connection with database
}

//initializing variables
$errors = array();
$username = "";
$password = "";
$usertype = "";
$type = "";
$msg = "";

// User Sign In - Student, Lecturer, Admin
if (isset($_POST['action'])) {

	//storing values in variables
  	$username = mysqli_real_escape_string($dbconnect, $_POST['username']); 
  	$password = mysqli_real_escape_string($dbconnect,  $_POST['userPassword']);
  	if(isset($_POST['usertype'])){
  		$usertype = mysqli_real_escape_string($dbconnect,  $_POST['usertype']);
  	}

  	//validations to check if fields are empty
  	if(empty($username) || empty($password) || !isset($_POST['usertype'])){
		if (empty($username)) {
	    	array_push($errors, "Username is required");   
	  	}
	    if (empty($password)) {
	    	array_push($errors, "Password is required");
	    } 
	    if (!isset($_POST['usertype'])) {
	    	array_push($errors, "Select User-type");
	    }	    
	    	
 	 }//end if
  	else{
	  	$password = md5($password); //encrypt password

	  	if($usertype == 'student'){
	  		$result = mysqli_query($dbconnect,"SELECT * FROM `student` WHERE (`sID` = '$username' OR `sEmail` = '$username') AND `sPassword` = '$password'"); //student table
	  	}
	  	if($usertype == 'lecturer'){
	  		$result = mysqli_query($dbconnect,"SELECT * FROM `lecturer` WHERE (`lecID` = '$username' OR `lecEmail` = '$username') AND `lecPassword` = '$password'"); //lecturer table
	  	}
	  	if($usertype == 'admin') {
	  		$result = mysqli_query($dbconnect,"SELECT * FROM `admin` WHERE `adID` = '$username' AND `adPassword` = '$password'"); //admin table
	  	}

	  	//if row of data found
		if (mysqli_num_rows($result) == 1) {
		    // output data of each row
		    while($row1 = mysqli_fetch_assoc($result)) {
		    	echo "success";
		    	
				//store data in session variables
				 $_SESSION['username'] = $username;
				 $_SESSION['password'] = $password;
				 $_SESSION['usertype'] = $row1["usertype"];

				 //student account
				 if($_SESSION['usertype'] == 'student'){
				 	$_SESSION['accName'] = $row1["sName"];
				 	$_SESSION['accEmail'] = $row1["sEmail"];
				 	$_SESSION['accDOB'] = $row1["sDOB"];
				 	$_SESSION['accStatus'] = $row1["status"];
				 	
				 }

				 //lecturer account
				 if($_SESSION['usertype'] == 'lecturer'){
				 	$_SESSION['accName'] = $row1["lecName"];
				 	$_SESSION['accEmail'] = $row1["lecEmail"];				 	
				 }

				 //admin login
				 if($_SESSION['usertype'] == 'admin'){
				 	$_SESSION['accName'] = "Admin";
				 	
				 }

				 //redirect
				 header('location: index.php');			    
		    } //end while
		}// end if account is found
		else {
			array_push($errors,  "No account found. Invalid username and password combination"); //if no account is found
		}//end else	
  	}//end else
} // end login condition


//Add New Course OR update course
if (isset($_POST['course-btn']) || isset($_POST['update-course-btn']) ) {

	//initialize and assign variables
	$cID = $_POST['cID']; //course ID
	$cName = mysqli_real_escape_string($dbconnect, $_POST['cName']); //course name
	$cDesc = mysqli_real_escape_string($dbconnect, $_POST['cDesc']); //course description
	$startDate = mysqli_real_escape_string($dbconnect,$_POST['startDate']); //start date
	$endDate = mysqli_real_escape_string($dbconnect,$_POST['endDate']); //end date

	//if fields are not filled out
	if(empty($cName) || empty($cDesc) || empty($startDate) || empty($endDate) || !isset($_POST['category']) || !isset($_POST['lecAssigned']) ){

		if(empty($cName)){
			array_push($errors, "Please enter course name"); 
		}
		if(empty($cDesc)){
			array_push($errors, "Please enter course description"); 
		}
		if(empty($startDate)){
			array_push($errors, "Please enter course start-date"); 
		}
		if(empty($endDate)){
			array_push($errors, "Please enter course end-date"); 
		}
		if(!isset($_POST['category'])){
			array_push($errors, "Please select course category"); 
		}
		if(!isset($_POST['lecAssigned'])){
			array_push($errors, "Please assign lecturer to course"); 
		}

	}
	//invalid date format
	elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$startDate) || !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$endDate)){

		array_push($errors, "Invalid date format"); //error message
	}
	else{
		$category = $_POST['category']; //course category
		$lecAssigned = $_POST['lecAssigned']; //lecturer ID

		if(isset($_POST['course-btn'])){
			$check_query = "SELECT * FROM `course` WHERE  `cName`='$cName' LIMIT 1"; //Two courses with same name not allowed
		}
		if(isset($_POST['update-course-btn'])){
			$check_query = "SELECT * FROM `course` WHERE  `cName`='$cName' AND `cID`!='$cID' LIMIT 1";
		}		
		$check_course = mysqli_query($dbconnect, $check_query); 
		$check_result = mysqli_fetch_assoc($check_course); //check if there are matches with existing courses

		if($check_result['cName'] == $cName){
			array_push($errors, "Course with same name already exists"); //error message
		}
		else{
			//if new course
			if(isset($_POST['course-btn'])){ 
				
				$sql_query =  "insert into course(cID, cName , category, cDesc, startDate, endDate, lecAssigned ) VALUES ('$cID','$cName','$category','$cDesc','$startDate' ,'$endDate' ,'$lecAssigned')"; //insert query
				$sql = mysqli_query($dbconnect, $sql_query);

				if($sql){
				$msg=  "Course Successfully Added"; //success message
				}
				else{
					array_push($errors, "Failed to add course"); //fail message
				}
			}
			//if update course
			if(isset($_POST['update-course-btn'])){
				$sql_query = "UPDATE `course` SET `cName`='$cName',`category`='$category',`cDesc`='$cDesc',`startDate`='$startDate',`endDate`='$endDate',`lecAssigned`='$lecAssigned' WHERE `course`.`cID`='$cID'"; //update query
				$sql = mysqli_query($dbconnect, $sql_query);

				if($sql){
				$msg=  "Course Successfully Updated"; //success message
				}
				else{
					array_push($errors, "Failed to update course"); //fail message
				}
			}

		} // end else

	} //end else	
}//end add / update course

//Register New || Update -  Student or  Lecturer 
if (isset($_POST['submit_account']) || isset($_POST['update_account'])) {
	//$_POST['submit_account'] is for registering a new student or lecturer account
	//$_POST['update_account'] is for updating a student or lecturer account

	//storing values in variables
  	$accName = mysqli_real_escape_string($dbconnect, $_POST["accName"]); //Full Name
  	$password = mysqli_real_escape_string($dbconnect,  $_POST['userPassword']); //password
  	$re_password = mysqli_real_escape_string($dbconnect,  $_POST['userPassword2']); //re-enter password
  	$email = mysqli_real_escape_string($dbconnect,  $_POST['userEmail']); //user email	
  	$usertype = mysqli_real_escape_string($dbconnect,  $_POST['usertype']); //usertype

  	if($usertype == "student"){
		$userDOB = mysqli_real_escape_string($dbconnect,  $_POST['userDOB']); //birthdate		
 	 }
  	//validations to check if fields are empty
  	if(empty($accName) || empty($password) || empty($re_password) || empty($email) || ($usertype == "student" && empty($userDOB))) {
		if (empty($accName)) {
	    	array_push($errors, "Name is required");   
	  	}
	    if (empty($password) || empty($re_password)) {
	    	array_push($errors, "Password is required in both password fields");
	    }
	    if (empty($email)) {
	    	array_push($errors, "Email is required");
	    }
	    if($usertype == "student" && empty($userDOB)){
			array_push($errors, "Birthdate is required");
		}
 	 }//end if
 	 elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password != $re_password || !preg_match("/^[a-zA-Z ]*$/",$accName) ||($usertype == "student" &&  !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$userDOB) )) {

 	 		//if fields are filled but values are illegal 

	 	 	if(!preg_match("/^[a-zA-Z ]*$/",$accName) ){
			  	array_push($errors, "Invalid name input. Only letters and white space allowed.");
			  } //if symbols, special characters or numbers are used

			if(($usertype == "student" && !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$userDOB)) ){
			  	array_push($errors, "Invalid date format.");
			  } //if date format is incorrect

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			  	array_push($errors, "Invalid email format");
			  } //if email format is not valid
			if($password != $re_password ){
			  	array_push($errors, "The two passwords do not match");
			  }  //if passwords do not match
		} //end elseif

 	 else{
 	 	//all fieds are filled out with correct values

 	 	//if new student account or new lecturer account
 	 	if(isset($_POST['submit_account'])){
 	 		if($usertype=="student"){
 	 			$check_query = "SELECT * FROM `student` WHERE  `sEmail`='$email' LIMIT 1"; //check if there is an account with same email
 	 		}
 	 		if($usertype=="lecturer"){
 	 			$check_query = "SELECT * FROM `lecturer` WHERE  `lecEmail`='$email' LIMIT 1"; //check if there is an account with same email
 	 		}
 	 	}	

 	 	//if update student account or new lecturer account
 	 	if(isset($_POST['update_account'])){
 	 		$id = $_POST['userid'];

 	 		if($usertype=="student"){
 	 			$check_query = "SELECT * FROM `student` WHERE  `sEmail`='$email' AND `sID` != '$id' LIMIT 1"; // if email is updated, check if there is another email with same email
 	 		}
 	 		if($usertype=="lecturer"){
 	 			$check_query = "SELECT * FROM `lecturer` WHERE  `lecEmail`='$email' AND `lecID` != '$id' LIMIT 1"; // if email is updated, check if there is another email with same email
 	 		}
 	 	}

 	 	$user_check = mysqli_query($dbconnect, $check_query);
		$user = mysqli_fetch_assoc($user_check);
		if($user){
			 array_push($errors, "Account with matching email already exists");
		}
		else{

			$password = md5($password);

			if(isset($_POST['submit_account'])){
				include("setid.php");
				if($usertype=="student"){

					$sql_query = "insert into student(sID, sName, sPassword, sEmail, sDOB, usertype, status) VALUES ('$setID','$accName','$password','$email', '$userDOB','$usertype','pending')";
				}
				if($usertype=="lecturer"){
					$sql_query = "insert into lecturer(lecID, lecName, lecPassword, lecEmail, usertype) VALUES ('$setID','$accName','$password','$email' ,'$usertype')";
				}

			}

			if(isset($_POST['update_account'])){
				$id = $_POST['userid'];
	
				if($usertype=="student"){
					$sql_query = "UPDATE `student` SET `sName`='$accName',`sPassword`='$password',`sEmail`='$email',`sDOB`='$userDOB' WHERE `student`.`sID`= '$id'";
				}
				if($usertype=="lecturer"){
					$sql_query = "UPDATE `lecturer` SET `lecName`='$accName',`lecPassword`='$password',`lecEmail`='$email' WHERE `lecturer`.`lecID`= '$id'";
				}

			}
			
			//insert into database
			$sql = mysqli_query($dbconnect, $sql_query ); 

			//if successfully inserted
			if($sql){ 

				if(isset($_POST['update_account'])){
					$msg = "Successfully updated account";

					if(isset($_SESSION['username']) && $_SESSION['usertype'] == 'student'){
						//reset session values
					 	$_SESSION['accName'] = $accName;
					 	$_SESSION['accEmail'] = $email;
					 	$_SESSION['accDOB'] = $userDOB;
				 	}
				}
				if(isset($_POST['submit_account'])){
					if($usertype=="student"){
					//redirect
					$_SESSION['sID'] = $setID;
				 	header('location: register-success.php');
				 }
				 if($usertype=="lecturer"){
				 	$_SESSION['lecID'] = $setID;
				 	header('location: lecturer-register-success.php');					 	
				 }
				}
				
			}//end if
			else{
				array_push($errors, "Failed to register account"); //error message 
			}

		} // end - else statement that inserts data into database

	} // end - else statement that checks if there is existing account with matching details
} // end register || update condition

//delete row
if(isset($_GET['delete'])){
	$delete_ID = $_GET['delete']; 
	$type = $_GET['type'];

	//check account type to be deleted
	if($type == 'student'){
		$id = "sID";  //id field of table
		$courseEnrolled_field ="studID"; //for course-enrolled table
	}
	if($type == 'lecturer'){
		$id = "lecID"; //id field of table
	}
	if($type == 'course'){
		$id = "cID"; //id field of table
		$courseEnrolled_field ="courseID"; //for course-enrolled table
	}

	//delete from course-enrolled table first
	if($type == 'student' || $type == 'course'){
		$delete_courseEnrolled = "DELETE FROM `course-enrolled` WHERE `course-enrolled`.`$courseEnrolled_field` = '$delete_ID'"; //Delete SQL query
		$sql_courseEnrolled = mysqli_query($dbconnect, $delete_courseEnrolled); //execute query	
	}

	$delete_query = "DELETE FROM `$type` WHERE `$type`.`$id` = '$delete_ID'"; //Delete SQL query
	$sql_delete = mysqli_query($dbconnect, $delete_query); //execute query	

	if($sql_delete){
		//if successfully deleted row
		$page = $_SERVER['PHP_SELF'];
		$sec = "0";
		header("Refresh: $sec; url=$page");
	}
	else{		
		if($type == 'lecturer'){
			array_push($errors, "Failed to delete lecturer account. Please make sure that no courses are assigned to lecturer");
		}
		else{
			echo "Failed to delete";
		}
	}
} //end delete row

//update student progress

if(isset($_POST['updatebtn'])){
	echo "working";
	$count = $_POST['rowCount']; //total number of rows
	$courseID = $_POST['cID_assigned']; 
	
	for($j = 0; $j < $count; $j++){
		
		$studID =  $_POST['stu'][$j]; //array of Student ID
		$lect1 = $_POST['lect1'][$j]; //array of lect1
		$lect2 = $_POST['lect2'][$j]; //array of lect2
		$lect3 = $_POST['lect3'][$j]; //array of lect3
		$lect4 = $_POST['lect4'][$j]; //array of lect4
		$lect5 = $_POST['lect5'][$j]; //array of lect5

		//total attendence calculated
		$totalAttend = ($lect1 + $lect2 + $lect3 + $lect4 + $lect5)/5 * 100;

		$asn1 = $_POST['asn1'][$j]; //assignment 1
		$asn2 = $_POST['asn2'][$j]; //assignment 2

		$asnMark1 = $asn1/50 * 100; //assignment 1 mark
		$asnMark2 = $asn2/50 * 100; //assignment 2 mark

		$courseMark = ($totalAttend * 0.2) + ($asnMark1 * 0.4) + ($asnMark2 * 0.4); //total coursemark

		$update_query = "UPDATE `course-enrolled` SET `lect1`='$lect1',`lect2`='$lect2',`lect3`='$lect3',`lect4`='$lect4',`lect5`='$lect5',`asn1`='$asn1',`asn2`='$asn2',`totalAttend`='$totalAttend',`courseMark`='$courseMark' WHERE `course-enrolled`.`courseID` = '$courseID' AND `course-enrolled`.`studID` = '$studID'"; //update course-enrolled query

		$update_sql = mysqli_query($dbconnect, $update_query);

		if(!$update_sql){
			echo "failed to update";
		}
		else{
			
		}
	}
} //end update progress

?>

