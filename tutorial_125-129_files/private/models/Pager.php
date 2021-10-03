<?php 

/**
 * pagination class
 */
class Pager
{
	public $links 			= array();
	public $offset 			= 0;
	public $page_number 	= 1;
	public $start 			= 1;
	public $end 			= 1;

	public function __construct($limit = 10, $extras = 1)
	{
		// code...
  		$page_number = isset($_GET['page']) ? (int)$_GET['page']: 1;
 		$page_number = $page_number < 1 ? 1:$page_number;

 		$this->end = $page_number + $extras;
 		$this->start = $page_number - $extras;
 		if($this->start < 1)
 		{
 			$this->start = 1;
 		}

 		$this->offset = ($page_number - 1) * $limit;
 		$this->page_number = $page_number;

 		$current_link = ROOT. "/". str_replace("url=", "", $_SERVER['QUERY_STRING']);
 		$current_link = !strstr($current_link, "page=") ? $current_link . "&page=1":$current_link;

 		$first_link = preg_replace('/page=[0-9]+/', "page=1", $current_link);
 		$next_link = preg_replace('/page=[0-9]+/', "page=".($page_number + $extras + 1), $current_link);

 		$this->links['first'] = $first_link;
 		$this->links['current'] = $current_link;
 		$this->links['next'] = $next_link;
	}

	public function display()
	{
		?>
		<br class="clearfix">
		<div>
			<nav aria-label="Page navigation example">
			  <ul class="pagination justify-content-center">
			    <li class="page-item"><a class="page-link" href="<?=$this->links['first']?>">First</a></li>

			    <?php for($x = $this->start; $x <= $this->end;$x++):?>
 			    	<li class="page-item 
 			    	<?=($x == $this->page_number)?' active ':'';?>
 			    	"><a class="page-link" href="
 			    		<?= preg_replace('/page=[0-9]+/', "page=".$x, $this->links['current'])?>
 			    		"><?=$x?></a></li>
 				<?php endfor;?>

			    <li class="page-item"><a class="page-link" href="<?=$this->links['next']?>">Next</a></li>
			  </ul>
			</nav>
	 	</div>
	 	<?php 
	}
}