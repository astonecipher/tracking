<?php
session_start ();
function __autoload($classname) {
 if (file_exists ( "./classes/$classname.class.php" )) {
  require "./classes/$classname.class.php";
 } else {
  echo "Error: Could not find Class.";
 }
}

$action = isset ( $_REQUEST['action'] ) ? trim ( strtolower ( $_REQUEST['action'] ) ) : '';
$user = new User ();
$tracks = new Track ();
$artists = new Artist ();
$albums = new Album ();

switch ($action) {
 
 case 'login_screen' :
  include './views/login.html';
  break;
 case 'login_details' :
  echo "working on it.";
  break;
 case 'add_artist' :
  if (isset ( $_GET ['name'] ) && isset ( $_GET ['display_name'] ))
   echo "Received new Artist {$_GET['name']} and {$_GET['display_name']}.";
  elseif (isset ( $_GET ['artist'] ))
   echo "Using Artist, {$_GET['artist']}.";
  break;
 case 'get_albums' :
  $obj = array ();
  if (isset ( $_GET ['artist_id'] ))
   $album = $albums->getAlbumsByArtistId ( $_GET ['artist_id'] );
  foreach ( $album as $key => $val ) {
   $obj ['title'] = $val ['album_title'];
   $obj ['id'] = $val ['album_id'];
  }
  echo json_encode ( $obj );
  break;
 default :
  $artist = $artists->getAllArtist ();
  $tbody = $tracks->getAll ();
  main ( $tbody, $artist );
}

function main($tbody, $artist) {
 include './views/main.php';
}


