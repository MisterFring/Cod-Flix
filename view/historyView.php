<?php ob_start();

require_once 'model/media.php';

$hist = getHistory($_SESSION['user_id']);

?>
<div class="container table-responsive py-5"> 
	<table class="table table-bordered table-hover">
	  <thead class="thead-dark">
	    <tr>
	    	<th scope="col">#</th>
			<th scope="col">Title</th>
			<th scope="col">Début de stream</th>
			<th scope="col">Fin du Stream</th>
			<th scope="col">Durée du stream</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php 
	  		foreach ($hist as $value) {
		  		$media = getMediaById($value['media_id']);
	  	?>
	  		<tr>
				<th scope="row"><?= $value['id'] ?></th>
				<td><?= $media['title'] ?></td>
				<td><?= $value['start_date'] ?></td>
				<td><?= $value['finish_date'] ?></td>
				<td><?= $value['watch_duration'] ?></td>

	    	</tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>