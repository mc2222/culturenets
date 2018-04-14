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

require_once "Dao.php";
$dao = new Dao();
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
					<li><a href="registration.php">Registration</a></li>

					<a href="http://google.com">Google link to get started</a>
					<li><a href="">Contact</a></li>
				</ul>
			</div>

			<div id="main">

				<p> Leave your review of Boise State.
				 </p>

				<?php
				if (isset($_SESSION["status"])) {
					echo "<div id='status'>" .  $_SESSION["status"] . "</div>";
					unset($_SESSION["status"]);
				}

				// echo "Hello";
				// echo $conn = getConnection();
				// echo "Goodbye";
				//echo "Table exists:" ;//. //tableExists ($conn, 'user');
				?>




				<form action="login_handler.php" method="POST">
					<div>
						<label for="email">Email</label>
						<input type="text" name="email" placeholder="email here" id="email" value="<?php echo $email; ?>"/>
					</div>
					<div>
						<label for="password">Password</label>
						<input type="password" name="password" placeholder="password here" id="password" value=""/>
					</div>
					<div>
						<input type="submit" name="submit" id="login" value="Login"/>
					</div>
				</form>


			</div>

		</div>

		
		<div id= "footer">
			<hr />
			<footer>
				<p>Copyright &copy; 2018 Culture Nets Inc. All Rights Reserved</p>
				<p>Contact by  <a href="mailto:maxwellchambers@u.boisestate.edu">
				email</a>.</p>
			</footer>
			<hr />
		</div>
		
	</div>
</body>




</html>



