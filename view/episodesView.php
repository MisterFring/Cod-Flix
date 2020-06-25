<?php ob_start();
require_once 'model/media.php';

// GET SOME DETAILS IN "CASCADE"

$episodes = getEpisodes($_GET['season']);

$season_details = getSeasonTitle($_GET['season']);

$season_title = $season_details['title'];
$media_id = $season_details['media_id'];

$media_title = getMediaById($media_id)['title'];

// **********************************//

?>
<div class="container-fluid">
  <a href="<?= $_SERVER['HTTP_REFERER']; ?>"><button type="button" class="btn btn-secondary btn-lg btn-block">Retour</button></a>
</div>
<div class="container table-responsive py-5">
	<h3><?= $media_title ?> - <?= $season_title ?></h3>
	<table class="table table-bordered table-hover">
	  <thead class="thead-dark">
	    <tr>
	    	<th scope="col">Episode</th>
			<th scope="col">Titre</th>
			<th scope="col">Description</th>
			<th scope="col">Durée</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($episodes as $episode) {?>
	  		<tr>
	  			<td><?= $episode['index_episode'] ?></td>
				<td><?= $episode['title'] ?></td>
				<td><?= $episode['summary'] ?></td>
				<td><?= transformSqlTimeInHhSs($episode['duration']) ?><br><button><a href="index.php?episode=<?= $episode['id']; ?>">Stream</a></button></td>

	    	</tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>