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

function main( $tbody, $artist ){

    include './views/main.php';
}

switch ( $action ){
    
    
    default:
        
        $artist = $artists->getAllArtist();
//         echo "<pre>";
//         print_r( $artist );
//         echo "</pre>";
        $tbody =  $tracks->getAll();
        main( $tbody, $artist );
    
}





