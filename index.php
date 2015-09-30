<?php

function __autoload( $classname ) {
    if ( file_exists( "./classes/$classname.class.php" )){
        require "./classes/$classname.class.php";
    } else {
        echo "Error: Could not find Class.";
    }
}


$action = isset ( $_GET['action'] ) ? trim( strtolower( $_GET['action'] ) ) : '';
$tracks = new Track();
$artists = new Artist();

// function validate( $_GET ){
//     if ( isset( $_GET['artist']))
// }

function main( $tbody, $artist ){

    include './views/main.php';
}

switch ( $action ){
    
    case 'add_artist':
        if ( isset( $_GET['name'] ) && isset( $_GET['display_name'] ) )
            echo "Received new Artist {$_GET['name']} and {$_GET['display_name']}.";
        elseif ( isset( $_GET['artist'])) 
            echo "Using Artist, {$_GET['artist']}.";
      break;
    default:
        
        $artist = $artists->getAllArtist();
//         echo "<pre>";
//         print_r( $artist );
//         echo "</pre>";
        $tbody =  $tracks->getAll();
        main( $tbody, $artist );
    
}




