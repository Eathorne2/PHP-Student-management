<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<center><h4>Edit Profile</h4></center>
		<?php if($row):?>

		<?php
 			$image = get_image($row->image,$row->gender);
 		?>

		<form method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-4 col-md-3">
				<img src="<?=$image?>" class="border d-block mx-auto" style="width:150px;">
 				<br>
				<?php if(Auth::access('reception') || Auth::i_own_content($row)):?>
				<div class="text-center">
					<label for="image_browser" class="btn-sm btn btn-info text-white">
						<input onchange="display_image_name(this.files[0].name)" id="image_browser" type="file" name="image" style="display: none;">
 						Browse Image
 			 		</label>
 			 		<br>
 			 		<small class="file_info text-muted"></small>
				</div>
				<?php endif;?>
			</div>
			<div class="col-sm-8 col-md-9 bg-light p-2">
					<div class="p-4 mx-auto mr-4 shadow rounded" >
					 
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

						<input class="my-2 form-control" value="<?=get_var('firstname',$row->firstname)?>" type="firstname" name="firstname" placeholder="First Name" >
						<input class="my-2 form-control" value="<?=get_var('lastname',$row->lastname)?>" type="lastname" name="lastname" placeholder="Last Name" >
						<input class="my-2 form-control" value="<?=get_var('email',$row->email)?>" type="email" name="email" placeholder="Email" >

						<select class="my-2 form-control" name="gender">
							<option <?=get_select('gender',$row->gender)?> value="<?=$row->gender?>"><?=ucwords($row->gender)?></option>
							<option <?=get_select('gender','male')?> value="male">Male</option>
							<option <?=get_select('gender','female')?> value="female">Female</option>
						</select>
 
						<select class="my-2 form-control" name="rank">
							<option <?=get_select('rank',$row->rank)?> value="<?=$row->rank?>"><?=ucwords($row->rank)?></option>
							<option <?=get_select('rank','student')?> value="student">Student</option>
							<option <?=get_select('rank','reception')?> value="reception">Reception</option>
							<option <?=get_select('rank','lecturer')?> value="lecturer">Lecturer</option>
							<option <?=get_select('rank','admin')?> value="admin">Admin</option>

							<?php if(Auth::getRank() == 'super_admin'):?>
							<option <?=get_select('rank','super_admin')?> value="super_admin">Super Admin</option>
							<?php endif;?>

						</select>
 
						<input class="my-2 form-control" value="<?=get_var('password')?>" type="text" name="password" placeholder="Password">
						<input class="my-2 form-control" value="<?=get_var('password2')?>" type="text" name="password2" placeholder="Retype Password">
						<br>
						<button class="btn btn-primary float-end">Save Changes</button>

						<a href="<?=ROOT?>/profile/<?=$row->user_id?>">
							<button type="button" class="btn btn-danger">Back to profile</button>
						</a>
						 
					</div>
			</div>
		</div>
		</form>
		<br>
 		 
		<?php else:?>
			<center><h4>That profile was not found!</h4></center>
		<?php endif;?>

	</div>
<script>
	
	function display_image_name(file_name)
	{
		document.querySelector(".file_info").innerHTML = '<b>Selected file:</b><br>' + file_name;
	}
</script>
<?php $this->view('includes/footer')?>
