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
            <a href="design3.php" class="menu-item"style="background: var(--purple); color: white;"><i data-lucide="headphones"></i> Audio to Text</a>
            <a href="design4.php" class="menu-item"><i data-lucide="file-audio"></i> Text to Audio</a>
        </div>
        <div class="main">
            <div class="topbar">
                <input type="text" class="search" placeholder="Search by title or keyword">
                <div class="profile-section" onclick="toggleAccountModal()">
                    <div class="profile-trigger">
                        <div class="user-avatar"><?php echo $initial; ?></div>
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
            

            <div class="content-bodys">
                <div class="container1">
                    <div class="upload-card" onclick="openTranscribeModal()">
                        <div class="icon-circle"><i data-lucide="cloud-upload"></i></div>
                        <span>Upload MP3</span>
                    </div>

                    <div id="transcribeModal" class="modal-overlay">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="header-title">
                                    <i data-lucide="cloud-upload"></i>
                                    <span>Transcribe Files</span>
                                </div>
                                <button class="close-btn" onclick="closeTranscribeModal()">&times;</button>
                            </div>

                            <div class="modal-body">
                                <label>Audio / Video File</label>
                                <div class="file-drop-area" id="dropArea">
                                    <p id="fileNameDisplay">Select or drag an audio file here</p>
                                    <input type="file" id="audioFileInput" hidden accept="audio/*">
                                </div>

                                <label>Audio Language</label>
                                <select id="audioLang" class="modal-select">
                                    <option value="fil">Tagalog 🇵🇭</option>
                                    <option value="en">English 🇺🇸</option>
                                </select>

                                <button class="btn-primary" id="transcribeBtn" onclick="processTranscription()">
                                    TRANSCRIBE
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="resultContainer" style="display:none; margin-top: 20px;">
                        <div style="background: #1e1e1e; border: 1px solid #333; border-radius: 12px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #007bff; margin: 0; font-size: 16px;">Transcription Output</h3>
                            <button onclick="copyText()" style="background: #333; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 12px;">Copy Text</button>
                        </div>
                        <div id="resultText" style="color: #e0e0e0; line-height: 1.6; font-size: 14px; min-height: 100px; white-space: pre-wrap;"></div>
                        </div>
                    </div>
                
                </div>
            </div>

            <?php include "footer.php"; ?>
        </div>
        
        
    </body>

    <script src="../script/design3.js"></script>
</html>