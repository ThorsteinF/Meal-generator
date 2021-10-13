<?php
session_start();

if (!isset($_SESSION["userid"])) {
  header("index.php");
} else if (isset($_POST["submit"])) {
  include_once "scripts/connect.php";
  include_once "scripts/functions.php";

  $username = $_POST["username"];

  if (uidEmailExists($conn, $username, $username)) {
    header("location: changeusername.php?error=usernameexists");
    exit();
  } else if (invalidUid($username)) {
    header("location: changeusername.php?error=invalidusername");
    exit();
  } else if (emptyInputLogin($username, $username)) {
    header("location: changeusername.php?error=emptyinput");
    exit();
  }

  $sql = "UPDATE users SET username = '$username' WHERE userid = '$_SESSION[userid]';";
  mysqli_query($conn, $sql);

  $_SESSION["username"] = $username;
  header("location: profile.php");
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
    <h1> CHANGE USERNAME </h1>
  </div>

  <div id="output">
    <form action="changeusername.php" method="POST">
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