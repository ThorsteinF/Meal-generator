<?php
session_start();

if (!isset($_SESSION["userid"])) {
  header("../dinnergenerator");
} else if (isset($_POST["submit"])) {
  include_once "scripts/connect.php";
  include_once "scripts/functions.php";
  $email = $_POST["email"];

  if (invalidEmail($email)) {
    header("location: changeemail?error=invalidemail");
    exit();
  }
  if (uidEmailExists($conn, $email, $email)) {
    header("location: changeemail?error=emailexists");
    exit();
  }

  $sql = "UPDATE users SET email = '$email' WHERE userid = '$_SESSION[userid]';";
  mysqli_query($conn, $sql);

  $_SESSION["email"] = $email;
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
    <p id="title"> CHANGE EMAIL </p>
  </div>

  <div id="output">
    <form action="changeemail" method="POST">
      <input name="email" placeholder="Email">
      <button name="submit"> Submit </button>
    </form>
    <?php
    if (!isset($_GET["error"])) {
      null;
    } else if ($_GET["error"] == "emptyinput") {
      echo "<p class = 'error'> ERROR: Empty input </p>";
    } else if ($_GET["error"] == "invalidemail") {
      echo "<p class = 'error'> ERROR: Invalid email </p>";
    } ?>
  </div>
</body>

</html>