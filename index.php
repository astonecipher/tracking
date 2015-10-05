<?php
session_start ();

if ( isset( $_SESSION['username']))
 $isAdmin = 1;
function __autoload($classname) {
 if (file_exists ( "./classes/$classname.class.php" )) {
  require "./classes/$classname.class.php";
 } else {
  echo "Error: Could not find Class.";
 }
}

$user = new User ();
$tracks = new Track ();
$artists = new Artist ();
$albums = new Album ();

$artist = $artists->getAllArtist ();
$tbody = $tracks->getAll ();

if ($_REQUEST ['action'] == 'logout') {
 unset ( $_SESSION ['username'] );
 unset ( $user );
 unset ( $_REQUEST ['action'] );
}

$action = isset ( $_REQUEST ['action'] ) ? trim ( strtolower ( $_REQUEST ['action'] ) ) : '';
if ($action == 'login') {
 $isAdmin = $user->login ( $_POST ['user'], $_POST ['pass'] );
 if ($isAdmin != 0) {
  $_SESSION ['username'] = $user->getUsername ();
 }
}

if (! isset ( $_REQUEST ['action'] ) || $action == 'login') {
 
 include './views/header.html';
}

switch ($action) {
 
 case 'login_screen' :
  include './views/login.html';
  break;
 case 'login_in' :
  main ( $tbody, $artist, $isAdmin );
  break;
 case 'logout' :
  session_destroy ();
  break;
 case 'add_artist' :
  if (isset ( $_GET ['name'] ) && isset ( $_GET ['display_name'] ))
   echo "Received new Artist {$_GET['name']} and {$_GET['display_name']}.";
  elseif (isset ( $_GET ['artist'] ))
   echo "Using Artist, {$_GET['artist']}.";
  break;
 case 'increase_pop' :
//   echo "Increase popularity triggered.\nWorking on it.";
  $tracks->increasePopularity( $_GET['track_id'] );
  main ( $tbody, $artist, $isAdmin );
  break;
 case 'decrease_pop' :
  //echo "Decrease popularity triggered.\nWorking on it.";
  $tracks->decreasePopularity( $_GET['track_id'] );
  main ( $tbody, $artist, $isAdmin );
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
  main ( $tbody, $artist );
}
function main($tbody, $artist, $isAdmin = 0) {
 include './views/main.php';
}


