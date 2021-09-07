<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<nav class="navbar navbar-light bg-light">
		  <form class="form-inline">
		    <div class="input-group">
		      <div class="input-group-prepend">
		        <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
		      </div>
		      <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
		    </div>
		  </form>
 			<a href="<?=ROOT?>/signup">
				<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
			</a>
 		</nav>

		<div class="card-group justify-content-center">

			<?php if($rows):?>
				<?php foreach ($rows as $row):?>
				 
				<?php include(views_path('user'))?>

	 			<?php endforeach;?>
 			<?php else:?>
 				<h4>No staff members were found at this time</h4>
 			<?php endif;?>
		</div>

		<?php $pager->display()?>
	 
	</div>
 
<?php $this->view('includes/footer')?>