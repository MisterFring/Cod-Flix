<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

	$search = isset( $_GET['title'] ) ? $_GET['title'] : null;

	if (isset($_GET['title'])) {
		$search = $_GET['title'];
		$medias = Media::filterMedias( $search );
	}
	else {
		//appeler tous les medias
		$medias = Media::getMedia();
	}
	require('view/mediaListView.php');
	

}


function mediaSheet(){
	$type = typeOfMedia($_GET['media']);
	if ($type == 'series') {
		require('view/mediaListView.php');
	}
	else {
		require("view/mediaSheetView.php");
	}
}
