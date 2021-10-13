<?php
session_start();
if ($_SESSION["username"] !== "admin") {
  header("location: index.php");
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="No more mealprep! FREE dinner generator">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/controlpanel.css">
  <title>Dinner generator</title>
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
    <p id="title"> CONTROL PANEL </p>
  </div>

  <div id="output">
    <h1> ACTIVE USERS </h1>
    <?php
    include_once "scripts/connect.php";
    $userid = $_SESSION['userid'];
    $result = mysqli_query($conn, "SELECT * FROM users");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
      echo "<table>";
      echo "<tr>";
      echo "<th>ID</th>";
      echo "<th>Username</th>";
      echo "<th>Email</th>";
      echo "<th>Created</th>";
      echo "<th>IP</th>";
      echo "</tr>";
      while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row["userid"]; ?></td>
          <td><?php echo $row["username"]; ?></td>
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["created"]; ?></td>
          <td><?php echo $row["ip"]; ?></td>
        </tr>
    <?php
      }
    } else {
      echo "<h2>NO ACTIVE USERS</h2>";
    } ?>
  </div>
</body>

</html>