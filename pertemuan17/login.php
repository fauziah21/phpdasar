<?php
session_start();
require 'functions.php';

//cek apakah ada cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash('sha256', $row["username"])) {
        //bikin session
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}



if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

    //cek apakah ada username
    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //cek session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST["remember"])) {
                # buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }
            header('Location: index.php');
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">

    <!-- custom css -->
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <h1>Welcome back to
        <br>
        <span style="color: #1E4AE5">Learning PHP</span>

    </h1>

    <?php if (isset($error)) : ?>
        <p style="color: red;font-style:italic">Username / Password salah</p>
    <?php endif; ?>

    <div class="card">
        <form action="" method="post">
            <ul>
                <li>
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username">
                </li>
                <li>
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password">
                </li>
                <li>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>

                </li>
                <li>
                    <button type="submit" name="login" class="btn-login">Login</button>
                </li>
            </ul>
        </form>
    </div>
</body>

</html>