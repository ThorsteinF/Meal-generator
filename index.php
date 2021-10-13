<?php
session_start();
if (isset($_POST["submit"])) {
  include_once "scripts/connect.php";
  mysqli_query($conn, "INSERT INTO meals (carbs, meat, vegetable, userid) VALUES ('$_POST[carbs]', '$_POST[meat]', '$_POST[vegetable]', '$_SESSION[userid]');");
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="No more mealprep! FREE dinner generator">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Dinner Generator</title>
</head>

<body>
  <header>
    <a href='../'><button>BACK</button></a>
    <a href="index.php"><button>HOME</button></a>
    <?php
    if (isset($_SESSION["userid"])) {
      echo "<a href = 'savedmeals.php'><button>SAVED MEALS</button></a>";
      echo "<a href = 'profile.php'><button>PROFILE</button></a>";
      if ($_SESSION["username"] == "admin") {
        echo "<a href = 'controlpanel.php'><button>CONTROL PANEL</button></a>";
      }
      echo "<a href = 'logout.php'><button>LOG OUT</button></a>";
    } else {
      echo "<a href = 'login.php'><button>LOGIN</button></a>";
      echo "<a href = 'signup.php'><button>REGISTER</button></a>";
    }
    ?>
    <a href="privacypolicy.php"><button>PRIVACY POLICY</button></a>
  </header>
  <br>
  <br>
  <div id="main">
    <p id="title"> DINNER GENERATOR </p>
    <img src="img/meal.jpg" style="box-shadow: 0px 0px 27px 13px rgba(0,0,0,0.53);">
  </div>
  <h2 style="margin-top: 25px; margin-bottom: 25px;"> Click GENERATE to generate a meal</h2>
  <div id="output">
    <form action="index.php" method="POST">
      <button type="button" id="generate" style="margin-right: 10px"> Generate </button>
      <?php
      if (!isset($_SESSION["userid"])) {
        echo "<button style = 'border: 3px solid gray;' disabled> Sign in to save recipe </button>";
      } else {
        echo "<button name = 'submit' id = 'add' style = 'border: 3px solid gray;' disabled> Save this recipe </button>";
      } ?>

      <input name="carbs" id="carbs" style="display: none;">
      <input name="meat" id="meat" style="display: none;">
      <input name="vegetable" id="vegetable" style="display: none;">
    </form>
    <script src="scripts/script.js"></script>
  </div>
  <p id="c"> Copyright © 2021 <a href="https://www.thorsteinsoftware.com/"> thorsteinsoftware.com </a> All right reserved</p>
</body>

</html>