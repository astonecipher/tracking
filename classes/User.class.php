<?php
require_once 'classes/DB.class.php';

class User extends DB
{

    protected $pdo;
    protected $isAdmin = false;
    
    /**
     */
    function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getConnection();
    }

    function login( $user, $pass){
        
        $sql = <<<SQL
        SELECT
          count(*), 
          role
        FROM
          user
        WHERE
            username = :username
          AND
            :password = :password
SQL;

        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute( array(
                ':username' => $user,
                ':password' => hash('whirlpool', $pass),
        ));
        
        $row = $stmt->fetch();
        
        if ( $row['role'] == 1 )
            $this->isAdmin == true;
          
        if( $stmt->rowCount == 1) {
            return true;
        }
        
    }
    
    public function isAdmin(){
        return $this->isAdmin;
    }
    
    public function insertNewUser( $user, $pass, $role = 0){

        $sql = <<<SQL
        INSERT INTO
          user
        ( username, password, role)
            VALUES
        ( :username, :password, :role );
SQL;
        
        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute( array(
          ':username' => $user,
          ':password' => hash('whirlpool', $pass),
          ':role'     => $role,
        ));
        
        if ( $stmt->rowCount == 1)
            return true;
        else 
            return false;
        
        
    }
    
}