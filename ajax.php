<?php
// ajax.php file
session_start();
require_once "Dao.php";

$dao = new Dao();
$comments = $dao->getComments();
?>

<html>
  <head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/ajax.js" type="text/javascript"></script>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <img src="moon.jpg" />
    <form id="form" method="POST"> <!-- notice that the form has no action -->
      <div class="pair">
        <label for="email">Enter your email:</label>
        <input type="text" id="email"
        <?php if (isset($_SESSION["email"])) {
          echo "value='{$_SESSION['email']}'";
        } ?>
        name="email"/>
      </div>
      <div class="pair">
        <label for="comment">Leave a comment:</label>
        <input type="text" id="comment"
        <?php if (isset($_SESSION["comment"])) {
          echo "value='{$_SESSION['comment']}'";
        } ?>
        name="comment"/>
      </div>
      <div class="pair">
        <label for="age">Enter your age:</label>
        <input type="text" id="age"
        <?php if (isset($_SESSION['age'])) {
          echo "value='{$_SESSION['age']}'";
        } ?>
        name="age"/>
      </div>
      <div class="pair">
        <label for="age"></label>
        <input id="submit" type="submit"/><small>(You must be 18 to post)</small>
      </div>
    </form>
    </div>

    <table id="comments">
    <?php
    foreach ($comments as $comment) {
      echo "<tr>";
      echo "<td>" . $comment["comment"] . "</td>";
      echo "<td>" . $comment["created"] . "</td>";
      echo "</tr>";
    }
    ?>
    </table>
  </body>
</html>