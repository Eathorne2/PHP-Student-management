<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid">
		<h1><i class="fa fa-plus"></i>This is home</h1>
	</div>

	<?php 

		echo "<pre>";
		print_r($rows);
	?>
<?php $this->view('includes/footer')?>
