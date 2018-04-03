<?php
// granted.php
session_start();

if (isset($_SESSION["access_granted"]) && !$_SESSION["access_granted"] ||
	!isset($_SESSION["access_granted"])) {
	$_SESSION["status"] = "You need to log in first";
header("Location:index.php");
}

echo "ACCESS GRANTED";

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
					<li><a href="">About</a></li>
					<li><a href="">Contact</a></li>
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

				<form action="handler.php" method="POST" enctype="multipart/form-data">
					<div>Name: <input value="<?php echo isset($presets['name']) ? $presets['name'] : ''; ?>" placeholder="name here" type="text" id="name" name="name"></div>
					<div>Age: <input value="<?php echo isset($presets['age']) ? $presets['age'] : ''; ?>" placeholder="age here" ptype="text" id="age" name="age"></div>
					<div>Comment: <input value="<?php echo isset($presets['comment']) ? $presets['comment'] : ''; ?>" placeholder="comment here" ptype="text" id="comment" name="comment"></div>
					<div><input type="submit" value="Add Comment"></div>
				</form>
				<table>
					<?php
					echo "<tr><th>Name</th><th>Comment</th><th>Date</th><th></th></tr>";
					foreach ($comments as $comment) {
						print "<tr><td><img src='" . $comment['image_path'] . "'/></td>" .
						"<td>" . htmlspecialchars($comment['name']) . "</td>" .
						"<td>" . htmlspecialchars($comment['comment']) . "</td>" .
						"<td>" . $comment['date_entered'] . "</td><td><a href='delete_comment.php?id=". $comment['id'] . "'>delete</a></td></tr>";
					}
					?>
				</table>

				
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


