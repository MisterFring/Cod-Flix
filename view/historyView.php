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
    <!-- <div class="col-sm">
      One of three columns
    </div> -->
    <div class="col-sm">
      <button><a href="index.php?deleteAll">DELETE ALL</a></button>
    </div>
  </div>
</div>
<h3>Films </h3>
<div class="container table-responsive py-5"> 
	<table class="table table-bordered table-hover">
	  <thead class="thead-dark">
	    <tr>
			<th scope="col">Title</th>
			<th scope="col">Début de stream</th>
			<th scope="col">Fin du Stream</th>
			<th scope="col">Durée du stream</th>
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
				<td><?= $value['finish_date'] ?></td>
				<td><?= $value['watch_duration'] ?></td>
				<td><button><a href="index.php?delete=<?= $value['id']; ?>">DELETE</a></button></td>

	    	</tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>
<h3>Séries</h3>
<div class="container table-responsive py-5"> 
	<table class="table table-bordered table-hover">
	  <thead class="thead-dark">
	    <tr>
			<th scope="col">Title</th>
			<th scope="col">Début de stream</th>
			<th scope="col">Fin du Stream</th>
			<th scope="col">Durée du stream</th>
			<th scope="col">Supprimer ligne</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php 
	  		foreach ($historySeries as $value) {
	  			//faire recherche en cascade du nom média & nom saison
		  		//$media = getMediaById($value['media_id']);
	  	?>
	  		<tr>
				<td>test</td>
				<td><?= $value['start_date'] ?></td>
				<td><?= $value['finish_date'] ?></td>
				<td><?= $value['watch_duration'] ?></td>
				<td><button><a href="index.php?delete=<?= $value['id']; ?>">DELETE</a></button></td>

	    	</tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>