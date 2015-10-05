<?php
require_once 'classes/DB.class.php';

/**
 *
 * @author Andrew
 */
class Track extends DB {
 protected $pdo;
 protected $title;
 protected $value;
 protected $lastChange;
 protected $artist;
 const POPULARITY_INTERVAL = 0.0025;
 
 /**
  */
 function __construct() {
  parent::__construct ();
  $this->pdo = parent::getConnection ();
  $this->setValues ();
 }
 private function setValues() {
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
 public function getAll() {
  $rows = array ();
  
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
  $stmt = $this->pdo->prepare ( $sql );
  $stmt->execute ();
  
  while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) )
   $rows [] = $row;
  
  return $rows;
 }
 public function getCurrentValue() {
  return $this->value;
 }
 public function increasePopularity($id) {
  if (! filter_var ( $id, FILTER_VALIDATE_INT ))
   throw new Exception ( 'ID is not valid.' );
  
  $sql = <<<SQL
      UPDATE
        ranking
      SET
        ranking.rank = (rank + POPULARITY_INTERVAL),
        ranking.rank_direction = 'up'
      WHERE track_id = :id
SQL;
  
  $stmt = $this->pdo->prepare ( $sql );
  $stmt->execute ( array (
    ':id' => $id 
  ) );
 }
 public function decreasePopularity($id) {
  if (! filter_var ( $id, FILTER_VALIDATE_INT ))
   throw new Exception ( 'ID is not valid.' );
  
  if ($this->checkRankValueLessThanOne ( $id )) {
   $sql = <<<SQL
      UPDATE
        ranking
      SET
        ranking.rank = (rank - POPULARITY_INTERVAL),
        ranking.rank_direction = 'down'  
      WHERE track_id = :id
SQL;
   
   $stmt = $this->pdo->prepare ( $sql );
   $stmt->execute ( array (
     ':id' => $id 
   ) );
  } else {
   $this->increasePopularity ( $id );
  }
 }
 private function checkRankValueLessThanOne($id) {
  $sql = <<<SQL
        SELECT rank FROM ranking WHERE track_id = :id
SQL;
  $stmt = $this->pdo->prepare ( $sql );
  $stmt->execute ( array (
    ':id' => $id 
  ) );
  $rank = $stmt->fetch ();
  if ($rank [0] + 0.0025 <= 1)
   return true;
  else
   return false;
 }
 public function updateTrackByID($id, $value) {
  if (! filter_var ( $id, FILTER_VALIDATE_INT ))
   throw new Exception ( "ID Not Found." );
  if (! filter_var ( $value, FILTER_VALIDATE_INT ))
   throw new Exception ( "Value not valid." );
  $sql = <<<SQL
      UPDATE
        ranking
      SET
        ranking.rank = :value,
      WHERE track_id = :id
SQL;
  
  $stmt = $this->pdo->prepare ( $sql );
  $stmt->execute ( array (
    ':id' => $id,
    ':value' => $value 
  ) );
 }
 private function calculateDifference() {
  // $now = new DateTime ();
  // $now->fomat ( 'Y-m-d H:i:s' );
  
  // $sql = <<<SQL
  // SELECT
  // ranking_id,
  // rank,
  // rank_direction,
  // last_updated
  // FROM
  // ranking
  // SQL;
  
  // $this->pdo - prepare ( $sql );
  // $stmt = $this->pdo->execute ();
  
  // while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
  // // TODO:
  // // find the difference between the timestamp and cur_time in hours
  // // then take the difference in hours and multiply or divide the current
  // // ranking based on whether the rank direction is up or down.
  // $current_date = new DateTime ();
  // $current_date->format ( 'Y-m-d h:i:s' );
  
  // $interval = date_diff ( $row ['last_updated'], $current_date );
  // if ($interval->format ( '%h' ) != 0 ){
  // $this->checkValueofPopularity( $row['rank_direction'], $interval->format ( '%h' ), $row['rank'] );
  // $this->updateTrackByID($row['ranking_id'], ) ;
  // }
  // }
 }
 function checkValueofPopulatrity($upORdown, $hourDiff, $currentPopularity) {
  if ($upORdown == 'up') {
   if ($currentPopularity * POPULARITY_INTERVAL >= 1)
    return 1;
  } else {
   if ($currentPopularity / POPULARITY_INTERVAL <= - 1)
    return - 1;
  }
 }
}
  

