<center><h4>My Classes</h4></center>
<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
      </div>
      <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
    </div>
  </form>
</nav>
 
<hr>
<?php $rows = $student_classes;?>
<?php include(views_path('classes'))?>

