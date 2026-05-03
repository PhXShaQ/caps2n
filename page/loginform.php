
<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // password_verify automatically detects Argon2id or Bcrypt
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            echo "<script>alert('Login Successful!'); window.location='homepage2.php';</script>";
            exit();

        } else {
            echo "<script>alert('Invalid email or password.'); window.location='loginform.php';</script>";
        }
    } else {
        // We use the same message for security (don't tell attackers which part was wrong)
        echo "<script>alert('Invalid email or password.'); window.location='loginform.php';</script>";
    }
    $stmt->close();
}
$conn->close();
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
    <link rel="stylesheet" href="../css/loginform.css">
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

    <form method="POST" action="loginform" autocomplete="off">
        <div class="input-box">
            <input type="email" name="email" autocomplete="one-time-code" class="input" placeholder="Enter Email" required id="email">
            <label>Email</label>
        </div>

        <div class="input-box password-wrapper">
            <input type="password" name="password" class="input" placeholder="Enter Password" required id="password" autocomplete="new-password">
            <label>Password</label>
            <i class="fa-solid fa-eye" onclick="togglePassword()" style="cursor: pointer;"></i>
        </div>

        <button type="submit" class="login-btn" id="loginBtn">Sign in</button>
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

<script>
    // Google Auth Logic
    function handleCredentialResponse(response) {
        fetch("verify_google_login.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ token: response.credential })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = "homepage2.php";
            } else {
                alert("Google Login Error: " + data.message);
            }
        })
        .catch(err => console.error("Error:", err));
    }

    document.getElementById('googleLoginBtn').onclick = () => {
        google.accounts.id.prompt(); 
    };

    // UI Helper Scripts
    const emailField = document.getElementById("email");
    const passwordField = document.getElementById("password");
    const submitBtn = document.getElementById("loginBtn");

    function checkInputs() {
        if (emailField && passwordField && submitBtn) {
            submitBtn.disabled = !(emailField.value.trim() && passwordField.value.trim());
        }
    }

    emailField.addEventListener("input", checkInputs);
    passwordField.addEventListener("input", checkInputs);

    function togglePassword() {
        if (passwordField) {
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    }
</script>
</body>
</html>