<?php
session_start();

if (isset($_POST["submit"])) {
  include_once "scripts/connect.php";
  include_once "scripts/functions.php";

  $userid = createUserId($conn);
  $username = $_POST["username"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];
  $pwdrepeat = $_POST["pwdrepeat"];
  date_default_timezone_set("Europe/Oslo");
  $created = date("d-m-Y H:i");
  $ip = $_SERVER['REMOTE_ADDR'];

  if (strlen($username) > 31) {
    header("location: ?error=usernametoolong");
    exit();
  } else if (strlen($pwd) <= 7) {
    header("location: ?error=pwdtooshort");
    exit();
  } else if (emptyInputSignup($username, $email, $pwd, $pwdrepeat)) {
    header("location: ?error=emptyinput");
    exit();
  } else if (invalidUid($username)) {
    header("location: ?error=invalidusername");
    exit();
  } else if (invalidEmail($email)) {
    header("location: ?error=invalidemail");
    exit();
  } else if (!pwdMatch($pwd, $pwdrepeat)) {
    header("location: ?error=pwdnotmatch");
    exit();
  } else if (uidEmailExists($conn, $username, $email)) {
    header("location: ?error=usernameexists");
    exit();
  }

  createUser($conn, $userid, $email, $username, $pwd, $created, $ip);
  loginUser($conn, $username, $pwd);
  header("location: ../dinnergenerator");
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="No more mealprep! FREE dinner generator">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Dinner generator - signup</title>
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
    <form action="signup" method="POST">
      <h1> Sign up </h1>
      <input type="text" name="email" placeholder="Email" id="inputEmail">
      <br>
      <input type="text" name="username" placeholder="Username" id="inputUid">
      <br>
      <input type="password" name="pwd" placeholder="Password" id="inputPwd">
      <br>
      <input type="password" name="pwdrepeat" placeholder="Repeat password" id="inputRepeatPwd">
      <br>
      <button type="submit" name="submit"> Submit </button>
    </form>
  </div>
  <?php
  if (!isset($_GET["error"])) {
    null;
  } else if ($_GET["error"] == "usernametoolong") {
    echo "<p class = 'error'> ERROR: Username too long (Max 32)</p>";
  } else if ($_GET["error"] == "emptyinput") {
    echo "<p class = 'error'> ERROR: Empty input </p>";
  } else if ($_GET["error"] == "invalidusername") {
    echo "<p class = 'error'> ERROR: Invalid username </p>";
  } else if ($_GET["error"] == "invalidemail") {
    echo "<p class = 'error'> ERROR: Invalid email </p>";
  } else if ($_GET["error"] == "pwdtooshort") {
    echo "<p class = 'error'> ERROR: Password too short (Min 8)</p>";
  } else if ($_GET["error"] == "pwdnotmatch") {
    echo "<p class = 'error'> ERROR: Passwords do not match </p>";
  } else if ($_GET["error"] == "stmtfailed") {
    echo "<p class = 'error'> ERROR: Internal server error. Please contact support! </p>";
  }
  ?>
  <p> Your account can be deleted at any time and all your data will be wiped from the server </p>
  <p> Password must be at least 8 characters long </p>
  <p> All passwords are hashed </p>
</body>

</html>