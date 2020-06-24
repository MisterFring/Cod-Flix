<?php
require_once( 'model/user.php' );

/****************************
* ----- LOAD CONTACT PAGE -----
****************************/

function contactPage() {

	require('view/contactView.php');

}


function contactPageWithoutAccount() {
	require('view/contactPageWithoutAccount.php');

	if (isset($_POST['validate'])) {

  		emailPlatform($_POST['subject'], $_POST['email'], $_POST['content']);

	}
	
}
?>