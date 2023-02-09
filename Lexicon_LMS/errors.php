<?php  
// errors array
if (count($errors) > 0) : ?>
  <div class='error padding-lr-10'>
  	<?php foreach ($errors as $error): ?>
  		<p class='red-text'>Error: <?php echo $error;?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
