<?php
require('database.php');
session_start();

// Check session
if (!isset($_SESSION['status']) || $_SESSION['status'] == 'invalid') {
    $_SESSION['status'] = 'invalid';
}

if ($_SESSION['status'] == 'valid') {
    header("Location: home.php");
    exit();
}

// Login
if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill up')</script>";
    } else {

        $queryValidate = "SELECT * FROM users WHERE email = '$email'";
        $sqlValidate = mysqli_query($connection, $queryValidate);

        if (mysqli_num_rows($sqlValidate) > 0) {
            $row = mysqli_fetch_assoc($sqlValidate);

            if (password_verify($password, $row['password'])) {
                $_SESSION['status'] = 'valid';
                header("Location: home.php");
                exit();
            } else {
                echo "<script>alert('Invalid credentials')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Kevin's Angel</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <link rel="shortcut icon" href="logonam.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="loginform.css">
</head>
<body>
  
    




    <div class="container">
    <div class="logo-container">
        <img src="../logonam.png" class="logo-img">
    </div>
    <div class="logo">Kevin's Angel</div>
    <div class="title">Welcome back</div>

    <button type="button" class="btn" id="googleLoginBtn">
        <img src="https://www.svgrepo.com/show/475656/google-color.svg" style="width:18px; height:18px;">
        Sign in with Google
    </button>

    <button class="btn"><i class="fab fa-apple"></i> Sign in with Apple</button>
    <button class="btn">Sign in with SSO</button>

    <div class="divider"></div>

    <form method="POST" action="login.php">
        <div class="input-box">
            <input type="email" name="email" class="input" placeholder=" " required id="email">
            <label>Email</label>
        </div>

        <div class="input-box password-wrapper">
            <input type="password" name="password" class="input" placeholder=" " required id="password">
            <label>Password</label>
            <i class="fa-solid fa-eye" onclick="togglePassword()" style="cursor: pointer;"></i>
        </div>

       

        <button type="submit" name="login" class="login-btn" id="login">Sign in</button>
    </form>

    <div class="footer">
        Don’t have an account? <a href="registration.php">Sign up</a>
    </div>

    <div id="g_id_onload"
         data-client_id="997021567508-mh2g2fv9cm60v9gcgstbbjpe8bisp69c.apps.googleusercontent.com"
         data-callback="handleCredentialResponse"
         data-auto_prompt="false"
         data-use_fedcm_for_prompt="true">
    </div>
</div>
</body>
</html>