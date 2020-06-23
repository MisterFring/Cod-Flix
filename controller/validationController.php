<?php

require_once( '../model/user.php' );


$login = $_GET['log'];
$cle = $_GET['key'];

$loginInteger = str_replace("'", "", $login);
$cle = str_replace("'", "", $cle);

// Récupération de la clé correspondant au $login dans la base de données
$db = init_db();

$stmt = $db->prepare('SELECT key_verif, active FROM user WHERE id = ?');
print_r($stmt);
$stmt->execute(array($loginInteger));
$row = $stmt->fetch();

$test = $row['email'];
$bdd_key = $row['key_verif'];    // Récupération de la clé
$active = $row['active']; // $actif contiendra alors 0 ou 1

  echo 'variable login'.$login.'<br>';
  echo 'variable clé'.$cle.'<br>';
  echo 'variable bddkey'.$bdd_key.'<br>';
  echo 'variable active'.$active.'<br>';


// On teste la valeur de la variable $actif récupérée dans la BDD

if($active == '1'){ // Si le compte est déjà actif on prévient
  echo "Votre compte est déjà actif !";
}
  else // Si ce n'est pas le cas on passe aux comparaisons
  {
    if($cle == $bdd_key) // On compare nos deux clés    
    {
      // Si elles correspondent on active le compte !    
      echo "Votre compte a bien été activé !";

      // La requête qui va passer notre champ actif de 0 à 1
      $stmt = $db->prepare("UPDATE user SET active = 1 WHERE id = :id ");
      $stmt->bindParam(':id', $loginInteger);
      $stmt->execute();
      // $dbh = null;
    }
    else // Si les deux clés sont différentes on provoque une erreur...
    {
    echo "Erreur ! Votre compte ne peut être activé...";
    }
  }
?>