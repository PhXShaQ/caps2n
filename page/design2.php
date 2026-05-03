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
            <a href="design2.php" class="menu-item" style="background: var(--purple); color: white;"><i data-lucide="volume-2"></i> Voice Cloaning</a>
            <a href="design3.php" class="menu-item"><i data-lucide="headphones"></i> Audio to Text</a>
            <a href="design4.php" class="menu-item"><i data-lucide="file-audio"></i> Text to Audio</a>
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

            <div class="content-body">
                

                <div class="folder-container" style="display: block; max-width: 1500px; margin: 0 auto;">
                <h2 style="margin-bottom: 20px; color: var(--text);">Text to Voice</h2>
                
                <div class="input-box" style="margin-bottom: 20px;">
                    <textarea id="textToSpeak" placeholder="Type something here..." 
                        style="width: 100%; height: 200px; background: var(--card); border: 1px solid var(--border); 
                        color: white; padding: 15px; border-radius: 12px; font-size: 16px; resize: none;"></textarea>
                </div>
            
                <div>
                    <select id="voiceSelect" style="flex: 1; background: var(--card); color: white; border: 1px solid var(--border); padding: 10px; border-radius: 8px; ">
                        <option value="">Loading Voices...</option>
                    </select>
                    
                    <div style="color: var(--muted); font-size: 14px;">
                        Speed: <span id="speedValue">1</span>x
                        <input type="range" id="rate" min="0.5" max="2" value="1" step="0.1" style="display: block;">
                    </div>

                    <button class="btn" onclick="stopSpeech()" style="background: red; color: white; border: 1px solid #white;">
                        <i data-lucide="square"></i> Stop
                    </button>

                    <button class="login-btns" onclick="speakText()" style="background: gray; height: 48px; color: white; border: 1px solid #white; ">
                        <i data-lucide="volume-2"></i> Speak Now
                    </button>

                    
                </div>
            
                <div style="display: flex; gap: 10px;">
                    
                    
                </div>
            

                <!-- Overlay -->
                
                </div>
            </div>


            <?php include "footer.php"; ?>
        </div>
       
       
    </body>
    <script src="../script/design2.js"></script>
     
     
     
</html>