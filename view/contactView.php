<?php ob_start();
require_once 'model/user.php';
if (isset($_POST['send'])) {
	$mail = $_SESSION['email'];
	emailPlatform($_POST['subject'],$mail,$_POST['message']);
}
?>
      <div class="col-md-12 col-md-offset-3">
        <div class="well well-sm">
          <form class="form-horizontal" action="index.php?action=contact" method="post">
          <fieldset>
            <legend class="text-center">Contactez nous</legend>
    
            <!-- Subject -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="subject">Sujet</label>
              <div class="col-md-9">
                <input id="subject" name="subject" type="text" placeholder="The subject of your request" class="form-control">
              </div>
            </div>
    
            <!-- Email -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Votre E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="<?= $_SESSION['email']?>" class="form-control" disabled value="<?= $_SESSION['email']?>">
              </div>
            </div>
    
            <!-- Message -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Votre message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12 col-xs-3 text-right">
                <button type="submit" name="send" class="btn btn-primary btn-lg">Envoyer</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>