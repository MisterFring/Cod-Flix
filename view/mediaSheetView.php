<?php ob_start();
require_once 'model/media.php';
$id = $_GET['media'];
$res = getMediaById($id);

// PREFERE TAKING DATABASE DATA THAN USER DATE BY GET METHOD
insertOrUpdateIntoHistory($_SESSION['user_id'], $res['id']);
?>

<div class="container-fluid">
  <a href="<?= $_SERVER['HTTP_REFERER']; ?>"><button id="return_button" type="button" class="btn btn-secondary btn-lg btn-block">Retour à la liste</button></a>
</div>

<section class="hea">
	<div class="overlay"></div>
	<div class="video">
	    <div>
	        <iframe allowfullscreen="" frameborder="0"
	                src="<?= $res['trailer_url']; ?>" >       
	        </iframe>
	    </div>
	</div>
</section>

<section class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h3><?= $res['title']?></h3>
        <h4>Sortie : <?= $res['release_date'] ?> - Durée : <?= transformSqlTimeInHhSs($res['duration']) ?></h4>
        <p><?= $res['summary']?></p>
      </div>
    </div>
  </div>
</section>






<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>