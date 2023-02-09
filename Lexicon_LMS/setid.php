<?php 
//method to set student ID, course ID or lecturer ID when inserting new data 

if($usertype == "student"){
	//Typical Student ID structure: STU + 4 digit number eg. STU0001
	$query = "SELECT `sID` FROM `student` ORDER BY `sID` ASC"; //sql select query
	$id_start = "STU";
	$id_db = 'sID'; //field name in SQL
}
if($usertype == "lecturer"){
	//Typical Lecturer ID structure: LEC + 4 digit number eg. LEC0001
	$query = "SELECT `lecID` FROM `lecturer` ORDER BY `lecID` ASC"; //sql select query
	$id_start = "LEC";
	$id_db = 'lecID'; //field name in SQL
}

if($type == "course"){
	//Typical Course ID structure: ABC + 4 digit number eg. ABC0001
	$query = "SELECT `cID` FROM `course` ORDER BY `cID` ASC"; //sql select query
	$id_start = "ABC";
	$id_db = 'cID'; //field name in SQL
}

$id_check = mysqli_query($dbconnect, $query); //select all  IDs from table in database

	//set id

	$count = 1; //initialize counter
	$num = sprintf("%04d", $count ); //set 4 digit number
	$setID = $id_start.$num ; // set initial  ID value

	//while there are rows
    while($row_check = mysqli_fetch_assoc($id_check)){
   		
   		//if ID does not match existing row	- Set the ID value to the value in $setID
		if($setID != $row_check[$id_db]){
			break; 
		}
		else{
			//if ID matches existing row- reset the value in $setID
			$count ++;
			$num = sprintf("%04d", $count );
			$setID = $id_start.$num ;	
		}						
	}//end while loop

 ?>