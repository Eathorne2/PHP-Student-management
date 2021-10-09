<?php $percentage = $this->get_answer_percentage($questions,$saved_answers)?>

<div class="container-fluid text-center">
	<div class="text-danger"><?=$percentage?>% Answered</div>
	<div class="bg-primary" style="width: <?=$percentage?>%;height: 5px;"></div>
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

	<?php $num = 0?>
	<?php foreach($questions as $question): $num++?>

	    	<?php  

	    		$myanswer = $this->get_answer($saved_answers,$question->id);
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

						    	<input class="float-end" style="transform: scale(1.5);cursor: pointer;" type="radio" name="<?=$question->id?>" <?=$myanswer == $letter ? ' checked ':''?> value="<?=$letter?>" >

						    </li>
						    <?php endforeach;?>

 						  </ul>
						</div>
						<br>
		    	
		    	<?php endif;?>

		    <?php if($question->question_type != 'multiple'):?>

	  			<input type="text" value="<?=$myanswer?>" class="form-control" name="<?=$question->id?>" placeholder="Type your answer here">
 
  			<?php endif;?>
		  </div>
		 
		</div>
	<?php endforeach;?>

	<center><button class="btn btn-primary">Save Your Answers</button></center>
	</form>
<?php endif;?>

