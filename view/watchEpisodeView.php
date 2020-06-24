<?php ob_start();
require_once 'model/media.php';
$id = $_GET['episode'];
$video = getVideo($id);
insertOrUpdateEpisodeIntoHistory($_SESSION['user_id'], $id);
?>
<style type="text/css">

.hea {
  position: relative;
  background-color: black;
  height: 75vh;
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
}

.hea iframe {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

</style>

<section class="hea">
	<div class="overlay"></div>
	<div class="video">
	    <div>
	        <iframe allowfullscreen="" frameborder="0"
	                src="<?= $video ?>">
	        </iframe>
	    </div>
	</div>
</section>






<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>