<?php
require 'conn.php';
session_start();

/*
   REGISTER 
*/
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Role default user
    $role = "user";

    $stmt = $conn->prepare("INSERT INTO users (nama, email, pw, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $password, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Register berhasil, silakan login');</script>";
    } else {
        echo "<script>alert('Register gagal');</script>";
    }
}


/* 
   LOGIN 
 */
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pw = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nama, email, pw, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();
        $stored = $user['pw']; // bisa INT, MD5, atau HASH

        /*
            1. Password HASH → langsung verify
        */
        if (strlen($stored) > 30 && password_verify($pw, $stored)) {

            // Rehash jika perlu
            if (password_needs_rehash($stored, PASSWORD_DEFAULT)) {
                $newHash = password_hash($pw, PASSWORD_DEFAULT);
                $u = $conn->prepare("UPDATE users SET pw = ? WHERE id = ?");
                $u->bind_param("si", $newHash, $user['id']);
                $u->execute();
            }

        } 
        /*
            2. Password INT → cocokkan langsung
            contoh: db = 1234, user masukin 1234
        */
        elseif (ctype_digit($stored) && $pw == $stored) {

            // PERBARUI ke HASH agar aman
            $new = password_hash($pw, PASSWORD_DEFAULT);
            $q = $conn->prepare("UPDATE users SET pw = ? WHERE id = ?");
            $q->bind_param("si", $new, $user['id']);
            $q->execute();

        } 
        /*
            3. Password MD5 → dukung sistem lama
        */
        elseif (strlen($stored) === 32 && $stored === md5($pw)) {

            // Upgrade ke hash
            $newHash = password_hash($pw, PASSWORD_DEFAULT);
            $u = $conn->prepare("UPDATE users SET pw = ? WHERE id = ?");
            $u->bind_param("si", $newHash, $user['id']);
            $u->execute();

        } 
        else {
            echo "<script>alert('Password salah');</script>";
            exit;
        }

        // LOGIN BERHASIL → Set session
        $_SESSION['user_login'] = $user['id'];
        $_SESSION['username'] = $user['nama'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if($user['email'] == "admin@gmail.com"){
            $_SESSION['is_admin'] = true;
        }

        // Redirect
        if ($user['role'] === 'admin') header("Location: admin.php");
        else header("Location: index.php");
        exit;

    } else {
        echo "<script>alert('Email tidak ditemukan');</script>";
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
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="bi bi-envelope-fill"></i>
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