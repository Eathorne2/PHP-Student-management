
<?php $percentage = get_answer_percentage($row->test_id,Auth::getUser_id())?>

<div class="container-fluid text-center">
	<div class="text-danger"><?=$percentage?>% Answered</div>
	<div class="bg-primary" style="width: <?=$percentage?>%;height: 5px;"></div>
	<?php if($answered_test_row):?>
		<?php if($answered_test_row->submitted):?>
			<div class="text-success">This test has been submitted</div>
		<?php else:?>
			<div class="text-danger">
				This test has not yet been submitted<br>
				<a onclick="submit_test(event)" href="<?=ROOT?>/take_test/<?=$row->test_id?>/?submit=true">
					<button class="btn btn-danger float-end">Submit Test</button>
				</a>
			</div>
		<?php endif;?>

	<?php endif;?>

</div>

<nav class="navbar">
	<center>
		<h5>Test Questions</h5>
		<p><b>Total Questions:</b> <?=$total_questions?></p>
	</center>
 
</nav>

<hr>

<?php if(isset($questions) && is_array($questions)):?>

<form method="post">

	<?php $num = $pager->offset;; ?>
	<?php foreach($questions as $question): $num++?>

	    	<?php  

	    		$myanswer = get_answer($saved_answers,$question->id);
	    	?>
 
		<div class="card mb-4 ">
		  <div class="card-header">
		    <span  class="bg-primary p-1 text-white rounded">Question #<?=$num?></span> <span class="badge bg-primary float-end p-2"><?=date("F jS, Y H:i:s a",strtotime($question->date))?></span>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title"><?=esc($question->question)?></h5>

		    <?php if(file_exists($question->image)):?>
		    	<img src="<?=ROOT . '/'.$question->image?>" style="width:50%">
		  	<?php endif;?>

		    <p class="card-text"><?=esc($question->comment)?></p>
			  <?php
			  	$type = '';
			  ?>

		    	<?php if($question->question_type == 'objective'):
		    		$type = '?type=objective';
		    	?>
		    	
		    	<?php endif;?>

		    	<?php if($question->question_type == 'multiple'):
		    		$type = '?type=multiple';
		    	?>

		    		<div class="card" style="width: 18rem;">
						  <div class="card-header">
						    Select your answer
						  </div>
						  <ul class="list-group list-group-flush">

						  	<?php $choices = json_decode($question->choices);?>
						  	<?php foreach($choices as $letter => $answer):?>
						    	<li class="list-group-item"><?=$letter?>: <?=$answer?> 

						    	<?php if(!$submitted):?>
						    		<input class="float-end" style="transform: scale(1.5);cursor: pointer;" type="radio" name="<?=$question->id?>" <?=$myanswer == $letter ? ' checked ':''?> value="<?=$letter?>" >
						    	<?php else:?>
							    	<?php if($myanswer == $letter):?>
							    		<i class="fa fa-check float-end"></i>
							    	<?php endif;?>
						    	<?php endif;?>
						    </li>
						    <?php endforeach;?>

 						  </ul>
						</div>
						<br>
		    	
		    	<?php endif;?>

		    <?php if($question->question_type != 'multiple'):?>

		    	<?php if(!$submitted):?>
	  				<input type="text" value="<?=$myanswer?>" class="form-control" name="<?=$question->id?>" placeholder="Type your answer here">
  				<?php else:?>
  					<div>Answer: <?=$myanswer?></div>
  				<?php endif;?>
  			<?php endif;?>
		  </div>
		 
		</div>
	<?php endforeach;?>

	<?php if(!$submitted):?>
		<center>
			<small>Click save answers before moving to another page to save your answers</small><br>
			<button class="btn btn-primary">Save Answers</button>
		</center>
		</form>
	<?php endif;?>
<?php endif;?>

<?php $pager->display()?>

<script>
	
	var percent = <?=$percentage?>;

	function submit_test(e)
	{

		if(!confirm("Are you sure you want to submit this test!?")){
			e.preventDefault();
			return;
		}

		if(percent < 100){
			if(!confirm("You have only answered "+ percent +"% of the test. Are you still sure you want to submit?!")){
				e.preventDefault();
				return;
			}
		}

		
	}

</script>

