<?php
session_start();

if (!empty($_SESSION["username"])) {
  header("location: ../dinnergenerator");
};

if (isset($_POST["submit"])) {
  include_once "scripts/connect.php";
  include_once "scripts/functions.php";

  $username = $_POST["username"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];

  loginUser($conn, $username, $pwd);
  header("location: ../dinnergenerator");
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="Log into the dinner database">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Dinner generator - login</title>
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
    <form action="login" method="POST">
      <h1> Log in </h1>
      <input type="text" name="username" placeholder="Username/Email" id="inputUid">
      <br>
      <input type="password" name="pwd" placeholder="Password" id="inputPwd">
      <br>
      <button type="submit" name="submit"> Submit </button>
    </form>
  </div>
  <?php
  if (!isset($_GET["error"])) {
    null;
  } else if ($_GET["error"] == "emptyinput") {
    echo "<p class = 'error'> ERROR: Empty input </p>";
  } else if ($_GET["error"] == "invalidinput") {
    echo "<p class = 'error'> ERROR: Invalid input </p>";
  }
  ?>
  <p> Password reset coming soon. Having trouble loggin in? Support: "admin@thorsteinsoftware.com"</p>
</body>

</html>