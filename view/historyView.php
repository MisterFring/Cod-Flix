<?php ob_start();

require_once 'model/media.php';

$historyFilm = getHistoryFilm($_SESSION['user_id']);
$historySeries = getHistorySeries($_SESSION['user_id']);

?>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <h2>Historique</h2>
    </div>
    <div class="col-sm">
      <button class="btn btn-block bg-red"><a href="index.php?deleteAll">TOUT SUPPRIMER</a></button>
    </div>
  </div>
</div>
<h3>Films </h3>
<div class="container table-responsive py-5"> 
	<table class="table table-bordered table-hover">
	  <thead class="thead-dark">
	    <tr>
			<th scope="col">Titre</th>
			<th scope="col">Début de stream</th>
			<!-- <th scope="col">Fin du Stream</th>
			<th scope="col">Durée du stream</th> -->
			<th scope="col">Supprimer ligne</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php 
	  		foreach ($historyFilm as $value) {
		  		$media = getMediaById($value['media_id']);
	  	?>
	  		<tr>
				<td><?= $media['title'] ?></td>
				<td><?= $value['start_date'] ?></td>
				<!-- <td><?= $value['finish_date'] ?></td>
				<td><?= $value['watch_duration'] ?></td> -->
				<td><button class="btn btn-block bg-red"><a href="index.php?delete=<?= $value['id']; ?>">Supprimer</a></button></td>

	    	</tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>

<!-- **************************************************************************** -->
<!-- **************************** SERIES HISTORY ******************************** -->
<!-- **************************************************************************** -->

<h3>Séries</h3>
<div class="container table-responsive py-5"> 
	<table class="table table-bordered table-hover">
	  <thead class="thead-dark">
	    <tr>
			<th scope="col">Episode</th>
			<th scope="col">Titre</th>
			<th scope="col">Série</th>
			<th scope="col">Saison</th>
			<th scope="col">Début de stream</th>
			<!-- <th scope="col">Fin du Stream</th>
			<th scope="col">Durée du stream</th> -->
			<th scope="col">Supprimer ligne</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php 
	  		foreach ($historySeries as $val) {
	  			$episode = getEpisodeById($val['episode_id']);

	  			$season = getSeasonTitle($episode['season_id']);
	  			
		  		$media = getMediaById($season['media_id']);
	  	?>
	  		<tr>
				<td><?= $episode['index_episode'] ?></td>
				<td><?= $episode['title'] ?></td>
				<td><?= $media['title'] ?></td>
				<td><?= $season['title'] ?></td>
				<td><?= $val['start_date'] ?></td>
				<!-- <td><?= $val['finish_date'] ?></td>
				<td><?= $val['watch_duration'] ?></td> -->
				<td><button class="btn btn-block bg-red"><a href="index.php?delete=<?= $val['id']; ?>">Supprimer</a></button></td>

	    	</tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>