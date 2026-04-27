<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .google-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    background: white; /* Google standard background */
    color: #1f2937; /* Dark text for contrast */
    text-decoration: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    border: 1px solid var(--border);
    width: 100%; /* Makes it full width like your other inputs */
    margin-top: 15px;
}

.google-btn img {
    width: 20px;
    height: 20px;
}

.google-btn:hover {
    background: #f3f4f6;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* If you want a Dark Version instead: */
.google-btn-dark {
    background: var(--card);
    color: white;
    border: 1px solid var(--border);
}

.google-btn-dark:hover {
    background: var(--sidebar);
}
    </style>
</head>
<body>
    <a href="login-google.php" class="google-btn">
    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_Logo.svg" alt="Google Logo">
    <span>Sign in with Google</span>
</a>
</body>
</html>