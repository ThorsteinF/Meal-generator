<?php
session_start();

if (!isset($_SESSION["userid"])) {
  header("../dinnergenerator");
} else if (isset($_POST["submit"])) {
  include_once "scripts/connect.php";
  include_once "scripts/functions.php";

  $pwd = $_POST["pwd"];
  $pwdrepeat = $_POST["pwdrepeat"];

  if (!emptyInputLogin($pwd, $pwdrepeat)) {
    header("location: changepwd?error=emptyinput");
  } else if (!pwdMatch($pwd, $pwdrepeat)) {
    header("location: changepwd?error=pwdnotmatch");
  } else if (strlen($pwd) <= 7) {
    header("location: changepwd?error=pwdtooshort");
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  $sql = "UPDATE users SET pwd = '$hashedPwd' WHERE userid = '$_SESSION[userid]';";
  mysqli_query($conn, $sql);

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
    <h1> CHANGE PASSWORD </h1>
  </div>

  <div id="output">
    <form action="changepwd" method="POST">
      <p> Password must be at least 8 characters long </p>
      <input name="pwd" type="password" placeholder="Password">
      <br>
      <input name="pwdrepeat" type="password" placeholder="Repeat password">
      <br>
      <button name="submit" id="add"> Submit </button>
    </form>
    <?php
    if (!isset($_GET["error"])) {
      null;
    } else if ($_GET["error"] == "emptyinput") {
      echo "<p> ERROR: Empty input </p>";
    } else if ($_GET["error"] == "pwdnotmatch") {
      echo "<p> ERROR: Passwords do not match </p>";
    } else if ($_GET["error"] == "pwdtooshort") {
      echo "<p> ERROR: Password too short (Min 8) </p>";
    }
    ?>
  </div>
</body>

</html>