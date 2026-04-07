
<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            echo "<script>alert('Login Successful!'); window.location='homepage2.php';</script>";

        } else {
            echo "<script>alert('Wrong Password!'); window.location='loginform.php';</script>";
        }
    } else {
        echo "<script>alert('Wrong Password!'); window.location='loginform.php';</script>";
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
<title>Premium Login UI</title>
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
    <img src="https://www.svgrepo.com/show/475656/google-color.svg" 
         style="width:18px; height:18px;">
    Sign in with Google
</button>

    <button class="btn">
        <i class="fab fa-apple"></i> Sign in with Apple
    </button>

    <button class="btn">Sign in with SSO</button>

    <div class="divider"></div>

    <form method="POST" action="loginform.php">

    <div class="input-box">
        <input type="email" name="email" class="input" placeholder=" " required>
        <label>Email</label>
    </div>

    <div class="input-box password-wrapper">
        <input type="password" name="password" class="input" placeholder=" " required>
        <label>Password</label>
        <i class="fa-solid fa-eye" onclick="togglePassword()"></i>
    </div>

    <button type="submit" class="login-btn">Sign in</button>

</form>

    <div class="footer">
        Don’t have an account? <a href="registration.php">Sign up</a>
    </div>

    <div id="g_id_onload"
     data-client_id="997021567508-mh2g2fv9cm60v9gcgstbbjpe8bisp69c.apps.googleusercontent.com"
     data-callback="handleCredentialResponse"
     data-auto_prompt="false"
     data-use_fedcm_for_prompt="true"> </div>
</div>

</div>

<script>

    // This function receives the token from Google
function handleCredentialResponse(response) {
    // Send token to your PHP backend
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

// Attach the Google Popup to your custom button
document.getElementById('googleLoginBtn').onclick = () => {
    google.accounts.id.prompt(); 
};

// Your existing UI scripts
function togglePassword() {
    const passwordField = document.getElementById("password");
    passwordField.type = passwordField.type === "password" ? "text" : "password";
}


const emailField = document.getElementById("email");
const passwordField = document.getElementById("password");
const submitBtn = document.getElementById("loginBtn");

function checkInputs() {
    // Safety check: only run if the elements were found
    if (emailField && passwordField && submitBtn) {
        submitBtn.disabled = !(emailField.value && passwordField.value);
    }
}

// Add listeners only if the fields exist
if (emailField) emailField.addEventListener("input", checkInputs);
if (passwordField) passwordField.addEventListener("input", checkInputs);

function togglePassword() {
    const pField = document.getElementById("password");
    if (pField) {
        pField.type = pField.type === "password" ? "text" : "password";
    }
}
</script>

</body>
</html>