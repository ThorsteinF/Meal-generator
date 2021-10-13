<?php
include_once "connect.php";

function emptyInputSignup($username, $email, $pwd, $pwdrepeat)
{
    if ((empty($username)) || (empty($email)) || (empty($pwd)) || (empty($pwdrepeat))) {
        return true;
    } else {
        return false;
    }
}

function emptyInputLogin($username, $pwd)
{
    if ((empty($username)) || (empty($pwd))) {
        return true;
    } else {
        return false;
    }
}

function invalidUid($username)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return true;
    } else {
        return false;
    }
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function pwdMatch($pwd, $pwdrepeat)
{
    if ($pwd == $pwdrepeat) {
        return true;
    } else {
        return false;
    }
}

function uidEmailExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ?error=invalidInput");
        exit();
    }
    #mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $userid, $email, $username, $pwd, $created, $ip)
{
    $sql = "INSERT INTO users (userid, email, username, pwd, created, ip) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $userid, $email, $username, $hashedPwd, $created, $ip);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function loginUser($conn, $username, $pwd)
{
    $uidExists = uidEmailExists($conn, $username, $username);

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ?error=emptyinput");
        exit();
    } else if (!$uidExists) {
        header("location: ?error=invalidinput");
        exit();
    }

    $pwdHashed = $uidExists["pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if (!$checkPwd) {
        header("location: ?error=invalidinput");
        exit();
    } else if ($checkPwd) {
        session_start();
        $_SESSION["userid"] = $uidExists["userid"];
        $_SESSION["username"] = $uidExists["username"];
        $_SESSION["email"] = $uidExists["email"];
    }
}

function createUserId($conn)
{
    $num = rand(1, 999999);
    $num = str_repeat("0", 6 - strlen($num)) . $num;
    $row = mysqli_num_rows(mysqli_query($conn, "SELECT userid FROM users WHERE userid = $num;"));
    if ($row > 0) {
        createUserId($conn);
        exit();
    } else {
        return $num;
    }
}
