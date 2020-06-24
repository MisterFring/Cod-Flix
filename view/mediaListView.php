<?php ob_start();
require_once( 'model/media.php' );
?>


<div class="row">
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

<div class="media-list">
    <?php
    foreach( $medias as $media ):
        ?>
        <a class="item" href="index.php?media=<?= $media['id']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $media['trailer_url']; ?>" >
                                
                    </iframe>
                </div>
            </div>
            <div class="title"><?= $media['title']; ?></div>
            <div class="release_date">
                <?php 

                    $available = available($media ['release_date']);
                    ($available) ? $msg = "available since <br>" : $msg = "available on <br>";
                        echo $msg;
                ?>
                <?= $media ['release_date']?>
            </div>
        </a>
    <?php endforeach; ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
