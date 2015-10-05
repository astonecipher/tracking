<?php

abstract class DB extends \PDO
{

    protected $pdo = null;
    
    public function __construct()
    {
        if ( $_SERVER['DOCUMENT_ROOT'] != '/home/stoneci2/public_html/tracks') {
        $this->pdo = new PDO('mysql:host=localhost; dbname=track_me', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } else {
            $this->pdo = new PDO('mysql:host=localhost; dbname=stoneci2_tracks', 'stoneci2_tracks', '_P@55word');
        }
        
    }
    
    public function getConnection(){
          return $this->pdo;
    }
    
}
