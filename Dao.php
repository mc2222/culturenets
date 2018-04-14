<?php
// Dao.php
// class for saving and getting comments from MySQL
class Dao {


  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_ceaf9c277c17d34";
  private $user = "b310f1aa2e3c93";
  private $pass = "632792fc";



//   public function getConnection () {
//     try{
//     $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
//       $this->pass);
//     $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }catch (PDOException $e) {
//   echo "didnt connect";
// exit ($e->getMessage());
// }
//   }

  public function getConnection() {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
          $this->pass);
  } 



  function tableExists($pdo, $table) {

    // Try a select statement against the table
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
    try {
        $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
    } catch (Exception $e) {
        // We got an exception == table not found
        return FALSE;
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== FALSE;
}

  public function getComments() {
   $conn = $this->getConnection();
   $query = $conn->prepare("select * from comment");
   $query->setFetchMode(PDO::FETCH_ASSOC);
   $query->execute();
   $results = $query->fetchAll();
   $this->logger->logDebug(__FUNCTION__ . " " . print_r($results,1));
   return $results;
 }

 public function saveComment($name, $comment) {
   $conn = $this->getConnection();
   $query = $conn->prepare("INSERT INTO comment (name, comment) VALUES (:name, :comment)");
   $query->bindParam(':name', $name);
   $query->bindParam(':comment', $comment);
   $this->logger->logDebug(__FUNCTION__ . " name=[{$name}] comment=[{$comment}]");
   $query->execute();
 }

 public function deleteComment($id) {
   $conn = $this->getConnection();
   $query = $conn->prepare("DELETE FROM comments WHERE id = :id");
   $query->bindParam(':id', $id);
   $query->execute();
 }

 public function saveUser($email, $password) {
   $conn = $this->getConnection();
   $query = $conn->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");
   $query->bindParam(':email', $email);
   $query->bindParam(':password', $password);
   $this->logger->logDebug(__FUNCTION__ . " email=[{$email}] password=[{$password}]");
   $query->execute();
 }

  public function getUser() {
   $conn = $this->getConnection();
   $query = $conn->prepare("select * from user");
   $query->setFetchMode(PDO::FETCH_ASSOC);
   $query->execute();
   $results = $query->fetchAll();
   $this->logger->logDebug(__FUNCTION__ . " " . print_r($results,1));
   return $results;
 }



} // end Dao