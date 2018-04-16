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


protected $logger = logger;


  public function createTable() {
    try{
      $this->logger->logDebug("Estabilished a database connection.");
      $conn = new PDO('mysql:host=us-cdbr-iron-east-05.cleardb.net;dbname=heroku_ceaf9c277c17d34', 'b310f1aa2e3c93', '632792fc');
      echo "connected";
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql_user = 
      "CREATE TABLE IF NOT EXISTS 'user' (
      `email` VARCHAR(200) PRIMARY KEY NOT NULL,
      `password` VARCHAR(64),
      `access` INT(1),
      `ts` CURRENT_TIMESTAMP,
      `fullname` VARCHAR(250) );";
      }
      catch(PDOException $e){
        echo "connection failed" . $e->getMessage();

      }
}

public function getConnection() {
  return
  new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
  $this->pass);
} 
public function saveUser($email, $password, $fullName) {
 $conn = $this->getConnection();
 $query = $conn->prepare("INSERT INTO user (email, password, fullName) VALUES (:email, :password, :fullName)");
 $query->bindParam(':email', $email);
 $query->bindParam(':password', $password);
 $query->bindParam(':fullName', $fullName);
  //$this->logger->logDebug(__FUNCTION__ . " email=[{$email}] password=[{$password}]");
 $query->execute();
}

public function getUser() {
 $conn = $this->getConnection();
 $query = $conn->prepare("select * from user");
 $query->setFetchMode(PDO::FETCH_ASSOC);
 $query->execute();
 $results = $query->fetchAll();
// $this->logger->logDebug(__FUNCTION__ . " " . print_r($results,1));
 return $results;
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
// $this->logger->logDebug(__FUNCTION__ . " " . print_r($results,1));
 return $results;
}

public function saveComment($name, $comment) {
 $conn = $this->getConnection();
 $query = $conn->prepare("INSERT INTO comment (name, comment) VALUES (:name, :comment)");
 $query->bindParam(':name', $name);
 $query->bindParam(':comment', $comment);
// $this->logger->logDebug(__FUNCTION__ . " name=[{$name}] comment=[{$comment}]");
 $query->execute();
}

public function deleteComment($id) {
 $conn = $this->getConnection();
 $query = $conn->prepare("DELETE FROM comments WHERE id = :id");
 $query->bindParam(':id', $id);
 $query->execute();
}





} // end Dao