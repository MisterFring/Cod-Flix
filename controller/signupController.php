<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/

function signup($post){

	$data = new stdClass();
	$data->email = $post['email'];
	$data->password = $post['password'];
	$data->password_confirm = $post['password_confirm'];

	try {
		check_password($post['password']);
		$user = new User ($data);
		$user->createUser();
		header('Refresh:5;url= http://localhost:8888/Cod-Flix/index.php?action=login');
		echo "<div style='border:1px dotted black;margin-top:20%;'><p style='text-align:center;'>Un mail de confirmation contenant un lien d'activation de votre compte vient d'être envoyé sur votre email</p></div>";
		//require('view/auth/loginView.php');
	}
	catch (Exception $error){
		$error_msg = $error->getMessage();
		require('view/auth/signupView.php');
	}

}