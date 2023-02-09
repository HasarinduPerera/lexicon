<footer class="page-footer padding-none">
	<div class="footer-copyright">
    <div class="container-fluid">
    	<div class="row margin-0">   	
      	<div class="col   s12">
          <h6 class="font-14 align-center">&copy; 2023 LEXICON Learning Management System</h6>
        </div>	<!--company copyright--> 	
    	</div>	<!--row-->		    
    </div> <!--container-->
  </div> <!--copyright container-->
</footer>

<!--JavaScript at end of body for optimized loading-->

<script src="https://kit.fontawesome.com/4e1640f996.js" crossorigin="anonymous"></script>     
<script> 	

$(document).ready(function(){
  //initialization and function calls
    $('.sidenav').sidenav();
    $('select').formSelect();
    $('.modal').modal();
    $('.materialboxed').materialbox();
    $('.datepicker').datepicker({
      yearRange : [1970,2020],
      format: 'yyyy-mm-dd'
    });
  });
</script>
</body>
</html>