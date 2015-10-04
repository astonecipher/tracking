<?php
require_once 'classes/DB.class.php';

class Album extends DB
{

    protected $pdo;

    /**
     */
    function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getConnection();
    }

    public function getAlbumsByArtistId($artist_id)
    {
        $rows = array();
        
        if (! filter_var($artist_id, FILTER_VALIDATE_INT))
            throw new Exception('Artist not found.');
        
        $sql = "SELECT * FROM album WHERE artist_id = :artist_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            ':artist_id' => $artist_id
        ));
        
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                array_push( $rows, $row);

        return $rows;
    }
}

?>