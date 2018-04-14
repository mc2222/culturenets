<!DOCTYPE html>

<?php
// login.php
session_start();

if (isset($_SESSION["access_granted"]) && $_SESSION["access_granted"]) {
	header("Location:granted.php");
}

$email = "";
if (isset($_SESSION["email_preset"])) {
	$email = $_SESSION["email_preset"];
}
?>


<html>

<head>
	<title>CultureNETS</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
</head>



<body>
	<div id="container">
		<div id="header">
			<h1>
				CultureNETS
			</h1>


			<img src="image.jpg" width="200" alt="Logo"/>

			<span class="blue">CultureNETS</span> is a fun website.
			
		</div>
		<div id="content">
			<div id="navigation">
				<ul>
					<li><a class="selected" href="">Home</a></li>
					<li><a href="">About</a></li>
					<li><a href="">Contact</a></li>
				</ul>
			</div>

			<div id="main">
				<h3>Login to my Secret System</h3>
				<?php
				if (isset($_SESSION["status"])) {
					echo "<div id='status'>" .  $_SESSION["status"] . "</div>";
					unset($_SESSION["status"]);
				}
				?>
				<form action="login_handler.php" method="POST">
					<div>
						<label for="email">Email</label>
						<input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
					</div>
					<div>
						<label for="password">Password</label>
						<input type="password" name="password" id="password" value=""/>
					</div>
					<div>
						<input type="submit" name="submit" id="login" value="Login"/>
					</div>
				</form>
				<a href="http://google.com">Google link to get started</a>
				<p>This is a paragraph.</p>
				<form action="process.php" method="post">
					Enter your name: <input name="name" type="text">
					<input type="submit">
				</form>
			</div>

		</div>

		
		<div id= "footer">
			<hr />
			<footer>
				<p>Copyright &copy; 2018 Culture Nets Inc. All Rights Reserved</p>
				<p>Contact information: <a href="mailto:maxwellchambers@u.boisestate.edu">
				email</a>.</p>
			</footer>
			<hr />
		</div>
		
	</div>
</body>


// // For simplification Lets pretend I got these login credentials from an SQL table.
if ("c@gmail.com" == $_POST["email"] &&
    "lol" == $_POST["password"]) {


} else {
  $status = "Invalid username or password";
  $_SESSION["status"] = $status;
  $_SESSION["email_preset"] = $_POST["email"];
  $_SESSION["access_granted"] = false;

  header("Location:index.php");
}

</html>