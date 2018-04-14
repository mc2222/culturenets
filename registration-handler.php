<?php
session_start();
// Extract all the variables from the $_POST superglobal array.
$email = $_POST['email'];
$password = $_POST['password'];
$password_match = $_POST['password_match'];
$errors = array();
if(!valid_length($email, 1, 50)) {
	$errors['email'] = "Email is required. Must be less than 50 characters.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors['email'] = "Must be a valid email address.";
}
if(!valid_length($password, 10, 128)) {
	$errors['password'] = "Please enter a password of at least length 10.";
} else if($password != $password_match) {
	$errors['password_match'] = "Passwords do not match.";
}


require_once "Dao.php";

  if (isset($_POST["Register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    try {
      $dao = new Dao();
      $dao->saveUser($email, $password);
    } catch (Exception $e) {
      var_dump($e);
      die;
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