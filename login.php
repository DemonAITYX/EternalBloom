<?php
require 'conn.php';
session_start();

/*
   REGISTER 
*/
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (nama, email, pw) VALUES ('$nama', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('You have registered, $nama!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

/* 
   LOGIN 
 */
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pw = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE nama='$username' AND pw='$pw' ");

    if (mysqli_num_rows($query) === 1) {

        $_SESSION['user_login'] = true;
        $_SESSION['username'] = $username;

        header("Location: index.php");

        exit;

    } else {
        echo "<script>alert('Wrong Username or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    
    <div class="container">

        <!-- LOGIN FORM -->
        <div class="form-box login">
            <form action="" method="POST">
                <h1>Login</h1>

                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="bi bi-lock-fill"></i>
                </div>

                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn" name="login">Login</button>

                <p>or login with</p>
                <div class="social-icons">
                    <a href="https://myaccount.google.com/"><i class="bi bi-google"></i></a>
                    <a href="https://www.facebook.com/?locale=id_ID"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-envelope-fill"></i></a>
                </div>
            </form>
        </div>

        <!-- REGISTER FORM -->
        <div class="form-box register">
            <form action="" method="POST">
                <h1>Registration</h1>

                <div class="input-box">
                    <input type="text" id="nama" name="nama" placeholder="Username" required>
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="input-box">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <i class="bi bi-envelope-fill"></i>
                </div>

                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="bi bi-lock-fill"></i>
                </div>

                <button type="submit" name="submit" class="btn">Register</button>

                <p>or register with</p>
                <div class="social-icons">
                    <a href="https://myaccount.google.com/"><i class="bi bi-google"></i></a>
                    <a href="https://www.facebook.com/?locale=id_ID"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-envelope-fill"></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>

    </div>

    <script src="login.js"></script>

    <div class="back-btn">
        <a href="index.php"><i class="bi bi-arrow-left-circle"></i></a>
    </div>

</body>
</html>