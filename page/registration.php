<?php
include "config.php";

$error_message = ""; // Variable to store errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error_message = "All fields are required.";
    } else {
        // 1. Check if email already exists
        $checkEmail = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            // Set the error message instead of using die()
            $error_message = "This email is already registered. Please use another or sign in.";
        } else {
            // 2. Email is unique, proceed with Argon2id
            $options = [
                'memory_cost' => 65536, 
                'time_cost'   => 4,
                'threads'     => 2
            ];

            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID, $options);

            $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ss", $email, $hashedPassword);
                if ($stmt->execute()) {
                    header("Location: loginform.php?success=1");
                    exit();
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
        $checkEmail->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Kevin's Angel</title>
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
            <input type="email" name="email" class="input" placeholder=" " required id="email" 
                autocomplete="off"
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <label>Email</label>
        </div>

        <div class="input-box password-wrapper">
            <input type="password" name="password" class="input" placeholder=" " required id="password" 
                autocomplete="new-password">
            <label>Password</label>
            <i class="fa-solid fa-eye" onclick="togglePassword()" style="cursor: pointer;"></i>
        </div>

        <button type="submit" class="register-btn" id="btn" disabled>Register</button>
    </form>

    <div class="footer">
        Already have an account? <a href="loginform.php">Sign in</a>
    </div>
</div>

<script>
    // Check if there is an error message from PHP and show an alert
    <?php if (!empty($error_message)): ?>
        alert("<?php echo addslashes($error_message); ?>");
    <?php endif; ?>

    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const btn = document.getElementById("btn");

    function checkInputs() {
        btn.disabled = !(email.value.trim() && password.value.trim());
    }

    email.addEventListener("input", checkInputs);
    password.addEventListener("input", checkInputs);

    // Run once on load in case the email was kept after a refresh
    checkInputs();

    function togglePassword() {
        password.type = password.type === "password" ? "text" : "password";
    }
</script>

</body>
</html>