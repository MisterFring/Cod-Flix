<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

	$search = isset( $_GET['titl'] ) ? $_GET['titl'] : null;
	$medias = Media::filterMedias( $search );
	//appeler tous les medias
	$medias = Media::getMedia();
	require('view/mediaListView.php');

}


function mediaSheet(){
	require("view/mediaSheetView.php");
}
