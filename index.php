<?php

require_once( 'controller/homeController.php' );
require_once( 'controller/loginController.php' );
require_once( 'controller/signupController.php' );
require_once( 'controller/mediaController.php' );
require_once( 'controller/contactController.php' );

/**************************
* ----- HANDLE ACTION -----
***************************/

if ( isset( $_GET['action'] ) ){

  switch( $_GET['action']):

    case 'login':

      if ( !empty( $_POST ) ) login( $_POST );
      else loginPage();

    break;

    case 'signup':
      if ( !empty( $_POST ) ) signup( $_POST );
      else signupPage();

    break;

    case 'history':
      history();
      break;

    case 'contact':
      contactPage();
      break;

    case 'contact_without_account':
      contactPageWithoutAccount();
      break;

    case 'logout':

      logout();

    break;

  endswitch;
}
elseif (isset($_GET['media'])) {

  mediaSheet();

}
elseif (isset($_GET['title'])) {
  
  mediaPage();

}

elseif (isset($_GET['season'])) {
  
  seasonPage();

}
elseif (isset($_GET['episode'])) {
  
  watchEpisode();

}
elseif (isset($_GET['delete'])) {
  
  deleteHistoryRow($_GET['delete']);

}
elseif (isset($_GET['deleteAll'])) {
  
  deleteAllHistory();

}

else {

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( $user_id ):
      mediaPage();
    else:
      homePage();
  endif;
}