<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<?php if($row):?>
 
		<div class="row">
	 	<center><h4><?=esc(ucwords($row->test))?></h4></center>
			<table class="table table-hover table-striped table-bordered">
				<tr>
					<th>Created by:</th><td><?=esc($row->user->firstname)?> <?=esc($row->user->lastname)?></td>
					<th>Date Created:</th><td><?=get_date($row->date)?></td>
					<td>
						<a href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">
							<button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i>View class</button>
						</a>

						<a href="<?=ROOT?>/single_test/<?=$row->test_id?>?tab=scores">
							<button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i>Student scores</button>
						</a>

						
					</td>
				</tr>

				<?php $active = $row->disabled ? "No":"Yes";?>
				<tr>
					<td>
						<b>Published:</b> <?=$active?><br>

						<?php 

							$btntext = 'Unpublish';
							$btncolor = 'btn-primary';
							if($row->disabled){
								$btntext = 'Publish';
								$btncolor = 'btn-danger';
							}
						?>
						<a href="<?=ROOT?>/single_test/<?=$row->test_id?>?disable=true">
							<button class="btn btn-sm <?=$btncolor?>"><?=$btntext?></button>
						</a>
					</td>

					<td colspan="5"><b>Test Description:</b><br><?=esc($row->description)?></td></tr>
			</table>
 		</div>
 		 
		
		 		<?php

		 			switch ($page_tab) {
		 				case 'view':
		 					// code...
		 					include(views_path('test-tab-view'));
		 					break;

		 				case 'add-question':
		 					// code...
		 					include(views_path('test-tab-add-question'));
		 					break;

		 				case 'edit-question':
		 					// code...
		 					include(views_path('test-tab-edit-question'));
		 					break;

		 				case 'delete-question':
		 					// code...
		 					include(views_path('test-tab-delete-question'));
		 					break;
		 				
		 				case 'edit':
		 					// code...
		 					include(views_path('test-tab-edit'));
		 					break;

		 				case 'delete':
		 					// code...
		 					include(views_path('test-tab-delete'));
		 					break;

		 				case 'scores':
		 					// code...
		 					include(views_path('test-tab-scores'));
		 					break;
		 				
		 				default:
		 					// code...
		 					break;
		 			}


		 		?>
		 
		<?php else:?>
			<center><h4>That test was not found!</h4></center>
		<?php endif;?>

	</div>

<?php $this->view('includes/footer')?>
