<?php
// granted.php
session_start();
require_once "Dao.php";
$dao = new Dao();
$comments = $dao->getComments();

if (isset($_SESSION["access_granted"]) && !$_SESSION["access_granted"] ||
	!isset($_SESSION["access_granted"])) {
	$_SESSION["status"] = "You need to log in first";
header("Location:index.php");
}

echo "ACCESS GRANTED";

?>

<html>

<head>
	<title>CultureNETS</title>
	<link rel="stylesheet" type="text/css" href="style2.css" />
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
					<li><a href="index.php">Home</a></li>
					<li><a class="selected" href="ajaxexample.html">Location Finder</a></li>
					<li><a href="registration.php">Registration</a></li>
				</ul>
			</div>

			<div id="main">
				<a href="logout.php">Logout</a>

				<?php
				if (isset($_SESSION["status"])) {
					echo "<div id='status'>" .  $_SESSION["status"] . "</div>";
					unset($_SESSION["status"]);
				}
				?>


				<form name="commentForm" action="handler.php" method="POST">
      <div>
        Leave a comment: <input type="text" name="comment">
      </div>
      <div>
        <input type="submit" name="commentButton" value="Submit">
      </div>
      <input type="hidden" name="form" value="comment">
    </form>
    <?php
    $comments = $dao->getComments();
    echo "<table>";
    foreach ($comments as $comment) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($comment["comment"]) . "</td>";
      echo "<td>" . htmlspecialchars($comment["created"]) . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    ?>

				

				
			</div>

		</div>
		
		<div id= "footer">
			<hr />
			<footer>
				<p>Copyright &copy; 2018 Culture Nets Inc. All Rights Reserved</p>
				<p>Contact by  <a href="mailto:maxwellchambers@u.boisestate.edu">
				Email</a>.</p>
			</footer>
			<hr />
		</div>
		
	</div>

</body>

</html>


