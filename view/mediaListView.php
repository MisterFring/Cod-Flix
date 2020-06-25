<?php ob_start();
require_once( 'model/media.php' );

/********************************************
* ----- 2 ways to get here, either by "home", 
or by clicking on a media being a series ---
*********************************************/

if (!isset($_GET['media'])) {
?>
<div class="row">
    <div class="col-md-4">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Genre
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 offset-md-8">
        <form method="get">
            <div class="form-group has-btn">
                <input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
                       placeholder="Rechercher un film ou une série">

                <button type="submit" class="btn btn-block bg-red">Valider</button>
            </div>
        </form>
    </div>
</div>

<!-- ***************************************************************************** -->
<!-- Separation of films and series not yet optimized, the same foreach runs twice -->
<!-- ***************************************************************************** -->

<h3>Films</h3>
<div class="media-list">
    <?php
    foreach( $medias as $media ):
        if ($media['type']=='film'):
        ?>
        <a class="item" href="index.php?media=<?= $media['id']; ?>">
            <div class="video">
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $media['trailer_url']; ?>" >
                                
                    </iframe>
            </div>
            <div class="title"><?= $media['title']; ?></div>
            <div class="release_date">
                <?php
                $available = available($media ['release_date']);
                ($available) ? $msg = "Disponible depuis :<br>" : $msg = "Disponible le :<br>";
                echo $msg . $media ['release_date'] ;
                ?>
            </div>
        </a>
    <?php
        endif;
    endforeach; ?>
</div>


<h3>Séries</h3>
<div class="media-list">
    <?php
    foreach( $medias as $media ):
        if ($media['type']=='series'):
        ?>
        <a class="item" href="index.php?media=<?= $media['id']; ?>">
            <div class="video">
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $media['trailer_url']; ?>" >
                                
                    </iframe>
            </div>
            <div class="title"><?= $media['title']; ?></div>
            <div class="release_date">
                <?php
                $fetchSeasons = getSeasons($media['id']);
                $numberOfSeasons = count($fetchSeasons);
                echo ($numberOfSeasons > 1 ) ? ($numberOfSeasons.' Saisons') : $numberOfSeasons.' Saison';
                ?>
            </div>
        </a>
    <?php 
        endif;
    endforeach; ?>
</div>


<!-- ************************* -->
<!-- IF WE CLICKED ON A SERIES -->
<!-- ************************* -->

<?php }
else {
    $res = getSeasons($_GET['media']);

?>
<div class="container-fluid">
  <a href="<?= $_SERVER['HTTP_REFERER']; ?>"><button type="button" class="btn btn-secondary btn-lg btn-block">Retour</button></a>
</div>
<h3 id="hea"><?= getMediaById($res[0]['media_id'])['title'] ?></h3>
<div class="media-list">
    <?php
    foreach( $res as $season ):
        ?>
        <a class="item" href="index.php?season=<?= $season['id']; ?>">
            <div class="video">
                
                    <img src="<?= $season['picture']; ?>" class="img-fluid" alt="Responsive image">
                
            </div>
            <div class="title"><?= $season['title']; ?></div>
        </a>
    <?php endforeach; ?>
</div>







<?php } ?>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
