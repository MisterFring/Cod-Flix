<?php ob_start();
require_once 'model/media.php';
$id = $_GET['episode'];
$video = getVideo($id);
insertOrUpdateEpisodeIntoHistory($_SESSION['user_id'], $id);
?>

<div class="container-fluid">
  <a href="<?= $_SERVER['HTTP_REFERER']; ?>"><button type="button" class="btn btn-secondary btn-lg btn-block">Retour aux épisodes</button></a>
</div>



<section class="hea">
	<div class="overlay"></div>
	<div class="video">
	        <iframe allowfullscreen="" frameborder="0"
	                src="<?= $video ?>">
	        </iframe>
	</div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>