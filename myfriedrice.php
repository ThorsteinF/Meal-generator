<?php
session_start();

if (!isset($_SESSION['userid'])) {
  header("location: login.php");
} else if (isset($_GET["mealid"])) {
  include_once "scripts/connect.php";

  $sql = "DELETE FROM meals WHERE mealid = '$_GET[mealid]';";
  mysqli_query($conn, $sql);

  header("location: savedmeals.pyp");
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="No more mealprep! FREE dinner generator!">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Dinner generator - dinner database</title>
</head>

<body>
  <header>
    <a href='../'><button>BACK</button></a>
    <a href="index.php"><button>HOME</button></a>
    <?php
    if (isset($_SESSION["userid"])) {
      echo "<a href = 'savedmeals.pyp'><button>SAVED MEALS</button></a>";
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
    <p id="title"> DINNER DATABASE </p>
  </div>
  <table>
    <?php
    include_once "scripts/connect.php";
    $result = mysqli_query($conn, "SELECT * FROM meals WHERE userid = '$_SESSION[userid]';");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
      echo "<th>carbs</th>";
      echo "<th>Meat</th>";
      echo "<th>Vegetables</th>";
      echo "<th>Action</th>";

      while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row["carbs"]; ?></td>
          <td><?php echo $row["meat"]; ?></td>
          <td><?php echo $row["vegetable"]; ?></td>
          <td><?php echo "<a href = 'savedmeals.pyp?mealid=$row[mealid]'><button> DELETE </button></a>" ?></td>
        </tr>
    <?php
      }
    } else {
      echo "<h2>NO DATA</h2>";
    } ?>
  </table>
</body>

</html>