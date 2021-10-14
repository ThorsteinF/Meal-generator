<?php
session_start();

if (!isset($_SESSION["userid"])) {
  header("../dinnergenerator");
} else if (isset($_POST["submit"])) {
  include_once "scripts/connect.php";
  include_once "scripts/functions.php";

  $username = $_POST["username"];

  if (uidEmailExists($conn, $username, $username)) {
    header("location: changeusername?error=usernameexists");
    exit();
  } else if (invalidUid($username)) {
    header("location: changeusername?error=invalidusername");
    exit();
  } else if (emptyInputLogin($username, $username)) {
    header("location: changeusername?error=emptyinput");
    exit();
  }

  $sql = "UPDATE users SET username = '$username' WHERE userid = '$_SESSION[userid]';";
  mysqli_query($conn, $sql);

  $_SESSION["username"] = $username;
  header("location: profile");
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="No more mealprep! FREE dinner generator">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Change email</title>
</head>

<body>
  <header>
    <a href='../'><button>BACK</button></a>
    <a href="../dinnergenerator"><button>HOME</button></a>
    <?php
    if (isset($_SESSION["userid"])) {
      echo "<a href = 'savedmeals'><button>SAVED MEALS</button></a>";
      echo "<a href = 'profile'><button>PROFILE</button></a>";
      echo "<a href = 'logout'><button>LOG OUT</button></a>";
    } else {
      echo "<a href = 'login'><button>LOGIN</button></a>";
      echo "<a href = 'signup'><button>REGISTER</button></a>";
    }
    ?>
    <a href="privacypolicy"><button>PRIVACY POLICY</button></a>
  </header>
  <br>
  <br>
  <div id="main">
    <h1> CHANGE USERNAME </h1>
  </div>

  <div id="output">
    <form action="changeusername" method="POST">
      <input name="username" placeholder="Username">
      <button name="submit"> Submit </button>
    </form>
    <?php
    if (!isset($_GET["error"])) {
      null;
    } else if ($_GET["error"] == "emptyinput") {
      echo "<p class = 'error'> ERROR: Empty input </p>";
    } else if ($_GET["error"] == "invalidusername") {
      echo "<p class = 'error'> ERROR: Invalid username </p>";
    } else if ($_GET["error"] == "usernametoolong") {
      echo "<p class = 'error'> ERROR: Username too long (Max 32)</p>";
    } ?>
  </div>
</body>

</html>