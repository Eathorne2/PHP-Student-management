
		<div class="card-group justify-content-center">
 
			 <form method="post">
			 	<h3>Add A Test</h3>

			 	<?php if(count($errors) > 0):?>
				<div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
				  <strong>Errors:</strong>
				   <?php foreach($errors as $error):?>
				  	<br><?=$error?>
				  <?php endforeach;?>
				  <span  type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </span>
				</div>
				<?php endif;?>
			
			 	<input autofocus class="form-control" value="<?=get_var('test')?>" type="text" name="test" placeholder="Text Title"><br>
			 	<textarea name="description" class="form-control" placeholder="Add a description for this test"><?=get_var('description')?></textarea><br>
			 	<input class="btn btn-primary float-end" type="submit" value="Create">

			 	<a href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">
			 		<input class="btn btn-danger" type="button" value="Cancel">
			 	</a>
			 </form>
		</div>