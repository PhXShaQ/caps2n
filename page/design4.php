<?php
// Include your session check at the very top
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginform.php");
    exit();
}
$userEmail = $_SESSION['email'] ?? 'User';
$initial = strtoupper(substr($userEmail, 0, 1));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meeting Dashboard</title>
        <link rel="shortcut icon" href="logonam.png" type="image/x-icon">
        <script src="https://unpkg.com/lucide@latest"></script>
         <link rel="stylesheet" href="../css/designs.css">

    </head>
    <body>
        <div class="sidebar">
            <div class="logos">
                <img src="../logonam.png" alt="logo"/>
                <h2>Kevin Angel's</h2>
            </div>
            <a href="designhome.php" class="menu-item"><i data-lucide="house"></i> Home</a>
            <a href="design1.php" class="menu-item"><i data-lucide="mic"></i> Meeting</a>
            <a href="design2.php" class="menu-item"><i data-lucide="volume-2"></i> Voice Cloaning</a>
            <a href="design3.php" class="menu-item"><i data-lucide="headphones"></i> Audio to Text</a>
            <a href="design4.php" class="menu-item"style="background: var(--purple); color: white;"><i data-lucide="file-audio"></i> Text to Audio</a>
        </div>
        <div class="main">
            <div class="topbar">
                <input type="text" class="search" placeholder="Search by title or keyword">
                <div class="profile-section">
                    
                    <div class="profile-trigger" onclick="toggleAccountModal()">
                        <?php echo $initial; ?>
                    </div>
                </div>
                <div id="accountModal" class="account-modal hidden">
                    <div class="modal-avatar-large"><?php echo $initial; ?></div>
                    <div style="margin-bottom: 5px; font-weight: 600;">Kevin Angel User</div>
                    <div style="color: var(--muted); font-size: 13px;"><?php echo $userEmail; ?></div>
                    
                     <a href="https://myaccount.google.com/" target="_blank" class="manage-link" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                        Manage your Google Account
                        <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                    </a>
                    
                    <a href="logout.php" class="signout-btn">Sign Out</a>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
        <script src="../script/design4.js"></script>
    </body>
    
</html>