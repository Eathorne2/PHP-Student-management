<?php $this->view('includes/header')?>
	
	<div class="container-fluid">
		
		<div class="p-4 mx-auto mr-4 shadow rounded" style="margin-top: 50px;width:100%;max-width: 340px;">
			<h2 class="text-center">My School</h2>
			<img src="<?=ROOT?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width:100px;">
			<h3>Add User</h3>
			<input class="my-2 form-control" type="firstname" name="firstname" placeholder="Frist Name" >
			<input class="my-2 form-control" type="lastname" name="lastname" placeholder="Last Name" >
			<input class="my-2 form-control" type="email" name="email" placeholder="Email" >

			<select class="my-2 form-control">
				<option>--Select a Gender--</option>
				<option>Male</option>
				<option>Female</option>
			</select>
			<select class="my-2 form-control">
				<option value="">--Select a Rank--</option>
				<option value="student">Student</option>
				<option value="reception">Reception</option>
				<option value="lecturer">Lecturer</option>
				<option value="admin">Admin</option>
				<option value="super_admin">Super Admin</option>
			</select>

			<input class="my-2 form-control" type="text" name="password" placeholder="Password">
			<input class="my-2 form-control" type="text" name="password2" placeholder="Retype Password">
			<br>
			<button class="btn btn-primary float-end">Add User</button>
			<button class="btn btn-danger">Cancel</button>
		</div>
	</div>

<?php $this->view('includes/footer')?>