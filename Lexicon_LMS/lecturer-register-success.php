<?php
//successfully registered lecturer
$PageTitle="Registration Success"; //page title
$page = "#aside-adm-lecturer"; //sidenav active tab

include_once('header.php');

if($_SESSION['usertype'] != 'admin'){
	header('location: 404.php');	
}
if(!isset($_SESSION['lecID'])){
	header("location: newlecturer.php");
}

?>

<main class=" row flex width-full margin-0">
	<?php include_once('aside.php'); ?><!--sidenav-->
	<section class="col s12 l9 m9 bg-grey padding-none-imp">
		<!--breadcrumb navigation-->	
		<div class="breadcrumb-container">	
			<div class="">
	        	<a href="managelecturers.php" class="breadcrumb">Manage Lecturer</a>
	        	<a href="newlecturer.php" class="breadcrumb">Add New Lecturer</a>
	      	</div>
		</div><!--breadcrumb navigation end-->
		<div class="padding-lr-20">	
			<div class="card margin-top-40">
				<div class="card-content">
					<h4 class="color-green fontw-500 center-align">Lecturer Successfully Registered</h4><!--Title-->		      	
			      	<h5 class="fontw-500 center-align id-highlight margin-top-30">Lecturer ID is : <span class="font-bold"><?php echo $_SESSION['lecID'];?></span></h5>  <!--Display lecturer ID-->	
			      	<div class="center-align margin-bottom-20 margin-top-30">	
			      		<a class="waves-effect waves-light btn left " href="admin-dashboard.php"><i class="material-icons left">arrow_back</i>Dashboard</a>
						<a class="waves-effect waves-light  btn margin-auto" href="managelecturers.php">Manage Lecturer Accounts</a>
						<a class="waves-effect waves-light  btn 	right" href="newlecturer.php"><i class="material-icons right">arrow_forward</i>Add Another Lecturer</a>
			      	</div> <!--Navigation-->	     	
				</div><!--card-content div close-->
			</div><!--card div close-->	
		</div> 
	</section>
</main>	
<?php
unset($_SESSION['lecID']); //remove value
include_once('footer.php');
?>
