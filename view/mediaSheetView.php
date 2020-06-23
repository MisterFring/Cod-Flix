<?php ob_start();
require_once 'model/media.php';
$id = $_GET['media'];
$res = getMediaById($id);
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
        <h4><?= $res['release_date'] ?></h4>
        <p><?= $res['summary']?></p>
      </div>
    </div>
  </div>
</section>






<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>