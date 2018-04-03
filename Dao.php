<?php
// Dao.php
// class for saving and getting comments from MySQL
class Dao {


  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_ceaf9c277c17d34";
  private $user = "b310f1aa2e3c93";
  private $pass = "632792fc";

  public function getConnection () {
    return
    new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
      $this->pass);
  }

  public function getComments () {
   $conn = $this->getConnection();
   $query = $conn->prepare("select * from comment");
   $query->setFetchMode(PDO::FETCH_ASSOC);
   $query->execute();
   $results = $query->fetchAll();
   $this->logger->logDebug(__FUNCTION__ . " " . print_r($results,1));
   return $results;
 }

 public function saveComment ($name, $comment) {
   $conn = $this->getConnection();
   $query = $conn->prepare("INSERT INTO comment (name, comment) VALUES (:name, :comment)");
   $query->bindParam(':name', $name);
   $query->bindParam(':comment', $comment);
   $this->logger->logDebug(__FUNCTION__ . " name=[{$name}] comment=[{$comment}]");
   $query->execute();
 }

 public function deleteComment ($id) {
   $conn = $this->getConnection();
   $query = $conn->prepare("DELETE FROM comments WHERE id = :id");
   $query->bindParam(':id', $id);
   $query->execute();
 }


} // end Dao