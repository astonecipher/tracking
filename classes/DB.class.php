<?php

abstract class DB extends \PDO
{

    protected $pdo = null;
    
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost; dbname=track_me', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
    }
    
    public function getConnection(){
//         if ( $this->pdo != null )
          return $this->pdo;
    }
    
 
    
}
