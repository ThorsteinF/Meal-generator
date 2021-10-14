<?php
session_start();

if (!isset($_SESSION['userid'])) {
  header("location: login");
} else if (isset($_GET["userid"])) {
  include_once "scripts/connect.php";

  $sql = "DELETE FROM users WHERE userid = '$_GET[userid]';";
  mysqli_query($conn, $sql);
  header("location: logout");
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="No more mealprep! FREE dinner generator!">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Dinner generator - profile</title>
</head>

<body>
  <header>
    <a href='../'><button>BACK</button></a>
    <a href="../dinnergenerator"><button>HOME</button></a>
    <?php
    if (isset($_SESSION["userid"])) {
      echo "<a href = 'savedmeals'><button>Saved meals</button></a>";
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
    <p id="title"> MY PROFILE </p>
  </div>

  <div id="output">
    <table>
      <tr>
        <th>ID</th>
        <td><?php echo $_SESSION["userid"]; ?></td>
      <tr>
        <th> EMAIL </th>
        <td><?php echo $_SESSION["email"]; ?></td>
        <?php echo "<td><a href = 'changeemail'><button> CHANGE </button> </a></td>" ?>
      </tr>
      <th> USERNAME </th>
      <td><?php echo $_SESSION["username"]; ?></td>
      <?php echo "<td><a href = 'changeusername'><button> CHANGE </button> </a></td>" ?>
      <tr>
        <th>PASSWORD</th>
        <td></td>
        <?php echo "<td><a href = 'changepwd'><button> CHANGE </button> </a></td>" ?>
      </tr>
      <tr>
        <th>Created</th>
        <td><?php include_once "scripts/connect.php";
            echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT created FROM users WHERE userid = '$_SESSION[userid]';"))["created"]; ?></td>
      <tr>
    </table>
    <?php echo "<a href = 'profile?userid=$_SESSION[userid]'><button style = 'margin-top: 100px;'> DELETE ACCOUNT </button></a>" ?>
  </div>
</body>

</html>