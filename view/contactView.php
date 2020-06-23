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
            <legend class="text-center">Contact us</legend>
    
            <!-- Subject input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="subject">Subject</label>
              <div class="col-md-9">
                <input id="subject" name="subject" type="text" placeholder="The subject of your request" class="form-control">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Your E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="<?= $_SESSION['email']?>" class="form-control" disabled value="<?= $_SESSION['email']?>">
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Your message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" name="send" class="btn btn-primary btn-lg">Submit</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
<?php $content = ob_get_clean(); ?>
<?php require('dashboard.php'); ?>