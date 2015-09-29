<?php
require_once 'classes/DB.class.php';

/**
 *
 * @author Andrew
 *        
 */
class Artist extends DB
{

    protected $pdo;

    /**
     */
    function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getConnection();
    }

    public function getAllArtist()
    {
        $rows = array();
        
        $sql = <<<SQL
      SELECT
            artist_id,
            artist_display_name            
      FROM
        artist;
SQL;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
           $rows[] = $row;

        return $rows;
    }
}

