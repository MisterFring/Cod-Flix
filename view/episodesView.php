<?php ob_start();
require_once 'model/media.php';

// GET SOME DETAILS IN "CASCADE"

$episodes = getEpisodes($_GET['season']);

$season_detais = getSeasonTitle($_GET['season']);

$season_title = $season_detais['title'];
$media_id = $season_detais['media_id'];

$media_title = getMediaById($media_id)['title'];

// **********************************//

?>
<h3><?= $media_title ?> - <?= $season_title ?></h3>
<div class="container table-responsive py-5"> 
	<table class="table table-bordered table-hover">
	  <thead class="thead-dark">
	    <tr>
	    	<th scope="col">#</th>
			<th scope="col">Title</th>
			<th scope="col">Summary</th>
			<th scope="col">Duration</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($episodes as $episode) {?>
	    <tr>
			<th scope="row"><?= $episode['id'] ?></th>
			<td><?= $episode['title'] ?></td>
			<td><?= $episode['summary'] ?></td>
			<td><?= $episode['duration'] ?></td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>