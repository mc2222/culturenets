<?php
session_start();

require_once "Dao.php";
// Extract all the variables from the $_POST superglobal array.
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_match = $_POST['password_match'];
$errors = array();
$valid = true;
$message = array();
if(!valid_length($fullName, 1, 50)) {
	$errors['fullName'] = "Full name is required. Must be less than 50 characters.";
	$valid = false;
}
if(!valid_length($email, 1, 50)) {
	$errors['email'] = "Email is required. Must be less than 50 characters.";
	$valid = false;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors['email'] = "Must be a valid email address.";
	$valid = false;
}
if(!valid_length($password, 10, 128)) {
	$errors['password'] = "Please enter a password of at least length 10.";
	$valid = false;
} else if($password != $password_match) {
	$errors['password_match'] = "Passwords do not match.";
	$valid = false;
}
 

  if ($valid == true) {
    try {
      $dao = new Dao();
      $dao->saveUser($email, $password, $fullName);
      $_SESSION['access'] = 1;
    
    } catch (Exception $e) {
      var_dump($e);
      echo "didnt work";
      exit;
     // die;
    }

   }

function valid_length($field, $min, $max) {
	$trimmed = trim($field);
	return (strlen($trimmed) >= $min && strlen($trimmed) <= $max);
}
// if all valid, then redirect the user to the welcome page.
if(empty($errors)) {
	$_SESSION['user'] = htmlspecialchars($fullName);
	header('Location: granted.php');
} else {
	$_SESSION['errors'] = $errors;
	$_SESSION['presets'] = array('fullName' => htmlspecialchars($fullName),
					'email' => htmlspecialchars($email));
	header('Location: registration.php');
}
?>