<?php
//Page type: LEXICON Landing Page

$PageTitle="LEXICON Learning Management System"; //page title

require_once('header.php'); //includes consistent header element
?>
<!--main page content-->
<main>
	<!--parallax banner section start-->
	<style type="text/css">
	.page-footer .container-fluid .row .col.l3.m6.offset-l1.s12 .font-14 .margin-bottom-5 .grey-text.text-lighten-3 .contact-icon.tiny.material-icons {
	color: #F05354;
}
.page-footer .container-fluid .row .col.l3.m6.offset-l1.s12 .white-text {
	color: #F05354;
	font-weight: bold;
}
    .button.amber.accent-4.pulse.section .material-icons {
	color: #F05354;
}
    .page-footer .container-fluid .row .col.l4.s12 {
	color: #FFF;
}
    .page-footer .container-fluid .row .col.l4.m6.s12 .white-text {
	color: #F05354;
}
    .page-footer .container-fluid .row .col.l4.m6.s12 .red-text {
	color: #F05354;
	font-weight: bold;
}
    .page-footer .container-fluid .row .col.l3.m6.offset-l1.s12 .red-text {
	color: #F05354;
	font-weight: bold;
}
    </style>
	
  <section class="banner-img valign-wrapper">
   <p class="white-text >This website helps you to learn online education courses at your comfortable place for free. The courses for these websites are offered by top teachers in Sri Lanka. You can learn a specific subject without any investment.This websites offer many audio, video, articles and e-books to increase your knowledge as well. This platforms enable you to learn the best free online courses..
  </p>
		<a class="btn-floating amber accent-4 pulse section" href="#courses_section"><i class="material-icons">arrow_drop_down</i></a> <!--interactive arrow-->
	</section> <!--parallax banner section end-->

	<!--courses section-->
	<section class="margin-bottom-40" id="courses_section">
		<div class="container-fluid">	
			<div class="row">	
				<div class="col s12">	
					<h3 class="section-title">Courses</h3> <!--section title-->
				</div>	
			</div>	
		  <div class="card-flex">
			<?php include_once('courses.php');?> <!--populate courses from course.php file-->
			</div><!--card-flex end-->
		</div><!--container-fluid end-->	
	</section><!--courses section end-->

	<!--Testimonial section-->
	<section>	
		<div class="carousel carousel-slider center grey  lighten-3" style="min-height: 450px;">
	 		<div class="carousel-fixed-item center">
		      	<h3 class="section-title">Why Study With Us?</h3> <!--section title-->
		    </div><!--carousel fixed item-->

		    <!--carousel item 1-->
	 		<div class="carousel-item grey  lighten-3 " href="#one!">
 			  <div class="carousel-content container ">		 				
	 				<h2>Best Academy Ever!!</h2>
 				<div class="media">
	 					<div class="media-right">
		 					 <img src="images/student_1.jpg" alt="Ashley Smith" class="circle circle-img pos-right"> <!-- student image-->
		 				</div><!--media end - image holder-->
			      		<div class=" media-body">
		      				<div class="quote">
			      				<p class="align-justify">LEXICON is by far the best tuition academy in Sri Lanka. The academy offers a variety of courses covering a wide range of subject areas at all levels of education. The lecturers are highly qualified and they adjust their teaching methodology based on your personal learning style. I will definitely recommend you to study with this instituition</p>
			      			</div><!--quote end-->
			      		</div><!--media-body end-->
 				  </div><!--media end-->
 				  <cite class="color-red" style="font-style: italic; color: #F05354;">&hyphen;&hyphen;&nbsp;MND Dias</cite> <!--student name-->
	 			</div><!--carousel-content end-->
		    </div><!--carousel item 1 end-->

		    <!--carousel item 2-->
		    <div class="carousel-item grey  lighten-3 " href="#two!">
 			  <div class="carousel-content container">
		      		<h2>Good Learning Experience</h2>
	      		<div class="media">
	 					<div class="media-right">
		 					 <img src="images/student_2.jpg" alt="Suzanne John" class="circle circle-img pos-left"> <!-- student image -->
		 				</div>
			      		<div class=" media-body">
			      			<div class="quote">
			      				<p class="align-justify">The learning experience is great. Lecturers are very highly qualified and make learning more engaging for students. I am able to understand my subject areas very well thanks to the academy. </p>
			      			</div><!--quote end-->
			      		</div><!--media-body end-->
 				  </div><!--media end-->
	      		  <cite class="color-red" style="font-style: italic; color: #F05354;">&hyphen;&hyphen;&nbsp;NHKS Perera</cite> <!--student name-->
	 			</div><!--carousel-content end-->
		    </div><!--carousel item 1 end-->

		    <!--carousel item 3-->
			    <div class="carousel-item grey  lighten-3 " href="#two!">
	 			  <div class="carousel-content container">
			      		<h2>Learnt A lot</h2>
		      		<div class="media">
		 					<div class="media-right">
			 					 <img src="images/student_3.jpg" alt="Michael" class="circle circle-img pos-right"> <!-- student image -->
			 				</div><!-- student image holder-->
				      		<div class=" media-body">
				      			<div class="quote">
				      				<p class="align-justify">I learned a lot while enrolled in LEXICON Learning Management System. My grades improved a great deal and I began to enjoy studying. The lecturers make the classes very engaging. The courses are very comprehensive and relavant to your subject area so they cover all the necessary details you may need. </p>
				      			</div><!--quote end-->
			      		</div><!--media-body end-->
	 				</div><!--media end-->
		      		<cite class="color-red" style="font-style: italic; color: #F05354;">&hyphen;&hyphen;&nbsp;PKK Gayanjalee</cite> <!--student name-->
	 			</div><!--carousel-content end-->
		    </div><!--carousel item 1 end-->
		</div><!--carousel end--> 
	</section><!--testimonial section end--> 
</main><!--main body section end-->

<!--homepage footer different from other pages--> 
<footer class="page-footer">
  <div class="container-fluid">
    <div class="row">
    <!--about and social media column-->	
      <div class="col l4  s12">
        <a><img src="images/logo.png" alt="LEXICON"></a><!--logo-->
        <p class="grey-text text-lighten-3 align-justify margin-bottom-20">This website helps you to learn online education courses at your comfortable place for free. The courses for these websites are offered by top teachers in Sri Lanka. You can learn a specific subject without any investment.This websites offer many audio, video, articles and e-books to increase your knowledge as well. This platforms enable you to learn the best free online courses..</p> 
        <!--company description-->

        <hr class="margin-top-20">

        <ul class="social-media">
        	<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        	<li><a href="https://www.twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        	<li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        	<li><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        </ul> <!--social media icons-->
      </div><!--about and social media column end-->

      <!--quick contact column-->
      <div class="col l3 m6 offset-l1 s12">
        <h5 class="red-text">Quick Contact</h5>
        <ul class="font-14">
          	<li class="margin-bottom-5">
              	<a class="grey-text text-lighten-3" href="tell::+94 75 779 5854 <br>
                 +94 774027767<br>
                 +94 764535036">
              		<i class="contact-icon tiny material-icons">call</i>
					+94 75 779 5854/+94 774027767/+94 764535036
				</a> <!--clickable company phone numbers. This feature will only work on mobile devices-->
			</li>
          	<li class="margin-bottom-5">
          		<a class="grey-text text-lighten-3" href="mailto:lexicon@gmail.com?Subject=Hello%20lexicon%20learning%20Centre" target="_blank">
          			<i class="contact-icon tiny material-icons">email</i>
          			lexicon@gmail.com
       		  </a> <!--clickable company email-->
			</li>
         
        </ul> <!-- contact details-->      
      </div><!--quick contact column end-->
      <!--Subcscription column-->
      <div class="col l4 m6 s12">
        <h5 class="red-text">Stay connected</h5>
        <p class="grey-text text-lighten-3">Subscribe to our Newsletter to stay tuned with latest events and course listings</p>
        <form method="post">
	        <div class="input-field ">
	          <input id="email_list" type="email" name="email_list" class="validate">
	          <label for="email_list">Email</label>
	          <span class="helper-text" data-error="Invalid Email Address"></span>
	        </div>
	        <button class="btn waves-effect waves-light modal-trigger" data-target="subscription-model" type="submit" name="email_list">Subscribe
				<i class="material-icons right">send</i>
			</button> <!--triggers model-->
	    </form>
      </div> <!--Subcscription column end-->
    </div><!--row end-->
  </div><!--container-fluid end-->

  <!--company copyrights-->
  <div class="footer-copyright">
    <div class="container-fluid">
    	<div class="row margin-0">
    		<div class="col   s12">
          		<h6 class="font-14 align-center">&copy; 2023 LEXICON Learning Management System</h6>
          	</div>	<!--company copyright--> 	
    	</div>	<!--row-->		    
    </div> <!--container-->
  </div> <!--copyright container-->
</footer> <!--end of footer-->

<!--JavaScript at end of body for optimized loading-->
<script src="js/jquery.js" ></script> <!--minified jquery-->
<script src="js/materialize.min.js"></script><!--materialize jquery-->
<script src="https://kit.fontawesome.com/4e1640f996.js" crossorigin="anonymous"></script> <!--fontawesome jquery-->    
<script>
 	$(document).ready(function(){
	    $('.modal').modal(); //modal initialization
	    $('.materialboxed').materialbox();
	    $('.carousel.carousel-slider').carousel({
	    	duration: 200,
		    fullWidth: true,
		    indicators: true
		  }); //carousel initialization
  	});
</script>
</body>
</html>