<?php ob_start();
?>

<div class="landscape">
  <div class="bg-black">
    <div class="row no-gutters">
      <div class="col-md-6 full-height bg-white">
        <div class="auth-container">
          <h2><span>Cod</span>'Flix</h2>
          <h3>Contactez nous</h3>

          <form method="post" action="index.php?action=contact_without_account" class="custom-form">

            <div class="form-group">
              <label for="email">Votre email</label>
              <input type="email" name="email" id="email" class="form-control" required/>
            </div>

            <div class="form-group">
              <label for="subject">Sujet</label>
              <input type="text" name="subject" id="subject" class="form-control" required/>
            </div>

            <div class="form-group">
              <label for="content">Votre message</label>
              <textarea class="form-control" rows="5" id="content" name="content" required></textarea>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <input type="submit" name="validate" class="btn btn-block bg-red" />
                </div>
                <div class="col-md-6">
                  <a href="index.php?action=login" class="btn btn-block bg-blue">Connexion</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6 full-height">
        <div class="auth-container">
          <h1>Bienvenue sur Cod'Flix !</h1>
        </div>
      </div>
    </div>
  </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require( __DIR__ . '/base.php'); ?>