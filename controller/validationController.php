<?php

require_once( '../model/user.php' );

// ********************************************************************
// RETRIEVE KEY & ID FIELD IN THE URL BY GET METHOD
$login = $_GET['log'];
$cle = $_GET['key'];

$loginInteger = str_replace("'", "", $login);
$key = str_replace("'", "", $cle);
// ********************************************************************


// ********************************************************************
// RETRIEVE KEY & ACTIVE FIELD IN DATABASE, CORRESPONDING TO THIS USER

$db = init_db();
$stmt = $db->prepare('SELECT key_verif, active FROM user WHERE id = ?');
$stmt->execute(array($loginInteger));
$row = $stmt->fetch();


$bdd_key = $row['key_verif'];
$active = $row['active'];

// ********************************************************************


// WE TEST THE VARIABLE $ACTIVE

if($active == '1'){ // IF ACCOUNT ALREADY ACTIVE
  echo "Votre compte est déjà actif !";
  ?><a href="http://localhost:8888/Cod-Flix/index.php?action=login"><button>GO</button></a><?php
}
  else
  {
    if($key == $bdd_key) // COMPARE GET KEY AND DATABASE KEY    
    {
      // ACCOUNT ACTIVATION    
      echo "Votre compte a bien été activé !";

      $stmt = $db->prepare("UPDATE user SET active = 1 WHERE id = :id ");
      $stmt->bindParam(':id', $loginInteger);
      $stmt->execute();

      ?><a href="http://localhost:8888/Cod-Flix/index.php?action=login"><button>GO</button></a><?php;
    }
    else // IF KEYS ARE DIFFERENT
    {
    echo "Erreur ! Votre compte ne peut être activé... Problème d'authentification";
    ?><a href="http://localhost:8888/Cod-Flix/index.php?action=signup"><button>GO SIGN UP</button></a><?php
    }
  }
?>