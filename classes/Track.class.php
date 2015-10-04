<?php
require_once 'classes/DB.class.php';

/**
 *
 * @author Andrew
 *        
 */
class Track extends DB
{

    protected $pdo;
    protected $title;
    protected $value;
    protected $lastChange;
    protected $artist;
    /**
     */
    function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getConnection();
        $this->setValues();
    }
    
    private function setValues(){
        $sql = <<<SQL
      SELECT
            track.track_id,
            artist_display_name,
            album_title,
            track_name,
            track.current_value,
            track.last_change,
            rank
      FROM
            artist
      INNER JOIN
            album
            on album.artist_id = artist.artist_id
      INNER JOIN
            track
            on track.album_id = album.album_id
      INNER JOIN
            ranking
            on ranking.track_id = track.track_id
      ORDER BY
            rank desc
SQL;
        
    }

    public function getAll()
    {
        $rows = array();
        
        $sql = <<<SQL
      SELECT 
            track.track_id,
            artist_display_name,
            album_title,
            track_name,
            rank
      FROM
            artist
      INNER JOIN
            album
            on album.artist_id = artist.artist_id
      INNER JOIN
            track 
            on track.album_id = album.album_id
      INNER JOIN
            ranking
            on ranking.track_id = track.track_id
      ORDER BY
            rank desc
              
SQL;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
           $rows[] = $row;

        return $rows;
    }

    public function getCurrentValue(){
        return $this->value;
    }
    
    
}

