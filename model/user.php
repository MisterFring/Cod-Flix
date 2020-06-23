<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;
  protected $password_confirm;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( check_password($user->password), isset( $user->password_confirm ) ? $user->password_confirm : false );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    $this->password = hash('sha256', $password);
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

    // Insert new user
    $req->closeCursor();
    $key_verif = md5(microtime(TRUE)*100000);

    $req  = $db->prepare( "INSERT INTO user ( email, password, key_verif, active ) VALUES ( :email, :password, :key_verif , :active )" );
    $req->execute( array(
      'email'     => $this->getEmail(),
      'password'  => $this->getPassword(),
      'key_verif' => $key_verif,
      'active'    => 0
    ));
    email($this->getEmail(), $test);

    // Close databse connection
    $db = null;

  }

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail() {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ));

    // Close database connection
    $db   = null;

    return $req->fetch();
  }
}

/***************************************
* ------- EMAIL USER TO CHECK HIS AUTHENTICITY -------
****************************************/

function email($to, $key) {

  $user_id = getIdByEmail($to);

  $recipient = $to;
  $subject = "Activate your account" ;
  $entete = "From: register@codflix.com" ;
   
  // Le lien d'activation est composé du login(log) et de la clé(cle)
  $content = "Welcome to Cod'Flix,
   
  To activate your account, please click on the link below or copy and paste into your web browser.
   
  http://localhost:8888/Cod-Flix/controller/validationController.php?log='".$user_id. "'&key='".$key."
   
   
  ----------------------
  This is an automatic email, please do not reply";
   
   
  mail($recipient, $subject, $content, $entete);
}


function check_password($password) {

  $error = '';

  if( strlen($password ) < 8 ) $error .="Password too short !</br>";

  if( strlen($password ) > 20 ) $error.= "Password too long !</br>";

  if( !preg_match("#[0-9]+#", $password ) ) $error.= "Password must include at least one number !</br>";

  if( !preg_match("#[a-z]+#", $password ) ) $error.= "Password must include at least one letter !</br>";

  if( !preg_match("#[A-Z]+#", $password ) ) $error.= "Password must include at least one CAPS !</br>" ;

  if( !preg_match("#\W+#", $password ) ) $error.="Password must include at least one symbol !";

  if ($error != '') {
    throw new Exception($error);
  }
  else {

      return true;
  }
}
function getIdByEmail($email){

  $pdo = init_db();

  $requete = $pdo->prepare('SELECT id FROM user WHERE email = ?');

  $requete->execute(array($email));
  $res = $requete->fetch();
  $db = null;

  return $res['id'];
 }
