<?php
// login_handler.php
session_start();


// set values pass from form in index.php

$email = $_POST['email'];
$password = $_POST['password'];

// For simplification Lets pretend I got these login credentials from an SQL table.



// if ("c@gmail.com" == $_POST["email"] &&
//     "lol" == $_POST["password"]) 

    try{
   $conn = new PDO('mysql:host=us-cdbr-iron-east-05.cleardb.net;dbname=heroku_ceaf9c277c17d34', 'b310f1aa2e3c93', '632792fc');
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e) {
  echo "didnt connect";
exit ($e->getMessage());
}


$query = $conn->prepare("SELECT password FROM user WHERE email=?");
$query->execute(array($_POST['email']));

if ($query->fetchColumn() === $_POST['password'] && $valid){ 
	$_SESSION["access_granted"] = true;  
	header("Location:granted.php");

} else {
  $status = "Invalid username or password";
  $_SESSION["status"] = $status;
  $_SESSION["email_preset"] = $_POST["email"];
  $_SESSION["access_granted"] = false;

  header("Location:index.php");
}

?>