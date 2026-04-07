<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        die("All fields are required.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: loginform.php?success=1");
        exit();
    } else {
        die("Execute failed: " . $stmt->error);
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
<title>Register</title>
<link rel="stylesheet" href="../css/registration.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>

<body>

<div class="container">
    <div class="logo-container">
        <img src="../logonam.png" class="logo-img">
    </div>

    <div class="title-small">Kevin's Angel</div>
    <div class="title">Create Account</div>

<form method="POST">

    <div class="input-box">
        <input type="email" name="email" class="input" placeholder=" " required id="email">
        <label>Email</label>
    </div>

    <div class="input-box password-wrapper">
        <input type="password" name="password" class="input" placeholder=" " required id="password">
        <label>Password</label>
        <i class="fa-solid fa-eye" onclick="togglePassword()"></i>
    </div>

    <button type="submit" class="register-btn" id="btn" disabled>
        Register
    </button>

</form>
    <div class="footer">
        Already have an account? <a href="loginform.php">Sign in</a>
    </div>

</div>

<script>
const email = document.getElementById("email");
const password = document.getElementById("password");
const btn = document.getElementById("btn");

function checkInputs() {
    if(email.value && password.value) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

email.addEventListener("input", checkInputs);
password.addEventListener("input", checkInputs);

function togglePassword() {
    password.type = password.type === "password" ? "text" : "password";
}
</script>

</body>
</html>