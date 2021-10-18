 <?php
	 	$image = get_image($row->image,$row->gender);
	 ?>
<div class="card m-2 shadow-sm" style="max-width: 12rem;min-width: 12rem;">
	  <img src="<?=$image?>" class=" rounded-circle card-img-top w-75 d-block mx-auto mt-1" alt="Card image cap">
  <div class="card-body">
    <center><h5 class="card-title"><?=$row->firstname?> <?=$row->lastname?></h5></center>
    <center><p class="card-text"><?=str_replace("_", " ", $row->rank)?></p></center>
    <a href="<?=ROOT?>/profile/<?=$row->user_id?>" class="btn btn-primary">Profile</a>
    
    <?php if(isset($_GET['select'])):?>
      <button name="selected" value="<?=$row->user_id?>" class="float-end btn btn-danger">Select</button>
    <?php endif;?>

  </div>
</div>