<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<?php if($row):?>
 
		<div class="row">
	 	<center><h4><?=esc(ucwords($row->class))?></h4></center>
			<table class="table table-hover table-striped table-bordered">
				<tr><th>Created by:</th><td><?=esc($row->user->firstname)?> <?=esc($row->user->lastname)?></td>
				<th>Date Created:</th><td><?=get_date($row->date)?></td></tr>

			</table>
 		</div>
 		 
			<ul class="nav nav-tabs">
			  <li class="nav-item">
			    <a class="nav-link <?=$page_tab=='lecturers'?'active':'';?> " href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=lecturers">Lecturers</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link <?=$page_tab=='students'?'active':'';?> " href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=students">Students</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link <?=$page_tab=='tests'?'active':'';?> " href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">Tests</a>
			  </li>
		 
			</ul>

			

		 		<?php

		 			switch ($page_tab) {
		 				case 'lecturers':
		 					// code...
		 					include(views_path('class-tab-lecturers'));
		 					break;

		 				case 'students':
		 					// code...
		 					include(views_path('class-tab-students'));
		 					break;

		 				case 'tests':
		 					// code...
		 					include(views_path('class-tab-tests'));

		 					break;
		 				case 'lecturer-add':
		 					// code...
		 					include(views_path('class-tab-lecturers-add'));

		 					break;
		 				case 'student-add':
		 					// code...
		 					include(views_path('class-tab-students-add'));

		 					break;
		 					
		 				case 'lecturer-remove':
		 					// code...
		 					include(views_path('class-tab-lecturers-remove'));

		 					break;
		 				case 'student-remove':
		 					// code...
		 					include(views_path('class-tab-students-remove'));

		 					break;
		 					
		 				case 'students-add':
		 					// code...
		 					include(views_path('class-tab-students-add'));

		 					break;
		 				case 'tests-add':
		 					// code...
		 					include(views_path('class-tab-tests-add'));

		 					break;
		 				
		 				default:
		 					// code...
		 					break;
		 			}


		 		?>
		 
		<?php else:?>
			<center><h4>That class was not found!</h4></center>
		<?php endif;?>

	</div>

<?php $this->view('includes/footer')?>
