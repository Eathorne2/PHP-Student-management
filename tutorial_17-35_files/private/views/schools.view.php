<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<div class="card-group justify-content-center">

			<table class="table table-striped table-hover">
				<tr><th>School</th><th>Created by</th><th>Date</th>
					<th>
						<a href="<?=ROOT?>/schools/add">
							<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
						</a>
					</th>
				</tr>
				<?php if($rows):?>
					 
					<?php foreach ($rows as $row):?>
					 
					 <tr><td><?=$row->school?></td><td><?=$row->user->firstname?> <?=$row->user->lastname?></td><td><?=get_date($row->date)?></td>

					 	<td>
					 		<a href="<?=ROOT?>/schools/edit/<?=$row->id?>">
					 			<button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
					 		</a>

					 		<a href="<?=ROOT?>/schools/delete/<?=$row->id?>">
					 			<button class="btn-sm btn btn-danger"><i class="fa fa-trash-alt"></i></button>
					 		</a>

					 		<a href="<?=ROOT?>/switch_school/<?=$row->id?>">
					 			<button class="btn-sm btn btn-success">Switch to<i class="fa fa-chevron-right"></i></button>
					 		</a>

					 		
					 	</td>

					 </tr>

		 			<?php endforeach;?>
	 			<?php else:?>
	 				<h4>No schools were found at this time</h4>
	 			<?php endif;?>

			</table>

		</div>

		
	 
	</div>
 
<?php $this->view('includes/footer')?>