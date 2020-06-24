<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $type ) {
    $this->type = $type;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  /***************************
  * -------- GET LIST --------
  ***************************/

  public static function filterMedias( $title ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE title LIKE ? ORDER BY release_date DESC" );
    $req->execute( array( '%' . $title . '%' ));

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }
  public static function getMedia() {

    // Open database connection
    $db   = init_db();

    $req  = $db->query( "SELECT * FROM media");
    $req->execute();

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }

}

/***********************************
* -------- GET MEDIA BY ID --------
***********************************/

function getMediaById($id){

  $pdo = init_db();
  $requete = $pdo->prepare('SELECT * FROM media WHERE id = ?');

  $requete->execute(array($id));
  $res = $requete->fetch();
  $db = null;

  return $res;
}
/********************************
* -------- COMPARE DATE --------
********************************/
function available($release){
  $date_now = date('Y-m-d');
  return ($date_now >= $release) ? true : false;
}
/**********************************************************
* -------- KNOW IF THE MEDIA IS A FILM OR A SERIES --------
***********************************************************/
function typeOfMedia($id){
  $pdo = init_db();
  $requete = $pdo->prepare('SELECT type FROM media WHERE id = ?');

  $requete->execute(array($id));
  $res = $requete->fetch();
  $db = null;

  return $res['type'];
}

/*******************************************************
* -------- GET SEASONS AND PICTURE OF A SERIES --------
********************************************************/
function getSeasons($id){
  $pdo = init_db();
  $requete = $pdo->prepare('SELECT * FROM season WHERE media_id = ?');

  $requete->execute(array($id));
  $res = $requete->fetchAll();
  $db = null;

  return $res;
}

/*******************************************************
* -------- GET EPISODES DETAILS OF A SEASON  --------
********************************************************/
function getEpisodes($id){
  $pdo = init_db();
  $requete = $pdo->prepare('SELECT * FROM episodes WHERE season_id = ?');

  $requete->execute(array($id));
  $res = $requete->fetchAll();
  $db = null;

  return $res;
}
/*******************************************************
* -------- GET SEASONS TITLE --------
********************************************************/
function getSeasonTitle($id){
  $pdo = init_db();
  $requete = $pdo->prepare('SELECT title, media_id FROM season WHERE id = ?');
  $requete->execute(array($id));
  $res = $requete->fetch();
  $db = null;

  return $res;
}

/*******************************************************
* -------- GET YOUTUBE URL OF THE EPISODE --------
********************************************************/
function getVideo($id){
  $pdo = init_db();
  $requete = $pdo->prepare('SELECT url FROM episodes WHERE id = ?');
  $requete->execute(array($id));
  $res = $requete->fetch();
  $db = null;

  return $res['url'];
}

/*******************************************************
* ----------------- GET USER HISTORY -------------------
********************************************************/
function getHistoryFilm($id_user){

  $pdo = init_db();
  $requete = $pdo->prepare('SELECT * FROM history WHERE user_id = ? AND media_id IS NOT NULL');
  $requete->execute(array($id_user));
  $res = $requete->fetchAll();
  $db = null;

  return $res;

}
function getHistorySeries($id_user){

  $pdo = init_db();
  $requete = $pdo->prepare('SELECT * FROM history WHERE user_id = ? AND episode_id IS NOT NULL');
  $requete->execute(array($id_user));
  $res = $requete->fetchAll();
  $db = null;

  return $res;

}

/***************************************************************************************
* ----------------- INSERT OR UPDATE DATA HISTORY INTO HISTORY TABLE FOR FILMS-------------------
****************************************************************************************/
function insertOrUpdateIntoHistory($user_id, $media_id){
  $update;
  $pdo = init_db();

  $req  = $pdo->prepare( "SELECT id FROM history WHERE user_id = :user AND media_id = :media" );
  $req->execute( array(
    'user' => $user_id,
    'media'=> $media_id
  ));
  if ( $req->rowCount() > 0 ) {
    $update = true;
    $res = $req->fetch();
    $res_id = $res['id'];
  }
  else {
    $update = false;
  }
  $req->closeCursor();


  if ($update == true) {
    $requete = $pdo->prepare("UPDATE history SET start_date = :start WHERE id = :id");
    $requete->execute( array(
      'start'=> date("Y-m-d H:i:s"),
      'id' => $res_id
    ));
  }
  else {
    $requete = $pdo->prepare("INSERT INTO history (user_id, media_id, start_date)VALUES (:id, :media, :start)");
    $requete->execute( array(
      'id'     => $user_id,
      'media'  => $media_id,
      'start' => date("Y-m-d H:i:s")
    ));
  }


  $db = null;
  
}
/***************************************************************************************
* ----------------- INSERT OR UPDATE DATA HISTORY INTO HISTORY TABLE FOR SERIES --------
****************************************************************************************/
function insertOrUpdateEpisodeIntoHistory($user_id, $episode_id){
  $update;
  $pdo = init_db();

  $req  = $pdo->prepare( "SELECT id FROM history WHERE user_id = :user AND episode_id = :id" );
  $req->execute( array(
    'user' => $user_id,
    'id'=> $episode_id
  ));
  if ( $req->rowCount() > 0 ) {
    $update = true;
    $res = $req->fetch();
    $res_id = $res['id'];
  }
  else {
    $update = false;
  }
  $req->closeCursor();


  if ($update == true) {
    $requete = $pdo->prepare("UPDATE history SET start_date = :start WHERE id = :id");
    $requete->execute( array(
      'start'=> date("Y-m-d H:i:s"),
      'id' => $res_id
    ));
  }
  else {
    $requete = $pdo->prepare("INSERT INTO history (user_id, episode_id, start_date)VALUES (:id, :episode, :start)");
    $requete->execute( array(
      'id'     => $user_id,
      'episode'  => $episode_id,
      'start' => date("Y-m-d H:i:s")
    ));
  }


  $db = null;

}





/**********************************************************************
* ----------------- DELETE 1 ROW IN  HISTORY TABLE -------------------
**********************************************************************/
function deleteRow($idRow){
  $pdo = init_db();

  $requete = $pdo->prepare('DELETE FROM history WHERE id = ?');
  $requete->execute(array($idRow));

  $db = null;

  header('Location: http://localhost:8888/Cod-Flix/index.php?action=history');

}
/**********************************************************
* ----------------- DELETE ALL HISTORY -------------------
***********************************************************/
function deleteHistory($idUser){
  $pdo = init_db();

  $requete = $pdo->prepare('DELETE FROM history WHERE user_id = ?');
  $requete->execute(array($idUser));

  $db = null;

  header('Location: http://localhost:8888/Cod-Flix/index.php?action=history');

}



